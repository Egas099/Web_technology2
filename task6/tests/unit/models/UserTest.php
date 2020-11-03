<?php

namespace tests\unit\models;
use Codeception\Util\Fixtures;
use app\models\User;
use Codeception\Module\Db;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('admin');
        expect($user->getId())->equals(1);

        expect_not(User::findIdentity(4589666346));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('admin'));
        expect_not(User::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUserPassword($user)
    {
        $user = User::findByUsername('admin');

        expect_that($user->validatePassword('admin','admin'));
        expect_not($user->validatePassword('admin','non-admin'));        
    }

}
