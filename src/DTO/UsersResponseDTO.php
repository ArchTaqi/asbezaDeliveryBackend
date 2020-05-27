<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 4:10 PM
 */

namespace App\DTO;


class UsersResponseDTO
{

    /**
     * @var int
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $fullName;

    /**
     * @var string
     *
     */
    private $phonenumber;

    /**
     * @var string
     *
     */
    private $username;

    /**
     * @var \DateTime
     *
     */
    private $regdate;

    /**
     * @var string
     *
     */
    private $regetdate;

    /**
     * @var int
     *
     */
    private $registeredbyId;

    /**
     * @var string
     *
     */
    private $registeredbyName;

    /**
     * @var int
     */
    private $roleId;

    /**
     * @var string
     *
     */
    private $roleName;


    /**
     * UsersResponseDTO constructor.
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
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }


    /**
     * @return string
     */
    public function getPhonenumber(): string
    {
        return $this->phonenumber;
    }

    /**
     * @param string $phonenumber
     */
    public function setPhonenumber(string $phonenumber): void
    {
        $this->phonenumber = $phonenumber;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
     * @return int
     */
    public function getRegisteredbyId(): int
    {
        return $this->registeredbyId;
    }

    /**
     * @param int $registeredbyId
     */
    public function setRegisteredbyId(int $registeredbyId): void
    {
        $this->registeredbyId = $registeredbyId;
    }

    /**
     * @return string
     */
    public function getRegisteredbyName(): string
    {
        return $this->registeredbyName;
    }

    /**
     * @param string $registeredbyName
     */
    public function setRegisteredbyName(string $registeredbyName): void
    {
        $this->registeredbyName = $registeredbyName;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

    /**
     * @param string $roleName
     */
    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }


}