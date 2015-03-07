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
use Zend\ServiceManager\ServiceManager;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use Falc\Flysystem\Plugin\Symlink\Local as LocalSymlinkPlugin;
use Base\Domain\Service\Create as ServiceCreate;
use Base\Domain\Service\BaseFinder as ServiceFinder;
use Employees\Controller\User\ListController;
use Employees\Controller\User\ShowController;
use Employees\Controller\User\AddController;
use Employees\Controller\User\CreateAjaxController;
use Employees\Controller\User\SaveAjaxController;
use Employees\Controller\Console\InitController;

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
        return array(
            'factories' => array(
                'Employees\Employee\Service\Create' => function (ServiceManager $sm) {
                    return new ServiceCreate(
                        $sm->get('Employees\Employee\InputFilter\Create'),
                        $sm->get('Employees\Employee\Repository\DbRepository'),
                        $sm->get('Employees\Employee\Factory\EntityFactory')
                    );
                },

                'Employees\Employee\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('Employees\Employee\Repository\DbRepository'),
                        $sm->get('Employees\Employee\Criteria\CriteriaFactory')
                    );
                },

                'Employees\PersonalInfo\Service\Create' => function (ServiceManager $sm) {
                    return new ServiceCreate(
                        $sm->get('Employees\PersonalInfo\InputFilter\Create'),
                        $sm->get('Employees\PersonalInfo\Repository\DbRepository'),
                        $sm->get('Employees\PersonalInfo\Factory\EntityFactory')
                    );
                },
            ),
            'invokables' => array(
                'Employees\ViewModel\SaveAjaxViewModel' => 'Employees\ViewModel\SaveAjaxViewModel',
                'Employees\Controller\User\AddViewModel' => 'Employees\Controller\User\AddViewModel',
                'Employees\Controller\User\ListViewModel' => 'Employees\Controller\User\ListViewModel',

                'Employees\Employee\InputFilter\Create' => 'Employees\Employee\InputFilter\Create',
                'Employees\PersonalInfo\InputFilter\Create' => 'Employees\PersonalInfo\InputFilter\Create',
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'Employees\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    $fileSystem = new Filesystem(new LocalAdapter(getcwd()));
                    $fileSystem->addPlugin(new LocalSymlinkPlugin\Symlink());

                    return new InitController(
                        $sl->get('Zend\Db\Adapter\Adapter'),
                        $fileSystem
                    );
                },
                'Employees\Controller\User\List' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new ListController(
                        $sl->get('Employees\Employee\Service\Finder'),
                        $sl->get('Employees\Controller\User\ListViewModel')
                    );
                },
                'Employees\Controller\User\Show' => function (ControllerManager $cm) {
                    return new ShowController();
                },
                'Employees\Controller\User\Add' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new AddController(
                        $sl->get('Employees\Controller\User\AddViewModel')
                    );
                },
                'Employees\Controller\User\CreateAjax' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new CreateAjaxController(
                        $sl->get('Employees\ViewModel\SaveAjaxViewModel'),
                        $sl->get('Employees\Employee\Service\Create'),
                        $sl->get('Employees\PersonalInfo\Service\Create')
                    );
                },
                'Employees\Controller\User\SaveAjax' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new SaveAjaxController(
                        $sl->get('Employees\ViewModel\SaveAjaxViewModel'),
                        $sl->get('Employees\Employee\Service\Create'),
                        $sl->get('Employees\PersonalInfo\Service\Create')
                    );
                },
            ),
        );
    }
}
