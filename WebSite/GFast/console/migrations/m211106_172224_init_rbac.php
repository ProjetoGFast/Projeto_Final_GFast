<?php

use yii\db\Migration;

/**
 * Class m211106_172224_init_rbac
 */
class m211106_172224_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $auth = Yii::$app->authManager;

        // add the rule
        $rule = new \frontend\rbac\ClienteRule();
        $auth->add($rule);

        //BACKEND

        $crudLojas = $auth->createPermission('crudLojas');
        $crudLojas->description = 'CRUD Lojas';
        $auth->add($crudLojas);

        $crudCategorias = $auth->createPermission('crudCategorias');
        $crudCategorias->description = 'CRUD Categorias';
        $auth->add($crudCategorias);


        $crudSubCategorias = $auth->createPermission('crudSubCategorias');
        $crudSubCategorias->description = 'CRUD SubCategorias';
        $auth->add($crudSubCategorias);

        $crudGuitarras = $auth->createPermission('crudtabelaGuitarras');
        $crudGuitarras->description = 'CRUD Tabela Guitarras';
        $auth->add($crudGuitarras);


        $crudConcertos = $auth->createPermission('crudConcertos');
        $crudConcertos->description = 'CRUD Concertos';
        $auth->add($crudConcertos);

        $crudPontos = $auth->createPermission('crudPontos');
        $crudPontos->description = 'CRUD Pontos';
        $auth->add($crudPontos);

        $crudUsers = $auth->createPermission('crudUsers');
        $crudUsers->description = 'CRUD Users';
        $auth->add($crudUsers);

        $crudMarcas = $auth->createPermission('crudMarcas');
        $crudMarcas->description = 'CRUD Marcas';
        $auth->add($crudMarcas);

        $alterarEncomenda = $auth->createPermission('alterarEncomenda');
        $alterarEncomenda->description = 'Alterar Encomendas';
        $auth->add($alterarEncomenda);


        $crudEncomendas = $auth->createPermission('crudEncomendas');
        $crudEncomendas->description = 'crud Encomendas';
        $crudEncomendas->ruleName = $rule->name;
        $auth->add($crudEncomendas);

        //lOGOUT
        $logout = $auth->createPermission('logout');
        $logout->description = 'Logout';
        $auth->add($logout);


        //FRONTEND Rules
        $editarOwnPerfil = $auth->createPermission('editarOwnPerfil');
        $editarOwnPerfil->description = 'Editar Próprio Perfil';
        $editarOwnPerfil->ruleName = $rule->name;
        $auth->add($editarOwnPerfil);

        $verOwnPerfil = $auth->createPermission('verOwnPerfil');
        $verOwnPerfil->description = 'Ver Perfil';
        $verOwnPerfil->ruleName = $rule->name;
        $auth->add($verOwnPerfil);

        $verOwnEncomendas = $auth->createPermission('verOwnEncomenda');
        $verOwnEncomendas->description = 'Ver Próprias Encomendas';
        $verOwnEncomendas->ruleName = $rule->name;
        $auth->add($verOwnEncomendas);


        $verOwnPontos = $auth->createPermission('verOwnPontos');
        $verOwnPontos->description = 'Ver Próprios Pontos';
        $verOwnPontos->ruleName = $rule->name;
        $auth->add($verOwnPontos);

        $verOwnSaldo = $auth->createPermission('verOwnSaldo');
        $verOwnSaldo->description = 'Ver Próprio Saldo';
        $verOwnSaldo->ruleName = $rule->name;
        $auth->add($verOwnSaldo);


        $fazerOwnEncomenda = $auth->createPermission('fazerOwnEncomenda');
        $fazerOwnEncomenda->description = 'Fazer Próprias Encomendas';
        $fazerOwnEncomenda->ruleName = $rule->name;
        $auth->add($fazerOwnEncomenda);

        $adicionarOwnSaldo = $auth->createPermission('adicionarOwnSaldo');
        $adicionarOwnSaldo->description = 'Adicionar Saldo';
        $adicionarOwnSaldo->ruleName = $rule->name;
        $auth->add($adicionarOwnSaldo);

        $adicionarOwnCarrinho = $auth->createPermission('adicionarOwnCarrinho');
        $adicionarOwnCarrinho->description = 'Adicionar ao Próprio Carrinho';
        $adicionarOwnCarrinho->ruleName = $rule->name;
        $auth->add($adicionarOwnCarrinho);

        $verOwnCarrinho = $auth->createPermission('verOwnCarrinho');
        $verOwnCarrinho->description = 'Ver Proprio Carrinho';
        $verOwnCarrinho->ruleName = $rule->name;
        $auth->add($verOwnCarrinho);

        $eliminarOwnCarrinho = $auth->createPermission('eliminarOwnCarrinho');
        $eliminarOwnCarrinho->description = 'Eliminar Próprio Carrinho';
        $eliminarOwnCarrinho->ruleName = $rule->name;
        $auth->add($eliminarOwnCarrinho);

        $crudOwnAvaliacao = $auth->createPermission('crudOwnAvaliacao');
        $crudOwnAvaliacao->description = 'CRUD à Propria Avaliação';
        $crudOwnAvaliacao->ruleName = $rule->name;
        $auth->add($crudOwnAvaliacao);

        //Cliente
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        $auth->addChild($cliente, $verOwnEncomendas);
        $auth->addChild($cliente, $logout);
        $auth->addChild($cliente, $verOwnPontos);
        $auth->addChild($cliente, $editarOwnPerfil);
        $auth->addChild($cliente, $verOwnSaldo);
        $auth->addChild($cliente, $fazerOwnEncomenda);
        $auth->addChild($cliente, $adicionarOwnSaldo);
        $auth->addChild($cliente, $adicionarOwnCarrinho);
        $auth->addChild($cliente, $verOwnCarrinho);
        $auth->addChild($cliente, $eliminarOwnCarrinho);
        $auth->addChild($cliente, $crudOwnAvaliacao);

        //Funcionário
        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $auth->addChild($funcionario, $cliente);
        $auth->addChild($funcionario, $crudEncomendas);

        //Gestor
        $gestor = $auth->createRole('gestor');
        $auth->add($gestor);
        $auth->addChild($gestor, $funcionario);
        $auth->addChild($gestor, $cliente);
        $auth->addChild($gestor, $crudCategorias);
        $auth->addChild($gestor, $crudSubCategorias);
        $auth->addChild($gestor, $crudConcertos);
        $auth->addChild($gestor, $crudGuitarras);
        $auth->addChild($gestor, $crudPontos);
        $auth->addChild($gestor, $crudMarcas);



        //admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $funcionario);
        $auth->addChild($admin, $gestor);
        $auth->addChild($admin, $cliente);
        $auth->addChild($admin, $crudLojas);
        $auth->addChild($admin, $crudUsers);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211106_172224_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
