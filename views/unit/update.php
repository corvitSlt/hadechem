<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unit */

$this->title = 'Update Satuan: ' . $model->unit_id;
$this->params['breadcrumbs'][] = ['label' => 'Unit Barang', 'url' => ['item/index', 'id'=>'unit']];
$this->params['breadcrumbs'][] = ['label' => $model->unit_id, 'url' => ['view', 'id' => $model->unit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form unit-update content">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
