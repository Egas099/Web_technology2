<?php

class SiteControllerCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->wantTo('Страница авторизации отображается');
        $I->see('Login', 'h1');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('Logout (admin)');
    }
    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
        $I->amOnPage('/');
        $I->see('Logout (admin)');
    }


    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->wantTo('Попытка входа с пустыми данными');
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->wantTo('Попытка входа с неверными данными');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->wantTo('Попытка входа с верными данными');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->see('Logout (admin)');
        $I->dontSeeElement('form#login-form');
        $I->see('Images');
    }
    public function deauthorize(\FunctionalTester $I)
    {
        $I->wantTo('Деавторизация');
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->click('Logout (admin)');
        $I->see('Login');
        $I->dontSee('Logout (admin)');
        $I->dontSee('Images');
        $I->See('Congratulations!');
    }
}
