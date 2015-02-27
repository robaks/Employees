<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/Controller/ControllerManagerAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\Controller\ControllerManagerAwareTrait;

class SaveAjaxControllerTest extends \PHPUnit_Framework_TestCase
{
    use ControllerManagerAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->controllerManager->has('Employees\Controller\User\SaveAjax'));

        $controller = $this->controllerManager->get('Employees\Controller\User\SaveAjax');

        $this->assertInstanceOf('Employees\Controller\User\SaveAjaxController', $controller);
    }

}