<?php

namespace Employees\PersonalInfo\Criteria;

use Base\Domain\Criteria\AbstractCriteria;

class EmployeeIds extends AbstractCriteria {
    
    protected $field = 'employee_id';
    protected $table = 'employees_personal_info';
    protected $buildMethod = 'addFilterIn';
}
