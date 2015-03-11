<?php
namespace EmployeesTest;

class AddEmployeeCest
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

    public function tryToTestAddEmployee(AcceptanceTester $I)
    {
        $I->wantTo('Add employee');
        $I->amOnPage('/employee/add');

        $I->seeResponseCodeIs(200);
        $I->see('Personal info', '#add-employee');
    }
}