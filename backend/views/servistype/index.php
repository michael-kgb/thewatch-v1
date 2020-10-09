<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Service Type</h4>

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
			<div class="card-box table-responsive">
				<h4 class="m-t-0 header-title m-b-30"><b>Service Type List</b></h4>
				
				<table id="data-service-type" class="table table-bordered" width=100%>
					<thead>
					<tr>
						<th width=10%>No</th>
						<th width=40%>Name</th>
						<th width=25%>Service Availability</th>
						<th width=15%>Status</th>
						<th width=10%></th>
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
var dataUrl = baseUrl + "/servistype/getallservicetype",
	dataColumn = [
        { "data" : "No", "name" : "No", "searchable" : false },
        { "data" : "service_type_name", "name" : "service_type_name" },
		{ "data" : "service_availability", "name" : "store_availability" },
		{ "data" : "service_type_status", "name" : "service_type_status" },
		{ "data" : "action", "name" : "action", "searchable" : false }
    ];
</script>