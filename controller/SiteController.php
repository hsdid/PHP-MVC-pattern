<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\repository\articleRepository;
use app\repository\categoryRepository;


class SiteController extends Controller
{
    /** @var categoryRepository  */
    private $categoryRepository;
    /** @var articleRepository  */
    private $articleRepository;

    public function __construct()
    {
        $this->categoryRepository = new categoryRepository();
        $this->articleRepository  = new articleRepository();
    }
    
    public function dashboard(Request $request, Response $response)
    {
        if (! Application::$app->isLogged()) {
            $response->redirect('/login');
        }

        $body = $request->getBody();
        $userId = Application::$app->session->get('user');

        if (! isset($body['categoryId'])) {
            $articles = $this->articleRepository->findUserCategoryArticles('all', $userId);
        } else {
            $articles = $this->articleRepository->findUserCategoryArticles($body['categoryId'], $userId);
        }

        $categories = $this->categoryRepository->findAll();

        return $this->render('dashboard', [
                'articles'   => $articles,
                'categories' => $categories
        ]);
    }
}
