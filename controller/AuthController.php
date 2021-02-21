<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\User;
use app\repository\userRepository;




class AuthController extends Controller
{   
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new userRepository();
    }


    public function register(Request $request, Response $response){

       //TODO validation data forms , error messages


        if (Application::$app->isLogged()){
            $response->redirect('/dashboard');
        }


        if ($request->getMethod() === 'post') {
            $body = $request->getBody();
            
            $name = $body['username'];
            $email    = $body['email'];
            $password = $body['password'];
            $confirmPassword = $body['confirmPass'];

            $user = $this->userRepository->findOne('email', $email);
            if ($user) {
                Application::$app->session->setFlash('error_email', 'Email aready exist');
                $response->redirect('/register');
            }
            


            if ($password === $confirmPassword){
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                Application::$app->session->setFlash('error_password', 'Passwords do not match');
                $response->redirect('/register');
            }
            
            $newUser = new User();
            $newUser->setName($name);
            $newUser->setEmail($email);
            $newUser->setPassword($hashPassword);

            $this->userRepository->create($newUser);

            Application::$app->session->setFlash('success_message', 'Thenks for register, now lets log in');
            $response->redirect('/login');
        }
        
        return $this->render('register',[]);
    }

    public function login(Request $request, Response $response){
        //TODO validation data forms , error messages

        if (Application::$app->isLogged()){
            $response->redirect('/dashboard');
        }

        if ($request->getMethod() === 'post'){
            
            $body = $request->getBody();

            $user = $this->userRepository->findOne('email', $body['email']);
            if (!$user) return "zly email albo haslo";
            

            $validPssword = password_verify($body['password'], $user->getPassword());
            if (!$validPssword) return "zle haslo albo email";
            
            if (!Application::$app->login($user)) return "something went wrong";
           

            $response->redirect('/dashboard');
        }
        
        
        return $this->render('login',[]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');   
    }



}