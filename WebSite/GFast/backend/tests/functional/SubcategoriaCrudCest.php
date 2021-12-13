<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class SubcategoriaCrudCest {

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

    public function testInserirSubcategoria(FunctionalTester $I){

        $I->click('Categorias');
        $I->click('SubCategorias');
        $I->click('Criar Subcategoria');
        $I->fillField('Subcategoriaguitarra[sub_nome]', 'SubcatTest');
        $I->selectOption('#subcategoriaguitarra-sub_idcat', '1');
        $I->click('submitbtn');
        $I->see('Update');
        $I->see('SubcatTest');

    }

    public function testEditarSubcategoria(FunctionalTester $I){

        $I->click('Categorias');
        $I->click('SubCategorias');
        $I->click('//table/tbody/tr[1]/td[4]/a[2]');
        $I->see('Update Subcategoria Guitarra: 1');
        $I->fillField('Subcategoriaguitarra[sub_nome]', 'ModeloTest');
        $I->selectOption('#subcategoriaguitarra-sub_idcat', '1');
        $I->click('submitbtn');

    }
}
