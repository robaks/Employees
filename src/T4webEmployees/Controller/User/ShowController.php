<?php

namespace T4webEmployees\Controller\User;

use T4webEmployees\Salary\Salary;
use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder;
use T4webEmployees\Employee\Service\PersonalInfoPopulate;
use T4webEmployees\Employee\Service\WorkInfoPopulate;
use T4webEmployees\Employee\Service\SocialPopulate;
use T4webEmployees\Employee\Employee;
use T4webEmployees\Salary\Currency;

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

    /**
     * @var BaseFinder
     */
    private $salaryFinder;

    public function __construct(
        BaseFinder $employeeFinder,
        PersonalInfoPopulate $personalPopulator,
        WorkInfoPopulate $workInfoPopulator,
        SocialPopulate $socialPopulator,
        BaseFinder $salaryFinder,
        ShowViewModel $view)
    {
        $this->employeeFinder = $employeeFinder;
        $this->personalPopulator = $personalPopulator;
        $this->workInfoPopulator = $workInfoPopulator;
        $this->socialPopulator = $socialPopulator;
        $this->salaryFinder = $salaryFinder;
        $this->view = $view;
    }

    /**
     * @return ListViewModel
     */
    public function defaultAction()
    {
        $id = $this->params('id', null);

        /** @var $employees Employee */
        $employee = $this->employeeFinder->find(['T4webEmployees' => ['Employee' => ['id' => $id]]]);

        /** @var $salaries Salary */
        $salaries = $this->salaryFinder->findMany(['T4webEmployees' => ['Salary' => ['employeeId' => $employee->getId()]]]);

        $this->personalPopulator->populate($employee);
        $this->workInfoPopulator->populate($employee);
        $this->socialPopulator->populate($employee);

        $this->view->setEmployee($employee);
        $this->view->setSalaries($salaries);
        $this->view->setCurrencies(Currency::getAll());

        return $this->view;
    }

}
