<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'Update Pelanggan: ' . $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_id, 'url' => ['view', 'id' => $model->customer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form customer-update content">
    <?= $this->render('_form', [
        'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage, 'dataBillRegency' => $dataBillRegency, 'dataBillDistrict' => $dataBillDistrict, 'dataBillVillage' => $dataBillVillage,
    ]) ?>

</div>
