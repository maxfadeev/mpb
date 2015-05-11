<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\Users\AddForm;
use Application\Modules\Users\Models\Users;
use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    public function indexAction()
    {
        $users = Users::find();

        $this->view->setVar('users', $users);
    }

    public function addAction()
    {
        $form = new AddForm();

        if ($this->request->isPost() == true) {
            // check if form data are valid and CSRF token is right
            if ($form->isValid($this->request->getPost()) && $this->security->checkToken()) {
                $users = new Users();

                $users->assign([
                    'login' => $this->request->getPost('login'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->security->hash($this->request->getPost('password')),
                    'role' => 1,
                    'banned' => false,
                    'suspended' => false,
                    'active' => true
                ]);

                if ($users->save()) {
                    $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }

                $this->flash->error($users->getMessages());
            }
        }

        $this->view->setVar('form', $form);
    }
}