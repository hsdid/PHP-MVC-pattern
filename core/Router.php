<?php

namespace app\core;



class Router {

    public Request  $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
       
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;        
    }


    
    public function delete($path, $callback)
    {
        $this->routes['delete'][$path] = $callback;        
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
       
        if (is_string($callback)){
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
           
            $callback[0] = new $callback[0];
        }
        
        return call_user_func($callback, $this->request, $this->response);
       
    }


    public function renderView($view, $params = [])
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

    protected function renderOnlyViwe($view, $params) {


        foreach ($params as $key => $value) {
            $$key = $value;
        }

        
        ob_start();
        include_once __DIR__."/../views/$view.php";
        return ob_get_clean();
    }

}