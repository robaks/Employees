<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\Create as CreateService;
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

    /**
     * @var CreateService
     */
    private $personalInfoCreateService;

    /**
     * @var CreateService
     */
    private $workInfoCreateService;

    /**
     * @var CreateService
     */
    private $socialCreateService;

    public function __construct(
        SaveAjaxViewModel $view,
        CreateService $createService,
        CreateService $personalInfoCreateService,
        CreateService $workInfoCreateService,
        CreateService $socialCreateService) {

        $this->view = $view;
        $this->createService = $createService;
        $this->personalInfoCreateService = $personalInfoCreateService;
        $this->workInfoCreateService = $workInfoCreateService;
        $this->socialCreateService = $socialCreateService;
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

        $socialCreateService = $this->socialCreateService->create($params);

        if (!$socialCreateService) {
            $this->view->setErrors($this->socialCreateService->getErrors());
        }

        return $this->view;
    }

}
