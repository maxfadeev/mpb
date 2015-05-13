<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\Users\AddForm;
use Application\Modules\Users\Models\Users;
use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    /**
     * Shows users
     */
    public function indexAction()
    {
        $users = Users::find();

        $this->view->setVar('users', $users);
    }

    /**
     * Adds a new user
     * If the user is added, forwards a request to the index action
     */
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

    /**
     * Deletes the user by its id
     * If the user is not found, forwards a request to the index action
     *
     * @param integer $id the id of the user to be deleted
     */
    public function deleteAction($id)
    {
        $user = Users::findFirstById($id);
        if ($user == false) {
            $this->flash->error('User was not found');
            $this->dispatcher->forward(['action' => 'index']);
            return;
        }

        if ($user->delete() == false) {
            $this->flash->error($user->getMessages());
        } else {
            $this->flash->success('User has been deleted');
        }

        $this->dispatcher->forward(['action' => 'index']);
    }
}