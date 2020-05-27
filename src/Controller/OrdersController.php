<?php

namespace App\Controller;

use App\DTO\BranchReportByDateRangeRequestDTO;
use App\DTO\BranchReportByDateRequestDTO;
use App\DTO\CustomerHistoryDetailsDTO;
use App\DTO\CustomerHistoryDTO;
use App\DTO\OrderConfirmDTO;
use App\DTO\OrderArrayDto;
use App\DTO\OrderListResponseDTO;
use App\DTO\OrderRequestDTO;
use App\DTO\OrderItemListDto;
use App\DTO\ResponseDTO;
use App\Entity\Branch;
use App\Entity\Itemstatus;
use App\Entity\Orders;
use App\Entity\Paymentmode;
use App\Entity\Paymentstatus;
use App\Entity\Pricing;
use App\Entity\Sellcredit;
use App\Entity\Sellcreditpayment;
use App\Entity\Status;
use App\Entity\StockExpense;
use App\Entity\User;
use App\Form\OrdersType;
use App\Services\CalendarExchangeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Services\CalendarConverterService;
use DateTime;
use WebSocket\Client;

/**
 * @Route("/rest/orders")
 */
class OrdersController extends AbstractController
{


    /**
     * @Route("/listTodayOrder", name="order_listTodayOrder", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Orders by date",
     *      @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=OrderListResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Parameter(
     *      name="branchId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Orders")
     * @param Request $request
     * @return Response
     */
    public function listTodayOrder(Request $request): Response
    {
        $branchId = intval($request->query->get('branchId'));
        $calendar = new CalendarExchangeService();
        return $this->branchDateRangeReport($calendar->etNow(), $calendar->etNow(), $branchId);
    }

    /**
     * @Route("/listOrderByDate", name="order_listOrderByDate", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Orders by date",
     *      @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=OrderListResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Parameter(
     *      name="reportDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=BranchReportByDateRangeRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Orders")
     * @ParamConverter("request", converter="fos_rest.request_body")
     * @param BranchReportByDateRangeRequestDTO $request
     * @return Response
     */
    public function listOrderByDate(BranchReportByDateRangeRequestDTO $request): Response
    {

        return $this->branchDateRangeReport($request->getReportStartDate(), $request->getReportEndDate(), $request->getBranchId());
    }

    /**
     * @Route("/listOrderByDateRange", name="order_listOrderByDateRange", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Orders by date",
     *      @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=OrderListResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Parameter(
     *      name="reportDate",
     *      in="body",
     *     @SWG\Schema(ref=@Model(type=BranchReportByDateRangeRequestDTO::class))
     * )
     *
     * @SWG\Tag(name="Orders")
     * @ParamConverter("request", converter="fos_rest.request_body")
     * @param BranchReportByDateRangeRequestDTO $request
     * @return Response
     */
    public function listOrderByDateRange(BranchReportByDateRangeRequestDTO $request): Response
    {

        return $this->branchDateRangeReport($request->getReportStartDate(), $request->getReportEndDate(), $request->getBranchId());
    }


    private function branchDateRangeReport(string $startDate, string $endDate, int $branchId): Response
    {

        $calendar = new CalendarExchangeService();


        $reportStartDate = $calendar->etToGreg($startDate);
        $reportEndDate = $calendar->etToGreg($endDate);

        $stDate = $reportStartDate->format('Y-m-d');
        $edDate = $reportEndDate->format('Y-m-d');

        $orders = $this->getDoctrine()->getRepository(Orders::class)
            ->createNamedQuery('dateRangeOrdersByBranch')
            ->setParameter('startDate', $stDate)
            ->setParameter('endDate', $edDate)
            ->setParameter('branchId', $branchId)
            ->getResult();

        $orderList = array();
        foreach ($orders as $order) {

//            $order= new Orders();

            $orderListDto = new  OrderListResponseDTO();
            $orderListDto->setId($order->getId());
            $orderListDto->setItemName($order->getPricing()->getItem()->getName());
            $orderListDto->setOrderDate($order->getOrderEtDate());
            $orderListDto->setOrderMode($order->getPaymentMode()->getName());
            $orderListDto->setQuantity($order->getOrderQuantity());
            $orderListDto->setUnitInPrice($order->getPricing()->getInPrice());
            $orderListDto->setUnitSellPrice($order->getItemSellPrice());
            $orderListDto->setTotalPrice($order->getItemSellPrice() * $order->getOrderQuantity());
            $orderListDto->setUnitProfit($order->getItemSellPrice() - $order->getPricing()->getInPrice());
            $orderListDto->setTotalProfit(($order->getItemSellPrice() - $order->getPricing()->getInPrice()) * $order->getOrderQuantity());
            if ($order->getPaymentStatus()->getId() == 1) {

                $orderListDto->setPaidAmount($order->getItemSellPrice() * $order->getOrderQuantity());
                $orderListDto->setRemainingAmount("0.00");
            } else {
                $sellCredit = $this->getDoctrine()->getRepository(Sellcredit::class)
                    ->createNamedQuery('sellCreditByOrder')
                    ->setParameter('orderId', $order->getId())->getResult();

                $orderListDto->setPaidAmount($sellCredit[0]->getPaidAmount());
                $orderListDto->setRemainingAmount($sellCredit[0]->getRemainingAmount());

            }
            array_push($orderList, $orderListDto);
        }


        return $this->json($orderList);
    }


    /**
     * @Route("/customerHistory", name="order_history", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns History of Orders for a Customer",
     *      @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=CustomerHistoryDTO::class))
     *      ))
     *
     *     )
     * @SWG\Parameter(
     *      name="branchId",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Orders")
     * @param Request $request
     * @return Response
     */
    public function customerHistory(Request $request) {
        $branchId = intval($request->query->get('branchId'));

        if($this->getUser()== null){
            $response = new ResponseDTO(false,"Authentication Required");
            return $this->json($response);
        }
        $Orders = $this->getDoctrine()->getRepository(Orders::class)->createNamedQuery('customerHistoryByBranch')
            ->setParameter('userId', $this->getUser()->getId())
            ->setParameter('branchId', $branchId)->getResult();

        $historyList = array();
        foreach ($Orders as $order) {
//            $order = new Orders();
            $customerHistoryDto = new CustomerHistoryDTO();
            $customerHistoryDto->setOrderDate($order->getOrderEtDate());
            $customerHistoryDto->setOrderCode($order->getOrdercode());
            $customerHistoryDto->setOrderStatus($order->getStatus()->getName());

            array_push($historyList, $customerHistoryDto);

        }
        return $this->json($historyList);
    }


    /**
     * @Route("/historyDetails", name="order_historyDetails", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns History of Orders for a Customer",
     *      @SWG\Schema(type="array",
     *       @SWG\Items(ref=@Model(type=CustomerHistoryDetailsDTO::class))
     *      ))
     *
     *     )
     * @SWG\Parameter(
     *      name="orderCode",
     *      in="query",
     *      type="integer",
     *      required=true
     * )
     *
     * @SWG\Tag(name="Orders")
     * @param Request $request
     * @return Response
     */
    public function customerHistoryDetails(Request $request) {
        $orderCode = intval($request->query->get('orderCode'));

        $Orders = $this->getDoctrine()->getRepository(Orders::class)->createNamedQuery('orderByCode')
            ->setParameter('orderCode', $orderCode)->getResult();

        $historyList = array();
        foreach ($Orders as $order) {
//            $order = new Orders();

            $item = $order->getPricing()->getItem();
            $historyDetailsDto = new CustomerHistoryDetailsDTO();

            $historyDetailsDto->setOrderId($order->getId());
            $historyDetailsDto->setItemCategory($item->getCategory()->getName());
            $historyDetailsDto->setItemName($item->getName());
            $historyDetailsDto->setItemDescription($item->getDescription());
            $historyDetailsDto->setPricing($order->getPricing()->getItemName());
            $historyDetailsDto->setUnitPrice($order->getPricing()->getUnitPrice());
            $historyDetailsDto->setQuantity($order->getOrderQuantity());
            $historyDetailsDto->setTotalPrice($order->getPricing()->getUnitPrice()*$order->getOrderQuantity());
            $historyDetailsDto->setOrderStatus($order->getStatus()->getName());

            array_push($historyList, $historyDetailsDto);

        }
        return $this->json($historyList);
    }


    /**
     * @Route("/newOrderFromArray", name="orders_new_array", methods={"POST"})
     *
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Creates Orders",
     *     @SWG\Schema(ref=@Model(type=ResponseDTO::class))
     *
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="body",
     *
     *          @SWG\Property(property="request", ref=@Model(type=OrderArrayDto::class))
     *
     * )
     *
     * @SWG\Tag(name="Orders")
     *
     * @ParamConverter("orderRequestDTO", converter="fos_rest.request_body")
     *
     * @param OrderArrayDto $orderRequestDTO
     * @return ResponseDTO
     * @throws \Exception
     */
    public function insertFromArray(OrderArrayDto $orderRequestDTO): ResponseDTO
    {

        $orderList = $orderRequestDTO->getOrderItemListDto();

        $orderDate = new \DateTime();
        $orderDate = $orderDate->modify('-3 hours');

        $calendar = new CalendarExchangeService();
        $etDate = $calendar->etNow();


        $orderDate->format("H:i:s A");
        $orderCode = (rand(1000000, 9999999));

//        $totalAmount = $orderRequestDTO->getTotalAmount();
        $pStatus = 1; // $orderRequestDTO->getOrderMode();
        $pMode = 1; // $orderRequestDTO->getOrderMode();
        $vat = 0;

        $remainingAmount = 0;
//        if ($pMode == 3) {
//            $remainingAmount = $totalAmount - $orderRequestDTO->getPaidAmount();
//        } else if ($pMode == 2) {
//            $remainingAmount = $totalAmount;
//        }


        $registeredBy = $this->getUser();
        $status = $this->getDoctrine()->getRepository(Status::class)->find(1);

        try {

            foreach ($orderList as $orderItem) {
//                $order =  new OrderItemListDto();

                $pricing = $this->getDoctrine()->getRepository(Pricing::class)->find($orderItem->getPricingId());
                if ($pricing != null) {

//                $pricing= new Pricing();
                    if ($pricing->getStatus()->getId() == 1 && $pricing->getItem()->getStatus()->getId() == 1) {


                        $branch = $this->getDoctrine()->getRepository(Branch::class)->find($orderRequestDTO->getBranchId());
                        $paymentMode = $this->getDoctrine()->getRepository(Paymentmode::class)->find($pMode);
                        $paymentStatus = $this->getDoctrine()->getRepository(Paymentstatus::class)->find($pStatus);


                        $itemStatus = $pricing->getItem()->getItemstatus();

                        if ($branch->getId() != $pricing->getItem()->getCategory()->getBranch()->getId()) {

                            return new ResponseDTO(false, 'Item NOT found in this branch. Selling Item from another Branch is NOT supported ');
                        } else {


                            $order = new Orders();
                            $order->setBranch($branch);
                            $order->setOrdercode($orderCode);
                            $order->setPaymentStatus($paymentStatus);
                            $order->setPaymentMode($paymentMode);
                            $order->setPricing($pricing);
                            $order->setRegisteredby($registeredBy);
                            $order->setItemSellPrice($pricing->getUnitPrice());
                            $order->setOrderQuantity($orderItem->getOrderQuantity());
                            $order->setOrderDate($orderDate);
                            $order->setOrderEtDate($etDate);
                            $order->setOrderTime($orderDate);
                            $order->setOrdercode($orderCode);
                            $order->setItemStatus($itemStatus);
                            $order->setVat($vat);
                            $order->setStatus($status);


                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($order);
                            $entityManager->flush();


                        }
                    } else {
                        return new ResponseDTO(false, 'Can Not Create Order with Deleted Item ');
                    }

                } else {
                    return new ResponseDTO(true, 'Item NOT Found ');
                }
            }

//            if ($pMode > 1) {
//                $sellCredit = new Sellcredit();
//
//                $sellCredit->setOrders($orderCode);
//                $sellCredit->setTotalAmount($totalAmount);
//                $sellCredit->setRemainingAmount($remainingAmount);
//                $sellCredit->setPaidAmount($orderRequestDTO->getPaidAmount());
//                $sellCredit->setRegdate($orderDate);
//                $sellCredit->setRegetdate($etDate[3]);
//                $sellCredit->setCustomerName($orderRequestDTO->getCustomerName());
//                $sellCredit->setCustomerPhone($orderRequestDTO->getCustomerPhone());
//                $sellCredit->setRegisteredby($registeredBy);
//                $sellCredit->setStatus($status);
//
//
//                $entityManager = $this->getDoctrine()->getManager();
//                $entityManager->persist($sellCredit);
//                $entityManager->flush();
//
//                return new ResponseDTO(true, 'Order Registered SuccessFully with credit ');
//            }
            return new ResponseDTO(true, 'Order Registered SuccessFully ');
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return new ResponseDTO(false, 'Order NOT Registered ' . $e->getMessage());
        }


//        return new ResponseDTO(true, strval($codenames));
    }


    public function returnOrder(int $orderId)
    {

        $order = $this->getDoctrine()->getRepository(Orders::class)->find($orderId);

    }

}
