<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Article;
use app\services\Container;
use app\validation\ArticleValidation;

/**
 * Class ArticleController
 * @package app\controller
 */
class ArticleController extends Controller
{
    /** @var articleRepository  */
    private $articleRepository;

    /** @var categoryRepository  */
    private $categoryRepository;

     /** @var AuthorVoter  */
    private $authorVoter;

    /** @var Container */
    private $container;

    /**
     * ArticleController constructor.
     * @param Container $container
     * @throws \Exception
     */
    public function __construct(Container $container)
    {   
        $this->container          = $container;
        $this->articleRepository  = $this->container->get('articleRepository');
        $this->categoryRepository = $this->container->get('categoryRepository');
        $this->authorVoter        = $this->container->get('authorVoter');
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function getCategoryPublicArticles(Request $request, Response $response)
    {
        $body = $request->getBody();

        if (! isset($body['categoryId'])){
            $articles = $this->articleRepository->findCategoryPublicArticles('all');
           
        } else {
            $articles = $this->articleRepository->findCategoryPublicArticles($body['categoryId']);
        }

        $categories = $this->categoryRepository->findAll();
        
        return $this->render('home', [
                        'articles'   => $articles,
                        'categories' => $categories
                    ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function createArticle(Request $request, Response $response)
    {
        if (! Application::$app->isLogged()) {
            return $response->redirect('/login');
        }

        $categories = $this->categoryRepository->findAll();

        if ($request->getMethod() === 'post') {
            $body = $request->getBody();

            if (! ArticleValidation::Article($body)) {
                return $response->redirect('/article');
            }

            $article = $this->articleRepository->findOne('title', $body['title']);

            if ($article) {
                Application::$app->session->setFlash('error_article', 'Same titile already exist');
                return $response->redirect('/article');
            }

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
                Application::$app->session->remove('error_article');
            }
            return $response->redirect('/dashboard');
        }
        return $this->render('/article/new', ['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function editArticle(Request $request, Response $response)
    {
        if (! Application::$app->isLogged()) {
            return $response->redirect('/login');
        }
        if ($request->getMethod() === 'get') {

            $body    = $request->getBody();
            $article = $this->articleRepository->findOne('id', $body['articleId']);

            if (!$this->authorVoter->belongToUser($article)) {
                Application::$app->session->setFlash('error_dashboard', 'Cant edit this article');
                return $response->redirect('/dashboard');
            }
            $categories = $this->categoryRepository->findAll();
        }

        if ($request->getMethod() === 'post') {
            $articleId = $_GET['articleId'];
            $article = $this->articleRepository->findOne('id', $articleId);

            $body = $request->getBody();

            if (! ArticleValidation::Article($body)) {
                return $response->redirect('/');
            }
            
            $article->setCategoryId($body['categoryId']);
            $article->setTitle($body['title']);
            $article->setDescription($body['description']);
            $this->articleRepository->update($article);

            Application::$app->session->remove('error_dashboard');
            return $response->redirect('/dashboard');
        }
    
        return $this->render(
            'article/edit',
                [
                    'article'    => $article,
                    'categories' => $categories
                ]
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function updateStatus(Request $request, Response $response)
    {
        $body = $request->getBody();
        $articleId = $body['articleId'];
        $status    = $body['status'];

        $this->articleRepository->updateStatus($status, $articleId);
        $response->redirect('/dashboard');
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function deleteArticle(Request $request, Response $response)
    {
        if (! Application::$app->isLogged()) {
            return $response->redirect('/login');
        }

        $body = $request->getBody();

        $article = $this->articleRepository->findOne('id', $body['articleId']);

        if (!$this->authorVoter->belongToUser($article)) {

            Application::$app->session->setFlash('error_dashboard', 'Cant remove this article');
            return $response->redirect('/dashboard');
        }

        $this->articleRepository->remove($article);

        Application::$app->session->remove('error_dashboard');
        return $response->redirect('/dashboard');
    }
}
