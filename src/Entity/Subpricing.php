<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subpricing
 *
 * @ORM\Table(name="subPricing", indexes={@ORM\Index(name="status", columns={"status"}), @ORM\Index(name="measueingUnit", columns={"measueingUnit"}), @ORM\Index(name="registeredBy", columns={"registeredBy"}), @ORM\Index(name="pricing", columns={"pricing"})})
 * @ORM\Entity
 */
class Subpricing
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
     * @ORM\Column(name="subPricing_value", type="string", length=255, nullable=false)
     */
    private $subpricingValue;

    /**
     * @var string
     *
     * @ORM\Column(name="subPricing_price", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $subpricingPrice;

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
     * @var \Pricing
     *
     * @ORM\ManyToOne(targetEntity="Pricing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pricing", referencedColumnName="id")
     * })
     */
    private $pricing;

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
     * @var \Stockuser
     *
     * @ORM\ManyToOne(targetEntity="Stockuser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registeredBy", referencedColumnName="id")
     * })
     */
    private $registeredby;

    /**
     * @var \Measueingunit
     *
     * @ORM\ManyToOne(targetEntity="Measueingunit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="measueingUnit", referencedColumnName="id")
     * })
     */
    private $measueingunit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubpricingValue(): ?string
    {
        return $this->subpricingValue;
    }

    public function setSubpricingValue(string $subpricingValue): self
    {
        $this->subpricingValue = $subpricingValue;

        return $this;
    }

    public function getSubpricingPrice()
    {
        return $this->subpricingPrice;
    }

    public function setSubpricingPrice($subpricingPrice): self
    {
        $this->subpricingPrice = $subpricingPrice;

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

    public function getPricing(): ?Pricing
    {
        return $this->pricing;
    }

    public function setPricing(?Pricing $pricing): self
    {
        $this->pricing = $pricing;

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

    public function getRegisteredby(): ?Stockuser
    {
        return $this->registeredby;
    }

    public function setRegisteredby(?Stockuser $registeredby): self
    {
        $this->registeredby = $registeredby;

        return $this;
    }

    public function getMeasueingunit(): ?Measueingunit
    {
        return $this->measueingunit;
    }

    public function setMeasueingunit(?Measueingunit $measueingunit): self
    {
        $this->measueingunit = $measueingunit;

        return $this;
    }


}
