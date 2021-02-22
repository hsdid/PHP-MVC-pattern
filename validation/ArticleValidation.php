<?php 
namespace app\validation;

use app\core\Application;
use Valitron\Validator;

class ArticleValidation 
{
   public static function createArticle($body)
   {
    $v = new Validator($body);
    $v->rule('required', 'categoryId','title','description');
    $v->rule('lengthMin','title',5);
    $v->rule('lengthMax','title',100);
    $v->rule('lengthMin','description',10);

    if(! $v->validate()){
        $title       = $v->errors()['title']?? null;
        $description = $v->errors()['description'] ?? null;
        $category    = $v->errors()['categoryId'] ?? null;
        if ($title){
             Application::$app->session->setFlash('error_article', $title[0]);
        }
        if ($description){
            Application::$app->session->setFlash('error_article', $description[0]);
        }
        if ($category){
            Application::$app->session->setFlash('error_article', $category[0]);
        }

      
        return false;
    }
    
    Application::$app->session->remove('error_article');
    return true;
   } 

   public static function editArticle($body)
   {
    $v = new Validator($body);
    $v->rule('required', 'categoryId','title','description');
    $v->rule('lengthMin','title',5);
    $v->rule('lengthMax','title',100);
    $v->rule('lengthMin','description',10);

    if(! $v->validate()){
        $title       = $v->errors()['title']?? null;
        $description = $v->errors()['description'] ?? null;
        $category    = $v->errors()['categoryId'] ?? null;
        if ($title){
             Application::$app->session->setFlash('error_article', $title[0]);
        }
        if ($description){
            Application::$app->session->setFlash('error_article', $description[0]);
        }
        if ($category){
            Application::$app->session->setFlash('error_article', $category[0]);
        }

      
        return false;
    }
    
    Application::$app->session->remove('error_article');
    return true;
   }
}