<?php

namespace Employees\Social;

use Base\Domain\Entity;

class Social extends Entity {
    
    protected $employeeId;
    protected $skype;
    protected $personalEmail;
    protected $email;
    protected $facebook;
    protected $vk;
    protected $linkedin;

    public function getId() {
        return $this->employeeId;
    }

}
