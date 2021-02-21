<?php

namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\repository\articleRepository;
use app\repository\userRepository;

class UserController extends Controller 
{
    
    private $userRepository;
  

    public function __construct()
    {
        $this->userRepository    = new userRepository();
        
    }

    public function getUser(Request $request, Response $response)
    {
        $body     = $request->getBody();
        $user     = $this->userRepository->findOne('id', $body['id']);

        $articles = $this->userRepository->findArticles($user);
        
        return $this->render('user/user', [
                                    'user'     => $user, 
                                    'articles' => $articles
                                    ]);
    }
    
}