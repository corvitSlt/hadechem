<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseRequest */

$this->title = 'Tambah Permintaan Pembelian';
$this->params['breadcrumbs'][] = ['label' => 'Purchase Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form purchase-request-create content">
    <?= $this->render('_form', [
        'model' => $model, 'detail_pr' => $detail_pr,
    ]) ?>

</div>
