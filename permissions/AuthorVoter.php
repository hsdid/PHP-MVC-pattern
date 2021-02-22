<?php 
namespace app\permissions;

use app\core\Application;
use app\model\Article;

class AuthorVoter
{
    
    

    public function canEdit($article) 
    {   

        if (! $article instanceof Article) {
            return false;
        }

        if (! (Application::$app->session->get('user') === $article->getUserId())) {
            return false;
        }
        return true;
    }


    public function canDelete($article) 
    {
        if (! $article instanceof Article) {
            return false;
        }

        if (! (Application::$app->session->get('user') === $article->getUserId())) {
            return false;
        }
        return true;
    }
}
