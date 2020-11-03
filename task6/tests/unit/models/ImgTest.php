<?php

namespace tests\unit\models;

use app\models\Img;
use Codeception\Util\Fixtures;

class ImgTest extends \Codeception\Test\Unit
{
    public $imgRightData;
    public $imgWrongData;

    public function _before()
    {
        $this->imgRightData = Fixtures::get('imgRightData');
        $this->imgWrongData = Fixtures::get('imgWrongData');
        // $this->tester->haveInDatabase('img', $this->imgWrongData['normal']);
    }
    public function testValidateNormalImg()
    {
        $img = new img($this->imgWrongData['normal']);
        expect_that($img->validate());
    }
    // public function testValidateEmptylImg()
    // {
    //     $this->model = new img($this->images['empty']);
    //     expect_not($this->model->validate());
    // }
    // public function testValidateLongCaptionImg()
    // {
    //     $this->model = new img($this->images['longCaption']);
    //     expect_not($this->model->validate());

    // }
    // public function testSaveImgInDB()
    // {
    //     $img = new Img($this->imgWrongData['normal']);
    //     expect_that($img->save());
    //     $this->tester->seeInDatabase('img', $this->imgWrongData['normal']);
    // }
}
