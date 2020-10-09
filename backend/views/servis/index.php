<?php 
use backend\models\ServiceStateLang;
use backend\models\Stores;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Claim Service</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="#">Claim Service</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-12">
			<div class="card-box table-responsive m-b-30">
				<h4 class="m-t-0 header-title m-b-30"><b>Filter Claim Service</b></h4>
				
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputEmail4" class="col-form-label">Service Date :</label>
						<div class="form-row">
							<div class="col-md-8">
								<div class="form-group row">
									<div class="col-3" style="padding-right: 0;">
										<input class="form-control" type="date" name="date_from" value="<?php echo date('Y-m-d'); ?>">
									</div>
									<div class="col-1" style="padding-left: 0; max-width: 19%;">
										<span class="input-group-addon" style="height: 38.36px;">
                                            <span class="dripicons-calendar"></span>&nbsp; From &nbsp;
                                        </span>
									</div>
									<div class="col-3" style="padding-right: 0;">
										<input class="form-control" type="date" name="date_to" value="<?php echo date('Y-m-d'); ?>">
									</div>
									<div class="col-1" style="padding-left: 0; max-width: 19%;">
										<span class="input-group-addon" style="height: 38.36px;">
											<span class="dripicons-calendar"></span>&nbsp; To &nbsp;
										</span>
									</div>
								</div>
							</div>
						</div>
						<label for="inputEmail4" class="col-form-label">Store Location :</label>
						<div class="form-row">
							<div class="col-md-8">
								<div class="form-group">
									<?php 
										$departement = Yii::$app->session->get('userInfo')['departement'];
										$store_id = Yii::$app->session->get('userInfo')['store_id'];
										
										$storeModel = Stores::findAll(["store_status" => "active"]); 
										if($departement == "Store Staff"){
											$storeModel = Stores::findAll(["store_status" => "active"]); 
										}
									?>
									<?php if(count($storeModel) > 0){ ?>
									<select class="form-control" id="service_detail_drop_store_id" name="service_detail_drop_store_id">
										<option value="0">Please Select</option>
										<?php foreach($storeModel as $row){ ?>
										<option value="<?php echo $row->store_id; ?>"><?php echo $row->store_name . ' ' . $row->store_slug; ?></option>
										<?php } ?>
									</select>
									<?php } ?>
								</div>
							</div>
						</div>
						<label class="col-form-label">Service Status</label>
						<div class="form-row">
							<div class="col-md-8">
								<div class="form-group">
									<?php $serviceStateLangModel = ServiceStateLang::findAll(["apps_language_id" => 1]); ?>
									<?php if(count($serviceStateLangModel) > 0){ ?>
									<select class="form-control" id="service_state_lang_id" name="service_state_lang_id">
										<option value="0">Please Select</option>
										<?php foreach($serviceStateLangModel as $row){ ?>
										<option value="<?php echo $row->service_state_lang_id; ?>"><?php echo $row->text; ?></option>
										<?php } ?>
									</select>
									<?php } ?>
								</div>
							</div>
						</div>
						<label class="col-form-label">Export</label>
						<div class="form-row">
							<div class="col-md-8">
								<div class="form-group">
									<select class="form-control" id="export_to" name="export_to">
										<option value="0">Please Select</option>
										<option value="Excel">Excel</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="pull-right">
									<button type="button" id="filter-servis" class="btn btn-primary waves-effect waves-light"><i class="fa fa-search"></i> Filter</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card-box table-responsive">
				<h4 class="m-t-0 header-title m-b-30"><b>Service List</b></h4>
				
				<div class="btn-toolbar m-b-30">
					<a class="btn btn-info waves-effect waves-light" href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/create" target="_blank"> <i class="fa fa-plus m-r-5"></i> <span>Add New</span> </a>
					<?php if(Yii::$app->session->get('userInfo')['store_id'] != 149) { ?>
					<a class="btn btn-info waves-effect waves-light" href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/return" target="_blank" style="margin-left:30px;"> <span>Daftar Service Drop dari Service Center</span> </a>
				    <?php } ?>
				</div>
			
				
				<table id="data-service" class="table table-bordered" width=100%>
					<thead>
					<tr>
						<th width=10%>No</th>
						<th>Reference</th>
						<th>Customer</th>
						<th>PIC</th>
						<th>Drop</th>
						<th>Return</th>
						<th>Status</th>
						<th>Date</th>
						<th></th>
					</tr>
					</thead>

					<tbody>
					
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- end row -->
</div>
<script>
var dataUrl = baseUrl + "/servis/getallservice",
	dataColumn = [
        { "data" : "No", "name" : "No", "searchable" : false },
        { "data" : "service_code", "name" : "service_code", "orderable" : false },
		{ "data" : "customer", "name" : "customer", "orderable" : false },
		{ "data" : "pic", "name" : "pic", "orderable" : false },
		{ "data" : "drop", "name" : "drop", "orderable" : false },
		{ "data" : "return", "name" : "return", "orderable" : false },
		{ "data" : "service_status", "name" : "service_status", "orderable" : false },
		{ "data" : "date", "name" : "date", "orderable" : false },
		{ "data" : "action", "name" : "action", "searchable" : false, "orderable" : false },
		{ "data" : "service_date_from", "name" : "service_date_from", "searchable" : false },
		{ "data" : "service_date_to", "name" : "service_date_to", "searchable" : false },
		{ "data" : "service_state_lang_id", "name" : "service_state_lang_id", "searchable" : false },
		{ "data" : "service_detail_drop_store_id", "name" : "service_detail_drop_store_id", "searchable" : false }
    ];
</script>