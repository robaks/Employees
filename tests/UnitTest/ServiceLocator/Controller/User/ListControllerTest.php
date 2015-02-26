<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class ListControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->controllerManager->has('Employees\Controller\User\List'));

        $controller = $this->controllerManager->get('Employees\Controller\User\List');

        $this->assertInstanceOf('Employees\Controller\User\ListController', $controller);
    }

}