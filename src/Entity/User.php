<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * StockUser
 *
 * @ORM\Table(name="stockUser", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"firstname", "lastname", "phoneNumber"}), @ORM\UniqueConstraint(name="username", columns={"username"})}, indexes={@ORM\Index(name="status", columns={"status"}), @ORM\Index(name="company", columns={"company"}), @ORM\Index(name="role", columns={"role"})})
 * @ORM\Entity
 *
 * @NamedQueries({
 *     @NamedQuery(name="usersByCompany", query="SELECT u FROM App\Entity\User u WHERE u.branch = :companyId"),
 *     @NamedQuery(name="findByUsername", query="SELECT u FROM App\Entity\User u WHERE u.regnum = :regnum")
 * })
 */
class User implements UserInterface
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
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=20, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, nullable=false)
     */
    private $username;

    /**
     * @var string
     * /**
     * @var string The hashed password
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
     * @var string|null
     *
     * @ORM\Column(name="notificationToken", type="string", length=1000, nullable=true)
     */
    private $notificationtoken;
    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch", referencedColumnName="id")
     * })
     */
    private $branch;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
    * @see UserInterface
    */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    /**
    * @see UserInterface
    */
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
    public function getNotificationtoken(): ?string
    {
        return $this->notificationtoken;
    }

    public function setNotificationtoken(?string $notificationtoken): self
    {
        $this->notificationtoken = $notificationtoken;

        return $this;
    }
    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): self
    {
        $this->branch = $branch;

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


    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [$this->role->getDescription()];
    }
}
