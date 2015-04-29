<?php

namespace T4webEmployees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;

use T4webBase\Domain\Service\BaseFinder;
use T4webBase\Domain\Service\Create as CreateService;
use T4webBase\Domain\Service\Update as UpdateService;
use T4webBase\Domain\Service\Delete as DeleteService;

use T4webEmployees\ViewModel\SaveAjaxViewModel;
use T4webEmployees\Salary\Currency;

class SalaryAjaxController extends AbstractActionController
{

    /**
     * @var BaseFinder
     */
    private $finder;

    /**
     * @var CreateService
     */
    private $createService;

    /**
     * @var UpdateService
     */
    private $updateService;

    /**
     * @var DeleteService
     */
    private $deleteService;

    /**
     * @var SaveAjaxViewModel
     */
    private $view;

    public function __construct(
        BaseFinder $finder,
        CreateService $createService,
        UpdateService $updateService,
        DeleteService $deleteService,
        SaveAjaxViewModel $view)
    {

        $this->finder = $finder;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
        $this->view = $view;
    }

    public function getCurrenciesAction()
    {
        $currencies = Currency::getAll();
        $this->view->setFormData($currencies);

        return $this->view;
    }

    public function saveAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->view;
        }

        $employeeId = $this->params('employeeId', 0);
        $params = $this->getRequest()->getPost()->toArray();
        $params['employeeId'] = $employeeId;

        $salary = $this->createService->create($params);

        if (!$salary) {
            $this->view->setFormData($params);
            $this->view->setErrors($this->createService->getErrors());

            return $this->view;
        }

        $params['id'] = $salary->getId();
        $params['date'] = $salary->getDate();
        $params['formatDate'] = $salary->getDateTime()->format('Y, j M');

        $this->view->setFormData($params);

        return $this->view;
    }

    public function deleteAction() {
        $id = $this->params('id', null);

        $salary = $this->deleteService->delete($id);

        if (!$salary) {
            $this->view->setErrors($this->createService->getErrors());
        }

        return $this->view;
    }

}
