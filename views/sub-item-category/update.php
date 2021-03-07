<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubItemCategory */

$this->title = 'Update Sub Kategori Barang: ' . $model->sub_item_category_id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Kategory Barang', 'url' => ['item/index', 'id'=>'subCategory']];
$this->params['breadcrumbs'][] = ['label' => $model->sub_item_category_id, 'url' => ['view', 'id' => $model->sub_item_category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form sub-item-category-update content">
	<?= $this->render('_form', [
        'model' => $model, 'dataItemCategory' => $dataItemCategory,
    ]) ?>

</div>
