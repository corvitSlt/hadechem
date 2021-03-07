<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalesPayment */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="preloader open-load">
	<div class="loader"></div>
</div>
<div class="sales-payment-form container-fluid trans-form transactions postloader close-load">
    <?php $form = ActiveForm::begin(); ?>
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-4">
						<?= $form->field($model, 
							'sales_payment_id', 
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
				  <div class="col-sm-5">
						<?php 
							if($detail_salesPayment){
								echo $form->field($model, 
									'customer_id', 
									[
										'template' => '{label}<div class="col-sm-7"><div class="input-group">{input}</div><span id="address-field" class="address-field mt-2 pl-2 pr-2 form-control"></span></div>',
										'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
										'options' => ['class'=>'form-group row'],
									])->textInput(['readonly'=>'disable', 'class'=>'form-control customer-id']);
							}
							else{
								echo $form->field($model, 
									'customer_id', 
									[
										'template' => '{label}<div class="col-sm-7"><div class="input-group">{input}<div class="input-group-append"><span class="btn-toggle input-group-text" data-toggle="modal" data-target="#modal-list-customers"><i class="fas fa-search"></i></span></div></div><span id="address-field" class="address-field mt-2 pl-2 pr-2 form-control"></span></div>',
										'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
										'options' => ['class'=>'form-group row'],
									])->textInput(['readonly'=>'disable', 'class'=>'form-control customer-id']);
							}
						?>
						
						
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body trans-content trans-content-sales-payment" <?php if($detail_salesPayment) echo "data-detail-sales-payment='".json_encode($detail_salesPayment)."'";?>></div>
			<div class="card-footer">
				<!-- Content Header (Page header) -->
				<div class="row mb-1">
					<div class="col-sm-8 mt-2">
						<div class="row">
							<div class="col-sm-6">
							<?= $form->field($model, 
								'payment_type', 
									[
										'template' => '{label}<div class="col-sm-4">{input}</div>',
										'labelOptions' => ['class' => 'col-sm-4 col-form-label pt-1 pb-1'],
										'options' => ['class'=>'form-group row'],
									])->dropDownList(
										[1 => 'KAS', 2 => 'BANK'],
											['class'=>'form-control select2 cash-type']
										);
							?>
							</div>
						</div>
					</div>
					<div class="col-sm-4 mt-2">
						<?= $form->field($model, 
								'total', 
									[
										'template' => '{label}<div class="col-7">{input}</div>',
										'labelOptions' => ['class' => 'col-sm-5 col-form-label pt-1 pb-1'],
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
