<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2019
 * Time: 4:51 PM
 */

namespace App\DTO;


class AuthenticationRequestDTO
{
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
     * AuthenticationRequestDTO constructor.
     */
    public function __construct()
    {
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