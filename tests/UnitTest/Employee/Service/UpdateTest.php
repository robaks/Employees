<?php

namespace T4webEmployeesTest\UnitTest\Employee\Service;

use T4webEmployees\Employee\Service\Update;
use T4webEmployees\Employee\Employee;
use T4webEmployees\PersonalInfo\PersonalInfo;
use T4webEmployees\WorkInfo\WorkInfo;
use T4webEmployees\Social\Social;

class UpdateTest extends \PHPUnit_Framework_TestCase {

    private $service;
    private $employeeInputFilterUpdateMock;
    private $employeeDbRepositoryMock;
    private $personalInfoDbRepositoryMock;
    private $workInfoDbRepositoryMock;
    private $socialDbRepositoryMock;
    private $employeeCriteriaFactoryMock;
    private $personalInfoCriteriaFactoryMock;
    private $workInfoCriteriaFactoryMock;
    private $socialCriteriaFactoryMock;
    private $eventManagerMock;

    private $data = array(
        'id' => 3,
        'surname' =>  'a',
        'name' =>  'b',
        'patronymic' =>  'c',
        'birthday' =>  '1988-06-17',
        'phone' =>  '(091)564-82-16',
        'passport' =>  '',
        'ipn' =>  '',
        'address' =>  '',
        'registrationAddress' => '',
        'avatar' => 'public/var/avatar/tmp/Аватар.jpg',
        'jobTitleId' =>  '7',
        'statusId' =>  '2',
        'startWorkDate' =>  '2013-06-13',
        'endWorkDate' =>  '',
        'login' =>  'a',
        'password' =>  '111',
        'skype' =>  'skype',
        'personalEmail' =>  '',
        'email' =>  '',
        'facebook' =>  'facebook',
        'vk' =>  '',
        'linkedin' =>  'linkedin',
        'contacts' =>  '',
        'comment' =>  '',
    );

    public function setUp() {
        $this->employeeInputFilterUpdateMock = $this->getMock('T4webEmployees\Employee\InputFilter\Update');
        $this->employeeDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->personalInfoDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->workInfoDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->socialDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->employeeCriteriaFactoryMock = $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock();
        $this->personalInfoCriteriaFactoryMock = $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock();
        $this->workInfoCriteriaFactoryMock = $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock();
        $this->socialCriteriaFactoryMock = $this->getMockBuilder('T4webBase\Domain\Criteria\Factory')->disableOriginalConstructor()->getMock();
        $this->eventManagerMock = $this->getMock('Zend\EventManager\EventManager');

        $this->service = new Update(
            $this->employeeInputFilterUpdateMock,
            $this->employeeDbRepositoryMock,
            $this->personalInfoDbRepositoryMock,
            $this->workInfoDbRepositoryMock,
            $this->socialDbRepositoryMock,
            $this->employeeCriteriaFactoryMock,
            $this->personalInfoCriteriaFactoryMock,
            $this->workInfoCriteriaFactoryMock,
            $this->socialCriteriaFactoryMock,
            $this->eventManagerMock
        );
    }

    public function testUpdate_NotIsValid_ReturnNull() {
        $this->employeeInputFilterUpdateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->employeeInputFilterUpdateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $this->employeeInputFilterUpdateMock->expects($this->once())
            ->method('getMessages')
            ->willReturn(array('errors'));

        $this->employeeInputFilterUpdateMock->expects($this->never())
            ->method('getValues');

        $this->assertNull($this->service->update($this->data['id'], $this->data));
    }

    public function testUpdate_Normal_ReturnEmployee() {
        $criteriaInterface = $this->getMock('T4webBase\Domain\Criteria\CriteriaInterface');
        $employee = new Employee(array('id' => 1));
        $personalInfo = new PersonalInfo(array('id' => 2, 'employeeId' => $employee->getId(), 'birthday' => $this->data['birthday']));
        $workInfo = new WorkInfo(array('id' => 2, 'employeeId' => $employee->getId(), 'jobTitleId' => $this->data['jobTitleId']));
        $social = new Social(array('id' => 2, 'employeeId' => $employee->getId()));
        $this->data['employeeId'] = $employee->getId();

        $this->employeeInputFilterUpdateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->employeeInputFilterUpdateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $this->employeeInputFilterUpdateMock->expects($this->never())
            ->method('getMessages');

        $this->employeeInputFilterUpdateMock->expects($this->once())
            ->method('getValues')
            ->willReturn($this->data);

        $this->employeeCriteriaFactoryMock->expects($this->once())
            ->method('getNativeCriteria')
            ->with($this->equalTo('Id'), $this->equalTo($this->data['id']))
            ->willReturn($criteriaInterface);

        $this->employeeDbRepositoryMock->expects($this->once())
            ->method('find')
            ->with($this->equalTo($criteriaInterface))
            ->willReturn($employee);

        $this->employeeDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($employee));

        $this->eventManagerMock->expects($this->at(0))
            ->method('trigger')
            ->with($this->equalTo('update:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $employee)));

        $this->personalInfoCriteriaFactoryMock->expects($this->once())
            ->method('getNativeCriteria')
            ->with($this->equalTo('EmployeeId'), $this->equalTo($this->data['id']))
            ->willReturn($criteriaInterface);

        $this->personalInfoDbRepositoryMock->expects($this->once())
            ->method('find')
            ->with($this->equalTo($criteriaInterface))
            ->willReturn($personalInfo);

        $this->personalInfoDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($personalInfo));

        $this->eventManagerMock->expects($this->at(1))
            ->method('trigger')
            ->with($this->equalTo('update:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $personalInfo)));

        $this->workInfoCriteriaFactoryMock->expects($this->once())
            ->method('getNativeCriteria')
            ->with($this->equalTo('EmployeeId'), $this->equalTo($this->data['id']))
            ->willReturn($criteriaInterface);

        $this->workInfoDbRepositoryMock->expects($this->once())
            ->method('find')
            ->with($this->equalTo($criteriaInterface))
            ->willReturn($workInfo);

        $this->workInfoDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($workInfo));

        $this->eventManagerMock->expects($this->at(2))
            ->method('trigger')
            ->with($this->equalTo('update:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $workInfo)));

        $this->socialCriteriaFactoryMock->expects($this->once())
            ->method('getNativeCriteria')
            ->with($this->equalTo('EmployeeId'), $this->equalTo($this->data['id']))
            ->willReturn($criteriaInterface);

        $this->socialDbRepositoryMock->expects($this->once())
            ->method('find')
            ->with($this->equalTo($criteriaInterface))
            ->willReturn($social);

        $this->socialDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($social));

        $this->eventManagerMock->expects($this->at(3))
            ->method('trigger')
            ->with($this->equalTo('update:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $social)));

        $result = $this->service->update($this->data['id'], $this->data);

        $this->assertSame($employee, $result);
    }
}