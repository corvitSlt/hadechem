<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Voucher */

$this->title = 'Create Voucher';
$this->params['breadcrumbs'][] = ['label' => 'Vouchers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form voucher-create content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
