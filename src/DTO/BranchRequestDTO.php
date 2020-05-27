<?php


namespace App\DTO;


class BranchRequestDTO
{
    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string|null
     *
     */
    private $description;

    /**
     * @var int
     *
     *
     */
    private $status;

    /**
     * @var int
     *
     *
     */
    private $company;

    /**
     * BranchRequestDTO constructor.
     * @param string $name
     * @param null|string $description
     * @param int $status
     * @param string $regdate
     * @param int $company
     */
    public function __construct(){
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }


    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


    public function getStatus(): int
    {
        return $this->status;
    }


    public function setStatus(int $status): void
    {
        $this->status = $status;
    }


    public function getCompany(): int
    {
        return $this->company;
    }


    public function setCompany(int $company): void
    {
        $this->company = $company;
    }




}