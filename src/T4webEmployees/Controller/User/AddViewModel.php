<?php

namespace T4webEmployees\Controller\User;

use Zend\View\Model\ViewModel;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Employee\Status;

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
