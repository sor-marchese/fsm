<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="event-add-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cityId')->dropDownList($cities) ?>

    <?= $form->field($model, 'start_date')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
        ]) ?>

    <?= $form->field($model, 'end_date')->widget(DateControl::classname(), [
    'type'=>DateControl::FORMAT_DATE,
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
