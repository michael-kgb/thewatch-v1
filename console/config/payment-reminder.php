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
			
			// send payment order reminder email
			if($reminder->orders_reminder_date >= $current){
				
				$orderHistory = \backend\models\OrderHistory::find()
					->orderBy('date_add DESC')
					->where(['orders_id' => $reminder->orders_id])
					->one();
					
				if($orderHistory != NULL){
					if($orderHistory->orderStateLang->template == 'awaiting'){
						
						// send email notification to customer about current order status
						$view = new yii\base\View();
						
						$customer = \backend\models\Customer::findOne(['customer_id' => $reminder->orders->customer_id]);
						$orderDetail = \backend\models\OrderDetail::findAll(['orders_id' => $reminder->orders_id]);
						$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $reminder->orders_id]);
						
						\common\components\Helpers::sendScheduleEmailMandrillUrlAPI(
							$view->renderFile('@app/views/template/mail/payment_reminder.php', array(
								"firstname" => $customer != NULL ? $customer->firstname : "",
								"cancelDate" => $reminder->orders_canceled_date,
								"orderDetail" => $orderDetail,
								"discount" => $orderCartRule != NULL ? $orderCartRule->value : 0,
								"shipping" => $reminder->orders->total_shipping,
								"shippinginsurance" => $reminder->orders->total_shipping_insurance,
								"kodeunik" => $reminder->orders->unique_code
							)), 
							'Order Information - Payment Reminder', 
							'notification@thewatch.co', 
							$customer->email,
							''
						);
						
						// update order reminder status
						$reminder->orders_reminder_status = 0;
						$reminder->orders_reminder_sent_date = $current; 
						$reminder->save();
					}
				}
			}
			
		}
	}
	
	
	// schedule for shipping reminder
      $shippingReminder = \backend\models\OrdersReminder::find()->where(['orders_reminder_shipping_status' => 1])->all();
      if(count($shippingReminder) > 0){
        foreach($shippingReminder as $reminder){
          
          // send payment order reminder email
          if($reminder->orders_reminder_shipping_date <= $current){
            
                     
                  // send email notification to customer about current order status
                $view = new yii\base\View();
                
                $orders = \backend\models\Orders::findOne(["orders_id" => $reminder->orders_id]);
    
                $token_generate = md5($current.'+'.$orders->orders_id);
               
                  $token = new \backend\models\Token();
                  $token->token_generate = $token_generate;
                  $token->token_status = 1;
                  $token->token_date_add = $current;
                  $token->token_date_expirated = date('Y-m-d H:i:s', strtotime("+7 day", strtotime($current)));
                  $token->save();
               
                
                \common\components\Helpers::sendScheduleEmailMandrillUrlAPI(
                  $view->renderFile('@app/views/template/mail/shipping_reminder.php', array(
                    "model" => $orders,
                    "token"=>$token_generate,
                  )), 
                  'Apakah barang pesanan Anda sudah diterima?', 
                  'notification@thewatch.co', 
                  $orders->customer->email,
                  ''
                );
    
                // echo 'ada'.$orders->customer->email;
                
                // update order reminder status
                $reminder->orders_reminder_shipping_status = 0;
                $reminder->orders_reminder_shipping_sent_date = $current; 
                $reminder->save();
            
          }
          
        }
      }
	
	// schedule for service 
	$serviceReminder = \backend\models\ServiceReminder::find()->where(['service_reminder_status' => 1])->all();
	if(count($serviceReminder) > 0){
		foreach($serviceReminder as $reminder){
			
			// send reminder email
			if($reminder->service_reminder_date <= $current){
			
						
						// send email notification to customer about current order status
						$view = new yii\base\View();
						
						$service_data = \backend\models\Service::findOne($reminder->service_id);
						
						\common\components\Helpers::sendScheduleEmailMandrillUrlAPI(
        					$view->renderFile('@app/views/template/mail/warranty_customer_receive.php', array(
        						"data" => $service_data
        					)), 'Terima Produk Anda', 'notification@thewatch.co', $service_data->orders->customer->email, ''
        				);
						
						// update order reminder status
						$reminder->service_reminder_status = 0;
						$reminder->service_reminder_sent_date = $current;
						$reminder->service_received_date = date('Y-m-d H:i:s', strtotime('+3 day', time()));
						$reminder->service_received_status = 1;
					    $reminder->save();
				
			}
			
		
			 
		}
	}
	
	$serviceReceive = \backend\models\ServiceReminder::find()->where(['service_received_status' => 1])->all();
	if(count($serviceReceive) > 0){
		foreach($serviceReceive as $reminder){
		
			// if customer not click receive
			if($reminder->service_received_date < $current){
			    
			        $service = \backend\models\Service::find()->where(['service_id'=>$reminder->service_id])->one();
        
                    $service_history = new \backend\models\ServiceHistory();
                    $service_history->service_id = $reminder->service_id;
                    $service_history->service_state_lang_id = 33;
                    $service_history->date_add = date('Y-m-d H:i:s');
                    $service_history->save();   
                    
                    $service->service_history_id = $service_history->service_history_id;
                    $service->update();
                    
                    $reminder->service_received_status = 0;
                    $reminder->save();
			   
			}
			
			 
		}
	}
});