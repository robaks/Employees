<?php
namespace Employees\Employee\Service;

use Base\Domain\Service\BaseFinder as SocialFinder;
use Base\Domain\Collection;
use Employees\Employee\Employee;

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
        /*
        $this->infos = $this->workInfoFinder->findMany(
            array('Employees' =>
                array('WorkInfo' => array('employeeIds' => array($employee->getId())))
            )
        );
        */
        $infoByEmployee = $this->infos[$employee->getId()];

        $employee->setSocial($infoByEmployee);
    }
    
    public function populateCollection(Collection $employees) {
        if (!$employees->count()) {
            return;
        }
        
        $this->infos = $this->socialFinder->findMany(
            array('Employees' =>
                  array('Social' => array('employeeIds' => $employees->getIds()))
            )
        );

        foreach ($employees as $employee) {
            $this->populate($employee);
        }
    }
}
