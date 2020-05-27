<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/21/2019
 * Time: 1:49 PM
 */

namespace App\DTO;


class PricingUpdateRequestDTO
{

    /**
     * @var int
     *
     */
    private $id;
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
     * @var double
     *
     */
    private $status;


    /**
     * PricingRequestDTO constructor.
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

    /**
     * @return float
     */
    public function getStatus(): float
    {
        return $this->status;
    }

    /**
     * @param float $status
     */
    public function setStatus(float $status): void
    {
        $this->status = $status;
    }



}