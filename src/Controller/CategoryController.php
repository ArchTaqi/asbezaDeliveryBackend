<?php

namespace App\Controller;

use App\DTO\CategoryResponseDTO;
use App\DTO\CategoryUpdateDTO;
use App\DTO\ResponseDTO;
use App\Entity\Category;
use App\Entity\Branch;
use App\Entity\Status;
use App\Entity\User;
use App\Form\CategoryType;
use App\DTO\CategoryRequestDTO;
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
 * @Route("/rest/categories")
 */
class CategoryController extends AbstractController
{

    /**
     * @Route("/listByBranch", name="category_list_byBranch", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Categories",
     *     @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=CategoryResponseDTO::class))
     *      ))
     *
     * )
     * @SWG\Parameter(
     *      name="branchId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     * @SWG\Tag(name="Categories")
     * @param Request $request
     * @return Response
     */
    public function listByBranch(Request $request): Response
    {

        $branchId =intval( $request->query->get('branchId'));
        $categories = $this->getDoctrine()->getRepository(Category::class)
            ->createNamedQuery('categoryByBranch')
            ->setParameter('branchId', $branchId)->getResult();



        $categoryList = array();

        foreach ($categories as $category) {
//            $category = new Category();
            $categoryResponseDTO = new CategoryResponseDTO();

            $categoryResponseDTO->setId($category->getId());
            $categoryResponseDTO->setCatName($category->getName());
            $categoryResponseDTO->setCatDescription($category->getDescription());
            $categoryResponseDTO->setPicturePath($category->getPicturepath());

            array_push($categoryList, $categoryResponseDTO);
        }


        return $this->json($categoryList);
    }

    /**
     * @Route("/insert", name="category_new", methods={"POST"})
     * @IsGranted({"ROLE_OWNER","ROLE_ADMIN"})
     * @SWG\Response(
     *     response=200,
     *     description="Creates Category",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     *  @SWG\Parameter(
     *     name="order",
     *     in="body",
     *
     * @SWG\Schema(ref=@Model(type=CategoryRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Categories")
     *
     * @ParamConverter("categoryDTO", converter="fos_rest.request_body")
     * @param CategoryRequestDTO $categoryDTO
     * @return ResponseDTO
     *
     * @return ResponseDTO
     */
    public function new(CategoryRequestDTO $categoryDTO): ResponseDTO
    {
        try {

            $fileData = $categoryDTO->getPictureData();
            $fileName = null;
            if ($fileData != null) {

               $image_parts = explode("data/", $fileData);

//                $image_type_aux = explode("data/", $image_parts[0]);

//                $image_type = $image_type_aux[1];

                $image_base64 = base64_decode($image_parts[0]);

                $path = "http://asbeza.appdevt.com/public/uploads/categories/";
                $uniqueName = $this->generateUniqueFileName() . '.png';
                $filePath = $this->getParameter('cat_pic_dir').'/'.$uniqueName;
                $fileName = $path.$uniqueName;
                file_put_contents($filePath, $image_base64);


            }
            $category = new Category();


            $calendar = new CalendarExchangeService();
            $etDate = $calendar->etNow();
            $regDate = new \DateTime();
            $randomGenCode = (rand(1234,9876));

            $user = $this->getUser();
            $status = $this->getDoctrine()->getRepository(Status::class)->find(1);

            $category->setName($categoryDTO->getCatName());
            $category->setCatcode($randomGenCode);
            $category->setDescription($categoryDTO->getCatDescription());
            $category->setRegisteredby($this->getUser());
            $category->setBranch($user->getBranch());
            $category->setRegdate($regDate);
            $category->setStatus($status);
            $category->setRegetdate($etDate);
            $category->setPicturepath($fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();


//            $file = $categoryDTO->getCategoryPic();
//
//            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
//
//            $file->move(
//                $this->getParameter('cat_pic_dir'),
//                $fileName
//            );


            $categoryResponseDTO = new CategoryResponseDTO();

            $categoryResponseDTO->setId($category->getId());
            $categoryResponseDTO->setCatName($category->getName());
            $categoryResponseDTO->setCatDescription($category->getDescription());
            $categoryResponseDTO->setPicturePath($category->getPicturepath());


            $notify = new PushNotificationService();
            $users = $this->getDoctrine()->getRepository(User::class)
                ->createNamedQuery('usersByCompany')
                ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


            foreach ($users as $user) {
//                    $user = new User();
                if($user->getNotificationtoken()!=null){
                    $notify->pushSilentNotifications($this->json($categoryResponseDTO), 1,1, $user->getNotificationtoken());
                }

            }
            return new ResponseDTO(true, 'Category Registered SuccessFully ');

        } catch (\Exception $e) {
            error_log($e->getMessage());
//            $error = $e->getMessage();
            return new ResponseDTO(false, 'Category NOT Registered '.$e->getMessage());

        }
    }

    /**
     * @Route("/update", name="category_update", methods={"POST"})
     * @IsGranted({"ROLE_OWNER","ROLE_ADMIN"})
     * @SWG\Response(
     *     response=200,
     *     description="Creates Category",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="body",
     *
     * @SWG\Schema(ref=@Model(type=CategoryUpdateDTO::class))
     * )
     *
     * @SWG\Tag(name="Categories")
     *
     * @ParamConverter("categoryDTO", converter="fos_rest.request_body")
     * @param CategoryUpdateDTO $categoryDTO
     * @return ResponseDTO
     */
    public function update(CategoryUpdateDTO $categoryDTO): ResponseDTO
    {
        try {
            $category = $branch = $this->getDoctrine()->getRepository(Category::class)->find($categoryDTO->getCatId());

            if($category != null){


//            $category = new Category();
            if($category->getStatus()->getId()==1){
                $category->setName($categoryDTO->getCatName());
                $category->setCatcode($categoryDTO->getCatCode());
                $category->setDescription($categoryDTO->getCatDescription());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->merge($category);
                $entityManager->flush();


                $categoryResponseDTO = new CategoryResponseDTO();

                $categoryResponseDTO->setId($category->getId());
                $categoryResponseDTO->setCatName($category->getName());
                $categoryResponseDTO->setCatDescription($category->getDescription());
                if($category->getPicturepath()!=null){
                    $categoryResponseDTO->setPicturePath($category->getPicturepath());
                }else{
                    $categoryResponseDTO->setPicturePath("");
                }


                $notify = new PushNotificationService();
                $users = $this->getDoctrine()->getRepository(User::class)
                    ->createNamedQuery('usersByCompany')
                    ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


                foreach ($users as $user) {
//                    $user = new User();
                    if($user->getNotificationtoken()!=null){
                        $notify->pushSilentNotifications($this->json($categoryResponseDTO), 1,2, $user->getNotificationtoken());
                    }

                }

                return new ResponseDTO(true, 'Category Updated SuccessFully ');
            }
            else{

                return new ResponseDTO(false, 'Can not Update deleted Category ');
            }
            }
            else{

                return new ResponseDTO(false, 'Category NOT Found ');
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return new ResponseDTO(false, 'Category NOT Updated '.$e->getMessage());

        }
    }

    /**
     * @Route("/delete", name="category_delete", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Deletes Category by ID",
     *     @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=ResponseDTO::class))
     *      ))
     *
     * )
     * @SWG\Parameter(
     *      name="categoryId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     * @SWG\Tag(name="Categories")
     * @param Request $request
     * @return ResponseDTO
     */
    public function delete(Request $request): ResponseDTO
    {

        $categoryId =intval( $request->query->get('categoryId'));
        $category = $this->getDoctrine()->getRepository(Category::class)->find($categoryId);

//                $category = new  Category();

        if($category==null){
            return new ResponseDTO(false, 'Category NOT Found ');
        }
         else if( $category->getStatus()->getId()!=3){
             $status = $this->getDoctrine()->getRepository(Status::class)->find(3);
             $category ->setStatus($status);

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($category);
             $entityManager->flush();

             $notify = new PushNotificationService();
             $users = $this->getDoctrine()->getRepository(User::class)
                 ->createNamedQuery('usersByCompany')
                 ->setParameter('companyId', $this->getUser()->getBranch()->getId())->getResult();


             foreach ($users as $user) {
//                    $user = new User();
                 if($user->getNotificationtoken()!=null){
                     $notify->pushSilentNotifications($this->json($categoryId), 1,3, $user->getNotificationtoken());
                 }

             }

             return new ResponseDTO(true, 'Category Deleted SuccessFully ');
         }else{
             return new ResponseDTO(false, 'Category Already Deleted ');
         }




    }


    //    /**
//     * @Route("/listAll", name="category_index", methods={"GET"})
//     * @SWG\Response(
//     *     response=200,
//     *     description="Returns List of Categories",
//     *      @SWG\Schema(type="array",
//     *     @SWG\Items(ref=@Model(type=CategoryResponseDTO::class))
//     *      ))
//     *
//     *
//     * )
//     *
//     * @SWG\Tag(name="Categories")
//     */
//    public function listAll(): Response
//    {
//        $categories = $this->getDoctrine()
//            ->getRepository(Category::class)
//            ->findAll();
//
//        $categoryList = array();
////        $category = new Category();
//        foreach ($categories as $category) {
//            $categoryResponseDTO = new CategoryResponseDTO();
//
//            $categoryResponseDTO->setId($category->getId());
//            $categoryResponseDTO->setCatName($category->getName());
//            $categoryResponseDTO->setCatDescription($category->getDescription());
//            $categoryResponseDTO->setCatCode($category->getCatcode());
//            $categoryResponseDTO->setCompanyId($category->getBranch()->getCompany()->getId());
//            $categoryResponseDTO->setCompanyName($category->getBranch()->getCompany()->getName());
//            $categoryResponseDTO->setBranchId($category->getBranch()->getId());
//            $categoryResponseDTO->setBranchName($category->getBranch()->getName());
//            $categoryResponseDTO->setRegisteredByUserId($category->getRegisteredby()->getId());
//            $categoryResponseDTO->setRegisteredByUserName($category->getRegisteredby()->getFirstname().' '.$category->getRegisteredby()->getLastname());
//
//            array_push($categoryList, $categoryResponseDTO);
//        }
//
//
//        return $this->json($categoryList);
//    }


    /**
     * @Route("/upload", name="category_upload", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Upload Category pic",
     *     @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=ResponseDTO::class))
     *      ))
     *
     * )
     * @SWG\Parameter(
     *      name="categoryPic",
     *      in="formData",
     *      type="file",
     *      required=true
     * )
     * @SWG\Tag(name="Categories")
     * @param Request $request
     * @return ResponseDTO
     */
    public function upload(Request $request): ResponseDTO
    {

        $file = $request->files->get('categoryPic');
        $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

        $file->move(
            $this->getParameter('cat_pic_dir'),
            $fileName
        );


        return new ResponseDTO(true, $fileName);

    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    private function conventBase64ToImage(String $b64){


        $bin = base64_decode($b64);
        $im = imageCreateFromString($bin);
        if (!$im) {
            die('Base64 value is not a valid image');
        }
        $img_file = '/files/images/filename.png';
       return imagepng($im, $img_file, 0);
    }

}
