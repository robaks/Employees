<?php

namespace T4webEmployees\Employee\Criteria;

use T4webBase\Domain\Criteria\AbstractCriteria;

class Ids extends AbstractCriteria {
    
    protected $field = 'id';
    protected $table = 'employees';
    protected $buildMethod = 'addFilterIn';
}
