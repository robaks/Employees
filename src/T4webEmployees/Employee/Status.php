<?php

namespace T4webEmployees\Employee;

use T4webBase\Domain\Status as DomainStatus;

class Status extends DomainStatus {
    
    const PROBATION = 1;
    const WORKING = 2;
    const DISMISSED = 3;
    const REMOTE = 4;

    /**
     * @var array
     */
    protected static $constants = array(
        self::PROBATION => 'На испытательном',
        self::WORKING => 'Работает',
        self::DISMISSED => 'Уволен',
        self::REMOTE => 'Удаленный сотрудник',
    );

}