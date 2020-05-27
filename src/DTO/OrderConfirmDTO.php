<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/14/2019
 * Time: 5:26 PM
 */

namespace App\DTO;


class OrderConfirmDTO
{

    /**
     * @var boolean
     *
     *
     */
    private $checkStatus;
    /**
     * @var string
     *
     *
     */
    private $category;
    /**
     * @var string
     *
     *
     */
    private $itemBrand;
    /**
     * @var string
     *
     *
     */
    private $itemName;
    /**
     * @var string
     *
     *
     */
    private $itemstatus;
    /**
     * @var int
     *
     *
     */
    private $remainingQuantity;

    /**
     * OrderConfirmDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function isCheckStatus(): bool
    {
        return $this->checkStatus;
    }

    /**
     * @param bool $checkStatus
     */
    public function setCheckStatus(bool $checkStatus): void
    {
        $this->checkStatus = $checkStatus;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
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
     * @return string
     */
    public function getItemstatus(): string
    {
        return $this->itemstatus;
    }

    /**
     * @param string $itemstatus
     */
    public function setItemstatus(string $itemstatus): void
    {
        $this->itemstatus = $itemstatus;
    }

    /**
     * @return int
     */
    public function getRemainingQuantity(): int
    {
        return $this->remainingQuantity;
    }

    /**
     * @param int $remainingQuantity
     */
    public function setRemainingQuantity(int $remainingQuantity): void
    {
        $this->remainingQuantity = $remainingQuantity;
    }


}