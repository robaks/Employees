<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class CreateAjaxControllerTest extends \PHPUnit_Framework_TestCase
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
        $this->serviceManager->setService('Employees\PersonalInfo\Service\Create', $serviceMock);
        $this->serviceManager->setService('Employees\WorkInfo\Service\Create', $serviceMock);
        $this->serviceManager->setService('Employees\Social\Service\Create', $serviceMock);

        $this->assertTrue($this->controllerManager->has('Employees\Controller\User\CreateAjax'));

        $controller = $this->controllerManager->get('Employees\Controller\User\CreateAjax');

        $this->assertInstanceOf('Employees\Controller\User\CreateAjaxController', $controller);
        $this->assertAttributeSame($viewMock, 'view', $controller);
        $this->assertAttributeSame($serviceMock, 'createService', $controller);
        $this->assertAttributeSame($serviceMock, 'personalInfoCreateService', $controller);
        $this->assertAttributeSame($serviceMock, 'workInfoCreateService', $controller);
        $this->assertAttributeSame($serviceMock, 'socialCreateService', $controller);
    }

}