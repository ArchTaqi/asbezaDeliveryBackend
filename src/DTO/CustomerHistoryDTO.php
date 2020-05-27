<?php


namespace App\DTO;


class CustomerHistoryDTO
{

    /**
     * @var string
     *
     */
    private $orderCode;
    /**
     * @var string
     *
     */
    private $orderDate;

    /**
     * @var string
     *
     */
    private $orderStatus;

    /**
     * CustomerHistoryDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getOrderCode(): string
    {
        return $this->orderCode;
    }

    /**
     * @param string $orderCode
     */
    public function setOrderCode(string $orderCode): void
    {
        $this->orderCode = $orderCode;
    }

    /**
     * @return string
     */
    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    /**
     * @param string $orderDate
     */
    public function setOrderDate(string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return string
     */
    public function getOrderStatus(): string
    {
        return $this->orderStatus;
    }

    /**
     * @param string $orderStatus
     */
    public function setOrderStatus(string $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }




}