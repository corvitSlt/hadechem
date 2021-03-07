<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalesOrder */

$this->title = $model->so_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sales-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->so_id], ['class' => 'btn btn-primar']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->so_id], [
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
            'so_id',
            'employee_id',
            'customer_id',
            'date',
            'total',
            'sales_id',
            'edit_date',
            'emp_edit_id',
            'status',
        ],
    ]) ?>

</div>
