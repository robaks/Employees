<?php

namespace T4webEmployees\Salary;

use T4webBase\Domain\Enum;

class Currency extends Enum
{
    const UAH = 1;
    const USD = 2;

    /**
     * @var array
     */
    protected static $constants = array(
        self::UAH => 'ГРН',
        self::USD => 'USD',
    );

}