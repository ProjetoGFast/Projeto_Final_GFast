<?php
namespace frontend\tests;

use common\models\User;

class RegistoTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
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

    public function testCriarUser()
    {

        $user = new User();


        $user->username = "Teste";
        $user->email = "teste@teste.pt";
        $user->setPassword("Teste123");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->us_nome = "Duarte";
        $user->us_contribuinte = "999555111";
        $user->us_apelido = "Pereira";
        $user->us_telemovel = 908678546;
        $user->us_cidade = "Leiria";
        $user->us_pontos = 0;
        $user->us_inativo = 0;

        $user->save();


        $this->tester->seeInDatabase('user', ['username' => "Teste"]);



    }
    /* public function testAtualizarUser()
     {

         $user = $this->tester->grabRecord(User::class, array('us_nome' => 'Duarte', 'us_apelido' => 'Pereira'));

         $user->localidade = "Leiria";
         $user->save(false);

         $this->tester->seeInDatabase('user', ['localidade' => 'Leiria']);
     }*/
}