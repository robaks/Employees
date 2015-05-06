<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder;
use T4webBase\Domain\Collection;
use T4webEmployees\Employee\EmployeeCollection;

class SalaryListController extends AbstractActionController {

    /**
     * @var BaseFinder
     */
    private $employeesFinder;

    /**
     * @var BaseFinder
     */
    private $salaryFinder;

    /**
     * @var ListViewModel
     */
    private $view;


    public function __construct(BaseFinder $employeesFinder, BaseFinder $salaryFinder, ListViewModel $view)
    {
        $this->employeesFinder = $employeesFinder;
        $this->salaryFinder = $salaryFinder;
        $this->view = $view;
    }

    /**
     * @return ListViewModel
     */
    public function sheetAction()
    {
        $year = $this->params('year', date('Y'));

        $this->view->setCurrent($year);

        /** @var $employees EmployeeCollection */
        $employees = $this->employeesFinder->findMany();

        /** @var $salaries Collection */
        $salaries = $this->salaryFinder->findMany();

        $this->view->setEmployees($employees);
        $this->view->setSalaries($salaries);

        return $this->view;
    }

}