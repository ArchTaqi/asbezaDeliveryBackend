<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/27/2019
 * Time: 12:15 PM
 */

namespace App\DTO;


class GeneralReportResponseDTO
{
    /**
     * @var double
     *
     */
    private $totalSales;
    /**
     * @var int
     *
     */

    private $totalProfit;
    /**
     * @var double
     *
     */
    private $totalQuantity;
    /**
     * @var double
     *
     */
    private $cashSales;
    /**
     * @var double
     *
     */
    private $creditSales;
    /**
     * @var double
     *
     */
    private $paidCredits;
    /**
     * @var double
     *
     */
    private $netCash;

    /**
     * @var double
     *
     */
    private $totalExpence;

    /**
     * @var string
     *
     */
    private $reportStartDate;

    /**
     * @var string
     *
     */
    private $reportEndDate;

    /**
     * @var OrderListResponseDTO[]
     *
     */
    private $orderList;
    /**
     * @var ExpensesListDTO[]
     *
     */
    private $expenseList;


    /**
     * GeneralReportResponseDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return float
     */
    public function getTotalSales(): float
    {
        return $this->totalSales;
    }

    /**
     * @param float $totalSales
     */
    public function setTotalSales(float $totalSales): void
    {
        $this->totalSales = $totalSales;
    }

    /**
     * @return int
     */
    public function getTotalProfit(): int
    {
        return $this->totalProfit;
    }

    /**
     * @param int $totalProfit
     */
    public function setTotalProfit(int $totalProfit): void
    {
        $this->totalProfit = $totalProfit;
    }

    /**
     * @return float
     */
    public function getTotalQuantity(): float
    {
        return $this->totalQuantity;
    }

    /**
     * @param float $totalQuantity
     */
    public function setTotalQuantity(float $totalQuantity): void
    {
        $this->totalQuantity = $totalQuantity;
    }

    /**
     * @return float
     */
    public function getCashSales(): float
    {
        return $this->cashSales;
    }

    /**
     * @param float $cashSales
     */
    public function setCashSales(float $cashSales): void
    {
        $this->cashSales = $cashSales;
    }

    /**
     * @return float
     */
    public function getCreditSales(): float
    {
        return $this->creditSales;
    }

    /**
     * @param float $creditSales
     */
    public function setCreditSales(float $creditSales): void
    {
        $this->creditSales = $creditSales;
    }

    /**
     * @return float
     */
    public function getPaidCredits(): float
    {
        return $this->paidCredits;
    }

    /**
     * @param float $paidCredits
     */
    public function setPaidCredits(float $paidCredits): void
    {
        $this->paidCredits = $paidCredits;
    }

    /**
     * @return float
     */
    public function getNetCash(): float
    {
        return $this->netCash;
    }

    /**
     * @param float $netCash
     */
    public function setNetCash(float $netCash): void
    {
        $this->netCash = $netCash;
    }

    /**
     * @return float
     */
    public function getTotalExpence(): float
    {
        return $this->totalExpence;
    }

    /**
     * @param float $totalExpence
     */
    public function setTotalExpence(float $totalExpence): void
    {
        $this->totalExpence = $totalExpence;
    }

    /**
     * @return string
     */
    public function getReportStartDate(): string
    {
        return $this->reportStartDate;
    }

    /**
     * @param string $reportStartDate
     */
    public function setReportStartDate(string $reportStartDate): void
    {
        $this->reportStartDate = $reportStartDate;
    }

    /**
     * @return string
     */
    public function getReportEndDate(): string
    {
        return $this->reportEndDate;
    }

    /**
     * @param string $reportEndDate
     */
    public function setReportEndDate(string $reportEndDate): void
    {
        $this->reportEndDate = $reportEndDate;
    }

    /**
     * @return OrderListResponseDTO[]
     */
    public function getOrderList(): array
    {
        return $this->orderList;
    }

    /**
     * @param OrderListResponseDTO[] $orderList
     */
    public function setOrderList(array $orderList): void
    {
        $this->orderList = $orderList;
    }

    /**
     * @return ExpensesListDTO[]
     */
    public function getExpenseList(): array
    {
        return $this->expenseList;
    }

    /**
     * @param ExpensesListDTO[] $expenseList
     */
    public function setExpenseList(array $expenseList): void
    {
        $this->expenseList = $expenseList;
    }



}