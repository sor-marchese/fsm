<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Competence */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competence-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'personId')->textInput() ?>

    <?= $form->field($model, 'roleId')->textInput() ?>

    <?= $form->field($model, 'level')->dropDownList([ 'High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
