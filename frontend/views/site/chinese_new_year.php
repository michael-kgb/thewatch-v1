

			<div class="modal fade" id="fortuneCookie-reminder" style="">
				<div class="modal-dialog" role="document">
					<div class="modal-content fortuneCookie-reminder" style="border-radius: 5px;width: 520px;height:520px;background-size:cover;background-repeat:no-repeat;background-image: url(<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/mobile-background-374x374-2.png);" >
            		
					  <div class="modal-header" style="border-bottom: 0;padding-right: 0;padding-left: 0;">
					    <a class="close-reminder" data-dismiss="modal" style="z-index:1;opacity: 1;position: absolute;right: 4px;top:6px;width: 25px;height: 30px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/button-close.png" style="width: 22px;float:right;"></a>
					    
					  </div>
					  
					  <div class="modal-body" style="border-bottom: 0;text-align: center;">
					  	
					    
					    <div class="col-lg-12" style="position: relative;">
					    	
					    	<div class="col-lg-12 cookie_coin-" style="height:100px;padding-top: 200px;">
					    		<img id="cookie_coin-" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="position: absolute;width:135px;left: 0;right: 0;top: 0;bottom: 0;margin:auto;">
					    	</div>
					    	<div class="col-lg-12 cookie_coin_congrat-" style="font-family: gotham-medium;font-size: 24px;padding-top: 10px;padding-bottom: 10px;color:#d7b950;">
					    		Selamat					    	</div>
					    	<div class="col-lg-12 cookie_coin_description-" style="font-family: gotham-light;font-size: 14px;padding-bottom: 10px;padding-left: 0%;padding-right: 0%;color:#d7b950;">
					    		Anda sekarang bisa menggunakan voucher<br>
								Chinese New Year!
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
			</div>

<div class="modal fade" id="fortuneCookie" style="">
			<div class="modal-dialog" role="document" style="width:780px;">
            	<div class="modal-content fortuneCookie" style="border-radius: 5px;width: 780px;height:551px;background-image: url(<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/desktop-background-2-740x435.png);background-size:cover;" >
            		<div id="modal-cookie" style="display: none;"><?php if(isset($_COOKIE['voucher_name'])){ 
					 		echo $_COOKIE['voucher_name'];
					 	}
					 ?></div>
					  <div class="modal-header" id="header-prev" style="border-bottom: 0;padding-right: 0;padding-left: 0;">
					    <a class="close" data-dismiss="modal" style="z-index:1;opacity: 1;position: absolute;right: 4px;top:6px;width: 25px;height: 30px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/button-close.png" style="width: 22px;float:right;"></a>
					    <div class="gotham-medium chinese-title" style="letter-spacing: 1.1px;font-size: 36px;text-align: center;padding-top: 50px;color:#d7b950;">Happy Chinese New Year</div>
					    <div class="gotham-medium chinese-title-success" style="display:none;letter-spacing: 1.1px;font-size: 36px;text-align: center;padding-top: 30px;color:#d7b950;">Selamat</div>
					  </div>
					  <div class="modal-body" id="body-prev" style="border-bottom: 0;text-align: center;">
					  	
					    
						
						<?php
						if (!isset($_SESSION['customerInfo'])) {
							// if (0) {
						?>	<span id="udahloginbelum" style="display:none;">belum</span>
							<div class="gotham-light chinese-sub-title" style="font-size: 14px;color:#d7b950;bottom:">
								Login atau Sign Up untuk dapatkan <br>
								Voucher Fortune Cookiesmu
							</div>

							<div class="col-lg-12"  style="position: relative;height:260px;bottom:60px;">
								<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="position: absolute;left: 0;right: 0;top: 200px;bottom: 0;margin:auto;"> -->
								<img id="cookie_opening" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/Vouchermu disini.png" style="position: absolute;left: 0;right: 0;top: 110px;bottom: 0;margin:auto;width:70%;">
							</div>

							<div class="col-lg-6 col-xs-6 cookie-lanjut">
					    	
					    		<a class="simpan_voucher to_daftar" style="width: 60%;font-size: 14px;opacity: 1;font-weight: unset;text-shadow: none;font-family: gotham-light;padding: 10px;" href="#">Daftar</a>
					    	</div>
					    	<div class="col-lg-6 col-xs-6 cookie-lanjut">
					    	
								<a class="simpan_voucher to_masuk" style="width: 60%;font-size: 14px;opacity: 1;font-weight: unset;text-shadow: none;font-family: gotham-light;padding: 10px;" href="#">Login</a>
					    	</div>
						<?php
						}else{
						?>
							<span id="udahloginbelum" style="display:none;">udah</span>
							<div class="gotham-light chinese-sub-title" style="font-size: 14px;color:#d7b950;">
								Pilih Fortune Cookies mu <br>
								dan dapatkan <span style="font-family: gotham-medium;color: #d7b950;">potongan harga spesial!</span>
							</div>

							<div id="cookie-1" class="col-lg-6 col-md-6" style="margin-top:100px;">
								<img id="bg_cookie1" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="width: 150px;position: absolute;top: 52px;right: 35px;">
								<img id="cookie1" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/fortune-cookie-rotate-2.png" style="width: 110px;position: absolute;top: 32px;right: 55px;transition: transform .2s;">
							</div>
							<div id="cookie-2" class="col-lg-6 col-md-6" style="margin-top:100px;">
								<img id="bg_cookie2" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="width: 150px;position: absolute;top: 52px;left: 55px;">
								<img id="cookie2" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/fortune-cookie-2.png" style="width: 110px;position: absolute;top: 32px;left: 84px;transition: transform .2s;">
							</div>
						<?php
						}
						?>
							
					    

						

					    <!-- <div class="gotham-light chinese-sub-title-success" style="display:none;font-size: 24px;color:#d7b950;">
					    	Anda Mendapat <span style="color:#d7b950;">Voucher!</span>
					    </div> -->
					    
					    <div class="col-lg-12" id="cookie_prize_1" style="display:none;position: relative;height:260px;right:30px;">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="position: absolute;left: 0;right: 0;top: 200px;bottom: 0;margin:auto;"> -->
					    	<img id="cookie_gif1" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/CNY-GIF_50.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;">
					    </div>
					    <div class="col-lg-12" id="cookie_prize_2" style="display:none;position: relative;height:260px;right:30px;">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/element-background.png" style="position: absolute;left: 0;right: 0;top: 200px;bottom: 0;margin:auto;"> -->
					    	<img id="cookie_gif2" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/CNY-GIF_100.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;">
					    	<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/cny-100k-desktop.gif" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin:auto;"> -->
					    </div>
					    <div class="col-lg-12" id="cookie_description" style="display:none;position: relative;top:20px;">
					    	<!-- <div class="col-lg-12 gotham-light fcolor69 cookie-description" style="font-size: 14px;color: #d7b950;">
					    	
					    		Berlaku untuk pembelanjaan minimum IDR 2 juta di dalam cart untuk produk jam tangan dengan harga normal maupun harga diskon. Voucher ini dapat digunakan sampai dengan 5 Maret 2018.
					    	</div> -->
					    	<!-- <div class="col-lg-12 cookie-description-simpan" style="font-family: gotham-medium;font-size: 14px;padding-top: 15px;padding-bottom: 10px;color: #d7b950;">
					    		Simpan Kode Voucher
					    	</div> -->
					    	<div id="cookie_code" class="col-lg-12 gotham-medium" style="font-style: underline;font-size: 24px;letter-spacing:2px;padding-bottom: 15px;color: #fff;">
					    	27301212
					    	</div>
						
							<div id="cookie_syarat_mobile" class="col-lg-12 gotham-medium" style="display:none;">
					    		<button class="btn btn-link" style="font-style: underline;color: #d7b950;" data-toggle="modal" data-target="#tnc-modal">Syarat dan Ketentuan Berlaku</button>
					    	</div>
					    	<div class="col-lg-12">
					    		<a style="" class="simpan_voucher" id="simpan_voucher_salin" style="width: 17%;" onclick="simpan_voucher('#cookie_code')">Salin</a>
					    	</div>
							<div id="cookie_syarat" class="col-lg-12 gotham-medium" style="margin-top:90px;">
					    		<button class="btn btn-link" href="#" style="font-style: underline;color: #d7b950;" data-toggle="modal" data-target="#tnc-modal">Syarat dan Ketentuan Berlaku</button>
					    	</div>
					    </div>
					  </div>
					  <div class="modal-body" id="body-success" style="display:none;border-bottom: 0;text-align: center;">
				  	
					    
					    <div class="col-lg-12" id="cookie_description" style="position: relative;">
					    	<div class="col-lg-12 hidden-xs" style="padding-top: 45px;"></div>
					    	<div class="col-lg-12 cookie_coin" style="height:100px;padding-top: 200px;bottom:30px;">
					    		<img id="cookie_coin" src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="position: absolute;width:135px;left: 0;right: 0;top: 0;bottom: 0;margin:auto;">
					    	</div>
					    	<div class="col-lg-12 cookie_coin_congrat" style="font-family: gotham-medium;font-size: 24px;padding-top: 10px;padding-bottom: 10px;color:#d7b950;bottom:50px;">
					    		Selamat kode Voucher Chinese New Year<br>
					    		Anda Telah Tersimpan!
					    	</div>
					    	<div class="col-lg-12 cookie_coin_description" style="font-family: gotham-light;font-size: 14px;padding-top: 30px;padding-bottom: 10px;padding-left: 20%;padding-right: 20%;color:#d7b950;bottom:50px;">
					    		Kode Voucher bisa digunakan di halaman check out Anda saat melakukan pembelian produk.<br><br>
								Penggunaan kode voucher bisa digunakan hanya satu kali untuk sekali keranjang belanja. 
					    	</div>
					    	
					    	<div class="col-lg-12 hidden-xs" style="padding-top: 50px;bottom:70px;">
					    	
					    		<a class="close simpan_voucher" id="simpan_voucher_belanja" data-dismiss="modal" style="width: 40%;font-size: 14px;opacity: 1;font-weight: unset;text-shadow: none;font-family: gotham-light;padding: 10px;">Belanja Sekarang</a>
					    	</div>
					    	<div class="col-lg-xs hidden-lg hidden-md hidden-sm" style="padding-top: 30px;">
					    	
					    		<a class="close simpan_voucher" id="simpan_voucher_belanja" data-dismiss="modal" style="width: 60%;font-size: 14px;opacity: 1;font-weight: unset;text-shadow: none;font-family: gotham-light;padding: 10px;">Belanja Sekarang</a>
					    	</div>
					    </div>
					  </div>
					 
					</div>
					</div>
				</div>
					

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cny_footer_red" style="display:none;position: fixed;bottom:0;height:40px;background-color: rgb(144,33,42);z-index: 2;">
	<div class="gotham-light footer-cookie-description hidden-xs hidden-sm" style="position: absolute;left:0;right: 0;bottom: 0;margin: auto;text-align: center;color:#fff;">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-right: 10px;">
		Happy Chinese New Year! Pilih Fortune Cookie Gratismu <a id="footer-cny-" style="font-family: gotham-medium;text-decoration: underline;color:#fff;" onclick="open_cny_footer()">Disini!</a>
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-left: 10px;">
	</div>
	<div class="gotham-light footer-cookie-description hidden-lg hidden-md" style="position: absolute;left:0;right: 0;bottom: 0;margin: auto;text-align: center;color:#fff;">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-right: 10px;">
		Pilih Fortune Cookie Gratismu <a id="footer-cny-" style="font-family: gotham-medium;text-decoration: underline;color:#fff;" onclick="open_cny_footer()">Disini!</a>
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin.png" style="width: 30px;padding-left: 10px;">
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
		Happy Chinese New Year! Gunakan Voucher Chinese New Yearmu <a id="footer-cny" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in" style="font-family: gotham-medium;text-decoration: underline;color:#fff;">Disini!</a>
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin_white.png" style="width: 30px;padding-left: 10px;">
	</div>
	<div class="gotham-light footer-cookie-description hidden-lg hidden-md" style="position: absolute;left:0;right: 0;bottom: 0;margin: auto;text-align: center;color:#fff;">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin_white.png" style="width: 30px;padding-right: 10px;">
		Gunakan Voucher Chinese New Yearmu <a id="footer-cny" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/sign-in" style="font-family: gotham-medium;text-decoration: underline;color:#fff;">Disini!</a>
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/event/fortune/coin_white.png" style="width: 30px;padding-left: 10px;">
	</div>
</div>


<div class="modal fade" id="tnc-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Syarat dan Ketentuan</h5>
      </div>
      <div class="modal-body">
	  	Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<script>
    $('a#footer-cny').css('cursor','pointer');
    $('a#footer-cny-').css('cursor','pointer');
</script>

<style type="text/css">
						#fortuneCookie{
							opacity: 1;
    						filter: alpha(opacity=80);
						}
						#fortuneCookie-reminder{
							opacity: 1;
    						filter: alpha(opacity=80);
						}
						a.simpan_voucher{
							border-radius: 25px;position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;width: 30%;background-color: #d7b950;color:#bd1816;padding: 10px;
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
