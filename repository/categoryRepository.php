<?php

namespace app\repository;

use app\core\Application;
use app\core\RepositoryInterface;
use app\model\Category;

class categoryRepository implements RepositoryInterface
{
    private $categoryTable;
    private $pdo;

    
    public function __construct()
    {
        $this->categoryTable = Category::$tableName;
        $this->pdo          = Application::$app->db->pdo;
    }


    public function findOne($field, $data)
    {
        $table = $this->categoryTable;

        $sql = "SELECT * from $table WHERE `$field`=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data]);

        $category = $stmt->fetchObject(Category::class);

        
        return $category;
    }


    public function findAll()
    {
        $results = array();
        $table = $this->categoryTable;
        $sql = "SELECT * FROM  $table";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        while ($category = $stmt->fetchObject(Category::class)) {
            array_push($results, $category);
        }
       
        return $results;
    }


    public function create($object)
    {
    }
    public function remove($object)
    {
    }
}
