<?php 
use backend\models\PaymentMethod;
use backend\models\PaymentMethodDetail;
use common\components\Helpers;
use backend\models\WarrantyType;
use backend\models\Stores;
use backend\models\ProductImage;
use backend\models\ProductAttribute;
use backend\models\ProductAttributeCombination;
use backend\models\AttributeValue;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">View Warranty</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/warranty">Warranty</a></li>
					<li class="breadcrumb-item"><a href="#">View Warranty</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->


	<div class="row">
		<div class="col-md-12">
			<div class="card-box">
			    <div class="row">
					<div class="col-5">
						<div class="pull-left mt-3">
							<p class="m-b-10">
								<strong>Warranty Code: </strong> 
								<br>
								<span><?php echo $warranty->warranty_code; ?></span>
							</p>
							<p class="m-b-10">
								<strong>Warranty Number: </strong> 
								<br>
								<span><?php echo ($warranty->warranty_number != '') ? $warranty->warranty_number : '-'; ?></span>
							</p>
							<p class="m-b-10">
								<strong>Warranty Status: </strong> 
								<br>
								<span><?php echo $warranty->warranty_status == 'USED' ? '<span style="color: blue">USED</span>' : '<span style="color: green">AVAILABLE</span>'; ?></span>
							</p>
							<p class="m-b-10">
								<strong>Warranty Activated Date: </strong> 
								<br>
								<span>
									<?php 
										if($warranty->warranty_activated_date != '0000-00-00 00:00:00'){
											echo date_format(date_create($warranty->warranty_activated_date), 'j F Y h:i A'); 
										} else {
											echo '-';
										}
									?>
								</span>
							</p>
							<p class="m-b-10">
								<strong>Warranty Expired Date: </strong> 
								<br>
								<span>
									<?php 
										if($warranty->warranty_expired_date != '0000-00-00 00:00:00'){
											echo date_format(date_create($warranty->warranty_expired_date), 'j F Y h:i A'); 
										} else {
											echo '-';
										}
									?>
								</span>
							</p>
						</div>

					</div><!-- end col -->
					<div class="col-5 offset-2">
						<div class="mt-3 pull-right">
							<p class="m-b-10"><strong>Warranty Type: </strong> 
								<br>
								<span>
									<?php 
										echo WarrantyType::find()->where(['warranty_type_id'=>$warranty->warranty_type_id])->one()->warranty_type_name; 
									?>
								</span>
							</p>
							<p class="m-b-10"><strong>Store: </strong>
								<br>
								<span><?php $warranty_store = Stores::find()->where(['store_id'=>$warranty->store_id])->one(); ?>
								    <?php echo $warranty_store->store_name; ?><br><?php echo $warranty_store->store_address; ?>
								</span>
							</p>
						
						</div>
					</div><!-- end col -->
				</div>
				<?php if(count($model) > 0){ ?>
				<hr>
				<div class="row" style="margin-top: 30px;">
					<div class="col-5">
						<div class="pull-left mt-3">
							<p class="m-b-10">
								<strong>Customer Name: </strong> 
								<br>
								<span><?php echo $model->customer->firstname . ' ' . $model->customer->lastname; ?></span>
							</p>
							<p class="m-b-10">
								<strong>Email: </strong> 
								<br>
								<span><?php echo $model->customer->email; ?></span>
							</p>
							<p class="m-b-10">
								<strong>Phone Number: </strong> 
								<br>
								<span><?php echo $model->customer->phone_number; ?></span>
							</p>
						</div>

					</div><!-- end col -->
					<div class="col-5 offset-2">
						<div class="mt-3 pull-right">
							<p class="m-b-10"><strong>Order Date: </strong> 
								<br>
								<span><?php echo date_format(date_create($model->date_add), 'j F Y h:i A'); ?></span>
							</p>
							<p class="m-b-10"><strong>Payment Method: </strong>
								<br>
								<span><?php echo $model->paymentmethoddetail->payment->name_bank; ?></span>
							</p>
							<p class="m-b-10"><strong>Order ID: </strong>
								<br>
								<span><?php echo $model->reference; ?></span>
							</p>
						</div>
					</div><!-- end col -->
				</div>
				<!-- end row -->

				<div class="row" style="margin-top: 30px;">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table mt-4">
								<thead>
									<tr>
										<th width=10%>Image</th>
										<th width=40%>Item</th>
										<th width=5%>Quantity</th>
										<th width=20%>Unit Price</th>
										<th width=20%>Total</th>
									</tr>
								</thead>
								<tbody id="product-body-data">
									<?php 
										$orderDetailModel = \backend\models\OrderDetail::find()->where(['orders_id' => $model->orders_id])->all(); 
										$subTotal = 0;
										$color = '';
										if(count($orderDetailModel) > 0){
											foreach($orderDetailModel as $product){
												$productimage = ProductImage::find()->where(['product_id' => $product->product_id, 'cover' => 1])->one();
												$subTotal += ($product->original_product_price * $product->product_quantity);
												
												$attributes_id = ProductAttribute::find()->where(['product_id' => $product->product_id])->all();
					
												if(count($attributes_id) != 0){
													foreach ($attributes_id as $row_id) {
														$combination_id = ProductAttributeCombination::find()->where(['product_attribute_id' => $row_id['product_attribute_id'], 'attribute_id'=>6])->one();
														$color = AttributeValue::find()->where(['attribute_value_id'=>$combination_id->attribute_value_id])->one();
														
														$color = $color->value;
													}
												}
									?>
										<tr>
											<td width="10%">
												<img src="https://www.thewatch.co/img/product/<?php echo $productimage->product_image_id; ?>/<?php echo $productimage->product_image_id; ?>_small.jpg" class="img-responsive" />
											</td>
											<td width="40%">
												<span class="pull-left"><?php echo $product->product_name . ' ' . $color; ?></span>
											</td>
											<td width="5%" align="center">
												<span class="center"><?php echo $product->product_quantity; ?></span>
											</td>
											<td width="20%">
												<span>IDR</span>
												<span id="unit-price-1" class="pull-right"><?php echo Helpers::getPriceFormat($product->original_product_price); ?></span>
											</td>
											<td width="25%">
												<span>IDR</span>
												<span id="unit-price-1" class="pull-right"><?php echo Helpers::getPriceFormat($product->original_product_price * $product->product_quantity); ?></span>
											</td>
										</tr>
											<?php } ?>
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
						<a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
					</div>
				</div>
				
				<?php } ?>
			</div>
		</div>

	</div>
	<!-- end row -->

</div>