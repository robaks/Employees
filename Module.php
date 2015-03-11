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
use Employees\Controller\User\EditController;
use Employees\Controller\User\AddController;
use Employees\Controller\User\CreateAjaxController;
use Employees\Controller\User\SaveAjaxController;
use Employees\Controller\Console\InitController;
use Employees\Employee\Service\WorkInfoPopulate;
use Employees\Employee\Service\PersonalInfoPopulate;
use Employees\Employee\Service\SocialPopulate;

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
                    $eventManager = $sm->get('EventManager');
                    $eventManager->addIdentifiers('Employees\Employee\Service\Create');

                    return new ServiceCreate(
                        $sm->get('Employees\Employee\InputFilter\Create'),
                        $sm->get('Employees\Employee\Repository\DbRepository'),
                        $sm->get('Employees\Employee\Factory\EntityFactory'),
                        $eventManager
                    );
                },

                'Employees\Employee\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('Employees\Employee\Repository\DbRepository'),
                        $sm->get('Employees\Employee\Criteria\CriteriaFactory')
                    );
                },

                'Employees\Employee\Service\WorkInfoPopulate' =>  function (ServiceManager $sm) {
                    return new WorkInfoPopulate(
                        $sm->get('Employees\WorkInfo\Service\Finder')
                    );
                },

                'Employees\Employee\Service\PersonalInfoPopulate' =>  function (ServiceManager $sm) {
                    return new PersonalInfoPopulate(
                        $sm->get('Employees\PersonalInfo\Service\Finder')
                    );
                },

                'Employees\Employee\Service\SocialPopulate' =>  function (ServiceManager $sm) {
                    return new SocialPopulate(
                        $sm->get('Employees\Social\Service\Finder')
                    );
                },

                'Employees\PersonalInfo\Service\Create' => function (ServiceManager $sm) {
                    return new ServiceCreate(
                        $sm->get('Employees\PersonalInfo\InputFilter\Create'),
                        $sm->get('Employees\PersonalInfo\Repository\DbRepository'),
                        $sm->get('Employees\PersonalInfo\Factory\EntityFactory')
                    );
                },

                'Employees\PersonalInfo\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('Employees\PersonalInfo\Repository\DbRepository'),
                        $sm->get('Employees\PersonalInfo\Criteria\CriteriaFactory')
                    );
                },

                'Employees\WorkInfo\Service\Create' => function (ServiceManager $sm) {
                    return new ServiceCreate(
                        $sm->get('Employees\WorkInfo\InputFilter\Create'),
                        $sm->get('Employees\WorkInfo\Repository\DbRepository'),
                        $sm->get('Employees\WorkInfo\Factory\EntityFactory')
                    );
                },

                'Employees\WorkInfo\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('Employees\WorkInfo\Repository\DbRepository'),
                        $sm->get('Employees\WorkInfo\Criteria\CriteriaFactory')
                    );
                },

                'Employees\Social\Service\Create' => function (ServiceManager $sm) {
                    return new ServiceCreate(
                        $sm->get('Employees\Social\InputFilter\Create'),
                        $sm->get('Employees\Social\Repository\DbRepository'),
                        $sm->get('Employees\Social\Factory\EntityFactory')
                    );
                },

                'Employees\Social\Service\Finder' => function (ServiceManager $sm) {
                    return new ServiceFinder(
                        $sm->get('Employees\Social\Repository\DbRepository'),
                        $sm->get('Employees\Social\Criteria\CriteriaFactory')
                    );
                },
            ),
            'invokables' => array(
                'Employees\ViewModel\SaveAjaxViewModel' => 'Employees\ViewModel\SaveAjaxViewModel',
                'Employees\Controller\User\AddViewModel' => 'Employees\Controller\User\AddViewModel',
                'Employees\Controller\User\ListViewModel' => 'Employees\Controller\User\ListViewModel',
                'Employees\Controller\User\ShowViewModel' => 'Employees\Controller\User\ShowViewModel',
                'Employees\Controller\User\EditViewModel' => 'Employees\Controller\User\EditViewModel',

                'Employees\Employee\InputFilter\Create' => 'Employees\Employee\InputFilter\Create',
                'Employees\PersonalInfo\InputFilter\Create' => 'Employees\PersonalInfo\InputFilter\Create',
                'Employees\WorkInfo\InputFilter\Create' => 'Employees\WorkInfo\InputFilter\Create',
                'Employees\Social\InputFilter\Create' => 'Employees\Social\InputFilter\Create',
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
                        $sl->get('Employees\Employee\Service\PersonalInfoPopulate'),
                        $sl->get('Employees\Employee\Service\WorkInfoPopulate'),
                        $sl->get('Employees\Employee\Service\SocialPopulate'),
                        $sl->get('Employees\Controller\User\ListViewModel')
                    );
                },
                'Employees\Controller\User\Show' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new ShowController(
                        $sl->get('Employees\Employee\Service\Finder'),
                        $sl->get('Employees\Employee\Service\PersonalInfoPopulate'),
                        $sl->get('Employees\Employee\Service\WorkInfoPopulate'),
                        $sl->get('Employees\Employee\Service\SocialPopulate'),
                        $sl->get('Employees\Controller\User\ShowViewModel')
                    );
                },
                'Employees\Controller\User\Edit' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new EditController(
                        $sl->get('Employees\Employee\Service\Finder'),
                        $sl->get('Employees\Employee\Service\PersonalInfoPopulate'),
                        $sl->get('Employees\Employee\Service\WorkInfoPopulate'),
                        $sl->get('Employees\Employee\Service\SocialPopulate'),
                        $sl->get('Employees\Controller\User\EditViewModel')
                    );
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
                        $sl->get('Employees\PersonalInfo\Service\Create'),
                        $sl->get('Employees\WorkInfo\Service\Create'),
                        $sl->get('Employees\Social\Service\Create')
                    );
                },
                'Employees\Controller\User\SaveAjax' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new SaveAjaxController(
                        $sl->get('Employees\ViewModel\SaveAjaxViewModel'),
                        $sl->get('Employees\Employee\Service\Create'),
                        $sl->get('Employees\PersonalInfo\Service\Create'),
                        $sl->get('Employees\WorkInfo\Service\Create')
                    );
                },
            ),
        );
    }
}
