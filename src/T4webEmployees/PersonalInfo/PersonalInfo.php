<?php

namespace T4webEmployees\PersonalInfo;

use DateTime;
use T4webBase\Domain\Entity;

class PersonalInfo extends Entity {

    /**
     * @var integer
     */
    protected $employeeId;

    /**
     * @var DateTime
     */
    protected $birthday;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $passport;

    /**
     * @var string
     */
    protected $ipn;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $registrationAddress;

    /**
     * @var string
     */
    protected $contacts;

    public function getId() {
        return $this->employeeId;
    }

    /**
     * @return DateTime
     */
    public function getBirthday()
    {
        return ($this->birthday == '0000-00-00') ? '' : $this->birthday;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * @return string
     */
    public function getIpn()
    {
        return $this->ipn;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getRegistrationAddress()
    {
        return $this->registrationAddress;
    }

    /**
     * @return string
     */
    public function getContacts()
    {
        return $this->contacts;
    }

}
