<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;

/**
 * StockExpense
 *
 * @ORM\Table(name="stock_expense", indexes={@ORM\Index(name="registeredBy", columns={"registeredBy"})})
 * @ORM\Entity
 * @NamedQueries({
 *     @NamedQuery(name="dailyExpenses", query="SELECT DISTINCT e FROM App\Entity\StockExpense e WHERE e.regdate >= :startDate AND e.regdate<= :endDate")
 * })
 */
class StockExpense
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
     * @ORM\Column(name="expence", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $expence;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reason", type="string", length=255, nullable=true)
     */
    private $reason;

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
     * @ORM\Column(name="regTime", type="time", nullable=false)
     */
    private $regtime;


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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpence()
    {
        return $this->expence;
    }

    public function setExpence($expence): self
    {
        $this->expence = $expence;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

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

    public function getRegtime(): ?\DateTimeInterface
    {
        return $this->regtime;
    }

    public function setRegtime(\DateTimeInterface $regtime): self
    {
        $this->regtime = $regtime;

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

}
