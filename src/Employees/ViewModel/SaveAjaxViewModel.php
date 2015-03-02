<?php

namespace Employees\ViewModel;

use Zend\View\Model\JsonModel;
use Base\InputFilter\InvalidInputError;

class SaveAjaxViewModel extends JsonModel {

    /**
     * @param InvalidInputError $errors
     */
    public function setErrors($errors)
    {
        $this->setVariable('errors', $errors->getErrors());
    }

    /**
     * @param array $formData
     */
    public function setFormData($formData)
    {
        $this->setVariable('formData', $formData);
    }

}
