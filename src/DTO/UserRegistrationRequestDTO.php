<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 4:09 PM
 */

namespace App\DTO;


class UserRegistrationRequestDTO
{

    /**
     * @var string
     *
     */
    private $firstname;

    /**
     * @var string
     *
     */
    private $lastname;

    /**
     * @var string
     *
     */
    private $phonenumber;

    /**
     * @var int
     *
     */
    private $role;


    /**
     * @var int|null
     *
     */
    private $branch;

    /**
     * UserRegistrationRequestDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
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
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }


    /**
     * @return int|null
     */
    public function getBranch(): ?int
    {
        return $this->branch;
    }

    /**
     * @param int|null $branch
     */
    public function setBranch(?int $branch): void
    {
        $this->branch = $branch;
    }



}