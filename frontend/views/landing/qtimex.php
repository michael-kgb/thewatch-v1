<style>
	.zoomContainer {
		z-index: 9999 !important;
	}

	.prism-widget {
		display: none;
	}

	.zoomWindowContainer>div {
		height: 400px !important;
	}

	#popup-product-wrap,
	#popup-regraffle-wrap,
	.zoomContainer {
		list-style-type: none;
		opacity: 0;
		visibility: hidden;
	}

	@media screen and (max-width: 768px) {
		.zoomWindowContainer>div {
			height: 338px !important;
		}
	}
</style>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#product-thumb").css('display', 'none');

		var url = new URL(window.location);
		var p = url.searchParams.get("p");

		if (p == 'open') {
			document.getElementById("shopNow").click();

			$(".zoomContainer").css('visibility', 'visible');
			$(".zoomContainer").css('opacity', 1);
		}
	});

	var url = new URL(window.location);
	var p = url.searchParams.get("p");

	if (p == 'timex') {

		$("#navbar-mobile").css('display', 'none');
		$("#foot-er").css('display', 'none');
		$(".scrolls").css('display', 'none');
		$('.ptop120').css('padding-top', 0);
		$('.clear').css('height', 0);
		$('#sfe-widget-closed-wrapper').css('height', 0);
		$('.bulkhead-height').css('display', 'none');
		$(".sfe-widget__minimized").css('display', 'none');

	}

	function openPopup() {
		$("#popup-product-wrap").css('visibility', 'visible');
		$("#product-thumb").css('display', 'block');
		$("#popup-product-wrap").css('opacity', 1);
		$(".zoomContainer").css('visibility', 'visible');
		$(".zoomContainer").css('opacity', 1);

		if (p == 'open') {

			setTimeout(() => {
				$(".zoomContainer").css('visibility', 'visible');
				$(".zoomContainer").css('opacity', 1);

			}, 1000);
		}
	}

	function openPopupRegistrasi() {
		$("#popup-regraffle-wrap").css('visibility', 'visible');
		$("#popup-regraffle-wrap").css('opacity', 1);

		if (p == 'open') {

			setTimeout(() => {
				$(".zoomContainer").css('visibility', 'visible');
				$(".zoomContainer").css('opacity', 1);

			}, 1000);
		}
	}

	function shopNow() {

		let URL = '<?php echo Yii::$app->request->baseUrl; ?>';

		if (p == 'timex') {
			window.location = URL + '/qtimex?p=open';

		} else {
			openPopup();
		}
	}

	function registerNow() {

		let URL = '<?php echo Yii::$app->request->baseUrl; ?>';

		if (p == 'timex') {
			window.location = URL + '/qtimex?p=open';

		} else {
			closeShop();
			openPopupRegistrasi();
		}
	}

	function closeRegister() {
		$("#popup-regraffle-wrap").css('visibility', 'hidden');
		$("#popup-regraffle-wrap").css('opacity', 0);
	}

	function closeShop() {

		$("#popup-product-wrap").css('visibility', 'hidden');
		$("#product-thumb").css('display', 'none');
		$("#popup-product-wrap").css('opacity', 0);
		$(".zoomContainer").css('visibility', 'hidden');
		$(".zoomContainer").css('opacity', 0);
	}
</script>

<?php
include "../shared/modal-product-detail-qtimex.php";
$img_src = "";
?>

<section class="nopadding" style="padding-bottom:2px;" id="sectionTimexBeam">
	<video id="my-video" class="video-home" muted loop autoplay loop controls playsinline>
		<!-- <video id="" class="jumbotron" muted loop autoplay loop controls playsinline> -->

		<source src="<?php echo Yii::$app->request->baseUrl; ?>/img/landing/timexraffle/mobile/vidtimexraffle.mp4" type="video/mp4" />

	</video>

</section>

<section class="nopadding" id="sectionTimexBeam2">
	<div class="container" id="containerTimexBeam2">
		<!--<div class="pull-right" id="descTimexBeam2">-->
		<div id="descTimexBeam2">
			<h1 style="font-size:80;">Q TIMEX</h1>
			<h2>1979 REISSUE</h2>
			<p>
				First released in 1979, the original diver-inspired Q Timex gave a new generation a modern Timex with quartz technology.
				A true reissue, Timex recreated every detail — including the true-to-the-era woven stainless-steel bracelet,
				functional battery hatch, rotating top ring, aged luminescent paint and ticking inside is a modern quartz movement.
			</p>
		</div>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam3">
	<img src="https://thewatch.imgix.net/landing/timexraffle/raffle3.jpg?auto=compress" class="img-responsive" width="100%">
</section>

<section class="nopadding" id="sectionTimexBeam4">
	<div class="container" id="containerTimexBeam4">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="https://thewatch.imgix.net/landing/timexraffle/raffle4a.jpg?auto=compress" class="img-responsive">
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="descTimexBeam4">
				<img src="https://thewatch.imgix.net/landing/timexraffle/raffle4b.jpg?auto=compress" class="img-responsive">
				<div id="checkoutTimexBeam" class="center-block" style="text-align:center;">
					<h5 style="margin-top:50px;">Q TIMEX 1979 REISSUE</h5>
					<p style="margin-bottom:30px;">
						First released in the late 1970s, A true reissue, we recreated every detail—including the true-to-the-era woven stainless steel bracelet, functional battery hatch, rotating top ring, luminescent paint and ticking inside is a modern quartz movement.
					</p>

					<div class="product-detail product-price" style="text-align:center;">
						IDR 3.500.000
					</div>
					<div class="product-detail product-discount-price" style="color:#AB8461;">
						IDR 291.667 / bulan
					</div>

					<a href="#" class="blue-round center-block" id="addtocart" style="float:none;width:200px;margin-top:60px;" onclick="shopNow()">Buy Now</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!--
<section class="nopadding" id="sectionTimexBeam5">
	<img src="https://thewatch.imgix.net/landing/timexraffle/raffle5.jpg?auto=compress" class="img-responsive" width="100%"> 
</section>

<section id="sectionTimexBeam6">
	<div class="container" id="containerTimexBeam6">
		<a class="blue-round center-block text-center " style="float:none;width:200px;margin:5% auto;" onclick="shopNow()">Buy Now</a>
	</div>
</section>
-->

<script type="text/javascript">
	(function() {

		/**

		 * Video element

		 * @type {HTMLElement}

		 */

		var video = document.getElementById("my-video");

		var videom = document.getElementById("my-video-m");

		/**

		 * Check if video can play, and play it

		 */

		video.addEventListener("canplay", function() {

			video.play();

		});

		videom.addEventListener("canplay", function() {

			videom.play();

		});

	})();
</script>



<style type="text/css">
	#my-video {
		width: 100%;
		margin-bottom: -8px !important;
	}

	.nopadding {

		padding: 0 !important;

	}


	@media only screen and (min-width: 1340px) {

		#sectionTimexBeam2 {
			background-image: url('https://thewatch.imgix.net/landing/timexraffle/raffle2.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#containerTimexBeam2 {
			/* min-height:70vw; */
			min-height: 62vw;

			position: relative;
		}

		#sectionTimexBeam3 {
			margin-top: 0px;
		}

		#descTimexBeam2 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam2 p {
			font-size: 12pt;
		}

		#descTimexBeam2 h3 {
			font-size: 14pt;
		}

		#descTimexBeam2 {
			margin-top: -100px;
		}

		#sectionTimexBeam4 {
			padding-top: 30px !important;
			padding-bottom: 90px !important;
			/* hide button Buy Now on the bottom of landing page */
		}

		#descTimexBeam6 {
			width: 52%;
			margin: 0 25% 0 25%;
		}
	}

	/*DESKTOP*/
	@media only screen and (min-width: 1024px) and (max-width:1340px) {
		#sectionTimexBeam2 {
			background-image: url('https://thewatch.imgix.net/landing/timexraffle/raffle2.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;

		}

		#containerTimexBeam2 {
			/* min-height:70vw; */
			min-height: 62vw;

			position: relative;
		}

		#sectionTimexBeam3 {
			margin-top: 0px;
		}

		#descTimexBeam2 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam2 p {
			font-size: 12pt;
		}

		#descTimexBeam2 h3 {
			font-size: 14pt;
		}

		#descTimexBeam2 {
			margin-top: -100px;
		}

		#sectionTimexBeam4 {
			padding-top: 30px !important;
			padding-bottom: 30px !important;
			padding-bottom: 90px !important;
			/* hide button Buy Now on the bottom of landing page */
		}


		#descTimexBeam6 {
			width: 52%;
			margin: 0 25% 0 25%;
		}


	}

	/*MOBILE*/

	@media (max-width:1024px) {
		#sectionTimexBeam2 {

			background-image: url('https://thewatch.imgix.net/landing/timexraffle/mobile/raffle2.jpg?auto=compress') !important;

			background-size: 100% auto;

			background-position: 0 3;

			background-repeat: no-repeat !important;

		}

		#containerTimexBeam2 {

			/* height:215vw; */
			height: 208vw;

			padding-left: 45px;

			padding-right: 45px;
		}

		#descTimexBeam2 {
			color: #fff;
		}

		#containerTimexBeam4 {

			padding-top: 45px;

			padding-bottom: 45px;

		}

		#descTimexBeam2 p {

			font-size: 20pt;

		}

		#descTimexBeam2 h3 {

			font-size: 30pt;

		}

		#descTimexBeam2 {

			margin-top: 20vw;

		}

		#descTimexBeam4 {

			margin-top: 30px;

		}

		#descTimexBeam6 {

			margin-bottom: 75px;

		}

		#sectionTimexBeam3 {
			display: none;
		}

	}

	@media (max-width:700px) {

		#sectionTimexBeam3 {
			display: none;
		}

		#descTimexBeam2 {
			color: #fff;
		}

		#descTimexBeam2 p {

			font-size: 9pt;

		}

		#descTimexBeam2 h3 {

			font-size: 14pt;

		}

		#descTimexBeam6 {

			margin-top: 5px;

		}
	}

	.o-content {
		background-image: none !important;
	}

	#sectionTimexBeam6,
	#sectionTimexBeam4 {
		background-image: none;
	}
</style>