<?php

namespace T4webEmployeesTest\UnitTest\Controller\User;

use T4webEmployees\Controller\User\ListViewModel;
use T4webBase\Domain\Collection;
use T4webEmployees\Salary\Salary;

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
    public function testGetMonthAmount_Provider_ReturnFalse($expected, $employeeId, $month)
    {
        $this->assertEquals($expected, $this->viewModel->getMonthAmount($employeeId, $month));
    }

    public function getMonthAmountProvider() {
        // потому что в dataProvider $this->salaries == null
        $lastSalary = new Salary(['id' => 4, 'employeeId' => 1, 'amount' => 300, 'date' => '2015-02-02']);
        $salary = new Salary(['id' => 3, 'employeeId' => 1, 'amount' => 550, 'date' => '2015-04-20']);

        return [
            [false, 2, 1], // not found salary by employeeId
            [false, 1, 1], // not found salaries by month
            [$lastSalary, 1, 3], // last salary
            [$salary, 1, 4], // normal
        ];
    }
}