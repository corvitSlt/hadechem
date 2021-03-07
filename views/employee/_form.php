<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Html::csrfMetaTags() ?>
<div class="employee-form container-fluid">
	<div class="card">
		<div class="card-header">
			<!-- Content Header (Page header) -->
			<div class="row mb">
			  <div class="col-sm-6">
				<h1 class="m-0 text-dark"><?= $this->title ?></h1>
			  </div>
			</div><!-- /.row -->
		</div>
		<div class="card-body form-group-separated">
			<?php $form = ActiveForm::begin(); ?>
			<div class="form-group"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Identitas Pegawai</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-3 col-xs-12 inner-col-left">
						<?= $form->field($model, 
							'employee_id', 
								[
									'template' => '{label} :{input}{error}',
								])->textInput(['maxlength' => true, 'readonly'=>'disable'])
						?>
					</div>
					<div class="col-md-6 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'employee_name', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="fas fa-pencil-alt"></i></span>{input}</div>{error}',
								])->textInput(['maxlength' => true, 'placeholder' => 'Masukan nama pegawai...', 'autofocus' => true])
						?>
					</div>
				</div>
			</div></div>
				<?= $form->field($model, 
					'id_card_number', 
						[
							'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
							'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
						])->textInput(['data-inputmask'=>'\'mask\': [\'9{4}(-9{4}){3}\']', 'data-mask'=>'', 'placeholder' => 'Masukan NIK (KTP) pegawai...'])
				?>
			<div class="form-group full-address-field"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Alamat</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-4 col-xs-12 inner-col-left">
						<?php $listProvince=ArrayHelper::map($dataProvince,'province_id','province_name');?>
						<?= $form->field($model, 
							'province', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listProvince,
								['prompt'=>'Select...', 'class'=>'form-control select2 province-select']
							);
						?>
					</div>
					<div class="col-md-4 col-xs-12 inner-col-right separated-none">
						<?php $listRegency=ArrayHelper::map($dataRegency,'regency_id','regency_name');?>
						<?= $form->field($model, 
							'regency', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listRegency,
								['prompt'=>'Select...', 'class'=>'form-control select2 regency-select']
							);
						?>
					</div>
					<div class="column-separated"></div>
					<div class="col-md-4 col-xs-12 inner-col-left">
						<?php $listDistrict=ArrayHelper::map($dataDistrict,'district_id','district_name');?>
						<?= $form->field($model, 
							'district', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listDistrict,
								['prompt'=>'Select...', 'class'=>'form-control select2 district-select']
							);
						?>
					</div>
					<div class="col-md-4 col-xs-12 inner-col-right separated-none">
						<?php $listVillage=ArrayHelper::map($dataVillage,'village_id','village_name');?>
						<?= $form->field($model, 
							'village_id', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listVillage,
								['prompt'=>'Select...', 'class'=>'form-control select2 village-select']
							);
						?>
					</div>
					<div class="column-separated"></div>
					<div class="col-md-9 col-xs-12 inner-col-right inner-col-left separated-none">
						<?= $form->field($model, 
							'address', 
								[
									'template' => '{label} :{input}{error}',
								])->textarea(['rows' => 3, 'placeholder' => 'Masukan alamat lengkap pegawai...'])
						?>
					</div>
				</div>
			</div></div>
			<div class="form-group"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Tempat Tanggal Lahir</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-3 col-xs-12 inner-col-left">
						<?= $form->field($model, 
							'birth_place', 
								[
									'template' => '{label} :{input}{error}',
								])->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir...'])
						?>
					</div>
					<div class="col-md-6 col-xs-12 inner-col-right separated-none">
						<?= $form->field($model, 
							'birth_date', 
								[
									'template' => '{label} :{input}',
									'options'=>[
										'class'=>'form-group birth-date-calendar'
									]
								])->textInput(['hidden' => true])
						?>
					</div>
				</div>
			</div></div>
			
			<?= $form->field($model, 'gender',
				[
					'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group">{input}</div></div></div>',
					'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
				]
				)->radioList( 
				['L'=>'Laki-laki', 'P' => 'Perempuan'],
				[
					'item' => function($index, $label, $name, $checked, $value) {

						$return = '<label class="modal-radio">' . ucwords($label);
						if($checked==true)
							$return .= '<input type="radio" name="' . $name . '" value="' . $value . '" checked='.$checked.'>';
						else
							$return .= '<input type="radio" name="' . $name . '" value="' . $value . '">';
						$return .= '<span class="radiocheckmark"></span>';
						$return .= '</label>';

						return $return;
					}
				]
			);?>
			
			<?= $form->field($model, 
				'phone_number', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="fas fa-phone"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-inputmask'=>'\'mask\': [\'\\\+62 P99-9{4}-9{3,5}\']', 'data-mask'=>'', 'placeholder' => 'Masukan no hp/telp pegawai...'])
			?>
			
			<?= $form->field($model, 
				'email', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="fas fa-envelope"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-mask-email'=>'', 'placeholder' => 'Masukan email pegawai...'])
			?>
			
			<div class="form-group"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Info Pekerjaan Pegawai</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-2 col-xs-12 inner-col-left">	
						<?= $form->field($model, 
							'education', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							['SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3'],
								['prompt'=>'Select...', 'class'=>'form-control select2']
							);
						?>
					</div>
					<div class="col-md-6 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'bachelor', 
								[
									'template' => '{label} :<div class="input-group">{input}</div>{error}',
								])->textarea(['rows' => 3, 'placeholder' => 'Masukan bidang/jurusan pendidikan pegawai...'])
						?>
					</div>
					<div class="column-separated"></div>
					<div class="col-md-3 col-xs-12 inner-col-left">
						
						<?php $listData=ArrayHelper::map($dataJob,'job_id','job_name');?>
						<?= $form->field($model, 
							'job_id', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listData,
								['prompt'=>'Select...', 'class'=>'form-control select2 text-up']
							);
						?>
					</div>
					<div class="col-md-4 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'salary', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="icon-indonesia-rupiah-currency-symbol"></i></span>{input}</div>{error}',
								])->textInput(['data-mask-currency'=>'', 'maxlength' => true, 'placeholder' => 'Masukan gaji pegawai...'])
						?>
					</div>
				</div>
			</div></div>
			<?= $form->field($model, 
				'work_date', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="icon-calendar"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['class' => 'form-control datepicker datetimepicker-input text-center', 'data-toggle' => 'datetimepicker', 'data-target' => '#employee-work_date', 'placeholder' => date("d-m-Y")])
			?>
			
			<?= $form->field($model, 
				'image', 
					[
						'template' => '<div class="row">{label}<div class="col-md-5 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->fileInput(['class' => 'file image-file', 'data-theme' => "fas", 'data-url' => @web.'/empImages/', 'data-image' => $model->image, 'accept' =>'image/*'])
			?>
			
			<?= $form->field($model, 
				'id_card_image', 
					[
						'template' => '<div class="row">{label}<div class="col-md-5 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->fileInput(['class' => 'file image-file', 'data-theme' => "fas", 'data-url' => @web.'/empIdImages/', 'data-image' => $model->id_card_image, 'accept' =>'image/*'])
			?>
			
			<div class="form-group mt-2">
					<?= Html::submitButton('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
