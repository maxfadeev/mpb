<?php


namespace Tests\Unit\Modules\Admin\Controllers;


use Application\Modules\Admin\Controllers\UsersController;
use Application\Modules\Users\Models\Users;
use Phalcon\Http\Request;
use Phalcon\Mvc\View;
use Phalcon\Security;

class UsersControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $userController;

    public function setUp()
    {
        $this->userController = new UsersController();

        $viewMock = $this->getMock('Phalcon\Mvc\View');
        $viewMock->method('setVar');
        $viewMock->method('setVars');

        $requestMock = $this->getMock('Phalcon\Http\Request');

        $securityMock = $this->getMock('Phalcon\Security');

        $this->userController->view = $viewMock;
        $this->userController->request = $requestMock;
        $this->userController->security = $securityMock;
    }

    public function testAddActionEmptyPost()
    {
        $request = $this->userController->request;
        $request->method('isPost')->will($this->returnValue(true));
        $request->method('getPost')->will($this->returnValue([]));
        $this->userController->security->method('checkToken')->will($this->returnValue(true));

        $this->userController->addAction();
    }

    public function testAddActionInvalidPost()
    {
        $request = $this->userController->request;
        $request->method('isPost')->will($this->returnValue(true));
        $postValue = [
            'login' => '2'
        ];
        $request->method('getPost')->will($this->returnValue($postValue));
        $this->userController->security->method('checkToken')->will($this->returnValue(true));

        $this->userController->addAction();
    }
}