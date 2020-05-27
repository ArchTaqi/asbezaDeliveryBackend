<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 2:16 PM
 */

namespace App\DTO;


class StockExpenseListDTO
{
    /**
     * @var int
     *
     */
    private $id;

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
     * @var \DateTime
     *
     */
    private $regtime;

    /**
     * @var int
     *
     */
    private $registerUserId;

    /**
     * @var string
     *
     */
    private $registerUserName;

    /**
     * StockExpenseListDTO constructor.
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
     * @return \DateTime
     */
    public function getRegtime(): \DateTime
    {
        return $this->regtime;
    }

    /**
     * @param \DateTime $regtime
     */
    public function setRegtime(\DateTime $regtime): void
    {
        $this->regtime = $regtime;
    }

    /**
     * @return int
     */
    public function getRegisterUserId(): int
    {
        return $this->registerUserId;
    }

    /**
     * @param int $registerUserId
     */
    public function setRegisterUserId(int $registerUserId): void
    {
        $this->registerUserId = $registerUserId;
    }

    /**
     * @return string
     */
    public function getRegisterUserName(): string
    {
        return $this->registerUserName;
    }

    /**
     * @param string $registerUserName
     */
    public function setRegisterUserName(string $registerUserName): void
    {
        $this->registerUserName = $registerUserName;
    }


}