<?php 
use backend\models\ServiceHistory;
use backend\models\OrderDetail;
use backend\models\ProductImage;
use backend\models\ProductAttribute;
use backend\models\ProductAttributeCombination;
use backend\models\AttributeValue;
use common\components\Helpers;
use backend\models\ServiceStateLang;
use backend\models\CustomerAddress;
use backend\models\ServiceDetail;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">View Claim Service</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis">Claim Service</a></li>
					<li class="breadcrumb-item"><a href="#">View Claim Service</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->
	
	<div class="modal fade" id="showResi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Resi Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group row" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Nomor Resi</b></label>
								<div class="col-8 col-form-label">
									<?php echo $data->customer_shipping_number; ?>
								</div>
							</div> 
							<div class="form-group row" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Foto Resi</b></label>
								<div class="col-8 col-form-label">
									<img width=300 src="https://www.thewatch.co/img/warranty/service/uploads/customer-resi/<?php echo $data->customer_shipping_number_image == "" ? "img-default.jpg" : $data->customer_shipping_number_image; ?>" />
								</div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-7">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-credit-card" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">SERVICE (<?php echo $data->service_code; ?>)</span>
					<!--<form method="GET" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/print/<?php echo $data->service_id; ?>" style="float: right;">
						<button type="submit" class="btn btn-default pull-right" style="cursor: pointer;"><input type="hidden" name="print_invoice" value="1"><i class="fa fa-fw fa-print"></i> Print Invoice</button>
					</form>-->
				</div>
				<hr>
				<div class="col-12" style="margin-top: 10px; padding-left: 0; padding-right: 0;">
					<label class="col-form-label"><b>Status</b></label>
					<table id="table-status" width=100%>
						<?php $serviceStatus = ServiceHistory::find()->where(['service_id' => $data->service_id])->orderBy('service_history.date_add DESC')->all(); ?>
						<?php if(count($serviceStatus) > 0){ ?>
						<tbody>
							<?php foreach($serviceStatus as $row){ ?>
							<tr>
								<td width="70%"><?php echo $row->serviceStateLang->text; ?> <span style="float: right;"><a href="#" data-toggle="modal" data-target="#showResi"><?php echo $row->serviceStateLang->action_text == "" ? "" : $row->serviceStateLang->action_text; ?></a></span></td>
								<td width="30%" align="right"><?php echo date_format(date_create($row->date_add), 'j F Y g:i A'); ?></td>
							</tr>
							<?php } ?>
						</tbody>
						<?php } ?>
					</table>
				</div>
				<div class="col-12" style="margin-top: 20px; padding-left: 0; padding-right: 0;">
					<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/updatestatusservice/<?php echo $data->service_id; ?>">
					<table width=100%>
						<tbody>
							<tr>
								<td width="70%">
									<?php $serviceStateLangModel = ServiceStateLang::findAll(["apps_language_id" => 1]); ?>
									<?php if(count($serviceStateLangModel) > 0){ ?>
									<select class="form-control" name="service_state_lang_id">
										<option value="0">Please Select</option>
										<?php foreach($serviceStateLangModel as $row){ ?>
										<option value="<?php echo $row->service_state_lang_id; ?>"><?php echo $row->text; ?></option>
										<?php } ?>
									</select>
									<?php } ?>
								</td>
								<td width="20%" align="right">
									<button class="btn btn-primary col-12" style="cursor: pointer;" type="submit">Update</button>
								</td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<div class="card card-body m-b-30">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">CUSTOMER DETAIL</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>Name</b></label>
						<div class="col-8 col-form-label">
							<?php echo $data->orders->customer->firstname . ' ' . $data->orders->customer->lastname; ?>
						</div>
					</div> 
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>Email</b></label>
						<div class="col-8 col-form-label">
							<a href="mailto:<?php echo $data->orders->customer->email; ?>"><?php echo $data->orders->customer->email; ?></a>
						</div>
					</div>   
					<div class="form-group row" style="margin-bottom: 0.5rem;">
						<label class="col-4 col-form-label"><b>No Telp</b></label>
						<div class="col-8 col-form-label">
							<?php echo $data->orders->customer->phone_number; ?>
						</div>
					</div> 
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-image"></i> <span style="margin-left: 10px;">PRODUCT CONDITION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>FRONT VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceDetail->serviceImage->service_image_front_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_front.jpg" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_front.jpg" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>LEFT VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceDetail->serviceImage->service_image_left_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_left.jpg" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_left.jpg" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>RIGHT VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceDetail->serviceImage->service_image_right_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_right.jpg" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_right.jpg" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>TOP VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceDetail->serviceImage->service_image_top_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_top.jpg" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_top.jpg" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>BOTTOM VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceDetail->serviceImage->service_image_bottom_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_bottom.jpg" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_bottom.jpg" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
						<div class="form-group col-md-4">
							<div class="form-group row" style="text-align: center;">
								<label class="col-12 col-form-label"><b>BACK VIEW</b></label>
								<div class="col-12 col-form-label">
									<?php if($data->serviceDetail->serviceImage->service_image_back_view){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_back.jpg" target="_blank"><img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/<?php echo $data->serviceDetail->serviceImage->service_image_id; ?>/<?php echo $data->serviceDetail->serviceImage->service_image_id ?>_back.jpg" /> </a>
									<?php } else { ?>
									<img width=150 src="https://www.thewatch.co/img/warranty/service/uploads/product_condition/img-default.jpg" /> 
									<?php } ?>
								</div>
							</div>   
						</div>
					</div>
				</div>
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-wrench"></i> <span style="margin-left: 10px;">SERVICE INFORMATION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Service List</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">
									<?php $serviceList = ServiceDetail::findAll(["service_id" => $data->service_id]); ?>
									<?php if(count($serviceList) > 0){ ?>
									<ul>
									<?php foreach($serviceList as $row){ ?>
									<li>
										<?php echo $row->serviceTypeStore->serviceType->service_type_name; ?> <br/>
									</li>
									<br>
									<?php } ?>
									</ul>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/view/<?php echo $data->service_id; ?>">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Service Fee</b></label>
								<div class="col-6 col-form-label" style="padding-right: 0;">
									<input type="text" name="service_fee" class="form-control" <?php echo $data->serviceHistory->serviceStateLang->service_state_lang_id == 14 ? "" : "disabled"; ?> value="<?php echo $data->service_fee; ?>" />
								</div>
							</div>
							<div class="hidden-print" style="margin-top: 50px;">
								<div class="text-right">
									<button type="submit" class="btn btn-gradient waves-light waves-effect w-md" <?php echo $data->serviceHistory->serviceStateLang->service_state_lang_id == 14 ? "" : "disabled"; ?>>Update</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-5">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-truck"></i> <span style="margin-left: 10px;">SHIPPING INFORMATION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Address</b></label>
								<div class="col-8 col-form-label" style="padding-right: 0;">
									<?php $addressList = CustomerAddress::find()->where(["customer_id" => $data->orders->customer_id])->orderBy('customer_address_id ASC')->all(); ?>
									<?php if(count($addressList) > 0){ ?>
									<ul>
									<?php foreach($addressList as $row){ ?>
									<li>
										<?php echo $row->address1; ?> <br/>
										<?php echo $row->postcode; ?> <?php echo $row->province->name; ?><br/>
										<?php echo $row->phone; ?> <?php echo $row->set_as_default == 1 ? "<span style='float: right;'><b>(Default)</b></span>" : ""; ?>
									</li>
									<br>
									<?php } ?>
									</ul>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/updateresiservice/<?php echo $data->service_id; ?>">
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-5 col-form-label"><b>Shipping Carrier</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<select class="form-control" name="sc_shipping_carrier" <?php echo $data->serviceHistory->serviceStateLang->service_state_lang_id == 22 ? "" : "disabled"; ?>>
										<option value="">Please Select</option>
										<option value="JNE" <?php echo $data->sc_shipping_carrier == "JNE" ? "selected" : "" ; ?>>JNE</option>
										<option value="NCS" <?php echo $data->sc_shipping_carrier == "NCS" ? "selected" : "" ; ?>>NCS</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-5 col-form-label"><b>Tracking Number</b></label>
								<div class="col-7 col-form-label" style="padding-right: 0;">
									<input type="text" <?php echo $data->serviceHistory->serviceStateLang->service_state_lang_id == 22 ? "" : "disabled"; ?> value="<?php echo $data->sc_tracking_number; ?>" name="sc_tracking_number" class="form-control" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hidden-print" style="margin-top: 10px;">
					<div class="text-right">
						<button type="submit" class="btn btn-gradient waves-light waves-effect w-md" <?php echo $data->serviceHistory->serviceStateLang->service_state_lang_id == 22 ? "" : "disabled"; ?>>Update</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end row -->
	
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">ORDER DETAIL (<?php echo strtoupper($data->orders->reference); ?>)</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-6">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Purchase Date</b></label>
								<div class="col-8 col-form-label">
									<?php echo date_format(date_create($data->orders->date_add), 'j F Y g:i A'); ?>
								</div>
							</div>   
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Invoice Number</b></label>
								<div class="col-8 col-form-label">
									<?php echo $data->orders->reference; ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Purchase Store</b></label>
								<div class="col-8 col-form-label">
									<b><?php echo $data->orders->stores->store_name . ' - ' . $data->orders->stores->store_location; ?></b> <br><hr>
									<?php echo $data->orders->stores->store_address; ?>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Store Claim</b></label>
								<div class="col-8 col-form-label">
									<b><?php echo $data->serviceDetail->serviceTypeStore->stores->store_name . ' - ' . $data->serviceDetail->serviceTypeStore->stores->store_location; ?></b> <br><hr>
									<?php echo $data->serviceDetail->serviceTypeStore->stores->store_address; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="padding-left: 0; padding-right: 0;">
					<div class="table-responsive">
						<table class="table mt-4">
							<thead>
								<tr>
									<th width=10%>Image</th>
									<th width=25%>Item</th>
									<th width=15% style="text-align: center;">Warranty Number</th>
									<th width=5%>Quantity</th>
									<th width=20%>Unit Price</th>
									<th width=20%>Total</th>
								</tr>
							</thead>
							<tbody id="product-body-data">
								<?php 
									$orderDetailModel = OrderDetail::find()->where(['orders_id' => $data->orders_id])->all(); 
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
										<td width="35%">
											<span class="pull-left"><?php echo $product->product_name . ' ' . $color; ?></span>
										</td>
										<td width="15%" align="center">
											<span><?php echo $product->orderDetailWarranty->warranty->warranty_number; ?></span>
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
		</div>
	</div>

</div>