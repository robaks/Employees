<?php

namespace T4webEmployees\Factory\Employee\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webEmployees\Employee\Service\Create;

class CreateServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceManager) {
        $eventManager = $serviceManager->get('EventManager');
        $eventManager->addIdentifiers('T4webEmployees\Employee\Service\Create');

        return new Create(
            $serviceManager->get('T4webEmployees\Employee\InputFilter\Create'),
            $serviceManager->get('T4webEmployees\Employee\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\PersonalInfo\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\WorkInfo\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\Social\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\Employee\Factory\EntityFactory'),
            $serviceManager->get('T4webEmployees\PersonalInfo\Factory\EntityFactory'),
            $serviceManager->get('T4webEmployees\WorkInfo\Factory\EntityFactory'),
            $serviceManager->get('T4webEmployees\Social\Factory\EntityFactory'),
            $eventManager
        );
    }
}