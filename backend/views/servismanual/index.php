<?php 
use backend\models\ServiceStateLang;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Claim Service Manual</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="#">Claim Service Manual</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-12">
			<div class="card-box table-responsive m-b-30">
				<h4 class="m-t-0 header-title m-b-30"><b>Filter Claim Service Manual</b></h4>
				
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputEmail4" class="col-form-label">Date :</label>
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
						<label class="col-form-label">Status</label>
						<div class="form-row">
							<div class="col-md-8">
								<div class="form-group">
									<select class="form-control" id="service_state_lang_id" name="service_state_lang_id">
										<option value="">Please Select</option>
										<option value="Valid">Valid</option>
										<option value="Invalid">Invalid</option>
										<option value="Awaiting Confirmation">Awaiting Confirmation</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="pull-right">
									<button type="button" id="filter-servis-manual" class="btn btn-primary waves-effect waves-light"><i class="fa fa-search"></i> Filter</button>
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
				<h4 class="m-t-0 header-title m-b-30"><b>Claim Service Manual List</b></h4>
				
				<table id="data-service-manual" class="table table-bordered" width=100%>
					<thead>
					<tr>
						<th width=10%>No</th>
						<th>Reference</th>
						<th>Customer</th>
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
var dataUrl = baseUrl + "/servismanual/getallservice",
	dataColumn = [
        { "data" : "No", "name" : "No", "searchable" : false },
        { "data" : "reference", "name" : "reference", "orderable" : false },
		{ "data" : "customer", "name" : "customer", "orderable" : false },
		{ "data" : "status", "name" : "status", "orderable" : false },
		{ "data" : "date", "name" : "date", "orderable" : false },
		{ "data" : "action", "name" : "action", "searchable" : false, "orderable" : false },
		{ "data" : "claim_service_manual_date_from", "name" : "service_date_from", "searchable" : false },
		{ "data" : "claim_service_manual_date_to", "name" : "service_date_to", "searchable" : false }
    ];
</script>