<?php

namespace T4webEmployeesTest\UnitTest\Factory\Employee\Service;

use T4webBaseTest\Factory\AbstractServiceFactoryTest;
use T4webEmployees\Factory\Employee\Service\WorkInfoPopulateServiceFactory;

class WorkInfoPopulateServiceFactoryTest extends AbstractServiceFactoryTest {

    public function testFactory() {
        $factory = new WorkInfoPopulateServiceFactory();

        $this->serviceManager->setService('T4webEmployees\WorkInfo\Service\Finder', $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock());

        $this->assertInstanceOf('T4webEmployees\Employee\Service\WorkInfoPopulate', $factory->createService($this->serviceManager));
    }
}