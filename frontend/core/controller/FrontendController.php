<?php

namespace frontend\core\controller;

use Yii;
use yii\web\Controller;
use yii\web\Session;

class FrontendController extends Controller {
    
    /**
     * @var array the parameters bound to the current url.
     */
    public $breadcrumb = [];
    
    /**
     * @var string the layout template parameter to be used.
     */
    public $layout = "mainShop";
    
    public $enableCsrfValidation = false;

	
	public function beforeAction($action)
	{
        // $this->enableCsrfValidation = TRUE; // disable to allow get notification from midtrans, etc
        $current_date = date('Y-m-d H:i:s');
        if ( $current_date >= '2019-07-05 00:00:00' && $current_date <= '2019-07-06 00:00:00' ) {
            // session_start();
            //remove PHPSESSID from browser
            if ( isset( $_COOKIE[session_name()] ))
            setcookie(session_name(), "", time() - 3600, "/");
            //clear session from globals
            //$_SESSION = array();
            //clear session from disk
            //session_destroy();
        }


		$check_stock = $this->checkStock();
		if (!parent::beforeAction($action)) {
			return false;
        }


        //Set Your server key
        \Midtrans\Config::$serverKey = Yii::$app->params['midtrans_conf']['svr_key']; //SERVER KEY SANDBOX MIDTRANS

        // Uncomment for production environment
        // \Midtrans\Config::$isProduction = true;

        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

		return true;
	}
	
	public function checkStock() {
        $data = array();
        $sessionOrder = new Session();
        $sessionOrder->open();
        // $sessionOrder = Yii::$app->session;

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : array();
		// check product quantity if equal zero
		// no longer can be order if product has reach zero quantity
		if (count($items) > 0) {
			$i = 0;
			foreach ($items as $item) {
                $product_active = (int)\backend\models\Product::findOne(["product_id" => $item['id']])->active;
                if ( $product_active === 0 ) { 
                    // $_SESSION['cart']['items'][$i]['item_inactive'] = 1;
                    // $_SESSION['cart']['items'][$i]['cart_msg'] = 'This item is Inactive';
                    // unset($_SESSION['cart']['items'][$i]); 
                    // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);   
                    // array_splice($items, $i);
                    unset($items[$i]);
                } else {
                    $stock = (int)\backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']])->quantity;
                    
                    if($stock === 0){
                        // $_SESSION['cart']['items'][$i]['out_of_stock'] = 1;
                        // $_SESSION['cart']['items'][$i]['cart_msg'] = 'This item is Out of Stock';
                        // array_splice($_SESSION['cart']['items'], $i);
                        // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                        unset($items[$i]);
                    }
                }
				$i++;
            }
            $_SESSION['cart']['items'] = array();
            $_SESSION['cart']['items'] = array_values($items);
		}
		return true;
    }
}
