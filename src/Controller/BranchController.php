<?php

namespace App\Controller;

use App\Entity\Branchuser;
use App\Entity\Managementusers;
use App\Entity\Stockfollowuptype;
use App\rest\BranchDao;
use App\DTO\BranchResponseDTO;
use App\Entity\Branch;
use App\Form\BranchType;
use App\Entity\Company;
use App\Entity\Status;
use App\DTO\BranchRequestDTO;
use App\DTO\ResponseDTO;
use App\Services\CalendarExchangeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



use App\Services\CalendarConverterService;

/**
 * @Route("/rest/branch")
 */
class BranchController extends AbstractController
{
    /**
     * @Route("/listAll", name="branch_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Branches",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=BranchResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="Branches")
     */
    public function listAll(): Response
    {
        $branches = $this->getDoctrine()->getRepository(Branch::class)->findAll();
        $branchList = array();
//        $branch = new Branch();


    foreach ($branches as $branch){
//

        $branchResopnseDto = new BranchResponseDTO();

        $branchResopnseDto->setId($branch->getId());
        $branchResopnseDto->setName($branch->getName());
        $branchResopnseDto->setDescription($branch->getDescription());
        $branchResopnseDto->setRegdate($branch->getRegdate());
        $branchResopnseDto->setRegEtdate( $branch->getRegetdate());
        $branchResopnseDto->setCompanyId($branch->getCompany()->getId());
        $branchResopnseDto->setCompanyName($branch->getCompany()->getName());
        $branchResopnseDto->setStatusId($branch->getStatus()->getId());
        $branchResopnseDto->setStatusName($branch->getStatus()->getName());

        array_push($branchList,$branchResopnseDto);
    }
//        $branches->
//        $branchResopnseDto = new BranchResponseDTO();
//        $branchResopnseDto->setName($branches->)




        return $this->json($branchList);
    }



    /**
     * @Route("/listByCompany", name="branch_list_byCompany", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Branches",
     *     @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=BranchResponseDTO::class))
     *      ))
     * @SWG\Parameter(
     *      name="companyId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Branches")
     */
    public function listByCompany(Request $request): Response
    {

        $companyId =intval( $request->query->get('companyId'));


        $branches = $this->getDoctrine()->getRepository(Branch::class)
            ->createNamedQuery('branchByCompany')
            ->setParameter('companyId', $companyId)->getResult();

//            $branches;


        $branchList = array();
//        $branch = new Branch();

        foreach ($branches as $branch){
//

            $branchResopnseDto = new BranchResponseDTO();

            $branchResopnseDto->setId($branch->getId());
            $branchResopnseDto->setName($branch->getName());
            $branchResopnseDto->setDescription($branch->getDescription());
            $branchResopnseDto->setRegdate($branch->getRegdate());
            $branchResopnseDto->setRegEtdate( $branch->getRegetdate());
            $branchResopnseDto->setCompanyId($branch->getCompany()->getId());
            $branchResopnseDto->setCompanyName($branch->getCompany()->getName());
            $branchResopnseDto->setStatusId($branch->getStatus()->getId());
            $branchResopnseDto->setStatusName($branch->getStatus()->getName());

            array_push($branchList,$branchResopnseDto);
        }




        return $this->json($branchList);
    }

    /**
     * @Route("/listByUserId", name="branch_list_byUserId", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Branches",
     *     @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=BranchResponseDTO::class))
     *      ))
     * @SWG\Parameter(
     *      name="userId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Branches")
     *
     * @param Request $request
     * @return Response
     */
    public function getUserbyId(Request $request): Response
    {
        $userId =intval( $request->query->get('userId'));

        $branchusers = $this->getDoctrine()->getRepository(Branchuser::class)
            ->createNamedQuery('branchUserById')
            ->setParameter('userId', $userId)->getResult();

        $branchList = array();

        if($branchusers!=null){
            $branchResopnseDto = new BranchResponseDTO();
            $branch = $branchusers[0]->getBranch();


            $branchResopnseDto->setId($branch->getId());
            $branchResopnseDto->setName($branch->getName());
            $branchResopnseDto->setDescription($branch->getDescription());
            $branchResopnseDto->setRegdate($branch->getRegdate());
            $branchResopnseDto->setRegEtdate( $branch->getRegetdate());
            $branchResopnseDto->setCompanyId($branch->getCompany()->getId());
            $branchResopnseDto->setCompanyName($branch->getCompany()->getName());
            $branchResopnseDto->setStatusId($branch->getStatus()->getId());
            $branchResopnseDto->setStatusName($branch->getStatus()->getName());

            array_push($branchList,$branchResopnseDto);
        }

        return  $this->json($branchList);

    }


    /**
     * @Route("/insert", name="branch_new", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Creates Category",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="branch",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=BranchRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Branches")
     *
     * @ParamConverter("branchRequestDTO", converter="fos_rest.request_body")
     * @param BranchRequestDTO $branchRequestDTO
     * @return ResponseDTO
     */
    public function createBranch(BranchRequestDTO $branchRequestDTO): ResponseDTO
    {
       try{
           $branch = new Branch();

           $calendar = new CalendarExchangeService();
           $etDate = $calendar->etNow();
           $regDate =  new \DateTime();

           $company = $this->getDoctrine()->getRepository(Company::class)->find($branchRequestDTO->getCompany());
           $status = $this->getDoctrine()->getRepository(Status::class)->find($branchRequestDTO->getStatus());
           $sales = $this->getDoctrine()->getRepository(Managementusers::class)->find(1);
           $followUpType = $this->getDoctrine()->getRepository(Stockfollowuptype::class)->find(1);

           $branch->setCompany($company);
           $branch->setName($branchRequestDTO->getName());
           $branch->setDescription($branchRequestDTO->getDescription());
           $branch->setRegdate($regDate);
           $branch->setRegetdate($etDate);
           $branch->setStatus($status);
           $branch->setRegisteredby($sales);
           $branch->setFollowuptype($followUpType);

           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($branch);
           $entityManager->flush();

           return new ResponseDTO(true, 'Branch Registered SuccessFully ');

       }catch (\Exception $e){

           return new ResponseDTO(false, 'Branch NOT Registered '.$e->getMessage());

       }


    }

}
