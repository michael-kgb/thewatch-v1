<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AppAsset;
use backend\models\Homebanner;
use backend\models\ProductCategory;
use backend\models\Brands;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!--
	
	'########:'##::::'##:'########:'##:::::'##::::'###::::'########::'######::'##::::'##:::::::'######:::'#######::
	... ##..:: ##:::: ##: ##.....:: ##:'##: ##:::'## ##:::... ##..::'##... ##: ##:::: ##::::::'##... ##:'##.... ##:
	::: ##:::: ##:::: ##: ##::::::: ##: ##: ##::'##:. ##::::: ##:::: ##:::..:: ##:::: ##:::::: ##:::..:: ##:::: ##:
	::: ##:::: #########: ######::: ##: ##: ##:'##:::. ##:::: ##:::: ##::::::: #########:::::: ##::::::: ##:::: ##:
	::: ##:::: ##.... ##: ##...:::: ##: ##: ##: #########:::: ##:::: ##::::::: ##.... ##:::::: ##::::::: ##:::: ##:
	::: ##:::: ##:::: ##: ##::::::: ##: ##: ##: ##.... ##:::: ##:::: ##::: ##: ##:::: ##:'###: ##::: ##: ##:::: ##:
	::: ##:::: ##:::: ##: ########:. ###. ###:: ##:::: ##:::: ##::::. ######:: ##:::: ##: ###:. ######::. #######::
	:::..:::::..:::::..::........:::...::...:::..:::::..:::::..::::::......:::..:::::..::...:::......::::.......:::

	Welcome to our family in here http://kgbgroup.co.id/jobs

	TWC Engineering Team
-->
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
            var csrf = '<?php echo Yii::$app->request->getCsrfToken(); ?>';
            var baseUrl = '<?php echo rtrim(Url::home(true), '/'); ?>';
			window.dataLayer = window.dataLayer || [];
            var vtrans_clnt = '<?php echo Yii::$app->params['vtrans_conf']['clnt_key']; ?>';
            var vtrans_url = '<?php echo Yii::$app->params['vtrans_conf']['api_url']; ?>';
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
		<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/7e02983712f248a4df84d988d/c81078f9c3be0d18bd032db24.js");</script>
		
        <script type="text/javascript">
        /* Use Insider E-Mail IO */
        <?php
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            }
            $session = Yii::$app->session;
            $customerInfo = $session["customerInfo"];
        if (empty($customerInfo)){
        ?>
        window.insider_object = {
            "user": {
                "email": "",
                "gdpr_optin": true,
                "email_optin": true,
                "name": "",
            }
        }
        <?php
        } else {
        ?>
        window.insider_object = {
            "user": {
                "email": "<?= $_SESSION['customerInfo']['email']; ?>",
                "gdpr_optin": true,
                "email_optin": true,
                "name": "<?= $_SESSION['customerInfo']['fname'].' '.$_SESSION['customerInfo']['lname']; ?>",
                "surname": "<?= $_SESSION['customerInfo']['fname']; ?>",
            }
        }
        <?php
        }
        ?>
        </script>

        <?php $this->head() ?>
		<link href="<?php echo \yii\helpers\Url::base(); ?>/img/icons/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    </head>
    <body id="page-top" class="index">
		<?php include "../shared/nav-menu.php" ?>
		<!-- 
        <div class="col-lg-12 col-xs-12 clearright clearleft snow-header" id="snow-header" style="position: fixed;overflow: hidden;height: 900px;z-index: 0;"></div>
        -->
		<?php $this->beginBody() ?>

        <!-- Navigation -->
        <?php
        $connection = Yii::$app->getDb();
                                    $command = $connection->createCommand(" SELECT marketing_bulkhead.marketing_bulkhead_id, marketing_bulkhead.marketing_bulkhead_text, marketing_bulkhead.marketing_bulkhead_type FROM marketing_bulkhead, marketing_campaign, marketing_campaign_bulkhead 
                                    	WHERE marketing_bulkhead.marketing_bulkhead_id = marketing_campaign_bulkhead.marketing_bulkhead_id AND marketing_campaign_bulkhead.marketing_campaign_id = marketing_campaign.marketing_campaign_id AND 
                                    	marketing_bulkhead.marketing_bulkhead_date_from <= NOW() and marketing_bulkhead.marketing_bulkhead_date_to >= NOW() AND 
                                    	marketing_campaign.marketing_campaign_date_from <= NOW() and marketing_campaign.marketing_campaign_date_to >= NOW() AND 
                                    	marketing_bulkhead.marketing_bulkhead_status = 1 AND marketing_campaign.marketing_campaign_status = 1 ");
                    
       $bulkhead = $command->queryAll();
        $data = ProductCategory::find()->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
        echo Yii::$app->view->renderFile('@app/views/site/menu_header.php', array("data" => $data,"bulkhead"=>$bulkhead));
        ?>
        <div id="o-wrapper" class="o-wrapper">
            <main class="o-content">
                <div class="o-container">
                    <!--<div class="hidden-lg hidden-xs" style="padding-top:125px;"></div>-->
                    <?php echo $content; ?>
                    
                    <!--Button TOP-->
                    <?php
                    echo Yii::$app->view->renderFile('@app/views/site/button_top.php');
                    ?>
					
					<section class="hidden-xs" style="background-repeat: repeat-x;padding: 50px 0;background-color: #f2f1f0;"></section>
		
                    <footer id="foot-er" style="position: relative;padding-top:10px;">
                        <div class="col-lg-12 hidden-xs clearleft clearright" id="snow-footer" style="height: 450px;position: absolute;bottom:0;"></div>
                        <div class="container">
                            <div class="row">
								<div class="hidden-xs hidden-sm hidden-md col-lg-8 col-md-8 col-sm-8 clearleft" style="z-index:1;">
									<div class="hidden-xs hidden-sm hidden-md col-lg-6 col-md-6 col-sm-6 clearleft footer caption" style="letter-spacing: 1px;">
										<!--<span class="gotham-medium lspace2">THE WATCH CO.</span>-->
										<br><br> 
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/about">TENTANG KAMI</a></div>
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/store">LOKASI TOKO</a></div>
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/contact">HUBUNGI KAMI</a></div>
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/corporateorder">CORPORATE ORDER</a></div>
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/warranty">GARANSI & SERVIS</a></div>
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a></div>
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/privacy">KEBIJAKAN PRIVASI</a></div>
										<div class="footer link"><a style="color: rgb(32, 97, 103);" href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">INFORMASI PENGIRIMAN</a></div></br>
										<div class="footer follow-us icons socmed btn-socmed">
											<a href="http://www.facebook.com/TheWatchCo" target="_blank">
												<i class="fb-footer inline-block"></i>
											</a>
											<a href="http://twitter.com/thewatchco_id" target="_blank">
												<i class="twitter-footer inline-block"></i>
											</a>
											<a href="https://www.instagram.com/thewatchco" target="_blank">
												<i class="instagram-footer inline-block"></i>
											</a>
											<a href="https://www.youtube.com/user/TheWatchCoOfficial" target="_blank">
												<i class="youtube-footer inline-block"></i>
											</a>
											<a href="https://pinterest.com/thewatchcompany" target="_blank">
												<i class="pinterest-footer inline-block"></i>
											</a>
											<a href="http://line.me/ti/p/%40thewatchco" target="_blank">
												<i class="line-footer inline-block"></i>
											</a>
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
									    <i class="bca-sprites"></i>
										<i class="mandiri-sprites"></i>
										<i class="kredivo-sprites"></i>
										<i class="mastercard-sprites"></i>
										<i class="visa-sprites"></i>
									</div>
									<div class="footer follow-us icons mbottom5">
									    <i class="akulaku-sprites"></i>
										<i class="gopay-sprites"></i>
										<i class="vospay-sprites"></i>
										<i class="jcb-sprites"></i>
									</div>
									
									<div class="footer newsletter caption mbottom5" style="letter-spacing: 1px;">CICILAN 0%</div>
									<div class="footer follow-us icons">
									    <i class="bca-sprites"></i>
										<i class="mandiri-sprites"></i>
										<i class="cimb-sprites"></i>
										<i class="permata-sprites"></i>
										<i class="danamon-sprites"></i>
									</div>
									<div class="footer follow-us icons mbottom5">
										<i class="standard-sprites"></i>
										<i class="hsbc-sprites"></i>
										<i class="panin-sprites"></i>
									</div>
									
									
									<div class="footer newsletter caption mbottom5" style="letter-spacing: 1px;">KEAMANAN BELANJA</div>
									
									<div class="footer follow-us icons mbottom5">
									    <i class="master-secure-sprites"></i>
									    <i class="visa-secure-sprites"></i>
										<i class="comodo-sprites"></i>
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
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/corporateorder">CORPORATE ORDER</a></div>
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
					                                            <i class="bca-sprites"></i>
                        										<i class="mandiri-sprites"></i>
                        										<i class="kredivo-sprites"></i>
                        										<i class="mastercard-sprites"></i>
                        										<i class="visa-sprites"></i>
                        										<i class="akulaku-sprites"></i>
                        										<i class="gopay-sprites"></i>
                        										<i class="vospay-sprites"></i>
                        										<i class="jcb-sprites"></i>
					                                        </div>
														</div>
									                </div>
									                <div class="swiper-slide">
									                	<div class="footer newsletter caption" style="margin-top: 20px;font-size: 14px; text-align: center; letter-spacing: 1px;">CICILAN 0%</div>
						                                    <div class="footer newsletter caption">
						                                        <div class="col-xs-12" style="padding-left: 0; padding-right: 0; text-align: center;">
						                                            <i class="bca-sprites"></i>
                            										<i class="mandiri-sprites"></i>
                            										<i class="cimb-sprites"></i>
                            										<i class="permata-sprites"></i>
                            										<i class="danamon-sprites"></i>
                            										<i class="standard-sprites"></i>
                            										<i class="hsbc-sprites"></i>
                            										<i class="panin-sprites"></i>
						                                        </div>
						                                    </div>
									                </div>

									                <div class="swiper-slide">
									                	<div class="footer newsletter caption" style="margin-top: 20px;font-size: 14px; text-align: center; letter-spacing: 1px;">KEAMANAN BELANJA</div>
					                                    <div class="footer newsletter caption">
					                                        <div class="col-xs-12" style="padding-left: 0; padding-right: 0; text-align: center;">
					                                            <i class="master-secure-sprites"></i>
                        									    <i class="visa-secure-sprites"></i>
                        										<i class="comodo-sprites"></i>
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
										<a href="http://www.facebook.com/TheWatchCo" target="_blank">
												<i class="fb-footer inline-block"></i>
											</a>
											<a href="http://twitter.com/thewatchco_id" target="_blank">
												<i class="twitter-footer inline-block"></i>
											</a>
											<a href="https://www.instagram.com/thewatchco" target="_blank">
												<i class="instagram-footer inline-block"></i>
											</a>
											<a href="https://www.youtube.com/user/TheWatchCoOfficial" target="_blank">
												<i class="youtube-footer inline-block"></i>
											</a>
											<a href="https://pinterest.com/thewatchcompany" target="_blank">
												<i class="pinterest-footer inline-block"></i>
											</a>
											<a href="http://line.me/ti/p/%40thewatchco" target="_blank">
												<i class="line-footer inline-block"></i>
											</a>
									</div>
                                    <br>
                                </div>
                                
                                    
                            </div>
                        </div>
                    </footer>

                    <div class="modal fade" id="loadingScreen" tabindex="-1" role="dialog" aria-hidden="true" style="z-index:2000;">

                    </div>
					
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
                </div>
            </main>
        </div>

        <?php $this->endBody() ?>
        <script>
			//$(window).load(function(){
				//$('#overloadReminder').modal('show');
			//});
			
            $('.carousel').carousel({
                interval: 5000 //changes the speed
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
            
 
			
// 			jQuery(document).ready(function($) {
// 				$(window).scroll(function() {
// 					//alert("masuk");
// 					var navHeight = $( window ).height();
// 					if ($(window).scrollTop() > 50) {
						
// 						$('#logotwc').hide();
// 						$('#logotwcco').show();
// 						$(".default-logo").attr('src', "<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo.png");
// 						$('.default-logo').css('width', '');
// 						$('.default-logo').css('height', '');
// 						$('.default-logo').css('margin-top', '4.3%');
// 						$('.box-logo').css('width', '100px');
// 						$('#navbar-mobile').css('background-color', 'white');
// 						$('.navbar-collapse').css('background-color', 'white');
// 						$('.collapse navbar-collapse').css('height', '35px');
// 						$('.navbar-left.mn-header').css('width', '64%');
// 						$('.navbar-left.mn-header').css('margin-left', '25.6%');
// 						$('.container.mn-header').css('padding-left', '3.7%');
// 					} else {
// 						$('#logotwc').show();
// 						$('#logotwcco').hide();
						
// 						$(".default-logo").attr('src', "<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo.png");
// 						$('.default-logo').css('width', '');
// 						$('.default-logo').css('height', '');
// 						$('.box-logo').css('width', '');
// 						$('#navbar-mobile').css('background-color', '');
// 						$('.padding-homebanner').css('padding-top', '');
// 						$('.box-header').css('width-top', '');
// 						$('.box-header').css('padding-right', '');
// 						$('.box-header').css('padding-left', '');
// 						$('.box-header').css('padding-top', '');
// 						$('.default-logo').css('margin-top', '');
// 						$('.navbar-left.mn-header').css('width', '');
// 						$('.navbar-left.mn-header').css('margin-left', '');
// 					}
// 				});
// 			});
        </script>    
        <script>
            $('.product-spesification').click(function () {
                $('.artop').fadeIn('slow');
                $('.ardown').fadeOut('slow');
                $('.product-spesification').fadeOut('slow');
                $('.product-spesification-after').slideDown('slow');
                $('.contain-spesification').slideDown('slow');
            });

            $('.product-spesification-after').click(function () {
                $('.artop').fadeOut('slow');
                $('.ardown').fadeIn('slow');
                $('.product-spesification').fadeIn('fast');
                $('.product-spesification-after').slideUp('slow');
                $('.contain-spesification').slideUp('slow');
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
        </script>
		<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T35B3Z"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager -->
		
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
<style type="text/css">
	#navbar-mobile{
		background-color: #fff;
	}
</style>
<script type="text/javascript">
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
    
    if( $('#hour-expire').length ){

    $('[id=hour-expire]').countdown(payment_expired, {elapse: true})
        .on('update.countdown', function(event){
            var $this = $(this);
            if (event.elapsed) {
                // after end
                // location.reload();
//                $("#countdown-product-box").hide();
            } else {
            	// var event_hour = event.strftime('%D') * event.strftime('%H');
                $this.html(event.strftime('%H'));
            }
        });
    $('[id=minute-expire]').countdown(payment_expired, {elapse: true})
        .on('update.countdown', function(event){
            var $this = $(this);
            if (event.elapsed) {
                // after end
                // location.reload();
//                $("#countdown-product-box").hide();
            } else {
                $this.html(event.strftime('%M'));
            }
        });
    $('[id=second-expire]').countdown(payment_expired, {elapse: true})
        .on('update.countdown', function(event){
            var $this = $(this);
            if (event.elapsed) {
                // after end
                // location.reload();
//                $("#countdown-product-box").hide();
            } else {
                $this.html(event.strftime('%S'));
            }
        });
    }
    </script>
<?php $this->endPage() ?>
