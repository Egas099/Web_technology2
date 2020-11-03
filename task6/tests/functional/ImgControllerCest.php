<?php


class ImgControllerCest
{
    public $model;
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('img/index');
    }

    public function seeIndexPage(\FunctionalTester $I)
    {
        $I->wantTo('Индексная страница изображений отображается');
        $I->see('Images', 'li');
        $I->see('Upload new image', 'a');
        $I->see('Update', 'a');
        $I->see('Delete', 'a');
    }

    // public function actionDelete(\FunctionalTester $I)
    // {
    //     $I->wantTo('Запрос на удаление изображения');
    //     $I->see('Delete', 'a');
    //     $I->click('Delete');
    //     $I->see('Вы действительно хотите удалить это изображение?');
    // }
    public function transitionOnUploadImagePage(\FunctionalTester $I)
    {
        $I->wantTo('Переход на страницу загрузки нового изображения');
        $I->click('Upload new image');
        $I->see('Uploading new image', 'h1');
    }

    // public function createWithEmptyCredentials(\FunctionalTester $I)
    // {
    //     $I->wantTo('Создание изображения с пустыми данными');
    //     $I->amOnRoute('img/create');
    //     $I->submitForm('#img-form', []);
    //     $I->expectTo('see validations errors');
    //     $I->canSee('Name cannot be blank');
    //     $I->canSee('Capture cannot be blank');
    // }

    // public function transitionOnUpdateImagePage(\FunctionalTester $I)
    // {
    //     $I->wantTo('Переход на страницу обновления изображения');
    //     $I->click('Update');
    //     $I->see('Update Image:', 'h1');
    // }

    // public function updateWithOldData(\FunctionalTester $I)
    // {
    //     $I->wantTo('Обновление изображения без внесения изменений');
    //     $I->amOnRoute('img/create');
    //     $I->submitForm('#img-form', []);
    //     $I->see('Images', 'li');
    //     $I->dontSee('Uploading new image', 'h1');
    // }
    
}
