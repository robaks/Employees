<?php

namespace T4webEmployees\Factory\Controller\User;

use T4webEmployees\Controller\User\SalaryAjaxController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SalaryAjaxControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $serviceManager = $serviceLocator->getServiceLocator();
        return new SalaryAjaxController(
            $serviceManager->get('T4webEmployees\Salary\Service\Finder'),
            $serviceManager->get('T4webEmployees\Salary\Service\Create'),
            $serviceManager->get('T4webEmployees\Salary\Service\Update'),
            $serviceManager->get('T4webEmployees\Salary\Service\Delete'),
            $serviceManager->get('T4webEmployees\ViewModel\SaveAjaxViewModel')
        );
    }
}