<?php
namespace EmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/ServiceLocatorAwareTrait.php";
use EmployeesTest\UnitTest\ServiceLocator\ServiceLocatorAwareTrait;

class ListViewModelTest extends \PHPUnit_Framework_TestCase
{
    use ServiceLocatorAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->serviceLocator->has('Employees\Controller\User\ListViewModel'));

        $controller = $this->serviceLocator->get('Employees\Controller\User\ListViewModel');

        $this->assertInstanceOf('Employees\Controller\User\ListViewModel', $controller);
    }

}