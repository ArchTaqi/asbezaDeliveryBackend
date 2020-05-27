<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/23/2019
 * Time: 7:32 AM
 */

namespace App\DTO;


class CompanyReportByDateRequestDTO
{
    /**
     * @var int
     *
     */
    private $companyId;
    /**
     * @var string
     *
     */
    private $reportDate;

    /**
     * BranchReportByDateRequestDTO constructor.
     */
    public function __construct()
    {
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
    public function getReportDate(): string
    {
        return $this->reportDate;
    }

    /**
     * @param string $reportDate
     */
    public function setReportDate(string $reportDate): void
    {
        $this->reportDate = $reportDate;
    }







}