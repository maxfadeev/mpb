<?php


namespace Tests;


use Application\Bootstrap;
use Phalcon\Config;
use Phalcon\Config\Adapter\Ini;
use Phalcon\DiInterface;
use Phalcon\Test\UnitTestCase;

class BootstrapTest extends UnitTestCase
{
    /**
     * @var \Application\Bootstrap
     */
    protected $bootstrap;

    public function setUp(DiInterface $di = null, Config $config = null)
    {
        parent::setUp($di, $config);
        $this->bootstrap = new Bootstrap();
    }

    public function testClassHasDiAttribute()
    {
        $this->assertClassHasAttribute('di', get_class($this->bootstrap));
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
    }
}
