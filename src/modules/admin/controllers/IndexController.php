<?php


namespace Application\Modules\Admin\Controllers;


use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->setVar('title', 'Admin Test Title');
    }
}