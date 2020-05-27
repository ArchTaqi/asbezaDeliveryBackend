<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/21/2019
 * Time: 1:49 PM
 */

namespace App\DTO;


class PricingRequestDTO
{

    /**
     * @var int
     *
     */
    private $item;
    /**
     * @var string
     *
     */
    private $itemTypeName;

    /**
     * @var double
     *
     */
    private $unitPrice;


    /**
     * PricingRequestDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getItem(): int
    {
        return $this->item;
    }

    /**
     * @param int $item
     */
    public function setItem(int $item): void
    {
        $this->item = $item;
    }

    /**
     * @return string
     */
    public function getItemTypeName(): string
    {
        return $this->itemTypeName;
    }

    /**
     * @param string $itemTypeName
     */
    public function setItemTypeName(string $itemTypeName): void
    {
        $this->itemTypeName = $itemTypeName;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }


}