<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class UserCrudCest{


    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }


    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'erau');
        $I->fillField('LoginForm[password]', 'password_0');
        $I->click('login-button');

    }

    // tests
    public function createUser(FunctionalTester $I)
    {
        $I->click('Utilizadores');
        $I->click('Criar utilizador');
        $I->fillField('User[us_nome]', 'testernome');
        $I->fillField('User[us_apelido]', 'testerapelido');
        $I->fillField('User[email]', 'testeremail@gmail.com');
        $I->fillField('User[username]', 'usertester');
        $I->fillField('User[password_hash]', 'testpasword');
        $I->fillField('User[us_cidade]', 'Leiria');
        $I->fillField('User[us_telemovel]', '910000000');
        $I->fillField('User[us_contribuinte]', '123456789');
        $I->fillField('User[us_pontos]', '123');

        $I->click('submitbtn');
        $I->dontSee('Save');
        $I->see('Showing');
        $I->see('testernome');

    }



   /* public function testNulls(FunctionalTester $I)
    {
        $I->click('Utilizadores');
        $I->click('Criar utilizador');
        $I->fillField('User[us_nome]', '');
        $I->fillField('User[us_apelido]', '');
        $I->fillField('User[email]', '');
        $I->fillField('User[username]', '');

        $I->fillField('User[password_hash]', '');
        $I->fillField('User[us_cidade]', '');
        $I->fillField('User[us_telemovel]', '');
        $I->fillField('User[us_contribuinte]', '');
        $I->fillField('User[us_pontos]', '');

        $I->see('Email cannot be blank.');
        //$I->click('submitbtn');
    }*/



}
