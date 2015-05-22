<?php

namespace T4webEmployeesTest\UnitTest\Factory\Employee\Service;

use T4webBaseTest\Factory\AbstractServiceFactoryTest;
use T4webEmployees\Factory\Employee\Service\FinderServiceFactory;

class FinderServiceFactoryTest extends AbstractServiceFactoryTest {

    public function testFactory() {
        $factory = new FinderServiceFactory();

        $this->serviceManager->setService('T4webEmployees\Employee\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Employee\Criteria\CriteriaFactory', $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock());

        $this->assertInstanceOf('T4webBase\Domain\Service\BaseFinder', $factory->createService($this->serviceManager));
    }
}