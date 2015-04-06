<?php


namespace Application\Modules\Users\Controllers;


use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->setVar('title', 'Users Test Title');
    }
}