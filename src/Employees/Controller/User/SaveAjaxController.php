<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class SaveAjaxController extends AbstractActionController {

    public function __construct(SaveAjaxViewModel $view, $createService) {

    }

    public function defaultAction()
    {
        if (!$this->isPost()) {
            return $this->view;
        }

        $params = $this->getFromPost();

        $product = $this->createService->create($params);

        if (!$product) {
            $this->view->data = $params;
            $this->view->error = $this->createService->getError();
        }


        return new JsonModel();
    }

}
