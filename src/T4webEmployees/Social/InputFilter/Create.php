<?php

namespace T4webEmployees\Social\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Id;
use T4webBase\InputFilter\Element\Text;
use T4webBase\InputFilter\Element\Email;

class Create extends InputFilter {
    
    public function __construct() {
        
        //id
        $id = new Id('employeeId');
        $id->setRequired(true);
        $this->add($id);

        // skype
        $skype = new Text('skype', 0, 50);
        $skype->setRequired(false);
        $this->add($skype);

        // personalEmail
        $personalEmail = new Email('personalEmail');
        $personalEmail->setRequired(false);
        $this->add($personalEmail);

        // email
        $email = new Email('email');
        $email->setRequired(false);
        $this->add($email);
        
        // facebook
        $facebook = new Text('facebook', 1, 100);
        $facebook->setRequired(false);
        $this->add($facebook);

        // vk
        $vk = new Text('vk', 1, 100);
        $vk->setRequired(false);
        $this->add($vk);

        // linkedin
        $linkedin = new Text('linkedin', 1, 100);
        $linkedin->setRequired(false);
        $this->add($linkedin);
    }
}
