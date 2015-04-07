<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\Users\AddForm;
use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    public function addAction()
    {
        $form = new AddForm();

        $this->view->setVar('form', $form);
    }
}