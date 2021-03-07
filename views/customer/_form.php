<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Html::csrfMetaTags() ?>
<div class="customer-form container-fluid">
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
				<label class="col-md-3 col-xs-12 control-label">Identitas Pelanggan</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-3 col-xs-12 inner-col-left">
						<?= $form->field($model, 
							'customer_id', 
								[
									'template' => '{label} :{input}{error}',
								])->textInput(['maxlength' => true, 'readonly'=>'disable'])
						?>
					</div>
					<div class="col-md-6 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'customer_name', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="fas fa-pencil-alt"></i></span>{input}</div>{error}',
								])->textInput(['maxlength' => true, 'placeholder' => 'Masukan nama pelanggan...', 'autofocus' => true])
						?>
					</div>
				</div>
			</div></div>
				<?= $form->field($model, 
					'id_card_number', 
						[
							'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
							'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
						])->textInput(['data-inputmask'=>'\'mask\': [\'9{4}(-9{4}){3}\']', 'data-mask'=>'', 'placeholder' => 'Masukan NIK (KTP) pelanggan...'])
				?>
			<div class="form-group full-address-field main-address"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Alamat Pelanggan</label>
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
								])->textarea(['class' => 'full-address form-control', 'style' => 'text-align:left', 'rows' => 3, 'placeholder' => 'Masukan alamat lengkap pegawai...'])
						?>
					</div>
				</div>
			</div></div>
			<div class="form-group full-address-field"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Alamat Penagihan</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-12 col-xs-12 inner-col-left">
						<?= $form->field($model, 'same_address',
							[
								'template' => '<label class="modal-checkbox" style="margin-bottom:0; margin-top:5px;">{label}{input}<span class="checkboxcheckmark"></span></label>'
							]
						)->checkbox(
							['class'=>'same-address'],false
						);?>
					</div>
					<div class="column-separated"></div>
					<div class="col-md-4 col-xs-12 inner-col-left">
						<?php $listProvince=ArrayHelper::map($dataProvince,'province_id','province_name');?>
						<?= $form->field($model, 
							'bill_province', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listProvince,
								['prompt'=>'Select...', 'class'=>'form-control select2 province-select']
							);
						?>
					</div>
					<div class="col-md-4 col-xs-12 inner-col-right separated-none">
						<?php $listBillRegency=ArrayHelper::map($dataBillRegency,'regency_id','regency_name');?>
						<?= $form->field($model, 
							'bill_regency', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listBillRegency,
								['prompt'=>'Select...', 'class'=>'form-control select2 regency-select']
							);
						?>
					</div>
					<div class="column-separated"></div>
					<div class="col-md-4 col-xs-12 inner-col-left">
						<?php $listBillDistrict=ArrayHelper::map($dataBillDistrict,'district_id','district_name');?>
						<?= $form->field($model, 
							'bill_district', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listBillDistrict,
								['prompt'=>'Select...', 'class'=>'form-control select2 district-select']
							);
						?>
					</div>
					<div class="col-md-4 col-xs-12 inner-col-right separated-none">
						<?php $listBillVillage=ArrayHelper::map($dataBillVillage,'village_id','village_name');?>
						<?= $form->field($model, 
							'village_bill_id', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listBillVillage,
								['prompt'=>'Select...', 'class'=>'form-control select2 village-select']
							);
						?>
					</div>
					<div class="column-separated"></div>
					<div class="col-md-9 col-xs-12 inner-col-right inner-col-left separated-none">
						<?= $form->field($model, 
							'bill_address', 
								[
									'template' => '{label} :{input}{error}',
								])->textarea(['class' => 'full-address form-control', 'style' => 'text-align:left', 'rows' => 3, 'placeholder' => 'Masukan alamat lengkap pegawai...'])
						?>
					</div>
				</div>
			</div></div>
			
			<?= $form->field($model, 
				'phone_number', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="fas fa-phone"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-inputmask'=>'\'mask\': [\'\\\+62 P99-9{4}-9{3,5}\']', 'data-mask'=>'', 'placeholder' => 'Masukan no hp/telp customer...'])
			?>
			<?= $form->field($model, 
				'email', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="fas fa-envelope"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-mask-email'=>'', 'placeholder' => 'Masukan email pegawai...'])
			?>
			<?= $form->field($model, 
				'npwp_number', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-inputmask'=>'\'mask\': [\'9{2}(.9{3}){2}.9-9{3}.9{3}\']', 'data-mask'=>'', 'placeholder' => 'Masukan NPWP pelanggan...'])
				?>
			<?= $form->field($model, 
				'limit_amount', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="icon-indonesia-rupiah-currency-symbol"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-mask-currency'=>'', 'maxlength' => true, 'placeholder' => 'Masukan limit order...'])
			?>
			<?= $form->field($model, 
				'id_card_image', 
					[
						'template' => '<div class="row">{label}<div class="col-md-5 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->fileInput(['class' => 'file image-file', 'data-theme' => "fas", 'data-url' => @web.'/cusIdImages/', 'data-image' => $model->id_card_image, 'accept' =>'image/*'])
			?>
			<?= $form->field($model, 
				'npwp_image', 
					[
						'template' => '<div class="row">{label}<div class="col-md-5 col-xs-12"><div class="input-group">{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->fileInput(['class' => 'file image-file', 'data-theme' => "fas", 'data-url' => @web.'/cusNPWPImages/', 'data-image' => $model->npwp_image, 'accept' =>'image/*'])
			?>

			<div class="form-group mt-2">
				<?= Html::submitButton('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right']) ?>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>
