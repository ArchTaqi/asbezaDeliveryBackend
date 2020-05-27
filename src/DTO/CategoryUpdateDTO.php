<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/9/2019
 * Time: 8:57 AM
 */

namespace App\DTO;


class CategoryUpdateDTO
{
    /**
     * @var int
     *
     */
    private $catId;
    /**
     * @var string
     *
     */
    private $catName;

    /**
     * @var string|null
     *
     */
    private $catDescription;

    /**
     * @var string
     *
     */
    private $catCode;


    /**
     * CategoryUpdateDTO constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getCatId(): int
    {
        return $this->catId;
    }

    /**
     * @param int $catId
     */
    public function setCatId(int $catId): void
    {
        $this->catId = $catId;
    }

    /**
     * @return string
     */
    public function getCatName(): string
    {
        return $this->catName;
    }

    /**
     * @param string $catName
     */
    public function setCatName(string $catName): void
    {
        $this->catName = $catName;
    }

    /**
     * @return null|string
     */
    public function getCatDescription(): ?string
    {
        return $this->catDescription;
    }

    /**
     * @param null|string $catDescription
     */
    public function setCatDescription(?string $catDescription): void
    {
        $this->catDescription = $catDescription;
    }

    /**
     * @return string
     */
    public function getCatCode(): string
    {
        return $this->catCode;
    }

    /**
     * @param string $catCode
     */
    public function setCatCode(string $catCode): void
    {
        $this->catCode = $catCode;
    }

}