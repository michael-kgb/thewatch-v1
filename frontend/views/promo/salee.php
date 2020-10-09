<div class="hidden-lg hidden-xs" style="padding-top:120px;"></div>
<section class="ptop1" style="padding-top:0px;">
    <div class="container">
        <div class="row">
			<style type="text/css">
	
            	.tab-content{
            		padding-top: 20px;
            		height: 100px;
            	}
            	.nav-tabs.mobile-tabs>li>a{
            		
            		padding: 5px;
            	}
            	.nav-tabs.mobile-tabs>li.active>a,.nav-tabs>li.active>a:hover{
	        		border:solid 1px #696969 !important;
	        		color: #696969;
	        		letter-spacing: 0.8px;
	        		padding: 5px;
	        		border-radius: 25px;
	        	}

	        	.nav-tabs.mobile-tabs>li>a:hover{
	        		    background-color: unset;
	        		    border:solid 1px #ddd !important;
	        		    padding: 5px;
	        		    border-radius: 25px;
	    				display: block;
	        	}
            	@media only screen and (min-width : 768px) {
            		.nav-tabs.desktop-tabs>li{
    	        		margin-right:20px;
    	        	}
    	        	.nav-tabs.desktop-tabs>li>a{
    	        		
    	        		padding: 13px 30px;
    	        	}
    	        	.nav-tabs.desktop-tabs>li.active>a,.nav-tabs>li.active>a:hover{
    	        		border:solid 1px #696969 !important;
    	        		color: #696969;
    	        		letter-spacing: 0.8px;
    	        		padding: 13px 30px;
    	        		border-radius: 25px;
    	        	}
    
    	        	.nav-tabs.desktop-tabs>li>a:hover{
    	        		    background-color: unset;
    	        		    border:solid 1px #ddd !important;
    	        		    padding: 13px 30px;
    	        		    border-radius: 25px;
    	    				display: block;
    	        	}
            	}
            </style>
            <?php
			
                $current_date = date('Y-m-d H:i:s');
            ?>
            <div class="col-xs-12 hidden-lg hidden-md hidden-sm clearright clearleft" style="padding-top:20px;">
            </div>
            <div class="col-lg-12 clearright clearleft">
                <ul class="nav nav-tabs desktop-tabs gotham-medium hidden-xs" style="border-bottom: none;">
    				<li class="active">
    					<a href="#all_promo" data-toggle="tab">
    						All Promo </a>
    				</li>
    				<li>
    					<a href="#promo_twc" data-toggle="tab">
    						Promo The Watch Co </a>
    				</li>
    				<li>
    					<a href="#promo_partner" data-toggle="tab">
    						Promo Partner </a>
    				</li>
    			</ul>
    			<ul class="nav nav-tabs mobile-tabs gotham-light hidden-lg hidden-md hidden-sm" style="border-bottom: none;font-size: 12px;">
    				<li class="active">
    					<a href="#all_promo" data-toggle="tab">
    						All Promo </a>
    				</li>
    				<li>
    					<a href="#promo_twc" data-toggle="tab">
    						Promo The Watch Co </a>
    				</li>
    				<li>
    					<a href="#promo_partner" data-toggle="tab">
    						Promo Partner </a>
    				</li>
    			</ul>
			
			    <div class="tab-content">
    				<div class="tab-pane active" id="all_promo">
    				    <?php  if($current_date >= '2018-10-01 00:00:00' && $current_date <= '2018-11-11 23:59:59'){  ?>
						
    				    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs ptop2 clearleft clearright">
            				<a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111" target="_blank">
            					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/Desktop-Main-Banner.png?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">
            				</a>
            			</div>
            			
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 mtop3-mobile">
            				<a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111" target="_blank">
            					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/Mobile-Main-Banner.png?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">
            				</a>
            			</div>
            			
    				   
            			<?php } ?>
    				 <!--   <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs ptop2 clearleft">-->
         <!--   				<a href="<?php echo \yii\helpers\Url::base(); ?>/promo-asian-games-2018" target="_blank">-->
         <!--   					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/tujuhbelas/page-banner-asian.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">-->
         <!--   				</a>-->
         <!--   			</div>-->
            			
    					<!--<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs ptop2 clearright">-->
         <!--   				<a href="<?php echo \yii\helpers\Url::base(); ?>/promo-mandiri" target="_blank">-->
         <!--   					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/mandiri/banner-sale-070818.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">-->
         <!--   				</a>-->
         <!--   			</div>-->
            			<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>-->
            			
            			
            			<!--<div class="hidden-lg hidden-md hidden-sm col-xs-12 mtop3-mobile">-->
            			<!--	<a href="<?php echo \yii\helpers\Url::base(); ?>/promo-mandiri" target="_blank">-->
            			<!--		<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/mandiri/banner-sale-070818.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">-->
            			<!--	</a>-->
            			<!--</div>-->
            			
            			<!--<div class="hidden-lg hidden-md hidden-sm col-xs-12 mtop3-mobile">-->
            			<!--	<a href="<?php echo \yii\helpers\Url::base(); ?>/timex-sale" target="_blank">-->
            			<!--		<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/taketimetimex/page-banner-080818.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">-->
            			<!--	</a>-->
            			<!--</div>-->
    				</div>
    				
    				<div class="tab-pane" id="promo_twc">
					
					   <?php  if($current_date >= '2018-10-01 00:00:00' && $current_date <= '2018-11-11 23:59:59'){  ?>
						
    				    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs ptop2 clearleft clearright">
            				<a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111" target="_blank">
            					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/Desktop-Main-Banner.png?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">
            				</a>
            			</div>
            			
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 mtop3-mobile">
            				<a href="<?php echo \yii\helpers\Url::base(); ?>/pesta-belanja-1111" target="_blank">
            					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/harbolnas/1111/Mobile-Main-Banner.png?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">
            				</a>
            			</div>
            			
    				   
            			<?php } ?>
            			
    				</div>
    				
    				<div class="tab-pane" id="promo_partner">
    				    <?php  if($current_date >= '2018-10-01 00:00:00' && $current_date <= '2018-10-31 23:59:59'){  ?>
    				    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs ptop2 clearleft">
            				<a href="<?php echo \yii\helpers\Url::base(); ?>/promo-vospay" target="_blank">
            					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/vospay/Sale-Banner-Page-10.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">
            				</a>
            			</div>
            			
            			<div class="hidden-lg hidden-md hidden-sm col-xs-12 mtop3-mobile">
            				<a href="<?php echo \yii\helpers\Url::base(); ?>/promo-vospay" target="_blank">
            					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/vospay/Sale-Banner-Page-10.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">
            				</a>
            			</div>
            			<?php } ?>
    					<!--<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft">-->
         <!--   				<a href="<?php echo \yii\helpers\Url::base(); ?>/promo-mandiri" target="_blank">-->
         <!--   					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/mandiri/banner-sale-070818.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">-->
         <!--   				</a>-->
         <!--   			</div>-->
            			
            		    
         <!--   			<div class="hidden-lg hidden-md hidden-sm col-xs-12 mtop3-mobile">-->
         <!--   				<a href="<?php echo \yii\helpers\Url::base(); ?>/promo-mandiri" target="_blank">-->
         <!--   					<img src="<?php echo Yii::$app->params['imgixUrl'] ?>promo/mandiri/banner-sale-070818.jpg?auto=compress&fm=pjpg" class="img-responsive" style="width:100%;">-->
         <!--   				</a>-->
         <!--   			</div>-->
    				</div>
  			
                </div>
            </div>
    </div>
</section>
<!--SEO Pages-->
<section style=" padding: 0px 0;z-index;1;padding-top:90px;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index: 1;
    margin-top: -70px;">    
        <div class="container clearleft">
                                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                        
                            <p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>

<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded. Diskon jam tangan branded akan selalu kami berikan di setiap bulannya sehingga kamu akan bangga menggunakan jam tangan original favoritmu tanpa takut menguras dompet. Jual jam tangan original online, mulai dari jam tangan original Daniel Wellington, Olivia Burton, Timex, Tsovet, Hypergrand, dan Aark Collective akan tersedia dengan harga murah di The Watch Co.&nbsp;</p>

<p class="seodesc"><strong>Promo Jam Tangan Wanita Murah</strong></p>

<p class="seodesc">Jam tangan branded merupakan salah satu aksesoris fashion yang penting bagi wanita. Bagi para wanita yang mau membeli jam tangan branded murah, tersedia program promo untuk jam tangan wanita branded seperti Daniel Wellington, Olivia Burton, Aark Collective, Timex, dan lain-lain. Diskon bagi jam tangan branded tersebut akan selalu tersedia sepanjang tahun di The Watch Co. Jadi bagi para wanita yang ingin menggunakan jam tangan original dengan harga murah, bisa mengunjunggi store The Watch Co. atau website www.thewatch.co untuk beli jam tangan online.</p>
                       
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                            
                                <p class="seodesc"><strong>Promo Jam Tangan Pria Murah</strong></p>

<p class="seodesc">Jam tangan original merupakan satu-satunya perhiasan yang dikenakan oleh pria. Maka dari itu, akan semankin bangga jika menggunakan jam tangan original. Tapi, kamu jangan khawatir dengan harga yang mahal, karena The Watch Co. mempunyai program promo sehingga kamu bisa memiliki jam tangan branded seperti Timex, Daniel Wellington, Hypergrand, Aark Collective, William L, dan lain-lain dengan harga murah. Jadi tunggu apa lagi, segera beli jam tangan original murah di store The Watch Co. dan juga website www.thewatch.co untuk beli jam tangan secara online.</p>

<p class="seodesc"><strong>Penawaran Promo Aksesoris Murah&nbsp;</strong></p>

<p class="seodesc">Selain jam tangan original, The Watch Co juga menjual beberapa aksesoris branded original seperti Eastpak, Rains Journal, Y Studio, Cereal Magz, Hypebeast, Kinfolk, Orbit Key, dan lain-lain. Berbagai macam aksesoris branded origianal tersebut tersedia dengan harga murah karena kami mempunyai program diskon bagi aksesoris branded tersebut. Jadi, kamu bisa bergaya dengan aksesoris original branded tersebut tanpa harus menguras dompet. Ayo beli aksesoris branded origianl dengan harga murah di store The Watch Co. atau di website www.thewatch.co untuk beli jam tangan secara online.</p>
                            
                    </div>
                    <!--mobile version-->
                    <div class="hidden-lg hidden-md hidden-sm" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>

<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded...<br><br><a>(Baca Selengkapnya)</a>                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Diskon Jam Tangan Original&nbsp;</strong></p>

<p class="seodesc">Untuk menggunakan jam tangan original kini tidak lagi harus mahal, karena kami menawarkan banyak sekali program promo dan juga program cicilan untuk jam tangan branded. Diskon jam tangan branded akan selalu kami berikan di setiap bulannya sehingga kamu akan bangga menggunakan jam tangan original favoritmu tanpa takut menguras dompet. Jual jam tangan original online, mulai dari jam tangan original Daniel Wellington, Olivia Burton, Timex, Tsovet, Hypergrand, dan Aark Collective akan tersedia dengan harga murah di The Watch Co. &nbsp;</p>

<p class="seodesc"><strong>Promo Jam Tangan Wanita Murah</strong></p>

<p class="seodesc">Jam tangan branded merupakan salah satu aksesoris fashion yang penting bagi wanita. Bagi para wanita yang mau membeli jam tangan branded murah, tersedia program promo untuk jam tangan wanita branded seperti Daniel Wellington, Olivia Burton, Aark Collective, Timex, dan lain-lain. Diskon bagi jam tangan branded tersebut akan selalu tersedia sepanjang tahun di The Watch Co. Jadi bagi para wanita yang ingin menggunakan jam tangan original dengan harga murah, bisa mengunjunggi store The Watch Co. atau website www.thewatch.co untuk beli jam tangan online.</p>
                        <p></p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="right" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            </p><p class="seodesc"><strong>Promo Jam Tangan Pria Murah</strong></p>

<p class="seodesc">Jam tangan original merupakan satu-satunya perhiasan yang dikenakan oleh pria. Maka dari itu, akan semankin bangga jika menggunakan jam tangan original. Tapi, kamu jangan khawatir dengan harga yang mahal, karena The Watch Co. mempunyai program promo sehingga kamu bisa memiliki jam tangan branded seperti Timex, Daniel Wellington, Hypergrand, Aark Collective, William L, dan lain-lain dengan harga murah. Jadi tunggu apa lagi, segera beli jam tangan original murah di store The Watch Co. dan juga website www.thewatch.co untuk beli jam tangan secara online.</p>

<p class="seodesc"><strong>Penawaran Promo Aksesoris Murah&nbsp;</strong></p>

<p class="seodesc">Selain jam tangan original, The Watch Co juga menjual beberapa aksesoris branded original seperti Eastpak, Rains Journal, Y Studio, Cereal Magz, Hypebeast, Kinfolk, Orbit Key, dan lain-lain. Berbagai macam aksesoris branded origianal tersebut tersedia dengan harga murah karena kami mempunyai program diskon bagi aksesoris branded tersebut. Jadi, kamu bisa bergaya dengan aksesoris original branded tersebut tanpa harus menguras dompet. Ayo beli aksesoris branded origianl dengan harga murah di store The Watch Co. atau di website www.thewatch.co untuk beli jam tangan secara online.</p>

                    </div>
                    </div>
    </div>
</section>

<style>
@media only screen and (max-width : 767px) {
	.mtop3-mobile { margin-top: 3%; }
	.mtop8-em-mobile { margin-top: 8em; }
}
p.seodesc{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    .show-read-more .more-text{
        display: none;
    }
</style>