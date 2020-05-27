<?php

namespace App\Controller;

use App\DTO\ItemResponseDTO;
use App\DTO\ItemSummaryResponseDTO;
use App\DTO\ItemUpdateRequestDTO;
use App\DTO\MerchantItemResponseDTO;
use App\DTO\PricingByItemResponseDTO;
use App\DTO\PricingResponseDTO;
use App\DTO\pricingSummaryResponseDTO;
use App\DTO\ResponseDTO;
use App\Entity\Category;
use App\Entity\Item;
use App\Entity\Itemcredit;
use App\Entity\Itemstatus;
use App\Entity\Measueingunit;
use App\Entity\Measuringunit;
use App\Entity\Paymentmode;
use App\Entity\Paymentstatus;
use App\Entity\Pricing;
use App\Entity\Status;
use App\Entity\User;
use App\DTO\ItemRequestDTO;
use App\Services\CalendarConverterService;
use App\Services\CalendarExchangeService;
use App\Services\PushNotificationService;
use phpDocumentor\Reflection\Types\Integer;
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
 * @Route("/rest/items")
 */
class ItemController extends AbstractController
{

    /**
     * @Route("/listAll", name="item_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Items",
     *       @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=ItemResponseDTO::class))
     *      ))
     *     )
     * @SWG\Tag(name="Items")
     */
    public function listAll(): Response
    {
        $items = $this->getDoctrine()->getRepository(Item::class)->findAll();

//        $item = new Item();


        $itemList = array();
        foreach ($items as $item) {
//            $item = new Item();
            if ($item->getStatus()->getId() == 1) {

                $itemResponseDTO = $this->listConstruct($item);

                array_push($itemList, $itemResponseDTO);

            }

        }
        return $this->json($itemList);
    }

    /**
     * @Route("/listByCategory", name="item_listByCategory", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Items In Category",
     *      @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=ItemResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Parameter(
     *      name="categoryId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Items")
     * @param Request $request
     * @return Response
     */
    public function listByCategory(Request $request): Response
    {
        $categoryId = intval($request->query->get('categoryId'));

        $items = $this->getDoctrine()->getRepository(Item::class)->createNamedQuery('itemByCategory')
            ->setParameter('categoryId', $categoryId)->getResult();

//        $item = new Item();

        $itemList = array();
        foreach ($items as $item) {
//            $item = new Item();
            if ($item->getStatus()->getId() == 1) {

                $itemResponseDTO = $this->listConstruct($item);

                array_push($itemList, $itemResponseDTO);

            }

        }
        return $this->json($itemList);
    }

    /**
     * @Route("/insert", name="item_new", methods={"POST"})
     * @IsGranted({"ROLE_OWNER","ROLE_ADMIN"})
     * @SWG\Response(
     *     response=200,
     *     description="Creates Item",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="branch",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=ItemRequestDTO::class))
     *  )
     *
     *
     * @SWG\Tag(name="ItemsMerchant")
     *
     * @ParamConverter("itemRequestDTO", converter="fos_rest.request_body")
     * @param ItemRequestDTO $itemRequestDTO
     * @return ResponseDTO
     */
    public function CreateItem(ItemRequestDTO $itemRequestDTO): ResponseDTO
    {

        try {

            $fileData = $itemRequestDTO->getPictureData();
            $fileName = null;
            if ($fileData != null) {

                $image_parts = explode("data/", $fileData);
                $image_base64 = base64_decode($image_parts[0]);

                $path = "http://asbeza.appdevt.com/public/uploads/items/";
                $uniqueName = $this->generateUniqueFileName() . '.png';
                $filePath = $this->getParameter('item_pic_dir').'/'.$uniqueName;
                $fileName = $path.$uniqueName;

                if (!file_exists($this->getParameter('item_pic_dir'))) {
                    mkdir($this->getParameter('item_pic_dir'), 0777, true);
                }
                file_put_contents($filePath, $image_base64);


            }

            $calendar = new CalendarExchangeService();
            $etDate = $calendar->etNow();
            $regDate = new \DateTime();


            $category = $this->getDoctrine()->getRepository(Category::class)->find($itemRequestDTO->getCategory());
            $itemstatus = $this->getDoctrine()->getRepository(Itemstatus::class)->find(1);
            $measuringUnit = $this->getDoctrine()->getRepository(Measuringunit::class)->find($itemRequestDTO->getMeasuringUnit());
            $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
            $item = new Item();

            $item->setName($itemRequestDTO->getName());
            $item->setDescription($itemRequestDTO->getDescription());
            $item->setBrand($itemRequestDTO->getBrand());
            $item->setRegdate($regDate);
            $item->setRegetdate($etDate);
            $item->setCategory($category);
            $item->setItemstatus($itemstatus);
            $item->setRegisteredby($this->getUser());
            $item->setStatus($status);
            $item->setMeasuringunit($measuringUnit);
            $item->setPicturepath($fileName);


            $pricing = new Pricing();
            $pricing->setItem($item);
            $pricing->setItemName("1 ".$measuringUnit->getName());
            $pricing->setUnitPrice($itemRequestDTO->getUnitPrice());
            $pricing->setRegisteredby($this->getUser());
            $pricing->setRegdate($regDate);
            $pricing->setRegetdate($etDate);
            $pricing->setStatus($status);
            $pricing->setIsDefault(1);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pricing);
            $entityManager->persist($item);
            $entityManager->flush();

            $itemResponseDTO = $this->merchantlistConstruct($item);
            $customerItemResponseDTO = $this->listConstruct($item);
            $notify = new PushNotificationService();
            $users = $this->getDoctrine()->getRepository(User::class)
                ->createNamedQuery('usersByCompany')
                ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


            foreach ($users as $user) {
//                    $user = new User();

                if($user->getNotificationtoken()!=null){
                    if($user->getRole()->getId()==4){
                        $notify->pushSilentNotifications($this->json($customerItemResponseDTO), 2, 1, $user->getNotificationtoken());
                    }else{
                        $notify->pushSilentNotifications($this->json($itemResponseDTO), 2, 1, $user->getNotificationtoken());
                    }

                }

            }


            return new ResponseDTO(true, 'Item Registered SuccessFully ');

        } catch (\Exception $e) {
            return new ResponseDTO(false, 'Item NOT Registered  ' . $e->getMessage());
        }

    }

    /**
     * @Route("/update", name="item_update", methods={"POST"})
     * @IsGranted({"ROLE_OWNER","ROLE_ADMIN"})
     * @SWG\Response(
     *     response=200,
     *     description="Updates Item",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="branch",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=ItemUpdateRequestDTO::class))
     *  )
     *
     *
     * @SWG\Tag(name="ItemsMerchant")
     *
     * @ParamConverter("itemRequestDTO", converter="fos_rest.request_body")
     * @param ItemUpdateRequestDTO $itemRequestDTO
     * @return ResponseDTO
     */
    public function UpdateItem(ItemUpdateRequestDTO $itemRequestDTO): ResponseDTO
    {

        try {

            $fileData = $itemRequestDTO->getPictureData();
            $fileName = null;
            if ($fileData != null && $fileData != "") {

                $image_parts = explode("data/", $fileData);
                $image_base64 = base64_decode($image_parts[0]);

                $path = "http://asbeza.appdevt.com/public/uploads/items/";
                $uniqueName = $this->generateUniqueFileName() . '.png';
                $filePath = $this->getParameter('item_pic_dir').'/'.$uniqueName;
                $fileName = $path.$uniqueName;

                if (!file_exists($this->getParameter('item_pic_dir'))) {
                    mkdir($this->getParameter('item_pic_dir'), 0777, true);
                }
                file_put_contents($filePath, $image_base64);


            }

            $calendar = new CalendarExchangeService();
            $etDate = $calendar->etNow();
            $regDate = new \DateTime();


            $category = $this->getDoctrine()->getRepository(Category::class)->find($itemRequestDTO->getCategory());
            $itemstatus = $this->getDoctrine()->getRepository(Itemstatus::class)->find(1);
            $measuringUnit = $this->getDoctrine()->getRepository(Measuringunit::class)->find($itemRequestDTO->getMeasuringUnit());
            $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
            $item = $this->getDoctrine()->getRepository(Item::class)->find($itemRequestDTO->getId());

//            $item= new Item();
            $item->setName($itemRequestDTO->getName());
            $item->setDescription($itemRequestDTO->getDescription());
            $item->setBrand($itemRequestDTO->getBrand());
            $item->setUpdatedate($etDate);
            $item->setCategory($category);
            $item->setStatus($status);
            $item->setMeasuringunit($measuringUnit);
            if($fileName!=null){
                $item->setPicturepath($fileName);
            }




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($item);
            $entityManager->flush();

            $itemResponseDTO = $this->merchantlistConstruct($item);
            $customerItemResponseDTO = $this->listConstruct($item);
            $notify = new PushNotificationService();
            $users = $this->getDoctrine()->getRepository(User::class)
                ->createNamedQuery('usersByCompany')
                ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


            foreach ($users as $user) {
//                    $user = new User();

                if($user->getNotificationtoken()!=null){
                    if($user->getRole()->getId()==4){
                        $notify->pushSilentNotifications($this->json($customerItemResponseDTO), 2, 2, $user->getNotificationtoken());
                    }else{
                        $notify->pushSilentNotifications($this->json($itemResponseDTO), 2, 2, $user->getNotificationtoken());
                    }

                }

            }


            return new ResponseDTO(true, 'Item Registered SuccessFully ');

        } catch (\Exception $e) {
            return new ResponseDTO(false, 'Item NOT Registered  ' . $e->getMessage());
        }

    }


    /**
     * @Route("/delete", name="item_delete", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Deletes Items by ID",
     *     @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=ResponseDTO::class))
     *      ))
     *
     * )
     * @SWG\Parameter(
     *      name="itemId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     * @SWG\Tag(name="ItemsMerchant")
     * @param Request $request
     * @return ResponseDTO
     */
    public function delete(Request $request): ResponseDTO
    {

        $itemId = intval($request->query->get('itemId'));
        $item = $this->getDoctrine()->getRepository(Item::class)->find($itemId);

//        $item = new Item();
//                $category = new  Category();
        if ($item->getStatus()->getId() != 3) {
            $status = $this->getDoctrine()->getRepository(Status::class)->find(3);
            $item->setStatus($status);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($item);
            $entityManager->flush();


            $notify = new PushNotificationService();
            $users = $this->getDoctrine()->getRepository(User::class)
                ->createNamedQuery('usersByCompany')
                ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


            foreach ($users as $user) {
//                    $user = new User();
                if($user->getNotificationtoken()!=null){
                    $notify->pushSilentNotifications($this->json($item->getId()), 2, 3, $user->getNotificationtoken());
                }

            }

            return new ResponseDTO(true, 'Item Deleted SuccessFully ');
        } else {
            return new ResponseDTO(false, 'Item Already Deleted ');
        }


    }



    private function listConstruct(Item $item)
    {

        $itemResponseDTO = new ItemResponseDTO();
        $itemResponseDTO->setItemId($item->getId());
        $itemResponseDTO->setItemName($item->getName());
        $itemResponseDTO->setItemDescription($item->getDescription());
        $itemResponseDTO->setMeasuringUnitId($item->getMeasuringunit()->getId());
        $itemResponseDTO->setMeasuringUnitName($item->getMeasuringunit()->getName());

//        $itemResponseDTO->setItemstatusId($item->getItemstatus()->getId());
//        $itemResponseDTO->setItemstatusName($item->getItemstatus()->getName());
        if($item->getPicturepath()!=null){
            $itemResponseDTO->setPicturePath($item->getPicturepath());
        }else{
            $itemResponseDTO->setPicturePath("");
        }

        $pricings = $this->getDoctrine()->getRepository(Pricing::class)->createNamedQuery('pricingByItem')
            ->setParameter('itemId', $item->getId())->getResult();

//            $pricing = new Pricing();
        $pricingList = array();
        $unitPrice = "0.00";


        foreach ($pricings as $pricing) {
//                $pricing= new Pricing();
            $pricingDTO = new PricingResponseDTO();
            $pricingDTO->setId($pricing->getId());
            $pricingDTO->setItemTypeName($pricing->getItemName());
            $pricingDTO->setUnitPrice($pricing->getUnitPrice());
            $pricingDTO->setStatusId($pricing->getStatus()->getId());
            $pricingDTO->setStatusName($pricing->getStatus()->getName());

            if($pricing->getIsDefault()==1){
                $unitPrice = $pricing->getUnitPrice();
            }

            array_push($pricingList, $pricingDTO);
        }
        $itemResponseDTO->setUnitPrice($unitPrice);
        $itemResponseDTO->setPricing($pricingList);

        return $itemResponseDTO;

    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Item for Merchant

    /**
     * @Route("/listAllItems", name="item_merchant_listAll", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Items",
     *       @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=MerchantItemResponseDTO::class))
     *      ))
     *     )
     * @SWG\Tag(name="ItemsMerchant")
     */
    public function itemMerchantListAll(): Response
    {
        $items = $this->getDoctrine()->getRepository(Item::class)->findAll();

//        $item = new Item();


        $itemList = array();
        foreach ($items as $item) {
//            $item = new Item();
            if ($item->getStatus()->getId() == 1) {

                $itemResponseDTO = $this->merchantlistConstruct($item);

                array_push($itemList, $itemResponseDTO);

            }

        }
        return $this->json($itemList);
    }

    /**
     * @Route("/listItemsByCategory", name="item_merchant_listByCategory", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Items In Category",
     *      @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=MerchantItemResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Parameter(
     *      name="categoryId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="ItemsMerchant")
     * @param Request $request
     * @return Response
     */
    public function itemMerchanLlistByCategory(Request $request): Response
    {
        $categoryId = intval($request->query->get('categoryId'));

        $items = $this->getDoctrine()->getRepository(Item::class)->createNamedQuery('itemByCategory')
            ->setParameter('categoryId', $categoryId)->getResult();

//        $item = new Item();

        $itemList = array();
        foreach ($items as $item) {
//            $item = new Item();
            if ($item->getStatus()->getId() == 1) {

                $itemResponseDTO = $this->merchantlistConstruct($item);

                array_push($itemList, $itemResponseDTO);

            }

        }
        return $this->json($itemList);
    }

    private function merchantlistConstruct(Item $item)
    {

        $itemResponseDTO = new MerchantItemResponseDTO();
        $itemResponseDTO->setItemId($item->getId());
        $itemResponseDTO->setItemName($item->getName());
        $itemResponseDTO->setItemDescription($item->getDescription());
        $itemResponseDTO->setItemBrand($item->getBrand());
        $itemResponseDTO->setCatId($item->getCategory()->getId());
        $itemResponseDTO->setCatName($item->getCategory()->getName());
        $itemResponseDTO->setItemStatusId($item->getStatus()->getId());
        $itemResponseDTO->setItemStatusName($item->getStatus()->getName());
        $itemResponseDTO->setRegisteredById($item->getRegisteredby()->getId());
        $itemResponseDTO->setRegisteredByName($item->getRegisteredby()->getFirstname()." ".$item->getRegisteredby()->getLastname());
        $itemResponseDTO->setMeasuringUnitId($item->getMeasuringunit()->getId());
        $itemResponseDTO->setMeasuringUnitName($item->getMeasuringunit()->getName());

//        $itemResponseDTO->setItemstatusId($item->getItemstatus()->getId());
//        $itemResponseDTO->setItemstatusName($item->getItemstatus()->getName());
        if($item->getPicturepath()!=null){
            $itemResponseDTO->setPicturePath($item->getPicturepath());
        }else{
            $itemResponseDTO->setPicturePath("");
        }

        $pricings = $this->getDoctrine()->getRepository(Pricing::class)->createNamedQuery('pricingByItem')
            ->setParameter('itemId', $item->getId())->getResult();

//            $pricing = new Pricing();
        $pricingList = array();
        $unitPrice = "0.00";


        foreach ($pricings as $pricing) {
//                $pricing= new Pricing();
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

            if($pricing->getIsDefault()==1){
                $unitPrice = $pricing->getUnitPrice();
            }

            array_push($pricingList, $pricingDTO);
        }
        $itemResponseDTO->setUnitPrice($unitPrice);
        $itemResponseDTO->setPricing($pricingList);

        return $itemResponseDTO;

    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
