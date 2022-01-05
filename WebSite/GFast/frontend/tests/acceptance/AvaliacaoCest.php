<?php
namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
class AvaliacaoCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('gfast:8060/');
    }

    // tests
    public function CRUDAvalicao(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->click('Entrar');
        $I->seeCurrentURLEquals('/site/login');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('login-button');
        $I->seeCurrentURLEquals('/');
        $I->amOnPage('/site/produto?id=5');
        $I->seeCurrentURLEquals('/site/produto?id=5');

        $I->click('/html/body/main/div/main/section/a');
        $I->seeCurrentURLEquals('/avaliacoes/create?id=5');
        $I->fillField('Avaliacoes[ava_avaliacao]', 'Era Mesmo esta que eu queria!!');
        $I->click('Save');
        $I->click('/html/body/main/div/main/section/div[2]/div[1]/a[1]/i');

        $I->fillField('Avaliacoes[ava_avaliacao]', 'É Mesmo esta que eu quero!!');
        $I->click('Save');


        $I->see("É Mesmo esta que eu quero!!");


        $I->click("/html/body/main/div/main/section/div[2]/div/a[2]");
        $I->acceptPopup();

        $I->dontSee("É Mesmo esta que eu quero!!");
    }
}
