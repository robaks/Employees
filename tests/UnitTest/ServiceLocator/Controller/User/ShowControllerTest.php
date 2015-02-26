<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class ShowControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->controllerManager->has('Employees\Controller\User\Show'));

        $controller = $this->controllerManager->get('Employees\Controller\User\Show');

        $this->assertInstanceOf('Employees\Controller\User\ShowController', $controller);
    }

}