<?php
namespace Employees;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\EventManager\EventInterface;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Falc\Flysystem\Plugin\Symlink\Local as LocalSymlinkPlugin;
use Employees\Controller\User\ListController;
use Employees\Controller\User\ShowController;
use Employees\Controller\User\AddController;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface,
                        ServiceProviderInterface, BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $navigator = $e->getApplication()->getServiceManager()->get('Navigation\Menu\Navigator');
        $navigator->addEntry('Employees', 'employees-list', 'menu-icon fa fa-users');
    }

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
                'Employees\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    $fileSystem = new Filesystem(new LocalAdapter(__DIR__));
                    $fileSystem->addPlugin(new LocalSymlinkPlugin\Symlink());

                    return new InitController(
                        $sl->get('Zend\Db\Adapter\Adapter'),
                        $sl->get('Zend\Db\Metadata\Metadata'),
                        $fileSystem
                    );
                },
                'Employees\Controller\User\List' => function (ControllerManager $cm) {
                    return new ListController();
                },
                'Employees\Controller\User\Show' => function (ControllerManager $cm) {
                    return new ShowController();
                },
                'Employees\Controller\User\Add' => function (ControllerManager $cm) {
                    return new AddController();
                },
            ),
        );
    }
}
