<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */

$this->title = 'Create Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form purchase-create content">

    <?= $this->render('_form', [
        'model' => $model, 'detail_purchase' => $detail_purchase,
    ]) ?>

</div>
