<?php

namespace Employees\WorkInfo;

use Base\Domain\Entity;

class WorkInfo extends Entity {
    
    protected $employeeId;
    protected $jobTitleId;
    protected $statusId;
    protected $startWorkDate;
    protected $endWorkDate;

    public function getId() {
        return $this->employeeId;
    }

}
