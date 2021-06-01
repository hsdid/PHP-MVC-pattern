<?php

namespace app\model;

/**
 * Class Category
 * @package app\model
 */
class Category
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    public static string $tableName = 'category';

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
    public function setId(int $id)
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
    public function setName(string $name)
    {
        $this->name = $name;
    }
}
