<?php

namespace T4webEmployeesTest\UnitTest\Factory\Employee\Service;

use T4webBaseTest\Factory\AbstractServiceFactoryTest;
use T4webEmployees\Factory\Employee\Service\UpdateServiceFactory;

class UpdateServiceFactoryTest extends AbstractServiceFactoryTest {

    public function testFactory() {
        $factory = new UpdateServiceFactory();

        $eventManagerMock = $this->getMock('Zend\EventManager\EventManager');
        $eventManagerMock->expects($this->once())
            ->method('addIdentifiers')
            ->with($this->equalTo('T4webEmployees\Employee\Service\Update'));

        $this->serviceManager->setService('T4webEmployees\Employee\InputFilter\Update', new \T4webEmployees\Employee\InputFilter\Update());
        $this->serviceManager->setService('T4webEmployees\Employee\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\PersonalInfo\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\WorkInfo\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Social\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Employee\Criteria\CriteriaFactory', $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\PersonalInfo\Criteria\CriteriaFactory', $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\WorkInfo\Criteria\CriteriaFactory', $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Social\Criteria\CriteriaFactory', $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('EventManager', $eventManagerMock);

        $this->assertInstanceOf('T4webEmployees\Employee\Service\Update', $factory->createService($this->serviceManager));
    }
}