<?php 
use common\components\Helpers;
use backend\models\Orders;
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
		$orderDate = "(orders.date_add BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM orders WHERE store_id = " . $store_id . " AND ".$orderDate." ");
		$data = $command->queryAll();
		
		foreach($data as $row){
			$total_orders = $row['total'];
		}
		
		$revenueQuery = $connection->createCommand("
			SELECT 
				SUM(order_detail.product_price) as revenue
			FROM 
				orders 
					LEFT JOIN order_detail ON (orders.orders_id = order_detail.orders_id)
			WHERE 
				store_id = " . $store_id . " AND 
				".$orderDate." 
		");
		
		$data = $revenueQuery->queryAll();
		
		foreach($data as $row){
			$revenue = $row['revenue'];
		}
		
		$avgQuery = $connection->createCommand("
			SELECT 
				round(AVG(order_detail.product_price), 0) as average
			FROM 
				orders 
					LEFT JOIN order_detail ON (orders.orders_id = order_detail.orders_id)
			WHERE 
				store_id = " . $store_id . " AND 
				".$orderDate." 
		");
		
		$data = $avgQuery->queryAll();
		
		foreach($data as $row){
			$avg = $row['average'];
		}
		
		$totalSoldQuery = $connection->createCommand("
			SELECT 
				SUM(order_detail.product_quantity) as total_sold
			FROM 
				orders 
					LEFT JOIN order_detail ON (orders.orders_id = order_detail.orders_id)
			WHERE 
				store_id = " . $store_id . " AND 
				".$orderDate." 
		");
		
		$data = $totalSoldQuery->queryAll();
		
		foreach($data as $row){
			$total_sold = $row['total_sold'];
		}
		
		function getPriceFormat($number) {
			return number_format($number, 0, '', ',');
		}
	?>
	<div class="row">
		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-bag float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">Orders</h6>
				<h4 class="mb-3" data-plugin="counterup" style="font-size: 18px;"><?php echo $total_orders; ?></h4>
			</div>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-bar-graph float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">Revenue</h6>
				<h4 class="mb-3" style="font-size: 18px;">IDR <span data-plugin="counterup"><?php echo getPriceFormat($revenue); ?></span></h4>
			</div>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-tag float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">Average Price</h6>
				<h4 class="mb-3" style="font-size: 18px;">IDR <span data-plugin="counterup"><?php echo getPriceFormat($avg); ?></span></h4>
			</div>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card-box tilebox-one">
				<i class="fi-briefcase float-right"></i>
				<h6 class="text-muted text-uppercase mb-3">Product Sold</h6>
				<h4 class="mb-3" data-plugin="counterup" style="font-size: 18px;"><?php echo $total_sold; ?></h4>
			</div>
		</div>
	</div>
	<?php 
	
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card-box">
				<h4 class="header-title mb-4">Last 10 Orders</h4>
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Invoice No</th>
							<th>Customer</th>
							<th>Payment</th>
							<th>Amount</th>
							<th>Date</th>
							<th style="text-align: right;">#</th>
						</tr>
					</thead>
					<tbody>
					<?php $i = 1; $ordersModel = Orders::find()->where(["store_id" => $store_id])->andWhere(['between','date_add', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00'])->orderBy('orders_id DESC')->limit(10)->all(); ?>
					<?php 
						if(count($ordersModel) > 0){ 
							foreach($ordersModel as $order){
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $order->reference; ?></td>
						<td><?php echo $order->customer->firstname . ' ' . $order->customer->lastname; ?></td>
						<td><?php echo $order->paymentmethoddetail->payment->name_bank; ?></td>
						<td>IDR <?php echo getPriceFormat($order->total_product_price); ?></td>
						<td><?php echo date_format(date_create($order->date_add), 'j F Y g:i A'); ?></td>
						<td style="text-align: right;">
							<div class="btn-group">
								<a href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/orders/view/<?php echo $order->orders_id; ?>" class="btn btn-default"><i class="fa fa-fw fa-eye"></i> View</a>
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
</div> <!-- container -->