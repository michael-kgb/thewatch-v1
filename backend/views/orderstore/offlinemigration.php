<?php 
use backend\models\PaymentMethod;
use backend\models\PaymentMethodDetail;
?>
<script>

</script>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Input Data Garansi</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/orders">Orders</a></li>
					<li class="breadcrumb-item"><a href="#">Add New</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->


	<div class="row">
		<div class="col-md-12">
			<div class="card-box">
				<form id="form-order" method="POST" onsubmit="return validateOrderForm()">
				<div class="row">
					<div class="col-lg-4">
						<div class="pull-left mt-3">
							<p class="m-b-10">
								<strong>Nama Customer: </strong> 
								<input class="form-control" type="text" name="customer_name" size=30 required />
							</p>
							<p class="m-b-10">
								<strong>Email: </strong> 
								<input class="form-control" type="email" name="customer_email" required />
							</p>
							<p class="m-b-10">
								<strong>Telepon: </strong> 
								<input class="form-control" type="text" name="phone_number" required />
							</p>
						</div>

					</div><!-- end col -->
					<div class="col-lg-4">
						<div class="mt-3 pull-left">
							<p class="m-b-10"><strong>Tanggal Pembelian: </strong> <input class="form-control" type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>" /></p>
							<p class="m-b-10"><strong>Nomor Warranty: </strong> 
								<input required class="form-control" type="text" name="warranty_number" placeholder="#12345" />
							</p>
							<p class="m-b-10"><strong>Warranty Type: </strong> 
								<?php 
									$warranty_types = \backend\models\WarrantyType::find()->where(['warranty_type_status'=>1])->all(); 
									
									if(count($warranty_types) > 0){
								?>
									
									<select name="warranty_type_id" class="form-control">
									
								<?php foreach($warranty_types as $warranty_type){ ?>
									
									<option value="<?php echo $warranty_type->warranty_type_id; ?>"><?php echo $warranty_type->warranty_type_name; ?></option>
									
								<?php } ?>
								</select>
								<?php } ?>
							</p>
						
						</div>
					</div><!-- end col -->
					<div class="col-lg-4">
						<div class="mt-3 pull-left">
						
							<p class="m-b-10"><strong>Nomor Invoice: </strong> <input required class="form-control" type="text" name="order_reference" placeholder="#12345" /></p>
							<p class="m-b-10"><strong>Metode Pembayaran Saat Pembelian: </strong> 
								<?php 
									$paymentMethodDetail = PaymentMethodDetail::findAll(["store_id" => Yii::$app->session->get('userInfo')['store_id']]); 
									
									if(count($paymentMethodDetail) > 0){
								?>
									
									<select name="payment_method" class="form-control">
									
								<?php foreach($paymentMethodDetail as $payment){ ?>
									
									<option value="<?php echo $payment->payment_method_detail_id; ?>"><?php echo $payment->payment->name_bank; ?></option>
									
								<?php } ?>
									
									</select>
								<?php } ?>
							</p>
						</div>
					</div><!-- end col -->
				</div>
				<!-- end row -->

				<div class="row" style="margin-top: 30px;">
					<div class="col-md-12">
						<div class="btn-toolbar m-b-10">
							<button type="button" onclick="addItem()" class="btn btn-info waves-effect waves-light" name="add-item"> <i class="fa fa-cart-plus m-r-5"></i> <span>Add Item</span> </button>
						</div>
						<div class="table-responsive">
							<table class="table mt-4">
								<thead>
									<tr>
										<th width=35%>Item</th>
										<!--<th width=15%>Warranty Code</th>-->
										<!--<th width=15%>Warranty Code input</th>-->
										<th width=5%>Quantity</th>
										<th width=20%>Unit Price</th>
										<th width=20%>Total</th>
							
									</tr>
								</thead>
								<tbody id="product-body-data">
									<tr id="empty-data">
										<td colspan=5 align="center">EMPTY DATA</td>
										<input type="hidden" value="0" name="product_id" />
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				

				<div class="hidden-print mt-4 mb-4">
					<div class="text-right">
						<button class="btn btn-info waves-effect waves-light" type="submit">Submit</button
					</div>
				</div>
			</div>
			</form>
		</div>

	</div>
	<!-- end row -->

</div>

<script>
var i = 0,
	productItems,
	warrantyItems,
	productId = 0,
	unitPrice,
	productQty,
	productTotal,
	subtotalOrder = 0,
	lastOrderAmount = 0;

function validateOrderForm(){
    var stop = 1;
    if($('#productSelector').length == 0){
		alert('Please Insert At Least 1 Product');
		stop = 0;
		return false;
	}
	$('input[name="product_check_id[]"]').each(function() {
       var element = $(this);
       if (element.val() == 0) {
           alert('Please Insert Product');
            stop = 0;
		    return false;
       }
    });

    $("input#warrantySelectorInput").each(function() {
       var element = $(this);
       if (element.attr('attrid') == '') {
           alert('Please Insert Right Code');
            stop = 0;
		    return false;
       }
    });
    
    
    // 	return false;
    if(stop == 1){
        // console.log('error ngga kena selector');
        // return false;
        $('#form-order').attr('action','<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/orders/offline-migration');
    }else{
        console.log('ada error');
        return false;
    }
    // return false;
    
//	$('#form-order').attr('action','<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/orders/create');
	//$('#form-order').submit();
}	

function addItem(){
    $("button[name='add-item']").remove();
	$(function() {
		
		// check if first product element not is exist
		if($("#product-data").length){
			i += 1;
			// insert new product data into next product data element
			$("#product-data-"+i).after(
				'<tr id="product-data-'+i+'">'+
					'<td width=35%><select id="productSelector" class="form-control product-select-'+i+'" name="product_id[]" onchange="getProductSelected('+i+')"></select><input type="hidden" id="product-check-id-'+i+'" name="product_check_id[]" value="0" /><input type="hidden" id="product-attribute-id-'+i+'" name="product_attribute_id[]" value="0" /></td>'+
				// 	'<td width=15%><select id="warrantySelector" class="form-control warranty-select-'+i+'" name="warranty_id[]"></select></td>' +
				// 	'<td width=15%><input id="warrantySelectorInput" class="form-control warranty-select-input-'+i+'" name="warranty_select_id[]" value="" attrid="" attrcode=""><input type="hidden" id="warrantyInput" class="form-control warranty-input-'+i+'" name="warranty_id[]" value="0"></td>' +
					'<td width=5%><input type="hidden" id="product-qty-'+i+'" min="1" type="number" value="1" class="form-control" name="product_quantity[]" style="width: 50px" /> 1 </td>'+
					'<td width=20%><span>IDR</span><span id="unit-price-'+i+'" class="pull-right">0</span></td>'+
					'<td width=20%><input type="hidden" name="totalPrice['+i+']" value="0" /><span>IDR</span><span id="total-price-'+i+'" class="pull-right">0</span></td>'+
					
				'</tr>'
			);
			
			$(".product-select-"+i).select2({
				ajax: {
					//url: 'https://api.github.com/search/repositories',
					url: storeUrl + '/api/getproductlist',
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page
						};
					},
					processResults: function (data, params) {
						// parse the results into the format expected by Select2
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data, except to indicate that infinite
						// scrolling can be used
						params.page = params.page || 1;
						
						productItems;
						productItems = data.items;
						
						return {
							results: data.items,
							pagination: {
								more: (params.page * 30) < data.total_count
							}
						};
					},
					cache: true
				},
				placeholder: 'Search for a product',
				escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				minimumInputLength: 4,
				//templateResult: formatRepo,
				//templateSelection: formatRepoSelection
			});
			
			$(".warranty-select-"+i).select2({
				ajax: {
					//url: 'https://api.github.com/search/repositories',
					url: storeUrl + '/api/getwarrantylist?status=available',
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page
						};
					},
					processResults: function (data, params) {
						// parse the results into the format expected by Select2
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data, except to indicate that infinite
						// scrolling can be used
						params.page = params.page || 1;
						
						warrantyItems;
						warrantyItems = data.items;
						
						return {
							results: data.items,
							pagination: {
								more: (params.page * 30) < data.total_count
							}
						};
					},
					cache: true
				},
				placeholder: 'Search for a warranty',
				escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				minimumInputLength: 2,
				//templateResult: formatRepo,
				//templateSelection: formatRepoSelection
			});
			
			$("input.warranty-select-input-"+i).on('input', function() {
			    var code_count = 0;
			    element = $(this).val();
			    $("input#warrantySelectorInput").each(function() {
                   var element2 = $(this).val();
                   if (element == element2) {
                        code_count++;
                   }
                });
                
                if(code_count == 2){
                    alert('Kode sama dengan sebelumnya');
                    return false;
                }
			    
			    $.ajax({
                    type:'POST',
                    url: storeUrl + '/warranty/getwarrantylist?status=available',
                    dataType: 'json',
                    data: {
                    
                      "q": $(this).val(),
                    },
                    beforeSend: function () {
                        $('#loadingScreen').modal('show');
                    },
                    success:function(data){
                        $('#loadingScreen').modal('hide');
                        
                        console.log(data['result']);
                        if(data['result'] == 'not found' || data['result'] == 'duplicate'){
                            $("input.warranty-select-input-"+i).css('border','solid 1px red');
                            $("input.warranty-select-input-"+i).attr('attrid','');
                            $("input.warranty-input-"+i).val(0);
                            // console.log('masuk');
                        }else{
                            // console.log(data['warranty_id']);
                            $("input.warranty-select-input-"+i).attr('attrid','1');
                            $("input.warranty-input-"+i).val(data['warranty_id']);
                            $("input.warranty-select-input-"+i).css('border-color','#dadada');
                        }
                        
                    },
                    error: function(data){
                        $('#loadingScreen').modal('hide');
                        console.log("error");
                        console.log(data);
                    }
                });
			    
			});
			
		} else {
			i += 1;
			$("#empty-data").remove();
			
			// insert new product data element
			$("#product-body-data").append(
				'<tr id="product-data-'+ i +'">' +
					'<td width=35%><select id="productSelector" class="form-control product-select-'+i+'" name="product_id[]" onchange="getProductSelected('+i+')"><input type="hidden" id="product-check-id-'+i+'" name="product_check_id[]" value="0" /></select><input type="hidden" id="product-attribute-id-'+i+'" name="product_attribute_id[]" value="0" /></td>' +
				// 	'<td width=15%><select id="warrantySelector" class="form-control warranty-select-'+i+'" name="warranty_id[]"></select></td>' +
				// 	'<td width=15%><input id="warrantySelectorInput" class="form-control warranty-select-input-'+i+'" name="warranty_select_id[]" value="" attrid="" attrcode=""><input type="hidden" id="warrantyInput" class="form-control warranty-input-'+i+'" name="warranty_id[]" value="0"></td>' +
					'<td width=5%><input type="hidden" id="product-qty-'+i+'" min="1" type="number" value="1" class="form-control" name="product_quantity[]" style="width: 50px" /> 1 </td>'+
					'<td width=20%><span>IDR</span><span id="unit-price-'+i+'" class="pull-right">0</span></td>'+
					'<td width=20%><input type="hidden" name="totalPrice['+i+']" value="0" /><span>IDR</span><span id="total-price-'+i+'" class="pull-right">0</span></td>'+
					
				'</tr>'
			);
			
			$(".product-select-"+i).select2({
				ajax: {
					//url: 'https://api.github.com/search/repositories',
					url: storeUrl + '/api/getproductlist',
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page
						};
					},
					processResults: function (data, params) {
						// parse the results into the format expected by Select2
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data, except to indicate that infinite
						// scrolling can be used
						params.page = params.page || 1;
						
						productItems;
						productItems = data.items;

						return {
							results: data.items,
							pagination: {
								more: (params.page * 30) < data.total_count
							}
						};
					},
					cache: true
				},
				placeholder: 'Search for a product',
				escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				minimumInputLength: 4,
				//templateResult: formatRepo,
				//templateSelection: formatRepoSelection
			});
			
			$(".warranty-select-"+i).select2({
				ajax: {
					//url: 'https://api.github.com/search/repositories',
					url: storeUrl + '/api/getwarrantylist?status=available',
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page
						};
					},
					processResults: function (data, params) {
						// parse the results into the format expected by Select2
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data, except to indicate that infinite
						// scrolling can be used
						params.page = params.page || 1;
						
						warrantyItems;
						warrantyItems = data.items;
						
						return {
							results: data.items,
							pagination: {
								more: (params.page * 30) < data.total_count
							}
						};
					},
					cache: true
				},
				placeholder: 'Search for a warranty',
				escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				minimumInputLength: 2,
				//templateResult: formatRepo,
				//templateSelection: formatRepoSelection
			});
			
			$("input.warranty-select-input-"+i).on('input', function() {
			    var code_count = 0;
			    element = $(this).val();
			    $("input#warrantySelectorInput").each(function() {
                   var element2 = $(this).val();
                   if (element == element2) {
                        code_count++;
                   }
                });
                
                if(code_count == 2){
                    alert('Kode sama dengan sebelumnya');
                    return false;
                }
                
			    $.ajax({
                    type:'POST',
                    url: storeUrl + '/warranty/getwarrantylist?status=available',
                    dataType: 'json',
                    data: {
                    
                      "q": $(this).val(),
                    },
                    beforeSend: function () {
                        $('#loadingScreen').modal('show');
                    },
                    success:function(data){
                        $('#loadingScreen').modal('hide');
                        
                        console.log(data['result']);
                        if(data['result'] == 'not found' || data['result'] == 'duplicate'){
                            $("input.warranty-select-input-"+i).css('border','solid 1px red');
                            $("input.warranty-select-input-"+i).attr('attrid','');
                            $("input.warranty-input-"+i).val(0);
                       
                            // console.log('masuk');
                        }else{
                            $("input.warranty-select-input-"+i).attr('attrid','1');
                            $("input.warranty-input-"+i).val(data['warranty_id']);
                            $("input.warranty-select-input-"+i).css('border-color','#dadada');
                        }
                        
                    },
                    error: function(data){
                        $('#loadingScreen').modal('hide');
                        console.log("error");
                        console.log(data);
                    }
                });
			    
			});
		}
		
	});
}

function productQtyChange(id){
	productQty = $("#product-qty-"+id+"").val();
	
	currentUnitPrice = $("#unit-price-"+id).text();
	currentTotalPrice = convertToAngka($("#total-price-"+id).text());
	
	productTotal = (productQty * convertToAngka(currentUnitPrice));
	
	// change total price label
	$("#total-price-"+id).text(convertToRupiah(productTotal));
	actualTotalPrice = convertToAngka($("#total-price-"+id).text());
	
	$('input[name="totalPrice['+id+']"]').val(productTotal);
	
	subtotalOrder = 0;
	$('input[name^="totalPrice"]').each(function() {
		subtotalOrder += parseInt($(this).val());
	});
	
	// change sub total & grandtotal order label
	$("#subtotal-order").text(convertToRupiah(subtotalOrder));
	$("#grandtotal-order").text(convertToRupiah(subtotalOrder));
}

function getProductSelected(id){
	productId = $(".product-select-"+id+" option:selected").val();
	$('input#product-check-id-'+id+'').val(productId);
	console.log(productId);
	console.log($('input#product-check-id-'+id+'').val());
	productQty = $("#product-qty-"+id+"").val();
	
	data = getProductUnitPrice(productItems, "id", productId);
	productTotal = (productQty * data.unit_price);
	
	// change unit price & total price label
	$("#unit-price-"+id).text(convertToRupiah(data.unit_price));
	$("#total-price-"+id).text(convertToRupiah(productTotal));
	$('input[name="totalPrice['+id+']"]').val(productTotal);
	
	// change product attribute id
	$("#product-attribute-id-"+id).val(data.product_attribute_id);
	
	subtotalOrder = 0;
	$('input[name^="totalPrice"]').each(function() {
		subtotalOrder += parseInt($(this).val());
	});
	
	// change sub total & grandtotal order label
	$("#subtotal-order").text(convertToRupiah(subtotalOrder));
	$("#grandtotal-order").text(convertToRupiah(subtotalOrder));
}

function convertToRupiah(amount){
	var rupiah = '';		
	var angkarev = amount.toString().split('').reverse().join('');
	for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	return rupiah.split('',rupiah.length-1).reverse().join('');
}

function convertToAngka(amount){
	return parseInt(amount.replace(/[^0-9]/g, ''), 10);
}

function getProductUnitPrice(array, key, value){
	for (var j = 0; j < array.length; j++) {
		if (array[j][key] == value) {
			return array[j];
		}
	}
}

function formatRepoSelection (repo) {
  return repo.full_name || repo.text;
}

function formatRepo (repo) {
	if (repo.loading) {
		return repo.text;
	}

	var markup = "<div class='select2-result-repository clearfix'>" +
		"<div class='select2-result-repository__title'>" + repo.full_name + "</div></div>";

	return markup;
}

function removeItem(id){
	$(function() {
		// check if product element is exist
		if($("#product-data-"+id).length){
			//i -= 1;
			$("#product-data-"+id).remove();
		}
		
		if(i == 0){
			// insert empty data element
			$("#product-body-data").append('<tr id="empty-data"><td colspan=6 align="center">EMPTY DATA</td><input type="hidden" value="0" name="product_id" /></tr>');
		}
		
		subtotalOrder = 0;
		$('input[name^="totalPrice"]').each(function() {
			subtotalOrder += parseInt($(this).val());
		});
		
		// change sub total & grandtotal order label
		$("#subtotal-order").text(convertToRupiah(subtotalOrder));
		$("#grandtotal-order").text(convertToRupiah(subtotalOrder));
	});
}
</script>