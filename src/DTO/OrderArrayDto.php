<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/25/2019
 * Time: 4:28 PM
 */

namespace App\DTO;


class OrderArrayDto
{


    /**
     * @var OrderItemListDto[]
     *
     */
    private $orderItemListDto;
    /**
     * @var int
     *
     *
     */
    private $branchId;

//    /**
//     * @var double | null
//     *
//     */
//    private $orderMode;
//
//    /**
//     * @var double | null
//     *
//     */
//    private $totalAmount;
//    /**
//     * @var double | null
//     *
//     */
//    private $paidAmount;
//
//    /**
//     * @var string | null
//     */
//    private $customerName;
//
//    /**
//     * @var string | null
//     */
//    private $customerPhone;

    /**
     * OrderArrayDto constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return OrderItemListDto[]
     */
    public function getOrderItemListDto(): array
    {
        return $this->orderItemListDto;
    }

    /**
     * @param OrderItemListDto[] $orderItemListDto
     */
    public function setOrderItemListDto(array $orderItemListDto): void
    {
        $this->orderItemListDto = $orderItemListDto;
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

//    /**
//     * @return float|null
//     */
//    public function getOrderMode(): ?float
//    {
//        return $this->orderMode;
//    }
//
//    /**
//     * @param float|null $orderMode
//     */
//    public function setOrderMode(?float $orderMode): void
//    {
//        $this->orderMode = $orderMode;
//    }
//
//    /**
//     * @return float|null
//     */
//    public function getTotalAmount(): ?float
//    {
//        return $this->totalAmount;
//    }
//
//    /**
//     * @param float|null $totalAmount
//     */
//    public function setTotalAmount(?float $totalAmount): void
//    {
//        $this->totalAmount = $totalAmount;
//    }
//
//    /**
//     * @return float|null
//     */
//    public function getPaidAmount(): ?float
//    {
//        return $this->paidAmount;
//    }
//
//    /**
//     * @param float|null $paidAmount
//     */
//    public function setPaidAmount(?float $paidAmount): void
//    {
//        $this->paidAmount = $paidAmount;
//    }
//
//    /**
//     * @return string|null
//     */
//    public function getCustomerName(): ?string
//    {
//        return $this->customerName;
//    }
//
//    /**
//     * @param string|null $customerName
//     */
//    public function setCustomerName(?string $customerName): void
//    {
//        $this->customerName = $customerName;
//    }
//
//    /**
//     * @return string|null
//     */
//    public function getCustomerPhone(): ?string
//    {
//        return $this->customerPhone;
//    }
//
//    /**
//     * @param string|null $customerPhone
//     */
//    public function setCustomerPhone(?string $customerPhone): void
//    {
//        $this->customerPhone = $customerPhone;
//    }


}