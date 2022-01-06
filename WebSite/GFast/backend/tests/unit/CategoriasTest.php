<?php
namespace backend\tests;

use common\fixtures\CategoriasFixture;
use common\models\Categoriaguitarra;

class CategoriasTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'categorias' => [
                'class' => CategoriasFixture::className(),
                'dataFile' => codecept_data_dir() . 'categorias.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testValidarCategoria()
    {
        $categorias = new Categoriaguitarra();

        //Nome
        $categorias->cat_nome = null;
        $this->assertFalse($categorias->validate(['cat_nome']));

        $categorias->cat_nome = 'Teste 231';
        $this->assertTrue($categorias->validate(['cat_nome']));

        //Inativo
        $categorias->cat_inativo = null;
        $this->assertFalse($categorias->validate(['cat_inativo']));

        $categorias->cat_inativo = '0';
        $this->assertTrue($categorias->validate(['cat_inativo']));

    }

    public function testCriarCategoria()
    {
        $model = new Categoriaguitarra([
            'cat_nome' => 'CategoriaTeste',
            'cat_inativo' => '0',
        ]);
        $categorias = $model->createCategoria();
        $this->tester->seeInDatabase('categoriaguitarra', ['cat_nome' => "CategoriaTeste"]);
        expect($categorias)->true();

    }

    public function testEditarCategoria()
    {
        $categorias = $this->tester->grabRecord('common\models\categoriaguitarra', ['cat_nome'=>'Baixo']);
        $model = Categoriaguitarra::findByCategoriasname($categorias->cat_nome);


        $model->setCatNome('Baixo123');
        $model->save(false);
        $this->tester->seeInDatabase('categoriaguitarra', ['cat_nome' => 'Baixo123']);


    }
}