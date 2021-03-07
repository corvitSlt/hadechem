<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->employee_id;
$this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-form employee-view content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row mb">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $model->employee_name.' ('.$model->employee_id.')' ?></h1>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body form-group-separated">
				<?= DetailView::widget([
					'model' => $model,
					'options' => ['class' => 'table detail-view'],
					'attributes' => [
						'employee_id',
						'username',
						[
							'label' => 'Foto 3X4 & KTP Pegawai',
							'format'=>'raw',
							'value' => '<input type="file" class="file image-file-view" data-url="../'.@web.'/empImages/'.$model->image.'|../'.@web.'/empIdImages/'.$model->id_card_image.'" data-image="Foto 3X4 Pegawai|Foto KTP Pegawai">',
						],
						[
							'attribute' => 'employee_name',
							'value' => ucwords($model->employee_name),
						],
						'id_card_number',
						[
							'attribute' => 'gender',
							'value' => function ($model){
								if($model->gender == 'L')
									return "Laki-laki";
								else if($model->gender == 'P')
									return "Perempuan";
							},
						], 
						[
							'label' => 'Tempat Tanggal Lahir',
							'value' => $model->birth_place
											.', '.strftime("%e %B %Y", strtotime($model->birth_date)),
						],
						[
							'attribute' => 'address',
							'value' => $model->address 
											.', Desa ' .ucwords(strtolower($model->village->village_name))
											.', Kecamatan ' .ucwords(strtolower($model->village->district->district_name))
											.', ' .ucwords(strtolower($model->village->district->regency->regency_name))
											.', '.ucwords(strtolower($model->village->district->regency->province->province_name)),
						],
						'phone_number',
						'email:email',
						[
							'attribute' => 'education',
							'value' => function ($model){
								if($model->bachelor)
									return $model->education . ' - [' . ucwords($model->bachelor) . ']';
								else
									return $model->education;
							},
						], 
						[
							'attribute' => 'job_id',
							'value' => ucwords($model->job->job_name),
						],
						[
							'label' => 'salary',
							'value' => $model->salary,
							'contentOptions' => ['data-mask-currency'=>'', 'class' => 'text-left'],
						],
						[
							'label' => 'work_date',
							'value' => strftime("%A, %e %B %Y", strtotime($model->work_date)),
						],
						[
							'attribute' => 'last_login',
							'value' => function ($model){
								if($model->last_login)
									return strftime("%A, %e %B %Y [%T]", strtotime($model->last_login));
								else if($model->gender == 0)
									return $model->last_login;
							},
						],
						'last_password_change',
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
						<?= Html::a('<i class="mr-2 fas fa-times-square"></i>Delete', ['delete', 'id' => $model->employee_id], [
							'class' => 'btn btn-danger float-right',
							'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							],
						]) ?>
						<?= Html::a('<i class="mr-2 fas fa-edit"></i>Update', ['update', 'id' => $model->employee_id], ['class' => 'btn btn-primary float-right']) ?>
				</div>
			</div>
		</div>
	</div>
</div>
