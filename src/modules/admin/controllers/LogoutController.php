<?php


namespace Application\Modules\Admin\Controllers;


use Phalcon\Mvc\Controller;

/**
 * @property \Application\Modules\Users\Components\Auth auth
 */
class LogoutController extends Controller
{
    /**
     * Logs out the user
     */
    public function indexAction()
    {
        $this->auth->remove();

        $this->response->redirect('/login');
    }
}