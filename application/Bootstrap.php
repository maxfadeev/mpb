<?php


namespace Application;


use Phalcon\Config\Adapter\Ini;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url;
use Phalcon\Session\Adapter\Files as SessionAdapter;

class Bootstrap
{
    /**
     * @var \Phalcon\DI
     */
    protected $di;

    public function __construct()
    {
        $this->di = new Di();
        $this->setDb();
        $this->setRoutes();
        $this->setSession();
        $this->setUrl();
        $this->setLogger();
    }

    /**
     * Sets a Db service
     */
    public function setDb()
    {
        $config = $this->getIniConfiguration('application');

        $eventsManager = $this->di->get('eventsManager');
        $eventsManager->attach('db', new DbListener());

        $this->di->set('db', function() use ($config, $eventsManager) {
            $connection = new Mysql([
                'host' => $config->db->host,
                'username' => $config->db->username,
                'password' => $config->db->password,
                'dbname' => $config->db->name
            ]);

            $connection->setEventsManager($eventsManager);

            return $connection;
        });
    }

    /**
     * Sets a Session service
     */
    public function setSession()
    {
        $this->di->set('session', function() {
            $session = new SessionAdapter();
            $session->start();
            return $session;
        });
    }

    /**
     * Sets a Router service
     */
    public function setRoutes()
    {
        $this->di->set('router', function() {
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
     * Sets an Url service
     */
    public function setUrl()
    {
        $this->di->set('url', function() {
            $url = new Url();
            $url->setBaseUri('/');
            return $url;
        });
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
     * @return \Phalcon\DI
     */
    public function getDi()
    {
        return $this->di;
    }
}