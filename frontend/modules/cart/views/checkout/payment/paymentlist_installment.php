<?php if (count($paymentMethod) > 0) { ?>
<?php $i = 1; ?>
    <?php $paymentAlias; ?>
    <?php foreach ($paymentMethod as $payment) { ?>				<?php if($payment->payment_id != 19){ ?>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 box-bank clearleft remove-padding">
            <?php $paymentAlias = backend\models\PaymentMethod::findOne(['payment_method_id' => 3])->payment_method_alias; ?>
            <div class="radio-btn">
                <input type="radio" data-id="<?php echo $paymentAlias; ?>" id="<?php echo $payment->payment_id; ?>" name="payment_method" class="payment-method-radio" value="<?php echo $payment->payment_id; ?>">
                <label for="<?php echo $payment->payment_id; ?>" class="black-style" onclick="" style="color: #000;">
                    <div class="img-bank">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->payment->filename; ?>" class="img-responsive">
                    </div>
                </label>
            </div>
<!--            <input type="radio" id="<?php echo $paymentAlias; ?>" name="payment_method" class="payment-method-radio" value="<?php echo $payment->payment_id; ?>">
            <div class="img-bank">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->payment->filename; ?>" class="img-responsive">
            </div>-->
        </div>				<?php } ?>
        <?php if($i == 3 || $i == 6){ ?>
        <div class="clearfix hidden-xs"></div>
        <div class="pbottom5 hidden-xs"></div>
        <?php } ?>
		
		<?php if($i == 2 || $i == 4 || $i == 6){ ?>
        <div class="clearfix hidden-lg hidden-md hidden-sm"></div>
        <div class="pbottom5 hidden-lg hidden-md hidden-sm"></div>
        <?php } ?>
        <?php $i++; ?>
    <?php } ?>
<?php } ?>

<script>
    $('input:radio[id=cc]').on('change', function () {
        $('.creditcardform').show();
    });

    $('input:radio[data-id=ip]').on('change', function () {
        
        $('.creditcardform').hide();
        
        var id_ip = $('input:radio[data-id=ip]:checked')[0].value;

        $.ajax({
            type: "POST",
            url: "../checkinstallment",
            data: {
                'id': id_ip,
            },
            success: function (data) {
                $('#installmentplan').empty();
                $(data).appendTo($("#installmentplan"));
                $('.installmentform').show();
            }
        });
    });

</script>