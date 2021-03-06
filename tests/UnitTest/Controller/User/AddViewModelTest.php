<?php

namespace T4webEmployeesTest\UnitTest\Controller\User;

use T4webEmployees\Controller\User\AddViewModel;
use T4webEmployees\Employee\JobTitle;
use T4webEmployees\Employee\Status;

class AddViewModelTest extends \PHPUnit_Framework_TestCase
{
    private $viewModel;

    public function setUp() {
        $this->viewModel = new AddViewModel();
    }

    public function testGetJobTitles_Normal_ReturnJobTitles() {
        $this->assertEquals(JobTitle::getAll(), $this->viewModel->getJobTitles());
    }

    public function testGetStatuses_WithoutDismissed_ReturnStatuses() {
        $statuses = [
            1 => 'На испытательном',
            2 => 'Работает',
            4 => 'Удаленный сотрудник',
        ];

        $this->assertEquals($statuses, $this->viewModel->getStatuses());
    }
}