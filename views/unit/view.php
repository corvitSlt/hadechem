<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Unit */

$this->title = $model->unit_id;
$this->params['breadcrumbs'][] = ['label' => 'Unit Barang', 'url' => ['item/index', 'id'=>'unit']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-form unit-view content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $model->unit_name.' ('.$model->unit_id.')' ?></h1>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body form-group-separated">
				<?= DetailView::widget([
					'model' => $model,
					'options' => ['class' => 'table detail-view'],
					'attributes' => [
						'unit_id',
						[
							'attribute' => 'unit_name',
							'value' => ucwords($model->unit_name),
						],
						[
								'attribute' => 'status',
								'value' => function ($model){
									if($model->status == 1)
										return "Aktif";
									else if($model->status == 0)
										return "Tidak Aktif";
								},
							], 
					],
				]) ?>
				<div class="form-group mt-2">
					<?= Html::a('<i class="mr-2 fas fa-times-square"></i>Delete', ['delete', 'id' => $model->unit_id], [
						'class' => 'btn btn-danger float-right',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					]) ?>
					<?= Html::a('<i class="mr-2 fas fa-edit"></i>Update', ['update', 'id' => $model->unit_id], ['class' => 'btn btn-primary float-right']) ?>
				</div>
			</div>
		</div>
	</div>
</div>
