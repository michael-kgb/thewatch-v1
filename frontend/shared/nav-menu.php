
<div class="nav-menu">

	
	<a href="/" class="nav-menu-item">
		<div class="nav-menu-item-img">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-home.png" alt="icons" />
		</div>
		Beranda
	</a>
	<div id="c-button--push-left" class="nav-menu-item">
		<div class="nav-menu-item-img">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-menu.png" alt="icons" />
		</div>
		Kategori
	</div>
	<div id="c-button--push-right" class="nav-menu-item">
		<div class="nav-menu-item-img">
		<!-- 
			Cart Icon Mobile
		-->
		<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-shop.png" alt="icons" /> -->
		<img src="https://thewatch.imgix.net/icons/independence-day/m/cart-icon-m.png?auto=compress" alt="icons" />
		</div>
		Keranjang
	</div>

	<!-- 
		Account Icon Mobile
	-->
	<?php 
	if(!isset($_SESSION['customerInfo'])){
	?>
	<div onclick="login_signup_menu()" class="nav-menu-item">
		<div class="nav-menu-item-img">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-person.png" alt="icons" />
		<!-- <img src="https://thewatch.imgix.net/icons/independence-day/m/account-icon-m.png?auto=compress" alt="icons" />-->
		</div>
		Akun 
		
	</div>
	<?php
	}else{
	?>
	<!--
		Ini untuk halaman akun yang sesuai UI tapi ui nya kurang oke menurut gua
	
	<div onclick="menu_account()" class="nav-menu-item">
		<div class="nav-menu-item-img">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-person.png" alt="icons" />
		</div>
		Akun 
		
	</div>
	-->
	
	
	<a href="/user/profile" class="nav-menu-item">
		<div class="nav-menu-item-img">
		<!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-person.png" alt="icons" /> -->
		<img src="https://thewatch.imgix.net/icons/independence-day/m/account-icon-m.png?auto=compress" alt="icons" />
		</div>
		Akun 
		
	</a>
	
	<?php
	}
	?>
	<div class="nav-menu-item">
		<div class="nav-menu-item-img">
		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/nav-home/icon-chat.png" alt="icons" />
		</div>
		Chat
	</div>
	
</div>

