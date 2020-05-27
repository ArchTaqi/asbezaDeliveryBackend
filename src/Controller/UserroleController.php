<?php

namespace App\Controller;

use App\DTO\DefaultResponseDTO;
use App\Entity\Userrole;
use App\Form\UserroleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/rest/userRole")
 */
class UserroleController extends AbstractController
{
    /**
     * @Route("/listAll", name="userrole_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of User Roles",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="User_Roles")
     */
    public function index(): Response
    {
        $userroles = $this->getDoctrine()->getRepository(Userrole::class)->findAll();
        $roleList=array();

        foreach ($userroles as $userrole){

            $defaultResponseDto = new DefaultResponseDTO();

            $defaultResponseDto->setId($userrole->getId());
            $defaultResponseDto->setName($userrole->getName());
            $defaultResponseDto->setDescription($userrole->getDescription());

            array_push($roleList,$defaultResponseDto);

        }

        return  $this->json($roleList);

    }
}
