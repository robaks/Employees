<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Domain\Service\BaseFinder;
use Employees\Employee\Service\PersonalInfoPopulate;
use Employees\Employee\Service\WorkInfoPopulate;
use Employees\Employee\Service\SocialPopulate;
use Employees\Employee\EmployeeCollection;

class ListController extends AbstractActionController {

    /**
     * @var BaseFinder
     */
    private $finder;

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
        BaseFinder $finder,
        PersonalInfoPopulate $personalPopulator,
        WorkInfoPopulate $workInfoPopulator,
        SocialPopulate $socialPopulator,
        ListViewModel $view)
    {
        $this->finder = $finder;
        $this->personalPopulator = $personalPopulator;
        $this->workInfoPopulator = $workInfoPopulator;
        $this->socialPopulator = $socialPopulator;
        $this->view = $view;
    }

    /**
     * @return ViewModel
     */
    public function defaultAction()
    {
        /** @var $employees EmployeeCollection */
        $employees = $this->finder->findMany();
        $this->personalPopulator->populateCollection($employees);
        $this->workInfoPopulator->populateCollection($employees);
        $this->socialPopulator->populateCollection($employees);

        $this->view->setEmployees($employees);
        return $this->view;
    }

}