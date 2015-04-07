<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\LoginForm;
use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        $form = new LoginForm();

        $this->view->setVar('form', $form);
    }
} 