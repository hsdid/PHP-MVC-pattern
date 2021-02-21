<?php

namespace app\core;

class Validation
{

    private $errors = [];

    public function getErrors () 
    {
        return $this->errors;
    }

    public function required ($var) 
    {
        if (!$var) {
            $this->errors[] = 'this filed is required';
            return false; 
        }
    }

    public function min (String $var,int $min) 
    {   
        if (strlen($var) < $min ) {
            $this->errors[] = "`$var` is too short, min lenght is `$min`";
            return false ;
        }
    }

    public function max (String $var,int $max) 
    {   
        if (strlen($var) > $max ) {
            $this->errors[] = "`$var` is too long, max lenght is `$max`";
            return false;
        }
    }




}