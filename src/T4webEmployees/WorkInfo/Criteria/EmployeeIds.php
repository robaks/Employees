<?php

namespace T4webEmployees\WorkInfo\Criteria;

use T4webBase\Domain\Criteria\AbstractCriteria;

class EmployeeIds extends AbstractCriteria {
    
    protected $field = 'employee_id';
    protected $table = 'employees_work_info';
    protected $buildMethod = 'addFilterIn';
}
