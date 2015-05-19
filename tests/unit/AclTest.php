<?php


namespace Tests\Unit;


use Phalcon\Config;

class AclTest extends \PHPUnit_Framework_TestCase
{
    public $acl;

    public function setUp()
    {
        $this->acl = $this->getMockBuilder('Application\Acl')->getMock();
    }

    public function testGetAcl()
    {
        $this->assertClassHasAttribute('filePath', get_class($this->acl));
    }
}