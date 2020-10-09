<?php

namespace common\components;

use Yii;
use yii\base\Component;
use DrewM\MailChimp\MailChimp;

class Helpers extends Component {
	
	public static function generateWarrantyNumber($prefix, $digits, $value){
		
		$string = $prefix.str_pad($value, $digits, 0, STR_PAD_LEFT);
		
		return $string;
	}
	
	public static function getDifferentMicrotime($startDate, $endDate)
    {
        $pageTime = new \DateTime($startDate);
        $rowTime  = new \DateTime($endDate);

        $uDiff = ($rowTime->format('u') - $pageTime->format('u'));

        $timePassed = $rowTime->getTimestamp() - $pageTime->getTimestamp() + $uDiff;

        return $timePassed * 1000;
    }
	
	public static function updateProductStock($id, $attr_id, $qty)
    {
        try {
            $result = \Yii::$app->db->createCommand("CALL update_product_stock(:id,:attr_id,:qty,@out)") 
                      ->bindValue(':id' , $id )
                      ->bindValue(':attr_id' , $attr_id )
                      ->bindValue(':qty' , $qty )
                      ->execute();
        
            $row = \Yii::$app->db->createCommand("SELECT @out AS hasil")->queryScalar();
            if ($row) {
                return $row;
            }else{
                return 0;
            }
        }catch (Exception $e) {

            return 0;

        }
    }
    
    public static function returnProductStock($id, $attr_id, $qty)
    {
        try {
            $result = \Yii::$app->db->createCommand("CALL return_product_stock(:id,:attr_id,:qty,@out)") 
                      ->bindValue(':id' , $id )
                      ->bindValue(':attr_id' , $attr_id )
                      ->bindValue(':qty' , $qty )
                      ->execute();
        
            $row = \Yii::$app->db->createCommand("SELECT @out AS hasil")->queryScalar();
            if ($row) {
                return $row;
            }else{
                return 0;
            }
        }catch (Exception $e) {

            return 0;

        }
    }
    
	public static function createProductMailchimp($productId)
    {
        $MailChimp = new MailChimp('35efbb4f1931d665b03f052efc24900f-us13');
        
        $product = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_id' => $productId])
            ->one();
            
        if($product != NULL){
            
            $actualPrice = self::getActualProductPrice($product);
            $productAttributes = \backend\models\ProductAttribute::findAll(['product_id' => $product->product_id]);
            $productVariant = array();

            if(count($productAttributes) > 0){
                foreach($productAttributes as $productAttribute){
                    $productVariant[] = array(
                        "id" => $productAttribute->product_attribute_id .'',
                        "title" => $product->productDetail->name . ' ' . $productAttribute->productAttributeCombination->attributeValue->value,
                        "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                        "sku" => "",
                        "price" => (int)$actualPrice,
                        "inventory_quantity" => (int)$productAttribute->productStock->quantity,
                        "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                        "backorders" => "",
                        "visibility" => $product->active == "1" ? "visible" : "hidden",
                        "created_at" => $product->date_updated,
                        "updated_at" => $product->date_updated
                    );
                }
            } else {
                $productVariant[] = array(
                    "id" => $product->product_id .'',
                    "title" => $product->productDetail->name,
                    "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                    "sku" => "",
                    "price" => (int)$actualPrice,
                    "inventory_quantity" => (int)$product->productStock->quantity,
                    "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                    "backorders" => "",
                    "visibility" => $product->active == "1" ? "visible" : "hidden",
                    "created_at" => $product->date_updated,
                    "updated_at" => $product->date_updated
                );
            }

            $productList = array(
                "id" => $product->product_id .'',
                "title" => $product->productDetail->name,
                "handle" => "",
                "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                "description" => $product->productDetail->description,
                "type" => $product->productCategory->product_category_name,
                "vendor" => $product->brands->brand_name,
                "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                "variants" => $productVariant
            );
            
            $post = $MailChimp->post('ecommerce/stores/twc1/products', $productList);
        
            return $post;
        }
    }
	
	public static function createOrdersMailchimp($orderId, $customerId, $cartLines = array())
    {
        $MailChimp = new MailChimp('35efbb4f1931d665b03f052efc24900f-us13');
        
        if(count($cartLines) > 0){
            foreach($cartLines as $line){
                
                $cart[] = array(
                    "id" => $line->id,
                    "product_id" => $line->product_id,
                    "product_title" => $line->product_title,
                    "product_variant_id" => $line->product_variant_id,
                    "product_variant_title" => $line->product_variant_title,
                    "quantity" => $line->quantity,
                    "price" => $line->price
                );
                
                $totalProduct += $line->price;
            }
        }
        
        $customer = \backend\models\Customer::findOne(['customer_id' => $customerId]);
        
        if($customer != NULL){
            $customerList = array(
                "id" => $customer->customer_id .'',
                "email_address" => $customer->email,
                "opt_in_status" => true,
                "company" => "",
                "first_name" => $customer->firstname,
                "last_name" => $customer->lastname,
                "orders_count" => 0,
                "total_spent" => 0
            );
        }
        
        $data = array(
            "id" => $orderId,
            "customer" => $customerList,
            "campaign_id" => "fa454c0030", 
            "checkout_url" => "https://www.thewatch.co/cart/checkout/sign-in", 
            "currency_code" => "IDR", 
            "order_total" => $totalProduct, 
            "tax_total" => 0,
            "lines" => $cart
        );
        
        $post = $MailChimp->post('ecommerce/stores/twc1/orders', $data);
        
        return $post;
    }
	
	public static function updateProductMailchimp($productId)
    {
        $MailChimp = new MailChimp('35efbb4f1931d665b03f052efc24900f-us13');
        // $MailChimp = new MailChimp('c97e29d3cdeeb00dff6c86312c78ac08-us13');
        
        $product = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_id' => $productId])
            ->one();
        
        if($product != NULL){
            
            $actualPrice = self::getActualProductPrice($product);
            $productAttributes = \backend\models\ProductAttribute::findAll(['product_id' => $product->product_id]);

            if(count($productAttributes) > 0){
                foreach($productAttributes as $productAttribute){
                    $variants[] = array(
                        "id" => $productAttribute->product_attribute_id .'',
                        "title" => $product->productDetail->name . ' ' . $productAttribute->productAttributeCombination->attributeValue->value,
                        "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                        "sku" => "",
                        "price" => (int)$actualPrice,
                        "inventory_quantity" => $productAttribute->productStock->quantity,
                        "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                        "backorders" => "0",
                        "visibility" => $product->active == "1" ? "visible" : "hidden",
                        "created_at" => $product->date_updated,
                        "updated_at" => $product->date_updated
                    );
                }
            } else {
                $variants[] = array(
                    "id" => $product->product_id .'',
                    "title" => $product->productDetail->name,
                    "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                    "sku" => "",
                    "price" => (int)$actualPrice,
                    "inventory_quantity" => $product->productStock->quantity,
                    "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                    "backorders" => "0",
                    "visibility" => $product->active == "1" ? "visible" : "hidden",
                    "created_at" => $product->date_updated,
                    "updated_at" => $product->date_updated
                );
            }

            $data = array(
                "variants" => $variants
            );
            
            $patch = $MailChimp->patch('ecommerce/stores/twc1/products/' . $productId, $data);
        
            return $patch;
        }
    }
	
	public static function getMailchimpExistingCarts()
    {
        // $apiKey = Yii::$app->getModule('mailchimp')->apiKey;
        // $MailChimp = new MailChimp($apiKey);
        
        // $get = $MailChimp->get('ecommerce/stores/twc1/carts');

        $apiKey = Yii::$app->mailchimp->apiKey;
        $MailChimp = new MailChimp($apiKey);
        $get = $MailChimp->get('ecommerce/stores/twc1/carts');
        
        return $get;
    }
    
    public static function editToCartMailchimp($cartItem = array(), $customerInfo = array(), $cartId, $lineId)
    {
        
        // $apiKey = Yii::$app->getModule('mailchimp')->apiKey;
        $apiKey = Yii::$app->mailchimp->apiKey;
        $MailChimp = new MailChimp($apiKey);
        $orderTotal = 0;
        
        if(count($cartItem) > 0){
            foreach($cartItem as $item){
                $cartItems[] = array(
                    "id" => $lineId,
                    "product_id" => $item['id'],
                    "product_title" => $item['name'],
                    "product_variant_id" => $item['product_attribute_id'] == 0 ? $item['id'] : $item['product_attribute_id'],
                    "product_variant_title" => $item['name'] . ' ' . \backend\models\AttributeValue::findOne(['attribute_value_id' => $item['attribute_value_id']])->value,
                    "quantity" => (int)$item['quantity'],
                    "price" => $item['total_price']
                );
                
                $orderTotal += $item->total_price;
            }
        }
        
        $cartLines = array(
            "id" => $cartId,
            "customer" => array(
                "id" => $customerInfo['customer_id']
            ),
            "campaign_id" => "fa454c0030",
            "checkout_url" => "https://www.thewatch.co/cart/checkout/sign-in",
            "currency_code" => "IDR",
            "order_total" => $orderTotal,
            "tax_total" => 0,
            "lines" => $cartItems
        );
        
        $patch = $MailChimp->patch('ecommerce/stores/twc1/carts/' . $cartId, $cartLines);
        
        return $patch;
        
    }
    
    public static function deleteCartMailchimp($cartId)
    {
        // $apiKey = Yii::$app->getModule('mailchimp')->apiKey;
        $apiKey = Yii::$app->mailchimp->apiKey;
        $MailChimp = new MailChimp($apiKey);
        
        $delete = $MailChimp->delete('ecommerce/stores/twc1/carts/' . $cartId);
        
        return $delete;
    }
    
    public static function addToCartMailchimp($cartItem = array(), $customerInfo = array())
    {
        
        // $apiKey = Yii::$app->getModule('mailchimp')->apiKey;
        $apiKey = Yii::$app->mailchimp->apiKey;
        $MailChimp = new MailChimp($apiKey);
        
        $cartUniqueId = substr(uniqid(), 2) . "-" . substr(uniqid(), 8) . "-" . substr(uniqid(), 2);
        $orderTotal = 0;
        
        if(count($cartItem) > 0){
            foreach($cartItem as $item){
                
                $lineUniqueId = substr(uniqid(), 2) . "-" . substr(uniqid(), 8) . "-" . substr(uniqid(), 2);
                
                $cartItems[] = array(
                    "id" => $lineUniqueId,
                    "product_id" => $item['id'],
                    "product_title" => $item['name'],
                    "product_variant_id" => $item['product_attribute_id'] == 0 ? $item['id'] : $item['product_attribute_id'],
                    "product_variant_title" => $item['name'] . ' ' . \backend\models\AttributeValue::findOne(['attribute_value_id' => $item['attribute_value_id']])->value,
                    "quantity" => (int)$item['quantity'],
                    "price" => $item['total_price']
                );
                
                $orderTotal += $item['total_price'];
            }
        }
        
        $cartLines = array(
            "id" => $cartUniqueId,
            "customer" => array(
                "id" => $customerInfo['customer_id'] . ""
            ),
            "campaign_id" => "fa454c0030",
            "checkout_url" => "https://www.thewatch.co/cart/checkout/sign-in",
            "currency_code" => "IDR",
            "order_total" => $orderTotal,
            "tax_total" => 0,
            "lines" => $cartItems
        );
        
//        print_r($cartItems); die();
        
        $post = $MailChimp->post('ecommerce/stores/twc1/carts', $cartLines);
        
        return $post;
        
    }
	
	public static function getProductMailchimp($productId)
    {
        $apiKey = Yii::$app->mailchimp->apiKey;
        $MailChimp = new MailChimp($apiKey);
        
        $get = $MailChimp->get('ecommerce/stores/twc1/products/' . $productId);
        
        return $get;
    }
	
	public static function createCartSession($customerId, $cartItems = array())
    {
        session_start();
        
        if(count($cartItems) > 0){
            foreach($cartItems as $item){
                
                $product = \backend\models\Product::find()
                ->joinWith([
                    "brands",
                    "productDetail",
                    "brandsCollection",
                    "specificPrice",
                    "productImage" => function ($query) {
                        $query->andWhere(['cover' => 1]);
                    }
                ])
                ->where(['product.product_id' => $item->product_id])
				->andWhere(['product.active' => 1])
                ->one();
                
                if($product != NULL){
					
					$productAttributes = \backend\models\ProductAttribute::findAll(['product_id' => $product->product_id]);
                    $stockAvailable = FALSE;
					
					if(count($productAttributes) > 0){
                        foreach($productAttributes as $productAttribute){
                            if($productAttribute->productStock->quantity > 0){
                                $stockAvailable = TRUE;
                            }
                        }
                    } else {
                        if($product->productStock->quantity > 0){
                            $stockAvailable = TRUE;
                        }
                    }
                    
                    // check product quantity
                    if($stockAvailable){
                    
						if($item->product_id == $item->product_variant_id){
							$ProductAttributeCombination = NULL;
						} else {
							$ProductAttributeCombination = \backend\models\ProductAttributeCombination::findOne(['product_attribute_id' => $item->product_variant_id]);
						}
						
						$actualPrice = self::getActualProductPrice($product);
						
						$_SESSION['cart']['items'][] = array(
							'id' => $item->product_id,
							'product_attribute_id' => $item->product_variant_id == $item->product_id ? "0" : $item->product_variant_id,
							'reference' => '',
							'name' => $item->product_title,
							'brand_name' => $product->brands->brand_name,
							'unit_price' => $actualPrice,
							'total_price' => ($actualPrice * $item->quantity),
							'attribute_value_id' => $ProductAttributeCombination != NULL ? $ProductAttributeCombination->attribute_value_id : "",
							'color' => $ProductAttributeCombination != NULL ? $ProductAttributeCombination->attributeValue->value : "",
							'quantity' => $item->quantity,
							'weight' => $product->weight,
							'flag' => true,
							'url' => 'https://www.thewatch.co/product/' . $product->productDetail->link_rewrite,
							'image' => array(
								'url' => 'https://d3vq5glb73pll6.cloudfront.net//img/product/' . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg'
							)
						);
					}
                }
            }
        }
        
    }
    
	private static function getActualProductPrice($product)
    {
        $spesificPrice = \backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
        $now = date('Y-m-d H:i:s');
        
        if($spesificPrice != NULL){
            if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) {
                return $product->price;
            }
            
            if ($spesificPrice->reduction_type == 'percent') {
                $discount = (($spesificPrice->reduction / 100) * $product->price);
            } elseif ($spesificPrice->reduction_type == 'amount') {
                $discount = $spesificPrice->reduction;
            }
            
            return $product->price - $discount;
        }
        
        return $product->price;
    }
	
	public static function registerCustomerMailchimp($customerId)
    {
        $customer = \backend\models\Customer::findOne($customerId);
        
        if($customer != NULL){
            $customerAddress = \backend\models\CustomerAddress::findAll(['customer_id' => $customer->customer_id]);
            $addressList = array();

            if(count($customerAddress) > 0){
                foreach ($customerAddress as $address){
                    $addressList = array(
                        "address1" => $address->address1 . "", 
                        "address2" => $address->address2 . "", 
                        "city" => $address->state->name, 
                        "province" => $address->province->name, 
                        "province_code" => "", 
                        "country_code" => "ID"
                    );
                }
            } else {
                $addressList = array(
                    "address1" => "", 
                    "address2" => "", 
                    "city" => "", 
                    "province" => "", 
                    "province_code" => "", 
                    "country_code" => "ID"
                );
            }

            $customerList = array(
                "id" => $customer->customer_id .'',
                "email_address" => $customer->email,
                "opt_in_status" => true,
                "company" => "",
                "first_name" => $customer->firstname,
                "last_name" => $customer->lastname,
                "orders_count" => 0,
                "total_spent" => 0,
                "address" => $addressList
            );
            
            $apiKey = Yii::$app->mailchimp->apiKey;
            $MailChimp = new MailChimp($apiKey);
        
            $post = $MailChimp->post('ecommerce/stores/twc1/customers/', $customerList);

            return $post;
        }
    }
	
    public static function importCustomerMailchimp(){
        $customers = \backend\models\Customer::find()
            ->limit(10)
            ->offset(7530)
            ->all();
        
        if(count($customers) > 0){
            foreach($customers as $customer){
                
                $customerAddress = \backend\models\CustomerAddress::findAll(['customer_id' => $customer->customer_id]);
                $addressList = array();
                
                if(count($customerAddress) > 0){
                    foreach ($customerAddress as $address){
                        $addressList = array(
                            "address1" => $address->address1 . "", 
                            "address2" => $address->address2 . "", 
                            "city" => $address->state->name, 
                            "province" => $address->province->name, 
                            "province_code" => "", 
                            "country_code" => "ID"
                        );
                    }
                } else {
                    $addressList = array(
                        "address1" => "", 
                        "address2" => "", 
                        "city" => "", 
                        "province" => "", 
                        "province_code" => "", 
                        "country_code" => "ID"
                    );
                }

                $customerList[] = array(
                    "id" => $customer->customer_id .'',
                    "email_address" => $customer->email,
                    "opt_in_status" => true,
                    "company" => "",
                    "first_name" => $customer->firstname,
                    "last_name" => $customer->lastname,
                    "orders_count" => 0,
                    "total_spent" => 0,
                    "address" => $addressList
                );
            }
            
            return $customerList;
        }
        
        return FALSE;
    }

    public static function importProductMailchimp(){
        $products = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "brandsCollection",
                "specificPrice",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
			->limit(500)
            ->offset(0)
            ->all();
        
        if(count($products) > 0){
            foreach($products as $product){

                $productAttributes = \backend\models\ProductAttribute::findAll(['product_id' => $product->product_id]);
                $productVariant = array();
				
				$actualPrice = self::getActualProductPrice($product);

                if(count($productAttributes) > 0){
                    foreach($productAttributes as $productAttribute){
                        $productVariant[] = array(
                            "id" => $productAttribute->product_attribute_id .'',
                            "title" => $product->productDetail->name . ' ' . $productAttribute->productAttributeCombination->attributeValue->value,
                            "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                            "sku" => "",
                            "price" => (int)$actualPrice,
                            "inventory_quantity" => (int)$productAttribute->productStock->quantity,
                            "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                            "backorders" => "",
                            "visibility" => $product->active == "1" ? "visible" : "hidden",
                            "created_at" => $product->date_updated,
                            "updated_at" => $product->date_updated
                        );
                    }
                } else {
                    $productVariant[] = array(
                        "id" => $product->product_id .'',
                        "title" => $product->productDetail->name,
                        "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                        "sku" => "",
                        "price" => (int)$actualPrice,
                        "inventory_quantity" => (int)$product->productStock->quantity,
                        "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                        "backorders" => "",
                        "visibility" => $product->active == "1" ? "visible" : "hidden",
                        "created_at" => $product->date_updated,
                        "updated_at" => $product->date_updated
                    );
                }

                $productList[] = array(
                    "id" => $product->product_id .'',
                    "title" => $product->productDetail->name,
                    "handle" => "",
                    "url" => "https://www.thewatch.co/product/" . $product->productDetail->link_rewrite,
                    "description" => $product->productDetail->description,
                    "type" => $product->productCategory->product_category_name,
                    "vendor" => $product->brands->brand_name,
                    "image_url" => "https://www.thewatch.co/img/product/" . $product->productImage->product_image_id . "/" . $product->productImage->product_image_id . '.jpg',
                    "variants" => $productVariant
                );
            }
            
            return $productList;
        }
        
        return FALSE;
    }

    public static function generateRandomCode(){
        
        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }
	
	public static function generateVoucherCode(){
        
        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return strtoupper($randomString);
    }
	
	public static function generateDynCode($strname){
        
        $length = 8;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.trim($strname);
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return strtoupper($randomString);
    }
	
	public static function generateLotCode(){
        
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        
        return strtoupper($randomString);
    }
	
    /*
     * return array orders detail
     */

    public static function saveOrders() {
        $sessionOrder = new Session();
        $sessionOrder->open();
        // $sessionOrder = Yii::$app->session;

        $cart = $sessionOrder->get("cart");
        $items = $cart['items'];

        $customerInfo = $sessionOrder->get("customerInfo");
        $shippingMethod = $customerInfo['shippingMethod'];
        $paymentMethod = $customerInfo['paymentMethod'];

        $total_cart_quantity = 0;
        $total_product_price = 0;
        $total_cart_item = 0;
        foreach ($items as $item) {
            $total_cart_quantity += $item['quantity'];
            $total_product_price += $item['total_price'];
            $total_cart_item += 1;
        }

        $order_number = \common\components\Helpers::generateOrderNumber();

        $orders = new \backend\models\Orders();
        $orders->customer_id = $customerInfo["customer_id"];
        $orders->reference = $order_number;
        $orders->secure_key = $_POST['_csrf'];
        $orders->customer_address_id = $shippingMethod['customer_address_id'];
        $orders->payment_method_detail_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_id" => $paymentMethod['payment_method_id'], "payment_id" => $paymentMethod["payment_id"]])->payment_method_detail_id;
        $orders->total_shipping = \backend\models\CarrierCost::findOne(["carrier_cost_id" => $shippingMethod['shipping_method']])->price;
        $orders->total_cart_item = $total_cart_item;
        $orders->total_cart_item_quantity = $total_cart_quantity;
        $orders->total_product_price = $total_product_price;
        $orders->date_add = date("Y-m-d H:i:s");
        $orders->invoice_date = date("Y-m-d H:i:s");
        $orders->apps_language_id = 2;
        $orders->carrier_cost_id = \backend\models\CarrierCost::findOne(["carrier_cost_id" => $shippingMethod['shipping_method']])->carrier_id;

        $orders->save();

        foreach ($items as $item) {
            $orders_detail = new \backend\models\OrderDetail();
            $orders_detail->orders_id = $orders->orders_id;
            $orders_detail->product_id = $item['id'];
            $orders_detail->product_name = $item['name'];
            $orders_detail->product_quantity = $item['quantity'];
            $orders_detail->product_attribute_id = $item['product_attribute_id'];
            $orders_detail->product_price = $item['unit_price'];
            $orders_detail->original_product_price = $item['unit_price'];
            $orders_detail->product_weight = \backend\models\Product::findOne(["product_id" => $item['id']])->weight;

            $orders_detail->save();

            // update product stock

            $productStock = \backend\models\ProductStock::findOne(["product_id" => $item['id'], "product_attribute_id" => $item['product_attribute_id']]);
            $productStock->quantity = ($productStock->quantity - $item['quantity']);

            $productStock->update();
        }

        $order_state_lang_id = 0;

        if ($paymentMethod['payment_method_id'] == 1) {
            $order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting"])->order_state_lang_id;
        } else {
            $order_state_lang_id = 1;
        }

        $orderState = new \backend\models\OrderState();
        $orderState->save();

        $orderHistory = new \backend\models\OrderHistory();
        $orderHistory->orders_id = $orders->orders_id;
        $orderHistory->order_state_id = $orderState->order_state_id;
        $orderHistory->order_state_lang_id = $order_state_lang_id;
        $orderHistory->date_add = date("Y-m-d H:i:s");

        $orderHistory->save();

        $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);

        self::sendEmailInvoiceOrders($customerInfo, $order_number, $items, $shippingCost);

        $_SESSION['lastOrder'] = array(
            "order_number" => $order_number
        );

//        unset($_SESSION['cart']);

        return $order_number;
    }

    /*
     * @param array customerInfo
     * @param string order_number
     * @param array items
     * @param integer shippingCost
     * return true if email sent success | false
     */

    public static function sendEmailInvoiceOrders($customerInfo = array(), $order_number, $items = array(), $shippingCost) {
        try {
            \common\components\Helpers::sendEmailMandrillUrlAPI(
                    self::renderFile('@app/views/template/mail/order_placed.php', array(
                        "customerInfo" => $customerInfo,
                        "orderNumber" => $order_number,
                        "items" => $items,
                        "shippingCost" => $shippingCost
                    )), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $customerInfo["email"], ''
            );
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    /*
     *  @param integer number
     *  return price in IDR format
     */

    public static function getPriceFormat($number) {
        return number_format($number, 0, '', '.');
    }

    /*
     *  return generated order number
     */

    public static function generateOrderNumber() {

        $prefix = 'TR';

        $orderDateTime = date("ymdHis");

        $format = $prefix . $orderDateTime . rand(10,99);

        return $format;
    }
    
    public static function generateUniqueCode() {

        $digits = 3;
        
        $format = str_pad(rand(0, 299), $digits, '0', STR_PAD_LEFT);
     
        
        return $format;
    }

    /*
     * @param array session cart->items 
     * return weight in kilogram
     */
    public static function generateWeightOrder($items) {
        $i = 0;
        $weight = 0;

        foreach ($items as $row) {
            $weight = $weight + ($row['weight'] * $row['quantity']);
            $i++;
        }

        if ($weight < 1000) {
            $weight = 1000;
        }

        $weight = round($weight / 1000, 0, PHP_ROUND_HALF_UP);
        
        return $weight;
    }
	
	/*
     * @param array session cart->items 
     * return weight in kilogram
     */
    public static function generateWeightOrderDetail($items) {
        $i = 0;
        $weight = 0;

        foreach ($items as $row) {
            $weight = $weight + ($row->product_weight * $row->product_quantity);
            $i++;
        }

        if ($weight < 1000) {
            $weight = 1000;
        }

        $weight = round($weight / 1000, 0, PHP_ROUND_HALF_UP);
        
        return $weight;
    }

    /*
     * @param string search
     * return array suggestion
     */

    public static function generateSearchSuggestion($input) {

        // array of words to check against
        $words = array('daniel wellington', 'aark collective');

        // no shortest distance found, yet
        $shortest = -1;

        // loop through words to find the closest
        foreach ($words as $word) {

            // calculate the distance between the input word,
            // and the current word
            $lev = levenshtein($input, $word);

            // check for an exact match
            if ($lev == 0) {

                // closest word is this one (exact match)
                $closest = $word;
                $shortest = 0;

                // break out of the loop; we've found an exact match
                break;
            }

            // if this distance is less than the next found shortest
            // distance, OR if a next shortest word has not yet been found
            if ($lev <= $shortest || $shortest < 0) {
                // set the closest match, and shortest distance
                $closest = $word;
                $shortest = $lev;
            }
        }

//        echo "Input word: $input\n";
        if ($shortest == 0) {
            echo "Exact match found: $closest\n";
        } else {
            echo "<span class='gotham-light'>DID YOU MEAN : </span> <a href='#'><span class='gotham-medium'>$closest</span></a> ?</span>";
        }
    }

    public static function sendEmailMandrillUrlAPI($body, $subject, $from, $to, $toNameCust) {
        //require_once 'include_mandrill/mandrill/src/Mandrill.php'; //Not required with Composer
        require_once Yii::$app->getBasePath() . '/include_mandrill/mandrill/src/Mandrill.php';
        //   include_once("include_mandrill/mandrill/src/Mandrill.php"); 
        try {
            $mandrill = new \Mandrill(Yii::$app->params['mandPwd']);
            $message = array(
                'html' => $body, //'<p>Example HTML content</p>',
                'text' => $body, //'Example text content',
                'subject' => $subject, //'example subject',
                'from_email' => Yii::$app->params['infoEmail'],
                'from_name' => Yii::$app->params['webName'],
                'to' => array(
                    array(
                        'email' => $to,
                        'name' => $toNameCust, 'Recipient Name',
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => Yii::$app->params['infoEmail']),
                'important' => true,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
            );
            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = ''; //YYYY-MM-DD HH:MM:SS
            $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            //echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            //throw $e;
        }
    }
	
	public static function sendScheduleEmailMandrillUrlAPI($body, $subject, $from, $to, $toNameCust) {
        //require_once 'include_mandrill/mandrill/src/Mandrill.php'; //Not required with Composer
        require_once Yii::$app->getBasePath() . '/include_mandrill/mandrill/src/Mandrill.php';
        //   include_once("include_mandrill/mandrill/src/Mandrill.php"); 
        try {
            $mandrill = new \Mandrill('VeBgR01y5I46DFnYUNMwFw');
            $message = array(
                'html' => $body, //'<p>Example HTML content</p>',
                'text' => $body, //'Example text content',
                'subject' => $subject, //'example subject',
                'from_email' => 'notification@thewatch.co',
                'from_name' => 'The Watch Co.',
                'to' => array(
                    array(
                        'email' => $to,
                        'name' => $toNameCust, 'Recipient Name',
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'cs@thewatch.co'),
                'important' => true,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
            );
            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = ''; //YYYY-MM-DD HH:MM:SS
            $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            //echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            //throw $e;
        }
    }

    public static function sendEmailMandrillUrlInquiriesAPI($body, $subject, $from, $from_name, $to, $toNameCust) {
        //require_once 'include_mandrill/mandrill/src/Mandrill.php'; //Not required with Composer
        require_once Yii::$app->getBasePath() . '/include_mandrill/mandrill/src/Mandrill.php';
        //   include_once("include_mandrill/mandrill/src/Mandrill.php"); 
        try {
            $mandrill = new \Mandrill(Yii::$app->params['mandPwd']);
            $message = array(
                'html' => $body, //'<p>Example HTML content</p>',
                'text' => $body, //'Example text content',
                'subject' => $subject, //'example subject',
                'from_email' => $from,
                'from_name' => $from_name,
                'to' => array(
                    array(
                        'email' => $to,
                        'name' => $toNameCust, 'Recipient Name',
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => $from),
                'important' => true,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
            );
            $async = false;
            $ip_pool = 'Main Pool';
            $send_at = ''; //YYYY-MM-DD HH:MM:SS
            $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            //echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            //throw $e;
        }
    }

	/** 
	* Helper Get Special Promo List
	* @param $promo_alias as promo alias
	* @param $brands_id as array brand id
	* @param $is_discount_price as condition is promo from normal price or discount price
	*/
	public static function getSpecialPromoProducts($promo_alias, $brands_id = array(), $is_discount_price = TRUE)
    {
		$current_time = date('Y-m-d H:i:s');
		$special_promo = \backend\models\SpecialPromo::findOne(["promo_alias" => $promo_alias]);
		$products_id = array();
		$product_promos = array();
		$message = "";
		$special_promo_id = 0;
		$discount_amount = 0;
		$results = array();
		if( $current_time >= $special_promo['date_from'] && $current_time <= $special_promo['date_to'] ){
			$discount_amount = (int) $special_promo['promo_amount'];
			if ( $special_promo['product_restriction'] === 1 ) { // get products id that have been set in table special_promo_product
				$special_promo_products = \backend\models\SpecialPromoProduct::findAll(["special_promo_id" => $special_promo['special_promo_id']]);
				foreach ( $special_promo_products as $spp ) {
					array_push($products_id, $spp['product_id']);
				}
				$message = "Special Promo Discount Price Product";
			} else {
				$products_id = array();
				$specific_prices = \backend\models\Product::find()->joinWith(["specificPrice"])
						->where(["in", "product.brands_brand_id", $brands_id])
						->andWhere('specific_price.from <= "'. $current_time . '"')
						->andWhere('specific_price.to > "'. $current_time . '"')->all();
				foreach ($product_promos as $pp) {
					array_push($products_id, $pp['product_id']); // get products id that have discount price
				}
					
				if ( $is_discount_price ) { // get products id that have discount price
					$products_id = array();
					$product_promos = \backend\models\Product::find()->joinWith(["specificPrice"])
							->where(["in", "product.brands_brand_id", $brands_id])
							->andWhere('specific_price.from <= "'. $current_time . '"')
							->andWhere('specific_price.to > "'. $current_time . '"')->all();
					foreach ($product_promos as $pp) {
						array_push($products_id, $pp['product_id']); // get products id that have discount price
					}
					$message = "Discount Price Product";
				} else { // get products id that dont have discount price
					$product_promos = \backend\models\Product::find()
						->select('product.product_id')
						// ->leftJoin('specific_price', 'specific_price.product_id = product.product_id  AND specific_price.from>=DATE_ADD(DATE(now()), INTERVAL 7 DAY)')
						->leftJoin('specific_price', 'specific_price.product_id = product.product_id')
						->where(['is', 'specific_price.product_id', NULL])
						->andWhere(["in", "product.brands_brand_id", $brands_id])
						->all();
					$products_id = array();
					// die(var_dump($product_promos));
					// $product_promos = \backend\models\Product::find()
						// ->where(["in", "product.brands_brand_id", $brands_id])->all();
					foreach ($product_promos as $pp) {
						// if($pp->discount_available === 0){
							array_push($products_id, $pp->product_id); // get products id that dont have discount price
						// }
					}
					$message = "Normal Price Product";
				}
			}
		}
		$results =  array(
			'message' => $message,
			'special_promo' => $special_promo,
			'results' => $products_id
		);
		return $results;
	}

	/** 
	* Helper Get Special Promo List
	* @param $promo_alias as promo alias
	* @param $categories as array categories
	* @param $brands as array brands
	* @param $products as array products
	* @param $is_discount_price as condition is promo from normal price or discount price
	*/
	public static function getSpecialPromoProductsNew($promo_alias, $categories = array(), $brands = array(), $products = array())
    {
		$current_time = date('Y-m-d H:i:s');
		$special_promo = \backend\models\SpecialPromo::findOne(["promo_alias" => $promo_alias]);
		$products_id = array();
		$product_promos = array();
		$special_promo_id = 0;
		$discount_amount = 0;
		$message = "";
		$results = array();
		if( $current_time >= $special_promo['date_from'] && $current_time <= $special_promo['date_to'] ){
            $discount_amount = (int) $special_promo['promo_amount'];

            // This query cannot be used
            $product_promos = \backend\models\Product::find()
                ->select('product.product_id, (CASE WHEN specific_price.product_id IS NOT NULL THEN 1 ELSE 0 END) AS discount_available, (CASE WHEN NOW() > specific_price.to THEN 1 ELSE 0 END) AS is_normal_price')
                ->leftJoin('specific_price', 'specific_price.product_id = product.product_id')
                ->leftJoin('brands', 'product.brands_brand_id = brands.brand_id')
                ->where(['NOT', ['product.product_id' => NULL]]);
            
            if ( $special_promo['category_restriction'] === 1 ) { // get products restrict by filtered categories
                if(sizeof($categories) > 0){
                    $product_promos->andWhere(["in", "product.product_category_id", $categories]);
                }
            }
            if ( $special_promo['brand_restriction'] === 1 ) { // get products restrict by filtered brands
                if(sizeof($brands) > 0){
                    $product_promos->andWhere(["in", "brands.link_rewrite", $brands]);
                }
            }
            if ( $special_promo['product_restriction'] === 1 ) { // get products restrict by filtered products
                if(sizeof($products) > 0){
                    $product_promos->andWhere(["in", "product.product_id", $products]);
                }
            }
            // $product_promos->orderBy($sort);
            $promo_list = $product_promos->all();
            die(var_dump($promo_list));
            foreach ($promo_list as $pl) {
                if($pl->discount_available === 0){
                    if ( $special_promo['is_discount'] === 0 ) {
                        array_push($products_id, $pl->product_id); // get normal price products id
                    }
                }
                if($pl->discount_available === 1){
                    if ( $special_promo['is_discount'] === 1 ) {
                        if($pl->is_normal_price === 0){
                            array_push($products_id, $pl->product_id); // get discount price products id
                        }
                    } else {
                        if($pl->is_normal_price === 1){
                            array_push($products_id, $pl->product_id); // get normal price products id
                        }
                    }
                }
            }
            $message = "Special Promos " . $special_promo['promo_name'];
        }
		$results =  array(
			'message' => $message,
			'special_promo' => $special_promo,
			'results' => $products_id
		);
		return $results;
    }

}
