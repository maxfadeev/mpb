<?php


namespace Application;


use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Component;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;

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
                $dispatcher->forward([
                    'controller' => 'login',
                    'action' => 'index'
                ]);

                return;
            }

            $actionName = $dispatcher->getActionName();
            if ($this->acl->isAllowed($identity['login'], $controllerName, $actionName) == false) {
                $this->flash->notice('You don\'t have access to this module');

                $dispatcher->forward([
                    'controller' => 'users',
                    'action' => 'index'
                ]);

                return;
            }
        }
    }

    public function beforeException(Event $event, Dispatcher $dispatcher, DispatcherException $exception)
    {
        if ($exception instanceof DispatcherException) {
            $dispatcher->forward(['controller' => 'error', 'action' => 'notFound']);
            return false;
        }
    }
}