<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemCategory */

$this->title = 'Tambah Kategori Barang';
$this->params['breadcrumbs'][] = ['label' => 'Kategory Barang', 'url' => ['item/index', 'id'=>'category']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form item-category-create content">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
