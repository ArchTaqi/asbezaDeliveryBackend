<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;

/**
 * Sellcreditpayment
 *
 * @ORM\Table(name="sellcreditpayment", indexes={@ORM\Index(name="sellCredit", columns={"sellCredit"}), @ORM\Index(name="registeredBy", columns={"registeredBy"})})
 * @ORM\Entity
 *
 * @NamedQueries({
 *     @NamedQuery(name="paidCreditsById", query="SELECT DISTINCT s FROM App\Entity\Sellcreditpayment s WHERE s.sellcredit = :sellCreditId")
 * })
 *
 */
class Sellcreditpayment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="paid_amount", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $paidAmount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="regDate", type="date", nullable=false)
     */
    private $regdate;

    /**
     * @var string
     *
     * @ORM\Column(name="regEtDate", type="string", length=250, nullable=false)
     */
    private $regetdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_time", type="time", nullable=false)
     */
    private $orderTime;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registeredBy", referencedColumnName="id")
     * })
     */
    private $registeredby;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status", referencedColumnName="id")
     * })
     */
    private $status;

    /**
     * @var \Sellcredit
     *
     * @ORM\ManyToOne(targetEntity="Sellcredit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sellCredit", referencedColumnName="id")
     * })
     */
    private $sellcredit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaidAmount()
    {
        return $this->paidAmount;
    }

    public function setPaidAmount($paidAmount): self
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    public function getRegdate(): ?\DateTimeInterface
    {
        return $this->regdate;
    }

    public function setRegdate(\DateTimeInterface $regdate): self
    {
        $this->regdate = $regdate;

        return $this;
    }

    public function getRegetdate(): ?string
    {
        return $this->regetdate;
    }

    public function setRegetdate(string $regetdate): self
    {
        $this->regetdate = $regetdate;

        return $this;
    }

    public function getOrderTime(): ?\DateTimeInterface
    {
        return $this->orderTime;
    }

    public function setOrderTime(\DateTimeInterface $orderTime): self
    {
        $this->orderTime = $orderTime;

        return $this;
    }

    public function getRegisteredby(): ?User
    {
        return $this->registeredby;
    }

    public function setRegisteredby(?User $registeredby): self
    {
        $this->registeredby = $registeredby;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }


    public function getSellcredit(): ?Sellcredit
    {
        return $this->sellcredit;
    }

    public function setSellcredit(?Sellcredit $sellcredit): self
    {
        $this->sellcredit = $sellcredit;

        return $this;
    }


}
