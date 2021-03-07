<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalesPayment */

$this->title = 'Tambah Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Pembayaran Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form sales-payment-create content">
    <?= $this->render('_form', [
        'model' => $model, 'detail_salesPayment' => $detail_salesPayment,
    ]) ?>

</div>
