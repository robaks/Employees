<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/ServiceLocatorAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\ServiceLocatorAwareTrait;

class AddViewModelTest extends \PHPUnit_Framework_TestCase
{
    use ServiceLocatorAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->serviceLocator->has('Employees\Controller\User\AddViewModel'));

        $controller = $this->serviceLocator->get('Employees\Controller\User\AddViewModel');

        $this->assertInstanceOf('Employees\Controller\User\AddViewModel', $controller);
    }

}