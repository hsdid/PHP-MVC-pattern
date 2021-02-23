<?php 
namespace app\permissions;

use app\core\Application;
use app\model\Article;

class AuthorVoter
{
    
    

    public function canEdit($article) 
    {   

        //wystarczy użyć type hinta wyżej i tego ifa nie trzeba w ogole
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
        //jak wyżej
        if (! $article instanceof Article) {
            return false;
        }

        //imo duplikujesz kod z canEdit.. to można ujednolicić
        if (! (Application::$app->session->get('user') === $article->getUserId())) {
            return false;
        }
        return true;
    }
}
