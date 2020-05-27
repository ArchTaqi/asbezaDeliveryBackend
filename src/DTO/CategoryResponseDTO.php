<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/20/2019
 * Time: 9:18 PM
 */

namespace App\DTO;


class CategoryResponseDTO
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
    private $catName;

    /**
     * @var string|null
     *
     */
    private $catDescription;

    /**
     * @var string | null
     *
     */
    private $picturePath;

    /**
     * CategoryResponseDTO constructor.
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
     * @return string|null
     */
    public function getCatDescription(): ?string
    {
        return $this->catDescription;
    }

    /**
     * @param string|null $catDescription
     */
    public function setCatDescription(?string $catDescription): void
    {
        $this->catDescription = $catDescription;
    }

    /**
     * @return string|null
     */
    public function getPicturePath(): ?string
    {
        return $this->picturePath;
    }

    /**
     * @param string|null $picturePath
     */
    public function setPicturePath(?string $picturePath): void
    {
        $this->picturePath = $picturePath;
    }


}