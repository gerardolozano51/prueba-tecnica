<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Ver Usuarios';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <a href="index.php?r=site/create"><button type="button" class="btn btn-info">Crear Usuario</button></a>
    <?= GridView::widget([
        'dataProvider' => $data,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'username',
            'rol',
            ['class' => 'yii\grid\ActionColumn'], // Columna con acciones para editar y borrar
        ],
    ]); ?>
</div>