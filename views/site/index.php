<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <?php if (Yii::$app->user->isGuest) { ?>
            <h1 class="display-4">Inicia Sesion</h1>
            <p><a class="btn btn-lg btn-success" href="index.php?r=site/login">Log In</a></p>
        <?php } else { ?>
            <h1 class="display-4">Hola <?= Yii::$app->user->identity->name ?>!</h1>
            <?php if (Yii::$app->user->identity->rol == 'admin') {
                echo "<p><a class='btn btn-lg btn-success' href='index.php?r=site/create'>Crear Usuario</a></p>";
            } else {
                echo "<p>No puedes hacer nada si no eres Administrador</p>";
            }
            ?>
        <?php } ?>
    </div>
</div>