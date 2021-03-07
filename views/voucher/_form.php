<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Voucher */
/* @var $form yii\widgets\ActiveForm */
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
?>

<div class="voucher-form container-fluid">
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
								])->textInput(['maxlength' => true, 'readonly'=>'disable', 'placeholder' => 'ID Pelanggan...'])
						?>
					</div>
					<div class="col-md-4 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'customer_name', 
								[
									'template' => '{label} :<div class="input-group">{input}<span class="input-group-append"><button type="button" class="btn btn-primary btn-flat"><i class="fas fa-search"></i></button></span></div>{error}',
								])->textInput(['maxlength' => true, 'readonly'=>'disable', 'placeholder' => 'Nama Pelanggan...', 'autofocus' => true])
						?>
					</div>
				</div>
			</div></div>
			<div class="form-group"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Keterangan Vocer</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-3 col-xs-12 inner-col-left">	
						<?= $form->field($model, 
							'discount_type', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							[0 => 'Potongan Harga (Rp)', 1 => 'Persentase (%)'],
								['prompt'=>'Select...', 'class'=>'form-control select2']
							);
						?>
					</div>
					<div class="col-md-3 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'discount', 
								[
									'template' => '{label} :{input}{error}',
								])->textInput(['data-mask-currency'=>'', 'maxlength' => true, 'placeholder' => 'Masukan nominal vocer...'])
						?>
					</div>
				</div>
			</div></div>
			<?= $form->field($model, 
				'valid_date', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="icon-calendar"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['class' => 'form-control datepicker datetimepicker-input text-center', 'data-toggle' => 'datetimepicker', 'data-target' => '#voucher-valid_date', 'placeholder' => strftime("%A, %e %B %Y",strtotime(date("Y-m-d")))])
			?>
			<?= $form->field($model, 
				'exp_date', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12"><div class="input-group"><span class="input-group-addon"><i class="icon-calendar"></i></span>{input}</div>{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['class' => 'form-control datepicker datetimepicker-input text-center', 'data-toggle' => 'datetimepicker', 'data-target' => '#voucher-exp_date', 'placeholder' => strftime("%A, %e %B %Y",strtotime(date("Y-m-d")))])
			?>
			<div class="form-group mt-2">
					<?= Html::submitButton('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
