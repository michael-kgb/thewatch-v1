<?php

use yii\web\Session;
use app\assets\VeritransAsset;


//print_r($_SESSION);
?>

<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <!-- <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag title">MY ORDER</div> -->
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myaccount profile separator clearleft clearright"></div>
            <div class="hidden-xs col-lg-9 col-md-9 col-sm-9 shopping-bag product separator clearleft clearright" style="border-bottom: 0px solid;"></div>
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myprofile menu-left box clearleft">
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left active clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders">MY ORDER / CONFIRM PAYMENT</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/sign-out">SIGN OUT</a>
                </div>
                <!-- <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left separator last clearleft clearright"></div> -->
            </div>

         <!--    <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders" selected>MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->

<style type="text/css">
    table tr td div{
        padding:15px;
    }
</style>

            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 clearleft clearright clearright-mobile clearleft-mobile">
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/order-complete.PNG" class="my-auto" style="width:35%;"></div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title">Terima Kasih!</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                
            </div>
            

            </div>
            
        </div>
    </div>
</section>
<style type="text/css">
    .non-active{
        display: none;
    }
    .active{
        display: block;
    }
</style>

                    

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
        .icon-visa,.icon-visa.install{
            top: 22px;
        }
    }
</style>

