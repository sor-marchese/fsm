<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $listDataProvider yii\data\ActiveDataProvider */
ListView::widget([
    'dataProvider' => $listDataProvider,
]);

$this->title = 'People List';
$this->params['breadcrumbs'][] = $this->title;
?>
