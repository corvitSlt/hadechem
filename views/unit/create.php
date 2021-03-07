<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unit */

$this->title = 'Tambah Satuan';
$this->params['breadcrumbs'][] = ['label' => 'Unit Barang', 'url' => ['item/index', 'id'=>'unit']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form unit-create content">
	<?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
