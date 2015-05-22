<?php

namespace T4webEmployees\Factory\Employee\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webEmployees\Employee\Service\WorkInfoPopulate;

class WorkInfoPopulateServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceManager) {
        return new WorkInfoPopulate(
            $serviceManager->get('T4webEmployees\WorkInfo\Service\Finder')
        );
    }
}