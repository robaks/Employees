<?php

namespace T4webEmployees\Employee;

use Base\Domain\Collection;

class EmployeeCollection extends Collection {

    /**
     * @return EmployeeCollection
     */
    public function getTopManagers()
    {
        $managers = new self();

        /** @var $employee Employee */
        foreach($this as $employee) {
            if (in_array($employee->getWorkInfo()->getJobTitleId(), [JobTitle::CEO, JobTitle::CTO])) {
                $managers->append($employee);
            }
        }

        return $managers;
    }

    public function getWorkers()
    {
        $workers = new self();

        /** @var $employee Employee */
        foreach($this as $employee) {
            if (!in_array($employee->getWorkInfo()->getJobTitleId(), [JobTitle::CEO, JobTitle::CTO])) {
                $workers->append($employee);
            }
        }

        return $workers;
    }
    
}
