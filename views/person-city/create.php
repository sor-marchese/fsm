<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PersonCity */

$this->title = 'Create Person City';
$this->params['breadcrumbs'][] = ['label' => 'Person Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
