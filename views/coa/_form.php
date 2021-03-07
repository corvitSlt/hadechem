<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Akun';
?>
<div class="preloader open-load">
	<div class="loader"></div>
</div>
<div class="coa-form container-fluid trans-form transactions  postloader close-load">
	<div class="card">
		<div class="card-body trans-content trans-content-coa"></div>
		<div class="card-footer account">
			<?php $form = ActiveForm::begin(); ?>
				<!-- Content Header (Page header) -->
				<div class="row mb-1">
					<div class="col-sm-5">

						<?php $listData=ArrayHelper::map($dataAccountGroup,'account_group_id','account_group_name');?>
						<?= $form->field($model, 
							'account_group_id', 
								[
									'template' => '{label}<div class="col-sm-2"><input class="form-control group-coa-code" readonly></input></div><div class="col-sm-7">{input}</div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->dropDownList(
									$listData,
									['class'=>'form-control select2', 'style'=>'width:100%', 'onChange'=>'generateCOA()']
								);
						?>
						<?= $form->field($model, 
							'coa_code', 
								[
									'template' => '{label}<div class="col-sm-2 dot-coa"><input id="groupConcatCoa" class="form-control" readonly></input></div><div class="col-sm-2"><input id="coaCodeConcat" class="form-control" readonly></input></div>{input}',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput(['type'=>'hidden'])
						?>
						<?= $form->field($model, 
							'coa_name', 
								[
									'template' => '{label}<div class="col-sm-9">{input}</div>',
									'labelOptions' => ['class' => 'col-sm-3 col-form-label pt-1 pb-1'],
									'options' => ['class'=>'form-group row'],
								])->textInput()
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
