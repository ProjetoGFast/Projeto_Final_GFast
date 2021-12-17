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
    <link rel="icon" href="../../web/images/home/guitar_icon.png">
    <title>GFast</title>


</head>

<header>
    <nav id="navbar">

        <?= Html::img('@web/images/thumbnail.png', ['id' => 'logo']) ?>


        <div id="navbar-right">
            <?php

            NavBar::begin([

                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
                ],
            ]);


            foreach ($categorias as $categoria) {
                $marcas[]=['label' => $categoria->cat_nome, 'url' => ['/site/subcategoria', 'id' => $categoria -> cat_id]];
            }
            $menuItems = [
                ['label' => 'Início', 'url' => ['/site/index']],
                [
                    'label' => 'Guitarras',
                    'items' => $marcas,
                ],
                ['label' => 'Marcas', 'url' => ['/site/marca']],
                ['label' => 'Concertos', 'url' => ['/site/concerto']],
                ['label' => 'Contactos', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Registar', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Entrar', 'url' => ['/site/login']];
            } else {

                if (\Yii::$app->user->can('createPost')) {
                    $utilizador[] = ['label' => 'Backend', 'url' => Yii::$app->urlManagerBackend->createUrl([''])];
                }





                $utilizador[] = ['label' => 'Perfil', 'url' => ['/site/ver-perfil']];
                $utilizador[] =
                        Html::beginForm(['/site/logout'], 'post') .' <a class ="dropdown-item ">'.
                        Html::submitButton('Logout', ['class' => 'logout']) . ' </a>'. Html::endForm();

                $menuItems = [
                    ['label' => 'Início', 'url' => ['/site/index']],
                    [
                        'label' => 'Guitarras',
                        'items' => $marcas,
                    ],
                    ['label' => 'Marcas', 'url' => ['/site/marca']],
                    ['label' => 'Concertos', 'url' => ['/site/concerto']],
                    ['label' => 'Contactos', 'url' => ['/site/contact']],
                    [
                        'label' => Yii::$app->user->identity->username,
                        'items' => $utilizador,
                    ],

                ];
            }
            echo Nav::widget([
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
        </div>


</nav>
    </header>
<body>

