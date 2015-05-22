<?php

namespace T4webEmployees\Factory\Employee\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webEmployees\Employee\Service\SocialPopulate;

class SocialPopulateServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceManager) {
        return new SocialPopulate(
            $serviceManager->get('T4webEmployees\Social\Service\Finder')
        );
    }
}