<?php
namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\services\Container;

/**
 * Class UserController
 * @package app\controller
 */
class UserController extends Controller
{
    /** @var userRepository  */
    private $userRepository;
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container      = $container;
        $this->userRepository = $this->container->get('userRepository');
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function getUser(Request $request, Response $response)
    {
        $body     = $request->getBody();
        $user     = $this->userRepository->findOne('id', $body['id']);

        $articles = $this->userRepository->findPublicArticles($user);
        
        return $this->render('user/user', [
                                    'user'     => $user,
                                    'articles' => $articles
                                    ]);
    }
}
