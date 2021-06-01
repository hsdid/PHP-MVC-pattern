<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\User;
use app\services\Container;
use app\validation\UserValidation;

/**
 * Class AuthController
 * @package app\controller
 */
class AuthController extends Controller
{
    /** @var userRepository  */
    private $userRepository;

    /** @var Container  */
    private $container;

    /**
     * AuthController constructor.
     * @param Container $container
     * @throws \Exception
     */
    public function __construct(Container $container)
    {   
        $this->container      = $container;
        $this->userRepository = $this->container->get('userRepository');
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function register(Request $request, Response $response)
    {
        if (Application::$app->isLogged()) {
            $response->redirect('/dashboard');
        }

        if ($request->getMethod() === 'post') {
            $body = $request->getBody();
            
            if (! UserValidation::register($body)) {
                return $response->redirect('/register');
            }

            $name        = $body['username'];
            $email       = $body['email'];
            $password    = $body['password'];
        
            $user = $this->userRepository->findOne('email', $email);
            if ($user) {
                Application::$app->session->setFlash('error_register', ' Same email aready exist');
                $response->redirect('/register');
            }
            
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $newUser = new User();
            $newUser->setName($name);
            $newUser->setEmail($email);
            $newUser->setPassword($hashPassword);

            $this->userRepository->create($newUser);

            Application::$app->session->remove('error_register');
            Application::$app->session->setFlash('success_message', 'Thenks for register, now lets log in');

            return $response->redirect('/login');
        }
        return $this->render('register', []);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function login(Request $request, Response $response)
    {
        if (Application::$app->isLogged()) {
            return $response->redirect('/dashboard');
        }

        if ($request->getMethod() === 'post') {
            $body = $request->getBody();

            if (! UserValidation::login($body)) {
                return $response->redirect('/login');
            }

            $user = $this->userRepository->findOne('email', $body['email']);
            if (!$user) {
                Application::$app->session->setFlash('error_login', 'Incorect password or email');
                return $response->redirect('/login');
            }
            

            $validPssword = password_verify($body['password'], $user->getPassword());
            if (!$validPssword) {
                Application::$app->session->setFlash('error_login', 'Incorect password or email');
                return $response->redirect('/login');
            }
            
            if (!Application::$app->login($user)) {
                Application::$app->session->setFlash('error_login', 'Something went wrong');
                return $response->redirect('/login');
            }
           
            Application::$app->session->remove('error_login');
            return $response->redirect('/dashboard');
        }
        
        
        return $this->render('login', []);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}
