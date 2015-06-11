<?php


namespace Tests\Unit;


use Application\Di;

class DiTest extends \PHPUnit_Framework_TestCase
{
    public function testCallsSetSessionWithConstructor()
    {
        $mock = $this->getMock('Application\Di');

        $mock->expects($this->once())
            ->method('setSession');

        $mock->__construct();
    }

    public function testCallsSetUrlWithConstructor()
    {
        $mock = $this->getMock('Application\Di');

        $mock->expects($this->once())
            ->method('setUrl');

        $mock->__construct();
    }

    public function testSetSession()
    {
        $di = new Di();

        $this->assertTrue($di->getService('session')->isShared());

        $session = $di->get('session');

        $this->assertInstanceOf('Phalcon\Session\Adapter\Files', $session);
    }

    public function testSetUrl()
    {
        $di = new Di();

        $this->assertFalse($di->getService('url')->isShared());

        $url = $di->get('url');

        $this->assertEquals('/', $url->getBaseUri());
    }
}