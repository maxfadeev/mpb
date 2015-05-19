<?php


namespace Tests\Unit;


use Phalcon\Config;
use Phalcon\DiInterface;
use Phalcon\Test\UnitTestCase;

class AclTest extends UnitTestCase
{
    public $acl;

    public function setUp(DiInterface $di = null, Config $config = null)
    {
        parent::setUp($di, $config);
        $this->acl = $this->getMockBuilder('Application\Acl')->getMock();
    }

    public function testGetAcl()
    {
        $this->assertClassHasAttribute('filePath', get_class($this->acl));
    }
}