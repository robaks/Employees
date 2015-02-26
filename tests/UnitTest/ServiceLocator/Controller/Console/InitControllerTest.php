<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\Console;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class InitControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $dbAdapterMock = $this->getMockBuilder('Zend\Db\Adapter\Adapter')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('Zend\Db\Adapter\Adapter', $dbAdapterMock);

        $this->assertTrue($this->controllerManager->has('Employees\Controller\Console\Init'));

        $controller = $this->controllerManager->get('Employees\Controller\Console\Init');

        $this->assertInstanceOf('Employees\Controller\Console\InitController', $controller);

        $this->assertAttributeEquals($dbAdapterMock, 'dbAdapter', $controller);
        $this->assertAttributeInstanceOf('League\Flysystem\Filesystem', 'fileSystem', $controller);
    }

}