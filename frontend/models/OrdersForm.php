<?php 
namespace frontend\models;

use backend\models\Orders;
use frontend\models\ProductsOrder;

use yii\base\Model;
use yii\web\Session;
use Yii;

class OrdersForm extends Model {
    
    public $order_id;
    public $reference;
    public $customer_id;
    public $currency_id;
    public $address_delivery_id;
    public $payment_id;
    public $discount_id;
    
    public $gift_message;
    
    public $order_total;
    public $shipping_total;
    public $gift_total;
    public $wrapping_total;
    public $discount_total;
    
    public $attribute_id;
    
    public $attribute_value_id;
    
    public function create($items = array()){
        
        $sessionOrder = new Session();
        $sessionOrder->open();
        
        foreach($items as $key => $value){
            $sessionOrder->set($key, $value);
        }
        
    }
    
    public function update($items = array()){
        $sessionOrder = new Session();
        $sessionOrder->open();
        
        foreach($items as $key => $value){
            $sessionOrder->set($key, $value);
        }
    }
    
    public function save(){
        $order = new Orders();
        
    }
}