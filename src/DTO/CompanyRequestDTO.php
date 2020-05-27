<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/20/2019
 * Time: 8:37 PM
 */

namespace App\DTO;


class CompanyRequestDTO
{

    /**
     * @var string
     *
     */
    private $companyName;

    /**
     * @var string
     *
     */
    private $description;


    /**
     * @var int
     *
     */
    private $registrationType;

    /**
     * @var string
     *
     */
    private $ownerFirstName;
    /**
     * @var string
     *
     */
    private $ownerLastName;
    /**
     * @var string
     *
     */
    private $ownerPhoneNumber;

    /**
     * CompanyRequestDTO constructor.
     */
    public function __construct()
    {
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getRegistrationType(): int
    {
        return $this->registrationType;
    }

    /**
     * @param int $registrationType
     */
    public function setRegistrationType(int $registrationType): void
    {
        $this->registrationType = $registrationType;
    }

    /**
     * @return string
     */
    public function getOwnerFirstName(): string
    {
        return $this->ownerFirstName;
    }

    /**
     * @param string $ownerFirstName
     */
    public function setOwnerFirstName(string $ownerFirstName): void
    {
        $this->ownerFirstName = $ownerFirstName;
    }

    /**
     * @return string
     */
    public function getOwnerLastName(): string
    {
        return $this->ownerLastName;
    }

    /**
     * @param string $ownerLastName
     */
    public function setOwnerLastName(string $ownerLastName): void
    {
        $this->ownerLastName = $ownerLastName;
    }

    /**
     * @return string
     */
    public function getOwnerPhoneNumber(): string
    {
        return $this->ownerPhoneNumber;
    }

    /**
     * @param string $ownerPhoneNumber
     */
    public function setOwnerPhoneNumber(string $ownerPhoneNumber): void
    {
        $this->ownerPhoneNumber = $ownerPhoneNumber;
    }


}