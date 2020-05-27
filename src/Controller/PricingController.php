<?php

namespace App\Controller;

use App\DTO\ItemResponseDTO;
use App\DTO\PricingByItemResponseDTO;
use App\DTO\PricingRequestDTO;
use App\DTO\PricingResponseDTO;
use App\DTO\PricingUpdateRequestDTO;
use App\DTO\ResponseDTO;
use App\Entity\Item;
use App\Entity\Itemcredit;
use App\Entity\Paymentmode;
use App\Entity\Paymentstatus;
use App\Entity\Pricing;
use App\Entity\Status;
use App\Entity\User;
use App\Form\PricingType;
use App\Services\CalendarConverterService;
use App\Services\CalendarExchangeService;
use App\Services\PushNotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/rest/pricing")
 */
class PricingController extends AbstractController
{
    /**
     * @Route("/listByItem", name="pricing_listAll", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Pricings in Item",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=PricingResponseDTO::class))
     *      ))
     *     )
     * @SWG\Parameter(
     *      name="itemId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Pricings")
     */
    public function listByItem(Request $request): Response
    {
        $itemId = intval($request->query->get('itemId'));

        $pricings = $this->getDoctrine()->getRepository(Pricing::class)->createNamedQuery('pricingByItem')
            ->setParameter('itemId', $itemId)->getResult();

        $pricingList = array();

        foreach ($pricings as $pricing) {
//            $pricing = new Pricing();
            if ($pricing->getStatus()->getId() == 1) {

                $pricingDTO = $this->listConstruct($pricing);

                array_push($pricingList, $pricingDTO);
            }
        }


        return $this->json($pricingList);
    }

    /**
     * @Route("/pricingByItem", name="pricing_listByItem", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns Detail List of Pricings in Item",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=PricingByItemResponseDTO::class))
     *      ))
     *     )
     * @SWG\Parameter(
     *      name="itemId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="PricingsMerchant")
     * @param Request $request
     * @return Response
     */
    public function pricingByItem(Request $request): Response
    {
        $itemId = intval($request->query->get('itemId'));

        $pricings = $this->getDoctrine()->getRepository(Pricing::class)->createNamedQuery('pricingByItem')
            ->setParameter('itemId', $itemId)->getResult();

        $pricingList = array();

        foreach ($pricings as $pricing) {
//            $pricing = new Pricing();
            if ($pricing->getStatus()->getId() == 1) {

                $pricingDTO = $this->merchantlistConstruct($pricing);

                array_push($pricingList, $pricingDTO);
            }
        }


        return $this->json($pricingList);
    }


    /**
     * @Route("/insert", name="pricing_new", methods={"POST"})
     * @IsGranted({"ROLE_OWNER","ROLE_ADMIN"})
     * @SWG\Response(
     *     response=200,
     *     description="Creates Pricing",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *     )
     *
     * @SWG\Parameter(
     *     name="branch",
     *     in="body",
     *    @SWG\Schema(ref=@Model(type=PricingRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="PricingsMerchant")
     *
     * @ParamConverter("pricingRequestDTO", converter="fos_rest.request_body")
     * @param PricingRequestDTO $pricingRequestDTO
     * @return ResponseDTO
     */
    public function new(PricingRequestDTO $pricingRequestDTO): ResponseDTO
    {
        try {

            $calendar = new CalendarExchangeService();
            $etDate = $calendar->etNow();
            $regDate = new \DateTime();

            $item = $this->getDoctrine()->getRepository(Item::class)->find($pricingRequestDTO->getItem());
//         $item= new Item();
            if ($item != null && $item->getStatus()->getId() == 1) {


                $status = $this->getDoctrine()->getRepository(Status::class)->find(1);

                $pricing = new Pricing();
                $pricing->setItem($item);
                $pricing->setItemName($pricingRequestDTO->getItemTypeName());
                $pricing->setUnitPrice($pricingRequestDTO->getUnitPrice());
                $pricing->setRegisteredby($this->getUser());
                $pricing->setRegdate($regDate);
                $pricing->setRegetdate($etDate);
                $pricing->setStatus($status);
                $pricing->setIsDefault(0);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($pricing);
                $entityManager->flush();


                $pricigResponseDTO = $this->merchantlistConstruct($pricing);
                $notify = new PushNotificationService();
                $users = $this->getDoctrine()->getRepository(User::class)
                    ->createNamedQuery('usersByCompany')
                    ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


                foreach ($users as $user) {
//                    $user = new User();

                    if($user->getNotificationtoken()!=null){
                        if($user->getRole()->getId()==4){
                            $customerpricigResponseDTO = $this->listConstruct($pricing);
                            $notify->pushSilentNotifications($this->json($customerpricigResponseDTO), 4, 1, $user->getNotificationtoken());
                        }else{
                            $notify->pushSilentNotifications($this->json($pricigResponseDTO), 4, 1, $user->getNotificationtoken());
                        }

                    }

                }
                return new ResponseDTO(true, 'Pricing Registered SuccessFully ');
            } else {
                return new ResponseDTO(false, 'Unable to register Pricing on Deleted Item SuccessFully ');
            }
        } catch (\Exception $e) {
            return new ResponseDTO(false, 'Pricing NOT Registered ' . $e->getMessage());
        }

    }

    /**
     * @Route("/update", name="pricing_update", methods={"POST"})
     * @IsGranted({"ROLE_OWNER","ROLE_ADMIN"})
     * @SWG\Response(
     *     response=200,
     *     description="Creates Pricing",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *     )
     *
     * @SWG\Parameter(
     *     name="branch",
     *     in="body",
     *    @SWG\Schema(ref=@Model(type=PricingUpdateRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="PricingsMerchant")
     *
     * @ParamConverter("pricingRequestDTO", converter="fos_rest.request_body")
     * @param PricingUpdateRequestDTO $pricingRequestDTO
     * @return ResponseDTO
     */
    public function update(PricingUpdateRequestDTO $pricingRequestDTO): ResponseDTO
    {
        try {

            $calendar = new CalendarExchangeService();
            $etDate = $calendar->etNow();
            $regDate = new \DateTime();

            $pricing = $this->getDoctrine()->getRepository(Pricing::class)->find($pricingRequestDTO->getId());
            if ($pricing != null && $pricing->getStatus()->getId() != 3) {


                $status = $this->getDoctrine()->getRepository(Status::class)->find(1);


                $pricing->setItemName($pricingRequestDTO->getItemTypeName());
                $pricing->setUnitPrice($pricingRequestDTO->getUnitPrice());
                $pricing->setStatus($status);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->merge($pricing);
                $entityManager->flush();



                $pricigResponseDTO = $this->merchantlistConstruct($pricing);

                $notify = new PushNotificationService();
                $users = $this->getDoctrine()->getRepository(User::class)
                    ->createNamedQuery('usersByCompany')
                    ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


                foreach ($users as $user) {
//                    $user = new User();

                    if($user->getNotificationtoken()!=null){
                        if($user->getRole()->getId()==4){
                            $customerpricigResponseDTO = $this->listConstruct($pricing);
                            $notify->pushSilentNotifications($this->json($customerpricigResponseDTO), 4, 2, $user->getNotificationtoken());
                        }else{
                            $notify->pushSilentNotifications($this->json($pricigResponseDTO), 4, 2, $user->getNotificationtoken());
                        }

                    }

                }


                return new ResponseDTO(true, 'Pricing Registered SuccessFully ');
            } else {
                return new ResponseDTO(false, 'Unable to register Pricing on Deleted Item SuccessFully ');
            }
        } catch (\Exception $e) {
            return new ResponseDTO(false, 'Pricing NOT Registered ' . $e->getMessage());
        }

    }

    private function merchantlistConstruct($pricing)
    {

        $pricingDTO = new PricingByItemResponseDTO();
        $pricingDTO->setId($pricing->getId());
        $pricingDTO->setUnitPrice($pricing->getUnitPrice());
        $pricingDTO->setName($pricing->getItemName());
        $pricingDTO->setItemId($pricing->getItem()->getId());
        $pricingDTO->setRegisteredbyId($pricing->getRegisteredby()->getId());
        $pricingDTO->setRegisteredbyName($pricing->getRegisteredby()->getFirstname().' '.$pricing->getRegisteredby()->getLastname());
        $pricingDTO->setRegDate($pricing->getRegdate());
        $pricingDTO->setRegEtDate($pricing->getRegEtDate());
        $pricingDTO->setStatusId($pricing->getStatus()->getId());
        $pricingDTO->setStatusName($pricing->getStatus()->getName());
        $pricingDTO->setIsDefault($pricing->getIsDefault());

        return $pricingDTO;
    }

    private function listConstruct($pricing)
    {
        $pricingDTO = new PricingResponseDTO();
        $pricingDTO->setId($pricing->getId());
        $pricingDTO->setItemTypeName($pricing->getItemName());
        $pricingDTO->setUnitPrice($pricing->getUnitPrice());
        $pricingDTO->setStatusId($pricing->getStatus()->getId());
        $pricingDTO->setStatusName($pricing->getStatus()->getName());
        return $pricingDTO;
    }


}
