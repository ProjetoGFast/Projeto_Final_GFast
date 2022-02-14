<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use common\models\Categoriaguitarra;

$categorias = Categoriaguitarra::find()->all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GFast</title>


</head>

<header>
    <div class="container">
        <nav id="navbar">
            <div class="row">
                <div class="col-sm-4">
                    <?= Html::img('@web/images/thumbnail.png', ['id' => 'logo']) ?>
                </div>


                <div class="col-sm-8  ">

                    <?php

                    NavBar::begin([

                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top ',
                        ],
                    ]);

                    $marcas = [];
                    foreach ($categorias as $categoria) {
                        $marcas[] = ['label' => $categoria->cat_nome, 'url' => ['/subcategoria-guitarra/index', 'id' => $categoria->cat_id]];
                    }
                    $menuItems = [
                        ['label' => 'Início', 'url' => ['/site/index']],
                        [
                            'label' => 'Guitarras',
                            'items' => $marcas,
                        ],
                        ['label' => 'Marcas', 'url' => ['/marcas/index']],
                        // ['label' => 'Concertos', 'url' => ['/site/concerto']],
                        ['label' => 'Contactos', 'url' => ['/site/contact']],
                    ];

                    if (Yii::$app->user->isGuest) {
                        $menuItems[] = ['label' => 'Registar', 'url' => ['/site/signup']];
                        $menuItems[] = ['label' => 'Entrar', 'url' => ['/site/login']];
                    } else {

                        if (\Yii::$app->user->can('createPost')) {
                            $utilizador[] = ['label' => 'Backend', 'url' => Yii::$app->urlManagerBackend->createUrl([''])];
                        }

                        // $utilizador[] = ['label' => 'Carrinho', 'url' => ['/encomendas/carrinho']];
                        $utilizador[] = ['label' => 'Encomendas', 'url' => ['/encomendas/index']];
                        $utilizador[] = ['label' => 'Favoritos', 'url' => ['/favoritos/index']];
                        $utilizador[] = ['label' => 'Perfil', 'url' => ['/site/ver-perfil']];


                        $utilizador[] =
                            Html::beginForm(['/site/logout'], 'post') . ' <a class ="dropdown-item ">' .
                            Html::submitButton('Logout', ['class' => 'logout']) . ' </a>' . Html::endForm();

                        $menuItems = [
                            ['label' => 'Início', 'url' => ['/site/index']],
                            [
                                'label' => 'Guitarras',
                                'items' => $marcas,
                            ],
                            ['label' => 'Marcas', 'url' => ['/marcas/index']],
                            //['label' => 'Concertos', 'url' => ['/site/concerto']],
                            ['label' => 'Contactos', 'url' => ['/site/contact']],


                        ];
                        if (!Yii::$app->user->isGuest) {
                            $user_id = Yii::$app->user->identity;
                            $nuser = \common\models\Encomendas::find()->where(['enc_iduser' => $user_id, 'enc_estado' => 1])->count();
                            $menuItems[] = ['label' => Html::tag('span', '', ['class' => 'fa fa-shopping-cart']) . "(" . $nuser . ")", 'url' => '/encomendas/carrinho'];
                        }
                        $menuItems[] = [
                            'label' => Yii::$app->user->identity->username,
                            'items' => $utilizador,
                        ];
                    }
                    echo Nav::widget([
                        'encodeLabels' => false,
                        'items' => $menuItems,
                    ]);
                    NavBar::end();
                    ?>

                </div>


            </div>
    </div>


    </nav>
</header>
<body>

