<?php


namespace Application;


use Phalcon\Config;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\Dispatcher;

class Bootstrap
{
    /**
     * @var \Phalcon\DI
     */
    protected $di;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->di = new Di();

        $this->registerServices();
    }

    /**
     * Registers all services that relate to whole application
     */
    public function registerServices()
    {
        $this->setLogger();
        try {
            $this->setDb($this->getIniConfiguration('application')->db);
            $this->setRoutes();
            $this->setDispatcher();
        } catch(\Exception $e) {
            $this->di->get('logger')->error($e->getMessage());
            $this->di->get('logger')->error($e->getTraceAsString());
        }
    }

    /**
     * Sets a Db service
     * @param \Phalcon\Config $config
     */
    public function setDb(Config $config)
    {
        $eventsManager = $this->di->get('eventsManager');
        $eventsManager->attach('db', new DbListener());

        $this->di->setShared('db', function() use ($config, $eventsManager) {
            $connection = new Mysql([
                'host' => $config['host'],
                'username' => $config['username'],
                'password' => '',
                'dbname' => $config['name']
            ]);

            $connection->setEventsManager($eventsManager);

            return $connection;
        });
    }

    /**
     * Sets a Router service
     */
    public function setRoutes()
    {
        $this->di->setShared('router', function() {
            // create a router without default rotes
            $router = new Router(false);

            // set a 404 page
            $router->notFound([
                'module' => 'admin',
                'controller' => 'error',
                'action' => 'notFound'
            ]);

            $routes = $this->getIniConfiguration('routes')->toArray();
            foreach ($routes as $route) {
                $pattern = array_shift($route);
                $router->add($pattern, $route);
            }

            return $router;
        });
    }

    /**
     * Sets a Dispatcher service
     */
    public function setDispatcher()
    {
        $this->di->setShared('dispatcher', function() {
            $eventsManager = $this->di->get('eventsManager');
            $eventsManager->attach("dispatch", new DispatcherListener());

            $dispatcher = new Dispatcher();
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }

    /**
     * Creates an Application instance and calls registerModules()
     *
     * @return \Phalcon\Mvc\Application
     */
    public function createApplication()
    {
        $application = new Application($this->di);

        $eventsManager = $this->di->get('eventsManager');
        $eventsManager->attach('application', new ApplicationListener());

        $application->setEventsManager($eventsManager);

        $this->registerModules($application);

        return $application;
    }

    /**
     * Registers modules
     *
     * @param \Phalcon\Mvc\Application $application
     */
    public function registerModules(Application $application)
    {
        $application->registerModules($this->getIniConfiguration('modules')->toArray());
    }

    /**
     * Gets concrete Ini configuration instance by name
     *
     * @param string $name
     * @return \Phalcon\Config\Adapter\Ini
     */
    public function getIniConfiguration($name)
    {
        return new Ini(APP_DIR . "/configs/{$name}.ini");
    }

    /**
     * Set a Logger service
     */
    public function setLogger()
    {
        $this->di->setShared('logger', function() {
            $fileName = date('mdY');
            $logger = new FileAdapter(APP_DIR . "/logs/debug{$fileName}.log");
            return $logger;
        });
    }

    /**
     * Getter
     *
     * @return \Phalcon\DI
     */
    public function getDi()
    {
        return $this->di;
    }
}