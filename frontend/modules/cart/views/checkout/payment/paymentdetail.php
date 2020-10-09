<?php
    session_start();
    $carts = $_SESSION['cart']['items'];
    $flash_flag = 0;
    foreach ($carts as $cart) {
        if($cart['flash_sale'] == 1){
            $flash_flag = 1;
        }
    }
?>

<?php if($paymentMethod->payment_method_id == 3){ ?>
<div class="fcolor69 payment-preview-installment-name" style="">
        <?php echo $paymentMethod->payment_method_name; ?> <span class="hidden-lg">Plan</span>
        
    </div>
<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="payment-preview-installment-img" style="">
	
    <div class="fcolor69 payment-preview-installment-title" style="">
        Anda akan melakukan pembayaran <br>
        menggunakan <?php echo $payment->name_bank; ?>
        
    </div>
    <div class="fcolor69" id="pilih_bulan" style="">

        Silahkan memilih jangka waktu <br> pembayaran cicilan berdasarkan <br> bulan yang anda inginkan.
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 clearleft remove-padding payment-preview-installment-month" style="">
                                <?php $shippingInsurance = 0; ?>
                                <?php
                                    $shippingInsurance = $_SESSION['customerInfo']['shippingMethod']['shipping_insurance'];
                                    if($shippingInsurance){
                                        $shippingInsurance = $grandOriginalTotal;
                                        $shippingInsurance = (($shippingInsurance * 0.5) / 100);
                                    }
                                ?>
                         
                            <?php if($payment->payment_id != 14){?>
                            <div class="radio-btn" style="margin-left: 30px;">
                                <input type="radio" data-id="installmentplan" id="3p" name="installmentplan" class="payment-method-radio payment_method_u" value="i3m">
                                <label for="3p" class="black-style" style="color: #000;padding-left: 10px;" onclick="choose_installment_plan(<?php echo $payment->payment_id; ?>)">
                                    3 Bulan | <?php echo  'IDR ' . \common\components\Helpers::getPriceFormat(($grandTotal - $discount + $shippingCost + $shippingInsurance)/3); ?> / bulan
                                </label>
                            </div>
                            <?php } ?>
                       
							<?php if($payment->payment_id != 17){?>
                            <div class="radio-btn" style="margin-left: 30px;">
                                <input type="radio" data-id="installmentplan" id="6p" name="installmentplan" class="payment-method-radio payment_method_u" value="i6m">
                                <label for="6p" class="black-style" style="color: #000;padding-left: 10px;" onclick="choose_installment_plan(<?php echo $payment->payment_id; ?>)">
                                    6 Bulan | <?php echo  'IDR ' . \common\components\Helpers::getPriceFormat(($grandTotal - $discount + $shippingCost + $shippingInsurance)/6); ?> / bulan
                                </label>
                            </div>
                            <?php } ?>
                       
							<?php if($payment->payment_id != 17){?>
                            <div class="radio-btn" style="margin-left: 30px;">
                                <input type="radio" data-id="installmentplan" id="12p" name="installmentplan" class="payment-method-radio payment_method_u" value="i12m">
                                <label for="12p" class="black-style" style="color: #000;padding-left: 10px;" onclick="choose_installment_plan(<?php echo $payment->payment_id; ?>)">
                                    12 Bulan | <?php echo  'IDR ' . \common\components\Helpers::getPriceFormat(($grandTotal - $discount + $shippingCost + $shippingInsurance)/12); ?> / bulan
                                </label>
                            </div>
                            <?php } ?>
                       
                        </div>
<div class="portfolio-modal modal fade forgot agreement rgb243" id="installmentform" tabindex="-1" role="dialog" aria-hidden="true" style="">
    <div class="modal-content agreement rgb243" style="text-align:left;height: auto;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rgb243 clearleft clearright" data-dismiss="modal" style="">
            <a href="#">
                <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-white.png" class="close-button-terms-conditions">-->
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rgb243 clearleft clearright clearleft-mobile clearright-mobile">
            <div class="modal-body" style="padding: 0;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile remove-padding" style="color: #000;padding-top: 2%;">
                    <form action="<?php echo \yii\helpers\Url::base(); ?>/payment/credit-card" method="POST" id="payment-form">
                        
                        <input type="hidden" name="installment" value="false">
                        <input type="hidden" name="installment_plan" value="0">
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag creditcardform clearleft-mobile clearright-mobile remove-padding" style="padding-top: 20px;padding-bottom: 20px;padding-left: 30px;padding-right: 30px;">
                            <span class="gotham-medium no-spacing" style="font-size: 14px;">
                                Credit Card Number & Information
                            </span>
                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                            <input class="cardholder" type="text" name="email" placeholder="Card Holder Name" style="border-radius: 25px;border:0;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearright clearleft clearleft-mobile clearright-mobile">
                                <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/lock.png" class="img-responsive lock-icon"> -->
                                <span class="gotham-medium secure-text no-spacing no-lineheight ccil-text" style="margin-left: 0;position: relative;">
                                    Secure Credit Card Payment <br>
                                    This is a secure 128-bit SSL encrypted payment
                                </span>
                                <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                                <div style="position: relative;">
                                <input class="cardholder card-number" type="text" name="card-number" onchange="verifyBank(<?=$payment->payment_id;?>, this)" placeholder="Credit Card Number" style="border-radius: 25px;border:0;">
                                    <div class="credit-valid" style="display: none;">false</div>
                                    <div class="credit-length" style="display: none;">false</div>
                                    <div class="credit-luhn" style="display: none;">false</div>
                                   <!--  <p class="log"></p> -->
                                    <img class="icon-mastercard install" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/mastercard.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                    <img class="icon-visa install" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/visa.png" width=35 style="display:none;position: absolute;right: 5px;" />
									<img class="icon-jcb install" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/jcb.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                </div>
								<input type="hidden" value="mandiri" name="acquiring_bank" />
                                <span class="gotham-light line-height2 ccil-text" style="font-style: italic;">
                                    16 digits of credit card number
                                </span>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mtop2 remove-padding">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-left">
                                        <select id="card-expiry-month" class="shipping mtop2 card-expiry-month" style="border:0;border-radius: 25px;height: 33px;">
                                            <option value="0" selected="selected">MONTH</option>
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <?php if($i <= 9){ ?>
                                                <option value="<?php echo '0' . $i; ?>"><?php echo $i; ?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-right">
                                        <select id="card-expiry-year" class="shipping mtop2 card-expiry-year" style="border:0;border-radius: 25px;height: 33px;">
                                            <option value="0" selected="selected">YEAR</option>
                                            <?php
                                            $year = date('Y');
                                            for ($i = 1; $i <= 15; $i++) {
                                                ?>
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                            <?php $year += 1;
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft mtop2 remove-padding">
                                    <span class="gotham-light ccil-text" style="font-style: italic;">
                                        The date your credit card expires. Find this one on the front of your credit card.
                                    </span>
                                </div>
                                <input style="border-radius: 25px;border:0;" class="cardholder card-cvv" type="password" placeholder="Security Code" maxlength=4>
                                <input id="token_id" name="token_id" type="hidden" />
                                <input id="payment_id" name="payment_id" type="hidden" />
                                <input id="payment_method_id" name="payment_method_id" type="hidden" />
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                    <span class="gotham-light ccil-text" style="font-style: italic;">
                                        or 'CVC' or 'CVV'. The last 3 digits displayed on the back of your credit card.
                                    </span>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rgb243 clearleft clearright">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                	<div class="col-lg-4"></div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description" style="padding-bottom: 13%;">
                        <a href="#" data-dismiss="modal" class="editpay" style="width: 100%;border-radius: 25px;text-align: center;">OK</a>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
   <script src="<?php echo \yii\helpers\Url::base(); ?>/js/validator/jquery.creditCardValidator.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('input.cardholder.card-number').validateCreditCard(function(result) {
                               
                                var card_name = result.card_type == null ? '-' : result.card_type.name;
                                if(card_name == 'mastercard'){
                                    $('img.icon-mastercard').css("display","block");
                                    $('img.icon-visa').css("display","none");
									$('img.icon-jcb').css("display","none");
                                    $('input[name=payment_id]').val(11);
									acquiringBank = 'mandiri';
									$('input[name=acquiring_bank]').val(acquiringBank);
                                }
                                else if(card_name == 'visa'){
                                    $('img.icon-mastercard').css("display","none");
									$('img.icon-jcb').css("display","none");
                                    $('img.icon-visa').css("display","block");
                                    $('input[name=payment_id]').val(3);
									acquiringBank = 'mandiri';
									$('input[name=acquiring_bank]').val(acquiringBank);
								}
								else if(card_name == 'jcb'){
                                    $('img.icon-mastercard').css("display","none");
									$('img.icon-visa').css("display","none");
                                    $('img.icon-jcb').css("display","block");
                                    $('input[name=payment_id]').val(31);
									acquiringBank = 'bni';
									$('input[name=acquiring_bank]').val(acquiringBank);
                                }else{
                                    $('img.icon-mastercard').css("display","none");
                                    $('img.icon-visa').css("display","none");
									$('img.icon-jcb').css("display","none");
                                }
                                if(result.valid == '' || result.length_valid == '' || result.luhn_valid == ''){
                                    $('.cardholder.card-number').css("border","solid 2px rgb(161,29,33)");
                                }
                                else{
                                    $('.cardholder.card-number').css("border","none");
                                }
                                if($('.cardholder.card-number').val() == ''){
                                    $('.cardholder.card-number').css("border","none");
                                }
                                
                                $('.credit-valid').html(result.valid);
                                $('.credit-length').html(result.length_valid);
                                $('.credit-luhn').html(result.luhn_valid);                               
                            });
                        });
                    </script>

<?php }elseif($paymentMethod->payment_method_id == 2){ ?>
    
	<form action="<?php echo \yii\helpers\Url::base(); ?>/payment/credit-card" method="POST" id="payment-form">
                        
                        <input type="hidden" name="installment" value="false">
                        <input type="hidden" name="installment_plan" value="0">
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag creditcardform clearleft-mobile clearright-mobile remove-padding" style="">
                            <div class="hidden-lg hidden-md hidden-sm col-xs-6 clearleft-mobile clearright-mobile" id="back-credit">
                                <label class="metode-pembayaran-title list">
                                    Credit Card
                                </label>
                            </div>
                            <div class="hidden-lg hidden-md hidden-sm col-xs-6 clearleft-mobile clearright-mobile" id="back-credit" style="min-height: 50px;">
                                <label class="metode-lain">
                                    <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                                </label>               
                            </div>
                            <span class="gotham-medium no-spacing" style="font-size: 14px;">
                                Credit Card Number & Information
                            </span>
                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                            <input class="cardholder" type="text" name="email" placeholder="Card Holder Name" style="border-radius: 25px;border:0;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearright clearleft clearleft-mobile clearright-mobile">
                                <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/lock.png" class="img-responsive lock-icon"> -->
                                <span class="gotham-medium secure-text no-spacing no-lineheight ccil-text" style="margin-left: 0;position: relative;">
                                    Secure Credit Card Payment <br>
                                    This is a secure 128-bit SSL encrypted payment
                                </span>
                                <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                                <div style="position: relative;">
                                    <input class="cardholder card-number credit" type="text" onchange="checkBank(this)" name="card-number" placeholder="Credit Card Number" style="border-radius: 25px;border:0;">
                                    <div class="credit-valid" style="display: none;">false</div>
                                    <div class="credit-length" style="display: none;">false</div>
                                    <div class="credit-luhn" style="display: none;">false</div>
                                   <!--  <p class="log"></p> -->
                                    <img class="icon-mastercard" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/mastercard.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                    <img class="icon-visa" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/visa.png" width=35 style="display:none;position: absolute;right: 5px;" />
									<img class="icon-jcb" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/jcb.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                </div>
								<input type="hidden" value="mandiri" name="acquiring_bank" />
         
                                <span class="gotham-light line-height2 ccil-text" style="font-style: italic;">
                                    16 digits of credit card number
                                </span>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mtop2 remove-padding">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-left">
                                        <select id="card-expiry-month" class="shipping mtop2 card-expiry-month" style="border:0;border-radius: 25px;height: 33px;">
                                            <option value="0" selected="selected">MONTH</option>
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <?php if($i <= 9){ ?>
                                                <option value="<?php echo '0' . $i; ?>"><?php echo $i; ?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-right">
                                        <select id="card-expiry-year" class="shipping mtop2 card-expiry-year" style="border:0;border-radius: 25px;height: 33px;">
                                            <option value="0" selected="selected">YEAR</option>
                                            <?php
                                            $year = date('Y');
                                            for ($i = 1; $i <= 15; $i++) {
                                                ?>
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                            <?php $year += 1;
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft mtop2 remove-padding">
                                    <span class="gotham-light ccil-text" style="font-style: italic;">
                                        The date your credit card expires. Find this one on the front of your credit card.
                                    </span>
                                </div>
                                <input style="border-radius: 25px;border:0;" class="cardholder card-cvv" type="password" placeholder="Security Code" maxlength=4>
                                <input id="token_id" name="token_id" type="hidden" />
                                <input id="payment_id" name="payment_id" type="hidden" />
                                <input id="payment_method_id" name="payment_method_id" type="hidden" />
                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                    <span class="gotham-light ccil-text" style="font-style: italic;">
                                        or 'CVC' or 'CVV'. The last 3 digits displayed on the back of your credit card.
                                    </span>
                                </div>
                            </div>
                        </div>

                    </form>
                    <script src="<?php echo \yii\helpers\Url::base(); ?>/js/validator/jquery.creditCardValidator.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('input.cardholder.card-number.credit').validateCreditCard(function(result) {
                               
                                var card_name = result.card_type == null ? '-' : result.card_type.name;
                                if(card_name == 'mastercard'){
                                    $('img.icon-mastercard').css("display","block");
                                    $('img.icon-visa').css("display","none");
									$('img.icon-jcb').css("display","none");
                                    $('input[name=payment_id]').val(11);
									acquiringBank = 'mandiri';
									$('input[name=acquiring_bank]').val(acquiringBank);
                                }
                                else if(card_name == 'visa'){
                                    $('img.icon-mastercard').css("display","none");
									$('img.icon-jcb').css("display","none");
                                    $('img.icon-visa').css("display","block");
                                    $('input[name=payment_id]').val(3);
									acquiringBank = 'mandiri';
									$('input[name=acquiring_bank]').val(acquiringBank);
								}
								else if(card_name == 'jcb'){
                                    $('img.icon-mastercard').css("display","none");
									$('img.icon-visa').css("display","none");
                                    $('img.icon-jcb').css("display","block");
                                    $('input[name=payment_id]').val(31);
									acquiringBank = 'bni';
									$('input[name=acquiring_bank]').val(acquiringBank);
                                }else{
                                    $('img.icon-mastercard').css("display","none");
                                    $('img.icon-visa').css("display","none");
									$('img.icon-jcb').css("display","none");
                                }
                                if(result.valid == '' || result.length_valid == '' || result.luhn_valid == ''){
                                    $('.cardholder.card-number.credit').css("border","solid 2px rgb(161,29,33)");
                                }
                                else{
                                    $('.cardholder.card-number.credit').css("border","none");
                                }
                                if($('.cardholder.card-number.credit').val() == ''){
                                    $('.cardholder.card-number.credit').css("border","none");
                                }
                                
                                $('.credit-valid').html(result.valid);
                                $('.credit-length').html(result.length_valid);
                                $('.credit-luhn').html(result.luhn_valid);   
								console.log(card_name);
                            });
                        });
                    </script>
<?php }elseif($paymentMethod->payment_method_id == 9){ ?>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
    <div class="col-lg-12 col-xs-12 fsize-13 rgb243">
        <?php
                                    $shippingInsurance = $_SESSION['customerInfo']['shippingMethod']['shipping_insurance'];
                                    if($shippingInsurance){
                                        $shippingInsurance = $grandOriginalTotal;
                                        $shippingInsurance = (($shippingInsurance * 0.5) / 100);
                                    }
                                ?>
        
        <!--<div class="col-lg-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">-->
        <!--    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">Total</div>-->
        <!--</div>-->
        <!--<div class="col-lg-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile gotham-medium talign-right">-->
        <!--    Rp. <?php echo \common\components\Helpers::getPriceFormat($grandTotal - $discount + $shippingCost + $shippingInsurance); ?>-->
        <!--</div>-->
        <!--<div class="vertical-line col-lg-12 col-sm-12 col-md-12 col-xs-12" style="margin-top: 5px;margin-bottom: 5px;"></div>-->
        <div class="col-lg-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
            Bagaimana cara membayarnya? <br>
            Silahkan selesaikan pembayaran <span class="gotham-medium">GO-PAY</span> Anda menggunakan aplikasi <span class="gotham-medium">GO-JEK.</span>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
        <div class="col-xs-12 col-md-12 col-sm-12 hidden-lg clearleft clearright clearleft-mobile clearright-mobile gotham-light">
            <ol style="padding-left: 15px;">
              <li style="margin-left: 0;">Klik <span class="gotham-medium">Pay Now with GO-PAY.</span></li>
              <li style="margin-left: 0;">Aplikasi <span class="gotham-medium">GO-JEK</span> akan terbuka.</li>
              
              <li style="margin-left: 0;">Cek detail pembayaran Anda lalu klik bayar dan pembayaran Anda telah selesai.</li>
            </ol>
        </div>
        <div class="col-lg-12 hidden-md hidden-sm hidden-xs clearleft clearright clearleft-mobile clearright-mobile gotham-light">
            <ol style="padding-left: 15px;">
              <li style="margin-left: 0;">Klik <span class="gotham-medium">Pay Now with GO-PAY.</span></li>
              <li style="margin-left: 0;">Buka aplikasi <span class="gotham-medium">GO-JEK</span> di handphone Anda.</li>
              <li style="margin-left: 0;">
                Klik <span class="gotham-medium">Scan QR.</span><br>
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-1.png" class="img-responsive" style="width: 60%;margin: auto;">
                <span class="fsize-11 gotham-medium">Catatan:</span><br>
                <span class="fsize-11">Tombol Scan QR tidak akan muncul jika saldo
                        GO-PAY Anda kurang dari Rp10,000.</span>
              </li>
              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
              <li style="margin-left: 0;">
                Arahkan kamera Anda ke <span class="gotham-medium">QR Code.</span><br>
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-2.png" class="img-responsive" style="width: 60%;margin: auto;">
              </li>
              <li style="margin-left: 0;">Cek detai pembayaran Anda di aplikasi <span class="gotham-medium">GO-JEK</span> lalu <span class="gotham-medium">klik Pay.</span></li>
              <li style="margin-left: 0;">Transaksi Anda telah selesai.</li>
            </ol>
        </div>
    </div>
<?php }else{ ?>
	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="payment-preview-img <?php if($payment->payment_id == 20){ echo 'akulaku';} ?>" style="<?php if($paymentMethod->payment_method_id == 2){ echo 'left:106px;width: 80px;';} ?>">
    
	<?php if($paymentMethod->payment_method_id == 2){ ?>
        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/mastercard.png" class="payment-preview-img <?php if($payment->payment_id == 20){ echo 'akulaku';} ?>" style="<?php if($paymentMethod->payment_method_id == 2){ echo 'left:196px;width: 60px;';} ?>">
    <?php } ?>
    <div class="fcolor69 hidden-xs" style="position: absolute;top:15px;width:100%;left:30px;font-size: 14px;font-family: gotham-medium;">
        <?php echo $paymentMethod->payment_method_name; ?>
        
    </div>
    <div class="fcolor69 title-payment-preview" style="">
        Anda Akan Menggunakan
        
    </div>
    
    <div class="fcolor69 detail-payment-preview" style="">

        <?php if($paymentMethod->payment_method_id == 2){ ?>
            <?php echo $paymentMethod->payment_method_name; ?>
        <?php }elseif($paymentMethod->payment_method_id == 3){ ?>
            <?php echo $payment->name_bank; ?>
        
        <?php }else{ ?>
            <?php echo $paymentMethod->payment_method_name.' '.$payment->name_bank; ?>
        <?php } ?>
    </div>
<?php } ?>
<script type="text/javascript">

</script>

<style type="text/css">
    .payment-preview-img{
        position: absolute;top: 25%;left: 123px;
    }
    .title-payment-preview{
        position: absolute;top:53%;width:100%;text-align:center;font-size: 14px;font-family: gotham-light;
    }
    .detail-payment-preview{
        position: absolute;top:58%;width:100%;text-align:center;font-size: 14px;font-family: gotham-medium;
    }
    .payment-preview-installment-img{
        position: absolute;top: 15%;left: 30px;
    }
    .payment-preview-installment-title{
        position: absolute;top:37%;width:100%;font-size: 14px;left:30px;font-family: gotham-medium;
    }
    .payment-preview-installment-name{
        position: absolute;top:15px;width:100%;left:30px;font-size: 14px;font-family: gotham-medium;
    }
    #pilih_bulan{
        position: absolute;top:53%;width:100%;left:30px;font-size: 14px;font-family: gotham-light;
    }
    .payment-preview-installment-month{
        position: absolute;top:73%;
    }
    #installmentform{
        padding: 0;left: 37%;right: 37%;max-height: none;
    }
    .shopping-bag.creditcardform{
        padding-top: 15px;padding-bottom: 6px;padding-left: 30px;padding-right: 30px;
    }
    .icon-mastercard{
        top: -14px;
    }
    .icon-visa{
        top: -10px;
    }
	.icon-jcb{
        top: -18px;
    }
	.icon-jcb.install{
        top: -20px;
    }
    .icon-mastercard.install{
        top: -20px;
    }
    .icon-visa.install{
        top: -16px;
    }
    span.ccil-text{
        font-size: 12px;
    }
    @media only screen and (max-width : 1365px) and (min-width: 1280px) {
        span.ccil-text{
            font-size: 10px;
        }
    }
    @media only screen and (max-width : 1040px) and (min-width: 1033px){
        .shopping-bag.creditcardform{
            padding-left: 15px;padding-right: 15px;background-color: rgb(243,243,243);border-radius: 5px;
        }
        #installmentform{
            left: 30%;right: 30%;top: 12px;bottom: 12px;border-radius: 5px;
        }
        .icon-mastercard,.icon-mastercard.install{
            top: 0px;
        }
		.icon-jcb,.icon-jcb.install{
            top: 0px;
        }
        .icon-visa,.icon-visa.install{
            top: 3px;
        }
        .secure-text{
            padding-left: 0;
        }
    }
    @media only screen and (max-width : 1032px) and (min-width: 768px){
        .shopping-bag.creditcardform{
            padding-left: 15px;padding-right: 15px;background-color: rgb(243,243,243);border-radius: 5px;
        }
        #installmentform{
            left: 25%;right: 25%;top: 12px;bottom: 12px;border-radius: 5px;
        }
        .icon-mastercard,.icon-mastercard.install{
            top: 0px;
        }
		.icon-jcb,.icon-jcb.install{
            top: 0px;
        }
        .icon-visa,.icon-visa.install{
            top: 3px;
        }
        .secure-text{
            padding-left: 0;
        }
    }
    @media only screen and (max-width : 767px) {
        .payment-preview-img{
            left: 35%;
        }
        .title-payment-preview{
            top:50%;
        }
        .detail-payment-preview{
           top:62%;
        }
        .payment-preview-installment-img{
            position: relative;
        }
        .payment-preview-installment-title{
            position: relative;padding-top: 20px;padding-bottom: 15px;
        
        }
        .payment-preview-installment-name{
            position: relative;top:0px;padding-top: 20px;padding-bottom: 20px;
        }
        #pilih_bulan{
            position: relative;padding-bottom: 15px;
        }
        .payment-preview-installment-month{
            position: relative;padding-bottom: 15px;
        }
        #installmentform{
            left: 12px;right: 12px;top: 12px;bottom: 12px;border-radius: 5px;
        }
        .shopping-bag.creditcardform {
            margin-top: 0%;
        }
        .secure-text{
            padding-left: 0;
        }
        .shopping-bag.creditcardform{
            padding-left: 15px;padding-right: 15px;background-color: rgb(243,243,243);border-radius: 5px;
        }
        .payment-preview-img.akulaku{
            width: 60px;top: 15px;left: 41%;
        }
        .icon-mastercard,.icon-mastercard.install{
            top: 18px;
        }
		.icon-jcb,.icon-jcb.install{
            top: 15px;
        }
        .icon-visa,.icon-visa.install{
            top: 22px;
        }
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('input.cardholder.card-number').on('paste', function() {
          var $el = $(this);
          setTimeout(function() {
            $el.val(function(i, val) {
              return val.replace(/\s/g, '')
            })
          })
        });

        $('input.cardholder.card-cvv').on('paste', function() {
        
            $(this).val($(this).val().replace(' ', '') );
        });
       
        $('input.cardholder.card-cvv').keypress(function( e ) {
        
            if(e.which < 48 || e.which > 57) 
                return false;
        });
        $('input.cardholder.card-number').keypress(function( e ) {
        
            if(e.which < 48 || e.which > 57) 
                return false;
        });



    });

</script> 