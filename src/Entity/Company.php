<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;

/**
 * Company
 *
 * @ORM\Table(name="company", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})}, indexes={@ORM\Index(name="registrationType", columns={"registrationType"}), @ORM\Index(name="sales", columns={"sales"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="companyOwner", columns={"companyOwner"})})
 * @ORM\Entity
 *
 * @NamedQueries({
 *     @NamedQuery(name="companyBySales", query="SELECT DISTINCT c FROM App\Entity\Company c WHERE c.sales = :salesId")
 * })
 */
class Company
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
     * @var \Registrationtype
     *
     * @ORM\ManyToOne(targetEntity="Registrationtype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registrationType", referencedColumnName="id")
     * })
     */
    private $registrationtype;

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
     * @var \Managementusers
     *
     * @ORM\ManyToOne(targetEntity="Managementusers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sales", referencedColumnName="id")
     * })
     */
    private $sales;

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

    public function getRegistrationtype(): ?Registrationtype
    {
        return $this->registrationtype;
    }

    public function setRegistrationtype(?Registrationtype $registrationtype): self
    {
        $this->registrationtype = $registrationtype;

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

    public function getSales(): ?Managementusers
    {
        return $this->sales;
    }

    public function setSales(?Managementusers $sales): self
    {
        $this->sales = $sales;

        return $this;
    }


}
