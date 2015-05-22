<?php

namespace T4webEmployeesTest\UnitTest\Factory\Employee\Service;

use T4webBaseTest\Factory\AbstractServiceFactoryTest;
use T4webEmployees\Factory\Employee\Service\SocialPopulateServiceFactory;

class SocialPopulateServiceFactoryTest extends AbstractServiceFactoryTest {

    public function testFactory() {
        $factory = new SocialPopulateServiceFactory();

        $this->serviceManager->setService('T4webEmployees\Social\Service\Finder', $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock());

        $this->assertInstanceOf('T4webEmployees\Employee\Service\SocialPopulate', $factory->createService($this->serviceManager));
    }
}