<?php

namespace App\Controller;

use App\DTO\BranchReportByDateRangeRequestDTO;
use App\DTO\BranchReportByDateRequestDTO;
use App\DTO\ResponseDTO;
use App\DTO\StockExpenseListDTO;
use App\DTO\StockExpenseRequestDTO;
use App\DTO\StockExpenseResponseDTO;
use App\Entity\Status;
use App\Entity\StockExpense;
use App\Entity\User;
use App\Form\StockExpenseType;
use App\Services\CalendarConverterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * @Route("/rest/stockexpense")
 */
class StockExpenseController extends AbstractController
{
    /**
     * @Route("/listTodayExpenses", name="stock_expense_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Stock Expenses",
     *
     *     @SWG\Items(ref=@Model(type=StockExpenseResponseDTO::class))
     *
     *
     *     )
     * @SWG\Tag(name="StockExpenses")
     */
    public function listTodayExpenses(): StockExpenseResponseDTO
    {
        return $this->stockExpense(new \DateTime(), new \DateTime());
    }

    /**
     * @Route("/listExpensesByDate", name="stock_expense_byDate", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Stock Expenses",
     *     @SWG\Items(ref=@Model(type=StockExpenseResponseDTO::class))
     * )
     * @SWG\Parameter(
     *      name="expenseDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=BranchReportByDateRequestDTO::class))
     * )
     * @SWG\Tag(name="StockExpenses")
     * @ParamConverter("dailyReportRequestDTO", converter="fos_rest.request_body")
     * @param BranchReportByDateRequestDTO $dailyReportRequestDTO
     * @return StockExpenseResponseDTO
     */
    public function listExpensesByDate(BranchReportByDateRequestDTO $dailyReportRequestDTO): StockExpenseResponseDTO
    {
        return $this->stockExpense($dailyReportRequestDTO->getReportDate(), $dailyReportRequestDTO->getReportDate());
    }

    /**
     * @Route("/listExpensesByDateRange", name="stock_expense_byDateRange", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Stock Expenses",
     *     @SWG\Items(ref=@Model(type=StockExpenseResponseDTO::class))
     * )
     * @SWG\Parameter(
     *      name="expenseDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=BranchReportByDateRangeRequestDTO::class))
     * )
     * @SWG\Tag(name="StockExpenses")
     * @ParamConverter("dateRangeReportRequestDTO", converter="fos_rest.request_body")
     * @param BranchReportByDateRangeRequestDTO $dateRangeReportRequestDTO
     * @return StockExpenseResponseDTO
     */
    public function listExpensesByDateRange(BranchReportByDateRangeRequestDTO $dateRangeReportRequestDTO): StockExpenseResponseDTO
    {
        return $this->stockExpense($dateRangeReportRequestDTO->getReportStartDate(), $dateRangeReportRequestDTO->getReportEndDate());
    }

    private function stockExpense(\DateTime $startDate, \DateTime $endDate): StockExpenseResponseDTO
    {

        $stDate = $startDate->format('Y-m-d');
        $edDate = $endDate->format('Y-m-d');
        $stockExpenses = $this->getDoctrine()->getRepository(StockExpense::class)
            ->createNamedQuery('dailyExpenses')
            ->setParameter('startDate', $stDate)
            ->setParameter('endDate', $edDate)
            ->getResult();
        $expenseList = array();

        $stockExpenseResponseDTO = new StockExpenseResponseDTO();
        $expenseAmount = 0;

        foreach ($stockExpenses as $stockExpense){
//

            $stockExpenseListDto = new StockExpenseListDTO();

            $stockExpenseListDto->setId($stockExpense->getId());
            $stockExpenseListDto->setReason($stockExpense->getReason());
            $stockExpenseListDto->setRegdate($stockExpense->getRegdate());
            $stockExpenseListDto->setRegEtdate($stockExpense->getRegetdate());
            $stockExpenseListDto->setExpenceAmount($stockExpense->getExpence());
            $stockExpenseListDto->setRegisterUserId($stockExpense->getRegisteredby()->getId());
            $stockExpenseListDto->setRegisterUserName($stockExpense->getRegisteredby()->getFirstname()." ". $stockExpense->getRegisteredby()->getLastname());
            $stockExpenseListDto->setRegtime($stockExpense->getRegtime());

            array_push($expenseList,$stockExpenseListDto);
            $expenseAmount += $stockExpense->getExpence();
        }
        $stockExpenseResponseDTO->setStockExpenseList($expenseList);
        $stockExpenseResponseDTO->setTotalAmount($expenseAmount);

        return $stockExpenseResponseDTO;
    }



    /**
     * @Route("/new", name="stock_expense_new", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Creates Category",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="branch",
     *     in="body",
     *     @SWG\Schema(ref=@Model(type=StockExpenseRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="StockExpenses")
     *
     * @ParamConverter("stockExpenseRequestDTO", converter="fos_rest.request_body")
     * @param StockExpenseRequestDTO $stockExpenseRequestDTO
     * @return ResponseDTO
     */
    public function new(StockExpenseRequestDTO $stockExpenseRequestDTO): ResponseDTO
    {
        try {
            $stockExpense = new StockExpense();


            $CalendarConverter = new CalendarConverterService();
            $etDate = $CalendarConverter-> dateConverter();
            $regDate = new \DateTime();
            $regDate=$regDate->modify('-3 hours');

            $user = $this->getDoctrine()->getRepository(User::class)->find($stockExpenseRequestDTO->getRegisteredby());
            $status = $this->getDoctrine()->getRepository(Status::class)->find(1);
            $stockExpense->setReason($stockExpenseRequestDTO->getReason());
            $stockExpense->setExpence($stockExpenseRequestDTO->getExpenceAmount());
            $stockExpense->setRegisteredby($user);
            $stockExpense->setRegtime($regDate);
            $stockExpense->setRegdate($regDate);
            $stockExpense->setRegetdate($etDate[3]);
            $stockExpense->setStatus($status);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stockExpense);
            $entityManager->flush();

            return new ResponseDTO(true, 'Expense Registered SuccessFully ');

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return new ResponseDTO(false, 'Expense NOT Registered '.$e->getMessage());

        }
    }


}
