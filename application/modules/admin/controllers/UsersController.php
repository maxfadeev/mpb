<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\Users\AddForm;
use Application\Modules\Users\Models\Users;
use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    public function addAction()
    {
        $form = new AddForm();

        if ($this->request->isPost() == true) {
            if ($form->isValid($this->request->getPost()) == true) {
                $users = new Users();

                $users->assign([
                    'login' => $this->request->getPost('login'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->security->hash($this->request->getPost('password')),
                    'roles_id' => 1
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