<?php

namespace app\modules\api\controllers;

use Yii;
use frontend\core\controller\FrontendController;
// use yii\rest\ActiveController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use DrewM\MailChimp\MailChimp;
use common\components\Helpers;
use yii\helpers\Url;
use backend\models\Customer;
use backend\models\CustomerAddress;
use backend\models\CartRule;
use backend\models\CartRuleLang;
use frontend\models\CustomerForm;
use backend\models\CustomerWishlist;
use yii\web\Session;

class UserController extends FrontendController
{
    public $modelClass = 'app\models\User';

    public $breadcrumb = ["Go-API"];
    public $title = "";
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
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

    public function actionDigiSession()
    {
        session_start();
        $session = Yii::$app->session;
        $customerInfo = $session['customerInfo'];
        $shippingMethod = $customerInfo['shippingMethod'];
        $voucherInfo = $session->get('voucherInfo');
        $cart = $session->get('cart');
        $lastOrder = $_SESSION['lastOrder'];

        if (!isset($customerInfo)){
            $response = array(
                "message" => "You haven't Sign In yet.",
                "shippingMethod" => $shippingMethod,
                "voucherInfo" => $voucherInfo,
                "carts" => $cart,
            );
        }else{
            $response = array(
                "customerInfo" => $customerInfo,
                "shippingMethod" => $shippingMethod,
                "voucherInfo" => $voucherInfo,
                "carts" => $cart,
                "lastOrder" => $lastOrder
            );
        }
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    /**
     * fungsi untuk update profil bagi user yang telah sign in
     */
    public function actionUpdateProfile() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session["customerInfo"];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            $customer_id = $customerInfo['customer_id'];

            $customer = Customer::findOne(array('customer_id' => $customer_id));
            if($customer != NULL){
				$first_name = $params_post['customerInfo']['fname'];
				$last_name = $params_post['customerInfo']['lname'];
				$birthday = $params_post['customerInfo']['birthday'];
				$phone = $params_post['customerInfo']['phone'];
				$gender = $params_post['customerInfo']['gender'];
				
				$first_name = htmlspecialchars(stripslashes(trim($first_name)));
				$last_name = htmlspecialchars(stripslashes(trim($last_name)));
				$birthday = htmlspecialchars(trim($birthday));
				$phone = htmlspecialchars(stripslashes(trim($phone)));
				$gender = (int)strip_tags(trim($gender));
				
                $customer->firstname = $first_name;
                $customer->lastname = $last_name;
                $customer->birthday = $birthday;
                $customer->phone_number = $phone;
                $customer->gender_id = $gender;
                $customer->save();

                $_SESSION['customerInfo']['fname'] = $first_name;
                $_SESSION['customerInfo']['lname'] = $last_name;
                $_SESSION['customerInfo']['birthday'] = $birthday;
                $_SESSION['customerInfo']['phone'] = $phone;
                $_SESSION['customerInfo']['gender'] = $gender === 1 ? 'MEN' : 'WOMEN';

                $message = "Update Profile Success!";
            }else{
                $state = FALSE;
                $message = "User Not Found!";
            }
        }

        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * fungsi untuk update password bagi user yang telah sign in
     */
    public function actionUpdatePassword() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            $customer_id = $customerInfo['customer_id'];

            $old_pass = $params_post['opassword'];
            $new_pass = $params_post['npassword'];
            $confirm_pass = $params_post['cpassword'];

            $customer = Customer::findOne($customer_id);
            if($new_pass != $confirm_pass){
                $message = "Password didn't match!";
            }
            if($customer->passwd != md5($old_pass)){
                $message = "Password didn't match!";
            }
            $customer->passwd = md5($new_pass);
            
            $customer->save();
            $message = "Update Password Succes!";
        }

        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }

    /**
     * fungsi untuk update email bagi user yang telah sign in
     */
    public function actionUpdateEmail() 
    {
        session_start();
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            $customer_id = $customerInfo['customer_id'];

            $email = htmlspecialchars(stripslashes(trim($params_post['customerInfo']['email'])));
            $confirm_pass = htmlspecialchars(stripslashes(trim($params_post['customerInfo']['cpassword'])));

            $customer = Customer::findOne($customer_id);
            if($customer->passwd != md5($confirm_pass)){
                $message = "Password didn't match!";
            }else{
                $customer->email = $email;
                $customer->save();
                $message = "Update Email Succes!";
                $_SESSION['customerInfo']['email'] = $params_post['customerInfo']['email'];
            }
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $response;
    }
	
	//START WISHLIST CODING


    public function actionCheckWishlist() 
    {
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            
            $customer_id = $customerInfo['customer_id'];

            $wishlist = \backend\models\CustomerWishlist::checkProductinWishlist($params_post['product_id'], $params_post['product_attribute_id'], $customer_id);
          
            if($wishlist>0){
                $state = true;
                $result = 0;
                $message = "Can't add product to wishlist";
            }else{
                $state = true;
                $result = 1;
                $message = "Can add product to wishlist.";
            }
            
           
        }
        $response = array(
            "status" => $state,
            "result" => $result,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }

    public function actionAddCategoryWishlist() 
    {
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";
        $maxWishlistID = 0;

        if(!$params_post){
            $state=FALSE;
            $message = "Not Found";
            $response = array(
                "status" => $state,
                "message" => $message
            );
            
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            return $response;
        }


        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            
            $customer_id = $customerInfo['customer_id'];
            
            $wishlist = new \backend\models\CustomerWishlist();
            $wishlist->customer_id = $customer_id;
            $wishlist->name_wishlist = $params_post['name'];
            $wishlist->created_at = date("Y-m-d H:i", time());
            $wishlist->update_at = date("Y-m-d H:i", time());
            $wishlist->isdefault = 0;

            if($wishlist->save()){
                $message = "Add Category Wishlist Success!";
				
                $maxWishlistID = CustomerWishlist::find()->max('customer_wishlist_id');
				
            }
            
           
        }
        $response = array(
            "status" => $state,
            "message" => $message,
            "id" => $maxWishlistID
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }

    public function actionDeleteCategoryWishlist() 
    {
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            
            $customer_id = $customerInfo['customer_id'];
            
            $wishlist = \backend\models\CustomerWishlist::findOne($params_post['id_wishlist']);
            if($wishlist->delete()){
                $message = "Delete Category Wishlist Success!";    
            }
            
           
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
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
    
    
    function giveDiscountWishlist($id){
        //2410
        $customer_wishlist_detail_id = $id;
        
        
        $wishlistDetail = \backend\models\CustomerWishlistDetail::find()->where(['customer_wishlist_detail_id'=>$customer_wishlist_detail_id])->with('customerWishlist.customer')->asArray()->all();
        
        
        $product_id = $wishlistDetail[0]['product_id'];
        $customer_id = $wishlistDetail[0]['customerWishlist']['customer_id'];
        
        // echo $product_id;
        // echo "<br>";
        // echo $customer_id;
        // echo "<br>";
        // echo strtoupper($this->generateRandomString());
        // echo "<br>";
        // echo date('Y-m-d H:i:s');
        // echo "<br>";
        // echo date('Y-m-d H:i:s', strtotime($Date. ' + 7 days'));
        
        $voucherCode = strtoupper($this->generateRandomString());
        
        
		$model = new \backend\models\CartRule();
		$model->date_from = date('Y-m-d H:i:s');
		$model->date_to = date('Y-m-d H:i:s', strtotime($Date. ' + 7 days'));
		$model->description = 'Wishlist Voucher Code';
		$model->quantity = 1;
		$model->priority = 1;
		$model->partial_use = 1;
		$model->code = $voucherCode;
		$model->minimum_amount = 1000000;
		$model->minimum_amount_currency = 1;
		$model->reduction_currency = 1;
		$model->highlight = 1;
		$model->active = 1;
		$model->date_add =date('Y-m-d H:i:s');
		$model->combined_with_other_promotion = 0;
		$model->reduction_amount = 100000;
        $model->customer_id = $customer_id;
        if($model->save()){
            $productWishlist = \backend\models\Product::find()->where(['product_id'=>$product_id])->with('productDetail')->asArray()->all();
    		$productImage = \backend\models\ProductImage::find()->where(["product_id" => $product_id, "cover"=> 1])->asArray()->all();
    		
    		if (!empty($wishlistDetail)) {
               foreach($wishlistDetail as $keyWishlist => $valueWishlist){
                  \common\components\Helpers::sendEmailMandrillUrlAPI(
                      $this->renderFile('@app/views/template/mail/wishlist/new_wish_give_promo.php', array(
                          "product_id" => $productWishlist[0]['product_id'],
                          "link_rewrite" => $productWishlist[0]['productDetail']['link_rewrite'],
                          "product_name" => $productWishlist[0]['productDetail']['name'],
    					   "product_image"=>$productImage[0]['product_image_id'],
    					   "type"=>"amount",
    					   "voucher"=>$voucherCode,
    					   "amount"=>1000000,
    					   "due_date"=>date('Y-m-d H:i:s', strtotime($Date. ' + 7 days'))
                      )), 
                      'The Watch Co - Wishlist Voucher Code - '.$productWishlist[0]['productDetail']['name'], 
                      Yii::$app->params['adminEmail'], 
                      $valueWishlist['customerWishlist']['customer']['email'], 
                      '' 
                  );
                    // echo $value_wishlist;
                   
               }
               
               
               return   array(
                            "product_id" => $product_id,
                            "customer_id" => $customer_id,
                            "voucher_code" => $voucherCode
                        );
    
            }
        }
        
        
        
        
        return false;
    }

    public function actionAddDetailWishlist() 
    {
        
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";
        
        if(!$params_post){
            $state=FALSE;
            $message = "Not Found";
            $response = array(
                "status" => $state,
                "message" => $message
            );
            
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            return $response;
        }

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            
            $customer_id = $customerInfo['customer_id'];
            
            $wishlist_id = 0;
            $wishlist = \backend\models\CustomerWishlist::
            find()
            ->where(['customer_id'=>$customer_id])
            ->andWhere(['isdefault'=>1])
            ->one();

            if(empty($wishlist)){
                $customer_id = $customerInfo['customer_id'];
            
                $newWishlist = new \backend\models\CustomerWishlist();
                $newWishlist->customer_id = $customer_id;
                $newWishlist->name_wishlist = "My Wishlist";
                $newWishlist->created_at = date("Y-m-d H:i", time());
                $newWishlist->update_at = date("Y-m-d H:i", time());
                $newWishlist->isdefault = 1;
                if($newWishlist->save()){
                    $wishlist_id = $newWishlist->customer_wishlist_id;
                }
                
            }else{
                $wishlist_id = $wishlist->customer_wishlist_id;
            }

            $newWishlistDetail = new \backend\models\CustomerWishlistDetail();
            $newWishlistDetail->product_id = $params_post['product_id'];
            $newWishlistDetail->product_attribute_id = $params_post['product_attribute_id'];
            $newWishlistDetail->customer_wishlist_id = $wishlist_id;
            $newWishlistDetail->created_at = date("Y-m-d H:i", time());

            if($newWishlistDetail->save()){
                if($result = $this->giveDiscountWishlist($newWishlistDetail->customer_wishlist_detail_id)){
                    $message = "Add Product Wishlist Success!";    
                }
            }
            
            
           
        }
        $response = array(
            "status" => $state,
            "message" => $message,
            "result" => $result
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }


    public function actionDeleteDetailWishlist() 
    {
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            
            $customer_id = $customerInfo['customer_id'];
            
            $wishlist = \backend\models\CustomerWishlistDetail::findOne($params_post['id_wishlist']);
            if($wishlist->delete()){
                $message = "Delete Detail Wishlist Success!";    
            }
            
           
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }

    public function actionDeleteMultipleDetailWishlist() 
    {
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        if(!empty($params_post)){
            if (empty($customerInfo)){
                $state = FALSE;
                $message = "You haven't Sign In yet.";
            }else{
                
                $customer_id = $customerInfo['customer_id'];
                
                $wishlist = \backend\models\CustomerWishlistDetail::deleteAll(['customer_wishlist_detail_id'=>$params_post['id_wishlist']]);
                //print_r($wishlist);
                //die();
                if($wishlist){
                    $message = "Delete Detail Wishlist Success!";    
                }
                
            
            }
        }else{
            $message = "Move Detail Wishlist Fail!";    
            $state = FALSE;
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }

    public function actionMoveDetailWishlist() 
    {
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";

        $customerInfo = $session['customerInfo'];
        
        if (empty($customerInfo)){
            $state = FALSE;
            $message = "You haven't Sign In yet.";
        }else{
            
            $customer_id = $customerInfo['customer_id'];
            
            $wishlist = \backend\models\CustomerWishlistDetail::findOne($params_post['detail_id_wishlist']);
            $wishlist->customer_wishlist_id = $params_post['category_id_wishlist'];
            if($wishlist->save()){
                $message = "Move Detail Wishlist Success!";    
            }
            
           
        }
        
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }


    
    public function actionMoveMultipleDetailWishlist() 
    {
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";
        $customerInfo = $session['customerInfo'];

       
        
        if(count($params_post['detail_id_wishlist'])>=1 && !empty($params_post['detail_id_wishlist'][0])){
            if (empty($customerInfo)){
                $state = FALSE;
                $message = "You haven't Sign In yet.";
            }else{
                
                $customer_id = $customerInfo['customer_id'];

                foreach($params_post['detail_id_wishlist'] as $detailID){
                    
                    $wishlist = \backend\models\CustomerWishlistDetail::findOne($detailID);
                    $wishlist->customer_wishlist_id = $params_post['category_id_wishlist'];
                    if(!$wishlist->save()){
                        $message = "Move Detail Wishlist Fail!";    
                        $state = FALSE;
                        $response = array(
                            "status" => $state,
                            "message" => $message,
                        );           
                        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;       
                        return $response;

                    }
                }

                $message = "Move Detail Wishlist Success!";   
                    
            }
        }else{
            $message = "Move Detail Wishlist Fail!";    
            $state = FALSE;
        }
        $response = array(
            "status" => $state,
			"message" => $message,
		);
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }


    public function actionConvertProductWishlistToProduct() 
    {
        //DECLARE VARIABLE
        $session = Yii::$app->session;
        $baseUrl = Yii::$app->params['frontendUrl'];
        $baseUrlImage = Yii::$app->params['imgixUrl'];
        $params_post = Yii::$app->request->post();
        $state = TRUE;
        $message = "";
        $customerInfo = $session['customerInfo'];
        $product_id =  $params_post['product_id'];
        $product_attribute_id = $params_post['product_attribute_id'];
        $now = date('Y-m-d H:i:s');


        //GET DATA FROM MODEL
        $product_M = \backend\models\Product::find()->where(['product_id'=>$product_id]);
        $productAttribute_M = \backend\models\ProductAttribute::find()->where(['product_id'=>$product_id]);
        $productImage_M = \backend\models\ProductImage::find()->where(['product_id'=>$product_id])->andWhere(['cover'=>1]);
        $productStock_M = \backend\models\ProductStock::find()->where(['product_id'=>$product_id]);
        $productSpecificPrice_M = \backend\models\SpecificPrice::find()->where(['product_id'=>$product_id])->andWhere(['product_attribute_id'=>$product_attribute_id]);
        $productDetail_M = $product_M->with('productDetail');
        $productBrands_M = $product_M->with('brands');
        $productCategoryCategory_M = $product_M->with('productCategory');
        $productCategory_M = $product_M->with('category');
        $productAttributeCombination_M = $productAttribute_M->with('productAttributeCombination');


        //CONVERT DATA MODEL TO DATA RESULT
        $product_R = $product_M->asArray()->all();
        $productAttribute_R = $productAttribute_M->asArray()->all();
        $productDetail_R = $productDetail_M->asArray()->all();
        $productBrands_R = $productBrands_M->asArray()->all();
        $productSpecificPrice_R = $productSpecificPrice_M->asArray()->all();
        $productImage_R = $productImage_M->asArray()->all();
        $productStock_R = $productStock_M->asArray()->all();
        $productCategoryCategory_R = $productCategoryCategory_M->asArray()->all();
        

        if($product_attribute_id!=0){
            $attributeCombinationAttributes = $productAttribute_M->with('productAttributeCombination.attributes')->asArray()->one();
            $attributeCombinationAttributes2 = $productAttribute_M->with('productAttributeCombination.attributes2')->asArray()->one();
            $attributeCombinationAttributeValue = $productAttribute_M->with('productAttributeCombination.attributeValue')->asArray()->one();
            $attributeCombinationAttributeValue2 = $productAttribute_M->with('productAttributeCombination.attributeValue2')->asArray()->one();
            
            if($attributeCombinationAttributes['productAttributeCombination']['attributes']['name']=="Color"){
                $productColor = $attributeCombinationAttributeValue['productAttributeCombination']['attributeValue']['value'];
            }elseif($attributeCombinationAttributes['productAttributeCombination']['attributes']['name']=="Size"){
                $productSize = $attributeCombinationAttributeValue['productAttributeCombination']['attributeValue']['value'];
            }

            if($attributeCombinationAttributes2['productAttributeCombination']['attributes2']['name']=="Color"){
                $productColor = $attributeCombinationAttributeValue2['productAttributeCombination']['attributeValue2']['value'];
            }elseif($attributeCombinationAttributes2['productAttributeCombination']['attributes2']['name']=="Color"){
                $productSize = $attributeCombinationAttributeValue2['productAttributeCombination']['attributeValue2']['value'];
            }
        }

         //MULAI HITUNG REDUCTION AWAL
         $_calculationResult = $product_R[0]['price'];
         $_calculationReduction = 0;
         $_calculationReductionExtra = 0;
         $_calculationReductionPlusExtra = 0;

        /*SPECIFIC PRICE CALCULATION*/
        if(!empty($productSpecificPrice_R)){
            
            $productSpecificPriceReduction = $productSpecificPrice_R[0]['reduction'];
            $productSpecificPriceReductionType = $productSpecificPrice_R[0]['reduction_type'];
            $productSpecificPriceReductionFrom = $productSpecificPrice_R[0]['from'];
            $productSpecificPriceReductionTo = $productSpecificPrice_R[0]['to'];
            $productSpecificPriceReductionIsFlashSale = $productSpecificPrice_R[0]['is_flash_sale'];
            $productSpecificPriceReductionFlashSaleQty = $productSpecificPrice_R[0]['flash_sale_qty'];
            $productSpecificPriceReductionReductionExtra = $productSpecificPrice_R[0]['reduction_extra'];
            $productSpecificPriceReductionReductionPlusExtra = $productSpecificPrice_R[0]['reduction_plus_extra'];

            //CEK FLASH SALE GA SIH?
            if($productSpecificPriceReductionIsFlashSale==1){
                //KALO FLASH SALE, CEK LAGI JUMLAH PRODUK YANG FLASH SALENYA MASIH ADA GA SIH?
                if($productSpecificPriceReductionFlashSaleQty>0){


                    //TERNYATA PRODUKNYA MASIH ADA, CEK LAGI TANGGAL DISKON MEMENUHI GA SIH?
                    if ($productSpecificPriceReductionFrom <= $now && $productSpecificPriceReductionTo > $now) {

                         //IS_DISKON=1
                         $productIsDiscount = 1;

                        //TERNYATA MEMENUHI, DISKONNYA PERCENT ATAU AMOUNT?
                        if($productSpecificPriceReductionType == "percent"){
                            

                            //DISKON PERCENT. MULAI PERHITUNGAN DISKON
                            $_calculationReduction = $_calculationResult*($productSpecificPriceReduction/100);
                            $_calculationResult = $_calculationResult - $_calculationReduction;
                            
                            //MULAI PERHITUNGAN DISKON EXTRA
                            if($productSpecificPriceReductionReductionExtra!=0){
                                $_calculationReductionExtra = $_calculationResult*($productSpecificPriceReductionReductionExtra/100);
                                $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                            }

                            //MULAI PERHITUNGAN DISKON PLUS EXTRA
                            if($productSpecificPriceReductionReductionPlusExtra!=0){
                                $_calculationReductionPlusExtra = $_calculationResult*($productSpecificPriceReductionReductionPlusExtra/100);
                                $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                            }

                            
                        }elseif($productSpecificPriceReductionType == "amount"){


                            //DISKON AMOUNT. MULAI PERHITUNGAN DISKON
                            $_calculationReduction = ($productSpecificPriceReduction);
                            $_calculationResult = $_calculationResult - $_calculationReduction;

                            //MULAI PERHITUNGAN DISKON EXTRA
                            if($productSpecificPriceReductionReductionExtra!=0){
                                $_calculationReductionExtra =($productSpecificPriceReductionReductionExtra);
                                $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                            }

                            //MULAI PERHITUNGAN DISKON PLUS EXTRA
                            if($productSpecificPriceReductionReductionPlusExtra!=0){
                                $_calculationReductionPlusExtra = ($productSpecificPriceReductionReductionPlusExtra);
                                $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                            }

                            
                        }
                    }


                }
            }else{

                //TERNYATA PRODUKNYA MASIH ADA, CEK LAGI TANGGAL DISKON MEMENUHI GA SIH?
                if ($productSpecificPriceReductionFrom <= $now && $productSpecificPriceReductionTo > $now) {

                     //IS_DISKON=1
                     $productIsDiscount = 1;

                    //TERNYATA MEMENUHI, DISKONNYA PERCENT ATAU AMOUNT?
                    if($productSpecificPriceReductionType == "percent"){
                        

                        //DISKON PERCENT. MULAI PERHITUNGAN DISKON
                        $_calculationReduction = $_calculationResult*($productSpecificPriceReduction/100);
                        $_calculationResult = $_calculationResult - $_calculationReduction;
                        
                        //MULAI PERHITUNGAN DISKON EXTRA
                        if($productSpecificPriceReductionReductionExtra!=0){
                            $_calculationReductionExtra = $_calculationResult*($productSpecificPriceReductionReductionExtra/100);
                            $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                        }

                        //MULAI PERHITUNGAN DISKON PLUS EXTRA
                        if($productSpecificPriceReductionReductionPlusExtra!=0){
                            $_calculationReductionPlusExtra = $_calculationResult*($productSpecificPriceReductionReductionPlusExtra/100);
                            $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                        }   

                        
                    }elseif($productSpecificPriceReductionType == "amount"){


                        //DISKON AMOUNT. MULAI PERHITUNGAN DISKON
                        $_calculationReduction = ($productSpecificPriceReduction);
                        $_calculationResult = $_calculationResult - $_calculationReduction;

                        //MULAI PERHITUNGAN DISKON EXTRA
                        if($productSpecificPriceReductionReductionExtra!=0){
                            $_calculationReductionExtra =($productSpecificPriceReductionReductionExtra);
                            $_calculationResult = $_calculationResult - $_calculationReductionExtra;
                        }

                        //MULAI PERHITUNGAN DISKON PLUS EXTRA
                        if($productSpecificPriceReductionReductionPlusExtra!=0){
                            $_calculationReductionPlusExtra = ($productSpecificPriceReductionReductionPlusExtra);
                            $_calculationResult = $_calculationResult - $_calculationReductionPlusExtra;
                        }

                        
                    }
                }

                
            }

        }      
        
        $productID = $product_id;
        $productAttribute = (empty($productAttribute_R)) ? "" : $productAttribute_R[0]['product_attribute_id'];
        $productName = (empty($productDetail_R)) ? "" : $productDetail_R[0]['productDetail']['name'];
        $productBrandName = (empty($productBrands_R)) ? "" : $productBrands_R[0]['brands']['brand_name'];
        $productBrandID = (empty($productBrands_R)) ? "" : $productBrands_R[0]['brands']['brand_id'];
        $productOriginalUnitPrice = (empty($product_R)) ? "" : $product_R[0]['price'];
        $productUnitPrice = $_calculationResult;
        $productColor = (!isset($productColor)) ? "" : $productColor;
        $productSize = (!isset($productSize)) ? "" : $productSize;
        $productWeight = (empty($productBrands_R)) ? "" : $productBrands_R[0]['weight'];
        $productLinkRewrite = (empty($productDetail_R)) ? "" : $productDetail_R[0]['productDetail']['link_rewrite'];
        $productImage = (empty($productImage_R)) ? "" : $productImage_R[0]['product_image_id'];
        $productStock = (empty($productStock_R)) ? "0" : $productStock_R[0]['quantity'];
        $productFlashSale = (!isset($productSpecificPriceReductionIsFlashSale)) ? 0 : $productSpecificPriceReductionIsFlashSale;
        $productCategoryCategory = (empty($product_R)) ? "" : $product_R[0]['product_category_id'];
        $productCategoryCategoryDesc = (empty($productCategoryCategory_R)) ? "" : $productCategoryCategory_R[0]['productCategory']['product_category_description'];
        $productCategory = (empty($product_R)) ? "" : $product_R[0]['category_id'];
        $productIsDiscount = (!isset($productIsDiscount)) ? 0 : $productIsDiscount;
        

        $data = array(
            "id" => $productID,
            "product_attribute_id" => $productAttribute,
            "reference" => null,
            "name" => $productName,
            "brand_name" => $productBrandName,
            "brand_id" => $productBrandID,
            "original_unit_price" => intval($productOriginalUnitPrice),
            "original_total_price" => intval($productOriginalUnitPrice),
            "unit_price" => intval($productUnitPrice),
            "total_price" => intval($productUnitPrice),
            "color" => $productColor,
            "size" => $productSize,
            "quantity" => 1,
            "weight" => $productWeight,
            "flag" =>true,
            "url" => $baseUrl."product/".$productLinkRewrite."",
            "image" => array(
                "url" => $baseUrlImage."product/".$productImage."/".$productImage."_medium.jpg",
            ),
            "flash_sale" => intval($productFlashSale),
            "pre_order" => 0,
            "category_id" => $productCategoryCategory,
            "category_desc" => $productCategoryCategoryDesc,
            "category"=> $productCategory,
            "is_discount" => $productIsDiscount,
            "stock"=>$productStock

            
        );


        
        // die();
       
        $response = $data;
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
		return $response;
    }
}