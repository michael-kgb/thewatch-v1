<?php

namespace frontend\models;

use backend\models\Orders;

use yii\base\Model;
use yii\web\Session;
use Yii;

class ProductsOrder extends Model {
    
    public $name;
    public $unit_price;
    public $total_price;
    
    public $attribute_value_id;
    public $color;
    public $quantity;
    
    public $url;
    
    public function create($customer = array()){
        
        foreach($customer as $info){
            $this->name = $product->name;
            $this->unit_price = $product->unit_price;
            $this->total_price = $product->total_price;
            $this->attribute_value_id = $product->attribute_value_id;
            $this->color = $product->color;
            $this->quantity = $product->quantity;
            $this->url = $product->url;
        }
        
    }
}
