<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/26/2019
 * Time: 6:08 PM
 */

namespace App\DTO;


class DefaultResponseDTO
{

    /**
     * @var int
     *

     */
    public $id;

    /**
     * @var string|null
     *
     */
    public $name;

    /**
     * @var string|null
     *
     */
    public $description;

    /**
     * defaultResponseDTO constructor.
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
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
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


}