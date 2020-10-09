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
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="author" content="The Watch Co">
        <?= Html::csrfMetaTags() ?>
        <title><?php echo $this->context->title == '' ? "The Watch Co." : $this->context->title; ?></title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            var baseUrl = '<?php echo \yii\helpers\Url::base(); ?>';
            var csrf = '<?php echo Yii::$app->request->getCsrfToken(); ?>';
			window.dataLayer = window.dataLayer || [];
        </script>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-T35B3Z');</script>
		<!-- End Google Tag Manager -->
		
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','https://connect.facebook.net/en_US/fbevents.js');

		fbq('init', '273338183102842');
		fbq('track', "PageView");</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=273338183102842&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
		
        <?php $this->head() ?>
		<link href="//thewatch.co<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    </head>
    <body id="page-top" class="index">
        <?php $this->beginBody() ?>

        

        <!-- Bulkhead Footer -->
                    <?php echo Yii::$app->view->renderFile('@app/views/site/bulkhead_footer.php', array("bulkhead"=>$bulkhead)); ?>
        <div id="o-wrapper" class="o-wrapper">
            <main class="o-content">
                <div class="o-container">
                	<?php
			        $connection = Yii::$app->getDb();
			                                    $command = $connection->createCommand(" SELECT marketing_bulkhead.marketing_bulkhead_id, marketing_bulkhead.marketing_bulkhead_text, marketing_bulkhead.marketing_bulkhead_type FROM marketing_bulkhead, marketing_campaign, marketing_campaign_bulkhead 
			                                        WHERE marketing_bulkhead.marketing_bulkhead_id = marketing_campaign_bulkhead.marketing_bulkhead_id AND marketing_campaign_bulkhead.marketing_campaign_id = marketing_campaign.marketing_campaign_id AND 
			                                        marketing_bulkhead.marketing_bulkhead_date_from <= NOW() and marketing_bulkhead.marketing_bulkhead_date_to >= NOW() AND 
			                                        marketing_campaign.marketing_campaign_date_from <= NOW() and marketing_campaign.marketing_campaign_date_to >= NOW() AND 
			                                        marketing_bulkhead.marketing_bulkhead_status = 1 AND marketing_campaign.marketing_campaign_status = 1 ");
			                    
			       $bulkhead = $command->queryAll();
			        $data = ProductCategory::find()->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
			        echo Yii::$app->view->renderFile('@app/views/site/menu_header.php', array("data" => $data, "bulkhead"=> $bulkhead));
			        ?>
                    <?php echo $content; ?>
					
					<section class="hidden-xs" style="background-repeat: repeat-x;padding: 50px 0;background-color: #f2f1f0;"></section>

                    <footer style="position: relative;">
                        <div class="container">
                            <div class="row">
								<div class="hidden-xs hidden-sm hidden-md col-lg-8 col-md-8 col-sm-8 clearleft" style="z-index:1;">
									<div class="hidden-xs hidden-sm hidden-md col-lg-6 col-md-6 col-sm-6 clearleft footer caption" style="letter-spacing: 1px;">
										<!--<span class="gotham-medium lspace2">THE WATCH CO.</span>-->
										<br><br> 
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/about">TENTANG KAMI</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/store">LOKASI TOKO</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/contact">HUBUNGI KAMI</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/warranty">GARANSI & SERVIS</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/privacy">KEBIJAKAN PRIVASI</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">INFORMASI PENGIRIMAN</a></div></br>
										<div class="footer follow-us icons socmed btn-socmed">
											<a href="http://www.facebook.com/TheWatchCo" target="_blank"><img src="https://thewatch.co/img/icons/fb.png"></a>
											<a href="http://twitter.com/thewatchco_id" target="_blank"><img src="https://thewatch.co/img/icons/twitter.png"></a>
											<a href="https://www.instagram.com/thewatchco" target="_blank"><img src="https://thewatch.co/img/icons/instagram.png"></a>
											<a href="https://pinterest.com/thewatchcompany" target="_blank"><img src="https://thewatch.co/img/icons/pinterest.png"></a>
											<a href="http://line.me/ti/p/%40thewatchco" target="_blank"><img src="https://thewatch.co/img/icons/line.png"></a>
										</div>
									</div>

									<div class="hidden-xs hidden-sm hidden-md col-lg-6 col-md-6 col-sm-6 clearleft footer caption">
										<span></span>
										<br><br>
										<div class="footer newsletter caption" style="letter-spacing: 1px;">IKUTI / DAFTAR NEWSLETTER KAMI</div>
										<input class="footer newsletter email email-subscribe margin-email" type="text" name="newsletter" placeholder="Enter your email address"/>
										<span class="input-group-addon subscribe-newsletter button-subscribe" style="border-radius: 100px;">SUBSCRIBE</span>
										<br><br>
										<div class="footer follow-us caption" style="font-size: 11px;">Dapatkan voucher Rp 100,000,-* jika anda berlangganan newsletter kami.</div><br><br>
										<div class="footer newsletter caption mbottom5" style="letter-spacing: 1px;">CUSTOMER SERVICE</div>
										<div class="footer newsletter caption" style="font-size: 11px;">Get in touch / +62 813 6800 1010 </br>(Mon-Fri 9AM-5PM (+7GMT))</div>
									</div>
								</div>
							
								<div class="hidden-xs hidden-sm hidden-md col-lg-4 col-md-4 col-sm-4 footer caption clearright" style="padding-left: 100px;z-index:1;">
									<span></span>
									<br><br>
									<div class="footer newsletter caption mbottom5" style="letter-spacing: 1px;">METODE PEMBAYARAN</div>
									<div class="footer follow-us icons mbottom5">
									    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/bca.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mandiri.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/kredivo.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mastercard.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/visa.png" class="logo-payment">
									</div>
									
									<div class="footer newsletter caption mbottom5" style="letter-spacing: 1px;">CICILAN 0%</div>
									<div class="footer follow-us icons mbottom5">
									    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/bca.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mandiri.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/cimb.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/anz.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/permata.png" class="logo-payment">
									</div>
									<div class="footer follow-us icons mbottom5">
									    
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/Danamon.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/uob.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/sc.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/hsbc.png" class="logo-payment">
									</div>
									
									
									<div class="footer newsletter caption mbottom5" style="letter-spacing: 1px;">KEAMANAN BELANJA</div>
									
									<div class="footer follow-us icons mbottom5">
									    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mastercard1.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/visa1.png" class="logo-payment">
										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/payment-methods-13.png" class="logo-payment">
									</div>
								</div>


                                <!--mobile footer-->
                                <div class="hidden-lg col-xs-12 footer caption margin-top-5" style="z-index:1;">
                                    <div class="footer newsletter caption" style="text-align: center; font-size: 12px; padding-bottom: 7%; letter-spacing: 0.1px">IKUTI / DAFTAR NEWSLETTER KAMI</div>
										<div class="footer newsletter caption">
										<input class="footer newsletter email email-subscribe" type="text" name="newsletter" placeholder="Enter your email address"/>
										<span class="input-group-addon subscribe-newsletter btn-subscribe" style="font-size: 12px;letter-spacing: 0.1px;">SUBSCRIBE</span>
										</div></br></br></br></br>
										<div class="footer follow-us caption" style="font-size: 14px; font-family: gotham-light;">Dapatkan voucher Rp 100,000,-* jika anda berlangganan newsletter kami.</div><br	>
										<div class="footer newsletter caption" style="font-size: 14px; font-family: gotham-medium;text-align: center; letter-spacing: 1px;margin-top: 50px;">CUSTOMER SERVICE</div><br>
										<div class="footer newsletter caption" style="font-size: 14px; font-family: gotham-light;text-align: center; margin-top: -7px;">Get in touch/ +62 813 6800 1010</div>
										<div class="footer newsletter caption" style="font-size: 14px; font-family: gotham-light;text-align: center; padding-bottom: 10%; margin-top: 0px;">(Mon-Fri 9AM-5PM (+7GMT))</div>
                                    <div class="footer-mobile-link" style="letter-spacing: 1px;">
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/about">TENTANG KAMI</a></div>
										<div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/store">LOKASI TOKO</a></div>
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/contact">HUBUNGI KAMI</a></div>
										<div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/warranty">GARANSI & SERVIS</a></div>
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a></div>
										<div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/privacy">KEBIJAKAN PRIVASI</a></div>
										<div class="col-xs-12 footer-mobile-link-content" style="padding-left: 0; padding-right: 0;"><a href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">INFORMASI PENGIRIMAN</a></div>
										<!-- <div class="col-xs-6 footer-mobile-link-content"><a href="#">BACK TO TOP</a></div> -->
                                    </div>
									<div class="clearfix"></div>
									
									<div id="" class="swiper-container-footer hidden-lg hidden-md hidden-sm col-xs-8 col-xs-offset-2" style="overflow-x:hidden;position: relative;overflow-y: hidden;margin-top: 40px;margin-bottom: 40px;">
   
    
									    <div class="swiper-wrapper clearleft clearright" style="">
									       
									                <div class="swiper-slide">
									                    <div class="footer newsletter caption" style="margin-top: 20px;font-size: 14px; text-align: center; letter-spacing: 1px;">METODE PEMBAYARAN</div>
                                
					                                    <div class="footer newsletter caption">
					                                        <div class="col-xs-12" style="padding-left: 0; padding-right: 0; text-align: center;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/bca.png" style="margin-right: 10px;margin-left: 10px;margin-top: 10px;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mandiri.png" style="margin-right: 10px;margin-left: 10px;margin-top: 10px;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/visa.png" style="margin-right: 10px;margin-left: 10px;margin-top: 10px;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mastercard.png" style="margin-right: 10px;margin-left: 10px;margin-top: 10px;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/kredivo.png" style="margin-right: 10px;margin-left: 10px;margin-top: 10px;">
																<img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/akulaku-logo-1.png">
					                                        </div>
														</div>
									                </div>
									                <div class="swiper-slide">
									                	<div class="footer newsletter caption" style="margin-top: 20px;font-size: 14px; text-align: center; letter-spacing: 1px;">CICILAN 0%</div>
						                                    <div class="footer newsletter caption">
						                                        <div class="col-xs-12" style="padding-left: 0; padding-right: 0; text-align: center;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/bca.png" style="margin-left: 10px; margin-right: 10px;margin-top: 10px;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mandiri.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/anz.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/permata.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/Danamon.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
																	<img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/cimb.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/uob.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/sc.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
						                                            <img width="45" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/hsbc.png" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
						                                        </div>
						                                    </div>
									                </div>

									                <div class="swiper-slide">
									                	<div class="footer newsletter caption" style="margin-top: 20px;font-size: 14px; text-align: center; letter-spacing: 1px;">KEAMANAN BELANJA</div>
					                                    <div class="footer newsletter caption">
					                                        <div class="col-xs-12" style="padding-left: 0; padding-right: 0; text-align: center;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/visa1.png" style="margin-left: 10px; margin-right: 10px;margin-top: 10px;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/mastercard1.png" style="margin-left: 10px; margin-right: 10px;margin-top: 10px;">
					                                            <img width="50" src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/payment-methods-13.png" style="margin-left: 10px; margin-right: 10px;margin-top: 10px;">
					                                        </div>
														</div>
									                </div>
									               
									    </div>
										<div class="swiper-pagination" style="height:40px;margin-top:10px;"></div>
									    <!-- Add Arrows -->
									     									   
									    
									</div>

                                    
									<div class="clearfix"></div>
                                    
                                    <div class="clearfix"></div>
									


									<div class="footer newsletter caption" style=" text-align: center;">
										<a href="#" class="scrolls">
											<i class="back-top"></i>
											<div class="" style=" text-align: center;font-family: gotham-light;font-size: 12px;letter-spacing: 0.6px;"><i class="footer-top"></i><br><br>BACK TO TOP</div>
										</a>
									</div>
									<div class="clearfix"></div>
                                    <div class="padding-img">
										<a href="http://www.facebook.com/TheWatchCo" target="_blank"><img src="https://thewatch.co/img/icons/fb.png" class="img-line"></a>
										<a href="http://twitter.com/thewatchco_id" target="_blank"><img src="https://thewatch.co/img/icons/twitter.png" class="img-line"></a>
										<a href="https://www.instagram.com/thewatchco" target="_blank"><img src="https://thewatch.co/img/icons/instagram.png" class="img-line"></a>
										<a href="https://pinterest.com/thewatchcompany" target="_blank"><img src="https://thewatch.co/img/icons/pinterest.png" class="img-line"></a>
										<a href="http://line.me/ti/p/%40thewatchco" target="_blank"><img src="https://thewatch.co/img/icons/line.png" class="img-line"></a>
									</div>
                                    <br>
                                </div>
                          
								
                                   
                            </div>
                        </div>
                    </footer>


					<div class="portfolio-modal modal fade subscribe" id="subscribeModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-content notifyme">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding modal-newsletter" style="background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/10.jpg');background-position: center;background-repeat: no-repeat;background-size: cover;height: 510px;">
                                <!--<div class="modal-body">-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding">
                                    <a href="#" data-dismiss="modal" class="">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/close.png" class="close-mobile">
                                    </a>
                                    <!-- <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 clearleft clearright remove-padding img-subscribe">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/hello.jpg" class="img-responsive" style="height:467px;">
                                    </div> -->
                                    <div id="popup-subscribe-thanks1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 success title margin-top-5" style="display: none;padding-top: 7%;text-align: center;">
                                        <span class="gotham-light thanks-sub" style="color:#fff;letter-spacing: 0.5px;">Thank you for subscribing!</span>
                                    </div>
                                    <div id="popup-subscribe-thanks2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 success content margin-bottom-10" style="display: none;padding-top: 4%;text-align: center;">
                                    	<div class="hidden-sm hidden-md hidden-lg" style="padding: 10px;"></div>
                                        <span class="gotham-light check-sub popup-subscribe-title2 no-spacing" style="color:#fff;letter-spacing: 0.5px;text-align: center;">
                                            
                                            Please check your email to enjoy your discount.
                                        </span>
                                        <div class="hidden-sm hidden-md hidden-lg" style="padding: 10px;"></div>
                                        <div class="mtop5" style="padding-left: 30%;padding-right: 30%;">
                                            <a href="#" data-dismiss="modal" class="gotham-light mn-header btn-subscribe" style="width: 100%;padding: 4%;text-align: center;">
	                                        	Continue Shopping
	                                    	</a>
                                        </div>
                                    </div>



                                    <div id="popup-subscribe-form1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: block;text-align: center;">
                                        <span class="gotham-light title-sub" style="color:#fff;">Welcome to The Watch Co.</span>
                                    </div>
                                    <div id="popup-subscribe-form2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 3%;display: block;text-align: center;">
                                        <span class="gotham-light fsize-1 popup-subscribe-title2 no-spacing" style="color:#fff;">
                                            Stay updated for the latest watch news and offers. <br>
                                            Enjoy <span class="gotham-medium">IDR 100.000*</span> by subscribing to our newsletter now! <br>
                                
                                        </span>
                                    </div>
                                    <div id="popup-subscribe-form3" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-left" style="display: block;padding-top: 3%;">
                                        <div class="mn-header margin-top-5 margin-bottom-5">
                                            <input class="form-subscribe email" type="text" name="firstname_subscribe" placeholder="Firstname">
                                            <span id="email-signin-error" style="display: none;">* Firstname Required</span>
                                        </div>
                                    </div>
                                    <div id="popup-subscribe-form4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-left" style="display: block;">
                                        <div class="mn-header margin-bottom-5">
                                            <input class="form-subscribe email" type="text" name="email_subscribe" placeholder="Email Address">
                                            <span id="email-signin-error" style="display: none;">* Email Required</span>
                                        </div>
                                    </div>
                                    <div id="popup-subscribe-form5" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 margin-bottom-5" style="display: block;padding-top: 15px;">
                                        <div class="mn-header btn-subscribe" id="subscribe" style="margin-right: 1%;letter-spacing: 1px;">Men</div>
                                        <div class="mn-header btn-subscribe" id="subscribe-fem" style="margin-left: 1%;letter-spacing: 1px;">Women</div>
                                    </div>
                                    <div id="popup-subscribe-form6" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-left" style="display: block;text-align: center;padding-top: 3%;">
                                    	<a href="#" data-dismiss="modal" class="gotham-light" style="color:#fff;text-decoration: underline;font-size: 11px;letter-spacing: 0.5px;">
                                        	No, thanks
                                    	</a>
                                    </div>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="loadingScreen" tabindex="-1" role="dialog" aria-hidden="true" style="z-index:2000;">
                    </div>
            </main>
        </div>

    </div>
    <div class="modal fade modal-back-timex" id="overlay">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      
		        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
		        
		      
		      <div class="modal-body gotham-light">
		       	<div class="col-lg-17 col-md-7 col-sm-7 hidden-xs padding-0 clearleft">
		       		<img style="width:100%;height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/reservation.jpg" />
		       	</div>
		       	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style="color:#fff;">
		       		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float:right;opacity: 1;color: white;padding-top: 5px;margin-right: -5px;">&times;</button>
		       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:3%;">
		       			
		       		</div>
		       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
		       			<img class="modal-timex" style="height:auto;" src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/timex-new-logo-white.png" />
		       		</div>
		       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:3%;">
		       			
		       		</div>
		       		<div class="reservation-form" id="reservation-form" style="display: block;">
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
			       			<span style="font-size: 15px;">You are invited to</span><br>
			       			<span style="font-size: 18px;font-weight: bold;">TAKE TIME PARTY</span><br>
			       			<span style="font-size: 15px;">at FJ Bistro & Deli</span><br>
			       			<span style="font-size: 15px;">20 September 2017</span><br>
			       			<span style="font-size: 15px;">RSVP now to get your E-Ticket</span>
			       		</div>
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:2%;">
			       			
			       		</div>
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:8%;">
			       			
			       				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft clearleft-mobile clearright-mobile" style="margin-bottom: 5px;margin-top: 5px;">
				       				<input id="reservation-name" type="name" name="reservation-name" style="width: 100%;height:35px;padding-right: 10px;padding-left: 10px;color: #000;" placeholder="*Name">
				       				<span id="reservation-name-warning" style="font-size:9px;display: none;color:red;"> * Name is required</span>
				       			</div>
				       			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft clearleft-mobile clearright-mobile" style="margin-bottom: 5px;margin-top: 5px;">
				       				<input id="reservation-phone" type="name" name="reservation-phone" style="width: 100%;height:35px;padding-right: 10px;padding-left: 10px;color: #000;" placeholder="*Phone Number">
				       				<span id="reservation-phone-warning" style="font-size:9px;display: none;color:red;" >* Phone is required</span>
				       			</div>
				       			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft clearleft-mobile clearright-mobile" style="margin-bottom: 5px;margin-top: 5px;">
				       				<input id="reservation-email" type="name" name="reservation-email" style="width: 100%;height:35px;padding-right: 10px;padding-left: 10px;color: #000;" placeholder="*Email">
				       				<span id="reservation-email-warning" style="font-size:9px;display: none;color:red;" >* Email is required</span>
				       				<span id="reservation-email-warning2" style="font-size:9px;display: none;color:red;" >* Email wrong format</span>
				       			</div>
				       			<span id="reservation-gagal-warning" style="font-size:9px;display: none;color:red;" >There is problem with the server</span>
			       				<button onclick="reservation_timex()" style="background-color: #55c3ba;width: 100%;height: 35px;border: none;color: #fff;margin-bottom: 5px;margin-top: 5px;letter-spacing: 2px;font-size: 15px;">SUBMIT</button>

			       				<script type="text/javascript">
					</script>
			       			
			       		</div>
			       	</div>
			       	<div class="reservation-success" id="reservation-success" style="display: none">
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5%;">
		       			
		       		</div>
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;font-size: 37px;">
			       			Thank You!
			       			
			       		</div>
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:5%;">
			       			
			       		</div>
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;font-size: 15px;">
			       			Our team will contact you <br> as soon as possible.
			       		</div>
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:10%;">
			       			
			       		</div>
			       		<button type="button" class="close" data-dismiss="modal" style="opacity:1;background-color: #55c3ba;width: 100%;height: 45px;border: none;color: #fff;margin-bottom: 7px;margin-top: 7px;letter-spacing: 2px;font-size: 15px;">CONTINUE</button>
			       		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:10%;">
			       			
			       		</div>   
			       	</div>
		       	</div>
		      </div>
		    </div>
		  </div>
		</div>

		

		<style type="text/css">
			.modal-content {
			    position: absolute;
			    background-color: #000;
			    -webkit-background-clip: padding-box;
			    background-clip: padding-box;
			    border: 1px solid #999;
			    border: 1px solid rgba(0,0,0,.2);
			    border-radius: 6px;
			    outline: 0;
			    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);
			    box-shadow: 0 3px 9px rgba(0,0,0,.5);
			    width: 785px;
			    margin-left: -14%;
			    margin-top: 22%;
			}
			.modal-body{
				padding:0px;
			}
			img.modal-timex{
				width:40%;
			}
			@media all and (max-width: 767px) {
				.modal-content {
			    position: absolute;
			    background-color: #000;
			    -webkit-background-clip: padding-box;
			    background-clip: padding-box;
			    border: 1px solid #999;
			    border: 1px solid rgba(0,0,0,.2);
			    border-radius: 6px;
			    outline: 0;
			    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);
			    box-shadow: 0 3px 9px rgba(0,0,0,.5);
			    width: 85%;
			    margin-left: 8%;
			    margin-top: 10%;
				}
				.modal-body{
					padding:0px;
				}
				.modal-back-timex{
					background-color: #fff;
				}
				img.modal-timex{
					width:45%;
				}
			}
		</style>
    <?php $this->endBody() ?>
    <script>
    $(window).load(function(){
	//	$('#overlay').modal('show');
	});

	// setTimeout(function() {
	//     $('#overlay').modal('hide');
	// }, 5000);
	<?php 
	if(isset($_GET['showpopupanz'])){
	?>
	
	$(window).load(function(){
		$('#myModals').modal('show');
	});
		
	<?php } ?>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        });
     
            
            $('body').click(function (e) {
                var treeTraversal = $(e.target).parents().map(function () {
                    return this.id;
                }).get().join(",");

                var split = treeTraversal.split(",");
                var click = false;

                for(i = 0; i < split.length; i++){
                    if(split[i] == 'box-filter' || split[i] == 'filter' || e.target.id == 'box-filter' || e.target.id == 'filter'){
                        click = true;
                        break;
                    }
                }

                if(!click){
                    setTimeout(function () {
                        $("#arrow-filter").slideUp();
                        $("#box-filter").slideUp();
                        $("a#filter").removeClass('hover-filter');
                        $('img#down-white').show();
                        $('img#down-black').hide();
                    }, 200);
                }
            });

         
            
            $("a#filter").click(function (e) {
                var $t = $("#box-filter");

                if ($t.is(':visible')) {
                    // $("#arrow-filter").slideUp();
                    $("#box-filter").slideUp();
                    $("a#filter").removeClass('hover-filter');
                    // $('img#down-white').show();
                    // $('img#down-black').hide();
                } else {
                    // $("#arrow-filter").slideDown();
                    $("#box-filter").slideDown();
                    $("a#filter").addClass('hover-filter');
                    // $('img#down-white').hide();
                    // $('img#down-black').show();
                }

                e.preventDefault();
            });


			
			// jQuery(document).ready(function($) {
			// 	$(window).scroll(function() {
			// 		//alert("masuk");
			// 		var navHeight = $( window ).height();
			// 		if ($(window).scrollTop() > 50) {
						
			// 			$('#logotwc').hide();
			// 			$('#logotwcco').show();
			// 			$(".default-logo").attr('src', "<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo.png");
			// 			$('.default-logo').css('width', '');
			// 			$('.default-logo').css('height', '');
			// 			$('.default-logo').css('margin-top', '4.3%');
			// 			$('.box-logo').css('width', '100px');
			// 			$('#navbar-mobile').css('background-color', 'white');
			// 			$('.navbar-collapse').css('background-color', 'white');
			// 			$('.collapse navbar-collapse').css('height', '35px');
			// 			$('.navbar-left.mn-header').css('width', '64%');
			// 			$('.navbar-left.mn-header').css('margin-left', '25.6%');
			// 			$('.container.mn-header').css('padding-left', '3.7%');
			// 		} else {
			// 			$('#logotwc').show();
			// 			$('#logotwcco').hide();
						
			// 			$(".default-logo").attr('src', "<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo.png");
			// 			$('.default-logo').css('width', '');
			// 			$('.default-logo').css('height', '');
			// 			$('.box-logo').css('width', '');
			// 			$('#navbar-mobile').css('background-color', '');
			// 			$('.padding-homebanner').css('padding-top', '');
			// 			$('.box-header').css('width-top', '');
			// 			$('.box-header').css('padding-right', '');
			// 			$('.box-header').css('padding-left', '');
			// 			$('.box-header').css('padding-top', '');
			// 			$('.default-logo').css('margin-top', '');
			// 			$('.navbar-left.mn-header').css('width', '');
			// 			$('.navbar-left.mn-header').css('margin-left', '');
			// 		}
			// 	});
			// });
    </script>    
    <script type="text/javascript">
    // $('#overlay').modal('show');
            $(function(){
                
        var shrinkHeaderMobile = $('.bulkhead-height').height();

        $('a.bulkhead-close').click(function(){
          shrinkHeaderMobile = 0;
        });
    
     var shrinkHeader = 300;
      $(window).scroll(function() {
        var scroll = getCurrentScroll();
            if ($(window).width() > 1024) {
               if ( scroll >= shrinkHeader ) {

               		$('.height-menu2').addClass('scroll');
                   $('.collapse.navbar-collapse').addClass('scroll');
                   $('.mn-header.submenu').addClass('scroll');
                   $('#navbar-mobile').css("box-shadow","rgba(0, 0, 0, 0.5) 1px 1px 5px 0px");

                   $("nav#navbar-mobile").css("background-color","white");
	                $("a#watches").css("color", "black");
	                $("a#straps").css("color", "black");
	                $("a#accessories").css("color", "black");
	                $("a#brands").css("color", "black");
	                $("a#jewelry").css("color","black");
	                $("a#journal").css("color", "black");
	                $("li.icons.user-profile a").css("color","black");
	                $("i#logotwc").attr('class', 'logo-sprite');
	                $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart.png");
	                $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account.png");
                	$("i#img-search").attr('class', 'icon-search');

                	

                }
                else {
                	$("nav#navbar-mobile").css("background-color","transparent"); 
                    $('.height-menu2').removeClass('scroll');
                    $('.collapse.navbar-collapse').removeClass('scroll');
                    $('.mn-header.submenu').removeClass('scroll');
                    $('#navbar-mobile').css("box-shadow","none");

                    $("a#watches").css("color","white");
		            $("a#straps").css("color","white");
		            $("a#accessories").css("color","white");
		            $("a#brands").css("color","white");
		            $("a#journal").css("color","white");
		            $("a#jewelry").css("color","white");
		            $("li.icons.user-profile a").css("color","white");
		            $("i#logotwc").attr('class', 'logo-sprite-putih');
		            $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart-putih.png");
		            $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account-putih.png");
		            $("i#img-search").attr('class', 'icon-search-white');

		            $("nav#navbar-mobile").mouseenter(function (e) {
              
		                $("nav#navbar-mobile").css("background-color","white");
		                $("a#watches").css("color", "black");
		                $("a#straps").css("color", "black");
		                $("a#accessories").css("color", "black");
		                $("a#brands").css("color", "black");
		                $("a#jewelry").css("color","black");
		                $("a#journal").css("color", "black");
		                $("li.icons.user-profile a").css("color","black");
		                $("i#logotwc").attr('class', 'logo-sprite');
		                $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart.png");
		                $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account.png");
		                $("i#img-search").attr('class', 'icon-search');
		            });
		            $("nav#navbar-mobile").mouseleave(function(e){
		                      
		                var $w = $("#box-watches");
		                var $s = $("#box-straps");
		                var $a = $("#box-accessories");
		                var $j = $("#box-jewelry");
		                var $b = $("#box-brands");
		                var $c = $("#box-cart");
		                var $se = $("#box-search");
		                if ($w.is(':visible') || $s.is(':visible') || $a.is(':visible') || $b.is(':visible') || $c.is(':visible') || $se.is(':visible') || $j.is(':visible')) {
		                    
		                } else {                
		                    $("nav#navbar-mobile").css("background-color","transparent"); 
		                    $("a#watches").css("color","white");
		                    $("a#straps").css("color","white");
		                    $("a#accessories").css("color","white");
		                    $("a#brands").css("color","white");
		                    $("a#journal").css("color","white");
		                    $("a#jewelry").css("color","white");
		                    $("li.icons.user-profile a").css("color","white");

		                    $("a#watches").css("border-bottom", "0px solid");
		                    $("a#straps").css("border-bottom", "0px solid");
		                    $("a#accessories").css("border-bottom", "0px solid");
		                    $("a#brands").css("border-bottom", "0px solid");
		                    $("a#journal").css("border-bottom", "0px solid");

		                    $("i#logotwc").attr('class', 'logo-sprite-putih');
		                    $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart-putih.png");
		                    $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account-putih.png");
		                    $("i#img-search").attr('class', 'icon-search-white');
		                }        
		               
		            });

		            $("li#watches").mouseenter(function (e) {
		              
		                $("nav#navbar-mobile").css("background-color","white");
		                $("a#journal").css("color", "black");
		                $("a#journal").css("border-bottom", "0px solid");

		            });

		            $("#box-watches").mouseleave(function(e){
		                $("nav#navbar-mobile").css("background-color","transparent"); 
		                $("a#watches").css("color","white");
		                    $("a#straps").css("color","white");
		                    $("a#accessories").css("color","white");
		                    $("a#brands").css("color","white");
		                    $("a#jewelry").css("color","white");
		                    $("a#journal").css("color","white");
		                    $("a#journal").css("border-bottom", "0px solid");       
		                    $("i#logotwc").attr('class', 'logo-sprite-putih'); 
		                    $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart-putih.png");     
		                    $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account-putih.png");
		                    $("i#img-search").attr('class', 'icon-search-white');
		               
		            });

		            $("li#straps").mouseenter(function (e) {
		              
		                $("nav#navbar-mobile").css("background-color","white");
		                $("a#journal").css("color", "black");
		                $("a#journal").css("border-bottom", "0px solid");

		            });

		            $("#box-straps").mouseleave(function(e){
		                $("nav#navbar-mobile").css("background-color","transparent");  
		                $("a#watches").css("color","white");
		                    $("a#straps").css("color","white");
		                    $("a#accessories").css("color","white");
		                    $("a#brands").css("color","white");
		                    $("a#jewelry").css("color","white");
		                    $("a#journal").css("color","white");      
		                    $("a#journal").css("border-bottom", "0px solid");       
		                    $("i#logotwc").attr('class', 'logo-sprite-putih');
		                    $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart-putih.png");
		                    $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account-putih.png");
		                    $("i#img-search").attr('class', 'icon-search-white');
		               
		            });
		            $("li#accessories").mouseenter(function (e) {
		              
		                $("nav#navbar-mobile").css("background-color","white");
		                $("a#journal").css("color", "black");
		                $("a#journal").css("border-bottom", "0px solid");

		            });

		            $("#box-accessories").mouseleave(function(e){
		                $("nav#navbar-mobile").css("background-color","transparent");
		                $("a#watches").css("color","white");
		                    $("a#straps").css("color","white");
		                    $("a#accessories").css("color","white");
		                    $("a#brands").css("color","white");
		                    $("a#jewelry").css("color","white");
		                    $("a#journal").css("color","white");     
		                    $("a#journal").css("border-bottom", "0px solid");     
		                    $("i#logotwc").attr('class', 'logo-sprite-putih');  
		                    $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart-putih.png");
		                    $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account-putih.png");
		                    $("i#img-search").attr('class', 'icon-search-white');
		               
		            });
		            $("li#brands").mouseenter(function (e) {
		              
		                $("nav#navbar-mobile").css("background-color","white");
		                $("a#journal").css("color", "black");
		                $("a#journal").css("border-bottom", "0px solid");

		            });

		            $("#box-brands").mouseleave(function(e){
		                $("nav#navbar-mobile").css("background-color","transparent"); 
		                $("a#watches").css("color","white");
		                    $("a#straps").css("color","white");
		                    $("a#accessories").css("color","white");
		                    $("a#brands").css("color","white");
		                    $("a#jewelry").css("color","white");
		                    $("a#journal").css("color","white");           
		                    $("a#journal").css("border-bottom", "0px solid");   
		                    $("i#logotwc").attr('class', 'logo-sprite-putih');
		                    $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart-putih.png");
		                    $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account-putih.png");
		                    $("i#img-search").attr('class', 'icon-search-white');
		               
		            });
		            $("li#jewelry").mouseenter(function (e) {
		              
		                $("nav#navbar-mobile").css("background-color","white");
		                $("a#journal").css("color", "black");
		                $("a#journal").css("border-bottom", "0px solid");

		            });

		            $("#box-jewelry").mouseleave(function(e){
		                $("nav#navbar-mobile").css("background-color","transparent"); 
		                $("a#watches").css("color","white");
		                    $("a#straps").css("color","white");
		                    $("a#accessories").css("color","white");
		                    $("a#brands").css("color","white");
		                    $("a#jewelry").css("color","white");
		                    $("a#journal").css("color","white");           
		                    $("a#journal").css("border-bottom", "0px solid");   
		                    $("i#logotwc").attr('class', 'logo-sprite-putih');
		                    $("img#img-cart").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-cart-putih.png");
		                    $("img#img-login").attr("src","<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-account-putih.png");
		                    $("i#img-search").attr('class', 'icon-search-white');
		               
		            });
		            $("li#journal").mouseenter(function (e) {
		                $("a#journal").css("color", "#9e8461");
		                $("a#journal").css("border-bottom", "1px solid");
		                $("a#journal").css("padding-bottom", "1px");
		                $("a#journal").css("margin-right", "15px");
		                $("a#journal").css("padding-right", "0");
		                $("a#journal").css("margin-left", "15px");
		                $("a#journal").css("padding-left", "0");

		                $("a#watches").css("color", "black");
		                $("a#straps").css("color", "black");
		                $("a#accessories").css("color", "black");
		                $("a#jewelry").css("color","black");
		                $("a#brands").css("color", "black");
		                $("a#watches").css("border-bottom", "0px solid");
		                $("a#straps").css("border-bottom", "0px solid");
		                $("a#accessories").css("border-bottom", "0px solid");
		                $("a#brands").css("border-bottom", "0px solid");
		            });
                }
            }else {
               if ( scroll >= shrinkHeaderMobile ) {
               		$('#navbar-mobile').css("background-color","#fff");
                   $('.height-menu2').addClass('scroll');
                   $('.collapse.navbar-collapse').addClass('scroll');
                   $('.mn-header.submenu').addClass('scroll');
                   $('#navbar-mobile').css("box-shadow","rgba(0, 0, 0, 0.5) 1px 1px 5px 0px");
                   $('#navbar-mobile').css("position","fixed");
                   $('#navbar-mobile').css("top","0");
                   $('#navbar-mobile').css("margin-top","0");
                   $('.swiper-container-homeban').css("padding-top","120px");

                }
                else {
                    $('.height-menu2').removeClass('scroll');
                    $('.collapse.navbar-collapse').removeClass('scroll');
                    $('.mn-header.submenu').removeClass('scroll');
                    $('#navbar-mobile').css("box-shadow","none");
                    $('#navbar-mobile').css("position","relative");
                   $('#navbar-mobile').css("top","unset");
                   $('#navbar-mobile').css("margin-top","none");
                   $('.swiper-container-homeban').css("padding-top","0");
                }
            }
           

          
      });
    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
        }
    });
</script>
    <script>


        $('.product-spesification').click(function () {
            $('.artop-spesification').fadeIn('slow');
            $('.ardown-spesification').fadeOut('slow');
            $('.product-spesification').fadeOut('slow');
            $('.product-spesification-after').slideDown('slow');
            $('.contain-spesification').slideDown('slow');
        });

        $('.product-spesification-after').click(function () {
            $('.artop-spesification').fadeOut('slow');
            $('.ardown-spesification').fadeIn('slow');
            $('.product-spesification').fadeIn('fast');
            $('.product-spesification-after').slideUp('slow');
            $('.contain-spesification').slideUp('slow');
        });
        
        $('.product-warranty').click(function () {
            $('.artop-spesification').fadeIn('slow');
            $('.ardown-spesification').fadeOut('slow');
            $('.product-warranty').fadeOut('slow');
            $('.product-warranty-after').slideDown('slow');
            $('.contain-warranty').slideDown('slow');
        });

        $('.product-warranty-after').click(function () {
            $('.artop-spesification').fadeOut('slow');
            $('.ardown-spesification').fadeIn('slow');
            $('.product-warranty').fadeIn('fast');
            $('.product-warranty-after').slideUp('slow');
            $('.contain-warranty').slideUp('slow');
        });
		
		$('.product-estimasi').click(function () {
            $('.product-estimasi').fadeOut('slow');
            $('.product-estimasi-after').slideDown('slow');
            $('.contain-estimasi').slideDown('slow');
        });

        $('.product-estimasi-after').click(function () {
            $('.product-estimasi').fadeIn('fast');
            $('.product-estimasi-after').slideUp('slow');
            $('.contain-estimasi').slideUp('slow');
        });
		
		$('.product-cicilan').click(function () {
            $('.product-cicilan').fadeOut('slow');
            $('.product-cicilan-after').slideDown('slow');
            $('.contain-cicilan').slideDown('slow');
        });

        $('.product-cicilan-after').click(function () {
            $('.product-cicilan').fadeIn('fast');
            $('.product-cicilan-after').slideUp('slow');
            $('.contain-cicilan').slideUp('slow');
        });

        $('.product-description').click(function () {
            $('.artop-desc').fadeOut('slow');
            $('.ardown-desc').fadeIn('slow');
            $('.product-description').fadeOut('slow');
            $('.product-description-after').fadeIn('slow');
            $('.product-description-text').slideUp('slow');
        });

        $('.product-description-after').click(function () {
            $('.artop-desc').fadeIn('slow');
            $('.ardown-desc').fadeOut('slow');
            $('.product-description').fadeIn('slow');
            $('.product-description-after').fadeOut('slow');
            $('.product-description-text').slideDown('slow');
        });
		
		//snippet for countdown
			
		var austDay = new Date();
		austDay = new Date(Date.UTC(2016, 12, 13, 13, 0, 0));
		
		$('#countdown-desktop').countdown({until: austDay, format: 'OODHMS', 
			layout: '<div id="clock" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 countdown-bg" style="color: #fff;">' + 
			'<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{dn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">DAY</span></div></div>' +
			'<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{hn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">HOUR</span></div></div>' + 
			'<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{mn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">MINUTE</span></div></div>' + 
			'<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{sn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">SECOND</span></div></div><div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-4 col-xs-offset-1 text-center fsize-1-5 mtop1-5"><div class="block"><span class="gotham-medium">TO GO TO OUR HARBOLNAS SPECIAL DEAL</span></div></div></div>'});

		$('#countdown-mobile').countdown({until: austDay, format: 'OODHMS', 
			layout: '<div id="clock" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 countdown-bg" style="color: #fff;">' + 
			'<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{dn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">DAY</span></div></div>' +
			'<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{hn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">HOUR</span></div></div>' + 
			'<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{mn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">MINUTE</span></div></div>' + 
			'<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{sn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">SECOND</span></div></div><div class="col-xs-12 countdown-bg text-center" style="padding: 4% 15px 6% 15px;"><div class="block"><span class="gotham-medium" style="color: #fff;">TO GO TO OUR HARBOLNAS SPECIAL DEAL</span></div></div></div>'});

		
    </script>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T35B3Z"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	<!-- begin prism-widget --> 
        <script type="text/javascript"> 
            (function(p,r,i,s,m) {
                var a = + new Date();
                s = r.createElement('script');
                m = r.getElementsByTagName('body')[0].appendChild(s);
                s.src = 'https://prismapp-files.s3.amazonaws.com/widget/prism.js?' + a.toString(); 
                s.async = true;
                s.onload = function() {p.Shamu = new Prism('ebe5f053-ad62-466f-beac-5fb02d4770dd');Shamu.display();}})
            (window, document); 
        </script> 
	<!-- end prism-widget -->
</body>
</html>
                    <script type="text/javascript">
$(document).ready(function(){
     $("#myarousel").carousel({
         interval : 3000,
         pause: false
     });
});
</script>           
    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 2,
        // paginationClickable: true,
        spaceBetween: 0,
        freeMode: true,
        autoplay: 5000,
    });
    
    var swiper7 = new Swiper('.swiper-container-footer', {
    			autoHeight: true,
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        paginationClickable: true,
       //  navigation: {
	      //   nextEl: '.swiper-button-next',
	      //   prevEl: '.swiper-button-prev',
	      // },
        spaceBetween: 0,
        slidesPerView: 1,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });
    </script>
    <style>
        .o-wrapper.has-push-left {
        -webkit-transform: translateX(100%);
        -ms-transform: translateX(100%);
        transform: translateX(100%);

    }

    .o-wrapper.has-push-left {
        -webkit-transform: translateX(0px);
        -ms-transform: translateX(0px);
        transform: translateX(0px);
    }


    .o-wrapper.has-push-right {
        -webkit-transform: translateX(-100%);
        -ms-transform: translateX(-100%);
        transform: translateX(-100%);
    }

    .o-wrapper.has-push-right {
        -webkit-transform: translateX(-0px);
        -ms-transform: translateX(-0px);
        transform: translateX(-0px);
    }
    @media only screen and (max-width : 767px) {
        .c-menu--push-left {
            width: 47.5%;
        }
        .c-menu--push-right {
            width: 85.5%;
        }
        
        .c-menu--slide-top,
        .c-menu--slide-bottom,
        .c-menu--push-top,
        .c-menu--push-bottom {
            vertical-align: middle;
            width: 56%;
            height: 80px;
            text-align: center;
            overflow: hidden;
        }
    }

    </style>
<?php $this->endPage() ?>
