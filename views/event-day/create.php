<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EventDay */

$this->title = Yii::t('app', 'Create Event Day');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Days'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-day-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
