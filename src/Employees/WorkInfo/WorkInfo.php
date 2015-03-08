<?php

namespace Employees\WorkInfo;

use Base\Domain\Entity;

class WorkInfo extends Entity {
    
    protected $employeeId;
    protected $jobTitleId;
    protected $statusId;
    protected $startWorkDate;
    protected $endWorkDate;

    public function __construct(array $data = array())
    {
        $this->populate($data);
        $this->id = (int)$data['employeeId'];
    }

    public function getId() {
        return $this->employeeId;
    }

}
