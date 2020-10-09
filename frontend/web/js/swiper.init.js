   	//snippet for countdown
		
// 		$('[id=countdown-product]').countdown(flashtime, {elapse: true})
//         .on('update.countdown', function(event){
//             var $this = $(this);
//             if (event.elapsed) {
//                 // after end
//                 location.reload();
// //                $("#countdown-product-box").hide();
//             } else {
//                 $this.html(event.strftime('<span>FLASH SALE : %H:%M:%S</span>'));
//             }
//         });
   	
   		 var swiper2 = new Swiper('.swiper-container-homeban', {
                pagination: {
			        el: '.homebanner-pagination',
			        dynamicBullets: true,
			        clickable: true,
			      },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 0,
        slidesPerView: 'auto',
        autoplay: {
	        delay: 5000,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });
    
    var swiper3 = new Swiper('.swiper-container', {
        slidesPerView: 2,
        // paginationClickable: true,
        spaceBetween: 0,
        freeMode: true,
        autoplay: {
	        delay: 5000,
	        disableOnInteraction: false,
	      },
    });

    var swiper4 = new Swiper('.swiper-container-featured-brand', {
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 0,
        slidesPerView: 1,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });
    var swiper5 = new Swiper('.swiper-container-featured-brand-product', {
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 15,
        slidesPerView: 2,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });

    var swiper6 = new Swiper('.swiper-container-brands', {
         //        pagination: {
			      //   el: '.swiper-pagination',
			      //   dynamicBullets: true,
			      //   clickable: true,
			      // },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 15,
        slidesPerView: 3,
        slidesPerGroup: 3,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });
    
        var swiper9 = new Swiper('.swiper-container-featured-brand-product-desktop', {
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 17,
        slidesPerView: 3,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });

    var swiper10 = new Swiper('.swiper-container-featured-brand-new', {
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 0,
        slidesPerView: 1,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });
    var swiper11 = new Swiper('.swiper-container-featured-brand-product-new', {
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 15,
        slidesPerView: 2,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });

    var swiper12 = new Swiper('.swiper-container-featured-brand-product-desktop-new', {
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 25,
        slidesPerView: 3,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });

			var setTimeSwipeProd = '';
			var setTimeSwipeBrand = '';
			jQuery(document).ready(function($) {
				$(window).scroll(function() {
					// if (typeof myVar !== 'undefined' || myVar !== null) {
					   clearTimeout(setTimeSwipeProd);
					   clearTimeout(setTimeSwipeBrand);
					// }

					$('.swiper-button-next.product-swipe').css('display',"block");
				      $('.swiper-button-prev.product-swipe').css('display',"block");
					$('.swiper-button-next.brand-swipe').css('display',"block");
				      $('.swiper-button-prev.brand-swipe').css('display',"block");
					setTimeSwipeProd = setTimeout(setTimeOutProd, 2000);
					setTimeSwipeBrand = setTimeout(setTimeOutBrand, 2000);
					
				});
				
			});

			function setTimeOutProd() {
					$('.swiper-button-next.product-swipe').css('display',"none");
				    $('.swiper-button-prev.product-swipe').css('display',"none");
			}    
			function setTimeOutBrand() {
				    $('.swiper-button-next.brand-swipe').css('display',"none");
				    $('.swiper-button-prev.brand-swipe').css('display',"none");
			}    

    $('.swiper-button-next.product-swipe').click(function(e) {
	   e.preventDefault();
	   $('.swiper-button-next.product-swipe').css('display',"block");
		$('.swiper-button-prev.product-swipe').css('display',"block");
	   swiper5.slideTo(4, 1000, true);
	   
	 });
    $('.swiper-button-prev.product-swipe').click(function(e) {
	   e.preventDefault();
	   $('.swiper-button-next.product-swipe').css('display',"block");
		$('.swiper-button-prev.product-swipe').css('display',"block");
	   swiper5.slideTo(0, 1000, true);
	   
	 });
    swiper5.on('touchMove', function () {
    	clearTimeout(setTimeOutProd);
	  	$('.swiper-button-next.product-swipe').css('display',"block");
		$('.swiper-button-prev.product-swipe').css('display',"block");
	});
	

    swiper6.on('touchMove', function () {
    	clearTimeout(setTimeOutBrand);
	  	$('.swiper-button-next.brand-swipe').css('display',"block");
		$('.swiper-button-prev.brand-swipe').css('display',"block");
	});

	$(document).ready(function(){
	
		$(".swiper-button-next.brand-swipe").click(function(){
			clearTimeout(setTimeOutBrand);
		    $('.swiper-button-next.brand-swipe').css('display',"block");
			$('.swiper-button-prev.brand-swipe').css('display',"block");
		});
		$(".swiper-button-prev.brand-swipe").click(function(){
			clearTimeout(setTimeOutBrand);
		    $('.swiper-button-next.brand-swipe').css('display',"block");
			$('.swiper-button-prev.brand-swipe').css('display',"block");
		});
	});
	
    var swiper7 = new Swiper('.swiper-container-footer', {
    			autoHeight: true,
                pagination: {
			        el: '.swiper-pagination',
			        dynamicBullets: false,
			        clickable: true,
			      },
        paginationClickable: true,
       //  navigation: {
	      //   nextEl: '.swiper-button-next',
	      //   prevEl: '.swiper-button-prev',
	      // },
        spaceBetween: 0,
        slidesPerView: 1,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });

    var swiper8 = new Swiper('.swiper-container-brands-desktop', {
         //        pagination: {
			      //   el: '.swiper-pagination',
			      //   dynamicBullets: true,
			      //   clickable: true,
			      // },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 15,
        slidesPerView: 5,
        slidesPerGroup: 5,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });
    
    var swiper13 = new Swiper('.swiper-container-flash-desktop', {
         //        pagination: {
			      //   el: '.swiper-pagination',
			      //   dynamicBullets: true,
			      //   clickable: true,
			      // },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 15,
        slidesPerView: 5,
        slidesPerGroup: 5,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });
    
    var swiper14 = new Swiper('.swiper-container-flash-mobile', {
         //        pagination: {
			      //   el: '.swiper-pagination',
			      //   dynamicBullets: true,
			      //   clickable: true,
			      // },
        // paginationClickable: true,
        navigation: {
	        nextEl: '.swiper-button-next',
	        prevEl: '.swiper-button-prev',
	      },
        spaceBetween: 15,
        slidesPerView: 2,
        slidesPerGroup: 2,
        autoplay: {
	        delay: 7500,
	        stopOnLast: true,
	        disableOnInteraction: false,
	      },
    });


      $('a.swipe-last').click(function(e) {
   e.preventDefault();

   swiper4.slideTo(2, 1000, true);
 });

//     $('[id=countdown-product]').countdown(flashtime, {elapse: true})
//         .on('update.countdown', function(event){
//             var $this = $(this);
//             if (event.elapsed) {
//                 // after end
//                 // location.reload();
// //                $("#countdown-product-box").hide();
//             } else {
//                 $this.html(event.strftime('%H<span style="padding:2px;"></span>:<span style="padding:2px;"></span>%M<span style="padding:2px;"></span>:<span style="padding:2px;"></span>%S'));
//             }
//         });