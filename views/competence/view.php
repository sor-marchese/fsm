<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Competence */

$this->title = $model->personId;
$this->params['breadcrumbs'][] = ['label' => 'Competences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competence-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'personId' => $model->personId, 'roleId' => $model->roleId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'personId' => $model->personId, 'roleId' => $model->roleId], [
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
            'roleId',
            'level',
        ],
    ]) ?>

</div>
