<?php 
use backend\models\ServiceStateLang;
use backend\models\Stores;
?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Survei Answer</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="#">Survei Answer</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-check float-right"></i>
				<span class="text-muted text-uppercase mb-3" style='font-family: Roboto, sans-serif; font-weight: 500; font-size: 14px;'>Avg Kecepatan (%)</span>
				<h4 class="mb-3" style="font-size: 18px; margin-top: 13px;"><?php echo $avg_kecepatan; ?></h4>
			</div>
		</div>
    
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-check float-right"></i>
				<span class="text-muted text-uppercase mb-3" style='font-family: Roboto, sans-serif; font-weight: 500; font-size: 14px;'>Avg Kerapihan (%)</span>
				<h4 class="mb-3" style="font-size: 18px; margin-top: 13px;"><?php echo $avg_kerapihan; ?></h4>
			</div>
		</div>
    
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-check float-right"></i>
				<span class="text-muted text-uppercase mb-3" style='font-family: Roboto, sans-serif; font-weight: 500; font-size: 14px;'>Avg Kemudahan (%)</span>
				<h4 class="mb-3" style="font-size: 18px; margin-top: 13px;"><?php echo $avg_kemudahan; ?></h4>
			</div>
		</div>
    </div>
	<div class="row">
		<div class="col-12">
			<div class="card-box table-responsive">
				<h4 class="m-t-0 header-title m-b-30"><b>Survei Answer List</b></h4>
				
				<div class="btn-toolbar m-b-30">
					<!--<a class="btn btn-info waves-effect waves-light" href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/create" target="_blank"> <i class="fa fa-plus m-r-5"></i> <span>Add New</span> </a>-->
					<?php if(Yii::$app->session->get('userInfo')['store_id'] != 149) { ?>
					<a class="btn btn-info waves-effect waves-light" href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/return" target="_blank" style="margin-left:30px;"> <span>Daftar Service Drop dari Service Center</span> </a>
				    <?php } ?>
				</div>
			
				
				<table id="data-feedback" class="table table-bordered" width=100%>
					<thead>
					<tr>
						<th width=10%>No</th>
						<th>Reference</th>
						<th>Customer Name</th>
						<th>Kecepatan</th>
						<th>Kerapihan</th>
						<th>Kemudahan</th>
						<th>Lainnya</th>
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
var dataUrl = baseUrl + "/feedback/getall",
	dataColumn = [
        { "data" : "No", "name" : "No", "searchable" : false },
        { "data" : "service_code", "name" : "service_code", "orderable" : false },
		{ "data" : "customer", "name" : "customer", "orderable" : false },
		{ "data" : "kecepatan", "name" : "kecepatan", "orderable" : false },
		{ "data" : "kerapihan", "name" : "kerapihan", "orderable" : false },
		{ "data" : "kemudahan", "name" : "kemudahan", "orderable" : false },
		{ "data" : "lainnya", "name" : "lainnya", "orderable" : false },
		{ "data" : "date", "name" : "date", "orderable" : false },
		{ "data" : "action", "name" : "action", "searchable" : false, "orderable" : false },
		{ "data" : "service_date_from", "name" : "service_date_from", "searchable" : false },
		{ "data" : "service_date_to", "name" : "service_date_to", "searchable" : false },
		{ "data" : "service_state_lang_id", "name" : "service_state_lang_id", "searchable" : false },
		{ "data" : "service_detail_drop_store_id", "name" : "service_detail_drop_store_id", "searchable" : false }
    ];
</script>