<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventDay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-day-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'eventId')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'activity')->dropDownList([ 'Transport' => 'Transport', 'Preparation' => 'Preparation', 'Event' => 'Event', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
