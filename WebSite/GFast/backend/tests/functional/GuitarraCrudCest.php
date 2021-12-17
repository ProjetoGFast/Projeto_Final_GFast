<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;


class GuitarraCrudCest{


    public function _fixtures()
    {
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


    public function testInserirGuitarra(FunctionalTester $I){

        $I->click('Guitarras');
        $I->click('Criar Guitarra');
        $I->fillField('Guitarras[gui_nome]', 'GuitarTest');
        $I->selectOption('#guitarras-gui_idsubcategoria', '1');
        $I->selectOption('#guitarras-gui_idmarca', '1');
        $I->fillField('Guitarras[gui_idreferencia]', 'Guitar1');
        $I->fillField('Guitarras[gui_descricao]', 'Guitarra de teste');
        $I->fillField('Guitarras[gui_preco]', '250');
        $I->fillField('Guitarras[gui_iva]', '25');
        $I->attachFile('#guitarras-gui_fotopath', '../img/guitar.jpg');
        $I->fillField('Guitarras[gui_inativo]', '1');
        $I->click('submitbtn');
        $I->dontSee('Save');
        $I->see('Update');
        $I->see('GuitarTest');

    }

}
