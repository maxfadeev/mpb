<?php


namespace Application\Modules\Articles\Controllers;


use Application\Modules\Articles\Models\Articles;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $articles = Articles::find();

        $this->view->setVar('articles', $articles);
    }
} 