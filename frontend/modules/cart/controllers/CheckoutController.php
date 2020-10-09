<?php

namespace app\modules\cart\controllers;

use frontend\core\controller\FrontendController;
use frontend\models\OrdersForm;
use frontend\models\CustomerForm;
use backend\models\CarrierCost;
use backend\models\CarrierPackageDetail;
use backend\models\District;
use backend\models\State;
use backend\models\CarrierCostFlatPrice;
use yii\web\Session;
use yii\helpers\Url;
 
class CheckoutController extends FrontendController {

    

    public function actionRemoveCartItem() {
        $id = $_POST['id'];
        $attributeId = $_POST['attributeId'];

        $sessionOrder = new Session();
        $cart = $sessionOrder->get("cart");

        if ($cart != NULL) {
            $items = $cart['items'];

            if (count($items) > 0) {
                
                $i = 0;
                $j = 0;
                
                $foundBundling = false;
                // detect if customer delete product bundling campaign 
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    if($item['id'] == $id && isset($item['flag'])){
                        $foundBundling = TRUE;
                    }
                    
                }
                
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    // if($foundBundling){
                        
                        // $k = 0;
                        // // find related product bundling campaign in current shopping cart
                        // foreach($items as $product){
                            // // remove matched product bundling campaign in current shopping cart
                            // if(isset($product['flag'])){
                                // unset($_SESSION['cart']['items'][$k]);
                                // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                // if (empty($_SESSION['cart']['items'])) {
                                    // unset($_SESSION['cart']['items']);
                                // }
                            // }
                            // $k++;
                        // }
                        
                        // $i++;
                        // continue;
                    // }
                    
                    // check if customer remove only campaign product in current shopping cart
                    if($item['id'] == $id && isset($item['productCampaign'])){
                        
                        // find related free campaign product in current shopping cart
                        foreach($items as $product){
                            // remove matched free campaign product in current shopping cart
                            if(isset($product['productFreeCampaign'])){
                                unset($_SESSION['cart']['items'][$j]);
                                $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                if (empty($_SESSION['cart']['items'])) {
                                    unset($_SESSION['cart']['items']);
                                }
                            }
                            $j++;
                        }
                        
                        // remove campaign product in current shopping cart
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                        
                        $i++;
                        continue;
                    }
                    
                    if ($item['id'] == $id && $item['product_attribute_id'] == $attributeId) {
                        
                        // if product has bundling in shopping cart session
                        if(isset($_SESSION['cart']['items'][$i]['is_bundling'])){
                            unset($_SESSION['cart']['items']);
                        } else {
                            unset($_SESSION['cart']['items'][$i]);
                            $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                        }
                        
                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                    }
                    $i++;
                }
                
                // remove voucher information for every time customer update shopping cart
                if(isset($_SESSION['voucherInfo'])){
                    unset($_SESSION['voucherInfo']);
                }
                
            }
        }
		
		if (isset($_SESSION['customerInfo'])){
            
            // check if customer already in existing cart in mailchimp
            $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $sessionItems = $_SESSION['cart']['items'];
            
            if(count($carts) > 0){
                foreach($carts as $cart){
                    // update existing cart if customer email match
                    if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                        // remove existing cart and re-create new cart
                        $cartId = $cart->id;
                        \common\components\Helpers::deleteCartMailchimp($cartId);
                    }
                }
                
                if(count($sessionItems) > 0){
                    \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
                }
                
            }
        }
		
        return $id;
        return $this->renderFile('@app/modules/cart/views/checkout/shoppingcart.php');
    }

    public function actionRemoveItem() {
        $id = $_POST['id'];
        $attributeId = $_POST['attributeId'];

        $sessionOrder = new Session();
        $cart = $sessionOrder->get("cart");

        if ($cart != NULL) {
            $items = $cart['items'];

            if (count($items) > 0) {
                $i = 0;
                $j = 0;
                
                $foundBundling = false;
                // detect if customer delete product bundling campaign 
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    if($item['id'] == $id && isset($item['flag'])){
                        $foundBundling = TRUE;
                    }
                    
                }
                
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    // if($foundBundling){
                        
                        // $k = 0;
                        // // find related product bundling campaign in current shopping cart
                        // foreach($items as $product){
                            // // remove matched product bundling campaign in current shopping cart
                            // if(isset($product['flag'])){
                                // unset($_SESSION['cart']['items'][$k]);
                                // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                // if (empty($_SESSION['cart']['items'])) {
                                    // unset($_SESSION['cart']['items']);
                                // }
                            // }
                            // $k++;
                        // }
                        
                        // $i++;
                        // continue;
                    // }
                    
                    // check if customer remove only campaign product in current shopping cart
                    if($item['id'] == $id && isset($item['productCampaign'])){
                        
                        // find related free campaign product in current shopping cart
                        foreach($items as $product){
                            // remove matched free campaign product in current shopping cart
                            if(isset($product['productFreeCampaign'])){
                                unset($_SESSION['cart']['items'][$j]);
                                $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                if (empty($_SESSION['cart']['items'])) {
                                    unset($_SESSION['cart']['items']);
                                }
                            }
                            $j++;
                        }
                        
                        // remove campaign product in current shopping cart
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                        
                        $i++;
                        continue;
                    }
                    
                    if ($item['id'] == $id && $item['product_attribute_id'] == $attributeId) {
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                    }
                    $i++;
                }
                
                // remove voucher information for every time customer update shopping cart
                if(isset($_SESSION['voucherInfo'])){
                    unset($_SESSION['voucherInfo']);
                }
            }
        }
		
		if (isset($_SESSION['customerInfo'])){
            
            // check if customer already in existing cart in mailchimp
            $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $sessionItems = $_SESSION['cart']['items'];
            
            if(count($carts) > 0){
                foreach($carts as $cart){
                    // update existing cart if customer email match
                    if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                        // remove existing cart and re-create new cart
                        $cartId = $cart->id;
                        \common\components\Helpers::deleteCartMailchimp($cartId);
                    }
                }
                
                if(count($sessionItems) > 0){
                    \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
                }
                
            }
        }
        
        //return $id;
        $data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
        $data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php');
        return $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
    }
    
    public function actionRemoveItemEvent() {
        $id = $_POST['id'];
        $attributeId = $_POST['attributeId'];

        $sessionOrder = new Session();
        $cart = $sessionOrder->get("cart");

        if ($cart != NULL) {
            $items = $cart['items'];

            if (count($items) > 0) {
                $i = 0;
                $j = 0;
                
                $foundBundling = false;
                // detect if customer delete product bundling campaign 
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    if($item['id'] == $id && isset($item['flag'])){
                        $foundBundling = TRUE;
                    }
                    
                }
                
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    // if($foundBundling){
                        
                        // $k = 0;
                        // // find related product bundling campaign in current shopping cart
                        // foreach($items as $product){
                            // // remove matched product bundling campaign in current shopping cart
                            // if(isset($product['flag'])){
                                // unset($_SESSION['cart']['items'][$k]);
                                // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                // if (empty($_SESSION['cart']['items'])) {
                                    // unset($_SESSION['cart']['items']);
                                // }
                            // }
                            // $k++;
                        // }
                        
                        // $i++;
                        // continue;
                    // }
                    
                    // check if customer remove only campaign product in current shopping cart
                    if($item['id'] == $id && isset($item['productCampaign'])){
                        
                        // find related free campaign product in current shopping cart
                        foreach($items as $product){
                            // remove matched free campaign product in current shopping cart
                            if(isset($product['productFreeCampaign'])){
                                unset($_SESSION['cart']['items'][$j]);
                                $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                if (empty($_SESSION['cart']['items'])) {
                                    unset($_SESSION['cart']['items']);
                                }
                            }
                            $j++;
                        }
                        
                        // remove campaign product in current shopping cart
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                        
                        $i++;
                        continue;
                    }
                    
                    if ($item['id'] == $id && $item['product_attribute_id'] == $attributeId) {
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                    }
                    $i++;
                }
                
                // remove voucher information for every time customer update shopping cart
                if(isset($_SESSION['voucherInfo'])){
                    unset($_SESSION['voucherInfo']);
                }
            }
        }
		
		if (isset($_SESSION['customerInfo'])){
            
            // check if customer already in existing cart in mailchimp
            $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $sessionItems = $_SESSION['cart']['items'];
            
            if(count($carts) > 0){
                foreach($carts as $cart){
                    // update existing cart if customer email match
                    if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                        // remove existing cart and re-create new cart
                        $cartId = $cart->id;
                        \common\components\Helpers::deleteCartMailchimp($cartId);
                    }
                }
                
                if(count($sessionItems) > 0){
                    \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
                }
                
            }
        }
        
        //return $id;
        $data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
        $data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php');
        return $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_event.php');
    }
    
    public function actionRemoveCartItemCart() {
        $id = $_POST['id'];
        $attributeId = $_POST['attributeId'];

        $sessionOrder = new Session();
        $cart = $sessionOrder->get("cart");

        if ($cart != NULL) {
            $items = $cart['items'];

            if (count($items) > 0) {
                
                $i = 0;
                $j = 0;
                
                $foundBundling = false;
                // detect if customer delete product bundling campaign 
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    if($item['id'] == $id && isset($item['flag'])){
                        $foundBundling = TRUE;
                    }
                    
                }
                
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    // if($foundBundling){
                        
                        // $k = 0;
                        // // find related product bundling campaign in current shopping cart
                        // foreach($items as $product){
                            // // remove matched product bundling campaign in current shopping cart
                            // if(isset($product['flag'])){
                                // unset($_SESSION['cart']['items'][$k]);
                                // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                // if (empty($_SESSION['cart']['items'])) {
                                    // unset($_SESSION['cart']['items']);
                                // }
                            // }
                            // $k++;
                        // }
                        
                        // $i++;
                        // continue;
                    // }
                    
                    // check if customer remove only campaign product in current shopping cart
                    if($item['id'] == $id && isset($item['productCampaign'])){
                        
                        // find related free campaign product in current shopping cart
                        foreach($items as $product){
                            // remove matched free campaign product in current shopping cart
                            if(isset($product['productFreeCampaign'])){
                                unset($_SESSION['cart']['items'][$j]);
                                $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                if (empty($_SESSION['cart']['items'])) {
                                    unset($_SESSION['cart']['items']);
                                }
                            }
                            $j++;
                        }
                        
                        // remove campaign product in current shopping cart
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                        
                        $i++;
                        continue;
                    }
                    
                    if ($item['id'] == $id && $item['product_attribute_id'] == $attributeId) {
                        
                        // if product has bundling in shopping cart session
                        if(isset($_SESSION['cart']['items'][$i]['is_bundling'])){
                            unset($_SESSION['cart']['items']);
                        } else {
                            unset($_SESSION['cart']['items'][$i]);
                            $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                        }
                        
                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                    }
                    $i++;
                }
                
                // remove voucher information for every time customer update shopping cart
                if(isset($_SESSION['voucherInfo'])){
                    unset($_SESSION['voucherInfo']);
                }
                
            }
        }
        
        return $this->renderFile('@app/modules/cart/views/checkout/shoppingcart.php');
    }

    public function actionRemoveItemCart() {
        $id = $_POST['id'];
        $attributeId = $_POST['attributeId'];

        $sessionOrder = new Session();
        $cart = $sessionOrder->get("cart");

        if ($cart != NULL) {
            $items = $cart['items'];

            if (count($items) > 0) {
                $i = 0;
                $j = 0;
                
                $foundBundling = false;
                // detect if customer delete product bundling campaign 
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    if($item['id'] == $id && isset($item['flag'])){
                        $foundBundling = TRUE;
                    }
                    
                }
                
                foreach ($items as $item) {
                    
                    // check if customer remove product bundling campaign in current shopping cart
                    // if($foundBundling){
                        
                        // $k = 0;
                        // // find related product bundling campaign in current shopping cart
                        // foreach($items as $product){
                            // // remove matched product bundling campaign in current shopping cart
                            // if(isset($product['flag'])){
                                // unset($_SESSION['cart']['items'][$k]);
                                // $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                // if (empty($_SESSION['cart']['items'])) {
                                    // unset($_SESSION['cart']['items']);
                                // }
                            // }
                            // $k++;
                        // }
                        
                        // $i++;
                        // continue;
                    // }
                    
                    // check if customer remove only campaign product in current shopping cart
                    if($item['id'] == $id && isset($item['productCampaign'])){
                        
                        // find related free campaign product in current shopping cart
                        foreach($items as $product){
                            // remove matched free campaign product in current shopping cart
                            if(isset($product['productFreeCampaign'])){
                                unset($_SESSION['cart']['items'][$j]);
                                $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);
                                
                                if (empty($_SESSION['cart']['items'])) {
                                    unset($_SESSION['cart']['items']);
                                }
                            }
                            $j++;
                        }
                        
                        // remove campaign product in current shopping cart
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                        
                        $i++;
                        continue;
                    }
                    
                    if ($item['id'] == $id && $item['product_attribute_id'] == $attributeId) {
                        unset($_SESSION['cart']['items'][$i]);
                        $_SESSION['cart']['items'] = array_values($_SESSION['cart']['items']);

                        if (empty($_SESSION['cart']['items'])) {
                            unset($_SESSION['cart']['items']);
                        }
                    }
                    $i++;
                }
                
                // remove voucher information for every time customer update shopping cart
                if(isset($_SESSION['voucherInfo'])){
                    unset($_SESSION['voucherInfo']);
                }
            }
        }
		
        if (isset($_SESSION['customerInfo'])){
            
            // check if customer already in existing cart in mailchimp
            $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $sessionItems = $_SESSION['cart']['items'];
            
            if(count($carts) > 0){
                foreach($carts as $cart){
                    // update existing cart if customer email match
                    if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                        // remove existing cart and re-create new cart
                        $cartId = $cart->id;
                        \common\components\Helpers::deleteCartMailchimp($cartId);
                    }
                }
                
                if(count($sessionItems) > 0){
                    \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
                }
                
            }
        }
		
        $data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
        $data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php');
        return $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
    }

    public function actionAddItem() {

        $data = $_POST;

        $sessionOrder = new Session();
        $cart = $sessionOrder->get("cart");
        $pre_order = 0;
        
        $items = $data['cart']['items'];
            $x = 0;
            foreach($items as $item){
                if($item['pre_order'] == 1){
                    $pre_order = 1;
                }

                if ( $item['unit_price'] === 0 ) { // if unit price is 0 while customer add to cart, then force unset the session
                    unset($_SESSION['cart']['items'][$x]); // this could be a simple price hacking prevention
                }
                $x++;
            }

        if ($cart == NULL) {
            
            if(isset($data['cart']['items'][0]['productFreeCampaign'])){
                return;
            }
            
            $order = new OrdersForm();
            $order->create($data);
            
        } else {

            $items = $cart['items'];

            if(count($items) == 1){
                $i = 0;
                foreach($items as $item){
                    if($item['flash_sale'] == 1){
                        $data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
                        $data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php');
                        $data[2] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_event.php');
                        return json_encode($data);
                    }
                    if($pre_order == 1){
                        if($item['pre_order'] == 1){
                            $pre_order = 1;
                        }else{
                            unset($_SESSION['cart']['items'][$i]);
                        }
                    }
                    if($pre_order == 0){
                        if($item['pre_order'] == 1){
                            unset($_SESSION['cart']['items'][$i]);
                        }
                    }
                    $i++;
                }
            }
            
            $order = new OrdersForm();
            $sessionOrder->open();

            $items = $cart['items'];

            if (count($items) > 0) {
                $i = 0;
                $len = count($items);
                $found = FALSE;
                
                /*
                 * check product bundling campaign
                 */
                
                $foundBundlingCampaign = FALSE;
                $countBundling = 0;
                foreach ($items as $item) {
                    // check if product campaign found in current shopping cart
                    if($item['productBundlingCampaign']){
                        $foundBundlingCampaign = TRUE;
                        $countBundling++;
                    }
                }
                
                /*
                 * end of check product bundling campaign
                 */
                
                /*
                 * check product campaign
                 */
                
                $foundCampaign = FALSE;
                $foundFreeCampaign = FALSE;
                foreach ($items as $item) {
                    // check if product campaign found in current shopping cart
                    if($item['productCampaign']){
                        $foundCampaign = TRUE;
                    }
                    
                    //check if free product campaign found in current shopping cart
                    if($item['productFreeCampaign']){
                        $foundFreeCampaign = TRUE;
                    }
                }
                
                if(isset($data['cart']['items'][0]['productBundlingCampaign']) && $foundCampaign){
                    return;
                } elseif(isset($data['cart']['items'][0]['productCampaign']) && $foundBundlingCampaign){
                    return;
                }
                
                
                if(isset($data['cart']['items'][0]['productBundlingCampaign'])){
                    // discount 50 for current bundling product 
                    if($countBundling == 1){
                        $data['cart']['items'][0]['unit_price'] -= 50000;
                        $data['cart']['items'][0]['total_price'] -= 50000;
                    } elseif($countBundling == 2){
                        $data['cart']['items'][0]['unit_price'] -= 50000;
                        $data['cart']['items'][0]['total_price'] -= 50000;
                    } elseif($countBundling == 3){
                        $data['cart']['items'][0]['unit_price'] -= 50000;
                        $data['cart']['items'][0]['total_price'] -= 50000;
                    }
                }
                
                /*
                 * end of check product campaign
                 */
                
                foreach ($items as $item) {
                    
                    /*
                     * check product bundling campaign
                     */
                     
                    if(isset($data['cart']['items'][0]['productBundlingCampaign'])){
                        if ($item['id'] == $data['cart']['items'][0]['id'] && $item['product_attribute_id'] == $data['cart']['items'][0]['product_attribute_id']) {
                            return;
                        }
                    } 
                    
                    // if customer add same product with product bundling campaign
                    if(isset($data['cart']['items'][0]['productBundlingCampaign']) && $foundBundlingCampaign){
                        
                        // discount 50 
                        if($countBundling == 1){
                            if(isset($item['productBundlingCampaign'])){
                                $_SESSION['cart']['items'][$i]['unit_price'] -= 50000;
                                $_SESSION['cart']['items'][$i]['total_price'] -= 50000;
                            }
                        }
                        
                    }
                    
                    /*
                     * end of check product bundling campaign
                     */
                    
                    /*
                     * check product campaign
                     */
                    
                    // exit if product campaign not found in current shopping cart
                    if(isset($data['cart']['items'][0]['productFreeCampaign']) && $foundCampaign == FALSE){
                        return;
                    }
                    
                    // exit if product free campaign found in current shopping cart
                    if(isset($data['cart']['items'][0]['productFreeCampaign']) && $foundFreeCampaign){
                        return;
                    }
                    
                    // if customer add same product with free campaign product
                    if($item['id'] == $data['cart']['items'][0]['id'] && $foundFreeCampaign){
                        return;
                    } elseif ($item['id'] == $data['cart']['items'][0]['id'] && isset($data['cart']['items'][0]['productFreeCampaign'])){
                        return;
                    }
                    
                    
                    /*
                     * end of check product campaign
                     */
                    
                    // update if existing item found
                    if ($item['id'] == $data['cart']['items'][0]['id'] && $item['product_attribute_id'] == $data['cart']['items'][0]['product_attribute_id']) {
                        
                        $existingStock = \backend\models\ProductStock::findOne([
                            'product_id' => $data['cart']['items'][0]['id'],
                            'product_attribute_id' => $data['cart']['items'][0]['product_attribute_id']
                        ])->quantity;
                        
                        $quantityCombination = ($data['cart']['items'][0]['quantity'] + $item['quantity']);
                        
                        if($existingStock >= $quantityCombination){
                        
                            // update quantity
                            $newquantity = $data['cart']['items'][0]['quantity'];
                            $oldquantity = $item['quantity'];

                            $unitprice = $item['unit_price'];

                            $_SESSION['cart']['items'][$i]['quantity'] = ($oldquantity + $newquantity);
                            $_SESSION['cart']['items'][$i]['total_price'] = ( ($oldquantity + $newquantity) * $unitprice);

                        }
                        
                        //same product found
                        $found = TRUE;
                    } else {

                        // insert new item if in last items
                        if ($i == $len - 1 && $found == FALSE) {
                            foreach ($data['cart']['items'] as $value) {
                                $_SESSION['cart']['items'][] = $value;
                            }
                        }
                    }
                    $i++;
                }
            }
        }
        
        // remove voucher information for every time customer update shopping cart
        if(isset($_SESSION['voucherInfo'])){
            unset($_SESSION['voucherInfo']);
        }
		
		if (isset($_SESSION['customerInfo'])){
            
            // check if customer already in existing cart in mailchimp
            $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $sessionItems = $_SESSION['cart']['items'];
            
            if($pre_order == 0){
                if(count($carts) > 0){
                    foreach($carts as $cart){
                        // update existing cart if customer email match
                        if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                            // remove existing cart and re-create new cart
                            $cartId = $cart->id;
                            \common\components\Helpers::deleteCartMailchimp($cartId);
                            \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
                            
                            $data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
                            $data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php');
                            return json_encode($data);
                        } 
                    }
    				
    				\common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
    						
    				$data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
    				$data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php');
    				return json_encode($data);
                    
                } else {
                    \common\components\Helpers::addToCartMailchimp($data['cart']['items'], $_SESSION['customerInfo']);
                }
            }
        }
        
        $data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php');
        $data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php');
        $data[2] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_event.php');
        return json_encode($data);
    }

    public function actionIndex() {
        return $this->render('index');
    }
	
	private function isWeekend($date) {
		$weekDay = date('w', strtotime($date));
		return ($weekDay == 0 || $weekDay == 5); // vospay weekend is from friday to sunday
	}

    public function actionStep($action = NULL, $id = 0) {
    

		
		$now = date("Y-m-d H:i:s");
		$current_date = $now;
		
		
        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : '';

        $reduction = 0;
        $discount = 0;
        $reduction_xtra = 0;
        $discount_extra = 0;
        $reduction_plus_xtra = 0;
        $discount_plus_extra = 0;

        switch ($action) {

            case "ordercomplete" :
                // check payment method gateway provider
                $orders = \backend\models\Orders::find()->where(['reference' => $_SESSION['lastOrder']['order_number']])->one();
                $paymentGateway = $orders->paymentmethoddetail->payment->payment_gateway_company;
				$order_cart_rule = \backend\models\OrderCartRule::find()->where(['orders_id' => $orders->orders_id])->one();
				if($order_cart_rule->free_shipping == 1){
					$free_shipping = 1;
				}else{
					$free_shipping = 0;
				}
				
				
				
                if ($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 3 && $paymentGateway != 'VERITRANS') {
                    $customerInfo = $sessionOrder->get("customerInfo");

                    if (isset($customerInfo['shippingMethod'])) {
                        $info = \backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']]);
						$shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);
                    }
                    $this->layout = false;
                    return $this->render('step/revieworderinstallment', array("info" => $info, "shippingCost" => $shippingCost, "shippingInsurance" => $orders->total_shipping_insurance, "total_special_promo"=>$orders->total_special_promo, "free_shipping"=>$free_shipping));
                } elseif ($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 4 && $paymentGateway != 'VERITRANS') { // Payment Kredivo
                    $customerInfo = $sessionOrder->get("customerInfo");

                    if (isset($customerInfo['shippingMethod'])) {
                        $info = \backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']]);
                        $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);
                    }
                    $this->layout = false;
                    return $this->render('step/revieworderkredivo', array("info" => $info, "shippingCost" => $shippingCost, "shippingInsurance" => $orders->total_shipping_insurance));
                    
                } elseif ($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 5) {
                    
                    // if($_SESSION['customerInfo']['customer_id'] == 7614){
                        
                        $valog = \backend\models\VaLog::findOne(['order_id' => $orders->reference]);
					
    					if($valog != NULL){
    					    if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 9){
                                return $this->render('step/ordercomplete_gopay');
                            }
    						return $this->render('step/ordercomplete');
    					}
    					
    					$items = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
    					$itemsDetail = array();
    					
    					$totalShipping = 0;
    					$grandtotal = 0;
    					$voucherAmount = 0;
    					
    					// product order
    					if(count($items) > 0){
                            foreach($items as $item){
    							$itemsDetail[] = array(
    								"id" => $item->product_id . "",
    								"name" => $item->product_name . "",
    								"price" => $item->original_product_price,
    								"quantity" => $item->product_quantity
    							);	
                            }
                        }
    					
    					// voucher code 
    					$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
    					
    					if($orderCartRule != NULL){
    						$itemsDetail[] = array(
    							"id" => $orderCartRule->cart_rule_id,
    							"price" => -round($orderCartRule->value),
    							"quantity" => 1,
    							"name" => 'discount voucher'
    						);
    						
    						$voucherAmount = $orderCartRule->value;
    					}
    					
    					// special promo
    					if($orders->total_special_promo != 0){
                            $itemsDetail[] = array(
                                "id" => "0",
                                "price" => -round($orders->total_special_promo),
                                "quantity" => 1,
                                "name" => 'Special Promo '.$orders->specialPromo->promo_name
                            );
                           
                        }
    					
    					
    					if($orders->total_shipping_insurance != 0){
    						// shipping + insurance
    						$itemsDetail[] = array(
    							"id" => "0",
    							"name" => "SHIPPING + INSURANCE",
    							"price" => $orders->total_shipping + $orders->total_shipping_insurance,
    							"quantity" => 1
    						);
    						
    						$totalShipping = $orders->total_shipping + $orders->total_shipping_insurance;
    						
    					} else {
    						// shipping
    						$itemsDetail[] = array(
    							"id" => "0",
    							"name" => "SHIPPING",
    							"price" => $orders->total_shipping,
    							"quantity" => 1
    						);
    						
    						$totalShipping = $orders->total_shipping;
    					}
    					
    					$grandtotal += $orders->total_product_price;
    					$grandtotal += $totalShipping;
    					$grandtotal -= $voucherAmount;
    					$grandtotal -= $orders->total_special_promo;
    					
    					$transaction_details = array(
    						'order_id' => $_SESSION['lastOrder']['order_number'],
    						'gross_amount' => round($grandtotal) 
    					);
    					
    					$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
    					
    					$customer = \backend\models\Customer::findOne(["customer_id" => $orders->customer_id]);
    					$customerAddress = \backend\models\CustomerAddress::findOne(["customer_address_id" => $orders->customer_address_id]);
    					
    					$billing_address = array(
    						'first_name' => $customer->firstname,
    						'last_name' => $customer->lastname,
    						'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
    						'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
    						'postal_code' => $customerAddress->postcode,
    						'phone' => $customerAddress->phone,
    						'country_code' => 'IDN'
    					);
    
    					$shipping_address = array(
    						'first_name' => $customer->firstname,
    						'last_name' => $customer->lastname,
    						'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
    						'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
    						'postal_code' => $customerAddress->postcode,
    						'phone' => $customerAddress->phone,
    						'country_code' => 'IDN'
    					);
    
    					// Populate customer's info
    					
    					if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 5){
    					    $customer_details = array(
        						'first_name' => $customer->firstname,
        						'last_name' => $customer->lastname,
        						'email' => $customer->email,
        						'phone' => $customerAddress->phone
        					);
    					}else{
    					    $customer_details = array(
        						'first_name' => $customer->firstname,
        						'last_name' => $customer->lastname,
        						'email' => $customer->email,
        						'phone' => $customerAddress->phone,
        						'billing_address' => $billing_address,
        						'shipping_address' => $shipping_address
        					);
    					}
    					
    					
    					if(strtolower($bankName[0]) == "akulaku") {
    						$transaction_data = array(
    							'payment_type' => 'akulaku',
    							'transaction_details' => $transaction_details,
    							'item_details' => $itemsDetail,
    							'customer_details' => $customer_details
    						);
    					} else {
    						$transaction_data = array(
    							'payment_type' => 'bank_transfer',
    							'bank_transfer' => array(
    								'bank' => strtolower($bankName[0])
    							),
    							'transaction_details' => $transaction_details,
    							'item_details' => $itemsDetail,
    							'customer_details' => $customer_details
    						);
    					}
                        
                  
    					require_once \Yii::$app->getBasePath() . '/include/Veritrans.php';
    					
    					// \Veritrans_Config::$serverKey = 'VT-server-Nj6-jo8mSfy6IOwGBBUGa3LA';
                        // \Veritrans_Config::$isProduction = true;
                        
    					\Veritrans_Config::$serverKey = \Yii::$app->params['vtrans_conf']['svr_key'];
    					\Veritrans_Config::$isProduction = \Yii::$app->params['vtrans_conf']['is_production'];

    					try {
    						$response = \Veritrans_VtWeb::getRedirectionUrl($transaction_data);
    					} catch (Exception $e) {
    						echo $e->getMessage();
    						
    						die();
    						//$this->redirect(\yii\helpers\Url::base());
    					}
    					
    					
    					if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 5){
                            return $this->redirect($response);
                        }
                        
                    // }
                    
        //             else{
        //                 $info = \backend\models\CustomerAddress::findOne(['customer_address_id' => $orders->customer_address_id]);
                        
        //                 $items = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
    				// 	$voucherUsed = FALSE;
                        
        //                 if(count($items) > 0){
        //                     foreach($items as $item){
                                
        //                         $productImageId = \backend\models\ProductImage::findOne(['product_id' => $item->product_id, 'cover' => 1])->product_image_id;
                                
    				// 			$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
    					
    				// 			if($orderCartRule != NULL){
    				// 				if(!$voucherUsed){
    				// 					if($item->product_quantity == 1){
    				// 						// voucher
    				// 						$details[] = array(
    				// 							"skuId" => $item->product_id . "",
    				// 							"skuName" => $item->product_name . "",
    				// 							"unitPrice" => $item->original_product_price - $orderCartRule->value,
    				// 							"qty" => $item->product_quantity,
    				// 							"img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
    				// 							"reservedField" => ""
    				// 						);								
    				// 						$voucherUsed = TRUE;
    				// 					} else {
    				// 						$details[] = array(
    				// 							"skuId" => $item->product_id . "",
    				// 							"skuName" => $item->product_name . "",
    				// 							"unitPrice" => $item->original_product_price,
    				// 							"qty" => $item->product_quantity,
    				// 							"img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
    				// 							"reservedField" => ""
    				// 						);								
    				// 					}
    									
    				// 				} else {
    				// 					$details[] = array(
    				// 						"skuId" => $item->product_id . "",
    				// 						"skuName" => $item->product_name . "",
    				// 						"unitPrice" => $item->original_product_price,
    				// 						"qty" => $item->product_quantity,
    				// 						"img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
    				// 						"reservedField" => ""
    				// 					);								
    				// 				}
    								
    				// 			} else {
    				// 				$details[] = array(
    				// 					"skuId" => $item->product_id . "",
    				// 					"skuName" => $item->product_name . "",
    				// 					"unitPrice" => $item->original_product_price,
    				// 					"qty" => $item->product_quantity,
    				// 					"img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
    				// 					"reservedField" => ""
    				// 				);
    				// 			}
    							
                                
        //                     }
        //                 }
    					
    				// 	$check_cart = \backend\models\CartRule::find()->where(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->andWhere(['description'=>'Cash Back Akulaku'])->one();
    
            
    				// 	if($orders->total_shipping_insurance != 0){
    				// 		// shipping + insurance
    				// 		$details[] = array(
    				// 			"skuId" => "0",
    				// 			"skuName" => "SHIPPING + INSURANCE",
    				// 			"unitPrice" => $orders->total_shipping + $orders->total_shipping_insurance,
    				// 			"qty" => 1,
    				// 			"img" => "",
    				// 			"reservedField" => ""
    				// 		);
    				// 	} else {
    				// 		// shipping
    				// 		$details[] = array(
    				// 			"skuId" => "0",
    				// 			"skuName" => "SHIPPING",
    				// 			"unitPrice" => $orders->total_shipping,
    				// 			"qty" => 1,
    				// 			"img" => "",
    				// 			"reservedField" => ""
    				// 		);
    				// 	}
    						
        //                 // akulaku
        //                 $params = array(
        //                     "appId" => "626809194",
        //                     "refNo" => $_SESSION['lastOrder']['order_number'],
    				// 		"userAccount" => $info->firstname . "",
        //                     "receiverName" => $info->firstname . "",
        //                     "receiverPhone" => $info->phone . "",
        //                     "province" => \backend\models\Province::findOne(['province_id' => $info->province_id])->name . "",
        //                     "city" => \backend\models\State::findOne(['state_id' => $info->state_id])->name . "",
        //                     "street" => $info->address1 . "",
        //                     "postcode" => $info->postcode . "",
    				// 		"callbackPageUrl" => "https://www.thewatch.co/user/orders",
        //                     "details" => $details
        //                 //	"extraInfo" => $extraInfo
        //                 );
                        
        //                 $akulaku = new \common\components\Akulaku();
        //                 $akulaku->setEnvironment('production');
        //                 $akulaku->setCredentials("626809194", "qeJjLw49bZkMlCAersNan2g-Ji7cQ8utPAxDoPy3hS0");
        //                 $order = $akulaku->generateOrder($params);
                        
        //                 if($order->success){
        //                     $this->redirect($akulaku->paymentEntry($_SESSION['lastOrder']['order_number']));
        //                 }
                    
        //             }
					
				} elseif ($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 6 || $_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 9) { // Payment Virtual Account & E-Wallet
					
					$valog = \backend\models\VaLog::findOne(['order_id' => $orders->reference]);
					
					if($valog != NULL){
					    if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 9){ // Payment E-Wallet
                            return $this->render('step/ordercomplete_gopay');
                        }
						return $this->render('step/ordercomplete');
					}
					
					$items = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
					$itemsDetail = array();
					
					$totalShipping = 0;
					$grandtotal = 0;
					$voucherAmount = 0;
					
					// product order
					if(count($items) > 0){
                        foreach($items as $item){
							$itemsDetail[] = array(
								"id" => $item->product_id . "",
								"name" => $item->product_name . "",
								"price" => $item->original_product_price,
								"quantity" => $item->product_quantity
							);	
                        }
                    }
					
					// voucher code 
					$orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
					
					if($orderCartRule != NULL){
						$itemsDetail[] = array(
							"id" => $orderCartRule->cart_rule_id,
							"price" => -round($orderCartRule->value),
							"quantity" => 1,
							"name" => 'discount voucher'
						);
						
						$voucherAmount = $orderCartRule->value;
					}
					
					// special promo
					if($orders->total_special_promo != 0){
                        $itemsDetail[] = array(
                            "id" => "0",
                            "price" => -round($orders->total_special_promo),
                            "quantity" => 1,
                            "name" => 'Special Promo '.$orders->specialPromo->promo_name
                        );
                       
                    }
					
					
					if($orders->total_shipping_insurance != 0){
						// shipping + insurance
						$itemsDetail[] = array(
							"id" => "0",
							"name" => "SHIPPING + INSURANCE",
							"price" => $orders->total_shipping + $orders->total_shipping_insurance,
							"quantity" => 1
						);
						
						$totalShipping = $orders->total_shipping + $orders->total_shipping_insurance;
						
					} else {
						// shipping
						$itemsDetail[] = array(
							"id" => "0",
							"name" => "SHIPPING",
							"price" => $orders->total_shipping,
							"quantity" => 1
						);
						
						$totalShipping = $orders->total_shipping;
					}
					
					$grandtotal += $orders->total_product_price;
					$grandtotal += $totalShipping;
					$grandtotal -= $voucherAmount;
					$grandtotal -= $orders->total_special_promo;
					
					$transaction_details = array(
						'order_id' => $_SESSION['lastOrder']['order_number'],
						'gross_amount' => round($grandtotal) 
					);
					
					$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
					
					$customer = \backend\models\Customer::findOne(["customer_id" => $orders->customer_id]);
					$customerAddress = \backend\models\CustomerAddress::findOne(["customer_address_id" => $orders->customer_address_id]);
					
					$billing_address = array(
						'first_name' => $customer->firstname,
						'last_name' => $customer->lastname,
						'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
						'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
						'postal_code' => $customerAddress->postcode,
						'phone' => $customerAddress->phone,
						'country_code' => 'IDN'
					);

					$shipping_address = array(
						'first_name' => $customer->firstname,
						'last_name' => $customer->lastname,
						'address' => \backend\models\CustomerAddress::findOne(["customer_id" => $customer->customer_id])->address1,
						'city' => \backend\models\State::findOne(["state_id" => $customerAddress->state_id])->name,
						'postal_code' => $customerAddress->postcode,
						'phone' => $customerAddress->phone,
						'country_code' => 'IDN'
					);

					// Populate customer's info
					$customer_details = array(
						'first_name' => $customer->firstname,
						'last_name' => $customer->lastname,
						'email' => $customer->email,
						'phone' => $customerAddress->phone,
						'billing_address' => $billing_address,
						'shipping_address' => $shipping_address
					);
					
					if(strtolower($bankName[0]) == "mandiri"){
						$transaction_data = array(
							'payment_type' => 'echannel',
							'echannel' => array(
								'bill_info1' => 'Payment For:',
								'bill_info2' => 'The Watch Co.'
							),
							'transaction_details' => $transaction_details,
							'item_details' => $itemsDetail,
							'customer_details' => $customer_details
						);
					
					} elseif(strtolower($bankName[0]) == "go-pay") {
						$transaction_data = array(
							'payment_type' => 'gopay',
							'transaction_details' => $transaction_details,
							'item_details' => $itemsDetail,
							'customer_details' => $customer_details
						);
					
					} elseif(strtolower($bankName[0]) == "bca") {
						$transaction_data = array(
							'payment_type' => 'bank_transfer',
							'bank_transfer' => array(
								'bank' => strtolower($bankName[0]),
								'va_number' => ''
							),
							'transaction_details' => $transaction_details,
							'item_details' => $itemsDetail,
							'customer_details' => $customer_details
						);
					} else {
						$transaction_data = array(
							'payment_type' => 'bank_transfer',
							'bank_transfer' => array(
								'bank' => strtolower($bankName[0])
							),
							'transaction_details' => $transaction_details,
							'item_details' => $itemsDetail,
							'customer_details' => $customer_details
						);
					}
                     
					require_once \Yii::$app->getBasePath() . '/include/Veritrans.php';
					
					// \Veritrans_Config::$serverKey = 'VT-server-Nj6-jo8mSfy6IOwGBBUGa3LA';
					// \Veritrans_Config::$isProduction = true;
                        
                    \Veritrans_Config::$serverKey = \Yii::$app->params['vtrans_conf']['svr_key'];
                    \Veritrans_Config::$isProduction = \Yii::$app->params['vtrans_conf']['is_production'];
					
					try {
						$response = \Veritrans_VtDirect::charge($transaction_data);
					} catch (Exception $e) {
						echo $e->getMessage();
						die();
						//$this->redirect(\yii\helpers\Url::base());
					}
					
					$bankName = explode(' ',trim($orders->paymentmethoddetail->payment->name_bank));
					
					if(strtolower($bankName[0]) == "go-pay") {
						
						// save transaction log from midtrans
						$valog = new \backend\models\VaLog();
						
						$valog->va_number = "";
						$valog->va_bank = $bankName[0];
						$valog->transaction_time = $response->transaction_time;
						$valog->transaction_status = $response->transaction_status;
						$valog->payment_type = $response->payment_type;
						$valog->order_id = $response->order_id;
						$valog->gross_amount = $response->gross_amount;
						$valog->payment_amounts_paid_at = '';
						$valog->payment_amounts_amount = '';
						$valog->action_qr_code_url = $response->actions[0]->url;
						$valog->action_deeplink_redirect = $response->actions[1]->url;
						$valog->action_get_status = $response->actions[2]->url;
						$valog->action_cancel = $response->actions[3]->url;
						$valog->save();
					}
					
					if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 9){
                        return $this->render('step/ordercomplete_gopay');
                    }
					
					return $this->render('step/ordercomplete');
					
					//print_r($response); die();
					
					
                } else {
                    
                    return $this->render('step/ordercomplete');
                }
                
                break;
            
            case "ordercompleteflash" :
                
                $now = date("Y-m-d H:i:s");
        
                $data = $_POST;

                if ($data) {

                }else{
                    $this->redirect(['../user/payment-complete']);
                }
                // check payment method gateway provider
                $orders = \backend\models\Orders::find()->where(['orders_id' => $data['order_id']])->one();
                $paymentGateway = $orders->paymentmethoddetail->payment->payment_gateway_company;

                if ($data['payment_method_id'] == 3 && $paymentGateway != 'VERITRANS') {
                    $customerInfo = $sessionOrder->get("customerInfo");
                    
                    $order_details = \backend\models\OrderDetail::find()->where(['orders_id'=>$orders->orders_id])->all();

                    $grandtotal = 0;
                    foreach ($order_details as $order_detail) {                                        
                        $grandtotal += $order_detail->original_product_price * $order_detail->product_quantity;
                    }
                    $order_cart_rule = \backend\models\OrderCartRule::find()->where(['orders_id'=>$orders->orders_id])->one();
                    $discountAmount = 0;
                    if($order_cart_rule != null){    
                        $discountAmount = $order_cart_rule->value;
                    }

                    $grandtotal += $orders->total_shipping;
                    $grandtotal += $orders->total_shipping_insurance;
                    $grandtotal -= round($discountAmount);
                
                    $info = \backend\models\CustomerAddress::findOne(['customer_address_id' => $orders->customer_address_id]);
                    $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $orders->carrier_cost_id]);
                   
                    $this->layout = false;
                    return $this->render('step/revieworderinstallmentflash', array("info" => $info, "shippingCost" => $shippingCost, "shippingInsurance" => $orders->total_shipping_insurance, "orders" => $orders, "grandtotal" => $grandtotal));
                } elseif ($data['payment_method_id'] == 4 && $paymentGateway != 'VERITRANS') {
                    
                    $totalAmountOrder = 0;
                    $voucherAmount = 0;
                    
                    $sessionOrder = new Session();
                    $sessionOrder->open();
                    
                    $transaction_id = $orders;
                    $items = \backend\models\OrderDetail::find()->where(['orders_id' => $transaction_id->orders_id])->all();
                    $orderCartRule = \backend\models\OrderCartRule::find()->where(['orders_id' => $transaction_id->orders_id])->one();
                    
                    if($orderCartRule != NULL){
                        $voucherAmount = $orderCartRule->value;
                    }
                    
                    foreach($items as $row){
                        $item[0] = array('weight' => $row->product_weight, 'quantity' => $row->product_quantity);
                        $weight = $weight + \common\components\Helpers::generateWeightOrder($item);
                    }

                    $products = array();
                    foreach ($items as $item) {
                        
                        $productId = \backend\models\Product::findOne(["product_id" => $item['product_id']]);
                        
                        $products[] = array(
                            'id' => $item['product_id'],
                            'name' => $item['product_name'],
                            'price' => $item['original_product_price'],
                            'type' => $productId->productCategory->product_category_name,
                            'url' => 'https://www.thewatch.co/product/' . $productId->productDetail->link_rewrite,
                            'quantity' => $item['product_quantity']
                        );
                        
                        $totalAmountOrder += $item['original_product_price'] * $item['product_quantity'];
                    }
                    
                    if($transaction_id->total_shipping_insurance != 0){
                        // shipping
                        $products[] = array(
                            'id' => 'shippingfee',
                            'name' => 'SHIPPING ' . $transaction_id->carriercost->carrier->name . ' ' . $transaction_id->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name . ' + INSURANCE',
                            'price' => $transaction_id->total_shipping + $transaction_id->total_shipping_insurance,
                            'quantity' => 1
                        );
                    } else {
                        // shipping
                        $products[] = array(
                            'id' => 'shippingfee',
                            'name' => 'SHIPPING ' . $transaction_id->carriercost->carrier->name . ' ' . $transaction_id->carriercost->carrierPackageDetail->carrierPackage->carrier_package_name,
                            'price' => $transaction_id->total_shipping,
                            'quantity' => 1
                        );
                    }
                    
                    $params_transaction_details = array(
                        'order_id' => $orders->reference,
                        'amount'   => ($totalAmountOrder + $transaction_id->total_shipping + $transaction_id->total_shipping_insurance) - $voucherAmount,
                        'items'    => $products,
                    );
                    
                    $params_billing_address = array(
                        'first_name'   => $transaction_id->customeraddress->firstname,
                        'last_name'    => $transaction_id->customeraddress->lastname,
                        'address'      => $transaction_id->customeraddress->address1,
                        'city'         => $transaction_id->customeraddress->state->name,
                        'postal_code'  => $transaction_id->customeraddress->postcode,
                        'phone'        => $transaction_id->customeraddress->phone,
                        'country_code' => "IDN",
                    );
                    
                    $params_shipping_address = array(
                        'first_name'   => $transaction_id->customeraddress->firstname,
                        'last_name'    => $transaction_id->customeraddress->lastname,
                        'address'      => $transaction_id->customeraddress->address1,
                        'city'         => $transaction_id->customeraddress->state->name,
                        'postal_code'  => $transaction_id->customeraddress->postcode,
                        'phone'        => $transaction_id->customeraddress->phone,
                        'country_code' => "IDN",
                    );
                    
                    $params_customer = array(
                        'first_name' => $transaction_id->customer->firstname,
                        'last_name'  => $transaction_id->customer->lastname,
                        'email'      => $transaction_id->customer->email,
                        'phone'      => $transaction_id->customeraddress->phone,
                    );
                    
                    $params = array(
                        'server_key'          => 'HMRFFg6e3WU5CjpNYqYN4ZygCyTa78',
                        'payment_type'        => '30_days',
                        'transaction_details' => $params_transaction_details,
                        'customer_details'    => $params_customer,
                        'billing_address'     => $params_billing_address,
                        'shipping_address'    => $params_shipping_address,
                        'push_uri'            => 'https://www.thewatch.co/payment/kredivo-response',
                        'order_status_uri'    => 'https://www.thewatch.co/user/orders',
                        'back_to_store_uri'   => 'https://www.thewatch.co/payment/kredivo-result',
                    );
                    
                    $this->redirect(\common\components\Kredivo::checkout_url($params));

                } elseif ($data['payment_method_id'] == 5) {
                    
                    $info = \backend\models\CustomerAddress::findOne(['customer_address_id' => $orders->customer_address_id]);
                    
                    $items = \backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();
                    $voucherUsed = FALSE;
                    
                    if(count($items) > 0){
                        foreach($items as $item){
                            
                            $productImageId = \backend\models\ProductImage::findOne(['product_id' => $item->product_id, 'cover' => 1])->product_image_id;
                            
                            $orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
                    
                            if($orderCartRule != NULL){
                                if(!$voucherUsed){
                                    if($item->product_quantity == 1){
                                        // voucher
                                        $details[] = array(
                                            "skuId" => $item->product_id . "",
                                            "skuName" => $item->product_name . "",
                                            "unitPrice" => $item->original_product_price - $orderCartRule->value,
                                            "qty" => $item->product_quantity,
                                            "img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
                                            "reservedField" => ""
                                        );                              
                                        $voucherUsed = TRUE;
                                    } else {
                                        $details[] = array(
                                            "skuId" => $item->product_id . "",
                                            "skuName" => $item->product_name . "",
                                            "unitPrice" => $item->original_product_price,
                                            "qty" => $item->product_quantity,
                                            "img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
                                            "reservedField" => ""
                                        );                              
                                    }
                                    
                                } else {
                                    $details[] = array(
                                        "skuId" => $item->product_id . "",
                                        "skuName" => $item->product_name . "",
                                        "unitPrice" => $item->original_product_price,
                                        "qty" => $item->product_quantity,
                                        "img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
                                        "reservedField" => ""
                                    );                              
                                }
                                
                            } else {
                                $details[] = array(
                                    "skuId" => $item->product_id . "",
                                    "skuName" => $item->product_name . "",
                                    "unitPrice" => $item->original_product_price,
                                    "qty" => $item->product_quantity,
                                    "img" => "https://www.thewatch.co/img/product/" . $productImageId . "/" . $productImageId . ".jpg",
                                    "reservedField" => ""
                                );
                            }
                            
                            
                        }
                    }
                    
                    $check_cart = \backend\models\CartRule::find()->where(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->andWhere(['description'=>'Cash Back Akulaku'])->one();
                    
                    if($orders->total_shipping_insurance != 0){
                        // shipping + insurance
                        $details[] = array(
                            "skuId" => "0",
                            "skuName" => "SHIPPING + INSURANCE",
                            "unitPrice" => $orders->total_shipping + $orders->total_shipping_insurance,
                            "qty" => 1,
                            "img" => "",
                            "reservedField" => ""
                        );
                    } else {
                        // shipping
                        $details[] = array(
                            "skuId" => "0",
                            "skuName" => "SHIPPING",
                            "unitPrice" => $orders->total_shipping,
                            "qty" => 1,
                            "img" => "",
                            "reservedField" => ""
                        );
                    }
                        
                    // akulaku
                    $params = array(
                        "appId" => "626809194",
                        "refNo" => $_SESSION['lastOrder']['order_number'],
                        "userAccount" => $info->firstname . "",
                        "receiverName" => $info->firstname . "",
                        "receiverPhone" => $info->phone . "",
                        "province" => \backend\models\Province::findOne(['province_id' => $info->province_id])->name . "",
                        "city" => \backend\models\State::findOne(['state_id' => $info->state_id])->name . "",
                        "street" => $info->address1 . "",
                        "postcode" => $info->postcode . "",
                        "callbackPageUrl" => "https://www.thewatch.co/user/orders",
                        "details" => $details
                    //  "extraInfo" => $extraInfo
                    );
                    
                    $akulaku = new \common\components\Akulaku();
                    $akulaku->setEnvironment('production');
                    $akulaku->setCredentials("626809194", "qeJjLw49bZkMlCAersNan2g-Ji7cQ8utPAxDoPy3hS0");
                    $order = $akulaku->generateOrder($params);
                    
                    if($order->success){
                        $this->redirect($akulaku->paymentEntry($orders->reference));
                    }
                    
                }else {
                    
                    return $this->redirect(['../user/payment-complete']);
                }
                
                break;
            
            case "confirmorder" :
                $now = date("Y-m-d H:i:s");

                if(isset($_SESSION['cart']) && count($_SESSION['cart']['items']) > 0){
                    
                }else{
                  return $this->redirect(\Yii::$app->params['frontendUrl']);  
                  
                } 
				
                if (isset($_POST['_csrf'])) {
                    $customerInfo = $sessionOrder->get("customerInfo");
                    $shippingMethod = $customerInfo['shippingMethod'];
                    $paymentMethod = $customerInfo['paymentMethod'];
                    $voucherInfo = $sessionOrder->get('voucherInfo');
                    
                    // check product quantity if equal zero
                    // no longer can be order if product has reach zero quantity
                    foreach ($items as $item) {
                        $productStock = \common\components\Helpers::updateProductStock($item['id'],$item['product_attribute_id'],$item['quantity']);

                        // if quantity equal zero
                        if($productStock == 'gagal' || $productStock == 'null'){ 
                            
                            // cancel order, empty current shopping cart and redirect customer into homepage
                            unset($_SESSION['cart']);
                            if(isset($voucherInfo)){
                                unset($_SESSION['voucherInfo']);
                            }
                            if(isset($customerInfo['paymentMethod'])){
                                unset($customerInfo['paymentMethod']);
                            }
                            if(isset($customerInfo['unique_code'])){
                                unset($customerInfo['unique_code']);
                            }
                            
                            // rollback product stock
                            $id_prod_stock = $item['id'];
                            $id_attr_stock = $item['product_attribute_id'];
                            foreach ($items as $item_return) {

                                if(($item_return['id'] == $id_prod_stock) && ($item_return['product_attribute_id'] == $id_attr_stock)){
                                    return $this->redirect(\Yii::$app->params['frontendUrl']);
                                }else{
                                    $productStock2 = \common\components\Helpers::returnProductStock($item_return['id'],$item_return['product_attribute_id'],$item_return['quantity']);
                                }
                            }
                        }
                    }
                    
                    $weight = \common\components\Helpers::generateWeightOrder($items);
                    
                    $total_cart_quantity = 0;
                    $total_product_price = 0;
                    $total_cart_item = 0;
                    $flash_sale_flag = 0;
                    $pre_order_flag = 0;
                    $total_shipping = 0;
                    foreach ($items as $item) {
                        $total_cart_quantity += $item['quantity'];
                        $total_product_price += $item['total_price'];
                        $total_cart_item += 1;
                        
                        if($item['flash_sale'] == 1){
                            $flash_sale_flag = 1;
                        }
                        
                        if($item['pre_order'] == 1){
                            $pre_order_flag = 1;
                        }
                    }
                    
                    if($total_cart_item == 0){
                        $this->redirect(\Yii::$app->params['frontendUrl']);
                    }
                    
                    $totalPurchase = $this->getTotalPurchase() === 0 ? 0 : (int) $this->getTotalPurchase();
                    $totalOriginalPurchase = $this->getOriginalTotalPurchase();

                    $discountAmount = 0;

                    if(isset($voucherInfo)){
                        $discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $totalPurchase);
						
						if($voucherInfo['extra_reduction_amount'] != 0 || $voucherInfo['extra_reduction_percent'] != 0){
                        
                            $totalPurchase -= $discountAmount;
                            $extraDiscountAmount = $voucherInfo['extra_reduction_percent'] == 0 ? $voucherInfo['extra_reduction_amount'] : (($voucherInfo['extra_reduction_percent'] / 100) * $totalPurchase);

                            $discountAmount += $extraDiscountAmount;
                        }
                        
                        if(isset($voucherInfo['discount'])){
                            $discountAmount = $voucherInfo['discount'];
                        }
                    }
                    
					$excludes = [[73,5], [75,12], [81,5], [82,5], [87,5], [14,5], [86,5], [88,5]];
					$excludesProduct = [4186];
                    $promo_amount = 0;
                    $special_promo_id = 0;

                    if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 8){ // payment method Vospay
						$current_date = date('Y-m-d H:i:s');
						if($current_date >= '2019-05-01 00:00:00' && $current_date <= '2019-07-31 00:00:00'){
							if( $this->isWeekend($current_date) ){
								$special_promo_id = 2;
								$special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();

								if($special_promo != null){
									if($now >= $special_promo->date_from && $now <= $special_promo->date_to){
										if(!isset($_SESSION['customerInfo'])){
											$this->redirect(\Yii::$app->params['frontendUrl']);
										}
										
										/*
										$order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
										->andWhere(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->all();
										
										$total_order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
											->andWhere(['<>','total_special_promo',0])->all();
										if(count($order_promo) == 0 && count($total_order_promo) <= 100){
											if(($total_product_price - $discountAmount) > $special_promo->promo_amount_minimum){
												$promo_amount = $special_promo->promo_amount;
												$special_promo_id = 1;
											}
										}
										*/
										
										if($special_promo->reduction_type == "percent"){
											$specialPromoAmount = ((($total_product_price - $discountAmount) * $special_promo->promo_amount) / 100);
											
											if($specialPromoAmount >= $special_promo->max_discount_amount){
												$specialPromoAmount = $special_promo->max_discount_amount;
											}
										}
										
										if(($total_product_price - $discountAmount) > $special_promo->promo_amount_minimum){
											$promo_amount = $specialPromoAmount;
										}
									}
								}
							}else{
								$special_promo_id = 9;
								$special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();

								if($special_promo != null){
									if($now >= $special_promo->date_from && $now <= $special_promo->date_to){
										if(!isset($_SESSION['customerInfo'])){
											$this->redirect(\Yii::$app->params['frontendUrl']);
										}
										
										/*
										$order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
										->andWhere(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->all();
										
										$total_order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
											->andWhere(['<>','total_special_promo',0])->all();
										if(count($order_promo) == 0 && count($total_order_promo) <= 100){
											if(($total_product_price - $discountAmount) > $special_promo->promo_amount_minimum){
												$promo_amount = $special_promo->promo_amount;
												$special_promo_id = 1;
											}
										}
										*/
										
										if($special_promo->reduction_type == "percent"){
											$specialPromoAmount = ((($total_product_price - $discountAmount) * $special_promo->promo_amount) / 100);
											
											if($specialPromoAmount >= $special_promo->max_discount_amount){
												$specialPromoAmount = $special_promo->max_discount_amount;
											}
										}
										
										if(($total_product_price - $discountAmount) > $special_promo->promo_amount_minimum){
											$promo_amount = $specialPromoAmount;
										}
									}
								}
							}
						}
                    }
					
                    if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 9){ // payment method E-Wallet

                        // if($_SESSION['customerInfo']['customer_id'] == 7614){
                            $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>3])->one();

                            if($special_promo != null){
                                if($now >= $special_promo->date_from && $now <= $special_promo->date_to){
                                    if(!isset($_SESSION['customerInfo'])){
                                        $this->redirect(\Yii::$app->params['frontendUrl']);
                                    }
                                    
                                    // check only one account per day
									$order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
                                    ->andWhere(['customer_id'=>$_SESSION['customerInfo']['customer_id']])->all();
                                    
                                    // check total transaction with promo
                                    $total_order_promo = \backend\models\Orders::find()->where(['<=','date_add',date('Y-m-d 23:59:59')])->andWhere(['>=','date_add',date('Y-m-d 00:00:00')])
                                        ->andWhere(['<>','total_special_promo',0])->all();
                                        
                                    $allow = 1;
                                    
                                    if($special_promo->product_restriction == 1){
                                        $found = 0;
                                        $special_promo_products = \backend\models\SpecialPromoProduct::find()->where(['special_promo_id'=>3])->all();
                                        foreach($items as $item){
                                            foreach($special_promo_products as $special_promo_product){
                                                if($item['id'] == $special_promo_product->product_id){
                                                    $found += 1;
                                                    break;
                                                }
                                            }
                                        }
                                        if(count($items) == $found){
                                            $allow = 1;
                                        }else{
                                            $allow = 0;
                                        }
                                    }
                                    
                                    // check restriction allowed
                                    if($allow == 1){
                                        if(count($order_promo) == 0){
                                            
                                            if($special_promo->max_transaction_per_day != 0){
                                                if(count($total_order_promo) <= $special_promo->max_transaction_per_day){
                                                    // Check reduction type for discount
                                                    if($special_promo->reduction_type == "percent"){
                										$specialPromoAmount = ((($total_product_price - $discountAmount) * $special_promo->promo_amount) / 100);
                										
                										if($specialPromoAmount >= $special_promo->max_discount_amount){
                											$specialPromoAmount = $special_promo->max_discount_amount;
                										}
                									}
                									
                									// Check minimum
                									if(($total_product_price - $discountAmount) > $special_promo->promo_amount_minimum){
                										$promo_amount = $specialPromoAmount;
                										$special_promo_id = 3;
                									}
                                                }
                                            }else{
                                                // Check reduction type for discount
                                                    if($special_promo->reduction_type == "percent"){
                										$specialPromoAmount = ((($total_product_price - $discountAmount) * $special_promo->promo_amount) / 100);
                										
                										if($specialPromoAmount >= $special_promo->max_discount_amount){
                											$specialPromoAmount = $special_promo->max_discount_amount;
                										}
                									}
                									
                									// Check minimum
                									if(($total_product_price - $discountAmount) > $special_promo->promo_amount_minimum){
                										$promo_amount = $specialPromoAmount;
                										$special_promo_id = 3;
                									}
                                            }
                                            
                                        }
                                    }
									
									
                                }
                            } 
                        // }   
                        
                    }
                    
                   
				
				   
                //BCA 10% MERDEKA NORMAL ITEM NON JEWELRY 3 && 6
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 3 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 6 && !isset($_SESSION['voucherInfo'])){ // payment method Installment BCA
                    $special_promo_id = 13;
                    if($special_promo_id==13){
                        $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
                        if($special_promo != null){
                            if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
                                if(!isset($_SESSION['customerInfo'])){
                                    $this->redirect(\Yii::$app->params['frontendUrl']);
                                }

                                $discountDiscountedItem=0;
                                
                                foreach ($items as $product) {
                                    if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
										if(!in_array($product['id'], $excludesProduct)){
                                            if ($product['isdiscount']==0 && $product['category_id']!=12) {
                                                $discountItem = 0;
                                                if(isset($product['after_voucher_merdeka_unit_price'])){
                                                    $discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
                                                }else{
                                                    $discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
                                                }

                                                $discountItem = $discountItem * $product['quantity'];
                                                
                                                $discountDiscountedItem = $discountDiscountedItem + $discountItem;
                                            }
										}
                                    }  
                                }

                                $promo_amount = $discountDiscountedItem;
                                $special_promo_id = (int)$special_promo->special_promo_id;


                                
                            }
                        }
                    }
                }

                //MANDIRI 10% MERDEKA NORMAL ITEM NON JEWELRY 3 && 7
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 3 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 7 && !isset($_SESSION['voucherInfo'])){ // payment method Installment Mandiri
					$special_promo_id = 14;
                    if($special_promo_id==14){
                        $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
                        if($special_promo != null){
                            if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
                                if(!isset($_SESSION['customerInfo'])){
                                    $this->redirect(\Yii::$app->params['frontendUrl']);
                                }

                                $discountDiscountedItem=0;
                                
                                foreach ($items as $product) {
                                    if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
										if(!in_array($product['id'], $excludesProduct)){
											if ($product['isdiscount']==0 && $product['category_id']!=12) {
												if(isset($product['after_voucher_merdeka_unit_price'])){
													$discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
												}else{
													$discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
												}
												$discountItem = $discountItem * $product['quantity'];
												$discountDiscountedItem += $discountItem;
											}  
										}
                                    }      
                                }
                                $promo_amount = $discountDiscountedItem;
                                $special_promo_id = (int)$special_promo->special_promo_id;


                                
                            }
                        }
                    }
                }

                //VOSPAY 30% MERDEKA MAX 500000 ALL ITEM 8 && 25
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 8 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 25 && !isset($_SESSION['voucherInfo'])){ // payment method Vospay
                    $special_promo_id = 15;
                    if($special_promo_id==15){
                        $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
                        if($special_promo != null){
                            if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
                                if(!isset($_SESSION['customerInfo'])){
                                    $this->redirect(\Yii::$app->params['frontendUrl']);
                                }

                                $discountDiscountedItem=0;
                                
                                foreach ($items as $product) {
                                    if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
										if(!in_array($product['id'], $excludesProduct)){
											if(isset($product['after_voucher_merdeka_unit_price'])){
												$discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
											}else{
												$discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
											}

											if($special_promo->max_discount_amount != 0 && $discountItem >= $special_promo->max_discount_amount){
												$discountItem = $special_promo->max_discount_amount;
											}
											$discountItem = $discountItem * $product['quantity'];
											$discountDiscountedItem += $discountItem;
										}
                                    }
                                    
                                }
                                $promo_amount = $discountDiscountedItem;
                                $special_promo_id = (int)$special_promo->special_promo_id;
                                                                
                            }
                        }
                    }
                }

                //AKULAKU 50% MERDEKA MAX 50000 ALL ITEM 5 & 20
                if($_SESSION['customerInfo']['paymentMethod']['payment_method_id'] == 5 && $_SESSION['customerInfo']['paymentMethod']['payment_id'] == 20 && !isset($_SESSION['voucherInfo'])){ // payment method Akulaku
                    $special_promo_id = 16;
                    if($special_promo_id==16){
                        $special_promo = \backend\models\SpecialPromo::find()->where(['special_promo_id'=>$special_promo_id])->one();
                        if($special_promo != null){
                            if($current_date >= $special_promo->date_from && $current_date <= $special_promo->date_to){
                                if(!isset($_SESSION['customerInfo'])){
                                    $this->redirect(\Yii::$app->params['frontendUrl']);
                                }

                                $discountDiscountedItem=0;
                                
                                foreach ($items as $product) {
                                    if(!in_array([$product['brand_id'], $product['category_id']], $excludes)){
										if(!in_array($product['id'], $excludesProduct)){
                                            if(isset($product['after_voucher_merdeka_unit_price'])){
                                                $discountItem = (($special_promo->promo_amount / 100) * $product['after_voucher_merdeka_unit_price']);
                                            }else{
                                                $discountItem = (($special_promo->promo_amount / 100) * $product['unit_price']);
                                            }

                                            if($special_promo->max_discount_amount != 0 && $discountItem >= $special_promo->max_discount_amount){
                                                $discountItem = $special_promo->max_discount_amount;
                                            }
                                            $discountItem = $discountItem * $product['quantity'];
                                            $discountDiscountedItem += $discountItem;
										}
                                    }
                                }
                                $promo_amount = $discountDiscountedItem;
                                $special_promo_id = (int)$special_promo->special_promo_id;
                                
                            }
                        }
                    }
                }

                    $order_number = \common\components\Helpers::generateOrderNumber();
                    
                    // echo $paymentMethod['payment_method_id'];
                    // echo $paymentMethod['payment_id'];
                    // echo \backend\models\PaymentMethodDetail::findOne(["payment_method_id" => $paymentMethod['payment_method_id'], "payment_id" => $paymentMethod["payment_id"]])->payment_method_detail_id;
                    // die();
                    $orders = new \backend\models\Orders();
                    $orders->total_special_promo = $promo_amount;
                    $orders->special_promo_id = $special_promo_id;
                    $orders->flash_sale = $flash_sale_flag;
                    $orders->pre_order = $pre_order_flag;
                    $orders->customer_id = $customerInfo["customer_id"];
                    $orders->reference = $order_number;
                    $orders->secure_key = $_POST['_csrf'];
                    $orders->customer_address_id = $shippingMethod['customer_address_id'];
                    $orders->note = $shippingMethod["note"];
                    $orders->payment_method_detail_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_id" => $paymentMethod['payment_method_id'], "payment_id" => $paymentMethod["payment_id"]])->payment_method_detail_id;
                    if($paymentMethod['payment_method_id'] == 3){
                        if($paymentMethod['installment_plan'] == 'i3m'){
                            $installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 1])->payment_method_installment_detail_id;
                        } elseif ($paymentMethod['installment_plan'] == 'i6m'){
                            $installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 2])->payment_method_installment_detail_id;
                        } elseif ($paymentMethod['installment_plan'] == 'i12m'){
                            $installmentId = \backend\models\PaymentMethodInstallmentDetail::findOne(['payment_id' => $paymentMethod['payment_id'], 'payment_method_installment_id' => 3])->payment_method_installment_detail_id;
                        }
                        
                        $orders->payment_method_installment_detail_id = $installmentId;
                    }

                    $unique_code = 0;
                    if(isset($customerInfo['unique_code'])){
                        if($paymentMethod['payment_method_id'] == 1){
                            $orders->unique_code = $customerInfo['unique_code'];
                             $unique_code = $orders->unique_code;
                        }
                        
                    }
                    
                    $carrier = \backend\models\CarrierCost::findOne($_SESSION['customerInfo']['shippingMethod']['shipping_method']);
					
					
					if($total_product_price - $discountAmount + $unique_code >= 3000000) {
						$total_shipping = 0;
			   
					} elseif($total_product_price - $discountAmount + $unique_code >= 1000000 && $total_product_price - $discountAmount + $unique_code < 3000000) { 
						// free shipping for regular shipping service
						if($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
							$total_shipping = 0;
			   
						} elseif($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
							$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;
							$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
							/*
								Free Shipping
								3 - 10 Mei
								Berlaku untuk pembelian apapun dengan minimum payment Rp 1,000,000,-
								Semua free shipping dialihkan ke service YES
							*/
							if($now >= '2019-05-03 00:00:00' && $now <= '2019-05-11 00:00:00'){
								$total_shipping = 0;
							}else{
								$total_shipping = $flatPrice * $weight;
							}
					 
						} else {
							$total_shipping = \backend\models\CarrierCost::findOne(["carrier_cost_id" => $shippingMethod['shipping_method']])->price * $weight;
				  
						}
						
					} else {
						if($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
							$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
							$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price;
							
							$total_shipping = $flatPrice * $weight;
					   
						} elseif($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
							$provinceId = \backend\models\CustomerAddress::findOne(['customer_address_id' => $_SESSION['customerInfo']['shippingMethod']['customer_address_id']])->province_id;
							$flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
							
							$total_shipping = $flatPrice * $weight;
					  
						} else {
							$total_shipping = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price * $weight;
						}
					}
					
					if(isset($_SESSION['voucherInfo']['free_shipping'])){
						if($_SESSION['voucherInfo']['free_shipping']==1){
							$total_shipping = 0;
						}
					}

                    // if customer select gift for current orders
                    if(isset($customerInfo['send_as_gift']['is_a_gift']) && $customerInfo['send_as_gift']['is_a_gift'] == 1){
                        $orders->gift = 1;
                        $orders->gift_message = $customerInfo['send_as_gift']['gift_message'];
                    }
                    
                    $orders->total_cart_item = $total_cart_item;
					$totalShippingInsurance = 0;
					//if($shippingMethod['shipping_insurance']){
					//	$totalShippingInsurance = $total_product_price - $discountAmount;
						$totalShippingInsurance = (($totalOriginalPurchase * 0.5) / 100);
						$orders->total_shipping_insurance = $totalShippingInsurance;
					//}
                    
                    $orders->total_cart_item_quantity = $total_cart_quantity;
                    $orders->total_product_price = $total_product_price;
                    $orders->date_add = date("Y-m-d H:i:s");
                    $orders->invoice_date = date("Y-m-d H:i:s");
					$orders->invoice_reminder_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +1 day'));
                    $orders->apps_language_id = 2;
                    $orders->carrier_cost_id = $shippingMethod['shipping_method'];
					$orders->total_shipping = $total_shipping;

                    $orders->save();
					
					$orderReminder = new \backend\models\OrdersReminder();
					$orderReminder->orders_id = $orders->orders_id;
					$orderReminder->orders_reminder_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +1 day'));
					$orderReminder->orders_canceled_date = date('Y-m-d H:i:s', strtotime($orders->invoice_date . ' +2 day'));
					$orderReminder->orders_reminder_status = 1;
					$orderReminder->orders_canceled_status = 1;
					
					
					$orderReminder->save();
                   
                    $order_state_lang_id = 0;
					
					$paymentMethodId = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $orders->payment_method_detail_id])->payment_method_id;
					
					$order_state_lang_id = \backend\models\OrderStateLang::findOne(["template" => "awaiting", "payment_method_id" => $paymentMethodId, "apps_language_id" => 1])->order_state_lang_id;

                    foreach ($items as $item) {
                        $reduction = empty($item['discount']) ? 0 : $item['discount'];
                        $discount = empty($item['discount_amount']) ? 0 : $item['discount_amount'];
                        $reduction_xtra = empty($item['discount_extra']) ? 0 : $item['discount_extra'];
                        $discount_extra = empty($item['discount_amount_extra']) ? 0 : $item['discount_amount_extra'];
                        $reduction_plus_xtra = empty($item['discount_plus_extra']) ? 0 : $item['discount_plus_extra'];
                        $discount_plus_extra = empty($item['discount_amount_plus_extra']) ? 0 : $item['discount_amount_plus_extra'];

                        $orders_detail = new \backend\models\OrderDetail();
                        $orders_detail->orders_id = $orders->orders_id;
                        $orders_detail->product_id = $item['id'];
                        $orders_detail->product_name = $item['name'];
                        $orders_detail->product_quantity = $item['quantity'];
                        $orders_detail->product_attribute_id = $item['product_attribute_id'];
                        $orders_detail->original_product_price = $item['unit_price'];
                        $orders_detail->reduction_percent = empty($item['disc']) ? 0 : $item['disc'];
                        $orders_detail->reduction_percent_extra = empty($item['disc_extra']) ? 0 : $item['disc_extra'];
                        // $orders_detail->reduction_percent_extra = 10;
                        $orders_detail->reduction_percent_plus_extra = empty($item['disc_plus_extra']) ? 0 : $item['disc_plus_extra'];
                        // $orders_detail->reduction_percent_plus_extra = 5;
                        $orders_detail->product_weight = \backend\models\Product::findOne(["product_id" => $item['id']])->weight;
                        
                        $specificPriceAll = \backend\models\SpecificPrice::find()->where(['product_id' => $item['id']])->all();
                        $check_discount = 0;
						$extraDiscountStartDate = '2018-10-10 00:00:00';
						$extraDiscountEndDate = '2018-10-10 23:59:59';
						
						
						
                        if($specificPriceAll != NULL && count($specificPriceAll) != 0){
							
							
                            foreach ($specificPriceAll as $specificPrice) {
                                $type = $specificPrice->reduction_type;
								
                                if($type == 'percent'){
                                    if($specificPrice->from <= $now && $specificPrice->to > $now){
										
										// if($specificPrice->description == "cybersale1010"){
											
											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
												
												if($paymentMethodId == 2){
													// $orders_detail->reduction_percent_extra = 5;
													$orders_detail->reduction_percent_extra = 0;
												}else{
													$orders_detail->reduction_percent_extra = 0;
												}
												
												$orders_detail->reduction_percent_plus_extra = 0;
											}else{
												
												if($paymentMethodId == 2){
													// $orders_detail->reduction_percent_extra = 5;
													$orders_detail->reduction_percent_extra = 0;
												}else{
													$orders_detail->reduction_percent_extra = 0;
												}
												
												$orders_detail->reduction_percent_plus_extra = 0;
											}
										// }
										
										
						
                                        $orders_detail->reduction_percent = $specificPrice->reduction;
                                        $check_discount = 1;break;
                                    }
                                } elseif($type == 'amount'){
                                    if($specificPrice->from <= $now && $specificPrice->to > $now){
										
										// if($specificPrice->description == "cybersale1010"){
											
											if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
												
												// $orders_detail->reduction_percent_extra = 10;
												$orders_detail->reduction_percent_extra = 0;
												$orders_detail->reduction_percent_plus_extra = 0;
											}else{
												$orders_detail->reduction_percent_extra = 0;
												$orders_detail->reduction_percent_plus_extra = 0;
											}
										
                                        $orders_detail->reduction_amount = $specificPrice->reduction;
                                        $check_discount = 1;break;
                                    }
                                }
                            }
                            
                            
                            $orders_detail->product_price = \backend\models\Product::findOne(["product_id" => $item['id']])->price;
                        } else {
							
							if($paymentMethodId == 2){
						
								// $orders_detail->reduction_percent_extra = 10;
								$orders_detail->reduction_percent_extra = 0;
							}else{
								$orders_detail->reduction_percent_extra = 0;
							}							
							
							$orders_detail->reduction_percent = 0;
							$orders_detail->reduction_percent_plus_extra = 0;
                            $orders_detail->product_price = $item['unit_price'];
                        }
						
						
					
						if($orders_detail->reduction_percent === NULL){
							$orders_detail->reduction_percent = 0;
							$orders_detail->reduction_percent_plus_extra = 0;
							$orders_detail->reduction_percent_extra = 0;
                        }

                        // if ($customerInfo['customer_id'] === 22764) {
                        //     die(var_dump($orders_detail));
                        // }
						 
                        $orders_detail->save();
                        
                        // create order detail history
                        $orderDetailHistory = new \backend\models\OrderDetailHistory();
                        $orderDetailHistory->orders_id = $orders->orders_id;
                        $orderDetailHistory->order_detail_id = $orders_detail->order_detail_id;
                        $orderDetailHistory->order_state_lang_id = $order_state_lang_id;
                        $orderDetailHistory->order_detail_state_lang_id = 1;
                        $orderDetailHistory->date_add = date("Y-m-d H:i:s");
						
                        $orderDetailHistory->save();
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
                    $shipping_method = $_SESSION['customerInfo']['shippingMethod']['shipping_method'];
                    
                    // if($flash_sale_flag == 0){
                        try {
                            \common\components\Helpers::sendEmailMandrillUrlAPI(
                                    $this->renderFile('@app/views/template/mail/order_placed_new.php', array(
                                        "customerInfo" => $customerInfo,
                                        "orderNumber" => $order_number,
                                        "items" => $items,
                                        "shippingCost" => $shippingCost,
    									"shippingInsurance" => $totalShippingInsurance,
                                        "shippingMethod" => $shipping_method,
                                        "weight" => $weight,
                                        "discount" => $discountAmount,
                                        "ordersId" => $orders->orders_id,
                                        "model"=> $orders,
                                    )), \Yii::$app->params['orderPlacedSubjectEmail'], \Yii::$app->params['adminEmail'], $customerInfo["email"], ''
                            );
                        } catch (Exception $ex) {
                            
                        }
                    // }
                    
                    // create last order number history session

                    $_SESSION['lastOrder'] = array(
                        "order_number" => $order_number,
                        "email" => $customerInfo["email"]
                    );
					
					
					$voucherInfo = $sessionOrder->get('voucherInfo');
					
					if(isset($voucherInfo['free_shipping'])){
						$free_shipping = $voucherInfo['free_shipping'];
					}else{
						$free_shipping = 0;
					}
					
                    if(isset($voucherInfo)){
						
						
                        
                        // save voucher history
                        $order_cart_rule = new \backend\models\OrderCartRule();
                        $order_cart_rule->orders_id = $orders->orders_id;
                        $order_cart_rule->cart_rule_id = $voucherInfo['cart_rule_id'];
                        $order_cart_rule->name = $voucherInfo['code'];
						$order_cart_rule->free_shipping = $free_shipping;
                        $order_cart_rule->value = $discountAmount;
						try{
							$order_cart_rule->save();
						}catch(Exception $e){
							if($_SESSION['customerInfo']['customer_id'] == 22764){
								// die(
									// var_dump(
										// array(
											// $voucherInfo,
											// $_SESSION['lastOrder'],
											// $orders->orders_id,
											// $voucherInfo['cart_rule_id'],
											// $voucherInfo['code'],
											// $discountAmount,
											// $free_shipping,
											// $e
											
										// )
									// )
								// );
								// exit;
								
								die("Error di save voucher history. CheckoutController->confirmorder");
								exit;
							}
						}
						
						
						
						
						
						
						
						
                        
                        // update quantity voucher code
                        $cart_rule = \backend\models\CartRule::findOne(["cart_rule_id" => $voucherInfo['cart_rule_id']]);
                        $cart_rule->quantity -= 1;
                        $cart_rule->save();
						
					
                        
                    }
					
					if($paymentMethod['payment_method_id'] != 5){
						unset($_SESSION['cart']);
						if(isset($voucherInfo)){
							unset($_SESSION['voucherInfo']);
						}
						if(isset($customerInfo['paymentMethod'])){
							unset($customerInfo['paymentMethod']);
						}
						if(isset($customerInfo['unique_code'])){
							unset($customerInfo['unique_code']);
						}
                    }
					
					$existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
                    $carts = $existingCartsMC->carts;
                    
                    if(count($carts) > 0){
                        foreach($carts as $cart){
                            if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                                $cartMC = $cart->lines;
                                
                                $cartId = $cart->id;
                                \common\components\Helpers::deleteCartMailchimp($cartId);
                            }
                        }
                        
                        \common\components\Helpers::createOrdersMailchimp($order_number, $_SESSION['customerInfo']['customer_id'], $cartMC);
                        
                    }
                    
                    // if($flash_sale_flag == 1){
                    //     return $this->redirect(['checkout/step/finishflashsale']); 
                    // }
                            
                    $total_bayar = (($orders->total_product_price+$orders->total_shipping+ $orders->total_shipping_insurance) - $orders->total_special_promo) - $discountAmount;

                    $installment = False;
                    $payments = [];
                    $payments_method_details = [61,21,20,22,82,3,7,11,12,14,15,83];
                    if($orders->payment_method_detail_id===61){
                        
                        array_push($payments, "bca_va");
                    }

                    if($orders->payment_method_detail_id===21){
                        
                        array_push($payments, "permata_va");
                    }

                    if($orders->payment_method_detail_id===20){
                        
                        array_push($payments, "bni_va");
                    }

                    if($orders->payment_method_detail_id===22){
                        
                        array_push($payments, "other_va");
                    }

                    if($orders->payment_method_detail_id===82){
                        
                        array_push($payments, "gopay");
                    }

                    if($orders->payment_method_detail_id===3){
                        
                        array_push($payments, "credit_card");
                    }

                    if($orders->payment_method_detail_id===7){
                        //INSTALLMENT MANDIRI
                        $installment = True;
                        $installment_bank = "mandiri";
                        array_push($payments, "credit_card");
                    }

                    if($orders->payment_method_detail_id==11){
                        //INSTALLMENT CIMB
                        $installment = True;
                        array_push($payments, "credit_card");
                    }

                    if($orders->payment_method_detail_id==12){
                        //INSTALLMENT DANAMON
                        $installment = True;
                        array_push($payments, "credit_card");
                    }

                    if($orders->payment_method_detail_id==14){
                        //INSTALLMENT HSBC
                        $installment = True;
                        array_push($payments, "credit_card");
                    }

                    if($orders->payment_method_detail_id==15){
                        //INSTALLMENT STANDARD CHARTERED
                        $installment = True;
                        array_push($payments, "credit_card");
                    }

                    if($orders->payment_method_detail_id==83){
                        //INSTALLMENT PANIN BANK
                        $installment = True;
                        $installment_bank = "panin";
                        array_push($payments, "credit_card");
                    }

                    if(in_array($orders->payment_method_detail_id, $payments_method_details)){
                        // var_dump($orders);
                        // die();
                        if($installment){
                            $transaction = array(
                                'transaction_details' => array(
                                    'order_id' => $orders->reference,
                                    'gross_amount' => $total_bayar  // no decimal allowed
                                ),
                                'enabled_payments' => $payments,
                                'credit_card' => array(
                                    'secure' => true,
                                    'installment' => array(
                                        'required' => true,
                                        'terms' => array(
                                            'bni' => [6, 12],
                                            'mandiri' => [3, 6, 12],
                                            'cimb' => [6, 12]
                                        )
                                    )
                                )
                            );
                        }else{
                            // var_dump($orders);
                            // die();
                            $transaction = array(
                                'transaction_details' => array(
                                    'order_id' => $orders->reference,
                                    'gross_amount' => $total_bayar  // no decimal allowed
                                ),
                                'enabled_payments' => $payments
                            );
                        }
                        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
                        return $this->render('step/confirmorder', array(
                            "snapToken" => $snapToken, "transaction" => $transaction
                        ));
                    }else{
                        return $this->redirect(['checkout/step/ordercomplete']); 
                        $this->redirect('https://www.thewatch.co/cart/checkout/step/ordercomplete');
                    }

                        
					
					
                }

                break;

            case "paymentinformation":

                
                   isset($cart) && count($items) > 0 ? '' : $this->redirect(\Yii::$app->params['frontendUrl']);

                $data = $_POST;
                // print_r($cart);die();
                if ($data) {

                    foreach ($data['paymentMethod'] as $key => $value) {
                        $_SESSION['customerInfo']['paymentMethod'][$key] = $value;
                    }
                    
                    if(isset($data['send_as_gift'])){
                        $_SESSION['customerInfo']['send_as_gift']['is_a_gift'] = $data['send_as_gift']['is_a_gift'];
                        $_SESSION['customerInfo']['send_as_gift']['gift_message'] = $data['send_as_gift']['gift_message'];
                    }

                    $response = json_encode($data
                    );

                    return $response;
                } else {
                    if(!isset($_SESSION['customerInfo'])){
                        return $this->redirect(['checkout/sign-in']);
                    }
                    if(!isset($_SESSION['customerInfo']['shippingMethod']['customer_address_id'])){
                        return $this->redirect(['checkout/step/deliveryform']); 
                    }
					
                    $paymentMethod = \backend\models\PaymentMethod::findAll(['active' => 1]);
					
                    $weight = \common\components\Helpers::generateWeightOrder($items);
                    
                    if (isset($_SESSION['customerInfo']['shippingMethod'])) {
                        $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);
                    }
                    
                    $totalPurchase = $this->getTotalPurchase();
                    
                    $shipment = \backend\models\CarrierCost::findOne($_SESSION['customerInfo']['shippingMethod']['shipping_method']);
                    
                    // if shopping total condition more than 3 milion IDR
                    // get free all shipping method service
                    $shippingCost = $_SESSION['customerInfo']['shippingMethod']['shipping_price'];
					
					$current_date = date('Y-m-d H:i:s');		
					if($current_date >= '2017-09-04 00:00:00' && $current_date <= '2017-09-08 23:59:59'){			
						$shippingCost = 0;		
					}
                    
                    $voucherInfo = $sessionOrder->get('voucherInfo');
                     
                    $discountAmount = 0;
                    
                    if(isset($voucherInfo)){
						
						$voucherCartPaymentMethod = \backend\models\CartRulePaymentMethod::findOne(['cart_rule_id' => $voucherInfo['cart_rule_id']]);
						
						if($voucherCartPaymentMethod != NULL){
							$paymentMethod = \backend\models\PaymentMethod::findAll(['active' => 1, 'payment_method_id' => $voucherCartPaymentMethod->payment_method_id]);
						}
						
                        $discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $totalPurchase);
						
						if($voucherInfo['extra_reduction_amount'] != 0 || $voucherInfo['extra_reduction_percent'] != 0){
                        
                            $totalPurchase -= $discountAmount;
                            $extraDiscountAmount = $voucherInfo['extra_reduction_percent'] == 0 ? $voucherInfo['extra_reduction_amount'] : (($voucherInfo['extra_reduction_percent'] / 100) * $totalPurchase);

                            $discountAmount += $extraDiscountAmount;
                        }
                    }
                    if(isset($voucherInfo['discount'])){
                        $discountAmount = $voucherInfo['discount'];
                    }

                    

                    return $this->render('step/paymentinformation', array(
                        "paymentMethod" => $paymentMethod, 
                        "shippingCost" => $shippingCost,
                        "discount" => $discountAmount
                    ));
                }

                break;

            case "deliveryform":

                isset($cart) && count($items) > 0 ? '' : $this->redirect(\Yii::$app->params['frontendUrl']);

                $province = \backend\models\Province::findAll(['active' => 1, "country_id" => 111]);

                return $this->render('step/deliveryform', array("provinces" => $province));

                break;

            case "revieworder":

                isset($cart) && count($items) > 0 ? '' : $this->redirect(\Yii::$app->params['frontendUrl']);

                $customerInfo = $sessionOrder->get("customerInfo");

                if (isset($customerInfo['shippingMethod'])) {
                    $info = \backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']]);
                    $shippingCost = \backend\models\CarrierCost::findOne(['carrier_cost_id' => $_SESSION['customerInfo']['shippingMethod']['shipping_method']]);
                    
                    $weight = \common\components\Helpers::generateWeightOrder($items);
                }
                
                $totalPurchase = $this->getTotalPurchase();
                
                $voucherInfo = $sessionOrder->get('voucherInfo');
                    
                $discountAmount = 0;

                if(isset($voucherInfo)){
                    $discountAmount = $voucherInfo['reduction_percent'] == 0 ? $voucherInfo['reduction_amount'] : (($voucherInfo['reduction_percent'] / 100) * $totalPurchase);
                }
                
                return $this->render('step/revieworder', array(
                    "info" => $info, 
                    "shippingCost" => $shippingCost, 
                    "weight" => $weight,
                    "discount" => $discountAmount
                ));

                break;

            case "installment":

                return $this->render('step/installment');

                break;

            case "deliveryinformation":
                $total_purchase = $this->getTotalPurchase();
                if ( $total_purchase <= 0 ) 
                {
                    $this->redirect(\Yii::$app->homeUrl);
                    session_destroy();
                }

                $data = $_POST;

                if ($data && isset($_POST['_csrf'])) {

                    $customerInfo = $sessionOrder->get("customerInfo");
                    
                    // if shipping information not exist
                    if (!isset($customerInfo['shippingInformation'])) {
                        
                        // write session value
                        foreach ($data as $key => $value) {
                            $_SESSION['customerInfo']['shippingInformation'][0][$key] = $value;
                        }
                        
                        // if new customer 
                        if (!isset($customerInfo['customer_id'])) {
                            $customer = new \backend\models\Customer();
                            $customer->firstname = $data['fname'];
                            $customer->lastname = $data['lname'];
                            $customer->email = $_SESSION['customerInfo']['email'];
                            $customer->passwd = md5($customerInfo['password']);

                            $customer->save();

                            $_SESSION['customerInfo']['customer_id'] = $customer->customer_id;

                            $customerAddress = new \backend\models\CustomerAddress();

                            $customerAddress->customer_id = $customer->customer_id;
                            $customerAddress->country_id = 111; // sementara hardcode dulu 111 = indonesia //bodo amat bgst kesementaraan lu terjadi selamanya
                            $customerAddress->province_id = $data['province_id'];
                            $customerAddress->state_id = $data['state_id'];
                            $customerAddress->district_id = $data['district_id'];
                            $customerAddress->firstname = $data['fname'];
                            $customerAddress->lastname = $data['lname'];
                            $customerAddress->address1 = $data['address'];
                            $customerAddress->postcode = $data['zip'];
                            $customerAddress->phone = $data['phone'];
                            $customerAddress->active = 1;

                            $customerAddress->save();

                            $_SESSION['customerInfo']['shippingInformation'][0]['customer_address_id'] = $customerAddress->customer_address_id;
                            $_SESSION['customerInfo']['shippingInformation'][0]['email'] = $customerInfo['email'];
                            
                            $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
                            
                        } else {
                            
                            // if existing customer add new shipping address
                            $customerAddress = new \backend\models\CustomerAddress();

                            $customerAddress->customer_id = $_SESSION['customerInfo']['customer_id'];
                            $customerAddress->country_id = 111; // sementara hardcode dulu 111 = indonesia
                            $customerAddress->province_id = $data['province_id'];
                            $customerAddress->state_id = $data['state_id'];
                            $customerAddress->district_id = $data['district_id'];
                            $customerAddress->firstname = $data['fname'];
                            $customerAddress->lastname = $data['lname'];
                            $customerAddress->address1 = $data['address'];
                            $customerAddress->phone = $data['phone'];
                            $customerAddress->postcode = $data['zip'];
                            $customerAddress->active = 1;

                            $customerAddress->save();

                            $_SESSION['customerInfo']['shippingInformation'][0]['customer_address_id'] = $customerAddress->customer_address_id;
                            
                            $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
                        }
                    } else {

                        // create new shipping address if shipping information already exist

                        $count = count($_SESSION['customerInfo']['shippingInformation']);

                        $customerAddress = new \backend\models\CustomerAddress();
                        $customerAddress->customer_id = \backend\models\Customer::findOne(["email" => $customerInfo['email']])->customer_id;
                        $customerAddress->country_id = 111; // sementara hardcode dulu 111 = indonesia
                        $customerAddress->province_id = $data['province_id'];
                        $customerAddress->state_id = $data['state_id'];
                        $customerAddress->district_id = $data['district_id'];
                        $customerAddress->firstname = $data['fname'];
                        $customerAddress->lastname = $data['lname'];
                        $customerAddress->address1 = $data['address'];
                        $customerAddress->phone = $data['phone'];
                        $customerAddress->postcode = $data['zip'];
                        $customerAddress->active = 1;

                        $customerAddress->save();

                        foreach ($data as $key => $value) {
                            $_SESSION['customerInfo']['shippingInformation'][$count][$key] = $value;
                        }

                        $_SESSION['customerInfo']['shippingInformation'][$count]['customer_address_id'] = $customerAddress->customer_address_id;
                        $_SESSION['customerInfo']['shippingInformation'][$count]['email'] = $customerInfo['email'];
                        
                        $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
                    }

                } else {

                    $province = \backend\models\Province::findAll(['active' => 1, "country_id" => 111]);

                    $customerInfo = $sessionOrder->get("customerInfo");

                    if (isset($customerInfo['shippingInformation'])) {
                        $shippingMethodName = isset($_SESSION['customerInfo']['shippingInformation'][0]['shipping_method_id']) ? $_SESSION['customerInfo']['shippingInformation'][0]['shipping_method_id'] : '';
                        return $this->render('step/deliverylist', array("shippingInformation" => $customerInfo['shippingInformation'], "shippingMethodName" => $shippingMethodName));
                    }

                    return $this->render('step/deliveryform', array("provinces" => $province));
                }

                break;
                
            case "finishflashsale":

                return $this->render('step/ordercomplete_flashsale');

                break;

            default : break;
        }
    }

    /*
     * @return integer total purchase
     */
    private function getTotalPurchase(){
        $sessionOrder = new Session();
        $sessionOrder->open();
        $cart = $sessionOrder->get("cart");
        
        $grandTotal = 0;
        $items = $cart['items'];
        if(count($items) > 0) {    
            foreach($items as $item) {
                $grandTotal += $item['total_price'];
            }
        }
        
        return $grandTotal;
    }
    
    /*
     * @return integer total original purchase
     */
    private function getOriginalTotalPurchase(){
        $sessionOrder = new Session();
        $sessionOrder->open();
        $cart = $sessionOrder->get("cart");
        
        $grandTotal = 0;
        $items = $cart['items'];
        if(count($items) > 0) {    
            foreach($items as $item) {
                $grandTotal += $item['original_total_price'];
            }
        }
        
        return $grandTotal;
    }
    
    public function actionShippingSubmit() {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $customerInfo = $sessionOrder->get("customerInfo");

        $_SESSION['customerInfo']['shippingMethod']['note'] = $_POST['note'];
        $_SESSION['customerInfo']['shippingMethod']['customer_address_id'] = $_POST['customer_address_id'];
        $_SESSION['customerInfo']['shippingMethod']['shipping_method'] = $_POST['shipping_method'];

        return;
    }

     public function actionShippingmethod() {
		
        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");

        $grandTotal = $this->getTotalPurchase();
        $grandOriginalTotal = $this->getOriginalTotalPurchase();
       
            $discount = 0;
            $discountAmount = 0;
            $total = 0;

        if($sessionOrder->get("voucherInfo") != null){
					
			$voucher = $sessionOrder->get("voucherInfo");
			
            if($voucher['reduction_amount'] != 0){
                $discount = \common\components\Helpers::getPriceFormat($voucher['reduction_amount']);
                $discountAmount = $voucher['reduction_amount'];
            }
            
            // if promo is reduction percent
            if($voucher['reduction_percent'] != 0){
                $discount = \common\components\Helpers::getPriceFormat(($voucher['reduction_percent'] / 100) * $grandTotal);
                $discountAmount = (($voucher['reduction_percent'] / 100) * $grandTotal);
            }
            
            $grandTotal = $grandTotal - $discountAmount;
        }
        
        $items = $cart['items'];

        $weight = \common\components\Helpers::generateWeightOrder($items);

        $shippingPrice = 0;

        $carrier_cost = CarrierCost::findOne(['carrier_cost_id' => $_POST['id_select']]);
        $carrier_package_detail = CarrierPackageDetail::findOne(['carrier_package_detail_id' => $carrier_cost->carrier_package_detail_id]);
        $district = District::findOne(['district_id' => $carrier_cost->district_id]);
        $state = State::findOne(['state_id' => $district->state_id]);

        if($grandTotal >= 3000000) { 
                                        
        } elseif($grandTotal >= 1000000 && $grandTotal < 3000000) { 
			// free shipping for regular shipping service
			if($carrier_cost->carrier_package_detail_id == 1){
				
			} elseif($carrier_cost->carrier_package_detail_id == 3){ 
				$carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
				$shippingPrice = $carrier_cost_flat_price->price * $weight;
			} else {
				$carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
				$shippingPrice = $carrier_cost_flat_price->price * $weight;
			}
        } elseif($grandTotal < 1000000){
			$carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
			$shippingPrice = $carrier_cost_flat_price->price * $weight;
		}else {
			$carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
			$shippingPrice = $carrier_cost_flat_price->price * $weight;
		}			
                                    																	// hari pelanggan nasional free shipping		
        $current_date = date('Y-m-d H:i:s');		
		
		
		if($current_date >= '2017-09-04 00:00:00' && $current_date <= '2017-09-08 23:59:59'){			$shippingPrice = 0;		}
        $_SESSION['customerInfo']['shippingMethod']['shipping_price'] = $shippingPrice;
        $_SESSION['customerInfo']['shippingMethod']['customer_address_id'] = $_POST['customer_address_id'];
        $_SESSION['customerInfo']['shippingMethod']['shipping_method'] = $_POST['shipping_method'];
		
		if(isset($_POST['shipping_insurance'])){
			$shippingInsurance = 0;
			if($_POST['shipping_insurance']){
				$shippingInsurance = (($grandOriginalTotal * 0.5) / 100);
			}
			
			$_SESSION['customerInfo']['shippingMethod']['shipping_insurance'] = 1;
		}
		
        $discountAmount = 0;
        if(isset($_SESSION['voucherInfo'])){
            if($_SESSION['voucherInfo']['reduction_amount'] != 0){
                $discount = \common\components\Helpers::getPriceFormat($voucher->reduction_amount);
                $discountAmount = $voucher->reduction_amount;
            }
            
            // if promo is reduction percent
            if($_SESSION['voucherInfo']['reduction_percent'] != 0){
                $discount = \common\components\Helpers::getPriceFormat(($voucher->reduction_percent / 100) * $totalPurchase);
                $discountAmount = (($voucher->reduction_percent / 100) * $totalPurchase);
            }
        }
        $total_item_for_ship = 1;
        if(count($items) > 2){
            $total_item_for_ship = ceil(count($items) / 2);
        }
		if($voucher['free_shipping'] == 1){
			$shippingPrice = 0;
        }
        
        $now = date('Y-m-d H:i:s');
        if($grandTotal >= 1000000 && $now <= '2019-05-10 23:59:59') {
            $total =  ($grandTotal - $discountAmount) + ($shippingInsurance);
            $shippingPrice = 0;
        }else{
            $total =  ($grandTotal - $discountAmount) + (($total_item_for_ship * $shippingPrice) + $shippingInsurance);
        }
        
        $response = json_encode(array(
					"price" => $shippingPrice,
					"total_item" => $total_item_for_ship,
					"diskon" => $discountAmount,
					"grandTotal" => $grandTotal,
                    "valid" => true,
                    "shipping_price" => \common\components\Helpers::getPriceFormat(($total_item_for_ship * $shippingPrice) + $shippingInsurance),
					"shipping_insurance" => \common\components\Helpers::getPriceFormat($shippingInsurance),
                    "total" => \common\components\Helpers::getPriceFormat($total),
                    "currency" => 'IDR'
                ));
                
                return $response;
    }

	public function actionSignIn() {
        $data = $_POST;
		if(isset($_SESSION['cart']) || isset($_SESSION['cart']['items'])){
			
		}else{
			$this->redirect(\yii\helpers\Url::base());
		}			

        $sessionOrder = new Session();
        $customerInfo = $sessionOrder->get("customerInfo");
		
        // if session exist
        if ($customerInfo != NULL) {
            $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
        }else{
            if (!empty($data)) {

                $customer = \backend\models\Customer::find()
                        ->joinWith(["gender", "customerGroup"])
                        ->where(["email" => $data['email'], 'passwd' => md5($data['password'])])
                        ->one();

                if (!$customer) {
                    return false;
                }

                // create new customer info session
                $_SESSION['customerInfo']['customer_id'] = $customer->customer_id;
                $_SESSION['customerInfo']['fname'] = $customer->firstname;
                $_SESSION['customerInfo']['lname'] = $customer->lastname;
                $_SESSION['customerInfo']['email'] = $customer->email;
                $_SESSION['customerInfo']['birthday'] = $customer->birthday;
                $_SESSION['customerInfo']['gender'] = $customer->gender_id === '0' ? 0 : $customer->gender->name;
                $_SESSION['customerInfo']['group'] = $customer->customerGroup->name;
                $_SESSION['customerInfo']['subscribe_newsletter'] = $customer->newsletter;

                $shippingInformation = \backend\models\CustomerAddress::find()
                        ->where(["customer_id" => $customer->customer_id])
                        ->all();

                $i = 0;
                // create new customer shipping information session
                if (count($shippingInformation) > 0) {
                    foreach ($shippingInformation as $shipping) {
                        $_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] = $shipping->customer_address_id;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['fname'] = $shipping->firstname;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['lname'] = $shipping->lastname;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['email'] = $customer->email;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['address'] = $shipping->address1;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['other_address'] = $shipping->address2;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['phone'] = $shipping->phone;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['phone_mobile'] = $shipping->phone_mobile;
                        $_SESSION['customerInfo']['shippingInformation'][$i]['postcode'] = $shipping->postcode;
                        $i++;
                    }
                }
                
                $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
                $carts = $existingCartsMC->carts;
                
                if(count($carts) > 0){
                    foreach($carts as $cart){
                        if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                            // unset existing cart
                            unset($_SESSION['cart']);
                            
                            $cartMC = $cart->lines;
                        }
                    }
                    
                    // write existing cart session in mailchimp
                    \common\components\Helpers::createCartSession($_SESSION['customerInfo']['customer_id'], $cartMC);
                }

                $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
            } else {
                return $this->render('signin');
            }
        }
    }
	
    public function actionSignUp() {
        $data = $_POST;

        if ($data) {

            $customer = \backend\models\Customer::find()
                    ->where(["email" => $data['customerInfo']['email']])
                    ->one();

            // if email already exist
            if ($customer) {
                echo 'FALSE';
                return;
            }

            $signup = new \backend\models\Customer();
            $signup->email = $data['customerInfo']['email'];
            $signup->firstname = $data['customerInfo']['fname'];
            $signup->lastname = $data['customerInfo']['lname'];
            $signup->phone_number = $data['customerInfo']['phone'];
            $signup->passwd = md5($data['customerInfo']['password']);
            $signup->apps_language_id = 1;
            $signup->active = 1;

            try {

                $signup->save();

                \common\components\Helpers::sendEmailMandrillUrlAPI(
                        $this->renderFile('@app/views/template/mail/signup.php', array(
                            "username" => $data['customerInfo']['email'],
                            "password" => $data['customerInfo']['password']
                        )), \Yii::$app->params['signupSubjectEmail'], \Yii::$app->params['adminEmail'], $data['customerInfo']['email'], ''
                );
                
                $order = new CustomerForm();
                $data['customerInfo']['customer_id'] = $signup->customer_id;
                $order->create($data);
				
				// register new customer in mailchimp
                \common\components\Helpers::registerCustomerMailchimp($signup->customer_id);
                
                if(isset($_COOKIE['voucher_name'])){
                    if($_COOKIE['voucher_name'] == 'chinese_new_year' && isset($_COOKIE['voucher_id'])){
                        // Yii::$app->db->createCommand()
                        //  ->update('cart_rule', ['code' => $_COOKIE['voucher_code']], 'customer_id =')
                        //  ->execute();
    
                        $cart_rule = \backend\models\CartRule::findOne(['cart_rule_id'=>$_COOKIE['voucher_id']]);
                        $cart_rule->customer_id = $signup->customer_id;
                        $cart_rule->save();
                    }
                }

                return 'TRUE';
            } catch (Exception $ex) {
//                print_r(\Yii::info());
                //die();
                return 'FALSE';
            }
            
            
            
            return TRUE;
//            print_r($_SESSION);
        } else {
            return $this->render('signin');
        }
    }

    public function actionEditquantity() {
        session_start();
        
        $product_id = $_SESSION['cart']['items'][$_POST['count_id']]['id'];
        $product_attribute_id = $_SESSION['cart']['items'][$_POST['count_id']]['product_attribute_id'];
        
        // check if customer update quantity in current shopping cart
        if(isset($_SESSION['cart']['items'][$_POST['count_id']]['productFreeCampaign'])){
            $error[0] = 'overload';
            return json_encode($error);
        }
        
        // check if customer update quantity in bundling product current shopping cart
        if(isset($_SESSION['cart']['items'][$_POST['count_id']]['productBundlingCampaign'])){
            $error[0] = 'overload';
            return json_encode($error);
        }

        $stock_available = \backend\models\ProductStock::find()->where(['product_id' => $product_id, 'product_attribute_id' => $product_attribute_id])->one();

        if ($_POST['action'] == 'plus') {
            if ($stock_available['quantity'] < $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] + 1) {
                $error[0] = 'overload';
                return json_encode($error);
            }
            $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] = $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] + 1;
        } elseif ($_POST['action'] == 'minus') {
            if ($stock_available['quantity'] < $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] - 1) {
                $value[3] = "overload_minus";
                $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] = $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] - 1;
            } elseif ($_SESSION['cart']['items'][$_POST['count_id']]['quantity'] - 1 == 0) {
                $error[0] = "minus";
                return json_encode($error);
            } else {
                $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] = $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] - 1;
            }
        }

        $_SESSION['cart']['items'][$_POST['count_id']]['total_price'] = $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] * $_SESSION['cart']['items'][$_POST['count_id']]['unit_price'];

        $items = $_SESSION['cart']['items'];
        $total = 0;
        $original_total = 0;

        foreach ($items as $row) {
            $total = $total + $row['total_price'];
            $original_total = $original_total + $row['original_total_price'];
        }
        $sessionOrder = new Session();

        $customerInfo = $sessionOrder->get("customerInfo");
        $shippingPrice = 0;
       
        $weight = \common\components\Helpers::generateWeightOrder($items);

        if(isset($_SESSION['customerInfo']['shippingMethod']['shipping_price'])){
            // $shippingPrice = $_SESSION['customerInfo']['shippingMethod']['shipping_price'];

            $carrier_cost = \backend\models\CarrierCost::find()->where(['carrier_cost_id'=>$_SESSION['customerInfo']['shippingMethod']['shipping_method']])->one();
            $carrier_package_detail = CarrierPackageDetail::findOne(['carrier_package_detail_id' => $carrier_cost->carrier_package_detail_id]);
            $district = District::findOne(['district_id' => $carrier_cost->district_id]);
        $state = State::findOne(['state_id' => $district->state_id]);
            if($total >= 3000000) { 
                $shippingPrice = 0;                        
            } elseif($total >= 1000000 && $total < 3000000) { 
                                            // free shipping for regular shipping service
                                            if($carrier_cost->carrier_package_detail_id == 1){
                                                
                                            } elseif($carrier_cost->carrier_package_detail_id == 3){ 
                                                $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                                $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                            } else {
                                                $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                                $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                            }
            } elseif($total < 1000000){
                                        $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                        $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                    }else {
                                        $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                         $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                    }

        }

        $_SESSION['customerInfo']['shippingMethod']['shipping_price'] = $shippingPrice;
        
        $shippingInsurance = (($original_total * 0.5) / 100);

        $value[0] = $_SESSION['cart']['items'][$_POST['count_id']]['quantity'];
        $value[1] = \common\components\Helpers::getPriceFormat($_SESSION['cart']['items'][$_POST['count_id']]['total_price']);
        $value[2] = \common\components\Helpers::getPriceFormat($total);
        $value[4] = \common\components\Helpers::getPriceFormat($shippingPrice + $shippingInsurance);

        
        // remove voucher information for every time customer update shopping cart
        if(isset($_SESSION['voucherInfo'])){
            unset($_SESSION['voucherInfo']);
        }
		
		if (isset($_SESSION['customerInfo'])){
            
            // check if customer already in existing cart in mailchimp
            $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $sessionItems = $_SESSION['cart']['items'];
            
            if(count($carts) > 0){
                foreach($carts as $cart){
                    // update existing cart if customer email match
                    if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                        // remove existing cart and re-create new cart
                        $cartId = $cart->id;
                        \common\components\Helpers::deleteCartMailchimp($cartId);
                    }
                }
                
                \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
                
            } else {
                \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
            }
        }
                            

        return json_encode($value);
    }
    
    public function actionEditquantitymobile(){
        session_start();
        
        // check if customer has update quantity in current shopping cart
        if(isset($_SESSION['cart']['items'][$_POST['count_id']]['productFreeCampaign'])){
            return;
        }
        
        // check if customer update quantity in bundling product current shopping cart
        if(isset($_SESSION['cart']['items'][$_POST['count_id']]['productBundlingCampaign'])){
            return;
        }
        
        $_SESSION['cart']['items'][$_POST['count_id']]['quantity'] = $_POST['qty'];
        $_SESSION['cart']['items'][$_POST['count_id']]['total_price'] = $_POST['qty'] * $_SESSION['cart']['items'][$_POST['count_id']]['unit_price'];
        
        $items = $_SESSION['cart']['items'];
        $total = 0;
        $original_total = 0;
        
        foreach ($items as $row) {
            $total = $total + $row['total_price'];
            $original_total = $original_total + $row['original_total_price'];
        }
        $sessionOrder = new Session();
        $customerInfo = $sessionOrder->get("customerInfo");
        $shippingPrice = 0;
         $weight = \common\components\Helpers::generateWeightOrder($items);

        if(isset($_SESSION['customerInfo']['shippingMethod']['shipping_price'])){
            // $shippingPrice = $_SESSION['customerInfo']['shippingMethod']['shipping_price'];

            $carrier_cost = \backend\models\CarrierCost::find()->where(['carrier_cost_id'=>$_SESSION['customerInfo']['shippingMethod']['shipping_method']])->one();
            $carrier_package_detail = CarrierPackageDetail::findOne(['carrier_package_detail_id' => $carrier_cost->carrier_package_detail_id]);
            $district = District::findOne(['district_id' => $carrier_cost->district_id]);
        $state = State::findOne(['state_id' => $district->state_id]);
            if($total >= 3000000) { 
                $shippingPrice = 0;                        
            } elseif($total >= 1000000 && $total < 3000000) { 
                                            // free shipping for regular shipping service
                                            if($carrier_cost->carrier_package_detail_id == 1){
                                                
                                            } elseif($carrier_cost->carrier_package_detail_id == 3){ 
                                                $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                                $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                            } else {
                                                $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                                $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                            }
            } elseif($total < 1000000){
                                        $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                        $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                    }else {
                                        $carrier_cost_flat_price = CarrierCostFlatPrice::findOne(['province_id' => $state->province_id,'carrier_package_id' => $carrier_package_detail->carrier_package_id]);
                                         $shippingPrice = $carrier_cost_flat_price->price * $weight;
                                    }

        }

        $_SESSION['customerInfo']['shippingMethod']['shipping_price'] = $shippingPrice;
        
        $shippingInsurance = (($original_total * 0.5) / 100);

//        $value[0] = \common\components\Helpers::getPriceFormat($_SESSION['cart']['items'][$_POST['count_id']]['total_price']);
                                    $value[0] = $_SESSION['cart']['items'][$_POST['count_id']]['quantity'];
        $value[1] = \common\components\Helpers::getPriceFormat($_SESSION['cart']['items'][$_POST['count_id']]['total_price']);
        $value[2] = \common\components\Helpers::getPriceFormat($total);
        $value[4] = \common\components\Helpers::getPriceFormat($shippingPrice + $shippingInsurance);
        
        // remove voucher information for every time customer update shopping cart
        if(isset($_SESSION['voucherInfo'])){
            unset($_SESSION['voucherInfo']);
        }
		
		if (isset($_SESSION['customerInfo'])){
            
            // check if customer already in existing cart in mailchimp
            $existingCartsMC = \common\components\Helpers::getMailchimpExistingCarts();
            $carts = $existingCartsMC->carts;
            $sessionItems = $_SESSION['cart']['items'];
            
            if(count($carts) > 0){
                foreach($carts as $cart){
                    // update existing cart if customer email match
                    if($cart->customer->email_address == $_SESSION['customerInfo']['email']){
                        // remove existing cart and re-create new cart
                        $cartId = $cart->id;
                        \common\components\Helpers::deleteCartMailchimp($cartId);
                    }
                }
                
                \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
                
            } else {
                \common\components\Helpers::addToCartMailchimp($sessionItems, $_SESSION['customerInfo']);
            }
        }
        
        return json_encode($value);
    }

    public function actionCheckinstallment() {
        $id = $_POST['id'];
        $available_installment = \backend\models\PaymentMethodInstallmentDetail::find()->where(['payment_id' => $id])->all();
        $text = '<option value = "0" selected>MONTH</option>';

        if (!empty($available_installment)) {
            foreach ($available_installment as $row) {
                $text = $text . '<option value = "' . $row->paymentMethodInstallment->payment_method_installment_code . '">' . $row->paymentMethodInstallment->payment_method_installment_name . '</option>';
            }
        }

        return $text;
    }

    public function actionEditaddress($id) {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : '';
        isset($cart) && count($items) > 0 ? '' : $this->redirect(\Yii::$app->params['frontendUrl']);

        if (isset($_POST['address'])) {
            $data = $_POST['address'];
            $customerAddress = \backend\models\CustomerAddress::findOne($id);
            if (!empty($customerAddress)) {
                $customerAddress->firstname = $data['fname'];
                $customerAddress->lastname = $data['lname'];
                $customerAddress->phone = $data['phone'];
                $customerAddress->address1 = $data['address1'];
                $customerAddress->postcode = $data['zip'];
                $customerAddress->province_id = $data['province'];
                $customerAddress->state_id = $_POST['state_id'];
                $customerAddress->district_id = $_POST['district_id'];
                $customerAddress->save();

                for ($i = 0; $i < count($_SESSION['customerInfo']['shippingInformation']); $i++) {
                    if ($_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] == $id) {
                        $_SESSION['customerInfo']['shippingInformation'][$i]['fname'] = $data['fname'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['lname'] = $data['lname'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['address'] = $data['address1'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['phone'] = $data['phone'];
                        $_SESSION['customerInfo']['shippingInformation'][$i]['postcode'] = $data['zip'];
                        break;
                    }
                }

                $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
            }
        } else {
            $check_address = \backend\models\CustomerAddress::findOne($id);
            if (!empty($check_address)) {
                $province = \backend\models\Province::findAll(['active' => 1, "country_id" => 111]);
                return $this->render('step/deliveryform_edit', array("provinces" => $province, 'customerAddress' => $check_address));
            } else {
                $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
            }
        }
    }

    public function actionDeleteaddress($id) {
        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : '';
        isset($cart) && count($items) > 0 ? '' : $this->redirect(\Yii::$app->params['frontendUrl']);

        if ($id != 0) {
            $customer_address = \backend\models\CustomerAddress::findOne($id);
            if (!empty($customer_address)) {
                $customer_address->delete();

                for ($i = 0; $i < count($_SESSION['customerInfo']['shippingInformation']); $i++) {
                    if ($_SESSION['customerInfo']['shippingInformation'][$i]['customer_address_id'] == $id) {
                        unset($_SESSION['customerInfo']['shippingInformation'][$i]);
                        break;
                    }
                }
                $_SESSION['customerInfo']['shippingInformation'] = array_values($_SESSION['customerInfo']['shippingInformation']);
            }
        }

        if (count($_SESSION['customerInfo']['shippingInformation']) == 0) {
            unset($_SESSION['customerInfo']['shippingInformation']);
            $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryform");
        } else {
            $this->redirect(\yii\helpers\Url::base()."/cart/checkout/step/deliveryinformation");
        }
    }

    public function actionGetShippingList($id) {

        if ($id != 3) {
            $paymentMethod = \backend\models\PaymentMethodDetail::findAll(['payment_method_id' => $id]);
            return $this->renderFile('@app/modules/cart/views/checkout/payment/paymentlist.php', array("paymentMethod" => $paymentMethod));
        } else {
            $paymentMethod = \backend\models\PaymentMethodInstallmentDetail::find()->groupBy('payment_id')->all();
            return $this->renderFile('@app/modules/cart/views/checkout/payment/paymentlist_installment.php', array("paymentMethod" => $paymentMethod));
        }
    }

    public function actionShippingprice($id) {

        if ($id != 3) {
            $paymentMethod = \backend\models\PaymentMethodDetail::findAll(['payment_method_id' => $id]);
            return $this->renderFile('@app/modules/cart/views/checkout/payment/paymentlist.php', array("paymentMethod" => $paymentMethod));
        } else {
            $paymentMethod = \backend\models\PaymentMethodInstallmentDetail::find()->groupBy('payment_id')->all();
            return $this->renderFile('@app/modules/cart/views/checkout/payment/paymentlist_installment.php', array("paymentMethod" => $paymentMethod));
        }
    }
    
    public function actionCheckstock() {

        $data = $_POST;
        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : '';
         // check product quantity if equal zero
                    // no longer can be order if product has reach zero quantity
        foreach ($items as $item) {
            $productStock = \common\components\Helpers::updateProductStock($item['id'],$item['product_attribute_id'],$item['quantity']); 
                        // if($productStock != 'berhasil'){
                        //     return $this->redirect(Yii::$app->params['frontendUrl']);
                        // }

                        // $productStock = \common\components\Helpers::getProductStock($item['id'],$item['product_attribute_id'],$item['quantity']);

                        // if quantity equal zero
            if($productStock == 'gagal' || $productStock == 'null'){ 

                            // cancel order, empty current shopping cart and redirect customer into homepage
                unset($_SESSION['cart']);
                if(isset($voucherInfo)){
                    unset($_SESSION['voucherInfo']);
                }
                if(isset($_SESSION['customerInfo']['paymentMethod'])){
                    unset($_SESSION['customerInfo']['paymentMethod']);
                }
                if(isset($_SESSION['customerInfo']['unique_code'])){
                    unset($_SESSION['customerInfo']['unique_code']);
                }

                // rollback product stock
                $id_prod_stock = $item['id'];
                $id_attr_stock = $item['product_attribute_id'];
                foreach ($items as $item_return) {

                    if(($item_return['id'] == $id_prod_stock) && ($item_return['product_attribute_id'] == $id_attr_stock)){
                        $data[0] = $productStock;
                        return json_encode($data);
                    }else{
                        $productStock2 = \common\components\Helpers::returnProductStock($item_return['id'],$item_return['product_attribute_id'],$item_return['quantity']);
                    }
                }
                
            }
        }
        $data[0] = 'berhasil';
        return json_encode($data);
    }

    public function actionReturnstock() {

        $data = $_POST;
        $sessionOrder = new Session();
        $sessionOrder->open();

        $cart = $sessionOrder->get("cart");
        $items = isset($cart['items']) ? $cart['items'] : '';
         // check product quantity if equal zero
                    // no longer can be order if product has reach zero quantity
        foreach ($items as $item) {
            $productStock = \common\components\Helpers::returnProductStock($item['id'],$item['product_attribute_id'],$item['quantity']); 
            
        }

        $data[0] = 'berhasil';
        return json_encode($data);
    }
	
	public function actionTestUrl() 
	{
		$arr_data = array();
		$relativeHomeUrl = Url::home();
		$absoluteHomeUrl = Url::home(true);
		$httpsAbsoluteHomeUrl = Url::home('https');
		
		$arr_data = array(
			"relativeHomeUrl" => $relativeHomeUrl,
			"absoluteHomeUrl" => $absoluteHomeUrl,
			"httpsAbsoluteHomeUrl" => $httpsAbsoluteHomeUrl,
		);
		
		return json_encode($arr_data);
	}
}
