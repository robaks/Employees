<?php

namespace Employees\Employee\Criteria;

use Base\Domain\Criteria\Id as BaseIdCriteria;

class Id extends BaseIdCriteria {
    
    protected $table = 'employees';
}
