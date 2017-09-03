<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Person Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Person City', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'personId',
            'cityId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
