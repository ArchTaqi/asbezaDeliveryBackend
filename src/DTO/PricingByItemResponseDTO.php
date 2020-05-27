<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/21/2019
 * Time: 12:54 PM
 */

namespace App\DTO;

class PricingByItemResponseDTO
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
    private $name;
    /**
     * @var int
     *
     */
    private $itemId;

    /**
     * @var double
     *
     */
    private $unitPrice;

    /**
     * @var \DateTime
     *
     */
    private $regdate;
    /**
     * @var string
     *
     */
    private $regetdate;

    /**
     * @var boolean|null
     *
     */
    private $isDefault;
    /**
     * @var int
     */
    private $statusId;

    /**
     * @var string
     */
    private $statusName;
    /**
     * @var int
     */
    private $registeredById;

    /**
     * @var string
     */
    private $registeredByName;

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
     * @return \DateTime
     */
    public function getRegdate(): \DateTime
    {
        return $this->regdate;
    }

    /**
     * @param \DateTime $regdate
     */
    public function setRegdate(\DateTime $regdate): void
    {
        $this->regdate = $regdate;
    }

    /**
     * @return string
     */
    public function getRegetdate(): string
    {
        return $this->regetdate;
    }

    /**
     * @param string $regetdate
     */
    public function setRegetdate(string $regetdate): void
    {
        $this->regetdate = $regetdate;
    }

    /**
     * @return bool|null
     */
    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool|null $isDefault
     */
    public function setIsDefault(?bool $isDefault): void
    {
        $this->isDefault = $isDefault;
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

}