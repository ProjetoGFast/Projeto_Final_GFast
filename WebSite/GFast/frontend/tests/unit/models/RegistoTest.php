<?php

namespace frontend\tests;

use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\SignupForm;

class RegistoTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    public function testRegisto()
    {

        $user = new User();


        //Username
        $user->username = null;
        $this->assertFalse($user->validate(['username']));

        $user->username = 'Teste';
        $this->assertTrue($user->validate(['username']));

        //Nome

        $user->us_nome = null;
        $this->assertFalse($user->validate(['us_nome']));

        $user->us_nome = 'Duarte';
        $this->assertTrue($user->validate(['us_nome']));

        //Apelido

        $user->us_apelido = null;
        $this->assertFalse($user->validate(['us_apelido']));

        $user->us_apelido = 'Pereira';
        $this->assertTrue($user->validate(['us_apelido']));


        //Cidade
        $user->us_cidade = null;
        $this->assertFalse($user->validate(['us_cidade']));

        $user->us_cidade = "Leiria";
        $this->assertTrue($user->validate(['us_cidade']));

        //Telemovel

        $user->us_telemovel = 123124123123123123;
        $this->assertFalse($user->validate(['us_telemovel']));
        $user->us_telemovel = 1231;
        $this->assertFalse($user->validate(['us_telemovel']));
        $user->us_telemovel = "";
        $this->assertFalse($user->validate(['us_telemovel']));

        $user->us_telemovel = 918909879;
        $this->assertTrue($user->validate(['us_telemovel']));


        //Contribuinte

        $user->us_contribuinte = 123124123123123123;
        $this->assertFalse($user->validate(['us_contribuinte']));
        $user->us_contribuinte = 1231;
        $this->assertFalse($user->validate(['us_contribuinte']));
        $user->us_contribuinte = "k";
        $this->assertFalse($user->validate(['us_contribuinte']));

        $user->us_contribuinte = "123456729";
        $this->assertTrue($user->validate(['us_contribuinte']));
    }


    public function testRegistoCorreto()
    {
        $model = new User([
            'username' => 'SignUpTest',
            'email' => 'teste@teste.com',
            'password_hash' => 'some_password',
            'us_nome' => 'Signup',
            'us_apelido' => 'gfast',
            'us_cidade' => 'Leiria',
            'us_telemovel' => '934765343',
            'us_contribuinte' => '123443789',
        ]);

        $user = $model->signupTest();
        $this->tester->seeInDatabase('user', ['username' => "SignUpTest"]);
        expect($user)->true();


    }

    public function testEditarUser()
    {
        $user = $this->tester->grabRecord('common\models\user', ['username'=>'okirlin']);
        $model = User::findByUsername($user->username);
        $model->setUsername('Duarte');
        $model->save(false);
        $this->tester->seeInDatabase('user', ['username' => 'Duarte']);
    }


    public function testEmailIncorreto()
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
            'us_nome' => 'erau',
            'us_apelido' => 'uare',
            'us_cidade' => 'Leiria',
            'us_telemovel' => '934765893',
            'us_contribuinte' => '1234567890',
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('username'))
            ->equals('Este username já está a ser utilizado');
        expect($model->getFirstError('email'))
            ->equals('Este Email já está a ser utilizado');
    }
}