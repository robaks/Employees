<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;

class AddController extends AbstractActionController {

    /**
     * @var AddViewModel
     */
    private $view;

    /**
     * @param AddViewModel $view
     */
    public function __construct(AddViewModel $view)
    {
        $this->view = $view;
    }

    /**
     * @return AddViewModel
     */
    public function defaultAction()
    {
        return $this->view;
    }

}
