<?php


namespace Application\Modules\Admin;


use Application\DispatcherListener;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Url;
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
            'Application\Modules\Admin\Controllers' => APP_DIR . '/modules/admin/controllers/',
            'Application\Modules\Admin\Models' => APP_DIR . '/modules/admin/models/',
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
        $this->setAcl();
        $this->setUrl();
    }

    /**
     * Sets a Dispatcher service
     */
    public function setDispatcher()
    {
        $this->di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Application\Modules\Admin\Controllers');

            $eventsManager = $this->di->get('eventsManager');
            $eventsManager->attach("dispatch", new DispatcherListener());

            $dispatcher->setEventsManager($eventsManager);

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
            $view->setViewsDir(APP_DIR . '/modules/admin/views/');

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

    /**
     * Sets an Acl service
     */
    public function setAcl()
    {
        $this->di->set('acl', 'Application\Modules\Admin\Components\Acl');
    }

    /**
     * Sets an Url service
     * Changes a base uri
     */
    public function setUrl()
    {
        $url = $this->di->get('url');
        $url->setBaseUri('/a');
        $this->di->set('url', $url);
    }
}