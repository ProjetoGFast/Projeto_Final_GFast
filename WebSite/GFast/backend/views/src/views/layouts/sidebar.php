
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
//if(\Yii::$app->user->can('crudUsers')){

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <?= Html::img('@web/images/logoguitar.png', ['class' => 'brand-image-tester'] ) ?>

        <span class="brand-text font-weight-light brand-text">&nbsp&nbsp&nbsp&nbspGFast</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?= Html::img('@web/images/user.png', ['class' => 'img-circle elevation-2'] ) ?>

            </div>
            <div class="info">
                <a href="#" class="d-block"><?=Yii::$app->user->identity->username?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
         <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            if (\Yii::$app->user->can('crudUsers')) {


            echo \hail812\adminlte\widgets\Menu::widget([

                    'items' => [['label' => 'Utilizadores',  'icon' => 'users', 'url' => ['user/index']]]
                    ]);
                   }
            ?>
            <?php

            if (\Yii::$app->user->can('crudtabelaGuitarras')) {


                echo \hail812\adminlte\widgets\Menu::widget([

                    'items' => [['label' => 'Guitarras',  'icon' => 'book', 'url' => ['guitarras/index']]]
                ]);
            }

            ?>
            <?php

            if (\Yii::$app->user->can('crudMarcas')) {


                echo \hail812\adminlte\widgets\Menu::widget([

                    'items' => [['label' => 'Marcas',  'icon' => 'book', 'url' => ['marcas/index']]]
                ]);
            }
            ?>
            <?php

            if (\Yii::$app->user->can('crudMarcas')) {


                echo \hail812\adminlte\widgets\Menu::widget([

                    'items' => [['label' => 'Categorias',  'icon' => 'book', 'url' => ['categoriasguitarra/index']]]
                ]);
            }
            ?>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php
//}
?>
