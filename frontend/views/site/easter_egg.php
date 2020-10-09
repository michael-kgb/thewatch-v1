<div class="modal fade" id="fortuneCookie-reminder" style="padding-left: 25%;">
            	<div class="modal-content fortuneCookie-reminder" style="border-radius: 5px;width: 520px;height:520px;background-size:cover;background-repeat:no-repeat;background-image: url("https://thewatch.imgix.net/event/easter/Easter Banner_Background_Mobile.jpg?auto=compress");" >
            		
					  <div class="modal-header" style="border-bottom: 0;padding-right: 0;padding-left: 0;">
					    <a class="close-reminder" data-dismiss="modal" style="z-index:1;opacity: 1;position: absolute;right: 4px;top:6px;width: 25px;height: 30px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/button-close.png" style="width: 22px;float:right;"></a>
					    
					  </div>
					  
					  <div class="modal-body" style="border-bottom: 0;text-align: center;">
					  	
					    
					    <div class="col-lg-12" style="position: relative;">
					    	
					    	 <!-- <div class="col-lg-12 cookie_coin-" style="height:100px;padding-top: 200px;">
					    		<img id="cookie_coin-" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="position: absolute;width:135px;left: 0;right: 0;top: 0;bottom: 0;margin:auto;">
					    	</div> -->
					    	<div class="col-lg-12 cookie_coin_congrat-" style="font-family: gotham-medium;font-size: 24px;padding-top: 10px;padding-bottom: 10px;color:rgb(186,32,42);">
					    		Selamat					    	</div>
					    	<div class="col-lg-12 cookie_coin_description-" style="font-family: gotham-light;font-size: 14px;padding-bottom: 10px;padding-left: 0%;padding-right: 0%;">
					    		Anda sekarang bisa menggunakan voucher<br>
								Easter Hunt!
					    	</div>
					    	
					    	<div class="col-lg-6 col-xs-6 cookie-lanjut" style="padding-top: 50px;">
					    	
					    		<a class="close simpan_voucher" data-dismiss="modal" style="width: 60%;font-size: 14px;opacity: 1;font-weight: unset;text-shadow: none;font-family: gotham-light;padding: 10px;">Lanjut Belanja</a>
					    	</div>
					    	<div class="col-lg-6 col-xs-6 cookie-lanjut" style="padding-top: 50px;">
					    	
					    		<a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in" style="width: 60%;padding: 7.5px;" class="simpan_voucher">Gunakan</a>
					    	</div>
					    </div>
					  </div>
					 
					</div>
				</div>

<div class="modal fade" id="fortuneCookie">
            	<div class="modal-content fortuneCookie" style="border-radius: 5px;width: 780px;height:600px;background-image: url('https://www.thewatch.co/img/event/easter/Easter%20Banner_Background_Desktop.jpg');" >
            		<div id="modal-cookie" style="display: none;"><?php if(isset($_COOKIE['voucher_name'])){ 
					 		echo $_COOKIE['voucher_name'];
					 	}
					 ?></div>
					  <div class="modal-header" id="header-prev" style="border-bottom: 0;padding-right: 0;padding-left: 0;">
					    <a class="close" data-dismiss="modal" style="z-index:1;opacity: 1;position: absolute;right: 4px;top:6px;width: 25px;height: 30px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/button-close.png" style="width: 22px;float:right;"></a>
					    <div class="gotham-medium chinese-title" style="letter-spacing: 1.1px;font-size: 36px;text-align: center;padding-top: 50px;color:rgb(186,32,42);">Happy Easter</div>
					    <div class="gotham-medium chinese-title-success" style="display:none;letter-spacing: 1.1px;font-size: 36px;text-align: center;padding-top: 30px;color:rgb(186,32,42);">Selamat</div>
					  </div>
					  <div class="modal-body" id="body-prev" style="border-bottom: 0;text-align: center;">
					  	
					    <div class="gotham-light fcolor69 chinese-sub-title" style="font-size: 14px;">
					    	
					    	Pilih Easter Egg mu <br>
					    	dan dapatkan <span style="font-family: gotham-medium;color: rgb(186, 32, 42);">potongan harga spesial!</span>
					    </div>
					    <div class="gotham-light chinese-sub-title-success" style="display:none;font-size: 24px;color:rgb(69,69,69);">
					    	Anda Mendapat <span style="color:rgb(186,32,42);">Voucher!</span>
					    </div>
					    <div class="col-lg-4 col-sm-4 col-xs-4">
					    	<img id="cookie1" src="https://thewatch.imgix.net/event/easter/Telur_5%.png?auto=compress" style="width: 110px;position: absolute;top: 32px;right: 55px;transition: transform .2s;">

					    </div>
					    <div class="col-lg-4 col-sm-4 col-xs-4">
					    	<img id="cookie2" src="https://thewatch.imgix.net/event/easter/Telur_10%.png?auto=compress" style="width: 110px;position: absolute;top: 32px;left: 84px;transition: transform .2s;">
						    
					    </div>
					    <div class="col-lg-4 col-sm-4 col-xs-4">
					    	<img id="cookie3" src="https://thewatch.imgix.net/event/easter/Telur_15%.png?auto=compress" style="width: 110px;position: absolute;top: 32px;left: 84px;transition: transform .2s;">
						    
					    </div>
					    <div class="col-lg-12" id="cookie_prize_1" style="display:none;position: relative;height:260px;">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="position: absolute;left: 0;right: 0;top: 200px;bottom: 0;margin:auto;"> -->
					    	<img id="cookie_gif1" src="https://thewatch.imgix.net/event/easter/Easter%20Egg_5%.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;;width:40%">
					    </div>
					    <div class="col-lg-12" id="cookie_prize_2" style="display:none;position: relative;height:260px;">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="position: absolute;left: 0;right: 0;top: 200px;bottom: 0;margin:auto;"> -->
					    	<img id="cookie_gif2" src="https://thewatch.imgix.net/event/easter/Easter%20Egg_10%.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;;width:40%">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/cny-100k-desktop.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;"> -->
					    </div>
                        <div class="col-lg-12" id="cookie_prize_3" style="display:none;position: relative;height:260px;">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="position: absolute;left: 0;right: 0;top: 200px;bottom: 0;margin:auto;"> -->
					    	<img id="cookie_gif3" src="https://thewatch.imgix.net/event/easter/Easter%20Egg_15%.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;width:40%">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/cny-100k-desktop.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;"> -->
					    </div>
					    <div class="col-lg-12" id="cookie_result" style="display:none;position: relative;">
					    	<!-- <div class="col-lg-12 gotham-light fcolor69 cookie-description" style="font-size: 14px;color: rgb(69, 69, 69);">
					    	
					    		Berlaku untuk pembelanjaan minimum IDR 2 juta di dalam cart untuk produk jam tangan dengan harga normal maupun harga diskon. Voucher ini dapat digunakan sampai dengan 5 Maret 2018.
					    	</div>
					    	<div class="col-lg-12 cookie-description-simpan" style="font-family: gotham-medium;font-size: 14px;padding-top: 15px;padding-bottom: 10px;color: rgb(69, 69, 69);">
					    		Simpan Kode Voucher
					    	</div> -->
					    	<div id="cookie_code" class="col-lg-12 gotham-medium" style="font-style: underline;font-size: 24px;letter-spacing:2px;padding-bottom: 15px;color: rgb(69, 69, 69);">
					    	27301212
					    	</div>
					    	<div class="col-lg-12">
					    	
					    		<a style="" class="simpan_voucher" style="width: 17%;" onclick="simpan_voucher('#cookie_code')">Salin</a>
					    	</div>
					    </div>
					  </div>
					  <div class="modal-body" id="body-success" style="display:none;border-bottom: 0;text-align: center;">
					  	
					    
					    <div class="col-lg-12" id="cookie_description" style="position: relative;">
					    	<div class="col-lg-12 hidden-xs" style="padding-top: 45px;"></div>
					    	<!--<div class="col-lg-12 cookie_coin" style="height:100px;padding-top: 200px;">-->
					    	<!--	<img id="cookie_coin" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="position: absolute;width:135px;left: 0;right: 0;top: 0;bottom: 0;margin:auto;">-->
					    	<!--</div>-->
					    	<div class="col-lg-12 cookie_coin_congrat" style="font-family: gotham-medium;font-size: 24px;padding-top: 10px;padding-bottom: 10px;color:rgb(186,32,42);">
					    		Selamat kode Voucher Easter Egg Hunt<br>
					    		Anda Telah Tersimpan!
					    	</div>
					    	<div class="col-lg-12 cookie_coin_description" style="font-family: gotham-light;font-size: 14px;padding-top: 30px;padding-bottom: 10px;padding-left: 20%;padding-right: 20%;">
					    		Kode Voucher bisa digunakan di halaman check out Anda saat melakukan pembelian produk.<br><br>
								Penggunaan kode voucher bisa digunakan hanya satu kali untuk sekali keranjang belanja. 
					    	</div>
					    	
					    	<div class="col-lg-12 hidden-xs" style="padding-top: 50px;">
					    	
					    		<a class="close simpan_voucher" data-dismiss="modal" style="width: 40%;font-size: 14px;opacity: 1;font-weight: unset;text-shadow: none;font-family: gotham-light;padding: 10px;">Belanja Sekarang</a>
					    	</div>
					    	<div class="col-lg-xs hidden-lg hidden-md hidden-sm" style="padding-top: 30px;">
					    	
					    		<a class="close simpan_voucher" data-dismiss="modal" style="width: 60%;font-size: 14px;opacity: 1;font-weight: unset;text-shadow: none;font-family: gotham-light;padding: 10px;">Belanja Sekarang</a>
					    	</div>
					    </div>
					  </div>
					 
					</div>
				</div>
					

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cny_footer_red" style="display:none;position: fixed;bottom:0;height:40px;background-color: #055eab;z-index: 2;">
	<div class="gotham-light footer-cookie-description hidden-xs hidden-sm" style="position: absolute;left:0;right: 0;bottom: 0;margin: auto;text-align: center;color:#fff;">
		<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-right: 10px;">-->
		Happy Easter! Pilih Easter Egg Gratismu <a id="footer-cny-" style="font-family: gotham-medium;text-decoration: underline;color:#fff;" onclick="open_cny_footer()">Disini!</a>
		<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-left: 10px;">-->
	</div>
	<div class="gotham-light footer-cookie-description hidden-lg hidden-md" style="position: absolute;left:0;right: 0;bottom: 0;margin: auto;text-align: center;color:#fff;">
		<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-right: 10px;">-->
		Pilih Easter Egg Gratismu <a id="footer-cny-" style="font-family: gotham-medium;text-decoration: underline;color:#fff;" onclick="open_cny_footer()">Disini!</a>
		<!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-left: 10px;">-->
	</div>
</div>
<?php 
	$grandTotal = 0;
	if(isset($_SESSION['cart']['items'])){
		foreach($_SESSION['cart']['items'] as $cart_item){
			$grandTotal += $cart_item['total_price'];
		}
	}
?>
<div id="grandtotal_item" style="display: none;"><?php echo $grandTotal; ?></div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cny_footer_gold" style="display:none;position: fixed;bottom:0;height:40px;background-color: rgb(195,156,103);z-index: 2;">
	<div class="gotham-light footer-cookie-description hidden-xs hidden-sm" style="position: absolute;left:0;right: 0;bottom: 0;margin: auto;text-align: center;color:#fff;">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin_white.png" style="width: 30px;padding-right: 10px;">
		Happy Easter! Gunakan Voucher Eastermu <a id="footer-cny" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in" style="font-family: gotham-medium;text-decoration: underline;color:#fff;">Disini!</a>
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin_white.png" style="width: 30px;padding-left: 10px;">
	</div>
	<div class="gotham-light footer-cookie-description hidden-lg hidden-md" style="position: absolute;left:0;right: 0;bottom: 0;margin: auto;text-align: center;color:#fff;">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin_white.png" style="width: 30px;padding-right: 10px;">
		Gunakan Voucher Eastermu <a id="footer-cny" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in" style="font-family: gotham-medium;text-decoration: underline;color:#fff;">Disini!</a>
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin_white.png" style="width: 30px;padding-left: 10px;">
	</div>
</div>
<script>
    $('a#footer-cny').css('cursor','pointer');
    $('a#footer-cny-').css('cursor','pointer');
</script>

<style type="text/css">
						#fortuneCookie{
							margin-left: 25%;
							/*margin-top: 5%;*/
							opacity: 1;
    						filter: alpha(opacity=80);
						}
						#fortuneCookie-reminder{
							margin-left: 30%;
							margin-top: 5%;
							opacity: 1;
    						filter: alpha(opacity=80);
						}
						a.simpan_voucher{
							border-radius: 25px;position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;width: 30%;background-color: rgb(145,31,31);color:#fff;padding: 10px;
						}
						a.simpan_voucher:hover{
							border-radius: 25px;position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;width: 30%;background-color: transparent;color:rgb(145,31,31);border: 1px solid rgb(145,31,31);padding: 10px;
						}
						.footer-cookie-description{
							font-size: 14px;
							top:10px;
						}	
						@media only screen and (max-width : 414px){
							.footer-cookie-description{
								font-size: 12px;
							}
						}
						@media only screen and (max-width : 320px){
							.footer-cookie-description{
								font-size: 11px;
							}
						}
					</style>
