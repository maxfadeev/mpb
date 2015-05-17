<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\Users\AddForm;
use Application\Modules\Admin\Forms\Users\EditForm;
use Application\Modules\Users\Models\Roles;
use Application\Modules\Users\Models\Users;
use Phalcon\Db\Column;
use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    /**
     * Shows users
     */
    public function indexAction()
    {
        $users = Users::find();

        $this->view->setVars([
            'users' => $users,
            'token' => $this->security->getToken()
        ]);
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
                    'login' => $this->request->getPost('login', 'striptags'),
                    'email' => $this->request->getPost('email', 'email'),
                    'password' => $this->security->hash($this->request->getPost('password')),
                    'role' => $this->request->getPost('role')
                ]);

                if ($users->save() == true) {
                    $this->flash->success("User has been created");
                    $this->dispatcher->forward(['action' => 'index']);
                    return;
                }

                $this->flash->error($users->getMessages());
            }
        }
        // if the request isn't POST, add roles drop-down
        // hence, we don't request to Roles model if there is no need
        $form->addRoleElement(Roles::find());

        $this->view->setVar('form', $form);
    }

    /**
     * Updates the user by its id
     *
     * @param integer $id the id of the user to be edited
     */
    public function editAction($id)
    {
        $user = Users::findFirst([
            'conditions' => 'id = ?1',
            'bind' => [1 => $id],
            'bindTypes' => [1 => Column::BIND_PARAM_INT]
        ]);

        if ($user == false) {
            $this->flash->error('User was not found');
            $this->dispatcher->forward(['action' => 'index']);
            return;
        }

        $form = new EditForm($user);

        if ($this->request->isPost()) {
            // check if form data are valid and CSRF token is right
            if ($form->isValid($this->request->getPost()) && $this->security->checkToken()) {
                $user->assign([
                    'login' => $this->request->getPost('login', 'striptags'),
                    'email' => $this->request->getPost('email', 'email'),
                    'role' => $this->request->getPost('role'),
                    'banned' => $form->isBanned($this->request->getPost('status')),
                    'suspended' => $form->isSuspended($this->request->getPost('status')),
                    'active' => $form->isActive($this->request->getPost('status'))
                ]);

                if ($user->save() == true) {
                    $this->flash->success("User has been updated");
                    $this->dispatcher->forward(['action' => 'index']);
                    return;
                }

                $this->flash->error($user->getMessages());
            }
        }
        // if the request isn't POST, add roles drop-down
        // hence, we don't request to Roles model if there is no need
        $form->addRoleElement(Roles::find());

        $this->view->setVar('form', $form);
    }

    /**
     * Deletes the user by its id
     * If the user is not found, forwards a request to the index action
     *
     * @param integer $id the id of the user to be deleted
     * @param string $token csrf token value
     */
    public function deleteAction($id, $token)
    {
        // verify if csrf token is right
        if ($token !== $this->security->getSessionToken()) {
            $this->flash->error("CSRF verification error");
            $this->dispatcher->forward(['action' => 'index']);
            return;
        }

        $user = Users::findFirst([
            'conditions' => 'id = ?1',
            'bind' => [1 => $id],
            'bindTypes' => [1 => Column::BIND_PARAM_INT]
        ]);

        if ($user == false) {
            $this->flash->error('User was not found');
            $this->dispatcher->forward(['action' => 'index']);
            return;
        }

        if ($user->delete() == false) {
            $this->flash->error($user->getMessages());
        } else {
            $this->flash->success('User has been deleted successfully');
        }

        // anyway forward to the index action
        $this->dispatcher->forward(['action' => 'index']);
    }
}