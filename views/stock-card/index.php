<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kartu Stok';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-card-index content">
	<?= $this->render('_form', []) ?>
</div>
