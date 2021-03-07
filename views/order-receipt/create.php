<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderReceipt */

$this->title = 'Tambah Penerimaan Barang';
$this->params['breadcrumbs'][] = ['label' => 'Order Receipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form order-receipt-create content">

    <?= $this->render('_form', [
        'model' => $model, 'detail_or' => $detail_or,
    ]) ?>

</div>
