<?php 
use backend\models\ServiceType;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Create Claim Service</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis">Claim Service</a></li>
					<li class="breadcrumb-item"><a href="#">Create Claim Service</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->
	
	<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/create" id="createWarrantyForm">
	<div class="row">
		<div class="col-12">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="mdi mdi-watch" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">PRODUCT INFORMATION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Product</b></label>
								<div class="col-8 col-form-label">
									<select name="product_id" onchange="getProductSelected()" class="form-control product-claim-service" required></select>
									<input type="hidden" name="product_attribute_id" id="product_attribute_id" value="" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Warranty Code / Number</b></label>
								<div class="col-8 col-form-label">
									<select name="warranty_id" onchange="getWarrantySelected()" required class="form-control product-warranty-number"></select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"></label>
								<div class="col-8 col-form-label" style="text-align: right;">
									<a href="#" data-toggle="modal" data-target="#lostWarrantyCode"><b>Lost Warranty Code / Number ?</b></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">SERVICE INFORMATION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Service List</b></label>
								<div class="col-8 col-form-label">
									<?php 
										$serviceTypeModel = ServiceType::findAll(["service_type_status" => 1]); 
										if(count($serviceTypeModel) > 0) {
										foreach($serviceTypeModel as $row){
									?>
									<div class="checkbox checkbox-custom">
										<input name="service_list[<?php echo $row->service_type_id; ?>]" id="<?php echo $row->service_type_id; ?>" type="checkbox">
										<label for="<?php echo $row->service_type_id; ?>">
											<?php echo $row->service_type_name; ?>
										</label>
									</div>
									<?php if($row->service_type_name == "Lainnya"){ ?>
									<div class="checkbox checkbox-custom" id="service_other_text" style="display: none;">
										<textarea class="form-control" rows="5" name="service_other_text"></textarea>
									</div>
									<?php } ?>
										<?php } ?>
										<?php } ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Product Condition Notes</b></label>
								<div class="col-8 col-form-label">
									<textarea class="form-control" rows="5" name="product_condition_notes"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hidden-print mt-4 mb-4">
					<div class="text-right">
						<button class="btn btn-info waves-effect waves-light" type="submit">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row hidden" id="firstService">
		<div class="col-12">
			<div class="card m-b-30 card-body">
				<div class="col-12" style="padding-left: 0; padding-right: 0;">
					<i class="fa fa-user" style="margin-top: 10px;"></i> <span style="margin-left: 10px;">CUSTOMER INFORMATION</span>
				</div>
				<hr>
				<div class="col-12" style="padding-left: 0;">
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Invoice Number</b></label>
								<div class="col-8 col-form-label">
									<input type="text" name="order_reference" class="form-control" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Email</b></label>
								<div class="col-8 col-form-label">
									<input type="email" name="customer_email" class="form-control" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Customer Name</b></label>
								<div class="col-8 col-form-label">
									<input type="text" name="customer_name" class="form-control" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-4 col-form-label"><b>Phone Number</b></label>
								<div class="col-8 col-form-label">
									<input type="text" name="phone_number" class="form-control" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	
	<div class="modal fade" id="lostWarrantyCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Find Warranty Code / Number</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group row" style="margin-bottom: 0.5rem;">
								<label class="col-4 col-form-label"><b>Email / Phone Number</b></label>
								<div class="col-8 col-form-label">
									<input type="text" class="form-control" id="customer_identifier" name="customer_identifier" value="" />
								</div>
							</div> 
						</div>
					</div>
					<div class="row">
						<table class="table">
							<thead>
								<tr>
									<th>Product Name</th>
									<th>Price</th>
									<th>Warranty Code</th>
									<th>Warranty Number</th>
									<th>Expire Date</th>
								</tr>
							</thead>
							<tbody id="warrantyData">
								<tr>
									<td colspan=5 align="center">NO DATA TO DISPLAY</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<style>
.hidden { display: none; }
</style>
<script>
var productItems, warrantyItems;

function getProductSelected(){
	$("#product_attribute_id").val(productItems[0].product_attribute_id);
}

function getWarrantySelected(){
	// first time service
	if(warrantyItems[0].status === "AVAILABLE"){
		$("div#firstService").removeClass("hidden");
		
		$("input[name=order_reference]").prop("required", true);
		$("input[name=phone_number]").prop("required", true);
	} else {
		$("div#firstService").addClass("hidden");
		
		$("input[name=order_reference]").prop("required", false);
		$("input[name=phone_number]").prop("required", false);
	}
}
</script>