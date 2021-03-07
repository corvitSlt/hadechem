<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->item_id;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-form item-view content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $model->item_name.' ('.$model->item_id.')' ?></h1>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body form-group-separated">
				<?= DetailView::widget([
					'model' => $model,
					'options' => ['class' => 'table detail-view'],
					'attributes' => [
						'item_id',
						[
							'attribute' => 'item_name',
							'value' => ucwords($model->item_name),
						],
						[
							'attribute' => 'sub_item_category_id',
							'value' => ucwords($model->subItemCategory->sub_item_category_name),
						],
						[
							'attribute' => 'unit_id',
							'value' => ucwords($model->unit->unit_name),
						],
						[
							'label' => 'price',
							'value' => $model->price,
							'contentOptions' => ['data-mask-currency'=>'', 'class' => 'text-left'],
						],
						'total_stock',
						'safe_stock',
						'delivery_time:datetime',
					],
				]) ?>
				<div class="form-group mt-2">
					<?= Html::a('<i class="mr-2 fas fa-times-square"></i>Delete', ['delete', 'id' => $model->item_id], [
						'class' => 'btn btn-danger float-right',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					]) ?>
					<?= Html::a('<i class="mr-2 fas fa-edit"></i>Update', ['update', 'id' => $model->item_id], ['class' => 'btn btn-primary float-right']) ?>
				</div>
			</div>
		</div>
	</div>
</div>
