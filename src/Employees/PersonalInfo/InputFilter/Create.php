<?php

namespace Employees\PersonalInfo\InputFilter;

use Base\InputFilter\InputFilter;
use Base\InputFilter\Element\Id;
use Base\InputFilter\Element\Date;
use Base\InputFilter\Element\Phone;
use Base\InputFilter\Element\Text;

class Create extends InputFilter {
    
    public function __construct() {
        
        //id
        $id = new Id('employeeId');
        $id->setRequired(true);
        $this->add($id);
        
        // birthday
        $birthday = new Date('birthday', 'Y-m-d');
        $birthday->setRequired(false);
        $this->add($birthday);

        // phone
        $phone = new Phone('phone');
        $phone->setRequired(false);
        $this->add($phone);

        // passport
        $passport = new Text('passport', 0, 255);
        $passport->setRequired(false);
        $this->add($passport);

        // ipn
        $ipn = new Text('ipn', 0, 10);
        $ipn->setRequired(false);
        $this->add($ipn);

        // address
        $address = new Text('address', 0, 255);
        $address->setRequired(false);
        $this->add($address);

        // registrationAddress
        $registrationAddress = new Text('registrationAddress', 0, 255);
        $registrationAddress->setRequired(false);
        $this->add($registrationAddress);

        // contacts
        $contacts = new Text('contacts', 0, 255);
        $contacts->setRequired(false);
        $this->add($contacts);
    }
}
