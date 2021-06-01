<?php
namespace app\core;
/**
 * Class Response
 * @package app\core
 */
class Response
{
    /**
     * @param int $code
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    /**
     * @param string $url
     */
    public function redirect(string $url)
    {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
}
