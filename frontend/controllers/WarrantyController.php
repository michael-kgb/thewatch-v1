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
use yii\web\Session;


class WarrantyController extends controller\FrontendController {
    
    public $breadcrumb = ["Warranty"];
    public $title = "";
    
    public function beforeAction($action)
    {            
        //if ($action->id == 'my-method') {
            $this->enableCsrfValidation = false;
        //}

        return parent::beforeAction($action);
    }
    
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
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    // service not yet take survei
    private function actionNotsurvei($id){
        $service = \backend\models\Service::find()
            ->joinWith([
                'orders','serviceHistory'
                ])
            ->where(['orders.customer_id'=>$id])
          
            ->andWhere(['service.questionnaire_respondent_id'=>0])
            ->andWhere(['or',
                   ['service_history.service_state_lang_id'=>33],
                   ['service_history.service_state_lang_id'=>19]
               ])
            ->orderBy('service.service_id DESC')
            ->one();
        if($service != null){
            return $service->service_id;
        }else{
            return '';
        }
        
    }
    public function actionKetentuan($id)
    {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        return $this->render('ketentuan',['id'=>$id]);
    }
    public function actionCard()
    {   
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect(['/?back_url=/warranty/card#loginWarranty']);
        
        $survei_check = $this->actionNotsurvei($customerInfo['customer_id']);
        
        
        
        // query search
        if(isset($_GET['search'])){
            $product_id = $this->actionSearch($_GET['search']);
            
            $orders = \backend\models\Orders::find()
                ->joinWith([
                    'stores'
                    ])
                ->where(['orders.customer_id'=>$customerInfo['customer_id']])
                ->all();
                
            $order_array = [];
            foreach ($orders as $order) {
                array_push($order_array,$order->orders_id);
                
            }
            $orders_query = \backend\models\Orders::find()
                ->joinWith([
                    'stores'
                    ])
                ->where(['orders.customer_id'=>$customerInfo['customer_id']])
                ->andWhere(['LIKE', 'stores.store_slug', '%'.$_GET['search'].'%', false])
                ->all();
                
            $order_array_query = [];
            foreach ($orders_query as $order_query) {
                array_push($order_array_query,$order_query->orders_id);
                
            }
            
         //   print_r($order_array_query);die();
            if($order_array_query == []){
                $order_details = \backend\models\OrderDetail::find()
                    ->where(['order_detail.orders_id'=>$order_array])
                    ->andWhere(['order_detail.product_id'=>$product_id])
                    ->all();
            }
            else{
                $order_details = \backend\models\OrderDetail::find()
                    ->where(['order_detail.orders_id'=>$order_array_query])
                    // ->andWhere(['order_detail.product_id'=>$product_id])
                    ->all();
            }
        }else{
            $orders = \backend\models\Orders::find()
                    ->where(['orders.customer_id'=>$customerInfo['customer_id']])
                    ->all();
            $order_array = [];
            foreach ($orders as $order) {
                array_push($order_array,$order->orders_id);
                
            }
            
            $order_details = \backend\models\OrderDetail::find()
                    ->where(['order_detail.orders_id'=>$order_array])
                    ->all();
        }
        
        

        $order_detail_array = [];
        foreach ($order_details as $order_detail) {
            array_push($order_detail_array,$order_detail->order_detail_id);
            
        }
        
        $order_detail_warrantys = \backend\models\OrderDetailWarranty::find()
                    ->joinWith([
                        "orderDetail",
                        "warranty",
//                     
                    ])
                    ->where(['order_detail_warranty.order_detail_id'=>$order_detail_array])
                    ->andWhere(['warranty.warranty_status'=>'USED'])
                    ->orderBy('order_detail_warranty.order_detail_id DESC')
                    ->all();
        // print_r($order_detail_warrantys);die();

        // echo count($order_detail_warrantys);die();
        
        $ratings = \backend\models\Question::find()->where(['questionnaire_id'=>2])->andWhere(['question_type'=>'rating'])->orderBy('question_order ASC')->all();
        $ulasans = \backend\models\Question::find()->where(['questionnaire_id'=>2])->andWhere(['question_type'=>'text'])->orderBy('question_order ASC')->all();
                                    
       
        return $this->render('card', array(
              "order_detail_warrantys" => $order_detail_warrantys,
              "customer_id" => $customerInfo['customer_id'], 
              "ratings" => $ratings,
              "ulasans" => $ulasans,
              "survei_check" => $survei_check
        ));
    }
    public function actionCreate()
    {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/?back_url=/warranty/create#loginWarranty');
        
        $sys_autonumber_brands = \backend\models\SysAutonumberBrands::find()->all();
        $brand_autonumber = [];
       // print_r($sys_autonumber_brands);die();
        foreach($sys_autonumber_brands as $sys_autonumber_brand){
            $brand_autonumber[] = $sys_autonumber_brand->brand_id;
            
        }
        $brands = \backend\models\Brands::find()->where(['brand_id'=>$brand_autonumber])->all();
        $brand_select = [];
        
        foreach ($brands as $brand) {
            $brand_detail = [];
            $brand_detail[id] = $brand->brand_id;
            $brand_detail[text] = $brand->brand_name;

            $brand_select[] = $brand_detail;
        }
        
        $stores = \backend\models\Stores::find()->where(['<>','store_id',149])->andWhere(['<>','store_id',153])->all();
        $store_select = [];
        
        foreach ($stores as $store) {
            $store_detail = [];
            $store_detail[id] = $store->store_id;
            $store_detail[name] = $store->store_name;
            $store_detail[slug] = $store->store_slug;
            $store_detail[text] = preg_replace( "/\r|\n/", " ", strip_tags($store->store_address) );

            $store_select[] = $store_detail;
        }
        // echo json_encode($brand_select);die();
        return $this->render('create', array(
            'brands' => $brand_select,
            'stores' => $store_select,  
            "customer_id" => $customerInfo['customer_id'],    
        ));
    }
    public function actionManual()
    {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/?back_url=/warranty/manual#loginWarranty');

        $data = $_POST;
        $hasil = [];
        $warranty = \backend\models\Warranty::find()->where(['warranty_code'=>$data['warranty_code']])->one();
        if($warranty == null){
            $hasil[0] = 'error';
            $hasil[1] = 'Kode garansi salah';
            return json_encode($hasil);
        }else{
            if($warranty->warranty_status == 'USED'){
                $hasil[0] = 'error';
                $hasil[1] = 'Kode garansi sudah digunakan';
                return json_encode($hasil);
            }
        }
      
        $order_detail_warrantys = \backend\models\OrderDetailWarranty::find()
                    ->joinWith([
                        "orderDetail",
                        "warranty",
//                     
                    ])
                    ->where(['warranty.warranty_code'=>$data['warranty_code']])
                    ->andWhere(['warranty.warranty_status'=>'AVAILABLE'])
                    ->andWhere(['order_detail.product_id'=>$data['product_id']])
                    ->one();

        $service_claim = new \backend\models\ServiceClaimManual();
        $service_claim->brand_id = $data['brand_id'];
        if (strpos($data['product_id'], '-') !== false) {
            $product_id = explode('-', $data['product_id']);
            $service_claim->product_id = $product_id[0];
            $service_claim->product_attribute_id = $product_id[1];
        }else{
            $product_id = []; 
            $product_id[0] = $data['product_id'];
            $product_id[1] = 0;
            $service_claim->product_id = $product_id[0];
            
            $service_claim->product_attribute_id = $product_id[1];
        }
        $service_claim->customer_id = $data['customer_id'];
        $service_claim->warranty_code = $data['warranty_code'];
        $service_claim->service_claim_manual_date_add = date('Y-m-d H:i:s');
        $service_claim->reference = $data['reference'];
        $service_claim->store_id = $data['store_id'];
        $service_claim->other_store = $data['other_store'];

        $product_warranty = \backend\models\ProductWarranty::find()->where(['product_id'=>$product_id[0]])->one();
            $year = $product_warranty->product_warranty_year;
            if($year = ''){
                $year = 0;
            }
            $from_date = date('Y-m-d H:i:s');
            $new_date = date('Y-m-d H:i:s', strtotime('+'.$year.' years', strtotime($from_date)));

        if($order_detail_warrantys == null){
            $service_claim->service_claim_manual_status = 'Awaiting Confirmation';
            //$connection = Yii::$app->db;
            //$connection->createCommand()->update('warranty', ['warranty_status' => 'USED','warranty_activated_date' => $from_date,'warranty_expired_date' => $new_date], 'warranty_code="'.$data['warranty_code'].'"')->execute();
        }else{
            
            $connection = Yii::$app->db;
            //$connection->createCommand()->update('warranty', ['warranty_status' => 'USED','warranty_activated_date' => $from_date,'warranty_expired_date' => $new_date], 'warranty_code="'.$data['warranty_code'].'"')->execute();
            $service_claim->service_claim_manual_status = 'Valid';

            $order = \backend\models\Orders::find()->where(['orders_id'=>$order_detail_warrantys->orderDetail->orders_id])->one();

            if($order->customer_id == 0){
                $connection = Yii::$app->db;
                $connection->createCommand()->update('orders', ['customer_id' => $data['customer_id']], 'orders_id="'.$order_detail_warrantys->orderDetail->orders_id.'"')->execute();
            }else{

            }
            
        }

        $service_claim->save();

        // Email to after sales
        \common\components\Helpers::sendEmailMandrillUrlAPI(
					$this->renderFile('@backend/views/template/mail/front/warranty_claim_manual.php', array(
						"data" => $service_claim
					)), 'Pengajuan Garansi Manual Baru', 'notification@thewatch.co', 'hendrihmwn@gmail.com', ''
				);
				
				
        $imagePath = \Yii::getAlias("@frontend" . '/web/img/warranty/service/uploads/invoice/'.$service_claim->service_claim_manual_id);
        mkdir($imagePath);
        if(isset($_FILES["file_2"]["name"])){
            $temp = explode(".", $_FILES["file_2"]["name"]);
            $newfilename = md5($data['reference']).'.' . end($temp);
            move_uploaded_file($_FILES['file_2']['tmp_name'], $imagePath . "/" . $newfilename);
            $service_claim->reference_img = $newfilename;
            $service_claim->update();
        }

        $data[0] = 'success';
                $data[1] = 'success';
        // echo json_encode($brand_select);die();
        return json_encode($data);
    }
    
    /**
     * @inheritdoc
     * Function to claim warranty, add service
     * $id is a warranty_id in warranty table
     */
    public function actionClaim($id)
    {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/?back_url=/warranty/claim/'.$id.'#loginWarranty');
        
        $order_detail_one = \backend\models\OrderDetailWarranty::find()
                    ->where(['order_detail_warranty.warranty_id'=>$id])
                    ->one();
                    
        $order_detail_claim = \backend\models\OrderDetail::find()->where(['order_detail_id'=>$order_detail_one->order_detail_id])->one();
        
        $order_claim = \backend\models\Orders::find()->where(['orders_id'=>$order_detail_claim->orders_id])->one();
        
        // check the page owner. False: redirect to page card
        if($customerInfo['customer_id'] != $order_claim->customer_id){
            $this->redirect('../../warranty/card');
        }
        
        $service_detail = \backend\models\ServiceDetail::find()->where(['order_detail_warranty_id'=>$order_detail_one->order_detail_warranty_id])->orderBy('service_detail_id DESC')->one();

        $service = \backend\models\Service::find()->where(['service_id'=>$service_detail->service_id])->one();
        
        $service_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service->service_history_id])->orderBy('service_history_id DESC')->one();
        
        $service_state_lang = \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one();
       
        
        // check if warranty is using by checking service detail
        // 
        if(count($service_detail) != 0){
            if($service->service_code == ''){
                
            }else{
                if($service_history != null){
                    if($service_state_lang->template == 'received_by_customer_in_store' || $service_state_lang->template == 'received_by_customer'){
                        $service = new \backend\models\Service();
                        $service->orders_id = $order_detail_one->orderDetail->orders_id;
                        $service->save();

                        $service_detail = new \backend\models\ServiceDetail();
                        $service_detail->service_id = $service->service_id;
                        $service_detail->order_detail_warranty_id = $order_detail_one->order_detail_warranty_id;
                        // $service_detail->service_type_store_id = $service_type->service_type_store_id;
                        $service_detail->save();
                    }else{
                        
                    }
                }
            }
        }else{
            $service = new \backend\models\Service();
            $service->orders_id = $order_detail_one->orderDetail->orders_id;
            $service->save();

            $service_detail = new \backend\models\ServiceDetail();
                $service_detail->service_id = $service->service_id;
                $service_detail->order_detail_warranty_id = $order_detail_one->order_detail_warranty_id;
                // $service_detail->service_type_store_id = $service_type->service_type_store_id;
                $service_detail->save();
        }
        
        $service_detail = \backend\models\ServiceDetail::find()->where(['order_detail_warranty_id'=>$order_detail_one->order_detail_warranty_id])->orderBy('service_detail_id DESC')->one();

        $service_detail_all = \backend\models\ServiceDetail::find()->where(['service_id'=>$service_detail->service_id])->orderBy('service_detail_id DESC')->all();

        $service = \backend\models\Service::find()->where(['service_id'=>$service_detail->service_id])->one();
        
        $service_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service->service_history_id])->orderBy('service_history_id DESC')->one();
        
        $service_state_lang = \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one();
        
        // Checking if warranty is using, so can't make a new claim
        if($service->service_history_id != 0){
            if($service_history->service_state_lang_id == 0){
                
            }
            
            if($service_state_lang->template == 'received_by_customer_in_store' || $service_state_lang->template == 'awaiting_for_confirmation' || $service_state_lang->template == 'received_by_customer'){
                
            }else{
                // redirect to card page
                $this->redirect('/warranty/card');
            }
        }

        $service_image = \backend\models\ServiceImage::find()->where(['service_id'=>$service->service_id])->one();
        
        $count_service_image = 0;
        if($service_image->service_image_front_view != '0'){
            $count_service_image = $count_service_image + 1;
        }
        if($service_image->service_image_right_view != '0'){
            $count_service_image = $count_service_image + 1;
        }
        if($service_image->service_image_left_view != '0'){
            $count_service_image = $count_service_image + 1;
        }
        if($service_image->service_image_top_view != '0'){
            $count_service_image = $count_service_image + 1;
        }
        if($service_image->service_image_bottom_view != '0'){
            $count_service_image = $count_service_image + 1;
        }
        if($service_image->service_image_back_view != '0'){
            $count_service_image = $count_service_image + 1;
        }
        if($service_image == null){
            $count_service_image = 0;
        }
        $order_detail_warrantys = \backend\models\OrderDetailWarranty::find()
                    ->joinWith([
                        "orderDetail",
                        "warranty",
//                     
                    ])
                    ->where(['order_detail_warranty.warranty_id'=>$id])
                    ->all();


        

        $warrantys = \backend\models\ServiceType::find()->where(['service_type_status'=>1])->all();

        $warranty_select = [];
        
        foreach ($warrantys as $warranty) {
            $warranty_detail = [];
            $warranty_detail[id] = $warranty->service_type_id;
  
            $type_store = \backend\models\ServiceTypeStore::find()->where(['<>','store_id',153])->andWhere(['service_type_id'=>$warranty->service_type_id])->one();
            $warranty_detail[text] = $warranty->service_type_name;
            if($type_store != null){
                $warranty_detail[type] = 2;
            }else{
                $warranty_detail[type] = 1;
            }

            foreach ($service_detail_all as $service_detail_a) {
              
                    $service_type_store_id = \backend\models\ServiceTypeStore::find()->where(['service_type_store_id'=>$service_detail_a->service_type_store_id])->one();
                    if($service_type_store_id->service_type_id == $warranty->service_type_id){
                        $warranty_detail[checked] = 1;
                        $warranty_detail[other] = $service_detail_a->service_other_text;
                    }
              
         
            }

            $warranty_select[] = $warranty_detail;
        }
        // print_r($service_detail_all);die();
        $service_select = [];
        
        // print_r($warranty_select);die();
        $store_city = \backend\models\Stores::find()->where(['<>','store_id',149])->andWhere(['<>','store_id',153])->andWhere(['store_type'=>'retail'])->andWhere(['store_status'=>'active'])->groupBy('store_location')->all();
        // print_r($warranty_select);die();                                         
        return $this->render('claim', array(
              "order_detail_warrantys" => $order_detail_warrantys,
              "service_type" => $warranty_select,       
              "store_city" => $store_city,
              "order_id" => $order_detail_one->orderDetail->orders_id,
              "customer_id" => $customerInfo['customer_id'],
              "service" => $service,
              "service_detail" => $service_detail,
              "service_detail_all" => $service_detail_all,
              "service_image" => $service_image,
              "count_service_image" => $count_service_image,
        ));
    }
    /**
     * @inheritdoc
     * Function to show detail service
     * $id is a service_id in service table
     */
    public function actionDetails($id)
    {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/?back_url=/warranty/details/'.$id.'#loginWarranty');

        $service = \backend\models\Service::find()->where(['service_id'=>$id])->one();

        $service_detail = \backend\models\ServiceDetail::find()->where(['service_id'=>$id])->orderBy('service_detail_id DESC')->one();

        $service_detail_all = \backend\models\ServiceDetail::find()->where(['service_id'=>$id])->andWhere(['order_detail_warranty_id'=>$service_detail->order_detail_warranty_id])->all();

        $order_detail_warrantys = \backend\models\OrderDetailWarranty::find()
                    ->joinWith([
                        "orderDetail",
                        "warranty",
//                     
                    ])
                    // ->where(['order_detail_warranty.warranty_id'=>$service_detail->order_detail_warranty_id])
                    ->where(['order_detail.orders_id'=>$service->orders_id])
                    ->orderBy('order_detail_warranty_id DESC')
                    ->one();
        
        $order = \backend\models\Orders::find()->where(['orders_id'=>$order_detail_warrantys->orderDetail->orders_id])->one();

        // check the page owner. False: redirect to page card        
        if($customerInfo['customer_id'] != $order->customer_id){
            $this->redirect('../../warranty/card');
        }

        $service_type_name = [];
        foreach($service_detail_all as $service_detail_a){
            $service_type_store = \backend\models\ServiceTypeStore::find()->joinWith([
                        "serviceType",
                       
                    ])->where(['service_type_store.service_type_store_id'=>$service_detail_a->service_type_store_id])->one();
            $service_type_name[] = $service_type_store->serviceType->service_type_name;
        }

        // print_r($service_type_id);die();

        
        $store = \backend\models\Stores::find()->where(['store_id'=>$service_detail->service_detail_drop_store_id])->one();
        

        $service_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service->service_history_id])->orderBy('service_history_id DESC')->one();
        
        

        return $this->render('details', array(
              "order_detail_warranty" => $order_detail_warrantys,
              "service_type_name" => $service_type_name,
              "service" => $service,
              "service_history" => $service_history,
            "store" => $store,
        ));
    }
    public function actionGetProductList($id) {

        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $products = \backend\models\Product::find()
                    ->joinWith([
                        "brands",
                        "productDetail",
//                        "productStock",
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    ->where(['product.brands_brand_id' => $id])
                    ->andWhere(['product.product_category_id' => 5])
                    // ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                    ->orderBy('product.product_id DESC')
                    ->all();

        $product_select = [];
        $i = 0;
        foreach ($products as $row) {

            $attribut_id_prod = [];
            $attribut_id = \backend\models\ProductAttribute::find()->where(['product_id' => $row->product_id])->all();
            // echo count($attribut_id);die();
            $product_warranty = \backend\models\ProductWarranty::find()->where(['product_id'=>$row->product_id])->one();
            if(count($attribut_id) != 0){
                foreach ($attribut_id as $row_id) {
                    // $attribut_id_prod[] = $row_id['product_attribute_id'];
                    $combination_id = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id' => $row_id['product_attribute_id']])->one();
                    $color = \backend\models\AttributeValue::find()->where(['attribute_value_id'=>$combination_id->attribute_value_id])->one();
                    $size = \backend\models\AttributeValue::find()->where(['attribute_value_id'=>$combination_id->attribute_value_id_2])->one();

                    $product_image = \backend\models\ProductAttributeImage::findOne(['id_product_attribute' => $row_id['product_attribute_id']]);

                    $result = array();
                    $result[id] = $row->product_id.'-'.$row_id['product_attribute_id'];
                    $result[text] = str_replace("'","&#8216",$row->productDetail->name).' - '.$color->value.' - '.$size->value;
                 
                    if($product_image->product_image_id != ''){
                        $result[attr] = Yii::$app->params['imgixUrl'].'product/'.$product_image->product_image_id . '/' . $product_image->product_image_id.'_small.jpg';
                    }else{
                        $result[attr] = Yii::$app->params['imgixUrl'].'product/'.$row->productImage->product_image_id . '/' . $row->productImage->product_image_id.'_small.jpg';
                    }

                    $product_select[] = $result;
                    $i++;
                    
                    if($i == $decode->size){
                        break;
                    }

                }
            }else{
                $result = array();
                    $result[id] = $row->product_id;
                    $result[text] = str_replace("'","&#8216",$row->productDetail->name);
                    $result[attr] = Yii::$app->params['imgixUrl'].'product/'.$row->productImage->product_image_id . '/' . $row->productImage->product_image_id.'_small.jpg';
                    
                    $product_select[] = $result;
                    $i++;

                    if($i == $decode->size){
                        break;
                    }
            }
            
            

            if($i == $decode->size){
                        break;
                    }
            
        }

        return $this->renderFile('@app/views/warranty/select_product.php', array("products" => $product_select));
        
    }

    public function actionGetStore($id) {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $stores = \backend\models\Stores::find()
                   
                    ->where(['store_id' => $id])
                    // ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                   
                    ->one();

        $store['name'] = $stores->store_name;
        $store['address'] = $stores->store_address;
        $store['contact'] = $stores->store_contact_number;
        return json_encode($store);
        
    }

    public function actionDownload($id){
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $data = json_decode($id);
        // echo $data->customer_name;die();
        // print_r($data);die();
        // if(isset($_POST)){
        
        $service = \backend\models\Service::find()->where(['service_id'=>$data->service_id])->one();
        $service->sender_name = $data->customer_name;
        $service->sender_address = $data->customer_address;
        $service->sender_telp = $data->customer_telp;
        $service->update();
        
            \common\components\PHPWord_Helper::generateWarrantysticker(
                'Pdf',
                $data->customer_name,
                $data->customer_address,
                $data->customer_telp,
                $data->location_id
                
            );
            return true;
        // }
        
    }

     public function actionSave(){
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $data = $_POST;

        $number = \backend\models\SysAutonumber::find()->where(['sys_autonumber_id'=>11])->one();

        $service = \backend\models\Service::findOne($data['service_id']);
       
        $service->orders_id = $data['order'];
        

        $service_history = new \backend\models\ServiceHistory();
        $service_history->date_add = date('Y-m-d H:i:s');
        $service_history->service_state_lang_id = 26;
        $service_history->service_id = $service->service_id;
        $service_history->save();

        $service->service_history_id = $service_history->service_history_id;
        if($service->service_code == ''){
            $service->service_code = $this->digit($number->sys_autonumber_prefix,$number->sys_autonumber_char,$number->sys_autonumber_value);
            $service->service_date_add = date('Y-m-d H:i:s');
            $service->service_date_update = date("Y-m-d H:i:s");
            $service->update();

            $connection = Yii::$app->db;
                $connection->createCommand()->update('sys_autonumber', ['sys_autonumber_value' => $number->sys_autonumber_value+1], 'sys_autonumber_id=11')->execute();
        }
        
        // $service_data for email, service data must query again
        $service_data = \backend\models\Service::findOne($data['service_id']);
       
        // echo $data->orders->customer->email;die();
                \common\components\Helpers::sendEmailMandrillUrlAPI(
					$this->renderFile('@backend/views/template/mail/front/warranty_input.php', array(
						"data" => $service_data
					)), 'Data Service Anda Berhasil Terinput', 'notification@thewatch.co', $service_data->orders->customer->email, ''
				);
		
		// Email to after sales
        \common\components\Helpers::sendEmailMandrillUrlAPI(
					$this->renderFile('@backend/views/template/mail/front/warranty_service_new.php', array(
						"data" => $service_data
					)), 'Pengajuan Service Baru', 'notification@thewatch.co', 'hendrihmwn@gmail.com', ''
				);

        return json_encode($data);
    }

    private function digit($prefix,$limit,$value){
        return $prefix.''.str_pad($value, $limit, '0', STR_PAD_LEFT);
    }
    
    public function actionUnggah(){
        $data = $_POST;
        $service_image = \backend\models\ServiceImage::find()->where(['service_id'=>$data['service_id']])->one();
        $data['front'] = '';
        $data['right'] = '';
        $data['left'] = '';
        $data['top'] = '';
        $data['bottom'] = '';
        $data['back'] = '';
        if($service_image == null){
            $service_image = new \backend\models\ServiceImage();
            $service_image->service_id = $data['service_id'];
            $service_image->service_image_front_view = 0;
            $service_image->service_image_left_view = 0;
            $service_image->service_image_right_view = 0;
            $service_image->service_image_top_view = 0;
            $service_image->service_image_bottom_view = 0;
            $service_image->service_image_back_view = 0;
            $service_image->save();

            $imagePath = \Yii::getAlias("@frontend" . '/web/img/warranty/service/uploads/product_condition/'.$service_image->service_image_id);
            mkdir($imagePath);
            if(isset($_FILES["file_1"]["name"])){
                $temp = explode(".", $_FILES["file_1"]["name"]);
                $newfilename = md5($_FILES["file_1"]["name"]) . '_front.' . end($temp);
                move_uploaded_file($_FILES['file_1']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_front_view = $newfilename;
                $service_image->update();
                $data['front'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_2"]["name"])){
                $temp = explode(".", $_FILES["file_2"]["name"]);
                $newfilename = md5($_FILES["file_2"]["name"]) . '_right.' . end($temp);
                move_uploaded_file($_FILES['file_2']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_right_view = $newfilename;
                $service_image->update();
                $data['right'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_3"]["name"])){
                $temp = explode(".", $_FILES["file_3"]["name"]);
                $newfilename = md5($_FILES["file_3"]["name"]) . '_left.' . end($temp);
                move_uploaded_file($_FILES['file_3']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_left_view = $newfilename;
                $service_image->update();
                $data['left'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_4"]["name"])){
                $temp = explode(".", $_FILES["file_4"]["name"]);
                $newfilename = md5($_FILES["file_4"]["name"]) . '_top.' . end($temp);
                move_uploaded_file($_FILES['file_4']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_top_view = $newfilename;
                $service_image->update();
                $data['top'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_5"]["name"])){
                $temp = explode(".", $_FILES["file_5"]["name"]);
                $newfilename = md5($_FILES["file_5"]["name"]) . '_bottom.' . end($temp);
                move_uploaded_file($_FILES['file_5']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_bottom_view = $newfilename;
                $service_image->update();
                $data['bottom'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_6"]["name"])){
                $temp = explode(".", $_FILES["file_6"]["name"]);
                $newfilename = md5($_FILES["file_6"]["name"]) . '_back.' . end($temp);
                move_uploaded_file($_FILES['file_6']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_back_view = $newfilename;
                $service_image->update();
                $data['back'] = $service_image->service_image_id . '/' . $newfilename;
            }
        }else{
            $imagePath = \Yii::getAlias("@frontend" . '/web/img/warranty/service/uploads/product_condition/'.$service_image->service_image_id);
            
            
            if(isset($_FILES["file_1"]["name"])){
                $temp = explode(".", $_FILES["file_1"]["name"]);
                $newfilename = md5($_FILES["file_1"]["name"]) . '_front.' . end($temp);

                if (file_exists($imagePath.$service_image->service_image_front_view)){
                    unlink($imagePath.$service_image->service_image_front_view);
                }

                move_uploaded_file($_FILES['file_1']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_front_view = $newfilename;
                $service_image->update();
                $data['front'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_2"]["name"])){
                $temp = explode(".", $_FILES["file_2"]["name"]);
                $newfilename = md5($_FILES["file_2"]["name"]) . '_right.' . end($temp);

                if (file_exists($imagePath.$service_image->service_image_right_view)){
                    unlink($imagePath.$service_image->service_image_right_view);
                }

                move_uploaded_file($_FILES['file_2']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_right_view = $newfilename;
                $service_image->update();
                $data['right'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_3"]["name"])){
                $temp = explode(".", $_FILES["file_3"]["name"]);
                $newfilename = md5($_FILES["file_3"]["name"]) . '_left.' . end($temp);

                if (file_exists($imagePath.$service_image->service_image_left_view)){
                    unlink($imagePath.$service_image->service_image_left_view);
                }

                move_uploaded_file($_FILES['file_3']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_left_view = $newfilename;
                $service_image->update();
                $data['left'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_4"]["name"])){
                $temp = explode(".", $_FILES["file_4"]["name"]);
                $newfilename = md5($_FILES["file_4"]["name"]) . '_top.' . end($temp);

                if (file_exists($imagePath.$service_image->service_image_top_view)){
                    unlink($imagePath.$service_image->service_image_top_view);
                }

                move_uploaded_file($_FILES['file_4']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_top_view = $newfilename;
                $service_image->update();
                $data['top'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_5"]["name"])){
                $temp = explode(".", $_FILES["file_5"]["name"]);
                $newfilename = md5($_FILES["file_5"]["name"]) . '_bottom.' . end($temp);

                if (file_exists($imagePath.$service_image->service_image_bottom_view)){
                    unlink($imagePath.$service_image->service_image_bottom_view);
                }

                move_uploaded_file($_FILES['file_5']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_bottom_view = $newfilename;
                $service_image->update();
                $data['bottom'] = $service_image->service_image_id . '/' . $newfilename;
            }
            if(isset($_FILES["file_6"]["name"])){
                $temp = explode(".", $_FILES["file_6"]["name"]);
                $newfilename = md5($_FILES["file_6"]["name"]) . '_back.' . end($temp);

                if (file_exists($imagePath.$service_image->service_image_back_view)){
                    unlink($imagePath.$service_image->service_image_back_view);
                }

                move_uploaded_file($_FILES['file_6']['tmp_name'], $imagePath . "/" . $newfilename);

                $service_image->service_image_back_view = $newfilename;
                $service_image->update();
                $data['back'] = $service_image->service_image_id . '/' . $newfilename;
            }
        }
        $data['id'] = $service_image->service_image_id;

       return json_encode($data);
        
    }
    
    public function actionUnggahbyone(){
        $data = $_POST;
        $service_image = \backend\models\ServiceImage::find()->where(['service_id'=>$data['service_id']])->one();
        $data['front'] = '';
        $data['right'] = '';
        $data['left'] = '';
        $data['top'] = '';
        $data['bottom'] = '';
        $data['back'] = '';
        if($service_image == null){
            $service_image = new \backend\models\ServiceImage();
            $service_image->service_id = $data['service_id'];
            $service_image->service_image_front_view = 0;
            $service_image->service_image_left_view = 0;
            $service_image->service_image_right_view = 0;
            $service_image->service_image_top_view = 0;
            $service_image->service_image_bottom_view = 0;
            $service_image->service_image_back_view = 0;
            $service_image->save();

            $imagePath = \Yii::getAlias("@frontend" . '/web/img/warranty/service/uploads/product_condition/'.$service_image->service_image_id);
            mkdir($imagePath);
            if(isset($_FILES["file"]["name"])){
                $temp = explode(".", $_FILES["file"]["name"]);
                $newfilename = md5(date('Y-m-d H:i:s')) . '_'.$data['type']. '.jpg';
                move_uploaded_file($_FILES['file']['tmp_name'], $imagePath . "/" . $newfilename);
                
                if($data['type'] == 'front'){
                    $service_image->service_image_front_view = $newfilename;
                }
                if($data['type'] == 'left'){
                    $service_image->service_image_left_view = $newfilename;
                }
                if($data['type'] == 'right'){
                    $service_image->service_image_right_view = $newfilename;
                }
                if($data['type'] == 'top'){
                    $service_image->service_image_top_view = $newfilename;
                }
                if($data['type'] == 'bottom'){
                    $service_image->service_image_bottom_view = $newfilename;
                }
                if($data['type'] == 'back'){
                    $service_image->service_image_back_view = $newfilename;
                }
                $service_image->update();
                if($data['type'] == 'front'){
                    $data['front'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'left'){
                    $data['left'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'right'){
                    $data['right'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'top'){
                    $data['top'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'bottom'){
                    $data['bottom'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'back'){
                    $data['back'] = $service_image->service_image_id . '/' . $newfilename;
                }
                $data['link'] = $service_image->service_image_id . '/' . $newfilename;
            }
           
        }else{
            $imagePath = \Yii::getAlias("@frontend" . '/web/img/warranty/service/uploads/product_condition/'.$service_image->service_image_id);
            
            
            if(isset($_FILES["file"]["name"])){
                $temp = explode(".", $_FILES["file"]["name"]);
                $newfilename = md5(date('Y-m-d H:i:s')) . '_'.$data['type']. '.jpg';
                
                if($data['type'] == 'front'){
                    if (file_exists($imagePath.$service_image->service_image_front_view)){
                        unlink($imagePath.$service_image->service_image_front_view);
                    }
                    $service_image->service_image_front_view = $newfilename;
                }
                if($data['type'] == 'left'){
                    if (file_exists($imagePath.$service_image->service_image_left_view)){
                        unlink($imagePath.$service_image->service_image_left_view);
                    }
                    $service_image->service_image_left_view = $newfilename;
                }
                if($data['type'] == 'right'){
                    if (file_exists($imagePath.$service_image->service_image_right_view)){
                        unlink($imagePath.$service_image->service_image_right_view);
                    }
                    $service_image->service_image_right_view = $newfilename;
                }
                if($data['type'] == 'top'){
                    if (file_exists($imagePath.$service_image->service_image_top_view)){
                        unlink($imagePath.$service_image->service_image_top_view);
                    }
                    $service_image->service_image_top_view = $newfilename;
                }
                if($data['type'] == 'bottom'){
                    if (file_exists($imagePath.$service_image->service_image_bottom_view)){
                        unlink($imagePath.$service_image->service_image_bottom_view);
                    }
                    $service_image->service_image_bottom_view = $newfilename;
                }
                if($data['type'] == 'back'){
                    if (file_exists($imagePath.$service_image->service_image_back_view)){
                        unlink($imagePath.$service_image->service_image_back_view);
                    }
                    $service_image->service_image_back_view = $newfilename;
                }
                
                move_uploaded_file($_FILES['file']['tmp_name'], $imagePath . "/" . $newfilename);
                
                $service_image->update();
                if($data['type'] == 'front'){
                    $data['front'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'left'){
                    $data['left'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'right'){
                    $data['right'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'top'){
                    $data['top'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'bottom'){
                    $data['bottom'] = $service_image->service_image_id . '/' . $newfilename;
                }
                if($data['type'] == 'back'){
                    $data['back'] = $service_image->service_image_id . '/' . $newfilename;
                }
                $data['link'] = $service_image->service_image_id . '/' . $newfilename;
            }

        }
        $data['id'] = $service_image->service_image_id;

       return json_encode($data);
        
    }
    
    public function actionType(){
        $data = $_POST;

        if($data['service'] != []){
            
            $service_detail_old = \backend\models\ServiceDetail::find()->where(['service_id' => $data['service_id']])->orderBy('service_id ASC')->one();
            $connection = Yii::$app->db;
            $connection->createCommand()->delete('service_detail', ['service_id' => $data['service_id']])->execute();

            $order_detail_one = \backend\models\OrderDetailWarranty::find()
                    ->where(['order_detail_warranty.warranty_id'=>$data['warranty']])
                    ->one();
            
                foreach ($data['service'] as $data_service) {
                    $data['service_type_store_id'] = $data_service;
                    $service_type_store = \backend\models\ServiceTypeStore::find()->where(['store_id'=>153])->andWhere(['service_type_id'=>$data_service])->one();

                    $service_detail = new \backend\models\ServiceDetail();
                    $service_detail->service_id = $data['service_id'];
                    $service_detail->order_detail_warranty_id = $order_detail_one->order_detail_warranty_id;
                    $service_detail->service_type_store_id = $service_type_store->service_type_store_id;
                    $service_detail->service_detail_drop_store_id = $service_detail_old->service_detail_drop_store_id;
                    
                    if($data_service == 11){
                        $service_detail->service_other_text = $data['other_text'];
                    }
                    $service_detail->save();
                }
           $service_image = \backend\models\ServiceImage::find()->where(['service_id'=>$data['service_id']])->one();
           if($service_image == null){
               $data['image'] = 'false';
           }else{
               $data['image'] = 'true';
           }
        }
        
        return json_encode($data);
    }
    public function actionDrop(){
        $data = $_POST;

        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

        $stores = \backend\models\Stores::find()
                   
                    ->where(['store_id' => $data['id']])
                    // ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                   
                    ->one();

        $store['name'] = $stores->store_name;
        $store['address'] = $stores->store_address;
        $store['contact'] = $stores->store_contact_number;
        $store['store_id'] = $data['id'];
        
        $service = \backend\models\Service::find()->where(['service_id'=>$data['service_id']])->one();
        $service->sender_name = $customerInfo['fname'];
        $service->save();

        $service_details = \backend\models\ServiceDetail::find()->where(['service_id'=>$data['service_id']])->all();
        foreach($service_details as $service_detail){
    
            $connection = Yii::$app->db;
            $connection->createCommand()->update('service_detail', ['service_detail_drop_store_id' => $data['id']], 'service_detail_id="'.$service_detail->service_detail_id.'"')->execute();
          
        }

        return json_encode($store);

        
                
        // return json_encode($data);
    }
    public function actionResi(){
        $data = $_POST;

                    $data['service_type_store_id'] = $data_service;
                    $service = \backend\models\Service::findOne($data['service_id']);
                    
                    $service_detail = \backend\models\ServiceDetail::find()->where(['service_id'=>$data['service_id']])->orderBy('service_detail_id DESC')->one();

            $imagePath = \Yii::getAlias("@frontend" . '/web/img/warranty/service/uploads/customer-resi');
           
            if(isset($_FILES["file_resi"]["name"])){
                $temp = explode(".", $_FILES["file_resi"]["name"]);
                $newfilename = md5($_FILES["file_resi"]["name"]) . '.' . end($temp);
                move_uploaded_file($_FILES['file_resi']['tmp_name'], $imagePath . "/" . $newfilename);
                $service->customer_shipping_number_image = $newfilename;
            }

                    $service->customer_shipping_carrier = $data['kurir'];
                    $service->customer_shipping_number = $data['resi'];
                    
        
        $service_history = new \backend\models\ServiceHistory();
        $service_history->service_id = $data['service_id'];
        
        if($service_detail->service_detail_drop_store_id == 153){
            $service_history->service_state_lang_id = 1;
        }else{
            $service_history->service_state_lang_id = 35;
        }
        
        $service_history->date_add = date('Y-m-d H:i:s');
        $service_history->save();     
        
        $service->service_history_id = $service_history->service_history_id;
        $service->update();
       
        // $service_data for email, service data must query again 
        $service_data = \backend\models\Service::findOne($data['service_id']);
        
        // echo $data->orders->customer->email;die();
                \common\components\Helpers::sendEmailMandrillUrlAPI(
					$this->renderFile('@backend/views/template/mail/front/warranty_customer_send.php', array(
						"data" => $service_data
					)), 'Terima Kasih Telah Mengirim Produk Anda', 'notification@thewatch.co', $service_data->orders->customer->email, ''
				);
        
        return json_encode($data);
    }
    
    public function actionPaymentconfirm(){
        $data = $_POST;

        $service = \backend\models\Service::find()->where(['service_id'=>$data['service_id']])->one();
        $service->payment_method_detail_id = $data['warranty_payment_detail'];
        
        
        $imagePath = \Yii::getAlias("@frontend" . '/web/img/warranty/service/uploads/payment_confirm');
        $newfilename = '';   
            if(isset($_FILES["file_pembayaran"]["name"])){
                $temp = explode(".", $_FILES["file_pembayaran"]["name"]);
                $newfilename = md5($_FILES["file_pembayaran"]["name"].'+'.$data['service_id']) . '.' . end($temp);
                move_uploaded_file($_FILES['file_pembayaran']['tmp_name'], $imagePath . "/" . $newfilename);
             
            }
        
        $service_confirmation = new \backend\models\ServiceConfirmation();
        $service_confirmation->service_id = $data['service_id'];
        $service_confirmation->account_name = $data['warranty_account_name'];
        $service_confirmation->account_number = $data['warranty_account_number'];
        $service_confirmation->bank_account = $data['warranty_bank_name'];
        $service_confirmation->amount = $data['warranty_nominal'];
        $service_confirmation->transfer_method = $data['payment_method'];
        $service_confirmation->date_add = date('Y-m-d H:i:s');
        $service_confirmation->payment_image = $newfilename;
        $service_confirmation->save();
        
        $service_history = new \backend\models\ServiceHistory();
        $service_history->service_id = $data['service_id'];
        $service_history->service_state_lang_id = 28;
        $service_history->date_add = date('Y-m-d H:i:s');
        $service_history->save();     
        
        $service->service_history_id = $service_history->service_history_id;
        $service->update();
        
        return json_encode($data);
    }
    
    public function actionCancel($id)
    {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');

     
        $service = \backend\models\Service::find()->where(['service_id'=>$id])->one()->delete();
        $connection = Yii::$app->db;
            $connection->createCommand()->delete('service_detail', ['service_id' => $id])->execute();
        // $service_detail = \backend\models\ServiceDetail::find()->where(['service_id'=>$id])->all()->delete();
        
        return $this->redirect(['warranty/card']);
    }
    
    public function actionReturnstore(){
        $data = $_POST;

        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');
        
        $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['store_id'=>$data['id']])->andWhere(['payment_id'=>27])->andWhere(['payment_method_id'=>7])->one();
        $service = \backend\models\Service::find()->where(['service_id' => $data['service_id']])->one();
        $service->sc_drop_store_id = $data['id'];
        $service->sc_drop_name = '';
        $service->sc_drop_address = '';
        $service->sc_drop_telp = '';
        $service->payment_method_detail_id = $payment_method_detail->payment_method_detail_id;
        $service->update();
        
        $stores = \backend\models\Stores::find()
                   
                    ->where(['store_id' => $data['id']])
                    // ->where(['product.product_category_id' => $category->product_category_id, 'product.active' => 1])
                   
                    ->one();

        $store['name'] = $stores->store_name;
        $store['address'] = $stores->store_address;
        $store['contact'] = $stores->store_contact_number;

        
        return json_encode($store);

        
                
        // return json_encode($data);
    }
    
    public function actionReturnaddress(){
        $data = $_POST;

        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');
        
        $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_id'=>26])->andWhere(['payment_method_id'=>1])->one();
        
        $service = \backend\models\Service::find()->where(['service_id' => $data['service_id']])->one();
        $service->sc_drop_store_id = 0;
        $service->sc_drop_name = $data['return-name'];
        $service->sc_drop_address = $data['return-address'];
        $service->sc_drop_telp = $data['return-telp'];
        $service->sc_drop_province_id = $data['province_id'];
        $service->sc_drop_state_id = $data['state_id'];
        $service->sc_drop_district_id = $data['district_id'];
        $service->sc_drop_kelurahan = $data['return-kel'];
        $service->payment_method_detail_id = $payment_method_detail->payment_method_detail_id;
        $service->update();
        
        $store['name'] = $data['return-name'];
        $store['address'] = $data['return-address'];
        $store['contact'] = $data['return-telp'];

        
        return json_encode($store);

        
                
        // return json_encode($data);
    }
    
    public function actionPayment($id){
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/?back_url=/warranty/payment/'.$id.'#loginWarranty');
        
        $service = \backend\models\Service::find()->where(['service_id'=>$id])->one();
        
        $store = \backend\models\Stores::find()->where(['store_id'=>$service->sc_drop_store_id])->one();
        $service_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service->service_history_id])->one();
        
        $service_state_lang = \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one();
        
        $service_confirmation = \backend\models\ServiceConfirmation::find()->where(['service_id'=>$id])->orderBy('service_confirmation_id DESC')->one();
        
        $questionnaire = \backend\models\Questionnaire::find()->where(['questionnaire_id'=>1])->one();
        $questionnaire_respondent = \backend\models\QuestionnaireRespondent::find()->where(['questionnaire_id'=>$questionnaire->questionnaire_id])->andWhere(['customer_id'=>$customerInfo['customer_id']])->one();
        
        $questionnaire_active = 'yes';
        if($questionnaire_respondent != null){
            $questionnaire_active = 'no';
        }
        
        $question = \backend\models\Question::find()->where(['questionnaire_id'=>$questionnaire->questionnaire_id])->all();
        
        return $this->render('thankyou',['service'=>$service,'store'=>$store,'service_confirmation'=>$service_confirmation,'service_state_lang'=>$service_state_lang,'questionnaire'=>$questionnaire,'questions'=>$question,'questionnaire_active'=>$questionnaire_active]);
    }
    
    public function actionSurvei(){
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');
       
        $answers = $_POST['answer'];
       
        
        // print_r($_POST);die();
        $questionnaire = \backend\models\Questionnaire::find()->where(['questionnaire_id'=>$_POST['questionnaire_id']])->one();
        $questionnaire_respondent = \backend\models\QuestionnaireRespondent::find()->where(['questionnaire_id'=>$questionnaire->questionnaire_id])->andWhere(['customer_id'=>$customerInfo['customer_id']])->one();
        
        if($questionnaire_respondent == null){
            
            $respondent = new \backend\models\QuestionnaireRespondent();
            $respondent->questionnaire_id = $questionnaire->questionnaire_id;
            $respondent->customer_id = $customerInfo['customer_id'];
            $respondent->save();
          
            foreach($answers as $key => $answer){
                if(is_array($answer)){
                    $answer_new = new \backend\models\Answer();
                    $answer_new->questionnaire_respondent_id = $respondent->questionnaire_respondent_id;
                    $answer_new->question_id = $key;
                    
                    
                    $answer_new->answer_date = date('Y-m-d H:i:s');
                    $answer_new->save();
                    
                    foreach($answer as $key_a => $a){
                        // $answer_choice_id = \backend\models\QuestionChoice::find()->where(['question_id'=>$key_a])->one();
                        
                        $answer_choice = new \backend\models\AnswerChoice();
                        $answer_choice->answer_id = $answer_new->answer_id;
                        $answer_choice->question_choice_id = $a;
                        $answer_choice->save();
                    }    
                    
                
                }else{
                    $answer_new = new \backend\models\Answer();
                    $answer_new->questionnaire_respondent_id = $respondent->questionnaire_respondent_id;
                    $answer_new->question_id = $key;
                    
                    if(is_numeric($answer)){
                  
                        $answer_new->answer_choice_id = $answer;
                    }else{
                        $answer_new->answer_text = $answer;
                    }
                    $answer_new->answer_date = date('Y-m-d H:i:s');
                    $answer_new->save();
                    
                }
            }
        }else{
            
        }
         
        return $this->redirect(['warranty/payment/'.$_POST['service_id']]);
    }
    
    public function actionSurveiservice($id){
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');
        if(isset($_POST)){
            $data = $_POST['survei'];
                $questionnaire_respondent = new \backend\models\QuestionnaireRespondent();
                $questionnaire_respondent->customer_id = $customerInfo['customer_id'];
                $questionnaire_respondent->questionnaire_id = 2;
                $questionnaire_respondent->save();
                
                $service = \backend\models\Service::find()->where(['service_id'=>$id])->one();
                $service->questionnaire_respondent_id = $questionnaire_respondent->questionnaire_respondent_id;
                $service->update();
                
            foreach($data as $key => $value){
          
                $answer = new \backend\models\Answer();
                $answer->questionnaire_respondent_id = $questionnaire_respondent->questionnaire_respondent_id;
                $answer->question_id = $key;
                $answer->answer_text = $value;
                $answer->answer_choice_id = 0;
                $answer->answer_date = date('Y-m-d H:i:s');
                $answer->save();
                
             
            }
        
        }
        
          
        return $this->redirect(['warranty/card']);
    }
    
    public function actionSurveicontent(){
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');
        
        $service = \backend\models\Service::findOne($_POST['id']);;
        // return 'ada';
        return $this->renderFile('@app/views/warranty/survei_content.php', array("service" => $service));
        
    }
    
    public function actionReceive($id){
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        isset($customerInfo) ? '' : $this->redirect('/');
        
        $service = \backend\models\Service::find()->where(['service_id'=>$id])->one();
        
        $service_history = new \backend\models\ServiceHistory();
        $service_history->service_id = $id;
        $service_history->service_state_lang_id = 33;
        $service_history->date_add = date('Y-m-d H:i:s');
        $service_history->save();   
        
        $service->service_history_id = $service_history->service_history_id;
        $service->update();
        
        $reminder = \backend\models\ServiceReminder::find()->where(['service_id'=>$service->service_id])->one();
        if($reminder != null){
            $reminder->service_received_status = 0;
            $reminder->update();    
        }
        
        
        return $this->redirect(['warranty/card']);
    }
    
    private function actionSearch($q){
        $products = \backend\models\Product::find()
               
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection" => function ($query) {
                        $query->andWhere(['brands_collection_status' => 1]);
                    },

                ])

                ->where([
                    'LIKE', 'product_detail.name', '%'.$q.'%', false,
                
                    
                ])
                ->orWhere([
                    'LIKE', 'brands.brand_name', '%'.$q.'%', false    
                ])
                // ->where(['product.active' => 1])
                ->orderBy('product.product_id DESC')
                ->all();
        $array_product = [];
        $i = 0;
        foreach($products as $product){
            $array_product[$i] = $product->product_id;
            $i++;
        }
        // print_r($array_product);die();
        return $array_product;
    }
    public function actionMail(){
        
       
        $startDate = time();
       // echo date('Y-m-d H:i:s', strtotime('+1 day', $startDate));
        
        $current = date('Y-m-d H:i:s');
        // echo $current;
        
        $data = \backend\models\Service::findOne(19);
        
        if($data->sc_drop_store_id == 0){
            
        }else{
            $store = \backend\models\Stores::find()->where(['store_id'=>$data->sc_drop_store_id])->one();
            echo $store->store_name.', '.strip_tags($store->store_address);
        }
        
        $serviceList = \backend\models\ServiceDetail::findAll(["service_id" => $data->service_id]);
        $j = 1;
        if(count($serviceList) > 0){
            foreach($serviceList as $list){
                echo $list->serviceTypeStore->serviceType->service_type_name;echo $list->serviceTypeStore->serviceType->service_type_id == 11 ? "(".$list->service_other_text.")" : "";
               
               if(count($serviceList) != $j){
                  echo ", "; 
               } 
               if(count($serviceList) - $j == 1){
                   echo "dan ";
               }
                $j++;
            }
        }
        
        $reminder = \backend\models\ServiceReminder::find()->where(['service_id'=>$data->service_id])->one();
        echo date('d F Y', strtotime($reminder->service_sent_date));  
    }
    
    public function actionCart(){
        $array_product = [1995,1101,1709,1634,1467,1774,1659,1697,1759,1782,1795,1115,1768,2018,2023,1777,1999,2001,2002,2021,2011,2024,1772,1579,1779,1780,1100,2017,1650,1652,1704,1608];
        foreach($array_product as $product){
            echo $product.'<br>';
            $cart_rule_product = new \backend\models\CartRuleProduct();
            $cart_rule_product->cart_rule_id = 16243;
            $cart_rule_product->product_id = $product;
            $cart_rule_product->save();
        }
        // for($i=8985;$i<=9084;$i++){
        //     echo $i.'<br>';

        //     $cart = \backend\models\CartRule::find()->where(['cart_rule_id'=>$i])->one();
        //     $cart->brand_restriction = 1;
        //     $cart->update();

        //     $cart_new = new \backend\models\CartRuleBrand();
        //     $cart_new->cart_rule_id = $i;
        //     $cart_new->brand_id = 2;
        //     $cart_new->save();

        //     $cart_new = new \backend\models\CartRuleBrand();
        //     $cart_new->cart_rule_id = $i;
        //     $cart_new->brand_id = 48;
        //     $cart_new->save();

        //     $cart_new = new \backend\models\CartRuleBrand();
        //     $cart_new->cart_rule_id = $i;
        //     $cart_new->brand_id = 44;
        //     $cart_new->save();

        //     $cart_new = new \backend\models\CartRuleBrand();
        //     $cart_new->cart_rule_id = $i;
        //     $cart_new->brand_id = 79;
        //     $cart_new->save();

        // }

        
        die();
    }
    public function actionAksesoris(){
        $now = date('2018-11-21 12:00:00');
        $products = \backend\models\Product::find()->where(['product.brands_brand_id'=>[48,44,79,2]])->all();
        
        // $products = \backend\models\SpecificPrice::find()->where('specific_price.from <= "'. $now . '"')
        //         ->andWhere('specific_price.to > "'. $now . '"')->all();
        // $products = [3172,3173,3174,3175,3176];
        foreach($products as $product){
            echo $product->product_id.'<br>';
                // $cart_rule = new \backend\models\CartRuleProduct();
                // $cart_rule->cart_rule_id = 16396;
                // $cart_rule->product_id = $product;
                // $cart_rule->save();
            // $product_feature = new \backend\models\ProductFeature();
            // $product_feature->feature_id = 3;
            // $product_feature->product_id = $product->product_id;
            // $product_feature->feature_value_id = 117;
            // $product_feature->save();
        }
        echo 'total: '.count($products);die();
    }
    public function actionCustomerordermail(){
    //     \common\components\Helpers::sendEmailMandrillUrlAPI(
				// 	$this->renderFile('@frontend/views/warranty/customeremailsample.php', array("data" => "data"
				// 	)), 'The Watch Co - Order Information', 'notification@thewatch.co', 'widiastutimonika@gmail.com', ''
				// );
				
		echo 'oke';die();
    }

    public function actionGetwarrantylist(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$search = $_POST['q'];
		$items = array();
		
		if(isset($search)){
			$warrantys = \backend\models\Warranty::find()
				->where(['warranty.warranty_code'=>$search])
				->andWhere([
					"warranty.warranty_status" => strtoupper($_GET['status'])
				])
				->orderBy('warranty.warranty_id DESC')
				->all();
				
			if(count($warrantys) >= 1){
			    $warranty_id = 0;
			    foreach($warrantys as $warranty){
			        $warranty_id = $warranty->warranty_id;
			    }
				$warrantys = array(
        			"total_count" => count($warrantys),
        			"incomplete_results" => false,
        			"result" => "found",
        			"warranty_id" => $warranty_id
        		);
			}elseif(count($warrantys) == 0){
			    $warrantys = array(
        			"total_count" => count($warrantys),
        			"incomplete_results" => false,
        			"result" => "not found"
        		);
			}
		}
		
		
		
		return $warrantys;
	}
	
	public function actionGetwarrantyid(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$search = $_POST['q'];
		$items = array();
		
		if(isset($search)){
			$warrantys = \backend\models\Warranty::find()
				->where(['warranty.warranty_id'=>$search])
				->andWhere([
					"warranty.warranty_status" => strtoupper($_GET['status'])
				])
				->orderBy('warranty.warranty_id DESC')
				->all();
				
			if(count($warrantys) >= 1){
			    $warranty_id = 0;
			    foreach($warrantys as $warranty){
			        $warranty_id = $warranty->warranty_id;
			    }
				$warrantys = array(
        			"total_count" => count($warrantys),
        			"incomplete_results" => false,
        			"result" => "found",
        			"warranty_id" => $warranty_id
        		);
			}elseif(count($warrantys) == 0){
			    $warrantys = array(
        			"total_count" => count($warrantys),
        			"incomplete_results" => false,
        			"result" => "not found"
        		);
			}
		}
		
		
		
		return $warrantys;
	}
}
