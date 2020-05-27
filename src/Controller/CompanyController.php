<?php

namespace App\Controller;

use App\DTO\CompanyRequestDTO;
use App\DTO\CompanyResponseDTO;
use App\DTO\ResponseDTO;
use App\Entity\Branch;
use App\Entity\Company;
use App\Entity\Managementusers;
use App\Entity\Registrationtype;
use App\Entity\Status;
use App\Entity\Stockfollowuptype;
use App\Entity\User;
use App\Entity\Userrole;
use App\Form\CompanyType;
use App\Services\CalendarConverterService;
use App\Services\CalendarExchangeService;
use DateTime;
use function Sodium\compare;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/rest/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/listAll", name="company_listAll", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Companies",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=CompanyResponseDTO::class))
     *      ))
     *     )
     * @SWG\Tag(name="Companies")
     */
    public function listAllCompanies(): Response
    {

        $companies = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findAll();


        $branchList = array();
        foreach ($companies as $company){
            $companyResponseDTO = new CompanyResponseDTO();
            $companyResponseDTO->setId($company->getId());
            $companyResponseDTO->setName($company->getName());
            $companyResponseDTO->setDescription($company->getDescription());
            $companyResponseDTO->setRegdate($company->getRegdate()->format('d/m/Y'));
            $companyResponseDTO->setStatusId($company->getStatus()->getId());
            $companyResponseDTO->setStatusName($company->getStatus()->getName());
//            $companyResponseDTO->setCompanyownerId($company->getCompanyowner()->getId());
//            $companyResponseDTO->setCompanyownerName($company->getCompanyowner()->getFirstname().' '.$company->getCompanyowner()->getLastname());
            $companyResponseDTO->setRegistrationtypeId($company->getRegistrationtype()->getId());
            $companyResponseDTO->setRegistrationtypeName($company->getRegistrationtype()->getName());
            $companyResponseDTO->setSalesId($company->getSales()->getId());
            $companyResponseDTO->setSalesName($company->getSales()->getFirstname().' '.$company->getSales()->getLastname());

            array_push($branchList, $companyResponseDTO);
        }

        return $this->json($branchList);
    }


    /**
     * @Route("/listBySales", name="company_listBySales", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Companies Registered by a sales person",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=CompanyResponseDTO::class))
     *      ))
     *     )
     *
     *@SWG\Parameter(
     *      name="salesId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     * @SWG\Tag(name="Companies")
     */
    public function listCompaniesBySales(Request $request): Response
    {

        $salesId =intval( $request->query->get('salesId'));


//        $branches = $this->getDoctrine()->getRepository(Branch::class)
//            ->createNamedQuery('branchByCompany')
//            ->setParameter('companyId', $companyId)->getResult();

        $companies = $this->getDoctrine()->getRepository(Company::class)
            ->createNamedQuery('companyBySales')
            ->setParameter('salesId', $salesId)->getResult();
//


        $branchList = array();
        foreach ($companies as $company){
            $companyResponseDTO = new CompanyResponseDTO();
            $companyResponseDTO->setId($company->getId());
            $companyResponseDTO->setName($company->getName());
            $companyResponseDTO->setDescription($company->getDescription());
            $companyResponseDTO->setRegdate($company->getRegdate()->format('d/m/Y'));
            $companyResponseDTO->setStatusId($company->getStatus()->getId());
            $companyResponseDTO->setStatusName($company->getStatus()->getName());
//            $companyResponseDTO->setCompanyownerId($company->getCompanyowner()->getId());
            $companyResponseDTO->setRegistrationtypeId($company->getRegistrationtype()->getId());
            $companyResponseDTO->setRegistrationtypeName($company->getRegistrationtype()->getName());
            $companyResponseDTO->setSalesId($company->getSales()->getId());
            $companyResponseDTO->setSalesName($company->getSales()->getFirstname().' '.$company->getSales()->getLastname());

            array_push($branchList, $companyResponseDTO);
        }

        return $this->json($branchList);
    }


    /**
     * @Route("/insert", name="company_new", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Creates Company",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="branch",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=CompanyRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Companies")
     *
     * @ParamConverter("companyRequestDTO", converter="fos_rest.request_body")
     * @param CompanyRequestDTO $companyRequestDTO
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return ResponseDTO
     */
    public function createCompany(CompanyRequestDTO $companyRequestDTO, UserPasswordEncoderInterface $passwordEncoder): ResponseDTO
    {
        try{
             $company = new Company();
             $branch = new Branch();
             $owner = new User();

            $calendar = new CalendarExchangeService();
            $etDate = $calendar->etNow();
            $regDate = new \DateTime();

            $randomGenCode = (rand(123456,987654));
            $regNo = $randomGenCode;
            $user = $this->getDoctrine()->getRepository(User::class)
                ->createNamedQuery('findByUsername')
                ->setParameter('regnum', $regNo)->getResult();

            while($user!=null){
                $randomGenCode = (rand(123456,987654));
                $regNo = $randomGenCode;
            }

            $encodedPassword = $passwordEncoder->encodePassword($owner, "mystpwd");

            $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
            $userStatus = $this->getDoctrine()->getRepository(Status::class)->find(2);
            $role = $this->getDoctrine()->getRepository(Userrole::class)->find(2);
            $sales = $this->getDoctrine()->getRepository(Managementusers::class)->find(1);
            $registrationtype = $this->getDoctrine()->getRepository(Registrationtype::class)->find($companyRequestDTO->getRegistrationtype());
//            $followUpType = $this->getDoctrine()->getRepository(Stockfollowuptype::class)->find(1);


            $company->setName($companyRequestDTO->getCompanyName());
            $company->setDescription($companyRequestDTO->getDescription());
            $company->setRegdate($regDate);
            $company->setRegetdate($etDate);
            $company->setStatus($status);
            $company->setRegistrationtype($registrationtype);
            $company->setSales($sales);


//Register Branch with company
            $branch->setName("branch 1");
            $branch->setDescription("default branch");
            $branch->setCompany($company);
            $branch->setStatus($status);
            $branch->setRegisteredby($sales);
            $branch->setRegdate($regDate);
            $branch->setRegetdate($etDate);


//Register owner with company
            $owner->setFirstname($companyRequestDTO->getOwnerFirstName());
            $owner->setLastname($companyRequestDTO->getOwnerLastName());
            $owner->setPhonenumber($companyRequestDTO->getOwnerPhoneNumber());
            $owner->setRegby(1);
            $owner->setRole($role);
            $owner->setStatus($userStatus);
            $owner->setUsername($regNo);
            $owner->setPassword($encodedPassword);
            $owner->setRegdate($regDate);
            $owner->setRegetdate($etDate);
            $owner->setBranch($branch);
            $owner->setRegnum($regNo);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->persist($branch);
            $entityManager->persist($owner);
            $entityManager->flush();

            return new ResponseDTO(true, 'Company Registered SuccessFully ');
        }catch (\Exception $e){
            return new ResponseDTO(false, 'Company NOT Registered '.$e->getMessage());
        }






    }


}
