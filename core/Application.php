<?php
namespace app\core;

use app\services\Container;

class Application
{
    public Router      $router;
    public Request     $request;
    public Response    $response;
    public static Application $app;
    public Session     $session;
    public Database    $db;
    public Container   $container;
    public $user;

    public function __construct(array $dbConfig)
    {   
        self::$app       = $this;
        $this->request   = new Request();
        $this->response  = new Response();
        $this->session   = new Session();
        $this->container = new Container();
        $this->router    = new Router($this->request, $this->response, $this->container);
        $this->db        = new Database($dbConfig);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
    
    public function isLogged()
    {
        if ($this->session->get('user')) {
            return true;
        }
        return false;
    }

    public function isGuest()
    {
        if (!$this->session->get('user')) {
            return true;
        }
        return false;
    }


    public function login($user)
    {
        $this->user = $user;
        $this->session->set('user', $user->getId());
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
        session_destroy();
    }
}
