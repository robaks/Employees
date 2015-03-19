<?php
namespace T4webEmployees\Employee\Service;

use T4webEmployees\Employee\Employee;
use Zend\EventManager\EventManager;
use T4webBase\InputFilter\InputFilterInterface;
use T4webBase\Domain\Repository\DbRepository;
use T4webBase\Domain\Criteria\Factory as CriteriaFactory;
use T4webBase\Domain\Service\Update as BaseUpdate;

class Update extends BaseUpdate {

    /**
     * @var DbRepository
     */
    private $personalInfoRepository;

    /**
     * @var DbRepository
     */
    private $workRepository;

    /**
     * @var DbRepository
     */
    private $socialRepository;

    /**
     * @var CriteriaFactory
     */
    private $personalInfoCriteriaFactory;

    /**
     * @var CriteriaFactory
     */
    private $workCriteriaFactory;

    /**
     * @var CriteriaFactory
     */
    private $socialCriteriaFactory;

    public function __construct(
        InputFilterInterface $inputFilter,
        DbRepository $repository,
        DbRepository $personalInfoRepository,
        DbRepository $workRepository,
        DbRepository $socialRepository,
        CriteriaFactory $criteriaFactory,
        CriteriaFactory $personalInfoCriteriaFactory,
        CriteriaFactory $workCriteriaFactory,
        CriteriaFactory $socialCriteriaFactory,
        EventManager $eventManager = null) {

        $this->inputFilter = $inputFilter;
        $this->repository = $repository;
        $this->personalInfoRepository = $personalInfoRepository;
        $this->workRepository = $workRepository;
        $this->socialRepository = $socialRepository;
        $this->criteriaFactory = $criteriaFactory;
        $this->personalInfoCriteriaFactory = $personalInfoCriteriaFactory;
        $this->workCriteriaFactory = $workCriteriaFactory;
        $this->socialCriteriaFactory = $socialCriteriaFactory;
        $this->eventManager = $eventManager;
    }

    /**
     * @param array $data
     * @return EntityInterface|null
     */
    public function update($id, array $data) {

        if (!$this->isValid($data)) {
            return;
        }

        $data = $this->inputFilter->getValues();

        /** @var Employee $entity */
        $employee = $this->repository->find($this->criteriaFactory->getNativeCriteria('Id', $id));

        $employee->populate($data);
        $this->repository->add($employee);
        $this->trigger('update:post', $employee);


        $data['employeeId'] = $employee->getId();

        $personalInfo = $this->personalInfoRepository->find($this->personalInfoCriteriaFactory->getNativeCriteria('EmployeeId', $id));

        $personalInfo->populate($data);

        $this->personalInfoRepository->add($personalInfo);
        $this->trigger('update:post', $personalInfo);


        $work = $this->workRepository->find($this->workCriteriaFactory->getNativeCriteria('EmployeeId', $id));

        $work->populate($data);
        $this->workRepository->add($work);
        $this->trigger('update:post', $work);


        $social = $this->socialRepository->find($this->socialCriteriaFactory->getNativeCriteria('EmployeeId', $id));

        $social->populate($data);
        $this->socialRepository->add($social);
        $this->trigger('update:post', $social);

        return $employee;
    }

}