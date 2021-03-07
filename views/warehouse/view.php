<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Warehouse */

$this->title = $model->warehouse_id;
$this->params['breadcrumbs'][] = ['label' => 'Gudang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-form warehouse-view content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $model->warehouse_name.' ('.$model->warehouse_id.')' ?></h1>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body form-group-separated">
				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'warehouse_id',
						[
							'attribute' => 'warehouse_name',
							'value' => ucwords($model->warehouse_name),
						],
						[
							'attribute' => 'address',
							'value' => $model->address 
											.', Desa ' .ucwords(strtolower($model->village->village_name))
											.', Kecamatan ' .ucwords(strtolower($model->village->district->district_name))
											.', ' .ucwords(strtolower($model->village->district->regency->regency_name))
											.', '.ucwords(strtolower($model->village->district->regency->province->province_name)),
						],
					],
				]) ?>
					<div class="form-group mt-2">
						<?= Html::a('<i class="mr-2 fas fa-times-square"></i>Delete', ['delete', 'id' => $model->warehouse_id], [
							'class' => 'btn btn-danger float-right',
							'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							],
						]) ?>
						<?= Html::a('<i class="mr-2 fas fa-edit"></i>Update', ['update', 'id' => $model->warehouse_id], ['class' => 'btn btn-primary float-right']) ?>
				</div>
			</div>
		</div>
	</div>
</div>
