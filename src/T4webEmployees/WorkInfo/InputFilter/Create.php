<?php

namespace T4webEmployees\WorkInfo\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Id;
use T4webBase\InputFilter\Element\Date;
use T4webBase\InputFilter\Element\InArray;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Employee\Status;

class Create extends InputFilter {
    
    public function __construct() {
        
        //id
        $id = new Id('employeeId');
        $id->setRequired(true);
        $this->add($id);

        // jobTitleId
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

        // endWorkDate
        $endWorkDate = new Date('endWorkDate', 'Y-m-d');
        $endWorkDate->setRequired(false);
        $this->add($endWorkDate);
    }
}
