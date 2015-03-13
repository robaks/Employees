<?php

namespace T4webEmployees\Employee\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Id;
use T4webBase\InputFilter\Element\Name;
use T4webBase\InputFilter\Element\InArray;
use T4webBase\InputFilter\Element\Date;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Employee\Status;

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
        $jobTitle = new InArray('jobTitleId', array_keys(JobTitle::getAll()));
        $jobTitle->setRequired(true);
        $this->add($jobTitle);

        // status
        $status = new InArray('statusId', array_keys(Status::getAll()));
        $status->setRequired(true);
        $this->add($status);

        // start_work_date
        $startWorkDate = new Date('startWorkDate', 'Y-m-d');
        $startWorkDate->setRequired(true);
        $this->add($startWorkDate);
    }
}
