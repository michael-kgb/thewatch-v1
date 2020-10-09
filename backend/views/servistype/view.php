<?php 
use backend\models\Stores;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Detail Service Type</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="#">Service Type</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-12">
			<div class="card-box">
				<div class="p-20">
					<form class="form-horizontal" role="form">
						<?php if($data != NULL){ ?>
						<div class="form-group row">
							<label class="col-2">Service Type :</label>
							<div class="col-10">
								<?php echo $data->service_type_name; ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-2">Service Availability :</label>
							<div class="col-3">
								<?php if(count($storeList) > 0){ ?>
								<?php 
								foreach($storeList as $row){ 
									echo '- ' . $row->stores->store_name . ' ' . $row->stores->store_location . '<br>';
								} 
								?>
								<?php } ?>
							</div>
							<div class="col-7"><a href="#" data-toggle="modal" data-target="#editServiceTypeStore">Edit</a></div>
						</div>
						<div class="form-group row">
							<label class="col-2">Service Availability :</label>
							<div class="col-10">
								<?php echo $data->service_type_status == 1 ? "Active" : "Inactive"; ?>
							</div>
						</div>
						<?php } ?>
					</form>
				</div>
				<div class="modal fade" id="editServiceTypeStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Update Service Store Availability</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form method="POST" action="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servistype/view/<?php echo $data->service_type_id; ?>">
							<div class="modal-body">
								<div class="row">
									<div class="col-12">
										<select id="store-select2" class="form-control" name="store_id[]" multiple="multiple">
											<?php 
												$stores = Stores::findAll(["store_status" => "active"]); 
												if(count($stores) > 0){
												foreach($stores as $store){
											?>
											<option value="<?php echo $store->store_id; ?>" <?php if(count($storeList) > 0){ foreach($storeList as $row){ echo $row->store_id == $store->store_id ? "selected" : "";  } } ?>><?php echo $store->store_name . ' ' . $store->store_location; ?></option>
											<?php } ?>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end row -->
</div>