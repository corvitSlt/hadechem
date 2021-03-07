<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalesPayment */

$this->title = 'Update Sales Payment: ' . $model->sales_payment_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sales_payment_id, 'url' => ['view', 'id' => $model->sales_payment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
