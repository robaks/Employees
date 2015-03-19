<?php

namespace T4webEmployees\Social\Criteria;

use T4webBase\Domain\Criteria\AbstractCriteria;

class EmployeeId extends AbstractCriteria {

    protected $field = 'employee_id';
    protected $table = 'employees_social';
    protected $buildMethod = 'addFilterEqual';
}
