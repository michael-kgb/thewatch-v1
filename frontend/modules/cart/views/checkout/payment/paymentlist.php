<!-- <?php $GLOBALS['unique'] = $unique_code; ?> -->
<?php if(count($paymentMethod) > 0) { ?>
<?php $paymentAlias; ?>
<?php foreach ($paymentMethod as $payment) { ?>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 clearleft remove-padding">
    <?php $paymentAlias = backend\models\PaymentMethod::findOne(['payment_method_id' => $payment->payment_method_id])->payment_method_alias; ?>
<!--    <input type="radio" id="<?php echo $paymentAlias; ?>" name="payment_method" class="payment-method-radio" value="<?php echo $payment->payment_id; ?>">
    <div class="img-bank">
        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->payment->filename; ?>" class="img-responsive logo-payment">
    </div>-->
    <div class="radio-btn">
        <input type="radio" data-id="<?php echo $paymentAlias; ?>" id="<?php echo $payment->payment_id; ?>" name="payment_method" class="payment-method-radio payment_method_u" value="<?php echo $payment->payment_id; ?>">
        <label for="<?php echo $payment->payment_id; ?>" class="black-style" onclick="" style="color: #000;">
            <div class="img-bank">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->payment->filename; ?>" class="img-responsive">
            </div>
        </label>
    </div>
</div>
<?php } ?>
<?php } ?>

<script>
$('input:radio[data-id=cc]').on('change', function() {
    $('.creditcardform').show();
});

$('input:radio[data-id=ip]').on('change', function() {
    $('.installmentform').show();
});

$('input:radio[data-id=kv]').on('change', function () {
    if ($(this).is(":checked")) {
        $("#kredivoModal").modal("show");
    }
});

$('input:radio[data-id=bt]').on('change', function () {
    if ($(this).is(":checked")) {
        $('div.unique_code').css('display','block');
    }
});



</script>