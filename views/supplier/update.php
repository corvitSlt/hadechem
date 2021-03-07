<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */

$this->title = 'Update Supplier: ' . $model->supplier_id;
$this->params['breadcrumbs'][] = ['label' => 'Supplier', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->supplier_id, 'url' => ['view', 'id' => $model->supplier_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form supplier-update content">
    <?= $this->render('_form', [
       'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage,
    ]) ?>

</div>
