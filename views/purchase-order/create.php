<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseOrder */

$this->title = 'Tambah Order Pembelian (PO)';
$this->params['breadcrumbs'][] = ['label' => 'Order Pembelian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form purchase-order-create content">

    <?= $this->render('_form', [
        'model' => $model, 'detail_po' => $detail_po,
    ]) ?>

</div>
