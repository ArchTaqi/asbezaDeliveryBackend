<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/10/2019
 * Time: 1:02 PM
 */

namespace App\DTO;


class LoginResponseDTO
{
    /**
     * @var boolean
     *
     */
    private $status;

    /**
     * @var string
     *
     */
    private $message;

    /**
     * @var string
     *
     */
    private $token;

    /**
     * LoginResponseDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }


}