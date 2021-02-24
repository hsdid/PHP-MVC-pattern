<?php 
namespace app\services;



use app\core\DependencyInjector;
use app\permissions\AuthorVoter;
use app\repository\articleRepository;
use app\repository\categoryRepository;
use app\repository\userRepository;


class Container extends DependencyInjector
{
    //public DependencyInjector $di;

    public function __construct()
    {
        //$this->di = new DependencyInjector();

        $this->register('articleRepository', function(){
            $obj = new articleRepository();
            return $obj;
        });

        $this->register('categoryRepository', function(){
            $obj = new categoryRepository();
            return $obj;
        });

        $this->register('userRepository', function(){
            $obj = new userRepository();
            return $obj;
        });

        $this->register('authorVoter', function(){
            $obj = new AuthorVoter();
            return $obj;
        });

    }
}

   





