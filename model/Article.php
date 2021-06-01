<?php

namespace app\model;

use DateTime;

/**
 * Class Article
 * @package app\model
 */
class Article
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $categoryId;
    /**
     * @var int
     */
    private int $userId;
    /**
     * @var string
     */
    private string $title;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var int
     */
    private int $publicStatus;

    private $created_at;
    /**
     * @var User
     */
    private User $user;
    /**
     * @var Category
     */
    private Category $category;

    /**
     * @var string
     */
    public static $tableName = 'articles';

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int $id
     */
    public function setCategoryId(int $id)
    {
        $this->categoryId = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $id
     */
    public function setUserId(int $id)
    {
        $this->userId = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $desc
     */
    public function setDescription(string $desc)
    {
        $this->description = $desc;
    }

    /**
     * @return int
     */
    public function getPublicStatus(): int
    {
        return $this->publicStatus;
    }

    /**
     * @param int $status
     */
    public function setPublicStatus(int $status)
    {
        $this->publicStatus = $status;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $date
     */
    public function setCreatedAt(\DateTime $date)
    {
        $this->created_at = $date;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }
}
