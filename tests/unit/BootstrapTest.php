<?php


namespace Tests\Unit;


use Application\Bootstrap;
use Phalcon\Config;
use Phalcon\Config\Adapter\Ini;

class BootstrapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Application\Bootstrap
     */
    protected $bootstrap;

    public function setUp()
    {
        $this->bootstrap = new Bootstrap();;
    }

    public function testServicesAreSet()
    {
        $this->assertClassHasAttribute('di', get_class($this->bootstrap));

        $this->assertTrue($this->bootstrap->getDi()->has('db'));
        $this->assertTrue($this->bootstrap->getDi()->has('session'));
        $this->assertTrue($this->bootstrap->getDi()->has('router'));
        $this->assertTrue($this->bootstrap->getDi()->has('url'));
        $this->assertTrue($this->bootstrap->getDi()->has('logger'));
    }

    public function testSetDb()
    {
        $this->assertFileExists(APP_DIR . '/configs/application.ini');

        $config = new Ini(APP_DIR . "/configs/application.ini");

        $this->assertObjectHasAttribute('db', $config);
        $this->assertObjectHasAttribute('host', $config->db);
        $this->assertObjectHasAttribute('username', $config->db);
        $this->assertObjectHasAttribute('password', $config->db);
    }

    public function testSetRotes()
    {
        $this->assertFileExists(APP_DIR . '/configs/routes.ini');

        $router = $this->bootstrap->getDi()->getService('router')->resolve();

        $this->assertNotEmpty($router->getRoutes());

        $router->handle('/a');
        $this->assertTrue($router->wasMatched());
    }
}
