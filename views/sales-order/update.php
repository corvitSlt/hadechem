<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalesOrder */

$this->title = 'Update Sales Order: ' . $model->so_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->so_id, 'url' => ['view', 'id' => $model->so_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form sales-order-update content">
    <?= $this->render('_form', [
        'model' => $model, 'detail_so' => $detail_so,
    ]) ?>

</div>
