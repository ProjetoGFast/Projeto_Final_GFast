<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class CategoriasCrudCest{

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

    public function testInserirCategoria(FunctionalTester $I){
        $I->click('Categoria');
        $I->click('Categorias');
        $I->click('Criar Categoria');
        $I->fillField('Categoriaguitarra[cat_nome]', 'catTest');
        $I->fillField('Categoriaguitarra[cat_inativo]', '1');
        $I->click('submitbtn');
        $I->see('Update');
        $I->see('catTest');
    }

    public function testEditarCategoria(FunctionalTester $I){

        $I->click('Categoria');
        $I->click('Categorias');
        $I->see('Categoria Guitarras');
        $I->click('//table/tbody/tr[4]/td[4]/a[2]');
        $I->see('Update Categoria Guitarra: 4');
        $I->fillField('Categoriaguitarra[cat_nome]', 'Teste');
        $I->click('submitbtn');
        $I->see('Teste');
        $I->see('Update');
    }



}
