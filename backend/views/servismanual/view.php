<?php 
use backend\models\ProductImage;
use common\components\Helpers;
use backend\models\Stores;
use backend\models\ProductDetail;
use backend\models\ProductAttributeCombination;

$productImageModel = ProductImage::findOne(["product_id" => $data->product_id, "cover" => 1]);
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">View Claim Service Manual</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis">Claim Service Manual</a></li>
					<li class="breadcrumb-item"><a href="#">View Claim Service Manual</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->
	
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30 card-body">
				<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servismanual/view/<?php echo $data->service_claim_manual_id; ?>">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="mdi mdi-watch" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">Claim Service Manual Detail</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					
					<div class="form-row">
						<div class="form-group col-md-6">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Customer</b></label>
								<div class="col-8 col-form-label">
									<?php echo $data->customer->firstname . ' ' . $data->customer->lastname; ?>
								</div>
							</div>   
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Invoice Number</b></label>
								<div class="col-8 col-form-label">
									<?php echo $data->reference; ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Warranty Code</b></label>
								<div class="col-8 col-form-label">
									<?php echo $data->warranty_code; ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Status</b></label>
								<div class="col-6 col-form-label">
									<select <?php echo $data->service_claim_manual_status == "Valid" ? "disabled" : ""; ?> name="service_claim_manual_status" class="form-control">
									<option value="Valid" <?php echo $data->service_claim_manual_status == "Valid" ? "selected" : ""; ?>>Valid</option>
									<option value="Invalid" <?php echo $data->service_claim_manual_status == "Invalid" ? "selected" : ""; ?>>Invalid</option>
									<option value="Awaiting Confirmation" <?php echo $data->service_claim_manual_status == "Awaiting Confirmation" ? "selected" : ""; ?>>Awaiting Confirmation</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Active Date</b></label>
								<div class="col-6 col-form-label">
									<input class="form-control" type="date" name="active_date" value="<?php echo date('Y-m-d'); ?>" />
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Invoice Image</b></label>
								<div class="col-8 col-form-label">
									<?php if($data->reference_img != ""){ ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/invoice/<?php echo $data->service_claim_manual_id; ?>/<?php echo $data->reference_img == "" ? "img-default.jpg" : $data->reference_img; ?>" target="_blank"><img src="https://www.thewatch.co/img/warranty/service/uploads/invoice/<?php echo $data->service_claim_manual_id; ?>/<?php echo $data->reference_img == "" ? "img-default.jpg" : $data->reference_img; ?>" width="200" /></a>
									<?php } else { ?>
									<a href="https://www.thewatch.co/img/warranty/service/uploads/invoice/<?php echo $data->reference_img == "" ? "img-default.jpg" : $data->reference_img; ?>" target="_blank"><img src="https://www.thewatch.co/img/warranty/service/uploads/invoice/<?php echo $data->reference_img == "" ? "img-default.jpg" : $data->reference_img; ?>" width="200" /></a>
									<?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Purchase Store</b></label>
								<div class="col-8 col-form-label">
									<?php $storesModel = Stores::findAll(["store_status" => "active"]); ?>
									<?php if(count($storesModel) > 0){ ?>
									<select name="store_id" class="form-control">
										<option value="0">PLEASE SELECT</option>
										<?php foreach($storesModel as $row){ ?>
										<option <?php echo $data->store_id == $row->store_id ? "selected" : ""; ?> value="<?php echo $row->store_id; ?>"><?php echo $row->store_name . ' ' . $row->store_address; ?></option>
										<?php } ?>
									</select>
									<?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Other Name</b></label>
								<div class="col-8 col-form-label">
								
									    <input placeholder="Nama Toko" type="" class="form-control" name="other_store" value="<?php echo $data->other_store; ?>">

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hidden-print" style="margin-top: 10px;">
					<div class="text-right">
						<button type="submit" class="btn btn-gradient waves-light waves-effect w-md">Update</button>
					</div>
				</div>
				</form>
				<div class="col-md-12" style="padding-left: 0; padding-right: 0;">
					<div class="table-responsive">
						<table class="table mt-4">
							<thead>
								<tr>
									<th width=10%>Image</th>
									<th width=40%>Item</th>
									<th width=30%>Brand</th>
									<th width=20%>Unit Price</th>
								</tr>
							</thead>
							<tbody id="product-body-data">
								<tr>
									<td width="10%">
										<img src="https://www.thewatch.co/img/product/<?php echo $productImageModel->product_image_id; ?>/<?php echo $productImageModel->product_image_id; ?>_small.jpg" class="img-responsive" />
									</td>
									<td width="40%">
										<span class="pull-left">
											<?php 
												$productDetailModel = ProductDetail::findOne(["product_id" => $data->product_id]);
												
												echo $productDetailModel != NULL ? $productDetailModel->name : "";
												if($data->product_attribute_id != 0){
													$productAttributeModel = ProductAttributeCombination::findOne(["product_attribute_id" => $data->product_attribute_id]);
													echo $productAttributeModel != NULL ? " " . $productAttributeModel->attributeValue->value : "";
												}
												//echo ProductDetail::findOne(["product_id" => $data->product_id])->name . ' ' . ProductAttribute::findOne(["product_attribute_id" => $data->product_attribute_id]) != NULL ? ProductAttribute::findOne(["product_attribute_id" => $data->product_attribute_id])->productAttributeCombination->attributeValue : ""; 
											?>
										</span>
									</td>
									<td width="30%">
										<span class="pull-left"><?php echo $data->brands->brand_name; ?></span>
									</td>
									<td width="20%">
										<span>IDR</span>
										<span id="unit-price-1" class="pull-right"><?php echo Helpers::getPriceFormat($data->product->price); ?></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>