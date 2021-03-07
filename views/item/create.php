<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = 'Tambah Barang';
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-form item-create content">
	<?= $this->render('_form', [
        'model' => $model, 'dataSubItemCategory' => $dataSubItemCategory, 'dataUnit' => $dataUnit,
    ]) ?>

</div>
