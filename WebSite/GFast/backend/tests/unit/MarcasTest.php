<?php
namespace backend\tests;

use common\fixtures\GuitarrasFixture;
use common\fixtures\MarcasFixture;
use common\models\Marcas;

class MarcasTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'marcas' => [
                'class' => MarcasFixture::className(),
                'dataFile' => codecept_data_dir() . 'marcas.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testValidarMarca()
    {
        $marcas = new Marcas();

        //Nome
        $marcas->mar_nome = null;
        $this->assertFalse($marcas->validate(['mar_nome']));

        $marcas->mar_nome = 'Teste 231';
        $this->assertTrue($marcas->validate(['mar_nome']));

        //Inativo
        $marcas->mar_inativo = null;
        $this->assertFalse($marcas->validate(['mar_inativo']));

        $marcas->mar_inativo = '0';
        $this->assertTrue($marcas->validate(['mar_inativo']));

    }

    public function testCriarMarca()
    {
        $model = new Marcas([
            'mar_nome' => 'Teste',
            'mar_inativo' => '0',
        ]);
        $marcas = $model->createMarca();
        $this->tester->seeInDatabase('marcas', ['mar_nome' => "Teste"]);
        expect($marcas)->true();

    }

    public function testEditarMarca()
    {
        $marcas = $this->tester->grabRecord('common\models\marcas', ['mar_nome'=>'Yamaha']);
        $model = Marcas::findByMarcasname($marcas->mar_nome);

        $model->setMarNome('Sadowsky123');
        $model->save(false);
        $this->tester->seeInDatabase('marcas', ['mar_nome' => 'Sadowsky123']);


    }



}