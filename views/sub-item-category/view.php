<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SubItemCategory */

$this->title = $model->sub_item_category_id;
$this->params['breadcrumbs'][] = ['label' => 'Sub Kategori Barang', 'url' => ['item/index', 'id'=>'subCategory']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-form sub-item-category-view content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $model->sub_item_category_name.' ('.$model->sub_item_category_id.')' ?></h1>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body form-group-separated">
				<?= DetailView::widget([
					'model' => $model,
					'options' => ['class' => 'table detail-view'],
					'attributes' => [
						'sub_item_category_id',
						[
							'attribute' => 'sub_item_category_name',
							'value' => ucwords($model->sub_item_category_name),
						],
						[
							'attribute' => 'item_category_id',
							'value' => ucwords($model->itemCategory->item_category_name),
						],
					],
				]) ?>
				<div class="form-group mt-2">
						<?= Html::a('<i class="mr-2 fas fa-times-square"></i>Delete', ['delete', 'id' => $model->sub_item_category_id], [
							'class' => 'btn btn-danger float-right',
							'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							],
						]) ?>
						<?= Html::a('<i class="mr-2 fas fa-edit"></i>Update', ['update', 'id' => $model->sub_item_category_id], ['class' => 'btn btn-primary float-right']) ?>
				</div>
			</div>
		</div>
	</div>
</div>