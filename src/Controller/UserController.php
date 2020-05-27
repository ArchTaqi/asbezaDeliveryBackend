<?php

namespace App\Controller;

use App\DTO\AuthenticationRequestDTO;
use App\DTO\CustomerRegistrationDTO;
use App\DTO\RegistrationResponseDTO;
use App\DTO\ResponseDTO;
use App\DTO\UserRegistrationAproveDTO;
use App\DTO\UserRegistrationRequestDTO;
use App\DTO\UsersResponseDTO;
use App\Entity\Branch;
use App\Entity\Branchuser;
use App\Entity\Company;
use App\Entity\Managementusers;
use App\Entity\Status;
use App\Entity\User;
use App\Entity\Userrole;
use App\Form\UserType;
use App\Services\CalendarConverterService;
use App\Services\CalendarExchangeService;
use App\Services\PushNotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/rest/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/listByCompany", name="user_listByCompany", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Users in the company",
     *     @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=UsersResponseDTO::class))
     *      ))
     * @SWG\Parameter(
     *      name="companyId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Users")
     * @param Request $request
     * @return Response
     */
    public function listUserByCompany(Request $request): Response
    {

        $companyId = intval($request->query->get('companyId'));


        $users = $this->getDoctrine()->getRepository(User::class)
            ->createNamedQuery('usersByCompany')
            ->setParameter('companyId', $companyId)->getResult();

        $userList = array();

        foreach ($users as $user) {
//
            if ($user->getRole()->getId() == 2) {
                $registeredBy = $this->getDoctrine()->getRepository(Managementusers::class)->find($user->getRegby());
            } else {
                $registeredBy = $this->getDoctrine()->getRepository(User::class)->find($user->getRegby());
            }
            $userResponseDto = new UsersResponseDTO();

            $userResponseDto->setId($user->getId());
            $userResponseDto->setFullName($user->getFirstname() . " " . $user->getLastname());
            $userResponseDto->setRegdate($user->getRegdate());
            $userResponseDto->setRegEtdate($user->getRegetdate());
            $userResponseDto->setRegisteredbyId($user->getRegby());
            $userResponseDto->setPhonenumber($user->getPhonenumber());
            $userResponseDto->setUsername($user->getUsername());
            $userResponseDto->setRegisteredbyName($registeredBy->getFirstname() . " " . $registeredBy->getLastname());
            $userResponseDto->setRoleId($user->getRole()->getId());
            $userResponseDto->setRoleName($user->getRole()->getName());


            array_push($userList, $userResponseDto);
        }


        return $this->json($userList);
    }

    /**
     * @Route("/findByRegNo", name="user_findByRegNo", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns User Detail by Registration Number",
     *     @SWG\Items(ref=@Model(type=RegistrationResponseDTO::class))
     *      )
     * @SWG\Parameter(
     *      name="registrationNumber",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Users")
     * @param Request $request
     * @return Response
     */
    public function findUserByRegNo(Request $request): Response
    {

        $regNo = intval($request->query->get('registrationNumber'));


        $user = $this->getDoctrine()->getRepository(User::class)
            ->createNamedQuery('findByUsername')
            ->setParameter('regnum', $regNo)->getResult();


//
        $userResponseDto = new RegistrationResponseDTO();
        if ($user != null) {

//            $usr = new User();
            $userResponseDto->setStatus(true);
            $userResponseDto->setFullName($user[0]->getFirstname() . " " . $user[0]->getLastname());
            $userResponseDto->setCompanyId($user[0]->getBranch()->getCompany()->getId());
            $userResponseDto->setCompanyName($user[0]->getBranch()->getCompany()->getName());
            $userResponseDto->setRoleId($user[0]->getRole()->getId());
            $userResponseDto->setUserId($user[0]->getId());
            $userResponseDto->setBranch($user[0]->getBranch()->getId());


        } else {
            $userResponseDto->setStatus(false);
            $userResponseDto->setFullName("");
            $userResponseDto->setCompanyId(0);
            $userResponseDto->setCompanyName("");
            $userResponseDto->setRoleId(0);
            $userResponseDto->setUserId(0);
        }

        return $this->json($userResponseDto);
    }

    /**
     * @Route("/checkAlreadyRegistred", name="user_regCheck", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Login",
     *     @SWG\Schema(ref=@Model(type=RegistrationResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=AuthenticationRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Users")
     * @ParamConverter("authenticationRequestDTO", converter="fos_rest.request_body")
     *
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function checkRegistration()
    {
        return $this->json([

        ]);
    }

    /**
     * @Route("/registerAccept", name="user_registerAccept", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns User Registration Approval",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=UserRegistrationAproveDTO::class))
     * )
     *
     * @SWG\Tag(name="Users")
     * @ParamConverter("userRegistrationAproveDTO", converter="fos_rest.request_body")
     * @param UserRegistrationAproveDTO $userRegistrationAproveDTO
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return ResponseDTO
     */
    public function acceptUserRegistration(UserRegistrationAproveDTO $userRegistrationAproveDTO, UserPasswordEncoderInterface $passwordEncoder): ResponseDTO
    {


        try {

            $users = $this->getDoctrine()->getRepository(User::class)
                ->createNamedQuery('findByUsername')
                ->setParameter('regnum', $userRegistrationAproveDTO->getRegistrationNumber())->getResult();


            if ($users != null) {

                $user = $users[0];
//                $user = new User();

                if ($user->getStatus()->getId() == 2) {
                    $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
                    $encodedPassword = $passwordEncoder->encodePassword($user, $userRegistrationAproveDTO->getPassword());
                    $user->setUsername($userRegistrationAproveDTO->getUsername());
                    $user->setPassword($encodedPassword);
                    $user->setStatus($status);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->merge($user);
                    $entityManager->flush();
                    return new ResponseDTO(true, 'User Approved SuccessFully ');
                } else {
                    return new ResponseDTO(false, 'User Already Approved ');
                }
            } else {
                return new ResponseDTO(false, 'User NOT Found');
            }


        } catch (\Exception $e) {
            return new ResponseDTO(false, 'User NOT Approved ' . $e->getMessage());
        }
    }

    /**
     * @Route("/register", name="user_new", methods={"POST"})
     * @IsGranted("ROLE_OWNER")
     * @SWG\Response(
     *     response=200,
     *     description="Creates Category",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=UserRegistrationRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Users")
     *
     * @ParamConverter("userRegistrationRequestDTO", converter="fos_rest.request_body")
     * @param UserRegistrationRequestDTO $userRegistrationRequestDTO
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return ResponseDTO
     */
    public function createUser(UserRegistrationRequestDTO $userRegistrationRequestDTO, UserPasswordEncoderInterface $passwordEncoder): ResponseDTO
    {
        try {
            $user = new User();

            if ($userRegistrationRequestDTO->getRole() == 3 && $userRegistrationRequestDTO->getBranch() == null) {

                return new ResponseDTO(false, 'Branch should be assigned for Sales Persons');
            } else {


                $calendar = new CalendarExchangeService();
                $etDate = $calendar->etNow();
                $regDate = new \DateTime();

                $randomGenCode = (rand(123456, 987654));
                $regNo = $randomGenCode;
                $reguser = $this->getDoctrine()->getRepository(User::class)
                    ->createNamedQuery('findByUsername')
                    ->setParameter('regnum', $regNo)->getResult();

                while ($reguser != null) {
                    $randomGenCode = (rand(123456, 987654));
                    $regNo = $randomGenCode;
                }

                $encodedPassword = $passwordEncoder->encodePassword($user, "mystpwd");

                $company = $this->getUser()->getCompany();
                $status = $this->getDoctrine()->getRepository(Status::class)->find(2);
                $role = $this->getDoctrine()->getRepository(Userrole::class)->find($userRegistrationRequestDTO->getRole());
                $user->setFirstname($userRegistrationRequestDTO->getFirstname());
                $user->setLastname($userRegistrationRequestDTO->getLastname());
                $user->setPhonenumber($userRegistrationRequestDTO->getPhonenumber());
                $user->setCompany($company);
                $user->setRegdate($regDate);
                $user->setRegetdate($etDate);
                $user->setUsername($regNo);
                $user->setPassword($encodedPassword);
                $user->setStatus($status);
                $user->setRole($role);
                $user->setRegby($this->getUser()->getId());
                $user->setRegnum($regNo);

                if ($userRegistrationRequestDTO->getRole() == 3) {
                    $branchController = new Branchuser();
                    $branch = $this->getDoctrine()->getRepository(Branch::class)->find($userRegistrationRequestDTO->getBranch());
                    $branchController->setBranch($branch);
                    $branchController->setUser($user);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->persist($branchController);
                    $entityManager->flush();
                } else {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();
                }


                return new ResponseDTO(true, 'User Registered SuccessFully ');
            }
        } catch (\Exception $e) {

            return new ResponseDTO(false, 'User NOT Registered ' . $e->getMessage());

        }


    }

    /**
     * @Route("/updateNotoken", name="user_updateNotoken", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Creates Category",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *      name="token",
     *      in="query",
     *      type="string",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Users")
     * @param Request $request
     *
     * @return ResponseDTO
     */
    public function updateNotoken(Request $request): ResponseDTO
    {
        try {
            $token = $request->query->get('token');
            if($token!=null){


            $user = $this->getUser();
            $user->setNotificationtoken($token);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($user);
            $entityManager->flush();


            return new ResponseDTO(true, 'Notification Token Updated Successfully ');
            }else{
                return new ResponseDTO(false, 'Notification Token NOT updated ');
            }
        } catch (\Exception $e) {

            return new ResponseDTO(false, 'User NOT Registered ' . $e->getMessage());

        }


    }

    /**
     * @Route("/registerCustomer", name="user_new_customer", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Creates Category",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=CustomerRegistrationDTO::class))
     * )
     *
     * @SWG\Tag(name="Users")
     *
     * @ParamConverter("userRegistrationRequestDTO", converter="fos_rest.request_body")
     * @param CustomerRegistrationDTO $userRegistrationRequestDTO
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return ResponseDTO
     */
    public function createCustomer(CustomerRegistrationDTO $userRegistrationRequestDTO, UserPasswordEncoderInterface $passwordEncoder): ResponseDTO
    {
        try {
            $user = new User();


            $branch = $this->getDoctrine()->getRepository(Branch::class)->find($userRegistrationRequestDTO->getBranch());

            $calendar = new CalendarExchangeService();
            $etDate = $calendar->etNow();
            $regDate = new \DateTime();

            $randomGenCode = (rand(123456, 987654));
            $regNo = $randomGenCode;
            $reguser = $this->getDoctrine()->getRepository(User::class)
                ->createNamedQuery('findByUsername')
                ->setParameter('regnum', $regNo)->getResult();

            while ($reguser != null) {
                $randomGenCode = (rand(123456, 987654));
                $regNo = $randomGenCode;
            }

            $encodedPassword = $passwordEncoder->encodePassword($user, $userRegistrationRequestDTO->getPassword());


            $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
            $role = $this->getDoctrine()->getRepository(Userrole::class)->find(4);
            $user->setFirstname($userRegistrationRequestDTO->getFirstname());
            $user->setLastname($userRegistrationRequestDTO->getLastname());
            $user->setPhonenumber($userRegistrationRequestDTO->getPhonenumber());
            $user->setBranch($branch);
            $user->setRegdate($regDate);
            $user->setRegetdate($etDate);
            $user->setUsername($userRegistrationRequestDTO->getUsername());
            $user->setPassword($encodedPassword);
            $user->setStatus($status);
            $user->setRole($role);
            $user->setRegby(1);
            $user->setRegnum($regNo);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            return new ResponseDTO(true, 'User Registered SuccessFully ');

        } catch (\Exception $e) {

            return new ResponseDTO(false, 'User NOT Registered ' . $e->getMessage());

        }


    }

    /**
     * @Route("/testNotification", name="user_testNotification", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Tests Notification Token",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *      name="token",
     *      in="query",
     *      type="string",
     *      required=true
     * )
     * @SWG\Parameter(
     *      name="body",
     *      in="query",
     *      type="string",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Users")
     * @param Request $request
     *
     * @return ResponseDTO
     */
    public function testNotification(Request $request): ResponseDTO
    {
        try {
            $token = $request->query->get('token');
            $body = $request->query->get('body');

            if($token!=null && $body!=null){
                $notify = new PushNotificationService();
                $notify->testNotifications($body,$token,0,0);
                return new ResponseDTO(true, 'Notification sent Successfully ');
            }else{
                return new ResponseDTO(false, 'Notification NOT sent ');
            }


        } catch (\Exception $e) {

            return new ResponseDTO(false, 'User NOT Registered ' . $e->getMessage());

        }


    }

}
