<?php

use app\controller\ArticleController;
use app\core\Application;
use app\controller\AuthController;

use app\controller\SiteController;
use app\controller\UserController;


require_once __DIR__.'/../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$dbConfig = [
    'dsn'  => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'pass' => $_ENV['DB_PASSWORD']
];


$app = new Application($dbConfig);


$app->router->get('/', [ArticleController::class, 'getArticles']);

$app->router->get('/user',[UserController::class, 'getUser']);

$app->router->get('/article/edit',[ArticleController::class, 'editArticle']);
$app->router->post('/article/edit',[ArticleController::class, 'editArticle']);

$app->router->get('/dashboard', [SiteController::class, 'dashboard']);
$app->router->get('/dashboard/category', [SiteController::class, 'getUserCategoryProducts']);

$app->router->get('/article',[ArticleController::class, 'createArticle']);
$app->router->post('/article',[ArticleController::class, 'createArticle']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/logout', [AuthController::class, 'logout']);


$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->router->get('/article/category', [ArticleController::class, 'getCategoryProduct']);
$app->router->post('/article/category', [ArticleController::class, 'getCategoryProduct']);

$app->router->get('/article/remove', [ArticleController::class, 'deleteArticle']);

$app->run();
    
