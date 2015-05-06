<?php

namespace T4webEmployees\View\Helper;

use DateTime;
use Zend\View\Helper\AbstractHelper;

class EmployeesYearPaginator extends AbstractHelper {
    
    public function __invoke(DateTime $current) {

        $view = new EmployeesYearPaginatorViewModel();
        $view->setCurrent($current);

        return $this->getView()->render($view);
    }
}