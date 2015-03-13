<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator\Controller\User;

require_once TESTS_FOLDER_PATH . "/UnitTest/ServiceLocator/ServiceLocatorAwareTrait.php";
use T4webEmployeesTest\UnitTest\ServiceLocator\ServiceLocatorAwareTrait;

class ListViewModelTest extends \PHPUnit_Framework_TestCase
{
    use ServiceLocatorAwareTrait;

    public function testCreation()
    {
        $this->assertTrue($this->serviceLocator->has('T4webEmployees\Controller\User\ListViewModel'));

        $controller = $this->serviceLocator->get('T4webEmployees\Controller\User\ListViewModel');

        $this->assertInstanceOf('T4webEmployees\Controller\User\ListViewModel', $controller);
    }

}