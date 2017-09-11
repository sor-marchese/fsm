<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EventDay */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Event Day',
]) . $model->eventDayId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Days'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->eventDayId, 'url' => ['view', 'id' => $model->eventDayId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="event-day-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
