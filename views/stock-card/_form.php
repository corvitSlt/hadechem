<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\StockCard */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="preloader open-load">
	<div class="loader"></div>
</div>
<div class="stock-card-form container-fluid trans-form transactions postloader close-load">
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
			<div class="card-body content-stock-card preloader-card-body close-load">
				<div class="loader"></div>
			</div>
		<div class="card-body trans-content trans-content-stock-card postloader-card-body open-load"></div>
		<div class="card-footer account">
						
		</div>
	</div>
</div>
