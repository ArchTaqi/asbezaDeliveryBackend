<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\NamedQuery;
use Doctrine\ORM\Mapping\NamedQueries;

/**
 * Branchuser
 *
 * @ORM\Table(name="BranchUser", indexes={@ORM\Index(name="branch", columns={"branch"}), @ORM\Index(name="stockUser", columns={"stockUser"})})
 * @ORM\Entity
 * @NamedQueries({
 *     @NamedQuery(name="branchUserById", query="SELECT u FROM App\Entity\Branchuser u WHERE u.user = :userId")
 * })
 */
class Branchuser
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
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch", referencedColumnName="id")
     * })
     */
    private $branch;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stockUser", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
