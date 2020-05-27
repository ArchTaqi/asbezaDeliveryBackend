<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;

/**
 * Sellcredit
 *
 * @ORM\Table(name="sellcredit", indexes={@ORM\Index(name="orders", columns={"orders"}), @ORM\Index(name="registeredBy", columns={"registeredBy"})})
 * @ORM\Entity
 *
 *   @NamedQueries({
 *     @NamedQuery(name="sellCreditByOrder", query="SELECT DISTINCT s FROM App\Entity\Sellcredit s WHERE s.orders = :orderId")
 * })
 */
class Sellcredit
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
     * @var string
     *
     * @ORM\Column(name="orders", type="string", length=255, nullable=false)
     */
    private $orders;

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
     * @ORM\Column(name="remaining_amount", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $remainingAmount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="customer_name", type="string", length=255, nullable=true)
     */
    private $customerName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="customer_phone", type="string", length=255, nullable=true)
     */
    private $customerPhone;

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
     * @var \Stockuser
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
     * Sellcredit constructor.
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
    public function getOrders(): string
    {
        return $this->orders;
    }

    /**
     * @param string $orders
     */
    public function setOrders(string $orders): void
    {
        $this->orders = $orders;
    }

    /**
     * @return string|null
     */
    public function getTotalAmount(): ?string
    {
        return $this->totalAmount;
    }

    /**
     * @param string|null $totalAmount
     */
    public function setTotalAmount(?string $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return string|null
     */
    public function getPaidAmount(): ?string
    {
        return $this->paidAmount;
    }

    /**
     * @param string|null $paidAmount
     */
    public function setPaidAmount(?string $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }

    /**
     * @return string|null
     */
    public function getRemainingAmount(): ?string
    {
        return $this->remainingAmount;
    }

    /**
     * @param string|null $remainingAmount
     */
    public function setRemainingAmount(?string $remainingAmount): void
    {
        $this->remainingAmount = $remainingAmount;
    }

    /**
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    /**
     * @param string|null $customerName
     */
    public function setCustomerName(?string $customerName): void
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string|null
     */
    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    /**
     * @param string|null $customerPhone
     */
    public function setCustomerPhone(?string $customerPhone): void
    {
        $this->customerPhone = $customerPhone;
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
     * @return \User
     */
    public function getRegisteredby(): ?User
    {
        return $this->registeredby;
    }

    /**
     * @param \User $registeredby
     */
    public function setRegisteredby(?User $registeredby): void
    {
        $this->registeredby = $registeredby;
    }

    /**
     * @return \Status
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * @param \Status $status
     */
    public function setStatus(?Status $status): void
    {
        $this->status = $status;
    }



}
