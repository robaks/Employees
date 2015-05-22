<?php

namespace T4webEmployees\Factory\Employee\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webBase\Domain\Service\BaseFinder as Finder;

class FinderServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceManager) {
        return new Finder(
            $serviceManager->get('T4webEmployees\Employee\Repository\DbRepository'),
            $serviceManager->get('T4webEmployees\Employee\Criteria\CriteriaFactory')
        );
    }
}