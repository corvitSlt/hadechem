/* MESSAGE BOX */
function alertBox(content,btn_ok_fc=false,btn_cancle_fc=""){
	var box = $("#msg-box");
	
	var $mb_title = "";
	var $mb_content = $('<div />',{'class':'mb-content'}).append($('<p />',{'style':'font-size:18px'}).append(content));
	var $mb_footer = $('<div />',{'class':'mb-footer'});
	
	if(btn_ok_fc){
		$mb_title = $('<label />', {'class':'mb-title'}).append($('<span />',{'class':'fa fa-exclamation-circle'})).append($('<span />').text(' Konfirmasi'));
		if(btn_cancle_fc){
			$mb_footer = $mb_footer.append($('<button />', {'class':'btn btn-default btn-lg pull-right mb-control-close', 'style':'margin-left:5px'}).text('Batal').on("click",function(){
				$(this).parents(".message-box").removeClass("open");
				return false;
			})).append($('<button />', {'class':'btn btn-secondary btn-lg pull-right mb-control-close', 'style':'margin-left:5px','onClick':btn_cancle_fc}).text('Tidak').on("click",function(){
				$(this).parents(".message-box").removeClass("open");
				return false;
			})).append($('<button />', {'class':'btn btn-primer btn-lg pull-right mb-control-close','onClick':btn_ok_fc}).text('Ok').on("click",function(){
				$(this).parents(".message-box").removeClass("open");
				return false;
			}))
		}else{
			$mb_footer = $mb_footer.append($('<button />', {'class':'btn btn-default btn-lg pull-right mb-control-close', 'style':'margin-left:5px'}).text('Batal').on("click",function(){
				$(this).parents(".message-box").removeClass("open");
				return false;
			})).append($('<button />', {'class':'btn btn-primer btn-lg pull-right mb-control-close','onClick':btn_ok_fc}).text('Ok').on("click",function(){
				$(this).parents(".message-box").removeClass("open");
				return false;
			}))
		}
	}
	else{
		$mb_title = $('<label />', {'class':'mb-title'}).append($('<span />',{'class':'fa fa-exclamation-circle'})).append($('<span />').text(' Peringatan'));
		$mb_footer = $mb_footer.append($('<button />', {'class':'btn btn-primer btn-lg pull-right mb-control-close'}).text('OK').on("click",function(){
			$(this).parents(".message-box").removeClass("open");
			return false;
		}));
	}
	
	var $message_box = $('<div />',{
		'class':'message-box animated fadeIn',
		'data-sound':'alert',
		'id':'message-box-alert'
	}).append($('<div />',{
		'class':'mb-container'
		}).append($('<div />', {
			'class':'mb-middle'
			}).append($mb_title).append($mb_content).append($mb_footer))).toggleClass("open");
	box.html($message_box);
	//if(box.length > 0){
		//contentAlert.html(content);
		//$message_box.toggleClass("open");
		//btnMBFooter.append('<button class="btn btn-primer btn-lg pull-right mb-control-close">OK</button>');
		var sound = $message_box.data("sound");
		
		if(sound === 'alert')
			playAudio('alert');
		
		if(sound === 'fail')
			playAudio('fail');
		//$(".mb-control-close").focus();
	//}        
	return false;
};
/* END MESSAGE BOX */

/* INIT DATATABLE */
function cerate_dataTable_index(dataTableCnfgs){
	$.each(dataTableCnfgs, function(index,id) {
		$(id.id_table + ' thead tr').clone(true).appendTo($(id.id_table + ' thead'));
		$(id.id_table + ' thead tr:eq(1) th').each( function (i) {
			if(!$(this).hasClass('th-number') && !$(this).hasClass('th-action')){
				var title = $(this).text();
				$(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'" />' );

				$( 'input', this ).on( 'keyup change', function () {
					if ( dataTable_item.column(i).search() !== this.value ) {
						dataTable_item.column(i)
							.search( this.value )
							.draw();
					}
				} );
			}
			else
				$(this).html( '' );
		} );
		var dataTable_item =$(id.id_table).DataTable({
			orderCellsTop: true,
			fixedHeader: true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": id.target_column
			}],
			order: [[ 1, "asc" ]],
			"info": true,
			"autoWidth": true,
		});
		dataTable_item.on( "order.dt search.dt", function () {
			dataTable_item.column(0, {search:"applied", order:"applied"}).nodes().each( function (cell, i) {
				cell.innerHTML = i+1;
			} );
		} ).draw();
	});
}
/* END OF INIT DATATABLE */
function submit_delete_table(url){
	$.ajax({ 
	   type: "POST", 
	   url: url		   
	});
}
$('.submit-delete-table').on( 'click', function () {
	alertBox($(this).data('alertbox'), 'submit_delete_table("' + $(this).data('url') + '")')
})
/* PLAY SOUND FUNCTION */
function playAudio(file){
	if(file === 'alert')
		document.getElementById('audio-alert').play();

	if(file === 'fail')
		document.getElementById('audio-fail').play();    
}
/* END PLAY SOUND FUNCTION */

$(document).ready(function(){
	//moment.locale('id');
	/* BIRTH DATE CALENDAR */
	if($('body').find('.birth-date-calendar').length){

		var bd_length = $('body').find('.birth-date-calendar').length;
		var $bd_calendar = '';
		var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'Oktober', 'September', 'November', 'Desember'];
		var day_ofMonths = [31, [28, 29], 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		for(i=0;i<bd_length;i++){

			$bd_calendar = $('.birth-date-calendar').eq(i);
			var d_target = $bd_calendar.children('input')[0].id;
			var d_index_id=  i;
			var date_init = $('#'+d_target).val().split("-");

			var $day_select = $('<select />', {
				'class' : 'form-control custom-select',
				'id' : 'birth-day-' + i,
				'data-target' : d_target,
				'data-index' : d_index_id
			}).on('change', function(){
				
				var indx = $(this).data('index');
				var target_date = $(this).data('target');
				var birthsDate = $(this).val() + '-' + $('#birth-month-' + indx).val() + '-' + $('#birth-year-' + indx).val();
				var data_target = $('#'+target_date);
				data_target.val(birthsDate);
				
				
			});
			var leap_year = 0;
			var disable_options = 0;
			if(date_init[1]==2){
				if ((date_init[2] % 4) == 0){
					if ((date_init[2] % 100) == 0){
						if ((date_init[2] % 400) == 0){
							leap_year = 1;
						}
					}
					else{
						leap_year = 1;
					}
				}
				disable_options = day_ofMonths[date_init[1]-1][leap_year];
			}
			else{
				disable_options = day_ofMonths[date_init[1]-1];
			}
			for(j=1; j<=31; j++){
				if(j==date_init[0])
					$day_select.append($('<option />', {'value' : j, 'id':d_target + '_optionDay_' + j, 'selected':''}).text(j));
				else{
					if(j>disable_options)
						$day_select.append($('<option />', {'value' : j, 'id':d_target + '_optionDay_' + j, 'disabled':''}).text(j));
					else
						$day_select.append($('<option />', {'value' : j, 'id':d_target + '_optionDay_' + j}).text(j));
				}
			}

			var $month_select = $('<select />', {
				'class' : 'form-control custom-select',
				'id' : 'birth-month-' + i,
				'data-target' : d_target,
				'data-index' : d_index_id
			}).on('change', function(){
				var indx = $(this).data('index');
				var target_date = $(this).data('target');

				check_leap_year(indx, target_date);

				$('#birth-day-' + indx).select2({
					minimumResultsForSearch: -1
				});

				var birthsDate = $('#birth-day-' + indx).val() + '-' + $(this).val() + '-' + $('#birth-year-' + indx).val();
				var data_target = $('#'+target_date);
				data_target.val(birthsDate);
			})
	
			for(j=0; j<12; j++){
				if(j+1==date_init[1])
					$month_select.append($('<option />', {'value' : j+1, 'selected':''}).text(months[j]));
				else
					$month_select.append($('<option />', {'value' : j+1}).text(months[j]));
			}
			
			var d_year = new Date().getFullYear();
			var $year_select=$('<select />', {
				'class' : 'form-control custom-select',
				'id' : 'birth-year-' + i,
				'data-target' : d_target,
				'data-index' : d_index_id
			}).on('change', function(){
				var indx = $(this).data('index');
				var target_date = $(this).data('target');
				
				check_leap_year(indx, target_date);

				$('#birth-day-' + indx).select2({
					minimumResultsForSearch: -1
				});
				
				var birthsDate = $('#birth-day-' + indx).val() + '-' + $('#birth-month-' + indx).val() + '-' + $(this).val();
				var data_target = $('#'+target_date);
				data_target.val(birthsDate);
			});
			for(j=d_year-70; j<=d_year; j++){
				if(j==date_init[2])
					$year_select.append($('<option />', {'value' : j, 'selected':''}).text(j));
				else
					$year_select.append($('<option />', {'value' : j}).text(j));
			}

			$bd_calendar.append($('<div />', {'class':'row', 'style':'margin:0'}).append($('<div />', {'class':'inner-col-left col-md-day slash'}).append($day_select)).append($('<div />', {'class':'inner-col-middle col-md-month slash'}).append($month_select)).append($('<div />', {'class':'inner-col-right col-md-year'}).append($year_select)));
		}
		function check_leap_year(indx, target_date){
			var cl_day = $('#birth-day-' + indx);
			var cl_month = $('#birth-month-' + indx);
			var cl_year = $('#birth-year-' + indx);
			var cl_day_option = '#' + target_date + '_optionDay_';

			for(d=28; d<=31; d++){
				if($(cl_day_option + d).prop('disabled'))
					$(cl_day_option + d).prop('disabled', false);
			}
			var leap_year = 0;
			if(cl_month.val()==2){
				if ((cl_year.val() % 4) == 0){
					if ((cl_year.val() % 100) == 0){
						if ((cl_year.val() % 400) == 0){
							leap_year = 1;
						}
					}
					else{
						leap_year = 1;
					}
				}
				if(leap_year){
					if(cl_day.val() > 29){
						cl_day.val(29);
						cl_day.trigger('change.select2');
					}
					for(d=30; d<=31; d++){
						if(!$(cl_day_option + d).prop('disabled'))
							$(cl_day_option + d).prop('disabled', true);
					}
				}
				else{
					if(cl_day.val() > 28){
						cl_day.val(28);
						cl_day.trigger('change.select2');
					}
					for(d=29; d<=31; d++){
						if(!$(cl_day_option + d).prop('disabled'))
							$(cl_day_option + d).prop('disabled', true);
					}
				}
			}
			else{
				if(day_ofMonths[cl_month.val()-1] < 31){
					if(cl_day.val() == 31){
						cl_day.val(30);
						cl_day.trigger('change.select2');
					}
					$(cl_day_option + 31).prop('disabled', true);
				}
			}
		}
	}
	/* BIRTH DATE CALENDAR */
	var $same_address = "";
	if($('body').find('.same-address').length){
		$same_address = $('body').find('.same-address');
	}
	/* ADDRESS FIELD */
	$('.full-address-field').each( function (i){
		var $optionRegency = $(this).find('select.regency-select');
		var $optionDistrict = $(this).find('select.district-select');
		var $optionVillage = $(this).find('select.village-select');
		if($optionRegency.find('option').length <=1){
			$optionRegency.append($('<option />', {'value' : '', 'disabled':''}).text('Pilih Provinsi terlebih dahulu!!!'));
		}
		if($optionDistrict.find('option').length <=1){
			$optionDistrict.append($('<option />', {'value' : '', 'disabled':''}).text('Pilih Provinsi dan Kota/Kabupaten terlebih dahulu!!!'));
		}
		if($optionVillage.find('option').length <=1){
			$optionVillage.append($('<option />', {'value' : '', 'disabled':''}).text('Pilih Provinsi, Kota/Kabupaten dan Kecamatan terlebih dahulu!!!'));
		}
	});
	$('.province-select').on('change', function(){
		var $parent_address = $(this).parents('div .full-address-field');
		var change_address = true;
		var has_same_address = $parent_address.find('.same-address').length;
		if(has_same_address > 0 && $same_address.is(':checked')){
			change_address = false;
		}
		if(change_address == true){
			$.ajax({ 
			   type: "POST", 
			   url: "index.php?r=employee%2Fget_regency_ajax",
			   dataType:'json',
			   data : {'province_id' : $(this).val()},
			   success: function(dataRegency){
					var $option_regency = $parent_address.find('select.regency-select');
					var $option_district = $parent_address.find('select.district-select');
					var $option_village = $parent_address.find('select.village-select');
					$option_regency.html($('<option />', {'value' : '', 'selected':''}).text('Select...'));
					$.each(dataRegency, function(index,value) {
						$option_regency.append($('<option />', {'value' : value.regency_id}).text(value.regency_name));
					});
					$option_district.html($('<option />', {'value' : '', 'selected':''}).text('Select...')).append($('<option />', {'value' : '', 'disabled':''}).text('Pilih Kota/Kabupaten terlebih dahulu!!!'));
					$option_village.html($('<option />', {'value' : '', 'selected':''}).text('Select...')).append($('<option />', {'value' : '', 'disabled':''}).text('Pilih Kota/Kabupaten dan Kecematan terlebih dahulu!!!'));
					$option_regency.select2();
					$option_district.select2();
					$option_village.select2();
					if($same_address && $same_address.is(':checked')){
						clone_address();
					}
			   }			   
			});
		}
	});
	$('.regency-select').on('change', function(){
		var $parent_address = $(this).parents('div .full-address-field');
		var change_address = true;
		var has_same_address = $parent_address.find('.same-address').length;
		if(has_same_address > 0 && $same_address.is(':checked')){
			change_address = false;
		}
		if(change_address == true){
			$.ajax({ 
			   type: "POST", 
			   url: "index.php?r=employee%2Fget_district_ajax",
			   dataType:'json',
			   data : {'regency_id' : $(this).val()},
			   success: function(dataDistrict){
					var $option_district = $parent_address.find('select.district-select');
					var $option_village = $parent_address.find('select.village-select');
					$option_district.html($('<option />', {'value' : '', 'selected':''}).text('Select...'));
					$.each(dataDistrict, function(index,value) {
						$option_district.append($('<option />', {'value' : value.district_id}).text(value.district_name));
					});
					$option_village.html($('<option />', {'value' : '', 'selected':''}).text('Select...')).append($('<option />', {'value' : '', 'disabled':''}).text('Pilih Kecematan terlebih dahulu!!!'));
					$option_district.select2();
					$option_village.select2();
					if($same_address && $same_address.is(':checked')){
						clone_address();
					}
			   }			   
			});
		}
	});
	$('.district-select').on('change', function(){
		var $parent_address = $(this).parents('div .full-address-field');
		var change_address = true;
		var has_same_address = $parent_address.find('.same-address').length;
		if(has_same_address > 0 && $same_address.is(':checked')){
			change_address = false;
		}
		if(change_address == true){
			$.ajax({ 
			   type: "POST", 
			   url: "index.php?r=employee%2Fget_village_ajax",
			   dataType:'json',
			   data : {'district_id' : $(this).val()},
			   success: function(dataVillage){
					var $option_village = $parent_address.find('select.village-select');
					$option_village.html($('<option />', {'value' : '', 'selected':''}).text('Select...'));
					$.each(dataVillage, function(index,value) {
						$option_village.append($('<option />', {'value' : value.village_id}).text(value.village_name));
					});
					$option_village.select2();
					if($same_address && $same_address.is(':checked')){
						clone_address();
					}
			   }			   
			});
		}
	});
	$('.village-select').on('change', function(){
		var $parent_address = $(this).parents('div .full-address-field');
		var change_address = true;
		var has_same_address = $parent_address.find('.same-address').length;
		if(has_same_address > 0 && $same_address.is(':checked')){
			change_address = false;
		}
		if(change_address == true){
			if($same_address && $same_address.is(':checked')){
				clone_address();
			}
		}
	});
	$('.full-address').on('keyup', function(){
		var $parent_address = $(this).parents('div .full-address-field');
		var change_address = true;
		var has_same_address = $parent_address.find('.same-address').length;
		if(has_same_address > 0 && $same_address.is(':checked')){
			change_address = false;
		}
		if(change_address == true){
			if($same_address && $same_address.is(':checked')){
				var $parent_same_address = $same_address.parents('div .full-address-field');
				var $same_option_full_address = $parent_same_address.find('textarea.full-address');
				$same_option_full_address.val($(this).val());
			}
		}
	});
	/* END OF ADDRESS FIELD */
	if($same_address){
		var $parent_same_address = $same_address.parents('div .full-address-field');
		var $option_province = $parent_same_address.find('select.province-select');
		var $option_regency = $parent_same_address.find('select.regency-select');
		var $option_district = $parent_same_address.find('select.district-select');
		var $option_village = $parent_same_address.find('select.village-select');
		var $option_full_address = $parent_same_address.find('textarea.full-address');
		
		$same_address.on('click', function(){
			if($(this).is(':checked')){
				$option_province.prop("disabled", true);
				$option_regency.prop("disabled", true);
				$option_district.prop("disabled", true);
				$option_village.prop("disabled", true);
				$option_full_address.attr('readonly', true);
				
				clone_address();
			}else{
				$option_province.prop("disabled", false);
				$option_regency.prop("disabled", false);
				$option_district.prop("disabled", false);
				$option_village.prop("disabled", false);
				$option_full_address.attr('readonly', false);
			}
		});
		if($same_address.is(':checked')){
			$option_province.prop("disabled", true);
			$option_regency.prop("disabled", true);
			$option_district.prop("disabled", true);
			$option_village.prop("disabled", true);
			$option_full_address.attr('readonly', true);
		}
	}
	function clone_address(){
		var $parent_same_address = $same_address.parents('div .full-address-field');
		var $same_option_province = $parent_same_address.find('select.province-select');
		var $same_option_regency = $parent_same_address.find('select.regency-select');
		var $same_option_district = $parent_same_address.find('select.district-select');
		var $same_option_village = $parent_same_address.find('select.village-select');
		var $same_option_full_address = $parent_same_address.find('textarea.full-address');
		
		var $parent_main_address = $('.main-address');
		var $main_option_province = $parent_main_address.find('select.province-select');
		var $main_option_regency = $parent_main_address.find('select.regency-select');
		var $main_option_district = $parent_main_address.find('select.district-select');
		var $main_option_village = $parent_main_address.find('select.village-select');
		var $main_option_full_address = $parent_main_address.find('textarea.full-address');
		
		var $options_regency = $main_option_regency.find("option").clone();
		var $options_district = $main_option_district.find("option").clone();
		var $options_village = $main_option_village.find("option").clone();
		
		$same_option_regency.html($options_regency);
		$same_option_district.html($options_district);
		$same_option_village.html($options_village);
		
		$same_option_province.val($main_option_province.val());
		$same_option_regency.val($main_option_regency.val());
		$same_option_district.val($main_option_district.val());
		$same_option_village.val($main_option_village.val());	
		$same_option_full_address.val($main_option_full_address.val());	
		
		$parent_same_address.find('.has-error').removeClass('has-error');
		$parent_same_address.find('.help-block').html('');
		
		$same_option_regency.select2();
		$same_option_district.select2();
		$same_option_village.select2();
		
		$same_option_province.trigger('change');
	};
  $('.nav-sidebar li.has-treeview.active').addClass('menu-open');
  $('.nav-sidebar li.active').children('a').addClass('active');
	
   $(".btn-logout").hover(function(){
	$('.txt-lg').show();
	}, function(){
	$('.txt-lg').hide();
  });
  //**find third lv hidden sidebar**//
  var activeClass = $('body').find('.active-form');
  if(activeClass.hasClass('customer-create')||activeClass.hasClass('customer-update')||activeClass.hasClass('customer-view')){
	$('.master-open').addClass('menu-open');
	$('.master-open').children('a').addClass('active');
	$('.customer-active').addClass('active');
  }else if(activeClass.hasClass('supplier-create')||activeClass.hasClass('supplier-update')||activeClass.hasClass('supplier-view')){
	$('.master-open').addClass('menu-open');
	$('.master-open').children('a').addClass('active');
	$('.supplier-active').addClass('active');
  }else if(activeClass.hasClass('employee-create')||activeClass.hasClass('employee-update')||activeClass.hasClass('employee-view')){
	$('.master-open').addClass('menu-open');
	$('.master-open').children('a').addClass('active');
	$('.employee-active').addClass('active');
  }else if(activeClass.hasClass('item-create')||activeClass.hasClass('item-update')||activeClass.hasClass('item-view')||activeClass.hasClass('item-category-create')||activeClass.hasClass('item-category-update')||activeClass.hasClass('item-category-view')||activeClass.hasClass('sub-item-category-create')||activeClass.hasClass('sub-item-category-update')||activeClass.hasClass('sub-item-category-view')||activeClass.hasClass('unit-create')||activeClass.hasClass('unit-update')||activeClass.hasClass('unit-view')){
	$('.master-open').addClass('menu-open');
	$('.master-open').children('a').addClass('active');
	$('.item-active').addClass('active');
  }else if(activeClass.hasClass('warehouse-create')||activeClass.hasClass('warehouse-update')||activeClass.hasClass('warehouse-view')){
	$('.master-open').addClass('menu-open');
	$('.master-open').children('a').addClass('active');
	$('.warehouse-active').addClass('active');
  }
  else if(activeClass.hasClass('sales-order-create')||activeClass.hasClass('sales-order-update')||activeClass.hasClass('sales-order-view')){
	$('.sales-open').addClass('menu-open');
	$('.sales-open').children('a').addClass('active');
	$('.sales-order-active').addClass('active');
  }else if(activeClass.hasClass('delivery-order-create')||activeClass.hasClass('delivery-order-update')||activeClass.hasClass('delivery-order-view')){
	$('.sales-open').addClass('menu-open');
	$('.sales-open').children('a').addClass('active');
	$('.delivery-order-active').addClass('active');
  }else if(activeClass.hasClass('sales-create')||activeClass.hasClass('sales-update')||activeClass.hasClass('sales-view')){
	$('.sales-open').addClass('menu-open');
	$('.sales-open').children('a').addClass('active');
	$('.sales-active').addClass('active');
  }else if(activeClass.hasClass('sales-payment-create')||activeClass.hasClass('sales-payment-update')||activeClass.hasClass('sales-payment-view')){
	$('.sales-open').addClass('menu-open');
	$('.sales-open').children('a').addClass('active');
	$('.sales-payment-active').addClass('active');
  }else if(activeClass.hasClass('sales-return-create')||activeClass.hasClass('sales-return-update')||activeClass.hasClass('sales-return-view')){
	$('.sales-open').addClass('menu-open');
	$('.sales-open').children('a').addClass('active');
	$('.sales-return-active').addClass('active');
  }
  else if(activeClass.hasClass('purchase-order-create')||activeClass.hasClass('purchase-order-update')||activeClass.hasClass('purchase-order-view')){
	$('.purchase-open').addClass('menu-open');
	$('.purchase-open').children('a').addClass('active');
	$('.purchase-order-active').addClass('active');
  }else if(activeClass.hasClass('purchase-request-create')||activeClass.hasClass('purchase-request-update')||activeClass.hasClass('purchase-request-view')){
	$('.purchase-open').addClass('menu-open');
	$('.purchase-open').children('a').addClass('active');
	$('.purchase-request-active').addClass('active');
  }else if(activeClass.hasClass('order-receipt-create')||activeClass.hasClass('order-receipt-update')||activeClass.hasClass('order-receipt-view')){
	$('.purchase-open').addClass('menu-open');
	$('.purchase-open').children('a').addClass('active');
	$('.order-receipt-active').addClass('active');
  }else if(activeClass.hasClass('purchase-create')||activeClass.hasClass('purchase-update')||activeClass.hasClass('purchase-view')){
	$('.purchase-open').addClass('menu-open');
	$('.purchase-open').children('a').addClass('active');
	$('.purchase-active').addClass('active');
  }else if(activeClass.hasClass('purchase-payment-create')||activeClass.hasClass('purchase-payment-update')||activeClass.hasClass('purchase-payment-view')){
	$('.purchase-open').addClass('menu-open');
	$('.purchase-open').children('a').addClass('active');
	$('.purchase-payment-active').addClass('active');
  }else if(activeClass.hasClass('purchase-return-create')||activeClass.hasClass('purchase-return-update')||activeClass.hasClass('purchase-return-view')){
	$('.purchase-open').addClass('menu-open');
	$('.purchase-open').children('a').addClass('active');
	$('.purchase-return-active').addClass('active');
  }
  
  
  //**end find third lv hidden sidebar**//
  
  //**DATE VALUE**//
	  var dates =[];
	  var i = 0;
	  $( ".datetimepicker-input" ).each(function() {
			dates[i]=$(this).val();
			$(this).val('');
			i++;
	  });
	  //**END DATE VALUE**//
  
  //** DateTimePicker**//
	function setDatePicker(){
	   $(".datepicker").datetimepicker({
		  format: "dddd, D MMMM YYYY",    
		  useCurrent: true ,
		})
	}
	function setDateRangePicker(input1, input2){
		$(input1).datetimepicker({
			format: "YYYY-MM-DD",    
			useCurrent: false  
		})  
		$(input1).on("change.datetimepicker", function (e) {
			$(input2).val("")        
			$(input2).datetimepicker('minDate', e.date);    
		})  
		$(input2).datetimepicker({
			format: "YYYY-MM-DD",
			useCurrent: false  
		})
	}
	function setMonthPicker(){
		$(".monthpicker").datetimepicker({
			format: "MM",
			useCurrent: false,
			viewMode: "months"
		})
	}
	function setYearPicker(){
		$(".yearpicker").datetimepicker({
			format: "YYYY",
			useCurrent: false,
			viewMode: "years"  
		})
	}
	function setYearRangePicker(input1, input2){
		$(input1).datetimepicker({
			format: "YYYY",
			useCurrent: false,
			viewMode: "years"  
		})  
		$(input1).on("change.datetimepicker", function (e) {
			$(input2).val("")
			$(input2).datetimepicker('minDate', e.date);    
		})  
		$(input2).datetimepicker({
			format: "YYYY",
			useCurrent: false,
			viewMode: "years"  
		})
	}
	
	setDatePicker()
	setDateRangePicker(".startdate", ".enddate")
	setMonthPicker()
	setYearPicker()        
	setYearRangePicker(".startyear", ".endyear")
  //** END DateTimePicker**//
  
  //**SET DATE VALUE**//
	var i = 0;
    $( ".datetimepicker-input" ).each(function() {
		$(this).val(dates[i]);
		i++;
    });
	//**END SET DATE VALUE**//
  
  //Bootstrap select
	var feSelect = function(){
		if($(".select").length > 0){
			$(".select").selectpicker();
			
			$(".select").on("change", function(){
				if($(this).val() == "" || null === $(this).val()){
					if(!$(this).attr("multiple"))
						$(this).val("").find("option").removeAttr("selected").prop("selected",false);
				}else{
					$(this).find("option[value="+$(this).val()+"]").attr("selected",true);
				}
			});
		}
	}//END Bootstrap select
	
	
	//Validation Engine
	var feValidation = function(){
		if($("form[id^='validate']").length > 0){
			
			// Validation prefix for custom form elements
			var prefix = "valPref_";
			
			//Add prefix to Bootstrap select plugin
			$("form[id^='validate'] .select").each(function(){
			   $(this).next("div.bootstrap-select").attr("id", prefix + $(this).attr("id")).removeClass("validate[required]");
			});
			
			// Validation Engine init
			$("form[id^='validate']").validationEngine('attach', {promptPosition : "bottomLeft", scroll: false,
				onValidationComplete: function(form, status){
					form.validationEngine("updatePromptsPosition");
				},
				prettySelect : true,
				usePrefix: prefix 
			 });              
		}
	}//END Validation Engine
	
	
	feSelect();
	feValidation();
	//**INPUT MASK**//
	$('[data-mask]').inputmask({
	  definitions: {
		"P": {
		  validator: "[1-9]",
		  cardinality: 1,
		}
	  }
	})
	$('[data-mask-currency]').inputmask('currency', {prefix: 'Rp ', removeMaskOnSubmit: false})
	$('[data-mask-number]').inputmask('numeric')
	$('[data-mask-email]').inputmask('email')
	//**END INPUT MASK**//
	
	// Setup - add a text input to each footer cell
	/*$('.example thead tr').clone(true).appendTo( '.example thead' );
	$('.example thead tr:eq(1) th').each( function (i) {
		var title = $(this).text();
		$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
		$( 'input', this ).on( 'keyup change', function () {
			if ( table.column(i).search() !== this.value ) {
				table
					.column(i)
					.search( this.value )
					.draw();
			}
		} );
	} );
 
	var table = */
	var Table_item =$('.example').DataTable( {
		//orderCellsTop: true,
		//fixedHeader: true,
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": 0
		}],
		order: [[ 1, "asc" ]],
		"info": true,
		"autoWidth": true,
	});
	/*DECLARE TABLE*/
	var dataTableCnfg = [];
	if($('body').find('#dataTable-employee').length){
		dataTableCnfg.push({'id_table':'#dataTable-employee', 'target_column':[0, 7]});
	}
	if($('body').find('#dataTable-customer').length){
		dataTableCnfg.push({'id_table':'#dataTable-customer', 'target_column':[0, 5]});
	}
	if($('body').find('#dataTable-supplier').length){
		dataTableCnfg.push({'id_table':'#dataTable-supplier', 'target_column':[0, 7]});
	}
	if($('body').find('#dataTable-item').length){
		dataTableCnfg.push({'id_table':'#dataTable-item', 'target_column':[0, 8]});
	}
	if($('body').find('#dataTable-subItem').length){
		dataTableCnfg.push({'id_table':'#dataTable-subItem', 'target_column':[0, 4]});
	}
	if($('body').find('#dataTable-categoryItem').length){
		dataTableCnfg.push({'id_table':'#dataTable-categoryItem', 'target_column':[0, 3]});
	}
	if($('body').find('#dataTable-unit').length){
		dataTableCnfg.push({'id_table':'#dataTable-unit', 'target_column':[0, 3]});
	}
	if($('body').find('#dataTable-warehouse').length){
		dataTableCnfg.push({'id_table':'#dataTable-warehouse', 'target_column':[0, 4]});
	}
	if($('body').find('#dataTable-voucher').length){
		dataTableCnfg.push({'id_table':'#dataTable-voucher', 'target_column':[0, 8]});
	}
	if($('body').find('#dataTable-so').length){
		dataTableCnfg.push({'id_table':'#dataTable-so', 'target_column':[0, 6]});
	}
	if($('body').find('#dataTable-do').length){
		dataTableCnfg.push({'id_table':'#dataTable-do', 'target_column':[0, 6]});
	}
	if($('body').find('#dataTable-sales').length){
		dataTableCnfg.push({'id_table':'#dataTable-sales', 'target_column':[0, 6]});
	}
	if($('body').find('#dataTable-pr').length){
		dataTableCnfg.push({'id_table':'#dataTable-pr', 'target_column':[0, 5]});
	}
	if($('body').find('#dataTable-po').length){
		dataTableCnfg.push({'id_table':'#dataTable-po', 'target_column':[0, 5]});
	}
	if($('body').find('#dataTable-or').length){
		dataTableCnfg.push({'id_table':'#dataTable-or', 'target_column':[0, 5]});
	}
	if($('body').find('#dataTable-purchase').length){
		dataTableCnfg.push({'id_table':'#dataTable-purchase', 'target_column':[0, 5]});
	}
	if($('body').find('#dataTable-salesPayment').length){
		dataTableCnfg.push({'id_table':'#dataTable-salesPayment', 'target_column':[0, 5]});
	}
	if($('body').find('#dataTable-purchasePayment').length){
		dataTableCnfg.push({'id_table':'#dataTable-purchasePayment', 'target_column':[0, 5]});
	}

	if(dataTableCnfg)
		cerate_dataTable_index(dataTableCnfg);
	/*END OF DECLARE TABLE*/
	
	/*var parent = document.getElementById('DataTables_Table_0');

	console.log(parent);
	var observer = new MutationObserver(function(mutations) {
	  mutations.forEach(function(mutation) {
		alert(mutation); // check if your son is the one removed
	  });
	});

	// configuration of the observer:
	var config = {
	  childList: true
	};

	observer.observe(parent, config);*/
	
    $('.select2').select2();
	$(".custom-select").select2({
		minimumResultsForSearch: -1
	});
	var instance;
	$(document).on('keyup', '.select2-search__field', function ()
	{
		var select = $("#"+$(this).parents(".select2-dropdown.select2-dropdown--below").find(".select2-results ul").attr("id"))
		customizeDropdownScrollbar(select);
	});

	// add a custom scrollbar to the drop down when the drop down is opened
	$('select').on('select2:open', function ()
	{
		var select = $("#select2-"+this.id+"-results");
		customizeDropdownScrollbar(select);
	});

	// the customized scrollbar is added when the drop down is opened or there is an input
	function customizeDropdownScrollbar(select)
	{
		setTimeout(function ()
		{
			// count the number of elements which can be used for selection in the drop down
			var count = select.find("li").length;
			var last_position = Array.prototype.slice.call(select.children('li'));
			var position_y = last_position.indexOf(select.find('li.select2-results__option--highlighted')[0]);
			// check if a previous instance of the customized scrollbar already exists
			if (typeof instance !== 'undefined' && count > 1)
			{
				instance.destroy();
				
			}

			// assign a scrollbar to a different element according to the number of available elements
			// trick to fix the customization of the scrollbar when there is one or zero element to select
			if (count > 1)
			{
				// create and store the instance reference for future destruction
				instance = select.overlayScrollbars(
				{
					className: "os-theme-dark",
					resize: "none",
					scrollbars :
					{
						visibility: "visible",
						autoHide: "never",
					},
				}).overlayScrollbars();
				instance.scroll({x: 0, y :  position_y*31.15}, 200);
			}
			else
			{
				// assign the scrollbar to an higher level in the hierarchy of the drop down
				$('.select2-dropdown select2-dropdown--below').overlayScrollbars(
				{
					className: "os-theme-dark",
					resize: "none",
					scrollbars :
					{
						visibility: "visible",
						autoHide: "never",
					},
				}).overlayScrollbars();
			}
		}, 0);
	}
	$('input.file[type=file]').each( function (i){
		if($(this).hasClass('image-file')){
			if($(this).data('image') !== undefined && $(this).data('image') !== ""){
				var $inputFile = $(this);
				var url = $inputFile.data('url') + $inputFile.data('image');
				$inputFile.fileinput({
					initialPreview: '../'+url,
					initialPreviewAsData: true,
					initialPreviewConfig: [
						{caption: $inputFile.data('image'),showRemove: false}
					],
					previewFileType: "image",
					allowedFileExtensions: ['png', 'jpeg', 'jpg'],
					overwriteInitial: true,
					browseClass: "btn btn-primer",
					browseLabel: "&nbsp Pilih Foto...",
					browseIcon: "<i class=\"fas fa-images\"></i> ",
					removeLabel: "&nbsp hapus...",
					removeIcon: "<i class=\"far fa-trash-alt\"></i> ",
					initialCaption: $inputFile.data('image'),
					
					slugCallback: function (filename) {
						return filename.replace('(', '_').replace(']', '_');
					}
				}).on('filecleared',function(event, id, index) {
					$inputFile.fileinput('destroy');
					$inputFile.fileinput({
						initialPreview: '../'+url,
						initialPreviewAsData: true,
						initialPreviewConfig: [
							{caption: $inputFile.data('image'),showRemove: false}
						],
						previewFileType: "image",
						allowedFileExtensions: ['png', 'jpeg', 'jpg'],
						overwriteInitial: true,
						browseClass: "btn btn-primer",
						browseLabel: "&nbsp Pilih Foto...",
						browseIcon: "<i class=\"fas fa-images\"></i> ",
						removeLabel: "&nbsp hapus...",
						removeIcon: "<i class=\"far fa-trash-alt\"></i> ",
						initialCaption: $inputFile.data('image'),
						
						slugCallback: function (filename) {
							return filename.replace('(', '_').replace(']', '_');
						}
					});
				});
			}
			else{
				$(this).fileinput({
					previewFileType: "image",
					allowedFileExtensions: ['png', 'jpeg', 'jpg'],
					overwriteInitial: false,
					browseClass: "btn btn-primer",
					browseLabel: "&nbsp Pilih Foto...",
					browseIcon: "<i class=\"fas fa-images\"></i> ",
					removeLabel: "&nbsp hapus...",
					removeIcon: "<i class=\"far fa-trash-alt\"></i> ",
					
					slugCallback: function (filename) {
						return filename.replace('(', '_').replace(']', '_');
					}
				});
			}
		}
		else if($(this).hasClass('image-file-view')){
			if($(this).data('url') !== undefined && $(this).data('url') !== ""){
				var $inputFile = $(this);
				var url = $inputFile.data('url').split("|");
				var image = $inputFile.data('image').split("|");
				var captions = [];
				$.each(image, function(i,v){
						captions.push({caption: v,showRemove: false,showDrag: false});
				});
				$inputFile.fileinput({
					initialPreview: url,
					initialPreviewAsData: true,
					initialPreviewConfig: captions,
					previewFileType: "image",
					allowedFileExtensions: ['png', 'jpeg', 'jpg'],
					overwriteInitial: true,
					browseClass: "btn btn-primer",
					browseLabel: "&nbsp Pilih Foto...",
					browseIcon: "<i class=\"fas fa-images\"></i> ",
					removeLabel: "&nbsp hapus...",
					removeIcon: "<i class=\"far fa-trash-alt\"></i> ",
					initialCaption: $inputFile.data('image'),
					
					slugCallback: function (filename) {
						return filename.replace('(', '_').replace(']', '_');
					}
				});
				var $captionWrap = $(this).parents('div').eq(2);
				$captionWrap.hide();
			}
		}
	});
	
});