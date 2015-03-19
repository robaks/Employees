<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use T4webEmployees\Employee\Service\Create as CreateService;
use T4webEmployees\ViewModel\SaveAjaxViewModel;

class CreateAjaxController extends AbstractActionController {

    /**
     * @var SaveAjaxViewModel
     */
    private $view;

    /**
     * @var CreateService
     */
    private $createService;

    public function __construct(
        SaveAjaxViewModel $view,
        CreateService $createService) {

        $this->view = $view;
        $this->createService = $createService;
    }

    public function defaultAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->view;
        }

        $params = $this->getRequest()->getPost()->toArray();

        $employee = $this->createService->create($params);

        if (!$employee) {
            $this->view->setFormData($params);
            $this->view->setErrors($this->createService->getErrors());
            return $this->view;
        }

        $params['employeeId'] = $employee->getId();
        $this->view->setFormData($params);

        return $this->view;
    }

}
