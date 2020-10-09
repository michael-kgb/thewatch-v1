<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use backend\models\Homebanner;
use backend\models\ProductCategory;
use backend\models\Brands;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="The Watch Co">
    <?= Html::csrfMetaTags() ?>
    <title>The Watch Co.</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    var baseUrl = '<?php echo \yii\helpers\Url::base(); ?>';
    </script>
    <?php $this->head() ?>
    
</head>
<body id="page-top" class="index">

		<?php include "../shared/modal-newsletter.php" ?>
		<?php include "../shared/nav-menu.php" ?>

<?php $this->beginBody() ?>
    
    <!-- Navigation -->
    <?php 
        $data = ProductCategory::find()->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
        echo Yii::$app->view->renderFile('@app/views/site/menu_header.php', array("data" => $data));
    ?>
    
    <!-- Page Header -->
    <?php 
        $data = Homebanner::find()->limit(5)->orderBy('homebanner_sequence')->all();
        echo Yii::$app->view->renderFile('@app/views/site/homebanner.php', array("data" => $data));
    ?>
    
    <section id="services">
        <div class="container">
            <div class="row services block">
                <div class="col-lg-4 col-md-4 col-sm-4 battery">
                    <div class="col-lg-4 col-md-4 col-sm-4"><img src="img/icons/battery.png"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 services caption">LIFETIME BATTERY</div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 installment">
                    <div class="col-lg-4 col-md-4 col-sm-4 left8"><img src="img/icons/installment.png"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 services caption">0% INSTALLMENT</div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="col-lg-4 col-md-4 col-sm-4 left8"><img src="img/icons/free-shipping.png"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8 services caption">FREE SHIPPING</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Featured Banner -->
    <?php 
        $data = ProductCategory::find()->limit(6)->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
        echo Yii::$app->view->renderFile('@app/views/site/featured_banner.php', array("data" => $data));
    ?>
    
    <!-- Featured Brands -->
    <?php 
        $data = Brands::find()->limit(5)->where(array("brand_status" => "active", "brand_featured" => 1))->orderBy('brand_sequence')->all();
        echo Yii::$app->view->renderFile('@app/views/site/featured_brands.php', array("data" => $data));
    ?>
    
    <footer id="foot-er" style="position: relative;padding-top:10px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 footer caption">
                    <span>THE WATCH CO.</span>
                    <br><br>
                    <div class="footer link">About</div>
                    <div class="footer link">Store Location</div>
                    <div class="footer link">Contact</div>
                    <div class="footer link">Warranty & Service</div>
                    <div class="footer link">FAQ</div>
                    <div class="footer link">Terms & Privacy</div>
                    <div class="footer link">Shipping Information</div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 footer caption">
                    <span></span>
                    <br><br>
                    <div class="footer newsletter caption">Join Our Newsletter</div>
                    <input class="footer newsletter email" type="text" name="newsletter" placeholder="Email Address" />
                    <span class="input-group-addon submit-newsletter"><img src="/twcnew/img/icons/btn-right-black-2.png"></span>
                    <br><br>
                    <div class="footer follow-us caption">FOLLOW US</div>
                    <div class="footer follow-us icons">
                        <a href="https://www.instagram.com/thewatchco" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/instagram.png"></a>
                        <a href="http://twitter.com/thewatchco_id" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twitter.png"></a>
                        <a href="http://www.facebook.com/TheWatchCo" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/fb.png"></a>
                        <a href="https://pinterest.com/thewatchcompany" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/pinterest.png"></a>
                        <a href="http://line.me/ti/p/%40thewatchco" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line.png"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 footer caption">
                    <span></span>
                    <br><br>
                    <div class="footer newsletter caption">We Accepted</div>
                    <div class="footer follow-us icons">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/bca.png" class="payment-logo">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mandiri.png" class="payment-logo">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mastercard1.png" class="payment-logo">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/visa1.png" class="payment-logo ptop5">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/paypal.png" class="payment-logo ptop5">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
<?php $this->endBody() ?>
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });
    
    $("a#login").click(function(e) {
        var $t = $("#arrow-login");

        if ($t.is(':visible')) {
            $("#arrow-login").slideUp();
            $("#box-login").slideUp();
        } else {
            $("#arrow-login").slideDown();
            $("#box-login").slideDown();
        }
        
        e.preventDefault();
    });
    
$("li#watches").mouseenter(function (e) {
                var $t = $("#arrow-watches");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-watches").slideDown(0);
                    $("#box-watches").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);

                    // straps
                    $("#arrow-straps").slideUp(0);
                    $("#box-straps").slideUp(0);
                    
                    // accessories
                    $("#arrow-accessories").slideUp(0);
                    $("#box-accessories").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-brands").slideUp(0);
                        $("#box-brands").slideUp(0);
                }
            });

            $("#box-watches").mouseleave(function(e){
			   
                        $("#arrow-watches").slideUp(0);
                        $("#box-watches").slideUp(0);
               
			});
            
            
            

            
            $("li#accessories").mouseenter(function (e) {
                var $t = $("#arrow-accessories");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-accessories").slideDown(0);
                    $("#box-accessories").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);
                    
                    // watches
                    $("#arrow-watches").slideUp(0);
                    $("#box-watches").slideUp(0);
                    
                    // straps
                    $("#arrow-straps").slideUp(0);
                    $("#box-straps").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-brands").slideUp(0);
                        $("#box-brands").slideUp(0);
                }
            });
            
            $("#box-accessories").mouseleave(function (e) {
                
                        $("#arrow-accessories").slideUp(0);
                        $("#box-accessories").slideUp(0);
                    
            });
            
            
            
            $("li#straps").mouseenter(function (e) {
                var $t = $("#arrow-straps");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-straps").slideDown(0);
                    $("#box-straps").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);

                    // watches
                    $("#arrow-watches").slideUp(0);
                    $("#box-watches").slideUp(0);
                    
                    // accessories
                    $("#arrow-accessories").slideUp(0);
                    $("#box-accessories").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-brands").slideUp(0);
                    $("#box-brands").slideUp(0);
                }
            });
            
            $("#box-straps").mouseleave(function (e) {
                
                        $("#arrow-straps").slideUp(0);
                        $("#box-straps").slideUp(0);
                  
            });

             $("li#brands").mouseenter(function (e) {
                var $t = $("#arrow-brands");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-brands").slideDown(0);
                    $("#box-brands").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);

                    // watches
                    $("#arrow-watches").slideUp(0);
                    $("#box-watches").slideUp(0);
                    
                    // accessories
                    $("#arrow-accessories").slideUp(0);
                    $("#box-accessories").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-straps").slideUp(0);
                    $("#box-straps").slideUp(0);
                }
            });
            
            $("#box-brands").mouseleave(function (e) {
                
                        $("#arrow-brands").slideUp(0);
                        $("#box-brands").slideUp(0);
                  
            });
</script>    
</body>
</html>
<?php $this->endPage() ?>
