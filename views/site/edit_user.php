<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Editar Usuarios';
$this->params['breadcrumbs'][] = ['label' => 'Ver Usuarios', 'url' => ['site/show_users']];
$this->params['breadcrumbs'][] = $this->title;
if (isset($view)) {
    $style = "display:none;";
} else {
    $style = "";
}
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="container">
        <div class="row">
            <div class="col-md-12 order-md-1">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'name')->textInput(['type' => 'text', 'autofocus' => true])->label('Nombre Usuario') ?>
                <?= $form->field($model, 'username')->textInput(['type' => 'email', 'autofocus' => true])->label('Email') ?>
                <?= $form->field($model, 'telefono')->textInput(['type' => 'number', 'autofocus' => true])->label('Telefono') ?>
                <?= $form->field($model, 'rol')->dropDownList([
                    'admin' => 'Administrador',
                    'user' => 'Usuario',
                ], ['prompt' => 'Selecciona un rol']) ?>
                <?= $form->field($model, 'password')->passwordInput()->label('Password') ?>
                <?= $form->field($model, 'Rpassword')->passwordInput()->label('Repetir Password') ?>


                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Procesar Informacion', ['style' => $style, 'class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#user-password').val('');
        $('#user-rpassword').val('');
    })
</script>