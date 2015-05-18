<?php


namespace Tests\Unit;


use Phalcon\Config;
use Phalcon\DiInterface;
use Phalcon\Test\UnitTestCase;

class DispatcherListenerTest extends UnitTestCase
{
    /**
     * @var \Application\Acl
     */
    protected $acl;

    /**
     * @var \Application\Modules\Users\Components\Auth
     */
    protected $auth;

    public function setUp(DiInterface $di = null, Config $config = null)
    {
        parent::setUp($di, $config);

        $this->acl = $this->getMockBuilder('Application\Acl')
            ->setMethods(['isPrivate', 'isAllowed'])
            ->getMock();

        $this->acl->expects($this->any())
            ->method('isPrivate')
            ->will($this->returnValue(true));
        $this->acl->expects($this->any())
            ->method('isAllowed')
            ->will($this->returnValue(true));

        $this->auth = $this->getMockBuilder('Application\Modules\Users\Components\Auth')
            ->setMethods(['getIdentity'])
            ->getMock();

        $this->auth->expects($this->any())
            ->method('getIdentity')
            ->will($this->returnValue(['id' => 7, 'login' => 'some-login']));
    }

    public function testBeforeExecuteRoute()
    {
        $this->assertTrue($this->acl->isPrivate('users'));

        $this->assertTrue($this->acl->isAllowed('some-login', 'users', 'add'));
    }
}