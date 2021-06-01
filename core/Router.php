<?php
namespace app\core;

use app\services\Container;

/**
 * Class Router
 * @package app\core
 */
class Router
{
    /**
     * @var Request
     */
    public Request  $request;
    /**
     * @var Response
     */
    public Response $response;
    /**
     * @var Container
     */
    public Container $container;
    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request   = $request;
        $this->response  = $response;
    }

    /**
     * @param string $path
     * @param array $callback
     */
    public function get(string $path,array $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param string $path
     * @param array $callback
     */
    public function post(string $path,array $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @param Container $container
     */
    public function setDependencies (Container $container)
    {
        $this->container = $container;
    }

    public function resolve()
    {
        $path     = $this->request->getPath();
        $method   = $this->request->getMethod();
       
        $callback = $this->routes[$method][$path] ?? false;
      
        if ($callback == false) {
            $this->response->setStatusCode(404);
            return "Not found";
        }
       
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            
            $class = $callback[0];

            if  (isset($this->container)){
                $callback[0] = new $class($this->container);
            } else {
                $callback[0] = new $class();
            }
        }
            
        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * @param string $view
     * @param array $params
     */
    public function renderView(string $view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent   = $this->renderOnlyViwe($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once __DIR__."/../views/layouts/main.php";
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param array $params
     */
    protected function renderOnlyViwe(string $view, array $params)
    {
        foreach ($params as $key => $value) {
            
            $$key = $value;
        }

        ob_start();
        include_once __DIR__."/../views/$view.php";
        return ob_get_clean();
    }
}
