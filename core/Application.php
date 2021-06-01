<?php
namespace app\core;

use app\model\User;

/**
 * Class Application
 * @package app\core
 */
class Application
{
    /**
     * @var Router
     */
    public Router      $router;
    /**
     * @var Request
     */
    public Request     $request;
    /**
     * @var Response
     */
    public Response    $response;
    /**
     * @var Application
     */
    public static Application $app;
    /**
     * @var Session
     */
    public Session     $session;
    /**
     * @var Database
     */
    public Database    $db;

    public $user;

    /**
     * Application constructor.
     * @param array $dbConfig
     */
    public function __construct(array $dbConfig)
    {   
        self::$app       = $this;
        $this->request   = new Request();
        $this->response  = new Response();
        $this->session   = new Session();
        $this->router    = new Router($this->request, $this->response);
        $this->db        = new Database($dbConfig);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return bool
     */
    public function isLogged()
    {
        if ($this->session->get('user')) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isGuest()
    {
        if (!$this->session->get('user')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function login(User $user)
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
