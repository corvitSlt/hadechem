<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemCategory */

$this->title = $model->item_category_id;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Barang', 'url' => ['item/index', 'id'=>'category']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-form item-category-view content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $model->item_category_name.' ('.$model->item_category_id.')' ?></h1>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body form-group-separated">
				<?= DetailView::widget([
					'model' => $model,
					'options' => ['class' => 'table detail-view'],
					'attributes' => [
						'item_category_id',
						[
							'attribute' => 'item_category_name',
							'value' => ucwords($model->item_category_name),
						],
					],
				]) ?>
				<div class="form-group mt-2">
						<?= Html::a('<i class="mr-2 fas fa-times-square"></i>Delete', ['delete', 'id' => $model->item_category_id], [
							'class' => 'btn btn-danger float-right',
							'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							],
						]) ?>
						<?= Html::a('<i class="mr-2 fas fa-edit"></i>Update', ['update', 'id' => $model->item_category_id], ['class' => 'btn btn-primary float-right']) ?>
				</div>
			</div>
		</div>
	</div>
</div>
