<?php


namespace App\DTO;


use phpDocumentor\Reflection\File;

class CategoryRequestDTO
{
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
     * @var string|null
     *
     */
    private $pictureData;


    /**
     * CategoryRequestDTO constructor.
     */
    public function __construct()
    {
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
    public function getPictureData(): ?string
    {
        return $this->pictureData;
    }

    /**
     * @param string|null $pictureData
     */
    public function setPictureData(?string $pictureData): void
    {
        $this->pictureData = $pictureData;
    }



}
