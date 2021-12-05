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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/subcategorias.css" rel="stylesheet" />
    <link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet"/>

</head>

<header>
    <nav id="navbar">


        <img src="images/home/logo.png" alt="" id="logo"/>

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

