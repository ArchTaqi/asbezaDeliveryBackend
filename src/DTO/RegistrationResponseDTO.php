<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/17/2019
 * Time: 6:40 AM
 */

namespace App\DTO;


class RegistrationResponseDTO
{

    /**
     * @var boolean
     *
     */
    private $status;
    /**
     * @var int
     *
     */
    private $userId;
    /**
     * @var string
     *
     */
    private $fullName;
    /**
     * @var int
     *
     */
    private $companyId;

    /**
     * @var string
     *
     */
    private $companyName;

    /**
     * @var int
     *
     */
    private $roleId;

    /**
     * @var int |null
     *
     */
    private $branch;
    /**
     * @var String |null
     *
     */
    private $token;

    /**
     * RegistrationResponseDTO constructor.
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
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
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    /**
     * @param int $companyId
     */
    public function setCompanyId(int $companyId): void
    {
        $this->companyId = $companyId;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
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
     * @return null|int
     */
    public function getBranch(): ?int
    {
        return $this->branch;
    }

    /**
     * @param null|String $branch
     */
    public function setBranch(?String $branch): void
    {
        $this->branch = $branch;
    }

    /**
     * @return null|String
     */
    public function getToken(): ?String
    {
        return $this->token;
    }

    /**
     * @param null|String $token
     */
    public function setToken(?String $token): void
    {
        $this->token = $token;
    }



}