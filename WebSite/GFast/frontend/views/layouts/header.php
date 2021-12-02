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
    <title>Home | GFast</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>

<header>

    <div id="navbar">

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
                $marcas[]=['label' => $categoria->cat_nome, 'url' => '#'];
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
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>';
            }
            echo Nav::widget([
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
        </div>
    </div>

</header>

<body>

