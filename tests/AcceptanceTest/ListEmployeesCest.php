<?php
namespace EmployeesTest;

class ListEmployeesCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login-form');
        $I->fillField('username', 'asd');
        $I->fillField('password', '111111');
        $I->click('SIGN IN');

        $I->see('Welcome, John', '#menu-content-demo');
        $I->seeInCurrentUrl('/');
    }

    public function tryToTestListEmployees(AcceptanceTester $I)
    {
        $I->wantTo('List employees');
        $I->amOnPage('/employees');

        $I->seeResponseCodeIs(200);
        $I->see('Employees', 'h1');
    }
}