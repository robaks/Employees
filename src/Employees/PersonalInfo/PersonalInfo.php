<?php

namespace Employees\PersonalInfo;

use Base\Domain\Entity;

class PersonalInfo extends Entity {
    
    protected $employeeId;
    protected $birthday;
    protected $phone;
    protected $passport;
    protected $ipn;
    protected $address;
    protected $registrationAddress;
    protected $contacts;

    public function getId() {
        return $this->employeeId;
    }

}
