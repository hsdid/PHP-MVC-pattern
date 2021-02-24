<?php
namespace app\repository;

use app\core\Application;
use app\core\RepositoryInterface;
use app\model\User;
use app\model\Article;

class userRepository implements RepositoryInterface
{
    private $userTable;
    private $articleTable;
    private $pdo;

    
    /**
     * @var categoryRepository
     */
    private $categoryRepository;


    public function __construct()
    {
        $this->userTable          = User::$tableName;
        $this->articleTable       = Article::$tableName;
        $this->pdo                = Application::$app->db->pdo;
        $this->categoryRepository = new categoryRepository();
    }

    public function create($user)
    {
        $table = $this->userTable;

        $name     = $user->getName();
        $email    = $user->getEmail();
        $password = $user->getPassword();
        
        $sql = "INSERT INTO $table (name, email, password) VALUES (?,?,?)";

        $this->pdo->prepare($sql)->execute([$name,$email,$password]);
        return $user;
    }

    public function findAll()
    {
        $results = array();
        $table = $this->userTable;
        $sql = "SELECT * FROM  $table";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        
        while ($user = $stmt->fetchObject(User::class)) {
            array_push($results, $user);
        }
       
        return $results;
    }

   
    public function findOne($field, $data): User
    {
        $table = $this->userTable;
        

        $sql  = "SELECT * from $table WHERE `$field`=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data]);

        return $stmt->fetchObject(User::class);
    }

    public function remove($user)
    {
        $userId = $user->getId;
        $table  = $this->userTable;

        $sql  = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        $stmt->fetchObject(User::class);

        return $stmt->fetchObject(User::class);
    }


    public function findArticles(User $user)
    {
        $results = array();
      
        $userId = $user->getId();
        $tableU = $this->userTable;
        $tableA = $this->articleTable;

        $sql = "SELECT * FROM $tableU as u JOIN $tableA as a ON u.id=a.userId WHERE u.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

       
        while ($article = $stmt->fetchObject(Article::class)) {
            $user = $this->findOne('id', $article->getUserId());
            $article->setUser($user);

            $category = $this->categoryRepository->findOne('id', $article->getCategoryId());
            $article->setCategory($category);

                
            array_push($results, $article);
        }

        return $results;
    }

    public function findPublicArticles(User $user)
    {
        $results = array();
      
        $userId = $user->getId();
        $tableU = $this->userTable;
        $tableA = $this->articleTable;

        $sql = "SELECT * FROM $tableU as u JOIN $tableA as a ON u.id=a.userId WHERE u.id = ? AND publicStatus=1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

       
        while ($article = $stmt->fetchObject(Article::class)) {
            $user = $this->findOne('id', $article->getUserId());
            $article->setUser($user);

            $category = $this->categoryRepository->findOne('id', $article->getCategoryId());
            $article->setCategory($category);

                
            array_push($results, $article);
        }

        return $results;
    }
}
