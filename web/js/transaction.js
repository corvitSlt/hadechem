function loader(i=0){
	if(i==0){
		if($(".content-wrapper .content .preloader").hasClass("open-load")){
			if($(".postloader").hasClass("close-load")){
				$(".postloader").removeClass("close-load");
				$(".postloader").addClass("open-load");
			}
			$(".content-wrapper .content .preloader").removeClass("open-load");
			$(".content-wrapper .content .preloader").addClass("close-load")
		}
	}
	if(i==1){
		if($(".content-wrapper .content .card-body.postloader-card-body").hasClass("close-load")){
			$(".card-body.postloader-card-body").removeClass("close-load");
			$(".card-body.postloader-card-body").addClass("open-load");
			$(".content-wrapper .content .card-body.preloader-card-body").removeClass("open-load");
			$(".content-wrapper .content .card-body.preloader-card-body").addClass("close-load")
		}
		else if($(".content-wrapper .content .card-body.postloader-card-body").hasClass("open-load")){
			$(".card-body.postloader-card-body").removeClass("open-load");
			$(".card-body.postloader-card-body").addClass("close-load");
			$(".content-wrapper .content .card-body.preloader-card-body").removeClass("close-load");
			$(".content-wrapper .content .card-body.preloader-card-body").addClass("open-load")
		}
	}
}

var variables = [];

function set_variable(val){
	variables = val;
}
function compare(a, b) {
  if (a.date > b.date) return 1;
  if (b.date > a.date) return -1;

  return 0;
}
function list_modal(data, modal_name){
	var tables = "";
	
	var thead = "<thead>";
	var tfoot = "<tfoot>";
	var tbody = "<tbody>";
	
	if(modal_name == "items"){
		tables = "<table id='modal-table-items' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID Barang</th>";
		thead += "<th>Nama Barang</th>";
		thead += "<th>Stock</th>";
		thead += "<th>Harga</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID Barang</th>";
		tfoot += "<th>Nama Barang</th>";
		tfoot += "<th>Stock</th>";
		tfoot += "<th>Harga</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(\"" + value.item_id + "\",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.item_id + "</td>";
			tbody += "<td>" + value.item_name + "</td>";
			tbody += "<td>" + value.total_stock + "</td>";
			tbody += "<td data-mask-currency-rp=''>" + value.price + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#items-list").html(tables);
	}
	else if(modal_name == 'customers'){
		tables = "<table id='modal-table-customers' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID Pelanggan</th>";
		thead += "<th>Nama Pelanggan</th>";
		thead += "<th>Alamat</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID Pelanggan</th>";
		tfoot += "<th>Nama Pelanggan</th>";
		tfoot += "<th>Alamat</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.customer_id + "</td>";
			tbody += "<td>" + value.customer_name + "</td>";
			tbody += "<td>" + value.address + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#customers-list").html(tables);
	}else if(modal_name == 'suppliers'){
		tables = "<table id='modal-table-suppliers' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID Supplier</th>";
		thead += "<th>Nama Supplier</th>";
		thead += "<th>Alamat</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID Supplier</th>";
		tfoot += "<th>Nama Supplier</th>";
		tfoot += "<th>Alamat</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.supplier_id + "</td>";
			tbody += "<td>" + value.supplier_name + "</td>";
			tbody += "<td>" + value.address + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#suppliers-list").html(tables);
	}else if(modal_name == 'salesman'){
		tables = "<table id='modal-table-salesman' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID Sales</th>";
		thead += "<th>Nama Sales</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID Sales</th>";
		tfoot += "<th>Nama Sales</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.employee_id + "</td>";
			tbody += "<td>" + value.employee_name + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#salesman-list").html(tables);
	}else if(modal_name == 'so'){
		tables = "<table id='modal-table-so' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID SO</th>";
		thead += "<th>Pelanggan</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID SO</th>";
		tfoot += "<th>Pelanggan</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(\"" + value.so_id + "\",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.so_id + "</td>";
			tbody += "<td>" + value.customer.customer_name + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#so-list").html(tables);
	}else if(modal_name == 'do'){
		tables = "<table id='modal-table-do' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID DO</th>";
		thead += "<th>Pelanggan</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID DO</th>";
		tfoot += "<th>Pelanggan</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.delivery_order_id + "</td>";
			tbody += "<td>" + value.so.customer.customer_name + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#do-list").html(tables);
	}else if(modal_name == 'sales'){
		tables = "<table id='modal-table-sales' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>No Nota Penjualan</th>";
		thead += "<th>Tanggal</th>";
		thead += "<th>Total</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>No Nota Penjualan</th>";
		tfoot += "<th>Tanggal</th>";
		tfoot += "<th>Total</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.sales_id + "</td>";
			tbody += "<td>" + value.date + "</td>";
			tbody += "<td>" + value.total + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#sales-list").html(tables);
	}else if(modal_name == 'pr'){
		tables = "<table id='modal-table-pr' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID PR</th>";
		thead += "<th>Supplier</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID PR</th>";
		tfoot += "<th>Supplier</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.pr_id + "</td>";
			tbody += "<td>" + value.supplier.supplier_name + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#pr-list").html(tables);
	}else if(modal_name == 'po'){
		tables = "<table id='modal-table-po' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID PO</th>";
		thead += "<th>Supplier</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID PO</th>";
		tfoot += "<th>Supplier</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.pr_id + "</td>";
			tbody += "<td>" + value.supplier.supplier_name + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#po-list").html(tables);
	}else if(modal_name == 'purchasefrom'){
		
		data.sort(compare);
		tables = "<table id='modal-table-purchasefrom' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";    
		thead += "<th class='th-number'>No</th>";
		thead += "<th>ID PO/OR</th>";
		thead += "<th>Supplier</th>";
		thead += "<th>Dari</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>ID PO/OR</th>";
		tfoot += "<th>Supplier</th>";
		tfoot += "<th>Dari</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		$.each(data, function(index,value) {
			var type = 'or';
			if(value.po_id)
				type = 'po';
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + type + "\")'>";
			tbody += "<td class='tb-number'></td>";
			if(type == 'po')
				tbody += "<td>" + value.po_id + "</td>";
			else
				tbody += "<td>" + value.or_id + "</td>";
			tbody += "<td>" + value.supplier.supplier_name + "</td>";
			if(type == 'or')
				tbody += "<td>Penerimaan Barang</td>";
			else
				tbody += "<td>Pembelian Tunai</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#purchasefrom-list").html(tables);
	}else if(modal_name == 'purchase'){
		tables = "<table id='modal-table-purchase' class='table table-bordered table-striped modal-table' style='width:100%'>";
		thead += "<tr>";
		thead += "<th class='th-number'>No</th>";
		thead += "<th>No Nota Pembelian</th>";
		thead += "<th>Tanggal</th>";
		thead += "<th>Total</th>";
		thead += "</tr>";
		thead += "</thead>";
		
		tfoot += "<tr>";
		tfoot += "<th>No</th>";
		tfoot += "<th>No Nota Pembelian</th>";
		tfoot += "<th>Tanggal</th>";
		tfoot += "<th>Total</th>";
		tfoot += "</tr>";
		tfoot += "</tfoot>";
		
		$.each(data, function(index,value) {
			tbody += "<tr onClick='pickModalRow(" + JSON.stringify(value) + ",\"" + modal_name + "\")'>";
			tbody += "<td class='tb-number'></td>";
			tbody += "<td>" + value.purchase_id + "</td>";
			tbody += "<td>" + value.date + "</td>";
			tbody += "<td>" + value.total + "</td>";
			tbody += "</tr>";
		});
		
		tbody += "</tbody>";
		tables += thead;
		tables += tbody;
		tables += tfoot;
		tables += "</table>";
		$("#purchase-list").html(tables);
	}
}
function onkeyup_colfield_check(e,tag){
	if(e.keyCode === 13 || e.keyCode === 'Enter'){
		if($(tag).val()==variables.input_buffer){
			if($(tag).hasClass('trans-id'))
				if($(tag).hasClass('trans-id-new')){
					if(variables.trans_form == 'create-sales-payment' || variables.trans_form == 'create-purchase-payment')
						alertBox("No Nota tidak boleh kosong!!!")
					else
						alertBox("Barang tidak boleh kosong!!!")
				}
				else
					$(tag).parents('tr.trans-row-table').find('.trans-qty').focus();
			else if($(tag).hasClass('trans-qty'))
				if(variables.chose_auto == true)
					variables.chose_auto = false;
				else
					$(tag).parents('tr.trans-row-table').find('.trans-price').focus();
			else if($(tag).hasClass('trans-price'))
				$('.trans-id-new').focus();
		}
		else{
			if($(tag).hasClass('trans-id'))
				focus_id("out",tag);
			else if($(tag).hasClass('trans-qty'))
				if(variables.chose_auto == true)
					variables.chose_auto = false;
				else
					$(tag).parents('tr.trans-row-table').find('.trans-price').focus();
			else if($(tag).hasClass('trans-price'))
				$('.trans-id-new').focus();
		}
	}
}

function onkeydown_colfield_check(e,tag){
	if(e.keyCode === 'up' || e.keyCode === 'down' || e.keyCode === 40 || e.keyCode === 38){
		if($(tag).hasClass('trans-id')){
			//alert(variables.input_buffer + " - " + $(tag).hasClass('trans-id').val());
			variables.chose_auto = true;
		}
	}
}
function row_selected(tag){
	variables.body_click = false;
	if($(tag).parents('tr.trans-row-table').hasClass('tr-selected')){
		$(tag).parents('tr.trans-row-table').removeClass('tr-selected');
		if(variables.selected_row)
			$(variables.selected_row).parents('tr.trans-row-table').removeClass('tr-selected');
		for(i = $(tag).parents('tr').index(); i < variables.row-1; i++){
			var s = i+1;
			$.each(variables.attribute, function(t,value){
				$('tbody.tbody-trans').find('tr:eq('+ i +')').find('.' + value.class_name).val($('tbody.tbody-trans').find('tr:eq('+ s +')').find('.' + value.class_name).val());
			})
		}
		$('tbody.tbody-trans').find('tr:eq('+ variables.row +')').remove();
		variables.row--;
		$('tbody.tbody-trans').find('tr:eq('+ variables.row +')').remove();
		if(variables.add_row_afRemove)
			add_row();
		calc();
		variables.selected_row = '';
		variables.body_click = true;
	}
	else{
		$(tag).parents('tr.trans-row-table').addClass('tr-selected');
		if(variables.selected_row)
			$(variables.selected_row).parents('tr.trans-row-table').removeClass('tr-selected');
		variables.selected_row = tag;
	}
}
//AUTOCOMPLETE//
function auto_input(){
	$('.trans-id').autocomplete({
		minLength: 0,
		source: variables.autofills,
		focus: function (event, ui) {
			$(this).val(ui.item.item_id);
			return false;
		},
		select: function (event, ui) {
			$(this).val(ui.item.item_id);
			focus_id("out",this);
			return false;
		}
	})
};
//EOF AUTOCOMPLETE//

function focus_id(con,tag){
	if(tag===false)
		tag = variables.tag_row;
	if(con == "out"){
		variables.id_onfocus = false;
		if($(tag).parent('div').hasClass('on-focus')&&variables.id_btn_onover==false){
			$(tag).parent('div').removeClass('on-focus');
		}
		if($(tag).val()!=""){
			if($(tag).val()!=variables.input_buffer){
				if($(tag).hasClass('trans-id')){
					change_id(tag);
				}
			}
		}
		else
			$(tag).val(variables.input_buffer);
	}
	else{
		if(variables.id_onfocus!=true){
			variables.tag_row = tag;
			variables.id_onfocus = true;
			if($(tag).hasClass('trans-id'))
				if(!$(tag).parent('div').hasClass('on-focus'))
					$(tag).parent('div').addClass('on-focus');
			variables.input_buffer = $(tag).val();
		}
	};
}
function block_text(tag){
	$(tag).select();
}
function btn_hover(con,tag){
	if(con == "out"){
		variables.id_btn_onover = false;
		if($(tag).parents('.input-group').hasClass('on-focus')&&variables.id_onfocus==false){
			$(tag).parents('.input-group').removeClass('on-focus');
		}
	}
	else{
		variables.id_btn_onover = true;
	};
}
//INPUT ID ON CHANGE//
function change_id(tag){
	//alert($(tag).val());
	if($(tag).val()!=""){
		var have_item = false;
		var item = [];
		if(variables.trans_form == 'create-sales-payment'){
			$.each(variables.sales, function(index,value) {
				if(value.sales_id.includes($(tag).val())||value.date.includes($(tag).val())){
					have_item = true;
					item = value;
					return false;
				}
			});
		}else if(variables.trans_form == 'create-purchase-payment'){
			$.each(variables.purchase, function(index,value) {
				if(value.purchase_id.includes($(tag).val())||value.date.includes($(tag).val())){
					have_item = true;
					item = value;
					return false;
				}
			});
		}
		else{
			$.each(variables.items, function(index,value) {
				if(value.item_id.includes($(tag).val())||value.item_name.includes($(tag).val())){
					have_item = true;
					item = value;
					return false;
				}
			});
		}
		if(have_item == true)
			create_row(tag,item);
		else{
			$(tag).val(variables.input_buffer);
			alertBox("Barang Tidak Ditemukan");
		}
	}
};
//EOV INPUT ID ON CHANGE//

//PICK ITEM ID//

function pickModalRow(id, modal){
	if(modal=="items"){
		$(variables.tag_row).val(id);
		$('#modal-list-items').modal('toggle');
		change_id(variables.tag_row);
	}
	else if(modal=="customers"){
		if($(".customer-id").val()!=id.customer_id){
			var det_text = "<strong><u>" + id.customer_name.toUpperCase() + "</u></strong></br>";
			det_text += "Alamat: " + id.address;
			$(".customer-id").val(id.customer_id);
			$("#address-field").html(det_text);
			if(variables.trans_form == 'create-sales-payment'){
				$.ajax({ 
				   type: "POST", 
				   url: "index.php?r=sales%2Fget_sales_ajax",
				   dataType:'json',
				   data: {customer_id : id.customer_id},
				   success: function(dataSales){
					   
					   $('tbody.tbody-trans').html('');
					   variables.row = $('.tbody-trans tr').length;
					   
					   variables.sales = dataSales;
					   variables.autofills = [];
					   $.each(dataSales, function(index,value) {
							variables.autofills.push({
								label : value.sales_id + " " + value.date,
								item_id : value.sales_id,
							});
						});
					   
					   add_row();
					   auto_input();
					   list_modal(dataSales, 'sales');
					   
						cerate_dataTable_index([{'id_table':'#modal-table-sales', 'target_column':[0]}]);
							
						$(".custom-select").select2({
							minimumResultsForSearch: -1
						});
				   }			   
				});
			}
		}
		$('#modal-list-customers').modal('toggle');
	}
	else if(modal=="suppliers"){
		if($(".supplier-id").val()!=id.supplier_id){
			var det_text = "<strong><u>" + id.supplier_name.toUpperCase() + "</u></strong></br>";
			det_text += "Alamat: " + id.address;
			$(".supplier-id").val(id.supplier_id);
			$("#address-field").html(det_text);
			if(variables.trans_form == 'create-purchase-payment'){
				$.ajax({ 
				   type: "POST", 
				   url: "index.php?r=purchase%2Fget_purchase_ajax",
				   dataType:'json',
				   data: {supplier_id : id.supplier_id},
				   success: function(dataPurchase){
					   
					   $('tbody.tbody-trans').html('');
					   variables.row = $('.tbody-trans tr').length;
					   
					   variables.purchase = dataPurchase;
					   variables.autofills = [];
					   $.each(dataPurchase, function(index,value) {
							variables.autofills.push({
								label : value.purchase_id + " " + value.date,
								item_id : value.purchase_id,
							});
						});
					   
					   add_row();
					   auto_input();
					   list_modal(dataPurchase, 'purchase');
					   
						cerate_dataTable_index([{'id_table':'#modal-table-purchase', 'target_column':[0]}]);
							
						$(".custom-select").select2({
							minimumResultsForSearch: -1
						});
				   }			   
				});
			}
		}
		$('#modal-list-suppliers').modal('toggle');
	}
	else if(modal=="salesman"){
		$(".sales-id").val(id.employee_id);
		$('#modal-list-salesman').modal('toggle');
	}
	else if(modal=="so"){
		$.ajax({ 
		   type: "POST", 
		   url: "index.php?r=sales-order%2Fget_detail_so_ajax",
		   dataType:'json',
		   data: {so_id : id},
		   success: function(dataDetailSO){
			   $('tbody.tbody-trans').html('');
			   variables.row = $('.tbody-trans tr').length;
			   $(".so-id").val(id);
			   update_content(dataDetailSO);
			    $(".select-content-trans").select2({
					minimumResultsForSearch: -1
				});
			   $('#modal-list-so').modal('toggle');
		   }			   
		});
	}
	else if(modal=="do"){
		$.ajax({ 
		   type: "POST", 
		   url: "index.php?r=delivery-order%2Fget_detail_do_ajax",
		   dataType:'json',
		   data: {delivery_order_id : id.delivery_order_id, so_id : id.so_id},
		   success: function(dataDetailDO){
			   //$('body').html(JSON.stringify(dataDetailDO));
			   $('tbody.tbody-trans').html('');
			   variables.row = $('.tbody-trans tr').length;
			   $(".do-id").val(id.delivery_order_id);
			   
			   var det_text = "<strong><u>" + id.so.customer.customer_name.toUpperCase() + "</u></strong></br>";
				det_text += "Alamat: " + id.so.customer.address;
				$(".customer-id").val(id.so.customer.customer_id);
				$("#address-field").html(det_text);
				
			   update_content(dataDetailDO);
			   $('#modal-list-do').modal('toggle');
		   }			   
		});
	}
	if(modal=="sales"){
		$(variables.tag_row).val(id.sales_id);
		$('#modal-list-sales').modal('toggle');
		change_id(variables.tag_row);
	}
	else if(modal=="pr"){
		$.ajax({ 
		   type: "POST", 
		   url: "index.php?r=purchase-request%2Fget_detail_pr_ajax",
		   dataType:'json',
		   data: {pr_id : id.pr_id},
		   success: function(dataDetailPR){
			   $('tbody.tbody-trans').html('');
			   variables.row = $('.tbody-trans tr').length;
			   $(".pr-id").val(id.pr_id);
			   
			   var det_text = "<strong><u>" + id.supplier.supplier_name.toUpperCase() + "</u></strong></br>";
				det_text += "Alamat: " + id.supplier.address;
				$(".supplier-id").val(id.supplier.supplier_id);
				$("#address-field").html(det_text);
			   update_content(dataDetailPR);
			   $('#modal-list-pr').modal('toggle');
		   }			   
		});
	}
	else if(modal=="po"){
		$.ajax({ 
		   type: "POST", 
		   url: "index.php?r=purchase-order%2Fget_detail_po_ajax",
		   dataType:'json',
		   data: {po_id : id.po_id},
		   success: function(dataDetailPO){
			   //$('body').html(JSON.stringify(dataDetailDO));
			   $('tbody.tbody-trans').html('');
			   variables.row = $('.tbody-trans tr').length;
			   $(".po-id").val(id.po_id);
			   
			   var det_text = "<strong><u>" + id.supplier.supplier_name.toUpperCase() + "</u></strong></br>";
				det_text += "Alamat: " + id.supplier.address;
				$(".supplier-id").val(id.supplier.supplier_id);
				$("#address-field").html(det_text);
				
			   update_content(dataDetailPO);
			   $(".select-content-trans").select2({
					minimumResultsForSearch: -1
				});
			   $('#modal-list-po').modal('toggle');
		   }			   
		});
	}
	else if(modal=="purchasefromor"){
		$.ajax({ 
		   type: "POST", 
		   url: "index.php?r=purchase-request%2Fget_detail_or_ajax",
		   dataType:'json',
		   data: {or_id : id.or_id},
		   success: function(dataDetailOR){
			   $('tbody.tbody-trans').html('');
			   variables.row = $('.tbody-trans tr').length;
			   $(".trans-id").val(id.or_id);
			   
			   var det_text = "<strong><u>" + id.supplier.supplier_name.toUpperCase() + "</u></strong></br>";
				det_text += "Alamat: " + id.supplier.address;
				$(".supplier-id").val(id.supplier.supplier_id);
				$("#address-field").html(det_text);
			   update_content(dataDetailOR);
			   $('#modal-list-purchasefrom').modal('toggle');
		   }			   
		});
	}
	else if(modal=="purchasefrompo"){
		$.ajax({ 
		   type: "POST", 
		   url: "index.php?r=purchase-order%2Fget_detail_po_ajax",
		   dataType:'json',
		   data: {po_id : id.po_id},
		   success: function(dataDetailPO){
			   //alert(JSON.stringify(dataDetailPO));
			   $('tbody.tbody-trans').html('');
			   variables.row = $('.tbody-trans tr').length;
			   $(".trans-id").val(id.po_id);
			   $(".supplier-invoice").val(id.supplier_invoice);
			   
			   var det_text = "<strong><u>" + id.supplier.supplier_name.toUpperCase() + "</u></strong></br>";
				det_text += "Alamat: " + id.supplier.address;
				$(".supplier-id").val(id.supplier.supplier_id);
				$("#address-field").html(det_text);
			   update_content(dataDetailPO);
			   $('#modal-list-purchasefrom').modal('toggle');
		   }			   
		});
	}if(modal=="purchase"){
		$(variables.tag_row).val(id.purchase_id);
		$('#modal-list-purchase').modal('toggle');
		change_id(variables.tag_row);
	}

}

//EOF PICK ITEM ID//

//CALCULATE PRICE//
function calc(){
	
	var sum_total = 0;
	var buff_subTotal = 1;
	var buff_subTotalClass = "";
	$.each($('tbody.tbody-trans').find('tr.trans-row-table'), function(index,value) {
		if(!$(value).find('.trans-id').hasClass('trans-id-new')){
			$.each(variables.attribute, function(i,val){
				if(variables.trans_form == 'create-sales-payment'||variables.trans_form == 'create-purchase-payment'){
					if(val.calc_attr==2){
						buff_subTotal = parseFloat($(value).find('.' + val.class_name).val().replace(/[^0-9.-]+/g,""));
						buff_subTotalClass = '.' + val.class_name;
					}
				}
				else{
					if(val.calc_attr == 1)
						buff_subTotal *= parseFloat($(value).find('.' + val.class_name).val().replace(/[^0-9.-]+/g,""));
					if(val.calc_attr==2)
						buff_subTotalClass = '.' + val.class_name;
					}
			});
			$(value).find(buff_subTotalClass).val(buff_subTotal);
			sum_total += buff_subTotal;
			buff_subTotal = 1;
			buff_subTotalClass = "";
		}
	});
	$(".total").val(sum_total);
	if($('.trans-form').find('.grandtotal').length>0){
		if($('.trans-form').hasClass('sales-order-form')){
			if($('.voucher_id').val()){
				
			}else{
				$('.grandtotal').val($('.total').val());
			}
		}
		//$('.grandtotal').val(parseFloat($('.total').val().replace(/[^0-9.-]+/g,""))-(parseFloat($('.discount').val().replace(/[^0-9.-]+/g,""))/100*parseFloat($('.total').val().replace(/[^0-9.-]+/g,""))));
	}
	
}
//EOF CALCULATE PRICE//

//SET INPUT VALUE//
function set_trans_value(tag_parents,val){
	$.each(variables.attribute, function(index,value) {
		if(value.class_name == "trans-id"){
			if(variables.trans_form == 'create-sales-payment')
				tag_parents.find('.trans-id').val(val.sales_id);
			else if(variables.trans_form == 'create-purchase-payment')
				tag_parents.find('.trans-id').val(val.purchase_id);
			else
				tag_parents.find('.trans-id').val(val.item_id);
		}
		else if(value.class_name == "trans-name"){
			tag_parents.find('.trans-name').val(val.item_name);
		}
		else if(value.class_name == "trans-unit"){
			tag_parents.find('.trans-unit').val(val.unit.unit_name);
		}
		else if(value.class_name == "trans-qty"){
			tag_parents.find('.trans-qty').val(1);
		}
		else if(value.class_name == "trans-price"){
			tag_parents.find('.trans-price').val(val.price);
		}
		else if(value.class_name == "trans-sub-total"){
			if(variables.trans_form == 'create-sales-payment'||variables.trans_form == 'create-purchase-payment')
				tag_parents.find('.trans-sub-total').val(val.grandtotal);
			else
				tag_parents.find('.trans-sub-total').val(val.price);
		}
		else if(value.class_name == "trans-date"){
			tag_parents.find('.trans-date').val(val.date);
		}
	});
}
//EOF SET INPUT VALUE//
//SUBMIT TRANSACTION FORM//
function submitForm(){
	var trigger_submit = true;
	var print_out = false;
	var message_text = '';
	if(variables.trans_form == 'create-so'){
		if(!$(".sales-id").val()){
			message_text += "<li>Sales tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if(!$(".customer-id").val()){
			message_text += "<li>Pelanggan tidak boleh kosong!!!</li>"
			trigger_submit = false;
		}
		if($('.tbody-trans tr').length<=1){
			message_text += "<li>Barang tidak boleh kosong!!!</li>"
			trigger_submit = false;
		}
		if($('.tbody-trans tr').length>1){
			$.each($('tbody.tbody-trans').find('tr.trans-row-table'), function(index,value) {
					if(!$(value).find('.trans-id').hasClass('trans-id-new')){
						if($(value).find('.trans-qty').val()<=0){
							message_text += "<li>Jumlah barang \"" + $(value).find('.trans-id').val() + "\" tidak boleh kurang atau sama dengan 0!!!</li>"
							trigger_submit = false;
						}
					}
			});
		}
		print_out = true;
	}
	if(variables.trans_form == 'create-do'){
		if(!$(".so-id").val()){
			message_text += "<li>No SO tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if(!$(".shipper").val()){
			message_text += "<li>Nama pengirim tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if(!$(".transportation-type").val()){
			message_text += "<li>Tipe kendaraan tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if(!$(".vehicle-number").val()){
			message_text += "<li>No kendaraan tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if($('.tbody-trans tr').length<=1){
			message_text += "<li>Barang tidak boleh kosong!!!</li>"
			trigger_submit = false;
		}
		if($('.tbody-trans tr').length>1){
			$.each($('tbody.tbody-trans').find('tr.trans-row-table'), function(index,value) {
					if(!$(value).find('.trans-id').hasClass('trans-id-new')){
						if($(value).find('.trans-qty').val()<=0){
							message_text += "<li>Jumlah barang \"" + $(value).find('.trans-id').val() + "\" tidak boleh kurang atau sama dengan 0!!!</li>"
							trigger_submit = false;
						}
					}
			});
		}
		print_out = true;
	}
	if(variables.trans_form == 'create-sales'){
		if(!$(".do-id").val()){
			message_text += "<li>No pengiriman tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if(!$(".due-date").val()){
			message_text += "<li>Tempo nota tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		print_out = true;
	}
	if(variables.trans_form == 'create-sales-payment'){
		if(!$(".customer-id").val()){
			message_text += "<li>Pelanggan tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}else{
			if($('.tbody-trans tr').length<=1){
				message_text += "<li>Item transaksi tidak boleh kosong!!!</li>"
				trigger_submit = false;
			}
		}
		print_out = true;
	}
	
	if(variables.trans_form == 'create-pr'){
		if(!$(".supplier-id").val()){
			message_text += "<li>Supplier tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if($('.tbody-trans tr').length<=1){
			message_text += "<li>Barang tidak boleh kosong!!!</li>"
			trigger_submit = false;
		}
		if($('.tbody-trans tr').length>1){
			$.each($('tbody.tbody-trans').find('tr.trans-row-table'), function(index,value) {
					if(!$(value).find('.trans-id').hasClass('trans-id-new')){
						if($(value).find('.trans-qty').val()<=0){
							message_text += "<li>Jumlah barang \"" + $(value).find('.trans-id').val() + "\" tidak boleh kurang atau sama dengan 0!!!</li>"
							trigger_submit = false;
						}
					}
			});
		}
		print_out = true;
	}
	if(variables.trans_form == 'create-po'){
		if(!$(".pr-id").val()){
			message_text += "<li>Permintaan pembelian tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}else{
			if($('.tbody-trans tr').length<=1){
				message_text += "<li>Barang tidak boleh kosong!!!</li>"
				trigger_submit = false;
			}
		}
		if($('.tbody-trans tr').length>1){
			$.each($('tbody.tbody-trans').find('tr.trans-row-table'), function(index,value) {
					if(!$(value).find('.trans-id').hasClass('trans-id-new')){
						if($(value).find('.trans-qty').val()<=0){
							message_text += "<li>Jumlah barang \"" + $(value).find('.trans-id').val() + "\" tidak boleh kurang atau sama dengan 0!!!</li>"
							trigger_submit = false;
						}
						if($(value).find('.trans-price').val()<=0){
							message_text += "<li>Harga barang \"" + $(value).find('.trans-id').val() + "\" tidak boleh kurang atau sama dengan 0!!!</li>"
							trigger_submit = false;
						}
					}
			});
		}
		print_out = true;
	}
	if(variables.trans_form == 'create-or'){
		if(!$(".po-id").val()){
			message_text += "<li>PO tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}else{
			if($('.tbody-trans tr').length<=1){
				message_text += "<li>Barang tidak boleh kosong!!!</li>"
				trigger_submit = false;
			}
		}
		if(!$(".supplier-invoice").val()){
			message_text += "<li>Surat jalan supplier tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}
		if($('.tbody-trans tr').length>1){
			$.each($('tbody.tbody-trans').find('tr.trans-row-table'), function(index,value) {
					if(!$(value).find('.trans-id').hasClass('trans-id-new')){
						if($(value).find('.trans-qty').val()<=0){
							message_text += "<li>Jumlah barang \"" + $(value).find('.trans-id').val() + "\" tidak boleh kurang atau sama dengan 0!!!</li>"
							trigger_submit = false;
						}
					}
			});
		}
		print_out = true;
	}
	if(variables.trans_form == 'create-purchase'){
		if(!$(".trans-id").val()){
			message_text += "<li>No Transaksi tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}else{
			if(!$('.supplier-invoice').val()){
				message_text += "<li>No nota supplier tidak boleh kosong!!!</li>"
				trigger_submit = false;
			}
		}
		print_out = true;
	}
	if(variables.trans_form == 'create-purchase-payment'){
		if(!$(".supplier-id").val()){
			message_text += "<li>Supplier tidak boleh kosong!!!</li>";
			trigger_submit = false;
		}else{
			if($('.tbody-trans tr').length<=1){
				message_text += "<li>Item transaksi tidak boleh kosong!!!</li>"
				trigger_submit = false;
			}
		}
		print_out = true;
	}
	else if($(".content-wrapper .content").hasClass('cash-in') || $(".content-wrapper .content").hasClass('cash-out') || $(".content-wrapper .content").hasClass('bank-in') || $(".content-wrapper .content").hasClass('bank-out')){
		if(!$("#journal-note").val()){
			message_text += "<li>Keterangan tidak boleh kosong!!!</li>"
			trigger_submit = false;
		}
		if($("#journal-balance").val()<=0){
			message_text += "<li>Nominal tidak boleh kurang dari \"0\" atau kosong!!!</li>"
			trigger_submit = false;
		}
	}
	else if($(".content-wrapper .content").hasClass('general-journal')){
		if(!$("#journal-note").val()){
			message_text += "<li>Keterangan tidak boleh kosong!!!</li>"
			trigger_submit = false;
		}
		if($("#journal-balance").val()<=0){
			message_text += "<li>Nominal tidak boleh kurang dari \"0\" atau kosong!!!</li>"
			trigger_submit = false;
		}
		if($("#journal-debit").val()==$("#journal-credit").val()){
			message_text += "<li>Kode COA debit dan kredit tidak boleh sama!!!</li>"
			trigger_submit = false;
		}
	}
	if(message_text)
		alertBox(message_text);
	if(trigger_submit == true){
		if(print_out)
			alertBox('Apakah Anda Yakin Untuk Menyimpan?', 'alertBox("Apakah Anda Ingin Menyetak Nota?","submiting_form(true)","submiting_form()")');
		else
			alertBox('Apakah Anda Yakin Untuk Menyimpan?', 'submiting_form()');
	}
}
function submiting_form(print=false){
	$('.trans-form form').submit();
}
//EOF SUBMIT TRANSACTION FORM//
//CREATE ROW//
function create_row(tag,val){
	var inpGroup = '<div class="input-group">';
	var btnSrc = '<span class="input-group-append"><button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-list-items" onmouseover="btn_hover(\'in\',this)" onmouseout="btn_hover(\'out\',this)"><i class="fas fa-search"></i></button></span>';
	if(variables.trans_form == 'create-sales-payment')
		btnSrc = '<span class="input-group-append"><button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-list-sales" onmouseover="btn_hover(\'in\',this)" onmouseout="btn_hover(\'out\',this)"><i class="fas fa-search"></i></button></span>';
	if(variables.trans_form == 'create-purchase-payment')
		btnSrc = '<span class="input-group-append"><button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-list-purchase" onmouseover="btn_hover(\'in\',this)" onmouseout="btn_hover(\'out\',this)"><i class="fas fa-search"></i></button></span>';
	var tag_parents = $(tag).parents('tr.trans-row-table');
	var check_duplicate = false;
	var tag_id = val.item_id;
	if(variables.trans_form == 'create-sales-payment')
		tag_id = val.sales_id;
	else if(variables.trans_form == 'create-purchase-payment')
		tag_id = val.purchase_id;
	$.each($('tbody.tbody-trans').find('tr.trans-row-table'), function(index,value) {
		if($(tag).parents('tr.trans-row-table').index()!=index)
			if(!$(value).find('.trans-id').hasClass('trans-id-new'))
				if(tag_id == $(value).find('.trans-id').val())
					check_duplicate = true;
	});
	if(check_duplicate==true){
		if(variables.trans_form == 'create-sales-payment' || variables.trans_form == 'create-purchase-payment')
			alertBox("No Nota Sudah di Input!!!");
		else
			alertBox("Barang Sudah di Input!!!");
	}
	
	if(tag_id!=variables.input_buffer && check_duplicate == false){
		if(tag_parents.find('.trans-name').length>0){
			set_trans_value(tag_parents,val);
			calc();
		}
		else{
			var update_row = [];
			if(variables.btn_toggle)
				update_row += "<td><button type='button' class='btn btn-select' onClick='row_selected(this)'><i class='fas before fa-angle-double-right'></i></i></button></td>";
			if(variables.number)
				update_row += "<td><input class='form-control' type='text' value=" + (variables.row+1) + " readonly='readonly' style='width:32px'></td>";
			
			$.each(variables.attribute, function(index,value) {
				if(value.group)
					update_row += "<td>" + inpGroup + "<input name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " " + value.readonly + ">" + btnSrc + "</div></td>";
				else
					update_row += "<td><input name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " " + value.readonly + "></td>";
			});
			variables.input_buffer = $(tag).val();
			tag_parents.html(update_row);
			set_trans_value(tag_parents,val);
			calc();
			variables.row++;
			add_row();
			auto_input();
			load_inputMask()
		}
	}
	else{
		$(tag).val(variables.input_buffer);
	}
	if(tag_parents.find('.trans-qty'))
		tag_parents.find('.trans-qty').focus();
};
//EOF CREATE ROW//

//ADD NEW ROW//
function add_row(){
	var inpGroup = '<div class="input-group">';
	var btnSrc = '<span class="input-group-append"><button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-list-items" onmouseover="btn_hover(\'in\',this)" onmouseout="btn_hover(\'out\',this)"><i class="fas fa-search"></i></button></span>';
	if(variables.trans_form == 'create-sales-payment')
		btnSrc = '<span class="input-group-append"><button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-list-sales" onmouseover="btn_hover(\'in\',this)" onmouseout="btn_hover(\'out\',this)"><i class="fas fa-search"></i></button></span>';
	else if(variables.trans_form == 'create-purchase-payment')
		btnSrc = '<span class="input-group-append"><button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-list-purchase" onmouseover="btn_hover(\'in\',this)" onmouseout="btn_hover(\'out\',this)"><i class="fas fa-search"></i></button></span>';
	var new_row = "<tr class='trans-row-table' role='row'>";
	if(variables.btn_toggle)
		new_row += "<td><button type='button' class='btn btn-non-select'><i class='fas fa-angle-double-right'></i></button></td>";
	if(variables.number)
		new_row += "<td><input class='form-control' type='text' value=" + (variables.row+1) + " readonly style='width:32px'></td>";
	new_row += "<td>" + inpGroup + "<input class='form-control trans-id trans-id-new' onfocusin='focus_id(\"in\",this)' onfocusout='focus_id(\"out\",this)' onkeyup='onkeyup_colfield_check(event,this)' onkeydown='onkeydown_colfield_check(event,this)' type='text'>" + btnSrc + "</div></td>";
	new_row += "</tr>";
	$('tbody.tbody-trans').append(new_row);
};
//EOF ADD ROW//
//UPDATE CONTENT//
function update_content(update_data){
	//alert(JSON.stringify(update_data));
	var inpGroup = '<div class="input-group">';
	var btnSrc = '<span class="input-group-append"><button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-list-items" onmouseover="btn_hover(\'in\',this)" onmouseout="btn_hover(\'out\',this)"><i class="fas fa-search"></i></button></span>';
	var update_row = [];
	//alert(JSON.stringify(update_data));
	$.each(update_data, function(index1,val) {
		//alert(JSON.stringify(val));
		update_row += "<tr class='trans-row-table' role='row'>";
		if($(".content-wrapper .content").hasClass('cash-in') || $(".content-wrapper .content").hasClass('cash-out') || $(".content-wrapper .content").hasClass('bank-in') || $(".content-wrapper .content").hasClass('bank-out') || $(".content-wrapper .content").hasClass('general-journal')  || $(".content-wrapper .content").hasClass('journal-index') || $(".content-wrapper .content").hasClass('stock-card-index')){
			var l = val.detailJournals.length;
			if(variables.btn_toggle)
				update_row += "<td><button style='height : calc(calc(24px * " + l + ") + " + (l-1) + "px);' type='button' class='btn btn-select' onClick='row_selected(this)'><i class='fas before fa-angle-double-right'></i></i></button></td>";
			if(variables.number)
				update_row += "<td><input style='height : calc(calc(24px * " + l + ") + " + (l-1) + "px);' class='form-control' type='text' value=" + (variables.row+1) + " readonly='readonly' style='width:32px'></td>";
		}
		else{
			if(variables.btn_toggle)
				update_row += "<td><button type='button' class='btn btn-select' onClick='row_selected(this)'><i class='fas before fa-angle-double-right'></i></i></button></td>";
			if(variables.number)
				update_row += "<td><input class='form-control' type='text' value=" + (variables.row+1) + " readonly='readonly' style='width:32px'></td>";
		}
		
		$.each(variables.attribute, function(index,value) {
			var input_val = '';
			if(value.class_name == "trans-id"){
				input_val = val.item_id;
			}
			else if(value.class_name == "trans-name"){
				input_val = val.item.item_name;
			}
			else if(value.class_name == "trans-unit"){
				input_val = val.unit.unit_name;
			}
			else if(value.class_name == "trans-qty" || value.class_name == "trans-qty-so" || value.class_name == "trans-qty-po" ){
				input_val = val.qty;
			}
			else if(value.class_name == "trans-price"){
				if(val.price)
					input_val = val.price;
				else if(val.item.price)
					input_val = val.item.price;
				else
					input_val = val.prices.price;
			}
			else if(value.class_name == "trans-sub-total"){
				input_val = val.sub_total;
			}
			else if(value.class_name == "coa-id"){
				input_val = val.coa_code;
			}
			else if(value.class_name == "coa-name"){
				input_val = val.coa_name;
			}
			else if(value.class_name == "category-coa"){
				input_val = val.accountGroup.account_category_id;
			}
			else if(value.class_name == "group-coa"){
				input_val = val.accountGroup.group_code;
			}
			else if(value.class_name == "group-name"){
				input_val = val.accountGroup.account_group_name;
			}
			else if(value.class_name == "beginning-coa-balance"){
				input_val = val.beginning_balance;
			}
			else if(value.class_name == "date-journal"){
				input_val = moment(val.date, "YYYY-MM-DD").format('D MMMM YYYY');
			}
			else if(value.class_name == "transaction-code-journal"){
				input_val = val.transaction_code;
			}
			else if(value.class_name == "note-journal"){
				input_val = val.note;
			}
			else if(value.class_name == "stock-card-id"){
				input_val = val.stock_card_id;
			}
			else if(value.class_name == "trans-date"){
				input_val = moment(val.date, "YYYY-MM-DD").format('D MMMM YYYY');
			}
			else if(value.class_name == "warehouse-name"){
				input_val = val.warehouse.warehouse_name;
			}
			else if(value.class_name == "trans-code"){
				input_val = val.trans_id;
			}
			else if(value.class_name == "purchase-price"){
				input_val = val.purchase_price;
			}
			else if(value.class_name == "sales-price"){
				input_val = val.seles_price;
			}
			else if(value.class_name == "change-stock"){
				input_val = val.changes;
			}
			else if(value.class_name == "item-stock"){
				input_val = val.stock;
			}
			//alert(JSON.stringify(val));
			//alert(input_val);
			if(value.class_name == "trans-warehouse"){
				update_row += "<td><select name='" + value.name.replace('key',variables.row) + "' data-style='btn-success' class='select-content-trans " + value.class_name + "' " + value.fn + " value='" + input_val + "' "  + value.readonly + ">";
				$.each(variables.warehouses, function(index,value) {
					update_row += "<option value=" + value.warehouse_id + ">" + value.warehouse_name + "</option>";
				});
				update_row += "</select></td>";
			}
			else if(value.class_name == "account-journal"){
				update_row += "<td>";
				$.each(val.detailJournals, function(i,v) {
					var mar = '';
					if(i!=0)
						mar = "margin-top : 1px;";
					if(v.debit)
						update_row += "<input style='" + mar + "' name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " value='" + v.coaCode.coa_name + "' "  + value.readonly + ">";
					if(v.credit)
						update_row += "<input style='padding-left : 35px; " + mar + "' name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " value='" + v.coaCode.coa_name + "' "  + value.readonly + ">";
				});
				update_row += "</td>";
			}
			else if(value.class_name == "debit-journal"){
				update_row += "<td>";
				$.each(val.detailJournals, function(i,v) {
					var mar = '';
					if(i!=0)
						mar = "margin-top : 1px;";
					if(v.debit)
						update_row += "<input style='" + mar + "' name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " value='" + v.debit + "' "  + value.readonly + ">";
					else
						update_row += "<input style='padding-left : 35px; " + mar + "' name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "'  value='' "  + value.readonly + ">";
				});
				update_row += "</td>";
			}
			else if(value.class_name == "credit-journal"){
				update_row += "<td>";
				$.each(val.detailJournals, function(i,v) {
					var mar = '';
					if(i!=0)
						mar = "margin-top : 1px;";
					if(v.credit)
						update_row += "<input style='" + mar + "' name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " value='" + v.credit + "' "  + value.readonly + ">";
					else
						update_row += "<input style='padding-left : 35px; " + mar + "' name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "'  value='' "  + value.readonly + ">";
				});
				update_row += "</td>";
			}
			else if(value.class_name == "date-journal" || value.class_name == "transaction-code-journal" || value.class_name == "note-journal"){
				var l = val.detailJournals.length;
				update_row += "<td><textarea style='height : calc(calc(24px * " + l + ") + " + (l-1) + "px);' name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " value='" + input_val + "' "  + value.readonly + ">" + input_val + "</textarea></td>";
			}
			else{
				if(value.group)
					update_row += "<td>" + inpGroup + "<input name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " value='" + input_val + "' " + value.readonly + ">" + btnSrc + "</div></td>";
				else
					update_row += "<td><input name='" + value.name.replace('key',variables.row) + "' class='form-control " + value.class_name + "' type='" + value.type + "' " + value.fn + " value='" + input_val + "' "  + value.readonly + "></td>";
			}
		});
		//calc();
		update_row += "</tr>";
		variables.row++;
	})
	if(update_data.length==0){
		var colspan_index=0;
		if(variables.btn_toggle)
			colspan_index++;
		if(variables.number)
			colspan_index++;
		colspan_index += variables.attribute.length;
		update_row += "<tr class='dataNotFound_empty'><td valign='center' colspan='" + colspan_index + "'>Tidak Ada Data Ditemukan!!!</td></tr>";
	}
	$('tbody.tbody-trans').append(update_row);
	calc();
	load_inputMask();
}
//EOF UPDATE CONTENT//
$(document).ready(function(){
	load_inputMask();
	if($('body').find('.trans-form').hasClass('transactions')){
		var transaction = $('body').find('.trans-content');
		$('body').on('click', function() {
			if(variables.body_click==true)
				if(variables.selected_row){
					$(variables.selected_row).parents('tr.trans-row-table').removeClass('tr-selected');
					variables.selected_row = '';
				}
			variables.body_click=true;
		});

		$('body').keydown(function(event) {
		  if (event.ctrlKey && event.keyCode === 13) {
			  submitForm();
		  }
		});
		
		$('form').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
			e.preventDefault();
		  }
		});
		
		$('form').on('keydown', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 46) { 
			if(variables.selected_row)
				row_selected(variables.selected_row);
		  }
		});

		function ajaxItems() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=item%2Fget_item_ajax",
			   dataType:'json',
			   success: function(dataDetailBarang){}			   
			});
		}
		function ajaxWarehouses() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=warehouse%2Fget_warehouse_ajax",
			   dataType:'json',
			   success: function(dataDetailGudang){}			   
			});
		}
		function ajaxCustomers() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=customer%2Fget_customer_ajax",
			   dataType:'json',
			   success: function(dataDetailCustomer){}			   
			});
		}
		function ajaxSuppliers() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=supplier%2Fget_supplier_ajax",
			   dataType:'json',
			   success: function(dataDetailSupplier){}			   
			});
		}
		function ajaxSalesman() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=employee%2Fget_salesman_ajax",
			   dataType:'json',
			   success: function(dataDetailSalesman){}			   
			});
		}
		function ajaxSO() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=sales-order%2Fget_so_ajax",
			   dataType:'json',
			   success: function(dataDetailSO){}			   
			});
		}
		function ajaxDO() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=delivery-order%2Fget_do_ajax",
			   dataType:'json',
			   success: function(dataDetailDO){}			   
			});
		}
		function ajaxPR() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=purchase-request%2Fget_pr_ajax",
			   dataType:'json',
			   success: function(dataDetailPR){}			   
			});
		}
		function ajaxPO() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=purchase-order%2Fget_po_ajax",
			   dataType:'json',
			   success: function(dataDetailPO){}			   
			});
		}
		function ajaxPurchaseFrom() {
			if(transaction.hasClass('trans-content-purchase')){
				return $.ajax({ 
				   type: "POST", 
				   url: "index.php?r=purchase%2Fget_purchase_trans_id_ajax",
				   dataType:'json',
				   success: function(dataDetailPurchaseFrom){}			   
				});
			}
			else
				return false;
		}
		function ajaxCoa() {
			return $.ajax({ 
			   type: "POST", 
			   url: "index.php?r=coa%2Fget_coa_ajax",
			   dataType:'json',
			   success: function(dataCoa){}			   
			});
		}
		function ajaxJournal() {
			if($(".content-wrapper .content").hasClass('cash-in') || $(".content-wrapper .content").hasClass('cash-out') || $(".content-wrapper .content").hasClass('bank-in') || $(".content-wrapper .content").hasClass('bank-out') || $(".content-wrapper .content").hasClass('general-journal') || $(".content-wrapper .content").hasClass('journal-index')){
				var jurnal_code = "";
				if($(".content-wrapper .content").hasClass('cash-in')){
					$('.field-journal-debit').hide();
					jurnal_code = "BKM";
				}else if($(".content-wrapper .content").hasClass('cash-out')){
					$('.field-journal-credit').hide();
					jurnal_code = "BKK";
				}
				else if($(".content-wrapper .content").hasClass('bank-in')){
					$('.field-journal-debit').hide();
					jurnal_code = "BBM";
				}
				else if($(".content-wrapper .content").hasClass('bank-out')){
					$('.field-journal-credit').hide();
					jurnal_code = "BBK";
				}
				else if ($(".content-wrapper .content").hasClass('general-journal')){
					jurnal_code = "BJU";
				}
				else{
					jurnal_code = "";
				}
				//alert($("#journal-date").val());
				if(!$(".content-wrapper .content").hasClass('journal-index')){
					start = moment($("#journal-date").val(), "dddd, D MMMM YYYY");
					end = moment($("#journal-date").val(), "dddd, D MMMM YYYY");
				}
				date_range_trans(start, end, true);
				return $.ajax({ 
				   type: "POST", 
				   url: "index.php?r=journal%2Fget_journal_ajax",
				   data: {
					   start_date : start.format('YYYY-MM-DD'),
					   end_date : end.format('YYYY-MM-DD'),
					   jurnal_code : jurnal_code,
				   },
				   dataType:'json',
				   success: function(dataJournal){}			   
				});
			}
			else
				return false;
		}
		function ajaxStockCard() {
			if($(".content-wrapper .content").hasClass('stock-card-index')){
				start = moment();
				end = moment();
				date_range_trans(start, end, true);
				return $.ajax({ 
				   type: "POST", 
				   url: "index.php?r=stock-card%2Fget_stock_card_ajax",
				   data: {
					   start_date : start.format('YYYY-MM-DD'),
					   end_date : end.format('YYYY-MM-DD'),
				   },
				   dataType:'json',
				   success: function(dataStockCard){}			   
				});
			}
			else
				return false;
		}
		
		
		function tables() {
		this.th = "";
		this.btn_toggle = true;
		this.number = true;
		this.count = 0;
		this.row = 0;
		this.fadd_row = 
		this.input_buffer = "";
		this.attribute = [];
		this.items = [];
		this.autofills = [];
		}
		var table = new tables();
		tables.prototype.initThead = function(array) {
		  array.forEach(function(entry) {
			if(entry!="")
				this.th += "<th>" + entry.th_label + "</th>";
		  }, this);
		};
		function create_initTable(entry,num=true,tggle=true){
			var table_trans = "<table><thead><tr role='row'>";
			table.btn_toggle = tggle;
			table.number = num;
			if(table.btn_toggle)
				table_trans += "<th class='th-tag'></th>";
			if(table.number)
				table_trans += "<th class='th-number'>No</th>";
			
			table.initThead(entry);
			table.count = 0;
			
			table_trans += table.th + "</tr></thead><tbody class='tbody-trans'></tbody></table>";
			return(table_trans);
		};
		$.when(ajaxItems(), ajaxWarehouses(), ajaxCustomers(), ajaxSuppliers(), ajaxSalesman(), ajaxSO(), ajaxDO(), ajaxPR(), ajaxPO(),ajaxPurchaseFrom(), ajaxCoa(), ajaxJournal(), ajaxStockCard()).done(function(data_get_items, data_get_warehouses, data_get_cuustomers, data_get_suppliers, data_get_salesman, data_get_so, data_get_do, data_get_pr, data_get_po,data_get_purchasefrom, data_get_coa, data_get_journal, data_get_stock_card){
			
			var data_items = data_get_items[0];
			var data_warehouses = data_get_warehouses[0];
			var data_customers = data_get_cuustomers[0];
			var data_suppliers = data_get_suppliers[0];
			var data_salesman = data_get_salesman[0];
			var data_so = data_get_so[0];
			var data_do = data_get_do[0];
			var data_pr = data_get_pr[0];
			var data_po = data_get_po[0];
			var data_purchasefrom = data_get_purchasefrom[0];
			var data_coa = data_get_coa[0];
			var data_journal = data_get_journal[0];
			var data_stock_card = data_get_stock_card[0];
			//alert(JSON.stringify(data_do));
			//SO TRANSACTON//
			
			//CREATE SO//
			if(transaction.hasClass('trans-content-so')){
				table.attribute = [
					{
						th_label : "ID Barang",
						name : "DetailSalesOrder[key][item_id]",
						class_name : "trans-id",
						readonly : "",
						type : 'text',
						group : true,
						fn : "onfocusin='focus_id(\"in\",this); block_text(this);' onfocusout='focus_id(\"out\",this)' onkeyup='onkeyup_colfield_check(event,this)' onkeydown='onkeydown_colfield_check(event,this)'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Satuan",
						name : "",
						class_name : "trans-unit",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Qty",
						name : "DetailSalesOrder[key][qty]",
						class_name : "trans-qty",
						type : 'number',
						readonly : "",
						group : false,
						fn : "onchange='calc()' onfocusin='block_text(this)' onkeyup='onkeyup_colfield_check(event,this)'",
						calc_attr : 1,
					},
					{
						th_label : "Harga",
						name : "DetailSalesOrder[key][price]",
						class_name : "trans-price",
						readonly : "",
						type : 'text',
						group : false,
						fn : "onchange='calc()' onfocusin='block_text(this)' onkeyup='onkeyup_colfield_check(event,this)' data-mask-currency-nrp=''",
						calc_attr : 1,
					},
					{
						th_label : "Sub Total",
						name : "DetailSalesOrder[key][subtotal]",
						class_name : "trans-sub-total",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 2,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-so',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : true,
				});
				
				if($('.trans-content-so').data('detail-so')){
					update_content($('.trans-content-so').data('detail-so'));
				}
				
				add_row();
				auto_input();
				list_modal(data_items, 'items');
				list_modal(data_customers, 'customers');
				list_modal(data_salesman, 'salesman');
				load_inputMask();
			};
			//EOF CREATE SO//
			
			//-------------------------------------------------------------//
			
			//CREATE DO//
			if(transaction.hasClass('trans-content-do')){
				table.attribute = [
					{
						th_label : "ID Barang",
						name : "DetailDeliveryOrder[key][item_id]",
						class_name : "trans-id",
						readonly : "readonly",
						type : 'text',
						group : true,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Satuan",
						name : "",
						class_name : "trans-unit",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Qty SO",
						name : "DetailDeliveryOrder[key][qty_so]",
						class_name : "trans-qty",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Qty",
						name : "DetailDeliveryOrder[key][qty]",
						class_name : "trans-qty",
						type : 'number',
						readonly : "",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Gudang",
						name : "DetailDeliveryOrder[key][warehouse_id]",
						class_name : "trans-warehouse",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "''",
						calc_attr : 0,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute,true,false));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-do',
					items : data_items,
					warehouses : data_warehouses,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : false,
				});
				if($('.trans-content-do').data('detail-do')){
					update_content($('.trans-content-do').data('detail-do'));
				}
				list_modal(data_so, 'so');
				load_inputMask();
			};
			//EOF CREATE DO//
			//CREATE SALES//
			if(transaction.hasClass('trans-content-sales')){
				table.attribute = [
					{
						th_label : "ID Barang",
						name : "DetailSales[key][item_id]",
						class_name : "trans-id",
						readonly : "readonly",
						type : 'text',
						group : true,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Satuan",
						name : "",
						class_name : "trans-unit",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Qty",
						name : "DetailSales[key][qty]",
						class_name : "trans-qty",
						type : 'number',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 1,
					},
					{
						th_label : "Harga",
						name : "DetailSales[key][price]",
						class_name : "trans-price",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-nrp=''",
						calc_attr : 1,
					},
					{
						th_label : "Sub Total",
						name : "DetailSales[key][subtotal]",
						class_name : "trans-sub-total",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 2,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute,true,false));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-sales',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : false,
				});
				if($('.trans-content-sales').data('detail-sales')){
					update_content($('.trans-content-sales').data('detail-sales'));
				}
				list_modal(data_do, 'do');
				load_inputMask();
			};
			//EOF CREATE SALES//
			
			//CREATE SALES PAYMENT//
			if(transaction.hasClass('trans-content-sales-payment')){
				table.attribute = [
					{
						th_label : "Nota Penjualan",
						name : "DetailSalesPayment[key][sales_id]",
						class_name : "trans-id",
						readonly : "",
						type : 'text',
						group : true,
						fn : "onfocusin='focus_id(\"in\",this); block_text(this);' onfocusout='focus_id(\"out\",this)' onkeyup='onkeyup_colfield_check(event,this)' onkeydown='onkeydown_colfield_check(event,this)'",
						calc_attr : 0,
					},
					{
						th_label : "Tanggal",
						name : "",
						class_name : "trans-date",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Sub Total",
						name : "DetailSalesPayment[key][subtotal]",
						class_name : "trans-sub-total",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 2,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
				
				set_variable({
					trans_form : 'create-sales-payment',
					items : data_items,
					sales : [],
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : true,
				});
				if($('.trans-content-sales-payment').data('detail-sales-payment')){
					update_content($('.trans-content-sales-payment').data('detail-sales-payment'));
				}
				
				list_modal(data_customers, 'customers');
				load_inputMask();
			};
			//EOF CREATE SALES PAYMENT//
			
			//CREATE PR//
			if(transaction.hasClass('trans-content-pr')){
				table.attribute = [
					{
						th_label : "ID Barang",
						name : "DetailPurchaseRequest[key][item_id]",
						class_name : "trans-id",
						readonly : "",
						type : 'text',
						group : true,
						fn : "onfocusin='focus_id(\"in\",this); block_text(this);' onfocusout='focus_id(\"out\",this)' onkeyup='onkeyup_colfield_check(event,this)' onkeydown='onkeydown_colfield_check(event,this)'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Satuan",
						name : "",
						class_name : "trans-unit",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Qty",
						name : "DetailPurchaseRequest[key][qty]",
						class_name : "trans-qty",
						type : 'number',
						readonly : "",
						group : false,
						fn : "onfocusin='block_text(this)'",
						calc_attr : 1,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-pr',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : true,
				});
				if($('.trans-content-pr').data('detail-pr')){
					update_content($('.trans-content-pr').data('detail-pr'));
				}
				add_row();
				auto_input();
				list_modal(data_items, 'items');
				list_modal(data_suppliers, 'suppliers');
				load_inputMask();
			};
			//EOF CREATE PR//
			//CREATE PO//
			if(transaction.hasClass('trans-content-po')){
				table.attribute = [
					{
						th_label : "ID Barang",
						name : "DetailPurchaseOrder[key][item_id]",
						class_name : "trans-id",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "onfocusin='block_text(this)'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Satuan",
						name : "",
						class_name : "trans-unit",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Qty",
						name : "DetailPurchaseOrder[key][qty]",
						class_name : "trans-qty",
						type : 'number',
						readonly : "",
						group : false,
						fn : "onchange='calc()' onfocusin='block_text(this)' onkeyup='onkeyup_colfield_check(event,this)'",
						calc_attr : 1,
					},
					{
						th_label : "Harga",
						name : "DetailPurchaseOrder[key][price]",
						class_name : "trans-price",
						readonly : "",
						type : 'text',
						group : false,
						fn : "onchange='calc()' onfocusin='block_text(this)' onkeyup='onkeyup_colfield_check(event,this)' data-mask-currency-nrp=''",
						calc_attr : 1,
					},
					{
						th_label : "Sub Total",
						name : "DetailPurchaseOrder[key][subtotal]",
						class_name : "trans-sub-total",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 2,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-po',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : false,
				});
				if($('.trans-content-po').data('detail-po')){
					update_content($('.trans-content-po').data('detail-po'));
				}
				add_row();
				auto_input();
				list_modal(data_items, 'items');
				list_modal(data_pr, 'pr');
				load_inputMask();
				
				$(".po-type").change(function(){
					if($(".po-type").val()!=2){
						$(".cash-type").prop("disabled", false);
						$(".supplier-invoice").attr('readonly', false);
					}
					else{
						$(".cash-type").val(1);
						$(".supplier-invoice").val("");
						$(".cash-type").prop("disabled", true);
						$('.cash-type').trigger('change');
						$(".supplier-invoice").attr('readonly', true);
					}
				});
			};
			//EOF CREATE PO//
			//CREATE OR//
			if(transaction.hasClass('trans-content-or')){
				table.attribute = [
					{
						th_label : "ID Barang",
						name : "DetailOrderReceipt[key][item_id]",
						class_name : "trans-id",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "onfocusin='block_text(this)'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Satuan",
						name : "",
						class_name : "trans-unit",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Qty Order",
						name : "DetailOrderReceipt[key][qty_order]",
						class_name : "trans-qty-po",
						type : 'number',
						readonly : "readonly",
						group : false,
						fn : "",
						calc_attr : 1,
					},
					{
						th_label : "Qty",
						name : "DetailOrderReceipt[key][qty]",
						class_name : "trans-qty",
						type : 'number',
						readonly : "",
						group : false,
						fn : "onfocusin='block_text(this)'",
						calc_attr : 1,
					},
					{
						th_label : "Gudang",
						name : "DetailOrderReceipt[key][warehouse_id]",
						class_name : "trans-warehouse",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "''",
						calc_attr : 0,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-or',
					items : data_items,
					warehouses : data_warehouses,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : false,
				});
				if($('.trans-content-or').data('detail-or')){
					update_content($('.trans-content-or').data('detail-or'));
				}
				list_modal(data_po, 'po');
				load_inputMask();
			};
			//EOF CREATE OR//
			//CREATE PURCHASE//
			if(transaction.hasClass('trans-content-purchase')){
				table.attribute = [
					{
						th_label : "ID Barang",
						name : "DetailPurchase[key][item_id]",
						class_name : "trans-id",
						readonly : "readonly",
						type : 'text',
						group : true,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Satuan",
						name : "",
						class_name : "trans-unit",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Qty",
						name : "DetailPurchase[key][qty]",
						class_name : "trans-qty",
						type : 'number',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Harga",
						name : "DetailPurchase[key][price]",
						class_name : "trans-price",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-nrp=''",
						calc_attr : 1,
					},
					{
						th_label : "Sub Total",
						name : "DetailPurchase[key][subtotal]",
						class_name : "trans-sub-total",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 2,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute,true,false));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-purchase',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : false,
				});
				if($('.trans-content-purchase').data('detail-purchase')){
					update_content($('.trans-content-purchase').data('detail-purchase'));
				}
				list_modal(data_purchasefrom, 'purchasefrom');
				load_inputMask();
			};
			//EOF CREATE PURCHASE//
			
			//CREATE PURCHASE PAYMENT//
			if(transaction.hasClass('trans-content-purchase-payment')){
				table.attribute = [
					{
						th_label : "Nota Penjualan",
						name : "DetailPurchasePayment[key][purchase_id]",
						class_name : "trans-id",
						readonly : "",
						type : 'text',
						group : true,
						fn : "onfocusin='focus_id(\"in\",this); block_text(this);' onfocusout='focus_id(\"out\",this)' onkeyup='onkeyup_colfield_check(event,this)' onkeydown='onkeydown_colfield_check(event,this)'",
						calc_attr : 0,
					},
					{
						th_label : "Tanggal",
						name : "",
						class_name : "trans-date",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Sub Total",
						name : "DetailPurchasePayment[key][subtotal]",
						class_name : "trans-sub-total",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 2,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				set_variable({
					trans_form : 'create-purchase-payment',
					items : data_items,
					purchase : [],
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
					add_row_afRemove : true,
				});
				if($('.trans-content-purchase-payment').data('detail-purchase-payment')){
					update_content($('.trans-content-purchase-payment').data('detail-purchase-payment'));
				}
				
				list_modal(data_suppliers, 'suppliers');
				load_inputMask();
			};
			//EOF CREATE PURCHASE PAYMENT//
			
			//COA//
			if(transaction.hasClass('trans-content-coa')){
				table.attribute = [
					{
						th_label : "Kode COA",
						name : "",
						class_name : "coa-id",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Nama COA",
						name : "",
						class_name : "coa-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Kode Kategori",
						name : "",
						class_name : "category-coa",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Kode Group",
						name : "",
						class_name : "group-coa",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Nama Group",
						name : "",
						class_name : "group-name",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Saldo Awal",
						name : "",
						class_name : "beginning-coa-balance",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 0,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-coa',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
				});
				
				update_content(data_coa)
				load_inputMask();
				generateCOA();
			};
			//EOF COA//
			//JOURNAL//
			if(transaction.hasClass('trans-content-journal-cash-bank')){
				table.attribute = [
					{
						th_label : "Tanggal",
						name : "",
						class_name : "date-journal",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Kode Transaksi",
						name : "",
						class_name : "transaction-code-journal",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Keterangan",
						name : "",
						class_name : "note-journal",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Akun",
						name : "",
						class_name : "account-journal",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Debit",
						name : "",
						class_name : "debit-journal",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 0,
					},
					{
						th_label : "Kredit",
						name : "",
						class_name : "credit-journal",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 0,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-journal-cash-bank',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
				});
				update_content(data_journal)
				load_inputMask();
				if($(".content-wrapper .content").hasClass('cash-in')){
					generateJournal('cashin');
				}else if($(".content-wrapper .content").hasClass('cash-out')){
					generateJournal('cashout');
				}
				else if($(".content-wrapper .content").hasClass('bank-in')){
					generateJournal('bankin');
				}
				else if($(".content-wrapper .content").hasClass('bank-out')){
					generateJournal('bankout');
				}
				else if($(".content-wrapper .content").hasClass('general-journal')){
					generateJournal('general');
				}
			};
			//EOF JOURNAL//
			//STOCK CARD//
			if(transaction.hasClass('trans-content-stock-card')){
				table.attribute = [
					{
						th_label : "Kode Kartu Stok",
						name : "",
						class_name : "stock-card-id",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Tanggal",
						name : "",
						class_name : "trans-date",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Kode Barang",
						name : "",
						class_name : "trans-id",
						readonly : "readonly",
						type : 'text',
						group : false,
						fn : "",
						calc_attr : 0,
					},
					{
						th_label : "Nama Barang",
						name : "",
						class_name : "trans-name",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Gudang",
						name : "",
						class_name : "warehouse-name",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Kode Transaksi",
						name : "",
						class_name : "trans-code",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Harga Beli",
						name : "",
						class_name : "purchase-price",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 0,
					},
					{
						th_label : "Harga Jual",
						name : "",
						class_name : "sales-price",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "data-mask-currency-rp=''",
						calc_attr : 0,
					},
					{
						th_label : "Perubahan",
						name : "",
						class_name : "change-stock",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
					{
						th_label : "Stok",
						name : "",
						class_name : "item-stock",
						type : 'text',
						readonly : "readonly",
						group : false,
						fn : "'",
						calc_attr : 0,
					},
				];
				//table.items = data_items;
				transaction.html(create_initTable(table.attribute));
			
				$.each(data_items, function(index,value) {
					table.autofills.push({
						label : value.item_id + "-" + value.item_name,
						item_id : value.item_id,
					});
				});
				set_variable({
					trans_form : 'create-journal-cash-bank',
					items : data_items,
					autofills : table.autofills,
					row : $('.tbody-trans tr').length,
					btn_toggle : table.btn_toggle,
					number : table.number,
					input_buffer : "",
					attribute : table.attribute,
					chose_auto : false,
					id_onfocus : false,
					id_btn_onover : false,
					tag_row : [],
					selected_row : '',
					body_click : true,
				});
				update_content(data_stock_card)
				load_inputMask();
			};
			//EOF STOCK CARD//
			loader();
			$('.card-body.trans-content').overlayScrollbars({
				paddingAbsolute : true,
				scrollbars : {
					clickScrolling   : true
				},
			}); 
	
			$(".custom-select").select2({
				minimumResultsForSearch: -1
			});
			
			var dataTableTransCnfg = [];
			if($('body').find('#modal-table-items').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-items', 'target_column':[0]});
			}
			if($('body').find('#modal-table-customers').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-customers', 'target_column':[0]});
			}
			if($('body').find('#modal-table-suppliers').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-suppliers', 'target_column':[0]});
			}
			if($('body').find('#modal-table-sales').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-sales', 'target_column':[0]});
			}
			if($('body').find('#modal-table-so').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-so', 'target_column':[0]});
			}
			if($('body').find('#modal-table-do').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-do', 'target_column':[0]});
			}
			if($('body').find('#modal-table-pr').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-pr', 'target_column':[0]});
			}
			if($('body').find('#modal-table-po').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-po', 'target_column':[0]});
			}
			if($('body').find('#modal-table-purchasefrom').length){
				dataTableTransCnfg.push({'id_table':'#modal-table-purchasefrom', 'target_column':[0]});
			}
		
			if(dataTableTransCnfg)
				cerate_dataTable_index(dataTableTransCnfg);
				
			$(".custom-select").select2({
				minimumResultsForSearch: -1
			});
		})
		//EOF SO TRANSACTION
	}
$('#daterange-trans').daterangepicker(
{
	ranges   : {
	  'Hari Ini'       : [moment(), moment()],
	  'Hari Kemarin'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	  '7 hari Terakhir' : [moment().subtract(6, 'days'), moment()],
	  '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
	  'Bulan Ini'  : [moment().startOf('month'), moment().endOf('month')],
	  'Bulan Kemarin'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	  'Tahun Ini'  : [moment().startOf('year'), moment().endOf('year')],
	  'Tahun Kemarin'  : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
	},
	startDate: start,
	endDate  : end,
	locale:{
	"customRangeLabel": "Pilih Tanggal",
	format:"dddd, D MMMM YYYY"
	}
},date_range_trans);
date_range_trans(start, end, true);
});
//Date range as a button
var start = moment();
var end = moment();
function date_range_trans(start, end, beginning_date) {
	
	$('#daterange-trans span#start-date').html(start.format('D MMMM YYYY'));
	$('#daterange-trans span#end-date').html(end.format('D MMMM YYYY'));
	if(beginning_date != true){
		if($(".content-wrapper .content").hasClass('cash-in') || $(".content-wrapper .content").hasClass('cash-out') || $(".content-wrapper .content").hasClass('bank-in') || $(".content-wrapper .content").hasClass('bank-out') || $(".content-wrapper .content").hasClass('general-journal') || $(".content-wrapper .content").hasClass('journal-index')){
			var jurnal_code = "";
			if($(".content-wrapper .content").hasClass('cash-in')){
				jurnal_code = "BKM";
			}else if($(".content-wrapper .content").hasClass('cash-out')){
				jurnal_code = "BKK";
			}
			else if($(".content-wrapper .content").hasClass('bank-in')){
				jurnal_code = "BBM";
			}
			else if($(".content-wrapper .content").hasClass('bank-out')){
				jurnal_code = "BBK";
			}
			else if($(".content-wrapper .content").hasClass('general-journal')){
				jurnal_code = "BJU";
			}
			else{
				jurnal_code = "";
			}
			loader(1);
			$('tbody.tbody-trans').html('');
			variables.row = $('.tbody-trans tr').length;
			$.ajax({ 
			   type: "POST", 
			   url: "index.php?r=journal%2Fget_journal_ajax",
			   data: {
				   start_date : start.format('YYYY-MM-DD'),
				   end_date : end.format('YYYY-MM-DD'),
				   jurnal_code : jurnal_code,
			   },
			   dataType:'json',
			   success: function(dataJournal){
				   update_content(dataJournal);
				   loader(1);
			   },
				failed: function(dataJournal){
				   loader(1);
			   }	
			});
		}
		if($(".content-wrapper .content").hasClass('stock-card-index')){
			loader(1);
			$('tbody.tbody-trans').html('');
			variables.row = $('.tbody-trans tr').length;
			$.ajax({ 
				type: "POST", 
				url: "index.php?r=stock-card%2Fget_stock_card_ajax",
				data: {
				   start_date : start.format('YYYY-MM-DD'),
				   end_date : end.format('YYYY-MM-DD'),
				},
				dataType:'json',
				success: function(dataStockCard){
					 update_content(dataStockCard);
					 loader(1);
				},	
				failed: function(dataStockCard){
				   loader(1);
			   }	
			});
		}
	}
 }

function load_inputMask(){
$('[data-mask-currency-rp]').inputmask('currency', {prefix: 'Rp ', removeMaskOnSubmit: false});
$('[data-mask-currency-percent]').inputmask('currency', {prefix:'',suffix: ' %',digits: 0, removeMaskOnSubmit: false});
$('[data-mask-currency-nrp]').inputmask('currency', {prefix: '', removeMaskOnSubmit: false});
}
function generateCOA(){
	$.ajax({ 
	   type: "POST", 
	   url: "index.php?r=coa%2Fget_generate_coa_ajax",
	   dataType:'json',
	   data: {account_group_id : $("#coa-account_group_id").val()},
	   success: function(dataDetailCOA){
		   $(".group-coa-code").val(dataDetailCOA.groupCode);
		   $("#groupConcatCoa").val(dataDetailCOA.groupCode);
		   $("#coaCodeConcat").val(dataDetailCOA.coaCode);
		   $("#coa-coa_code").val(dataDetailCOA.groupCode + "." + dataDetailCOA.coaCode);
	   }			   
	});
}
function generateJournal(jrnl){
	var journal ="";
	if(jrnl == 'cashin')
		journal = "BKM";
	else if(jrnl == 'cashout')
		journal = "BKK";
	else if(jrnl == 'bankin')
		journal = "BBM";
	else if (jrnl == 'bankout')
		journal = "BBK";
	else
		journal = "BJU";
		
	$.ajax({ 
	   type: "POST", 
	   url: "index.php?r=journal%2Fget_generate_journal_ajax",
	   dataType:'json',
	   data: {transaction_code : journal},
	   success: function(dataJournal){
		  // alert(start);
		   $("#journalConcatCode").val(journal);
		   $("#journalConcatNo").val(dataJournal.noJournal);
		   $("#journalConcatMonth").val(dataJournal.month);
		   $("#journalConcatYear").val(dataJournal.year);
		   $("#journal-transaction_code").val(dataJournal.transactionCode);
	   }			   
	});
}