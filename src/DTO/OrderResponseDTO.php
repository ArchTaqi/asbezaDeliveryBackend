<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/27/2019
 * Time: 1:43 PM
 */

namespace App\DTO;


class OrderResponseDTO
{

    /**
     * @var int
     *
     */
    private $id;

    /**
     * @var string|null
     *
     */
    private $ordercode;

    /**
     * @var string
     */
    private $itemSellPrice;

    /**
     * @var int
     *
     */
    private $orderQuantity;

    /**
     * @var \DateTime
     *

     */
    private $orderDate;

    /**
     * @var string
     */
    private $orderEtDate;


    /**
     * OrderResponseDTO constructor.
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
     * @return null|string
     */
    public function getOrdercode(): ?string
    {
        return $this->ordercode;
    }

    /**
     * @param null|string $ordercode
     */
    public function setOrdercode(?string $ordercode): void
    {
        $this->ordercode = $ordercode;
    }

    /**
     * @return string
     */
    public function getItemSellPrice(): string
    {
        return $this->itemSellPrice;
    }

    /**
     * @param string $itemSellPrice
     */
    public function setItemSellPrice(string $itemSellPrice): void
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
     * @return \DateTime
     */
    public function getOrderDate(): \DateTime
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime $orderDate
     */
    public function setOrderDate(\DateTime $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return string
     */
    public function getOrderEtDate(): string
    {
        return $this->orderEtDate;
    }

    /**
     * @param string $orderEtDate
     */
    public function setOrderEtDate(string $orderEtDate): void
    {
        $this->orderEtDate = $orderEtDate;
    }

}