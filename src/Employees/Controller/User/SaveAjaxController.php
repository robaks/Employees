<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class SaveAjaxController extends AbstractActionController {

    public function defaultAction()
    {
        return new JsonModel();
    }

}
