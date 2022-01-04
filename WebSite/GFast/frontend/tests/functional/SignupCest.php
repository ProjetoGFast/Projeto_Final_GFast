<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#login-form';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function registoCamposVazios(FunctionalTester $I)
    {
        $I->see('Registo', 'h5');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
        $I->seeValidationError('Nome cannot be blank.');
        $I->seeValidationError('Apelido cannot be blank.');
        $I->seeValidationError('Cidade cannot be blank.');
        $I->seeValidationError('Telemovel cannot be blank.');
        $I->seeValidationError('Contribuinte cannot be blank.');


    }

    public function registoCamposIncorretos(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[us_contribuinte]'  => 1234567890,
            'SignupForm[email]'     => 'ttttt',
            'SignupForm[us_telemovel]'  => 1234567890,
        ]
        );
        $I->see('Contribuinte should contain at most 9 characters.', '.invalid-feedback');
        $I->see('Telemovel should contain at most 9 characters.', '.invalid-feedback');
        $I->see('Email is not a valid email address.', '.invalid-feedback');
    }


    public function registoCorreto(FunctionalTester $I)
    {
        $I->amOnPage('/site/signup');
        $I->fillField('SignupForm[username]', 'Tester');
        $I->fillField('SignupForm[email]', 'teste@teste.pt');
        $I->fillField('SignupForm[us_nome]', 'tester1234');
        $I->fillField('SignupForm[us_apelido]', 'gfast');
        $I->fillField('SignupForm[us_cidade]', 'Leiria');
        $I->fillField('SignupForm[us_telemovel]', '914254541');
        $I->fillField('SignupForm[us_telemovel]', '914252341');
        $I->fillField('SignupForm[us_contribuinte]', '1234567890');
        $I->fillField('SignupForm[us_contribuinte]', '247685938');
        $I->fillField('SignupForm[password]', 'teste123');
        $I->click('signup-button');
        $I->see('Registo Concluido :)');
    }


}
