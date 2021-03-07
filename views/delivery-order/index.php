<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengiriman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-order-index content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<!-- Content Header (Page header) -->
				<div class="row">
				  <div class="col-sm-6">
					<h1 class="m-0 text-dark"><?= $this->title ?></h1>
				  </div>
				
				<!-- /.content-header -->
				<div class="col-sm-6 c-flex">
					<span class="header-footer-btn">
						<?= Html::a('<span class="fas fa-plus-square btn-icon-span"></span>Tambah Pengiriman', ['create'], ['class' => 'btn btn-primer']) ?>
					</span>
				</div>
				</div><!-- /.row -->
			</div>
			<div class="card-body">
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'layout'=>"{items}",
					'columns' => [
						[
							'class' => 'yii\grid\Column',
							'header'=>'No',
							'headerOptions' => [ 'width' => '12', 'class' => 'th-number'],
							'contentOptions' => ['class' => 'tb-number'],
						],
						[
							'attribute' => 'delivery_order_id',
							'headerOptions' => [ 'width' => '80'],
						],
						'employee_id',
						 [
							'attribute' => 'so_id',
							'value' => 'so.customer.customer_name',
							'headerOptions' => [ 'width' => '120'],
						], 
						[
							'attribute' => 'date',
							'headerOptions' => [ 'width' => '170'],
							'value' => function ($model){
								setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');								
								return strftime("%A, %e %B %Y [%T]",strtotime($model->date));
							},
						],
						'shipper',
						//'transportation_type',
						//'vehicle_number',

						[
							'class' => 'yii\grid\ActionColumn','header'=>'<span class="fas fa-th"></span>', 
							'headerOptions' => ['width' => '25', 'class' => 'th-action'],
							'contentOptions' => ['class' => 'tb-action'],
							'template' => '<div class="btn-group">{view} {update} {delete}{link}</div>',
							'buttons' => [
								'view' => function ($url,$model,$key) {
									return Yii::$app->user->identity->job->authorization->view_employee
										? Html::a('<span class="fas fa-search"></span>', 
										$url, [
											'class' =>'btn btn-primer', 
										]) : '';
								},
								'update' => function ($url,$model) {
									return $model->status && Yii::$app->user->identity->job->authorization->update_employee
										? Html::a('<span class="fas fa-edit"></span>', 
										$url, [
											'class' =>'btn btn-primer', 
										]) : '';
								},
							],
						],
					],
					'emptyText' => false,
					'tableOptions' =>['id' => 'dataTable-do', 'class' => 'table-th-search table table-striped table-bordered'],
				]); ?>
			</div>
		</div>
	</div>
</div>