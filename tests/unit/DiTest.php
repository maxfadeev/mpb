<?php


namespace Tests\Unit;


use Application\Di;

class DiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $applicationDiMock;

    /**
     * @var \Application\Di
     */
    protected $di;

    public function setUp() {
        $this->applicationDiMock = $this->getMock('Application\Di');
        $this->di = new Di();
    }

    public function testCallsSetSessionWithConstructor()
    {
        $this->applicationDiMock->expects($this->once())
            ->method('setSession');

        $this->applicationDiMock->__construct();
    }

    public function testCallsSetUrlWithConstructor()
    {
        $this->applicationDiMock->expects($this->once())
            ->method('setUrl');

        $this->applicationDiMock->__construct();
    }

    public function testSetSession()
    {
        $this->assertTrue($this->di->has('session'));
        $this->assertTrue($this->di->getService('session')->isShared());

        $session = $this->di->get('session');
        //This does not work within a test
        //$this->assertTrue($session->isStarted());

        $this->assertInstanceOf('Phalcon\Session\Adapter\Files', $session);
    }

    public function testSetUrl()
    {
        $this->assertTrue($this->di->has('url'));
        $this->assertFalse($this->di->getService('url')->isShared());

        $url = $this->di->get('url');

        $this->assertEquals('/', $url->getBaseUri());
    }
}