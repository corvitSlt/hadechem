<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Item Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-item-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sub Item Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sub_item_category_id',
            'item_category_id',
            'sub_item_category_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
