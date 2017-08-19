<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Registration Successful';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-registration-ok">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        You are successfully registered to FSM<br>
        Click the Login button to sign in
    </p>
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

</div>
