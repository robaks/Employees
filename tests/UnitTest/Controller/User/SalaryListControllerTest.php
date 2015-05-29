<?php

namespace T4webEmployeesTest\UnitTest\Controller\User;

use T4webEmployees\Controller\User\SalaryListController;
use T4webEmployees\Controller\User\ListViewModel;
use T4webEmployees\Employee\EmployeeCollection;
use T4webBase\Domain\Collection;
use T4webEmployees\Employee\Employee;
use T4webEmployees\Salary\Salary;

class SalaryListControllerTest extends \PHPUnit_Framework_TestCase
{
    private $controller;
    private $paramsPluginMock;
    private $employeeFinderServiceMock;
    private $salaryFinderServiceMock;
    private $listViewModel;

    public function setUp() {
        $this->paramsPluginMock = $this->getMock('Zend\Mvc\Controller\Plugin\Params');
        $this->employeeFinderServiceMock = $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock();
        $this->salaryFinderServiceMock = $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock();
        $this->listViewModel = new ListViewModel();

        $this->controller = new SalaryListController();
    }

    public function testSheetAction_Normal_ReturnListView() {
        $year = '2016';
        $employeeCollection = new EmployeeCollection();
        $salaries = new Collection();

        $this->paramsPluginMock->expects($this->once())
            ->method('__invoke')
            ->with($this->equalTo('year'), $this->equalTo('2015'))
            ->willReturn($year);

        $this->employeeFinderServiceMock->expects($this->once())
            ->method('findMany')
            ->willReturn($employeeCollection);

        $this->salaryFinderServiceMock->expects($this->once())
            ->method('findMany')
            ->willReturn($salaries);

        /** @var $result ListViewModel */
        $result = $this->controller->sheetAction($this->paramsPluginMock, $this->employeeFinderServiceMock, $this->salaryFinderServiceMock, $this->listViewModel);

        $this->assertEquals($this->listViewModel, $result);
        $this->assertEquals($year, $result->getCurrent()->format('Y'));
        $this->assertEquals($employeeCollection, $result->getEmployees());
        $this->assertEquals($salaries, $result->getSalaries());
    }
}