<?php

namespace T4webEmployeesTest\UnitTest\Factory\Employee\Service;

use T4webBaseTest\Factory\AbstractServiceFactoryTest;
use T4webEmployees\Factory\Employee\Service\PersonalInfoPopulateServiceFactory;

class PersonalInfoPopulateServiceFactoryTest extends AbstractServiceFactoryTest {

    public function testFactory() {
        $factory = new PersonalInfoPopulateServiceFactory();

        $this->serviceManager->setService('T4webEmployees\PersonalInfo\Service\Finder', $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock());

        $this->assertInstanceOf('T4webEmployees\Employee\Service\PersonalInfoPopulate', $factory->createService($this->serviceManager));
    }
}