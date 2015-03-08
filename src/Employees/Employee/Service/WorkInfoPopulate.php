<?php
namespace Employees\Employee\Service;

use Base\Domain\Service\BaseFinder as WorkInfoFinder;
use Base\Domain\Collection;
use Employees\Employee\Employee;

class WorkInfoPopulate {

    protected $pictureEntityName = 'Picture';
    protected $entityIds = 'productIds';

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
        /*
        $this->infos = $this->workInfoFinder->findMany(
            array('Employees' =>
                array('WorkInfo' => array('employeeIds' => array($employee->getId())))
            )
        );
        */
        $infoByEmployee = $this->infos[$employee->getId()];

        $employee->setWorkInfo($infoByEmployee);
    }
    
    public function populateCollection(Collection $employees) {
        if (!$employees->count()) {
            return;
        }
        
        $this->infos = $this->workInfoFinder->findMany(
            array('Employees' =>
                  array('WorkInfo' => array('employeeIds' => $employees->getIds()))
            )
        );

        foreach ($employees as $employee) {
            $this->populate($employee);
        }
    }
}
