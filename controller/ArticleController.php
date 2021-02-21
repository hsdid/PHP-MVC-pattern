<?php 

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Article;
use app\model\User;
use app\repository\articleRepository;
use app\repository\categoryRepository;
use app\repository\userRepository;
use GrahamCampbell\ResultType\Result;

class ArticleController extends Controller
{
    private $articleRepository;
    private $categoryRepository;

    public function __construct()
    {
        $this->articleRepository  = new articleRepository();
        $this->categoryRepository = new categoryRepository();
    }



    public function getArticles(Request $request, Response $response)
    {
        $articles = $this->articleRepository->findAll();
        $categories = $this->categoryRepository->findAll();

        return  $this->render('home',[
                        'articles'   => $articles,
                        'categories' => $categories
                    ]); 
    }


    public function getCategoryProduct(Request $request, Response $response) 
    {
        $body = $request->getBody();
        
        $articles = $this->articleRepository->findCategoryById($body['categoryId']);
        $categories = $this->categoryRepository->findAll();
        
        return $this->render('home', [
                        'articles'   => $articles,
                        'categories' => $categories
                    ]);
    }

   


    public function createArticle(Request $request, Response $response)
    {   
       
        if (! Application::$app->isLogged()){
            $response->redirect('/login');
        }

        if ($request->getMethod() === 'get') {
            $categories = $this->categoryRepository->findAll();
        }
        

        if ($request->getMethod() === 'post'){

            //TODO validate data
            $body = $request->getBody();
            
            $categoryId  = $body['categoryId'];
            $title       = $body['title'];
            $description = $body['description'];

            $userId  = Application::$app->session->get('user');
           
            $article = new Article();
            $article->setCategoryId($categoryId);
            $article->setUserId($userId);
            $article->setTitle($title);
            $article->setDescription($description);

            if ($this->articleRepository->create($article)) {
                
                $response->redirect('/dashboard');
            }
        }

        return $this->render('article/new', ['categories' => $categories]);
    }


    public function editArticle(Request $request, Response $response) 
    {   
        if (! Application::$app->isLogged()){
            $response->redirect('/login');
        }
        
        if ($request->getMethod() === 'get') {

            $body        = $request->getBody();

            $article     = $this->articleRepository->findOne('id', $body['articleId']);
           

            if (! (Application::$app->session->get('user') === $article->getUserId())) {
                return "you cant edit this article";
            }

            $categories = $this->categoryRepository->findAll();
        }


        if ($request->getMethod() === 'post') {
            

            $articleId = $_GET['articleId'];
            $article = $this->articleRepository->findOne('id', $articleId);

            $body = $request->getBody();
           
            $article->setCategoryId($body['categoryId']);
            $article->setTitle($body['title']);
            $article->setDescription($body['description']);
            
            $this->articleRepository->update($article);

            return $response->redirect('/dashboard');
        }
    
        return $this->render('article/edit', [
                    'article'    => $article,
                    'categories' => $categories
                ]
            );    
        
    }

    public function deleteArticle(Request $request, Response $response) 
    {   
        $body = $request->getBody();

        $article = $this->articleRepository->findOne('id', $body['articleId']);

        if (! (Application::$app->session->get('user') === $article->getUserId())) {
            return "you cant delete this article";
        }

        $this->articleRepository->remove($article);
        
        $response->redirect('/dashboard');
    }
}