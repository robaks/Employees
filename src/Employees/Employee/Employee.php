<?php

namespace Employees\Employee;

use Base\Domain\Entity;
use Employees\WorkInfo\WorkInfo;

class Employee extends Entity {
    
    protected $name;
    protected $surname;
    protected $patronymic;
    protected $avatar;

    /**
     * @var WorkInfo
     */
    protected $workInfo;

    /**
     * @return WorkInfo
     */
    public function getWorkInfo()
    {
        return $this->workInfo;
    }

    /**
     * @param WorkInfo $workInfo
     */
    public function setWorkInfo(WorkInfo $workInfo)
    {
        $this->workInfo = $workInfo;
    }



}
