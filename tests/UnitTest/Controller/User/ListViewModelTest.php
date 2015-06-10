<?php

namespace T4webEmployeesTest\UnitTest\Controller\User;

use T4webEmployees\Controller\User\ListViewModel;
use T4webBase\Domain\Collection;
use T4webEmployees\Salary\Salary;
use T4webEmployees\Employee\Employee;
use T4webEmployees\WorkInfo\WorkInfo;

class ListViewModelTest extends \PHPUnit_Framework_TestCase
{
    /** @var ListViewModel */
    private $viewModel;
    /** @var Collection */
    private $salaries;

    public function setUp()
    {
        $salary1 = new Salary(['id' => 1, 'employeeId' => 1, 'amount' => 500, 'date' => '2015-04-01']);
        $salary2 = new Salary(['id' => 2, 'employeeId' => 1, 'amount' => 70, 'date' => '2015-08-01']);
        $salary3 = new Salary(['id' => 3, 'employeeId' => 1, 'amount' => 550, 'date' => '2015-04-20']);
        $salary4 = new Salary(['id' => 4, 'employeeId' => 1, 'amount' => 300, 'date' => '2015-02-02']);
        $this->salaries = new Collection();
        $this->salaries->offsetSet($salary1->getId(), $salary1);
        $this->salaries->offsetSet($salary2->getId(), $salary2);
        $this->salaries->offsetSet($salary3->getId(), $salary3);
        $this->salaries->offsetSet($salary4->getId(), $salary4);

        $this->viewModel = new ListViewModel();
        $this->viewModel->setSalaries($this->salaries);
        $this->viewModel->setCurrent(date('Y'));
    }

    /**
     * @dataProvider getMonthAmountProvider
     */
    public function testGetMonthAmount_Provider_ReturnFalse($expected, $employee, $month)
    {
        $this->assertEquals($expected, $this->viewModel->getMonthAmount($employee, $month));
    }

    public function getMonthAmountProvider() {
        // потому что в dataProvider $this->salaries == null
        $lastSalary = new Salary(['id' => 4, 'employeeId' => 1, 'amount' => 300, 'date' => '2015-02-02']);
        $salary = new Salary(['id' => 3, 'employeeId' => 1, 'amount' => 550, 'date' => '2015-04-20']);

        $employee = new Employee(array('id' => 1));
        $employee->setWorkInfo(new WorkInfo(array('employeeId' => 1, 'jobTitleId'=> 1, 'statusId' => 2)));

        $employee2 = new Employee(array('id' => 2));
        $employee2->setWorkInfo(new WorkInfo(array('employeeId' => 2, 'jobTitleId'=> 1, 'statusId' => 2)));

        $employee3 = new Employee(array('id' => 3));
        $employee3->setWorkInfo(new WorkInfo(array('employeeId' => 3, 'jobTitleId'=> 3, 'statusId' => 3, 'endWorkDate' => '2015-05-01')));

        return [
            [false, $employee, 1], // not found salary by employeeId
            [false, $employee2, 1], // not found salaries by month
            [$lastSalary, $employee, 3], // last salary
            [$salary, $employee, 4], // normal
            [false, $employee3, 5], // normal
        ];
    }
}