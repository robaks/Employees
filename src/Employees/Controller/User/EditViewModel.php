<?php

namespace T4webEmployees\Controller\User;

use Zend\View\Model\ViewModel;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Employee\Status;
use T4webEmployees\Employee\Employee;

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
