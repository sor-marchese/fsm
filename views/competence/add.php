<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Competence */
/* @var $listPeople app\models\Competence */
/* @var $listRoles app\models\Competence */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Add Competence';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="competence-add">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'personId')->dropDownList($listPeople,['prompt'=>'Select...']) ?>

    <?= $form->field($model, 'roleId')->dropDownList($listRoles,['prompt'=>'Select...']) ?>

    <?= $form->field($model, 'level')->dropDownList([ 'High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
