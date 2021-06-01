<?php
namespace app\core;

/**
 * Class Controller
 * @package app\core
 */
class Controller
{
    /**
     * @param string $view
     * @param array $params
     */
    public function render(string $view,array $params)
    {
        return Application::$app->router->renderView($view, $params);
    }
}
