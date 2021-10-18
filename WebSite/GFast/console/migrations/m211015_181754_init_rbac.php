<?php

use yii\db\Migration;

/**
 * Class m211015_181754_init_rbac
 */
class m211015_181754_init_rbac extends Migration
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

        $crudGuitarras = $auth->createPermission('crudtabelaGuitarras');
        $crudGuitarras->description = 'CRUD Tabela Guitarras';
        $auth->add($crudGuitarras);

        $crudCategorias = $auth->createPermission('crudCategorias');
        $crudCategorias->description = 'CRUD Categorias';
        $auth->add($crudCategorias);

        $crudConcerto = $auth->createPermission('crudConcerto');
        $crudConcerto->description = 'CRUD Concerto';
        $auth->add($crudConcerto);

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

        //lOGOUT
        $logout = $auth->createPermission('logout');
        $logout->description = 'Logout';
        $auth->add($logout);


        //FRONTEND
        $editarPerfil = $auth->createPermission('editarPerfil');
        $editarPerfil->description = 'Editar Perfil';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($editarPerfil);

        $verPerfil = $auth->createPermission('verPerfil');
        $verPerfil->description = 'Ver Perfil';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($verPerfil);

        $verEncomendas = $auth->createPermission('verEncomenda');
        $verEncomendas->description = 'Ver Encomendas';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($verEncomendas);


        $verPontos = $auth->createPermission('verPontos');
        $verPontos->description = 'Ver Pontos';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($verPontos);

        $alterarEcomenda = $auth->createPermission('alterarEcomenda');
        $alterarEcomenda->description = 'Alterar Encomenda';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($alterarEcomenda);

        $fazerEncomenda = $auth->createPermission('fazerEncomenda');
        $fazerEncomenda->description = 'Fazer Encomenda';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($fazerEncomenda);

        $adicionarSaldo = $auth->createPermission('adicionarSaldo');
        $adicionarSaldo->description = 'Adicionar Saldo';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($adicionarSaldo);

        $adicionarCarrinho = $auth->createPermission('adicionarCarrinho');
        $adicionarCarrinho->description = 'Adicionar Carrinho';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($adicionarCarrinho);

        $verCarrinho = $auth->createPermission('verCarrinho');
        $verCarrinho->description = 'Ver Carrinho';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($verCarrinho);

        $eliminarCarrinho = $auth->createPermission('eliminarCarrinho');
        $eliminarCarrinho->description = 'Eliminar Carrinho';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($eliminarCarrinho);

        $crudAvaliacao = $auth->createPermission('crudAvaliacao');
        $crudAvaliacao->description = 'CRUD Avaliação';
        $editarPerfil->ruleName = $rule->name;
        $auth->add($crudAvaliacao);

        //Cliente
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        //$auth->addChild($author, $createPost);

        //Funcionário
        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        //$auth->addChild($author, $createPost);

        //Funcionário
        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        //$auth->addChild($author, $createPost);


        //Gestor
        $gestor = $auth->createRole('admin');
        $auth->add($gestor);
        //$auth->addChild($admin, $updatePost);



        //admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $funcionario);
        $auth->addChild($admin, $gestor);
        $auth->addChild($admin, $cliente);







        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
       // $auth->assign($author, 2);
        $auth->assign($admin, 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211015_181754_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211015_181754_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
