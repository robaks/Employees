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
     * @var EntityFactoryInterface
     */
    private $personalInfoEntityFactory;

    public function __construct(
        InputFilterInterface $inputFilter,
        DbRepository $repository,
        DbRepository $personalInfoRepository,
        EntityFactoryInterface $entityFactory,
        EntityFactoryInterface $personalInfoEntityFactory,
        EventManager $eventManager = null) {

        $this->inputFilter = $inputFilter;
        $this->repository = $repository;
        $this->personalInfoRepository = $personalInfoRepository;
        $this->entityFactory = $entityFactory;
        $this->personalInfoEntityFactory = $personalInfoEntityFactory;
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

        $personalInfo = $this->personalInfoEntityFactory->create($data);
        $this->personalInfoRepository->add($personalInfo);

        $this->trigger($personalInfo);

        return $employee;
    }

}