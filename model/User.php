<?php
namespace app\model;


class User 
{
    private $id;
    private $name;
    private $email;
    private $password;
    // private $articles;
    public static $tableName = 'users';

    public function getId ():int 
    {
        return $this->id;
    }

    public function setId (int $id) 
    {
        $this->id = $id;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function setName (string $name) 
    {
        $this->name = $name;
    }

    public function getEmail ():string 
    {
        return $this->email;
    }

    public function setEmail (string $email)
    {
        $this->email = $email;
    }

    public function getPassword ():string 
    {
        return $this->password;
    }

    public function setPassword (string $password) 
    {
        $this->password = $password;
    }

    public function tableName():string 
    {
        return $this->tableName;
    }

    // public function getArticles():array
    // {
    //     return $this->articles;
    // }

    // public function setArticles(array $arr)
    // {
    //     $this->articles = $arr;
    // }

    

}   