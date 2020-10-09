<?php

namespace app\modules\api\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use common\components\Helpers;
use yii\helpers\Url;
use frontend\core\controller\FrontendController;

class CartController extends FrontendController
{
    // public $enableCsrfValidation = false;

    // public function beforeAction($action)
	// {
    //     $this->enableCsrfValidation = TRUE; // can not use csrf for some moments
    // }

    public function actionAddItem()
    {
        $baseUrl = Yii::$app->request->baseUrl;
        $data_post = Yii::$app->request->post();
        $response = array();

        $response = array(
            $data[0] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag.php'),
            $data[1] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_mobile.php'),
            $data[2] = $this->renderFile('@app/modules/cart/views/checkout/shoppingbag_event.php'),
            $data[3] = 0, // is flash sale
            // $data[3] = (int)$data_post['id'], // is flash sale
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    public function actionAddItemTest( $data = array() )
    {
        $response = array();

		$current_date = date('Y-m-d H:i:s');
		$date_rule_from = Yii::$app->params['digicarts.rules']['flash_sale_time']['date_from'];
		$date_rule_to = Yii::$app->params['digicarts.rules']['flash_sale_time']['date_to'];

		// if ( ($date_rule_from <= $current_date) && ( $current_date < $date_rule_to) )
		// {
		// 	if ( count($items) > 1 ) 
		// 	{
		// 		return FALSE;
		// 	}
		// }

        if ( empty($data) ) {
            $data = array(
                array(
                        'id'      => '97',
                        'qty'     => 1,
                        'price'   => 1500000,
                        'price_discount'   => 0,
                        'name'    => 'Timex Style - TWEG16508 45mm',
                        'options' => array(
                            'image' => array(
                                'url' => '//thewatch.imgix.net/product/11336/11336_medium.jpg'
                            ),
                            'product_category' => array(
                                'id' => 5,
                                'desc' => 'Jam tangan',
                                'category' => 'watches'
                            ),
                            'product_brand' => array(
                                'id' => 2,
                                'name' => 'Daniel Wellington'
                            ),
                            'product_attribute' => array(
                                'id' => 86,
                                // 'attribute' => array( // more complete cart item option array
                                //     array('id' => 1, 'name' => 'size'),
                                //     array('id' => 6, 'name' => 'color'),
                                // ),
                                // 'attribute_value' => array(

                                // ),
                                'color' => 'Rose Gold',
                                'size' => '',
                                'weight' => 500,
                            ),
                            'product_discount' => array(
                                //
                            ),
                            'is_flash_sale' => 0,
                            'is_pre_order' => 0
                        )
                ),
                array(
                    'id'      => '1968',
                    'qty'     => 1,
                    'price'   => 175000,
                    'price_discount'   => 0,
                    'name'    => 'Chain 55cm - Silver',
                    'options' => array(
                        'image' => array(
                            'url' => '//thewatch.imgix.net/product/5315/5315_medium.jpg'
                        ),
                        'product_category' => array(
                            'id' => 12,
                            'desc' => 'Perhiasan',
                            'category' => 'jewelry'
                        ),
                        'product_brand' => array(
                            'id' => 78,
                            'name' => 'Verso'
                        ),
                        'product_attribute' => array(
                            'id' => 438,
                            'color' => 'Silver',
                            'size' => '',
                            'weight' => 500,
                        ),
                        'product_discount' => array(
                            //
                        ),
                        'is_flash_sale' => 0,
                        'is_pre_order' => 0
                    )
                ),
                array(
                    'id'      => '228',
                    'qty'     => 2,
                    'price'   => 3100000,
                    'price_discount'   => 0,
                    'name'    => 'Maverick Silver White - Honey Brown Leather',
                    'options' => array(
                        'image' => array(
                            'url' => '//thewatch.imgix.net/product/5315/5315_medium.jpg'
                        ),
                        'product_category' => array(
                            'id' => 5,
                            'desc' => 'Jam tangan',
                            'category' => 'watches'
                        ),
                        'product_brand' => array(
                            'id' => 9,
                            'name' => 'Hypergrand'
                        ),
                        'product_attribute' => array(
                            'id' => 0,
                            'color' => '',
                            'size' => '',
                            'weight' => 500,
                        ),
                        'product_discount' => array(
                            'discount_type' => 'percentage',
                            'discount_amount' => 60,
                            'discount_price' => 1860000,
                            'price_gap' => 1240000,
                            'progressive_discount' => 0,
                            'progressive_discount_amount' => 0,
                            'progressive_discount_price' => 0,
                        ),
                        'is_flash_sale' => 0,
                        'is_pre_order' => 0
                    )
                )
            );
        
            if (Yii::$app->digicarts->insert($data) )
            {
                $response = array(
                    'status' => TRUE,
                    'message' => 'Successfull add data to Cart',
                );
            } else {
                $response = array(
                    'status' => FALSE,
                    'message' => 'Failed add data to Cart',
                );
            }
        } else {
            if (Yii::$app->digicarts->insert($data) )
            {
                $response = array(
                    'status' => TRUE,
                    'message' => 'Successfull add data to Cart',
                );
            } else {
                $response = array(
                    'status' => FALSE,
                    'message' => 'Failed add data to Cart',
                );
            }
        }
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    public function actionAddItem2( $data = array() )
    {
        $response = array();

		$current_date = date('Y-m-d H:i:s');
		$date_rule_from = Yii::$app->params['digicarts.rules']['flash_sale_time']['date_from'];
		$date_rule_to = Yii::$app->params['digicarts.rules']['flash_sale_time']['date_to'];

		// if ( ($date_rule_from <= $current_date) && ( $current_date < $date_rule_to) )
		// {
		// 	if ( count($items) > 1 ) 
		// 	{
		// 		return FALSE;
		// 	}
		// }

        if ( empty($data) ) {
            $data = array(
                array(
                        'id'      => '97',
                        'qty'     => 1,
                        'price'   => 1500000,
                        'price_discount'   => 0,
                        'name'    => 'Timex Style - TWEG16508 45mm',
                        'options' => array(
                            'image' => array(
                                'url' => '//thewatch.imgix.net/product/11336/11336_medium.jpg'
                            ),
                            'product_category' => array(
                                'id' => 5,
                                'desc' => 'Jam tangan',
                                'category' => 'watches'
                            ),
                            'product_brand' => array(
                                'id' => 2,
                                'name' => 'Daniel Wellington'
                            ),
                            'product_attribute' => array(
                                'id' => 86,
                                // 'attribute' => array( // more complete cart item option array
                                //     array('id' => 1, 'name' => 'size'),
                                //     array('id' => 6, 'name' => 'color'),
                                // ),
                                // 'attribute_value' => array(

                                // ),
                                'color' => 'Rose Gold',
                                'size' => '',
                                'weight' => 500,
                            ),
                            'product_discount' => array(
                                //
                            ),
                            'is_flash_sale' => 0,
                            'is_pre_order' => 0
                        )
                ),
            );
        
            if (Yii::$app->digicarts->insert($data) )
            {
                $response = array(
                    'status' => TRUE,
                    'message' => 'Successfull add data to Cart',
                );
            } else {
                $response = array(
                    'status' => FALSE,
                    'message' => 'Failed add data to Cart',
                );
            }
        } else {
            if (Yii::$app->digicarts->insert($data) )
            {
                $response = array(
                    'status' => TRUE,
                    'message' => 'Successfull add data to Cart',
                );
            } else {
                $response = array(
                    'status' => FALSE,
                    'message' => 'Failed add data to Cart',
                );
            }
        }
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    public function actionShowCart()
    {
        $response = array();

        $carts = Yii::$app->digicarts->contents();
        $cart = array();

        foreach ($carts as $item) {
            $cart[] = array(
                       'rowid' => $item['rowid'],
                       'id' => $item['id'],
                       'name' => $item['name'],
                       'qty' => $item['qty'],
                       'subtotal' => $item['subtotal'],
                       'subtotal_discount' => $item['subtotal_discount'],
                       'price' => $item['price'],
                       'discount' => $item['price_discount'],
                       'options' => $item['options'],
                   );
        }

        $rid = null;
        foreach ($cart as $c){
            // $rid = $c[0]['rowid'];
            // var_dump($c);
            // exit();
        }

        $response = array(
            'status' => TRUE,
            // 'message' => 'Retrieved Data '.Yii::$app->request->baseUrl,
            'message' => 'Retrieved Data',
            'result' => $cart,
            'result_full' => $carts,
            'rid' => $rid,
            'total_items' => Yii::$app->digicarts->total_items(),
            'total' => Yii::$app->digicarts->total(),
            'total_discount' => Yii::$app->digicarts->total_discount(),
            'total_no_discount' => Yii::$app->digicarts->total_no_discount(),
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    public function actionEmptyCart()
    {
        $response = array();

        Yii::$app->digicarts->destroy();
        $carts = Yii::$app->digicarts->contents();

        $response = array(
            'status' => TRUE,
            'message' => 'Cart Empty',
            'result' => $carts,
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    /**
     * Coupon Controller
     */
    public function actionAddCoupon( $data = array() )
    {
        $response = array();

        if ( empty($data) ) {
            $data = array(
                array(
                    'id'      => '29724',
                    'code'     => '29TATJYN',
                    'name'   => 'Subscribe Newsletter',
                    'type'   => 'amount',
                    'amount'    => 100000,
                    'progressive_amount'    => 50000,
                    'options' => array(
                        //
                    )
                ),
                array(
                    'id'      => '29725',
                    'code'     => '29TATJYX',
                    'name'   => 'Promo Kere Hore',
                    'type'   => 'percentage',
                    'amount'    => 10,
                    'progressive_amount'    => 5,
                    'options' => array(
                        //
                    )
                ),
            );
        
            if (Yii::$app->digicoupons->insert($data) )
            {
                $response = array(
                    'status' => TRUE,
                    'message' => 'Successfull add data coupon',
                );
            } else {
                $response = array(
                    'status' => FALSE,
                    'message' => 'Failed add data coupon',
                );
            }
        } else {
            if (Yii::$app->digicoupons->insert($data) )
            {
                $response = array(
                    'status' => TRUE,
                    'message' => 'Successfull add data coupon',
                );
            } else {
                $response = array(
                    'status' => FALSE,
                    'message' => 'Failed add data coupon',
                );
            }
        }
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    public function actionShowCoupon()
    {
        $response = array();

        $coupons = Yii::$app->digicoupons->contents();
        $coupon = array();

        foreach ($coupons as $item) {
            $coupon[] = array(
                'rowid' => $item['rowid'],
                'id' => $item['id'],
                'code' => $item['code'],
                'name' => $item['name'],
                'type' => $item['type'],
                'amount' => $item['amount'],
                'progressive_amount' => $item['progressive_amount'],
                'options' => $item['options'],
            );
        }

        $response = array(
            'status' => TRUE,
            // 'message' => 'Retrieved Data '.Yii::$app->request->baseUrl,
            'message' => 'Retrieved Data',
            'result' => $coupon,
            'result_full' => $coupons,
            'total_coupons' => Yii::$app->digicoupons->total_coupons(),
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    public function actionEmptyCoupon()
    {
        $response = array();

        Yii::$app->digicoupons->destroy();
        $coupons = Yii::$app->digicoupons->contents();

        $response = array(
            'status' => TRUE,
            'message' => 'Coupon Empty',
            'result' => $coupons,
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }

    /**
     * Show All Session
     */
    public function actionShowSessions()
    {
        $response = array();

        $carts = Yii::$app->digicarts->contents();
        $cart = array();

        foreach ($carts as $item) {
            $cart[] = array(
                       'rowid' => $item['rowid'],
                       'id' => $item['id'],
                       'name' => $item['name'],
                       'qty' => $item['qty'],
                       'subtotal' => $item['subtotal'],
                       'subtotal_discount' => $item['subtotal_discount'],
                       'price' => $item['price'],
                       'discount' => $item['price_discount'],
                       'options' => $item['options'],
                   );
        }

        $coupons = Yii::$app->digicoupons->contents();
        $coupon = array();

        foreach ($coupons as $item) {
            $coupon[] = array(
                'rowid' => $item['rowid'],
                'id' => $item['id'],
                'code' => $item['code'],
                'name' => $item['name'],
                'type' => $item['type'],
                'amount' => $item['amount'],
                'progressive_amount' => $item['progressive_amount'],
                'options' => $item['options'],
            );
        }

        $response = array(
            'status' => TRUE,
            // 'message' => 'Retrieved Data '.Yii::$app->request->baseUrl,
            'message' => 'Retrieved Data',
            'result' => array('carts' => $cart, 'coupons' => $coupon),
            'result_full' => array('carts' => $cart, 'coupons' => $coupon),
            'last_cart' => $cart[1]['rowid'],
            'total_items' => Yii::$app->digicarts->total_items(),
            'total' => Yii::$app->digicarts->total(),
            'total_discount' => Yii::$app->digicarts->total_discount(),
            'total_no_discount' => Yii::$app->digicarts->total_no_discount(),
            'total_coupons' => Yii::$app->digicoupons->total_coupons(),
            'count_cart_contents' => count($_SESSION['cart_contents']),
            'cart_contents' => $_SESSION['cart_contents'],
            'coupon_contents' => $_SESSION['coupon_contents'],
        );
		
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
        exit();
    }
}