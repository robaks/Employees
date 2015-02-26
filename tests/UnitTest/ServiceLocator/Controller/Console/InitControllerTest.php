<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\Console;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class InitControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->controllerManager->has('Employees\Controller\User\Add'));

        $controller = $this->controllerManager->get('Employees\Controller\User\Add');

        $this->assertInstanceOf('Employees\Controller\User\AddController', $controller);
    }

}