<?php


namespace App\DTO;


class OrderListResponseDTO
{
    /**
     * @var int
     *
     */
    private $id;
    /**
     * @var string
     */
    private $itemName;
    /**
     * @var string
     */
    private $orderDate;
    /**
     * @var string
     */
    private $unitInPrice;
    /**
     * @var string
     */
    private $unitSellPrice;
    /**
     * @var string
     */
    private $unitProfit;
    /**
     * @var string
     */
    private $totalProfit;
    /**
     * @var int
     *
     */
    private $quantity;
    /**
     * @var string
     */
    private $totalPrice;
    /**
     * @var string
     */
    private $orderMode;
    /**
     * @var string
     */
    private $paidAmount;
    /**
     * @var string
     */
    private $remainingAmount;

    /**
     * @var string
     */
    private $customerName;
    /**
     * @var string
     */
    private $customerPhone;
    /**
     * @var string
     */
    private $userName;
    /**
     * @var string
     */
    private $userRole;
    /**
     * @var string
     */
    private $registrationDate;
    /**
     * @var string
     */
    private $registrationTime;

    /**
     * OrderListResponseDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * @param string $itemName
     */
    public function setItemName(string $itemName): void
    {
        $this->itemName = $itemName;
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
    public function getUnitInPrice(): string
    {
        return $this->unitInPrice;
    }

    /**
     * @param string $unitInPrice
     */
    public function setUnitInPrice(string $unitInPrice): void
    {
        $this->unitInPrice = $unitInPrice;
    }

    /**
     * @return string
     */
    public function getUnitSellPrice(): string
    {
        return $this->unitSellPrice;
    }

    /**
     * @param string $unitSellPrice
     */
    public function setUnitSellPrice(string $unitSellPrice): void
    {
        $this->unitSellPrice = $unitSellPrice;
    }



    /**
     * @return string
     */
    public function getUnitProfit(): string
    {
        return $this->unitProfit;
    }

    /**
     * @param string $unitProfit
     */
    public function setUnitProfit(string $unitProfit): void
    {
        $this->unitProfit = $unitProfit;
    }

    /**
     * @return string
     */
    public function getTotalProfit(): string
    {
        return $this->totalProfit;
    }

    /**
     * @param string $totalProfit
     */
    public function setTotalProfit(string $totalProfit): void
    {
        $this->totalProfit = $totalProfit;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }

    /**
     * @param string $totalPrice
     */
    public function setTotalPrice(string $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return string
     */
    public function getOrderMode(): string
    {
        return $this->orderMode;
    }

    /**
     * @param string $orderMode
     */
    public function setOrderMode(string $orderMode): void
    {
        $this->orderMode = $orderMode;
    }

    /**
     * @return string
     */
    public function getPaidAmount(): string
    {
        return $this->paidAmount;
    }

    /**
     * @param string $paidAmount
     */
    public function setPaidAmount(string $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }

    /**
     * @return string
     */
    public function getRemainingAmount(): string
    {
        return $this->remainingAmount;
    }

    /**
     * @param string $remainingAmount
     */
    public function setRemainingAmount(string $remainingAmount): void
    {
        $this->remainingAmount = $remainingAmount;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string
     */
    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     */
    public function setCustomerPhone(string $customerPhone): void
    {
        $this->customerPhone = $customerPhone;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserRole(): string
    {
        return $this->userRole;
    }

    /**
     * @param string $userRole
     */
    public function setUserRole(string $userRole): void
    {
        $this->userRole = $userRole;
    }



    /**
     * @return string
     */
    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    /**
     * @param string $registrationDate
     */
    public function setRegistrationDate(string $registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }

    /**
     * @return string
     */
    public function getRegistrationTime(): string
    {
        return $this->registrationTime;
    }

    /**
     * @param string $registrationTime
     */
    public function setRegistrationTime(string $registrationTime): void
    {
        $this->registrationTime = $registrationTime;
    }




}