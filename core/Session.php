<?php

namespace app\core;

/**
 * Class Session
 * @package app\core
 */
class Session
{
    public function __construct()
    {
        session_start();
    }

    /**
     * @param string $key
     * @param string $message
     */
    public function setFlash(string $key, string $message)
    {
        $_SESSION[$key] = $message;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getFlash(string $key)
    {
        return $_SESSION[$key]?? null;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $_SESSION[$key]?? null;
    }

    /**
     * @param string $key
     */
    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }
}
