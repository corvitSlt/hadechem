<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>
<?= Html::csrfMetaTags() ?>
<div class="item-form container-fluid">
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
				<label class="col-md-3 col-xs-12 control-label">Identitas Item</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-3 col-xs-12 inner-col-left">
						<?= $form->field($model, 
							'item_id', 
								[
									'template' => '{label} :{input}{error}',
								])->textInput(['maxlength' => true, 'readonly'=>'disable'])
						?>
					</div>
					<div class="col-md-6 col-xs-12 inner-col-right">
						<?= $form->field($model, 
							'item_name', 
								[
									'template' => '{label} :<div class="input-group"><span class="input-group-addon"><i class="fas fa-pencil-alt"></i></span>{input}</div>{error}',
								])->textInput(['maxlength' => true, 'placeholder' => 'Masukan nama pegawai...', 'autofocus' => true])
						?>
					</div>
				</div>
			</div></div>
			<div class="form-group"><div class="row">
				<label class="col-md-3 col-xs-12 control-label">Kategori</label>
				<div class="col-md-9 col-xs-12 row"  style="margin:0;">
					<div class="col-md-4 col-xs-12 inner-col-left">
						<?php $listSubItemCategory=ArrayHelper::map($dataSubItemCategory,'sub_item_category_id','sub_item_category_name');?>
						<?= $form->field($model, 
							'sub_item_category_id', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listSubItemCategory,
								['prompt'=>'Select...', 'class'=>'form-control select2']
							);
						?>
					</div>
					<div class="col-md-3 col-xs-12 inner-col-right separated-none">
						<?php $listUnit=ArrayHelper::map($dataUnit,'unit_id','unit_name');?>
						<?= $form->field($model, 
							'unit_id', 
							['template' => '{label} :{input}{error}',])->dropDownList(
							$listUnit,
								['prompt'=>'Select...', 'class'=>'form-control select2']
							);
						?>
					</div>
				</div>
			</div></div>
			<?= $form->field($model, 
				'price', 
					[
						'template' => '<div class="row">{label}<div class="col-md-3 col-xs-12">{input}{error}</div></div>',
						'labelOptions' => ['class' => 'col-md-3 col-xs-12 control-label'],
					])->textInput(['data-mask-currency'=>'', 'placeholder' => 'Masukan harga barang...'])
			?>
			<div class="form-group mt-2">
					<?= Html::submitButton('<i class="mr-2 fas fa-save"></i>Simpan', ['class' => 'btn btn-primer float-right']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
