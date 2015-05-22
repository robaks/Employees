<?php

namespace T4webEmployeesTest\UnitTest\Factory\Employee\Service;

use T4webBaseTest\Factory\AbstractServiceFactoryTest;
use T4webEmployees\Factory\Employee\Service\CreateServiceFactory;

class CreateServiceFactoryTest extends AbstractServiceFactoryTest {

    public function testFactory() {
        $factory = new CreateServiceFactory();

        $eventManagerMock = $this->getMock('Zend\EventManager\EventManager');
        $eventManagerMock->expects($this->once())
            ->method('addIdentifiers')
            ->with($this->equalTo('T4webEmployees\Employee\Service\Create'));

        $this->serviceManager->setService('T4webEmployees\Employee\InputFilter\Create', new \T4webEmployees\Employee\InputFilter\Create());
        $this->serviceManager->setService('T4webEmployees\Employee\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\PersonalInfo\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\WorkInfo\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Social\Repository\DbRepository', $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock());
        $this->serviceManager->setService('T4webEmployees\Employee\Factory\EntityFactory', $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface'));
        $this->serviceManager->setService('T4webEmployees\PersonalInfo\Factory\EntityFactory', $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface'));
        $this->serviceManager->setService('T4webEmployees\WorkInfo\Factory\EntityFactory', $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface'));
        $this->serviceManager->setService('T4webEmployees\Social\Factory\EntityFactory', $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface'));
        $this->serviceManager->setService('EventManager', $eventManagerMock);

        $this->assertInstanceOf('T4webEmployees\Employee\Service\Create', $factory->createService($this->serviceManager));
    }
}