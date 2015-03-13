<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator\Controller\Console;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use T4webEmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class InitControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $dbAdapterMock = $this->getMockBuilder('Zend\Db\Adapter\Adapter')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('Zend\Db\Adapter\Adapter', $dbAdapterMock);

        $this->assertTrue($this->controllerManager->has('T4webEmployees\Controller\Console\Init'));

        $controller = $this->controllerManager->get('T4webEmployees\Controller\Console\Init');

        $this->assertInstanceOf('T4webEmployees\Controller\Console\InitController', $controller);

        $this->assertAttributeEquals($dbAdapterMock, 'dbAdapter', $controller);
        $this->assertAttributeInstanceOf('League\Flysystem\Filesystem', 'fileSystem', $controller);
    }

}