<?php
namespace backend\tests;

use common\fixtures\GuitarrasFixture;
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
        'class' => GuitarrasFixture::className(),
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
}