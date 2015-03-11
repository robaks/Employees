<?php

namespace Employees\WorkInfo\Criteria;

use Base\Domain\Criteria\AbstractCriteria;

class EmployeeIds extends AbstractCriteria {
    
    protected $field = 'employee_id';
    protected $table = 'employees_work_info';
    protected $buildMethod = 'addFilterIn';
}