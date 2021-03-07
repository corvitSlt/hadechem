<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form container-fluid">
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
				<label class="col-md-3 col-xs-12 control-label">Identitas Supplier</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-3 col-xs-12 inner-col-left">
						<?= $form->field($model, 
							'supplier_id', 
								[
									'template' => '{label} :{input}{error}',
								])->textInput(['maxlength' => true, 'readonly'=>'disable'])
						?>
					</div>
					<div class="col-md-6 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'supplier_name', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="fas fa-pencil-alt"></i></span>{input}</div>{error}',
								])->textInput(['maxlength' => true, 'placeholder' => 'Masukan nama pelanggan...', 'autofocus' => true])
						?>
					</div>
				</div>
			</div></div>
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
								])->textarea(['rows' => 3, 'placeholder' => 'Masukan alamat lengkap supplier...'])
						?>
					</div>
				</div>
			</div></div>
			<?= $form->field($model, 
				'phone_number', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="fas fa-phone"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-inputmask'=>'\'mask\': [\'\\\+62 P99-9{4}-9{3,5}\']', 'data-mask'=>'', 'placeholder' => 'Masukan no hp/telp kantor supplier...'])
			?>
			<?= $form->field($model, 
				'email', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="fas fa-envelope"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-mask-email'=>'', 'placeholder' => 'Masukan email pegawai...'])
			?>
			<div class="form-group"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Identitas Kontak Seles</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-4 col-xs-12 inner-col-left">
						<?= $form->field($model, 
							'contact_name', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="fas fa-pencil-alt"></i></span>{input}</div>{error}',
								])->textInput(['maxlength' => true, 'placeholder' => 'Masukan nama pelanggan...', 'autofocus' => true])
						?>
					</div>
					<div class="col-md-4 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'contact_number', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="fas fa-phone"></i></span>{input}</div>{error}',
								])->textInput(['data-inputmask'=>'\'mask\': [\'\\\+62 P99-9{4}-9{3,5}\']', 'data-mask'=>'', 'placeholder' => 'Masukan nama pelanggan...', 'autofocus' => true])
						?>
					</div>
				</div>
			</div></div>	
			<?= $form->field($model, 
				'npwp_number', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-inputmask'=>'\'mask\': [\'9{2}(.9{3}){2}.9-9{3}.9{3}\']', 'data-mask'=>'', 'placeholder' => 'Masukan NPWP pelanggan...'])
				?>
			<?= $form->field($model, 
				'npwp_image', 
					[
						'template' => '<div class="row">{label}<div class="col-md-5 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->fileInput(['class' => 'file image-file', 'data-theme' => "fas", 'data-url' => @web.'/supNPWPImages/', 'data-image' => $model->npwp_image, 'accept' =>'image/*'])
			?>
			<div class="form-group mt-2">
					<?= Html::submitButton('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
