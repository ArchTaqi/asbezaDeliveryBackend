<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 3:13 AM
 */

namespace App\DTO;


class StockExpenseRequestDTO
{

    /**
     * @var double|null
     *
     */
    private $expenceAmount;
    /**
     * @var string|null
     *
     */
    private $reason;
    /**
     * @var int
     *
     */
    private $registeredby;

    /**
     * StockExpenseRequestDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return float|null
     */
    public function getExpenceAmount(): ?float
    {
        return $this->expenceAmount;
    }

    /**
     * @param float|null $expenceAmount
     */
    public function setExpenceAmount(?float $expenceAmount): void
    {
        $this->expenceAmount = $expenceAmount;
    }


    /**
     * @return null|string
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @param null|string $reason
     */
    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * @return int
     */
    public function getRegisteredby(): int
    {
        return $this->registeredby;
    }

    /**
     * @param int $registeredby
     */
    public function setRegisteredby(int $registeredby): void
    {
        $this->registeredby = $registeredby;
    }


}