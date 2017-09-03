<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
// BLOCCONE COMMENTATO PER CITTA
// use kartik\depdrop\DepDrop;
// use yii\helpers\Url;
// $form->field($selRegion, 'region')->dropDownList($regions,
//     [   'prompt' => 'Select region',
//         'onchange' => '$.post("index.php?r=city/lists&region=' . '"+$(this).text(),
//         function(data)
//         {
//             $("select#region").html(data);
//         });'
//     ])
//$dataPost=ArrayHelper::map(\app\Models\City::find()->asArray()->all(), 'cityId', 'name');
// $form->field($selRegion, 'name')->dropDownList(
//     ArrayHelper::map(\app\Models\City::find()->asArray()->all(), 'cityId', 'name'),
// ['prompt' => 'Select city',
// ])
// With DepDrop plugin
//  $form->field($selRegion, 'region')->dropDownList($regions, ['id'=>'cat-id']);
//
 //
//  $form->field($selRegion, 'name')->widget(DepDrop::classname(), [
//      'pluginOptions'=>[
//          'depends'=>['cat-id'],
//          'placeholder' => 'Select...',
//          'url' => Url::to(['/city/subcat'])
//      ]
//  ]);
//

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-registration">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create a new account.<br>
    Password must be between 4 to 14 characters long.</p>

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'name')->textInput() ?>

        <?= $form->field($model, 'surname')->textInput() ?>

        <?= $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', ], ['prompt' => '']) ?>

        <?= $form->field($model, 'employment')->dropDownList([ 'partita iva' => 'Partita iva', 'voucher/legge sport' => 'Voucher/legge sport', 'società' => 'Società', ], ['prompt' => '']) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
