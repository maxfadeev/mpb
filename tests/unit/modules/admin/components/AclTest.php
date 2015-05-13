<?php


namespace Tests\Unit\Modules\Admin\Components;


use Phalcon\Config;
use Phalcon\DiInterface;
use Phalcon\Test\UnitTestCase;

class AclTest extends UnitTestCase
{
    protected $acl;

    public function setUp(DiInterface $di = null, Config $config = null)
    {
        parent::setUp($di, $config);
        $this->acl = $this->getMockBuilder('Application\Modules\Admin\Components\Acl')->getMock();
    }

    public function testPrivateResources()
    {
        $this->assertClassHasAttribute('privateResources', get_class($this->acl));
    }
}