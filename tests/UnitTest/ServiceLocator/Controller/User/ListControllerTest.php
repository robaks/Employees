<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class ListControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $finderMock = $this->getMockBuilder('Base\Domain\Service\BaseFinder')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('Employees\Employee\Service\Finder', $finderMock);

        $viewMock = $this->getMockBuilder('Employees\Controller\User\ListViewModel')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('Employees\Controller\User\ListViewModel', $viewMock);

        $this->assertTrue($this->controllerManager->has('Employees\Controller\User\List'));

        $controller = $this->controllerManager->get('Employees\Controller\User\List');

        $this->assertInstanceOf('Employees\Controller\User\ListController', $controller);
        $this->assertAttributeSame($finderMock, 'finder', $controller);
        $this->assertAttributeSame($viewMock, 'view', $controller);
    }

}