<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeliveryOrder */

$this->title = 'Tambah Pengiriman Barang';
$this->params['breadcrumbs'][] = ['label' => 'Pengiriman Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form delivery-order-create content">

    <?= $this->render('_form', [
        'model' => $model, 'detail_do' => $detail_do,
    ]) ?>

</div>
