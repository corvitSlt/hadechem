<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sales */

$this->title = 'Tambah Penjualan';
$this->params['breadcrumbs'][] = ['label' => 'Penjualan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form sales-create content">

    <?= $this->render('_form', [
        'model' => $model, 'detail_sales' => $detail_sales
    ]) ?>

</div>
