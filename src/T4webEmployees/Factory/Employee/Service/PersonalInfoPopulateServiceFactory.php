<?php

namespace T4webEmployees\Factory\Employee\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webEmployees\Employee\Service\PersonalInfoPopulate;

class PersonalInfoPopulateServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceManager) {
        return new PersonalInfoPopulate(
            $serviceManager->get('T4webEmployees\PersonalInfo\Service\Finder')
        );
    }
}