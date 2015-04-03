<?php


namespace Application\Modules\Admin\Controllers;


use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
    public function notFoundAction()
    {
        $this->view->setVar('message', 'Error 404');
    }
} 