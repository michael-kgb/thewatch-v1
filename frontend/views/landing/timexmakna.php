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

<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css"/>
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
        window.location = URL + '/timexmakna?p=open';

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
include "../shared/modal-product-detail.php";
?>
<section id="clock-wrap">
    <div class="container">
        <div class="row">
            <ul id="clock">	
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/face.jpg" alt="clock" />
                <li id="sec"></li>
                <li id="hour"></li>
                <li id="min"></li>
            </ul>
        </div>  
    </div>
</section>

<section id="total-time">
    <div class="container">
        <div class="row time-we-have">
            <div class="we-have-text">
                Remaining time <span class="show-mobile"> of the day.</span> <br/> 
                <span class="show-desktop">of the day.</span>
            </div>
            <div class="we-have-clock">
                <div class="have-time" id="sechand">
                    <span class='time-number'>00</span> Seconds
                </div>
                <div class="have-time" id="minhand">
                    <span class='time-number'>00</span> Minutes
                </div>
                <div class="have-time" id="hourhand">
                    <span class='time-number'>00</span> Hours
                </div>
            </div>
        </div>
    </div>
</section>
<section id="time-highlights">
    <div class="container">
        <div class="row time-we-have">
            <div class="highligh-left">
                Some people says time is a continued progress of existence and events that occur from the past through the present to the future

                <div class="under-highlights">
                    Time is the most impactful unit of <span class="show-mobile-custom"><br/></span> measure in our life.
                </div>
            </div>
            <div class="highlight-right">
                <span>Time
                always
                moves </span> <br/>
                <span>forward, never stops, </span><br/>
                <span>never in reverse.</span> <br/>
            </div>
        </div>
    </div>
</section>

<section id="separate-image">
    <div class="left-center abs-text">
        <div class="abs-head">TIMEX x MAKNA</div>
        <div class="abs-child">IT'S TIME</div>
        <button id="shopNow" class="round-btn chocolate" onclick="shopNow()">Shop Now</button>
    </div>
    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/separate.jpg" alt="separate-image" />
</section>

<section id="separate-text">

    We tend to let ourselves get  <span class="show-desktop" style="display:contents"><br/></span> trapped in our routines, 
    not realizing we are  <span class="show-desktop" style="display:contents"><br/></span> <u><b>underestimating the value time.</b></u>

</section>

<section id="separate-image-text">
    <div class="right-bottom abs-text">
        <button id="shopNow" class="round-btn chocolate" onclick="shopNow()">Shop Now</button>
    </div>
    <img class="show-desktop" src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/separate-text.jpg" alt="separate-image text" />
    <img class="show-mobile" src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/separate-text2.jpg" alt="separate-image text" />
</section>

<section id="time-slider">
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
                    src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/slide1.jpg" alt="img" />
                </div>
                <div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/slide2.jpg" alt="img" />
                </div>
                <div class="carousel-landing-cell">
                    <img class="carousel-landing-cell-image custom-slide"
                    src="<?php echo \yii\helpers\Url::base(); ?>/img/clock/slide3.jpg" alt="img" />
                </div>
                </div>

               
            </section>
        </div>

        
    </div>
</section>

<section id="footer">
    <div class="container">
        <div class="row">   
            <div class="col-md-4 col-sm-12">
                <div class="large-text">Reevaluating <span class="show-mobile" style="display:contents"><br/></span> time.</div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="medium-text">
                Time plays a very special role in our life. It has witnessed the good as well as the bad moments, all that has made us who we are today. <br/><br/>

                Time is so precious, it has become our currency. It is very limited, it gives us insecurities. Waste is well, waste it wisely Time is now. It's Time.
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 col-sm-12">
                <div class="medium-text-bold">
                MK1 36mm <br/>
                Fabric Strap Watch
                </div>

                Band Material : Fabric<br/>
                Case Height : 12.5 mm<br/>
                Strap and lug width : 18 mm <br/>
                Case Width : 36 mm<br/>
                Attachment Hardware Color : Black<br/><br/>

                Watch Movement : Quartz Analog<br/>
                Water Resistance : 30 meters<br/><br/>

                Case Material : Resin<br/>
                Band Color : Black<br/>
                Case Color : Black<br/>
                Case Finish : Glossy<br/>
                Case Shape : Round<br/>
                Case Size : Full Size <br/>
                Dial Color : Black & White<br/>
            </div>
        </div>
        <div class="row center-row">
            <button id="shopNow" class="round-btn chocolate" onclick="shopNow()">Shop Now</button>
        </div>
        <div class="row last-footer">
            <div class="col-md-12 in-last-footer">
                2019 &copy; MX01-1900-000
            </div>
        </div>
    </div>
</section>

<div class="clear"></div>

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