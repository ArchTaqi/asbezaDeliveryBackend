<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Managementusers
 *
 * @ORM\Table(name="managementUsers", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"firstname", "lastname", "phoneNumber"}), @ORM\UniqueConstraint(name="username", columns={"username"})}, indexes={@ORM\Index(name="role", columns={"role"}), @ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class Managementusers
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
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=20, nullable=false)
     */
    private $phonenumber;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=20, nullable=false)
     */
    private $password;

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
     * @var int
     *
     * @ORM\Column(name="regBy", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $regby;
    /**
     * @var string
     *
     * @ORM\Column(name="regNum", type="string", length=250, nullable=false)
     */
    private $regnum;
    /**
     * @var \Userrole
     *
     * @ORM\ManyToOne(targetEntity="Userrole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="id")
     * })
     */
    private $role;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getRegby(): ?int
    {
        return $this->regby;
    }

    public function setRegby(int $regby): self
    {
        $this->regby = $regby;

        return $this;
    }
    public function getRegnum(): ?string
    {
        return $this->regnum;
    }

    public function setRegnum(string $regnum): self
    {
        $this->regnum = $regnum;

        return $this;
    }

    public function getRole(): ?Userrole
    {
        return $this->role;
    }

    public function setRole(?Userrole $role): self
    {
        $this->role = $role;

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
