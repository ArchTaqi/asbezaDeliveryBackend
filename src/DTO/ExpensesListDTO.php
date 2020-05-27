<?php


namespace App\DTO;


class ExpensesListDTO
{

    /**
     * @var int
     *
     */
    private $id;
    /**
     * @var string
     */
    private $expenseReason;
    /**
     * @var string
     */
    private $expenseAmount;
    /**
     * @var string
     */
    private $userName;
    /**
     * @var string
     */
    private $userRole;
    /**
     * @var string
     */
    private $registrationDate;
    /**
     * @var string
     */
    private $registrationTime;

    /**
     * ExpensesListDTO constructor.
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
    public function getExpenseReason(): string
    {
        return $this->expenseReason;
    }

    /**
     * @param string $expenseReason
     */
    public function setExpenseReason(string $expenseReason): void
    {
        $this->expenseReason = $expenseReason;
    }

    /**
     * @return string
     */
    public function getExpenseAmount(): string
    {
        return $this->expenseAmount;
    }

    /**
     * @param string $expenseAmount
     */
    public function setExpenseAmount(string $expenseAmount): void
    {
        $this->expenseAmount = $expenseAmount;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserRole(): string
    {
        return $this->userRole;
    }

    /**
     * @param string $userRole
     */
    public function setUserRole(string $userRole): void
    {
        $this->userRole = $userRole;
    }

    /**
     * @return string
     */
    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    /**
     * @param string $registrationDate
     */
    public function setRegistrationDate(string $registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }

    /**
     * @return string
     */
    public function getRegistrationTime(): string
    {
        return $this->registrationTime;
    }

    /**
     * @param string $registrationTime
     */
    public function setRegistrationTime(string $registrationTime): void
    {
        $this->registrationTime = $registrationTime;
    }



}