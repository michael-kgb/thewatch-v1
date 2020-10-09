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
            var currentUrl = '<?php echo Yii::$app->request->url; ?>';
            var csrf = '<?php echo Yii::$app->request->getCsrfToken(); ?>';
			var dataLayer = [],
				promotions = [];
        </script>
        <?php $this->head() ?>
		<link href="//thewatch.co<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    </head>
    <body id="page-top" class="index">

        <?php $this->beginBody() ?>

        <!-- Navigation -->
        <?php
        $data = ProductCategory::find()->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
        echo Yii::$app->view->renderFile('@app/views/site/menu_header.php', array("data" => $data));
        ?>

        <!-- Page Header -->
        <?php
        $data = Homebanner::find()->limit(10)->orderBy('homebanner_sequence')->where(['homebanner_status' => 'active'])->all();
        echo Yii::$app->view->renderFile('@app/views/site/homebanner.php', array("data" => $data));
        ?>

        <div id="o-wrapper" class="o-wrapper">
            <main class="o-content">
                <div class="o-container">
                    <section id="services">
                        <div class="container">
                            <div class="row services block">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 battery clearleft remove-padding">
                                    <div class="col-lg-4 col-md-4 col-sm-4 img-services clearleft">
										<span class="lifetime-bateray" style="cursor: pointer;">
											<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/battery.png" class="img-services-icon">
										</span>
									</div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 services caption lifetime clearleft">
									<span class="lifetime-bateray" style="cursor: pointer;">LIFETIME BATTERY</span>
									</div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 installment remove-padding">
                                    <div class="col-lg-4 col-md-4 col-sm-4 left8 img-services">
										<span class="installments" style="cursor: pointer;">
											<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/installment.png" class="img-services-icon">
										</span>
									</div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 services caption">
									<span class="installments" style="cursor: pointer;">0% INSTALLMENT</span>
									</div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 remove-padding">
                                    <div class="col-lg-4 col-md-4 col-sm-4 left8 img-services freeship">
										<span class="free-shipping" style="cursor: pointer;">
											<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/free-shipping.png" class="img-services-icon">
										</span>
									</div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 services caption freeship">
									<span class="free-shipping" style="cursor: pointer;">FREE SHIPPING</span>
									</div>
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
                    $data = Brands::find()->limit(6)->where(array("brand_status" => "active", "brand_featured" => 1))->orderBy('brand_sequence')->all();
                    echo Yii::$app->view->renderFile('@app/views/site/featured_brands.php', array("data" => $data));
                    ?>

                    <footer>
                        <div class="container">
                            <div class="row">
                                <div class="hidden-xs hidden-sm hidden-md col-lg-4 col-md-4 col-sm-4 footer caption">
                                    <span class="gotham-medium lspace2">THE WATCH CO.</span>
                                    <br><br>
                                    <div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/about">About</a></div>
                                    <div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/store">Store Location</a></div>
                                    <div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/contact">Contact</a></div>
                                    <div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/warranty">Warranty & Service</a></div>
                                    <div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a></div>
                                    <div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/privacy">Terms & Privacy</a></div>
                                    <div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">Shipping Information</a></div>
                                </div>

                                <div class="hidden-xs hidden-sm hidden-md col-lg-4 col-md-4 col-sm-4 footer caption">
                                    <span></span>
                                    <br><br>
                                    <div class="footer newsletter caption">Join Our Newsletter</div>
                                    <input class="footer newsletter email" type="text" name="newsletter" placeholder="Email Address" />
                                    <span class="input-group-addon subscribe-newsletter"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black-2.png"></span>
                                    <br><br>
                                    <div class="footer follow-us caption">Follow Us</div>
                                    <div class="footer follow-us icons socmed btn-socmed">
                                        <a href="https://www.instagram.com/thewatchco" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/instagram.png"></a>
                                        <a href="http://twitter.com/thewatchco_id" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twitter.png"></a>
                                        <a href="http://www.facebook.com/TheWatchCo" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/fb.png"></a>
                                        <a href="https://pinterest.com/thewatchcompany" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/pinterest.png"></a>
                                        <a href="http://line.me/ti/p/%40thewatchco" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line.png"></a>
                                    </div>
                                </div>
                                <div class="hidden-xs hidden-sm hidden-md col-lg-4 col-md-4 col-sm-4 footer caption">
                                    <span></span>
                                    <br><br>
                                    <div class="footer newsletter caption mbottom5">We Accept</div>
                                    <div class="footer follow-us icons mbottom5">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/bca.png" class="payment-logo">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mandiri.png" class="payment-logo">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/visa.png" class="payment-logo">
                                    </div>
                                    <div class="footer follow-us icons mbottom5">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mastercard.png" class="payment-logo">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/paypal.png" class="payment-logo">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/kredivo.png" class="payment-logo">
                                    </div>
                                    <div class="footer newsletter caption mbottom5">0% Installment</div>
                                    <div class="footer follow-us icons mbottom5">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/bca.png" class="payment-logo">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mandiri.png" class="payment-logo">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/anz.png" class="payment-logo">
                                    </div>
                                    <div class="footer follow-us icons">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/permata.png" class="payment-logo">
                                        <!--<img src="<?php // echo \yii\helpers\Url::base(); ?>/img/logos/cimb.png" class="payment-logo">-->
                                    </div>
                                </div>


                                <!--mobile footer-->
                                <div class="hidden-lg col-xs-12 footer caption margin-top-5">
                                    <span class="footer-title">THE WATCH CO.</span>
                                    <br><br>
                                    <div class="footer-mobile-link">
                                        <div class="footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/about">About</a> | <a href="<?php echo \yii\helpers\Url::base(); ?>/store">Store Location</a> | <a href="<?php echo \yii\helpers\Url::base(); ?>/contact">Contact</a></div>
                                        <div class="footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/warranty">Warranty & Service</a> | <a href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a> | <a href="<?php echo \yii\helpers\Url::base(); ?>/privacy">Terms & Privacy</a></div>
                                        <div class="footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">Shipping Information</a></div>
                                    </div>
                                    <div class="footer newsletter caption col-xs-5">Join Our Newsletter</div>
                                    <div class="col-xs-7 input-newsletter">
                                        <input class="footer newsletter email" type="text" name="newsletter" placeholder="Email Address" />
                                        <span class="input-group-addon subscribe-newsletter"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black-2.png"></span>
                                    </div>
                                    <br>
                                    <div class="footer follow-us icons socmed">
                                        <a href="https://www.instagram.com/thewatchco" target="_blank" class="icon-follow-us"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/instagram.png"></a>
                                        <a href="http://twitter.com/thewatchco_id" target="_blank" class="icon-follow-us"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twitter.png"></a>
                                        <a href="http://www.facebook.com/TheWatchCo" target="_blank" class="icon-follow-us"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/fb.png"></a>
                                        <a href="https://pinterest.com/thewatchcompany" target="_blank" class="icon-follow-us"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/pinterest.png"></a>
                                        <a href="http://line.me/ti/p/%40thewatchco" target="_blank"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line.png"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
					
					<!-- Lifetime battery modal -->
					<div class="modal fade top" id="lifetime" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-edit" role="document">                            
                                <!--Carousel-->
                            <div id="carousel-example-generics" class="carousel slide" data-ride="carousel">
                                <div class="modal-content modal-content-edit">
                                    <a href="#" data-dismiss="modal">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-mobile-benefit">
                                    </a>
                                    <div class="carousel-inner">
                                        <div class="item active"> 
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/battery.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">Lifetime <br> Battery</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        You are entitled to a lifetime battery warranty when you purchase our watch. To claim the battery warranty, please visit the nearest The Watch Co. store and bring the original The Watch Co. warranty card and receipt for warranty verification.
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Garansi baterai berlaku seumur hidup sejak tanggal pembelian. Untuk mengajukan claim, silahkan kunjungi store The Watch Co. terdekat dengan membawa kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli.<br>
                                                        Garansi tidak berlaku jika Anda tidak dapat menunjukkan kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli, atau email bukti pembelian (untuk pembelian secara online).<br>                                              
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/installment.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">0%<br>INSTALLMENT </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Enjoy 0% installment payment when you shop with us.<br><br>
                                                        Terms &amp; Conditions:
                                                            <br>1. Available for BCA, Mandiri, ANZ and Permata Bank cardholders.
                                                            <br>2. Available for 3-month, 6-month and 12-month
                                                            <br>3. Available for minimum purchase of IDR 1.000.000
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Nikmati kemudahan pembayaran dengan fasilitas cicilan 0%.<br>
                                                        Terms &amp; Conditions:
                                                            <br>  1. Berlaku untuk pemegang kartu kredit BCA, Mandiri, ANZ dan Permata berlogo Visa atau MasterCard
                                                            <br>  2. Tersedia pilihan untuk cicilan 3, 6 dan 12 bulan
                                                            <br> 3. Berlaku untuk minimum pembelian senilai Rp 1.000.000,- <br>                                                
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/free-shipping.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">Free <br> Shipping</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        We offer free shipping to every city in Indonesia.<br><br> 
                                                        Spend above IDR 1.000.000 and enjoy free regular delivery service (JNE<br> Regular - 3 to 5 days)<br>
                                                        Spend above IDR 3.000.000 and enjoy free express delivery service (JNE<br> YES - 1 to 2 days)<br><br>                                          
                                                        Note:
                                                        For some cities, express delivery option is not available
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Kami memberikan fasilitas gratis ongkos kirim ke seluruh kota di Indonesia.<br><br>
                                                        Pembelian di atas Rp 1.000.000,- gratis pengiriman regular (JNE REG, 3<br> sampai 5 hari)<br>
                                                        Pembelian di atas Rp 3.000.000,- gratis pengiriman kilat (JNE YES, 1 <br> sampai 2 hari)                                                
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="left carousel-control left-carousel" href="#carousel-example-generics" role="button" data-slide="prev"></a>
                                        <a class="right carousel-control right-carousel" href="#carousel-example-generics" role="button" data-slide="next"></a>                                                                         
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
					
					<!-- /.modal -->
					
					<!-- Installment -->
					<div class="modal fade top" id="installment">
                        <div class="modal-dialog modal-dialog-edit" role="document">
                            
                                <!--Carousel-->
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <div class="modal-content modal-content-edit">
                                    <a href="#" data-dismiss="modal">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-mobile-benefit">
                                    </a>
                                    <div class="carousel-inner">
                                        <div class="item active"> 
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/installment.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">0%<br>INSTALLMENT </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Enjoy 0% installment payment when you shop with us.<br><br>
                                                        Terms &amp; Conditions:
                                                            <br>1. Available for BCA, Mandiri, ANZ and Permata Bank cardholders.
                                                            <br>2. Available for 3-month, 6-month and 12-month
                                                            <br>3. Available for minimum purchase of IDR 1.000.000
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Nikmati kemudahan pembayaran dengan fasilitas cicilan 0%.<br>
                                                        Terms &amp; Conditions:
                                                            <br>  1. Berlaku untuk pemegang kartu kredit BCA, Mandiri, ANZ dan Permata berlogo Visa atau MasterCard
                                                            <br>  2. Tersedia pilihan untuk cicilan 3, 6 dan 12 bulan
                                                            <br> 3. Berlaku untuk minimum pembelian senilai Rp 1.000.000,- <br>                                                
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/free-shipping.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">Free <br> Shipping</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        We offer free shipping to every city in Indonesia.<br><br> 
                                                        Spend above IDR 1.000.000 and enjoy free regular delivery service (JNE<br> Regular - 3 to 5 days)<br>
                                                        Spend above IDR 3.000.000 and enjoy free express delivery service (JNE<br> YES - 1 to 2 days)<br><br>                                          
                                                        Note:
                                                        For some cities, express delivery option is not available
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Kami memberikan fasilitas gratis ongkos kirim ke seluruh kota di Indonesia.<br><br>
                                                        Pembelian di atas Rp 1.000.000,- gratis pengiriman regular (JNE REG, 3<br> sampai 5 hari)<br>
                                                        Pembelian di atas Rp 3.000.000,- gratis pengiriman kilat (JNE YES, 1 <br> sampai 2 hari)                                                
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/battery.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">Lifetime <br> Battery</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        You are entitled to a lifetime battery warranty when you purchase our watch. To claim the battery warranty, please visit the nearest The Watch Co. store and bring the original The Watch Co. warranty card and receipt for warranty verification.
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Garansi baterai berlaku seumur hidup sejak tanggal pembelian. Untuk mengajukan claim, silahkan kunjungi store The Watch Co. terdekat dengan membawa kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli.<br>
                                                        Garansi tidak berlaku jika Anda tidak dapat menunjukkan kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli, atau email bukti pembelian (untuk pembelian secara online).<br>                                              
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="left carousel-control left-carousel" href="#carousel-example-generic" role="button" data-slide="prev"></a>
                                        <a class="right carousel-control right-carousel" href="#carousel-example-generic" role="button" data-slide="next"></a>                                                                         
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
					
					<!-- ./modal -->
					
					<!-- Free Shipping -->
					<div class="modal fade top" id="shipping">
                        <div class="modal-dialog modal-dialog-edit" role="document">                            
                            <div id="carousel-example-genericss" class="carousel slide" data-ride="carousel">
                                <div class="modal-content modal-content-edit">
                                <a href="#" data-dismiss="modal">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-mobile-benefit">
                                </a>
                                    <div class="carousel-inner">
                                        <div class="item active"> 
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/free-shipping.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">Free <br> Shipping</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        We offer free shipping to every city in Indonesia.<br><br> 
                                                        Spend above IDR 1.000.000 and enjoy free regular delivery service (JNE<br> Regular - 3 to 5 days)<br>
                                                        Spend above IDR 3.000.000 and enjoy free express delivery service (JNE<br> YES - 1 to 2 days)<br><br>                                          
                                                        Note:
                                                        For some cities, express delivery option is not available
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Kami memberikan fasilitas gratis ongkos kirim ke seluruh kota di Indonesia.<br><br>
                                                        Pembelian di atas Rp 1.000.000,- gratis pengiriman regular (JNE REG, 3<br> sampai 5 hari)<br>
                                                        Pembelian di atas Rp 3.000.000,- gratis pengiriman kilat (JNE YES, 1 <br> sampai 2 hari)                                                
                                                    </p>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="item">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/installment.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">0%<br>INSTALLMENT </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Enjoy 0% installment payment when you shop with us.<br><br>
                                                        Terms &amp; Conditions:
                                                            <br>1. Available for BCA, Mandiri, ANZ and Permata Bank cardholders.
                                                            <br>2. Available for 3-month, 6-month and 12-month
                                                            <br>3. Available for minimum purchase of IDR 1.000.000
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Nikmati kemudahan pembayaran dengan fasilitas cicilan 0%.<br>
                                                        Terms &amp; Conditions:
                                                            <br>  1. Berlaku untuk pemegang kartu kredit BCA, Mandiri, ANZ dan Permata berlogo Visa atau MasterCard
                                                            <br>  2. Tersedia pilihan untuk cicilan 3, 6 dan 12 bulan
                                                            <br> 3. Berlaku untuk minimum pembelian senilai Rp 1.000.000,- <br>                                                
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-header-edit">                                    
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 img-position">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/battery.png" class="img-size">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rightborder position-line-heading"></div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-heading gotham-medium">Lifetime <br> Battery</div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-body edit">
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-right-black.png" class="close-mobile right-btn">
                                                </a>
                                                <a href="#" data-dismiss="modal">
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-left-black.png" class="close-mobile left-btn">
                                                </a>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        You are entitled to a lifetime battery warranty when you purchase our watch. To claim the battery warranty, please visit the nearest The Watch Co. store and bring the original The Watch Co. warranty card and receipt for warranty verification.
                                                    </p>
                                                </div>
                                                <div>
                                                    <hr class="line-content">
                                                </div>
                                                <div>
                                                    <p class="gotham-light paragrap-text-content" style="letter-spacing: 1px; margin: 30px 6px 10px;">
                                                        Garansi baterai berlaku seumur hidup sejak tanggal pembelian. Untuk mengajukan claim, silahkan kunjungi store The Watch Co. terdekat dengan membawa kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli.<br>
                                                        Garansi tidak berlaku jika Anda tidak dapat menunjukkan kartu garansi resmi dari The Watch Co. dan nota penjualan yang asli, atau email bukti pembelian (untuk pembelian secara online).<br>                                              
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="left carousel-control left-carousel" href="#carousel-example-genericss" role="button" data-slide="prev"></a>
                                        <a class="right carousel-control right-carousel" href="#carousel-example-genericss" role="button" data-slide="next"></a>                                                                         
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
					
					<!-- ./modal -->

                    <div class="modal fade" id="loadingScreen" tabindex="-1" role="dialog" aria-hidden="true">

                    </div>

                    <div class="portfolio-modal modal fade subscribe" id="subscribeModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-content notifyme">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding modal-newsletter">
                                <!--<div class="modal-body">-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding">
                                    <a href="#" data-dismiss="modal" class="hidden-xs">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-mobile">
                                    </a>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 clearleft clearright remove-padding img-subscribe">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/hello.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 talign-left popup-subscribe-title-success subscribe success title margin-top-5" style="display: none;">
                                        <span class="gotham-medium fsize-4">Thanks!</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 talign-left popup-subscribe-title subscribe success content margin-bottom-10" style="display: none;">
                                        <span class="gotham-light fsize-1 popup-subscribe-title2 no-spacing">
                                            We just need you to confirm your email address. <br>
                                            please check your inbox for a confirmation link. <br><br>
                                            if you don't receive it please check your spam folder
                                        </span>
                                        <div class="mtop5">
                                            <div class="mn-header btn-login" data-dismiss="modal">OK</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 talign-left popup-subscribe-title">
                                        <span class="gotham-medium fsizer-4">Hello!</span>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 talign-left popup-subscribe-title">
                                        <span class="gotham-light fsize-1 popup-subscribe-title2 no-spacing">
                                            Be the first to know our latest inspirations and products. <br>
                                            Subscribe & get voucher worth IDR 100.000 <br>
                                            *for your first purchase
                                        </span>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 talign-left popup-subscribe-fname">
                                        <div class="mn-header form-login margin-top-5 margin-bottom-5">
                                            <input class="form-subscribe email" type="text" name="firstname_subscribe" placeholder="Firstname">
                                            <span id="email-signin-error" style="display: none;">* Firstname Required</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 talign-left popup-subscribe-email">
                                        <div class="mn-header form-login  margin-bottom-5">
                                            <input class="form-subscribe email" type="text" name="email_subscribe" placeholder="Email Address">
                                            <span id="email-signin-error" style="display: none;">* Email Required</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 talign-left popup-subscribe-button margin-top-5 margin-bottom-5">
                                        <div class="mn-header btn-login" id="subscribe">SUBMIT</div>
                                    </div>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <?php $this->endBody() ?>
        <script>

            $('.carousel').carousel({
                interval: 5000 //changes the speed
            });

            $("a#login").click(function (e) {
                var $t = $("#arrow-login");
                if ($t.is(':visible')) {
                    $("#arrow-login").slideUp();
                    $("#box-login").slideUp();
                } else {
                    $("#arrow-login").slideDown();
                    $("#box-login").slideDown();

                    // watches
                    $("#arrow-watches").slideUp();
                    $("#box-watches").slideUp();

                    // straps
                    $("#arrow-straps").slideUp();
                    $("#box-straps").slideUp();
                    
                    // essentials
                    $("#arrow-essentials").slideUp();
                    $("#box-essentials").slideUp();

                    // cart
                    $("#arrow-cart").slideUp();
                    $("#box-cart").slideUp();

                }

                e.preventDefault();
            });

            $("a#cart").click(function (e) {
                var $t = $("#arrow-cart");
                if ($t.is(':visible')) {
                    $("#arrow-cart").slideUp();
                    $("#box-cart").slideUp();
                } else {
                    $("#arrow-cart").slideDown();
                    $("#box-cart").slideDown();

                    // watches
                    $("#arrow-watches").slideUp();
                    $("#box-watches").slideUp();

                    // straps
                    $("#arrow-straps").slideUp();
                    $("#box-straps").slideUp();
                    
                    // essentials
                    $("#arrow-essentials").slideUp();
                    $("#box-essentials").slideUp();

                    // login
                    $("#arrow-login").slideUp();
                    $("#box-login").slideUp();
                }

                e.preventDefault();
            });

            $("li#watches").mouseenter(function (e) {
                var $t = $("#arrow-watches");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-watches").slideDown(100);
                    $("#box-watches").slideDown(100);

                    // cart
                    $("#arrow-cart").slideUp(100);
                    $("#box-cart").slideUp(100);

                    // straps
                    $("#arrow-straps").slideUp(100);
                    $("#box-straps").slideUp(100);
                    
                    // essentials
                    $("#arrow-essentials").slideUp(100);
                    $("#box-essentials").slideUp(100);

                    // login
                    $("#arrow-login").slideUp(100);
                    $("#box-login").slideUp(100);
                }
            }).mouseleave(function (e) {
                if(e.relatedTarget.id !== 'box-watches' || e.relatedTarget.id !== 'watches'){
                    var $t = $("#arrow-watches");
                    if ($t.is(':visible')) {
                        $("#arrow-watches").slideUp(100);
                        $("#box-watches").slideUp(100);
                    }
                }
            });
            
            $("div#box-watches").mouseenter(function (e) {
                var $t = $("#arrow-watches");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-watches").slideDown(100);
                    $("#box-watches").slideDown(100);

                    // cart
                    $("#arrow-cart").slideUp(100);
                    $("#box-cart").slideUp(100);

                    // straps
                    $("#arrow-straps").slideUp(100);
                    $("#box-straps").slideUp(100);
                    
                    // essentials
                    $("#arrow-essentials").slideUp();
                    $("#box-essentials").slideUp();

                    // login
                    $("#arrow-login").slideUp(100);
                    $("#box-login").slideUp(100);
                }
            }).mouseleave(function (e) {
                if(e.relatedTarget.id !== 'watches'){
                    var $t = $("#arrow-watches");
                    if ($t.is(':visible')) {
                        $("#arrow-watches").slideUp(100);
                        $("#box-watches").slideUp(100);
                    }
                }
            });
            
            $("a#filter").click(function (e) {
                var $t = $("#arrow-filter");

                if ($t.is(':visible')) {
                    $("#arrow-filter").slideUp();
                    $("#box-filter").slideUp();
                    $("a#filter").removeClass('hover-filter');
                    $('img#down-white').show();
                    $('img#down-black').hide();
                } else {
                    $("#arrow-filter").slideDown();
                    $("#box-filter").slideDown();
                    $("a#filter").addClass('hover-filter');
                    $('img#down-white').hide();
                    $('img#down-black').show();
                }

                e.preventDefault();
            });
            
            $("li#essentials").mouseenter(function (e) {
                var $t = $("#arrow-essentials");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-essentials").slideDown(100);
                    $("#box-essentials").slideDown(100);

                    // cart
                    $("#arrow-cart").slideUp(100);
                    $("#box-cart").slideUp(100);
                    
                    // watches
                    $("#arrow-watches").slideUp(100);
                    $("#box-watches").slideUp(100);
                    
                    // straps
                    $("#arrow-straps").slideUp(100);
                    $("#box-straps").slideUp(100);

                    // login
                    $("#arrow-login").slideUp(100);
                    $("#box-login").slideUp(100);
                }
            }).mouseleave(function (e) {
                if(e.relatedTarget.id !== 'box-essentials' || e.relatedTarget.id !== 'essentials'){
                    var $t = $("#arrow-essentials");
                    if ($t.is(':visible')) {
                        $("#arrow-essentials").slideUp(100);
                        $("#box-essentials").slideUp(100);
                    }
                }
            });
            
            $("div#box-essentials").mouseenter(function (e) {
                var $t = $("#arrow-essentials");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-essentials").slideDown(100);
                    $("#box-essentials").slideDown(100);

                    // cart
                    $("#arrow-cart").slideUp(100);
                    $("#box-cart").slideUp(100);
                    
                    // watches
                    $("#arrow-watches").slideUp(100);
                    $("#box-watches").slideUp(100);

                    // straps
                    $("#arrow-straps").slideUp(100);
                    $("#box-straps").slideUp(100);

                    // login
                    $("#arrow-login").slideUp(100);
                    $("#box-login").slideUp(100);
                }
            }).mouseleave(function (e) {
                if(e.relatedTarget.id !== 'essentials'){
                    var $t = $("#arrow-essentials");
                    if ($t.is(':visible')) {
                        $("#arrow-essentials").slideUp(100);
                        $("#box-essentials").slideUp(100);
                    }
                }
            });
            
            $("a#filter").not("#box-filter").focusout(function () {
                setTimeout(function () {
                    $("#arrow-filter").slideUp();
                    $("#box-filter").slideUp();
                }, 200);
            });
            
            $("li#straps").mouseenter(function (e) {
                var $t = $("#arrow-straps");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-straps").slideDown(100);
                    $("#box-straps").slideDown(100);

                    // cart
                    $("#arrow-cart").slideUp(100);
                    $("#box-cart").slideUp(100);

                    // watches
                    $("#arrow-watches").slideUp(100);
                    $("#box-watches").slideUp(100);
                    
                    // essentials
                    $("#arrow-essentials").slideUp(100);
                    $("#box-essentials").slideUp(100);

                    // login
                    $("#arrow-login").slideUp(100);
                    $("#box-login").slideUp(100);
                }
            }).mouseleave(function (e) {
                if(e.relatedTarget.id !== 'box-straps' || e.relatedTarget.id !== 'straps'){
                    var $t = $("#arrow-straps");
                    if ($t.is(':visible')) {
                        $("#arrow-straps").slideUp(100);
                        $("#box-straps").slideUp(100);
                    }
                }
            });
            
            $("div#box-straps").mouseenter(function (e) {
                var $t = $("#arrow-straps");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-straps").slideDown(100);
                    $("#box-straps").slideDown(100);

                    // cart
                    $("#arrow-cart").slideUp(100);
                    $("#box-cart").slideUp(100);

                    // watches
                    $("#arrow-watches").slideUp(100);
                    $("#box-watches").slideUp(100);
                    
                    // essentials
                    $("#arrow-essentials").slideUp(100);
                    $("#box-essentials").slideUp(100);

                    // login
                    $("#arrow-login").slideUp(100);
                    $("#box-login").slideUp(100);
                }
            }).mouseleave(function (e) {
                if(e.relatedTarget.id !== 'straps'){
                    var $t = $("#arrow-straps");
                    if ($t.is(':visible')) {
                        $("#arrow-straps").slideUp(100);
                        $("#box-straps").slideUp(100);
                    }
                }
            });

        </script> 
		<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T35B3Z"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-T35B3Z');</script>
		<!-- End Google Tag Manager -->
		<script async="true" src="//ssp.adskom.com/tags/third-party-async/NmYzZDI3ZGEtODY3YS00OTg2LWE1YWEtZGNkZjBjOWM5ZWZl"></script>
    </body>
</html>
<?php $this->endPage() ?>
