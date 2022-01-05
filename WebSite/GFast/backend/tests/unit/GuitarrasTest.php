<?php
namespace backend\tests;

use common\fixtures\GuitarrasFixture;
use common\models\Estiloconstrucao;
use common\models\Guitarras;
use common\models\Localidade;
use common\models\Pontosturisticos;
use common\models\Tipomonumento;

class GuitarrasTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'guitarras' => [
                'class' => GuitarrasFixture::className(),
                'dataFile' => codecept_data_dir() . 'guitarras.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testValidarGuitarra()
    {

        $guitarras = new Guitarras();

        //modelo
        $guitarras->gui_nome = null;
        $this->assertFalse($guitarras->validate(['gui_nome']));

        $guitarras->gui_nome = 'Fender 231';
        $this->assertTrue($guitarras->validate(['gui_nome']));

        //idsubcategoria
        $guitarras->gui_idsubcategoria = null;
        $this->assertFalse($guitarras->validate(['gui_idsubcategoria']));

        $guitarras->gui_idsubcategoria = '1';
        $this->assertTrue($guitarras->validate(['gui_idsubcategoria']));


        //idmarca
        $guitarras->gui_idmarca = null;
        $this->assertFalse($guitarras->validate(['gui_idmarca']));

        $guitarras->gui_idmarca = '1';
        $this->assertTrue($guitarras->validate(['gui_idmarca']));

        //referencia
        $guitarras->gui_idreferencia = null;
        $this->assertFalse($guitarras->validate(['gui_idreferencia']));

        $guitarras->gui_idreferencia = 'G001';
        $this->assertTrue($guitarras->validate(['gui_idreferencia']));

        //descricao
        $guitarras->gui_descricao = null;
        $this->assertFalse($guitarras->validate(['gui_descricao']));

        $guitarras->gui_descricao = 'Lorem Ipsum';
        $this->assertTrue($guitarras->validate(['gui_descricao']));

        //Preco
        $guitarras->gui_preco = null;
        $this->assertFalse($guitarras->validate(['gui_preco']));

        $guitarras->gui_preco = '145';
        $this->assertTrue($guitarras->validate(['gui_preco']));



        //IVA
        $guitarras->gui_iva = null;
        $this->assertFalse($guitarras->validate(['gui_iva']));

        $guitarras->gui_iva = '23';
        $this->assertTrue($guitarras->validate(['gui_iva']));

        //Foto
        $guitarras->gui_fotopath = 'foto.png';
        $this->assertTrue($guitarras->validate(['gui_fotopath']));

    }
}