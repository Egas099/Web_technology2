<?php

namespace app\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class UploadImg extends Model
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;
    // public $name;
    // public $caption;

    public function rules()
    {
        return [
            [
                ['imageFile'], 'file',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'maxSize' => 4 * 512000,
                'tooBig' => 'Файл слишком большого размера. Он должен быть не больше 2MB.'
            ],
        ];
    }

    public function upload()
    {
        // Если проверка успешна
        if ($this->validate()) {
            // Сохраняем файл
            return $this->saveImage();
        } else {
            return null;
        }
    }
    public function saveImage() // Сохранение файла на сервере
    {
        $filename = $this->randomFileName();
        $this->imageFile->saveAs('../web/upload/' . $filename);
        return $filename;
    }
    private function randomFileName()
    {
        do {
            $name = md5(microtime() . rand(0, 1000));
            $file = $name.'.'. $this->imageFile->extension;
        } while (file_exists('../web/upload/'.$file));
        return $file;
    }
}
