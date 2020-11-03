<?php

namespace app\models;

use Yii;
// use app\models\Clients;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $login;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = User::find()
            ->where(['accessToken' => $token])
            ->asArray()
            ->one();
        return isset($user) ? new static(array(
            'id' => $user['id'],
            'username' => $user['login'],
            'login' => $user['login'],
        )) : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $users = User::find()
        ->asArray()
            ->all();
        foreach ($users as $user) {
            if (strcasecmp($user['login'], $username) === 0) {

                return new static(array(
                    'id' => $user['id'],
                    'username' => $user['login'],
                    'login' => $user['login'],
                ));
            }
        }

        return null;
    }

    public static function findIdentity($id)
    {
        $user = User::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
        return isset($user) ? new static(array(
            'id' => $user['id'],
            'username' => $user['login'],
            'login' => $user['login'],
        )) : null;
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password, $username)
    {
        $user = User::find()
            ->where(['login' => $username])
            ->asArray()
            ->one();
        return md5($password) === $user['password'];
    }
}
