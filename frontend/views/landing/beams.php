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

<section class="nopadding" style="padding-bottom:2px;" id="sectionTimexBeam">

	<video id="my-video" class="video-home" muted loop autoplay loop muted playsinline>

	<source src="https://thewatch.co/img/landing/timexbeams/vidtimexbeams.mp4" type="video/mp4"/>

	</video>

</section>                                                                                          



<section class="nopadding" id="sectionTimexBeam2"> 

	<div class="container" id="containerTimexBeam2">

				<!--<div class="pull-right" id="descTimexBeam2">-->

				<div id="descTimexBeam2">

					<h3>Timex x Beams x Engineered Garments</h3>

					<p>

						Timex has linked up with Beams Boy and Engineered Garments for limited edition Camper watch with a reversed face dial.The watch face is mirrored, with the numbers and branding facing backwards. The watch hands run clockwise however, making it challenging, but still feasible, to tell time.nd the rugged toughness of TIMEX.


					</p>

				</div>

	</div> 

</section>



<section class="nopadding" id="sectionTimexBeam3">

	<img src="https://thewatch.imgix.net/landing/timexbeams/beams3.png?auto=compress" class="img-responsive" width="100%"> 

</section>



<section class="nopadding" id="sectionTimexBeam4">

	<div class="container" id="containerTimexBeam4">

		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<img src="https://thewatch.imgix.net/landing/timexbeams/beams4a.png?auto=compress" class="img-responsive">

			</div>

			

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="descTimexBeam4">

				

					<img src="https://thewatch.imgix.net/landing/timexbeams/beams4b.png?auto=compress" class="img-responsive">

					<div id="checkoutTimexBeam" class="center-block" style="text-align:center;">

						<h5>TIMEX x BEAMs x ENGINEREED GARMENTS</h5>

						<p style="margin-bottom:30px;">

						Vintage Chronograph Black DLC Case with Black Buffalo Leather and Red Stitching

						</p>

						<div class="product-detail product-price" style="text-align:center;">

							IDR 2.450.000

						</div>

						<div class="product-detail product-installment" style="text-align:center;margin-bottom:30px;">

							IDR 162.500 / bulan

						</div>

						<a href="#" class="blue-round center-block" id="addtocart" style="float:none;width:200px;" onclick="shopNow()">Add to Cart</a>

					</div>

				

			</div>

		</div>	

	</div>

</section>





<section class="nopadding" id="sectionTimexBeam5">

	<div class="container" id="containerTimexBeam5">

		<div id="descTimexBeam5">

			<h6>Nylon Slip Thru Strap</h6>

			

			<ul style="list-style:none;"> 

				<li><label>Water Resistance</label> : 30m</li>

				<li><label>Strap</label> : Black Fabric</li>

				<li><label>Case Color</label> : Black</li>

				<li><label>Case Height</label> : 9mm</li>

				<li><label>Case Lug Width</label> : 18mm</li>

				<li><label>Case Width</label> : 36mm</li>

				<li><label>Case Material</label> : Resin</li>

				<li><label>Crystal/Glass</label> : Acrylic</li>

				<li><label>Dial Color</label> : Black</li>

				<li><label>Movement</label> : Quartz</li>

				<li><label>Finish</label> : Polished</li>

			</ul>

		</div>

	</div>

</section>



<section id="sectionTimexBeam6">

	<div class="container" id="containerTimexBeam6">

		<div id="descTimexBeam6">

			<a class="blue-round center-block text-center" style="float:none;width:200px;" href="https://thewatch.co/product/timex-x-beams-x-engineered-garments">Shop Now</a>

		</div>

	</div>

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

