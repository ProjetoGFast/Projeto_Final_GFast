<?php
$this->title = 'DashBoard GFast';
$this->params['breadcrumbs'] = [['label' => $this->title]];

$nguitarras = \common\models\Guitarras::find()->count();
$nuser = \common\models\User::find()->where(['us_inativo' => false])->count();
$nvendas= \common\models\Vendas::find()->count();

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">

            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $nguitarras,
                'text' => 'Guitarras',
                'icon' => 'fas fa-boxes',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $nuser,
                'text' => 'Utilizadores Ativos',
                'theme'=> 'green',
                'icon' => 'fas fa-user',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => $nvendas,
                'text' => 'Vendas',
                'theme'=> 'red',
                'icon' => 'fas fa-piggy-bank',
            ]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '0',
                'text' => 'Encomendas',
                'theme'=> 'warning',
                'icon' => 'fas fa-shopping-cart',
            ]) ?>
        </div>


        <!--<div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <?php/* $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '150',
                'text' => 'New Orders',
                'icon' => 'fas fa-shopping-cart',
                'theme' => 'success'
            ]) */?>
            <?php /*\hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id.'-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) */?>
            <?php/* \hail812\adminlte\widgets\SmallBox::end() */?>
        </div>-->

    </div>




</div>