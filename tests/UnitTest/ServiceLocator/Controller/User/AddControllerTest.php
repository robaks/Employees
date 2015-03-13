<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use T4webEmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class AddControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $viewMock = $this->getMockBuilder('T4webEmployees\Controller\User\AddViewModel')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Controller\User\AddViewModel', $viewMock);

        $this->assertTrue($this->controllerManager->has('T4webEmployees\Controller\User\Add'));

        $controller = $this->controllerManager->get('T4webEmployees\Controller\User\Add');

        $this->assertInstanceOf('T4webEmployees\Controller\User\AddController', $controller);
        $this->assertAttributeSame($viewMock, 'view', $controller);
    }

}