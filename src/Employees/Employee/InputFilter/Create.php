<?php

namespace Employees\Employee\InputFilter;

use Base\InputFilter\InputFilter;
use Base\InputFilter\Element\Id;
use Base\InputFilter\Element\Name;

class Create extends InputFilter {
    
    public function __construct() {
        
        //id
        $id = new Id('id');
        $id->setRequired(false);
        $this->add($id);
        
        // name
        $name = new Name('name', 1, 50);
        $name->setRequired(false);
        $this->add($name);

        // surname
        $surname = new Name('surname', 1, 50);
        $surname->setRequired(false);
        $this->add($surname);

        // patronymic
        $patronymic = new Name('patronymic', 1, 50);
        $patronymic->setRequired(false);
        $this->add($patronymic);
    }
}
