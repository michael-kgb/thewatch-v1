<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\CustomerForm;
use yii\web\Session;

/**
 * Site controller
 */
class StatusController extends \frontend\core\controller\FrontendController {

    public $breadcrumb = ["Brands"];
    public $title = "";

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
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


    public function actionCancel($action, $id) {
        // echo '<br>';echo $id;die();
        // Check token valid
        $token = \backend\models\Token::find()->where(['token_status'=>1])->andWhere(['token_generate'=>$action])->andWhere(['>=','token_date_expirated',date("Y-m-d H:i:s")])->one();
       
        if($token == null){
            $this->redirect('https://www.thewatch.co');
        }else{
            $token->token_status = 0;
            $token->save();

            $orders = \backend\models\Orders::findOne(["reference" => $id]);
            if($orders != null){
                $order_state_lang = \backend\models\OrderStateLang::find()->where(['payment_method_id'=>$orders->paymentmethoddetail->payment_method_id])->andWhere(['template'=>'customer_cancel'])->andWhere(['apps_language_id'=>2])->one();
                
                // echo $order_state_lang->order_state_lang_id;die();
                $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();

                foreach ($orderdetail as $row) {
                    // $product_stock = \backend\models\ProductStock::find()->where(['product_id' => $row->product_id, 'product_attribute_id' => $row->product_attribute_id])->one();
                    // $product_stock->quantity = $product_stock->quantity + $row->product_quantity;
                    // $product_stock->save();

                    // $productHasAttribute = FALSE;

                    // $productAttribute = \backend\models\ProductAttributeCombination::findOne(['product_attribute_id' => $row->product_attribute_id]);

                    // if($productAttribute != NULL){
                    //     $productHasAttribute = TRUE;
                    // }

                    // $product = \backend\models\ProductStock::findOne(["product_attribute_id" => $row->product_attribute_id, "product_id" => $row->product_id]);
                    // $currentQuantity = $product->quantity;

                    // current product status
                    $status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();

                    $currentProductInventoryStatus = '';
                    $currentProductOrderStatus = '';

                    foreach($status as $rowStatus){
                        $currentProductInventoryStatus = $rowStatus->orderDetailStateLang->name;
                        $currentProductOrderStatus = $rowStatus->orderStateLang->name;
                        break;
                    }

                    $orderDetailHistory = new \backend\models\OrderDetailHistory();
                    $orderDetailHistory->orders_id = $orders->orders_id;
                    $orderDetailHistory->order_detail_id = $row->order_detail_id;
                    $orderDetailHistory->order_state_lang_id = $order_state_lang->order_state_lang_id;
                    $orderDetailHistory->order_detail_state_lang_id = 1;
                    $orderDetailHistory->date_add = date("Y-m-d H:i:s");
                    // if(isset($value['notes'])){
                    $orderDetailHistory->notes = 'from customer';
                    // }
                    $orderDetailHistory->save();

                        // create activity log for current quantity
                    // $log = new \backend\models\Log();
                    // $log->fullname = substr($orders->customer->email, 0, 20);
                    // $log->module = 'products';
                    // $log->action = 'update';
                    // if($productHasAttribute){
                    //     $log->action_text = 'customer email: '. $log->fullname . ' update Quantity [' . $productAttribute->attributeValue->value . '] FROM ' . $currentQuantity . ' TO ' . $product_stock->quantity;
                    // } else {
                    //     $log->action_text = 'customer email: '. $log->fullname . ' update Quantity FROM ' . $currentQuantity . ' TO ' . $product_stock->quantity;
                    // }
                    // $log->date_time = date("Y-m-d H:i:s");
                    // $log->id_onChanged = $orders->orders_id;
                    // $log->save();

                    // create activity log for current order status
                    $log = new \backend\models\Log();
                    $log->fullname = substr($orders->customer->email, 0, 20);
                    $log->module = 'orders';
                    $log->action = 'update';
                    $log->action_text = 'customer email: '. $log->fullname . ' update Order status product [' . \backend\models\OrderDetail::findOne($row->order_detail_id)->product_name . '] from [' . $currentProductOrderStatus . '] to [' . \backend\models\OrderStateLang::findOne($order_state_lang->order_state_lang_id)->name . ']';
                    $log->date_time = date("Y-m-d H:i:s");
                    $log->id_onChanged = $orders->orders_id;
                    $log->save();
                }
            }else{
                $this->redirect('https://www.thewatch.co');
            }
            
        }

        

       
        return $this->render('cancel', array(
            "orders" => $orders
        ));         
    }

    public function actionAgree($action, $id) {

        // Check token valid
        $token = \backend\models\Token::find()->where(['token_status'=>1])->andWhere(['token_generate'=>$action])->andWhere(['>=','token_date_expirated',date("Y-m-d H:i:s")])->one();
       
        if($token == null){
            $this->redirect('https://www.thewatch.co');
        }else{
            $token->token_status = 0;
            $token->save();

            $orders = \backend\models\Orders::findOne(["reference" => $id]);
            if($orders != null){
                $order_state_lang = \backend\models\OrderStateLang::find()->where(['payment_method_id'=>$orders->paymentmethoddetail->payment_method_id])->andWhere(['template'=>'customer_agree_goods_not_pass_quality_check'])->andWhere(['apps_language_id'=>2])->one();

                $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();

                foreach ($orderdetail as $row) {

                // current product status
                    $status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();
                    
                    $currentProductInventoryStatus = '';
                    $currentProductOrderStatus = '';
                    
                    foreach($status as $rowStatus){
                        $currentProductInventoryStatus = $rowStatus->orderDetailStateLang->name;
                        $currentProductOrderStatus = $rowStatus->orderStateLang->name;
                        break;
                    }

                    $orderDetailHistory = new \backend\models\OrderDetailHistory();
                    $orderDetailHistory->orders_id = $orders->orders_id;
                    $orderDetailHistory->order_detail_id = $row->order_detail_id;
                    $orderDetailHistory->order_state_lang_id = $order_state_lang->order_state_lang_id;
                    $orderDetailHistory->order_detail_state_lang_id = 1;
                    $orderDetailHistory->date_add = date("Y-m-d H:i:s");
                    // if(isset($value['notes'])){
                    $orderDetailHistory->notes = 'from customer';
                    // }
                    $orderDetailHistory->save();

                    // create activity log for current order status
                    $log = new \backend\models\Log();
                    $log->fullname = substr($orders->customer->email, 0, 20);
                    $log->module = 'orders';
                    $log->action = 'update';
                    $log->action_text = 'customer email: '. $log->fullname . ' update Order status product [' . \backend\models\OrderDetail::findOne($row->order_detail_id)->product_name . '] from [' . $currentProductOrderStatus . '] to [' . \backend\models\OrderStateLang::findOne($order_state_lang->order_state_lang_id)->name . ']';
                    $log->date_time = date("Y-m-d H:i:s");
                    $log->id_onChanged = $orders->orders_id;
                    $log->save();


                }
            }else{
                $this->redirect('https://www.thewatch.co');
            }
            
        }
    
        return $this->render('agree', array(
            "orders" => $orders
        ));         
    }

    public function actionCancelproduct($action, $id, $product_id) {

        // Check token valid
        $token = \backend\models\Token::find()->where(['token_status'=>1])->andWhere(['token_generate'=>$action])->andWhere(['>=','token_date_expirated',date("Y-m-d H:i:s")])->one();
       
        if($token == null){
            $this->redirect('https://www.thewatch.co');
        }else{
            $token->token_status = 0;
            $token->save();

            $orders = \backend\models\Orders::findOne(["reference" => $id]);
            if($orders != null){
                $order_state_lang = \backend\models\OrderStateLang::find()->where(['payment_method_id'=>$orders->paymentmethoddetail->payment_method_id])->andWhere(['template'=>'customer_cancel'])->andWhere(['apps_language_id'=>2])->one();

                $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();

                foreach ($orderdetail as $row) {
                    if($row->product_id == $product_id){
                        // $product_stock = \backend\models\ProductStock::find()->where(['product_id' => $row->product_id, 'product_attribute_id' => $row->product_attribute_id])->one();
                        // $product_stock->quantity = $product_stock->quantity + $row->product_quantity;
                        // $product_stock->save();

                        // $productHasAttribute = FALSE;

                        // $productAttribute = \backend\models\ProductAttributeCombination::findOne(['product_attribute_id' => $row->product_attribute_id]);

                        // if($productAttribute != NULL){
                        //     $productHasAttribute = TRUE;
                        // }

                        // $product = \backend\models\ProductStock::findOne(["product_attribute_id" => $row->product_attribute_id, "product_id" => $row->product_id]);
                        // $currentQuantity = $product->quantity;

                    // current product status
                        $status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();

                        $currentProductInventoryStatus = '';
                        $currentProductOrderStatus = '';

                        foreach($status as $rowStatus){
                            $currentProductInventoryStatus = $rowStatus->orderDetailStateLang->name;
                            $currentProductOrderStatus = $rowStatus->orderStateLang->name;
                            break;
                        }

                        $orderDetailHistory = new \backend\models\OrderDetailHistory();
                        $orderDetailHistory->orders_id = $orders->orders_id;
                        $orderDetailHistory->order_detail_id = $row->order_detail_id;
                        $orderDetailHistory->order_state_lang_id = $order_state_lang->order_state_lang_id;
                        $orderDetailHistory->order_detail_state_lang_id = 1;
                        $orderDetailHistory->date_add = date("Y-m-d H:i:s");
                    // if(isset($value['notes'])){
                        $orderDetailHistory->notes = 'from customer';
                    // }
                        $orderDetailHistory->save();

                            // create activity log for current quantity
                        // $log = new \backend\models\Log();
                        // $log->fullname = substr($orders->customer->email, 0, 20);
                        // $log->module = 'products';
                        // $log->action = 'update';
                        // if($productHasAttribute){
                        //     $log->action_text = 'customer email: '. $log->fullname . ' update Quantity [' . $productAttribute->attributeValue->value . '] FROM ' . $currentQuantity . ' TO ' . $product_stock->quantity;
                        // } else {
                        //     $log->action_text = 'customer email: '. $log->fullname . ' update Quantity FROM ' . $currentQuantity . ' TO ' . $product_stock->quantity;
                        // }
                        // $log->date_time = date("Y-m-d H:i:s");
                        // $log->id_onChanged = $orders->orders_id;
                        // $log->save();

                    // create activity log for current order status
                        $log = new \backend\models\Log();
                        $log->fullname = substr($orders->customer->email, 0, 20);
                        $log->module = 'orders';
                        $log->action = 'update';
                        $log->action_text = 'customer email: '. $log->fullname . ' update Order status product [' . \backend\models\OrderDetail::findOne($row->order_detail_id)->product_name . '] from [' . $currentProductOrderStatus . '] to [' . \backend\models\OrderStateLang::findOne($order_state_lang->order_state_lang_id)->name . ']';
                        $log->date_time = date("Y-m-d H:i:s");
                        $log->id_onChanged = $orders->orders_id;
                        $log->save();

                    }
                }
            }else{
                $this->redirect('https://www.thewatch.co');
            }
            
        }

        

        return $this->render('cancel', array(
            "orders" => $orders
        ));         
    }

    public function actionAgreeproduct($action, $id, $product_id) {

        // Check token valid
        $token = \backend\models\Token::find()->where(['token_status'=>1])->andWhere(['token_generate'=>$action])->andWhere(['>=','token_date_expirated',date("Y-m-d H:i:s")])->one();
       
        if($token == null){
            $this->redirect('https://www.thewatch.co');
        }else{
            $token->token_status = 0;
            $token->save();

            $orders = \backend\models\Orders::findOne(["reference" => $id]);
            if($orders != null){
                $order_state_lang = \backend\models\OrderStateLang::find()->where(['payment_method_id'=>$orders->paymentmethoddetail->payment_method_id])->andWhere(['template'=>'customer_agree_goods_not_pass_quality_check'])->andWhere(['apps_language_id'=>2])->one();

                $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();

                foreach ($orderdetail as $row) {
                    if($row->product_id == $product_id){

                    // current product status
                        $status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();

                        $currentProductInventoryStatus = '';
                        $currentProductOrderStatus = '';

                        foreach($status as $rowStatus){
                            $currentProductInventoryStatus = $rowStatus->orderDetailStateLang->name;
                            $currentProductOrderStatus = $rowStatus->orderStateLang->name;
                            break;
                        }

                        $orderDetailHistory = new \backend\models\OrderDetailHistory();
                        $orderDetailHistory->orders_id = $orders->orders_id;
                        $orderDetailHistory->order_detail_id = $row->order_detail_id;
                        $orderDetailHistory->order_state_lang_id = $order_state_lang->order_state_lang_id;
                        $orderDetailHistory->order_detail_state_lang_id = 1;
                        $orderDetailHistory->date_add = date("Y-m-d H:i:s");
                    // if(isset($value['notes'])){
                        $orderDetailHistory->notes = 'from customer';
                    // }
                        $orderDetailHistory->save();

                    // create activity log for current order status
                        $log = new \backend\models\Log();
                        $log->fullname = substr($orders->customer->email, 0, 20);
                        $log->module = 'orders';
                        $log->action = 'update';
                        $log->action_text = 'customer email: '. $log->fullname . ' update Order status product [' . \backend\models\OrderDetail::findOne($row->order_detail_id)->product_name . '] from [' . $currentProductOrderStatus . '] to [' . \backend\models\OrderStateLang::findOne($order_state_lang->order_state_lang_id)->name . ']';
                        $log->date_time = date("Y-m-d H:i:s");
                        $log->id_onChanged = $orders->orders_id;
                        $log->save();

                    }
                }
            }else{
                $this->redirect('https://www.thewatch.co');
            }
            
        }

        

        return $this->render('agree', array(
            "orders" => $orders
        ));         
    }

    public function actionAcceptproduct($action, $id) {

        // Check token valid
        $token = \backend\models\Token::find()->where(['token_status'=>1])->andWhere(['token_generate'=>$action])->andWhere(['>=','token_date_expirated',date("Y-m-d H:i:s")])->one();
       
        if($token == null){
            $this->redirect('https://www.thewatch.co');
        }else{
            $token->token_status = 0;
            $token->save();

            $orders = \backend\models\Orders::findOne(["secure_key" => $id]);
            if($orders != null){
                $order_state_lang = \backend\models\OrderStateLang::find()->where(['payment_method_id'=>$orders->paymentmethoddetail->payment_method_id])->andWhere(['template'=>'customer_confirm_receipt_of_goods'])->one();

                $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();

                $order_history = new \backend\models\OrderHistory();
                $order_history->orders_id = $orders->orders_id;
                $order_history->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $orders->orders_id])->order_state_id;
                $order_history->order_state_lang_id = $order_state_lang->order_state_lang_id;
                $order_history->date_add = date("Y-m-d H:i:s");
                $order_history->save();
                
                // create activity log for current order status
                $log = new \backend\models\Log();
                $log->fullname = substr($orders->customer->email, 0, 20);
                $log->module = 'orders';
                $log->action = 'update';
                $log->action_text = 'customer email: '. $log->fullname . ' update order status to ' . \backend\models\OrderStateLang::findOne($order_state_lang->order_state_lang_id)->name;
                $log->date_time = date("Y-m-d H:i:s");
                $log->id_onChanged = $orders->orders_id;
                $log->save();

                foreach ($orderdetail as $row) {
                    

                    // current product status
                        $status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $row->order_detail_id])->orderBy('date_add DESC')->all();
                        
                        $currentProductInventoryStatus = '';
                        $currentProductOrderStatus = '';
                        
                        foreach($status as $rowStatus){
                            $currentProductInventoryStatus = $rowStatus->orderDetailStateLang->name;
                            $currentProductOrderStatus = $rowStatus->orderStateLang->name;
                            break;
                        }

                        $orderDetailHistory = new \backend\models\OrderDetailHistory();
                        $orderDetailHistory->orders_id = $orders->orders_id;
                        $orderDetailHistory->order_detail_id = $row->order_detail_id;
                        $orderDetailHistory->order_state_lang_id = $order_state_lang->order_state_lang_id;
                        $orderDetailHistory->order_detail_state_lang_id = 1;
                        $orderDetailHistory->date_add = date("Y-m-d H:i:s");
                    // if(isset($value['notes'])){
                        $orderDetailHistory->notes = 'from customer';
                    // }
                        $orderDetailHistory->save();

                    // create activity log for current order status
                        $log = new \backend\models\Log();
                        $log->fullname = substr($orders->customer->email, 0, 20);
                        $log->module = 'orders';
                        $log->action = 'update';
                        $log->action_text = 'customer email: '. $log->fullname . ' update Order status product [' . \backend\models\OrderDetail::findOne($row->order_detail_id)->product_name . '] from [' . $currentProductOrderStatus . '] to [' . \backend\models\OrderStateLang::findOne($order_state_lang->order_state_lang_id)->name . ']';
                        $log->date_time = date("Y-m-d H:i:s");
                        $log->id_onChanged = $orders->orders_id;
                        $log->save();

                   
                }
            }else{
                $this->redirect('https://www.thewatch.co');
            }
            
        }

        

        return $this->render('accept', array(
            "orders" => $orders
        ));         
    }
    
    public function actionStock(){
        $id = 3;
        try {
            $result = \Yii::$app->db->createCommand("CALL check_stock(:id,@out)") 
                      ->bindValue(':id' , $id )
                      ->execute();
        
            $row = \Yii::$app->db->createCommand("SELECT @out AS level")->queryScalar();
            if ($row) {
                print_r($row);
            }
        }catch (Exception $e) {

            echo 'Message: ' .$e->getMessage();

         }
        die();
    }
    
}
