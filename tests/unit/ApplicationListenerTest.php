<?php


namespace Tests\Unit;


use Application\ApplicationListener;

class ApplicationListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testBoot()
    {
        $fileName = date('mdY');
        $fileName = APP_DIR . "/logs/debug{$fileName}.log";

        $mock = $this->getMockBuilder('Phalcon\Logger\Adapter\File')
            ->setMethods(['begin', 'info'])
            ->setConstructorArgs([$fileName])
            ->getMock();

        $this->assertFileExists($fileName);

        $mock->expects($this->once())
            ->method('begin');

        $mock->expects($this->once())
            ->method('info');

        $applicationListener = new ApplicationListener();
        $applicationListener->logger = $mock;
        $applicationListener->boot();
    }

    public function testAfterStartModule()
    {
        $fileName = date('mdY');
        $fileName = APP_DIR . "/logs/debug{$fileName}.log";

        $mock = $this->getMockBuilder('Phalcon\Logger\Adapter\File')
            ->setMethods(['commit'])
            ->setConstructorArgs([$fileName])
            ->getMock();

        $mock->expects($this->once())
            ->method('commit');

        $applicationListener = new ApplicationListener();
        $applicationListener->logger = $mock;
        $applicationListener->afterStartModule();
    }
}