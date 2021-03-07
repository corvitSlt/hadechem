<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SubItemCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-item-category-form container-fluid">
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
				<div class="col-md-6 col-xs-12 row"  style="margin:0;">
					<div class="col-md-3 col-xs-12 inner-col-left">
						<?= $form->field($model, 
							'sub_item_category_id', 
								[
									'template' => '{label} :{input}{error}',
								])->textInput(['maxlength' => true, 'readonly'=>'disable'])
						?>
					</div>
					<div class="col-md-9 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'sub_item_category_name', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="fas fa-pencil-alt"></i></span>{input}</div>{error}',
								])->textInput(['maxlength' => true, 'placeholder' => 'Masukan nama pegawai...', 'autofocus' => true])
						?>
					</div>
				</div>
			</div></div>
			<?php $listItemCategory=ArrayHelper::map($dataItemCategory,'item_category_id','item_category_name');?>
			<?= $form->field($model, 
				'item_category_id', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12">{input}{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->dropDownList(
							$listItemCategory,
							['prompt'=>'Select...', 'class'=>'form-control select2', 'disabled' => $model->disabledIdCategory]
					);
			?>

			<div class="form-group mt-2">
					<?= Html::submitButton('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
