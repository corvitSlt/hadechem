<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PurchasePayment */

$this->title = 'Update Purchase Payment: ' . $model->purchase_payment_id;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->purchase_payment_id, 'url' => ['view', 'id' => $model->purchase_payment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchase-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
