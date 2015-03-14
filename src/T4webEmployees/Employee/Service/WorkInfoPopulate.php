<?php
namespace T4webEmployees\Employee\Service;

use T4webBase\Domain\Service\BaseFinder as WorkInfoFinder;
use T4webBase\Domain\Collection;
use T4webEmployees\Employee\Employee;

class WorkInfoPopulate {

    private $workInfoFinder;

    /**
     * @var Collection
     */
    private $infos;

    public function __construct(WorkInfoFinder $workInfoFinder) {
        $this->workInfoFinder = $workInfoFinder;
    }
    
    public function populate(Employee $employee) {

        // TODO: не грузить повторно, запоминать по ID что уже загружали ранее

        $this->infos = $this->workInfoFinder->findMany(
            array('T4webEmployees' =>
                array('WorkInfo' => array('employeeIds' => array($employee->getId())))
            )
        );

        $infoByEmployee = $this->infos[$employee->getId()];

        $employee->setWorkInfo($infoByEmployee);
    }
    
    public function populateCollection(Collection $employees) {
        if (!$employees->count()) {
            return;
        }
        
        $this->infos = $this->workInfoFinder->findMany(
            array('T4webEmployees' =>
                  array('WorkInfo' => array('employeeIds' => $employees->getIds()))
            )
        );

        foreach ($employees as $employee) {
            $this->populate($employee);
        }
    }
}
