<?php
namespace EmployeesTest;

class ListEmployeesCest
{
    public function tryToTestListEmployees(AcceptanceTester $I)
    {
        $I->wantTo('List employees');
        $I->amOnPage('/employees');

        $I->seeResponseCodeIs(200);
        $I->see('Employees', 'h1');
    }
}