<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/12/2019
 * Time: 8:42 AM
 */

namespace App\DTO;


class ItemSummaryResponseDTO
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
    private $itemName;

    /**
     * @var string|null
     *
     */
    private $itemDescription;

    /**
     * @var string
     *
     */
    private $itemstatusName;


    /**
     * @var string
     *
     */
    private $itemBrand;


    /**
     * @var int
     *
     */
    private $itemQuantity;

    /**
     * @var pricingSummaryResponseDTO[]
     *
     */
    private $pricing;

    /**
     * ItemSummaryResponseDTO constructor.
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
     * @return null|string
     */
    public function getItemDescription(): ?string
    {
        return $this->itemDescription;
    }

    /**
     * @param null|string $itemDescription
     */
    public function setItemDescription(?string $itemDescription): void
    {
        $this->itemDescription = $itemDescription;
    }

    /**
     * @return string
     */
    public function getItemstatusName(): string
    {
        return $this->itemstatusName;
    }

    /**
     * @param string $itemstatusName
     */
    public function setItemstatusName(string $itemstatusName): void
    {
        $this->itemstatusName = $itemstatusName;
    }

    /**
     * @return string
     */
    public function getItemBrand(): string
    {
        return $this->itemBrand;
    }

    /**
     * @param string $itemBrand
     */
    public function setItemBrand(string $itemBrand): void
    {
        $this->itemBrand = $itemBrand;
    }

    /**
     * @return int
     */
    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    /**
     * @param int $itemQuantity
     */
    public function setItemQuantity(int $itemQuantity): void
    {
        $this->itemQuantity = $itemQuantity;
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