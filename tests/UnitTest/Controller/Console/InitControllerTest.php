<?php
namespace EmployeesTest\UnitTest\Controller\Console;

use Employees\Controller\Console\InitController;

class InitControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testRun()
    {
        $dbAdapterMock = $this->getMockBuilder('Zend\Db\Adapter\Adapter')
            ->disableOriginalConstructor()
            ->getMock();

        $fsMock = $this->getMockBuilder('League\Flysystem\Filesystem')
            ->disableOriginalConstructor()
            ->setMethods(['symlink'])
            ->getMock();

        $controller = new InitController($dbAdapterMock, $fsMock);

        $dbAdapterMock->expects($this->once())
            ->method('query');

        $dbAdapterMock->expects($this->any())
            ->method('getPlatform')
            ->will($this->returnValue($this->getMock('Zend\Db\Adapter\Platform\Mysql')));

        $fsMock->expects($this->once())
            ->method('symlink');

        $controller->runAction();

        $this->assertAttributeEquals($dbAdapterMock, 'dbAdapter', $controller);
        $this->assertAttributeEquals($fsMock, 'fileSystem', $controller);
    }

}