<?php

namespace T4webEmployees\Controller\User;

use T4webEmployees\Salary\Currency;
use Zend\View\Model\ViewModel;
use T4webEmployees\Employee\Employee;
use T4webEmployees\Employee\EmployeeCollection;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Employee\Status;
use T4webBase\Domain\Collection;
use T4webEmployees\Salary\Salary;

class ListViewModel extends ViewModel
{

    /**
     * @var Collection
     */
    private $employees;

    /**
     * @var Collection
     */
    private $salaries;

    /**
     * @var /DateTime
     */
    private $current;

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

    /**
     * @return Collection
     */
    public function getSalaries($employeeId = 0)
    {
        if (!empty($employeeId) && isset($this->salaries[$employeeId])) {
            return $this->salaries[$employeeId];
        }

        if (empty($employeeId)) {
            return $this->salaries;
        }

        return false;
    }

    /**
     * @param Collection $salaries
     */
    public function setSalaries(Collection $salaries)
    {
        $this->salaries = $salaries;
    }

    /**
     * @return /DateTime
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param mixed $current
     */
    public function setCurrent($current)
    {
        $this->current = \DateTime::createFromFormat('Y-m-d', $current . '-01-01');
    }

    /**
     * @return Currency
     */
    public function getCurrencies()
    {
        return Currency::getAll();
    }

    public function getMonthsList()
    {

        $months = array();
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = date('F', mktime(0, 0, 0, $i, 1));
        }

        return $months;
    }

    /**
     * @param $employeeId
     * @param $month
     * @return bool|Salary
     */
    public function getMonthAmount(Employee $employee, $month)
    {
        // if employee dismissed
        if($employee->getWorkInfo()->getStatusId() == Status::DISMISSED) {
            if(date('Y-m', strtotime($employee->getWorkInfo()->getEndWorkDate())) < $this->getCurrent()->format('Y') . '-' . sprintf("%'.02d", $month)) {
                return false;
            }
        }

        $salaries = $this->getSalaries();
        $salariesByEmployeeId = $salaries->getAllByAttributeValue($employee->getId(), 'employeeId');
        if (!$salariesByEmployeeId->count()) {
            return false;
        }

        $salaryDateTimes = $salariesByEmployeeId->getValuesByAttribute('date', true);
        $salaryIdByDate = [];
        foreach ($salaryDateTimes as $salaryId => $salaryDateTime) {
            if (date('Y-m', strtotime($salaryDateTime)) <= $this->getCurrent()->format('Y') . '-' . sprintf("%'.02d", $month)) {
                $salaryIdByDate[$salaryDateTime] = $salaryId;
            }
        }

        if (empty($salaryIdByDate)) {
            return false;
        }

        // sort by date
        ksort($salaryIdByDate);
        // array_pop: get last salaryId by last date
        return $salaries->offsetGet( array_pop($salaryIdByDate) );
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
        $class = '';

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
