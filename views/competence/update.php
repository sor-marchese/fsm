<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Competence */

$this->title = 'Update Competence: ' . $model->person;
$this->params['breadcrumbs'][] = ['label' => 'Competences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person, 'url' => ['view', 'person' => $model->person, 'role' => $model->role]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="competence-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
