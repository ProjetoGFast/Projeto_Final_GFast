<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class UserCrudCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
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
        $I->fillField('User[email]', 'testeremail');
        $I->fillField('User[username]', 'usertester');
        $I->fillField('User[password_hash]', 'testpasword');
        $I->fillField('User[us_cidade]', 'Leiria');
        $I->fillField('User[us_telemovel]', '910000000');
        $I->fillField('User[us_contribuinte]', '123456789');
        $I->fillField('User[us_pontos]', '123');

        $I->click('Save');
        $I->see('Update');



    }
}
