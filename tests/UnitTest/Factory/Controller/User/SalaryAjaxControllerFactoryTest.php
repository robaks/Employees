<?php
namespace T4webEmployeesTest\UnitTest\Factory\Controller\User;

use T4webBaseTest\Factory\AbstractControllerFactoryTest;
use T4webEmployees\Factory\Controller\User\SalaryAjaxControllerFactory;
use T4webEmployees\ViewModel\SaveAjaxViewModel;

class SalaryAjaxControllerFactoryTest extends AbstractControllerFactoryTest
{

    public function testFactory() {
        $factory = new SalaryAjaxControllerFactory();

        $this->serviceManager->setService('T4webEmployees\Salary\Service\Finder', $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Salary\Service\Create', $this->getMockBuilder('T4webBase\Domain\Service\Create')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Salary\Service\Update', $this->getMockBuilder('T4webBase\Domain\Service\Update')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Salary\Service\Delete', $this->getMockBuilder('T4webBase\Domain\Service\Delete')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\ViewModel\SaveAjaxViewModel', new SaveAjaxViewModel());

        $this->assertInstanceOf('T4webEmployees\Controller\User\SalaryAjaxController', $factory->createService($this->controllerManager));
    }

}