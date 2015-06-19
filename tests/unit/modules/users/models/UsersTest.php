<?php


namespace Tests\Unit\Modules\Users\Models;


use Application\Modules\Users\Models\Users;

class UsersTest extends \PHPUnit_Framework_TestCase
{
    public function testModelHasColumns()
    {
        $mock = $this->getMockBuilder('Application\Modules\Users\Models\Users')
            ->getMock();

        $class = get_class($mock);
        $this->assertClassHasAttribute('id', $class);
        $this->assertClassHasAttribute('login', $class);
        $this->assertClassHasAttribute('email', $class);
        $this->assertClassHasAttribute('password', $class);
        $this->assertClassHasAttribute('role', $class);
        $this->assertClassHasAttribute('banned', $class);
        $this->assertClassHasAttribute('suspended', $class);
        $this->assertClassHasAttribute('active', $class);
    }

    public function testFindFirstById()
    {
        $this->assertNotFalse(Users::findFirstById(3));
    }

    public function testFindFirstByLogin()
    {
        $this->assertNotFalse(Users::findFirstByLogin('test'));
    }
}