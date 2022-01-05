<?php
namespace backend\tests;

use common\fixtures\GuitarrasFixture;
use common\models\Estiloconstrucao;
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
        $guitarra = $this->tester->grabFixture('guitarras', 0);
        var_dump($guitarra);
        die();
       /* $pontoTuristico = new Pontosturisticos();

        //Despoletar todas as regras de validação

        //Nome Ponto Turistico
        $pontoTuristico->nome = null;
        $this->assertFalse($pontoTuristico->validate(['nome']));

        $pontoTuristico->nome = 'Castelo de Leiria';
        $this->assertTrue($pontoTuristico->validate(['nome']));

        //Ano de Construção

        $pontoTuristico->anoConstrucao = null;
        $this->assertTrue($pontoTuristico->validate(['anoConstrucao']));

        $pontoTuristico->anoConstrucao = '1135';
        $this->assertTrue($pontoTuristico->validate(['anoConstrucao']));

        //Descrição

        $pontoTuristico->descricao = null;
        $this->assertFalse($pontoTuristico->validate(['descricao']));

        $pontoTuristico->descricao = 'Localizado em Leiria';
        $this->assertTrue($pontoTuristico->validate(['descricao']));

        //Foto

        $pontoTuristico->foto = 'castelo-de-leiria.jpg';
        $this->assertTrue($pontoTuristico->validate(['foto']));

        //Tipo de Monumento

        $pontoTuristico->tm_idTipoMonumento = Tipomonumento::findOne(['descricao' => 'Castelo'])->idTipoMonumento;
        $this->assertTrue($pontoTuristico->validate(['tm_idTipoMonumento']));

        //Estilo de Construção

        $pontoTuristico->ec_idEstiloConstrucao = Estiloconstrucao::findOne(['descricao' => 'Barroco'])->idEstiloConstrucao;
        $this->assertTrue($pontoTuristico->validate(['ec_idEstiloConstrucao']));

        //Localidade

        $pontoTuristico->localidade_idLocalidade = Localidade::findOne(['nomeLocalidade' => 'Leiria'])->id_localidade;
        $this->assertTrue($pontoTuristico->validate(['localidade_idLocalidade']));

        //Horário

        $pontoTuristico->horario = null;
        $this->assertTrue($pontoTuristico->validate(['horario']));

        $pontoTuristico->horario = '09:00h - 17:00h';
        $this->assertTrue($pontoTuristico->validate(['horario']));

        //Morada

        $pontoTuristico->morada = null;
        $this->assertTrue($pontoTuristico->validate(['morada']));

        $pontoTuristico->morada = 'Rua C, nº50';
        $this->assertTrue($pontoTuristico->validate(['morada']));

        //Telefone

        $pontoTuristico->telefone = null;
        $this->assertTrue($pontoTuristico->validate(['telefone']));

        $pontoTuristico->telefone = '924639852';
        $this->assertTrue($pontoTuristico->validate(['telefone']));

        //Latitude

        $pontoTuristico->latitude = null;
        $this->assertFalse($pontoTuristico->validate(['latitude']));

        $pontoTuristico->latitude = '39.74362';
        $this->assertTrue($pontoTuristico->validate(['latitude']));

        //Longitude

        $pontoTuristico->longitude = null;
        $this->assertFalse($pontoTuristico->validate(['longitude']));

        $pontoTuristico->longitude = '-8.80705';
        $this->assertTrue($pontoTuristico->validate(['longitude']));*/

    }
}