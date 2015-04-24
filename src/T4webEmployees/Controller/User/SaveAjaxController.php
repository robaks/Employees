<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use T4webEmployees\Employee\Service\Update as UpdateService;
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

    public function __construct(
        SaveAjaxViewModel $view,
        UpdateService $updateService) {

        $this->view = $view;
        $this->updateService = $updateService;
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

        if(isset($params['removeAvatar']) && !empty($params['removeAvatar']) && file_exists(getcwd() . '/public' . $params['removeAvatar'])) {
            $folder = new \T4webBase\Folder();
            $folder->remove('/public' . $params['removeAvatar']);
        }

        $params['employeeId'] = $employee->getId();
        $this->view->setFormData($params);

        return $this->view;
    }

}
