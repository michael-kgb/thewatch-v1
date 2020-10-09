<?php

use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");

//print_r($_SESSION);
?>
<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
           

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile gotham-light" style="height: 500px;">
                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 clearleft clearright clearleft-mobile clearright-mobile">
                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 talign-center gotham-medium fsize-14" style="padding-top: 200px;">Product pesanan Anda Berhasil Dibatalkan. <br> Kami akan segera menghubungi Anda perihal pengembalian dana. <br> Terima Kasih Telah Berbelanja di The Watch Co.</div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-2 col-lg-push-5 col-xs-12">
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/watches/all-product" class="blue-round default">Cari Produk Lain</a>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                   
                </div>
            </div>

             
        </div>
    </div>
</section>