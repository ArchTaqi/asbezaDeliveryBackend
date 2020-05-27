<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/25/2019
 * Time: 4:28 PM
 */

namespace App\DTO;


class OrderRequestDTO
{

    /**
     * @var int
     *
     *
     */
    private $branchId;
    /**
     * @var string
     *
     *
     */
    private $itemCode;

    /**
     * @var double
     *
     */
    private $itemSellPrice;

    /**
     * @var int
     *
     */
    private $orderQuantity;

    /**
     * @var double | null
     *
     */
    private $paidAmount;

    /**
     * @var string | null
     */
    private $customerName;

    /**
     * @var string | null
     */
    private $customerPhone;

    /**
     * OrderRequestDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getBranchId(): int
    {
        return $this->branchId;
    }

    /**
     * @param int $branchId
     */
    public function setBranchId(int $branchId): void
    {
        $this->branchId = $branchId;
    }


    /**
     * @return string
     */
    public function getItemCode(): string
    {
        return $this->itemCode;
    }

    /**
     * @param string $itemCode
     */
    public function setItemCode(string $itemCode): void
    {
        $this->itemCode = $itemCode;
    }

    /**
     * @return float
     */
    public function getItemSellPrice(): float
    {
        return $this->itemSellPrice;
    }

    /**
     * @param float $itemSellPrice
     */
    public function setItemSellPrice(float $itemSellPrice): void
    {
        $this->itemSellPrice = $itemSellPrice;
    }

    /**
     * @return int
     */
    public function getOrderQuantity(): int
    {
        return $this->orderQuantity;
    }

    /**
     * @param int $orderQuantity
     */
    public function setOrderQuantity(int $orderQuantity): void
    {
        $this->orderQuantity = $orderQuantity;
    }

    /**
     * @return float|null
     */
    public function getPaidAmount(): ?float
    {
        return $this->paidAmount;
    }

    /**
     * @param float|null $paidAmount
     */
    public function setPaidAmount(?float $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }

    /**
     * @return null|string
     */
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    /**
     * @param null|string $customerName
     */
    public function setCustomerName(?string $customerName): void
    {
        $this->customerName = $customerName;
    }

    /**
     * @return null|string
     */
    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    /**
     * @param null|string $customerPhone
     */
    public function setCustomerPhone(?string $customerPhone): void
    {
        $this->customerPhone = $customerPhone;
    }



}