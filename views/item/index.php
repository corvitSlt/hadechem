<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index content">
	<div class="container-fluid">
		<div class="card card-primary card-outline card-outline-tabs">
			<div class="card-header p-0 border-bottom-0">
				<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
				  <li class="nav-item">
					<a class="nav-link <?php if($modalActive=='item')echo 'active'; ?>" id="custom-tabs-three-item-tab" data-toggle="pill" href="#custom-tabs-three-item" role="tab" aria-controls="custom-tabs-three-item" aria-selected="true">Barang</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link <?php if($modalActive=='subCategory')echo 'active'; ?>" id="custom-tabs-three-sub-category-item-tab" data-toggle="pill" href="#custom-tabs-three-sub-category-item" role="tab" aria-controls="custom-tabs-three-sub-category-item" aria-selected="false">Sub Kategori</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link <?php if($modalActive=='category')echo 'active'; ?>" id="custom-tabs-three-category-item-tab" data-toggle="pill" href="#custom-tabs-three-category-item" role="tab" aria-controls="custom-tabs-three-category-item" aria-selected="false">Kategori</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link <?php if($modalActive=='unit')echo 'active'; ?>" id="custom-tabs-three-unit-tab" data-toggle="pill" href="#custom-tabs-three-unit" role="tab" aria-controls="custom-tabs-three-unit" aria-selected="false">Satuan</a>
				  </li>
				</ul>
			</div>
			<div class="card-body p-0">
                <div class="tab-content" id="custom-tabs-three-tabContent">
					<div class="tab-pane fade <?php if($modalActive=='item')echo 'show active'; ?>" id="custom-tabs-three-item" role="tabpanel" aria-labelledby="custom-tabs-three-item-tab">
						<div class="card-header">
							<!-- Content Header (Page header) -->
							<div class="row">
							  <div class="col-sm-6">
								<h1 class="m-0 text-dark"><?= $this->title ?></h1>
							  </div>
							
							<!-- /.content-header -->
							<div class="col-sm-6 c-flex">
								<span class="header-footer-btn">
									<?= Html::a('<span class="fas fa-plus-square btn-icon-span"></span>Tambah Barang', ['create'], ['class' => 'btn btn-primer']) ?>
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
										'attribute'=>'item_id',
										'headerOptions' => [ 'width' => '80'],
									],
									'item_name',
									[
										'header'=> 'Category',
										'value'=>'subItemCategory.itemCategory.item_category_name',
										'headerOptions' => [ 'width' => '120', 'class' => 'th-dropdown'],
									],
									[
										'header'=> 'Subcategory',
										'value'=>'subItemCategory.sub_item_category_name',
										'headerOptions' => [ 'width' => '120'],
									],
									[
										'attribute'=>'unit.unit_name',
										'headerOptions' => [ 'width' => '80'],
									],
									[
										'attribute'=>'total_stock',
										'headerOptions' => [ 'width' => '80'],
										'contentOptions' => ['data-mask-number' => ''],
									],
									[
										'attribute'=>'price',
										'headerOptions' => [ 'width' => '80'],
										'contentOptions' => ['data-mask-currency' => ''],
									],
									[
										'class' => 'yii\grid\ActionColumn','header'=>'<span class="fas fa-th"></span>', 
										'headerOptions' => [ 'width' => '25', 'class' => 'th-action'],
										'contentOptions' => ['class' => 'tb-action'],
										'template' => '<div class="btn-group">{view} {update} {delete}{link}</div>',
										'buttons' => [
											'view' => function ($url,$model,$key) {
												return Yii::$app->user->identity->job->authorization->view_item
													? Html::a('<span class="fas fa-search"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'update' => function ($url,$model) {
												return $model->status && Yii::$app->user->identity->job->authorization->update_item  
													? Html::a('<span class="fas fa-edit"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'delete' => function ($url,$model) {
												return $model->status && !$model->total_stock && Yii::$app->user->identity->job->authorization->delete_item 
													? Html::tag('button', '<span class="fas fa-times-square"></span>',
													[
														'class' =>'btn btn-primer submit-delete-table',
														'data' => [
															'alertBox' => 'Apa anda yakin menghapus barang?',
															'url' => $url,
													]]) : '';
											},
										],
									],
								],
								'emptyText' => false,
								'tableOptions' =>['id' => 'dataTable-item', 'class' => 'table table-th-search table-striped table-bordered'],
							]); ?>
						</div>
					</div>
					<div class="tab-pane fade <?php if($modalActive=='subCategory')echo 'show active'; ?>" id="custom-tabs-three-sub-category-item" role="tabpanel" aria-labelledby="custom-tabs-three-sub-category-item-tab">
                     <div class="card-header">
							<!-- Content Header (Page header) -->
							<div class="row">
							  <div class="col-sm-6">
								<h1 class="m-0 text-dark">Sub Kategori Barang</h1>
							  </div>
							
							<!-- /.content-header -->
							<div class="col-sm-6 c-flex">
								<span class="header-footer-btn">
									<?= Html::a('<span class="fas fa-plus-square btn-icon-span"></span>Tambah Sub Kategori', ['sub-item-category/create'], ['class' => 'btn btn-primer']) ?>
								</span>
							</div>
							</div><!-- /.row -->
						</div>
						<div class="card-body">
							<?= GridView::widget([
								'dataProvider' => $dataProviderSub,
								'layout'=>"{items}",
								'columns' => [
									[
										'class' => 'yii\grid\Column',
										'header'=>'No',
										'headerOptions' => [ 'width' => '12', 'class' => 'th-number'],
										'contentOptions' => ['class' => 'tb-number'],
									],
									[
										'attribute'=>'sub_item_category_id',
										'headerOptions' => [ 'width' => '120'],
									],
									'sub_item_category_name',
									'itemCategory.item_category_name',
									[
										'class' => 'yii\grid\ActionColumn','header'=>'<span class="fas fa-th"></span>', 
										'headerOptions' => [ 'width' => '25', 'class' => 'th-action'],
										'contentOptions' => ['class' => 'tb-action'],
										'template' => '<div class="btn-group">{view} {update} {delete}{link}</div>',
										'buttons' => [
											'view' => function ($url,$model,$key) {
												return Yii::$app->user->identity->job->authorization->view_sub_item_category
													? Html::a('<span class="fas fa-search"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'update' => function ($url,$model) {
												return $model->status && Yii::$app->user->identity->job->authorization->update_sub_item_category 
													? Html::a('<span class="fas fa-edit"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'delete' => function ($url,$model) {
												return $model->status && Yii::$app->user->identity->job->authorization->delete_sub_item_category 
													? Html::a('<span class="fas fa-times-square"></span>', 
													$url,
													[
														'class' =>'btn btn-primer', 
														'data' => [
														'confirm' => 'Apa anda yakin menonaktivkan pegawai?',
														'method' => 'post',
													]]) : '';
											},
										],
										'urlCreator' => function ($action, $model, $key, $index) {
											if ($action === 'view') {
												$url = Url::to(['sub-item-category/'.$action, 'id' => $model->sub_item_category_id]);
												return $url;
											}

											if ($action === 'update') {
												$url = Url::to(['sub-item-category/'.$action, 'id' => $model->sub_item_category_id]);
												return $url;
											}
											if ($action === 'delete') {
												$url = Url::to(['sub-item-category/'.$action, 'id' => $model->sub_item_category_id]);
												return $url;
											}

										}
									],
								],
								'emptyText' => false,
								'tableOptions' =>['id' => 'dataTable-subItem', 'class' => 'table table-th-search table-striped table-bordered'],
							]); ?>
						</div>
                  </div>
                  <div class="tab-pane fade <?php if($modalActive=='category')echo 'show active'; ?>" id="custom-tabs-three-category-item" role="tabpanel" aria-labelledby="custom-tabs-three-category-item-tab">
                     <div class="card-header">
							<!-- Content Header (Page header) -->
							<div class="row">
							  <div class="col-sm-6">
								<h1 class="m-0 text-dark">Kategori Barang</h1>
							  </div>
							
							<!-- /.content-header -->
							<div class="col-sm-6 c-flex">
								<span class="header-footer-btn">
									<?= Html::a('<span class="fas fa-plus-square btn-icon-span"></span>Tambah Kategori', ['item-category/create'], ['class' => 'btn btn-primer']) ?>
								</span>
							</div>
							</div><!-- /.row -->
						</div>
						<div class="card-body">
							<?= GridView::widget([
								'dataProvider' => $dataProviderCategory,
								'layout'=>"{items}",
								'columns' => [
									[
										'class' => 'yii\grid\Column',
										'header'=>'No',
										'headerOptions' => [ 'width' => '12', 'class' => 'th-number'],
										'contentOptions' => ['class' => 'tb-number'],
									],

									[
										'attribute' => 'item_category_id',
										'headerOptions' => [ 'width' => '120'],
									],
									'item_category_name',
									[
										'class' => 'yii\grid\ActionColumn','header'=>'<span class="fas fa-th"></span>', 
										'headerOptions' => [ 'width' => '25', 'class' => 'th-action'],
										'contentOptions' => ['class' => 'tb-action'],
										'template' => '<div class="btn-group">{view} {update} {delete}{link}</div>',
										'buttons' => [
											'view' => function ($url,$model,$key) {
												return Yii::$app->user->identity->job->authorization->view_item_category
													? Html::a('<span class="fas fa-search"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'update' => function ($url,$model) {
												return $model->status && Yii::$app->user->identity->job->authorization->update_item_category
													? Html::a('<span class="fas fa-edit"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'delete' => function ($url,$model) {
												return $model->status && Yii::$app->user->identity->job->authorization->delete_item_category 
													? Html::a('<span class="fas fa-times-square"></span>', 
													$url,
													[
														'class' =>'btn btn-primer', 
														'data' => [
														'confirm' => 'Apa anda yakin menonaktivkan pegawai?',
														'method' => 'post',
													]]) : '';
											},
										],
										'urlCreator' => function ($action, $model, $key, $index) {
											if ($action === 'view') {
												$url = Url::to(['item-category/'.$action, 'id' => $model->item_category_id]);
												return $url;
											}

											if ($action === 'update') {
												$url = Url::to(['item-category/'.$action, 'id' => $model->item_category_id]);
												return $url;
											}
											if ($action === 'delete') {
												$url = Url::to(['item-category/'.$action, 'id' => $model->item_category_id]);
												return $url;
											}

										}
									],
								],
								'emptyText' => false,
								'tableOptions' =>['id' => 'dataTable-categoryItem', 'class' => 'table table-th-search table-striped table-bordered'],
							]); ?>
						</div>
                  </div>
                  <div class="tab-pane fade <?php if($modalActive=='unit')echo 'show active'; ?>" id="custom-tabs-three-unit" role="tabpanel" aria-labelledby="custom-tabs-three-unit-tab">
                     <div class="card-header">
							<!-- Content Header (Page header) -->
							<div class="row">
							  <div class="col-sm-6">
								<h1 class="m-0 text-dark">Satuan Barang</h1>
							  </div>
							
							<!-- /.content-header -->
							<div class="col-sm-6 c-flex">
								<span class="header-footer-btn">
									<?= Html::a('<span class="fas fa-plus-square btn-icon-span"></span>Tambah Satuan', ['unit/create'], ['class' => 'btn btn-primer']) ?>
								</span>
							</div>
							</div><!-- /.row -->
						</div>
						<div class="card-body">
							<?= GridView::widget([
								'dataProvider' => $dataProviderUnit,
								'layout'=>"{items}",
								'columns' => [
									[
										'class' => 'yii\grid\Column',
										'header'=>'No',
										'headerOptions' => [ 'width' => '12', 'class' => 'th-number'],
										'contentOptions' => ['class' => 'tb-number'],
									],
									[
										'attribute'=>'unit_id',
										'headerOptions' => [ 'width' => '120'],
									],
									'unit_name',
									[
										'class' => 'yii\grid\ActionColumn','header'=>'<span class="fas fa-th"></span>', 
										'headerOptions' => [ 'width' => '25', 'class' => 'th-action'],
										'contentOptions' => ['class' => 'tb-action'],
										'template' => '<div class="btn-group">{view} {update} {delete}{link}</div>',
										'buttons' => [
											'view' => function ($url,$model,$key) {
												return Yii::$app->user->identity->job->authorization->view_unit
													? Html::a('<span class="fas fa-search"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'update' => function ($url,$model) {
												return $model->status && Yii::$app->user->identity->job->authorization->update_unit
													? Html::a('<span class="fas fa-edit"></span>', 
													$url, [ 
														'class' =>'btn btn-primer', 
													  ]) : '';
											},
											'delete' => function ($url,$model) {
												return $model->status && Yii::$app->user->identity->job->authorization->delete_unit 
													? Html::a('<span class="fas fa-times-square"></span>', 
													$url,
													[
														'class' =>'btn btn-primer', 
														'data' => [
														'confirm' => 'Apa anda yakin menonaktivkan pegawai?',
														'method' => 'post',
													]]) : '';
											},
										],
										'urlCreator' => function ($action, $model, $key, $index) {
											if ($action === 'view') {
												$url = Url::to(['unit/'.$action, 'id' => $model->unit_id]);
												return $url;
											}

											if ($action === 'update') {
												$url = Url::to(['unit/'.$action, 'id' => $model->unit_id]);
												return $url;
											}
											if ($action === 'delete') {
												$url = Url::to(['unit/'.$action, 'id' => $model->unit_id]);
												return $url;
											}

										}
									],
								],
								'emptyText' => false,
								'tableOptions' =>['id' => 'dataTable-unit', 'class' => 'table table-th-search table-striped table-bordered'],
							]); ?>
						</div> 
                  </div>
				</div>
			</div>
		</div>
	</div>
</div>
