<?php


namespace Application;


use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Component;

/**
 * @property \Application\Modules\Users\Components\Auth auth
 * @property \Application\Acl acl
 */
class DispatcherListener extends Component
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();

        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName)) {
            // Get the current identity
            $identity = $this->auth->getIdentity();

            if (is_array($identity) == false) {
                $this->flash->notice('You don\'t have access to this module');

                $dispatcher->forward([
                    'controller' => 'login',
                    'action' => 'index'
                ]);

                return false;
            }

            $actionName = $dispatcher->getActionName();
            if ($this->acl->isAllowed($identity['login'], $controllerName, $actionName) == false) {
                $this->flash->notice('You don\'t have access to this module');

                $dispatcher->forward([
                    'controller' => 'login',
                    'action' => 'index'
                ]);

                return false;
            }
        }
    }
}