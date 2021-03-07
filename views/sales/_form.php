<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="preloader open-load">
	<div class="loader"></div>
</div>
<div class="sales-form container-fluid trans-form transactions postloader close-load">

    <?php $form = ActiveForm::begin(); ?>
	<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-4">
						<?= $form->field($model, 
							'sales_id', 
								[
									'template' => '{label}<div class="col-sm-7">{input}</div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['readonly'=>'disable'])
						?>
						<?= $form->field($model, 
							'date', 
								[
									'template' => '{label}<div class="col-sm-7"><div class="input-group">{input}<div class="input-group-append"><span class="input-group-text"><i class="icon-calendar"></i></span></div></div></div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['readonly'=>'disable'])
						?>
				  </div>
				  <div class="col-sm-4">
						<?= $form->field($model, 
								'customer_id', 
								[
									'template' => '{label}<div class="col-sm-7"><div class="input-group">{input}{error}</div><span id="address-field" class="address-field mt-2 pl-2 pr-2 form-control"></span></div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['readonly'=>'disable', 'class'=>'form-control customer-id']);
						?>
				  </div>
				  <div class="col-sm-4">
						<?= $form->field($model, 
								'delivery_order_id', 
								[
									'template' => '{label}<div class="col-sm-7"><div class="input-group">{input}<div class="input-group-append"><span class="btn-toggle input-group-text" data-toggle="modal" data-target="#modal-list-do"><i class="fas fa-search"></i></span></div></div></div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['readonly'=>'disable', 'class'=>'form-control do-id']);
						?>
						<?= $form->field($model, 
								'due_date', 
								[
									'template' => '{label}<div class="col-sm-7"><div class="input-group">{input}</div></div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->dropDownList(
									[7 => '7 HARI', 14 => '14 HARI', 30 => '30 HARI', 40 => '40 HARI', 60 => '60 HARI', 90 => '90 HARI'],
									['prompt'=>'Select...', 'class'=>'form-control custom-select due-date']
								);
						?>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body trans-content trans-content-sales" <?php if($detail_sales) echo "data-detail-sales='".json_encode($detail_sales)."'";?>></div>
			<div class="card-footer">
				<!-- Content Header (Page header) -->
				<div class="row mb-1">
					<div class="col-sm-8 mt-2">
					</div>
					<div class="col-sm-4 mt-2">
						<?= $form->field($model, 
								'total', 
									[
										'template' => '{label}<div class="col-sm-8">{input}</div>',
										'labelOptions' => ['class' => 'col-sm-4 col-form-label pt-2 pb-1'],
										'options' => ['class'=>'form-group mb-2 row trans-total'],
									])->textInput(['class'=>'form-control total','data-mask-currency-rp'=>'', 'readonly'=>'disable'])
							?>
							<?= $form->field($model, 
								'discount', 
									[
										'template' => '{label}<div class="col-sm-8">{input}</div>',
										'labelOptions' => ['class' => 'col-sm-4 col-form-label pt-2 pb-1'],
										'options' => ['class'=>'form-group mb-2 row trans-total '],
									])->textInput(['class'=>'form-control total', 'readonly'=>'disable'])
							?>
							<?= $form->field($model, 
								'grandtotal', 
									[
										'template' => '{label}<div class="col-sm-8">{input}</div>',
										'labelOptions' => ['class' => 'col-sm-4 col-form-label pt-2 pb-1'],
										'options' => ['class'=>'form-group mb-2 row trans-total'],
									])->textInput(['class'=>'form-control total','data-mask-currency-rp'=>'', 'readonly'=>'disable'])
							?>
					</div>
				</div>
				<div class="row pt-1 ml-0 mr-0" style="border-top:1px solid rgba(0, 0, 0, 0.125)">
					<div class="col-sm-12 form-group mt-2 mb-2 pr-0 pl-0">
						<?= Html::button('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right', 'onClick' => 'submitForm()']) ?>
					</div>	
				</div><!-- /.row -->
			</div>
		</div>
    <?php ActiveForm::end(); ?>
</div>
