<?php


namespace Tests\Unit\Modules\Admin\Components;


use Application\Modules\Admin\Components\Acl;
use Phalcon\Config;

class AclTest extends \PHPUnit_Framework_TestCase
{
    protected $acl;

    public function setUp()
    {
        $this->acl = $this->getMockBuilder('Application\Modules\Admin\Components\Acl')->getMock();
    }

    public function testPrivateResources()
    {
        $this->assertClassHasAttribute('privateResources', get_class($this->acl));
    }

    public function testRebuild()
    {
        $aclMemoryAdapter = (new Acl())->rebuild();

        $this->assertTrue($aclMemoryAdapter->getDefaultAction() === \Phalcon\Acl::DENY);

        $this->assertNotEmpty($aclMemoryAdapter->getRoles());
        $this->assertNotEmpty($aclMemoryAdapter->getResources());

        $this->assertTrue($aclMemoryAdapter->isAllowed('admin', 'index', 'index'));

        $this->assertObjectHasAttribute('filePath', $this->acl);
    }
}