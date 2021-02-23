<?php
namespace app\validation;

use app\core\Application;
use Valitron\Validator;

class UserValidation
{
    public static function register($body)
    {
        $v = new Validator($body);
        $v->rule('required', 'username', 'email', 'password', 'confirmPass');
        $v->rule('lengthMin', 'username', 3);
        $v->rule('lengthMax', 'username', 20);
        $v->rule('lengthMin', 'password', 6);
        $v->rule('lengthMax', 'password', 100);
        $v->rule('equals', 'password', 'confirmPass');
        $v->rule('email', 'email');

        if (! $v->validate()) {
            $username    = $v->errors()['username']?? null;
            $email       = $v->errors()['email'] ?? null;
            $password    = $v->errors()['password'] ?? null;
            $confirmPass = $v->errors()['confirmPass'] ?? null;

            if ($username) {
                Application::$app->session->setFlash('error_register', $username[0]);
            }
            if ($email) {
                Application::$app->session->setFlash('error_register', $email[0]);
            }
            if ($password) {
                Application::$app->session->setFlash('error_register', $password[0]);
            }
            if ($confirmPass) {
                Application::$app->session->setFlash('error_register', $confirmPass[0]);
            }

      
            return false;
        }
    
        Application::$app->session->remove('error_register');
        return true;
    }


    public static function login($body)
    {
        $v = new Validator($body);
        $v->rule('required', 'email', 'password');
        $v->rule('lengthMin', 'password', 6);
        $v->rule('lengthMax', 'password', 100);
        $v->rule('email', 'email');

        if (! $v->validate()) {
            $email       = $v->errors()['email'] ?? null;
            $password    = $v->errors()['password'] ?? null;
        
            if ($email) {
                Application::$app->session->setFlash('error_login', $email[0]);
            }
            if ($password) {
                Application::$app->session->setFlash('error_login', $password[0]);
            }
        
            return false;
        }
    
        Application::$app->session->remove('error_login');
        return true;
    }
}
