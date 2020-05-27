<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/28/2019
 * Time: 3:21 AM
 */

namespace App\DTO;


class StockExpenseResponseDTO
{
    /**
     * @var StockExpenseListDTO[]
     *
     */
    private $stockExpenseList;

    /**
     * @var double|null
     *
     */
    private $totalAmount;

    /**
     * StockExpenseResponseDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return StockExpenseListDTO[]
     */
    public function getStockExpenseList(): array
    {
        return $this->stockExpenseList;
    }

    /**
     * @param StockExpenseListDTO[] $stockExpenseList
     */
    public function setStockExpenseList(array $stockExpenseList): void
    {
        $this->stockExpenseList = $stockExpenseList;
    }

    /**
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    /**
     * @param float|null $totalAmount
     */
    public function setTotalAmount(?float $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }


}