<?php

namespace T4webEmployees\Controller\User;

use T4webActionInjections\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\Params;
use T4webBase\Domain\Service\BaseFinder;
use T4webEmployees\Employee\EmployeeCollection;
use T4webEmployees\Employee\Service\WorkInfoPopulate;
use T4webBase\Domain\Collection;

class SalaryListController extends AbstractActionController {

    public function sheetAction(Params $params, BaseFinder $employeesFinder, WorkInfoPopulate $workInfoPopulator, BaseFinder $salaryFinder, ListViewModel $view)
    {
        $year = $params('year', date('Y'));

        $view->setCurrent($year);

        /** @var $employees EmployeeCollection */
        $employees = $employeesFinder->findMany(['Employees' => ['WorkInfo' => ['startWorkDateTo' => $year . '-12-31']]]);
        $workInfoPopulator->populateCollection($employees);

        /** @var $salaries Collection */
        $salaries = $salaryFinder->findMany();

        $view->setEmployees($employees);
        $view->setSalaries($salaries);

        return $view;
    }

}