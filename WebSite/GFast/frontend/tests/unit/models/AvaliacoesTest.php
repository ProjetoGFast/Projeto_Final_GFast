<?php
namespace frontend\tests;

use common\fixtures\AvaliacoesFixture;
use common\fixtures\GuitarrasFixture;
use common\fixtures\UserFixture;
use common\models\Avaliacoes;
use common\models\User;

class AvaliacoesTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'avaliacao' => [
                'class' => AvaliacoesFixture::className(),
                'dataFile' => codecept_data_dir() . 'avaliacoes.php'
            ]
        ]);
        $this->tester->haveFixtures([
        'guitarras' => [
            'class' => GuitarrasFixture::className(),
            'dataFile' => codecept_data_dir() . 'guitarras.php'
            ]
        ]);
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

    // tests
    public function testAvaliacao()
    {
        $avaliacoes = new Avaliacoes();


        //ava_avaliacao
        $avaliacoes->ava_avaliacao = null;
        $this->assertFalse($avaliacoes->validate(['ava_avaliacao']));

        $avaliacoes->ava_avaliacao = 'Teste';
        $this->assertTrue($avaliacoes->validate(['ava_avaliacao']));

    }
    public function testCriarRegisto()
    {
        $model = new Avaliacoes([
            'ava_avaliacao' => 'Lindo',
            'ava_idguitarra' => '1',
            'ava_iduser' => '1',
        ]);

        $user = $model->createAva();
        $this->tester->seeInDatabase('avaliacoes', ['ava_avaliacao' => "Lindo"]);
        expect($user)->true();



    }
    public function testEditarUser()
    {
        $ava = $this->tester->grabRecord('common\models\avaliacoes', ['ava_avaliacao'=>'Lindo']);


        $model = Avaliacoes::findByTitulo($ava->ava_avaliacao);

        $model->ava_avaliacao = 'Siga Siga';

        $model->save(false);
         $this->tester->seeInDatabase('avaliacoes', ['ava_avaliacao' => 'Siga Siga']);



    }

}