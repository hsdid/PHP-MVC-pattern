<?php
namespace app\core;
class Response
{
    public function setStatusCode(int $code) 
    {
        http_response_code($code);
    }

    public function redirect($url) 
    {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
}