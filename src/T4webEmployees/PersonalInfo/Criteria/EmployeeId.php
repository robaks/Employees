<?php

namespace T4webEmployees\PersonalInfo\Criteria;

use T4webBase\Domain\Criteria\AbstractCriteria;

class EmployeeId extends AbstractCriteria {

    protected $field = 'employee_id';
    protected $table = 'employees_personal_info';
    protected $buildMethod = 'addFilterEqual';
}
