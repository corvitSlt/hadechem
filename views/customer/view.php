<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-form customer-view content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $model->customer_name.' ('.$model->customer_id.')' ?></h1>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body form-group-separated">
				<?= DetailView::widget([
					'model' => $model,
					'options' => ['class' => 'table detail-view'],
					'attributes' => [
						'customer_id',
						[
							'attribute' => 'customer_name',
							'value' => ucwords($model->customer_name),
						],
						[
							'label' => 'KTP & NPWP Pelanggan',
							'format'=>'raw',
							'value' =>  function ($model){
								if($model->npwp_image)
									return '<input type="file" class="file image-file-view" data-url="../'.@web.'/cusIdImages/'.$model->id_card_image.'|../'.@web.'/cusNPWPImages/'.$model->npwp_image.'" data-image="Foto KTP Pelanggan|Foto NPWP Pelanggan">';
								else
									return '<input type="file" class="file image-file-view" data-url="../'.@web.'/cusIdImages/'.$model->id_card_image.'|../'.@web.'/cusNPWPImages/no-pic.png" data-image="Foto KTP Pelanggan|Foto NPWP Pelanggan">';
							},
						],
						[
							'attribute' => 'address',
							'value' => $model->address 
											.', Desa ' .ucwords(strtolower($model->village->village_name))
											.', Kecamatan ' .ucwords(strtolower($model->village->district->district_name))
											.', ' .ucwords(strtolower($model->village->district->regency->regency_name))
											.', '.ucwords(strtolower($model->village->district->regency->province->province_name)),
						],
						[
							'attribute' => 'bill_address',
							'value' => $model->bill_address 
											.', Desa ' .ucwords(strtolower($model->villageBill->village_name))
											.', Kecamatan ' .ucwords(strtolower($model->villageBill->district->district_name))
											.', ' .ucwords(strtolower($model->villageBill->district->regency->regency_name))
											.', '.ucwords(strtolower($model->villageBill->district->regency->province->province_name)),
						],
						'phone_number',
						'email:email',
						[
							'attribute' => 'limit_amount',
							'value' => $model->limit_amount,
							'contentOptions' => ['data-mask-currency'=>'', 'class' => 'text-left'],
						],
						[
								'attribute' => 'flag',
								'value' => function ($model){
									if($model->flag == 1)
										return "Aktif";
									else if($model->flag == 0)
										return "Tidak Aktif";
								},
							], 
					],
				]) ?>
				<div class="form-group mt-2">
					<?= Html::a('<i class="mr-2 fas fa-times-square"></i>Delete', ['delete', 'id' => $model->customer_id], [
						'class' => 'btn btn-danger float-right',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					]) ?>
					<?= Html::a('<i class="mr-2 fas fa-edit"></i>Update', ['update', 'id' => $model->customer_id], ['class' => 'btn btn-primary float-right']) ?>
				</div>
			</div>
		</div>
	</div>
</div>
