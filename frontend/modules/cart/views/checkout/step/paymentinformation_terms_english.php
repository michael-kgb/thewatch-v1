<?php

use yii\web\Session;
use app\assets\VeritransAsset;

$sessionOrder = new Session();
$sessionOrder->open();
$cart = $sessionOrder->get("cart");

VeritransAsset::register($this);
//print_r($_SESSION);
?>
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
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/4.png" width="100%">
            </div>
        </div>
        <div class="row step-purchase">
            <div class="col-xs-12 clearleft clearright">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title">PAYMENT DETAILS</div>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 step-purchase separator clearleft clearright remove-padding"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 gotham-medium clearleft remove-padding-left no-spacing">
                            GRAND TOTAL
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 gotham-medium right clearleft clearright remove-padding no-spacing">
                            <?php
                            $items = $cart['items'];
                            if (count($items) > 0) {
                                $grandTotal = 0;
                                foreach ($items as $item) {
                                    $grandTotal += $item['total_price'];
                                }
                                ?>
                                <?php echo 'IDR ' . \common\components\Helpers::getPriceFormat($grandTotal); ?>
<?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping field field-ipad clearleft clearright remove-padding margin-top-3 padding-bottom-5 border-bottom-1">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 gotham-medium clearleft remove-padding-left no-spacing">
                            DISCOUNT
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 gotham-medium right clearleft clearright remove-padding no-spacing">
                            <span id="discount">
<?php echo $discount == 0 ? '-' : common\components\Helpers::getPriceFormat($discount); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 step-purchase separator clearleft clearright remove-padding"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box ipad clearleft clearright remove-padding">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding margin-top-5">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 gotham-medium clearleft remove-padding-left no-spacing">
                            TOTAL
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 gotham-medium right clearleft clearright remove-padding no-spacing">
                            <span id="total-price">
<?php echo 'IDR ' . \common\components\Helpers::getPriceFormat($grandTotal - $discount); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 step-purchase separator clearleft clearright remove-padding"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding margin-top-3 margin-bottom-5 padding-bottom-5 border-bottom-1 ipad">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 gotham-medium clearleft remove-padding no-spacing">
                            ADD PROMO CODE
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 right clearleft clearright remove-padding">
                            <input class="email" type="text" name="code" style="text-transform:uppercase">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 position-right clearleft clearright remove-padding">
                            <a href="#" id="apply-code" class="edit apply-code">APPLY</a>
                            <!--<input type="submit" class="apply" value="APPLY">-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase separator clearleft clearright remove-padding"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box ipad clearleft clearright remove-padding">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 gotham-medium clearleft remove-padding-left no-spacing">
                            PAYMENT METHOD
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 clearleft clearright remove-padding">
                            <select id="payment_method" class="shipping" name="year">
                                <option value="0" selected="selected">PLEASE SELECT</option>
                                <?php if (count($paymentMethod) > 0) { ?>
                                    <?php foreach ($paymentMethod as $payment) { ?>
                                        <option value="<?php echo $payment->payment_method_id; ?>"><?php echo $payment->payment_method_name; ?></option>
                                    <?php } ?>
<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag payment separator clearleft clearright remove-padding margin-top-10">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft payment-error" style="display: none;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft">
                            <span id="payment-error">* Payment Method Is Required</span>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag installmentform separator clearleft clearright remove-padding margin-top-10" style="display: none;">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 clearleft remove-padding-left text-gotham-light">
                            INSTALLMENT PLAN
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 col-lg-offset-1 clearleft clearright remove-padding">
                            <select id="installmentplan" class="installmentplan" name="installmentplan">
                                <option value="0" selected>MONTH</option>
                                <option value="3">3 MONTH</option>
                                <option value="6">6 MONTH</option>
                                <option value="12">12 MONTH</option>
                            </select>
                        </div>
                    </div>
                    <form action="<?php echo \yii\helpers\Url::base(); ?>/cart/payment/credit-card" method="POST" id="payment-form">
                        
                        <input type="hidden" name="installment" value="false">
                        <input type="hidden" name="installment_plan" value="0">
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag creditcardform separator clearleft clearright remove-padding" style="display: none;">
                            <span class="gotham-light line-height2 no-spacing">
                                ENTER YOUR CREDIT CARD NUMBER <br>
                                CREDIT CARD INFORMATION
                            </span>
                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                            <input class="cardholder" type="text" name="email" placeholder="Card Holder Name">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-creditcard separator">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/lock.png" class="img-responsive lock-icon">
                                <span class="gotham-light line-height2 secure-text no-spacing no-lineheight">
                                    SECURE CREDIT CARD PAYMENT <br>
                                    This is a secure 128-bit SSL encrypted payment
                                </span>
                                <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                                <input class="cardholder card-number" type="text" name="card-number" placeholder="Credit Card Number">
                                <span class="gotham-light line-height2 fsize-0-8">
                                    16 digits of credit card number
                                </span>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft mtop2 remove-padding">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 clearleft remove-padding-left">
                                        <select id="card-expiry-month" class="shipping mtop2 card-expiry-month">
                                            <option value="0" selected="selected">EXPIRY MONTH</option>
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <option value="<?php echo '0' . $i; ?>"><?php echo $i; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 clearleft remove-padding-right">
                                        <select id="card-expiry-year" class="shipping mtop2 card-expiry-year">
                                            <option value="0" selected="selected">EXPIRY YEAR</option>
                                            <?php
                                            $year = date('Y');
                                            for ($i = 1; $i <= 10; $i++) {
                                                ?>
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
    <?php $year += 1;
} ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft mtop2 remove-padding">
                                    <span class="gotham-light line-height2 fsize-0-8">
                                        The date your credit card expires. Find this one on the front of your credit card.
                                    </span>
                                </div>
                                <input class="cardholder card-cvv" type="password" placeholder="Security Code">
                                <input id="token_id" name="token_id" type="hidden" />
                                <input id="payment_id" name="payment_id" type="hidden" />
                                <input id="payment_method_id" name="payment_method_id" type="hidden" />
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                    <span class="gotham-light line-height2 fsize-0-8">
                                        or 'CVC' or 'CVV'. The last 3 digits displayed on the back of your credit card.
                                    </span>
                                </div>
                            </div>
                        </div>

                    </form>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag separator clearleft clearright remove-padding margin-top-10">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-medium clearleft remove-padding-left no-spacing margin-top-5">
                            TERMS AND CONDITIONS
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light confirmation order-info clearleft remove-padding">
                            <!--<input type="checkbox" id="rc001" name="payment_method">-->
                            <!--<input type="checkbox" name="payment_method" id="agreement" class="">-->
                            <div class="checkbox-btn agreement-checkbox ipad">
                                <input type="checkbox" id="agreement" name="payment_method">
                                <label for="agreement" class="black-style" style="color: #000;" onclick>I AGREE WITH THE TERMS AND CONDITIONS</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 clearleft agreement-error" style="display: none;">
                            <div class="col-lg-12 col-md-12 col-sm-12 clearleft">
                                <span id="agreement-error">* Agreement Is Required</span>
                            </div>
                        </div>
                        <!--                    <div class="col-lg-12 col-md-12 col-sm-12 gotham-light confirmation order-info clearleft">
                                                <input type="checkbox" name="payment_method" class="">
                                                CREATE THE WATCH CO. MEMBER ACCOUNT
                                            </div>-->
                    </div>
                </div>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 step-purchase separator clearleft clearright remove-padding"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box clearleft clearright remove-padding padding-top-5 border-top-button margin-top-3">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryinformation" class="shipping-information position-left">SHIPPING INFORMATION</a>
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/revieworder" id="payment-info" class="edit ipad">NEXT</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="portfolio-modal modal fade forgot agreement" id="agreementModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content agreement">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="height: 45px;">
            <a href="#">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-white.png" class="close-button-terms-conditions">
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding padding-terms-conditions">
            <div class="modal-body">
                <div class="terms-conditions-title">TERMS AND CONDITIONS</div>
                <div class="terms-conditions-sub-title">REGISTATION REQUIREMENTS</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #fff;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email remove-padding clearright terms-condition-description">
                        Registration is required for some of the services or features available on this Site. 
                        We require current, valid, and true information about you in all respects. 
                        If you change your information, you must write to us with the new information immediately to 
                        <b>cs@thewatch.co</b>. 
                        The account password you provide should be unique and kept secure, and you must notify The Watch Co team immediately of any breach of security or unauthorized use of your account.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="terms-conditions-sub-title">WARRANTY</div>
                <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright remove-padding" style="color: #fff;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 customer-login email remove-padding clearright terms-condition-description">
                        Warranty term: One year from the date of purchase. 
                        The Watch co warranty covers only material and manufacturing defects. 
                        This warranty does not cover batteries, straps, 
                        scratches or any damages arising from normal wear or misuse, 
                        or from any alteration, service or repair performed by any party other than The Watch Co. 
                        Once you get the goods delivered, please make sure to check the quality of our timepieces. 
                        You may also e-mail our team at <b>cs@thewatch.co</b>.  and we will be happy to assist you.
                        <br>
                        <br>
                        This warranty does not cover:
                        <br>
                        <br>
                        - Failure or damage caused by improper use or carelessness
                        <br>
                        - Failure or damage caused by outer force like dropping or hitting
                        <br>
                        - Failure or damage caused by unjustifiable repair or modifications
                        <br>
                        - Failure or damage caused by fire, water, or a natural disaster such as an earthquake
                        <br>
                        - Esthetic changes that occur during use (minor scratches, etc.; on the case glass, watchband)
                        <br>
                        - In case the retail store and the purchase date are not indicated on the warranty, or if this information has been rewritten
                        <br>
                        - If the warranty is not submitted along with the watch.
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="terms-conditions-sub-title">ELIGIBILITY TO PURCHASE</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #fff;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description">
                        For you to do transaction on Our Website, you need to provide us with your particulars including real name, contact number, e-mail address and other information as indicated. You will also be requested to provide payment details that are both valid and correct and you confirm that you are the person referred to in the Billing information provided.
                        The Watch Co only deal with individual who meet our terms of eligibility and those who have been issued a valid credit card by a bank acceptable to The Watch Co. In addition, you agree that we may use Personal information provided by you in order to conduct appropriate anti-fraud checks. Personal Information that you provide may be disclosed to a credit reference or fraud prevention agency, which may keep a record of that information.

                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="terms-conditions-sub-title">PAYMENT</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #fff;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description">

                        You can choose to pay with credit or debit cards. Credit Card transactions are managed through Veritrans and for Installment by Ipay88.

                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="terms-conditions-sub-title">PAYMENT BY CARD</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #fff;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description">

                        Pay with your Visa or MasterCard securely over the Internet. Your payment is handled by IPAY88 with secure encryption and under strict banking standards. Your card details are sent directly to the bank and can not be read or accessed by anyone other than your bank.

                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="terms-conditions-sub-title">CONFIRMATION</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #fff;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description">

                        Once we have received your order we will send a confirmation to your e-mail address. It is therefore important that you enter your real e-mail address when placing your order. Save this e-mail in order to facilitate any contact with customer service. The order confirmation (receipt) also serves as a guarantee of proof of purchase.

                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="terms-conditions-sub-title">COMPLAINTS TERMS AND WITHDRAWAL</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #fff;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description" style="padding-bottom: 13%;">

                        It is important that you as a customer check your goods / products when you receive your shipment in order to verify that the products are not damaged and correct.  For all inquiries regarding returns and defective items, please e-mail 
                        <b>cs@thewatch.co</b>
                        before sending your watch to us, in order to verify the correct local shipping address and ensure timely processing of your request. or through our contact form on the contact page. Please supply the order number and the reason for complaint and we will get back to you shortly with instructions on how to return the item. Please contact us within 14 days. Defective products returned to The Watch Co should be treated as if they were faultless. It is in all types of returns extremely important that the product is packaged in such a way that it can not be damaged.
                        <br>
                        <br>
                        Discount Vouchers Code
                        <br>
                        You Can use Vouchers only for the watches. Terms and conditions as follows:
                        <br>
                        <br>

                        1.	 Fill in the code number of your discount voucher
                        <br>

                        2.	Voucher is not exchangeable and is non-refundable for cash in the currency
                        <br>

                        3.	Voucher can only be used for 1 transaction on the Site
                        <br>

                        4.	Voucher is not  for resale and is not transferable to other party
                        <br>

                        5.	Voucher cannot be used for any purchase product(s) less than the value of the voucher.
                        <br>
                        <br>
                        If you need assistance with respect to Voucher or Discount Codes, please contact <a href="mailto:cs@thewatch.co" style="color: white; text-decoration: none;">cs@thewatch.co</a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var grossamount = '<?php
$weight = common\components\Helpers::generateWeightOrder($items);
echo ($grandTotal + $shippingCost['price'] * $weight) - $discount;
?>';
</script>