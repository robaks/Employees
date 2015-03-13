<?php

namespace T4webEmployees\Social\Criteria;

use T4webBase\Domain\Criteria\AbstractCriteria;

class EmployeeIds extends AbstractCriteria {
    
    protected $field = 'employee_id';
    protected $table = 'employees_social';
    protected $buildMethod = 'addFilterIn';
}
