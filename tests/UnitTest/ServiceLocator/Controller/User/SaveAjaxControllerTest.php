<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class SaveAjaxControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $viewMock = $this->getMockBuilder('Employees\ViewModel\SaveAjaxViewModel')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('Employees\ViewModel\SaveAjaxViewModel', $viewMock);

        $serviceMock = $this->getMockBuilder('Base\Domain\Service\Create')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('Employees\Employee\Service\Create', $serviceMock);

        $this->assertTrue($this->controllerManager->has('Employees\Controller\User\SaveAjax'));

        $controller = $this->controllerManager->get('Employees\Controller\User\SaveAjax');

        $this->assertInstanceOf('Employees\Controller\User\SaveAjaxController', $controller);
        $this->assertAttributeSame($viewMock, 'view', $controller);
        $this->assertAttributeSame($serviceMock, 'createService', $controller);
    }

}