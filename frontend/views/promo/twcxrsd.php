<?php

use app\assets\ProductDetailAsset;

ProductDetailAsset::register($this);

?>

<div class="container">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mtop5 mbottom5 margin-top-15-ipad">
		<span class="fsize-2 lspace1">SUBSCRIBE NEWSLETTER</span>
	</div>
	<form method="POST" action="https://thewatch.co/twcxrsd">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom5">
			<div class="col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 col-xs-2 col-xs-offset-2" style="margin-top: 1%;">
				<span class="gotham-medium">Fullname</span>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mbottom3">
				<input type="text" name="fullname" class="col-lg-8 col-md-8 col-sm-8 col-xs-8" placeholder="Fullname..." style="padding-left: 5px; height: 45px;">
			</div>
			<div class="col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 col-xs-2 col-xs-offset-2" style="margin-top: 1%;">
				<span class="gotham-medium">Email</span>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mbottom3">
				<input type="text" name="email" class="col-lg-8 col-md-8 col-sm-8 col-xs-8" placeholder="Email..." style="padding-left: 5px; height: 45px;">
			</div>
			<div class="col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 col-xs-2 col-xs-offset-2" style="margin-top: 1%;">
				<span class="gotham-medium">Phone Number</span>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mbottom3">
				<input type="text" name="phone_number" class="col-lg-8 col-md-8 col-sm-8 col-xs-8" placeholder="Phone Number..." style="padding-left: 5px; height: 45px;">
			</div>
			<div class="col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-2 col-sm-offset-2 col-xs-2 col-xs-offset-2" style="margin-top: 1%;">
				<span class="gotham-medium">Gender</span>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="margin-top: 1%;">
				<input type="radio" name="gender" value="men" checked>
				<label>MEN</label>
				<input type="radio" name="gender" value="women" style="margin-left: 4%;">
				<label>WOMEN</label>
			</div>
			<div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-4 col-xs-8 col-xs-offset-4 mtop3">
				<input type="submit" class="subscribe-btn-ipad lspace1" value="SUBSCRIBE">
			</div>
		</div>
	</form>
</div>