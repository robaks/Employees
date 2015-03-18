<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use T4webEmployees\Employee\Service\Update as UpdateService;
use T4webBase\Domain\Service\Create as CreateService;
use T4webEmployees\ViewModel\SaveAjaxViewModel;

class SaveAjaxController extends AbstractActionController {

    /**
     * @var SaveAjaxViewModel
     */
    private $view;

    /**
     * @var UpdateService
     */
    private $updateService;

    /**
     * @var CreateService
     */
    private $personalInfoCreateService;

    /**
     * @var CreateService
     */
    private $workInfoCreateService;

    public function __construct(
        SaveAjaxViewModel $view,
        UpdateService $updateService,
        CreateService $personalInfoCreateService,
        CreateService $workInfoCreateService) {

        $this->view = $view;
        $this->updateService = $updateService;
        $this->personalInfoCreateService = $personalInfoCreateService;
        $this->workInfoCreateService = $workInfoCreateService;
    }

    public function defaultAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->view;
        }

        $params = $this->getRequest()->getPost()->toArray();

        $employee = $this->updateService->update($params['id'], $params);

        if (!$employee) {
            $this->view->setFormData($params);
            $this->view->setErrors($this->updateService->getErrors());
            return $this->view;
        }

        $params['employeeId'] = $employee->getId();
        $this->view->setFormData($params);
/*
        $personalInfo = $this->personalInfoCreateService->create($params);

        if (!$personalInfo) {
            $this->view->setErrors($this->personalInfoCreateService->getErrors());
        }

        $workInfo = $this->workInfoCreateService->create($params);

        if (!$workInfo) {
            $this->view->setErrors($this->workInfoCreateService->getErrors());
        }
*/
        return $this->view;
    }

}
