<?php


namespace App\DTO;


class CustomerHistoryDetailsDTO
{

    /**
     * @var string
     *
     */
    private $orderId;
    /**
     * @var string
     *
     */
    private $itemCategory;
    /**
     * @var string
     *
     */
    private $itemName;
    /**
     * @var string
     *
     */
    private $itemDescription;
    /**
     * @var string
     *
     */
    private $pricing;
    /**
     * @var string
     *
     */
    private $unitPrice;
    /**
     * @var string
     *
     */
    private $quantity;
    /**
     * @var string
     *
     */
    private $totalPrice;

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
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getItemCategory(): string
    {
        return $this->itemCategory;
    }

    /**
     * @param string $itemCategory
     */
    public function setItemCategory(string $itemCategory): void
    {
        $this->itemCategory = $itemCategory;
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
    public function getItemDescription(): string
    {
        return $this->itemDescription;
    }

    /**
     * @param string $itemDescription
     */
    public function setItemDescription(string $itemDescription): void
    {
        $this->itemDescription = $itemDescription;
    }

    /**
     * @return string
     */
    public function getPricing(): string
    {
        return $this->pricing;
    }

    /**
     * @param string $pricing
     */
    public function setPricing(string $pricing): void
    {
        $this->pricing = $pricing;
    }

    /**
     * @return string
     */
    public function getUnitPrice(): string
    {
        return $this->unitPrice;
    }

    /**
     * @param string $unitPrice
     */
    public function setUnitPrice(string $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity(string $quantity): void
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