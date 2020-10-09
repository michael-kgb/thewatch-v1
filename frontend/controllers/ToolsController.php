<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\core\controller;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;
use backend\models\SpecificPrice;
use yii\web\Session;

class ToolsController extends controller\FrontendController {
    
    public $breadcrumb = ["Gift"];
    public $title = "";
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionRespon()
    {
		session_start();
		
		// we have bugs when receiving callback from ipay88
		// so we redirect it into last order history page for a while
		
		//$this->redirect('https://www.thewatch.co/user/orders');
		
        $merchantcode = $_POST["MerchantCode"];
        $paymentid = $_POST["PaymentId"];
        
        if(YII_ENV !== 'prod'){
            $merchantcode = "ID00071";
            $merchantkey = "Y2IoTLdbZu";
            $paymentid = 1;
        }else{
            if($merchantcode == "ID00071_S0001"){
                $merchantkey = "OCz9QkknOC";
            }else if($merchantcode == "ID00071_S0002"){
                $merchantkey = "yyoKGX6b35";
            }else if($merchantcode == "ID00071_S0003"){
                $merchantkey = "ObaoTJs1Hx";
            }
        }
		
		//echo $merchantkey;
		//die();
		   
        //$merchantkey = $_POST["MerchantKey"];
            
        $refno = $_POST["RefNo"];
        $amount = $_POST["Amount"];
        $ecurrency = $_POST["Currency"];
        $remark = $_POST["Remark"];
        $transid = $_POST["TransId"];
        $authcode = $_POST["AuthCode"];
        $estatus = $_POST["Status"];
        $errdesc = $_POST["ErrDesc"];
        $signature = $_POST["Signature"];

        function iPay88_signature($source)
        {
            return base64_encode(hex2bin2(sha1($source)));
        }
        function hex2bin2($hexSource)
        {
            for ($i=0;$i<strlen($hexSource);$i=$i+2)
        {
            $bin .= chr(hexdec(substr($hexSource,$i,2)));
        }
            return $bin;
        }
        
        $source = $merchantkey.$merchantcode.$paymentid.$refno.$amount.$ecurrency.$estatus;
        $strHash = iPay88_signature($source);

        $modelresponupdate = new \backend\models\MsPaymentcc();
		
		$modelresponupdate->refNo = $refno;
        $modelresponupdate->status = 'P';
        $modelresponupdate->transId = $transid;
        $modelresponupdate->resp_amount = $amount;
        $modelresponupdate->resp_signature = $signature;
        $modelresponupdate->remark = $remark;
        $modelresponupdate->resp_status = $estatus;
        $modelresponupdate->resp_authCode = $authcode;
        $modelresponupdate->resp_desc = $errdesc;
        $modelresponupdate->signature_respon_a = $strHash;
        $modelresponupdate->save();

        if($estatus == '1'){
            if($strHash == $signature){
                $resp_status = "Payment Success";
				
				$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 3])->order_state_lang_id;
				
				$orders = \backend\models\Orders::findOne(['reference' => $refno]);

                $orderHistory = new \backend\models\OrderHistory();
				$orderHistory->order_state_lang_id = $orderStateLangId;
				$orderHistory->orders_id = $orders->orders_id;
				$orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
				$orderHistory->date_add = date("Y-m-d H:i:s");
				$orderHistory->save();
				
				$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
				
				foreach($orderDetail as $detail){
					
					// update order detail history status
					$orderDetailHistory = new \backend\models\OrderDetailHistory();
					$orderDetailHistory->orders_id = $orders->orders_id;
					$orderDetailHistory->order_detail_id = $detail->order_detail_id;
					$orderDetailHistory->order_state_lang_id = $orderStateLangId;
					$orderDetailHistory->date_add = date("Y-m-d H:i:s");
					$orderDetailHistory->order_detail_state_lang_id = 1;
					$orderDetailHistory->save();
				}
				
            }else{
				
                $resp_status = "Payment Fail (Signature Not Match)";
				
				$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 3])->order_state_lang_id;

				$orders = \backend\models\Orders::findOne(['reference' => $refno]);
				
                $orderHistory = new \backend\models\OrderHistory();
				$orderHistory->order_state_lang_id = $orderStateLangId;
				$orderHistory->orders_id = $orders->orders_id;
				$orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
				$orderHistory->date_add = date("Y-m-d H:i:s");
				$orderHistory->save();

                // return product stock while payment failed
                $productList = \backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
                if (count($productList) > 0) {
                    foreach ($productList as $product) {

                        // update product stock quantity
                        $productStock = \backend\models\ProductStock::findOne([
                                    "product_id" => $product->product_id,
                                    "product_attribute_id" => $product->product_attribute_id
                        ]);

                        $productStock->quantity += $product->product_quantity;
                        $productStock->save();
                    }
                }
				
				$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
				
				foreach($orderDetail as $detail){
					
					// update order detail history status
					$orderDetailHistory = new \backend\models\OrderDetailHistory();
					$orderDetailHistory->orders_id = $orders->orders_id;
					$orderDetailHistory->order_detail_id = $detail->order_detail_id;
					$orderDetailHistory->order_state_lang_id = $orderStateLangId;
					$orderDetailHistory->date_add = date("Y-m-d H:i:s");
					$orderDetailHistory->order_detail_state_lang_id = 1;
					$orderDetailHistory->save();
				}
            }
        }else{
			
            $resp_status = "Payment Fail:".$errdesc;
			
			if($errdesc == 'Unable to perform capture'){
				
				$resp_status = "Payment Authorized, Please contact our customer service for information on the payment status of your order.";
				
			} else {
			
				$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 3])->order_state_lang_id;
				
				$orders = \backend\models\Orders::findOne(['reference' => $refno]);
				
				$orderHistory = new \backend\models\OrderHistory();
				$orderHistory->order_state_lang_id = $orderStateLangId;
				$orderHistory->orders_id = $orders->orders_id;
				$orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
				$orderHistory->date_add = date("Y-m-d H:i:s");
				$orderHistory->save();

				// return product stock while payment failed
				$productList = \backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
				if (count($productList) > 0) {
					foreach ($productList as $product) {

						// update product stock quantity
						$productStock = \backend\models\ProductStock::findOne([
									"product_id" => $product->product_id,
									"product_attribute_id" => $product->product_attribute_id
						]);

						$productStock->quantity += $product->product_quantity;
						$productStock->save();
					}
				}
				
				$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
				
				foreach($orderDetail as $detail){
					
					// update order detail history status
					$orderDetailHistory = new \backend\models\OrderDetailHistory();
					$orderDetailHistory->orders_id = $orders->orders_id;
					$orderDetailHistory->order_detail_id = $detail->order_detail_id;
					$orderDetailHistory->order_state_lang_id = $orderStateLangId;
					$orderDetailHistory->date_add = date("Y-m-d H:i:s");
					$orderDetailHistory->order_detail_state_lang_id = 1;
					$orderDetailHistory->save();
				}
				
			}
        }

        return $this->render('response',array(
            'strHash'=>$strHash,
            'source'=>$source,
            'response'=>$resp_status,
        ));
    }
	
	public function actionResponbackend(){
		
		session_start();
		
		$merchantcode = $_POST["MerchantCode"];
		$paymentid = $_POST["PaymentId"];
            
        if(YII_ENV !== 'prod'){
            $merchantcode = "ID00071";
            $merchantkey = "Y2IoTLdbZu";
            $paymentid = 1;
        }else{
            if($merchantcode == "ID00071_S0001"){
                $merchantkey = "OCz9QkknOC";
            }else if($merchantcode == "ID00071_S0002"){
                $merchantkey = "yyoKGX6b35";
            }else if($merchantcode == "ID00071_S0003"){
                $merchantkey = "ObaoTJs1Hx";
            }
        }
		
	  //  $merchantcode = $_POST["MerchantCode"];
		$refno = $_POST["RefNo"];
		$amount = $_POST["Amount"];
		$ecurrency = $_POST["Currency"];
		$remark = $_POST["Remark"];
		$transid = $_POST["TransId"];
		$authcode = $_POST["AuthCode"];
		$estatus = $_POST["Status"];
		$errdesc = $_POST["ErrDesc"];
		$signature = $_POST["Signature"];
		  //  $source = $merchantkey.$merchantcode.$refno.$amount.$amount00.$currency;
		function iPay88_signature($source)
		{
			return base64_encode(hex2bin2(sha1($source)));
		}
		function hex2bin2($hexSource)
		{
			for ($i=0;$i<strlen($hexSource);$i=$i+2)
			{
				$bin .= chr(hexdec(substr($hexSource,$i,2)));
			}
			return $bin;
		}
					
		$source = $merchantkey.$merchantcode.$paymentid.$refno.$amount.$ecurrency.$estatus;
		$strHash = iPay88_signature($source);
		
		$modelresponupdate = new \backend\models\MsPaymentcc();
		
		$modelresponupdate->refNo = $refno;
        $modelresponupdate->status = 'P';
        $modelresponupdate->transId = $transid;
        $modelresponupdate->resp_amount = $amount;
        $modelresponupdate->resp_signature = $signature;
        $modelresponupdate->remark = $remark;
        $modelresponupdate->resp_status = $estatus;
        $modelresponupdate->resp_authCode = $authcode;
        $modelresponupdate->resp_desc = $errdesc;
        $modelresponupdate->signature_respon_a = $strHash;
        $modelresponupdate->save();

		if($estatus == '1'){
			// if($strHash == $signature){
			// 	$resp_status = "RECEIVEOK";
			// }else{
			// 	$resp_status = "Signature Not Match";
            // }

            if($strHash == $signature){
                $resp_status = "RECEIVEOK";
				
				$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_success", "payment_method_id" => 3])->order_state_lang_id;
				
				$orders = \backend\models\Orders::findOne(['reference' => $refno]);

				$orderHistory = \backend\models\OrderHistory::find()->where(['order_id' => $orders->orders_id])->one();
				if($orderHistory != NULL){
					// skip update because order history already set
				} else {
					$orderHistory = new \backend\models\OrderHistory();
					$orderHistory->order_state_lang_id = $orderStateLangId;
					$orderHistory->orders_id = $orders->orders_id;
					$orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
					$orderHistory->date_add = date("Y-m-d H:i:s");
					$orderHistory->save();
				
					$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
					
					foreach($orderDetail as $detail){
						
						// update order detail history status
						$orderDetailHistory = new \backend\models\OrderDetailHistory();
						$orderDetailHistory->orders_id = $orders->orders_id;
						$orderDetailHistory->order_detail_id = $detail->order_detail_id;
						$orderDetailHistory->order_state_lang_id = $orderStateLangId;
						$orderDetailHistory->date_add = date("Y-m-d H:i:s");
						$orderDetailHistory->order_detail_state_lang_id = 1;
						$orderDetailHistory->save();
					}
				}
				
            }else{
				
                $resp_status = "Signature Not Match";
				
				$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 3])->order_state_lang_id;

				$orders = \backend\models\Orders::findOne(['reference' => $refno]);
				
                $orderHistory = \backend\models\OrderHistory::find()->where(['order_id' => $orders->orders_id])->one();
				if($orderHistory != NULL){
					// skip update because order history already set
				} else {
					$orderHistory = new \backend\models\OrderHistory();
					$orderHistory->order_state_lang_id = $orderStateLangId;
					$orderHistory->orders_id = $orders->orders_id;
					$orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
					$orderHistory->date_add = date("Y-m-d H:i:s");
					$orderHistory->save();

					// return product stock while payment failed
					$productList = \backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
					if (count($productList) > 0) {
						foreach ($productList as $product) {
	
							// update product stock quantity
							$productStock = \backend\models\ProductStock::findOne([
										"product_id" => $product->product_id,
										"product_attribute_id" => $product->product_attribute_id
							]);
	
							$productStock->quantity += $product->product_quantity;
							$productStock->save();
						}
					}
				
					$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
					
					foreach($orderDetail as $detail){
						
						// update order detail history status
						$orderDetailHistory = new \backend\models\OrderDetailHistory();
						$orderDetailHistory->orders_id = $orders->orders_id;
						$orderDetailHistory->order_detail_id = $detail->order_detail_id;
						$orderDetailHistory->order_state_lang_id = $orderStateLangId;
						$orderDetailHistory->date_add = date("Y-m-d H:i:s");
						$orderDetailHistory->order_detail_state_lang_id = 1;
						$orderDetailHistory->save();
					}
				}
            }
		}elseif($estatus == '0'){
            // $resp_status = "Payment Fail:".$errdesc;

            $resp_status = "Payment Fail:".$errdesc;
			
			if($errdesc == 'Unable to perform capture'){
				
				$resp_status = "Payment Authorized, Please contact our customer service for information on the payment status of your order.";
				
			} else {
			
				$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 3])->order_state_lang_id;
				
				$orders = \backend\models\Orders::findOne(['reference' => $refno]);
				
				$orderHistory = \backend\models\OrderHistory::find()->where(['order_id' => $orders->orders_id])->one();
				if($orderHistory != NULL){
					// skip update because order history already set
				} else {
					$orderHistory = new \backend\models\OrderHistory();
					$orderHistory->order_state_lang_id = $orderStateLangId;
					$orderHistory->orders_id = $orders->orders_id;
					$orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
					$orderHistory->date_add = date("Y-m-d H:i:s");
					$orderHistory->save();

					// return product stock while payment failed
					$productList = \backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
					if (count($productList) > 0) {
						foreach ($productList as $product) {
	
							// update product stock quantity
							$productStock = \backend\models\ProductStock::findOne([
										"product_id" => $product->product_id,
										"product_attribute_id" => $product->product_attribute_id
							]);
	
							$productStock->quantity += $product->product_quantity;
							$productStock->save();
						}
					}
				
					$orderDetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
					
					foreach($orderDetail as $detail){
						
						// update order detail history status
						$orderDetailHistory = new \backend\models\OrderDetailHistory();
						$orderDetailHistory->orders_id = $orders->orders_id;
						$orderDetailHistory->order_detail_id = $detail->order_detail_id;
						$orderDetailHistory->order_state_lang_id = $orderStateLangId;
						$orderDetailHistory->date_add = date("Y-m-d H:i:s");
						$orderDetailHistory->order_detail_state_lang_id = 1;
						$orderDetailHistory->save();
					}
				}
				
			}
		}else{
            // $resp_status = "Payment Pending:".$errdesc;
			
			// $orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "payment_failed", "payment_method_id" => 3])->order_state_lang_id;
			$orderStateLangId = \backend\models\OrderStateLang::findOne(["template" => "awaiting", "payment_method_id" => 3, "apps_language_id" => 1])->order_state_lang_id;

			$orders = \backend\models\Orders::findOne(['reference' => $refno]);
			
			// $orderHistory = new \backend\models\OrderHistory();
			$orderHistory = \backend\models\OrderHistory::find()->where(['order_id' => $orders->orders_id])->one();
			if($orderHistory != NULL){
				// skip update because order history already set
			} else {
				$orderHistory->order_state_lang_id = $orderStateLangId;
				$orderHistory->orders_id = $orders->orders_id;
				$orderHistory->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
				$orderHistory->date_add = date("Y-m-d H:i:s");
				$orderHistory->save();
			}
		}
		
		// echo $resp_status;
		
		return $this->render('response',array(
            'strHash'=>$strHash,
            'source'=>$source,
            'response'=>$resp_status,
        ));
		die();
	}

}
