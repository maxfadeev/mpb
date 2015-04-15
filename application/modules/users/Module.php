<?php


namespace Application\Modules\Users;


use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * @var \Phalcon\DiInterface
     */
    protected $di;

    /**
     * Registers an autoloader related to the module
     */
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Application\Modules\Users\Controllers' => '../application/modules/users/controllers/',
            'Application\Modules\Users\Models' => '../application/modules/users/models/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices($di)
    {
        $this->di = $di;
        $this->setDispatcher();
        $this->setView();
        $this->setAuth();
    }

    /**
     * Sets a Dispatcher service
     */
    public function setDispatcher()
    {
        $this->di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Application\Modules\Users\Controllers');
            return $dispatcher;
        });
    }

    /**
     * Sets a View service
     */
    public function setView()
    {
        $this->di->set('view', function() {
            $view = new View();
            $view->setViewsDir('../application/modules/users/views/');
            $view->registerEngines(['.volt' => 'Phalcon\Mvc\View\Engine\Volt']);
            return $view;
        });
    }

    /**
     * Sets an Auth service
     */
    public function setAuth()
    {
        $this->di->set('auth', 'Application\Modules\Users\Components\Auth');
    }
}