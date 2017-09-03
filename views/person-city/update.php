<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonCity */

$this->title = 'Update Person City: ' . $model->personId;
$this->params['breadcrumbs'][] = ['label' => 'Person Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->personId, 'url' => ['view', 'personId' => $model->personId, 'cityId' => $model->cityId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="person-city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
