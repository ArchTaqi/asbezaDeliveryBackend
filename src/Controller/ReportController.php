<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/27/2019
 * Time: 12:09 PM
 */

namespace App\Controller;

use App\DTO\BranchReportByDateRequestDTO;
use App\DTO\CompanyReportByDateRangeRequestDTO;
use App\DTO\CompanyReportByDateRequestDTO;
use App\DTO\ExpensesListDTO;
use App\DTO\GeneralReportResponseDTO;
use App\DTO\BranchReportByDateRangeRequestDTO;
use App\DTO\OrderListResponseDTO;
use App\Entity\Branch;
use App\Entity\Category;
use App\Entity\Orders;
use App\Entity\Sellcredit;
use App\Entity\Sellcreditpayment;
use App\Entity\StockExpense;
use App\Services\CalendarExchangeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
//use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Route("/rest/report")
 */
class ReportController extends AbstractController
{

    /**
     * @Route("/companyTodayReport", name="todayReport_company", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns Daily sales Report",
     *
     *     @SWG\Items(ref=@Model(type=GeneralReportResponseDTO::class))
     *     )
     * @SWG\Parameter(
     *      name="companyId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     * @SWG\Tag(name="Reports")
     * @param Request $request
     * @return GeneralReportResponseDTO
     */
    public function companyTodayReport(Request $request): GeneralReportResponseDTO
    {
        $companyId =intval( $request->query->get('companyId'));
        $calendar = new CalendarExchangeService();
        return $this->companyDateRangeReport($calendar->etNow(), $calendar->etNow(),$companyId);

    }

    /**
     * @Route("/companyReportByDate", name="reportByDate_company", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns Daily sales Report",
     *
     *     @SWG\Items(ref=@Model(type=GeneralReportResponseDTO::class))
     *)
     * @SWG\Parameter(
     *      name="reportDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=CompanyReportByDateRequestDTO::class))
     * )
     * @SWG\Tag(name="Reports")
     * @ParamConverter("dailyReportRequestDTO", converter="fos_rest.request_body")
     *
     * @param CompanyReportByDateRequestDTO $dailyReportRequestDTO
     * @return GeneralReportResponseDTO
     */
    public function companyReportByDate(CompanyReportByDateRequestDTO $dailyReportRequestDTO): GeneralReportResponseDTO
    {

        return $this->companyDateRangeReport($dailyReportRequestDTO->getReportDate(), $dailyReportRequestDTO->getReportDate(), $dailyReportRequestDTO->getCompanyId());

    }

    /**
     * @Route("/companyReportByDateRange", name="reportByDateRange_company", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns Daily sales Report",
     *
     *     @SWG\Items(ref=@Model(type=GeneralReportResponseDTO::class))
     *)
     * @SWG\Parameter(
     *      name="reportDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=CompanyReportByDateRangeRequestDTO::class))
     * )
     * @SWG\Tag(name="Reports")
     * @ParamConverter("dateRangeReportRequestDTO", converter="fos_rest.request_body")
     *
     * @param CompanyReportByDateRangeRequestDTO $dateRangeReportRequestDTO
     * @return GeneralReportResponseDTO
     */
    public function companyReportByDateRange(CompanyReportByDateRangeRequestDTO $dateRangeReportRequestDTO): GeneralReportResponseDTO
    {

        return $this->companyDateRangeReport($dateRangeReportRequestDTO->getReportStartDate(), $dateRangeReportRequestDTO->getReportEndDate(), $dateRangeReportRequestDTO->getCompanyId());

    }


    /**
     * @param string $startDate
     * @param string $endDate
     * @param int $companyId
     * @return GeneralReportResponseDTO
     */
    private function companyDateRangeReport(string $startDate, string $endDate, int $companyId): GeneralReportResponseDTO
    {

        $calendar = new CalendarExchangeService();

        $totalSales=0;
        $totalCount= 0;
        $totalProfit= 0;
        $cashSales= 0;
        $creditSales= 0;
        $paidCredits= 0;
        $expense=0;
        $reportStartDate= $calendar->etToGreg($startDate);
        $reportEndDate= $calendar->etToGreg($endDate);
        $orderList = array();
        $expenseList = array();

        
        $stDate = $reportStartDate->format('Y-m-d');
        $edDate = $reportEndDate->format('Y-m-d');

        $allBranches = $this->getDoctrine()->getRepository(Branch::class)
            ->createNamedQuery('branchByCompany')
            ->setParameter('companyId', $companyId)
            ->getResult();

        foreach ($allBranches as $branch){

            $orders = $this->getDoctrine()->getRepository(Orders::class)
                ->createNamedQuery('dateRangeOrdersByBranch')
                ->setParameter('startDate', $stDate)
                ->setParameter('endDate', $edDate)
                ->setParameter('branchId', $branch->getId())
                ->getResult();


            $stockExpenses = $this->getDoctrine()->getRepository(StockExpense::class)
                ->createNamedQuery('dailyExpenses')
                ->setParameter('startDate', $stDate)
                ->setParameter('endDate', $edDate)
                ->getResult();


            foreach ($orders as $order){


//                $order = new Orders();
                $orderListDto = new  OrderListResponseDTO();
                $orderListDto->setId($order->getId());
                $orderListDto->setItemName($order->getPricing()->getItem()->getName());
                $orderListDto->setOrderDate($order->getOrderEtDate());
                $orderListDto->setOrderMode($order->getPaymentMode()->getName());
                $orderListDto->setQuantity($order->getOrderQuantity());
                $orderListDto->setUnitInPrice($order->getPricing()->getInPrice());
                $orderListDto->setUnitSellPrice($order->getItemSellPrice());
                $orderListDto->setTotalPrice($order->getItemSellPrice()*$order->getOrderQuantity());
                $orderListDto->setUnitProfit($order->getItemSellPrice()-$order->getPricing()->getInPrice());
                $orderListDto->setTotalProfit(($order->getItemSellPrice()-$order->getPricing()->getInPrice())*$order->getOrderQuantity());







                $totalSales+=($order->getItemSellPrice()*$order->getOrderQuantity());
                $totalCount+= $order->getOrderQuantity();
                $totalProfit+= ($order->getItemSellPrice()-$order->getPricing()->getInPrice())*$order->getOrderQuantity();
                if($order->getPaymentStatus()->getId()==1){

                    $orderListDto->setPaidAmount($order->getItemSellPrice()*$order->getOrderQuantity());
                    $orderListDto->setRemainingAmount("0.00");


                    $cashSales+=($order->getItemSellPrice()*$order->getOrderQuantity());
                }else{
                    $sellCredit = $this->getDoctrine()->getRepository(Sellcredit::class)
                        ->createNamedQuery('sellCreditByOrder')
                        ->setParameter('orderId', $order->getId())->getResult();

//                    $sellCredit = new Sellcredit();

                    $orderListDto->setPaidAmount($sellCredit[0]->getPaidAmount());
                    $orderListDto->setRemainingAmount($sellCredit[0]->getRemainingAmount());
                    $orderListDto->setCustomerName($sellCredit[0]->getCustomerName());
                    $orderListDto->setCustomerPhone($sellCredit[0]->getCustomerPhone());

                    $cashSales+=($sellCredit[0]->getPaidAmount());
                    $creditSales+=($sellCredit[0]->getRemainingAmount());

                    $sellCreditPayments = $this->getDoctrine()->getRepository(Sellcreditpayment::class)
                        ->createNamedQuery('paidCreditsById')
                        ->setParameter('sellCreditId', $sellCredit[0]->getId())
                        ->getResult();

                    foreach ($sellCreditPayments as $sellCreditPayment){

                        $paidCredits+= $sellCreditPayment->getPaidAmount();
                    }
                }


               $orderListDto->setUserName($order->getRegisteredby()->getFirstname()." ".$order->getRegisteredby()->getLastname());
               $orderListDto->setUserRole($order->getRegisteredby()->getRole()->getName());
               $orderListDto->setRegistrationDate($order->getOrderEtDate());
               $orderListDto->setRegistrationTime($order->getOrderTime()->format('H:i:s A'));
                array_push($orderList, $orderListDto);

            }

            foreach ($stockExpenses as $stockExpense){

//                $stockExpense = new StockExpense();
                $expenseDto = new ExpensesListDTO();
                $expenseDto->setId($stockExpense->getId());
                $expenseDto->setExpenseReason($stockExpense->getReason());
                $expenseDto->setExpenseAmount($stockExpense->getExpence());
                $expenseDto->setUserName($stockExpense->getRegisteredby()->getFirstname()." ".$stockExpense->getRegisteredby()->getLastname());
                $expenseDto->setUserRole($stockExpense->getRegisteredby()->getRole()->getName());
                $expenseDto->setRegistrationDate($stockExpense->getRegetdate());
                $expenseDto->setRegistrationTime($stockExpense->getRegtime()->format('H:i:s A'));

                $expense+=$stockExpense->getExpence();

                array_push($expenseList, $expenseDto);
            }

        }


        $netCash= $cashSales+$paidCredits-$expense;
        $dailyReportResponseDto = new  GeneralReportResponseDTO();

        $dailyReportResponseDto->setTotalSales($totalSales);
        $dailyReportResponseDto->setTotalQuantity($totalCount);
        $dailyReportResponseDto->setTotalProfit($totalProfit);
        $dailyReportResponseDto->setCashSales($cashSales);
        $dailyReportResponseDto->setCreditSales($creditSales);
        $dailyReportResponseDto->setTotalExpence($expense);
        $dailyReportResponseDto->setPaidCredits($paidCredits);
        $dailyReportResponseDto->setNetCash($netCash);
        $dailyReportResponseDto->setReportStartDate($startDate);
        $dailyReportResponseDto->setReportEndDate($endDate);
        $dailyReportResponseDto->setOrderList($orderList);
        $dailyReportResponseDto->setExpenseList($expenseList);

        return $dailyReportResponseDto;
    }

    /**
     * @Route("/branchTodayReport", name="todayReport_branch", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns Daily sales Report",
     *
     *     @SWG\Items(ref=@Model(type=GeneralReportResponseDTO::class))
     *     )
     * @SWG\Parameter(
     *      name="branchId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     * @SWG\Tag(name="Reports")
     * @param Request $request
     * @return GeneralReportResponseDTO
     */
    public function branchTodayReport(Request $request): GeneralReportResponseDTO
    {
        $branchId =intval( $request->query->get('branchId'));

        $calendar = new CalendarExchangeService();

        return $this->branchDateRangeReport($calendar->etNow(), $calendar->etNow(),$branchId);

    }

    /**
     * @Route("/branchReportByDate", name="reportByDate_branch", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns Daily sales Report",
     *
     *     @SWG\Items(ref=@Model(type=GeneralReportResponseDTO::class))
     *)
     * @SWG\Parameter(
     *      name="reportDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=BranchReportByDateRequestDTO::class))
     * )
     * @SWG\Tag(name="Reports")
     * @ParamConverter("dailyReportRequestDTO", converter="fos_rest.request_body")
     * @param BranchReportByDateRequestDTO $dailyReportRequestDTO
     * @return GeneralReportResponseDTO
     */
    public function branchReportByDate(BranchReportByDateRequestDTO $dailyReportRequestDTO): GeneralReportResponseDTO
    {

        return $this->branchDateRangeReport($dailyReportRequestDTO->getReportDate(), $dailyReportRequestDTO->getReportDate(), $dailyReportRequestDTO->getBranchId());

    }

    /**
     * @Route("/branchReportByDateRange", name="reportByDateRange_branch", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns Daily sales Report",
     *
     *     @SWG\Items(ref=@Model(type=GeneralReportResponseDTO::class))
     *)
     * @SWG\Parameter(
     *      name="reportDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=BranchReportByDateRangeRequestDTO::class))
     * )
     * @SWG\Tag(name="Reports")
     * @ParamConverter("dateRangeReportRequestDTO", converter="fos_rest.request_body")
     * @param BranchReportByDateRangeRequestDTO $dateRangeReportRequestDTO
     * @return GeneralReportResponseDTO
     */
    public function branchReportByDateRange(BranchReportByDateRangeRequestDTO $dateRangeReportRequestDTO): GeneralReportResponseDTO
    {

        return $this->branchDateRangeReport($dateRangeReportRequestDTO->getReportStartDate(), $dateRangeReportRequestDTO->getReportEndDate(), $dateRangeReportRequestDTO->getBranchId());

    }

    private function branchDateRangeReport(string $startDate, string $endDate, int $branchId): GeneralReportResponseDTO
    {

        $calendar = new CalendarExchangeService();

        $totalSales=0;
        $totalCount= 0;
        $totalProfit= 0;
        $cashSales= 0;
        $creditSales= 0;
        $paidCredits= 0;
        $expense=0;
        $reportStartDate= $calendar->etToGreg($startDate);
        $reportEndDate= $calendar->etToGreg($endDate);

        $stDate = $reportStartDate->format('Y-m-d');
        $edDate = $reportEndDate->format('Y-m-d');

        $orders = $this->getDoctrine()->getRepository(Orders::class)
            ->createNamedQuery('dateRangeOrdersByBranch')
            ->setParameter('startDate', $stDate)
            ->setParameter('endDate', $edDate)
            ->setParameter('branchId', $branchId)
            ->getResult();


        $stockExpenses = $this->getDoctrine()->getRepository(StockExpense::class)
            ->createNamedQuery('dailyExpenses')
            ->setParameter('startDate', $stDate)
            ->setParameter('endDate', $edDate)
            ->getResult();

        foreach ($orders as $order){

            $totalSales+=($order->getItemSellPrice()*$order->getOrderQuantity());
            $totalCount+= $order->getOrderQuantity();
            $totalProfit+= ($order->getItemSellPrice()-$order->getPricing()->getInPrice())*$order->getOrderQuantity();
            if($order->getPaymentStatus()->getId()==1){

                $cashSales+=($order->getItemSellPrice()*$order->getOrderQuantity());
            }else{
                $sellCredit = $this->getDoctrine()->getRepository(Sellcredit::class)
                    ->createNamedQuery('sellCreditByOrder')
                    ->setParameter('orderId', $order->getId())->getResult();

                $cashSales+=($sellCredit[0]->getPaidAmount());
                $creditSales+=($sellCredit[0]->getRemainingAmount());

                $sellCreditPayments = $this->getDoctrine()->getRepository(Sellcreditpayment::class)
                    ->createNamedQuery('paidCreditsById')
                    ->setParameter('sellCreditId', $sellCredit[0]->getId())
                    ->getResult();

                foreach ($sellCreditPayments as $sellCreditPayment){

                    $paidCredits+= $sellCreditPayment->getPaidAmount();
                }
            }
        }


        foreach ($stockExpenses as $stockExpense){

            $expense+=$stockExpense->getExpence();
        }

        $netCash= $cashSales+$paidCredits-$expense;
        $dailyReportResponseDto = new  GeneralReportResponseDTO();

        $dailyReportResponseDto->setTotalSales($totalSales);
        $dailyReportResponseDto->setTotalQuantity($totalCount);
        $dailyReportResponseDto->setTotalProfit($totalProfit);
        $dailyReportResponseDto->setCashSales($cashSales);
        $dailyReportResponseDto->setCreditSales($creditSales);
        $dailyReportResponseDto->setPaidCredits($paidCredits);
        $dailyReportResponseDto->setNetCash($netCash);
        $dailyReportResponseDto->setReportStartDate($startDate);
        $dailyReportResponseDto->setReportEndDate($endDate);
        $dailyReportResponseDto->setTotalExpence($expense);

        return $dailyReportResponseDto;
    }


}