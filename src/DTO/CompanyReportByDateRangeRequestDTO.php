<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 12:47 PM
 */

namespace App\DTO;


class CompanyReportByDateRangeRequestDTO
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
    private $reportStartDate;

    /**
     * @var string
     *
     */
    private $reportEndDate;

    /**
     * BranchReportByDateRangeRequestDTO constructor.
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
    public function getReportStartDate(): string
    {
        return $this->reportStartDate;
    }

    /**
     * @param string $reportStartDate
     */
    public function setReportStartDate(string $reportStartDate): void
    {
        $this->reportStartDate = $reportStartDate;
    }

    /**
     * @return string
     */
    public function getReportEndDate(): string
    {
        return $this->reportEndDate;
    }

    /**
     * @param string $reportEndDate
     */
    public function setReportEndDate(string $reportEndDate): void
    {
        $this->reportEndDate = $reportEndDate;
    }


}