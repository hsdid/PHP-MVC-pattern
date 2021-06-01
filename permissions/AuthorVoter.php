<?php
namespace app\permissions;

use app\core\Application;
use app\model\Article;

/**
 * Class AuthorVoter
 * @package app\permissions
 */
class AuthorVoter
{
    /**
     * @param Article $article
     * @return bool
     */
    public function belongToUser(Article $article): bool
    {
        if (! $article instanceof Article) {
            return false;
        }

        if (! (Application::$app->session->get('user') == $article->getUserId())) {
            return false;
        }
        return true;
    }
}
