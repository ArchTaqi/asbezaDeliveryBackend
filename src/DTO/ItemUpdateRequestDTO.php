<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/20/2019
 * Time: 12:08 PM
 */

namespace App\DTO;


class ItemUpdateRequestDTO
{

    /**
     * @var int
     *
     *
     */
    private $id;

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
     * @var string
     *
     */
    private $pictureData;



    /**
     * ItemRequestDTO constructor.
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
    public function getName(): string
    {
        return $this->name;
    }

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