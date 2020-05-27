<?php

namespace App\Controller;

use App\DTO\DefaultResponseDTO;
use App\Entity\Paymentstatus;
use App\Form\PaymentstatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/rest/paymentstatus")
 */
class PaymentstatusController extends AbstractController
{
    /**
     * @Route("/listAll", name="paymentstatus_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Item Statuses",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="PaymentStatus")
     *
     */
    public function index(): Response
    {
        $paymentstatuses = $this->getDoctrine()
            ->getRepository(Paymentstatus::class)
            ->findAll();

        $statusLIst=array();
        foreach ($paymentstatuses as $status) {

            $defaultResponseDto = new DefaultResponseDTO();

            $defaultResponseDto->setId($status->getId());
            $defaultResponseDto->setName($status->getName());
            $defaultResponseDto->setDescription($status->getDescription());

            array_push($statusLIst, $defaultResponseDto);
        }
        return $this->json($statusLIst);
    }

}
