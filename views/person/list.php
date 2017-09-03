<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
//use yii\widgets\ListView;
use yii\grid\GridView;

// GridView::widget([
//     'dataProvider' => $listDataProvider,
// ]);

// ListView::widget([
//     'dataProvider' => $listDataProvider,
// ]);

/* @var $this yii\web\View */
/* @var $listDataProvider yii\data\ActiveDataProvider */

$this->title = 'People List';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="people-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=GridView::widget([
        'dataProvider' => $listDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // Simple columns defined by the data contained in $dataProvider.
            // Data from the model's column will be used.
            'name',
            'surname',
            'gender',
            'employment',
        ]
    ]); ?>
</div>
