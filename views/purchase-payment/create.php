<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PurchasePayment */

$this->title = 'Tambah Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Pembelian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form purchase-payment-create content">

    <?= $this->render('_form', [
        'model' => $model, 'detail_purchasePayment' => $detail_purchasePayment,
    ]) ?>

</div>
