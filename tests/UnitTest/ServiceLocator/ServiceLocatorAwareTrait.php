<?php
namespace T4webEmployeesTest\UnitTest\ServiceLocator;

use T4webEmployees\Module;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Config;

trait ServiceLocatorAwareTrait
{
    /**
     * @var ServiceManager
     */
    protected $serviceLocator;

    protected function setUp()
    {
        $module = new Module();

        $this->serviceLocator = new ServiceManager(new Config($module->getServiceConfig()));
        $this->serviceLocator->setAllowOverride(true);
    }

}