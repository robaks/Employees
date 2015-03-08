<?php

namespace Employees\Controller\User;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Domain\Service\BaseFinder;
use Employees\Employee\Service\WorkInfoPopulate;

class ListController extends AbstractActionController {

    /**
     * @var BaseFinder
     */
    private $finder;

    /**
     * @var ListViewModel
     */
    private $view;

    /**
     * @var WorkInfoPopulate
     */
    private $workInfoPopulator;

    public function __construct(BaseFinder $finder, WorkInfoPopulate $workInfoPopulator, ListViewModel $view)
    {
        $this->finder = $finder;
        $this->workInfoPopulator = $workInfoPopulator;
        $this->view = $view;
    }

    /**
     * @return ViewModel
     */
    public function defaultAction()
    {
        /*@var $products \Products\Product\ProductCollection */
        $employees = $this->finder->findMany();
        $this->workInfoPopulator->populateCollection($employees);
die(var_dump($employees));
        $this->view->setEmployees($employees);
        return $this->view;
    }

}
