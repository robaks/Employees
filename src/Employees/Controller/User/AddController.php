<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AddController extends AbstractActionController {

    /**
     * @return ViewModel
     */
    public function defaultAction()
    {
        return new ViewModel();
    }

}
