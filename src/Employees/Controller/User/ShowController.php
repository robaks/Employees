<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Base\Domain\Service\BaseFinder;
use Employees\Employee\Service\PersonalInfoPopulate;
use Employees\Employee\Service\WorkInfoPopulate;
use Employees\Employee\Service\SocialPopulate;
use Employees\Employee\Employee;

class ShowController extends AbstractActionController {

    /**
     * @var BaseFinder
     */
    private $employeeFinder;

    /**
     * @var ListViewModel
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
        ShowViewModel $view)
    {
        $this->employeeFinder = $employeeFinder;
        $this->personalPopulator = $personalPopulator;
        $this->workInfoPopulator = $workInfoPopulator;
        $this->socialPopulator = $socialPopulator;
        $this->view = $view;
    }

    /**
     * @return ListViewModel
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
