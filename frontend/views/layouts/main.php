<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AppAsset;
use backend\models\Homebanner;
use backend\models\ProductCategory;
use backend\models\Brands;
use backend\models\SeoPagesContent;
use app\assets\ProductDetailAsset;

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
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="google-site-verification" content="TwfVeC79a0xIyMDjUx_b_YYL_IziuNhbcMWvjjg3Z7s" />
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="TheWatchCo">
		<meta name="msvalidate.01" content="E29022F3EC32888E330601805643C091" />
		<!-- Force Users to refresh their Browser cache on this Site -->
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<!-- End Force Users to refresh their Browser cache on this Site -->
        <?= Html::csrfMetaTags() ?>	
        <title>Pusat Jual Jam Tangan Branded Original Indonesia – The Watch Co.</title>
        <?php $this->head() ?>
		<link href="https://www.thewatch.co/css/homepage.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var baseUrl = '<?php echo rtrim(Url::home(true), '/'); ?>';
			var frontend_url = window.location.origin;
            var currentUrl = '<?php echo Yii::$app->request->url; ?>';
            var csrf = '<?php echo Yii::$app->request->getCsrfToken(); ?>';
			window.dataLayer = window.dataLayer || [];
			var promotions = [];
            var vtrans_clnt = '<?php echo Yii::$app->params['vtrans_conf']['clnt_key']; ?>';
            var vtrans_url = '<?php echo Yii::$app->params['vtrans_conf']['api_url']; ?>';
        </script>
		<script type="text/babel">
			const getMessage = () => "Welcome to Thewatch.co";
			console.log(getMessage());
		</script>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl+ '&gtm_auth=cskdfuOs0xrn87GL3I1MLQ&gtm_preview=env-1&gtm_cookies_win=x';f.parentNode.insertBefore(j,f);
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
		
		<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/7e02983712f248a4df84d988d/f595775907166d27b5ca0b381.js");</script>
        
        <!-- Push NotificationSS -->
        <link href="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/js/pushnotif/manifest.json" rel="manifest" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/js/pushnotif/mobile-logo/ic_launcher180.png">
        <link href="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/js/pushnotif/manifest.json" rel="manifest" />
        <link href="<?php echo \yii\helpers\Url::base(); ?>/js/insider/manifest.json" rel="manifest" />
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
          <script>
		  var OneSignal = OneSignal || [];
		  OneSignal.push(["init", {
		    appId: "735062e9-881a-484b-970a-7cfbcf348a7d",
            // subdomainName: 'thewatchco',
            autoRegister: true,
            safari_web_id:"web.onesignal.auto.040fbea3-5bf4-4f81-a6ad-042d48246d00",
		    notifyButton: {
		      enable: false /* Set to false to hide */
		    },
		    welcomeNotification: {
              title: "Welcome to The Watch Co.",
              message: "Stay tuned for our latest info."
            },
		 
		   
		  }]);
		</script>
		
		<!--<script type="text/javascript">
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
		</script>-->
		<script type="application/ld+json">
		{
		   "@context": "http://schema.org",
		   "@type": "WebSite",
		   "url": "https://www.thewatch.co/",
		   "potentialAction": {
			   "@type": "SearchAction",
			   "target": {
				   "@type": "EntryPoint",
				   "urlTemplate": "https://www.thewatch.co/category/search?q={search_term_string}"
			   },
			   "query-input": {
				   "@type": "PropertyValueSpecification",
				   "valueRequired": "http://schema.org/True",
				   "valueName": "search_term_string"
			   }
			}
		}
		</script>
		<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/7e02983712f248a4df84d988d/c81078f9c3be0d18bd032db24.js");</script>
		
		<link href="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <?= Html::csrfMetaTags() ?>
    </head>
    <body id="page-top" class="index">
		<?php include "../shared/modal-newsletter.php" ?>
		<?php include "../shared/nav-menu.php" ?>

        <div class="col-lg-12 col-xs-12 clearright clearleft snow-header" id="snow-header" style="position: fixed;overflow: hidden;height: 900px;z-index: 0;"></div>
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

        <!-- Page Header -->
        <?php
        $data = Homebanner::find()->limit(10)->orderBy('homebanner_sequence')->where(['homebanner_status' => 'active'])->all();
        echo Yii::$app->view->renderFile('@app/views/site/homebanner.php', array("data" => $data));
        echo Yii::$app->view->renderFile('@app/views/site/homebannermobile.php', array("data" => $data));
        ?>
		<?php 
        $current_date = date('Y-m-d H:i:s');
            if( ($current_date > '2020-04-01 00:00:00') && ($current_date <= '2020-04-12 23:59:59') ){
                echo Yii::$app->view->renderFile('@app/views/site/easter_egg.php');
            }
        ?>
        
		
        <div id="o-wrapper" class="o-wrapper">
            <main class="o-content">
                <div class="o-container">
					<!--<section id="countdown">
                        <div class="container">
                            <div class="row hidden-xs">
                                <div id="countdown-desktop"></div>
                            </div> 
                            <div class="row hidden-lg hidden-md hidden-sm">
                                <div id="countdown-mobile"></div>
                            </div>
                        </div>
                    </section>-->
                    
					<div class="col-lg-12 col-lg-12 col-sm-12 shop-title">BELANJA</div>
                    <!-- Featured Banner -->
                    <?php
                    $data = ProductCategory::find()->where(array("product_category_status" => "active", "product_category_featured" => "1"))->orderBy('product_category_sequence')->all();
                    echo Yii::$app->view->renderFile('@app/views/site/featured_banner.php', array("data" => $data));
                    ?>
                    
                    <?php
                    // Flash sale
                    //echo Yii::$app->view->renderFile('@app/views/site/flash_sale.php', array("data" => $data));
					?>
					<!--
					<section>
						<div class="container">
							<div class="row">
								<?php
									$current_date = date('Y-m-d H:i:s');
									$banner_home_desktop = 'promo/flash/campaign-banner-desktop-010219.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
									$banner_home_mobile = 'promo/flash/campaign-banner-mobile-010219.jpg?auto=compress%2Cformat&fm=pjpg';
									if( ($current_date > '2019-01-31 21:00:00') && ($current_date <= '2019-02-01 17:00:00') ){
										$banner_home_desktop = 'promo/flash/campaign-banner-desktop-010219.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
            							$banner_home_mobile = 'promo/flash/campaign-banner-mobile-010219.jpg?auto=compress%2Cformat&fm=pjpg';
									}elseif( ($current_date > '2019-02-01 17:00:00') && ($current_date <= '2019-02-01 21:00:00') ){
										$banner_home_desktop = 'promo/flash/campaign-banner-desktop-010219.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
            							$banner_home_mobile = 'promo/flash/campaign-banner-mobile-010219.jpg?auto=compress%2Cformat&fm=pjpg';
									}
									/*
									elseif( ($current_date > '2019-02-01 21:00:00') && ($current_date <= '2019-02-02 17:00:00') ){
										$banner_home_desktop = 'promo/flash/campaign-banner-desktop-020219.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
            							$banner_home_mobile = 'promo/flash/campaign-banner-mobile-020219.jpg?auto=compress%2Cformat&fm=pjpg';
									}elseif( ($current_date > '2019-02-02 17:00:00') && ($current_date <= '2019-02-02 21:00:00') ){
										$banner_home_desktop = 'promo/flash/campaign-banner-desktop-020219.jpg?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;max-w=3840';
										$banner_home_mobile = 'promo/flash/campaign-banner-mobile-020219.jpg?auto=compress%2Cformat&fm=pjpg';
									}
									*/
								?>
								<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs ptop15">
									<a href="/flash-sale">
										<img alt="Flash Sale" class="img-responsive" src="<?php echo Yii::$app->params['imgixUrl'].$banner_home_desktop; ?>" data-was-processed="true">
									</a>
								</div>
								<div class="hidden-lg hidden-md hidden-sm col-xs-12 ptop15">
									<a href="/flash-sale">
										<img alt="Flash Sale" class="img-responsive" src="<?php echo Yii::$app->params['imgixUrl'].$banner_home_mobile; ?>" data-was-processed="true">
									</a>
								</div>
							</div>
						</div>
					</section>
					-->
                    
                    
                    <?php
                        // if($_SESSION['customerInfo']['customer_id'] == 7614){
                            // echo Yii::$app->view->renderFile('@app/views/site/sale.php');
                        // }
                    
                    ?>
                    
                    
                   <?php
                    // Popular Brand
                    echo Yii::$app->view->renderFile('@app/views/site/popular_brand.php', array("data" => $data));
                    ?>
                    
                    
                    
                    <!-- Featured Brands -->
                    <?php
                    $data = Brands::find()->where(array("brand_status" => "active", "brand_featured" => 1))->orderBy('brand_sequence')->all();
                    echo Yii::$app->view->renderFile('@app/views/site/featured_brands.php', array("data" => $data));
                    ?>
                    
                    <!-- Journal -->
                    <?php
           
                    echo Yii::$app->view->renderFile('@app/views/site/journal.php');
                    ?>
                    
                    <!-- Bulkhead Footer -->
                    <?php echo Yii::$app->view->renderFile('@app/views/site/bulkhead_footer.php', array("bulkhead"=>$bulkhead)); ?>


                    
                    <!--Button TOP-->
                    <hr>
                    <?php
                    echo Yii::$app->view->renderFile('@app/views/site/button_top.php');
                    ?>
					<!--SEO Pages-->
                    <?php 
                        $seo = SeoPagesContent::find()->where('seo_pages_id=1')->all();
//                        print_r($seo); die();
                        echo Yii::$app->view->renderFile('@app/views/site/seo_pages.php', array("seo"=>$seo));
                    ?>
					<section class="hidden-xs footer-top"></section>

                    <footer>
                        <div class="col-lg-12 hidden-xs clearleft clearright" id="snow-footer" style="height: 450px;position: absolute;bottom:0;"></div>
                        <div class="container">
                            <div class="row">
								<div class="hidden-xs hidden-sm hidden-md col-lg-8 col-md-8 col-sm-8 clearleft footer-index">
									<div class="hidden-xs hidden-sm hidden-md col-lg-6 col-md-6 col-sm-6 clearleft footer caption">
										<!--<span class="gotham-medium lspace2">THE WATCH CO.</span>-->
										<br><br> 
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/about">TENTANG KAMI</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/store">LOKASI TOKO</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/contact">HUBUNGI KAMI</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/corporateorder">CORPORATE ORDER</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/warranty">GARANSI & SERVIS</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/privacy">KEBIJAKAN PRIVASI</a></div>
										<div class="footer link"><a href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">INFORMASI PENGIRIMAN</a></div></br>
										<div class="footer follow-us icons socmed btn-socmed">
											<a href="http://www.facebook.com/TheWatchCo" target="_blank">
                                            <i class="fb-footer"></i>
											</a>
											<a href="http://twitter.com/thewatchco_id" target="_blank">
                                            <i class="twitter-footer"></i>
											</a>
											<a href="https://www.instagram.com/thewatchco" target="_blank">
                                            <i class="instagram-footer"></i>
											</a>
                                            <a href="https://www.youtube.com/user/TheWatchCoOfficial" target="_blank">
                                                <i class="youtube-footer"></i>
											</a>
											<a href="https://pinterest.com/thewatchcompany" target="_blank">
                                            <i class="pinterest-footer"></i>
											</a>
											<a href="http://line.me/ti/p/%40thewatchco" target="_blank">
                                            <i class="line-footer"></i>
											</a>
										</div>
									</div>

									<div class="hidden-xs hidden-sm hidden-md col-lg-6 col-md-6 col-sm-6 clearleft footer caption">
										<span></span>
										<br><br>
										<div class="footer newsletter caption">IKUTI / DAFTAR NEWSLETTER KAMI</div>
										<input class="footer newsletter email email-subscribe margin-email" type="text" name="newsletter" placeholder="Enter your email address"/>
										<span class="input-group-addon subscribe-newsletter button-subscribe">SUBSCRIBE</span>
										<br><br>
										<div class="footer follow-us caption">Dapatkan voucher Rp 100,000,-* jika anda berlangganan newsletter kami.</div><br><br>
										<div class="footer newsletter caption mbottom5">CUSTOMER SERVICE</div>
										<div class="footer newsletter caption">Get in touch / +62 813 6800 1010 </br>(Mon-Fri 9AM-5PM (+7GMT))</div>
									</div>
								</div>
							
								<div class="hidden-xs hidden-sm hidden-md col-lg-4 col-md-4 col-sm-4 footer caption top-metode clearright">
									<span></span>
									<br><br>
									<div class="footer newsletter caption mbottom5">METODE PEMBAYARAN</div>
									<div class="footer follow-us icons">
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
									
									<div class="footer newsletter caption mbottom5">CICILAN 0%</div>
									<div class="footer follow-us icons">
									    <i class="bca-sprites"></i>
										<i class="mandiri-sprites"></i>
										<i class="cimb-sprites"></i>
										<i class="permata-sprites"></i>
										<i class="danamon-sprites"></i>
									</div>
									<div class="footer follow-us icons mbottom5">
										<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/uob.png" class="logo-payment">-->
										<i class="standard-sprites"></i>
										<i class="hsbc-sprites"></i>
										<i class="panin-sprites"></i>
									</div>
									
									
									<div class="footer newsletter caption mbottom5">KEAMANAN BELANJA</div>
									
									<div class="footer follow-us icons mbottom5">
									    <i class="master-secure-sprites"></i>
									    <i class="visa-secure-sprites"></i>
										<i class="comodo-sprites"></i>
									</div>
								</div>


                                <!--mobile footer-->
                                <div class="hidden-lg col-xs-12 footer caption margin-top-5 footer-index">
                                    <div class="footer newsletter caption title-newsletter">IKUTI / DAFTAR NEWSLETTER KAMI</div>
										<div class="footer newsletter caption">
										<input class="footer newsletter email email-subscribe" type="text" name="newsletter" placeholder="Enter your email address"/>
										<span class="input-group-addon subscribe-newsletter btn-subscribe">SUBSCRIBE</span>
										</div></br></br></br></br>
										<div class="footer follow-us caption mobile-text-1">Dapatkan voucher Rp 100,000,-* jika anda berlangganan newsletter kami.</div><br	>
										<div class="footer newsletter caption mobile-text-2">CUSTOMER SERVICE</div><br>
										<div class="footer newsletter caption mobile-text-3">Get in touch/ +62 813 6800 1010</div>
										<div class="footer newsletter caption mobile-text-4">(Mon-Fri 9AM-5PM (+7GMT))</div>
                                    <div class="footer-mobile-link">
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/about">TENTANG KAMI</a></div>
										<div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/store">LOKASI TOKO</a></div>
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/contact">HUBUNGI KAMI</a></div>
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/corporateorder">CORPORATE ORDER</a></div>
										<div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/warranty">GARANSI & SERVIS</a></div>
                                        <div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/faq">FAQ</a></div>
										<div class="col-xs-12 footer-mobile-link-content"><a href="<?php echo \yii\helpers\Url::base(); ?>/privacy">KEBIJAKAN PRIVASI</a></div>
										<div class="col-xs-12 footer-mobile-link-content clearleft-mobile clearright-mobile"><a href="<?php echo \yii\helpers\Url::base(); ?>/shipping-information">INFORMASI PENGIRIMAN</a></div>
										<!-- <div class="col-xs-6 footer-mobile-link-content"><a href="#">BACK TO TOP</a></div> -->
                                    </div>
									<div class="clearfix"></div>
									
									<div id="" class="swiper-container-footer hidden-lg hidden-md hidden-sm col-xs-8 col-xs-offset-2">
									    <div class="swiper-wrapper clearleft clearright">
									                <div class="swiper-slide">
									                    <div class="footer newsletter caption metode">METODE PEMBAYARAN</div>
                                
					                                    <div class="footer newsletter caption">
					                                        <div class="col-xs-12 clearleft-mobile clearright-mobile talign-center">
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
									                	<div class="footer newsletter caption metode">CICILAN 0%</div>
						                                    <div class="footer newsletter caption">
						                                        <div class="col-xs-12 clearleft-mobile clearright-mobile talign-center">
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
									                	<div class="footer newsletter caption metode">KEAMANAN BELANJA</div>
					                                    <div class="footer newsletter caption">
					                                        <div class="col-xs-12 clearleft-mobile clearright-mobile talign-center">
					                                            <i class="master-secure-sprites"></i>
                        									    <i class="visa-secure-sprites"></i>
                        										<i class="comodo-sprites"></i>
					                                        </div>
														</div>
									                </div>
									               
									    </div>
										<div class="swiper-pagination metode-paging"></div>
									    <!-- Add Arrows -->
									</div>
									
                   
									<div class="clearfix"></div>
                             
                                    <div class="clearfix"></div>
								    <div class="footer newsletter caption talign-center">
										<a href="#" class="scrolls">
											<i class="back-top"></i>
											<div class="talign-center gotham-light fsize-12 lspace0-6"><i class="footer-top"></i><br><br>BACK TO TOP</div>
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

                    <div class="modal fade" id="loadingScreen" tabindex="-1" role="dialog" aria-hidden="true">

                    </div>
					
										<div class="portfolio-modal modal fade subscribe" id="subscribeModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-content notifyme">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding modal-newsletter">
                                <!--<div class="modal-body">-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding">
                                    <a href="#" data-dismiss="modal" class="">
                                        <img src="https://thewatch.imgix.net/close.png?auto=compress&fit=max" class="close-mobile">
                                    </a>
                                    <!-- <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 clearleft clearright remove-padding img-subscribe">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/hello.jpg" class="img-responsive" style="height:467px;">
                                    </div> -->
                                    <div id="popup-subscribe-thanks1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 success title margin-top-5">
                                        <span class="gotham-light thanks-sub fcolorfff lspace0-5">Thank you for subscribing!</span>
                                    </div>
                                    <div id="popup-subscribe-thanks2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 success content margin-bottom-10">
                                    	<div class="hidden-sm hidden-md hidden-lg p10"></div>
                                        <span class="gotham-light check-sub popup-subscribe-title2 no-spacing fcolorfff lspace0-5 talign-center">
                                            
                                            Please check your email to enjoy your discount.
                                        </span>
                                        <div class="hidden-sm hidden-md hidden-lg p10"></div>
                                        <div class="mtop5 pleft30p pright30p">
                                            <a href="#" data-dismiss="modal" class="gotham-light mn-header btn-subscribe width100 talign-center p4p">
	                                        	Continue Shopping
	                                    	</a>
                                        </div>
                                    </div>



                                    <div id="popup-subscribe-form1" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="gotham-light title-sub fcolorfff">Welcome to The Watch Co.</span>
                                    </div>
                                    <div id="popup-subscribe-form2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="gotham-light fsize-1 popup-subscribe-title2 no-spacing fcolorfff">
                                            Stay updated for the latest watch news and offers. <br>
                                            Enjoy <span class="gotham-medium">IDR 100.000*</span> by subscribing to our newsletter now! <br>
                                
                                        </span>
                                    </div>
                                    <div id="popup-subscribe-form3" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-left">
                                        <div class="mn-header margin-top-5 margin-bottom-5">
                                            <input class="form-subscribe email" type="text" name="firstname_subscribe" placeholder="Firstname">
                                            <span id="firstname-signin-error">* Firstname Required</span>
                                        </div>
                                    </div>
                                    <div id="popup-subscribe-form4" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-left">
                                        <div class="mn-header margin-bottom-5">
                                            <input class="form-subscribe email" type="text" name="email_subscribe" placeholder="Email Address">
                                            <span id="email-signin-error">* Email Required</span>
                                        </div>
                                    </div>
                                    <div id="popup-subscribe-form5" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 margin-bottom-5">
                                        <div class="mn-header btn-subscribe" id="subscribe">Men</div>
                                        <div class="mn-header btn-subscribe" id="subscribe-fem">Women</div>
                                    </div>
                                    <div id="popup-subscribe-form6" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 talign-left">
                                    	<a href="#" data-dismiss="modal" class="gotham-light no-thank">
                                        	No, thanks
                                    	</a>
                                    </div>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    
                    <div id="loginWarranty" class="modal fade" role="dialog">
					  <div class="modal-dialog login-warranty">

					    <!-- Modal content-->
					    <div class="modal-content login-warranty">
					      <div class="modal-header login-warranty">
					        
					        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile" id="tab-login">					                    
					            <span class="clearleft clearright clearleft-mobile clearright-mobile">
					               <img id="img-login-warranty" src="https://thewatch.imgix.net/icons/account-mobile.png?auto=compress&fit=max"> Masuk
					            </span>
					        </div>
					        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile tab-signup" id="tab-signup">					                    
					            <span class="clearleft clearright clearleft-mobile clearright-mobile">
					                <img id="img-signup" src="https://thewatch.imgix.net/icons/account-mobile.png?auto=compress&fit=max"> Daftar
					            </span>
					        </div>

					      </div>
					      <div class="modal-body login-body" id="login-body">
					          <?php
					            $url_warranty = '/warranty';
					            if(isset($_GET['back_url'])){
					                $url_warranty = $_GET['back_url'];
					            }
					          ?>
					          <input type="hidden" name="url_warranty" id="url_warranty" value="<?php echo $url_warranty; ?>">
					        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile mtop10 mbottom15">
					        	Login untuk mengakses halaman garansi
					        </div>
					      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					            <input placeholder="Email" name="email_login_warranty" id="email_login_warranty" value="">
					            <span id="error-email-login"></span>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					           
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					            <input type="password" placeholder="Password" name="password_login_warranty" id="password_login_warranty" value="">
					            <span id="error-password-login"></span>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile login-warranty tab forget">
					          		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
					           		</div>
					           		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile">
					           			<a id="tab-forget">Lupa Password</a>
					           		</div>
					          </div>
					          <div id="retrieve-body">
					          	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-center">
					           		Lupa Password Anda? Silahkan isi alamat email dibawah untuk kami kirimkan email konfirmasi lupa password.
					          	</div>
					          	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile mtop30">
						            <input placeholder="Email" name="retrieve_login_warranty" id="retrieve_login_warranty" value="">
						            <span id="error-retrieve-login"></span>
						         </div>
						         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile mtop10 mbottom10">
						           	<a id="retrieve-warranty" class="blue-round">OK</a>
						          </div>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					           	<a id="login-warranty" class="blue-round">Masuk</a>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile new-line"></div>

					         </div>
					      </div>

					      <div class="modal-body signup-body" id="signup-body">
					        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile mtop10 mbottom15">
					        	
					        </div>
					      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					            <input placeholder="Email" name="email_signup_warranty" id="email_signup_warranty" value="">
					            <span id="error-email-signup"></span>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					           
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					            <input placeholder="Nama" name="first_name_signup_warranty" id="first_name_signup_warranty" value="">
					            <span id="error-name-signup"></span>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					           
					          </div>
					          
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					            <input placeholder="Telephone" name="telp_signup_warranty" id="telp_signup_warranty" value="">
					            <span id="error-telp-signup"></span>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					           
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					            <input type="password" placeholder="Password" name="password_signup_warranty" id="password_signup_warranty" value="">
					            <span id="error-password-signup"></span>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					           
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
					            <input type="password" placeholder="Konfirmasi Password" name="confirm_password_signup_warranty" id="confirm_password_signup_warranty" value="">
					            <span id="error-confirm-password-signup"></span>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					          		
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile height20">
					           	<a id="signup-warranty" class="blue-round">Daftar</a>
					          </div>
					          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile new-line"></div>

					         </div>

					         </div>
					      </div>
					      
					      
					    </div>

					  </div>
					</div>
					
					<!--<div id="ied-modal" class="modal fade" role="dialog">-->
					<!--  <div class="modal-dialog ied" style="vertical-align: middle;margin-top: 5%;margin-bottom: 5%;">-->

					    <!-- Modal content-->
					<!--    <div class="modal-content" style="border-radius: 10px;background-color: rgb(255,255,255);">-->
					<!--      <div class="modal-body" style="padding-top: 15px;">-->
					<!--        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>-->
					<!--        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">-->
					                          
					<!--                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">-->
					<!--                            Informasi Lebaran-->
					<!--                          </span>-->
					<!--                          <span class="clearleft clearright clearright-mobile gotham-medium">-->
					                            <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition.png" style="width: 24px;margin-left: 10px;"> -->
					<!--                          </span>-->
					                          
					<!--                        </div>-->
					                        
					<!--      </div>-->
					<!--      <div class="modal-body title-warranty" style="display:inline-block;margin-top:7px;padding-top:5px;">-->
					        
					<!--      <hr style="margin-top: 0px;margin-bottom: 20px;border-top:1px solid rgb(69,69,69);">-->
					<!--        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light" style="padding-bottom: 20px;">-->
					<!--            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright clearleft-mobile clearright-mobile" style="text-align: center;">					            				            		-->
					<!--        		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/lebaran/Pop-Up-Home-Page-Desktop.jpg" style="border-radius: 5px;width: 100%;">			            	-->
					<!--            </div>-->
					<!--            <div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="text-align: center;">					            				            		-->
					<!--        		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/lebaran/Pop-Up-Home-Page-Mobile.jpg" style="border-radius: 5px;width: 100%;">			            	-->
					<!--            </div>                -->
					<!--        </div>-->
					                
					        
					<!--        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">-->
					<!--            <a class="blue-round close fsize-14 fsize-i5-10" data-dismiss="modal" style="width:100%;text-align: center;padding-top: 14px;padding-bottom: 11px;text-shadow: none;">-->
					<!--            	Lanjut Berbelanja-->
					<!--            </a>-->
					<!--        </div>-->

					<!--      </div>-->
					      
					<!--    </div>-->

					<!--  </div>-->
					<!--</div>-->
					
                    <!--<div class="portfolio-modal modal fade hpn" id="subscribeHpn" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-content hpn notifyme">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding modal-newsletter">
                                <!--<div class="modal-body">-->
                                <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding img-hpn">
										<a href="#" data-dismiss="modal" class="hidden-xs">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-mobile-hpn">
                                    </a>
										<a href="http://thewatch.co/hari-pelanggan-nasional">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/popup-hpn.jpg" class="img-responsive hpn-image">
										</a>
                                    </div>
                                </div>
                                <!--</div>-->
                            <!--</div>
                        </div>
                    </div>-->
                </div>
            </main>
        </div>
		<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>-->
        <?php $this->endBody() ?>
        <script>
		<?php if(isset($_GET['newsletterpopup']) && $_GET['newsletterpopup'] == 'open'){ ?>
            $('#subscribeModal').modal('show');
        <?php } ?>
       
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
            
  
            
            $("a#filter").not("#box-filter").focusout(function () {
                setTimeout(function () {
                    $("#arrow-filter").slideUp();
                    $("#box-filter").slideUp();
                }, 200);
            });
            
     
			
			//snippet for countdown
			
			var austDay = new Date();
            austDay = new Date(Date.UTC(2016, 12, 13, 13, 0, 0));
            
            //$('#countdown-desktop').countdown({until: austDay, format: 'OODHMS', 
            //    layout: '<div id="clock" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 countdown-bg" style="color: #fff;">' + 
            //    '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{dn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">DAY</span></div></div>' +
            //    '<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{hn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">HOUR</span></div></div>' + 
            //    '<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{mn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">MINUTE</span></div></div>' + 
            //    '<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-1 col-xs-offset-1 text-center"><div class="block"><span class="value gotham-medium fsize-3">{sn}</span></div><div class="block mbottom20"><span class="unit gotham-medium">SECOND</span></div></div><div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-4 col-xs-offset-1 text-center fsize-1-5 mtop1-5"><div class="block"><span class="gotham-medium">TO GO TO OUR HARBOLNAS SPECIAL DEAL</span></div></div></div>'});
    
            //$('#countdown-mobile').countdown({until: austDay, format: 'OODHMS', 
            //    layout: '<div id="clock" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 countdown-bg" style="color: #fff;">' + 
            //    '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{dn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">DAY</span></div></div>' +
            //    '<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{hn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">HOUR</span></div></div>' + 
            //    '<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{mn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">MINUTE</span></div></div>' + 
            //    '<div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-sm-1 col-sm-offset-1 col-xs-3 text-center"><div class="block" style="margin-top: 30%"><span class="value gotham-medium fsize-2">{sn}</span></div><div class="block mbottom20"><span class="unit gotham-medium" style="font-size: 0.6em;">SECOND</span></div></div><div class="col-xs-12 countdown-bg text-center" style="padding: 4% 15px 6% 15px;"><div class="block"><span class="gotham-medium" style="color: #fff;">TO GO TO OUR HARBOLNAS SPECIAL DEAL</span></div></div></div>'});
        </script> 
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T35B3Z&gtm_auth=cskdfuOs0xrn87GL3I1MLQ&gtm_preview=env-1&gtm_cookies_win=x"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
		<!-- begin prism-widget --> 
        <script type="text/javascript"> 
			/*
            (function(p,r,i,s,m) {
                var a = + new Date();
                s = r.createElement('script');
                m = r.getElementsByTagName('body')[0].appendChild(s);
                s.src = 'https://prismapp-files.s3.amazonaws.com/widget/prism.js?' + a.toString(); 
                s.async = true;
                s.onload = function() {p.Shamu = new Prism('ebe5f053-ad62-466f-beac-5fb02d4770dd');Shamu.display();}})
            (window, document); 
			*/
			
			if ('serviceWorker' in navigator) {
				console.log("Will the service worker register?");
				navigator.serviceWorker.register('service-worker.js')
				  .then(function(reg){
					console.log("Yes, it did.");
				 }).catch(function(err) {
					console.log("No it didn't. This happened:", err)
				});
			 }
			 
					</script> 
        <!-- end prism-widget -->
		
    </body>
</html>

<?php $this->endPage() ?>
