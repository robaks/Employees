<?php

namespace Employees\Employee;

use Base\Domain\Entity;
use Employees\WorkInfo\WorkInfo;
use Employees\PersonalInfo\PersonalInfo;
use Employees\Social\Social;

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
     * @var PersonalInfo
     */
    protected $personalInfo;

    /**
     * @var Social
     */
    protected $social;

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

    /**
     * @return Social
     */
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * @param Social $social
     */
    public function setSocial($social)
    {
        $this->social = $social;
    }

    /**
     * @return PersonalInfo
     */
    public function getPersonalInfo()
    {
        return $this->personalInfo;
    }

    /**
     * @param PersonalInfo $personalInfo
     */
    public function setPersonalInfo($personalInfo)
    {
        $this->personalInfo = $personalInfo;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

}
