<?php


namespace Tests;


use Application\Bootstrap;
use Phalcon\Config\Adapter\Ini;

class BootstrapTest extends \PHPUnit_Framework_TestCase
{
    protected $bootstrap;

    public function setUp()
    {
        $this->bootstrap = new Bootstrap();
    }

    public function testSetDb()
    {
        $this->assertFileExists(APP_DIR . '/configs/application.ini');

        $config = new Ini(APP_DIR . "/configs/application.ini");

        $this->assertClassHasAttribute('di', get_class($this->bootstrap));

        $this->assertObjectHasAttribute('db', $config);
        $this->assertObjectHasAttribute('host', $config->db);
        $this->assertObjectHasAttribute('username', $config->db);
        $this->assertObjectHasAttribute('password', $config->db);
    }
}
