<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/20/2019
 * Time: 12:08 PM
 */

namespace App\DTO;


class ItemRequestDTO
{

    /**
     * @var string
     *
     *
     */
    private $name;

    /**
     * @var string|null
     *
     */
    private $description;

    /**
     * @var string
     *
     */
    private $brand;


    /**
     * @var int
     *
     */
    private $category;

    /**
     * @var int
     *
     */
    private $measuring_unit;

    /**
     * @var double
     *
     */
    private $unit_price;

    /**
     * ItemRequestDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @var string
     *
     */
    private $pictureData;

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getMeasuringUnit(): int
    {
        return $this->measuring_unit;
    }

    /**
     * @param int $measuring_unit
     */
    public function setMeasuringUnit(int $measuring_unit): void
    {
        $this->measuring_unit = $measuring_unit;
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
     * @return string
     */
    public function getPictureData(): string
    {
        return $this->pictureData;
    }

    /**
     * @param string $pictureData
     */
    public function setPictureData(string $pictureData): void
    {
        $this->pictureData = $pictureData;
    }



}