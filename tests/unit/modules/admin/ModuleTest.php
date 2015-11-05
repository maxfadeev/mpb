<?php


namespace Tests\Unit\Modules\Admin;


use Application\Di;
use Application\Modules\Admin\Module;
use Phalcon\Loader;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public $di;

    public function setUp()
    {
        $this->di = new Di();
    }

    public function testRegisterAutoloaders()
    {
        $module = new Module();
        $loader = $module->registerAutoloaders($this->di);

        $this->assertEquals([
            'Application\Modules\Admin\Controllers' => APP_DIR . '/modules/admin/controllers/',
            'Application\Modules\Admin\Models' => APP_DIR . '/modules/admin/models/',
        ], $loader->getNamespaces());
    }

    public function testRegisterServices()
    {
        $mock = $this->getMockBuilder('Application\Modules\Admin\Module')
            ->setMethods(['setDispatcher', 'setView', 'setAuth', 'setAcl', 'setUrl'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertClassHasAttribute('di', 'Application\Modules\Admin\Module');

        $mock->expects($this->once())
            ->method('setDispatcher');

        $mock->expects($this->once())
            ->method('setView');

        $mock->expects($this->once())
            ->method('setAuth');

        $mock->expects($this->once())
            ->method('setAcl');

        $mock->expects($this->once())
            ->method('setUrl');

        $mock->registerServices($this->di);
    }

    /**
     * @depends testRegisterServices
     */
    public function testSetDispatcher()
    {
        $module = new Module();
        $module->registerServices($this->di);

        $dispatcher = $this->di->get('dispatcher');
        $this->assertEquals('Application\Modules\Admin\Controllers', $dispatcher->getDefaultNamespace());

        $this->assertTrue($dispatcher->getEventsManager()->hasListeners('dispatch'));
    }

    /**
     * @depends testRegisterServices
     */
    public function testSetView()
    {
        $module = new Module();
        $module->registerServices($this->di);

        $view = $this->di->get('view');

        $this->assertEquals(APP_DIR . '/modules/admin/views/', $view->getViewsDir());

        $this->assertArrayHasKey('.volt', $view->getRegisteredEngines());

        $volt = $view->getRegisteredEngines()['.volt'];

        $this->assertEquals([
            'compiledPath' => APP_DIR . '/cache/volt/',
            'compiledSeparator' => '_',
            'compileAlways' => true
        ], $volt->getOptions());
    }

    /**
     * @depends testRegisterServices
     */
    public function testSetAuth()
    {
        $module = new Module();
        $module->registerServices($this->di);

        $this->assertInstanceOf('Application\Modules\Users\Components\Auth', $this->di->get('auth'));
    }

    /**
     * @depends testRegisterServices
     */
    public function testSetAcl()
    {
        $module = new Module();
        $module->registerServices($this->di);

        $this->assertInstanceOf('Application\Modules\Admin\Components\Acl', $this->di->get('acl'));
    }

    /**
     * @depends testRegisterServices
     */
    public function testSetUrl()
    {
        $module = new Module();
        $module->registerServices($this->di);

        $url = $this->di->get('url');

        $this->assertEquals('/a', $url->getBaseUri());
    }
}