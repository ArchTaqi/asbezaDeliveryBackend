<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/21/2019
 * Time: 9:34 AM
 */

namespace App\DTO;



class MerchantItemResponseDTO
{
    /**
     * @var int
     *
     */
    private $itemId;

    /**
     * @var string
     *
     */
    private $itemName;

    /**
     * @var string|null
     *
     */
    private $itemDescription;
    /**
     * @var string|null
     *
     */
    private $itemBrand;

    /**
     * @var int
     *
     */
    private $catId;
    /**
     * @var string
     *
     */
    private $catName;
    /**
     * @var int
     *
     */
    private $measuringUnitId;

    /**
     * @var string
     *
     */
    private $measuringUnitName;
    /**
     * @var double
     *
     */
    private $unit_price;
    /**
     * @var string |null
     *
     */
    private $picturePath;
    /**
     * @var int
     *
     */
    private $itemStatusId;

    /**
     * @var string
     *
     */
    private $itemStatusName;

    /**
     * @var int
     *
     */
    private $registeredById;

    /**
     * @var string
     *
     */
    private $registeredByName;
    /**
     * @var PricingByItemResponseDTO[]
     *
     */
    private $pricing;

    /**
     * ItemResponseDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getItemId(): int
    {
        return $this->itemId;
    }

    /**
     * @param int $itemId
     */
    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
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
     * @return string|null
     */
    public function getItemDescription(): ?string
    {
        return $this->itemDescription;
    }

    /**
     * @param string|null $itemDescription
     */
    public function setItemDescription(?string $itemDescription): void
    {
        $this->itemDescription = $itemDescription;
    }

    /**
     * @return string|null
     */
    public function getItemBrand(): ?string
    {
        return $this->itemBrand;
    }

    /**
     * @param string|null $itemBrand
     */
    public function setItemBrand(?string $itemBrand): void
    {
        $this->itemBrand = $itemBrand;
    }

    /**
     * @return int
     */
    public function getCatId(): int
    {
        return $this->catId;
    }

    /**
     * @param int $catId
     */
    public function setCatId(int $catId): void
    {
        $this->catId = $catId;
    }

    /**
     * @return string
     */
    public function getCatName(): string
    {
        return $this->catName;
    }

    /**
     * @param string $catName
     */
    public function setCatName(string $catName): void
    {
        $this->catName = $catName;
    }

    /**
     * @return int
     */
    public function getMeasuringUnitId(): int
    {
        return $this->measuringUnitId;
    }

    /**
     * @param int $measuringUnitId
     */
    public function setMeasuringUnitId(int $measuringUnitId): void
    {
        $this->measuringUnitId = $measuringUnitId;
    }

    /**
     * @return string
     */
    public function getMeasuringUnitName(): string
    {
        return $this->measuringUnitName;
    }

    /**
     * @param string $measuringUnitName
     */
    public function setMeasuringUnitName(string $measuringUnitName): void
    {
        $this->measuringUnitName = $measuringUnitName;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unit_price;
    }

    /**
     * @param float $unit_price
     */
    public function setUnitPrice(float $unit_price): void
    {
        $this->unit_price = $unit_price;
    }

    /**
     * @return string|null
     */
    public function getPicturePath(): ?string
    {
        return $this->picturePath;
    }

    /**
     * @param string|null $picturePath
     */
    public function setPicturePath(?string $picturePath): void
    {
        $this->picturePath = $picturePath;
    }

    /**
     * @return int
     */
    public function getItemStatusId(): int
    {
        return $this->itemStatusId;
    }

    /**
     * @param int $itemStatusId
     */
    public function setItemStatusId(int $itemStatusId): void
    {
        $this->itemStatusId = $itemStatusId;
    }

    /**
     * @return string
     */
    public function getItemStatusName(): string
    {
        return $this->itemStatusName;
    }

    /**
     * @param string $itemStatusName
     */
    public function setItemStatusName(string $itemStatusName): void
    {
        $this->itemStatusName = $itemStatusName;
    }

    /**
     * @return int
     */
    public function getRegisteredById(): int
    {
        return $this->registeredById;
    }

    /**
     * @param int $registeredById
     */
    public function setRegisteredById(int $registeredById): void
    {
        $this->registeredById = $registeredById;
    }

    /**
     * @return string
     */
    public function getRegisteredByName(): string
    {
        return $this->registeredByName;
    }

    /**
     * @param string $registeredByName
     */
    public function setRegisteredByName(string $registeredByName): void
    {
        $this->registeredByName = $registeredByName;
    }

    /**
     * @return PricingByItemResponseDTO[]
     */
    public function getPricing(): array
    {
        return $this->pricing;
    }

    /**
     * @param PricingByItemResponseDTO[] $pricing
     */
    public function setPricing(array $pricing): void
    {
        $this->pricing = $pricing;
    }

    

}