<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemCategory */

$this->title = 'Update Kategory Barang: ' . $model->item_category_id;
$this->params['breadcrumbs'][] = ['label' => 'Kategory Barang', 'url' => ['item/index', 'id'=>'category']];
$this->params['breadcrumbs'][] = ['label' => $model->item_category_id, 'url' => ['view', 'id' => $model->item_category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="active-form item-category-update content">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
