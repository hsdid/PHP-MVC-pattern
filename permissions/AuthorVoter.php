<?php 
namespace app\permissions;

use app\core\Application;
use app\model\Article;

class AuthorVoter
{
    
    public function canEdit(Article $article) 
    {
        if (! (Application::$app->session->get('user') === $article->getUserId())) {
            return false;
        }
        return true;
    }


    public function canDelete(Article $article) 
    {
        if (! (Application::$app->session->get('user') === $article->getUserId())) {
            return false;
        }
        return true;
    }
}
