<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\repository\articleRepository;
use app\repository\categoryRepository;
use app\repository\userRepository;

class SiteController extends Controller
{

    private $userRepository;
    private $categoryRepository;
    private $articleRepository;

    public function __construct()
    {   
        $this->userRepository     = new userRepository();
        $this->categoryRepository = new categoryRepository();
        $this->articleRepository  = new articleRepository();

    }
    
    public function dashboard(Request $request, Response $response)
    {   

        if (! Application::$app->isLogged()){
            $response->redirect('/login');
        }
        
        $userId       = Application::$app->session->get('user');
        $currentUser  = $this->userRepository->findOne('id', $userId);
        $articles     = $this->userRepository->findArticles($currentUser);

        
        $categories = $this->categoryRepository->findAll();


        return $this->render('dashboard', [
                'user'       => $currentUser,
                'articles'   => $articles,
                'categories' => $categories
        ]);
    }


    public function getUserCategoryProducts(Request $request, Response $response) 
    {   

        if (! Application::$app->isLogged()){
            $response->redirect('/login');
        }

        $body = $request->getBody();

        $userId       = Application::$app->session->get('user');
        $articles     = $this->articleRepository->findUserCategoryArticles($body['categoryId'], $userId);
        $categories   = $this->categoryRepository->findAll();
        

        return $this->render('dashboard', [
                        'articles'   => $articles,
                        'categories' => $categories
                    ]);
    }
    
}