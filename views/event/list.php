<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\grid\GridView;

$this->title = 'Event List';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="event-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=GridView::widget([
        'dataProvider' => $listDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // Simple columns defined by the data contained in $dataProvider.
            // Data from the model's column will be used.
            'name',
            'city',
            'region',
            'start_date',
            'end_date',
        ]
    ]); ?>
</div>
