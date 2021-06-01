<?php

namespace app\repository;

use app\core\Application;
use app\core\RepositoryInterface;
use app\model\Category;

/**
 * Class categoryRepository
 * @package app\repository
 */
class categoryRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    private string $categoryTable;
    /**
     * @var \PDO
     */
    private \PDO $pdo;

    
    public function __construct()
    {
        $this->categoryTable = Category::$tableName;
        $this->pdo          = Application::$app->db->pdo;
    }

    /**
     * @param $field
     * @param $data
     * @return Category
     */
    public function findOne($field, $data)
    {
        $table = $this->categoryTable;

        $sql = "SELECT * from $table WHERE `$field`=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data]);

        $category = $stmt->fetchObject(Category::class);

        return $category;
    }

    /**
     * @return array
     */
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
