<?php


namespace Application\Modules\Articles;


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
            'Application\Modules\Articles\Controllers' => '../application/modules/articles/controllers/',
            'Application\Modules\Articles\Models' => '../application/modules/articles/models/',
        ]);

        $loader->register();
    }

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices($di)
    {
        $this->di = $di;
        $this->setDispatcher();
        $this->setView();
    }

    /**
     * Sets a Dispatcher service
     */
    public function setDispatcher()
    {
        $this->di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Application\Modules\Articles\Controllers');
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
            $view->setViewsDir('../application/modules/articles/views/');
            $view->registerEngines(['.volt' => 'Phalcon\Mvc\View\Engine\Volt']);
            return $view;
        });
    }
}