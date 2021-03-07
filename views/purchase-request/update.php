<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseRequest */

$this->title = 'Update Purchase Request: ' . $model->pr_id;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pr_id, 'url' => ['view', 'id' => $model->pr_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchase-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
