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
     * @var EntityFactoryInterface
     */
    private $personalInfoEntityFactory;

    /**
     * @var EntityFactoryInterface
     */
    private $workEntityFactory;

    /**
     * @var EntityFactoryInterface
     */
    private $socialEntityFactory;

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

        $employee = $this->entityFactory->create($data);
        $this->repository->add($employee);

        $this->trigger($employee);

        $data['employeeId'] = $employee->getId();

        $personalInfo = $this->personalInfoEntityFactory->create($data);
        $this->personalInfoRepository->add($personalInfo);

        $this->trigger($personalInfo);

        $work = $this->workEntityFactory->create($data);
        $this->workRepository->add($work);

        $this->trigger($work);

        $social = $this->socialEntityFactory->create($data);
        $this->socialRepository->add($social);

        $this->trigger($social);

        return $employee;
    }

}