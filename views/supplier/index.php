<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Supplier';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index content">
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
						<?= Html::a('<span class="fas fa-plus-square btn-icon-span"></span>Tambah Supplier', ['create'], ['class' => 'btn btn-primer']) ?>
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
							'attribute' => 'supplier_id',
							'headerOptions' => [ 'width' => '80'],
						],
						'supplier_name',
						'address',
						[
							'attribute' => 'phone_number',
							'headerOptions' => [ 'width' => '120'],
						],
						[
							'attribute' => 'contact_name',
							'headerOptions' => [ 'width' => '120'],
						],
						[
							'attribute' => 'contact_number',
							'headerOptions' => [ 'width' => '120'],
						],
						//'phone_number',
						//'fax_number',
						//'contact_name',
						//'contact_number',
						//'email:email',
						//'flag',

						[
							'class' => 'yii\grid\ActionColumn','header'=>'<span class="fas fa-th"></span>', 
							'headerOptions' => ['width' => '25', 'class' => 'th-action'],
							'contentOptions' => ['class' => 'tb-action'],
							'template' => '<div class="btn-group">{view} {update} {delete}{link}</div>',
							'buttons' => [
								'view' => function ($url,$model,$key) {
									return Yii::$app->user->identity->job->authorization->view_supplier
										? Html::a('<span class="fas fa-search"></span>', 
										$url, [
											'class' =>'btn btn-primer', 
										]) : '';
								},
								'update' => function ($url,$model) {
									return $model->flag && Yii::$app->user->identity->job->authorization->update_supplier
										? Html::a('<span class="fas fa-edit"></span>', 
										$url, [
											'class' =>'btn btn-primer', 
										]) : '';
								},
								'delete' => function ($url,$model) {
									return $model->flag && Yii::$app->user->identity->job->authorization->delete_supplier
										? Html::tag('button', '<span class="fas fa-times-square"></span>',
										[
											'class' =>'btn btn-primer submit-delete-table',
											'data' => [
												'alertBox' => 'Apa anda yakin menonaktifkan supplier?',
												'url' => $url,
										]]) : '';
								},
							],
						],
					],
					'emptyText' => false,
					'tableOptions' =>['id' => 'dataTable-supplier', 'class' => 'table table-striped table-th-search table-bordered'],
				]); ?>
			</div>
		</div>
	</div>
</div>
