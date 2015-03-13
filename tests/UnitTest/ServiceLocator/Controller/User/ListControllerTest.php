<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use T4webEmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class ListControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $finderMock = $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Employee\Service\Finder', $finderMock);

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

        $viewMock = $this->getMockBuilder('T4webEmployees\Controller\User\ListViewModel')
            ->disableOriginalConstructor()
            ->getMock();

        $this->serviceManager->setService('T4webEmployees\Controller\User\ListViewModel', $viewMock);

        $this->assertTrue($this->controllerManager->has('T4webEmployees\Controller\User\List'));

        $controller = $this->controllerManager->get('T4webEmployees\Controller\User\List');

        $this->assertInstanceOf('T4webEmployees\Controller\User\ListController', $controller);
        $this->assertAttributeSame($finderMock, 'finder', $controller);
        $this->assertAttributeSame($personalInfoPopulatorMock, 'personalPopulator', $controller);
        $this->assertAttributeSame($workInfoPopulatorMock, 'workInfoPopulator', $controller);
        $this->assertAttributeSame($socialPopulatorMock, 'socialPopulator', $controller);
        $this->assertAttributeSame($viewMock, 'view', $controller);
    }

}