<?php 
use backend\models\PaymentMethod;
use backend\models\PaymentMethodDetail;
use common\components\Helpers;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Update Orders</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/orders">Orders</a></li>
					<li class="breadcrumb-item"><a href="#">Update Orders</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->


	<div class="row">
		<div class="col-md-12">
			<div class="card-box">
				<form method="POST" onsubmit="return validateOrderForm()" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/orders/update/<?php echo $model->orders_id; ?>">
				<div class="row">
					<div class="col-5">
						<div class="pull-left mt-3">
							<p class="m-b-10">
								<strong>Customer Name: </strong> 
								<input class="form-control" type="text" name="customer_name" size=30 required value="<?php echo $model->customer->firstname . '' . $model->customer->lastname; ?>" />
							</p>
							<p class="m-b-10">
								<strong>Email: </strong> 
								<input class="form-control" type="email" name="customer_email" required value="<?php echo $model->customer->email; ?>" />
							</p>
							<p class="m-b-10">
								<strong>Phone Number: </strong> 
								<input data-mask="(9999) 9999-9999" class="form-control" type="text" name="phone_number" required value="<?php echo $model->customer->phone_number; ?>" />
							</p>
						</div>
					</div><!-- end col -->
					<div class="col-5 offset-2">
						<div class="mt-3 pull-right">
							<p class="m-b-10"><strong>Order Date: </strong> <input class="form-control" type="date" name="order_date" value="<?php echo date_format(date_create($model->date_add), 'Y-m-d'); ?>" /></p>
							<p class="m-b-10"><strong>Payment Method: </strong> 
								<?php 
									$paymentMethodDetail = PaymentMethodDetail::findAll(["store_id" => Yii::$app->session->get('userInfo')['store_id']]); 
									
									if(count($paymentMethodDetail) > 0){
								?>
									
									<select name="payment_method" class="form-control">
									
								<?php foreach($paymentMethodDetail as $payment){ ?>
									
									<option value="<?php echo $payment->payment_method_detail_id; ?>" <?php echo $model->payment_method_detail_id == $payment->payment_method_detail_id ? "selected" : ""; ?>><?php echo $payment->payment->name_bank; ?></option>
									
								<?php } ?>
									
									</select>
								<?php } ?>
							</p>
							<p class="m-b-10"><strong>Order ID: </strong> <input required class="form-control" type="text" name="order_reference" value="<?php echo $model->reference; ?>" /></p>
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
										<th width=50%>Item</th>
										<th width=5%>Quantity</th>
										<th width=20%>Unit Price</th>
										<th width=20%>Total</th>
										<th width=5% class="text-center">#</th>
									</tr>
								</thead>
								<tbody id="product-body-data">
									<?php 
										$orderDetailModel = \backend\models\OrderDetail::find()->where(['orders_id' => $model->orders_id])->all(); 
										$subTotal = 0;
										$i = 1;
										if(count($orderDetailModel) > 0){
											foreach($orderDetailModel as $product){
												$subTotal += ($product->original_product_price * $product->product_quantity);
									?>
										<tr id="product-data-update-<?php echo $i; ?>">
											<td width="50%">
												<span class="pull-left">
													<?php echo $product->product_name; ?>
													<input type="hidden" name="product_id[]" value="<?php echo $product->product_id; ?>" />
												</span>
											</td>
											<td width="5%" align="center">
												<span class="center">
													<?php echo $product->product_quantity; ?>
													<input type="hidden" name="product_quantity[]" value="<?php echo $product->product_quantity; ?>" />
												</span>
											</td>
											<td width="20%">
												<span>IDR</span>
												<span id="unit-price-update-<?php echo $i; ?>" class="pull-right"><?php echo Helpers::getPriceFormat($product->original_product_price); ?></span>
											</td>
											<td width="25%">
												<span>IDR</span>
												<span id="unit-price-update-<?php echo $i; ?>" class="pull-right"><input type="hidden" name="totalPrice[<?php echo $i; ?>]" value="<?php echo ($product->original_product_price * $product->product_quantity); ?>" /><?php echo Helpers::getPriceFormat($product->original_product_price * $product->product_quantity); ?></span>
											</td>
											<td width="5%">
												<button type="button" onclick="removeItemData(<?php echo $i; ?>)" class="btn btn-icon waves-effect waves-light btn-danger"><i class="fa fa-remove"></i></button>
											</td>
										</tr>
										<?php $i++; } ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="clearfix pt-5">
							<h6 class="text-muted">Notes:</h6>

							<small>
								Good(s) purchased cannot be exchanged, refunded, or returned.
							</small>
						</div>

					</div>
					<div class="col-6">
						<div class="float-right">
							<p><b>Sub Total:</b> IDR <span id="subtotal-order"><?php echo Helpers::getPriceFormat($subTotal); ?></span></p>
							<h3>IDR <span id="grandtotal-order"><?php echo Helpers::getPriceFormat($subTotal); ?></span></h3>
						</div>
						<div class="clearfix"></div>
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
var i = <?php echo $i; ?>,
	productItems,
	productId = 0,
	unitPrice,
	productQty,
	productTotal,
	subtotalOrder = <?php echo $subTotal; ?>;

function validateOrderForm(){
	if($('#productSelector').length == 0){
		alert('Please Insert At Least 1 Product');
		return false;
	}
}	

function addItem(){
	$(function() {
		
		// check if first product element not is exist
		if($("#product-data").length){
			i += 1;
			// insert new product data into next product data element
			$("#product-data-"+i).after(
				'<tr id="product-data-'+i+'">'+
					'<td width=50%><select id="productSelector" class="form-control product-select-'+i+'" name="product_id[]" onchange="getProductSelected('+i+')"></select><input type="hidden" id="product-attribute-id-'+i+'" name="product_attribute_id[]" value="0" /></td>'+
					'<td width=5%><input onchange="productQtyChange('+i+')" id="product-qty-'+i+'" min="1" type="number" value="1" class="form-control" name="product_quantity[]" style="width: 50px" /></td>'+
					'<td width=20%><span>IDR</span><span id="unit-price-'+i+'" class="pull-right">0</span></td>'+
					'<td width=20%><input type="hidden" name="totalPrice['+i+']" value="0" /><span>IDR</span><span id="total-price-'+i+'" class="pull-right">0</span></td>'+
					'<td width=5%>'+
						'<button type="button" onclick="removeItem('+i+')" class="btn btn-icon waves-effect waves-light btn-danger"><i class="fa fa-remove"></i></button>'+
					'</td>'+
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
			
		} else {
			i += 1;
			$("#empty-data").remove();
			
			// insert new product data element
			$("#product-body-data").append(
				'<tr id="product-data-'+ i +'">' +
					'<td width=50%><select id="productSelector" class="form-control product-select-'+i+'" name="product_id[]" onchange="getProductSelected('+i+')"></select><input type="hidden" id="product-attribute-id-'+i+'" name="product_attribute_id[]" value="0" /></td>' +
					'<td width=5%><input onchange="productQtyChange('+i+')" id="product-qty-'+i+'" min="1" type="number" value="1" class="form-control" name="product_quantity[]" style="width: 50px" /></td>'+
					'<td width=20%><span>IDR</span><span id="unit-price-'+i+'" class="pull-right">0</span></td>'+
					'<td width=20%><input type="hidden" name="totalPrice['+i+']" value="0" /><span>IDR</span><span id="total-price-'+i+'" class="pull-right">0</span></td>'+
					'<td width=5%>'+
						'<button type="button" onclick="removeItem('+i+')" class="btn btn-icon waves-effect waves-light btn-danger"><i class="fa fa-remove"></i></button>'+
					'</td>'+
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
	productQty = $("#product-qty-"+id+"").val();
	
	data = getProductUnitPrice(productItems, "id", productId);
	productTotal = (productQty * data.unit_price);
	
	// change unit price & total price label
	$("#unit-price-"+id).text(convertToRupiah(data.unit_price));
	$("#total-price-"+id).text(convertToRupiah(productTotal));
	
	// change product attribute id
	$("#product-attribute-id-"+id).val(data.product_attribute_id);
	
	$('input[name="totalPrice['+id+']"]').val(productTotal);
	
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
			$("#product-body-data").append('<tr id="empty-data"><td colspan=5 align="center">EMPTY DATA</td><input type="hidden" value="0" name="product_id" /></tr>');
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

function removeItemData(id){
	$(function() {
		// check if product element is exist
		if($("#product-data-update-"+id).length){
			//i -= 1;
			$("#product-data-update-"+id).remove();
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