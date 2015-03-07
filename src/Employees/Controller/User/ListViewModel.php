<?php

namespace Employees\Controller\User;

use Zend\View\Model\ViewModel;
use Base\Domain\Collection;

class ListViewModel extends ViewModel {

    /**
     * @var Collection
     */
    private $employees;

    /**
     * @return Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param Collection $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }

}
