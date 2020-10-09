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

<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css/timexfooturama.css"/>
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
include "../shared/modal-product-detail-footurama.php";
$img_src = "";
?>

<section class="nopadding" id="sectionTimexBeam1">
	<div class="container" id="containerTimexBeam1">
		<!--<div class="pull-right" id="descTimexBeam2">-->
		<div id="descTimexBeam1">
			<img src="https://thewatch.imgix.net/landing/timex_footurama/footuramaxtimex.png?auto=compress" style="width: 90%; margin-bottom: 30px" alt="">
			<p>Footurama and Timex has</p>
			<p>teamed up to create a new</p>
			<p>rendition to the classic MK-1 40</p>
			<a href="#" class="white-round" id="addtocart" style="float:none;width:200px;margin-top:60px;display: block; text-align:center" onclick="shopNow()">Shop Now</a>
		</div>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam2Mobile">
	<img src="https://thewatch.imgix.net/landing/timex_footurama/1.jpg?auto=compress" class="img-responsive" width="100%">
	<div id="descTimexBeam2Mobile">
		<p>Footurama and Timex has</p>
		<p>teamed up to create a new</p>
		<p>rendition to the classic MK-1 40</p>
		<a href="#" class="white-round" id="addtocart" style="float:none;width:200px;margin-top:60px; display: block; text-align:center" onclick="shopNow()">Shop Now</a>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam2">
	<div class="container" id="containerTimexBeam2">
		<!--<div class="pull-right" id="descTimexBeam2">-->
		<div id="descTimexBeam2">
			<p>An exploration of the</p>
			<p>iconic military watch</p>
		</div>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam2Mobile">
	<img src="https://thewatch.imgix.net/landing/timex_footurama/2.jpg?auto=compress" class="img-responsive" width="100%">
	<div id="descTimexBeam2Mobile">
		<p>An exploration of the</p>
		<p>iconic military watch</p>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam3">
	<div class="container" id="containerTimexBeam3">
		<!--<div class="pull-right" id="descTimexBeam2">-->
		<div id="descTimexBeam3">
			<p> Inspired by the campervan community,</p>
			<p>this collaboration brings the aesthetic</p>
			<p>of vehicle instrument clusters combined</p>
			<p>with both brand's identity, through</p>
			<p>the customization of a military classic</p>
			<p>-the Timex MK1</p>
			<a href="#" class="white-round" id="addtocart" style="float:none;width:200px;margin-top:60px;display: block; text-align:center" onclick="shopNow()">Shop Now</a>
		</div>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam2Mobile">
	<img src="https://thewatch.imgix.net/landing/timex_footurama/3.jpg?auto=compress" class="img-responsive" width="100%">
	<div id="descTimexBeam2Mobile">
		<p> Inspired by the campervan community, this collaboration brings the aesthetic of vehicle instrument clusters combined with both brand's identity, through the customization of a military classic</p>
		<p>-the Timex MK1</p>
		<a href="#" class="white-round" id="addtocart" style="float:none;width:200px;margin-top:60px; display: block; text-align:center" onclick="shopNow()">Shop Now</a>
	</div>
</section>


<section class="nopadding" id="sectionTimexBeam4">
	<div class="container" id="containerTimexBeam4">
		<!--<div class="pull-right" id="descTimexBeam2">-->
		<div id="descTimexBeam4">
			<h3>INDIGLO® Light </h3>
			<h3>Feature</h3>
			<p> Green INDIGLO® light with</p>
			<p>hidden graphics.</p>
		</div>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam2Mobile">
	<img src="https://thewatch.imgix.net/landing/timex_footurama/4.jpg?auto=compress" class="img-responsive" width="100%">
	<div id="descTimexBeam2Mobile">
		<h3>INDIGLO® Light </h3>
		<h3>Feature</h3>
		<p> Green INDIGLO® light with</p>
		<p>hidden graphics.</p>
	</div>
	
</section>

<section id="time-slider" >
    <div class="container" style="width:100% !important">
        <div class="row">
           
            <section class="shop">
                <!--
                <div class="arrow-slide-control">
                    <div class="arrow-control prev">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/arrow-left.png" 
                            alt="arrow">
                    </div>
                    <div class="arrow-control next">
                         <img src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/arrow-right.png" 
                            alt="arrow">
                    </div>
                </div>

                <section id="sliderDev">
                    <article title="" slide="1">
                    <div class="image-content"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/slide1.jpg" alt="image" class="product-image"></div>
                    </article>
                    <article title="" slide="2">
                    <div class="image-content"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/slide2.jpg" alt="image" class="product-image"></div>
                    </article>
                    <article title="" slide="3">
                    <div class="image-content"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/slide3.jpg" alt="image" class="product-image"></div>
                    </article>
                </section> -->


                <div class="carousel-landing"
                data-flickity='{ "wrapAround": true, "setGallerySize":  false }'>
                <div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timex_footurama/carousel/1.jpg?auto=compress" alt="img" />
                </div>
                <div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timex_footurama/carousel/2.jpg?auto=compress" alt="img" />
                </div>
                <div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timex_footurama/carousel/3.jpg?auto=compress" alt="img" />
                </div> 
				<div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timex_footurama/carousel/4.jpg?auto=compress" alt="img" />
                </div>
				<div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timex_footurama/carousel/5.jpg?auto=compress" alt="img" />
                </div>
                </div>

               
            </section>
        </div>

        
    </div>
</section>

<section class="nopadding" id="sectionTimexBeam5">
	<div class="container" id="containerTimexBeam5">
		<!--<div class="pull-right" id="descTimexBeam2">-->
		<div id="descTimexBeam5">
			<h3>MK1 40 mm </h3>
			<h3>Fabric Strap</h3>
			<p style="font-size: 14px">
				Case Material: Alumunium</br>
				Band Color: Navy</br>
				Dial Color: Black</br>
				Case Color: Navy</br>
				Case Finish: Matte</br>
				Water Resistant: 30 m</br>
				Dial Size: 40 mm</br>
				Case Height 9mm</br>
				Strap Width: 20 mm</br>
				INDIGLO® Light: Green
			</p>
		</div>
	</div>
</section>

<section class="nopadding" id="sectionTimexBeam2Mobile">
	<img src="https://thewatch.imgix.net/landing/timexfooturama/7.jpg?auto=compress" class="img-responsive" width="100%">
	<div id="descTimexBeam2Mobile">
		<h3>MK1 40 mm </h3>
		<h3>Fabric Strap</h3>
		<p>
			Case Material: Alumunium</br>
			Band Color: Navy</br>
			Dial Color: Black</br>
			Case Color: Navy</br>
			Case Finish: Matte</br>
			Water Resistant: 30 m</br>
			Dial Size: 40 mm</br>
			Case Height 9mm</br>
			Strap Width: 20 mm</br>
			INDIGLO® Light: Green
		</p>
	</div>
	
</section>

<!-- <section>
<a href="#" class="blue-round center-block" id="addtocart" style="float:none;width:200px;margin-top:60px;" onclick="shopNow()">Buy</a>
</section> -->

<!--
<section class="nopadding" id="sectionTimexBeam5">
	<img src="https://thewatch.imgix.net/landing/timexraffle/raffle5.jpg?auto=compress" class="img-responsive" width="100%"> 
</section>
-->


<script>
    
$(function() {

    function setHeight(ab) {
        var target = $('.carousel-landing-cell-image'),
            heightImage;
        if (target[0].complete || target[0].readyState === 4) {
            heightImage = target.height();
            ab.height(heightImage);
        }
        else {
            target.on('load', function () {
                heightImage = $(this).height();
                console.log(heightImage);
                ab.height(heightImage);
            });
        }
    }
    setHeight($('.flickity-viewport'));
    $(window).resize(function () {
        setHeight($('.flickity-viewport'));
    });
    /*
    let theSpeed = 3000;
    let currentImage = $("#currentImage");
    let totalImage = $("#totalImage");

    

    var theSlide = $("#slider").slippry({
        // transition: 'fade',
        // useCSS: true,
        speed: theSpeed,
        // pause: 3000,
        // auto: true,
        // preload: 'visible',
        controls: false,
        autoHover: true
    });

    totalImage.html(theSlide.getSlideCount());

    function getCurentSlideNow(){
        return theSlide.getCurrentSlide()[0].getAttribute('slide');
    }

    setInterval(() => {
        currentImage.html(getCurentSlideNow())
    }, theSpeed);

    $('.stop').click(function () {
        theSlide.stopAuto();
    });

    $('.start').click(function () {
        theSlide.startAuto();
    });

    
    $('.reset').click(function () {
        theSlide.destroySlider();
        return false;
    });
    $('.reload').click(function () {
        theSlide.reloadSlider();
        return false;
    });
    $('.init').click(function () {
        theSlide = $("#theSlide").slippry();
        return false;
    });
    */

    var theSlide = $('#sliderDev').slippry({
        // general elements & wrapper
        slippryWrapper: '<div class="sy-box shop-slider" />', 
        elements: 'article', 

        // options
        adaptiveHeight: true, // height of the sliders adapts to current slide
        start: 2, 
        loop: true, 
        captionsSrc: 'article',
        captions: 'custom',
        captionsEl: '.product-name',
        controls: true,
        pager: true,

        // transitions
        slideMargin: 4, // spacing between slides (in %)
        useCSS: true,
        transition: 'horizontal',

        // slideshow
        auto: false
    });

    function getCurentSlideNow(){
        return theSlide.getCurrentSlide()[0].getAttribute('slide');
    }

    $('.prev').click(function () {
        if(getCurentSlideNow() === 2) {
            $($('.prev')[0]).css('display', 'none');
        }

        theSlide.goToPrevSlide();
        return false;
    });
    $('.next').click(function () {
        theSlide.goToNextSlide();
        return false;
    });
});
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

		#sectionTimexBeam5 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/5.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}
		
		#sectionTimexBeam4 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/4.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#sectionTimexBeam3 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/3.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#sectionTimexBeam2 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/2.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#sectionTimexBeam1 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/1.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#containerTimexBeam1 {
			/* min-height:70vw; */
			min-height: 56vw;

			position: relative;
		}

		#containerTimexBeam2 {
			/* min-height:70vw; */
			min-height: 56vw;

			position: relative;
		}

		#containerTimexBeam3 {
			/* min-height:70vw; */
			min-height: 56vw;

			position: relative;
		}

		#containerTimexBeam4 {
			/* min-height:70vw; */
			min-height: 38vw;

			position: relative;
		}

		#containerTimexBeam4 {
			/* min-height:70vw; */
			min-height: 36vw;

			position: relative;
		}

		#containerTimexBeam5 {
			/* min-height:70vw; */
			min-height: 38vw;

			position: relative;
		}

		#sectionTimexBeam3 {
			margin-top: 0px;
		}

		#descTimexBeam1 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam2 {
			width: 450px;

			top: 45%;

			position: absolute;

			left: 20%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam3 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
		}
		
		#descTimexBeam4 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 80%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam5 {
			width: 450px;

			top: 10%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
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

		#sectionTimexBeam2Mobile{
			display: none;
		}

		#descTimexBeam4 img{
			width: 70%;
			margin: 0 auto;
		}

		#checkoutTimexBeam{
			padding: 0 10%
		}
	}

	/*DESKTOP*/
	@media only screen and (min-width: 1024px) and (max-width:1340px) {
		#sectionTimexBeam5 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/5.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;

		}
		
		#sectionTimexBeam4 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/4.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#sectionTimexBeam3 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/3.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#sectionTimexBeam2 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/2.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;

		}

		#sectionTimexBeam1 {
			background-image: url('https://thewatch.imgix.net/landing/timex_footurama/1.jpg?auto=compress');

			background-size: 100% auto;

			background-position: 0 0;

			background-repeat: no-repeat !important;
		}

		#descTimexBeam1 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam2 {
			width: 450px;

			top: 45%;

			position: absolute;

			left: 20%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam3 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam4 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 80%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam5 {
			width: 450px;

			top: 10%;

			position: absolute;

			left: 60%;

			position: absolute;
			color: #fff;
		}

		#containerTimexBeam1 {
			/* min-height:70vw; */
			min-height: 56vw;

			position: relative;
		}

		#containerTimexBeam2 {
			/* min-height:70vw; */
			min-height: 56vw;

			position: relative;
		}

		#containerTimexBeam3 {
			/* min-height:70vw; */
			min-height: 56vw;

			position: relative;
		}

		#containerTimexBeam4 {
			/* min-height:70vw; */
			min-height: 36vw;

			position: relative;
		}

		#containerTimexBeam4 {
			/* min-height:70vw; */
			min-height: 38vw;

			position: relative;
		}

		#containerTimexBeam4 {
			/* min-height:70vw; */
			min-height: 36vw;

			position: relative;
		}

		#sectionTimexBeam3 {
			margin-top: 0px;
		}

		#descTimexBeam2 {
			width: 450px;

			top: 40%;

			position: absolute;

			left: 70%;

			position: absolute;
			color: #fff;
		}

		#descTimexBeam2 p {
			font-size: 10pt;
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

		#sectionTimexBeam2Mobile{
			display: none;
		}

		#checkoutTimexBeam{
			padding: 0 10%
		}


	}

	/* IPAD */
	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px)  {
		#descTimexBeam2Mobile{
			padding: 10% 35%;
		}
		/* #sectionTimexBeam2Mobile{
			display: none;
		} */
		#sectionTimexBeam4 {
			display: none;
		}

		#sectionTimexBeam5 {
			display: none;
		}
	}

	/*MOBILE*/

	@media (max-width:1024px) {

		#containerTimexBeam4 {

			padding-top: 45px;

			padding-bottom: 45px;

		}

		/* #descTimexBeam2 p {

			font-size: 20pt;

		}

		#descTimexBeam2 h3 {

			font-size: 30pt;

		}

		#descTimexBeam2 {

			margin-top: 20vw;

		} */

		#descTimexBeam4 {
			/* padding: 0 50px */
			margin-top:30px;

		}

		#descTimexBeam6 {

			margin-bottom: 75px;

		}

		#sectionTimexBeam1 {
			display: none;
		}

		#sectionTimexBeam2 {
			display: none;
		}

		#sectionTimexBeam3 {
			display: none;
		}

		#sectionTimexBeam4 {
			display: none;
		}

		#sectionTimexBeam5 {
			display: none;
		}

		#descTimexBeam2Mobile{
			padding: 10% 20%;
		}

		#descTimexBeam2Mobile h3{
			font-size: 12pt;
		}

	}

	@media (max-width:700px) {

		#sectionTimexBeam4 {
			display: none;
		}

		#sectionTimexBeam5 {
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

		#descTimexBeam4 {
			/* padding: 0 50px */
			margin-top:30px;

		}
	}

	.o-content {
		background-image: none !important;
	}

</style>