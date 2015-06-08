<?php


namespace Tests\Unit;


use Application\Bootstrap;
use Phalcon\Config;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Mvc\Application;

class BootstrapTest extends \PHPUnit_Framework_TestCase
{
    public function testSetsDiWithConstructor()
    {
        $bootstrap = new Bootstrap();
        $this->assertClassHasAttribute('di', get_class($bootstrap));
        $this->assertAttributeInstanceOf('Application\Di', 'di', $bootstrap);
    }

    public function testCallsRegisterServicesMethodWithConstructor()
    {
        $mock = $this->getMock('Application\Bootstrap');

        $mock->expects($this->once())
            ->method('registerServices');

        $mock->__construct();
    }

    public function testRegisterServices()
    {
        $mock = $this->getMockBuilder('Application\Bootstrap')
            ->setMethods(['setDb', 'setRoutes', 'setLogger'])
            ->getMock();

        $mock->expects($this->once())
            ->method('setDb');

        $mock->expects($this->once())
            ->method('setRoutes');

        $mock->expects($this->once())
            ->method('setLogger');

        $mock->registerServices();
    }

    public function testApplicationConfigurationExists()
    {
        $config = APP_DIR . '/configs/application.ini';

        $this->assertFileExists($config);

        return new Ini($config);
    }

    /**
     * @depends testApplicationConfigurationExists
     * @param \Phalcon\Config\Adapter\Ini $config
     */
    public function testApplicationDbConfiguration(Ini $config)
    {
        $this->assertObjectHasAttribute('db', $config);
        $this->assertObjectHasAttribute('host', $config->db);
        $this->assertObjectHasAttribute('username', $config->db);
        $this->assertObjectHasAttribute('password', $config->db);
        $this->assertObjectHasAttribute('name', $config->db);
    }

    /**
     * @depends testApplicationConfigurationExists
     * @depends testApplicationDbConfiguration
     * @param \Phalcon\Config\Adapter\Ini $config
     */
    public function testSetDb(Ini $config)
    {
        $bootstrap = new Bootstrap();

        $dbConfig = $config->db;
        $dbConfig->host = '192.168.56.102';

        $bootstrap->setDb($dbConfig);

        $this->assertTrue($bootstrap->getDi()->has('db'));

        $db = $bootstrap->getDi()->get('db');

        $this->assertInstanceOf('Phalcon\Db\Adapter\Pdo\Mysql', $db);

        $this->assertTrue($db->getEventsManager()->hasListeners('db'));
    }

    public function testRoutesConfigurationExists()
    {
        $config = APP_DIR . '/configs/routes.ini';

        $this->assertFileExists($config);

        return new Ini($config);
    }

    /**
     * @depends testRoutesConfigurationExists
     */
    public function testNonexistentRoutes()
    {
        $bootstrap = new Bootstrap();
        $bootstrap->setRoutes();

        $this->assertTrue($bootstrap->getDi()->has('router'));

        $routes = $bootstrap->getDi()->get('router');

        $routes->handle('/some_wrong_controller/some_wrong_action');

        $this->assertEquals('error', $routes->getControllerName());
        $this->assertEquals('notFound', $routes->getActionName());
    }

    /**
     * @depends testRoutesConfigurationExists
     */
    public function testExistentRoutes()
    {
        $bootstrap = new Bootstrap();
        $bootstrap->setRoutes();

        $routes = $bootstrap->getDi()->get('router');

        $routes->handle('/a');

        $this->assertEquals('admin', $routes->getModuleName());
        $this->assertEquals('index', $routes->getControllerName());
        $this->assertEquals('index', $routes->getActionName());

        $routes->handle('/a/users');

        $this->assertEquals('admin', $routes->getModuleName());
        $this->assertEquals('users', $routes->getControllerName());
        $this->assertEquals('index', $routes->getActionName());
    }

    public function testCreateApplication()
    {
        $bootstrap = new Bootstrap();
        $application = $bootstrap->createApplication();

        $this->assertInstanceOf('Application\Di', $application->getDi());

        $this->assertTrue($application->getEventsManager()->hasListeners('application'));

        return $application;
    }

    /**
     * @depends testCreateApplication
     */
    public function testCallsRegisterModulesMethodOnCreateApplication()
    {
        $mock = $this->getMockBuilder('Application\Bootstrap')
            ->setMethods(['registerModules'])
            ->getMock();

        $mock->expects($this->once())
            ->method('registerModules');

        $mock->createApplication();
    }

    public function testModulesConfigurationExists()
    {
        $config = APP_DIR . '/configs/modules.ini';

        $this->assertFileExists($config);

        return new Ini($config);
    }

    /**
     * @depends testCreateApplication
     * @depends testModulesConfigurationExists
     * @param \Phalcon\Mvc\Application $application
     * @param \Phalcon\Config\Adapter\Ini $config
     */
    public function testRegisterModules(Application $application, Ini $config)
    {
        $application->registerModules($config->toArray());

        $this->assertArrayHasKey('admin', $application->getModules());
        $this->assertArrayHasKey('users', $application->getModules());
        $this->assertArrayHasKey('articles', $application->getModules());
    }

    public function testSetLogger()
    {
        $bootstrap = new Bootstrap();
        $bootstrap->setLogger();

        $this->assertTrue($bootstrap->getDi()->has('logger'));

        $logger = $bootstrap->getDi()->get('logger');

        $this->assertEquals(APP_DIR . '/logs/debug' . date('mdY') . '.log', $logger->getPath());
    }
}