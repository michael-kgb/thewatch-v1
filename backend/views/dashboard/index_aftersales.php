<?php 
use common\components\Helpers;
use backend\models\Service;
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Dashboard</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->

	<?php 
		$connection = Yii::$app->getDb();
		$orderDateFrom = date('Y-m-d');
		$orderDateTo = date('Y-m-d');
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM service, service_history WHERE service.service_history_id = service_history.service_history_id AND service_history.service_state_lang_id IN (22, 20, 18, 17, 21, 19, 33, 34) ");
		$data = $command->queryAll();
		
		foreach($data as $row){
			$total_completed_service = $row['total'];
		}
		
		$totalServiceQuery = $connection->createCommand("
			SELECT COUNT(*) AS total, SUM(service_fee) as service_fee FROM service
		");
		
		$data = $totalServiceQuery->queryAll();
		
		foreach($data as $row){
			$total_service = $row['total'];
		}
		
		foreach($data as $row){
			$service_fee = $row['service_fee'];
		}
		
		$totalPendingService = $connection->createCommand("
			SELECT COUNT(*) AS total FROM service, service_history WHERE service.service_history_id = service_history.service_history_id AND service_history.service_state_lang_id NOT IN (22, 20, 18, 17, 21, 19, 33, 34)
		");
		
// 		$fourteendays = $connection->createCommand("
// 			SELECT a.service_id as a, b.service_id as b FROM service a INNER JOIN service b 
//                     ON a.service_id = b.service_id
//                     and a.service_id in (select c.service_id from service_history c where c.service_state_lang_id = 3 or c.service_state_lang_id = 4)
//                     and b.service_id in (select d.service_id from service_history d where d.service_state_lang_id = 33 or d.service_state_lang_id = 34)
// 		")->queryAll();

//         $fourteendays = $connection->createCommand("
// 			SELECT a.service_id as a FROM service where
//                     and a.service_id in (select c.service_id from service_history c where c.service_state_lang_id = 3 or c.service_state_lang_id = 4)
// 		")->queryAll();
		
// 		print_r($fourteendays);die();
		
		$data = $totalPendingService->queryAll();
		
		foreach($data as $row){
			$total_pending_service = $row['total'];
		}
		
		$totalProcess = $connection->createCommand("
			SELECT COUNT(*) AS total FROM service, service_history WHERE service.service_history_id = service_history.service_history_id AND service_history.service_state_lang_id IN (13, 14)
		")->queryAll();
		
		$total_process_service = 0;
		foreach($data as $row){
			$total_process_service = $row['total'];
		}
		
		function getPriceFormat($number) {
			return number_format($number, 0, '', ',');
		}
	?>
	<div class="row">
		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-watch float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">Total Service</h6>
				<h4 class="mb-3" data-plugin="counterup" style="font-size: 18px;"><?php echo $total_service; ?></h4>
			</div>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-tag float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">Service Fee</h6>
				<h4 class="mb-3" style="font-size: 18px;">IDR <span data-plugin="counterup"><?php echo getPriceFormat($service_fee); ?></span></h4>
			</div>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-check float-right"></i>
				<span class="text-muted text-uppercase mb-3" style='font-family: Roboto, sans-serif; font-weight: 500; font-size: 14px;'>Completed Service</span>
				<h4 class="mb-3" style="font-size: 18px; margin-top: 13px;"><?php echo $total_completed_service; ?></h4>
			</div>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-repeat float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">Pending Service</h6>
				<h4 class="mb-3" data-plugin="counterup" style="font-size: 18px;"><?php echo $total_pending_service; ?></h4>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-repeat float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">On Repairing Process</h6>
				<h4 class="mb-3" data-plugin="counterup" style="font-size: 18px;"><?php echo $total_process_service; ?></h4>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-repeat float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">More Than 14 Days Service</h6>
				<h4 id="pending_14_header" class="mb-3" data-plugin="counterup" style="font-size: 18px;"></h4>
			</div>
		</div>
	</div>
	<?php 
	
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card-box">
				<h4 class="header-title mb-4">Last 10 Service</h4>
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Reference</th>
							<th>Customer</th>
							<th>Status</th>
							<th>Date</th>
							<th style="text-align: right;">#</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i = 1; 
						$serviceModel = Service::find()
							->leftJoin("service_history", "service_history.service_history_id=service.service_history_id")
							->leftJoin("service_state_lang", "service_state_lang.service_state_lang_id=service_history.service_state_lang_id")
							->orderBy('service_id DESC')
							->andFilterWhere(["<>", "service.service_history_id", "0"])
							->limit(10)
							->all(); 
					?>
					<?php 
						if(count($serviceModel) > 0){ 
							foreach($serviceModel as $row){
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row->service_code; ?></td>
						<td><?php echo $row->orders->customer->firstname . ' ' . $row->orders->customer->lastname; ?></td>
						<td><?php echo $row->serviceHistory->serviceStateLang->text; ?></td>
						<td><?php echo date_format(date_create($row->service_date_add), 'j F Y g:i A'); ?></td>
						<td style="text-align: right;">
							<div class="btn-group">
								<a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/view/<?php echo $row->service_id; ?>" class="btn btn-default"><i class="fa fa-fw fa-eye"></i> View</a>
							</div>
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
		<div class="col-lg-12">
			<div class="card-box">
				<h4 class="header-title mb-4">14 Hari Lebih Service</h4>
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Reference</th>
							<th>Customer</th>
							<th>Jumlah Hari</th>
							<th>Date</th>
							<th style="text-align: right;">#</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i = 1; 
						$serviceModel = Service::find()
							->joinWith([
							    'serviceHistory'
							    ])
							->where(['or',
                                   ['service_history.service_state_lang_id'=>33],
                                   ['service_history.service_state_lang_id'=>34]
                               ])
							->orderBy('service_id DESC')
							->andFilterWhere(["<>", "service.service_history_id", "0"])
					
							->all(); 
					?>
					<?php 
					    $now = new DateTime();
						if(count($serviceModel) > 0){ 
							foreach($serviceModel as $row){
							    
    									$ref = new DateTime($row->service_date_add);
    									$diff = $ref->diff($now);
    									$different = $diff->format("%r%a");
							    if($different >= 14){
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row->service_code; ?></td>
						<td><?php echo $row->orders->customer->firstname . ' ' . $row->orders->customer->lastname; ?></td>
						<td><?php echo $different; ?></td>
						<td><?php echo date_format(date_create($row->service_date_add), 'j F Y g:i A'); ?></td>
						<td style="text-align: right;">
							<div class="btn-group">
								<a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/servis/view/<?php echo $row->service_id; ?>" class="btn btn-default"><i class="fa fa-fw fa-eye"></i> View</a>
							</div>
						</td>
					</tr>
				
						<?php $i++; } } ?>
					<?php } ?>
					</tbody>
				</table>
				<div id="total_14"><?php echo ($i - 1); ?></div>
			</div>
		</div>

	</div>
</div> <!-- container -->
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
      document.getElementById("pending_14_header").append(document.getElementById("total_14"));
    });
</script>