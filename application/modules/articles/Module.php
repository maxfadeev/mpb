<?php


namespace Application\Modules\Articles;


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
     */
    public function registerAutoloaders(DiInterface $di = null)
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
    public function registerServices(DiInterface $di)
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
            $view->setViewsDir(APP_DIR . '/modules/articles/views/');

            $volt = new Volt($view, $this->di);
            $volt->setOptions([
                'compiledPath' => APP_DIR . '/cache/volt/',
                'compiledSeparator' => '_'
            ]);

            $view->registerEngines(['.volt' => $volt]);
            return $view;
        });
    }
}