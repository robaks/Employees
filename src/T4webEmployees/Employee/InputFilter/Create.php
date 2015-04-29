<?php

namespace T4webEmployees\Employee\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Id;
use T4webBase\InputFilter\Element\Name;
use T4webBase\InputFilter\Element\InArray;
use T4webBase\InputFilter\Element\Date;
use T4webBase\InputFilter\Element\Phone;
use T4webBase\InputFilter\Element\Text;
use T4webBase\InputFilter\Element\Email;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Employee\Status;

class Create extends InputFilter {
    
    public function __construct() {
        
        //id
        $id = new Id('id');
        $id->setRequired(false);
        $this->add($id);
        
        // name
        $name = new Name('name', 1, 50);
        $name->setRequired(true);
        $this->add($name);

        // surname
        $surname = new Name('surname', 1, 50);
        $surname->setRequired(true);
        $this->add($surname);

        // patronymic
        $patronymic = new Name('patronymic', 1, 50);
        $patronymic->setRequired(true);
        $this->add($patronymic);

        // avatar
        $avatar = new Text('avatar');
        $avatar->setRequired(false);
        $this->add($avatar);

        // job_title
        $jobTitle = new InArray('jobTitleId', array_keys(JobTitle::getAll()));
        $jobTitle->setRequired(true);
        $this->add($jobTitle);

        // status
        $status = new InArray('statusId', array_keys(Status::getAll()));
        $status->setRequired(true);
        $this->add($status);

        // start_work_date
        $startWorkDate = new Date('startWorkDate', 'Y-m-d');
        $startWorkDate->setRequired(true);
        $this->add($startWorkDate);


        // birthday
        $birthday = new Date('birthday', 'Y-m-d');
        $birthday->setRequired(false);
        $this->add($birthday);

        // phone
        $phone = new Phone('phone', '/^\(\d{3}\)\d{3}-\d{2}-\d{2}$/', '(###) ###-##-##');
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


        // start_work_date
        $startWorkDate = new Date('startWorkDate', 'Y-m-d');
        $startWorkDate->setRequired(true);
        $this->add($startWorkDate);

        // endWorkDate
        $endWorkDate = new Date('endWorkDate', 'Y-m-d');
        $endWorkDate->setRequired(false);
        $this->add($endWorkDate);

        // comment
        $comment = new Text('comment');
        $comment->setRequired(false);
        $this->add($comment);


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
