<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'Tambah Pelanggan';
$this->params['breadcrumbs'][] = ['label' => 'Pelanggan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form customer-create content">
    <?= $this->render('_form', [
        'model' => $model, 'dataProvince' => $dataProvince, 'dataRegency' => $dataRegency, 'dataDistrict' => $dataDistrict, 'dataVillage' => $dataVillage, 'dataBillRegency' => $dataBillRegency, 'dataBillDistrict' => $dataBillDistrict, 'dataBillVillage' => $dataBillVillage,
    ]) ?>

</div>
