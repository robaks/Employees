<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use T4webEmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class SaveAjaxControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $viewMock = $this->getMockBuilder('T4webEmployees\ViewModel\SaveAjaxViewModel')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\ViewModel\SaveAjaxViewModel', $viewMock);

        $serviceMock = $this->getMockBuilder('T4webBase\Domain\Service\Create')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Employee\Service\Create', $serviceMock);
        $this->serviceManager->setService('T4webEmployees\PersonalInfo\Service\Create', $serviceMock);
        $this->serviceManager->setService('T4webEmployees\WorkInfo\Service\Create', $serviceMock);

        $this->assertTrue($this->controllerManager->has('T4webEmployees\Controller\User\SaveAjax'));

        $controller = $this->controllerManager->get('T4webEmployees\Controller\User\SaveAjax');

        $this->assertInstanceOf('T4webEmployees\Controller\User\SaveAjaxController', $controller);
        $this->assertAttributeSame($viewMock, 'view', $controller);
        $this->assertAttributeSame($serviceMock, 'createService', $controller);
        $this->assertAttributeSame($serviceMock, 'personalInfoCreateService', $controller);
        $this->assertAttributeSame($serviceMock, 'workInfoCreateService', $controller);
    }

}