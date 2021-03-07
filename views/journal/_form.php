<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Journal */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="preloader open-load">
	<div class="loader"></div>
</div>
<div class="journal-form container-fluid trans-form transactions postloader close-load">
	<div class="card">
		<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-7">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label pt-1 pb-1">Rentang Tanggal</label>
							<div class="col-sm-9">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="icon-calendar"></i></span>
									</div>
									<div class="form-control" id="daterange-trans"><div class="row"><div class="col-sm-6"><span id="start-date"></span></div><div class="col-sm-6"><span id="end-date"></span></div></div></div>
								</div>
							</div>
						 </div>
				  </div>
				</div><!-- /.row -->
			</div>
			<div class="card-body journal-cash-bank preloader-card-body close-load">
				<div class="loader"></div>
			</div>
		<div class="card-body trans-content trans-content-journal-cash-bank postloader-card-body open-load"></div>
		<div class="card-footer account">
			<?php $form = ActiveForm::begin(); ?>
				<!-- Content Header (Page header) -->
				<div class="row mb-1">
					<div class="col-sm-5">
						<?php $listData=ArrayHelper::map($dataCoa,'coa_code','coa_code_name');?>
						<?= $form->field($model, 
							'transaction_code', 
								[
									'template' => '{label}<div class="col-sm-9"><div class="row"><div class="col-sm-3 slash-journal"><input id="journalConcatCode" class="form-control" readonly></input></div><div class="col-sm-3 slash-journal"><input id="journalConcatNo" class="form-control" readonly></input></div><div class="col-sm-3 slash-journal"><input id="journalConcatMonth" class="form-control" readonly></input></div><div class="col-sm-3"><input id="journalConcatYear" class="form-control" readonly></input></div></div></div>{input}',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['type'=>'hidden'])
						?>
						<?= $form->field($model, 
							'date', 
								[
									'template' => '{label}<div class="col-sm-9"><div class="input-group">{input}<div class="input-group-append"><span class="input-group-text"><i class="icon-calendar"></i></span></div></div></div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['class' => 'form-control datepicker datetimepicker-input text-center', 'data-toggle' => 'datetimepicker', 'data-target' => '#journal-date', 'placeholder' => date("l, j F Y")])
						?>
						<?= $form->field($model,
							'debit', 
								[
									'template' => '{label}<div class="col-sm-9">{input}</div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->dropDownList(
									$listData,
									['class'=>'form-control select2', 'style'=>'width:100%']
								);
						?>
						<?= $form->field($model,
							'credit', 
								[
									'template' => '{label}<div class="col-sm-9">{input}</div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->dropDownList(
									$listData,
									['class'=>'form-control select2', 'style'=>'width:100%']
								);
						?>
						<?= $form->field($model, 
							'note', 
								[
									'template' => '{label}<div class="col-sm-9">{input}</div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textArea()
						?>
						<?= $form->field($model,
							'balance', 
								[
									'template' => '{label}<div class="col-sm-5">{input}</div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['data-mask-currency-nrp' => ''])
						?>
						
				  </div>
				</div>
				<div class="row pt-1 ml-0 mr-0" style="border-top:1px solid rgba(0, 0, 0, 0.125)">
					<div class="col-sm-12 form-group mt-2 mb-2 pr-0 pl-0">
						<?= Html::button('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right', 'onClick' => 'submitForm()']) ?>
					</div>	
				</div><!-- /.row -->
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
