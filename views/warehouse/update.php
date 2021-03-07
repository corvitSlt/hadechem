<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Warehouse */

$this->title = 'Update Gudang: ' . $model->warehouse_id;
$this->params['breadcrumbs'][] = ['label' => 'Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->warehouse_id, 'url' => ['view', 'id' => $model->warehouse_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form warehouse-update content">
    <?= $this->render('_form', [
        'model' => $model,  'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage,
    ]) ?>

</div>
