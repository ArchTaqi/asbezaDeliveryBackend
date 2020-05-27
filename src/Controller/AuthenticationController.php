<?php

namespace App\Controller;

use App\DTO\AuthenticationRequestDTO;
use App\DTO\RegistrationResponseDTO;
use App\Entity\Managementusers;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\DTO\UsersResponseDTO;
use App\DTO\LoginResponseDTO;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/rest")
 */
class AuthenticationController extends AbstractController
{
    /**
     * @Route("/login", name="api_login", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Login",
     *     @SWG\Schema(ref=@Model(type=LoginResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=AuthenticationRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Authentication")
     * @ParamConverter("authenticationRequestDTO", converter="fos_rest.request_body")
     *
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login()
    {
        return $this->json([

        ]);
    }

   
    /**
     * @Route("/checkUser", name="api_profile", methods={"GET"})
     * @IsGranted("ROLE_OWNER")
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Users",
     *
     *     @SWG\Items(ref=@Model(type=UsersResponseDTO::class))
     *      )
     *
     *
     * @SWG\Tag(name="Authentication")
     */
    public function checkUser()
    {
        $user = $this->getUser();

        if($user->getRole()->getId()==2){
            $registeredBy = $this->getDoctrine()->getRepository(Managementusers::class)->find($user->getRegby());
        }
        else{
            $registeredBy = $this->getDoctrine()->getRepository(User::class)->find($user->getRegby());
        }

        $userResponseDto = new UsersResponseDTO();

        $userResponseDto->setId($user->getId());
        $userResponseDto->setFullName($user->getFirstname()." ".$user->getLastname());
        $userResponseDto->setRegdate($user->getRegdate());
        $userResponseDto->setRegEtdate( $user->getRegetdate());
        $userResponseDto->setRegisteredbyId($user->getRegby());
        $userResponseDto->setPhonenumber($user->getPhonenumber());
        $userResponseDto->setUsername($user->getUsername());
        $userResponseDto->setRegisteredbyName($registeredBy->getFirstname()." ".$registeredBy->getLastname());
        $userResponseDto->setRoleId($user->getRole()->getId());
        $userResponseDto->setRoleName($user->getRole()->getName());

        return $this->json($userResponseDto);
    }
}
