<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 4:09 PM
 */

namespace App\DTO;


class CustomerRegistrationDTO
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
    private $username;

    /**
     * @var string
     *
     */
    private $password;

    /**
     * @var string
     *
     */
    private $phonenumber;

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
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }



}