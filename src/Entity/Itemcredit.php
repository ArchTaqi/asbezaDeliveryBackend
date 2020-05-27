<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itemcredit
 *
 * @ORM\Table(name="itemcredit", indexes={@ORM\Index(name="registeredBy", columns={"registeredBy"}), @ORM\Index(name="payment_status", columns={"payment_status"}), @ORM\Index(name="pricing", columns={"pricing"})})
 * @ORM\Entity
 */
class Itemcredit
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
     * @ORM\Column(name="total_amount", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $totalAmount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="paid_amount", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $paidAmount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remainig_amount", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $remainigAmount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="owner_name", type="string", length=250, nullable=true)
     */
    private $ownerName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="owner_phone", type="string", length=20, nullable=true)
     */
    private $ownerPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="paymentDate", type="string", length=20, nullable=true)
     */
    private $paymentdate;

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
     * @var \Paymentstatus
     *
     * @ORM\ManyToOne(targetEntity="Paymentstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_status", referencedColumnName="id")
     * })
     */
    private $paymentStatus;

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
     * @var \Pricing
     *
     * @ORM\ManyToOne(targetEntity="Pricing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pricing", referencedColumnName="id")
     * })
     */
    private $pricing;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
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

    public function getRemainigAmount()
    {
        return $this->remainigAmount;
    }

    public function setRemainigAmount($remainigAmount): self
    {
        $this->remainigAmount = $remainigAmount;

        return $this;
    }

    public function getOwnerName(): ?string
    {
        return $this->ownerName;
    }

    public function setOwnerName(?string $ownerName): self
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    public function getOwnerPhone(): ?string
    {
        return $this->ownerPhone;
    }

    public function setOwnerPhone(?string $ownerPhone): self
    {
        $this->ownerPhone = $ownerPhone;

        return $this;
    }

    public function getPaymentdate(): ?string
    {
        return $this->paymentdate;
    }

    public function setPaymentdate(?string $paymentdate): self
    {
        $this->paymentdate = $paymentdate;

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

    public function getPaymentStatus(): ?Paymentstatus
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(?Paymentstatus $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

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

    public function getPricing(): ?Pricing
    {
        return $this->pricing;
    }

    public function setPricing(?Pricing $pricing): self
    {
        $this->pricing = $pricing;

        return $this;
    }


}
