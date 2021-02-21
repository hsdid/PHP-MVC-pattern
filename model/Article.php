<?php

namespace app\model;

use DateTime;

class Article 
{
    private $id;
    private $categoryId;
    private $userId;
    private $title;
    private $description;
    private $created_at;
    private $user;
    private $category;
    public static $tableName = 'articles';
    

    public function getId (): ?int 
    {
        return $this->id;
    }

    public function setId (int $id)
    {
        $this->id = $id;
    }
    public function getCategoryId (): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId (int $id)
    {
        $this->categoryId = $id;
    }
    public function getUserId (): ?int 
    {
        return $this->userId;
    }

    public function setUserId (int $id)
    {
        $this->userId = $id;
    }
    public function getTitle () : string
    {
        return $this->title;
    }

    public function setTitle (string $title)
    {
        $this->title = $title;
    }
    public function getDescription (): string
    {
        return $this->description;
    }

    public function setDescription (string $desc)
    {
        $this->description = $desc;
    }

    public function getCreatedAt()
    {   
        return $this->created_at;
    }

    public function setCreatedAt (\DateTime $date)
    {
        $this->created_at = $date;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
    }


}