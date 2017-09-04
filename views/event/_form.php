<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */

/*<?= $form->field($model, 'start_date')->textInput() ?>*/
/*<?= $form->field($model, 'end_date')->textInput() ?>*/
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cityId')->textInput() ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
        'model' => $model,
        'attribute' => 'start_date',
        'clientOptions' => [
                            'autoclose' => true,
                            'dateFormat' => 'yyyy-MM-dd'
                        ],
        ]) ?>

    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::classname(), [
        'model' => $model,
        'attribute' => 'end_date',
        'clientOptions' => [
                            'autoclose' => true,
                            'dateFormat' => 'yyyy-MM-dd'
                        ],
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
