<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubItemCategory */

$this->title = 'Tambah Sub Kategori Barang';
$this->params['breadcrumbs'][] = ['label' => 'Sub Kategory Barang', 'url' => ['item/index', 'id'=>'subCategory']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form sub-item-category-create content">
	<?= $this->render('_form', [
        'model' => $model, 'dataItemCategory' => $dataItemCategory,
    ]) ?>

</div>
