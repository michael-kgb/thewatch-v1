$(window).load(function(){
	if(typeof isOrderConfirmed !== 'undefined' && isOrderConfirmed === false)
	{
		$('#confirmModal').modal('show');
	}

	//$('#subscribeHpn').modal('show');
});

function randString(x) {
      var s = "";
      while (s.length < x && x > 0) {
          var r = Math.random();
          s += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
      }
      return s;
  }
  
    function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for(var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
              c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return "";
  }

function video_play_product(){
  $('div.image-thumb').css("display","none");
  $('div.video-thumb').css("display","block");
  $('div.zoomContainer').css("display","none");
  $('video').trigger('play');
  
}
function video_stop_product(){
  $('div.image-thumb').css("display","block");
  $('div.video-thumb').css("display","none");
  $('div.zoomContainer').css("display","block");
  $('video').trigger('pause');
}
    
  
$(".journal-box").hover(function(){
  $(".overlay-journal",this).css("display","block");
  $(".overlay-title",this).css("display","block");
  $(".overlay-description",this).css("display","block");
  $(".overlay-journal-date",this).css("display","block");
});
$(".journal-box").mouseleave(function(){
  $(".overlay-journal",this).css("display","none");
  $(".overlay-title",this).css("display","none");
  $(".overlay-description",this).css("display","none");
  $(".overlay-journal-date",this).css("display","none");
});

$(function(){
    var shrinkHeaderMobile = $('.bulkhead-height').height();

    $('a.bulkhead-close').click(function(){
      shrinkHeaderMobile = 0;
    });
     var shrinkHeader = 300;
      $(window).scroll(function() {
        var scroll = getCurrentScroll();
            if ($(window).width() < 1025) {
               if ( scroll >= shrinkHeaderMobile ) {
                   $('.height-menu2').addClass('scroll');
                   $('.collapse.navbar-collapse').addClass('scroll');
                   $('.mn-header.submenu').addClass('scroll');
                   $('#navbar-mobile').css("box-shadow","rgba(0, 0, 0, 0.5) 1px 1px 5px 0px");
                   $('#navbar-mobile').css("position","fixed");
                   $('#navbar-mobile').css("top","0");
                   $('#navbar-mobile').css("margin-top","0");
                   $('#navbar-mobile').css("background-color","#fff");
                   $('.menu-header-gap').css("padding-top","120px");

                }
                else {
                    $('.height-menu2').removeClass('scroll');
                    $('.collapse.navbar-collapse').removeClass('scroll');
                    $('.mn-header.submenu').removeClass('scroll');
                    $('#navbar-mobile').css("box-shadow","none");
                    $('#navbar-mobile').css("position","relative");
                   $('#navbar-mobile').css("top","unset");
                   $('#navbar-mobile').css("margin-top","none");
                   $('.menu-header-gap').css("padding-top","0");
                }
            }
            else {
               if ( scroll >= shrinkHeader ) {
                   $('.height-menu2').addClass('scroll');
                   $('.collapse.navbar-collapse').addClass('scroll');
                   $('.mn-header.submenu').addClass('scroll');
                   $('#navbar-mobile').css("background-color","#fff");
                   $('#navbar-mobile').css("box-shadow","rgba(0, 0, 0, 0.5) 1px 1px 5px 0px");
                   // $('#navbar-mobile').css("position","fixed");
                   // $('#navbar-mobile').css("top","0");

                }
                else {
                    $('.height-menu2').removeClass('scroll');
                    $('.collapse.navbar-collapse').removeClass('scroll');
                    $('.mn-header.submenu').removeClass('scroll');
                    $('#navbar-mobile').css("box-shadow","none");
                   //  $('#navbar-mobile').css("position","relative");
                   // $('#navbar-mobile').css("top","unset");
                }
            }

          
      });
    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
        }
    });
    
$(window).scroll(function() {

    if ($(this).scrollTop() === 0)
     {
        // $('a.scrolls').css('display','none');
        $('a.scrolls').css('-webkit-transform','translateY(120px)');
      $('a.scrolls').css('-ms-transform','translateY(120px)');
      $('a.scrolls').css('transform','translateY(120px)');
     }
    else
     {
        // console.log('muncul');
    //   $('a.scrolls').css('display','block');
      $('a.scrolls').css('-webkit-transform','translateY(0px)');
      $('a.scrolls').css('-ms-transform','translateY(0px)');
      $('a.scrolls').css('transform','translateY(0px)');
       
     }
 });

// menu bulkhead

  $(document).ready(function(){
       $(".text-bulkhead").mouseover(function(){
        $(this).find("i").addClass('hover');
        $(this).find("span").addClass('hover');
    });
 $(".text-bulkhead").mouseout(function(){
        $(this).find("i").removeClass('hover');
        $(this).find("span").removeClass('hover');
     });
});
 
/*for window scroll up*/
$(document).ready(function () {
    $('a.scrolls').css('-webkit-transform','translateY(120px)');
      $('a.scrolls').css('-ms-transform','translateY(120px)');
      $('a.scrolls').css('transform','translateY(120px)');
//    $(window).scroll(function () {
//        if ($(this).scrollTop() > 100) {
//            $('.scrollup').fadeIn();
//        } else {
//            $('.scrollup').fadeOut();
//        }
//    });

    $('.scrolls').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

});
function reservation_timex(){
                // alert('hello');
                    var name = $('input[name=reservation-name]').val();
                        var phone = $('input[name=reservation-phone]').val();
                         var email = $('input[name=reservation-email]').val();
                    // alert(name+phone+email);

                    if (name === '') {
                        // alert('name');
                        $('span#reservation-name-warning').css("display", "block");
                        // $('span#reservation-name-warning').html('* Name Is Required!');
                        return;
                    } else {
                        $('span#reservation-name-warning').css("display", "none");
                    }

                    if (phone === '') {
                        // alert('phone');
                        $('span#reservation-phone-warning').css("display", "block");
                        // $('span#reservation-name-warning').html('* Phone Number Is Required!');
                        return;
                    } else {
                        $('span#reservation-phone-warning').css("display", "none");
                    }

                    if (email === '') {
                        // alert('email');
                        $('span#reservation-email-warning').css("display", "block");
                        // $('span#reservation-email-warning').html('* Email Is Required!');
                        return;
                    } else if (!validateEmail(email)) {
                        $('span#reservation-email-warning2').css("display", "block");
                        return;
                    }else {
                        $('span#reservation-email-warning').css("display", "none");
                    }

                    
                  

                    $.ajax({
                        type: "POST",
                        url: baseUrl + '/timexlandingpage/reservation',
                        data: {
                            "reservation": {
                                "name": $('input[name=reservation-name]')[0].value,
                                "phone": $('input[name=reservation-phone]')[0].value,
                                "email": $('input[name=reservation-email]')[0].value,
                               
                            }
                        },
                        beforeSend: function () {
                            $('#loadingScreen').modal('show');
                        },
                        success: function (data) {
                            var d = data;
                            if (d === false) {
                                $('span#reservation-gagal-warning').css("display", "block");
                                return;
                            }

                            // sendRegisterHomePage();

                            // (function(document, window) {
                            //     var scr = document.createElement("script");
                            //     scr.type = "text/javascript";
                            //     scr.async = true;
                            //     scr.src =  "//ssp.adskom.com/tags/third-party-async/MmJlMzUxNjUtYzQ1Ny00ZjVjLWFiNzktNWM0YzJhNWFiYzVj";

                            //     document.body.appendChild(scr);
                            // })(document, window);

                            $('#loadingScreen').modal('hide');
                            $('#reservation-form').css("display", "none");
                            $('#reservation-success').css("display", "block");
                            // location.reload();
                        }
                    });
                }
/*
    $(window).load(function(){
        $('#myModals').modal('show');
    });

$(document).ready(function(){
	if(refreshCheck){
		$('#myModals').modal('show');
	}
});
function refreshCheck()
{
  if( document.refresh.visited.value == "" )
  {
    // Page loaded for first time

    document.refresh.visited.value = "1";

  }
 else
  {
  // On page refresh
  //alert("Refresh!!");
  }
}
*/

// Scroll in brand page
// if (document.getElementById('brand-collection-buttonsss')) {

// var fixmeTop = $('section#brand-collection-buttonsss').offset().top;
//     $(window).scroll(function() {
//         var currentScroll = $(window).scrollTop();
//         if (currentScroll >= fixmeTop) {
//             $('section#brand-collection-button').css({
//                 position: 'fixed',
//                 top: '0',
//                 left: '0'

//             });
//             $('section#brand-collection-button').css('z-index','2');
//             $('section#brand-collection-button').css('background-color','rgb(255, 255, 255)');
//             $('section#brand-collection-button').css('width','100%');

//         } else {
//             $('section#brand-collection-button').css({
//                 position: 'static'
//             });

//         }
//         if(currentScroll == 0){
//             $('#brand-category-master-click').text('');
//             $('#brand-category-master-click').append('CHOOSE CATEGORIES<span class="glyphicon glyphicon-option-horizontal" style="float:right;"></span>');
//         }
//     });
// }

if (document.getElementById('brand-filtersss')) {

		var fixmeTop = $('div#brand-filtersss').offset().top;

    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= fixmeTop) {
            $('div#brand-filter').css({
                position: 'fixed',
                top: '30px',
                // left: '0'

            });
            $('div#brand-filter').css('z-index','1000');
            $('div#brand-filter').css('background-color','rgb(255, 255, 255)');
            $('div#brand-filter').css('width','180px');

        } else {
            $('div#brand-filter').css({
                position: 'static'
            });
						$('div#brand-filter').css('width','100%');

        }

    });
}

// $(window).bind('scroll', function() {
//     if($(window).scrollTop() >= $('#foot-er').offset().top + $('#foot-er').outerHeight() - window.innerHeight) {
// 			$('div#brand-filter').css({
// 					position: 'static'
// 			});
// 			$('div#brand-filter').css('width','100%');
//     }
// });

$('input#shipping_insurance').on('click', function (e) {
	if ($('input#shipping_insurance').is(':checked')) {
		shipping_method();
	} else {
		shipping_method();
	}  
});

// mobile choose category brand in brand page
$('#brand-choose-mobile').on('click', function (e) {
    e.preventDefault();
    $('#brands-content').show("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'hidden');
    $('#navbar-mobile').fadeOut();
});

$('#close-brands-mobile').on('click', function (e) {
    e.preventDefault();
    $('#brands-content').hide("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'auto');
    $('#navbar-mobile').css('display', 'block');
});

$('#brand-koleksi-mobile').on('click', function (e) {
    e.preventDefault();
    $('#brands-collection-content').show("slide", {direction: "down"}, 500);
    // $('body').css('overflow', 'hidden');
    // $('#navbar-mobile').fadeOut();
});

$('#close-koleksi-mobile').on('click', function (e) {
    e.preventDefault();
    $('#brands-collection-content').hide("slide", {direction: "down"}, 500);
    // $('body').css('overflow', 'auto');
    // $('#navbar-mobile').css('display', 'block');
});

var sourceSwap = function () {
        var $this = $(this);
        var newSource = $this.data('alt-src');
        $this.data('alt-src', $this.attr('src'));
        $this.attr('src', newSource);
    }

    $(function() {
        $('img[data-alt-src]').each(function() {
            new Image().src = $(this).data('alt-src');
        }).hover(sourceSwap, sourceSwap);
    });

$(function(){
   $('#free').click(function(){
//       $('div#test').toggle(this.checked);
        if( $(this).is(':checked')) {
                $('#test').show();
//            alert("terklik");
        } else {
            $('#test').hide();
//            alert("unklik");
        }
   });
})
$(function(){
   $('#free1').click(function(){
       $('div#test1').toggle(this.checked);
   });
})
$('select.qty').on('change', function() {
    $("#free").prop("disabled", false);
    $("#free1").prop("disabled", false);

})
$('#free').on('change', function(){
   $('#addtocart').hide();
});
$('#free1').on('change', function(){
   $('#addtocart').hide();
});

$('input[name="freeStraps"]').on('change', function() {
//    $('#buttonRB').show();
//    $('#buttonRB2').show();
    var rbID = $('input[name="freeStraps"]:checked').attr('id'); //id Rb
    $('select[name="colors"]').val("0");
    $('select[name="colors"]').attr('disabled', true);
//    alert($('input[name="productName'+rbID+'"]').attr('value'));
    var colorAttr = rbID.replace("rb","colour"); //attr select colors
    $("#"+rbID.replace("rb","colour")).prop('disabled', false);
});
$('input[name="freeStraps2"]').on('change', function() {
//    $('#buttonRB').show();
    $('#buttonRB2').show();
    var rbID = $('input[name="freeStraps2"]:checked').attr('id'); //id Rb
    $('select[name="colors2"]').val("0");
    $('select[name="colors2"]').attr('disabled', true);
//    alert($('input[name="productName'+rbID+'"]').attr('value'));
    var colorAttr = rbID.replace("rb","colour"); //attr select colors
    $("#"+rbID.replace("rb","colour")).prop('disabled', false);
});

//$(function (){
////    $('#buttonRB').children().off('click');
//    $('#buttonRB').bind('click', false);
////    if($('input[name="freeStraps"]:checked').attr('id')){
////        $('#buttonRB').children().click();
////    }
//});

$('div#readmore').on('click', function(){
//    alert();
   $('div#left').show();
   $('div#right').show();
   $('div#readmore').hide();
});

$("#carousel-example-generic").carousel({interval: false});
$("#carousel-example-generics").carousel({interval: false});
$("#carousel-example-genericss").carousel({interval: false});
//$("#myCarousel").carousel({interval: false});

$("#myCarousel").swiperight(function () {
    $("#myCarousel").carousel('prev');
});

$("#myCarousel").swipeleft(function () {
    $("#myCarousel").carousel('next');
});

$('a#signup-hpn').on('click', function (e) {
    e.preventDefault();

    var email = $("input[name=signup_ch_email]").val(),
        firstname = $("input[name=firstname_checkout_signup]").val(),
        lastname = $("input[name=lastname_checkout_signup]").val(),
        password = $('input[name=signup_ch_password]').val(),
        phone = $('input[name=phone_number]').val(),
        gender = $('input[name=gender]').val(),
        birthday = document.getElementById('birth-year').value + '-' + document.getElementById('birth-month').value + '-' + document.getElementById('birth-date').value,
        cpassword = $('input[name=signup_ch_cpassword]').val();

    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-error').hide();
    }

    if (firstname === '') {
        $('span#firstname-checkout-error').show();
        $('span#firstname-checkout-error').html('* First Name Is Required!');
        return;
    } else {
        $('span#firstname-checkout-error').hide();
    }

    if (lastname === '') {
        $('span#lastname-checkout-error').show();
        $('span#lastname-checkout-error').html('* Last Name Is Required!');
        return;
    } else {
        $('span#lastname-checkout-error').hide();
    }

    if (phone === '') {
        $('span#phone-error').show();
        $('span#phone-error').html('* Phone Number Is Required!');
        return;
    } else {
        $('span#phone-error').hide();
    }

    if (password === '') {
        $('span#password-error').show();
        $('span#password-error').html('* Password Is Required!');
        return;
    } else {
        $('span#password-error').hide();
    }

    if (cpassword === '') {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Is Required!');
        return;
    } else if (cpassword !== password) {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Do Not Match!');
        return;
    } else {
        $('span#password-confirm-error').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/campaign/hpn',
        data: {"customerInfo": {
            "email": email,
            "fname": firstname,
            "lname": lastname,
            "password": password,
            "phone": phone,
            "gender": gender,
            "birth": birthday,
            "isNewCustomer": true
        }},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#signup-error').show();
                $('#loadingScreen').modal('hide');
                return;
            }
            $('#loadingScreen').modal('hide');
            window.location.href = baseUrl + '/hari-pelanggan-nasional/thankyou-page';
        }
    });
});

$("#search-mobile-query").keypress(function (e) {
    if (e.which == 13) {
        search_mobile(baseUrl + '/category/search?q=');
    }
});

$('.lifetime-bateray').on('click', function (e) {
    $("#lifetime").modal('show');
});

$('.installments').on('click', function (e) {
    e.preventDefault();
    $("#installment").modal('show');
});
$('.free-shipping').on('click', function (e) {
    e.preventDefault();
    $("#shipping").modal('show');
});

$("#search-mobile-query").keypress(function (e) {
    if (e.which == 13) {
        search_mobile(baseUrl + '/category/search?q=');
    }
});

$('#sorting-mobile').on('click', function (e) {
    e.preventDefault();
    $('#sorting-content').show("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'hidden');
    $('#navbar-mobile').fadeOut();
});

$('#sorting-pad').on('click', function (e) {
    e.preventDefault();
    $('#sorting-content').show("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'hidden');
    $('#navbar-mobile').fadeOut();
});


$('#close-sorting-mobile').on('click', function (e) {
    e.preventDefault();
    $('#sorting-content').hide("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'auto');
    $('#navbar-mobile').css('display', 'block');
});

$('#filter-mobile').on('click', function (e) {
    e.preventDefault();
    $('#filter-content').show("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'hidden');
    $('#navbar-mobile').fadeOut();
});

$('#filter-pad').on('click', function (e) {
    e.preventDefault();
    $('#filter-content').show("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'hidden');
    $('#navbar-mobile').fadeOut();
});

$('#close-filter-mobile').on('click', function (e) {
    e.preventDefault();
    $('#filter-content').hide("slide", {direction: "right"}, 500);
    $('body').css('overflow', 'auto');
    $('#navbar-mobile').css('display', 'block');
    $('#list-brand-mobile-menu').hide("slide", {direction: "right"}, 500);
        $('#list-price-mobile-menu').hide("slide", {direction: "right"}, 500); 
        $('#list-size-mobile-menu').hide("slide", {direction: "right"}, 500);   
        $('#list-type-mobile-menu').hide("slide", {direction: "right"}, 500); 
        $('#list-movement-mobile-menu').hide("slide", {direction: "right"}, 500);   
        $('#list-water-mobile-menu').hide("slide", {direction: "right"}, 500); 
        $('#list-bandwidth-mobile-menu').hide("slide", {direction: "right"}, 500);  
        $('#list-gender-mobile-menu').hide("slide", {direction: "right"}, 500);
});

// MENU MOBILE FILTER
$('#filter-brand-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-brand-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-brand-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-brand-mobile-menu').hide("slide", {direction: "right"}, 500);
});
$('#filter-price-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-price-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-price-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-price-mobile-menu').hide("slide", {direction: "right"}, 500);
});
$('#filter-size-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-size-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-size-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-size-mobile-menu').hide("slide", {direction: "right"}, 500);
});
$('#filter-type-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-type-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-type-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-type-mobile-menu').hide("slide", {direction: "right"}, 500);
});
$('#filter-movement-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-movement-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-movement-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-movement-mobile-menu').hide("slide", {direction: "right"}, 500);
});
$('#filter-water-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-water-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-water-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-water-mobile-menu').hide("slide", {direction: "right"}, 500);
});
$('#filter-bandwidth-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-bandwidth-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-bandwidth-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-bandwidth-mobile-menu').hide("slide", {direction: "right"}, 500);
});
$('#filter-gender-mobile-menu').on('click', function (e) {
    e.preventDefault();
    $('#list-gender-mobile-menu').show("slide", {direction: "right"}, 500);
});
$('#close-list-gender-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-gender-mobile-menu').hide("slide", {direction: "right"}, 500);
});

//menu mobile submenu slide

$('#account-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-account').show("slide", {direction: "right"}, 500);
});
$('#close-account').on('click', function (e) {
    e.preventDefault();
    $('#list-account').hide("slide", {direction: "right"}, 500);
});
$('#watches-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-watches').show("slide", {direction: "right"}, 500);
});
$('#close-watches').on('click', function (e) {
    e.preventDefault();
    $('#list-watches').hide("slide", {direction: "right"}, 500);
});
$('#watches-brands').on('click', function (e) {
    e.preventDefault();
    $('#list-watches-brands').show("slide", {direction: "right"}, 500);
});
$('#close-watches-brands').on('click', function (e) {
    e.preventDefault();
    $('#list-watches-brands').hide("slide", {direction: "right"}, 500);
});

$('#straps-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-straps').show("slide", {direction: "right"}, 500);
});
$('#close-straps').on('click', function (e) {
    e.preventDefault();
    $('#list-straps').hide("slide", {direction: "right"}, 500);
});
$('#straps-brands').on('click', function (e) {
    e.preventDefault();
    $('#list-straps-brands').show("slide", {direction: "right"}, 500);
});
$('#close-straps-brands').on('click', function (e) {
    e.preventDefault();
    $('#list-straps-brands').hide("slide", {direction: "right"}, 500);
});

$('#accessories-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-accessories').show("slide", {direction: "right"}, 500);
});
$('#close-accessories').on('click', function (e) {
    e.preventDefault();
    $('#list-accessories').hide("slide", {direction: "right"}, 500);
});
$('#accessories-brands').on('click', function (e) {
    e.preventDefault();
    $('#list-accessories-brands').show("slide", {direction: "right"}, 500);
});
$('#close-accessories-brands').on('click', function (e) {
    e.preventDefault();
    $('#list-accessories-brands').hide("slide", {direction: "right"}, 500);
});

$('#brands-mobile').on('click', function (e) {
    e.preventDefault();
    $('#list-brands').show("slide", {direction: "right"}, 500);
});
$('#close-list-brands').on('click', function (e) {
    e.preventDefault();
    $('#list-brands').hide("slide", {direction: "right"}, 500);
});

function sliding(event) {
    if (event != null) {
        
            $('#list-'+ event).show("slide", {direction: "right"}, 500);
        }
}
function close_sliding(event) {
    if (event != null) {
        
            $('#list-'+ event).hide("slide", {direction: "right"}, 500);
        }
}

// menu mobile


if ($('#btn-close-menu').hasClass('c-menu__close')) {
    var pushLeft = new Menu({
        wrapper: '#o-wrapper',
        type: 'push-left',
        menuOpenerClass: '.c-button',
        maskId: '#c-mask',
        navbar: '#navbar-mobile',
        close: function(){
            alert();
        }
    });

    var pushLeftBtn = document.querySelector('#c-button--push-left');

    pushLeftBtn.addEventListener('click', function (e) {

        e.preventDefault;
        pushLeft.open();

        $('html').css("position", "fixed");
        $('html').css("overflow", "hidden");

    });
}
// search mobile

$('#c-button--push-search').on('click', function (e) {
   
    var $t = $("#menu-search-mobile");
        if ($t.is(':visible')) {
             $("#menu-search-mobile").slideUp(300);
        } else {
            $("#menu-search-mobile").slideDown(300);
            $("#search-mobile-query").focus();
        }
     e.preventDefault();
});

/**
 * Push right instantiation and action.
 */
var pushRight = new Menu({
    wrapper: '#o-wrapper',
    type: 'push-right',
    menuOpenerClass: '.c-button',
    maskId: '#c-mask'
});

var pushRightBtn = document.querySelector('#c-button--push-right');

pushRightBtn.addEventListener('click', function (e) {
    e.preventDefault;
    pushRight.open();
});

function filter_mobile() {
    var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            size_param = [],
            price_param = [],
                        gender_param = [],
                        type_param = [],
                        water_param = [],
                        bandwidth_param = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_fil = '',
            price_fil = '',
                        gender_fil = '',
                        type_fil = '',
                        water_fil = '',
                        bandwidth_fil = '',

            category_name = '',
            selected = '',
            category_active = '',
            old_category_name = '';

    var found = false;

    $('input:checkbox[name=brands_mobile]:checked').each(function () {

        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    $('input:checkbox[name=category_mobile]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category_mobile]:checked').length; i++) {
            selected = $('input:checkbox[name=category_mobile]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

		$('input:checkbox[name=size_mobile]:checked').each(function () {
            size_param.push(this.value);

            if (found) {
                size_fil = '&size=' + size_param.join('--');
            } else {
                size_fil = '&size=' + size_param.join('--');
                found = true;
            }
				
		});

    $('input:checkbox[name=gender_mobile]:checked').each(function () {
            gender_param.push(this.value);

            if (found) {
                gender_fil = '&gender=' + gender_param.join('--');
            } else {
                gender_fil = '&gender=' + gender_param.join('--');
                found = true;
            }
        
    });



		$('input:checkbox[name=bandwidth_mobile]:checked').each(function () {
            bandwidth_param.push(this.value);

            if (found) {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
            } else {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
                found = true;
            }
				
		});

		$('input:checkbox[name=type_mobile]:checked').each(function () {
            type_param.push(this.value);

            if (found) {
                type_fil = '&type=' + type_param.join('--');
            } else {
                type_fil = '&type=' + type_param.join('--');
                found = true;
            }
				
		});

		$('input:checkbox[name=water_mobile]:checked').each(function () {
            water_param.push(this.value);

            if (found) {
                water_fil = '&water=' + water_param.join('--');
            } else {
                water_fil = '&water=' + water_param.join('--');
                found = true;
            }
				
		});

    $('input:radio[name=sort_mobile]:checked').each(function () {
        sort.push(this.value);

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = '&sort=' + sort.join('--');
            found = true;
        }
    });

   if (found) {
       price_param = '&price=' + minPrice + '--' + maxPrice;
   } else {
       price_param = '&price=' + minPrice + '--' + maxPrice;
   }

  //  params = brands_param + size_param + category_param + sort_param + price_param;

    //console.log(params);

  //  window.location.href = baseUrl + '/category/filter?' + params;

		params = brands_param + size_fil + bandwidth_fil + gender_fil + type_fil + water_fil + category_param + sort_param + price_param;
		pagination = '&page=1&limit=20';

		//console.log(params);
		window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;
}

function clear_filter_mobile() {
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
    $(':checkbox, :radio').prop('checked', false);
    $('#all-product-mobile').prop('checked', true);
}

$('input#submit-kredivo').on('click', function (e) {

	//console.log(paramsKredivo);

    e.preventDefault();

	// sandbox
    $.ajax({
        type: "POST",
        url: sandboxKredivoUri,
        data: JSON.stringify(paramsKredivo),
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
			var d = data;
            $('#loadingScreen').modal('hide');

			if(d.status == "OK"){
				window.location.href = d.redirect_url;
			}
        }
    });
});

function slidedown(event) {
    if (event != null) {
        if ($('#list-' + event).hasClass("non-active")) {
            $('#list-' + event).slideDown();
            $('#list-' + event).removeClass("non-active");
            $('#list-' + event).addClass("active");
            $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/top-spec.png">');
        }
        else {
            $('#list-' + event).slideUp();
            $('#list-' + event).removeClass("active");
            $('#list-' + event).addClass("non-active");
            $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/down-spec.png">');
        }
    }
}

function slidedown_filter(event) {
    if (event != null) {
        if ($('#list-' + event).hasClass("non-active")) {
            $('#list-' + event).slideDown();
            $('#list-' + event).removeClass("non-active");
            $('#list-' + event).addClass("active");
            $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + ' arrow-filter" src="/img/icons/top-spec.png">');
        }
        else {
            $('#list-' + event).slideUp();
            $('#list-' + event).removeClass("active");
            $('#list-' + event).addClass("non-active");
            $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + ' arrow-filter" src="/img/icons/down-spec.png">');
        }
    }
}

function menuFAQ(event) {
    if (event != null) {
        if (event == 'ordering') {
            $('#ordering').fadeIn();
            $('#shipping').hide();
            $('#ordering-menu').removeClass("active");
            $('#shipping-menu').removeClass("active");
            $('#ordering-menu').addClass("active");
        }
        else if (event == 'shipping') {
            $('#ordering').hide();
            $('#shipping').fadeIn();
            $('#ordering-menu').removeClass("active");
            $('#shipping-menu').removeClass("active");
            $('#shipping-menu').addClass("active");
        }
    }
}

function changeQuantity(count_id, id, attribute_id) {
    var qty = document.getElementById('quantity-' + id + '-' + attribute_id).value;
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/editquantitymobile',
        data: {
            "count_id": count_id,
            "id": id,
            "attribute_id": attribute_id,
            "qty": qty
        },
        dataType: 'json',
        success: function (data) {
            $('span#item-quantity-' + id).empty();
                    $('span#item-quantity-mob-' + id).empty();
//                    $('#item-price-' + id).empty();
                    $('#item-total').empty();
                    $('#item-total1').empty();
                    $('#total-purchase').empty();
                    $('span#ongkir').empty();

                    $('#overload-quantity-' + id).fadeOut();

                    $("span#item-quantity-" + id).text(data[0]);
                    $("span#item-quantity-mob-" + id).text(data[0]);
//                    $("#item-price-" + id).text(data[1]);
                    $("#item-total").text('IDR '+data[2]);
                    $("#item-total1").text('IDR '+data[2]);
                    $("#total-purchase").text('IDR '+data[2]);
                    $('span#ongkir').text('IDR ' + data[4]);
        }
    });
}

function login_signup_menu() {
    $('#main-menu').hide();
    $('#login-signup-menu').fadeIn();
}

function main_menu() {
    $('#login-signup-menu').hide();
    $('#main-menu').fadeIn();
}

function forgot_password() {
    $('#login-mobile').hide();
    $('#forgot-password-mobile').fadeIn();
}

function signup_box(event) {
    if (event == 'signup') {
        $('#login-box').removeClass('bg9f8562');
        $('#signup-box-mobile').removeClass('bg-white-text-black');
        $('#login-box').addClass('bg-white-text-black');
        $('#signup-box-mobile').addClass('bg9f8562');
        $('#login-form').hide();
        $('#signup-form-mobile').show();
    }
    else if (event == 'login') {
        $('#signup-box-mobile').removeClass('bg9f8562');
        $('#login-box').removeClass('bg-white-text-black');
        $('#signup-box-mobile').addClass('bg-white-text-black');
        $('#login-box').addClass('bg9f8562');
        $('#signup-form-mobile').hide();
        $('#login-form').show();
    }
}

function log_in_mobile() {
    var email = $('input[name=email_login_mobile]').val(),
            password = $('input[name=password_login_mobile]').val();

    if (email === '') {
        $('#email-login-error-mobile').show();
        $('#email-login-error-mobile').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('#email-login-error-mobile').show();
        $('#email-login-error-mobile').html('* Email Is Not Valid!');
        return;
    } else {
        $('#email-login-error-mobile').hide();
    }

    if (password === '') {
        $('#password-login-error-mobile').show();
        $('#password-login-error-mobile').html('* Password Is Required!');
        return;
    } else {
        $('#password-login-error-mobile').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/sign-in',
        data: {
            "email": $('input[name=email_login_mobile]')[0].value,
            "password": $('input[name=password_login_mobile]')[0].value
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#signintop-error').show();
                return;
            }

            window.location.href = baseUrl + '/user/profile';
        }
    });
}

function signup_mobile() {
    var email = $('input[name=email_signup_mobile]').val(),
            fname = $('input[name=firstname_signup_mobile]').val(),
            password = $('input[name=password_signup_mobile]').val();

    if (email === '') {
        $('#email-signup-error-mobile').show();
        $('#email-signup-error-mobile').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('#email-signup-error-mobile').show();
        $('#email-signup-error-mobile').html('* Email Is Not Valid!');
        return;
    } else {
        $('#email-signup-error-mobile').hide();
    }

    if (fname === '') {
        $('#firstname-signup-error-mobile').show();
        $('#firstname-signup-error-mobile').html('* First Name Is Required!');
        return;
    } else {
        $('#firstname-signup-error-mobile').hide();
    }

    if (password === '') {
        $('#password-signup-error-mobile').show();
        $('#password-signup-error-mobile').html('* Password Is Required!');
        return;
    } else {
        $('#password-signup-error-mobile').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/sign-up',
        data: {
            "customerInfo": {
                "email": $('input[name=email_signup_mobile]')[0].value,
                "fname": $('input[name=firstname_signup_mobile]')[0].value,
                "lname": '',
                "password": $('input[name=password_signup_mobile]')[0].value,
                "newsletter": $('input[name=subscribe_signup_mobile]')[0].value
            }
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#signuptop-error').show();
                return;
            }

            location.reload();
        }
    });
}

function journal_category() {
    var url = $('#journal-menu').val();
    if (url) {
        window.location = url;
    }
    return false;
}

function profile_menu() {
    var url = $('#profile-menu').val();
    if (url) {
        window.location = url;
    }
    return false;
}

function search_mobile(base) {
    var url = $('#search-mobile-query').val();
    if (url) {
        window.location = base + url;
    }
    return false;
}

// addtocartFree
$('a.addtocartFree').on('click', function (e) {
    e.preventDefault();

    var id = $(this).attr("data-id");

    if ($('select[name=straps-color-' + id + ']').length && !$('select[name=straps-color-' + id + ']').is(':disabled')) {
        // validate if user not choosing color
        if ($('select[name=straps-color-' + id + ']')[0].value === "0") {
            alert('Please Select Color!');
            return;
        }
    }

    var attribute_value_id = $('select[name=straps-color-' + id + ']').length && !$('select[name=straps-color-' + id + ']').is(':disabled') ? $('select[name=straps-color-' + id + ']')[0].value : '',
            //id = $('input[name=product_free_id]')[0].value,
            reference = '',
            product_attribute_id = $('select[name=straps-color-' + id + ']').length && !$('select[name=straps-color-' + id + ']').is(':disabled') ? $('select[name=straps-color-' + id + '] option:selected').attr("attributeId") : 0,
            quantity = 1,
            name = $('input[name=product_free_name_' + id + ']')[0].value,
            price = 0,
            brandName = $('input[name=brand_name_free_' + id + ']')[0].value,
            url = $('input[name=link-rewrite-free-' + id + ']')[0].value,
            color = $('select[name=straps-color-' + id + ']').length && !$('select[name=straps-color-' + id + ']').is(':disabled') ? $('select[name=straps-color-' + id + '] option:selected').text() : '',
            weight = $('input[name=weight_free_' + id + ']')[0].value,
            imageUrl = $('img#' + id).attr('src');

	var cartItem = [];

	cartItem.push({
            "id": id,
            "name": $('input[name=product_free_name_' + id + ']')[0].value,
            "price": price,
            "brand": brandName,
            "category": $('input[name=productCategoryFree_' + id + ']')[0].value,
            "quantity": quantity
	});

	sendAddToCartClick(cartItem);

    var items = [{
        "id": id,
        "product_attribute_id": product_attribute_id,
        "reference": reference,
        "name": name,
        "brand_name": brandName,
        "unit_price": price,
        "total_price": (price * quantity),
        "attribute_value_id": attribute_value_id,
        "color": color,
        "quantity": quantity,
        "weight": weight,
        "url": baseUrl + '/product/' + url,
        "productFreeCampaign" : true,
        "image": {
            "url": imageUrl
        }
    }];

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/add-item',
        dataType: 'json',
        data: {"cart": {
                "items": items
            }},
        success: function (data) {
            $("div#box-cart").html(data[0]);
            $("div#menu-cart-mobile").html(data[1]);
            pushRight.open();
            $("#arrow-cart").slideDown();
            $("#box-cart").slideDown();
            $("html, body").animate({scrollTop: 0}, "slow");
        }
    });
});

// addtocart click button trigger
$('a.addtocartCampaign').on('click', function (e) {
    e.preventDefault();

    if ($('select.color').length && !$('select.color').is(':disabled')) {
        // validate if user not choosing color
        if ($('select.color')[0].value === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Color');

            return;
        }
    }

    if ($('select.qty').length) {
        // validate if user not choosing quantity
        if ($('select.qty')[0].value === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Quantity');

            return;
        }
    }

    var attribute_value_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color')[0].value : '',
            id = $('input[name=product_id]')[0].value,
            reference = '',
            product_attribute_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').attr("attributeId") : 0,
            quantity = $('select.qty')[0].value,
            name = $('input[name=product_name]')[0].value,
            price = $('input[name=price]')[0].value,
            brandName = $('input[name=brand_name]')[0].value,
            url = $('input[name=link-rewrite]')[0].value,
            color = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').text() : '',
            weight = $('input[name=weight]')[0].value,
            imageUrl = $('select.color').length && !$('select.color').is(':disabled') ? $('a[id=' + attribute_value_id + ']').attr("data-image") : $('a[id=0]').attr("data-image");

	var cartItem = [];

	cartItem.push({
		"id": id,
		"name": $('input[name=product_name]')[0].value,
		"price": price,
		"brand": brandName,
		"category": $('input[name=productCategory]')[0].value,
		"quantity": quantity
	});

	sendAddToCartClick(cartItem);

    var items = [{
        "id": id,
        "product_attribute_id": product_attribute_id,
        "reference": reference,
        "name": name,
        "brand_name": brandName,
        "unit_price": price,
        "total_price": (price * quantity),
        "attribute_value_id": attribute_value_id,
        "color": color,
        "quantity": quantity,
        "weight": weight,
        "url": baseUrl + '/product/' + url,
        "productCampaign" : true,
        "image": {
            "url": imageUrl
        }
    }];

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/add-item',
        dataType: 'json',
        data: {"cart": {
                "items": items
            }},
        success: function (data) {
            $("div#box-cart").html(data[0]);
            $("div#menu-cart-mobile").html(data[1]);
            pushRight.open();
            $("#arrow-cart").slideDown();
            $("#box-cart").slideDown();
            $("html, body").animate({scrollTop: 0}, "slow");
        }
    });
});

$('a.addtocartevent').on('click', function (e) {

//    $('input[name="freeStraps"]').attr('disabled', false);
//    $('input[name="freeStraps2"]').attr('disabled', false);


    e.preventDefault();

    if ($('select.color').length && !$('select.color').is(':disabled')) {
        $col_value = $('select.color')[0].value.split("+");
        // validate if user not choosing color
        if ($col_value[0] === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Color');

            return;
        }
    }

    if ($('select.size').length && !$('select.size').is(':disabled')) {
        $col_value = $('select.size')[0].value.split("+");
        // validate if user not choosing color
        if ($col_value[1] === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Size');

            return;
        }
    }

    if ($('select.qty').length) {
        // validate if user not choosing quantity
        if ($('select.qty')[0].value === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Quantity');

            return;
        }
    }
    if($('input[name="freeStraps"]:checked').attr('id')){
        var rbID = $('input[name="freeStraps"]:checked').attr('value');
    }
    if($('input[name="freeStraps2"]:checked').attr('id')){
        var rbID2 = $('input[name="freeStraps2"]:checked').attr('value');
    }
//    alert(rbID);
        $col_value = $('select.color')[0].value.split("+");

    var attribute_value_id = $('select.color').length && !$('select.color').is(':disabled') ? $col_value[0] : '',
            id = $('input[name=product_id]')[0].value,
            reference = '',
            product_attribute_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').attr("attrId") : $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').attr("attrId") : 0,
            quantity = $('select.qty')[0].value,
            name = $('input[name=product_name]')[0].value,
            price = $('input[name=price]')[0].value,
            brandName = $('input[name=brand_name]')[0].value,
            url = $('input[name=link-rewrite]')[0].value,
            color = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').text() : '',
            size = $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').text() : '',
            weight = $('input[name=weight]')[0].value,
            imageUrl = $('select.color').length && !$('select.color').is(':disabled') ? $('a[id=' + attribute_value_id + ']').attr("data-image") : $('a[id=0]').attr("data-image");

    var cartItem = [];

    cartItem.push({
        "id": id,
        "name": $('input[name=product_name]')[0].value,
        "price": price,
        "brand": brandName,
        "category": $('input[name=productCategory]')[0].value,
        "quantity": quantity
    });

    sendAddToCartClick(cartItem);
//    var itemStraps = [{
//
//    }];

    var items = [{
            "id": id,
            "rbID": rbID,
            "rbID2": rbID2,
            "product_attribute_id": product_attribute_id,
            "reference": reference,
            "name": name,
            "brand_name": brandName,
            "unit_price": price,
            "total_price": (price * quantity),
            "attribute_value_id": attribute_value_id,
            "color": color,
            "size": size,
            "quantity": quantity,
            "weight": weight,
            "flag":true,
            "url": baseUrl + '/product/' + url,
            "image": {
                "url": imageUrl
            },
        }];
    /*var items2 = [{
            "rbID":rbID,
            "rbName":rbName,
            "rbPrice":rbPrice,
            "rbCateg":rbCateg,
            "rbImage":rbImage,
            "rbwarna":rbwarna
    }]*/

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/add-item',
        dataType: 'json',
        data: {"cart": {
                "items": items,
//                "items2":items2

            }},
        beforeSend: function () {
                                                        $('#loadingScreen').modal('show');
                                                    },
        success: function (data) {
            $('#loadingScreen').modal('hide');
            $("div#box-event-open").html(data[2]);
            $("#box-event").modal('show');
            // $("div#menu-cart-mobile").html(data[1]);
            // pushRight.open();
            // $("#arrow-cart").slideDown();
            // $("#box-cart").slideDown();
            // $("html, body").animate({scrollTop: 0}, "slow");
        }
    });
});

// addtocart click button trigger
$('a.addtocart').on('click', function (e) {

//    $('input[name="freeStraps"]').attr('disabled', false);
//    $('input[name="freeStraps2"]').attr('disabled', false);


    e.preventDefault();

    if ($('select.color').length && !$('select.color').is(':disabled')) {
        $col_value = $('select.color')[0].value.split("+");
        // validate if user not choosing color
        if ($col_value[0] === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Color');

            return;
        }
    }

    if ($('select.size').length && !$('select.size').is(':disabled')) {
        $col_value = $('select.size')[0].value.split("+");
        // validate if user not choosing color
        if ($col_value[1] === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Size');

            return;
        }
    }

    if ($('select.qty').length) {
        // validate if user not choosing quantity
        if ($('select.qty')[0].value === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Quantity');

            return;
        }
    }
    if($('input[name="freeStraps"]:checked').attr('id')){
        var rbID = $('input[name="freeStraps"]:checked').attr('value');
    }
    if($('input[name="freeStraps2"]:checked').attr('id')){
        var rbID2 = $('input[name="freeStraps2"]:checked').attr('value');
    }
//    alert(rbID);
    $col_value = $('select.color')[0].value.split("+");

    var attribute_value_id = $('select.color').length && !$('select.color').is(':disabled') ? $col_value[0] : '',
            id = $('input[name=product_id]')[0].value,
            reference = '',
            product_attribute_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').attr("attrId") : $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').attr("attrId") : 0,
            quantity = $('select.qty')[0].value,
            name = $('input[name=product_name]')[0].value,
            price = $('input[name=price]')[0].value,
            brandName = $('input[name=brand_name]')[0].value,
            url = $('input[name=link-rewrite]')[0].value,
            color = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').text() : '',
            size = $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').text() : '',
            weight = $('input[name=weight]')[0].value,
            imageUrl = $('select.color').length && !$('select.color').is(':disabled') ? $('a[id=' + attribute_value_id + ']').attr("data-image") : $('a[id=0]').attr("data-image");

	var cartItem = [];

	cartItem.push({
		"id": id,
		"name": $('input[name=product_name]')[0].value,
		"price": price,
		"brand": brandName,
		"category": $('input[name=productCategory]')[0].value,
		"quantity": quantity
	});

	sendAddToCartClick(cartItem);
//    var itemStraps = [{
//
//    }];

    var items = [{
            "id": id,
            "rbID": rbID,
            "rbID2": rbID2,
            "product_attribute_id": product_attribute_id,
            "reference": reference,
            "name": name,
            "brand_name": brandName,
            "unit_price": price,
            "total_price": (price * quantity),
            "attribute_value_id": attribute_value_id,
            "color": color,
            "size": size,
            "quantity": quantity,
            "weight": weight,
            "flag":true,
            "url": baseUrl + '/product/' + url,
            "image": {
                "url": imageUrl
            },
        }];
    /*var items2 = [{
            "rbID":rbID,
            "rbName":rbName,
            "rbPrice":rbPrice,
            "rbCateg":rbCateg,
            "rbImage":rbImage,
            "rbwarna":rbwarna
    }]*/

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/add-item',
        dataType: 'json',
        data: {"cart": {
                "items": items,
//                "items2":items2

            }},
        success: function (data) {
            $("div#box-cart").html(data[0]);
            $("div#menu-cart-mobile").html(data[1]);
            pushRight.open();
            $("#arrow-cart").slideDown();
            $("#box-cart").slideDown();
            $("html, body").animate({scrollTop: 0}, "slow");
        }
    });
});

/*for hide erros massage not choose color straps*/
$('.newclass').on('change', function () {
    $("#newerror").css({"display": "none"});
});
$('.newclass').on('change', function () {
    $("#newerror2").css({"display": "none"});
});
/*----------------------------------------------*/

$('#addfreeitem').on('click', function (e) {

    if ($('input[name="freeStraps"]:checked').attr('attr') == "1") {
        if ($('select[name=colors]').val()==0) {
            $("#newerror").css({"display": "block"});
            return;
        }
//        else {
//            $("#newerror").css({"display": "none"});
//        }
    }

    if($('input[name="freeStraps"]:checked').attr('id')){


        var numberOfCheckedRadio = $('input[name="freeStraps"]:checked').length
        var rbID = $('input[name="freeStraps"]:checked').attr('value');
        var rbName = $('input[name="productName'+rbID+'"]').attr('value');
        var rbPrice = $('input[name="productPrice"]').attr('value');
        var rbCateg = $('input[name="brandName'+rbID+'"]').attr('value');
        var link = $('a[name="link'+rbID+'"]').attr('href');
        var rbImage = $('img[name="image'+rbID+'"]').attr('src');
        var rbwarna = $('select#colour'+rbID+' option:selected').text();

        var items = [{
            "id":rbID,
            "name":rbName,
            "total_price":rbPrice,
            "brand_name":rbCateg,
//            "images":rbImage,
            "color":rbwarna,
            "quantity":numberOfCheckedRadio,
            "url": baseUrl + '/product/' + link,
            "flag":true,
            "image": {
                "url": rbImage
            },
        }]

        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/add-item',
            dataType: 'json',
            data: {"cart": {
                    "items": items,
    //                "items2":items2

                }},
            success: function (data) {
                $("div#box-cart").html(data[0]);
                $("div#menu-cart-mobile").html(data[1]);
                pushRight.open();
                $("#arrow-cart").slideDown();
                $("#box-cart").slideDown();
                $("html, body").animate({scrollTop: 0}, "slow");
            }
        });

    }else{

    }
});

$('#addfreeitem2').on('click', function (e) {

  if ($('input[name="freeStraps2"]:checked').attr('attr') == "1") {
        if ($('select[name=colors2]').val()==0) {
            $("#newerror2").css({"display": "block"});
            return;
        }
//        else {
//            $("#newerror2").css({"display": "none"});
//        }
    }


    if($('input[name="freeStraps2"]:checked').attr('id')){

        var numberOfCheckedRadio = $('input[name="freeStraps2"]:checked').length
        var rbID = $('input[name="freeStraps2"]:checked').attr('value');
        var rbName = $('input[name="productName'+rbID+'"]').attr('value');
        var rbPrice = $('input[name="productPrice'+rbID+'"]').attr('value');
        var rbCateg = $('input[name="brandName'+rbID+'"]').attr('value');
        var link = $('a[name="link'+rbID+'"]').attr('href');
        var rbImage = $('img[name="image'+rbID+'"]').attr('src');
        var rbwarna = $('select#colour'+rbID+' option:selected').text();

        var items = [{
            "id":rbID,
            "name":rbName,
            "total_price":rbPrice,
            "brand_name":rbCateg,
//            "image":rbImage,
            "color":rbwarna,
            "quantity":numberOfCheckedRadio,
            "url": baseUrl + '/product/' + link,
            "flag":true,
            "image": {
                "url": rbImage
            },
        }]

        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/add-item',
            dataType: 'json',
            data: {"cart": {
                    "items": items,
    //                "items2":items2

                }},
            success: function (data) {
                $("div#box-cart").html(data[0]);
                $("div#menu-cart-mobile").html(data[1]);
                pushRight.open();
                $("#arrow-cart").slideDown();
                $("#box-cart").slideDown();
                $("html, body").animate({scrollTop: 0}, "slow");
            }
        });

    }else{

    }


});

$('a.productClick').on('click', function (e) {
	//e.preventDefault();

	var items = [],
        opt_list = $(this).children('input[name=opt_list]')[0].value;

    items.push({
        "id": $(this).children('input[name=productId]')[0].value,
        "name": $(this).children('input[name=productName]')[0].value,
        "price": $(this).children('input[name=productPrice]')[0].value,
	"brand": $(this).children('input[name=brandName]')[0].value,
        "category": $(this).children('input[name=productCategory]')[0].value,
        "position": $(this).children('input[name=productPosition]')[0].value
    });

    sendProductClick(items, opt_list);
});

$('a#homeBannerClick').on('click', function (e) {
	//e.preventDefault();

	var items = [];

	items.push({
		"id": $(this).children('img').attr('alt'),
		"name": $(this).children('img').attr('alt'),
		"creative": "Homebanner",
		"position": "center"
	});

	sendPromotionClick(items);
});

$('a.productClickRelated').on('click', function (e) {
	//e.preventDefault();

	var items = [];

    items.push({
        "id": $(this).children('input[name=productId]')[0].value,
        "name": $(this).children('input[name=productName]')[0].value,
        "price": $(this).children('input[name=productPrice]')[0].value,
		"brand": $(this).children('input[name=brandName]')[0].value,
        "category": $(this).children('input[name=productCategory]')[0].value,
        "position": $(this).children('input[name=productPosition]')[0].value
    });

    sendProductClick(items, 'related items');
});

// $('a.apply-code').on('click', function (e) {

//     e.preventDefault();

//     var code = $('input[name=code]').val();
//     var total = $('span#total-price');

//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         url: baseUrl + '/cart/voucher/check',
//         data: {"code": code},
//         beforeSend: function () {

//         },
//         success: function (data) {
// //            console.log(data);
//             var d = data;
//             if (d.valid) {
//                 $('span#discount').html(d.currency + ' ' + d.discount);
//                 $('span#total-price').html(d.currency + ' ' + d.total);

//                 grossamount = d.total;
// 				grossamount = d.total.split('.').join("");
//             } else {
// 				$('span.voucher-message').html(d.message);
// 			}
//         }
//     });

// });

$('select#payment_method').on('change', function () {
    // validate if user selected color
    if ($('select#payment_method')[0].value !== "0") {
        var payment_method_id = $('select#payment_method')[0].value;
        $.ajax({
            type: "GET",
            url: baseUrl + '/cart/payment/get-payment-list/' + payment_method_id,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('.creditcardform').hide();
                $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('div.payment').html(data);
            }
        });
    }
});

function choose_payment(id,method_id){
  $('#mf_frame').css("border","none");
  $('#cc_frame').css("border","none");
  $('#bt_frame').css("border","none");
  $('#i_frame').css("border","none");
  $('#va_frame').css("border","none");
  $('#payment-info').css('display','block');
  var $window = $(window);

    $.ajax({
            type: "POST",
            url: baseUrl + '/cart/payment/get-payment-detail/',
            data: {
                "id": id,
                "method_id": method_id,
               
            },
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('.creditcardform').hide();
                $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('div#metode-preview').css("border","none");
                $('.shopping-bag.creditcardform').css('padding-left','30px');
                $('.shopping-bag.creditcardform').css('padding-right','30px');
                $('.shopping-bag.creditcardform').css('padding-top','20px');
                $('.shopping-bag.creditcardform').css('padding-bottom','20px');
                $('div#metode-preview').html(data);
              if($window.width() > 767){
                if(method_id == 1){
                    $('#bt_frame').css("border","solid 2px rgb(32,97,103)");
                    $('div#metode-preview').css("border","solid 2px rgb(32,97,103)");
                    $('div.unique.separator').show();
                    $('div.total-with-trf').show();
                    $('div.total-without-trf').hide();
                }else{
                    $('div.unique.separator').hide();
                    $('div.total-with-trf').hide();
                    $('div.total-without-trf').show();
                }
                if(method_id == 4){
                  $('#mf_frame').css("border","solid 2px rgb(32,97,103)");
                  $('div#metode-preview').css("border","solid 2px rgb(32,97,103)");
                  $("#kredivoModal").modal("show");
                }
                if(method_id == 2){
                  $('#cc_frame').css("border","solid 2px rgb(32,97,103)");
                  if(grossamount == 0){
                    alert('Payment Credit Card not allowed with grand total 0');
                    $('#payment-info').css('display','none');
                  }
               
                }
                if(method_id == 3){
                  $('#i_frame').css("border","solid 2px rgb(32,97,103)");
               
                }
                if(method_id == 5){
                  $('#mf_frame').css("border","solid 2px rgb(32,97,103)");
                  $('div#metode-preview').css("border","solid 2px rgb(32,97,103)");
               
                }
                if(method_id == 6){
                  $('#va_frame').css("border","solid 2px rgb(32,97,103)");
                  $('div#metode-preview').css("border","solid 2px rgb(32,97,103)");
               
                }
              }else{
                $('#mf_frame').css("display","none");
                $('#cc_frame').css("display","none");
                $('#bt_frame').css("display","none");
                $('#i_frame').css("display","none");
                $('#va_frame').css("display","none");
                $('.metode-lain').css("display","block");
                $('.padding-all-method').css("display","none");
                $('.payment-detail-mobile').css("display","none");
                $('.payment-detail-mobile-close').css("display","block");
                $('.payment-layout-3').css("display","block");
                $('.payment-layout-3').css("margin-top","-5px");
                if(method_id == 1){
                    $('#bt_frame').css("display","block");
                    $('div.unique.separator').show();
                    $('div.total-with-trf').show();
                    $('div.total-without-trf').hide();
                }else{
                    $('div.unique.separator').hide();
                    $('div.total-with-trf').hide();
                    $('div.total-without-trf').show();
                }
                if(method_id == 2){
                  // $('#cc_frame').css("display","block");
                  // $('#back-credit').css("display","block");
                  // $('#back-credit').css("display","block");
                  if(grossamount == 0){
                    alert('Payment Credit Card not allowed with grand total 0');
                    $('#payment-info').css('display','none');
                  }
                }
                if(method_id == 3){
                  $('#i_frame').css("display","block");
                }
                if(method_id == 4){
                  $('#mf_frame').css("display","block");
                  $("#kredivoModal").modal("show");
                }
                if(method_id == 5){
                  $('#mf_frame').css("display","block");
                }
                if(method_id == 6){
                  $('#va_frame').css("display","block");
                }
              }
            }
        });
    
}

function choose_installment_plan(id){
  var bank = id;
  if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19) {
    
            $("#installmentform").modal("show");
    
  }
}

function all_method(){
  $('#mf_frame').css("display","block");
                $('#cc_frame').css("display","block");
                $('#bt_frame').css("display","block");
                $('#i_frame').css("display","block");
                $('#va_frame').css("display","block");
                $('.metode-lain').css("display","none");
                $('.padding-all-method').css("display","block");
                $('.payment-detail-mobile').css("display","block");
                $('.payment-detail-mobile-close').css("display","none");
                $('.payment-layout-3').css("display","none");
  $("input:radio[name='payment_method']").each(function(i) {
         this.checked = false;
  });
}

$('select#shipping_method').on('change', function () {
    // validate if user selected color
    if ($('select#shipping_method')[0].value !== "0") {
        var carrier_cost_id = $('select#shipping_method')[0].value;
        $.ajax({
            type: "GET",
            url: baseUrl + '/cart/checkout/get-shipping-list/' + carrier_cost_id,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('.creditcardform').hide();
                $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('div.payment').html(data);
            }
        });
    }
});

$('input.payment_method_d').on('change', function () {
    // validate if user selected color
    // if ($('input#payment_method')[0].value !== "0") {
        var payment_method_id = $('input[type="radio"]:checked').val();
        $.ajax({
            type: "GET",
            url: baseUrl + '/cart/payment/get-payment-list/' + payment_method_id,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('.creditcardform').hide();
                $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('div.payment').html(data);
                if(payment_method_id == 1){
                    $('div.unique.separator').show();
                    $('div.total-with-trf').show();
                    $('div.total-without-trf').hide();
                }else{
                    $('div.unique.separator').hide();
                    $('div.total-with-trf').hide();
                    $('div.total-without-trf').show();
                }
                
            }
        });
    // }
});

// method_unique($id) {
//     // validate if user selected color
//     // if ($('input#payment_method')[0].value !== "0") {
//         var payment_id = $('input[type="radio"]:checked').val();
//         $.ajax({
//             type: "GET",
//             url: baseUrl + '/cart/payment/paymenttransfer/' + payment_id,
//             beforeSend: function () {
//                 $('#loadingScreen').modal('show');
//             },
//             success: function (data) {
//                 // $('.creditcardform').hide();
//                 // $('.installmentform').hide();
//                 $('#loadingScreen').modal('hide');
//                 $('div.unique_code').html(data);
//             }
//         });
//     // }
// };

$('select#installmentplan').on('change', function () {
    var plan = $('select#installmentplan option:selected')[0].value,
            bank = $('input:radio[data-id=ip]:checked')[0].value;

    // bank mandiri ke veritrans
    if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19) {
        $('.creditcardform').show();
    }
});

$('a#payment-info').on('click', function (e) {
    e.preventDefault();

	var sendAsGift = 0,
        gift_message = '';


    if ($('#send_as_gift').is(":checked")) {
        sendAsGift = 1;
        gift_message = $('textarea#gift_message').val();
    }

    if ($('input:radio:checked').length < 1) {
        $('div.payment-error').show();
        return false;
    }

    if ($('input:radio[name=payment_method]:checked').length == 0) {
        $('div.payment-error').show();
        return false;
    }

    if (!$('#agreement').is(":checked")) {
        $('div.agreement-error').show();
        return false;
    }
    
    $('#metode-preview').css("border","none");
    $('.shopping-bag.creditcardform').css('padding-left','30px');
    $('.shopping-bag.creditcardform').css('padding-right','30px');
    
    if ($('input:radio[data-id=cc]').is(':checked')) {
        $(function () {
            // Sandbox Parameter
//            Veritrans.url = "https://api.sandbox.veritrans.co.id/v2/token";
//            Veritrans.client_key = "VT-client-mjABlnYixiNp15XZ";
            
            if($('.credit-valid').html() == '' || $('.credit-length').html() == '' || $('.credit-luhn').html() == ''){
              $('.cardholder.card-number.credit').css("border","solid 2px rgb(161,29,33)");
           
                  return false;
              }
              if($('.cardholder.card-cvv').val().length < 3){
                  $('.cardholder.card-cvv').css("border","solid 2px rgb(161,29,33)");
     
                  return false;
              }
             
              
            Veritrans.url = "https://api.veritrans.co.id/v2/token";
            Veritrans.client_key = "VT-client-_rz55Hanv0PtThrX";

            // $('input[name=payment_id]').val($('input:radio[name=payment_method]:checked')[0].value);
            $('input[name=payment_method_id]').val($('input:radio[name=payment_method]:checked').attr("method-id"));
            var card = function () {
                return {
                    "card_number": $('.card-number').val(),
                    "card_exp_month": $('select#card-expiry-month option:selected')[0].value,
                    "card_exp_year": $('select#card-expiry-year option:selected')[0].value,
                    "card_cvv": $('.card-cvv').val(),
                    "secure": true,
                    "gross_amount": grossamount,
//                    "bank": "bni",
                }
            };

            function callback(response) {
                console.log(response);
                if (response.redirect_url) {
                    console.log("3D SECURE");
                    // 3D Secure transaction, please open this popup
                    openDialog(response.redirect_url);
                }
                else if (response.status_code == "200") {
                    // Submit form
                    $("#token_id").val(response.token_id);
                    $("#payment-form").submit();
                }
                else {
                    // Failed request token
                    console.log(response.status_code);
                    alert(response.status_message);
                    
                    $('.shopping-bag.creditcardform').css('padding-left','28px');
                    $('.shopping-bag.creditcardform').css('padding-right','28px');
                    $('.shopping-bag.creditcardform').css('padding-top','15px');
                    $('.shopping-bag.creditcardform').css('padding-bottom','15px');
                    $('.shopping-bag.creditcardform').css("border","solid 2px rgb(161,29,33)");
                    $('.shopping-bag.creditcardform').css("border-radius","5px");
                    $('button').removeAttr("disabled");
                }
            }

            function openDialog(url) {
                $.fancybox.open({
                    href: url,
                    type: "iframe",
                    autoSize: false,
                    width: 700,
                    height: 500,
                    closeBtn: false,
                    modal: true
                });
            }

            //$(".submit-button").click(function (event) {
            console.log("SUBMIT");
            //event.preventDefault();
            //$(this).attr("disabled", "disabled");
            Veritrans.token(card, callback);
            return false;
            //});
        });
    }

    if ($('input:radio[data-id=ip]').is(':checked')) {
        
        if(!$('input:radio[data-id=installmentplan]').is(':checked')) { 
          $('#metode-preview').css("border","solid 2px rgb(161,29,33)");
          $('#pilih_bulan').removeClass("fcolor69");
          $('#pilih_bulan').css("color","rgb(161,29,33)");
          return false;
        }
        
        var plan = $('input:radio[data-id=installmentplan]:checked')[0].value,
                bank = $('input:radio[data-id=ip]:checked')[0].value,
                planValue = 3;

        // bank mandiri ke veritrans
        if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19) {

            $('input[name=installment]').val('true');

            if(plan == 'i3m'){
                planValue = 3;
            } else if(plan == 'i6m'){
                planValue = 6;
            } else if(plan == 'i12m'){
                planValue = 12;
            }

            $('input[name=installment_plan]').val(planValue);

            $(function () {
                // Sandbox Parameter
//                Veritrans.url = "https://api.sandbox.veritrans.co.id/v2/token";
//                Veritrans.client_key = "VT-client-mjABlnYixiNp15XZ";
                
                if($('.credit-valid').html() == '' || $('.credit-length').html() == '' || $('.credit-luhn').html() == ''){
                  $('.cardholder.card-number.credit').css("border","solid 2px rgb(161,29,33)");
                
                  $('#metode-preview').css("border","solid 2px rgb(161,29,33)");
                  alert('Card Number is not Valid');
                  return false;
              }
              if($('.cardholder.card-cvv').val().length < 3){
                  $('.cardholder.card-cvv').css("border","solid 2px rgb(161,29,33)");
                  $('#metode-preview').css("border","solid 2px rgb(161,29,33)");
                  alert('CVV is not Valid');
                  return false;
              }
              
                Veritrans.url = "https://api.veritrans.co.id/v2/token";
                Veritrans.client_key = "VT-client-_rz55Hanv0PtThrX";

                $('input[name=payment_id]').val($('input:radio[name=payment_method]:checked')[0].value);
                 $('input[name=payment_method_id]').val($('input:radio[name=payment_method]:checked').attr("method-id"));
                var card = function () {
                    return {
                        "card_number": $('.card-number').val(),
                        "card_exp_month": $('select#card-expiry-month option:selected')[0].value,
                        "card_exp_year": $('select#card-expiry-year option:selected')[0].value,
                        "card_cvv": $('.card-cvv').val(),
                        "secure": true,
                        "gross_amount": grossamount,
                        "installment" : true,
                        "installment_term" : planValue
                        //                    "bank": "bni",
                    }
                };

                function callback(response) {
                    console.log(response);
                    if (response.redirect_url) {
                        console.log("3D SECURE");
                        // 3D Secure transaction, please open this popup
                        openDialog(response.redirect_url);
                    }
                    else if (response.status_code == "200") {
                        // Submit form
                        $("#token_id").val(response.token_id);
                        $("#payment-form").submit();
                    }
                    else {
                        // Failed request token
                        console.log(response.status_code);
                        alert(response.status_message);
                        $('.shopping-bag.creditcardform').css('padding-left','28px');
                        $('.shopping-bag.creditcardform').css('padding-right','28px');
                        $('.shopping-bag.creditcardform').css('padding-top','15px');
                        $('.shopping-bag.creditcardform').css('padding-bottom','15px');
                        $('.shopping-bag.creditcardform').css("border","solid 2px rgb(161,29,33)");
                        $('.shopping-bag.creditcardform').css("border-radius","5px");
                        $('button').removeAttr("disabled");
                    }
                }

                function openDialog(url) {
                    $.fancybox.open({
                        href: url,
                        type: "iframe",
                        autoSize: false,
                        width: 700,
                        height: 500,
                        closeBtn: false,
                        modal: true
                    });
                }

                //$(".submit-button").click(function (event) {
                console.log("SUBMIT");
                //event.preventDefault();
                //$(this).attr("disabled", "disabled");
                Veritrans.token(card, callback);
                return false;
                //});
            });
        } else {

            $.ajax({
                type: "POST",
                url: baseUrl + '/cart/checkout/step/paymentinformation',
                data: {
					"paymentMethod": {
						"payment_id": $('input:radio[name=payment_method]:checked')[0].value,
                        "payment_method_id": $('input:radio[name=payment_method]:checked').attr("method-id"),
                        "installment_plan": $('input:radio[name=installmentplan]:checked')[0].value
					}
				},
                beforeSend: function () {
                    $('#loadingScreen').modal('show');
                },
                success: function (data) {
                    $('#loadingScreen').modal('hide');
                    console.log(data);
                    $("#confirmorder-form").submit();
                }
            });

        }
    }

    if ($('input:radio[data-id=cc]').is(':checked') || $('input:radio[data-id=ip]').is(':checked')) {

    } else {
        // bank transfer kredivo
        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/step/paymentinformation',
            data: {
				"paymentMethod": {
					"payment_id": $('input:radio[name=payment_method]:checked')[0].value,
                        "payment_method_id": $('input:radio[name=payment_method]:checked').attr("method-id"),
				},
				"send_as_gift" : {
					"is_a_gift" : sendAsGift,
					"gift_message" : gift_message
				}
			},
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('#loadingScreen').modal('hide');
                console.log(data);
                    $("#confirmorder-form").submit();
            }
        });
    }

    $('div.payment-error').hide();
    $('div.agreement-error').hide();

	var payment_method = $('select#payment_method option:selected').text();

	dataLayer.push({
		"event": "checkoutOption",
		"ecommerce": {
			"checkout_option": {
				"actionField": {
					"step": 3,
					"option": payment_method
				}
			}
		}
	});

});

$('input:checkbox[id=send_as_gift]').on('change', function () {
    if ($('#send_as_gift').is(":checked")) {
        $("#gift_message_box").removeClass('hidden');
    } else {
        $("#gift_message_box").addClass('hidden');
    }
});

$('div#signin-btn').on('click', function (e) {
    e.preventDefault();

    var email = $('input[name=email]').val(),
            password = $('input[name=password]').val();

    if (email === '') {
        $('span#email-signin-error').show();
        $('span#email-signin-error').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#email-signin-error').show();
        $('span#email-signin-error').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-signin-error').hide();
    }

    if (password === '') {
        $('span#signin-pwderror').show();
        $('span#signin-pwderror').html('* Password Is Required!');
        return;
    } else {
        $('span#signin-pwderror').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/sign-in',
        data: {
            "email": $('input[name=email]')[0].value,
            "password": $('input[name=password]')[0].value
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#signintop-error').show();
                return;
            }

			(function(document, window) {
				var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/YTk4NzZhYWItZjQwNi00MTEwLTliYTktZThiYTQxMTdiNzg0";

				document.body.appendChild(scr);
			})(document, window);

			$('#loadingScreen').modal('hide');

            window.location.href = baseUrl + '/user/profile';
        }
    });
});

$('div#signup-btn').on('click', function (e) {
    e.preventDefault();

	(function(document, window) {
		var scr = document.createElement("script");
		scr.type = "text/javascript";
		scr.async = true;
		scr.src =  "//ssp.adskom.com/tags/third-party-async/NzY2MWM1NDUtNmJhNS00MmVmLWExMDMtZjIzNzJjYjNhOWU4";

		document.body.appendChild(scr);
	})(document, window);

    var email = $('input[name=signup_email]').val(),
            fname = $('input[name=fname]').val(),
			phone = $('input[name=phone]').val(),
            password = $('input[name=signup_password]').val();

    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-error').hide();
    }

    if (fname === '') {
        $('span#firstname-error').show();
        $('span#firstname-error').html('* First Name Is Required!');
        return;
    } else {
        $('span#firstname-error').hide();
    }

	if (phone === '') {
        $('span#phone-error').show();
        $('span#phone-error').html('* Phone Number Is Required!');
        return;
    } else {
        $('span#phone-error').hide();
    }

    if (password === '') {
        $('span#signup-pwderror').show();
        $('span#signup-pwderror').html('* Password Is Required!');
        return;
    } else {
        $('span#signup-pwderror').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/sign-up',
        data: {
            "customerInfo": {
                "email": $('input[name=signup_email]')[0].value,
                "fname": $('input[name=fname]')[0].value,
				"phone": $('input[name=phone]')[0].value,
                "lname": '',
                "password": $('input[name=signup_password]')[0].value,
                "newsletter": $('input[name=rc002]')[0].value
            }
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#signuptop-error').show();
                $('#loadingScreen').modal('hide');
                return;
            }

			sendRegisterHomePage();

			(function(document, window) {
				var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/MmJlMzUxNjUtYzQ1Ny00ZjVjLWFiNzktNWM0YzJhNWFiYzVj";

				document.body.appendChild(scr);
			})(document, window);

            $('#loadingScreen').modal('hide');
            location.reload();
        }
    });
});

$('div#signup').on('click', function (e) {

    e.preventDefault();

    $('div#signup-form').show();
    // $('div#signup').css('border', '1px solid #000');
    // $('div#signup').css('background', '#000');
    $('div#signup').css('color', '#9e8463');
    $('div#signup').css('border-bottom', '2px solid');

    $('div#signin-form').hide();
    // $('div#signin').css('border', '1px solid #000');
    // $('div#signin').css('background', '#fff');
    $('div#signin').css('color', '#000');
    $('div#signin').css('border-bottom', '0px');

    $('div#signin-box').hide();
    $('div#signup-box').show();

    $("div#forgot-btn-box").hide();
    $("div#forgot-form-box").hide();
    $("div#forgot-form-content").hide();

});

$('div#signin').on('click', function (e) {

    e.preventDefault();

    $('div#signup-form').hide();
    // $('div#signup').css('border', '1px solid #000');
    // $('div#signup').css('background', '#fff');
    $('div#signup').css('color', '#000');
    $('div#signup').css('border-bottom', '0px');

    $('div#signin-form').show();
    // $('div#signin').css('border', '1px solid #000');
    // $('div#signin').css('background', '#000');
    $('div#signin').css('color', '#9e8463');
    $('div#signin').css('border-bottom', '2px solid');

    $('div#signin-box').show();
    $('div#signup-box').hide();
});

$('input:radio[name=shipping]').on('change', function () {
    $('select.shipping').prop("disabled", false);

    $.ajax({
        type: "POST",
        url: baseUrl + '/shipping/generate-shipping-method',
        data: {"customer_address_id": $('input:radio[name=shipping]:checked')[0].value},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            $('#loadingScreen').modal('hide');
            $("div.step-purchase.shipping-method").html(data);
        }
    });
});

// $('a#delivery-list').on('click', function (e) {
//     e.preventDefault();

//     if ($('input:radio:checked').length > 0 && $('select#shipping-method option:selected').val() != 0) {
//         var customer_address_id = $('input:radio:checked')[0].value;

//         $('div.signup-error').hide();

//         $.ajax({
//             type: "POST",
//             url: baseUrl + '/cart/checkout/shipping-submit',
//             data: {"customer_address_id": customer_address_id, "shipping_method": $('select#shipping-method').length ? $('select#shipping-method option:selected').val() : 0},
//             beforeSend: function () {
//                 $('#loadingScreen').modal('show');
//             },
//             success: function (data) {
//                 $('#loadingScreen').modal('hide');
//                 window.location.href = baseUrl + '/cart/checkout/step/paymentinformation';
//             }
//         });

//         return;

//     } else {
//         $('div.signup-error').show();
//     }



// });

$('a#removeItem').on('click', function (e) {

    e.preventDefault();

    var id = $(this).attr("data-id"),
            attributeId = $(this).attr("attributeId");

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item-cart',
        data: {"id": id, "attributeId": attributeId},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            $('#loadingScreen').modal('hide');
            $("div#box-cart").html(data);
            //$("div#menu-cart-mobile").html(data[1]);
        }
    });

    if ($("section#shopping-bag").length) {
        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/remove-cart-item-cart',
            data: {"id": id, "attributeId": attributeId},
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('#loadingScreen').modal('hide');
                $("section#shopping-bag").html(data);
            }
        });
    }

	var items = [];

	items.push({
		"id": id,
		"name": $(this).children('input[name=productName]')[0].value,
		"price": $(this).children('input[name=productPrice]')[0].value,
		"brand": $(this).children('input[name=brandName]')[0].value,
		"category": $(this).children('input[name=productCategory]')[0].value,
		"variant": $(this).children('input[name=variantName]')[0].value,
		"position": $(this).children('input[name=productPosition]')[0].value,
		"quantity": $(this).children('input[name=productQuantity]')[0].value
	});

	sendRemoveCartItem(items);
});

$('a#removeItem-mobile').on('click', function (e) {

    e.preventDefault();

    var id = $(this).attr("data-id"),
            attributeId = $(this).attr("attributeId");

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item-cart',
        data: {"id": id, "attributeId": attributeId},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            $('#loadingScreen').modal('hide');
            location.reload();
        }
    });
});

$('a#removeCartItem').on('click', function (e) {

    e.preventDefault();

    var id = $(this).attr("data-id"),
            attributeId = $(this).attr("attributeId");

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-cart-item',
        data: {"id": id, "attributeId": attributeId},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            $('#loadingScreen').modal('hide');
            $("section#shopping-bag").html(data);
            location.reload();
        }
    });

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item',
        data: {"id": id, "attributeId": attributeId},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            $('#loadingScreen').modal('hide');
            $("div#box-cart").html(data);
            location.reload();
        }
    });
});

$('a#removeCartItemMobile').on('click', function (e) {

    e.preventDefault();

    var id = $(this).attr("data-id"),
            attributeId = $(this).attr("attributeId");

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-cart-item',
        data: {"id": id, "attributeId": attributeId}
    });

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item',
        data: {"id": id, "attributeId": attributeId},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            window.location.reload();
            location.reload();
        }
    });
});

$('select.size').on('change', function () {
    // validate if user selected color
    //sebelumnya yg pake id="color" dimana? gak ada pal// , ini class ya?// trs ini element nya dimana? itu krna select box
    $col_value = $('select.size')[0].value.split("+");
    if ($col_value[1] !== "0") {
       // console.log($col_value[1]);
       
            $('select.qty').prop("disabled", false);
            $('select.size').prop("disabled", false);
            $('div.cart-add-error.error').hide();
            var ez = $("#product-img").data('elevateZoom');
            var attribute_value_id = $col_value[1],
                    product_attribute_id = $('select.size option:selected').attr("attributeId");
            // generate quantity select box
            $.ajax({
                type: "POST",
                url: baseUrl + '/stock/quantitycolor',
                data: {
                    "attribute_value_id": product_attribute_id,
                    "attribute_value": $col_value[0] ,
                    "attribute_value_2": $col_value[1] ,
                    },
                beforeSend: function () {
                    $('#loadingAjax').fadeIn(200, function () {
                    });
                    $('span.product-total').hide();
                },
                success: function (data) {
                    $('#loadingAjax').fadeOut(200, function () {
                    });
                    $('span.product-total').show();
                    $('div#qty').html(data);
                    // $('li.small-thumb').hide();
                    // show selected attribute images
                    $('li[id=' + attribute_value_id + ']').show();
                    var smallImage = $('li#' + attribute_value_id).attr("data-image");
                    var largeImage = $('li#' + attribute_value_id).attr("data-zoom-image");
                    if ($('li[id=' + attribute_value_id + ']').length <= 6) {
                        $('.btn-prev').hide();
                        $('.btn-next').hide();
                    }
                    else {
                        $('.btn-prev').show();
                        $('.btn-next').show();
                    }
                    $("#thumb-small").css("top", "0");
                    // change into first selected attribute images
                    ez.swaptheimage(smallImage, largeImage);
                    var qty = $('div.quantity-out-of-stock').text();
                    if ($.trim(qty) === 'Out Of Stock') {
                        $(".product-addtocart").hide();
                        $(".product-notifyme").show();
                    } else {
                        $(".product-addtocart").show();
                        $(".product-notifyme").hide();
                    }
                }
            });
        
        
    } else {
        $('select.qty').val(0);
        $('span.product-total').html('');
        $('select.qty').prop("disabled", true);
        $(".product-addtocart").show();
        $(".product-notifyme").hide();
        $('select.qty option:selected').text('QTY');
    }
});

$('select.color').on('change', function () {
    // validate if user selected color
    //sebelumnya yg pake id="color" dimana? gak ada pal// , ini class ya?// trs ini element nya dimana? itu krna select box
    $col_value = $('select.color')[0].value.split("+");
    if ($col_value[0] !== "0") {
        // console.log($col_value[1]);
        if($col_value[1] != '' || $col_value[1] != 0){
            $('select.qty').prop("disabled", true);
            $('span.product-total').hide();
            $('select.size').prop("disabled", false);

            var attribute_value_id = $col_value[0],
                    product_attribute_id = $('select.color option:selected').attr("attributeId");
            // console.log($col_value[0]);
            $.ajax({
                type: "POST",
                url: baseUrl + '/stock/viewsize',
                data: {
                    "attribute_value_id": product_attribute_id ,
                    "attribute_value": $col_value[0] ,
                    // "attribute_value_2": 0 ,
                    },
                beforeSend: function () {
                    $('#loadingAjax').fadeIn(200, function () {
                    });
                    $('span.product-total').hide();
                },
                success: function (data) {
                    $('#loadingAjax').fadeOut(200, function () {
                    });
                    // $('span.product-total').show();
                    $('select#size').html(data);

                    // $('li.small-thumb').hide();

                    // show selected attribute images
                    // $('li[id=' + attribute_value_id + ']').show();

                    // var smallImage = $('li#' + attribute_value_id).attr("data-image");
                    // var largeImage = $('li#' + attribute_value_id).attr("data-zoom-image");

                    // if ($('li[id=' + attribute_value_id + ']').length <= 6) {
                    //     $('.btn-prev').hide();
                    //     $('.btn-next').hide();
                    // }
                    // else {
                    //     $('.btn-prev').show();
                    //     $('.btn-next').show();
                    // }

                    // $("#thumb-small").css("top", "0");

                    // // change into first selected attribute images
                    // ez.swaptheimage(smallImage, largeImage);

                    // var qty = $('div.quantity-out-of-stock').text();

                    // if ($.trim(qty) === 'Out Of Stock') {
                    //     $(".product-addtocart").hide();
                    //     $(".product-notifyme").show();
                    // } else {
                    //     $(".product-addtocart").show();
                    //     $(".product-notifyme").hide();
                    // }
                }
            });

        }else{
            $('select.qty').prop("disabled", false);
            $('select.size').prop("disabled", true);
            $('div.cart-add-error.error').hide();

            var ez = $("#product-img").data('elevateZoom');
            var attribute_value_id = $col_value[0],
                    product_attribute_id = $('select.color option:selected').attr("attributeId");
            // generate quantity select box
            $.ajax({
                type: "POST",
                url: baseUrl + '/stock/quantitycolor',
                data: {
                    "attribute_value_id": product_attribute_id ,
                    "attribute_value": $col_value[0] ,
                    "attribute_value_2": 0 ,
                    },
                beforeSend: function () {
                    $('#loadingAjax').fadeIn(200, function () {
                    });
                    $('span.product-total').hide();
                },
                success: function (data) {
                    $('#loadingAjax').fadeOut(200, function () {
                    });
                    $('span.product-total').show();
                    $('div#qty').html(data);

                    // $('li.small-thumb').hide();

                    // show selected attribute images
                    $('li[id=' + attribute_value_id + ']').show();

                    var smallImage = $('li#' + attribute_value_id).attr("data-image");
                    var largeImage = $('li#' + attribute_value_id).attr("data-zoom-image");

                    if ($('li[id=' + attribute_value_id + ']').length <= 6) {
                        $('.btn-prev').hide();
                        $('.btn-next').hide();
                    }
                    else {
                        $('.btn-prev').show();
                        $('.btn-next').show();
                    }

                    $("#thumb-small").css("top", "0");

                    // change into first selected attribute images
                    ez.swaptheimage(smallImage, largeImage);

                    var qty = $('div.quantity-out-of-stock').text();

                    if ($.trim(qty) === 'Out Of Stock') {
                        $(".product-addtocart").hide();
                        $(".product-notifyme").show();
                    } else {
                        $(".product-addtocart").show();
                        $(".product-notifyme").hide();
                    }
                }
            });
        }
        

    } else {
        $('select.qty').val(0);
        $('span.product-total').html('');
        $('select.qty').prop("disabled", true);

        $(".product-addtocart").show();
        $(".product-notifyme").hide();

        $('select.qty option:selected').text('QTY');
    }

});

$('a#submit-notifyme').on('click', function (e) {

    e.preventDefault();

    var email = $('input[name=email-notifyme]').val(),
            name = $('input[name=name-notifyme]').val(),
            product_id = $('input[name=product_id]').val(),
            product_attribute_id = $('select.color').length ? $('select.color option:selected').attr("attributeId") : 0;

    if (name === '') {
        $('span#name-notifyme-error').show();
        $('span#name-notifyme-error').html('* Name Is Required!');
    } else {
        $('span#name-notifyme-error').hide();
    }

    if (email === '') {
        $('span#email-notifyme-error').show();
        $('span#email-notifyme-error').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#email-notifyme-error').show();
        $('span#email-notifyme-error').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-notifyme-error').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/notify',
        data: {
            "product_id": product_id,
            "product_attribute_id": product_attribute_id,
            "email": email,
            "fullname": name
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#error-notifyme').show();
                return;
            } else if (d === 'TRUE') {
                $('span#success-notifyme').show();
            }
        }
    });
});

$('select.qty').on('change', function () {
    // validate if user choose quantity
    if ($('select.qty')[0].value !== "0") {

        $('div.cart-add-error.error').hide();

        // generate total price
        $.ajax({
            type: "POST",
            url: baseUrl + '/stock/price',
            data: {"quantity": $('select.qty')[0].value, "price": $('input.price').val()},
            beforeSend: function () {
                $('#loadingAjax').fadeIn(200, function () {
                });
                $('span.product-total').hide();
            },
            success: function (data) {
                $("#loadingAjax").css('display', 'none');
                $('span.product-total').show();
                $('.product-total').html(data);
            }
        });

    } else {
        $('span.product-total').html('');
    }
});

$('a#signin-checkout').on('click', function (e) {
    e.preventDefault();

    var email = $("#email-signin").val(),
            password = $('#password-signin').val();

    if (email === '') {
        $('span#email-signin-error').show();
        $('span#email-signin-error').html('* Email Is Required!');
    } else if (!validateEmail(email)) {
        $('span#email-signin-error').show();
        $('span#email-signin-error').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-signin-error').hide();
    }

    if (password === '') {
        $('span#password-signin-error').show();
        $('span#password-signin-error').html('* Password Is Required!');
        return;
    } else {
        $('span#password-signin-error').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/sign-in',
        data: {"email": email, "password": password},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (!d) {
                $('span#signin-error').show();
                $('#loadingScreen').modal('hide');
                return;
            }

			(function(document, window) {
				var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/NWNkMjAzZTQtM2Y2Ni00MTJmLThiYzItZWIwMjhhYjNmNWM4";

				document.body.appendChild(scr);
			})(document, window);

            $('#loadingScreen').modal('hide');
            window.location.href = baseUrl + '/cart/checkout/step/deliveryinformation';
        }
    });
});

$('a#signup-giveaway').on('click', function (e) {
    e.preventDefault();

    var email = $("input[name=signup_ch_email]").val(),
            firstname = $("input[name=firstname_checkout_signup]").val(),
            lastname = $("input[name=lastname_checkout_signup]").val(),
            password = $('input[name=signup_ch_password]').val(),
			phone = $('input[name=phone_number]').val(),
			ig = $('input[name=ig_account]').val(),
            cpassword = $('input[name=signup_ch_cpassword]').val();

    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-error').hide();
    }

    if (firstname === '') {
        $('span#firstname-checkout-error').show();
        $('span#firstname-checkout-error').html('* First Name Is Required!');
        return;
    } else {
        $('span#firstname-checkout-error').hide();
    }

	if (lastname === '') {
        $('span#lastname-checkout-error').show();
        $('span#lastname-checkout-error').html('* Last Name Is Required!');
        return;
    } else {
        $('span#lastname-checkout-error').hide();
    }

	if (phone === '') {
        $('span#phone-error').show();
        $('span#phone-error').html('* Phone Number Is Required!');
        return;
    } else {
        $('span#phone-error').hide();
    }

    if (password === '') {
        $('span#password-error').show();
        $('span#password-error').html('* Password Is Required!');
        return;
    } else {
        $('span#password-error').hide();
    }

    if (cpassword === '') {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Is Required!');
        return;
    } else if (cpassword !== password) {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Do Not Match!');
        return;
    } else {
        $('span#password-confirm-error').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/campaign/giveaway',
        data: {"customerInfo": {
                "email": email,
                "fname": firstname,
                "lname": lastname,
                "password": password,
				"phone": phone,
				"ig": ig,
                "isNewCustomer": true
            }},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#signup-error').show();
                $('#loadingScreen').modal('hide');
                return;
            }
            $('#loadingScreen').modal('hide');
            window.location.href = baseUrl + '/giveaway/thankyou-page';
        }
    });
});

$('a#signup-checkout').on('click', function (e) {
    e.preventDefault();

    var email = $("input[name=signup_ch_email]").val(),
            firstname = $("input[name=firstname_checkout_signup]").val(),
            lastname = $("input[name=lastname_checkout_signup]").val(),
            password = $('input[name=signup_ch_password]').val(),
			phone = $('input[name=phone_checkout_signup]').val(),
            cpassword = $('input[name=signup_ch_cpassword]').val();

    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-error').hide();
    }

    if (firstname === '') {
        $('span#firstname-checkout-error').show();
        $('span#firstname-checkout-error').html('* First Name Is Required!');
        return;
    } else {
        $('span#firstname-checkout-error').hide();
    }

	if (phone === '') {
        $('span#phone-checkout-error').show();
        $('span#phone-checkout-error').html('* Phone Number Is Required!');
        return;
    } else {
        $('span#phone-checkout-error').hide();
    }

    if (password === '') {
        $('span#password-error').show();
        $('span#password-error').html('* Password Is Required!');
        return;
    } else {
        $('span#password-error').hide();
    }

    if (cpassword === '') {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Is Required!');
        return;
    } else if (cpassword !== password) {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Do Not Match!');
        return;
    } else {
        $('span#password-confirm-error').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/sign-up',
        data: {"customerInfo": {
                "email": email,
                "fname": firstname,
                "lname": lastname,
                "password": password,
				"phone": phone,
                "isNewCustomer": true
            }},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#signup-error').show();
                $('#loadingScreen').modal('hide');
                return;
            }

			sendRegisterCheckout();

			(function(document, window) {
				var scr = document.createElement("script");
				scr.type = "text/javascript";
				scr.async = true;
				scr.src =  "//ssp.adskom.com/tags/third-party-async/ZmQzMTAxOWYtODQ3ZC00ZTBiLWIyOWUtMTgxYzgzNTI4MTcy";

				document.body.appendChild(scr);
			})(document, window);

            $('#loadingScreen').modal('hide');
            window.location.href = baseUrl + '/cart/checkout/step/deliveryinformation';
        }
    });
});


$('select#province').on('change', function (e) {

    e.preventDefault();

    if ($('select#province')[0].value !== "0") {

        $('select#district').val(0);
        $('select#district').prop("disabled", true);

        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);

        var province_id = $('select#province')[0].value;

        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-state',
            data: {"province_id": province_id},
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('#loadingScreen').modal('hide');
                $("div.state").html(data);
            }
        });
    } else {
        $('select#state').val(0);
        $('select#state').prop("disabled", true);

        $('select#district').val(0);
        $('select#district').prop("disabled", true);

        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);
    }

});

$('select#state').on('change', function (e) {

    e.preventDefault();

    if ($('select#state')[0].value !== "0") {

        var state_id = $('select#state')[0].value;

        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-district',
            data: {"state_id": state_id},
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('#loadingScreen').modal('hide');
                $("div.district").html(data);
            }
        });
    } else {
        $('select#district').val(0);
        $('select#district').prop("disabled", true);

        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);
    }

});

$('select#district').on('change', function (e) {

    e.preventDefault();

    if ($('select#district')[0].value !== "0") {

        var district_id = $('select#district')[0].value;

        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-shipping-method',
            data: {"district_id": district_id},
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('#loadingScreen').modal('hide');
                $("div.carrier-method").html(data);
            }
        });
    } else {
        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);
    }

});

$('select#province-profile').on('change', function (e) {

    e.preventDefault();

    if ($('select#province-profile')[0].value !== "0") {

        $('select#district-profile').val(0);
        $('select#district-profile').prop("disabled", true);

        var province_id = $('select#province-profile')[0].value;

        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-state-profile',
            data: {"province_id": province_id},
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                $('#loadingScreen').modal('hide');
                $("div.state").html(data);
            }
        });
    } else {
        $('select#state-profile').val(0);
        $('select#state-profile').prop("disabled", true);

        $('select#district-profile').val(0);
        $('select#district-profile').prop("disabled", true);
    }

});

$('a#search').on('click', function (e) {

                var $t = $("#arrow-search");
                if ($t.is(':visible')) {
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();
                    

                    $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");

                } else {
                    $("#arrow-search").slideDown();
                    $("#box-search").slideDown();
                    $("#search.search-desktop").focus();
                    // watches
                    $("#arrow-watches").slideUp();
                    $("#box-watches").slideUp();

                    // straps
                    $("#arrow-straps").slideUp();
                    $("#box-straps").slideUp();
                    
                    // accessories
                    $("#arrow-accessories").slideUp();
                    $("#box-accessories").slideUp();

                    // login
                    $("#arrow-login").slideUp();
                    $("#box-login").slideUp();

                    // cart
                    $("#arrow-cart").slideUp();
                    $("#box-cart").slideUp();

                    // brands
                    $("#arrow-brands").slideUp();
                    $("#box-brands").slideUp();

                    $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                    $("img#img-search").css("display","none");
                    $("img#search-hover").css("display","");
                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");
                }

     e.preventDefault();

});

            $("a#login").click(function (e) {
                var $t = $("#arrow-login");
                if ($t.is(':visible')) {
                    $("#arrow-login").slideUp();
                    $("#box-login").slideUp();

                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                } else {
                    $("#arrow-login").slideDown();
                    $("#box-login").slideDown();

                    // watches
                    $("#arrow-watches").slideUp();
                    $("#box-watches").slideUp();

                    // straps
                    $("#arrow-straps").slideUp();
                    $("#box-straps").slideUp();
                    
                    // accessories
                    $("#arrow-accessories").slideUp();
                    $("#box-accessories").slideUp();

                    // cart
                    $("#arrow-cart").slideUp();
                    $("#box-cart").slideUp();

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    // brands
                    $("#arrow-brands").slideUp();
                    $("#box-brands").slideUp();

                    $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                    $("img#img-login").css("display","none");
                    $("img#account-hover").css("display","");
                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");
                    $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");

                }

                e.preventDefault();
            });

            $("a#cart").click(function (e) {
                var $t = $("#arrow-cart");
                if ($t.is(':visible')) {
                    $("#arrow-cart").slideUp();
                    $("#box-cart").slideUp();

                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");
                } else {
                    $("#arrow-cart").slideDown();
                    $("#box-cart").slideDown();

                    // watches
                    $("#arrow-watches").slideUp();
                    $("#box-watches").slideUp();

                    // straps
                    $("#arrow-straps").slideUp();
                    $("#box-straps").slideUp();
                    
                    // accessories
                    $("#arrow-accessories").slideUp();
                    $("#box-accessories").slideUp();

                    // login
                    $("#arrow-login").slideUp();
                    $("#box-login").slideUp();

                     // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    // brands
                    $("#arrow-brands").slideUp();
                    $("#box-brands").slideUp();

                    $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                    $("img#img-cart").css("display","none");
                    $("img#cart-hover").css("display","");
                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                    $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");
                }

                e.preventDefault();
            });

               $("li#watches").mouseenter(function (e) {
              
                $("a#watches").css("color", "#9e8461");
                $("a#watches").css("border-bottom", "1px solid");
                $("a#watches").css("padding-bottom", "1px");
                $("a#watches").css("margin-right", "15px");
                $("a#watches").css("padding-right", "0");

                var $t = $("#arrow-watches");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-watches").slideDown(0);
                    $("#box-watches").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);

                    // straps
                    $("#arrow-straps").slideUp(0);
                    $("#box-straps").slideUp(0);
                    
                    // accessories
                    $("#arrow-accessories").slideUp(0);
                    $("#box-accessories").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-brands").slideUp(0);
                        $("#box-brands").slideUp(0);

                        $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);


                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");

                $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");
                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");


                }
            });

            $("#box-watches").mouseleave(function(e){
               
                        $("#arrow-watches").slideUp(0);
                        $("#box-watches").slideUp(0);

                $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");
               
            });
            
            
            
              $("li#accessories").mouseenter(function (e) {
                $("a#accessories").css("color", "#9e8461");
                $("a#accessories").css("border-bottom", "1px solid");
                $("a#accessories").css("padding-bottom", "1px");
                $("a#accessories").css("margin-right", "15px");
                $("a#accessories").css("padding-right", "0");
                $("a#accessories").css("margin-left", "15px");
                $("a#accessories").css("padding-left", "0");
                var $t = $("#arrow-accessories");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-accessories").slideDown(0);
                    $("#box-accessories").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);
                    
                    // watches
                    $("#arrow-watches").slideUp(0);
                    $("#box-watches").slideUp(0);
                    
                    // straps
                    $("#arrow-straps").slideUp(0);
                    $("#box-straps").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-brands").slideUp(0);
                    $("#box-brands").slideUp(0);

                    $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");

                $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");
                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");

                }
            });
            
            $("#box-accessories").mouseleave(function (e) {
                
                $("#arrow-accessories").slideUp(0);
                $("#box-accessories").slideUp(0);

                 $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");
                    
            });
            
            
            
            $("li#straps").mouseenter(function (e) {
                $("a#straps").css("color", "#9e8461");
                $("a#straps").css("border-bottom", "1px solid");
                $("a#straps").css("padding-bottom", "1px");
                $("a#straps").css("margin-right", "15px");
                $("a#straps").css("padding-right", "0");
                $("a#straps").css("margin-left", "15px");
                $("a#straps").css("padding-left", "0");

                var $t = $("#arrow-straps");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-straps").slideDown(0);
                    $("#box-straps").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);

                    // watches
                    $("#arrow-watches").slideUp(0);
                    $("#box-watches").slideUp(0);
                    
                    // accessories
                    $("#arrow-accessories").slideUp(0);
                    $("#box-accessories").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-brands").slideUp(0);
                    $("#box-brands").slideUp(0);

                    $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                 $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");

                $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");
                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");

                }
            });
            
            $("#box-straps").mouseleave(function (e) {
                
                        $("#arrow-straps").slideUp(0);
                        $("#box-straps").slideUp(0);

                $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");
                  
            });

            $("li#jewelry").mouseenter(function (e) {
                $("a#jewelry").css("color", "#9e8461");
                $("a#jewelry").css("border-bottom", "1px solid");
                $("a#jewelry").css("padding-bottom", "1px");
                $("a#jewelry").css("margin-right", "15px");
                $("a#jewelry").css("padding-right", "0");
                $("a#jewelry").css("margin-left", "15px");
                $("a#jewelry").css("padding-left", "0");

                var $t = $("#arrow-jewelry");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-jewelry").slideDown(0);
                    $("#box-jewelry").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);

                    // watches
                    $("#arrow-watches").slideUp(0);
                    $("#box-watches").slideUp(0);
                    
                    // accessories
                    $("#arrow-accessories").slideUp(0);
                    $("#box-accessories").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-brands").slideUp(0);
                    $("#box-brands").slideUp(0);

                    $("#arrow-straps").slideUp(0);
                    $("#box-straps").slideUp(0);



                 $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");
                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");

                }
            });
            
            $("#box-jewelry").mouseleave(function (e) {
                
                        $("#arrow-jewelry").slideUp(0);
                        $("#box-jewelry").slideUp(0);

                $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");
                  
            });

             $("li#brands").mouseenter(function (e) {
                $("a#brands").css("color", "#9e8461");
                $("a#brands").css("border-bottom", "1px solid");
                $("a#brands").css("padding-bottom", "1px");
                $("a#brands").css("margin-right", "15px");
                $("a#brands").css("padding-right", "0");
                $("a#brands").css("margin-left", "15px");
                $("a#brands").css("padding-left", "0");

                var $t = $("#arrow-brands");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-brands").slideDown(0);
                    $("#box-brands").slideDown(0);

                    // cart
                    $("#arrow-cart").slideUp(0);
                    $("#box-cart").slideUp(0);

                    // watches
                    $("#arrow-watches").slideUp(0);
                    $("#box-watches").slideUp(0);
                    
                    // accessories
                    $("#arrow-accessories").slideUp(0);
                    $("#box-accessories").slideUp(0);

                    // login
                    $("#arrow-login").slideUp(0);
                    $("#box-login").slideUp(0);

                    // search
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();

                    $("#arrow-straps").slideUp(0);
                    $("#box-straps").slideUp(0);

                    $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                 $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");

                $("img#img-search").css("display","");
                    $("img#search-hover").css("display","none");
                    $("img#img-login").css("display","");
                    $("img#account-hover").css("display","none");
                    $("img#img-cart").css("display","");
                    $("img#cart-hover").css("display","none");

                }
            });
            
            $("#box-brands").mouseleave(function (e) {
                
                $("#arrow-brands").slideUp(0);
                $("#box-brands").slideUp(0);

                $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");
                  
            });

            $("li#journal").mouseenter(function (e) {
                $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");

                $("#arrow-brands").slideUp(0);
                $("#box-brands").slideUp(0);

                $("#arrow-accessories").slideUp(0);
                $("#box-accessories").slideUp(0);

                $("#arrow-watches").slideUp(0);
                $("#box-watches").slideUp(0);

                $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                
            });

            $("li#jurnal").mouseenter(function (e) {
                $("a#watches").css("color", "");
                $("a#watches").css("border-bottom", "");
                $("a#watches").css("padding-bottom", "");
                $("a#watches").css("margin-right", "");
                $("a#watches").css("padding-right", "");

                $("a#accessories").css("color", "");
                $("a#accessories").css("border-bottom", "");
                $("a#accessories").css("padding-bottom", "");
                $("a#accessories").css("margin-right", "");
                $("a#accessories").css("padding-right", "");
                $("a#accessories").css("margin-left", "");
                $("a#accessories").css("padding-left", "");

                $("a#straps").css("color", "");
                $("a#straps").css("border-bottom", "");
                $("a#straps").css("padding-bottom", "");
                $("a#straps").css("margin-right", "");
                $("a#straps").css("padding-right", "");
                $("a#straps").css("margin-left", "");
                $("a#straps").css("padding-left", "");

                $("a#brands").css("color", "");
                $("a#brands").css("border-bottom", "");
                $("a#brands").css("padding-bottom", "");
                $("a#brands").css("margin-right", "");
                $("a#brands").css("padding-right", "");
                $("a#brands").css("margin-left", "");
                $("a#brands").css("padding-left", "");

                $("a#jewelry").css("color", "");
                $("a#jewelry").css("border-bottom", "");
                $("a#jewelry").css("padding-bottom", "");
                $("a#jewelry").css("margin-right", "");
                $("a#jewelry").css("padding-right", "");
                $("a#jewelry").css("margin-left", "");
                $("a#jewelry").css("padding-left", "");

                $("#arrow-brands").slideUp(0);
                $("#box-brands").slideUp(0);

                $("#arrow-accessories").slideUp(0);
                $("#box-accessories").slideUp(0);

                $("#arrow-watches").slideUp(0);
                $("#box-watches").slideUp(0);

                $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                
            });

$('input#search').on('focusout', function () {
    // $("div.searchform").fadeOut(500, function () {
    //     $('a#search').show();
    // });
})

$('input#search').on('keypress', function (e) {
    if (e.which === 13) {

        var search = $("input#search").val();

        window.location.href = baseUrl + '/category/search?q=' + search;

        return false;
    }
});

function validateEmail(email) {
    // http://stackoverflow.com/a/46181/11236

    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$('input:checkbox[id=agreement]').on('change', function () {
    if ($('#agreement').is(":checked")) {
        $("#agreementModal").modal("show");
    }
});

$("span.submit-search").on("click", function () {

    var search = $("input#search").val();

    window.location.href = baseUrl + '/category/search?q=' + search;

});

$('a#submit-confirm').on('click', function (e) {
    e.preventDefault();

    var customer_name = $('input[name=customer_name]')[0].value,
            account_name = $('input[name=account_name]')[0].value,
            account_number = $('input[name=account_number]')[0].value,
            bank_anda = $('input[name=bank_anda]')[0].value,
            amount = $('input[name=amount]')[0].value,
            //transfer_to = $('input[name=transfer_to]')[0].value,
            //transfer_method = $('input[name=transfer_method]')[0].value,
            orders_id = $('input[name=orders_id]')[0].value,
            comments = $('input[name=comments]')[0].value;

    $.ajax({
        type: "POST",
        url: baseUrl + '/user/order/confirmation/' + ordersId,
        data: {
            "customer_name": customer_name,
            "account_name": account_name,
            "account_number": account_number,
            "bank_anda":bank_anda,
            "amount": amount,
            //"transfer_to": transfer_to,
            //"transfer_method": transfer_method,
            "comments": comments,
            "orders_id": orders_id
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            $('#loadingScreen').modal('hide');
			if(data == true){
				location.reload();
			}
        }
    });
});

$("#foo").slider({
    tooltip: 'false'
});

$("#foo_mobile").slider({
    tooltip: 'false'
});

var minPrice = $('#bar-left').text(),
    maxPrice = $('#bar-right').text();

var minPrice_mobile = $('#bar-left-mobile').text(),
    maxPrice_mobile = $('#bar-right-mobile').text();

$('#foo').slider().on('slide', function (ev) {
    $('#bar-left').html(ev.value[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    $('#bar-right').html(ev.value[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

    minPrice = ev.value[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    maxPrice = ev.value[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

$('#foo_mobile').slider().on('slide', function (ev) {
    $('#bar-left-mobile').html(ev.value[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    $('#bar-right-mobile').html(ev.value[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

    minPrice = ev.value[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    maxPrice = ev.value[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

$("input[name=clear]").on('click', function (e) {
    e.preventDefault();

	// uncheck all checkbox
	$("input:checkbox").prop('checked', false);

	//console.log(params);
	$.ajax({
			type: "POST",
			url: baseUrl + '/category/filterajax',
			data: {
			},
			beforeSend: function () {
					$('#loadingScreen').modal('show');
			},
			success: function (data) {
					window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction;
					}
			});

	// window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction;
});

$("input[name=clear-brand]").on('click', function (e) {
    e.preventDefault();

		var breadcrumb = $('input[name="breadcrumb"]').val();
		var brandname = $('input[name="brandname"]').val();
		if(breadcrumb == ''){
			var currentAc = 'brand/' + brandname;
		}else{
			var currentAc = breadcrumb + '/brand/' + brandname;
		}

	// uncheck all checkbox
	$("input:checkbox").prop('checked', false);

	//console.log(params);
	$.ajax({
			type: "POST",
			url: baseUrl + '/category/filterajax',
			data: {
			},
			beforeSend: function () {
					$('#loadingScreen').modal('show');
			},
			success: function (data) {
					window.location.href = baseUrl + '/' + currentAc;
					}
			});

	// window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction;
});

$("input[name=clear-promo]").on('click', function (e) {
    e.preventDefault();

        var breadcrumb = $('input[name="breadcrumb"]').val();
        
        if(breadcrumb != ''){
            
            var currentAc = breadcrumb;
        }

    // uncheck all checkbox
    $("input:checkbox").prop('checked', false);

    //console.log(params);
    $.ajax({
            type: "POST",
            url: baseUrl + '/category/filterajax',
            data: {
            },
            beforeSend: function () {
                    $('#loadingScreen').modal('show');
            },
            success: function (data) {
                    window.location.href = baseUrl + '/' + currentAc;
                    }
            });

    // window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction;
});


$('input#apply-filters').click(function() {
    // e.preventDefault();

		var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            size_param = [],
            price_param = [],
                        gender_param = [],
                        type_param = [],
                        water_param = [],
                        bandwidth_param = [];
												movement_param = [];
												subcat_param = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_fil = '',
            price_fil = '',
                        gender_fil = '',
                        type_fil = '',
                        water_fil = '',
                        bandwidth_fil = '',
												movement_fil = '',
                                                subcat_fil = '',
            category_name = '',
            selected = '',
            category_active = '',
            old_category_name = '';

    var found = false;
    
    var limit = $('input[name="filter-limit"]').val();
    var sortby = '&sortby=' + $('input[name="filter-sortby"]').val();

    $('input:checkbox[name=brands]:checked').each(function () {

        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category_mobile]:checked').length; i++) {
            selected = $('input:checkbox[name=category_mobile]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

		$('input:checkbox[name=size]:checked').each(function () {
            size_param.push(this.value);

            if (found) {
                size_fil = '&size=' + size_param.join('--');
            } else {
                size_fil = '&size=' + size_param.join('--');
                found = true;
            }

		});

    $('input:checkbox[name=gender]:checked').each(function () {
            gender_param.push(this.value);

            if (found) {
                gender_fil = '&gender=' + gender_param.join('--');
            } else {
                gender_fil = '&gender=' + gender_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=movement]:checked').each(function () {
            movement_param.push(this.value);

            if (found) {
                movement_fil = '&movement=' + movement_param.join('--');
            } else {
                movement_fil = '&movement=' + movement_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=bandwidth]:checked').each(function () {
            bandwidth_param.push(this.value);

            if (found) {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
            } else {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=type]:checked').each(function () {
            type_param.push(this.value);

            if (found) {
                type_fil = '&type=' + type_param.join('--');
            } else {
                type_fil = '&type=' + type_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=water]:checked').each(function () {
            water_param.push(this.value);

            if (found) {
                water_fil = '&water=' + water_param.join('--');
            } else {
                water_fil = '&water=' + water_param.join('--');
                found = true;
            }

		});

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = '&sort=' + sort.join('--');
            found = true;
        }
    });
    
    $('input:radio[name=subcat]:checked').each(function () {
        subcat_param.push(this.value);

        if (found) {
            subcat_fil = '&sub=' + subcat_param.join('--');
        } else {
            subcat_fil = '&sub=' + subcat_param.join('--');
            found = true;
        }
    });


		$('input:radio[name=price]:checked').each(function () {
				minPrice = this.value.split('-')[0];
				maxPrice = this.value.split('-')[1];
			});

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_fil + bandwidth_fil + gender_fil + type_fil + water_fil + movement_fil + category_param + sort_param + price_param + subcat_fil + sortby;
    pagination = '&page=1&limit='+limit;

    //console.log(params);
		$.ajax({
        type: "POST",
        url: baseUrl + '/category/filterajax',
        data: {
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;
		        }
		    });
		// window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});

$('input#apply-filters-mobile').click(function() {
    // e.preventDefault();

		var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            size_param = [],
            price_param = [],
                        gender_param = [],
                        type_param = [],
                        water_param = [],
                        bandwidth_param = [];
												movement_param = [];
												subcat_param = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_fil = '',
            price_fil = '',
                        gender_fil = '',
                        type_fil = '',
                        water_fil = '',
                        bandwidth_fil = '',
												movement_fil = '',
                                                subcat_fil = '',
            category_name = '',
            selected = '',
            category_active = '',
            old_category_name = '';

    var found = false;
    
    var limit = $('input[name="filter-limit"]').val();
    var sortby = '&sortby=' + $('input[name="filter-sortby"]').val();

    $('input:checkbox[name=brands-mobile]:checked').each(function () {

        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category_mobile]:checked').length; i++) {
            selected = $('input:checkbox[name=category_mobile]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

		$('input:checkbox[name=size-mobile]:checked').each(function () {
            size_param.push(this.value);

            if (found) {
                size_fil = '&size=' + size_param.join('--');
            } else {
                size_fil = '&size=' + size_param.join('--');
                found = true;
            }

		});

    $('input:checkbox[name=gender-mobile]:checked').each(function () {
            gender_param.push(this.value);

            if (found) {
                gender_fil = '&gender=' + gender_param.join('--');
            } else {
                gender_fil = '&gender=' + gender_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=movement-mobile]:checked').each(function () {
            movement_param.push(this.value);

            if (found) {
                movement_fil = '&movement=' + movement_param.join('--');
            } else {
                movement_fil = '&movement=' + movement_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=bandwidth-mobile]:checked').each(function () {
            bandwidth_param.push(this.value);

            if (found) {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
            } else {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=type-mobile]:checked').each(function () {
            type_param.push(this.value);

            if (found) {
                type_fil = '&type=' + type_param.join('--');
            } else {
                type_fil = '&type=' + type_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=water-mobile]:checked').each(function () {
            water_param.push(this.value);

            if (found) {
                water_fil = '&water=' + water_param.join('--');
            } else {
                water_fil = '&water=' + water_param.join('--');
                found = true;
            }

		});

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = '&sort=' + sort.join('--');
            found = true;
        }
    });
    
    $('input:radio[name=subcat-mobile]:checked').each(function () {
        subcat_param.push(this.value);

        if (found) {
            subcat_fil = '&sub=' + subcat_param.join('--');
        } else {
            subcat_fil = '&sub=' + subcat_param.join('--');
            found = true;
        }
    });


		$('input:radio[name=price-mobile]:checked').each(function () {
				minPrice = this.value.split('-')[0];
				maxPrice = this.value.split('-')[1];
			});

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_fil + bandwidth_fil + gender_fil + type_fil + water_fil + movement_fil + category_param + sort_param + price_param + subcat_fil + sortby;
    pagination = '&page=1&limit='+limit;

    //console.log(params);
		$.ajax({
        type: "POST",
        url: baseUrl + '/category/filterajax',
        data: {
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;
		        }
		    });
		// window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});



$('input#apply-filters-brand').click(function() {
    // e.preventDefault();

		var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            size_param = [],
            price_param = [],
                        collection_param = [],
                        gender_param = [],
                        type_param = [],
                        water_param = [],
                        bandwidth_param = [];
												movement_param = [];
												filter_param = [];subcat_param = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_fil = '',
            price_fil = '',
                        gender_fil = '',
                        collection_fil = '',
                        type_fil = '',
                        water_fil = '',
                        bandwidth_fil = '',
												movement_fil = '',
                                                subcat_fil = '',
            category_name = '',
            selected = '',
            category_active = '',
            old_category_name = '';
						filter_fil = '';

    var found = false;

		var breadcrumb = $('input[name="breadcrumb"]').val();
		var brandname = $('input[name="brandname"]').val();
		if(breadcrumb == ''){
			var currentAc = 'brand/' + brandname;
		}else{
			var currentAc = breadcrumb + '/brand/' + brandname;
		}

		$('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category_mobile]:checked').length; i++) {
            selected = $('input:checkbox[name=category_mobile]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

        $('input:checkbox[name=collection]:checked').each(function () {
            collection_param.push(this.value);

            if (found) {
                collection_fil = '&collection=' + collection_param.join('--');
            } else {
                collection_fil = '&collection=' + collection_param.join('--');
                found = true;
            }

        });

		$('input:checkbox[name=size]:checked').each(function () {
            size_param.push(this.value);

            if (found) {
                size_fil = '&size=' + size_param.join('--');
            } else {
                size_fil = '&size=' + size_param.join('--');
                found = true;
            }

		});

    $('input:checkbox[name=gender]:checked').each(function () {
            gender_param.push(this.value);

            if (found) {
                gender_fil = '&gender=' + gender_param.join('--');
            } else {
                gender_fil = '&gender=' + gender_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=movement]:checked').each(function () {
            movement_param.push(this.value);

            if (found) {
                movement_fil = '&movement=' + movement_param.join('--');
            } else {
                movement_fil = '&movement=' + movement_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=bandwidth]:checked').each(function () {
            bandwidth_param.push(this.value);

            if (found) {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
            } else {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=type]:checked').each(function () {
            type_param.push(this.value);

            if (found) {
                type_fil = '&type=' + type_param.join('--');
            } else {
                type_fil = '&type=' + type_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=water]:checked').each(function () {
            water_param.push(this.value);

            if (found) {
                water_fil = '&water=' + water_param.join('--');
            } else {
                water_fil = '&water=' + water_param.join('--');
                found = true;
            }

		});

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = '&sort=' + sort.join('--');
            found = true;
        }
    });

    $('input:radio[name=subcat]:checked').each(function () {
        subcat_param.push(this.value);

        if (found) {
            subcat_fil = '&sub=' + subcat_param.join('--');
        } else {
            subcat_fil = '&sub=' + subcat_param.join('--');
            found = true;
        }
    });
    
		$('input:radio[name=price]:checked').each(function () {
				minPrice = this.value.split('-')[0];
				maxPrice = this.value.split('-')[1];
			});

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = size_fil + bandwidth_fil + gender_fil + type_fil + water_fil + movement_fil + collection_fil + category_param + sort_param + price_param + subcat_fil;


    //console.log(params);
		$.ajax({
        type: "POST",
        url: baseUrl + '/category/filterajax',
        data: {
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            window.location.href = baseUrl + '/' + currentAc + '?' + params;
		        }
		    });
		// window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});

$('input#apply-filters-brand-mobile').click(function() {
    // e.preventDefault();

		var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            size_param = [],
            price_param = [],
            collection_param = [],
                        gender_param = [],
                        type_param = [],
                        water_param = [],
                        bandwidth_param = [];
												movement_param = [];
												filter_param = [];subcat_param = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_fil = '',
            price_fil = '',
            collection_fil = '',
                        gender_fil = '',
                        type_fil = '',
                        water_fil = '',
                        bandwidth_fil = '',
												movement_fil = '',
                                                subcat_fil = '',
            category_name = '',
            selected = '',
            category_active = '',
            old_category_name = '';
						filter_fil = '';

    var found = false;

		var breadcrumb = $('input[name="breadcrumb"]').val();
		var brandname = $('input[name="brandname"]').val();
		if(breadcrumb == ''){
			var currentAc = 'brand/' + brandname;
		}else{
			var currentAc = breadcrumb + '/brand/' + brandname;
		}

		$('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category_mobile]:checked').length; i++) {
            selected = $('input:checkbox[name=category_mobile]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

        $('input:checkbox[name=collection-mobile]:checked').each(function () {
            collection_param.push(this.value);

            if (found) {
                collection_fil = '&collection=' + collection_param.join('--');
            } else {
                collection_fil = '&collection=' + collection_param.join('--');
                found = true;
            }

        });

		$('input:checkbox[name=size-mobile]:checked').each(function () {
            size_param.push(this.value);

            if (found) {
                size_fil = '&size=' + size_param.join('--');
            } else {
                size_fil = '&size=' + size_param.join('--');
                found = true;
            }

		});

    $('input:checkbox[name=gender-mobile]:checked').each(function () {
            gender_param.push(this.value);

            if (found) {
                gender_fil = '&gender=' + gender_param.join('--');
            } else {
                gender_fil = '&gender=' + gender_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=movement-mobile]:checked').each(function () {
            movement_param.push(this.value);

            if (found) {
                movement_fil = '&movement=' + movement_param.join('--');
            } else {
                movement_fil = '&movement=' + movement_param.join('--');
                found = true;
            }

    });

		$('input:checkbox[name=bandwidth-mobile]:checked').each(function () {
            bandwidth_param.push(this.value);

            if (found) {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
            } else {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=type-mobile]:checked').each(function () {
            type_param.push(this.value);

            if (found) {
                type_fil = '&type=' + type_param.join('--');
            } else {
                type_fil = '&type=' + type_param.join('--');
                found = true;
            }

		});

		$('input:checkbox[name=water-mobile]:checked').each(function () {
            water_param.push(this.value);

            if (found) {
                water_fil = '&water=' + water_param.join('--');
            } else {
                water_fil = '&water=' + water_param.join('--');
                found = true;
            }

		});

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = '&sort=' + sort.join('--');
            found = true;
        }
    });

    $('input:radio[name=subcat-mobile]:checked').each(function () {
        subcat_param.push(this.value);

        if (found) {
            subcat_fil = '&sub=' + subcat_param.join('--');
        } else {
            subcat_fil = '&sub=' + subcat_param.join('--');
            found = true;
        }
    });
    
		$('input:radio[name=price-mobile]:checked').each(function () {
				minPrice = this.value.split('-')[0];
				maxPrice = this.value.split('-')[1];
			});

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = size_fil + bandwidth_fil + gender_fil + type_fil + water_fil + movement_fil + collection_fil + category_param + sort_param + price_param + subcat_fil;


    //console.log(params);
		$.ajax({
        type: "POST",
        url: baseUrl + '/category/filterajax',
        data: {
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            window.location.href = baseUrl + '/' + currentAc + '?' + params;
		        }
		    });
		// window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});

$('input#apply-filters-promo').click(function() {
    // e.preventDefault();

        var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            size_param = [],
            price_param = [],
                        gender_param = [],
                        type_param = [],
                        water_param = [],
                        bandwidth_param = [];
                                                movement_param = [];
                                                filter_param = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_fil = '',
            price_fil = '',
                        gender_fil = '',
                        type_fil = '',
                        water_fil = '',
                        bandwidth_fil = '',
                                                movement_fil = '',
            category_name = '',
            selected = '',
            category_active = '',
            old_category_name = '';
                        filter_fil = '';

    var found = false;

    var sortby = '&sortby=' + $('input[name="sortby"]').val();
    var limit = $('input[name="filter-limit"]').val();

    $('input:checkbox[name=brands]:checked').each(function () {

        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });
        $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category_mobile]:checked').length; i++) {
            selected = $('input:checkbox[name=category_mobile]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

        $('input:checkbox[name=size]:checked').each(function () {
            size_param.push(this.value);

            if (found) {
                size_fil = '&size=' + size_param.join('--');
            } else {
                size_fil = '&size=' + size_param.join('--');
                found = true;
            }

        });

    $('input:checkbox[name=gender]:checked').each(function () {
            gender_param.push(this.value);

            if (found) {
                gender_fil = '&gender=' + gender_param.join('--');
            } else {
                gender_fil = '&gender=' + gender_param.join('--');
                found = true;
            }

    });

        $('input:checkbox[name=movement]:checked').each(function () {
            movement_param.push(this.value);

            if (found) {
                movement_fil = '&movement=' + movement_param.join('--');
            } else {
                movement_fil = '&movement=' + movement_param.join('--');
                found = true;
            }

    });

        $('input:checkbox[name=bandwidth]:checked').each(function () {
            bandwidth_param.push(this.value);

            if (found) {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
            } else {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
                found = true;
            }

        });

        $('input:checkbox[name=type]:checked').each(function () {
            type_param.push(this.value);

            if (found) {
                type_fil = '&type=' + type_param.join('--');
            } else {
                type_fil = '&type=' + type_param.join('--');
                found = true;
            }

        });

        $('input:checkbox[name=water]:checked').each(function () {
            water_param.push(this.value);

            if (found) {
                water_fil = '&water=' + water_param.join('--');
            } else {
                water_fil = '&water=' + water_param.join('--');
                found = true;
            }

        });

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = '&sort=' + sort.join('--');
            found = true;
        }
    });


        $('input:radio[name=price]:checked').each(function () {
                minPrice = this.value.split('-')[0];
                maxPrice = this.value.split('-')[1];
            });

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_fil + bandwidth_fil + gender_fil + type_fil + water_fil + movement_fil + category_param + sort_param + price_param + sortby;
    pagination = '&page=1&limit='+limit;

    //console.log(params);
        $.ajax({
        type: "POST",
        url: baseUrl + '/category/filterajax',
        data: {
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            window.location.href = baseUrl + '/' + $('input[name="breadcrumb"]').val() + '?' + params + pagination;
                }
            });
        // window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});

$('input#apply-filters-promo-mobile').click(function() {
    // e.preventDefault();

        var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            size_param = [],
            price_param = [],
                        gender_param = [],
                        type_param = [],
                        water_param = [],
                        bandwidth_param = [];
                                                movement_param = [];
                                                filter_param = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_fil = '',
            price_fil = '',
                        gender_fil = '',
                        type_fil = '',
                        water_fil = '',
                        bandwidth_fil = '',
                                                movement_fil = '',
            category_name = '',
            selected = '',
            category_active = '',
            old_category_name = '';
                        filter_fil = '';

    var found = false;

    var sortby = '&sortby=' + $('input[name="sortby"]').val();
    var limit = $('input[name="filter-limit"]').val();

    $('input:checkbox[name=brands-mobile]:checked').each(function () {

        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });
        $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category_mobile]:checked').length; i++) {
            selected = $('input:checkbox[name=category_mobile]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category_mobile]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

        $('input:checkbox[name=size-mobile]:checked').each(function () {
            size_param.push(this.value);

            if (found) {
                size_fil = '&size=' + size_param.join('--');
            } else {
                size_fil = '&size=' + size_param.join('--');
                found = true;
            }

        });

    $('input:checkbox[name=gender-mobile]:checked').each(function () {
            gender_param.push(this.value);

            if (found) {
                gender_fil = '&gender=' + gender_param.join('--');
            } else {
                gender_fil = '&gender=' + gender_param.join('--');
                found = true;
            }

    });

        $('input:checkbox[name=movement-mobile]:checked').each(function () {
            movement_param.push(this.value);

            if (found) {
                movement_fil = '&movement=' + movement_param.join('--');
            } else {
                movement_fil = '&movement=' + movement_param.join('--');
                found = true;
            }

    });

        $('input:checkbox[name=bandwidth-mobile]:checked').each(function () {
            bandwidth_param.push(this.value);

            if (found) {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
            } else {
                bandwidth_fil = '&bandwidth=' + bandwidth_param.join('--');
                found = true;
            }

        });

        $('input:checkbox[name=type-mobile]:checked').each(function () {
            type_param.push(this.value);

            if (found) {
                type_fil = '&type=' + type_param.join('--');
            } else {
                type_fil = '&type=' + type_param.join('--');
                found = true;
            }

        });

        $('input:checkbox[name=water-mobile]:checked').each(function () {
            water_param.push(this.value);

            if (found) {
                water_fil = '&water=' + water_param.join('--');
            } else {
                water_fil = '&water=' + water_param.join('--');
                found = true;
            }

        });

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = '&sort=' + sort.join('--');
            found = true;
        }
    });


        $('input:radio[name=price-mobile]:checked').each(function () {
                minPrice = this.value.split('-')[0];
                maxPrice = this.value.split('-')[1];
            });

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_fil + bandwidth_fil + gender_fil + type_fil + water_fil + movement_fil + category_param + sort_param + price_param + sortby;
    pagination = '&page=1&limit='+limit;

    //console.log(params);
        $.ajax({
        type: "POST",
        url: baseUrl + '/category/filterajax',
        data: {
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            window.location.href = baseUrl + '/' + $('input[name="breadcrumb"]').val() + '?' + params + pagination;
                }
            });
        // window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});


$("input#apply-filter").on('click', function (e) {
    e.preventDefault();

    var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            filter_band = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_param = '',
            band_param = '',
            price_param = '',
            category_name = '',
            selected = '',
            category_active = '',
            pagination = '',
            old_category_name = '';

    var found = false;

    $('input:checkbox[name=brands]:checked').each(function () {

        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category]:checked').length; i++) {
            selected = $('input:checkbox[name=category]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

    $('input:checkbox[name=filter_size]:checked').each(function () {
        filter_size.push(this.value);

        if (found) {
            size_param = '&size=' + filter_size.join('--')+"&";
        } else {
            size_param = '&size=' + filter_size.join('--')+"&";
            found = true;
        }
    });

    $('input:checkbox[name=filter_bandwidth]:checked').each(function () {
        filter_band.push(this.value);

        if (found) {
            band_param = '&bandwidth=' + filter_band.join('--')+"&";
        } else {
            band_param = '&bandwidth=' + filter_band.join('--');
            found = true;
        }
    });

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        currentAction = this.value;

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = 'sort=' + sort.join('--');
            found = true;
        }
    });

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_param + band_param + category_param + sort_param + price_param;
    pagination = '&page=1&limit=20';

    //console.log(params);
    window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;
});

/*filter essentials sale*/
$("input#apply-filtersale").on('click', function (e) {
    e.preventDefault();

    var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            filter_band = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_param = '',
            band_param = '',
            price_param = '',
            category_name = '',
            selected = '',
            category_active = '',
            pagination = '',
            old_category_name = '';

    var found = false;

    $('input:checkbox[name=brands]:checked').each(function () {
        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category]:checked').length; i++) {
            selected = $('input:checkbox[name=category]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

    $('input:checkbox[name=filter_size]:checked').each(function () {
        filter_size.push(this.value);

        if (found) {
            size_param = '&size=' + filter_size.join('--') +'&';
        } else {
            size_param = '&size=' + filter_size.join('--')+"&";
            found = true;
        }
    });

    $('input:checkbox[name=filter_bandwidth]:checked').each(function () {
        filter_band.push(this.value);

        if (found) {
            band_param = '&bandwidth=' + filter_band.join('--')+'&';
        } else {
            band_param = '&bandwidth=' + filter_band.join('--');
            found = true;
        }
    });

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        currentAction = this.value;

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = 'sort=' + sort.join('--');
            found = true;
        }
    });

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_param + band_param + category_param + sort_param + price_param;
    pagination = '&page=1&limit=20';

    //console.log(params);

    window.location.href = baseUrl + '/essentialsale?' + params + pagination;
});

/*-----------*/

/*for filter watches sale*/

$("input#apply-filtersales").on('click', function (e) {
    e.preventDefault();

    var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            filter_band = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_param = '',
            band_param = '',
            price_param = '',
            category_name = '',
            selected = '',
            category_active = '',
            pagination = '',
            old_category_name = '';

    var found = false;

    $('input:checkbox[name=brands]:checked').each(function () {
        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category]:checked').length; i++) {
            selected = $('input:checkbox[name=category]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

    $('input:checkbox[name=filter_size]:checked').each(function () {
        filter_size.push(this.value);

        if (found) {
            size_param = '&size=' + filter_size.join('--')+"&";
        } else {
            size_param = '&size=' + filter_size.join('--')+"&";
            found = true;
        }
    });

    $('input:checkbox[name=filter_bandwidth]:checked').each(function () {
        filter_band.push(this.value);

        if (found) {
            band_param = '&bandwidth=' + filter_band.join('--')+"&";
        } else {
            band_param = '&bandwidth=' + filter_band.join('--');
            found = true;
        }
    });

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        currentAction = this.value;

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = 'sort=' + sort.join('--');
            found = true;
        }
    });

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_param + band_param + category_param + sort_param + price_param;
    pagination = '&page=1&limit=20';

    //console.log(params);

    window.location.href = baseUrl + '/watchsale?' + params + pagination;
});
/*----------------------*/

/*for filter all product sale*/

$("input#apply-filterallsale").on('click', function (e) {
    e.preventDefault();

    var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            filter_band = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_param = '',
            band_param = '',
            price_param = '',
            category_name = '',
            selected = '',
            category_active = '',
            pagination = '',
            old_category_name = '';

    var found = false;

    $('input:checkbox[name=brands]:checked').each(function () {
        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    $('input:checkbox[name=category]:checked').each(function () {
        var i = 0;
        var j = 0;
        var k = 0;

        for (i = 0; i < $('input:checkbox[name=category]:checked').length; i++) {
            selected = $('input:checkbox[name=category]:checked')[i]['dataset']['id'];
            if (category_active != selected && i == 0) {
                category_active = selected;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            else if (category_active != selected) {
                category_selected[k] = [category_active, data_id];
                category_active = selected;
                data_id = [];
                j = 0;
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
                k++;
            }
            else {
                data_id[j] = $('input:checkbox[name=category]:checked')[i].value;
            }
            j++;
        }

        category_selected[k] = [category_active, data_id];

        for (i = 0; i < category_selected.length; i++) {
            category_name = category_selected[i][0];
            category = [];
            for (j = 0; j < category_selected[i][1].length; j++) {
                category.push(category_selected[i][1][j]);
            }
            if (found) {
                category_param = category_param + '&' + category_name + '=' + category.join('--');
            } else {
                category_param = category_name + '=' + category.join('--');
                found = true;
            }
        }
        return false;
    });

    $('input:checkbox[name=filter_size]:checked').each(function () {
        filter_size.push(this.value);

        if (found) {
            size_param = '&size=' + filter_size.join('--')+"&";
        } else {
            size_param = '&size=' + filter_size.join('--')+"&";
            found = true;
        }
    });

    $('input:checkbox[name=filter_bandwidth]:checked').each(function () {
        filter_band.push(this.value);

        if (found) {
            band_param = '&bandwidth=' + filter_band.join('--')+"&";
        } else {
            band_param = '&bandwidth=' + filter_band.join('--');
            found = true;
        }
    });

    $('input:radio[name=sort]:checked').each(function () {
        sort.push(this.value);

        currentAction = this.value;

        if (found) {
            sort_param = '&sort=' + sort.join('--');
        } else {
            sort_param = 'sort=' + sort.join('--');
            found = true;
        }
    });

    if (found) {
        price_param = '&price=' + minPrice + '--' + maxPrice;
    } else {
        price_param = 'price=' + minPrice + '--' + maxPrice;
    }

    params = brands_param + size_param + band_param + category_param + sort_param + price_param;
    pagination = '&page=1&limit=20';

    //console.log(params);

    window.location.href = baseUrl + '/sale?' + params + pagination;
});
/*----------------------*/

    $("input#apply-filterpromo").on('click', function (e) {
    e.preventDefault();

    var brands = [],
            category = [],
            data_id = [],
            category_selected = [],
            sort = [],
            filter_size = [],
            filter_band = [];

    var brandStr1 = '',
            brandStr2 = '',
            res = '',
            params = '',
            brands_param = '',
            category_param = '',
            sort_param = '',
            size_param = '',
            band_param = '',
            price_param = '',
            category_name = '',
            selected = '',
            category_active = '',
            pagination = '',
            old_category_name = '';

    var found = false;

    $('input:checkbox[name=brands]:checked').each(function () {
        brands.push(this.value);

        brands_param = 'brands=' + brands.join('--');
        found = true;

    });

    params = brands_param;
    pagination = '&page=1&limit=20';

    //console.log(params);

    window.location.href = baseUrl + '/promo-lebaran?' + params + pagination;
});

$('span.subscribe-newsletter').on('click', function (e) {
    e.preventDefault();
//    alert();
    $("#subscribeModal").modal('show');
});

$('div#subscribe').on('click', function (e) {
    e.preventDefault();

    var fname = $('input[name="firstname_subscribe"]').val(),
        email = $('input[name="email_subscribe"]').val();

    if (fname == '') {
        $('input[name="firstname_subscribe"]').focus();
        return false;
    }

    if (email == '') {
        $('input[name="email_subscribe"]').focus();
        return false;
    } else if (!validateEmail(email)) {
        $('input[name="email_subscribe"]').focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/subscribe',
        data: {
            "firstname": $("input[name=firstname_subscribe]").val(),
            "email": $("input[name=email_subscribe]").val(),
            "gender": "men",
            "_csrf": csrf
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
//                $('div.subscribe.success.title').show();
                return;
            } else if (d === 'TRUE') {
                $('div#popup-subscribe-form1').hide();
                $('div#popup-subscribe-form2').hide();
                $('div#popup-subscribe-form3').hide();
                $('div#popup-subscribe-form4').hide();
                $('div#popup-subscribe-form5').hide();
                $('div#popup-subscribe-form6').hide();

                $('div#popup-subscribe-thanks1').show();
                $('div#popup-subscribe-thanks2').show();
         

				sendSubscribeNewsletter();
            }
            $('#loadingScreen').modal('hide');
        }
    });
});
$('div#subscribe-fem').on('click', function (e) {
    e.preventDefault();

    var fname = $('input[name="firstname_subscribe"]').val(),
        email = $('input[name="email_subscribe"]').val();

    if (fname == '') {
        $('input[name="firstname_subscribe"]').focus();
        return false;
    }

    if (email == '') {
        $('input[name="email_subscribe"]').focus();
        return false;
    } else if (!validateEmail(email)) {
        $('input[name="email_subscribe"]').focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/subscribe',
        data: {
            "firstname": $("input[name=firstname_subscribe]").val(),
            "email": $("input[name=email_subscribe]").val(),
            "gender": "women",
            "_csrf": csrf
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
//                $('div.subscribe.success.title').show();
                return;
            } else if (d === 'TRUE') {
                $('div#popup-subscribe-form1').hide();
                $('div#popup-subscribe-form2').hide();
                $('div#popup-subscribe-form3').hide();
                $('div#popup-subscribe-form4').hide();
                $('div#popup-subscribe-form5').hide();
                $('div#popup-subscribe-form6').hide();

                $('div#popup-subscribe-thanks1').show();
                $('div#popup-subscribe-thanks2').show();
         

                sendSubscribeNewsletter();
            }
            $('#loadingScreen').modal('hide');
        }
    });
});

$("a#forgot-password").on('click', function (e) {
    e.preventDefault();

    $("div#forgot-btn-box").show();
    $("div#forgot-form-box").show();
    $("div#forgot-form-content").show();

    $("div#signin-box").hide();
});

$('div#retrieve-btn').on('click', function (e) {
    e.preventDefault();

    if ($('input[name=email_forgot]').val() == '') {
        $('span#email-forgot-top-error').show();
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/forgot-password',
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        data: {
            "email": $("input[name=email_forgot]").val(),
            "_csrf": csrf
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#email-forgot-top-error').text('Email not found!');
                $('span#email-forgot-top-error').show();
                $('#loadingScreen').modal('hide');
                return;
            } else if (d === 'TRUE') {
                $('span#email-forgot-top-error').css("color","#1d6068");
                $('span#email-forgot-top-error').css("display","block");
                $('span#email-forgot-top-error').text('AN EMAIL CONFIRMATION HAS BEEN SENT');
                $('#loadingScreen').modal('hide');
            }
        }
    });
})

function retrieve_mobile() {

    if ($('input[name=email_forgot_password_mobile]').val() == '') {
        $('span#email-forgot-top-error').show();
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/forgot-password',
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        data: {
            "email": $("input[name=email_forgot_password_mobile]").val(),
            "_csrf": csrf
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#email-forgot-top-error').text('Email not found!');
                $('span#email-forgot-top-error').show();
                $('#loadingScreen').modal('hide');
                return;
            } else if (d === 'TRUE') {
                $('span#email-forgot-top-error').css("color","#1d6068");
                $('span#email-forgot-top-error').css("display","block");
                $('span#email-forgot-top-error').text('AN EMAIL CONFIRMATION HAS BEEN SENT');
                $('#loadingScreen').modal('hide');
            }
        }
    });
}

$("a.shop-social").mouseenter(function () {
    var data_id = $(this).attr("data-id");
    $('div#shop-btn-instagram-' + data_id).show();
    $('img#love-icons-' + data_id).show();
    $('span#total-love-' + data_id).show();
    $('img#comment-icons-' + data_id).show();
    $('span#total-comment-' + data_id).show();
    $('#img-social-' + data_id).addClass('hover');
}).mouseleave(function () {
    var data_id = $(this).attr("data-id");
    $('div#shop-btn-instagram-' + data_id).hide();
    $('img#love-icons-' + data_id).hide();
    $('span#total-love-' + data_id).hide();
    $('img#comment-icons-' + data_id).hide();
    $('span#total-comment-' + data_id).hide();
    $('#img-social-' + data_id).removeClass('hover');
});

$("a#out-of-stock").mouseenter(function () {
    var data_id = $(this).attr("data-id");
    $('span#out-of-stock-caption-' + data_id).show();
    $('img#out-of-stock-' + data_id).addClass('hover');
}).mouseleave(function () {
    var data_id = $(this).attr("data-id");
    $('span#out-of-stock-caption-' + data_id).hide();
    $('img#out-of-stock-' + data_id).removeClass('hover');
});

$('#more-desktop').on('click', function () {
    var maxid = $(this).data('maxid');
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: baseUrl + '/shopsocial/next?maxId=' + maxid,
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var links = [];

            // Output data
            $.each(data.images, function (i, src) {

                $.each(data.links, function (j, link) {
                    links.push(link);
                });

                $('#instagram-box').append('<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 instagram-image margin-bottom-5"><a href="#" class="shop-social" data-id="' + data.imageId[i] + '"><img id="img-social-' + data.imageId[i] + '" class="img-responsive img-social" src="' + data.images[i] + '" /><div id="shop-btn-instagram-' + data.imageId[i] + '" align="center" class="shop-btn-instagram hidden-xs" style="display: none;">SHOP NOW</div><img src="' + data.baseUrl + '/img/icons/love.png" class="love-icons hidden-xs" id="love-icons-' + data.imageId[i] + '" style="display: none;" /><span class="total-love hidden-xs" style="display: none;" id="total-love-' + data.imageId[i] + '">' + data.likes[i] + '</span><img src="' + data.baseUrl + '/img/icons/comment.png" class="comment-icons hidden-xs" id="comment-icons-' + data.imageId[i] + '" style="display: none;" /><span class="total-comment hidden-xs" id="total-comment-' + data.imageId[i] + '" style="display: none;">' + data.comments[i] + '</span><span class="hidden-xs" id="shop-social-caption-' + data.imageId[i] + '" style="display: none;">' + data.caption[i] + '</span></a></div>');

                $('#more-desktop').data('maxid', data.next_id);

                $("a[data-id=" + data.imageId[i] + "]").mouseenter(function () {
                    var data_id = data.imageId[i];
                    $('div#shop-btn-instagram-' + data_id).show();
                    $('img#love-icons-' + data_id).show();
                    $('span#total-love-' + data_id).show();
                    $('img#comment-icons-' + data_id).show();
                    $('span#total-comment-' + data_id).show();
                    $('#img-social-' + data_id).addClass('hover');
                }).mouseleave(function () {
                    var data_id = data.imageId[i];
                    $('div#shop-btn-instagram-' + data_id).hide();
                    $('img#love-icons-' + data_id).hide();
                    $('span#total-love-' + data_id).hide();
                    $('img#comment-icons-' + data_id).hide();
                    $('span#total-comment-' + data_id).hide();
                    $('#img-social-' + data_id).removeClass('hover');
                });


                $("a[data-id=" + data.imageId[i] + "]").on('click', function (e) {
                    e.preventDefault();
                    $('body').css("overflow", "hidden");
                    $("#shopSocialModal").modal('show');

                    var data_id = data.imageId[i],
                            imgSocial = $('#img-social-' + data_id),
                            caption = $("#shop-social-caption-" + data_id).text();

                    var regex = /\s+/gi;
                    var wordCount = caption.trim().replace(regex, ' ').split(' ').length;

                    if (wordCount > 50) {
                        caption = caption.substr(0, 500);
                        caption = caption.substr(0, Math.min(caption.length, caption.lastIndexOf(" "))) + ' ...';
                    }

                    $("#img-social-detail").attr('src', imgSocial[0].currentSrc);
                    $("#shop-social-caption-detail").html(caption);

                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: baseUrl + '/shopsocial/related-item?imageId=' + data_id,
                        success: function (data) {
                            var product = data.product;
                            if (product.length) {
                                $('div#shop-social-product').html('');
                                $.each(product, function (i, src) {
                                    if (i % 2 === 0) {
                                        $('div#shop-social-product').append('<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft text-to-center remove-padding-left margin-bottom-5"><a target="_blank" href="' + product[i].link_rewrite + '" id="product-url"><img style="margin-bottom: 4%;" src="' + product[i].image_url + '" class="img-responsive" /><span class="gotham-light hidden-lg hidden-md hidden-sm" style="font-size: 1rem; letter-spacing: 0px;">' + product[i].brand_name + '</span><br class="hidden-lg hidden-md hidden-sm" /><span class="gotham-medium hidden-lg hidden-md hidden-sm" style="font-size: 1rem; letter-spacing: 0px;">' + product[i].product_name + '</span><br class="hidden-lg hidden-md hidden-sm"/><span class="gotham-medium shop-social-price">IDR ' + product[i].price + '</span></a></div>');
                                    }
                                    else {
                                        $('div#shop-social-product').append('<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 clearleft text-to-center remove-padding-right margin-bottom-5"><a target="_blank" href="' + product[i].link_rewrite + '" id="product-url"><img style="margin-bottom: 4%;" src="' + product[i].image_url + '" class="img-responsive" /><span class="gotham-light hidden-lg hidden-md hidden-sm" style="font-size: 1rem; letter-spacing: 0px;">' + product[i].brand_name + '</span><br class="hidden-lg hidden-md hidden-sm" /><span class="gotham-medium hidden-lg hidden-md hidden-sm" style="font-size: 1rem; letter-spacing: 0px;">' + product[i].product_name + '</span><br class="hidden-lg hidden-md hidden-sm"/><span class="gotham-medium shop-social-price">IDR ' + product[i].price + '</span></a></div>');
                                    }
                                });
                            } else {
                                $('div#shop-social-product').html('');
                            }
                        }
                    });
                });
            });
            $('#loadingScreen').modal('hide');
        }
    });
});

$('a.shop-social').on('click', function (e) {
    e.preventDefault();
    $("#shopSocialModal").modal('show');

    var data_id = $(this).attr("data-id"),
            imgSocial = $('#img-social-' + data_id),
            caption = $("#shop-social-caption-" + data_id).text();

    var regex = /\s+/gi;
    var wordCount = caption.trim().replace(regex, ' ').split(' ').length;

    if (wordCount > 50) {
        caption = caption.substr(0, 500);
        caption = caption.substr(0, Math.min(caption.length, caption.lastIndexOf(" "))) + ' ...';
    }

    $("#img-social-detail").attr('src', imgSocial[0].currentSrc);
    $("#shop-social-caption-detail").html(caption);

    $.ajax({
        type: "GET",
        dataType: "json",
        url: baseUrl + '/shopsocial/related-item?imageId=' + data_id,
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {

            $('body').addClass('modal-open');
            var product = data.product;
            if (product.length) {
                $('div#shop-social-product').html('');
                $.each(product, function (i, src) {
                    $('div#shop-social-product').append('<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 clearleft"><a target="_blank" href="' + product[i].link_rewrite + '" id="product-url"><img style="margin-bottom: 4%;" src="' + product[i].image_url + '" class="img-responsive" /><span class="gotham-medium">IDR ' + product[i].price + '</span></a></div>');
                });
            } else {
                $('div#shop-social-product').html('');
            }
            $('#loadingScreen').modal('hide');
            $('body').css("overflow", "hidden");
        }
    });
});

function rm_overflow_body() {
    $('body').css("overflow", "auto");
}

function add_overflow_body() {
    $('body').css("overflow", "hidden");
}

function goto(id) {
    var offset = $('#city-' + id).offset();
    $('html,body').animate({
        scrollTop: offset.top - 10
    }, 1000)
}

$('#newshipping-form').on('beforeSubmit', function (event, jqXHR, settings) {
    var form = $(this),
            province_name = $('select#province option:selected').text(),
            state_name = $('select#state option:selected').text(),
            district_name = $('select#district option:selected').text();

    $('input[name="province_name"]').val(province_name);
    $('input[name="state_name"]').val(state_name);
    $('input[name="district_name"]').val(district_name);

    if ($('select#province option:selected').val() == 0 ||
            $('select#state option:selected').val() == 0 ||
            $('select#district option:selected').val() == 0 ||
            $('input[id="new_address_fname"]').val() == '' ||
            $('input[id="new_address_phone"]').val() == '' ||
            $('input[id="new_address_address"]').val() == '' ||
            $('input[id="new_address_zip"]').val() == '') {
        return false;
    }
});

$('#hgbundling-form').on('beforeSubmit', function (event, jqXHR, settings) {

    event.preventDefault();

    var straps = document.getElementsByName('hgstraps[]'),
        watches = document.getElementsByName('hgwatches[]'),
        checked_watches = 0,
        checked_straps = 0;

    for (var i = 0, length = straps.length; i < length; i++) {
        if (straps[i].checked) {
            checked_straps++;
        }
    }

    for (var i = 0, length = watches.length; i < length; i++) {
        if (watches[i].checked) {
            checked_watches++;
        }
    }

    if (checked_watches === 0){
        alert('Please Select Watches');
        return false;
    } else if(checked_straps === 0){
        alert('Please Select Straps');
        return false;
    }

});

$('#hgstraps-form').on('beforeSubmit', function (event, jqXHR, settings) {

    event.preventDefault();

    var straps = document.getElementsByName('hgstraps[]'),
        checked = 0;

    for (var i = 0, length = straps.length; i < length; i++) {
        if (straps[i].checked) {
            checked++;
        }
    }

    if (checked === 0){
        alert('Please Select Straps');
        return false;
    }

});
$('#confirmorder-form').on('beforeSubmit', function (event, jqXHR, settings) {
    $("#loadingScreen").modal('show');
});

$('#resetpassword-form').on('beforeSubmit', function (event, jqXHR, settings) {
    var new_password = $('input[name="new_password"]').val(),
            c_password = $('input[name="confirm_password"]').val();

    if (new_password == '' || c_password == '') {
        return false;
    }
});

$("a#reset_password_signin").on('click', function (e) {
    var email = $('input[name="email_signin_forgot"]').val();

    if (email == '') {
        $('input[name="email_signin_forgot"]').focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/forgot-password',
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        data: {
            "email": email,
            "_csrf": csrf
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#email-signin-forgot-popup-error').text('Email not found!');
                $('span#email-signin-forgot-popup-error').show();
                $('#loadingScreen').modal('hide');
                return;
            } else if (d === 'TRUE') {
                $('span#email-signin-forgot-popup-error').text('AN EMAIL CONFIRMATION HAS BEEN SENT');
                $('#loadingScreen').modal('hide');
            }
        }
    });

});
