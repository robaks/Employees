<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use T4webEmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class ShowControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $finderMock = $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Employee\Service\Finder', $finderMock);
        $this->serviceManager->setService('T4webEmployees\Salary\Service\Finder', $finderMock);


        $personalInfoPopulatorMock = $this->getMockBuilder('T4webEmployees\Employee\Service\PersonalInfoPopulate')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Employee\Service\PersonalInfoPopulate', $personalInfoPopulatorMock);

        $workInfoPopulatorMock = $this->getMockBuilder('T4webEmployees\Employee\Service\WorkInfoPopulate')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Employee\Service\WorkInfoPopulate', $workInfoPopulatorMock);

        $socialPopulatorMock = $this->getMockBuilder('T4webEmployees\Employee\Service\SocialPopulate')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Employee\Service\SocialPopulate', $socialPopulatorMock);

        $viewMock = $this->getMockBuilder('T4webEmployees\Controller\User\ShowViewModel')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Controller\User\ShowViewModel', $viewMock);


        $this->assertTrue($this->controllerManager->has('T4webEmployees\Controller\User\Show'));

        $controller = $this->controllerManager->get('T4webEmployees\Controller\User\Show');

        $this->assertInstanceOf('T4webEmployees\Controller\User\ShowController', $controller);
        $this->assertAttributeSame($finderMock, 'employeeFinder', $controller);
        $this->assertAttributeSame($finderMock, 'salaryFinder', $controller);
        $this->assertAttributeSame($personalInfoPopulatorMock, 'personalPopulator', $controller);
        $this->assertAttributeSame($workInfoPopulatorMock, 'workInfoPopulator', $controller);
        $this->assertAttributeSame($socialPopulatorMock, 'socialPopulator', $controller);
        $this->assertAttributeSame($viewMock, 'view', $controller);
    }

}