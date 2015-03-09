<?php

namespace Employees\Controller\User;

use Zend\View\Model\ViewModel;
use Employees\Employee\Employee;
use Employees\Employee\EmployeeCollection;
use Employees\Employee\JobTitle;

class ListViewModel extends ViewModel {

    /**
     * @var Collection
     */
    private $employees;

    /**
     * @return EmployeeCollection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param EmployeeCollection $employees
     */
    public function setEmployees(EmployeeCollection $employees)
    {
        $this->employees = $employees;
    }

    public function getEmployeeColorClass(Employee $employee)
    {
        $class= '';

        switch ($employee->getWorkInfo()->getJobTitleId()) {
            case JobTitle::JUNIOR_SOFTWARE_DEVELOPER:
            case JobTitle::MIDDLE_SOFTWARE_DEVELOPER:
            case JobTitle::SENIOR_SOFTWARE_DEVELOPER:
            case JobTitle::LEAD_SOFTWARE_DEVELOPER:
                $class = 'panel-success';
                break;

            case JobTitle::JUNIOR_QA_ENGINEER:
            case JobTitle::MIDDLE_QA_ENGINEER:
            case JobTitle::SENIOR_QA_ENGINEER:
            case JobTitle::LEAD_QA_ENGINEER:
                $class = 'panel-danger';
                break;

            case JobTitle::PROJECT_MANAGER:
                $class = 'panel-warning';
                break;

            case JobTitle::FRONTEND_ENGINEER:
            case JobTitle::DESIGNER:
                $class = 'panel-info';
                break;
        }

        return $class;
    }

    public function getEmployeeIconClass(Employee $employee)
    {
        $class= '';

        switch ($employee->getWorkInfo()->getJobTitleId()) {
            case JobTitle::JUNIOR_SOFTWARE_DEVELOPER:
            case JobTitle::MIDDLE_SOFTWARE_DEVELOPER:
            case JobTitle::SENIOR_SOFTWARE_DEVELOPER:
            case JobTitle::LEAD_SOFTWARE_DEVELOPER:
                $class = 'fa-keyboard-o';
                break;

            case JobTitle::JUNIOR_QA_ENGINEER:
            case JobTitle::MIDDLE_QA_ENGINEER:
            case JobTitle::SENIOR_QA_ENGINEER:
            case JobTitle::LEAD_QA_ENGINEER:
                $class = 'fa-bug';
                break;

            case JobTitle::PROJECT_MANAGER:
                $class = 'fa-tasks';
                break;

            case JobTitle::FRONTEND_ENGINEER:
            case JobTitle::DESIGNER:
                $class = 'fa-desktop';
                break;
        }

        return $class;
    }

}
