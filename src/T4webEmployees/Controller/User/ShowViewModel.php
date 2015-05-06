<?php

namespace T4webEmployees\Controller\User;

use Zend\View\Model\ViewModel;
use T4webEmployees\Employee\Employee;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Salary\Currency;
use T4webBase\Domain\Collection;

class ShowViewModel extends ViewModel {

    /**
     * @var Employee
     */
    private $employee;

    /**
     * @var Currency
     */
    private $currencies;

    /**
     * @var Collection
     */
    private $salaries;

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     */
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * @return Currency
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @param Currency $currencies
     */
    public function setCurrencies($currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @return Collection
     */
    public function getSalaries()
    {
        return $this->salaries;
    }

    /**
     * @param Collection $salaries
     */
    public function setSalaries($salaries)
    {
        $this->salaries = $salaries;
    }

    public function getEmployeeColorClass()
    {
        $class= '';

        switch ($this->employee->getWorkInfo()->getJobTitleId()) {
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
            case JobTitle::CTO:
            case JobTitle::CEO:
                $class = 'panel-info';
                break;
        }

        return $class;
    }

    public function getEmployeeIconClass()
    {
        $class= '';

        switch ($this->employee->getWorkInfo()->getJobTitleId()) {
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

            case JobTitle::CTO:
            case JobTitle::CEO:
                $class = 'fa-star';
                break;
        }

        return $class;
    }

}
