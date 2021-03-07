<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed<?php if(Yii::$app->user->identity->setting->body_small_text==1){echo " text-sm";}if(Yii::$app->user->identity->setting->navbar_position_fix==1){echo " layout-navbar-fixed";}if(Yii::$app->user->identity->setting->footer_position_fix==1){echo " layout-footer-fixed";}if(Yii::$app->user->identity->setting->accent_color_variant!=""){echo ' '.Yii::$app->user->identity->setting->accent_color_variant;}if(Yii::$app->user->identity->setting->sidebar_variant!=''){echo ' content'.Yii::$app->user->identity->setting->sidebar_variant;}else{echo ' content-dark-primary';}if(Yii::$app->user->identity->setting->mini_sidebar==1){echo " sidebar-collapse";}?>">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand<?php if(Yii::$app->user->identity->setting->no_navbar_border==1){echo " border-bottom-0";}if(Yii::$app->user->identity->setting->navbar_small_text==1){echo " text-sm";}if(Yii::$app->user->identity->setting->navbar_variant!=''){echo ' '.Yii::$app->user->identity->setting->navbar_variant;}else{echo ' navbar-white navbar-light';}?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
	  <?= Breadcrumbs::widget([
			'tag' => false,
			'homeLink' => [
				'label' => 'Beranda',
				'url' => 'site/index',
			],
			'options' => ['class' => 'breadcrumb'],
			'itemTemplate' => "<li class='nav-item breadcrumb-item'>{link}</li>\n",
			'activeItemTemplate' => "<li class='nav-item  breadcrumb-item active'>{link}</li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </ul>
	<?php
		if(!Yii::$app->user->isGuest){ 
			echo '<!-- SEARCH FORM -->
				<form class="form-inline ml-3">
				  <div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
					  <button class="btn btn-navbar" type="submit">
						<i class="fas fa-search"></i>
					  </button>
					</div>
				  </div>
				</form>';
	    
			echo '<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto"> 
				<!-- logout -->
				<li class="nav-item">';
		     
			echo Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                   ['class' => 'btn btn-link logout', 'hidden' => 'hidden']
                )
                . Html::endForm();
		
			echo '<a class="nav-link btn-logout" href="javascript:$(\'.logout\').click()"><i class="fas fa-sign-out-alt"></i><span class="txt-lg"> Logout</span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
				  <i class="fas fa-cogs"></i>
				</a>
			  </li>
			</ul>';
		}
	?>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4<?php if(Yii::$app->user->identity->setting->main_sidebar_disable_hover==1){echo " sidebar-no-expand";}if(Yii::$app->user->identity->setting->sidebar_variant!=''){echo ' sidebar'.Yii::$app->user->identity->setting->sidebar_variant;}else{echo ' sidebar-dark-primary';}?>">
    <!-- Brand Logo -->
    <?php
		$brand_link = '';
		if(Yii::$app->user->identity->setting->brand_small_text==1){
			$brand_link .= " text-sm";
		}
		if(Yii::$app->user->identity->setting->brand_logo_variant!=''){
			$brand_link .= ' '.Yii::$app->user->identity->setting->brand_logo_variant;
		}
		echo Html::a(
		Html::img(
			'@web/dist/img/AdminLTELogo.png',[
				'alt' => 'My logo', 
				'class'=>'brand-image img-circle elevation-3', 
				'style'=>'style="opacity: .8'])
			.Html::tag(
				'span',
				'CorvIT', 
				['class' => 'brand-text font-weight-light']), 
			['/site/index'], 
			['class'=>'brand-link'.$brand_link]) 
	?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php echo Html::a(Html::img('@web/profilImage/'.Yii::$app->user->identity->profil_image,['alt' => 'User Image','class'=>'img-circle elevation-2']))?>
        </div>
        <div class="info">
          <span id="profil-name" class="d-block"><?php echo Yii::$app->user->identity->employee_name ?></span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <?php
			$nav_sidebar_class = '';
			if(Yii::$app->user->identity->setting->sidebar_nav_faf==1){
				$nav_sidebar_class .= " nav-faf-solid";
			}
			else{
				$nav_sidebar_class .= " nav-faf-light";
			}
			if(Yii::$app->user->identity->setting->sidebar_nav_fas==1){
				$nav_sidebar_class .= " nav-fas-solid";
			}
			else{
				$nav_sidebar_class .= " nav-fas-light";
			}
			if(Yii::$app->user->identity->setting->sidebar_nav_small_text==1){
				$nav_sidebar_class .= " text-sm";
			}
			if(Yii::$app->user->identity->setting->sidebar_nav_flat_style==1){
				$nav_sidebar_class .= " nav-flat";
			}
			if(Yii::$app->user->identity->setting->sidebar_nav_legacy_style==1){
				$nav_sidebar_class .= " nav-legacy";
			}
			if(Yii::$app->user->identity->setting->sidebar_nav_compact==1){
				$nav_sidebar_class .= " nav-compact";
			}
			if(Yii::$app->user->identity->setting->sidebar_nav_child_indent==1){
				$nav_sidebar_class .= " nav-child-indent";
			}
			echo Menu::widget([
				'items' => [
					[
						'label' => 'Beranda',
						'url' => ['site/index'],
						'template' => "\n<a class=\"nav-link\" href=\"{url}\">\n<i class=\"nav-icon fos fa-desktop-alt\"></i>\n<p>\n{label}\n</p>\n</a>\n",
					],
					[
						'label' => 'Master Data',
						'options' => ['class' => 'master-open nav-item has-treeview'],
						'template' => "\n<a class=\"nav-link\" href=\"#\">\n<i class=\"nav-icon fos fa-cabinet-filing\"></i>\n<p>\n{label}\n<i class=\"right fas fa-angle-left\"></i>\n</p>\n</a>\n",
							'items' => [
								[
									'label' => 'Customer', 
									'url' => ['customer/index'],
									'template' => '<a class="customer-active nav-link" href="{url}"><i class="fos fa-id-card nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Pegawai', 
									'url' => ['employee/index'],
									'template' => '<a class="employee-active nav-link" href="{url}"><i class="fos fa-id-card-alt nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Supplier', 
									'url' => ['supplier/index'],
									'template' => '<a class="supplier-active nav-link" href="{url}"><i class="fos fa-handshake nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Barang', 
									'url' => ['item/index'],
									'template' => '<a class="item-active nav-link" href="{url}"><i class="fos fa-pallet nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Kartu Stock', 
									'url' => ['stock-card/index'],
									'template' => '<a class="stock-card-active nav-link" href="{url}"><i class="fos fa-ballot-check nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Gudang', 
									'url' => ['warehouse/index'],
									'template' => '<a class="warehouse-active nav-link" href="{url}"><i class="fos fa-warehouse nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'vocer', 
									'url' => ['voucher/index'],
									'template' => '<a class="voucher-active nav-link" href="{url}"><i class="fos fa-tags nav-icon"></i><p>{label}</p></a>',
								],
							]
					],
					[
						'label' => 'Pembelian',
						'options' => ['class' => 'purchase-open nav-item has-treeview'],
						'template' => "\n<a class=\"nav-link\" href=\"#\">\n<i class=\"nav-icon fos fa-shopping-cart\"></i>\n<p>\n{label}\n<i class=\"right fas fa-angle-left\"></i>\n</p>\n</a>\n",
							'items' => [
								[
									'label' => 'Permintaan Pembelian', 
									'url' => ['purchase-request/index'],
									'template' => '<a class="purchase-request-active nav-link" href="{url}"><i class="nav-icon fos fa-receipt"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Order Pembelian (PO)', 
									'url' => ['purchase-order/index'],
									'template' => '<a class="purchase-order-active nav-link" href="{url}"><i class="nav-icon fos fa-clipboard-list"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Penerimaan Barang', 
									'url' => ['order-receipt/index'],
									'template' => '<a class="order-receipt-active nav-link" href="{url}"><i class="fos fa-truck-loading nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Nota Pembelian', 
									'url' => ['purchase/index'],
									'template' => '<a class="purchase-active nav-link" href="{url}"><i class="fos fa-file-invoice-dollar nav-icon"></i><p>{label}</p></a>',
								],
[
									'label' => 'Pembayaran Pembelian', 
									'url' => ['purchase-payment/index'],
									'template' => '<a class="purchase-payment-active nav-link" href="{url}"><i class="fos fa-cash-register nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Retur Pembelian', 
									'url' => ['returBarangBeli/index'],
									'template' => '<a class="purchase-return-active nav-link" href="{url}"><i class="fos fa-inbox-out nav-icon"></i><p>{label}</p></a>',
								],
							]
					],
					[
						'label' => 'Penjualan',
						'options' => ['class' => 'sales-open nav-item has-treeview'],
						'template' => "\n<a class=\"nav-link\" href=\"#\">\n<i class=\"nav-icon fos fa-dollar-sign\"></i>\n<p>\n{label}\n<i class=\"right fas fa-angle-left\"></i>\n</p>\n</a>\n",
							'items' => [
								[
									'label' => 'Order Penjualan (SO)', 
									'url' => ['sales-order/index'],
									'template' => '<a class="sales-order-active nav-link" href="{url}"><i class="nav-icon fos fa-clipboard-list"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Pengiriman Barang', 
									'url' => ['delivery-order/index'],
									'template' => '<a class="delivery-order-active nav-link" href="{url}"><i class="fos fa-shipping-fast nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Nota Penjualan', 
									'url' => ['sales/index'],
									'template' => '<a class="sales-active nav-link" href="{url}"><i class="fos fa-file-invoice-dollar nav-icon"></i><p>{label}</p></a>',
								],
[
									'label' => 'Pembayaran Penjualan', 
									'url' => ['sales-payment/index'],
									'template' => '<a class="sales-payment-active nav-link" href="{url}"><i class="fos fa-cash-register nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Retur Barang', 
									'url' => ['returBarangJual/index'],
									'template' => '<a class="sales-return-active nav-link" href="{url}"><i class="fos fa-inbox-in nav-icon"></i><p>{label}</p></a>',
								],
							]
					],
					[
						'label' => 'Akuntansi',
						'options' => ['class' => 'nav-item has-treeview'],
						'template' => "\n<a class=\"nav-link\" href=\"#\">\n<i class=\"nav-icon fos fa-calculator-alt\"></i>\n<p>\n{label}\n<i class=\"right fas fa-angle-left\"></i>\n</p>\n</a>\n",
							'items' => [
								[
									'label' => 'Master Akun', 
									'url' => ['coa/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-swatchbook nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Kas Masuk', 
									'url' => ['journal/cashin'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-address-book nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Kas Keluar', 
									'url' => ['journal/cashout'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-truck nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Bank Masuk', 
									'url' => ['journal/bankin'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-boxes nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Bank Keluar', 
									'url' => ['journal/bankout'],
									'template' => '<a class="nav-link" href="{url}"><i class="ion ion-clipboard nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Jurnal Umum', 
									'url' => ['journal/general'],
									'template' => '<a class="nav-link" href="{url}"><i class="ion ion-clipboard nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Jurnal', 
									'url' => ['journal/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="ion ion-clipboard nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Aktiva Tetap', 
									'url' => ['kartuStock/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-building nav-icon"></i><p>{label}</p></a>',
								],
							]
					],
					[
						'label' => 'Laporan',
						'options' => ['class' => 'nav-item has-treeview'],
						'template' => "\n<a class=\"nav-link\" href=\"#\">\n<i class=\"nav-icon fos fa-analytics\"></i>\n<p>\n{label}\n<i class=\"right fas fa-angle-left\"></i>\n</p>\n</a>\n",
							'items' => [
								[
									'label' => 'Laba-Rugi', 
									'url' => ['customer/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-file-alt nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Neraca', 
									'url' => ['pegawai/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-balance-scale nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Buku Besar', 
									'url' => ['supplier/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-book nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Laporan Master', 
									'url' => ['barang/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-file-spreadsheet nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Daftar Jurnal', 
									'url' => ['kartuStock/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-file-spreadsheet nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Laporan Pembelian', 
									'url' => ['kartuStock/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-file-chart-line nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Laporan Penjualan', 
									'url' => ['kartuStock/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-file-chart-line nav-icon"></i><p>{label}</p></a>',
								],
								[
									'label' => 'Ekuitas Pemilik', 
									'url' => ['kartuStock/index'],
									'template' => '<a class="nav-link" href="{url}"><i class="fos fa-file-contract nav-icon"></i><p>{label}</p></a>',
								],
							]
					],

				],
				'options' => ['class'=>'nav nav-pills nav-sidebar'.$nav_sidebar_class.' flex-column', 'data-widget' => 'treeview', 'role' => 'menu', 'data-accordion' => 'false'],
				'itemOptions' => ['class'=>'nav-item'],
				'submenuTemplate' => "\n<ul class=\"nav nav-treeview\">\n{items}\n</ul>\n",
				'activateParents'=>true,
			]);
		?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <?= Alert::widget() ?>
        <?= $content ?>
	<!------------------------------------------------------------------------------------------>	
	  <!-- MESSAGE BOX -->
	  <!-- ALERT BOX-->
	  <div id="msg-box">
		<!--<div class="message-box animated fadeIn" data-sound="alert" id="message-box-alert">
			<div class="mb-container">
				<div class="mb-middle">
					<div class="mb-title"><span class="fa fa-exclamation-circle"></span> Alert</div>
					<div class="mb-content">
						<p style="font-size:18px;" id="alert-content"></p>               
					</div>
					<div id="btn-mb-footer" class="mb-footer">
						<button class="btn btn-primer btn-lg pull-right mb-control-close">OK</button>
					</div>
				</div>
			</div>
		</div>-->
	 </div>
		<!-- LAERT BOX-->
		<!-- EOF MESSAGE BOX -->
	  <!-- MODAL -->
	  <!-- MODAL ITEMS -->
	  <div class="modal fade" id="modal-list-items">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Barang</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="items-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL ITEMS -->
	  
	  <!-- MODAL CUSTOMERS -->
	  <div class="modal fade" id="modal-list-customers">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Pelangan</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="customers-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL CUSTOMERS -->
	  
	  <!-- MODAL SUPPLIERS -->
	  <div class="modal fade" id="modal-list-suppliers">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Supplier</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="suppliers-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL SUPPLIERS -->
	  
	  <!-- MODAL SALES -->
	  <div class="modal fade" id="modal-list-salesman">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Sales</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="salesman-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL SALES -->
	  
	  <!-- MODAL SO -->
	  <div class="modal fade" id="modal-list-so">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Order Penjualan (SO)</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="so-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL SO -->
	  <!-- MODAL DO -->
	  <div class="modal fade" id="modal-list-do">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Surat Jalan (DO)</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="do-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL DO -->
	   <!-- MODAL SALES PAYMENT -->
	  <div class="modal fade" id="modal-list-sales">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Nota Penjualan</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="sales-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL SALES PAYMENT -->
	   <!-- MODAL PR -->
	  <div class="modal fade" id="modal-list-pr">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Permintaan Pembelian</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="pr-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL PR -->
	  <!-- MODAL PO -->
	  <div class="modal fade" id="modal-list-po">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Order Pembelian</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="po-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL PO -->
	  <!-- MODAL PURCHASEFROM -->
	  <div class="modal fade" id="modal-list-purchasefrom">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Penerimaan Barang/Pembelian Tunai</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="purchasefrom-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL PURCHASEFROM -->
	   <!-- MODAL PURCHASE PAYMENT -->
	  <div class="modal fade" id="modal-list-purchase">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Nota Pembelian</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="purchase-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL PURCHASE PAYMENT -->
	  <!-- MODAL VOUCHER -->
	  <div class="modal fade" id="modal-list-voucher">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
			  <h4 class="modal-title">Vocer</h4>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body" id="voucher-list">
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	  </div>
	  <!-- EOF MODAL VOUCHER -->
	  <!-- EOF MODAL -->
  </div>
  <audio id="audio-alert" src="<?= Yii::getAlias('@web/audio/alert.mp3');?>" preload="auto"></audio>
  <audio id="audio-fail" src="<?= Yii::getAlias('@web/audio/fail.mp3'); ?>" preload="auto"></audio>
  
  <!-- /.content-wrapper -->
  <footer class="main-footer<?php if(Yii::$app->user->identity->setting->footer_small_text==1){echo " text-sm";}?>">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar<?php if(strpos(Yii::$app->user->identity->setting->sidebar_variant, 'dark') !== false){echo ' control-sidebar-dark';}else{echo ' control-sidebar-light';}?>">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
