<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Domain\Service\BaseFinder;

class ListController extends AbstractActionController {

    /**
     * @var BaseFinder
     */
    private $finder;

    /**
     * @var ListViewModel
     */
    private $view;

    public function __construct(BaseFinder $finder, ListViewModel $view)
    {
        $this->finder = $finder;
        $this->view = $view;
    }

    /**
     * @return ViewModel
     */
    public function defaultAction()
    {
        /*@var $products \Products\Product\ProductCollection */
        $employees = $this->finder->findMany();

        $this->view->setEmployees($employees);
        return $this->view;
    }

}
