<?php

namespace T4webEmployeesTest\UnitTest\Employee\Service;

use T4webEmployees\Employee\Service\Create;
use T4webEmployees\Employee\Employee;
use T4webEmployees\PersonalInfo\PersonalInfo;
use T4webEmployees\WorkInfo\WorkInfo;
use T4webEmployees\Social\Social;

class CreateTest extends \PHPUnit_Framework_TestCase {

    private $service;
    private $employeeInputFilterCreateMock;
    private $employeeDbRepositoryMock;
    private $personalInfoDbRepositoryMock;
    private $workInfoDbRepositoryMock;
    private $socialDbRepositoryMock;
    private $employeeEntityFactoryMock;
    private $personalInfoEntityFactoryMock;
    private $workInfoEntityFactoryMock;
    private $socialEntityFactoryMock;
    private $eventManagerMock;

    private $data = array(
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
        $this->employeeInputFilterCreateMock = $this->getMock('T4webEmployees\Employee\InputFilter\Create');
        $this->employeeDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->personalInfoDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->workInfoDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->socialDbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock();
        $this->employeeEntityFactoryMock = $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface');
        $this->personalInfoEntityFactoryMock = $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface');
        $this->workInfoEntityFactoryMock = $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface');
        $this->socialEntityFactoryMock = $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface');
        $this->eventManagerMock = $this->getMock('Zend\EventManager\EventManager');

        $this->service = new Create(
            $this->employeeInputFilterCreateMock,
            $this->employeeDbRepositoryMock,
            $this->personalInfoDbRepositoryMock,
            $this->workInfoDbRepositoryMock,
            $this->socialDbRepositoryMock,
            $this->employeeEntityFactoryMock,
            $this->personalInfoEntityFactoryMock,
            $this->workInfoEntityFactoryMock,
            $this->socialEntityFactoryMock,
            $this->eventManagerMock
        );
    }

    public function testCreate_NotIsValid_ReturnNull() {
        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('getMessages')
            ->willReturn(array('errors'));

        $this->employeeInputFilterCreateMock->expects($this->never())
            ->method('getValues');

        $this->assertNull($this->service->create($this->data));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Cannot create entity form empty data
     */
    public function testCreate_EmptyData_ThrowException() {
        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $this->employeeInputFilterCreateMock->expects($this->never())
            ->method('getMessages');

        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('getValues')
            ->willReturn(array());

        $this->service->create($this->data);
    }

    public function testCreate_Normal_ReturnEmployee() {
        $employee = new Employee(array('id' => 1));
        $personalInfo = new PersonalInfo(array('id' => 2, 'employeeId' => $employee->getId(), 'birthday' => $this->data['birthday']));
        $workInfo = new WorkInfo(array('id' => 2, 'employeeId' => $employee->getId(), 'jobTitleId' => $this->data['jobTitleId']));
        $social = new Social(array('id' => 2, 'employeeId' => $employee->getId()));
        $this->data['employeeId'] = $employee->getId();

        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $this->employeeInputFilterCreateMock->expects($this->never())
            ->method('getMessages');

        $this->employeeInputFilterCreateMock->expects($this->once())
            ->method('getValues')
            ->willReturn($this->data);

        $this->employeeEntityFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->data))
            ->willReturn($employee);

        $this->employeeDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($employee));

        $this->personalInfoEntityFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->data))
            ->willReturn($personalInfo);

        $this->personalInfoDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($personalInfo));

        $this->eventManagerMock->expects($this->at(0))
            ->method('trigger')
            ->with($this->equalTo('create:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $personalInfo)));

        $employee->setPersonalInfo($personalInfo);

        $this->workInfoEntityFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->data))
            ->willReturn($workInfo);

        $this->workInfoDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($workInfo));

        $this->eventManagerMock->expects($this->at(1))
            ->method('trigger')
            ->with($this->equalTo('create:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $workInfo)));

        $employee->setWorkInfo($workInfo);

        $this->socialEntityFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->data))
            ->willReturn($social);

        $this->socialDbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($social));

        $this->eventManagerMock->expects($this->at(2))
            ->method('trigger')
            ->with($this->equalTo('create:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $social)));

        $employee->setSocial($social);

        $this->eventManagerMock->expects($this->at(3))
            ->method('trigger')
            ->with($this->equalTo('create:post'), $this->equalTo($this->service), $this->equalTo(array('entity' => $employee)));

        $result = $this->service->create($this->data);

        $this->assertSame($employee, $result);
    }
}