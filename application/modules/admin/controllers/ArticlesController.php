<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Articles\Models\Articles;
use Phalcon\Mvc\Controller;

class ArticlesController extends Controller
{
    /**
     * Shows articles
     */
    public function indexAction()
    {
        $articles = Articles::find();

        $this->view->setVars([
            'articles' => $articles,
            'token' => $this->security->getToken()
        ]);
    }
} 