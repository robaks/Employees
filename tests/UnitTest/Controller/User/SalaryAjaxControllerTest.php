<?php

namespace T4webEmployeesTest\UnitTest\Controller\User;

use T4webEmployees\Controller\User\SalaryAjaxController;
use T4webEmployees\ViewModel\SaveAjaxViewModel;
use T4webEmployees\Salary\Currency;

class SalaryAjaxControllerTest extends \PHPUnit_Framework_TestCase
{
    private $controller;
    private $salaryFinderServiceMock;
    private $salaryCreateServiceMock;
    private $salaryUpdateServiceMock;
    private $salaryDeleteServiceMock;
    private $saveAjaxViewModel;

    public function setUp() {
        $this->salaryFinderServiceMock = $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')->disableOriginalConstructor()->getMock();
        $this->salaryCreateServiceMock = $this->getMockBuilder('T4webBase\Domain\Service\Create')->disableOriginalConstructor()->getMock();
        $this->salaryUpdateServiceMock = $this->getMockBuilder('T4webBase\Domain\Service\Update')->disableOriginalConstructor()->getMock();
        $this->salaryDeleteServiceMock = $this->getMockBuilder('T4webBase\Domain\Service\Delete')->disableOriginalConstructor()->getMock();
        $this->saveAjaxViewModel = new SaveAjaxViewModel();


        $this->controller = new SalaryAjaxController(
            $this->salaryFinderServiceMock,
            $this->salaryCreateServiceMock,
            $this->salaryUpdateServiceMock,
            $this->salaryDeleteServiceMock,
            $this->saveAjaxViewModel
        );
    }

    public function testGetCurrenciesAction_Normal_ReturnCurrencies() {
        /** @var $result SaveAjaxViewModel */
        $result = $this->controller->getCurrenciesAction();

        $this->assertEquals($this->saveAjaxViewModel, $result);
        $this->assertEquals(Currency::getAll(), $result->getVariable('formData'));
    }
}