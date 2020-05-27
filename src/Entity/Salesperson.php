<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salesperson
 *
 * @ORM\Table(name="salesPerson", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"user"})}, indexes={@ORM\Index(name="status", columns={"status"}), @ORM\Index(name="registeredBy", columns={"registeredBy"}), @ORM\Index(name="user", columns={"user"})})
 * @ORM\Entity
 */
class Salesperson
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
     * @ORM\Column(name="agreement", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $agreement;

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
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Managementusers
     *
     * @ORM\ManyToOne(targetEntity="Managementusers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registeredBy", referencedColumnName="id")
     * })
     */
    private $registeredby;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgreement()
    {
        return $this->agreement;
    }

    public function setAgreement($agreement): self
    {
        $this->agreement = $agreement;

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

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRegisteredby(): ?Managementusers
    {
        return $this->registeredby;
    }

    public function setRegisteredby(?Managementusers $registeredby): self
    {
        $this->registeredby = $registeredby;

        return $this;
    }


}
