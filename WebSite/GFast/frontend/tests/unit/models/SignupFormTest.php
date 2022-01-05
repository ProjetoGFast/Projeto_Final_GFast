<?php

namespace unit\models;

use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new User([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
            'us_nome'=>'erau',
            'us_apelido'=>'uare',
            'us_cidade'=>'Leiria',
            'us_telemovel'=>'934765893',
            'us_contribuinte'=>'1234567890',
        ]);

        $user = $model->signupTest();
        expect($user)->true();

        /** @var \common\models\User $user */
        $user = $this->tester->grabRecord('common\models\User', [
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'us_nome'=>'erau',
            'us_apelido'=>'uare',
            'us_cidade'=>'Leiria',
            'us_telemovel'=>'934765893',
            'us_contribuinte'=>'1234567890',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);


    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
            'us_nome'=>'erau',
            'us_apelido'=>'uare',
            'us_cidade'=>'Leiria',
            'us_telemovel'=>'934765893',
            'us_contribuinte'=>'1234567890',
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('username'));
        expect_not($model->signup());
        expect_that($model->getErrors('password'));

        expect($model->getFirstError('username'))
            ->equals('Este username já está a ser utilizado');

        expect($model->getFirstError('username'))
            ->equals('Este username já está a ser utilizado');

    }
}
