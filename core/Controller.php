<?php
namespace app\core; // odstępy, znów brak formatowania
class Controller  // ten kontroler powinien robić więcej i być abstrakcyjny
{

    // brak type hintów, return type,
    public function render ($view, $params)
    {
        return Application::$app->router->renderView($view, $params);
    }


}