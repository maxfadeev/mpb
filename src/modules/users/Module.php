<?php


namespace Application\Modules\Users;


use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

class Module implements ModuleDefinitionInterface
{
    /**
     * @var \Phalcon\DiInterface
     */
    protected $di;

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $di
     * @return \Phalcon\Loader
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Application\Modules\Users\Controllers' => APP_DIR . '/modules/users/controllers/',
            'Application\Modules\Users\Models' => APP_DIR . '/modules/users/models/',
        ]);

        return $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices(DiInterface $di)
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
            $view->setViewsDir(APP_DIR . '/modules/users/views/');

            $volt = new Volt($view, $this->di);
            $volt->setOptions([
                'compiledPath' => APP_DIR . '/cache/volt/',
                'compiledSeparator' => '_'
            ]);

            $view->registerEngines(['.volt' => $volt]);
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