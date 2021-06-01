<?php

namespace app\core;

use Exception;

/**
 * Class DependencyInjector
 * @package app\core
 */
class DependencyInjector
{
    protected $services = [];

    public function register($service_name, callable $callable)
    {
        $this->services[$service_name] = $callable;
    }

    public function get($service_name)
    {
        //Check if the service exist 
        if ( ! array_key_exists($service_name, $this->services)){
            throw new \Exception("The Service: $service_name dose not exist. ");
        }
        //Return the existing Service 
        return $this->services[$service_name]();
    }
}
