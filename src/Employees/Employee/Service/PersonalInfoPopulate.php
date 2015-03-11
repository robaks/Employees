<?php
namespace Employees\Employee\Service;

use Base\Domain\Service\BaseFinder as PersonalInfoFinder;
use Base\Domain\Collection;
use Employees\Employee\Employee;

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
            array('Employees' =>
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
            array('Employees' =>
                  array('PersonalInfo' => array('employeeIds' => $employees->getIds()))
            )
        );

        foreach ($employees as $employee) {
            $this->populate($employee);
        }
    }
}