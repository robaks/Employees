<?php

namespace Employees\Controller\User;

use Zend\View\Model\ViewModel;
use Employees\Employee\JobTitle;
use Employees\Employee\Status;

class AddViewModel extends ViewModel {

    /**
     * @return JobTitle
     */
    public function getJobTitles()
    {
        return JobTitle::getAll();
    }

    /**
     * @return Statuses
     */
    public function getStatuses()
    {
        return Status::getAll();
    }

}
