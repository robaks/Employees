<?php
namespace EmployeesTest;

class AddEmployeeCest
{
    public function tryToTestAddEmployee(AcceptanceTester $I)
    {
        $I->wantTo('Add employee');
        $I->amOnPage('/employee/add');

        $I->seeResponseCodeIs(200);
        $I->see('Personal info', '#personal-info');
    }
}