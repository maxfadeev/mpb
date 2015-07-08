<?php


namespace Tests\Unit\Modules\Users;


use Application\Di;
use Application\Modules\Users\Module;

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
            'Application\Modules\Users\Controllers' => APP_DIR . '/modules/users/controllers/',
            'Application\Modules\Users\Models' => APP_DIR . '/modules/users/models/',
        ], $loader->getNamespaces());
    }

    public function testRegisterServices()
    {
        $mock = $this->getMockBuilder('Application\Modules\Users\Module')
            ->setMethods(['setDispatcher', 'setView', 'setAuth'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertClassHasAttribute('di', 'Application\Modules\Admin\Module');

        $mock->expects($this->once())
            ->method('setDispatcher');

        $mock->expects($this->once())
            ->method('setView');

        $mock->expects($this->once())
            ->method('setAuth');

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
        $this->assertEquals('Application\Modules\Users\Controllers', $dispatcher->getDefaultNamespace());
    }

    /**
     * @depends testRegisterServices
     */
    public function testSetView()
    {
        $module = new Module();
        $module->registerServices($this->di);

        $view = $this->di->get('view');

        $this->assertEquals(APP_DIR . '/modules/users/views/', $view->getViewsDir());

        $this->assertArrayHasKey('.volt', $view->getRegisteredEngines());

        $volt = $view->getRegisteredEngines()['.volt'];

        $this->assertEquals([
            'compiledPath' => APP_DIR . '/cache/volt/',
            'compiledSeparator' => '_'
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
}