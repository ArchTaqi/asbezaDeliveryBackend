<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/17/2019
 * Time: 8:41 AM
 */

namespace App\DTO;


class UserRegistrationAproveDTO
{
    /**
     * @var string
     *
     */
    private $registrationNumber;

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
     * UserRegistrationAproveDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    /**
     * @param string $registrationNumber
     */
    public function setRegistrationNumber(string $registrationNumber): void
    {
        $this->registrationNumber = $registrationNumber;
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