<?php

namespace app\core;

class Session 
{

   


    public function __construct()
    {   
        session_start();
    }
    public function setFlash($key, $message)
    {
        $_SESSION[$key] = $message;
    }

    public function getFlash($key)
    {   

        return $_SESSION[$key]?? null;
    }

    public function set ($key, $value) 
    {
        $_SESSION[$key] = $value;
    }

    public function get ($key) 
    {
        return $_SESSION[$key]?? null;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

}