<?php


namespace Application\Modules\Admin\Controllers;


use Application\Modules\Admin\Forms\LoginForm;
use Application\Modules\Users\Components\AuthException;
use Phalcon\Mvc\Controller;

/**
 * @property \Application\Modules\Users\Components\Auth auth
 */
class LoginController extends Controller
{
    public function indexAction()
    {
        $form = new LoginForm();

        if ($this->request->isPost() == true) {
            try {
                if ($form->isValid($this->request->getPost()) == true) {
                    $this->auth->login([
                        'login' => $this->request->getPost('login'),
                        'password' => $this->request->getPost('password')
                    ]);

                    $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }
            } catch (AuthException $e) {
                $this->flash->error($e->getMessage());
            }
        }

        $this->view->setVar('form', $form);
    }
} 