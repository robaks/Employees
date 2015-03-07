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

        $params['id'] = 19;

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

        $workInfo = $this->workInfoCreateService->create($params);

        if (!$workInfo) {
            $this->view->setErrors($this->workInfoCreateService->getErrors());
        }

        return $this->view;
    }

}
