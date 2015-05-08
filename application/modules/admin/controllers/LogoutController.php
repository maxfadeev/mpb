<?php


namespace Application\Modules\Admin\Controllers;


use Phalcon\Mvc\Controller;

class LogoutController extends Controller
{
    public function indexAction()
    {
        $this->auth->remove();

        $this->response->redirect('a/login');
    }
}