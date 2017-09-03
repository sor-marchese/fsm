<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PersonCity */

$this->title = $model->personId;
$this->params['breadcrumbs'][] = ['label' => 'Person Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-city-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'personId' => $model->personId, 'cityId' => $model->cityId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'personId' => $model->personId, 'cityId' => $model->cityId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'personId',
            'cityId',
        ],
    ]) ?>

</div>
