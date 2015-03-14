<?php
namespace T4webEmployees\Employee\Service;

use T4webBase\Domain\Service\BaseFinder as SocialFinder;
use T4webBase\Domain\Collection;
use T4webEmployees\Employee\Employee;

class SocialPopulate {

    private $socialFinder;

    /**
     * @var Collection
     */
    private $infos;

    public function __construct(SocialFinder $socialFinder) {
        $this->socialFinder = $socialFinder;
    }
    
    public function populate(Employee $employee) {

        // TODO: не грузить повторно, запоминать по ID что уже загружали ранее

        $this->infos = $this->socialFinder->findMany(
            array('T4webEmployees' =>
                array('Social' => array('employeeIds' => array($employee->getId())))
            )
        );

        $infoByEmployee = $this->infos[$employee->getId()];

        $employee->setSocial($infoByEmployee);
    }
    
    public function populateCollection(Collection $employees) {
        if (!$employees->count()) {
            return;
        }
        
        $this->infos = $this->socialFinder->findMany(
            array('T4webEmployees' =>
                  array('Social' => array('employeeIds' => $employees->getIds()))
            )
        );

        foreach ($employees as $employee) {
            $this->populate($employee);
        }
    }
}
