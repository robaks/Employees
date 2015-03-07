<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Base\Domain\Service\Create as CreateService;
use Employees\ViewModel\SaveAjaxViewModel;

class CreateAjaxController extends AbstractActionController {

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

    /**
     * @var CreateService
     */
    private $workInfoCreateService;

    public function __construct(
        SaveAjaxViewModel $view,
        CreateService $createService,
        CreateService $personalInfoCreateService,
        CreateService $workInfoCreateService) {

        $this->view = $view;
        $this->createService = $createService;
        $this->personalInfoCreateService = $personalInfoCreateService;
        $this->workInfoCreateService = $workInfoCreateService;
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

        $personalInfo = $this->personalInfoCreateService->create($params);

        if (!$personalInfo) {
            $this->view->setErrors($this->personalInfoCreateService->getErrors());
        }

        $workInfo = $this->workInfoCreateService->create($params);

        if (!$workInfo) {
            $this->view->setErrors($this->workInfoCreateService->getErrors());
        }

        return $this->view;
    }

}
