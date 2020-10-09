var acquiringBank = 'mandiri';

$(window).load(function(){
	if(typeof isOrderConfirmed !== 'undefined' && isOrderConfirmed === false)
	{
		$('#confirmModal').modal('show');
	}
	//$('#subscribeHpn').modal('show');
});
$('a#ied-modal-checkout').click(function(){
      $('#ied-modal-bag').modal('show');
});

$('form.corporate_form').submit(function () {

    // Get the Login Name value and trim it
    var name = $.trim($('#fullname').val());
    var company_name = $.trim($('#company_name').val());
    var phone_number = $.trim($('#phone_number').val());
    var email = $.trim($('#email').val());
    var message = $.trim($('#message').val());
    
    if ($('#message').val().length > 2000) {
        alert('Pesan lebih dari 2000');
        return false;
    }
    
    // Check if empty of not
    if (name === '') {
        alert('Nama Lengkap harus diisi');
        return false;
    }
    // Check if empty of not
    if (company_name === '') {
        alert('Nama Perusahaan harus diisi');
        return false;
    }
    // Check if empty of not
    if (phone_number === '') {
        alert('Nomor Telepon harus diisi');
        return false;
    }
    // Check if empty of not
    if (email === '') {
        alert('Email harus diisi');
        return false;
    }
    // Check if empty of not
    if (message === '') {
        alert('Pesan harus diisi');
        return false;
    }
    
    if (!validateEmail(email)) {
        alert('Email tidak valid.');
        return false;
    }
    
});

$('#spnCharLeft').css('display', 'none');
$('#spnCharLeft').css('float', 'right');

$('textarea[name="CorporateOrder[message]"]').keyup(updateCount);
$('textarea[name="CorporateOrder[message]"]').keydown(updateCount);
var maxLimit = 2000;
function updateCount() {
    var lengthCount = $('textarea[name="CorporateOrder[message]"]').val().length;              
        if (lengthCount > maxLimit) {
            $('textarea[name="CorporateOrder[message]"]').val() = $('textarea[name="CorporateOrder[message]"]').val().substring(0, maxLimit);
            var charactersLeft = maxLimit - lengthCount + 1;                   
        }
        else {                   
           var charactersLeft = maxLimit - lengthCount;                   
        }
        $('#spnCharLeft').css('display', 'block');
        $('#spnCharLeft').text(charactersLeft + ' Char left');
}
    

function confirmVospayOrder(transactionDetails){
	$.ajax({
        type: "POST",
        url: baseUrl + '/api/checkout/confirmorder',
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
        data: JSON.stringify(transactionDetails),
        success: function (data) {
            var d = data;
			console.log(data);
            if (d.success) {
				
				vospayConfig = {
					merchantKey: 'd9a16f7e5731b79230e35f27a4faab4d',
					transactionDetails: {
						orderID: d.vospayOrderId,
						orderDescription: 'The Watch Co. - Order Information',
						items: vospayOrderItems,
						currency: 'IDR',
						shipping: vospayShipping,
						grossAmount: vospayGrossAmount,
						customerDetails: vospayCustomerDetails
					},
					onDone: (result) => {
						var status = result.status;
						
						//if(status == "Success"){
							window.location = 'https://www.thewatch.co/cart/checkout/step/ordercomplete';
						//}
					},
					onError: (error) => {
						console.log('Payment error:', error);
					},
					logoURL: 'https://www.thewatch.co/img/logos/logo.png',
					notifyEndpoint: 'https://www.thewatch.co/api/payment/notification'
				}
				
                $('#loadingScreen').modal('hide');
				
				vospay.payNow(vospayConfig);
            } else {
				$('#loadingScreen').modal('hide');
				return;
            }
        }
    });
}

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
    
    var bulkhead_flagship = $('#bulkhead-flagship').html();
    var search_warranty = $('#search-warranty').html();
    
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
                
                if ($("#warranty-card-scroll").length) {
                  if(scroll < 160){
                    $('#bulkhead-flagship').html(bulkhead_flagship);
                   
                  }else{
                    $('#bulkhead-flagship').html(search_warranty);
               
                  }
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
    /*
    $('.product-wrap').each(function(){ //loop through each element with the .dynamic-height class
        $(this).css({
            'margin-bottom' : $(this).outerHeight() + 5 + 'px' //adjust the css rule for margin-top to equal the element height + 15px and add the measurement unit "px" for valid CSS
        });
    });
    */

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

$("#account-mobile").click(function () {

    $header = $(this);
    //getting the next element
    $content = $header.next();
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(function () {
        //execute this after slideToggle is done
        //change text of header based on visibility of content div
        // $header.text(function () {
            //change text based on condition
            return $content.is(":visible") ? $('.arrow-down-account').attr('src',baseUrl + '/img/icons/up-arrow-16.png') : $('.arrow-down-account').attr('src',baseUrl + '/img/icons/down-arrow-16.png');
        // });
    });

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
            $('#akulaku').hide();
            
            $('#shipping-menu').removeClass("active");
            $('#akulaku-menu').removeClass("active");
            $('#ordering-menu').addClass("active");
        }
        else if (event == 'shipping') {
            $('#ordering').hide();
            $('#shipping').fadeIn();
            $('#ordering-menu').removeClass("active");
            $('#shipping-menu').removeClass("active");
            $('#shipping-menu').addClass("active");
        }
        else if (event == 'akulaku') {
            $('#ordering').hide();
            $('#shipping').hide();
            $('#akulaku').fadeIn();
            $('#ordering-menu').removeClass("active");
            $('#shipping-menu').removeClass("active");
            $('#akulaku-menu').addClass("active");
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
            original_price = $('input[name=original_price]')[0].value,
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
        "original_unit_price": original_price,
        "original_total_price": (original_price * quantity),
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
            original_price = $('input[name=original_price]')[0].value,
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
        "original_unit_price": original_price,
        "original_total_price": (original_price * quantity),
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
            original_price = $('input[name=original_price]')[0].value,
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
            "original_unit_price": original_price,
            "original_total_price": (original_price * quantity),
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
            original_price = $('input[name=original_price]')[0].value,
            price = $('input[name=price]')[0].value,
            brandName = $('input[name=brand_name]')[0].value,
            url = $('input[name=link-rewrite]')[0].value,
            color = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').text() : '',
            size = $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').text() : '',
            weight = $('input[name=weight]')[0].value,
            imageUrl = $('select.color').length && !$('select.color').is(':disabled') ? $('a[id=' + attribute_value_id + ']').attr("data-image") : $('a[id=0]').attr("data-image"),
            flash_sale = $('input[name=flash_sale]')[0].value,
            pre_order = $('input[name=pre_order]')[0].value,
            category_id = $('input[name=productCategoryID]')[0].value,
            category_desc = $('input[name=productCategoryDesc]')[0].value,
            category = $('input[name=productCategory]')[0].value;

	var cartItem = [];

	cartItem.push({
		"id": id,
		"name": $('input[name=product_name]')[0].value,
		"price": price,
		"brand": brandName,
		"category_id": $('input[name=productCategoryID]')[0].value,
		"category_desc": $('input[name=productCategoryDesc]')[0].value,
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
            "original_unit_price": original_price,
            "original_total_price": (original_price * quantity),
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
            "flash_sale": flash_sale,
            "pre_order": pre_order,
            "category_id": category_id,
            "category_desc": category_desc,
            "category": category,
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
            
            if($('input[name=flash_sale]')[0].value == 1){
                $(".product-addtocart").css("display","none");
                $(".product-select").css("display","none");
            }
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

function address_select(){
    var selectBox = document.getElementById("address-select");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    // console.log(selectedValue);
    if(selectedValue != 0){
      $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-address',
            data: {
                "id": selectedValue,
            },
            dataType: 'json',
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                // console.log(data);
                $('input[name="shipping_method"]:checked').each(function(){
                    $(this).prop('checked', false);
                });
                $('#loadingScreen').modal('hide');
                $("div#view-shipping").html(data[1]);
                $('div#view-address').html(data[0]);
                $('input[name="shipping"]').val(data[2]);
            }
        });
    }
    
}

function shipping_method(id){
   
    var selectedValue = id;
    // var item_total = $('#item-total').html;
    // var total = $('#total-purchase').html;
    // var discount = $('#discount').html;
    // if ($('input:radio:checked').length > 0 && $('select#shipping-method option:selected').val() != 0) {
      console.log($('input#shipping_insurance').is(':checked') ? 1 : 0);
        var customer_address_id = $('input[name=shipping]').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + '/cart/checkout/shippingmethod',
            data: {
              "id_select": selectedValue, 
              "customer_address_id": customer_address_id, 
              "shipping_method": selectedValue,
              "shipping_insurance": $('input#shipping_insurance').is(':checked') ? 1 : 0
            },
            beforeSend: function () {

            },
            success: function (data) {
    //            console.log(data);
                var d = data;
                if (d.valid) {
                    $('span#ongkir').html(d.currency + ' ' + d.shipping_price);
                    $('#total-purchase').html(d.currency + ' ' + d.total);
                    $('input[name=shippingmet]').val(selectedValue);
                    // $('span#shippinginsurance').html(d.currency + ' ' + d.shipping_insurance);
                    // grossamount = d.total;
                    // grossamount = d.total.split('.').join("");
                    // alert(d.shipping_price);
                } else {
                    // $('span.voucher-message').html(d.message);
                }
            }
        });
    // }else{
    //     $('div.signup-error').show();
    // }
}

function voucher_select() {

    var selectBox = document.getElementById("voucher-select");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

    $('input[name=code]').val(selectedValue);

    var code = selectedValue;
    var total = $('#total-purchase');

    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseUrl + '/cart/voucher/check',
        data: {"code": code},
        beforeSend: function () {

        },
        success: function (data) {
//            console.log(data);
            var d = data;
            if (d.valid) {
                $('span#discount').html(d.currency + ' ' + d.discount);
                $('#total-purchase').html(d.currency + ' ' + d.total);
                $('span#ongkir').html(d.currency + ' ' + d.shipping);
                grossamount = d.total;
                grossamount = d.total.split('.').join("");
            } else {
                $('span.voucher-message').html(d.message);
            }
        }
    });

};
function voucher_select_mobile() {

    var selectBox = document.getElementById("voucher-select-mobile");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

    $('input[name=code]').val(selectedValue);

    var code = selectedValue;
    var total = $('#total-purchase');
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseUrl + '/cart/voucher/check',
        data: {"code": code},
        beforeSend: function () {

        },
        success: function (data) {
//            console.log(data);
            var d = data;
            if (d.valid) {
                $('span#discount').html(d.currency + ' ' + d.discount);
                $('#total-purchase').html(d.currency + ' ' + d.total);
                $('span#ongkir').html(d.currency + ' ' + d.shipping);
                grossamount = d.total;
                grossamount = d.total.split('.').join("");
            } else {
                $('span.voucher-message').html(d.message);
            }
        }
    });

};

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

$("a#payment-info").hover(function(){
    $("#gopay-img").attr("src",baseUrl + "/img/icons/gopay-black.png");
}, function(){
    $("#gopay-img").attr("src",baseUrl + "/img/icons/gopay-white.png");
});

/**
 * Countdown Time
*/
$(function() {
    if($('#complete-order-gopay').length){
      $("#qr-gopay-modal").modal({backdrop: 'static', keyboard: false});

      $('[id=minute-expire]').countdown(expire_time, {elapse: true})
        .on('update.countdown', function(event){
            var $this = $(this);
            if (event.elapsed) {
                // after end
                $('#complete-order-gopay').attr('id','complete-order-gopay-cancel');
                location.reload();
//                $("#countdown-product-box").hide();
            } else {
                $this.html(event.strftime('%M'));
            }
        });

      $('[id=second-expire]').countdown(expire_time, {elapse: true})
        .on('update.countdown', function(event){
            var $this = $(this);
            if (event.elapsed) {
                // after end
                $('#complete-order-gopay').attr('id','complete-order-gopay-cancel');
                location.reload();
//                $("#countdown-product-box").hide();
            } else {
                $this.html(event.strftime('%S'));
            }
        });

    }

    if($('#complete-order-gopay-redirect').length){
      
      $('[id=minute-expire]').countdown(expire_time, {elapse: true})
        .on('update.countdown', function(event){
            var $this = $(this);
            if (event.elapsed) {
                // after end
                $('#complete-order-gopay').attr('id','complete-order-gopay-cancel');
                location.reload();
//                $("#countdown-product-box").hide();
            } else {
                $this.html(event.strftime('%M'));
            }
        });

      $('[id=second-expire]').countdown(expire_time, {elapse: true})
        .on('update.countdown', function(event){
            var $this = $(this);
            if (event.elapsed) {
                // after end
                $('#complete-order-gopay').attr('id','complete-order-gopay-cancel');
                location.reload();
//                $("#countdown-product-box").hide();
            } else {
                $this.html(event.strftime('%S'));
            }
        });
      window.location = gopay_deeplink;

    }
	
	

});

function choose_payment(id,method_id){
  $('#mf_frame').css("border","none");
  $('#cc_frame').css("border","none");
  $('#bt_frame').css("border","none");
  $('#i_frame').css("border","none");
  $('#va_frame').css("border","none");
  $('#w_frame').css("border","none");
  $('#payment-info').css('display','block');
  
  if(method_id == 8){
	  $('#vospay').css('display', 'block');
	  $('#payment-info').css('display', 'none');
  } else {
	  $('#vospay').css('display', 'none');
	  $('#payment-info').css('display', 'block');
  }
  
  if(method_id == 9){
    $('#pay-default-text').css('display', 'none');
    $('#pay-gopay-text').css('display', 'block');
  }else{
    $('#pay-default-text').css('display', 'block');
    $('#pay-gopay-text').css('display', 'none');
  }
  
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
                if(method_id == 8){
                  $('#mf_frame').css("border","solid 2px rgb(32,97,103)");
                  $('div#metode-preview').css("border","solid 2px rgb(32,97,103)");
                  $("#vospayModal").modal("show");
                }
				
				if(method_id == 9){
                  $('#w_frame').css("border","solid 2px rgb(32,97,103)");
                  $('div#metode-preview').css("border","solid 2px rgb(32,97,103)");
                 
                }
				
              }else{
                $('#mf_frame').css("display","none");
                $('#cc_frame').css("display","none");
                $('#bt_frame').css("display","none");
                $('#i_frame').css("display","none");
                $('#va_frame').css("display","none");
                $('#w_frame').css("display","none");
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
                if(method_id == 8){
                  $('#mf_frame').css("display","block");
                  $("#vospayModal").modal("show");
                }
				if(method_id == 9){
                  $('#w_frame').css("display","block");
                
                }
              }
            }
        });
    
if(method_id == 8){
    $.ajax({
      type: "POST",
      url: baseUrl + '/cart/payment/get-special-promo/',
      dataType: 'json',
      data: {
        // "special_promo_id": 10, // for testing
        "special_promo_id": 9,
        "method_id": method_id,              
      },
      success: function (data) {
        if(data.length != 0){
            if(data[0] != '0'){
              $('div.special-promo').css('display','block');
              $('div.total-with-special-promo').css('display','block');
              $('div.total-without-trf').css('display','none');
              $('div.total-with-trf').css('display','none');
              $('div.special-promo-amount').html(data[0]);
              $('div.total-with-special-promo').html(data[1]);
              $('div.special-promo-name').html(data[2]);
            }
            console.log(data[1]);
        }
      }
    });
  }
  else if(method_id == 9){
    $.ajax({
      type: "POST",
      url: baseUrl + '/cart/payment/get-special-promo/',
      dataType: 'json',
      data: {
        "special_promo_id": 3,
        "method_id": method_id,              
      },
      success: function (data) {
        if(data[0] != 0){
          $('div.special-promo').css('display','block');
          $('div.total-with-special-promo').css('display','block');
          $('div.total-without-trf').css('display','none');
          $('div.total-with-trf').css('display','none');
          $('div.special-promo-amount').html(data[0]);
          $('div.total-with-special-promo').html(data[1]);
          $('div.special-promo-name').html(data[2]);
        }

        console.log(data[1]);
      }
    });
  }else{
    $('div.special-promo').css('display','none');
    $('div.total-with-special-promo').css('display','none');
  }
  
}

function choose_installment_plan(id){
  var bank = id;
  if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19 || bank == 29) {
    
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
    if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19 || bank == 29) {
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
    
    // flash sale
    // if($('input[name="flash_sale_flag"]').val() == 1){
        
    //     var installmentplan = 0;
    //       if($('input:radio[name=payment_method]:checked').attr("method-id") == 3){
    //         installmentplan = $('input:radio[name=installmentplan]:checked')[0].value;
    //       }
      
    //       $.ajax({
    //             type: "POST",
    //             url: baseUrl + '/cart/checkout/step/paymentinformation',
    //             data: {
    //             "paymentMethod": {
    //               "payment_id": $('input:radio[name=payment_method]:checked')[0].value,
    //                             "payment_method_id": $('input:radio[name=payment_method]:checked').attr("method-id"),
    //                             "installment_plan": installmentplan
    //             },
    //             "send_as_gift" : {
    //               "is_a_gift" : sendAsGift,
    //               "gift_message" : gift_message
    //             }
    //           },
    //             beforeSend: function () {
    //                 $('#loadingScreen').modal('show');
    //             },
    //             success: function (data) {
    //                 $('#loadingScreen').modal('hide');
    //                 console.log(data);
    //                     $("#confirmorder-form").submit();
    //             }
    //         });
    //   return;
    // }
    
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
            
            // check product stock
              var isOk = false;
              $.ajax({
                    type: "GET",
                    url: baseUrl + '/cart/checkout/checkstock',
                    dataType: 'json',
                    async: false,
                    data: {
                      
                    },
                    beforeSend: function () {
                        $('#loadingScreen').modal('show');
                    },
                    success: function (data) {
                        $('#loadingScreen').modal('hide');
                        if(data[0] == 'berhasil'){
                          // continue
                          console.log(data[0]);
                          isOk = true;
                        }else{
                          console.log(data[0]);
                          isOk = false;
                        }
                        
                    }
                }); 

              if(isOk == false){
                alert('maaf stock habis');
                window.location.href = baseUrl;
                return false;
              } 
              
              /**/
              function checkValue(str, strArray){
                for (var j=0; j<strArray.length; j++) {
                  if (strArray[j].match(str.substring(0, 4))) return true;
                }
                return false;
              }
              
              var cardnumber = $(".card-number").val();
              
              if(checkValue(cardnumber, permataBin)){
                grossamount -= Math.round(promoPermataMandiriAmount);
              }
              
              if(checkValue(cardnumber, mandiriBin)){
                grossamount -= Math.round(promoPermataMandiriAmount);
              }
              /**/
      
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
                    "bank": acquiringBank,
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
                    
                    // return stock
                    $.ajax({
                        type: "GET",
                        url: baseUrl + '/cart/checkout/returnstock',
                        dataType: 'json',
                        async: false,
                        data: {
                          
                        },
                        beforeSend: function () {
                            // $('#loadingScreen').modal('show');
                        },
                        success: function (data) {
                            // $('#loadingScreen').modal('hide');
                            console.log('return stock');
                        }
                    }); 
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
			
			
			function checkValue(str, strArray){
				for (var j=0; j<strArray.length; j++) {
					if (strArray[j].match(str.substring(0, 4))) return true;
				}
				return false;
			}
			
			var cardnumber = $(".card-number").val();
			
			/*
			if(checkValue(cardnumber, permataBin)){
				promoPermataAmount = grossamount * 0.05;
				grossamount -= Math.round(promoPermataAmount);
			}
			
			
			if(checkValue(cardnumber, mandiriBin)){
				grossamount -= Math.round(promoMandiriAmount);
			}
			*/
			
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
        if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19 || bank == 29) {

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
              
                // check product stock
                  var isOk = false;
                  $.ajax({
                        type: "GET",
                        url: baseUrl + '/cart/checkout/checkstock',
                        dataType: 'json',
                        async: false,
                        data: {
                          
                        },
                        beforeSend: function () {
                            $('#loadingScreen').modal('show');
                        },
                        success: function (data) {
                            $('#loadingScreen').modal('hide');
                            if(data[0] == 'berhasil'){
                              // continue
                              console.log(data[0]);
                              isOk = true;
                            }else{
                              console.log(data[0]);
                              isOk = false;
                            }
                            
                        }
                    }); 
    
                  if(isOk == false){
                    alert('maaf stock habis');
                    window.location.href = baseUrl;
                    return false;
                  }
                
                    /**/
                  function checkValue(str, strArray){
                    for (var j=0; j<strArray.length; j++) {
                      if (strArray[j].match(str.substring(0, 4))) return true;
                    }
                    return false;
                  }
                  
                  var cardnumber = $(".card-number").val();
                  
                  if(checkValue(cardnumber, permataBin)){
                    grossamount -= Math.round(promoPermataMandiriAmount);
                  }
                  
                  if(checkValue(cardnumber, mandiriBin)){
                    grossamount -= Math.round(promoPermataMandiriAmount);
                  }
                  /**/
              
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
                        "installment_term" : planValue,
                        "bank": acquiringBank,
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
                        
                        // return stock
                        $.ajax({
                            type: "GET",
                            url: baseUrl + '/cart/checkout/returnstock',
                            dataType: 'json',
                            async: false,
                            data: {
                              
                            },
                            beforeSend: function () {
                                // $('#loadingScreen').modal('show');
                            },
                            success: function (data) {
                                // $('#loadingScreen').modal('hide');
                                console.log('return stock');
                            }
                        }); 
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
				
				
				function checkValue(str, strArray){
					for (var j=0; j<strArray.length; j++) {
						if (strArray[j].match(str.substring(0, 4))) return true;
					}
					return false;
				}
				
				var cardnumber = $(".card-number").val();
				/*
				if(checkValue(cardnumber, mandiriBin)){
					grossamount -= Math.round(promoMandiriAmount);
				}
				*/
				
                //event.preventDefault();
                //$(this).attr("disabled", "disabled");
                Veritrans.token(card, callback);
                return false;
                //});
            });
        } else {
            
              /**/
                  function checkValue(str, strArray){
                    for (var j=0; j<strArray.length; j++) {
                      if (strArray[j].match(str.substring(0, 4))) return true;
                    }
                    return false;
                  }
                  
                  var cardnumber = $(".card-number").val();
                  
                //   for permata only
                  if(bank == 12){
                      if(checkValue(cardnumber, permataBin)){
                        $('input[name="special_promo"]').val(promoPermataMandiriAmount);
                        grossamount -= Math.round(promoPermataMandiriAmount);
                      }
                      
                      if(checkValue(cardnumber, mandiriBin)){
                        $('input[name="special_promo"]').val(promoPermataMandiriAmount);
                        grossamount -= Math.round(promoPermataMandiriAmount);
                      }
                  }
                  
                  /**/
                  
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

$('a#payment-flash-credit').on('click', function (e) {
    e.preventDefault();

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
                    "bank": acquiringBank,
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
      
      
      function checkValue(str, strArray){
        for (var j=0; j<strArray.length; j++) {
          if (strArray[j].match(str.substring(0, 4))) return true;
        }
        return false;
      }
      
      var cardnumber = $(".card-number").val();
      
      /*
      if(checkValue(cardnumber, permataBin)){
        promoPermataAmount = grossamount * 0.05;
        grossamount -= Math.round(promoPermataAmount);
      }
      
      
      if(checkValue(cardnumber, mandiriBin)){
        grossamount -= Math.round(promoMandiriAmount);
      }
      */
      
            //event.preventDefault();
            //$(this).attr("disabled", "disabled");
            Veritrans.token(card, callback);
            return false;
            //});
        });

});

$('a#payment-flash-installment').on('click', function (e) {
    e.preventDefault();

 
        var bank = $('input[name=payment_id]').val(),
            planValue = 3;
            
            // console.log($('input[name=payment_id]').val());return;

        // bank mandiri ke veritrans
        if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19 || bank == 29) {

            $('input[name=installment]').val('true');

            var planValue = $('input[name=installment_plan]').val();
            
            // console.log(bank);return;

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

                // $('input[name=payment_id]').val($('input:radio[name=payment_method]:checked')[0].value);
                //  $('input[name=payment_method_id]').val($('input:radio[name=payment_method]:checked').attr("method-id"));
                var card = function () {
                    return {
                        "card_number": $('.card-number').val(),
                        "card_exp_month": $('select#card-expiry-month option:selected')[0].value,
                        "card_exp_year": $('select#card-expiry-year option:selected')[0].value,
                        "card_cvv": $('.card-cvv').val(),
                        "secure": true,
                        "gross_amount": grossamount,
                        "installment" : true,
                        "installment_term" : planValue,
                        "bank": acquiringBank,
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
        
        
        function checkValue(str, strArray){
          for (var j=0; j<strArray.length; j++) {
            if (strArray[j].match(str.substring(0, 4))) return true;
          }
          return false;
        }
        
        var cardnumber = $(".card-number").val();
        /*
        if(checkValue(cardnumber, mandiriBin)){
          grossamount -= Math.round(promoMandiriAmount);
        }
        */
        
                //event.preventDefault();
                //$(this).attr("disabled", "disabled");
                Veritrans.token(card, callback);
                return false;
                //});
            });
        } else {
            $("#confirmorder-form").submit();
            // $.ajax({
            //     type: "POST",
            //     url: baseUrl + '/cart/checkout/step/paymentinformation',
            //     data: {
            //       "paymentMethod": {
            //         "payment_id": $('input[name=payment_id]').val(),
            //                     "payment_method_id": $('input[name=payment_method_id]').val(),
            //                     "installment_plan": 'i'+$('input[name=installment_plan]').val()+'m',
            //       }
            //     },
            //     beforeSend: function () {
            //         $('#loadingScreen').modal('show');
            //     },
            //     success: function (data) {
            //         $('#loadingScreen').modal('hide');
            //         console.log(data);
            //         $("#confirmorder-form").submit();
            //     }
            // });

        }
        
});

function closeModal(){
    let allModals = $('.modal-wrap');

    for(let i = 0; i<allModals.length; i++){
        $(allModals[i]).css('display', 'none');
    }
}

function terms (e){

    let buttonDaftarOn = $('#btn-terms-on');
    let buttonDaftarOff = $('#btn-terms-off');

    if(e.value === 'on'){
        buttonDaftarOn.css('display', 'block');
        buttonDaftarOff.css('display', 'none');
    }else{
        buttonDaftarOn.css('display', 'none');
        buttonDaftarOff.css('display', 'block');
    }
   
}

$('a#multipayment-flash').on('click', function (e) {
    e.preventDefault();
    $("#confirmorder-form").submit();
});

$('input:checkbox[id=send_as_gift]').on('change', function () {
    if ($('#send_as_gift').is(":checked")) {
        $("#gift_message_box").removeClass('hidden');
    } else {
        $("#gift_message_box").addClass('hidden');
    }
});

$('div#signin-btn-mobile').on('click', function (e) {
    e.preventDefault();
    var email = $('input[name=email_login_mobile]').val(),
            password = $('input[name=password_login_mobile]').val();

    if (email === '') {
        $('span#email-signin-error-mobile').show();
        $('span#email-signin-error-mobile').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#email-signin-error-mobile').show();
        $('span#email-signin-error-mobile').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#email-signin-error-mobile').hide();
    }
    
    if (password === '') {
        $('span#signin-pwderror-mobile').show();
        $('span#signin-pwderror-mobile').html('* Password Is Required!');
        return;
    } else {
        $('span#signin-pwderror-mobile').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/sign-in',
        data: {
            "email": email,
            "password": password
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
           
            var d = data;
            if (d === '"FALSE"') {
                $('span#signintop-error').show();
                $('#loadingScreen').modal('hide');
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

$('div#signin-btn').on('click', function (e) {
    e.preventDefault();
    var email = $('input[name=email]').val(),
            password = $('input[name=password]').val();
            console.log(email, password);

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
            console.log(d);
            if (d === '"FALSE"') {
                $('span#signintop-error').show();
                $('#loadingScreen').modal('hide');
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

    let emailValid = false;
    let nameValid = false;
    let phoneValid = false;
    let passwordValid = false;
    let repasswordValid = false;

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
            repassword = $('input[name=signup_password_repeat]').val();
    

    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
      
    } else if (!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
        
    } else {
        emailValid = true;
        $('span#email-error').hide();
    }

    if (fname === '') {
        $('span#firstname-error').show();
        $('span#firstname-error').html('* First Name Is Required!');
        
    } else {
        nameValid = true;
        $('span#firstname-error').hide();
    }

	if (phone === '') {
        $('span#phone-error').show();
        $('span#phone-error').html('* Phone Number Is Required!');
    } else {
        phoneValid = true;
        $('span#phone-error').hide();
    }

    if (password === '') {
        $('span#signup-pwderror').show();
        $('span#signup-pwderror').html('* Password Is Required!');
        
    } else {
        passwordValid = true;
        $('span#signup-pwderror').hide();
    }

    if (repassword !== password) {
        $('span#repassword-error').show();
        $('span#repassword-error').html('* Password not match');
        
    } else {
        repasswordValid = true;
        $('span#repassword-error').hide();
    }

    if(nameValid && emailValid && phoneValid && passwordValid && repasswordValid) {

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
                    "newsletter": null
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
    }else{
        return false;
    }
    
});

$('div#signup-btn-mobile').on('click', function (e) {
    e.preventDefault();

    let emailValid = false;
    let nameValid = false;
    let phoneValid = false;
    let passwordValid = false;
    let repasswordValid = false;

	(function(document, window) {
		var scr = document.createElement("script");
		scr.type = "text/javascript";
		scr.async = true;
		scr.src =  "//ssp.adskom.com/tags/third-party-async/NzY2MWM1NDUtNmJhNS00MmVmLWExMDMtZjIzNzJjYjNhOWU4";

		document.body.appendChild(scr);
	})(document, window);

    var email = $('input[name=signup_email_mobile]').val(),
            fname = $('input[name=fname_mobile]').val(),
			phone = $('input[name=phone_mobile]').val(),
            password = $('input[name=signup_password_mobile]').val();
            repassword = $('input[name=signup_password_repeat_mobile]').val();

            
    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
      
    } else if (!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
        
    } else {
        emailValid = true;
        $('span#email-error').hide();
    }

    if (fname === '') {
        $('span#firstname-error').show();
        $('span#firstname-error').html('* First Name Is Required!');
        
    } else {
        nameValid = true;
        $('span#firstname-error').hide();
    }

	if (phone === '') {
        $('span#phone-error').show();
        $('span#phone-error').html('* Phone Number Is Required!');
    } else {
        phoneValid = true;
        $('span#phone-error').hide();
    }

    if (password === '') {
        $('span#signup-pwderror').show();
        $('span#signup-pwderror').html('* Password Is Required!');
        
    } else {
        passwordValid = true;
        $('span#signup-pwderror').hide();
    }

    if (repassword !== password) {
        $('span#repassword-error').show();
        $('span#repassword-error').html('* Password not match');
        
    } else {
        repasswordValid = true;
        $('span#repassword-error').hide();
    }

    if(nameValid && emailValid && phoneValid && passwordValid && repasswordValid) {

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
                    // "newsletter": $('input[name=rc002]')[0].value
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
    }else{
        return false;
    }
    
});

$('div#signup').on('click', function (e) {

    e.preventDefault();

    $('div#signup-form').show();
    // $('div#signup').css('border', '1px solid #000');
    // $('div#signup').css('background', '#000');
    $('div#signup').addClass('fill-button');
    $('div#signin').removeClass('fill-button');

    $('div#signin-form').hide();
    $('div#signin').css('border-bottom', '0px');

    $('div#signin-box').hide();
    $('div#signup-box').show();

    $("div#forgot-btn-box").hide();
    $("div#forgot-form-box").hide();
    $("div#forgot-form-content").hide();
    
    $("#box-login").css("height","unset");
    $("#box-login").css("overflow","unset");

});

$('div#signin').on('click', function (e) {

    e.preventDefault();

    $('div#signup-form').hide();
    $('div#signup').removeClass('fill-button');
    $('div#signin').addClass('fill-button');

    $('div#signin-form').show();
    // $('div#signin').css('border', '1px solid #000');
    // $('div#signin').css('background', '#000');


    $('div#signin-box').show();
    $('div#signup-box').hide();
    
    $("div#forgot-btn-box").hide();
    $("div#forgot-form-box").hide();
    $("div#forgot-form-content").hide();
    
    $("#box-login").css("height","unset");
    $("#box-login").css("overflow","unset");
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

function tabSignInUp(tab){
    let signinAll = $('.tab-signin');
    let signupAll = $('.tab-signup');

    $('.signin-form').removeClass('dnone')
    $('.signup-form').removeClass('dnone')

    if(tab === 'signin'){
        
        $('.signup-form').addClass('dnone')
        $('.signin-form').removeClass('dnone')
        
        for(let i = 0; i<signinAll.length; i++){
            $(signinAll[i]).removeClass('active');
            $(signupAll[i]).addClass('active');
        }
        
    }else{

        $('.signup-form').removeClass('dnone')
        $('.signin-form').addClass('dnone')

        for(let i = 0; i<signinAll.length; i++){
            $(signinAll[0]).addClass('active');
            $(signupAll[0]).removeClass('active');
        }
    }
}

function signinCheckout(){

    var email = $("#email-login-web").val(),
        password = $('#password-login-web').val();

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
                
                $('span#signintop-error').css('display', 'block');
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
        },
        error: function (error) {
            console.log(error);
            $('span#signintop-error').removeClass('dnone');
        }
    });
};

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


function signupCheckout(){

    var email = $("input[name=email_mobile]").val(),
            firstname = $("input[name=name_mobile]").val(),
            lastname = '',
            password = $('input[name=password_mobile]').val(),
			phone = $('input[name=sign_phone_mobile]').val(),
            cpassword = $('input[name=password_repeat_mobile]').val();

    let emailValid = false,
        firstnameValid = false,
        phoneValid = false, 
        passwordValid = false,
        rePasswordValid = false;

    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
        
    } else if (!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
    } else {
        $('span#email-error').hide();
        emailValid = true;
    }

    if (firstname === '') {
        $('span#firstname-mobile-error').show();
        $('span#firstname-mobile-error').html('* First Name Is Required!');
   
    } else {
        $('span#firstname-mobile-error').hide();
        firstnameValid = true;
    }

	if (phone === '') {
        $('span#phone-mobile-error').show();
        $('span#phone-mobile-error').html('* Phone Number Is Required!');
    } else {
        $('span#phone-mobile-error').hide();
        phoneValid = true;
    }

    if (password === '') {
        $('span#password-mobile-error').show();
        $('span#password-mobile-error').html('* Password Is Required!');
    } else {
        $('span#password-mobile-error').hide();
        passwordValid = true;
    }

    if (cpassword === '') {
        $('span#password-confirm-mobile-error').show();
        $('span#password-confirm-mobile-error').html('* Password Is Required!');

    } else if (cpassword !== password) {
        $('span#password-confirm-mobile-error').show();
        $('span#password-confirm-mobile-error').html('* Password Do Not Match!');

    } else {
        $('span#password-confirm-mobile-error').hide();
        rePasswordValid = true;
    }

    if(emailValid && phoneValid && firstnameValid && passwordValid && rePasswordValid) {

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
    }
};

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

function toggleEyePassword(e) {

   var imgEye = e.children[0];
   var baseImgEye = imgEye.src.split('icons/');
   var pass = document.getElementById('password-login');
   var passMobile = document.getElementsByClassName('password-login')[0];
  
   if (pass.type === "password") {
    pass.type = "text";
    passMobile.type = "text";
    imgEye.src = baseImgEye[0] + 'icons/eye-opened.png';

   } else {
    pass.type = "password";
    passMobile.type = "password";
    imgEye.src = baseImgEye[0] + 'icons/eye-closed.png';
   }
   
}

$('a#search').on('click', function (e) {

                var $t = $("#arrow-search");
                if ($t.is(':visible')) {
                    $("#arrow-search").slideUp();
                    $("#box-search").slideUp();
                    $("#blank-popup").css('display', 'none');

                    $("#img-search").css("display","unset");
                    $("#search-hover").css("display","none");

                } else {
                    $("#arrow-search").slideDown();
                    $("#blank-popup").css('display', 'block');
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
                    
                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);

                    $("#img-search").css("display","none");
                    $("#search-hover").css("display","unset");
                    $("#img-login").css("display","unset");
                    $("#account-hover").css("display","none");
                    $("#img-cart").css("display","unset");
                    $("#cart-hover").css("display","none");
                }

     e.preventDefault();

});

            $("a#login").click(function (e) {
                var $t = $("#arrow-login");
               
                if ($t.is(':visible')) {
                    $("#arrow-login").slideUp();
                    $("#box-login").slideUp();
                    $("#blank-popup").css('display', 'none');

                    $("#img-login").css("display","unset");
                    $("#account-hover").css("display","none");
                } else {
                    $("#arrow-login").slideDown();
                    $("#box-login").slideDown();
                    $("#blank-popup").css('display', 'block');

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
                    
                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);

                    $("#img-login").css("display","none");
                    $("#account-hover").css("display","unset");
                    $("#img-cart").css("display","unset");
                    $("#cart-hover").css("display","none");
                    $("#img-search").css("display","unset");
                    $("#search-hover").css("display","none");

                }

                e.preventDefault();
            });

            $("a#cart").click(function (e) {
                var $t = $("#arrow-cart");
                if ($t.is(':visible')) {
                    $("#arrow-cart").slideUp();
                    $("#box-cart").slideUp();
                    $("#blank-popup").css('display', 'none');
                    $("#img-cart").css("display","unset");
                    $("#cart-hover").css("display","none");
                } else {
                    $("#arrow-cart").slideDown();
                    $("#box-cart").slideDown();
                    $("#blank-popup").css('display', 'block');
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
                    
                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);

                    $("#img-cart").css("display","none");
                    $("#cart-hover").css("display","unset");
                    $("#img-login").css("display","unset");
                    $("#account-hover").css("display","none");
                    $("#img-search").css("display","unset");
                    $("#search-hover").css("display","none");
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

                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);


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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");
               
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

                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");
                    
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

                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");
                  
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

                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");
                  
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

                    $("#arrow-promo").slideUp(0);
                    $("#box-promo").slideUp(0);

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");
                  
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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");

                $("#arrow-brands").slideUp(0);
                $("#box-brands").slideUp(0);

                $("#arrow-accessories").slideUp(0);
                $("#box-accessories").slideUp(0);

                $("#arrow-watches").slideUp(0);
                $("#box-watches").slideUp(0);

                $("#arrow-promo").slideUp(0);
                $("#box-promo").slideUp(0);

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

                $("#arrow-promo").slideUp(0);
                $("#box-promo").slideUp(0);

                $("#arrow-jewelry").slideUp(0);
                    $("#box-jewelry").slideUp(0);

                
            });

            $("li#promo").mouseenter(function (e) {

                var $t = $("#arrow-brands");
                if ($t.is(':visible')) {
                    
                } else {
                    $("#arrow-promo").slideDown(0);
                    $("#box-promo").slideDown(0);

                    $("#arrow-brands").slideUp(0);
                    $("#box-brands").slideUp(0);
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

            $("#box-promo").mouseleave(function (e) {
                
                $("#arrow-promo").slideUp(0);
                $("#box-promo").slideUp(0);

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

                $("a#promo").css("color", "");
                $("a#promo").css("border-bottom", "");
                $("a#promo").css("padding-bottom", "");
                $("a#promo").css("margin-right", "");
                $("a#promo").css("padding-right", "");
                $("a#promo").css("margin-left", "");
                $("a#promo").css("padding-left", "");

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
           // window.location.href = $('input[name="breadcrumb_url"]').val() + '?' + params + pagination;
           window.location.href = baseUrl + '/' + $('input[name="breadcrumb"]').val() + '?' + params + pagination;
            }
        });
        // window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});

$('input#apply-filters-promo-custom').click(function() {
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
             window.location.href = $('input[name="breadcrumb_url"]').val() + '?' + params + pagination;
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

$('input#apply-filters-preorder').click(function() {
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


        $('input:checkbox[name=collection]:checked').each(function () {
            collection_param.push(this.value);

            if (found) {
                collection_fil = '&collection=' + collection_param.join('--');
            } else {
                collection_fil = '&collection=' + collection_param.join('--');
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

    params = size_fil + collection_fil + sort_param + price_param + subcat_fil;


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
            window.location.href = baseUrl + '?' + params;
		        }
		    });
		// window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;

});

$('input#apply-filters-preorder-mobile').click(function() {
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

		
	
        $('input:radio[name=collection-mobile]:checked').each(function () {
            collection_param.push(this.value);

            if (found) {
                collection_fil = '&collection=' + collection_param.join('--');
            } else {
                collection_fil = '&collection=' + collection_param.join('--');
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

    params = size_fil + collection_fil + sort_param + price_param + subcat_fil;


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
            window.location.href = baseUrl + '?' + params;
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
        alert("name is required");
        // $('#firstname-signin-error').css('display','block');
        return false;
    }

    if (email == '') {
        $('input[name="email_subscribe"]').focus();
        alert("email is required");
        // $('#email-signin-error').css('display','block');
        return false;
    } else if (!validateEmail(email)) {
        $('input[name="email_subscribe"]').focus();
        alert("email is not valid");
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
    $("#box-login").css("height","450px");
    $("#box-login").css("overflow","hidden scroll");
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

// var id is attribute id, var addition is integer for height addition
function scroll_top(id,addition){
    $('html, body').animate({
        scrollTop: ($(id).offset().top - addition) + 'px'
    }, 1000);
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
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.bg-image-input').css('background-image', 'url('+e.target.result+')');
                $('.bg-image-input').css('background-size', 'cover');
                
                $('.bg-image-payment').css('background-image', 'url('+e.target.result+')');
                $('.bg-image-payment').css('background-size', 'cover');

            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
$("#file-2").change(function(){
        readURL(this);
    });
$("#file-pembayaran").change(function(){
        readURL(this);
    });
$("#file-resi").change(function(){
        readURL(this);
    });
    
$("input.term-condition").change(function() {
    if(this.checked) {
        $('a#warranty-term-condition').removeClass("grey-round");
        $('a#warranty-term-condition').addClass("blue-round");
    }else{
        $('a#warranty-term-condition').addClass("grey-round");
        $('a#warranty-term-condition').removeClass("blue-round");
    }
});
 $('a#warranty-term-condition').on('click', function (e) {
        e.preventDefault();
        var input_id = $(this).attr("attrId");
        if (!$('#agreement-'+input_id).is(":checked")) {
            $('div.agreement-error').show();
          
            return false;
        }
        
        console.log(input_id);
        window.location.href = baseUrl + '/warranty/claim/'+input_id;
        

    });

// dats is brand_id    
if (typeof dats === 'undefined') {
    var dats = [];
}else{
  var dats = $.map(JSON.parse(dats), function (obj) {
    return { id: obj.id, text: obj.text };
  });
}

if (typeof store_datas === 'undefined') {
    var store_datas = [];
}else{
   var store_datas = $.map(JSON.parse(store_datas), function (obj) {
    return { id: obj.id, text: obj.text, name: obj.name, slug: obj.slug };
  });
}


$('.warranty-select-brand').prepend('<option></option>').select2({
    width: '100%',
    placeholder: 'Nama Brand',
    data: dats,
    allowClear: true,
    // ajax: {
    //   url: 'https://api.github.com/orgs/select2/repos',
    //   data: dats,

    //   // function (params) {
    //   //   var query = {
    //   //     search: params.term,
    //   //     type: 'public'
    //   //   }

    //   //   // Query parameters will be ?search=[term]&type=public
    //   //   return query;
    //   // }
    // }
  });
  
$('.warranty-select-store').prepend('<option></option>').select2({
    width: '100%',
    placeholder: 'Nama Store',
    data: store_datas,
    allowClear: true,
    templateResult: formatDataStore,
    templateSelection: formatDataStoreSelect
  });
  
$('select.warranty-select-store').on('change', function() {
  if( this.value == 169){
    $('#other-store').css('display','block');
    setTimeout(function () { $('input[name="other_store').focus(); }, 20);
  }else{
    $('#other-store').css('display','none');
    console.log($('input[name="other_store"]').val());
    $('input[name="other_store"]').val('');
  }
});
  
$('select.warranty-select-brand').on('change', function () {
    // validate if user selected color
    if ($('select.warranty-select-brand')[0].value !== "0") {
        var brand_id = $('select.warranty-select-brand')[0].value;
        console.log(brand_id);
        $.ajax({
            type: "GET",
            url: baseUrl + '/warranty/get-product-list/' + brand_id,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                // $('.creditcardform').hide();
                // $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('div#warranty-product-list').html(data);
            }
        });
    }
});
$('.warranty-select-product').prepend('<option></option>').select2({
    width: '100%',
    placeholder: 'Nama Product',
    allowClear: true,
  });

if (typeof sertype === 'undefined') {
    var sertype = [];
}else{
  var sertype = $.map(JSON.parse(sertype), function (obj) {
    return { id: obj.id, text: obj.text , type: obj.type };
  });

  // sertype = formatData();
}

function formatDataStore (data) {
  if (!data.id) { return data.text; }
    var $result= $(
      '<div style="position:relative;width:100%;"><span class="gotham-medium" style="width:100%;">' + data.name + '</span><br><span class="gotham-light" style="width:100%;">' + data.text + '</span></div>'
    );
  return $result;
};
function formatDataStoreSelect (data) {
  if (!data.id) { return data.text; }
    var $result= $(
      '<div style="position:relative;width:100%;"><span class="gotham-light" style="width:100%;">' + data.name + ' '+ data.slug + '</span></div>'
    );
  return $result;
};

function formatData (data) {
  if (!data.id) { return data.text; }
  if (data.type == 2){
    var $result= $(
      '<div style="position:relative;width:100%;">' + data.text + '<span style="position:absolute;right:0;"><img src="'+ baseUrl + '/img/icons/shop.png' +'"/><img src="'+ baseUrl + '/img/icons/shop.png' +'"/></span></div>'
    );
  }else {
    var $result= $(
      '<div style="position:relative;width:100%;">' + data.text + '<img style="position:absolute;right:0;" src="'+ baseUrl + '/img/icons/shop.png' +'"/></div>'
    );
  }
  
  return $result;
};

$('.warranty-select-service').prepend('<option></option>').select2({
    width: '100%',
    placeholder: 'Jenis Perbaikan',
    allowClear: true,
    data: sertype,
    templateResult: formatData,
    templateSelection: formatData
  });

$('a#choose-service').on('click', function (e) {
        e.preventDefault();
    $("span#error-type").css("display", "none");
    var stuff = [];
    var atr = '';
    var othr_atr = '';
    var empty_atr = 0;
    var i = 1;
    $('input[name="service_type"]:checked').each(function() {
        stuff.push(this.value);
           
        if($(this).attr("id") == 'Lainnya'){
            othr_atr = '<span style="font-size:10px;font-weight:bold;">Lainnya:</span><br>' + $("#other-text").val();
            atr = atr + othr_atr + '<br>';
            if($("#other-text").val() != ''){
                empty_atr = 1;
            }
        }else{
            atr = atr + i +'. '+ $(this).attr("id") + othr_atr + '<br>';
            empty_atr = 1;
            i++;
        }
        
    });
    if(empty_atr == 0){
        $("span#error-type").css("display", "block");
        return false;
        atr = 'Jenis Perbaikan';
    }
    
    $('span#service-name-display').html(atr);
                $('span#service-name-display').css('display','block');
                $('span#service-name-none').css('display','none');
              $("#dropdown-service").slideUp();
              $('a#dropbtn').css('border-radius','10px');
    $('a#choose-service-save').css('display','block');
    $('img#icon-drop-service-black').removeClass('rotated');
    $('div#catatan-umum').css('display','none');
    scroll_top('#warranty-type-service-title',120);
}); 

$('a#choose-service-save').on('click', function (e) {
        e.preventDefault();
        
        $("span#error-type").css("display", "none");
        var stuff = [];
        var atr = '';
        var othr_atr = '';
        var empty_atr = 0;
        var i = 1;
        $('input[name="service_type"]:checked').each(function() {
           stuff.push(this.value);
           
           if($(this).attr("id") == 'Lainnya'){
               othr_atr = '<span style="font-size:10px;font-weight:bold;">Lainnya:</span><br>' + $("#other-text").val();
                atr = atr + othr_atr + '<br>';
                if($("#other-text").val() != ''){
                    empty_atr = 1;
                }
           }else{
                atr = atr + i +'. '+ $(this).attr("id") + othr_atr + '<br>';
                empty_atr = 1;
                i++;
            }
        });
        // if(stuff == []){
            
        // }
        // console.log(stuff);
        if(empty_atr == 0){
            $("span#error-type").css("display", "block");
            return false;
          atr = 'Jenis Perbaikan';
        }
        
        // console.log($("#other-text").val());
        $.ajax({
            type:'POST',
            dataType: 'json',
            url: baseUrl + '/warranty/type',
            data:{
              "service": stuff,
              "warranty": $("input#warranty-id").val(),
              "service_id": $("input#service-id").val(),
              "other_text": $("#other-text").val(),
            },
            cache:false,
           
            beforeSend: function () {
                $('#loadingScreen').modal('show');

            },
            success:function(data){
                $('#loadingScreen').modal('hide');
                console.log(data);
                $('span#service-name-display').html(atr);
                $('span#service-name-display').css('display','block');
                $('span#service-name-none').css('display','none');
              $("#dropdown-service").slideUp();
              $('a#dropbtn').css('border-radius','10px');
              $("div#warranty-photo-upload").css("display", "block");
              $("a#how-upload-info").css("display", "block");
              $("a#change-upload").css("display", "none");
              $('img#icon-drop-service').removeClass('rotated');
               
                $('a#dropbtn').addClass('bgcolorgrey');
                $('a#change-service').css('display','block');
              $('a#dropbtn').css("pointer-events", "none");
              $('img#icon-drop-service').css('display', 'none');
              $('img#icon-drop-service-black').css('display', 'none');
              $('span#icon-drop-service-after').css('display', 'block');
            
                // if(data['image'] == 'true'){
                //     $('div#address-location').css("display", "none");
                //     $('div#warranty-store').css("display", "block");
                // }
              $('a#choose-service-save').css('display','none');
              $('div#warranty-type-service').css('display','none');
              
              $('span#no_1').html('1');
              
              if($('span#no_2').html() == '1'){
                  $("div#image-zoom-warranty-front").show();
                  $("div#image-zoom-warranty-left").show();
                  $("div#image-zoom-warranty-right").show();
                  $("div#image-zoom-warranty-top").show();
                  $("div#image-zoom-warranty-bottom").show();
                  $("div#image-zoom-warranty-back").show();
              }
            //   if($('span#no_2').html() == '0'){
                  scroll_top('#warranty-photo-upload-title',120);
            //   }else{
            //       scroll_top('#warranty-save',120);
            //   }
              
              
            },
            error: function(data){
                $('#loadingScreen').modal('hide');
                console.log("error");
                console.log(data);
            }
        });

        

    });
function warranty_check_size(){
  if($("#file-1").val() != ''){
           // your validation error action
          if($("#file-1")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            $('div#img-front').css('border','solid 1px red');
            return false;
          }
       }
       if($("#file-2").val() != ''){
           // your validation error action
          if($("#file-2")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            $('div#img-right').css('border','solid 1px red');
            return false;
          }
       }
       if($("#file-3").val() != ''){
           // your validation error action
          if($("#file-3")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            $('div#img-left').css('border','solid 1px red');
            return false;
          }
       }
       if($("#file-4").val() != ''){
           // your validation error action
          if($("#file-4")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            $('div#img-top').css('border','solid 1px red');
            return false;
          }
       }
       if($("#file-5").val() != ''){
           // your validation error action
          if($("#file-5")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            $('div#img-bottom').css('border','solid 1px red');
            return false;
          }
       }
       if($("#file-6").val() != ''){
           // your validation error action
          if($("#file-6")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            $('div#img-back').css('border','solid 1px red');
            return false;
          }
       }
       $('span#error-1mb').css('display','none');


}
function check_image_format(name){
        // get the file name, possibly with path (depends on browser)
        var filename = $("#"+name).val();
        if(filename == ''){
          // $('span#error-format').css('display','none');
          return;
        }
        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');

        // Iff there is no dot anywhere in filename, we would have extension == filename,
        // so we account for this possibility now
        if (extension == filename) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }
        $('span#error-format').css('display','none');
        if(extension == 'jpg'){
          $('span#error-format').css('display','none');
        }else if(extension == 'jpeg'){
          $('span#error-format').css('display','none');
        }else if(extension == 'png'){
          $('span#error-format').css('display','none');
        }else{
          $('span#error-format').css('display','block');
          return false;
        }
        
}
document.addEventListener('DOMContentLoaded', function (event) {
    $('span#error-format').css('display','none');
        $('div#img-front').css('border','none');
        $('div#img-right').css('border','none');
        $('div#img-left').css('border','none');
        $('div#img-top').css('border','none');
        $('div#img-bottom').css('border','none');
        $('div#img-back').css('border','none');
        
    if ($("#warranty-card-claim").length) {
   
    	// Initialise resize library
    	var resize = new window.resize();
    	resize.init();
    	
    	function upload_file_warranty(resizedFile,type){
    	    var resizedSize = resizedFile.size;
            console.log(type);                    
                var formData = new FormData();
                var service_id = $("input#service-id").val();
                formData.append('type', type);
                formData.append('service_id', service_id);
                formData.append('file', resizedFile);
                                
            	$.ajax({
                   type:'POST',
                    dataType: 'json',
                    url: baseUrl + '/warranty/unggahbyone',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#img-'+type).css('background-image','url("/img/icons/tiktok.gif")');
                        $('#img-'+type).css('background-size','60px');
                        $('#img-'+type).css('background-repeat','no-repeat');
                        $('#img-'+type).css('background-position','50%');
                        
                    },
                    success:function(data){
                        $('#img-'+data['type']).css('background-size','unset');
                        $('#img-'+data['type']).css('background-repeat','unset');
                        $('#img-'+data['type']).css('background-position','unset');
                        console.log("success");
                        console.log(data);
                     
                          $('#img-'+data['type']).css('background-image','url("/img/warranty/service/uploads/product_condition/'+data['link']+'")');
                          $('#img-'+data['type']).css('background-size','cover');
                          $('img#img-'+data['type']).css('display','none');
                          $('img#zoom-img-'+data['type']).attr('src','/img/warranty/service/uploads/product_condition/'+data['link']);
                          $('div#image-zoom-warranty-'+data['type']).css('display','block');
                          $('span.span-'+data['type']).empty();
                      
                                        
                    },
                        error: function(data){
                        
                        console.log("error");
                        console.log(data);
                    }
                });
    	}

        $("input:file[name=file-1]").change(function (){
                 
            
            if($("input:file[name=file-1]")[0].files.length === 0){
                return false;
            }
            if(check_image_format('file-1') == false){
                $('div#img-top').css('border','solid 1px red');
                return false;
            }
            var initialSize = $("input:file[name=file-1]")[0].files[0].size;
        
        	resize.photo($('input:file[name=file-1]')[0].files[0], 1200, 'file', function (resizedFile) {
            	upload_file_warranty(resizedFile,'front');
            });
        	
        	if($("input[name=img-front-hide]").val() == 0){
                     if($(this).val() == ''){
                         $("span#img-count").html(parseInt($("span#img-count").html()) - 1);
                         $("span#count-img-front").html('0');
                     }else{
                         if($("span#count-img-front").html() == 0){
                             $("span#count-img-front").html('1');
                             $("span#img-count").html(parseInt($("span#img-count").html()) + 1);
                         }
                     }
                 }
                 if($("span#img-count").html() == '6'){
                     $("a#upload-service").addClass('blue-round');
                     $("a#upload-service").removeClass('grey-round');
                     $("a#upload-service").css('pointer-events','auto');
                 }else{
                     $("a#upload-service").addClass('grey-round');
                     $("a#upload-service").removeClass('blue-round');
                     $("a#upload-service").css('pointer-events','none');
                 }
            
        });  
        
        $("input:file[name=file-2]").change(function (){
            
            if($("input:file[name=file-2]")[0].files.length === 0){
                return false;
            }
            if(check_image_format('file-2') == false){
                $('div#img-right').css('border','solid 1px red');
                return false;
            }
            var initialSize = $("input:file[name=file-2]")[0].files[0].size;
        
        	resize.photo($('input:file[name=file-2]')[0].files[0], 1200, 'file', function (resizedFile) {
            	upload_file_warranty(resizedFile,'right');
            });
            
            if($("input[name=img-right-hide]").val() == 0){
                     if($(this).val() == ''){
                         $("span#img-count").html(parseInt($("span#img-count").html()) - 1);
                         $("span#count-img-right").html('0');
                     }else{
                         if($("span#count-img-right").html() == 0){
                             $("span#count-img-right").html('1');
                             $("span#img-count").html(parseInt($("span#img-count").html()) + 1);
                         }
                     }
                     
                 }
                 if($("span#img-count").html() == '6'){
                     $("a#upload-service").addClass('blue-round');
                     $("a#upload-service").removeClass('grey-round');
                     $("a#upload-service").css('pointer-events','auto');
                 }else{
                     $("a#upload-service").addClass('grey-round');
                     $("a#upload-service").removeClass('blue-round');
                     $("a#upload-service").css('pointer-events','none');
                 }
        });         
        $("input:file[name=file-3]").change(function (){
            
            if($("input:file[name=file-3]")[0].files.length === 0){
                return false;
            }
            if(check_image_format('file-3') == false){
                $('div#img-left').css('border','solid 1px red');
                return false;
            }
            var initialSize = $("input:file[name=file-3]")[0].files[0].size;
        
        	resize.photo($('input:file[name=file-3]')[0].files[0], 1200, 'file', function (resizedFile) {
            	upload_file_warranty(resizedFile,'left');
            });
            
            if($("input[name=img-left-hide]").val() == 0){
                if($(this).val() == ''){
                         $("span#img-count").html(parseInt($("span#img-count").html()) - 1);
                         $("span#count-img-left").html('0');
                     }else{
                         if($("span#count-img-left").html() == 0){
                             $("span#count-img-left").html('1');
                             $("span#img-count").html(parseInt($("span#img-count").html()) + 1);
                         }
                     }
                 }
                 if($("span#img-count").html() == '6'){
                     $("a#upload-service").addClass('blue-round');
                     $("a#upload-service").removeClass('grey-round');
                     $("a#upload-service").css('pointer-events','auto');
                 }else{
                     $("a#upload-service").addClass('grey-round');
                     $("a#upload-service").removeClass('blue-round');
                     $("a#upload-service").css('pointer-events','none');
                 }
        });
        
        $("input:file[name=file-4]").change(function (){
             
            if($("input:file[name=file-4]")[0].files.length === 0){
                return false;
            }
            if(check_image_format('file-4') == false){
                $('div#img-top').css('border','solid 1px red');
                return false;
            }
            var initialSize = $("input:file[name=file-4]")[0].files[0].size;
        
        	resize.photo($('input:file[name=file-4]')[0].files[0], 1200, 'file', function (resizedFile) {
            	upload_file_warranty(resizedFile,'top');
            });
            
            if($("input[name=img-top-hide]").val() == 0){
                 if($(this).val() == ''){
                         $("span#img-count").html(parseInt($("span#img-count").html()) - 1);
                         $("span#count-img-top").html('0');
                     }else{
                         if($("span#count-img-top").html() == 0){
                             $("span#count-img-top").html('1');
                             $("span#img-count").html(parseInt($("span#img-count").html()) + 1);
                         }
                     }
                 }
                 if($("span#img-count").html() == '6'){
                     $("a#upload-service").addClass('blue-round');
                     $("a#upload-service").removeClass('grey-round');
                     $("a#upload-service").css('pointer-events','auto');
                 }else{
                     $("a#upload-service").addClass('grey-round');
                     $("a#upload-service").removeClass('blue-round');
                     $("a#upload-service").css('pointer-events','none');
                 }
                 
         });
        $("input:file[name=file-5]").change(function (){
             
            if($("input:file[name=file-5]")[0].files.length === 0){
                return false;
            }
            if(check_image_format('file-5') == false){
                $('div#img-bottom').css('border','solid 1px red');
                return false;
            }
            var initialSize = $("input:file[name=file-5]")[0].files[0].size;
        
        	resize.photo($('input:file[name=file-5]')[0].files[0], 1200, 'file', function (resizedFile) {
            	upload_file_warranty(resizedFile,'bottom');
            });
            
            if($("input[name=img-bottom-hide]").val() == 0){
                     if($(this).val() == ''){
                         $("span#img-count").html(parseInt($("span#img-count").html()) - 1);
                         $("span#count-img-bottom").html('0');
                     }else{
                         if($("span#count-img-bottom").html() == 0){
                             $("span#count-img-bottom").html('1');
                             $("span#img-count").html(parseInt($("span#img-count").html()) + 1);
                         }
                     }
                 }
                 if($("span#img-count").html() == '6'){
                     $("a#upload-service").addClass('blue-round');
                     $("a#upload-service").removeClass('grey-round');
                     $("a#upload-service").css('pointer-events','auto');
                 }else{
                     $("a#upload-service").addClass('grey-round');
                     $("a#upload-service").removeClass('blue-round');
                     $("a#upload-service").css('pointer-events','none');
                 }
        });
        $("input:file[name=file-6]").change(function (){
             
            if($("input:file[name=file-6]")[0].files.length === 0){
                return false;
            }
            if(check_image_format('file-6') == false){
                $('div#img-back').css('border','solid 1px red');
                return false;
            }
            var initialSize = $("input:file[name=file-6]")[0].files[0].size;
        
        	resize.photo($('input:file[name=file-6]')[0].files[0], 1200, 'file', function (resizedFile) {
            	upload_file_warranty(resizedFile,'back');
            });
            
            if($("input[name=img-back-hide]").val() == 0){
                    if($(this).val() == ''){
                         $("span#img-count").html(parseInt($("span#img-count").html()) - 1);
                         $("span#count-img-back").html('0');
                     }else{
                         if($("span#count-img-back").html() == 0){
                             $("span#count-img-back").html('1');
                             $("span#img-count").html(parseInt($("span#img-count").html()) + 1);
                         }
                     }
                 }
                 if($("span#img-count").html() == '6'){
                     $("a#upload-service").addClass('blue-round');
                     $("a#upload-service").removeClass('grey-round');
                     $("a#upload-service").css('pointer-events','auto');
                 }else{
                     $("a#upload-service").addClass('grey-round');
                     $("a#upload-service").removeClass('blue-round');
                     $("a#upload-service").css('pointer-events','none');
                 }
                 
        });
    }
});

$('a#upload-service').on('click', function (e) {
        e.preventDefault();
        
        $("div#image-zoom-warranty-front").show();
                  $("div#image-zoom-warranty-left").show();
                  $("div#image-zoom-warranty-right").show();
                  $("div#image-zoom-warranty-top").show();
                  $("div#image-zoom-warranty-bottom").show();
                  $("div#image-zoom-warranty-back").show();
               
                  $('div#upload-image-btn').css('display', 'none');
                  $("a#change-upload").css('display','block');
                
                $('span#no_2').html('1');
                $("div#warranty-location").css("display", "block");
                $('div#warranty-photo-upload').css('display','none');
                $("a#how-upload-info").css("display", "none");
           
                scroll_top('#warranty-location-title',120);
        
    });

$('a#save-service').on('click', function (e) {
        e.preventDefault();
        
        
        var stuff = [];
        $('input[name="service_type"]:checked').each(function() {
           stuff.push(this.value);       
        });
        $("div#warranty-type").css("display", "none");
        $("div#warranty-location").css("display", "none");
        if(stuff == []){
          $("div#warranty-type").css("display", "block");
          return false;
        }


        var stuff = [];
        $('input[name="service_type"]:checked').each(function() {
           stuff.push(this.value);       
        });
        var warranty_id = $("input#warranty-id").val();
        var location_id = $("input#location-id").val();
        if(location == ''){
          $("div#warranty-location").css("display", "block");
          return false;
        }
        
        if ($('#claim-agreement').is(":checked")) {
            
        }else{
            $("span#agreement-error").css("display", "block");
            alert('Silahkan pilih "Syarat & Ketentuan"');
            return false;
        }
       
        var order_id = $("input#order-id").val();

        var formData = new FormData();
        formData.append('order', order_id);
        formData.append('warranty', warranty_id);
        formData.append('location', location_id);
        formData.append('service', stuff);
        formData.append('service_id', $("input#service-id").val());
        $.ajax({
            type:'POST',
            url: $('#warranty_save').attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success:function(data){
                $('#loadingScreen').modal('hide');
                console.log("success");
                console.log(data);
                window.location.replace(baseUrl + "/warranty/card");
            },
            error: function(data){
                $('#loadingScreen').modal('hide');
                console.log("error");
                console.log(data);
            }
        });

    });
$('a.return-store').on('click', function (e) {
        e.preventDefault();

        
        
         $("div#return-store-city").css("display", "block");
        $("div#warranty-return-location").css("display", "none");

    });
$('a.return-address').on('click', function (e) {
        e.preventDefault();

        
        
         $("div#return-address-field").css("display", "block");
        $("div#warranty-return-location").css("display", "none");

    });
$('a.drop-store-return').on('click', function (e) {
        e.preventDefault();
      var id = $(this).attr('id');
      console.log(id);
      $('input#location-id').val(id);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + '/warranty/returnstore',
            data: {
              "id":id,
              "service_id": $("input#service-id").val(),
            },
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                // $('.creditcardform').hide();
                // $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('span#drop-store-name').html(data['name']);
                $('span#drop-store-address').html(data['address']);
                $('span#drop-store-contact').html(data['contact']);
                $('div#drop-store-name').html(data['name']);
                $('div#drop-store-address').html(data['address']);
                $('div#drop-store-contact').html(data['contact']);
                 $("div#return-store-city").css("display", "none");
                $("div#return-address-field").css("display", "none");
                $("div#address-location-return").css("display", "block");
                $("a#change-location-return").css("display", "block");
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
                // $('#catatan-khusus').css('display','block');
                // $('#catatan-umum').css('display','block');
                $('#warranty-save').css('display','block');
                $('span#no_4').html('1');
                scroll_top('#warranty-save',120);
                
            }
        });

    });

$('a#save-return-address').on('click', function (e) {
        e.preventDefault();
        // console.log('ada');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + '/warranty/returnaddress',
            data: {
             
              "service_id": $("input#service-id").val(),
              "return-name": $("input#return-name").val(),
              "return-address": $("textarea#return-address").val(),
              "return-telp": $("input#return-telp").val(),
              "province_id": $("select[name='province_id']")[0].value,
              "state_id": $("select[name='state_id']")[0].value,
              "district_id": $("select[name='district_id']")[0].value,
              "return-kel": $("input#return-kel").val(),
            },
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                // $('.creditcardform').hide();
                // $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('span#drop-store-name').html(data['name']);
                $('span#drop-store-address').html(data['address']);
                $('span#drop-store-contact').html(data['contact']);
                $('div#drop-store-name').html(data['name']);
                $('div#drop-store-address').html(data['address']);
                $('div#drop-store-contact').html(data['contact']);
                 $("div#return-store-city").css("display", "none");
                $("div#return-address-field").css("display", "none");
                $("div#address-location-return").css("display", "block");
                $("a#change-location-return").css("display", "block");
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
                // $('#catatan-khusus').css('display','none');
                // $('#catatan-umum').css('display','block');
                $('#warranty-save').css('display','block');
                $('span#no_4').html('1');
                scroll_top('#warranty-save',120);
            }
        });

    });
    
$('a.drop-store').on('click', function (e) {
        e.preventDefault();

        
        
         $("div#store-city").css("display", "block");
        $("div#warranty-store").css("display", "none");

    });

$('a.drop-centre').on('click', function (e) {
        e.preventDefault();
      var id = $(this).attr('id');
      console.log(id);
      $('input#location-id').val(id);
      
      if(id == 153){
          
            $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + '/warranty/drop',
            data: {
              "id":id,
              "service_id": $("input#service-id").val(),
            },
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                // $('.creditcardform').hide();
                // $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('span#store-name').html(data['name']);
                $('span#store-address').html(data['address']);
                $('span#store-contact').html(data['contact']);
                $('div#store-name').html(data['name']);
                $('div#store-address').html(data['address']);
                $('div#store-contact').html(data['contact']);
                 $("div#store-city").css("display", "none");
                $("div#warranty-store").css("display", "none");
                $("div#address-location").css("display", "block");
                $("a#change-location").css("display", "block");
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
                // $('#catatan-khusus').css('display','block');
                // $('#catatan-umum').css('display','none');
                
                $('a#preview-location').css('display','block');
                $('a#save-location').css('display','none');
                $('a#return-address').css('display','block');
                $('#preview-download').modal('show');
            }
        });
      }else{
          $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + '/warranty/drop',
            data: {
              "id":id,
              "service_id": $("input#service-id").val(),
            },
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
                // $('.creditcardform').hide();
                // $('.installmentform').hide();
                $('#loadingScreen').modal('hide');
                $('span#store-name').html(data['name']);
                $('span#store-address').html(data['address']);
                $('span#store-contact').html(data['contact']);
                $('div#store-name').html(data['name']);
                $('div#store-address').html(data['address']);
                $('div#store-contact').html(data['contact']);
                 $("div#store-city").css("display", "none");
                $("div#warranty-store").css("display", "none");
                $("div#address-location").css("display", "block");
                $("a#change-location").css("display", "block");
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
                // $('#catatan-khusus').css('display','block');
                // $('#catatan-umum').css('display','none');
               
                    // $('a#preview-location').css('display','block');
                    $('a#preview-location').css('display','none');
                    $('a#return-address').css('display','none');
                    $('a#save-location').css('display','block');
                
            }
        });
      }
        

    });
$('a#back-location-drop').on('click', function (e) {
    $("div#warranty-store").css("display", "block");
    $("div#store-city").css("display", "none");
});
$('a#back-location-return').on('click', function (e) {
    $("div#warranty-return-location").css("display", "block");
    $("div#return-store-city").css("display", "none");
    $("div#return-address-field").css("display", "none");
});
$('a#view-location').on('click', function (e) {
        e.preventDefault();
        
        $(this).css("display", "none");
        $("div#warranty-location").css("display", "block");
        
    });
$('a#save-location').on('click', function (e) {
        e.preventDefault();
       
        $('div#warranty-return').css('display','block');
        
        $("div#warranty-location").css("display", "none");
        $("a#view-location").css("display", "block");
        $("div#warranty-return").css("display", "block");
        scroll_top('#warranty-return-title',120);
});
    
$('a#change-location').on('click', function (e) {
        e.preventDefault();
        
        $("div#warranty-store").css("display", "none");
        $("div#store-city").css("display", "none");
                $("div#warranty-store").css("display", "block");
                $("div#address-location").css("display", "none");
                $("a#change-location").css("display", "none");
        
        $('#customer-address-from').css('display','none');
                
    });
    
$('a#change-location-return').on('click', function (e) {
        e.preventDefault();
                $("div#warranty-return").css("display", "block");
                $("div#warranty-return-location").css("display", "block");
                $("div#address-location-return").css("display", "none");
                $("a#change-location-return").css("display", "none");
                // $('#warranty-save').css('display','none');

    });

$('a#download-warranty').on('click', function (e) {
        e.preventDefault();
       
        var data = {
                    "customer_name": $('input#customer-name').val() ,
                    "customer_address": $('textarea#customer-address').val() ,
                    "customer_telp": $('input#customer-telp').val() ,
                    "location_id": $('input#location-id').val(),
                    "service_id": $('input#service-id').val(),
                    };
       
      
      $(location).attr('href', baseUrl + '/warranty/download/'+ JSON.stringify(data));
      $('#preview-download').modal('hide');
      
      $('section').css('-webkit-filter','none');
        $('section').css('-moz-filter','none');
        $('section').css('-o-filter','none');
        $('section').css('-ms-filter','none');
        $('section').css('filter','none');

        $('nav').css('-webkit-filter','none');
        $('nav').css('-moz-filter','none');
        $('nav').css('-o-filter','none');
        $('nav').css('-ms-filter','none');
        $('nav').css('filter','none');
        
        $('#customer-address-from').css('display','block');
        $('#customer-address-name').html($('input#customer-name').val());
        $('#customer-address-address').html($('textarea#customer-address').val());
        $('#customer-address-contact').html($('input#customer-telp').val());
        
        $('#preview-location').css('display','none');
        $('#save-location').css('display','block');
        
        //   $('div#warranty-return').css('display','block');
        $('span#no_3').html('1');
        // scroll_top('#warranty-return-title',120);
        scroll_top('#warranty-location-title',120);
    });
    

 $('a.modal-blur').on('click', function () {

            $('section').css('-webkit-filter','blur(5px)');
              $('section').css('-moz-filter','blur(5px)');
              $('section').css('-o-filter','blur(5px)');
              $('section').css('-ms-filter','blur(5px)');
              $('section').css('filter','blur(5px)');
             

              $('nav').css('-webkit-filter','blur(5px)');
              $('nav').css('-moz-filter','blur(5px)');
              $('nav').css('-o-filter','blur(5px)');
              $('nav').css('-ms-filter','blur(5px)');
              $('nav').css('filter','blur(5px)');

              $('div.modal').css('-webkit-filter','none');
        $('div.modal').css('-moz-filter','none');
        $('div.modal').css('-o-filter','none');
        $('div.modal').css('-ms-filter','none');
        $('div.modal').css('filter','none');
  });

  $('div.modal').on('hidden.bs.modal', function () {
    $('section').css('-webkit-filter','none');
        $('section').css('-moz-filter','none');
        $('section').css('-o-filter','none');
        $('section').css('-ms-filter','none');
        $('section').css('filter','none');
        
        $('header').css('-webkit-filter','none');
        $('header').css('-moz-filter','none');
        $('header').css('-o-filter','none');
        $('header').css('-ms-filter','none');
        $('header').css('filter','none');

        $('nav').css('-webkit-filter','none');
        $('nav').css('-moz-filter','none');
        $('nav').css('-o-filter','none');
        $('nav').css('-ms-filter','none');
        $('nav').css('filter','none');
  });

$('a#dropbtn').click(function() {

                var $t = $("#dropdown-service");
                if ($t.is(':visible')) {
                    $("#dropdown-service").slideUp();
                    $('a#dropbtn').css('border-radius','10px');
                    // $('img#icon-drop-service-white').css('display','block');
                    $('img#icon-drop-service-black').removeClass('rotated');
                    // $("a#dropbtn").addClass('bgcolorwhite');
                    $("a#dropbtn").removeClass('bgcolorgrey');
                    $("a#dropbtn").removeClass('bgcolorblue');
                    $("span#service-name-display").toggle();
                    $("span#service-name-none").toggle();
                   
                } else {
                    $("#dropdown-service").slideDown();
                    $('a#dropbtn').css('border-radius','15px 15px 0 0');
                    $('img#icon-drop-service-white').css('display','none');
                    $('img#icon-drop-service-black').css('display','block');
                    $('img#icon-drop-service-black').addClass('rotated');
                    $("a#dropbtn").removeClass('bgcolorblue');
                    $("a#dropbtn").removeClass('bgcolorgrey');
                    $("a#dropbtn").addClass('bgcolorwhite');
                    $("a#dropbtn").removeClass('fcolorfff');
                    $("span#service-name-display").toggle();
                    $("span#service-name-none").toggle();
                   
                }

});
// $(document).mouseup(function(e) 
// {
//     var container = $("#dropdown-service");
//     var container2 = $("a#dropbtn");
//     // if the target of the click isn't the container nor a descendant of the container
//     if (!container.is(e.target) && !container2.is(e.target) && container.has(e.target).length === 0) 
//     {
//         container.slideUp();
//         $('a#dropbtn').css('border-radius','25px');
//     }
// });

$('a#create-warranty').on('click', function (e) {
        e.preventDefault();
        $('span#error-select-brand').css('display','none');
        $('span#error-select-product').css('display','none');
        $('span#error-code-unique').css('display','none');
        $('span#error-invoice-d').css('display','none');
        $('span#error-format').css('display','none');
        $('span#error-store').css('display','none');
        
        if($('#file-2')[0].files.length != 0){
          if(check_image_format('file-2') == false){
             // $('span#error-code-unique').css('display','block');
              return false;
             }
        }
        
       
        if($('select.warranty-select-brand')[0].value == ''){
          $('span#error-select-brand').css('display','block');
          return false;
        }
        if($('select.warranty-select-product')[0].value == ''){
          $('span#error-select-product').css('display','block');
          //console.log($('select.warranty-select-product')[0].value);
          return false;
        }
        if($('select.warranty-select-store')[0].value == ''){
          $('span#error-select-store').css('display','block');
          return false;
        }
        if($("input[name='kode_unik']").val() == ''){
          $('span#error-code-unique').css('display','block');
          $('span#error-code-unique').html('Silahkan isi kode unik product');
          return false;
        }
        if($("input[name='nomor_invoice']").val() == ''){
            $('span#error-invoice-d').css('display','block');
          return false;
        }
        
        if($('#file-2')[0].files.length == 0){
          $('span#error-invoice-d').css('display','block');
          return false;
        }
             
        var brand_id = $('select.warranty-select-brand')[0].value;
        var product_id = $('select.warranty-select-product')[0].value;
        var store_id = $('select.warranty-select-store')[0].value;
        var kode = $("input[name='kode_unik']").val();
        var invoice = $("input[name='nomor_invoice']").val();
        var customer_id = $("input[name='customer_id']").val();
        var other_store = $("input[name='other_store']").val();
        console.log(brand_id+' p='+product_id+' k='+kode+' i='+invoice);

        var formData = new FormData();
        formData.append('brand_id', brand_id);
        formData.append('product_id', product_id);
        formData.append('store_id', store_id);
        formData.append('warranty_code', kode);
        formData.append('reference', invoice);
        formData.append('customer_id', customer_id);
        formData.append('file_2', $('#file-2')[0].files[0]);
        formData.append('other_store', other_store);
        
        $.ajax({
            type:'POST',
            url: $('#warranty_manual').attr('action'),
            dataType: 'json',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success:function(data){
                $('#loadingScreen').modal('hide');
                
                console.log(data[0]);
                if(data[0] == 'error'){
                  $('span#error-code-unique').css('display','block');
                  $('span#error-code-unique').html(data[1]);
                }else{
                  window.location.replace(baseUrl + "/warranty/card");
                }
                // window.location.replace(baseUrl + "/warranty/card");
            },
            error: function(data){
                $('#loadingScreen').modal('hide');
                console.log("error");
                console.log(data);
            }
        });

    });



$('a#simpan-resi').on('click', function (e) {
        e.preventDefault();
        
        $('span#error-resi').css('display','none');
        $('span#error-kurir').css('display','none');
        $('span#error-format').css('display','none');
        $('span#error-1mb').css('display','none');
        
        // if($('#file-resi')[0].files.length == 0 && ($("input[name='nomor_resi']").val() == '' && $("input[name='kurir']").val() == '')){
        //   $('span#error-file-resi').css('display','block');
        //   return false;
        // }
        
        if($('#file-resi')[0].files.length != 0){
            if(check_image_format('file-resi') == false){
              return;
             }
        
     
          if($("#file-resi")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            return false;
          }
        }else{
            if($("input[name='nomor_resi']").val() == ''){
              $('span#error-resi').css('display','block');
             
              return false;
            }
            if($("input[name='kurir']").val() == ''){
              $('span#error-kurir').css('display','block');
             
              return false;
            }
        }
    
        var kurir = $("input[name='kurir']").val();
        var resi = $("input[name='nomor_resi']").val();
        var service_id = $("input[name='service_id']").val();
        
        console.log(kurir+' '+resi+' '+service_id);
        var formData = new FormData();
        formData.append('kurir', kurir);
        formData.append('resi', resi);
        formData.append('service_id', service_id);
        formData.append('file_resi', $('#file-resi')[0].files[0]);
        
        $.ajax({
            type:'POST',
            url: baseUrl + '/warranty/resi',
            dataType: 'json',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success:function(data){
                $('#loadingScreen').modal('hide');
                
              
                  window.location.replace(baseUrl + "/warranty/card");
               
                // window.location.replace(baseUrl + "/warranty/card");
            },
            error: function(data){
                $('#loadingScreen').modal('hide');
                console.log("error");
                console.log(data);
            }
        });

    });

$('a#resi-action').on('click', function (e) {

  $("input[name='service_id']").val($(this).attr("attr"));
});


$('a#simpan-bukti-pembayaran').on('click', function (e) {
        e.preventDefault();
        
        $('span#error-bank-name').css('display','none');
        $('span#error-account-number').css('display','none');
        $('span#error-account-name').css('display','none');
        $('span#error-nominal').css('display','none');
        $('span#error-format').css('display','none');
        $('span#error-1mb').css('display','none');
        $('span#error-empty').css('display','none');
        $('span#error-nominal-format').css('display','none');
       
        
         
        if($('#file-pembayaran')[0].files.length != 0){
            if(check_image_format('file-pembayaran') == false){
              return;
             }
        
     
          if($("#file-pembayaran")[0].files[0].size > 2000000){
            $('span#error-1mb').css('display','block');
            return false;
          }
        }else{
            $('span#error-empty').css('display','block');
            return;
            
        }
        
        if($("input[name='warranty_bank_name']").val() == ''){
              $('span#error-bank-name').css('display','block');
             
              return false;
            }
            if($("input[name='warranty_account_number']").val() == ''){
              $('span#error-account-number').css('display','block');
             
              return false;
            }
    
        if($("input[name='warranty_account_name']").val() == ''){
              $('span#error-account-name').css('display','block');
             
              return false;
            }
            if($("input[name='warranty_nominal']").val() == ''){
              $('span#error-nominal').css('display','block');
             
              return false;
            }
        
        if($.isNumeric($("input[name='warranty_nominal']").val())){
           
         }else{
              $('span#error-nominal-format').css('display','block');
             
              return false;
         }
       
        var warranty_bank_name = $("input[name='warranty_bank_name']").val();
        var warranty_account_number = $("input[name='warranty_account_number']").val();
        var warranty_account_name = $("input[name='warranty_account_name']").val();
        var warranty_nominal = $("input[name='warranty_nominal']").val();
        var warranty_payment_detail = $("select[name='warranty_payment_detail']")[0].value;
        var service_id = $("input[name='service_id']").val();
        var payment_method = $('option:selected').attr('id');
        
        
        var formData = new FormData();
        formData.append('service_id', service_id);
        formData.append('warranty_bank_name', warranty_bank_name);
        formData.append('warranty_account_number', warranty_account_number);
        formData.append('warranty_account_name', warranty_account_name);
        formData.append('warranty_nominal', warranty_nominal);
        formData.append('warranty_payment_detail', warranty_payment_detail);
        formData.append('file_pembayaran', $('#file-pembayaran')[0].files[0]);
        formData.append('payment_method', $('option:selected').attr('id'));
        $.ajax({
            type:'POST',
            url: baseUrl + '/warranty/paymentconfirm',
            dataType: 'json',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success:function(data){
                $('#loadingScreen').modal('hide');
                
              
                  window.location.replace(baseUrl + "/warranty/details/" + service_id);
               
                // window.location.replace(baseUrl + "/warranty/card");
            },
            error: function(data){
                $('#loadingScreen').modal('hide');
                console.log("error");
                console.log(data);
            }
        });

    });
$(document).ready(function() {

  if(window.location.href.indexOf('#loginWarranty') != -1) {
    $('#loginWarranty').modal('show');
    $('section').css('-webkit-filter','blur(5px)');
              $('section').css('-moz-filter','blur(5px)');
              $('section').css('-o-filter','blur(5px)');
              $('section').css('-ms-filter','blur(5px)');
              $('section').css('filter','blur(5px)');
              
              $('header').css('-webkit-filter','blur(5px)');
              $('header').css('-moz-filter','blur(5px)');
              $('header').css('-o-filter','blur(5px)');
              $('header').css('-ms-filter','blur(5px)');
              $('header').css('filter','blur(5px)');

              $('nav').css('-webkit-filter','blur(5px)');
              $('nav').css('-moz-filter','blur(5px)');
              $('nav').css('-o-filter','blur(5px)');
              $('nav').css('-ms-filter','blur(5px)');
              $('nav').css('filter','blur(5px)');

              $('div.modal').css('-webkit-filter','none');
        $('div.modal').css('-moz-filter','none');
        $('div.modal').css('-o-filter','none');
        $('div.modal').css('-ms-filter','none');
        $('div.modal').css('filter','none');
  }
  if($('span#survei-modal').length){
    if($('span#survei-modal').html() != ''){
      
      
          $.ajax({
            type: "POST",
            url: baseUrl + '/warranty/surveicontent',
            data: {
                "id": $('span#survei-modal').html(),
            },
            beforeSend: function () {
                $('#loadingScreen').modal('show');
            },
            success: function (data) {
            
                $('#loadingScreen').modal('hide');
                $('div#survei-content2').html(data);
                $('div#survei-content').modal('show');
            }
        });
      }
  }
  
  var windowsize = $(window).width();
  if (windowsize > 767) {
      $('div.warranty-stat').css('position','absolute');
  }else{
      $('div.warranty-stat').css('position','relative');
  }

});
$('a#survei-modal').on('click', function (e) {
    $('div#history-'+$(this).attr('attrtype')).modal('hide');
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/warranty/surveicontent',
        data: {
            "id": $(this).attr('attrid'),
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
        
            $('#loadingScreen').modal('hide');
            $('div#survei-content2').html(data);
            $('div#survei-content').modal('show');
        }
    });
    
});

$('div#tab-signup').on('click', function (e) {

  $(this).removeClass('tab-signup');
  $("div#tab-login").addClass('tab-login');
  $("div#login-body").css("display","none");
  $("div#signup-body").css("display","block");
  $("img#img-login-warranty").css("display","none");
  $("img#img-signup").css("display","inline");
});
$('div#tab-login').on('click', function (e) {

  $(this).removeClass('tab-login');
  $("div#tab-signup").addClass('tab-signup');
  $("div#signup-body").css("display","none");
  $("div#login-body").css("display","block");
  $("img#img-login-warranty").css("display","inline");
  $("img#img-signup").css("display","none");
});

$('a#tab-forget').on('click', function (e) {


  $("div#retrieve-body").css("display","block");
  $("div#login-body").css("height","480px");
});

$('a#login-warranty').on('click', function (e) {
    e.preventDefault();

    var email = $('input[name=email_login_warranty]').val(),
            password = $('input[name=password_login_warranty]').val();

    if (email === '') {
        $('span#error-email-login').show();
        $('span#error-email-login').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#error-email-login').show();
        $('span#error-email-login').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#error-email-login').hide();
    }

    if (password === '') {
        $('span#error-password-login').show();
        $('span#error-password-login').html('* Password Is Required!');
        return;
    } else {
        $('span#error-password-login').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/sign-in',
        dataType: 'json',
        data: {
            "email": $('input[name=email_login_warranty]')[0].value,
            "password": $('input[name=password_login_warranty]')[0].value
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            console.log(d);
            if (d === 'FALSE') {
                $('span#error-password-login').show();
                $('span#error-password-login').html('Email atau password anda salah');
                $('#loadingScreen').modal('hide');
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

            window.location.href = baseUrl + $('input[name=url_warranty]').val();
        }
    });
});

$('a#signup-warranty').on('click', function (e) {
    e.preventDefault();

  (function(document, window) {
    var scr = document.createElement("script");
    scr.type = "text/javascript";
    scr.async = true;
    scr.src =  "//ssp.adskom.com/tags/third-party-async/NzY2MWM1NDUtNmJhNS00MmVmLWExMDMtZjIzNzJjYjNhOWU4";

    document.body.appendChild(scr);
  })(document, window);

    var email = $('input[name=email_signup_warranty]').val(),
            fname = $('input[name=first_name_signup_warranty]').val(),
      phone = $('input[name=telp_signup_warranty]').val(),
            password = $('input[name=password_signup_warranty]').val();
            confirm_password = $('input[name=confirm_password_signup_warranty]').val();

    if (email === '') {
        $('span#error-email-signup').show();
        $('span#error-email-signup').html('* Email Is Required!');
        return;
    } else if (!validateEmail(email)) {
        $('span#error-email-signup').show();
        $('span#error-email-signup').html('* Email Is Not Valid!');
        return;
    } else {
        $('span#error-email-signup').hide();
    }

    if (fname === '') {
        $('span#error-name-signup').show();
        $('span#error-name-signup').html('* First Name Is Required!');
        return;
    } else {
        $('span#error-name-signup').hide();
    }

  if (phone === '') {
        $('span#error-telp-signup').show();
        $('span#error-telp-signup').html('* Phone Number Is Required!');
        return;
    } else {
        $('span#error-telp-signup').hide();
    }

    if (password === '') {
        $('span#error-password-signup').show();
        $('span#error-password-signup').html('* Password Is Required!');
        return;
    } else {
        $('span#error-password-signup').hide();
    }

    if (password != confirm_password) {
        $('span#error-confirm-password-signup').show();
        $('span#error-confirm-password-signup').html('Confirmation password not match');
        return;
    } else {
        $('span#error-confirm-password-signup').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/sign-up',
        dataType: 'json',
        data: {
            "customerInfo": {
                "email": $('input[name=email_signup_warranty]')[0].value,
                "fname": $('input[name=first_name_signup_warranty]')[0].value,
        "phone": $('input[name=telp_signup_warranty]')[0].value,
                "lname": '',
                "password": $('input[name=password_signup_warranty]')[0].value,
                "newsletter": $('input[name=rc002]')[0].value
            }
        },
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#error-email-signup').show();
                $('span#error-email-signup').html('Email sudah terdaftar');
                console.log(d);
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
            window.location.href = baseUrl + '/warranty/card';
        }
    });
});
$('a#retrieve-warranty').on('click', function (e) {
    e.preventDefault();

    if ($('input[name=retrieve_login_warranty]').val() == '') {
        $('span#error-retrieve-login').show();
        $('span#error-retrieve-login').html('* Email Required');
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/customer/forgot-password',
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        data: {
            "email": $("input[name=retrieve_login_warranty]").val(),
            "_csrf": csrf
        },
        success: function (data) {
            var d = data;
            if (d === 'FALSE') {
                $('span#error-retrieve-login').show();
                $('span#error-retrieve-login').html('* Email not found!');
               
               
                $('#loadingScreen').modal('hide');
                return;
            } else if (d === 'TRUE') {
      
                $('span#error-retrieve-login').css("color","#1d6068");
                $('span#error-retrieve-login').css("display","block");
                $('span#error-retrieve-login').text('AN EMAIL CONFIRMATION HAS BEEN SENT');
                $('#loadingScreen').modal('hide');
            }
        }
    });
});

$('input#email_login_warranty').on('keypress', function (e) {
    if (e.which === 13) {
        $('a#login-warranty').click();
        return false;
    }
});
$('input#password_login_warranty').on('keypress', function (e) {
    if (e.which === 13) {
        $('a#login-warranty').click();
        return false;
    }
});

$("span#pencil-name").click(function() {
  $("input#customer-name").focus();
});

$("span#pencil-address").click(function() {
  $("textarea#customer-address").focus();
});

$("span#pencil-phone").click(function() {
  $("input#customer-telp").focus();
});

$("a#change-service").click(function() {
  $('a#dropbtn').css("pointer-events", "auto");
  $('img#icon-drop-service').css('display', 'block');
  $('span#icon-drop-service-after').css('display', 'none');
  $('img#icon-drop-service-black').css('display','block');
  $('div#warranty-type-service').css('display','block');
  $('div#catatan-umum').css('display','block');
  $('img#icon-drop-service-black').removeClass('rotated');
  $(this).css('display','none');
});

$("a#change-upload").click(function() {
  $('div#upload-image-btn').css('display', 'block');
  $(this).css('display','none');
  $("a#change-upload").css('display','none');
  $("a#upload-next").css('display','none');
  $('#hidden-front').modal('hide');
  $('#hidden-left').modal('hide');
  $('#hidden-right').modal('hide');
  $('#hidden-top').modal('hide');
  $('#hidden-bottom').modal('hide');
  $('#hidden-back').modal('hide');
  $("div#image-zoom-warranty-front").hide();
  $("div#image-zoom-warranty-left").hide();
  $("div#image-zoom-warranty-right").hide();
  $("div#image-zoom-warranty-top").hide();
  $("div#image-zoom-warranty-bottom").hide();
  $("div#image-zoom-warranty-back").hide();
  $('div#warranty-photo-upload').css('display','block');
  $("a#how-upload-info").css("display", "block");
  
});

$("a#upload-next").click(function() {
  $('div#warranty-location').css('display', 'block');
  $('div#warranty-photo-upload').css('display', 'none');
  $("a#how-upload-info").css("display", "none");
  
  scroll_top('#warranty-location-title',120);
 
});

$("div#image-plus-warranty-right").mouseover(function(){
    $('img#plus-warranty-right').show();
});
$("div#image-plus-warranty-right").mouseout(function(){
    $('img#plus-warranty-right').hide();
});
$("div#image-plus-warranty-front").mouseover(function(){
    $('img#plus-warranty-front').show();
});
$("div#image-plus-warranty-front").mouseout(function(){
    $('img#plus-warranty-front').hide();
});
$("div#image-plus-warranty-left").mouseover(function(){
    $('img#plus-warranty-left').show();
});
$("div#image-plus-warranty-left").mouseout(function(){
    $('img#plus-warranty-left').hide();
});
$("div#image-plus-warranty-top").mouseover(function(){
    $('img#plus-warranty-top').show();
});
$("div#image-plus-warranty-top").mouseout(function(){
    $('img#plus-warranty-top').hide();
});
$("div#image-plus-warranty-bottom").mouseover(function(){
    $('img#plus-warranty-bottom').show();
});
$("div#image-plus-warranty-bottom").mouseout(function(){
    $('img#plus-warranty-bottom').hide();
});
$("div#image-plus-warranty-back").mouseover(function(){
    $('img#plus-warranty-back').show();
});
$("div#image-plus-warranty-back").mouseout(function(){
    $('img#plus-warranty-back').hide();
});

$("div#image-zoom-warranty-right").mouseover(function(){
    $('a#zoom-warranty-right').show();
});
$("div#image-zoom-warranty-right").mouseout(function(){
    $('a#zoom-warranty-right').hide();
});
$("div#image-zoom-warranty-front").mouseover(function(){
    $('a#zoom-warranty-front').show();
});
$("div#image-zoom-warranty-front").mouseout(function(){
    $('a#zoom-warranty-front').hide();
});
$("div#image-zoom-warranty-left").mouseover(function(){
    $('a#zoom-warranty-left').show();
});
$("div#image-zoom-warranty-left").mouseout(function(){
    $('a#zoom-warranty-left').hide();
});
$("div#image-zoom-warranty-top").mouseover(function(){
    $('a#zoom-warranty-top').show();
});
$("div#image-zoom-warranty-top").mouseout(function(){
    $('a#zoom-warranty-top').hide();
});
$("div#image-zoom-warranty-bottom").mouseover(function(){
    $('a#zoom-warranty-bottom').show();
});
$("div#image-zoom-warranty-bottom").mouseout(function(){
    $('a#zoom-warranty-bottom').hide();
});
$("div#image-zoom-warranty-back").mouseover(function(){
    $('a#zoom-warranty-back').show();
});
$("div#image-zoom-warranty-back").mouseout(function(){
    $('a#zoom-warranty-back').hide();
});
$('input:checkbox[id=claim-agreement]').on('change', function () {
    if ($('#claim-agreement').is(":checked")) {
        $("#agreement-modal").modal("show");
        $("span#agreement-error").css("display", "none");
    }
});

$("label#Lainnya").click(function() {
  $('div#textarea-other-text').toggle();
  setTimeout(function() { $('textarea[name="other-text"]').focus() }, 10);
    // $('textarea[name="other-text"]').get(0).focus();
});

 $("#preview-download").on('shown.bs.modal', function() {
    $('input[name="customer-name-warranty"]').focus()
  });

// VALIDATION FOR WARRANTY ISI ALAMAT KEMBALIAN
$(function() {
    if($('input#return-name').val() != '' && $('textarea#return-address').val() != '' && $('input#return-telp').val()){
            $("a#save-return-address").addClass('blue-round');
            $("a#save-return-address").removeClass('grey-round');
            $("a#save-return-address").css('pointer-events','auto');
        }else{
            $("a#save-return-address").addClass('grey-round');
            $("a#save-return-address").removeClass('blue-round');
            $("a#save-return-address").css('pointer-events','none');
        }
        
   $("input[id=return-name]").on('input',function (){
        if($('input#return-name').val() != '' && $('textarea#return-address').val() != '' && $('input#return-telp').val()){
            $("a#save-return-address").addClass('blue-round');
            $("a#save-return-address").removeClass('grey-round');
            $("a#save-return-address").css('pointer-events','auto');
        }else{
            $("a#save-return-address").addClass('grey-round');
            $("a#save-return-address").removeClass('blue-round');
            $("a#save-return-address").css('pointer-events','none');
        }
   });
   $("input[id=return-address]").on('input',function (){
        if($('input#return-name').val() != '' && $('textarea#return-address').val() != '' && $('input#return-telp').val()){
            $("a#save-return-address").addClass('blue-round');
            $("a#save-return-address").removeClass('grey-round');
            $("a#save-return-address").css('pointer-events','auto');
        }else{
            $("a#save-return-address").addClass('grey-round');
            $("a#save-return-address").removeClass('blue-round');
            $("a#save-return-address").css('pointer-events','none');
        }
   });
   $("input[id=return-telp]").on('input',function (){
        if($('input#return-name').val() != '' && $('textarea#return-address').val() != '' && $('input#return-telp').val()){
            $("a#save-return-address").addClass('blue-round');
            $("a#save-return-address").removeClass('grey-round');
            $("a#save-return-address").css('pointer-events','auto');
        }else{
            $("a#save-return-address").addClass('grey-round');
            $("a#save-return-address").removeClass('blue-round');
            $("a#save-return-address").css('pointer-events','none');
        }
   });
});

// VALIDATION FOR WARRANTY ISI ALAMAT PENGIRIM
$(function() {
    if($('input#customer-name').val() != '' && $('textarea#customer-address').val() != '' && $('input#customer-telp').val()){
            $("a#download-warranty").addClass('blue-round');
            $("a#download-warranty").removeClass('grey-round');
            $("a#download-warranty").css('pointer-events','auto');
        }else{
            $("a#download-warranty").addClass('grey-round');
            $("a#download-warranty").removeClass('blue-round');
            $("a#download-warranty").css('pointer-events','none');
        }
        
   $("input[id=customer-name]").on('input',function (){
        if($('input#customer-name').val() != '' && $('textarea#customer-address').val() != '' && $('input#customer-telp').val()){
            $("a#download-warranty").addClass('blue-round');
            $("a#download-warranty").removeClass('grey-round');
            $("a#download-warranty").css('pointer-events','auto');
        }else{
            $("a#download-warranty").addClass('grey-round');
            $("a#download-warranty").removeClass('blue-round');
            $("a#download-warranty").css('pointer-events','none');
        }
   });
   $("input[id=customer-address]").on('input',function (){
        if($('input#customer-name').val() != '' && $('textarea#customer-address').val() != '' && $('input#customer-telp').val()){
            $("a#download-warranty").addClass('blue-round');
            $("a#download-warranty").removeClass('grey-round');
            $("a#download-warranty").css('pointer-events','auto');
        }else{
            $("a#download-warranty").addClass('grey-round');
            $("a#download-warranty").removeClass('blue-round');
            $("a#download-warranty").css('pointer-events','none');
        }
   });
   $("input[id=customer-telp]").on('input',function (){
        if($('input#customer-name').val() != '' && $('textarea#customer-address').val() != '' && $('input#customer-telp').val()){
            $("a#download-warranty").addClass('blue-round');
            $("a#download-warranty").removeClass('grey-round');
            $("a#download-warranty").css('pointer-events','auto');
        }else{
            $("a#download-warranty").addClass('grey-round');
            $("a#download-warranty").removeClass('blue-round');
            $("a#download-warranty").css('pointer-events','none');
        }
   });
});    

// VALIDATION FOR WARRANTY PHOTO CONDITION
$(function() {
             

 });
 
$("#cancel-service").click(function(){
    if(confirm("Are you sure you want to cancel this service?")){
        $("#cancel-service").attr("href", baseUrl + "/warranty/cancel/" + service_id );
    }
    else{
        return false;
    }
});

$("#receive-goods-service").click(function(){
   
    if(confirm("Apakah Anda telah menerima barang Anda?")){
        $("#receive-goods-service").attr("href", baseUrl + "/warranty/receive/" + $(this).attr("attrId"));
    }
    else{
        return false;
    }
});

function detail_history_warranty(id){
   
    var $t = $("#detail-history-warranty-"+id);
    if ($t.is(':visible')) {
        $("#detail-history-warranty-"+id).slideUp();
        $('img#detail-history-down-'+id).removeClass('rotated');
    } else {
        $("#detail-history-warranty-"+id).slideDown();
        $('img#detail-history-down-'+id).addClass('rotated');
    }
}

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  
  $('#copy-account-number').tooltip("show");

        setTimeout(function(){
          $('#copy-account-number').tooltip( 'hide' );
        }, 2000);  
}

function copyTotal(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  
  $('#copy-total').tooltip("show");

        setTimeout(function(){
          $('#copy-total').tooltip( 'hide' );
        }, 2000);  
}

$("a#warranty-search-button").click(function(){
    var name = $("input[name='warranty-search']").val();
    window.location.href = baseUrl + '/warranty/card?search=' + name;
});
$("input[name='warranty-search']").keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    $('a#warranty-search-button').click();
    return false;  
  }
});   

// rating survei
$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */

  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    // id survei
    var survei_id = $(this).attr('attrid');
    
    // id question
    var survei_type = $(this).attr('attrtype');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('.stars-'+survei_type+' li.selected').last().data('value'), 10);
   
    responseMessage(survei_id,ratingValue,survei_type);
    
  });
  
  $('textarea').unbind('keyup change input paste').bind('keyup change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
        }
    }); 
  
});


function responseMessage(survei_id,ratingValue,survei_type) {
//  console.log(survei_id+' '+ratingValue);
  $('#survei-'+survei_type+'-'+survei_id).val(ratingValue);
}

$("input#password-signin").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
          
          $('a#signin-checkout').click();
            return false;  
    }
});

$("input#cpassword").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
          
          $('a#signup-checkout').click();
            return false;  
    }
});

$('#more-detail-history').on('click', function(){
  console.log('masuk pak');
  $('.show-detail-history').slideToggle();
  $('#lihat-lebih').toggle();
  $('#lihat-kurangi').toggle();
  $('#lihat-arrow-down').toggle();
  $('#lihat-arrow-up').toggle();
});

function filter_order(id){
  if(id.value == 'status'){
    $('#status-section').css('display','block');
    $('#date-section').css('display','none');
    $('#transaction-section').css('display','none');
  }else if(id.value == 'date'){
    $('#date-section').css('display','block');
    $('#status-section').css('display','none');
    $('#transaction-section').css('display','none');
  }else if(id.value == 'transaction'){
    $('#transaction-section').css('display','block');
    $('#date-section').css('display','none');
    $('#status-section').css('display','none');
    setTimeout(function () { $('input[name="tr').focus(); }, 20);
  }else{
    $('#status-section').css('display','none');
    $('#date-section').css('display','none');
    $('#transaction-section').css('display','none');
    window.location.reload();
  }
}

$('#tanggal-order').on('click', function(){
  // window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;
  // baseUrl + '/user/orders'
  var params = '';
  var date_from = '';
  var date_to = '';
  if($('input[name="date-from"]').val() != ''){
    date_from = '&date_from=' + $('input[name="date-from"]').val();
  }
  if($('input[name="date-to"]').val() != ''){
    date_to = '&date_to=' + $('input[name="date-to"]').val();
  }
  params = date_from + date_to;
  if(params != ''){
    window.location.href = baseUrl + '/user/orders?'+params;
  }

});
$('#tr-order').on('click', function(){
  // window.location.href = baseUrl + '/' + currentCategory + '/' + currentAction + '?' + params + pagination;
  // baseUrl + '/user/orders'
  var params = '';
  if($('input[name="tr"]').val() != ''){
    params = '&tr=' + $('input[name="tr"]').val();
  }
  
  if(params != ''){
    window.location.href = baseUrl + '/user/orders?'+params;
  }
  

});

$(document).ready(function(){
      var date_input=$('input[name="date-from"]'); //our date input has the name "date"
      var date_to=$('input[name="date-to"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        orientation: "auto"
      };
      var options2={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        orientation: "auto"
      };
      date_input.datepicker(options);
      date_to.datepicker(options2);
    })

$("input[name='tr']").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
          var params = '';
          if($('input[name="tr"]').val() != ''){
            params = '&tr=' + $('input[name="tr"]').val();
          }
          
          if(params != ''){
            window.location.href = baseUrl + '/user/orders?'+params;
          }
    }
});

$('a#selesai').on('click', function (e) {
    var id = $(this).attr('attrid');
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/user/selesai',
        data: {
            "id": $(this).attr('attrid'),
        },
        beforeSend: function () {
            $('#showAccept-'+id).modal('hide');
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
        
            $('#loadingScreen').modal('hide');
            $('#showFinish-'+id).modal('show');
        }
    });
    
});

$(document).ready(function(){
  if($('.click-voucher').length){
    $("#apply-code").trigger('click'); 
  }
});

/*
// temporary disable snow effect
var snowEffectInterval = jQuery.fn.snow({
  // min size of element (default: 20)
  minSize: 10,
  
  // max size of element (default: 50)
  maxSize: 30,
  
  // flake fall time multiplier (default: 20)
  fallTimeMultiplier: 20, 
  
  // flake fall time difference (default: 10000)
  fallTimeDifference: 10000, 
  
  // interval (miliseconds) between new element spawns (default: 500)
  spawnInterval: 500, 
  
  // jQuery element to apply snow effect on (should work on any block element) (default: body)
  target: jQuery(".snow-header"),
  
  //elements to use in generating snow effect
  elements  : [
  
    // // Element #1
    // { 
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#ffffff'
    // },
    
    // Element #2
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/big-red-snow-90.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/big-red-snow-50.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/big-red-snow-35.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-10.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-10.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-10.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-5.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    
    // // Element #3
    // { 
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#ffffff'
    // },
    
    // // Element #4
    // {
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-music" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#cc2037'
    // },
    
    // // Element #5
    // { 
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#ffffff'
    // },
  ]
});

var snowEffectInterval2 = jQuery.fn.snow({
  // min size of element (default: 20)
  minSize: 10,
  
  // max size of element (default: 50)
  maxSize: 30,
  
  // flake fall time multiplier (default: 20)
  fallTimeMultiplier: 20, 
  
  // flake fall time difference (default: 10000)
  fallTimeDifference: 10000, 
  
  // interval (miliseconds) between new element spawns (default: 500)
  spawnInterval: 500, 
  
  // jQuery element to apply snow effect on (should work on any block element) (default: body)
  target: jQuery("#snow-footer"),
  
  //elements to use in generating snow effect
  elements  : [
  
    // // Element #1
    // { 
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#ffffff'
    // },
    
    // Element #2
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/big-red-snow-90.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/big-red-snow-50.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/big-red-snow-35.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-10.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-10.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-10.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    { 
      // html element to be spawned for this element
      html: '<img src="https://thewatch.co/img/icons/christmas2018/tiny-red-snow-5.svg">',
      // hex color for this element - works only for font based icons
      color: '#ed9b40'
    },
    
    // // Element #3
    // { 
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#ffffff'
    // },
    
    // // Element #4
    // {
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-music" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#cc2037'
    // },
    
    // // Element #5
    // { 
    //   // html element to be spawned for this element
    //   html: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>',
    //   // hex color for this element - works only for font based icons
    //   color: '#ffffff'
    // },
  ]
});
*/

/**
  * start jquery timeTo
*/


$(document).ready(function(){
      $("#slideImg").rotate();
      $("#slideImgMobile").rotate();

    });
    
var campaign_home = new Swiper('.swiper-container.swiper-campaign-home', {
        spaceBetween: 0,
        slidesPerView: 1,
        slidesPerGroup: 1,
    });
    
$('#bannerCampaign').carousel({
	interval: 4000
})
$('#subBannerCampaign').carousel({
	interval: 4000
})
  
/*
  const $slider = $(".slider-1");
$slider
	.on("init", () => {
		mouseWheel($slider);
	})
	.slick({
		autoplay:true,
		autoplaySpeed:2500,
		dots: true,
		vertical: true,
		infinite: true,
		prevArrow: false,
        nextArrow: false,
	});
	
	function jumpBack() {
		setTimeout(function() {
			$slider.slick("slickGoTo", 0);
		}, 3000);
	}
	
	$slider.on("afterChange", function(event, slick, currentSlide, nextSlide) {
		// console.log(currentSlide);
		if (currentSlide === 2) {
			// console.log("last slide");
			jumpBack();
		}
	});
function mouseWheel($slider) {
    $(".slider-1").on("wheel", { $slider: $slider }, mouseWheelHandler);
	// $(window).on("wheel", { $slider: $slider }, mouseWheelHandler);
}
function mouseWheelHandler(event) {
	event.preventDefault();
	const $slider = event.data.$slider;
	const delta = event.originalEvent.deltaY;
	if (delta > 0) {
		$slider.slick('slickNext');
	}else{
		$slider.slick('slickPrev');
	}
}

const $slider2 = $("#slider-sl2");
$slider2
	.on("init", () => {
		mouseWheel2($slider2);
	})
	.slick({
		autoplay:true,
		autoplaySpeed:2500,
		dots: true,
		vertical: true,
		infinite: false,
		prevArrow: false,
        nextArrow: false
	});
function mouseWheel2($slider) {
	$("#slider-sl2").on("wheel", { $slider2: $slider2 }, mouseWheelHandler2);
	// $(window).on("wheel", { $slider2: $slider2 }, mouseWheelHandler2);
// 	$(".slide-wheel-2").on("wheel", { $slider: $slider }, mouseWheelHandler);
}
function mouseWheelHandler2(event) {
	event.preventDefault();
	const $slider = event.data.$slider2;
	const delta = event.originalEvent.deltaY;
	if (delta > 0) {
		$slider.slick('slickNext');
	}else{
		$slider.slick('slickPrev');
	}
}
*/

$('.slider-1').slick({
	autoplay:true,
	autoplaySpeed:2500,
	dots: true,
	vertical: true,
	infinite: true,
	adaptiveHeight: true,
	prevArrow: false,
	nextArrow: false
});

const slider = $(".slider-1");

slider.on('wheel', (function(e) {
	var slideCount = $(this)[0].slick["slideCount"];
	var currentIndex = $(this).slick("slickCurrentSlide");
	var totalSildeToShow =  $(this)[0].slick.options["slidesToShow"];

	if (e.originalEvent.deltaY < 0) {
		if(currentIndex == 0){
			return;
		}else{
			e.preventDefault();
			$(this).slick('slickPrev');
		}
	} else {
		if (slideCount - totalSildeToShow == currentIndex){
			return;
		}else{
			e.preventDefault();
			$(this).slick('slickNext');
		}
	}
}));

// On edge hit not used
slider.on('edge', function(event, slick, direction){
  console.log('edge was hit');
});

$('.slider-2').slick({
	autoplay:true,
	autoplaySpeed:2500,
	dots: true,
	vertical: true,
	infinite: true,
	adaptiveHeight: true,
	prevArrow: false,
	nextArrow: false
});

const slider2 = $(".slider-2");

slider2.on('wheel', (function(e) {
	var slideCount = $(this)[0].slick["slideCount"];
	var currentIndex = $(this).slick("slickCurrentSlide");
	var totalSildeToShow =  $(this)[0].slick.options["slidesToShow"];

	if (e.originalEvent.deltaY < 0) {
		if(currentIndex == 0){
			return;
		}else{
			e.preventDefault();
			$(this).slick('slickPrev');
		}
	} else {
		if (slideCount - totalSildeToShow == currentIndex){
			return;
		}else{
			e.preventDefault();
			$(this).slick('slickNext');
		}
	}
}));