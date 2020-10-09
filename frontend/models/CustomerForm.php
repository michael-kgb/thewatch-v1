<?php 
namespace frontend\models;

use backend\models\Orders;
use frontend\models\CustomerOrder;

use yii\base\Model;
use yii\web\Session;
use Yii;

class CustomerForm extends Model {
    
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