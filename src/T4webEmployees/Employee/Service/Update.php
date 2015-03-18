<?php

namespace T4webEmployees\Employee\Service;

use T4webBase\Domain\Service\UpdateAbstract;
use T4webEmployees\Employee\Employee;

class Update extends UpdateAbstract {

    /**
     * @param       $id
     * @param array $data
     *
     * @return Employee|void
     */
    public function update($id, array $data) {

        if (!$this->isValid($data)) {
            return;
        }

        $data = $this->inputFilter->getValues();
        
        /** @var Employee $employee */
        $employee = $this->repository->find($this->criteriaFactory->getNativeCriteria('Id', $id));

        $employee->setName($data['name']);
        $employee->setSurname($data['surname']);
        $employee->setPatronymic($data['patronymic']);
        $employee->setAvatar($data['avatar']);

        $this->repository->add($employee);
        $this->trigger('update:post', $employee);
        
        return $employee;
    }
}
