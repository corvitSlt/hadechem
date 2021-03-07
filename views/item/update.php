<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = 'Update Barang: ' . $model->item_id;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_id, 'url' => ['view', 'id' => $model->item_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form item-update content">
	<?= $this->render('_form', [
        'model' => $model, 'dataSubItemCategory' => $dataSubItemCategory, 'dataUnit' => $dataUnit,
    ]) ?>

</div>
