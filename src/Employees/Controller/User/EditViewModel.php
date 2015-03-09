<?php

namespace Employees\Controller\User;

use Zend\View\Model\ViewModel;
use Employees\Employee\JobTitle;
use Employees\Employee\Status;
use Employees\Employee\Employee;

class EditViewModel extends ViewModel {

    /**
     * @var Employee
     */
    private $employee;

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
     * @return JobTitle
     */
    public function getJobTitles()
    {
        return JobTitle::getAll();
    }

    /**
     * @return Statuses
     */
    public function getStatuses()
    {
        return Status::getAll();
    }

}
