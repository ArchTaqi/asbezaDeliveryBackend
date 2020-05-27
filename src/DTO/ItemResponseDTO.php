<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/21/2019
 * Time: 9:34 AM
 */

namespace App\DTO;

use App\DTO\PricingResponseDTO;


class ItemResponseDTO
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
     * @var string
     *
     */
    private $unit_price;
    /**
     * @var string |null
     *
     */
    private $picturePath;

    /**
     * @var PricingResponseDTO[]
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
     * @return string
     */
    public function getUnitPrice(): string
    {
        return $this->unit_price;
    }

    /**
     * @param string $unit_price
     */
    public function setUnitPrice(string $unit_price): void
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
     * @return PricingResponseDTO[]
     */
    public function getPricing(): array
    {
        return $this->pricing;
    }

    /**
     * @param PricingResponseDTO[] $pricing
     */
    public function setPricing(array $pricing): void
    {
        $this->pricing = $pricing;
    }


}