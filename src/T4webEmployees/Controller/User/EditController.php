<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder;
use T4webEmployees\Employee\Service\PersonalInfoPopulate;
use T4webEmployees\Employee\Service\WorkInfoPopulate;
use T4webEmployees\Employee\Service\SocialPopulate;
use T4webEmployees\Employee\Employee;

class EditController extends AbstractActionController {

    /**
     * @var BaseFinder
     */
    private $employeeFinder;

    /**
     * @var EditViewModel
     */
    private $view;

    /**
     * @var WorkInfoPopulate
     */
    private $workInfoPopulator;

    /**
     * @var PersonalInfoPopulate
     */
    private $personalPopulator;

    /**
     * @var SocialPopulate
     */
    private $socialPopulator;

    public function __construct(
        BaseFinder $employeeFinder,
        PersonalInfoPopulate $personalPopulator,
        WorkInfoPopulate $workInfoPopulator,
        SocialPopulate $socialPopulator,
        EditViewModel $view)
    {
        $this->employeeFinder = $employeeFinder;
        $this->personalPopulator = $personalPopulator;
        $this->workInfoPopulator = $workInfoPopulator;
        $this->socialPopulator = $socialPopulator;
        $this->view = $view;
    }

    /**
     * @return ShowViewModel
     */
    public function defaultAction()
    {
        $id = $this->params('id', null);

        /** @var $employees Employee */
        $employee = $this->employeeFinder->find(['Employees' => ['Employee' => ['id' => $id]]]);

        $this->personalPopulator->populate($employee);
        $this->workInfoPopulator->populate($employee);
        $this->socialPopulator->populate($employee);

        $this->view->setEmployee($employee);
        return $this->view;
    }

}
