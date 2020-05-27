<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/20/2019
 * Time: 8:53 PM
 */

namespace App\DTO;


class CompanyResponseDTO
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
    private $name;

    /**
     * @var string
     *
     */
    private $description;

    /**
     * @var string
     *
     */
    private $regdate;

    /**
     * @var int
     *
     */
    private $registrationtypeId;

    /**
     * @var string
     *
     */
    private $registrationtypeName;

    /**
     * @var int
     *
     */
    private $statusId;

    /**
     * @var string
     *
     */
    private $statusName;

    /**
     * @var int
     *
     */
    private $salesId;

    /**
     * @var string
     *
     */
    private $salesName;

//    /**
//     * @var int|null
//     *
//     *
//     */
//    private $companyownerId;
//
//    /**
//     * @var string|null
//     *
//     *
//     */
//    private $companyownerName;


    /**
     * CompanyRequestDTO constructor.
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     * @return string
     */
    public function getRegdate(): string
    {
        return $this->regdate;
    }

    /**
     * @param string $regdate
     */
    public function setRegdate(string $regdate): void
    {
        $this->regdate = $regdate;
    }

    /**
     * @return int
     */
    public function getRegistrationtypeId(): int
    {
        return $this->registrationtypeId;
    }

    /**
     * @param int $registrationtypeId
     */
    public function setRegistrationtypeId(int $registrationtypeId): void
    {
        $this->registrationtypeId = $registrationtypeId;
    }

    /**
     * @return string
     */
    public function getRegistrationtypeName(): string
    {
        return $this->registrationtypeName;
    }

    /**
     * @param string $registrationtypeName
     */
    public function setRegistrationtypeName(string $registrationtypeName): void
    {
        $this->registrationtypeName = $registrationtypeName;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     */
    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return $this->statusName;
    }

    /**
     * @param string $statusName
     */
    public function setStatusName(string $statusName): void
    {
        $this->statusName = $statusName;
    }

    /**
     * @return int
     */
    public function getSalesId(): int
    {
        return $this->salesId;
    }

    /**
     * @param int $salesId
     */
    public function setSalesId(int $salesId): void
    {
        $this->salesId = $salesId;
    }

    /**
     * @return string
     */
    public function getSalesName(): string
    {
        return $this->salesName;
    }

    /**
     * @param string $salesName
     */
    public function setSalesName(string $salesName): void
    {
        $this->salesName = $salesName;
    }


}