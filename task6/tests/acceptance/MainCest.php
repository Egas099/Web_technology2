<?php

use yii\helpers\Url;

class MainCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->wantTo('Домашняя страница отображается');
        $I->amOnPage('/');
        $I->see('Congratulations!');
        $I->see('My Company');
        $I->seeLink('Login');
    }
    public function transitionToLoginFromHome(AcceptanceTester $I)
    {
        $I->wantTo('Переход на страницу авторизации из домашней страницы');
        $I->amOnPage('/');
        $I->click('Login');
        $I->see('Please fill out the following fields to login');
    }
    public function transitionToHomeFromLogin(AcceptanceTester $I)
    {
        $I->wantTo('Переход на домашнюю страницу из страницы авторизации');
        $I->amOnPage('/');
        $I->click('My Application');
        $I->see('Congratulations!');
        $I->see('My Company');
        $I->seeLink('Login');
    }
    public function autorisation(AcceptanceTester $I)
    {
        $I->wantTo('Авторизация');
        $I->amOnPage('index.php?r=site%2Flogin');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->see('Logout (admin)');
        $I->dontSeeElement('form#login-form');
        $I->see('Images');
    }
    public function deautorise(AcceptanceTester $I)
    {
        $I->wantTo('Деавторизация');
        $I->amOnPage('index.php?r=site%2Flogin');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->click('Logout (admin)');
        $I->see('Congratulations!');
        $I->see('My Company');
        $I->seeLink('Login');
        $I->dontSee('Logout (admin)');
        $I->dontSee('Images');
    }
    public function ensureThatCreateImgPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index.php?r=site%2Flogin');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->click('Upload new image');
        $I->see('Uploading new image');
        $I->wantTo('Cтраница загрузки нового изображения отображается');
    }
    public function ensureThatUpdateImgPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index.php?r=site%2Flogin');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->click('Update');
        $I->see('Update Image: ');
        $I->wantTo('Cтраница обновления изображения отображается');
    }
    // public function сreateImg(AcceptanceTester $I)
    // { 
    //     $I->wantTo('Загрузка изображения');
    //     $I->amOnPage('index.php?r=site%2Flogin');
    //     $I->submitForm('#login-form', [
    //         'LoginForm[username]' => 'admin',
    //         'LoginForm[password]' => 'admin',
    //     ]);
    //     $I->click('Upload new image');
    //     $I->see('Uploading new image');
    //     $I->submitForm('#img-form', [
    //         'Img[name]' => 'Cat',
    //         'Img[caption]' => 'Catys',
    //         'UploadImg[imageFile]' => '../tests/_data/files/cat.jpg',
    //     ]);
    //     $I->seeInDatabase('img', [
    //         'path' => 'cat.jpg',
    //         'name' => 'Cat',
    //         'caption' => 'Catys',
    //     ]);
    //     $I->see('Upload new image');
    // }
}
