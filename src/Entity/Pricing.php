<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;

/**
 * Pricing
 *
 * @ORM\Table(name="pricing", indexes={@ORM\Index(name="status", columns={"status"}), @ORM\Index(name="registeredBy", columns={"registeredBy"}), @ORM\Index(name="item", columns={"item"})})
 * @ORM\Entity
 *
 *  * @NamedQueries({
 *     @NamedQuery(name="pricingByItem", query="SELECT p FROM App\Entity\Pricing p WHERE p.item = :itemId"),
 *     @NamedQuery(name="pricingByCode", query="SELECT p FROM App\Entity\Pricing p WHERE p.itemCode = :itemCode")
 * })
 */
class Pricing
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
     * @ORM\Column(name="item_name", type="string", length=255, nullable=false)
     */
    private $itemName;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_price", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $unitPrice;

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
     * @var int|null
     *
     * @ORM\Column(name="isDefault", type="integer", nullable=true)
     */
    private $isDefault;

    /**
     * @var \Item
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item", referencedColumnName="id")
     * })
     */
    private $item;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registeredBy", referencedColumnName="id")
     * })
     */
    private $registeredby;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function setItemName(string $itemName): self
    {
        $this->itemName = $itemName;

        return $this;
    }

    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function setUnitPrice($unitPrice): self
    {
        $this->unitPrice = $unitPrice;

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

    /**
     * @return int|null
     */
    public function getIsDefault(): ?int
    {
        return $this->isDefault;
    }

    /**
     * @param int|null $isDefault
     */
    public function setIsDefault(?int $isDefault): void
    {
        $this->isDefault = $isDefault;
    }



    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

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

    public function getRegisteredby(): ?User
    {
        return $this->registeredby;
    }

    public function setRegisteredby(?User $registeredby): self
    {
        $this->registeredby = $registeredby;

        return $this;
    }


}
