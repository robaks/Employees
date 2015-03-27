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
    protected $employeeFinder;

    /**
     * @var EditViewModel
     */
    protected $view;

    /**
     * @var WorkInfoPopulate
     */
    protected $workInfoPopulator;

    /**
     * @var PersonalInfoPopulate
     */
    protected $personalPopulator;

    /**
     * @var SocialPopulate
     */
    protected $socialPopulator;

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
        $employee = $this->employeeFinder->find(['T4webEmployees' => ['Employee' => ['id' => $id]]]);

        $this->personalPopulator->populate($employee);
        $this->workInfoPopulator->populate($employee);
        $this->socialPopulator->populate($employee);

        $this->view->setEmployee($employee);
        return $this->view;
    }

}
