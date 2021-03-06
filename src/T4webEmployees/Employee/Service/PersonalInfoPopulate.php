<?php
namespace T4webEmployees\Employee\Service;

use T4webBase\Domain\Service\BaseFinder as PersonalInfoFinder;
use T4webBase\Domain\Collection;
use T4webEmployees\Employee\Employee;

class PersonalInfoPopulate {

    private $personalInfoFinder;

    /**
     * @var Collection
     */
    private $infos;

    public function __construct(PersonalInfoFinder $personalInfoFinder) {
        $this->personalInfoFinder = $personalInfoFinder;
    }
    
    public function populate(Employee $employee) {

        // TODO: не грузить повторно, запоминать по ID что уже загружали ранее

        $this->infos = $this->personalInfoFinder->findMany(
            array('T4webEmployees' =>
                array('PersonalInfo' => array('employeeIds' => array($employee->getId())))
            )
        );

        $infoByEmployee = $this->infos[$employee->getId()];

        $employee->setPersonalInfo($infoByEmployee);
    }
    
    public function populateCollection(Collection $employees) {
        if (!$employees->count()) {
            return;
        }
        
        $this->infos = $this->personalInfoFinder->findMany(
            array('T4webEmployees' =>
                  array('PersonalInfo' => array('employeeIds' => $employees->getIds()))
            )
        );

        foreach ($employees as $employee) {
            $this->populate($employee);
        }
    }
}
