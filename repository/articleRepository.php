<?php

namespace app\repository;

use app\core\Application;
use app\core\RepositoryInterface;
use app\model\Article;
use app\model\User;

class articleRepository implements RepositoryInterface
{

    private $userTable;
    private $articleTable;
    private $pdo;
    private $userRepository;
    private $categoryRepository;

    public function __construct()
    {
        
        $this->userTable          = User::$tableName;
        $this->articleTable       = Article::$tableName;
        $this->pdo                = Application::$app->db->pdo;
        $this->categoryRepository = new categoryRepository();
        $this->userRepository     = new userRepository();

    }


    public function findOne($field, $data)
    {
        
        $table = $this->articleTable;

        $sql = "SELECT * from $table WHERE `$field`=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data]);

        $article = $stmt->fetchObject(Article::class);
        if(!$article) {
            return null;
        }
        $user = $this->userRepository->findOne('id',$article->getUserId());
        $article->setUser($user);

        $category = $this->categoryRepository->findOne('id', $article->getCategoryId()); 
        $article->setCategory($category);

        return $article;
      
    }
    
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

    public function findAllPublic() 
    {
        $results = array(); 
        $tableA = $this->articleTable;

        $sql = "SELECT * FROM  $tableA WHERE publicStatus=1";
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
    
    public function findCategoryPublicArticles($category)
    {   
        $results = array(); 
        $table = $this->articleTable;

        $sql = "SELECT * FROM $table WHERE categoryId=? AND publicStatus=1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$category]);

        //na litosc, foreach...
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

    public function findUserCategoryArticles($category, $user)
    {   
        $results = array(); 
        $table = $this->articleTable;

        $sql = "SELECT * FROM $table WHERE categoryId=? AND userId=?" ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$category, $user]);

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

    public function updateStatus($status, $articleId) 
    {
        $table  = $this->articleTable;

        $sql  = "UPDATE $table SET publicStatus=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([$status, $articleId]);

    }

    
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