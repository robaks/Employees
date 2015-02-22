<?php
namespace Employees;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\TableGateway\TableGateway;
use Employees\Controller\User\ListController;
use Employees\Controller\User\ShowController;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface,
                        ServiceProviderInterface
{

    public function getConfig($env = null)
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'employees init' => 'Initialize module',
        );
    }

    public function getServiceConfig()
    {
        return array();
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'Employees\Controller\User\List' => function (ControllerManager $cm) {
                    return new ListController();
                },
                'Employees\Controller\User\Show' => function (ControllerManager $cm) {
                    return new ShowController();
                },
            ),
        );
    }
}
