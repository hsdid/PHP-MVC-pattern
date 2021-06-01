<?php

namespace app\repository;

use app\core\Application;
use app\core\RepositoryInterface;
use app\model\Article;
use app\model\User;

/**
 * Class articleRepository
 * @package app\repository
 */
class articleRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    private $articleTable;
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var userRepository
     */
    private $userRepository;
    /**
     * @var categoryRepository
     */
    private $categoryRepository;

    /**
     * articleRepository constructor.
     */
    public function __construct()
    {
        $this->userTable          = User::$tableName;
        $this->articleTable       = Article::$tableName;
        $this->pdo                = Application::$app->db->pdo;
        $this->categoryRepository = new categoryRepository();
        $this->userRepository     = new userRepository();
    }

    /**
     * @param $field
     * @param $data
     * @return Article|bool
     */
    public function findOne($field, $data)
    {
        $table = $this->articleTable;

        $sql = "SELECT * from $table WHERE `$field`=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data]);

        $article = $stmt->fetchObject(Article::class);
        if (!$article) {
            return false;
        }
        $user = $this->userRepository->findOne('id', $article->getUserId());
        $article->setUser($user);

        $category = $this->categoryRepository->findOne('id', $article->getCategoryId());
        $article->setCategory($category);

        return $article;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $results = array();
        $tableA = $this->articleTable;

        $sql = "SELECT * FROM  $tableA";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        

        while ($article = $stmt->fetchObject(Article::class)) {
            $userId = $article->getUserId();
            $user = $this->userRepository->findOne('id', $userId);
            $article->setUser($user);

            $categoryId = $article->getCategoryId();
            $category = $this->categoryRepository->findOne('id', $categoryId);
            $article->setCategory($category);

            array_push($results, $article);
        }
       
        return $results;
    }

    /**
     * @param $category
     * @return array
     */
    public function findCategoryPublicArticles($category): array
    {   
        $results = array();
        $table = $this->articleTable;

        if ($category === 'all') {
            $sql = "SELECT * FROM $table WHERE publicStatus=1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

        } else {
            $sql = "SELECT * FROM $table WHERE categoryId=? AND publicStatus=1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$category]);
        }

        while ($article = $stmt->fetchObject(Article::class)) {
            $userId = $article->getUserId();
            $user = $this->userRepository->findOne('id', $userId);
            $article->setUser($user);

            $categoryId = $article->getCategoryId();
            $category = $this->categoryRepository->findOne('id', $categoryId);
            $article->setCategory($category);

            array_push($results, $article);
        }

        return $results;
    }

    /**
     * @param $category
     * @param $user
     * @return array
     */
    public function findUserCategoryArticles($category, $user): array
    {
        $results = array();
        $table = $this->articleTable;

        if ($category === 'all') {
            $sql = "SELECT * FROM $table WHERE userId=?" ;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user]);
        } else {
            $sql = "SELECT * FROM $table WHERE categoryId=? AND userId=?" ;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$category, $user]);
        }

        while ($article = $stmt->fetchObject(Article::class)) {
            $userId = $article->getUserId();
            $user = $this->userRepository->findOne('id', $userId);
            $article->setUser($user);

            $categoryId = $article->getCategoryId();
            $category = $this->categoryRepository->findOne('id', $categoryId);
            $article->setCategory($category);

            array_push($results, $article);
        }

        return $results;
    }

    /**
     * @param $article
     * @return Article
     */
    public function create($article)
    {
        $table = $this->articleTable;

        $categoryId  = $article->getCategoryId();
        $userId      = $article->getUserId();
        $title       = $article->getTitle();
        $description = $article->getDescription();
        
        
        $sql = "INSERT INTO $table (categoryId, userId, title, description)
        VALUES (?,?,?,?)";

        $this->pdo->prepare($sql)->execute([$categoryId, $userId, $title, $description]);
        
        return $article;
    }

    /**
     * @param Article $article
     * @return bool
     */
    public function update(Article $article)
    {
        $table  = $this->articleTable;

        $articleId   = $article->getId();
        $categoryId  = $article->getCategoryId();
        $title       = $article->getTitle();
        $description = $article->getDescription();

        $sql  = "UPDATE $table SET categoryId=?, title=?, description=? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$categoryId, $title, $description, $articleId]);
    }

    /**
     * @param $status
     * @param $articleId
     * @return bool
     */
    public function updateStatus($status, $articleId)
    {
        $table  = $this->articleTable;

        $sql  = "UPDATE $table SET publicStatus=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([$status, $articleId]);
    }

    /**
     * @param $article
     * @return bool|null
     */
    public function remove($article)
    {
        if (!$article) {
            return null;
        }
        $articleId = $article->getId();
        $table     = $this->articleTable;
        
        $sql  = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return  $stmt->execute([$articleId]);
    }
}
