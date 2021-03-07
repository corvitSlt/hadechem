<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalesOrder */

$this->title = 'Tambah SO';
$this->params['breadcrumbs'][] = ['label' => 'Order Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form sales-order-create content">
    <?= $this->render('_form', [
        'model' => $model, 'detail_so' => $detail_so,
    ]) ?>

</div>
