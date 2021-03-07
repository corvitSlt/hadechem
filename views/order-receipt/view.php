<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderReceipt */

$this->title = $model->or_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Receipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-receipt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->or_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->or_id], [
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
            'or_id',
            'employee_id',
            'po_id',
            'supplier_id',
            'supplier_invoice',
            'date',
            'notes:ntext',
            'shipper',
            'vehicle_number',
            'edit_date',
            'emp_edit_id',
            'status',
        ],
    ]) ?>

</div>
