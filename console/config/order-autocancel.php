<?php
date_default_timezone_set("Asia/Jakarta");
/**
 * @var \omnilight\scheduling\Schedule $schedule
 */

// Place here all of your cron jobs

// This command will execute ls command 
$schedule->call(function(\yii\console\Application $app) {
    $orderReminder = \backend\models\OrdersReminder::find()->where(['orders_reminder_status' => 1])->all();
	$current = date('Y-m-d H:i:s');
	
	if(count($orderReminder) > 0){
		foreach($orderReminder as $reminder){
				
			// automatic cancel order
			if($reminder->orders_canceled_date <= $current){
				
				$currentProductOrderStatus = '';
				
				$orderHistory = \backend\models\OrderHistory::find()
					->orderBy('date_add DESC')
					->where(['orders_id' => $reminder->orders_id])
					->one();
					
				if($orderHistory != NULL){
					if($orderHistory->orderStateLang->template == 'awaiting'){
						
						$currentOrderStatus = $orderHistory->orderStateLang->name;
						
						$orderUpdate = new \backend\models\OrderHistory();
						$orderUpdate->orders_id = $reminder->orders_id;
						$orderUpdate->order_state_id = $orderHistory->order_state_id;
						$paymentMethod = \backend\models\OrderStateLang::findOne(['order_state_lang_id' => $orderHistory->order_state_lang_id]);
						
						// get current order payment method lang id for canceled order 
						if($paymentMethod != NULL){
							$cancelOrder = \backend\models\OrderStateLang::findOne([
								'payment_method_id' => $paymentMethod->payment_method_id, 'template' => 'order_canceled'
							]);
							$orderUpdate->order_state_lang_id = $cancelOrder->order_state_lang_id;
						}
						
						$orderUpdate->date_add = date('Y-m-d H:i:s');
						
						$orderUpdate->save();
						
						// update order reminder status
						$reminder->orders_reminder_status = 0;
						$reminder->save();
						
						// create activity log for current inventory status
						$log = new \backend\models\Log();
						$log->fullname = 'SYSTEM';
						$log->module = 'orders';
						$log->action = 'update';
						$log->action_text = 'SYSTEM auto update Order status from ' . $currentOrderStatus . ' to [Canceled]';
						$log->date_time = date("Y-m-d H:i:s");
						$log->id_onChanged = $reminder->orders_id;
						$log->save();
					}
				}
			}
		}
	}
});