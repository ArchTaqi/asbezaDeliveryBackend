<?php


namespace App\DTO;


class BranchResponseDTO
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
     * @var string|null
     *
     */
    private $description;

    /**
     * @var int
     *
     *
     */
    private $statusId;

    /**
     * @var string
     *
     *
     */
    private $statusName;

    /**
     * @var \DateTime | null
     *
     *
     */
    private $regdate;

    /**
     * @var string
     *
     *
     */
    private $regEtdate;

    /**
     * @var int
     *
     *
     */
    private $companyId;

    /**
     * @var string
     *
     *
     */
    private $companyName;

    /**
     * BranchResponseDTO constructor.
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
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
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
     * @return \DateTime|null
     */
    public function getRegdate(): ?\DateTime
    {
        return $this->regdate;
    }

    /**
     * @param \DateTime|null $regdate
     */
    public function setRegdate(?\DateTime $regdate): void
    {
        $this->regdate = $regdate;
    }


    /**
     * @return string
     */
    public function getRegEtdate(): string
    {
        return $this->regEtdate;
    }

    /**
     * @param string $regEtdate
     */
    public function setRegEtdate(string $regEtdate): void
    {
        $this->regEtdate = $regEtdate;
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


}