<?php


namespace Application\Modules\Articles\Controllers;


use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->setVar('title', 'Articles Test Title');
    }
} 