<style>
.zoomContainer {
    z-index: 9999 !important;
}
.prism-widget {
    display:none;
}
.zoomWindowContainer > div {
    height: 400px !important;
}
#popup-product-wrap, .zoomContainer {
    list-style-type: none;
    opacity: 0;
    visibility: hidden;
}
@media screen and (max-width: 768px){
    .zoomWindowContainer > div {
        height: 338px !important;
    }
}
</style>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css/timexmakna.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script type="text/javascript">

var today = new Date();
var countDownDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1, 0, 0, 0);

var x = setInterval(function() {

  var now = new Date().getTime();
  var distance = countDownDate - now;

  var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60 * 60 * 24)) / 1000);

  document.getElementById("sechand").innerHTML  = "<span class='time-number'>"+ convertNumber(seconds).toLocaleString().replace(',', '.') + "</span> Seconds";
  document.getElementById("minhand").innerHTML  = "<span class='time-number'>"+ convertNumber(minutes).toLocaleString().replace(',', '.') + "</span> Minutes";
  document.getElementById("hourhand").innerHTML = "<span class='time-number'>"+ convertNumber(hours) + "</span> Hours ";
  
  if (distance < 0) {
    countDownDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1, 0, 0, 0);
  }
  
}, 1000);

function convertNumber(number){
    if(number < 10){
        return '0'+number;
    }

    return number;
}
    
$(document).ready(function() {
    let scaleRate = window.innerWidth > 760 ? 0.9 : 0.5;
    let secScaleRate = window.innerWidth > 760 ? 0.6 : 0.33;

    setInterval( function() {
        var seconds = new Date().getSeconds();
        var sdegree = seconds * 6;
        var srotate = "rotate(" + sdegree + "deg)";
        
        $("#sec").css({"-moz-transform" : srotate + " scale("+secScaleRate+")", "-webkit-transform" : srotate + " scale("+secScaleRate+")"});
        
    }, 1000 );
    

    setInterval( function() {
        var hours = new Date().getHours();
        var mins = new Date().getMinutes();
        var hdegree = hours * 30 + (mins / 2);
        var hrotate = "rotate(" + hdegree + "deg)";
        
        $("#hour").css({"-moz-transform" : hrotate + " scale("+scaleRate+")", "-webkit-transform" : hrotate + " scale("+scaleRate+")"});
        
    }, 1000 );


    setInterval( function() {
        var mins = new Date().getMinutes();
        var mdegree = mins * 6;
        var mrotate = "rotate(" + mdegree + "deg)";
        
        $("#min").css({"-moz-transform" : mrotate + " scale("+scaleRate+")", "-webkit-transform" : mrotate + " scale("+scaleRate+")"});
        
    }, 1000 );

    $("#product-thumb").css('display', 'none');

    var url = new URL(window.location);
    var p = url.searchParams.get("p");

    if(p == 'open') {
        document.getElementById("shopNow").click();
       
        $(".zoomContainer").css('visibility', 'visible');
        $(".zoomContainer").css('opacity', 1);
    }
}); 

var url = new URL(window.location);
var p = url.searchParams.get("p");

if(p == 'timex'){

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

    if(p == 'open') {
        
        setTimeout(() => {
        $(".zoomContainer").css('visibility', 'visible');
        $(".zoomContainer").css('opacity', 1);
            
        }, 1000);
    }
}

function shopNow() {

    let URL = 'https://gostaging.thewatch.co';

    if(p == 'timex'){
        window.location = URL + '/timexbeams?p=open';

    } else {
       openPopup();
    }
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
include "../shared/modal-product-detail-timexbeams.php";
?>




<section class="nopadding" id="sectionTimexFooturama1">

	<img src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_01.jpg?auto=compress" class="img-responsive" width="100%"> 

</section>

<section class="nopadding" id="sectionTimexFooturama2">

	<img src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_02.jpg?auto=compress" class="img-responsive" width="100%"> 

</section>

<section class="nopadding" id="sectionTimexFooturama3">

	<img src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_03.jpg?auto=compress" class="img-responsive" width="100%"> 

</section>

<section class="nopadding" id="sectionTimexFooturama4">

	<img src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_04.jpg?auto=compress" class="img-responsive" width="100%"> 

</section>

<section id="time-slider" >
    <div class="container">
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
                    src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_01.jpg?auto=compress" alt="img" />
                </div>
                <div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_02.jpg?auto=compress" alt="img" />
                </div>
                <div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_03.jpg?auto=compress" alt="img" />
                </div> 
				<div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_04.jpg?auto=compress" alt="img" />
                </div>
				<div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_05_carousel.jpg?auto=compress" alt="img" />
                </div>
				<div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_06.jpg?auto=compress" alt="img" />
                </div>
                </div>

               
            </section>
        </div>

        
    </div>
</section>

<section class="nopadding" id="sectionTimexFooturama6">

	<img src="https://thewatch.imgix.net/landing/timexfooturama/FT_Landing Page_06.jpg?auto=compress" class="img-responsive" width="100%"> 

</section>





<script>

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

  video.addEventListener( "canplay", function() {

    video.play();

  });

  videom.addEventListener( "canplay", function() {

    videom.play();

  });

})();
</script>


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



<style>



#my-video{

	width:100%;

}



.nopadding {

	padding: 0 !important;

}



/*DESKTOP*/

@media only screen and (min-width: 1024px){

	#sectionTimexBeam2{

		background-image:url('https://thewatch.imgix.net/landing/timexbeams/beams2a.png?auto=compress');

		background-size:auto 100%;

		background-position: center 0;

		background-repeat:no-repeat !important;

		margin-left:40px !important;

		margin-right:40px !important;

		margin-top:80px !important;

		margin-bottom:80px !important;

	}



	#containerTimexBeam2{

		min-height:910px;

		position:relative;

	}



	#descTimexBeam2{

		width:450px;

		top:40%;

		position:absolute; 

		left: 60%;

		position:absolute;

	}



	#descTimexBeam2 p{

		font-size:12pt;

	}

	#descTimexBeam2 h3{ 

		font-size:14pt;

	}

	#descTimexBeam2{

		margin-top:1vw;

	}



	#sectionTimexBeam4{

		padding-top:60px !important;

		padding-bottom: 60px !important;

	}



	#sectionTimexBeam5{

		background-image:url('https://thewatch.imgix.net/landing/timexbeams/beams5.png?auto=compress');

		background-size:100% auto;

		background-position: center 0;

		background-repeat:no-repeat !important;

	} 



	#containerTimexBeam5{

		height:65vw; 

		position:relative;

	}



	#descTimexBeam5{

    	color:#fff;

		margin-top:10%;

	}



	#descTimexBeam5 ul{

		font-size:10pt;

		color:#fff;

		list-style: none;    

		padding-left:0;

		text-shadow: 0.75px 0.75px 0px #000;

	}



	#descTimexBeam6{

		margin-bottom:75px;

	}



}





/*MOBILE*/

@media (max-width:1024px){

	#sectionTimexBeam2{

		background-image:url('https://thewatch.imgix.net/landing/timexbeams/mobile/beams2a.png?auto=compress') !important;

		background-size:100% auto;

		background-position: 0 65px;

		background-repeat:no-repeat !important;

	}

	#containerTimexBeam2{

		height:215vw;

		padding-left:45px;

		padding-right:45px;

	}



	#containerTimexBeam4{

		padding-top:45px;

		padding-bottom:45px;

	}



	#sectionTimexBeam5{

		background-image:url('https://thewatch.imgix.net/landing/timexbeams/mobile/beams5.png?auto=compress') !important;

		background-size:100% auto;

		background-position: 0 0;

		background-repeat:no-repeat !important;

	}



	#containerTimexBeam5{

		height:170vw;

	}



	#descTimexBeam5{

		padding-left:20px;

		color:#000;

		margin-top:80vw;

	}



	#descTimexBeam5 ul{

		font-size:10pt;

		color:#000;

		list-style: none;    

    padding-left:0;

	}



	#descTimexBeam2 p{

		font-size:20pt;

	}

	#descTimexBeam2 h3{ 

		font-size:30pt;

	}

	#descTimexBeam2{

		margin-top:1vw;

	}

	#descTimexBeam4{

		margin-top:30px;

	}

	#descTimexBeam6{

		margin-bottom:75px;

	}

}



@media (max-width:700px){

	#descTimexBeam2 p{ 

		font-size:9pt;

	}

	#descTimexBeam2 h3{ 

		font-size:14pt;

	}

	#descTimexBeam6{

		margin-top:5px;

	}

}









#descTimexBeam5 label{

    width:120px;

}



#descTimexBeam5 h6{

	font-weight:800;

}

 

.o-content{

	background-image:none !important; 

}



#sectionTimexBeam6,#sectionTimexBeam4{

	background-image:none;



}



</style>

