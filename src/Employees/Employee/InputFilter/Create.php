<?php

namespace Employees\Employee\InputFilter;

use Base\InputFilter\InputFilter;
use Base\InputFilter\Element\Id;
use Base\InputFilter\Element\Name;
use Base\InputFilter\Element\InArray;
use Base\InputFilter\Element\Date;
use Employees\Employee\JobTitle;
use Employees\Employee\Status;

class Create extends InputFilter {
    
    public function __construct() {
        
        //id
        $id = new Id('id');
        $id->setRequired(false);
        $this->add($id);
        
        // name
        $name = new Name('name', 1, 50);
        $name->setRequired(true);
        $this->add($name);

        // surname
        $surname = new Name('surname', 1, 50);
        $surname->setRequired(true);
        $this->add($surname);

        // patronymic
        $patronymic = new Name('patronymic', 1, 50);
        $patronymic->setRequired(true);
        $this->add($patronymic);

        // job_title
        $jobTitle = new InArray('jobTitle', array_keys(JobTitle::getAll()));
        $jobTitle->setRequired(true);
        $this->add($jobTitle);

        // status
        $jobTitle = new InArray('status', array_keys(Status::getAll()));
        $jobTitle->setRequired(true);
        $this->add($jobTitle);

        // start_work_date
        $startWorkDate = new Date('startWorkDate', 'Y-m-d');
        $startWorkDate->setRequired(true);
        $this->add($startWorkDate);
    }
}
