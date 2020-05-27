<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/21/2019
 * Time: 12:54 PM
 */

namespace App\DTO;

class PricingResponseDTO
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
     * @var string
     *
     */
    private $unitPrice;

    /**
     * @var int
     */
    private $statusId;

    /**
     * @var string
     */
    private $statusName;


    /**
     * PricingResponseDTO constructor.
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
     * @return string
     */
    public function getUnitPrice(): string
    {
        return $this->unitPrice;
    }

    /**
     * @param string $unitPrice
     */
    public function setUnitPrice(string $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     */
    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return $this->statusName;
    }

    /**
     * @param string $statusName
     */
    public function setStatusName(string $statusName): void
    {
        $this->statusName = $statusName;
    }




}