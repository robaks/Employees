<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Base\Domain\Service\Create as CreateService;
use Employees\ViewModel\SaveAjaxViewModel;

class SaveAjaxController extends AbstractActionController {

    /**
     * @var SaveAjaxViewModel
     */
    private $view;

    /**
     * @var CreateService
     */
    private $createService;

    /**
     * @var CreateService
     */
    private $personalInfoCreateService;

    public function __construct(SaveAjaxViewModel $view, CreateService $createService, CreateService $personalInfoCreateService) {
        $this->view = $view;
        $this->createService = $createService;
        $this->personalInfoCreateService = $personalInfoCreateService;
    }

    public function defaultAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->view;
        }

        $params = $this->getRequest()->getPost()->toArray();

        $employee = $this->createService->create($params);

        $params['employee_id'] = $employee->getId();

        $this->view->setFormData($params);

        if (!$employee) {
            $this->view->setErrors($this->createService->getErrors());
            return $this->view;
        }


        $personalInfo = $this->personalInfoCreateService->create($params);

        if (!$personalInfo) {
            $this->view->setErrors($this->personalInfoCreateService->getErrors());
        }

        return $this->view;
    }

}
