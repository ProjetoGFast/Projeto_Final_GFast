<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class MarcaCrudCest {

    public function _fixtures(){
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I){
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'erau');
        $I->fillField('LoginForm[password]', 'password_0');
        $I->click('login-button');
    }


    public function testInserirMarca(FunctionalTester $I){

        $I->click('Marcas');
        $I->click('Criar Marca');
        $I->fillField('Marcas[mar_nome]', 'MarcaTest');
        $I->fillField('Marcas[mar_inativo]', '1');
        $I->click('submitbtn');
        $I->see('Update');
        $I->see('MarcaTest');

    }

    public function testEditarMarca(FunctionalTester $I){

        $I->click('Marcas');
        $I->click('//table/tbody/tr[1]/td[4]/a[2]');
        $I->see('Update Marcas: 1');
        $I->fillField('Marcas[mar_nome]', 'Teste');
        $I->click('submitbtn');
        $I->see('Update');
        $I->see('Teste');
    }




}
