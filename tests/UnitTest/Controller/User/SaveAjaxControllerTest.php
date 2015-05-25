<?php

namespace T4webEmployeesTest\UnitTest\Controller\User;

use T4webEmployees\Controller\User\SaveAjaxController;
use T4webEmployees\ViewModel\SaveAjaxViewModel;
use T4webBase\InputFilter\InvalidInputError;
use Zend\Stdlib\Parameters;
use T4webEmployees\Employee\Employee;

class SaveAjaxControllerTest extends \PHPUnit_Framework_TestCase
{
    private $controller;

    private $requestMock;
    private $saveAjaxViewModel;
    private $updateServiceMock;
    private $fileSystemMock;

    public function setUp() {
        $this->requestMock = $this->getMockBuilder('Zend\Http\PhpEnvironment\Request')->disableOriginalConstructor()->getMock();
        $this->saveAjaxViewModel = new SaveAjaxViewModel();
        $this->updateServiceMock = $this->getMockBuilder('T4webEmployees\Employee\Service\Update')->disableOriginalConstructor()->getMock();
        $this->fileSystemMock = $this->getMockBuilder('League\Flysystem\Filesystem')->disableOriginalConstructor()->getMock();

        $this->controller = new SaveAjaxController();
    }

    public function testDefaultAction_IsNotPost_ReturnView() {
        $this->requestMock->expects($this->once())
            ->method('isPost')
            ->willReturn(false);

        /** @var $result SaveAjaxViewModel */
        $result = $this->controller->defaultAction($this->requestMock, $this->saveAjaxViewModel, $this->updateServiceMock, $this->fileSystemMock);

        $this->assertEquals($this->saveAjaxViewModel, $result);
    }

    public function testDefaultAction_UpdateEmployeeIsNotValid_ReturnViewWithErrors() {
        $this->requestMock->expects($this->once())
            ->method('isPost')
            ->willReturn(true);

        $data = array(
            'id' => null,
            'name' => 'Vasia',
        );
        $parameters = new Parameters($data);
        $this->requestMock->expects($this->once())
            ->method('getPost')
            ->willReturn($parameters);

        $this->updateServiceMock->expects($this->once())
            ->method('update')
            ->with($this->equalTo($data['id']), $this->equalTo($parameters->toArray()));

        $errors = new InvalidInputError(array('general' => 'error'));
        $this->updateServiceMock->expects($this->once())
            ->method('getErrors')
            ->willReturn($errors);

        /** @var $result SaveAjaxViewModel */
        $result = $this->controller->defaultAction($this->requestMock, $this->saveAjaxViewModel, $this->updateServiceMock, $this->fileSystemMock);

        $this->assertEquals($this->saveAjaxViewModel, $result);
        $this->assertEquals($parameters->toArray(), $result->getVariable('formData'));
        $this->assertEquals($errors->getErrors(), $result->getVariable('errors'));
    }

    public function testDefaultAction_UpdateEmployee_ReturnViewWithErrors() {
        $this->requestMock->expects($this->once())
            ->method('isPost')
            ->willReturn(true);

        $data = array(
            'id' => null,
            'name' => 'Vasia',
            'removeAvatar' => '/var/avatar/00/path/image.jpg',
        );
        $parameters = new Parameters($data);
        $this->requestMock->expects($this->once())
            ->method('getPost')
            ->willReturn($parameters);

        $employee = new Employee($parameters->toArray());
        $this->updateServiceMock->expects($this->once())
            ->method('update')
            ->with($this->equalTo($data['id']), $this->equalTo($parameters->toArray()))
            ->willReturn($employee);

        $this->fileSystemMock->expects($this->once())
            ->method('has')
            ->with($this->equalTo($data['removeAvatar']))
            ->willReturn(true);

        $this->fileSystemMock->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($data['removeAvatar']));

        /** @var $result SaveAjaxViewModel */
        $result = $this->controller->defaultAction($this->requestMock, $this->saveAjaxViewModel, $this->updateServiceMock, $this->fileSystemMock);

        $params = $parameters->toArray();
        $params['employeeId'] = $employee->getId();
        $this->assertEquals($this->saveAjaxViewModel, $result);
        $this->assertEquals($params, $result->getVariable('formData'));
    }
}