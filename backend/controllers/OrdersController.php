<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Customer;
use backend\models\Orders;
use backend\models\OrderDetail;
use backend\models\Product;
use backend\models\ProductDetail;
use backend\models\SpecificPrice;
use backend\models\Warranty;
use backend\models\OrderDetailWarranty;
use backend\models\SysAutonumber;
use backend\models\SysAutonumberBrands;
use common\components\Helpers;

/**
 * groupController implements the CRUD actions for group model.
 */
class OrdersController extends Controller {

    public $layout = "dashboard";
	
	public function beforeAction($action)
	{            
		//if ($action->id == 'my-method') {
			$this->enableCsrfValidation = false;
		//}

		return parent::beforeAction($action);
	}

    public function behaviors() {

        if(!Yii::$app->session->get('userInfo')){
			return $this->redirect(Yii::$app->params['backendLoginUrl']);
		}
		
		$module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect(Yii::$app->params['backendPermissionDeniedUrl']);
        }

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	
	public function actionQuickview($id){
        $model = $this->findModel($id);
        
        return $this->renderPartial('quickview', [
            'model' => $model,
        ]);
    }
    
	public function actionGetallorders($draw) {
		$connection = Yii::$app->getDb();
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$orderDateFrom = $_GET['columns'][6]['search']['value'];
		$orderDateTo = $_GET['columns'][7]['search']['value'];
		
		//$orderDate = "(orders.date_add BETWEEN '".date('d-m-Y')." 00:00:00 ' AND '".date('d-m-Y')." 23:59:00 ')";
		
		if($orderDateFrom != '' && $orderDateTo != ''){
			
			$orderDateFrom = $_GET['columns'][6]['search']['value'];
			$orderDateTo = $_GET['columns'][7]['search']['value'];
			
		} else {
			
			$orderDateFrom = date('Y-m-d');
			$orderDateTo = date('Y-m-d');
			
		}
		
		$orderDate = "(orders.date_add BETWEEN '".$orderDateFrom." 00:00:00 ' AND '".$orderDateTo." 23:59:00 ')";
		
		//echo $orderDate; die();
		
		$command = $connection->createCommand("SELECT COUNT(*) AS total FROM orders WHERE ".$orderDate."");
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Store Staff"){
			$command = $connection->createCommand("SELECT COUNT(*) AS total FROM orders WHERE store_id = " . $store_id . " AND ".$orderDate." ");
		}
		
		$data = $command->queryAll();
		
		foreach($data as $row){
			$total_orders = $row['total'];
		}
		
		// 
		
        //$total_orders = \backend\models\Orders::find()->count();
        
        // $queryTotalFind = \backend\models\Orders::find()
        //         ->joinWith([
        //             "customer",
        //             "customeraddress",
        //             "paymentmethoddetail"
        //         ]);
        
        $userFilter = FALSE;
        $userSearch = $_GET['search']['value'];
        
        $filterreference = $_GET['columns'][1]['search']['value'];
        $filtercustomer = $_GET['columns'][2]['search']['value'];
        $filterpayment = $_GET['columns'][4]['search']['value'];
        $filterParams = array();
        $searchParams = array();
        
        $queryOrder = \backend\models\Orders::find()
			->joinWith([
				"customer",
				"customeraddress",
				"paymentmethoddetail",
			])
			->where(["orders.store_id" => $store_id]);

        $table = array('product_id', 'product_id', 'product_detail.name', 'brands.brand_name', 'brands_collection.brands_collection_name', 'product_category.product_category_name', 'price', 'product_id', 'active', 'product_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];
        
        if($filterreference != ''){
            $userFilter = TRUE;
            $filterParams[] = ['LIKE', 'orders.reference', $filterreference];
        }
        
        if($filtercustomer != ''){
            $userFilter = TRUE;
            $filterParams[0] = ['LIKE', 'customer.firstname', $filtercustomer];
            $filterParams[1] = ['LIKE', 'customer.lastname', $filtercustomer];
        }

        // if($filterpayment != ''){
        //     $userFilter = TRUE;
        //     $filterParams[] = ['LIKE', 'orders.payment_method_detail_id', $filterpayment];
        // }

        if($userFilter){
            
            foreach($filterParams as $filter){
                // $queryTotalFind
                //     ->andFilterWhere($filter);
                
                $queryOrder
                    ->andFilterWhere($filter);
            }
            
            if($userSearch != ''){
                // $queryTotalFind
                //     ->where(['like', 'orders.reference', $_GET['search']['value']])
                //     ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
                   
                $queryOrder
                    ->orWhere(['like', 'orders.reference', $_GET['search']['value']])
                    ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
            }
                
        } else {
            
            if($userSearch != ''){
                
                // $queryTotalFind
                //     ->where(['like', 'orders.reference', $_GET['search']['value']])
                //     ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
                $queryOrder
                    ->orWhere(['like', 'orders.reference', $_GET['search']['value']])
                    ->orWhere(['like', 'customer.firstname', $_GET['search']['value']]);
            }
            
        }
		
		$queryOrder->andFilterWhere(['between','orders.date_add', $orderDateFrom . ' 00:00:00 ', $orderDateTo . ' 23:59:00']);
        
        $total_find = $queryOrder->all();
        $orders = $queryOrder
                ->orderBy('orders.orders_id desc')
                ->offset($_GET['start'])
                ->limit($_GET['length'])
                ->all();

        // $products = $queryProduct
        //         ->orderBy($order)->offset($_GET['start'])
        //         ->limit($_GET['length'])
        //         ->all();
        


        $columns = array();
        $numbering = $_GET['start'];

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();


		$data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . $total_orders . ',
            "recordsFiltered": ' . count($total_find) . ',
            "data": ';


        if (!empty($orders)) {
            foreach ($orders as $row) {


                $button = "";

                $numbering++;
                $button = '<div class="btn-group"><a href="' . \yii\helpers\Url::base() . '/orders/view/' . $row->orders_id . '" class="btn btn-default" ><i class="fa fa-fw fa-eye"></i> View</a>';

              
                $button = $button . '</ul></div>';                              

                $paymentmethod = $row->paymentmethoddetail->payment->name_bank;
                if($row->payment_method_installment_detail_id != 0){
                    $paymentmethod = $paymentmethod .' ' . \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_method_installment_detail_id' => $row->payment_method_installment_detail_id])->paymentMethodInstallment->payment_method_installment_name;
                }
				 if($row->payment_method_detail_id == 10){
					 $kredivoPaymentType = \backend\models\KredivoNotify::findOne(['kredivo_order_id' => $row->reference]);
					 if($kredivoPaymentType->kredivo_payment_type == '30_days'){
						 $paymentmethod = $paymentmethod . ' 30 days payment';
					 } elseif($kredivoPaymentType->kredivo_payment_type == '3_months'){
						 $paymentmethod = $paymentmethod . ' 3 month installment';
					 } elseif($kredivoPaymentType->kredivo_payment_type == '6_months'){
						 $paymentmethod = $paymentmethod . ' 6 month installment';
					 } elseif($kredivoPaymentType->kredivo_payment_type == '12_months'){
						 $paymentmethod = $paymentmethod . ' 12 month installment';
					 }
				 }


                // $image = '<img src="https://d3vq5glb73pll6.cloudfront.net/img/product/' . $product_image_id . '/' . $product_image_id . '.jpg" class="img-responsive">';

                $product_array = array(
                    "No" => $numbering, 
                    "reference" => $row->reference, 
                    "customer" => $row->customer->firstname . ' ' . $row->customer->lastname,
                    "payment" => $paymentmethod,
                    "date" => date_format(date_create($row->date_add), 'j F Y g:i A'), 
                    "action" => $button,
					"order_date_from" => '',
					"order_date_to" => ''
                );
                array_push($columns, $product_array);
            }
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }

    public function actionExportto() {
        // return $this->redirect(['view']);
        if($_POST['export_to'] != ''){
            if($_POST['from'] != '' && $_POST['to'] != '')
            {
             
                $data = \backend\models\Orders::find()
                    ->orderBy('date_add DESC')
                    ->where(['between','date_add', $_POST['from'] . ' 00:00:00 ', $_POST['to'] . ' 23:59:00'])
                    ->all();

            }
            else{
                return $this->redirect(['index']);
            }
            
            \common\components\PHPExcel_Helper::generateExport($_POST['export_to'], $data, $_POST['from'], $_POST['to']);
        }else{
            return $this->redirect(['index']);
        }
    }
	
	private function RenderStoreOrder(){
		
		return $this->render('../orderstore/index');
		
	}
	

    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if($departement == "Store Staff"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->RenderStoreOrder();
		}
		if($departement == "Customer Service & After Sales"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->RenderStoreOrder();
		}
		
		$value = $_GET['payment'];
        $value1 = $_GET['status'];
        $date1 = $_GET['from'];
        $date2 = $_GET['to'];
        
        if($_GET['export_to'] != ''){
            
            if(($_GET['from']!='' && $_GET['to']!='')){
				
				$connection = Yii::$app->getDb();
				if($_GET['payment'] != '' && $_GET['status'] != ''){
				    $command = $connection->createCommand("
    					SELECT
    						orders.reference,
    						customer.firstname,
    						customer.lastname,
    						customer_address.address1,
    						district.name as district_name,
    						state.name as state_name,
    						province.province_id,
    						province.name as province_name,
    						customer_address.postcode,
    						customer.email,
    						customer_address.phone,
    						orders.total_product_price, 
    						orders.unique_code,
    						orders.total_discounts,
    						orders.total_shipping,
    						payment.name_bank,
    						orders.date_add,
    						orders.shipping_number,
    						order_detail.product_name,
    						order_detail.original_product_price,
    						product_detail.link_rewrite,
    						brands.brand_name,
    						order_detail.product_quantity,
    						orders.payment_method_installment_detail_id,
    						orders.payment_method_detail_id,
    						orders.reference,
    						orders.orders_id,
    						carrier_package.carrier_package_id,
    						carrier_package.carrier_package_name,
    						orders.total_shipping_insurance,
    						orders.carrier_delivery_name,
    						payment_method_installment.payment_method_installment_name,
    						kredivo_notify.kredivo_payment_type,
    						order_confirmation.account_name,
							orders.flash_sale,
							orders.total_special_promo
    					FROM
    						orders
    						LEFT JOIN customer ON (customer.customer_id = orders.customer_id)
    						LEFT JOIN customer_address ON (customer_address.customer_address_id = orders.customer_address_id)
    						LEFT JOIN district ON (customer_address.district_id = district.district_id)
    						LEFT JOIN state ON (customer_address.state_id = state.state_id)
    						LEFT JOIN province ON (customer_address.province_id = province.province_id)
    						LEFT JOIN payment_method_detail ON (payment_method_detail.payment_method_detail_id = orders.payment_method_detail_id)
    						LEFT JOIN payment ON (payment.payment_id = payment_method_detail.payment_id)
    						LEFT JOIN order_detail ON (orders.orders_id = order_detail.orders_id)
    						LEFT JOIN product_detail ON (order_detail.product_id = product_detail.product_id)
    						LEFT JOIN product ON (order_detail.product_id = product.product_id)
    						LEFT JOIN brands ON (product.brands_brand_id = brands.brand_id)
    						LEFT JOIN carrier_cost ON (orders.carrier_cost_id = carrier_cost.carrier_cost_id)
    						LEFT JOIN carrier_package_detail ON (carrier_package_detail.carrier_package_detail_id = carrier_cost.carrier_package_detail_id)
    						LEFT JOIN carrier_package ON (carrier_package_detail.carrier_package_id = carrier_package.carrier_package_id)
    						LEFT JOIN payment_method_installment_detail ON (orders.payment_method_installment_detail_id = payment_method_installment_detail.payment_method_installment_detail_id)
    						LEFT JOIN payment_method_installment ON (payment_method_installment_detail.payment_method_installment_id = payment_method_installment.payment_method_installment_id)
    						LEFT JOIN kredivo_notify ON (kredivo_notify.kredivo_order_id = orders.reference)
    						LEFT JOIN order_history ON (order_history.orders_id = orders.orders_id)
    						LEFT JOIN order_confirmation ON (order_confirmation.orders_id = orders.orders_id)
    					WHERE 
    						(orders.date_add BETWEEN '".$date1." 00:00:00 ' AND '".$date2." 23:59:00 ') AND
    						orders.store_id = " . $store_id . " AND orders.payment_method_detail_id = " . $value . " AND order_history.order_state_lang_id = " . $value1 . "
    					GROUP BY orders.reference
    					ORDER BY orders.date_add DESC
    				");
				}
				if($_GET['payment'] == '' && $_GET['status'] != ''){
				    $command = $connection->createCommand("
    					SELECT
    						orders.reference,
    						customer.firstname,
    						customer.lastname,
    						customer_address.address1,
    						district.name as district_name,
    						state.name as state_name,
    						province.province_id,
    						province.name as province_name,
    						customer_address.postcode,
    						customer.email,
    						customer_address.phone,
    						orders.total_product_price,
    						orders.unique_code,
    						orders.total_discounts,
    						orders.total_shipping,
    						payment.name_bank,
    						orders.date_add,
    						orders.shipping_number,
    						order_detail.product_name,
    						product_detail.link_rewrite,
    						brands.brand_name,
    						order_detail.product_quantity,
    						order_detail.original_product_price,
    						orders.carrier_cost_id,
    						orders.payment_method_installment_detail_id,
    						orders.payment_method_detail_id,
    						orders.reference,
    						orders.orders_id,
    						carrier_package.carrier_package_id,
    						carrier_package.carrier_package_name,
    						orders.total_shipping_insurance,
    						orders.carrier_delivery_name,
    						payment_method_installment.payment_method_installment_name,
    						kredivo_notify.kredivo_payment_type,
    						order_confirmation.account_name,
							orders.flash_sale,
							orders.total_special_promo,
    					FROM
    						orders
    						LEFT JOIN customer ON (customer.customer_id = orders.customer_id)
    						LEFT JOIN customer_address ON (customer_address.customer_address_id = orders.customer_address_id)
    						LEFT JOIN district ON (customer_address.district_id = district.district_id)
    						LEFT JOIN state ON (customer_address.state_id = state.state_id)
    						LEFT JOIN province ON (customer_address.province_id = province.province_id)
    						LEFT JOIN payment_method_detail ON (payment_method_detail.payment_method_detail_id = orders.payment_method_detail_id)
    						LEFT JOIN payment ON (payment.payment_id = payment_method_detail.payment_id)
    						LEFT JOIN order_detail ON (orders.orders_id = order_detail.orders_id)
    						LEFT JOIN product_detail ON (order_detail.product_id = product_detail.product_id)
    						LEFT JOIN product ON (order_detail.product_id = product.product_id)
    						LEFT JOIN brands ON (product.brands_brand_id = brands.brand_id)
    						LEFT JOIN carrier_cost ON (orders.carrier_cost_id = carrier_cost.carrier_cost_id)
    						LEFT JOIN carrier_package_detail ON (carrier_package_detail.carrier_package_detail_id = carrier_cost.carrier_package_detail_id)
    						LEFT JOIN carrier_package ON (carrier_package_detail.carrier_package_id = carrier_package.carrier_package_id)
    						LEFT JOIN payment_method_installment_detail ON (orders.payment_method_installment_detail_id = payment_method_installment_detail.payment_method_installment_detail_id)
    						LEFT JOIN payment_method_installment ON (payment_method_installment_detail.payment_method_installment_id = payment_method_installment.payment_method_installment_id)
    						LEFT JOIN kredivo_notify ON (kredivo_notify.kredivo_order_id = orders.reference)
    						LEFT JOIN order_history ON (order_history.orders_id = orders.orders_id)
    						LEFT JOIN order_confirmation ON (order_confirmation.orders_id = orders.orders_id)
    					WHERE 
    						(orders.date_add BETWEEN '".$date1." 00:00:00 ' AND '".$date2." 23:59:00 ') AND
    						orders.store_id = " . $store_id . " AND order_history.order_state_lang_id = " . $value1 . "
    					GROUP BY orders.reference
    					ORDER BY orders.date_add DESC
    				");
				}
				if($_GET['payment'] != '' && $_GET['status'] == ''){
				    $command = $connection->createCommand("
    					SELECT
    						orders.reference,
    						customer.firstname,
    						customer.lastname,
    						customer_address.address1,
    						district.name as district_name,
    						state.name as state_name,
    						province.province_id,
    						province.name as province_name,
    						customer_address.postcode,
    						customer.email,
    						customer_address.phone,
    						orders.total_product_price,
    						orders.unique_code,
    						orders.total_discounts,
    						orders.total_shipping,
    						payment.name_bank,
    						orders.date_add,
    						orders.shipping_number,
    						order_detail.product_name,
    						product_detail.link_rewrite,
    						brands.brand_name,
    						order_detail.product_quantity,
    						order_detail.original_product_price,
    						orders.payment_method_installment_detail_id,
    						orders.payment_method_detail_id,
    						orders.reference,
    						orders.orders_id,
    						carrier_package.carrier_package_id,
    						carrier_package.carrier_package_name,
    						orders.total_shipping_insurance,
    						orders.carrier_delivery_name,
    						payment_method_installment.payment_method_installment_name,
    						kredivo_notify.kredivo_payment_type,
    						order_confirmation.account_name,
							orders.flash_sale,
							orders.total_special_promo
    					FROM
    						orders
    						LEFT JOIN customer ON (customer.customer_id = orders.customer_id)
    						LEFT JOIN customer_address ON (customer_address.customer_address_id = orders.customer_address_id)
    						LEFT JOIN district ON (customer_address.district_id = district.district_id)
    						LEFT JOIN state ON (customer_address.state_id = state.state_id)
    						LEFT JOIN province ON (customer_address.province_id = province.province_id)
    						LEFT JOIN payment_method_detail ON (payment_method_detail.payment_method_detail_id = orders.payment_method_detail_id)
    						LEFT JOIN payment ON (payment.payment_id = payment_method_detail.payment_id)
    						LEFT JOIN order_detail ON (orders.orders_id = order_detail.orders_id)
    						LEFT JOIN product_detail ON (order_detail.product_id = product_detail.product_id)
    						LEFT JOIN product ON (order_detail.product_id = product.product_id)
    						LEFT JOIN brands ON (product.brands_brand_id = brands.brand_id)
    						LEFT JOIN carrier_cost ON (orders.carrier_cost_id = carrier_cost.carrier_cost_id)
    						LEFT JOIN carrier_package_detail ON (carrier_package_detail.carrier_package_detail_id = carrier_cost.carrier_package_detail_id)
    						LEFT JOIN carrier_package ON (carrier_package_detail.carrier_package_id = carrier_package.carrier_package_id)
    						LEFT JOIN payment_method_installment_detail ON (orders.payment_method_installment_detail_id = payment_method_installment_detail.payment_method_installment_detail_id)
    						LEFT JOIN payment_method_installment ON (payment_method_installment_detail.payment_method_installment_id = payment_method_installment.payment_method_installment_id)
    						LEFT JOIN kredivo_notify ON (kredivo_notify.kredivo_order_id = orders.reference)
    						LEFT JOIN order_confirmation ON (order_confirmation.orders_id = orders.orders_id)
    					WHERE 
    						(orders.date_add BETWEEN '".$date1." 00:00:00 ' AND '".$date2." 23:59:00 ') AND
    						orders.store_id = " . $store_id . " AND orders.payment_method_detail_id = " . $value . "
    					GROUP BY orders.reference
    					ORDER BY orders.date_add DESC
    				");
				}
				if($_GET['payment'] == '' && $_GET['status'] == ''){
				    $command = $connection->createCommand("
    					SELECT
    						orders.reference,
    						customer.firstname,
    						customer.lastname,
    						customer_address.address1,
    						district.name as district_name,
    						state.name as state_name,
    						province.province_id,
    						province.name as province_name,
    						customer_address.postcode,
    						customer.email,
    						customer_address.phone,
    						orders.total_product_price,
    						orders.unique_code,
    						orders.total_discounts,
    						orders.total_shipping,
    						payment.name_bank,
    						orders.date_add,
    						orders.shipping_number,
    						order_detail.product_name,
    						product_detail.link_rewrite,
    						brands.brand_name,
    						order_detail.product_quantity,
    						order_detail.original_product_price,
    						orders.payment_method_installment_detail_id,
    						orders.payment_method_detail_id,
    						orders.reference,
    						orders.orders_id,
    						carrier_package.carrier_package_id,
    						carrier_package.carrier_package_name,
    						orders.total_shipping_insurance,
    						orders.carrier_delivery_name,
    						payment_method_installment.payment_method_installment_name,
    						kredivo_notify.kredivo_payment_type,
    						order_confirmation.account_name,
							orders.flash_sale,
							orders.total_special_promo
    					FROM
    						orders
    						LEFT JOIN customer ON (customer.customer_id = orders.customer_id)
    						LEFT JOIN customer_address ON (customer_address.customer_address_id = orders.customer_address_id)
    						LEFT JOIN district ON (customer_address.district_id = district.district_id)
    						LEFT JOIN state ON (customer_address.state_id = state.state_id)
    						LEFT JOIN province ON (customer_address.province_id = province.province_id)
    						LEFT JOIN payment_method_detail ON (payment_method_detail.payment_method_detail_id = orders.payment_method_detail_id)
    						LEFT JOIN payment ON (payment.payment_id = payment_method_detail.payment_id)
    						LEFT JOIN order_detail ON (orders.orders_id = order_detail.orders_id)
    						LEFT JOIN product_detail ON (order_detail.product_id = product_detail.product_id)
    						LEFT JOIN product ON (order_detail.product_id = product.product_id)
    						LEFT JOIN brands ON (product.brands_brand_id = brands.brand_id)
    						LEFT JOIN carrier_cost ON (orders.carrier_cost_id = carrier_cost.carrier_cost_id)
    						LEFT JOIN carrier_package_detail ON (carrier_package_detail.carrier_package_detail_id = carrier_cost.carrier_package_detail_id)
    						LEFT JOIN carrier_package ON (carrier_package_detail.carrier_package_id = carrier_package.carrier_package_id)
    						LEFT JOIN payment_method_installment_detail ON (orders.payment_method_installment_detail_id = payment_method_installment_detail.payment_method_installment_detail_id)
    						LEFT JOIN payment_method_installment ON (payment_method_installment_detail.payment_method_installment_id = payment_method_installment.payment_method_installment_id)
    						LEFT JOIN kredivo_notify ON (kredivo_notify.kredivo_order_id = orders.reference)
    						LEFT JOIN order_confirmation ON (order_confirmation.orders_id = orders.orders_id)
    					WHERE 
    						(orders.date_add BETWEEN '".$date1." 00:00:00 ' AND '".$date2." 23:59:00 ') AND
    						orders.store_id = " . $store_id . "
    					GROUP BY orders.reference
    					ORDER BY orders.date_add DESC
    				");
				}
				
				
				$data = $command->queryAll();
			 
                //$data = \backend\models\Orders::find()
                    //->orderBy('date_add DESC')
                    //->where(['between','date_add', $date1 . ' 00:00:00 ', $date2 . ' 23:59:00'])
                    //->all();

            }
            
            \common\components\PHPExcel_Helper::generateExport($_GET['export_to'], $data, $date1, $date2);
        }
        
		if(($_GET['from']!='' && $_GET['to']!='') && ($_GET['payment'] !='' && $_GET['status']!='' )){
			
            $data = \backend\models\Orders::find()
                ->joinWith([
                    "orderhistory"
                ])
                ->orderBy('date_add DESC')
                ->where(['payment_method_detail_id'=>$value])
				->andWhere(['orders.store_id' => $store_id])
                ->andWhere(['between','orders.date_add', $date1 . ' 00:00:00 ', $date2 . ' 23:59:00'])
                ->andWhere(['order_history.order_state_lang_id' => $value1])
                ->andWhere('order_history.date_add IN 
                    (SELECT MAX(date_add) FROM order_history GROUP by orders_id)')
                ->all();
				
            return $this->render('index', [
                    'data' => $data
            ]);
			
        }
		
		if(($_GET['from']!='' && $_GET['to']!='') && $_GET['status']!='' ){
			
			if($_GET['status'] == 7){
				
                $data = \backend\models\Orders::find()
                ->joinWith([
                    "orderhistory"
                ])
                ->orderBy('date_add DESC')
				->where(['orders.store_id' => $store_id])
                ->andWhere(['between','orders.date_add', $date1 . ' 00:00:00 ', $date2 . ' 23:59:00'])
                ->andWhere(['IN', 'order_history.order_state_lang_id', [7, 59, 61, 69]])
                ->andWhere('order_history.date_add IN 
                    (SELECT MAX(date_add) FROM order_history GROUP by orders_id)')
                ->all();
				
            } else {
            
                $data = \backend\models\Orders::find()
                    ->joinWith([
                        "orderhistory"
                    ])
                    ->orderBy('date_add DESC')
					->where(['orders.store_id' => $store_id])
                    ->andWhere(['between','orders.date_add', $date1 . ' 00:00:00 ', $date2 . ' 23:59:00'])
                    ->andWhere(['order_history.order_state_lang_id' => $value1])
                    ->andWhere('order_history.date_add IN 
                        (SELECT MAX(date_add) FROM order_history GROUP by orders_id)')
                    ->all();
            }	
			
            return $this->render('index', [
                    'data' => $data
            ]);
        }
        
        if($_GET['payment'] !='' && $_GET['status']!=''){
			
            $data = \backend\models\Orders::find()
                ->joinWith([
                    "orderhistory"
                ])
                ->orderBy('date_add DESC')
                ->where(['payment_method_detail_id'=>$value])
				->andWhere(['orders.store_id' => $store_id])
                ->andWhere(['order_history.order_state_lang_id' => $value1])
                ->andWhere('order_history.date_add IN 
                    (SELECT MAX(date_add) FROM order_history GROUP by orders_id)')
                ->all();
				
            return $this->render('index', [
                    'data' => $data
			]);
        }
		
		if(($_GET['from']!='' && $_GET['to']!='') && $_GET['payment'] != '' ){
			 
             $data = \backend\models\Orders::find()
                ->joinWith([
                    "orderhistory"
                ])
                ->orderBy('date_add DESC')
                ->where(['payment_method_detail_id'=>$value])
				->andWhere(['orders.store_id' => $store_id])
                ->andWhere(['between','orders.date_add', $date1 . ' 00:00:00 ', $date2 . ' 23:59:00'])
                ->all();
				
            return $this->render('index', [
                    'data' => $data
            ]);
		}
        
        if($_GET['payment'] != ''){
			
            $data = \backend\models\Orders::find()
                ->orderBy('date_add DESC')
                ->where(['payment_method_detail_id'=>$value])
				->andWhere(['orders.store_id' => $store_id])
                ->all();
				
            return $this->render('index', [
                    'data' => $data
			]);
        }
        if($_GET['status'] != ''){
            $data = \backend\models\Orders::find()
                ->joinWith([
                    "orderhistory"
                ])
                ->orderBy('date_add DESC')
                ->where(['order_history.order_state_lang_id' => $value1])
				->andWhere(['orders.store_id' => $store_id])
                ->andWhere('order_history.date_add IN 
                    (SELECT MAX(date_add) FROM order_history GROUP by orders_id)')
                ->all();
				
            return $this->render('index', [
                    'data' => $data
			]);
        }
        if($_GET['from']!='' && $_GET['to']!='' && $_GET['export_to'] == ''){
            $data = \backend\models\Orders::find()
                ->orderBy('date_add DESC')
                ->where(['between','date_add', $date1 . ' 00:00:00 ', $date2 . ' 23:59:00'])
				->andWhere(['orders.store_id' => $store_id])
                ->all();
			return $this->render('index', [
						'data' => $data
			]);
        }
		
		
		
        $data = \backend\models\Orders::find()
                ->joinWith([
                    "customer",
                    "customeraddress",
                    "paymentmethoddetail"
                ])
				->orderBy('orders.orders_id desc')
				->where(['orders.store_id' => $store_id])
				// ->andWhere(['<=','orders.date_add','2018-07-31 23:59:59 '])
				->limit(500)
                ->all();
				
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }
	
	private function RenderStoreOrderView($id, $template){
		$model = $this->findModel($id);
		
		switch($template){
			case "view":
				return $this->render('../orderstore/view', array(
					"model" => $model
				));
			break;
			
			case "update":
				return $this->render('../orderstore/update', array(
					"model" => $model
				));
			break;
		}
		
	}

    /**
     * Displays a single group model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
		
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		$ukey = Yii::$app->session->get('userInfo')['username'];
		
		if($departement == "Store Staff"){
			
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->RenderStoreOrderView($id, "view");
		}
		
        $model = $this->findModel($id);
        $different = 0;
        $state_lang_id = 0;
        
		if (isset($_POST)) {
			$isNotifyCustomer = $_POST['is_notify_customer'];
			$orderDetailHistory = empty($_POST['orderDetailHistory']) ? array() : $_POST['orderDetailHistory'];
			
			$orderDetailHistory2 = $orderDetailHistory;
			
			foreach ($orderDetailHistory as $key => $value){
				
				// Check status per produk for not same
                if($different == 0){
                    foreach ($orderDetailHistory2 as $ordet => $val_ordet) {
                        if($value['order_state_lang_id'] != $val_ordet['order_state_lang_id']){
                           
                            $different = 1;
                        }
                        
                    }
                  
                }
                $state_lang_id = $value['order_state_lang_id'];
                
				// current product status
				
				$status = \backend\models\OrderDetailHistory::find()->where(['order_detail_id' => $value['order_detail_id']])->orderBy('date_add DESC')->all();
				
				$currentProductInventoryStatus = '';
				$currentProductOrderStatus = '';
				
				foreach($status as $rowStatus){
					$currentProductInventoryStatus = $rowStatus->orderDetailStateLang->name;
					$currentProductOrderStatus = $rowStatus->orderStateLang->name;
					break;
				}
				
				// order detail history
				$orderDetailHistory = new \backend\models\OrderDetailHistory();
				$orderDetailHistory->orders_id = $value['orders_id'];
				$orderDetailHistory->order_detail_id = $value['order_detail_id'];
				$orderDetailHistory->order_state_lang_id = $value['order_state_lang_id'];
				$orderDetailHistory->order_detail_state_lang_id = $value['order_detail_state_lang_id'];
				$orderDetailHistory->date_add = date("Y-m-d H:i:s");
				if(isset($value['notes'])){
					$orderDetailHistory->notes = $value['notes'];
				}
				$orderDetailHistory->save();
				
				// send email each product
                if($different == 1){
                    if($isNotifyCustomer){
                        //if($model->customer->email == 'hendrihmwn@gmail.com'){
                            // echo $different;die();
                            if($orderDetailHistory->orderStateLang->template == 'goods_in_quality_check' || $orderDetailHistory->orderStateLang->template == 'goods_pass_quality_check_and_ready_to_packing' || $orderDetailHistory->orderStateLang->template == 'goods_not_pass_quality_check'){

                                $current_date = date('Y-m-d H:i:s');
                                $token_generate = md5($current_date);
                                if($orderDetailHistory->orderStateLang->template == 'goods_not_pass_quality_check'){
                                    $token = new \backend\models\Token();
                                    $token->token_generate = $token_generate;
                                    $token->token_status = 1;
                                    $token->token_date_add = $current_date;
                                    $token->token_date_expirated = date('Y-m-d H:i:s', strtotime("+3 day", strtotime($current_date)));
                                    $token->save();
                                }

                                \common\components\Helpers::sendEmailMandrillUrlAPI(
                                    $this->renderFile('@app/views/template/mail/order_information_product.php', array(
                                        "model" => $model, "id" => $orderDetailHistory->orderStateLang->template, "order_detail_id" => $value['order_detail_id'], "token"=>$token_generate
                                    )), 'Order Information', 'notification@thewatch.co', $model->customer->email, ''
                                );
                            }
                        //}
                    }
                }
                
				
				// create activity log for current inventory status
				$log = new \backend\models\Log();
				$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$log->module = Yii::$app->controller->id;
				$log->action = 'update';
				$log->action_text = 'user '. $log->fullname . ' update Inventory status product [' . \backend\models\OrderDetail::findOne($value['order_detail_id'])->product_name . '] from [' . $currentProductInventoryStatus . '] to [' . \backend\models\OrderDetailStateLang::findOne($value['order_detail_state_lang_id'])->name . ']';
				$log->date_time = date("Y-m-d H:i:s");
				$log->id_onChanged = $value['orders_id'];
				$log->save();
				
				// create activity log for current order status
				$log = new \backend\models\Log();
				$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$log->module = Yii::$app->controller->id;
				$log->action = 'update';
				$log->action_text = 'user '. $log->fullname . ' update Order status product [' . \backend\models\OrderDetail::findOne($value['order_detail_id'])->product_name . '] from [' . $currentProductOrderStatus . '] to [' . \backend\models\OrderStateLang::findOne($value['order_state_lang_id'])->name . ']';
				$log->date_time = date("Y-m-d H:i:s");
				$log->id_onChanged = $value['orders_id'];
				$log->save();
			}
			
			// if notify customer is checked
			if($isNotifyCustomer){
				// send email notification to customer about current order status
				// \common\components\Helpers::sendEmailMandrillUrlAPI(
    //                 $this->renderFile('@app/views/template/mail/notify_order_customer.php', array(
				// 		"model" => $model
    //                 )), 'Order Information', 'notification@thewatch.co', $model->customer->email, ''
				// );
				
				//if($model->customer->email == 'hendrihmwn@gmail.com'){
                    if($different == 0){

                        $order_state_lang = \backend\models\OrderStateLang::find()->where(['order_state_lang_id'=>$state_lang_id])->one();

                        $current_date = date('Y-m-d H:i:s');
                        $token_generate = md5($current_date);
                        if($order_state_lang->template == 'goods_not_pass_quality_check'){
                            $token = new \backend\models\Token();
                            $token->token_generate = $token_generate;
                            $token->token_status = 1;
                            $token->token_date_add = $current_date;
                            $token->token_date_expirated = date('Y-m-d H:i:s', strtotime("+3 day", strtotime($current_date)));
                            $token->save();
                        }
                        
                        
                            \common\components\Helpers::sendEmailMandrillUrlAPI(
                                $this->renderFile('@app/views/template/mail/order_information.php', array(
                                    "model" => $model, "id" => $order_state_lang->template, "token"=>$token_generate
                                )), 'Order Information', 'notification@thewatch.co', $model->customer->email, ''
                            );
                       
                          //  echo "oke";die();
                        if($order_state_lang->template == 'shipped'){
                            $current_date = date('Y-m-d H:i:s');
                            $shipping_reminder = \backend\models\OrdersReminder::find()->where(['orders_id'=>$model->orders_id])->andWhere(['orders_reminder_shipping_status'=>1])->one();
                            if($shipping_reminder == null){
                                $shipping_reminder_new = new \backend\models\OrdersReminder();
                                $shipping_reminder_new->orders_id = $model->orders_id;
                                $shipping_reminder_new->orders_reminder_shipping_date = date('Y-m-d 01:i:s', strtotime("+3 day", strtotime($current_date)));
                                $shipping_reminder_new->orders_reminder_shipping_status = 1;
                                $shipping_reminder_new->save();
                            }
                        }
                    }
               // }
			}
			
		}
		
		if($_GET['print_invoice'] != ''){
            $data = array(
                'orderId' => $id,
                'customerName' => $model->customer->firstname . ' ' . $model->customer->lastname,
                'phoneNumber' => $model->customeraddress->phone,
				'customerAddressFl' => $model->customeraddress->firstname . ' ' .$model->customeraddress->lastname,
                'customerAddress' => $model->customeraddress->address1,
				'customerAddressDistrict' => $model->customeraddress->district->name,
                'customerAddressCity' => $model->customeraddress->state->name,
                'customerAddressPostalCode' => $model->customeraddress->postcode,
                'customerAddressProvince' => $model->customeraddress->province->name,
                'shipmentPackage' => $model->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name
            );
            
            \common\components\PHPExcel_Helper::generateInvoice(
                'Excel', 
                $model->reference, 
                $data
            );
        }
		
        if($_GET['print_sticker'] != ''){
            
            $data = array(
                'customerName' => $model->customer->firstname . ' ' . $model->customer->lastname,
                'phoneNumber' => empty($model->customeraddress->phone) ? '-' : $model->customeraddress->phone,
				'customerAddressFl' => $model->customeraddress->firstname . ' ' .$model->customeraddress->lastname,
                'customerAddress' => $model->customeraddress->address1,
				'customerAddressDistrict' => $model->customeraddress->district->name,
                'customerAddressCity' => $model->customeraddress->state->name,
                'customerAddressPostalCode' => $model->customeraddress->postcode,
                'customerAddressProvince' => $model->customeraddress->province->name,
                'shipmentPackage' => $model->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name
            );
            
            \common\components\PHPWord_Helper::generateStickerNew(
                'Word', 
                $model->reference, 
                $data 
			);
			
			// \common\components\PHPWord_Helper::generateStickerNew(
            //     'Word', 
            //     $model->reference, 
            //     $data
            // );
        }
        
        // print_r($model);die();
        return $this->render('view', [
            'model' => $model,
            'ukey' => $store_id,
        ]);
    }
	
	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

    /**
     * Creates a new group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if(Yii::$app->request->post()){
		    
		  //  print_r($_POST);die();
			
			$customerModel = Customer::findOne(['email' => $_POST['customer_email']]);
			// check if customer not already exist
			if($customerModel == NULL){
				
				$customerPasswd = $this->generateRandomString(8);
				
				$phonestr = str_replace("'", '', $_POST['phone_number']);
				$phonestr = preg_replace('/[^a-zA-Z0-9\']/', '', $phonestr);
				
				// register customer
				$customerModel = new Customer();
				$customerModel->firstname = $_POST['customer_name'];
				$customerModel->email = $_POST['customer_email'];
				$customerModel->phone_number = $phonestr;
				$customerModel->passwd = md5($customerPasswd);
				$customerModel->active = 1;
				$customerModel->store_id = $store_id;
				$customerModel->date_add = $_POST['order_date'];
				$customerModel->save();
				
				// send welcome email
				
				try {
					\common\components\Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/signup.php', array(
							"username" => $customerModel->email, 
							"password" => $customerPasswd
						)), 
						'Welcome To The Watch Co', 
						Yii::$app->params['adminEmail'], 
						$customerModel->email, 
						''
					);
				} catch (Exception $ex) {
					echo $ex->message;
					die();
				}
				
			}
			
			$product_quantity = $_POST['product_quantity'];
			$totalQty = 0;
			$totalProductPrice = 0;
			$i = 0;
			
			foreach($product_quantity as $qty){
				$totalQty += $qty;
				
				$productPrice = Product::findOne(['product_id' => $_POST['product_id'][$i]])->price;
				
				$totalProductPrice += ($productPrice * $qty);
				$i++;
			}
			
			// check order number if not already exist
			$ordersModel = Orders::findOne(['reference' => $_POST['order_reference']]);
			if($ordersModel == NULL){
				// create new customer order
				$ordersModel = new Orders();
				$ordersModel->reference = $_POST['order_reference'];
				$ordersModel->apps_language_id = 2;
				$ordersModel->customer_id = $customerModel->customer_id;
				$ordersModel->secure_key = $this->generateRandomString(20);
				$ordersModel->payment_method_detail_id = $_POST['payment_method'];
				$ordersModel->total_cart_item = count($_POST['product_id']);
				$ordersModel->total_cart_item_quantity = $totalQty;
				$ordersModel->total_product_price = $totalProductPrice;
				$ordersModel->total_shipping = 0;
				$ordersModel->total_shipping_insurance = 0;
				$ordersModel->invoice_date = date('Y-m-d H:i:s');
				$ordersModel->valid = 1;
				$ordersModel->date_add = $_POST['order_date'];
				$ordersModel->store_id = $store_id;
				$ordersModel->save();
				
				$products = $_POST['product_id'];
				$i = 0;
				foreach($products as $product){
					
					$productModel = Product::findOne($product);
					$productDetailModel = ProductDetail::findOne($product);
					
					// create order detail
					$orderDetailModel = new OrderDetail();
					$orderDetailModel->orders_id = $ordersModel->orders_id;
					$orderDetailModel->product_id = $product;
					$orderDetailModel->product_attribute_id = $_POST['product_attribute_id'][$i];
					$orderDetailModel->product_name = $productDetailModel->name;
					$orderDetailModel->product_quantity = $_POST['product_quantity'][$i];
					
					$specificPrice = SpecificPrice::findOne(['product_id' => $product]);
					if($specificPrice != NULL){
						$type = $specificPrice->reduction_type;
						
						if($type == 'percent'){
							$orderDetailModel->reduction_percent = $specificPrice->reduction;
						} elseif($type == 'amount'){
							$orderDetailModel->reduction_amount = $specificPrice->reduction;
						}
						
						$orderDetailModel->product_price = $productModel->price;
					} else {
						$orderDetailModel->product_price = $productModel->price;
					}
					
					$orderDetailModel->original_product_price = $productModel->price;
					$orderDetailModel->product_weight = $productModel->weight;
					$orderDetailModel->save();
					
					if($productModel->productWarranty->product_warranty_year != '' || $productModel->productWarranty->product_warranty_year != 0){
					
						// insert order detail warranty
						$orderDetailWarrantyModel = new OrderDetailWarranty();
						$orderDetailWarrantyModel->order_detail_id = $orderDetailModel->order_detail_id;
						$orderDetailWarrantyModel->warranty_id = $_POST['warranty_id'][$i];
						$orderDetailWarrantyModel->save();
						
						$sysAutonumberBrandsModel = SysAutonumberBrands::findOne(["brand_id" => $productModel->brands_brand_id]);
						
						// update warranty number and activate it
						$warrantyModel = Warranty::findOne($_POST['warranty_id'][$i]);
						if($sysAutonumberBrandsModel != NULL){
							$warrantyModel->warranty_number = Helpers::generateWarrantyNumber(
								$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_prefix, 
								$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_char, 
								$sysAutonumberBrandsModel->sysAutonumber->sys_autonumber_value
							);
						}
						
						$warrantyModel->warranty_activated_date = date("Y-m-d H:i:s");
						$warrantyModel->warranty_expired_date = date("Y-m-d H:i:s", strtotime('+'.$productModel->productWarranty->product_warranty_year. ' years'));
						$warrantyModel->warranty_status = 'USED';
						$warrantyModel->save();
						
						// update autonumber brand
						$sysAutonumberModel = SysAutonumber::findOne($sysAutonumberBrandsModel->sys_autonumber_id);
						$sysAutonumberModel->sys_autonumber_value = ($sysAutonumberModel->sys_autonumber_value + 1);
						$sysAutonumberModel->save();
						
					}
					
					$i++;
				}
			}
			
			return $this->redirect(Yii::$app->urlManager->getBaseUrl() . '/orders/index');
		}
		
		if($departement == "Store Staff"){
				
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('../orderstore/create');
		}
    }

    /**
     * Updates an existing group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if(Yii::$app->request->post()){
			
			// check customer email
			$customerModel = Customer::findOne(['email' => $_POST['customer_email']]);
			// check if customer not already exist
			if($customerModel == NULL){
				
				$customerPasswd = $this->generateRandomString(8);
				
				// register customer
				$customerModel = new Customer();
				$customerModel->firstname = $_POST['customer_name'];
				$customerModel->email = $_POST['customer_email'];
				$customerModel->phone_number = $_POST['phone_number'];
				$customerModel->passwd = md5($customerPasswd);
				$customerModel->active = 1;
				$customerModel->store_id = $store_id;
				$customerModel->date_add = $_POST['order_date'];
				$customerModel->save();
				
				// send welcome email
				
				try {
					\common\components\Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/signup.php', array(
							"username" => $customerModel->email, 
							"password" => $customerPasswd
						)), 
						'Welcome To The Watch Co', 
						Yii::$app->params['adminEmail'], 
						$customerModel->email, 
						''
					);
				} catch (Exception $ex) {
					echo $ex->message;
					die();
				}
				
			} else {
				
				// update existing customer detail
				$customerModel->firstname = $_POST['customer_name'];
				$customerModel->phone_number = $_POST['phone_number'];
				$customerModel->save();
			}
			
			$product_quantity = $_POST['product_quantity'];
			$totalQty = 0;
			$totalProductPrice = 0;
			$i = 0;
			
			foreach($product_quantity as $qty){
				$totalQty += $qty;
				
				$productPrice = Product::findOne(['product_id' => $_POST['product_id'][$i]])->price;
				
				$totalProductPrice += ($productPrice * $qty);
				$i++;
			}
			
			// check order number if not already exist
			$ordersModel = Orders::findOne($id);
			if($ordersModel != NULL){
				$ordersModel->reference = $_POST['order_reference'];
				$ordersModel->apps_language_id = 2;
				$ordersModel->customer_id = $customerModel->customer_id;
				$ordersModel->secure_key = $this->generateRandomString(20);
				$ordersModel->payment_method_detail_id = $_POST['payment_method'];
				$ordersModel->total_cart_item = count($_POST['product_id']);
				$ordersModel->total_cart_item_quantity = $totalQty;
				$ordersModel->total_product_price = $totalProductPrice;
				$ordersModel->total_shipping = 0;
				$ordersModel->total_shipping_insurance = 0;
				$ordersModel->invoice_date = date('Y-m-d H:i:s');
				$ordersModel->valid = 1;
				$ordersModel->date_add = $_POST['order_date'];
				$ordersModel->store_id = $store_id;
				$ordersModel->save();
				
				// delete all existing order detail and re-input new order detail
				$orderDetailModel = OrderDetail::deleteAll(["orders_id" => $ordersModel->orders_id]);
				
				$products = $_POST['product_id'];
				$i = 0;
				foreach($products as $product){
					
					$productModel = Product::findOne($product);
					$productDetailModel = ProductDetail::findOne($product);
					
					// create order detail
					$orderDetailModel = new OrderDetail();
					$orderDetailModel->orders_id = $ordersModel->orders_id;
					$orderDetailModel->product_id = $product;
					$orderDetailModel->product_attribute_id = $_POST['product_attribute_id'][$i];
					$orderDetailModel->product_name = $productDetailModel->name;
					$orderDetailModel->product_quantity = $_POST['product_quantity'][$i];
					
					$specificPrice = SpecificPrice::findOne(['product_id' => $product]);
					if($specificPrice != NULL){
						$type = $specificPrice->reduction_type;
						
						if($type == 'percent'){
							$orderDetailModel->reduction_percent = $specificPrice->reduction;
						} elseif($type == 'amount'){
							$orderDetailModel->reduction_amount = $specificPrice->reduction;
						}
						
						$orderDetailModel->product_price = $productModel->price;
					} else {
						$orderDetailModel->product_price = $productModel->price;
					}
					
					$orderDetailModel->original_product_price = $productModel->price;
					$orderDetailModel->product_weight = $productModel->weight;
					$orderDetailModel->save();
					
					$i++;
				}
			}
			
			//return $this->redirect(Yii::$app->urlManager->getBaseUrl() . '/orders/index');
		}
		
		if($departement == "Store Staff"){
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->RenderStoreOrderView($id, "update");
		}
    }

    /**
     * Deletes an existing group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        //update all user if group $id to 0
        $user = \backend\models\User::find()->where(['group_id' => $id])->all();

        foreach ($user as $row) {
            $user_update = \backend\models\User::findOne($row->id);
            $user_update->group_id = 0;
            $user_update->update();
        }

        //remove all permissions if group $id
        $permissions = \backend\models\Permissions::find()->where(['group_id' => $id])->all();
        $permissions->deleteAll();

        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $id;

        $log->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdatequantity() {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];

        $orderquantity = \backend\models\OrderDetail::findOne($id);
        $orderquantity->product_quantity = $quantity;
        $orderquantity->save();

        $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orderquantity->orders_id])->all();
        $price = 0;
        $totalshipping = 0;

        foreach ($orderdetail as $row) {
            $price = $price + $row->product_price * $row->product_quantity;
            $totalshipping = $totalshipping + $row->product_weight;
        }

        $order = \backend\models\Orders::findOne($orderquantity->orders_id);
        $customeraddress = \backend\models\CustomerAddress::findOne($order->customer_address_id);
        $carrierpackagedetail = \backend\models\CarrierPackageDetail::findOne($order->carrier_package_detail_id);
        $shipping = \backend\models\CarrierCost::find()->where(['district_id' => $customeraddress->district_id, 'carrier_id' => $carrierpackagedetail->carrier_id, 'carrier_package_detail_id' => $order->carrier_package_detail_id])->one();
        $order->total_paid = $price - $order->total_discounts;
        $order->total_paid_real = $price;
        $order->total_products = count($orderdetail);
        $order->total_shipping = ($totalshipping / 1000) * $shipping->price;
        $order->save();
    }

    public function actionUpdatetrackingnumber() {
        $id = $_POST['id'];
        $tracking_number = $_POST['tracking_number'];
		$shipping_carrier = $_POST['shipping_carrier'];
        // echo $id.' '.$tracking_number .' '.$shipping_carrier;die();
        $orders = \backend\models\Orders::findOne($id);
        $orders->shipping_number = $tracking_number;
		$orders->carrier_delivery_name = $shipping_carrier;
		$orders->carrier_delivery_notes = $_POST['carrier_delivery_notes'];
        $orders->save();
		
		// create activity log for current order tracking number
		$log = new \backend\models\Log();
		$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
		$log->module = Yii::$app->controller->id;
		$log->action = 'update';
		$log->action_text = 'user '. $log->fullname . ' update tracking order number to ' . $tracking_number . ' and set shipping carrier to ' . $shipping_carrier;
		$log->date_time = date("Y-m-d H:i:s");
		$log->id_onChanged = $id;
		$log->save();

        try {
    //         \common\components\Helpers::sendEmailMandrillUrlAPI(
    //                 $this->renderFile('@app/views/template/mail/tracking_number.php', array(
    //                     "reference" => $orders['reference'],
    //                     "email" => $orders->customer->email,
    //                     "subject" => 'Tracking Number',
    //                     "tracking_number" => $tracking_number,
				// 		"shipping_carrier" => $shipping_carrier,
    //                 )), 'Tracking Number', 'notification@thewatch.co', $orders->customer->email, ''
    //         );
            //if($orders->customer->email == 'hendrihmwn@gmail.com'){
                \common\components\Helpers::sendEmailMandrillUrlAPI(
                        $this->renderFile('@app/views/template/mail/order_information.php', array(
                            "model" => $orders, "id" => "shipped","tracking_number" => $tracking_number,
                        "shipping_carrier" => $shipping_carrier,
                        )), 'Tracking Number', 'notification@thewatch.co', $orders->customer->email, ''
                    );
            //}
        } catch (Exception $ex) {
            
        }
         
    }

    public function actionCheckcategory() {
        $id = $_POST['id'];

        $brand_category = \backend\models\ProductCategoryBrands::find()->joinWith(["brands"])->orderBy("brands.brand_name")->where(['product_category_category_id' => $id])->all();
        $text = "<option value='0'>Please select</option>";

        foreach ($brand_category as $row) {
            $text = $text . "<option value='" . $row->brands_brand_id . "'>" . $row->brands->brand_name . "</option>";
        }

        return $text;
    }

    public function actionCheckbrands() {
        $brand_id = $_POST['brand_id'];
        $category_id = $_POST['category_id'];

        $brand_category = \backend\models\Product::find()->joinWith(["productDetail"])->where(['product_category_id' => $category_id, "brands_brand_id" => $brand_id])->all();
        $text = "<option value='0'>Please select</option>";

        foreach ($brand_category as $row) {
            $text = $text . "<option value='" . $row->product_id . "'>" . $row->productDetail->name . "</option>";
        }

        return $text;
    }

    public function actionCheckproduct() {
        $product_id = $_POST['product_id'];

        $brand_category = \backend\models\ProductAttribute::find()->joinWith(["productAttributeCombination"])->where(['product_id' => $product_id])->all();
        $text = "<option value='0'>Please select</option>";

        foreach ($brand_category as $row) {
            $text = $text . "<option value='" . $row->product_attribute_id . "'>" . $row->productAttributeCombination->attributeValue->value . "</option>";
        }

        return $text;
    }

    public function actionAddproduct() {
        $product_id = $_POST['product_id'];
        $product_attribute_id = $_POST['product_attribute_id'];
        $product_quantity = $_POST['product_quantity'];
        $orders_id = $_POST['orders_id'];

        $orderdetail = \backend\models\OrderDetail::find()->where(['product_id' => $product_id, 'orders_id' => $orders_id, 'product_attribute_id' => $product_attribute_id])->one();

        if (empty($orderdetail)) {
            $order_detail = new \backend\models\OrderDetail();
            $product = \backend\models\Product::findOne($product_id);

            $order_detail->orders_id = $orders_id;
            $order_detail->warehouse_id = 0;
            $order_detail->product_id = $product_id;
            $order_detail->product_attribute_id = $product_attribute_id;
            $order_detail->product_name = $product->productDetail->name;
            $order_detail->product_quantity = $product_quantity;
            $order_detail->product_price = $product->price;
            $order_detail->product_weight = 500;
            $order_detail->purchase_supplier_price = 0;
            $order_detail->original_product_price = 0;
            $order_detail->original_wholesale_price = 0;
            $order_detail->save();

            $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders_id])->all();
            $price = 0;
            $totalshipping = 0;

            foreach ($orderdetail as $row) {
                $price = $price + $row->product_price * $row->product_quantity;
                $totalshipping = $totalshipping + $row->product_weight;
            }

            $order = \backend\models\Orders::findOne($orders_id);
            $customeraddress = \backend\models\CustomerAddress::findOne($order->customer_address_id);
            $carrierpackagedetail = \backend\models\CarrierPackageDetail::findOne($order->carrier_package_detail_id);
            $shipping = \backend\models\CarrierCost::find()->where(['district_id' => $customeraddress->district_id, 'carrier_id' => $carrierpackagedetail->carrier_id, 'carrier_package_detail_id' => $order->carrier_package_detail_id])->one();
            $order->total_paid = $price - $order->total_discounts;
            $order->total_paid_real = $price;
            $order->total_products = count($orderdetail);
            $order->total_shipping = ($totalshipping / 1000) * $shipping->price;
            $order->save();

            return 1;
        } else {
            return 0;
        }
    }

    public function actionDeleteproductorder() {
        $id = $_POST['id'];

        $order_detail = \backend\models\OrderDetail::findOne($id);
        $orders_id = $order_detail->orders_id;
        $order_detail->delete();

        $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $orders_id])->all();
        $price = 0;
        $totalshipping = 0;

        foreach ($orderdetail as $row) {
            $price = $price + $row->product_price * $row->product_quantity;
            $totalshipping = $totalshipping + $row->product_weight;
        }

        $order = \backend\models\Orders::findOne($orders_id);
        $customeraddress = \backend\models\CustomerAddress::findOne($order->customer_address_id);
        $carrierpackagedetail = \backend\models\CarrierPackageDetail::findOne($order->carrier_package_detail_id);
        $shipping = \backend\models\CarrierCost::find()->where(['district_id' => $customeraddress->district_id, 'carrier_id' => $carrierpackagedetail->carrier_id, 'carrier_package_detail_id' => $order->carrier_package_detail_id])->one();
        $order->total_paid = $price - $order->total_discounts;
        $order->total_paid_real = $price;
        $order->total_products = count($orderdetail);
        $order->total_shipping = ($totalshipping / 1000) * $shipping->price;
        $order->save();
    }
	
	public function actionReceiptakulaku(){
		
		$order_id = $_POST['id'];
        $order_state_lang_id = $_POST['order_state_lang_id'];
		
		// confirm receipt akulaku
		$akulakuPay = [];
		
		//if($order_state_lang_id == 81){
			$ref = \backend\models\Orders::find()->where(['orders_id'=>$order_id])->one()->reference;

			$akulaku = new \common\components\Akulaku();
			$akulaku->setEnvironment('production');
			$akulaku->setCredentials("626809194", "qeJjLw49bZkMlCAersNan2g-Ji7cQ8utPAxDoPy3hS0");
			
			$akulakuPay = $akulaku->confirmReceipt($ref);
	// 		print_r($receipt);
		//}
		
		// cancel[refund] order akulaku
		//if($order_state_lang_id == 89){
			//$ref = \backend\models\Orders::find()->where(['orders_id'=>$order_id])->one()->reference;

			//$akulaku = new \common\components\Akulaku();
			//$akulaku->setEnvironment('production');
			//$akulaku->setCredentials("626809194", "qeJjLw49bZkMlCAersNan2g-Ji7cQ8utPAxDoPy3hS0");
			
			//$akulakuPay = $akulaku->cancelPayment($ref);
	// 		print_r($receipt);
		//}
		
		return json_encode($akulakuPay);
	}
	
	public function actionSaveinvoice($id){
		
		$model = $this->findModel($id);
		
		$data = array(
			'orderId' => $id,
			'customerId' => $model->customer_id,
			'customerName' => $model->customer->firstname . ' ' . $model->customer->lastname,
			'phoneNumber' => $model->customeraddress->phone,
			'customerAddressFl' => $model->customeraddress->firstname . ' ' .$model->customeraddress->lastname,
			'customerAddress' => $model->customeraddress->address1,
			'customerAddressDistrict' => $model->customeraddress->district->name,
			'customerAddressCity' => $model->customeraddress->state->name,
			'customerAddressPostalCode' => $model->customeraddress->postcode,
			'customerAddressProvince' => $model->customeraddress->province->name,
			'shipmentPackage' => $model->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name,
			'shipmentCost' => $model->total_shipping
		);
		
		$orderInvoice = \backend\models\OrderInvoice::findOne(["orders_id" => $model->orders_id]);
		if($orderInvoice == NULL){
			\common\components\PHPExcel_Helper::saveInvoice(
				'Excel', 
				$model->reference, 
				$data
			);
		}
		
		$orderDeliverySlip = \backend\models\OrderDeliverySlip::findOne(["orders_id" => $id]);
		if($orderDeliverySlip == NULL){
			\common\components\PHPWord_Helper::saveSticker(
				'Word', 
				$model->reference, 
				$data
			);
		}
		
		$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/orders/view/' . $id);
	}

    public function actionUpdatestatusorder($id) {
		
		if(Yii::$app->request->post()){
			
			$order_state_lang_id = $_POST['order-status'];

			$order_history = new \backend\models\OrderHistory();
			$order_history->orders_id = $id;
			$order_history->order_state_id = \backend\models\OrderHistory::findOne(["orders_id" => $id])->order_state_id;
			$order_history->order_state_lang_id = $order_state_lang_id;
			$order_history->date_add = date("Y-m-d H:i:s");
			$order_history->save();
			
			// create activity log for current order status
			$log = new \backend\models\Log();
			$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
			$log->module = Yii::$app->controller->id;
			$log->action = 'update';
			$log->action_text = 'user '. $log->fullname . ' update order status to ' . \backend\models\OrderStateLang::findOne($order_state_lang_id)->name;
			$log->date_time = date("Y-m-d H:i:s");
			$log->id_onChanged = $id;
			$log->save();
			
			$model = $this->findModel($id);

			if ($order_history->orderStateLang->template == "order_canceled") {
				$orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $id])->all();

				foreach ($orderdetail as $row) {
					$product_stock = \backend\models\ProductStock::find()->where(['product_id' => $row->product_id, 'product_attribute_id' => $row->product_attribute_id])->one();
					$product_stock->quantity = $product_stock->quantity + $row->product_quantity;
					$product_stock->save();
					
					$productHasAttribute = FALSE;
								
					$productAttribute = \backend\models\ProductAttributeCombination::findOne(['product_attribute_id' => $row->product_attribute_id]);
					
					if($productAttribute != NULL){
						$productHasAttribute = TRUE;
					}
					
					$product = \backend\models\ProductStock::findOne(["product_attribute_id" => $row->product_attribute_id, "product_id" => $row->product_id]);
					$currentQuantity = $product->quantity;
					
					// create activity log for current quantity
					$log = new \backend\models\Log();
					$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
					$log->module = 'products';
					$log->action = 'update';
					if($productHasAttribute){
						$log->action_text = 'user '. $log->fullname . ' update Quantity [' . $productAttribute->attributeValue->value . '] FROM ' . $currentQuantity . ' TO ' . $product_stock->quantity;
					} else {
						$log->action_text = 'user '. $log->fullname . ' update Quantity FROM ' . $currentQuantity . ' TO ' . $product_stock->quantity;
					}
					$log->date_time = date("Y-m-d H:i:s");
					$log->id_onChanged = $id;
					$log->save();
				}
				
				// check if orderinvoice already exist
				$orderInvoiceModel = \backend\models\OrderInvoice::findOne(["orders_id" => $id]);
				
				if($orderInvoiceModel != NULL){
					$pathInvoice = \Yii::getAlias("@backend" . '/web/dist/invoice/' . $model->reference);
					unlink($pathInvoice . '/' . 'invoice ' . $model->reference . ' ' . $model->customer->firstname . ' ' . $model->customer->lastname . '.xls');
					rmdir($pathInvoice);
					$orderInvoiceModel->delete();
				}
				
				$orderDeliverySlip = \backend\models\OrderDeliverySlip::findOne(["orders_id" => $id]);
				
				if($orderDeliverySlip != NULL){
					$pathDeliverySlip = \Yii::getAlias("@backend" . '/web/dist/delivery_slip/' . $model->reference);
					unlink($pathDeliverySlip . '/' . 'sticker ' . $model->reference . ' ' . $model->customer->firstname . ' ' . $model->customer->lastname . '.docx');
					rmdir($pathDeliverySlip);
					$orderDeliverySlip->delete();
				}
			}
			
			if($order_history->orderStateLang->template == "packing_order"){
				$ordersReminder = \backend\models\OrdersReminder::findOne(['orders_id' => $id]);
				
				// update order reminder status
				if($ordersReminder != NULL){
					$ordersReminder->orders_reminder_status = 0;
					$ordersReminder->orders_canceled_status = 0;
					$ordersReminder->save();
				}
				
				// check if orderinvoice already exist
				$orderInvoiceModel = \backend\models\OrderInvoice::findOne(["orders_id" => $id]);
				
				$data = array(
					'orderId' => $id,
					'customerId' => $model->customer_id,
					'customerName' => $model->customer->firstname . ' ' . $model->customer->lastname,
					'phoneNumber' => $model->customeraddress->phone,
					'customerAddressFl' => $model->customeraddress->firstname . ' ' .$model->customeraddress->lastname,
					'customerAddress' => $model->customeraddress->address1,
					'customerAddressDistrict' => $model->customeraddress->district->name,
					'customerAddressCity' => $model->customeraddress->state->name,
					'customerAddressPostalCode' => $model->customeraddress->postcode,
					'customerAddressProvince' => $model->customeraddress->province->name,
					'shipmentPackage' => $model->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name,
					'shipmentCost' => $model->total_shipping
				);
				
				if($orderInvoiceModel == NULL){
					\common\components\PHPExcel_Helper::saveInvoice(
						'Excel', 
						$model->reference, 
						$data
					);
				}
				
				$orderDeliverySlip = \backend\models\OrderDeliverySlip::findOne(["orders_id" => $id]);
				if($orderDeliverySlip == NULL){
					\common\components\PHPWord_Helper::saveSticker(
						'Word', 
						$model->reference, 
						$data
					);
				}
			}

			if ($order_history->orderStateLang->template == "shipped") {
				$order = \backend\models\Orders::findOne($id);
				$order->valid = 1;
				$order->update();
				
				$ordersReminder = \backend\models\OrdersReminder::findOne(['orders_id' => $id]);
				
				// update order reminder status
				if($ordersReminder != NULL){
					$ordersReminder->orders_reminder_status = 0;
					$ordersReminder->orders_canceled_status = 0;
					$ordersReminder->save();
				}
			}
			
			$orders = \backend\models\Orders::findOne($id); 
			$orders->last_order_state = $order_history->orderStateLang->template;
			$orders->update();
			
			$this->redirect(Yii::$app->urlManager->getBaseUrl() . '/orders/view/' . $id);
		}
    }
    /**
     * Creates a new group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionOfflineMigration() {
		$departement = Yii::$app->session->get('userInfo')['departement'];
		
		$store_id = Yii::$app->session->get('userInfo')['store_id'];
		
		if(Yii::$app->request->post()){
		    
		  //  print_r($_POST);die();
			
			$customerModel = Customer::findOne(['email' => $_POST['customer_email']]);
			// check if customer not already exist
			if($customerModel == NULL){
				
				$customerPasswd = $this->generateRandomString(8);
				
				$phonestr = str_replace("'", '', $_POST['phone_number']);
				$phonestr = preg_replace('/[^a-zA-Z0-9\']/', '', $phonestr);
				
				// register customer
				$customerModel = new Customer();
				$customerModel->firstname = $_POST['customer_name'];
				$customerModel->email = $_POST['customer_email'];
				$customerModel->phone_number = $phonestr;
				$customerModel->passwd = md5($customerPasswd);
				$customerModel->active = 1;
				$customerModel->store_id = $store_id;
				$customerModel->date_add = $_POST['order_date'];
				$customerModel->save();
				
				// send welcome email
				
				try {
					\common\components\Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/signup.php', array(
							"username" => $customerModel->email, 
							"password" => $customerPasswd
						)), 
						'Welcome To The Watch Co', 
						Yii::$app->params['adminEmail'], 
						$customerModel->email, 
						''
					);
				} catch (Exception $ex) {
					echo $ex->message;
					die();
				}
				
			}
			
			$product_quantity = $_POST['product_quantity'];
			$totalQty = 0;
			$totalProductPrice = 0;
			$i = 0;
			
			foreach($product_quantity as $qty){
				$totalQty += $qty;
				
				$productPrice = Product::findOne(['product_id' => $_POST['product_id'][$i]])->price;
				
				$totalProductPrice += ($productPrice * $qty);
				$i++;
			}
			
			// check order number if not already exist
			$ordersModel = Orders::findOne(['reference' => $_POST['order_reference']]);
			if($ordersModel == NULL){
				// create new customer order
				$ordersModel = new Orders();
				$ordersModel->reference = $_POST['order_reference'];
				$ordersModel->apps_language_id = 2;
				$ordersModel->customer_id = $customerModel->customer_id;
				$ordersModel->secure_key = $this->generateRandomString(20);
				$ordersModel->payment_method_detail_id = $_POST['payment_method'];
				$ordersModel->total_cart_item = count($_POST['product_id']);
				$ordersModel->total_cart_item_quantity = $totalQty;
				$ordersModel->total_product_price = $totalProductPrice;
				$ordersModel->total_shipping = 0;
				$ordersModel->total_shipping_insurance = 0;
				$ordersModel->invoice_date = date('Y-m-d H:i:s');
				$ordersModel->valid = 1;
				$ordersModel->date_add = $_POST['order_date'];
				$ordersModel->store_id = $store_id;
				$ordersModel->save();
				

				$products = $_POST['product_id'];
				$i = 0;
				foreach($products as $product){
					
					$productModel = Product::findOne($product);
					$productDetailModel = ProductDetail::findOne($product);
					
					// create order detail
					$orderDetailModel = new OrderDetail();
					$orderDetailModel->orders_id = $ordersModel->orders_id;
					$orderDetailModel->product_id = $product;
					$orderDetailModel->product_attribute_id = $_POST['product_attribute_id'][$i];
					$orderDetailModel->product_name = $productDetailModel->name;
					$orderDetailModel->product_quantity = $_POST['product_quantity'][$i];
					
					$specificPrice = SpecificPrice::findOne(['product_id' => $product]);
					if($specificPrice != NULL){
						$type = $specificPrice->reduction_type;
						
						if($type == 'percent'){
							$orderDetailModel->reduction_percent = $specificPrice->reduction;
						} elseif($type == 'amount'){
							$orderDetailModel->reduction_amount = $specificPrice->reduction;
						}
						
						$orderDetailModel->product_price = $productModel->price;
					} else {
						$orderDetailModel->product_price = $productModel->price;
					}
					
					$orderDetailModel->original_product_price = $productModel->price;
					$orderDetailModel->product_weight = $productModel->weight;
					$orderDetailModel->save();
					
					
					if($productModel->productWarranty->product_warranty_year != '' || $productModel->productWarranty->product_warranty_year != 0){
					    
					    // insert new warranty
					    $warrantyModel = new Warranty();
        				$warrantyModel->warranty_code = $this->generateRandomString(8);
        				$warrantyModel->warranty_number = $_POST['warranty_number'];
        				$warrantyModel->warranty_date_add = date('Y-m-d H:i:s');
        				$warrantyModel->warranty_date_upd = date('Y-m-d H:i:s');
        				$warrantyModel->warranty_status = 'USED';
        				$warrantyModel->warranty_type_id = $_POST['warranty_type_id'];
        				$warrantyModel->warranty_activated_date = $_POST['order_date'];
        				$warrantyModel->warranty_expired_date = date("Y-m-d H:i:s", strtotime('+'.$productModel->productWarranty->product_warranty_year. ' years'));
        				$warrantyModel->warranty_description = 'Warranty Generated ' . $warrantyModel->warranty_date_add;
        				$warrantyModel->migration_data = 1;
        				$warrantyModel->store_id = $store_id;
        				$warrantyModel->save();
					
						// insert order detail warranty
						$orderDetailWarrantyModel = new OrderDetailWarranty();
						$orderDetailWarrantyModel->order_detail_id = $orderDetailModel->order_detail_id;
						$orderDetailWarrantyModel->warranty_id = $warrantyModel->warranty_id;
						$orderDetailWarrantyModel->save();
						
					}
					
					$i++;
				}
			}
			
			return $this->redirect(Yii::$app->urlManager->getBaseUrl() . '/orders/offline-migration');
		}
		
// 		if($departement == "Store Staff"){
				
			$this->layout = "storeadmin/dashboard_storeadmin";
			
			return $this->render('../orderstore/offlinemigration');
// 		}
    }
    
    private function insertWarrantymigration($type,$order_date,$product,$warranty_number,$storeId){
	    try {
			        $productDetailModel = ProductDetail::findOne($product);
			        
    				$warrantyModel = new Warranty();
    				$warrantyModel->warranty_code = $this->generateRandomString(8);
    				$warrantyModel->warranty_number = $warranty_number;
    				$warrantyModel->warranty_date_add = date('Y-m-d H:i:s');
    				$warrantyModel->warranty_date_upd = date('Y-m-d H:i:s');
    				$warrantyModel->warranty_status = 'USED';
    				$warrantyModel->warranty_type_id = $type;
    				$warrantyModel->warranty_activated_date = $order_date;
    				$warrantyModel->warranty_expired_date = date("Y-m-d H:i:s", strtotime('+'.$productModel->productWarranty->product_warranty_year. ' years'));
    				$warrantyModel->warranty_description = 'Warranty Generated ' . $warrantyModel->warranty_date_add;
    				$warrantyModel->migration_data = 1;
    				$warrantyModel->store_id = $storeId;
    				$warrantyModel->save();
			    }
    			catch(\yii\db\IntegrityException $e) {
    			    $this->insertWarrantymigration($type,$order_date,$product,$warranty_number,$storeId);
    			}
    	return $warrantyModel;
	}
    
}
