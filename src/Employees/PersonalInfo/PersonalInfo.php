<?php

namespace Employees\PersonalInfo;

use DateTime;
use Base\Domain\Entity;

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
        return $this->birthday;
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
