<?php

namespace T4webEmployees\Factory\Employee\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webEmployees\Employee\Service\Update;

class UpdateServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceManager) {
        $eventManager = $serviceManager->get('EventManager');
        $eventManager->addIdentifiers('T4webEmployees\Employee\Service\Update');

        return new Update(
            $serviceManager->get('T4webEmployees\Employee\InputFilter\Update'),
            $serviceManager->get('T4webEmployees\Employee\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\PersonalInfo\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\WorkInfo\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\Social\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\Employee\Criteria\CriteriaFactory'),
            $serviceManager->get('T4webEmployees\PersonalInfo\Criteria\CriteriaFactory'),
            $serviceManager->get('T4webEmployees\WorkInfo\Criteria\CriteriaFactory'),
            $serviceManager->get('T4webEmployees\Social\Criteria\CriteriaFactory'),
            $eventManager
        );
    }
}