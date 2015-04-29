<?php

namespace T4webEmployees\Salary\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\InArray;
use T4webBase\InputFilter\Element\Date;
use T4webBase\InputFilter\Element\Int;
use T4webBase\InputFilter\Element\Id;
use T4webEmployees\Salary\Currency;

class Create extends InputFilter {
    
    public function __construct() {

        // id
        $id = new Id('id');
        $id->setRequired(false);
        $this->add($id);

        // employee_id
        $employeeId = new Int('employeeId');
        $employeeId->setRequired(true);
        $this->add($employeeId);

        // amount
        $amount = new Int('amount');
        $amount->setRequired(true);
        $this->add($amount);

        // currency
        $currency = new InArray('currency', array_keys(Currency::getAll()));
        $currency->setRequired(true);
        $this->add($currency);

        // date
        $date = new Date('date', 'Y-m-d');
        $date->setRequired(true);
        $this->add($date);

    }
}
