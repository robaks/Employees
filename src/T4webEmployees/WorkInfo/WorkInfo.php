<?php

namespace T4webEmployees\WorkInfo;

use T4webBase\Domain\Entity;
use T4webEmployees\Employee\JobTitle;

class WorkInfo extends Entity {

    /**
     * @var integer
     */
    protected $employeeId;

    /**
     * @var integer
     */
    protected $jobTitleId;

    /**
     * @var integer
     */
    protected $statusId;

    protected $startWorkDate;
    protected $endWorkDate;

    /**
     * @var JobTitle
     */
    protected $jobTitle;

    public function __construct(array $data = array())
    {
        $this->populate($data);
        $this->id = (int)$data['employeeId'];
        $this->jobTitle = JobTitle::create($data['jobTitleId']);
    }

    public function getId() {
        return $this->employeeId;
    }

    /**
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * @return int
     */
    public function getJobTitleId()
    {
        return $this->jobTitleId;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @return mixed
     */
    public function getStartWorkDate()
    {
        return $this->startWorkDate;
    }

    /**
     * @return mixed
     */
    public function getEndWorkDate()
    {
        return ($this->endWorkDate == '0000-00-00') ? '' : $this->endWorkDate;
    }

    /**
     * @return JobTitle
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

}
