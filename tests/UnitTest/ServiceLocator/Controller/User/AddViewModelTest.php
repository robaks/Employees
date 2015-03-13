<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/ServiceLocatorAwareTrait.php";
use T4webEmployeesTest\UnitTest\ServiceLocator\ServiceLocatorAwareTrait;

class AddViewModelTest extends \PHPUnit_Framework_TestCase
{
    use ServiceLocatorAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->serviceLocator->has('T4webEmployees\Controller\User\AddViewModel'));

        $controller = $this->serviceLocator->get('T4webEmployees\Controller\User\AddViewModel');

        $this->assertInstanceOf('T4webEmployees\Controller\User\AddViewModel', $controller);
    }

}