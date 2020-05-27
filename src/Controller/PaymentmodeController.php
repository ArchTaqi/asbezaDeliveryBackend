<?php

namespace App\Controller;

use App\DTO\DefaultResponseDTO;
use App\Entity\Paymentmode;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 *
 * @Route("/rest/paymentmode")
 */
class PaymentmodeController extends AbstractController
{
    /**
     * @Route("/listAll", name="pmode_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Statuses",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="PaymentModes")
     */
    public function index(): Response
    {

        $paymentmodes = $this->getDoctrine()->getRepository(Paymentmode::class)->findAll();

        $modeLIst=array();


        foreach ($paymentmodes as $mode){

            $defaultResponseDto = new DefaultResponseDTO();

            $defaultResponseDto->setId($mode->getId());
            $defaultResponseDto->setName($mode->getName());
            $defaultResponseDto->setDescription($mode->getDescription());

            array_push($modeLIst,$defaultResponseDto);

        }

        return  $this->json($modeLIst);

    }

}
