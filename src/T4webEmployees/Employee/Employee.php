<?php

namespace T4webEmployees\Employee;

use T4webBase\Domain\Entity;
use T4webEmployees\WorkInfo\WorkInfo;
use T4webEmployees\PersonalInfo\PersonalInfo;
use T4webEmployees\Social\Social;

class Employee extends Entity {
    
    protected $name;
    protected $surname;
    protected $patronymic;
    protected $avatar;

    /**
     * @var WorkInfo
     */
    private $workInfo;

    /**
     * @var PersonalInfo
     */
    private $personalInfo;

    /**
     * @var Social
     */
    private $social;

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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @param mixed $patronymic
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
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

    public function getShortName()
    {
        return $this->getSurname() . ' ' . $this->getName();
    }

}
