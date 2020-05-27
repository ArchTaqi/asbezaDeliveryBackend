<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;

/**
 * Item
 *
 * @ORM\Table(name="item", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name", "category"})}, indexes={@ORM\Index(name="itemStatus", columns={"itemStatus"}), @ORM\Index(name="category", columns={"category"}), @ORM\Index(name="registeredBy", columns={"registeredBy"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="measueingUnit", columns={"measueingUnit"})})
 * @ORM\Entity
 *
 * @NamedQueries({
 *     @NamedQuery(name="itemByCategory", query="SELECT DISTINCT i FROM App\Entity\Item i WHERE i.category = :categoryId")
 * })
 */
class Item
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
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=250, nullable=false)
     */
    private $brand;

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
     * @var string|null
     *
     * @ORM\Column(name="updateDate", type="string", length=250, nullable=true)
     */
    private $updatedate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picturePath", type="string", length=250, nullable=true)
     */
    private $picturepath;

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
     * @var \Itemstatus
     *
     * @ORM\ManyToOne(targetEntity="Itemstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="itemStatus", referencedColumnName="id")
     * })
     */
    private $itemstatus;

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
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Measuringunit
     *
     * @ORM\ManyToOne(targetEntity="Measuringunit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="measuringUnit", referencedColumnName="id")
     * })
     */
    private $measuringunit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

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

    public function getUpdatedate(): ?string
    {
        return $this->updatedate;
    }

    public function setUpdatedate(?string $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getPicturepath(): ?string
    {
        return $this->picturepath;
    }

    public function setPicturepath(?string $picturepath): self
    {
        $this->picturepath = $picturepath;

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

    public function getItemstatus(): ?Itemstatus
    {
        return $this->itemstatus;
    }

    public function setItemstatus(?Itemstatus $itemstatus): self
    {
        $this->itemstatus = $itemstatus;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
    public function getMeasuringunit(): ?Measuringunit
    {
        return $this->measuringunit;
    }

    public function setMeasuringunit(?Measuringunit $measuringunit): self
    {
        $this->measuringunit = $measuringunit;

        return $this;
    }

}
