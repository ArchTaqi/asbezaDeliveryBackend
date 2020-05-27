<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/25/2019
 * Time: 4:28 PM
 */

namespace App\DTO;


class OrderItemListDto
{


    /**
     * @var string
     *
     *
     */
    private $pricingId;


    /**
     * @var int
     *
     */
    private $orderQuantity;


    /**
     * OrderRequestDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getPricingId(): string
    {
        return $this->pricingId;
    }

    /**
     * @param string $pricingId
     */
    public function setPricingId(string $pricingId): void
    {
        $this->pricingId = $pricingId;
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




}