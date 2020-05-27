<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 5:19 AM
 */

namespace App\DTO;


class BranchReportByDateRequestDTO
{

    /**
     * @var int
     *
     */
    private $branchId;
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
    public function getBranchId(): int
    {
        return $this->branchId;
    }

    /**
     * @param int $branchId
     */
    public function setBranchId(int $branchId): void
    {
        $this->branchId = $branchId;
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