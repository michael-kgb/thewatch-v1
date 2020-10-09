<?php

use yii\web\Session;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$sessionOrder = new Session();
$sessionOrder->open();
$customerInfo = $sessionOrder->get("customerInfo");
$cart = $sessionOrder->get("cart");
$items = $cart['items'];

$totalItems = count($cart['items']);

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
//print_r($_SESSION);
?>

<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/MDFjYjljZDktZjMwZS00YWIyLWFhYjgtZTNlNzhmMTVlZTk4"></script>-->

<script>
var dataLayer = [],
	items = [];

var totalCart = <?php echo $totalItems; ?>;

if(totalCart > 0){
	<?php $i = 1; ?>
	<?php foreach ($cart['items'] as $item) { ?>
	<?php $product = \backend\models\Product::findOne(['product_id' => $item['id']]); ?>
	items.push({
		"id": <?php echo $item['id']; ?>,
		"name": "<?php echo $item['name']; ?>",
		"price": "<?php echo $item['total_price']; ?>",
		"brand": "<?php echo $item['brand_name']; ?>",
		"category": "<?php echo $product->productCategory->product_category_name; ?>",
		"position": <?php echo $i; ?>,
		"quantity": <?php echo $item['quantity']; ?>
	});
	<?php $i++; ?>
	<?php } ?>

	dataLayer.push({
	  "event": "checkout",
	  "ecommerce": {
		"checkout": {
		  "actionField": {
			"step": 4
		  },
		  "products": items,
		}
	  }
	});
}
</script>

<section id="shopping-bag">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-1 step-purchase shipping step clearleft remove-padding">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2 clearright clearleft remove-padding">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/1.png" width="100%">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 step-purchase step separator clearright clearleft remove-padding"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2 clearleft clearright remove-padding">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/3.png" width="100%">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 step-purchase step separator clearleft clearright remove-padding"></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2 clearleft clearright remove-padding">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/5.png" width="100%">
            </div>
        </div>
        <div class="row step-purchase">
            <div class="col-xs-12 clearleft clearright">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title remove-padding">RINCIAN PESANAN</div>
                <?php 
                if (isset($customerInfo['paymentMethod'])) { 
                    if ($paymentMethod == 'bt') {
                ?>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 step-purchase separator clearleft clearright remove-padding"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding border-bottom-1 padding-bottom-5 ipad-1024 margin-bottom-5 ipad-1024">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 line-height2 gotham-medium clearleft clearright remove-padding no-spacing">
                        Hi <?php echo $customerInfo['fname']; ?>,
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright remove-padding no-spacing">
                        <?php
                        if (isset($customerInfo['paymentMethod'])) {
                            echo \backend\models\PaymentMethod::findOne(['payment_method_id' => $customerInfo['paymentMethod']['payment_method_id']])->note;
                        }
                        ?>
                    </div>
                </div>
                <?php 
                    }
                } 
                ?>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 step-purchase separator clearleft clearright remove-padding no-spacing"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myorder detail header">
                        WWW.THEWATCH.CO
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myorder detail box">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form first clearright no-spacing">
                                NAME
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form no-spacing">
                                : <?php echo strtoupper($info['firstname'] . ' ' . $info['lastname']); ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form caption clearright no-spacing">
                                PHONE
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form text no-spacing">
                                : <?php echo $info['phone']; ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form caption clearright no-spacing">
                                EMAIL
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form text no-spacing">
                                : <?php echo isset($customerInfo['email']) ? $customerInfo['email'] : ''; ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form caption clearright no-spacing">
                                ADDRESS
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form text no-spacing">
                                : <?php echo $info['address1']; ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form caption clearright no-spacing">
                                ZIP POSTAL
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form text no-spacing">
                                : <?php echo $info['postcode']; ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form caption clearright no-spacing">
                                PROVINCE
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form text no-spacing">
                                : <?php echo strtoupper(\backend\models\Province::findOne(['province_id' => $info['province_id']])->name); ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form caption clearright no-spacing">
                                STATE
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form text no-spacing">
                                : <?php echo strtoupper(\backend\models\State::findOne(['state_id' => $info['state_id']])->name); ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 gotham-light myorder detail form caption clearright no-spacing">
                                DISTRICT
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 gotham-light myorder detail form text no-spacing">
                                : <?php echo strtoupper(\backend\models\District::findOne(['district_id' => $info['district_id']])->name); ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myorder detail separator"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding padding-top-2 padding-bottom-2 border-bottom-1 ipad border-top-button ipad margin-top-10 margin-bottom-3">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 myorder detail item header remove-padding">
                                LIST PRODUK
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 myorder detail item header qty remove-padding">
                                JUMLAH
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 myorder detail item header price remove-padding">
                                HARGA
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myorder detail separator bottom"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myitem box ipad clearleft clearright remove-padding padding-bottom-5 margin-bottom-5 border-bottom-1 ipad">
                            <?php if (count($items) > 0) { ?>
                                <?php
                                $i = 1;
                                $grandTotal = 0;
                                ?>
                                <?php foreach ($items as $item) { ?>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 myorder detail item header value remove-padding">
                                        <?php echo $i; ?>. <?php echo $item['name']; ?> <?php echo isset($item['color']) ? $item['color'] : ''; ?>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 myorder detail item header qty value">
                                        <?php echo $item['quantity']; ?>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 myorder detail item header price value">
                                        IDR <?php echo \common\components\Helpers::getPriceFormat($item['total_price']); ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $grandTotal += $item['total_price']; ?>
                                    <?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myorder detail separator bottom"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myitem box clearleft clearright remove-padding margin-bottom-5 ipad">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                TOTAL
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                IDR <?php echo \common\components\Helpers::getPriceFormat($grandTotal); ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 myorder detail item header value">
                                <?php
                                $shipment = backend\models\CarrierCost::findOne($_SESSION['customerInfo']['shippingMethod']['shipping_method']);
                                ?>
                                PENGIRIMAN 
                                    <?php 
                                        echo!empty($shipment) ? $shipment->carrier->name . 
                                        ' ' . 
                                        $shipment->carrierPackageDetail->carrierPackage->carrier_package_name : ''; ?>
                            </div>
                            <?php 
                            $unique_code = 0;
                            if($customerInfo['paymentMethod']['payment_id'] == 1 || $customerInfo['paymentMethod']['payment_id'] == 2){
                                $unique_code = \common\components\Helpers::generateUniqueCode();
                                $_SESSION['customerInfo']['unique_code'] = $unique_code;
                            }?>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 myorder detail item header price value">
                                IDR 
                                <?php $grandTotal = $grandTotal - $discount + $unique_code; ?>
                                <?php 
                                    $shippingPrice = 0;
                                    // if shopping total condition more than 3 milion IDR
                                    // get free all shipping method service
                                    if($grandTotal >= 3000000) { 
                                        echo 0;
                                    } elseif($grandTotal >= 1000000 && $grandTotal < 3000000) { 
                                        // free shipping for regular shipping service
                                        if($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
                                            echo 0;
                                        } elseif($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
                                            $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;
                                            $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
                                            echo \common\components\Helpers::getPriceFormat($flatPrice * $weight); 
                                            $shippingPrice = $flatPrice * $weight;
                                        } else {
                                            echo \common\components\Helpers::getPriceFormat($shippingCost['price'] * $weight); 
                                            $shippingPrice = $shippingCost['price'] * $weight;
                                        }
                                    } elseif($grandTotal < 1000000){
                                        if($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
                                            $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;
                                            $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 1])->price;
                                            echo \common\components\Helpers::getPriceFormat($flatPrice * $weight); 
                                            $shippingPrice = $flatPrice * $weight;
                                        } elseif($shipment->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
                                            $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerInfo['shippingMethod']['customer_address_id']])->province_id;
                                            $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
                                            echo \common\components\Helpers::getPriceFormat($flatPrice * $weight); 
                                            $shippingPrice = $flatPrice * $weight;
                                        } else {
                                            echo \common\components\Helpers::getPriceFormat($shippingCost['price'] * $weight); 
                                            $shippingPrice = $shippingCost['price'] * $weight;
                                        }
                                    }else {
                                        echo \common\components\Helpers::getPriceFormat($shippingCost['price'] * $weight);
                                        $shippingPrice = $shippingCost['price'] * $weight;
                                    }
                                ?>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                            <?php if ($discount != 0) { ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    DISCOUNT
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    IDR <?php echo \common\components\Helpers::getPriceFormat($discount); ?>
                                </div>
                            <?php } ?>
                            
                            <?php
                            if($unique_code != 0){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value">
                                    UNIQUE CODE
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value">
                                    <?php echo $unique_code; ?>
                                </div>
                            <?php } ?>
                            <div class="clearfix hidden-lg hidden-md hidden-sm"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header value grand-total">
                                GRAND TOTAL
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 myorder detail item header price value grand-total">
                                IDR <?php echo \common\components\Helpers::getPriceFormat(($grandTotal + $shippingPrice)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding margin-top-10">
                    <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::base() . '/cart/checkout/step/confirmorder', "id" => "confirmorder-form"]) ?>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/paymentinformation" class="shipping-information position-left">DETAIL PEMBAYARAN</a>
                    <!--                <a href="#" class="edit" id="confirm-order">CONFIRM ORDER</a>-->
                    <input type="submit" value="KONFIRMASI PESANAN" id="confirm-order" class="btn-submit">
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>