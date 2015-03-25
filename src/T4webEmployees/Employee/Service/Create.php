<?php
namespace T4webEmployees\Employee\Service;

use Zend\EventManager\EventManager;
use T4webBase\InputFilter\InputFilterInterface;
use T4webBase\Domain\Repository\DbRepository;
use T4webBase\Domain\Factory\EntityFactoryInterface;
use T4webBase\Domain\Service\Create as BaseCreate;

class Create extends BaseCreate {

    /**
     * @var DbRepository
     */
    protected $personalInfoRepository;

    /**
     * @var DbRepository
     */
    protected $workRepository;

    /**
     * @var DbRepository
     */
    protected $socialRepository;

    /**
     * @var EntityFactoryInterface
     */
    protected $personalInfoEntityFactory;

    /**
     * @var EntityFactoryInterface
     */
    protected $workEntityFactory;

    /**
     * @var EntityFactoryInterface
     */
    protected $socialEntityFactory;

    public function __construct(
        InputFilterInterface $inputFilter,
        DbRepository $repository,
        DbRepository $personalInfoRepository,
        DbRepository $workRepository,
        DbRepository $socialRepository,
        EntityFactoryInterface $entityFactory,
        EntityFactoryInterface $personalInfoEntityFactory,
        EntityFactoryInterface $workEntityFactory,
        EntityFactoryInterface $socialEntityFactory,
        EventManager $eventManager = null) {

        $this->inputFilter = $inputFilter;
        $this->repository = $repository;
        $this->personalInfoRepository = $personalInfoRepository;
        $this->workRepository = $workRepository;
        $this->socialRepository = $socialRepository;
        $this->entityFactory = $entityFactory;
        $this->personalInfoEntityFactory = $personalInfoEntityFactory;
        $this->workEntityFactory = $workEntityFactory;
        $this->socialEntityFactory = $socialEntityFactory;
        $this->eventManager = $eventManager;
    }

    /**
     * @param array $data
     * @return EntityInterface|null
     */
    public function create(array $data) {

        if (!$this->isValid($data)) {
            return;
        }

        $data = $this->inputFilter->getValues();

        if (empty($data)) {
            throw new \RuntimeException("Cannot create entity form empty data");
        }

        /** @var T4webEmployees\Employee\Employee $employee */
        $employee = $this->entityFactory->create($data);
        $this->repository->add($employee);

        $data['employeeId'] = $employee->getId();

        $personalInfo = $this->personalInfoEntityFactory->create($data);
        $this->personalInfoRepository->add($personalInfo);

        $this->trigger($personalInfo);
        $employee->setPersonalInfo($personalInfo);

        $work = $this->workEntityFactory->create($data);
        $this->workRepository->add($work);

        $this->trigger($work);
        $employee->setWorkInfo($work);

        $social = $this->socialEntityFactory->create($data);
        $this->socialRepository->add($social);

        $this->trigger($social);
        $employee->setSocial($social);


        $this->trigger($employee);

        return $employee;
    }

}