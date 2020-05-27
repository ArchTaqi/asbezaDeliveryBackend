<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/21/2019
 * Time: 4:01 PM
 */

namespace App\DTO;


class ResponseDTO
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
     * ResponseDTO constructor.
     * @param bool $status
     * @param string $message
     */
    public function __construct(bool $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * ResponseDTO constructor.
     */


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


}