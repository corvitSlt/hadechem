<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeliveryOrder */

$this->title = 'Update Delivery Order: ' . $model->delivery_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Delivery Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->delivery_order_id, 'url' => ['view', 'id' => $model->delivery_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form delivery-order-update content">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
