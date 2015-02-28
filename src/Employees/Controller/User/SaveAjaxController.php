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

    public function __construct(SaveAjaxViewModel $view, CreateService $createService) {
        $this->view = $view;
        $this->createService = $createService;
    }

    public function defaultAction()
    {
        die(var_dump(__LINE__));
        if (!$this->getRequest()->isPost()) {
            //return $this->view;
        }
die(var_dump(__LINE__));
        $params = $this->getRequest()->getPost()->toArray();

        $product = $this->createService->create($params);

        if (!$product) {
            $this->view->data = $params;
            $this->view->error = $this->createService->getError();
        }

        return $this->view;
    }

}
