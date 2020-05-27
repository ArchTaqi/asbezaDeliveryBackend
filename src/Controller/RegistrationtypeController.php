<?php

namespace App\Controller;

use App\DTO\DefaultResponseDTO;
use App\Entity\Registrationtype;
use App\Form\RegistrationtypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/rest/registrationtype")
 */
class RegistrationtypeController extends AbstractController
{
    /**
     * @Route("/listAll", name="registrationType_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Statuses",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="RegistrationTypes")
     */
    public function index(): Response
    {
        $registrationtypes = $this->getDoctrine()
            ->getRepository(Registrationtype::class)
            ->findAll();

        $typeList=array();


        foreach ($registrationtypes as $type){

            $defaultResponseDto = new DefaultResponseDTO();

            $defaultResponseDto->setId($type->getId());
            $defaultResponseDto->setName($type->getName());
            $defaultResponseDto->setDescription($type->getDescription());

            array_push($typeList,$defaultResponseDto);

        }

        return  $this->json($typeList);
    }


}
