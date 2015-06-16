<?php


namespace Tests\Unit\Modules\Admin\Controllers;


use Application\Modules\Admin\Controllers\UsersController;
use Application\Modules\Users\Models\Users;
use Phalcon\Http\Request;
use Phalcon\Mvc\View;
use Phalcon\Security;

class UsersControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testIndexAction()
    {
        $controller = new UsersController();
        $controller->view = new View();
        $controller->indexAction();

        $paramsToView = $controller->view->getParamsToView();
        $this->assertArrayHasKey('users', $paramsToView);
        $this->assertEquals(Users::find(), $controller->view->getParamsToView()['users']);

        $this->assertArrayHasKey('token', $paramsToView);

        $this->assertTrue($controller->security->checkToken($paramsToView['token']));
    }
}