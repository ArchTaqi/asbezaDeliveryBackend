<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/12/2019
 * Time: 8:55 AM
 */

namespace App\DTO;


class pricingSummaryResponseDTO
{


    /**
     * @var string
     *
     */
    private $itemCode;

    /**
     * @var string
     *
     */
    private $inPrice;

    /**
     * @var string |null
     *
     */
    private $fixPrice;

    /**
     * @var int
     *
     */
    private $inQuantity;

    /**
     * @var int
     *
     */
    private $remainingQuantity;

    /**
     * @var string
     *
     */
    private $regEtDate;

    /**
     * pricingSummaryResponseDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getItemCode(): string
    {
        return $this->itemCode;
    }

    /**
     * @param string $itemCode
     */
    public function setItemCode(string $itemCode): void
    {
        $this->itemCode = $itemCode;
    }

    /**
     * @return string
     */
    public function getInPrice(): string
    {
        return $this->inPrice;
    }

    /**
     * @param string $inPrice
     */
    public function setInPrice(string $inPrice): void
    {
        $this->inPrice = $inPrice;
    }

    /**
     * @return null|string
     */
    public function getFixPrice(): ?string
    {
        return $this->fixPrice;
    }

    /**
     * @param null|string $fixPrice
     */
    public function setFixPrice(?string $fixPrice): void
    {
        $this->fixPrice = $fixPrice;
    }

    /**
     * @return int
     */
    public function getInQuantity(): int
    {
        return $this->inQuantity;
    }

    /**
     * @param int $inQuantity
     */
    public function setInQuantity(int $inQuantity): void
    {
        $this->inQuantity = $inQuantity;
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

    /**
     * @return string
     */
    public function getRegEtDate(): string
    {
        return $this->regEtDate;
    }

    /**
     * @param string $regEtDate
     */
    public function setRegEtDate(string $regEtDate): void
    {
        $this->regEtDate = $regEtDate;
    }



}