<?php

namespace Employees\Social\Criteria;

use Base\Domain\Criteria\AbstractCriteria;

class EmployeeIds extends AbstractCriteria {
    
    protected $field = 'employee_id';
    protected $table = 'employees_social';
    protected $buildMethod = 'addFilterIn';
}
