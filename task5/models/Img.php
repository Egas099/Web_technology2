<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "img".
 *
 * @property int $id
 * @property string $path
 * @property string $name
 * @property string $caption
 * @property int user_id
 */
class Img extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'caption', 'path', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'caption', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'path' => 'Path',
            'id' => 'ID',
            'name' => 'Name',
            'caption' => 'Caption',
            'user_id' => 'User ID',
        ];
    }
}
