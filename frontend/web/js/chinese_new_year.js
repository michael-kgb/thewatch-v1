
    $(window).on('load',function(){
    	// open_fortune_cookie_reminder();
    	if(getCookie('voucher_name') == 'chinese_new_year'){
    		if($('#grandtotal_item').html() > 2000000){
    			$("#cny_footer_gold").slideDown("slow");
    		}
   			

	    }
	    else{
	    	if(getCookie('voucher_close') == 'true'){
	    		$("#cny_footer_red").slideDown("slow");
	    	}else{
	    		if($('.cookie_coin_congrat').html() != null){
	    			open_fortune_cookie();
	    		}
	    		
	    	}
	    	
	    }
	  
    });

    function open_fortune_cookie_reminder(){
    	var $window = $(window);
    	$('#fortuneCookie-reminder').modal('show');

    	$('main').css('-webkit-filter','blur(5px)');
				    	$('main').css('-moz-filter','blur(5px)');
				    	$('main').css('-o-filter','blur(5px)');
				    	$('main').css('-ms-filter','blur(5px)');
				    	$('main').css('filter','blur(5px)');
				    	$('.modal-backdrop.in').css('opacity','0.5')

				    	$('nav').css('-webkit-filter','blur(5px)');
				    	$('nav').css('-moz-filter','blur(5px)');
				    	$('nav').css('-o-filter','blur(5px)');
				    	$('nav').css('-ms-filter','blur(5px)');
				    	$('nav').css('filter','blur(5px)');

				    	$('#fortuneCookie-reminder').css('-webkit-filter','none !important');
				    	$('#fortuneCookie-reminder').css('-moz-filter','none !important');
				    	$('#fortuneCookie-reminder').css('-o-filter','none !important');
				    	$('#fortuneCookie-reminder').css('-ms-filter','none !important');
				    	$('#fortuneCookie-reminder').css('filter','none !important');

    				if($window.width() <= 768){
				    	$('.fortuneCookie-reminder').css('width','374px');
				    	$('.fortuneCookie-reminder').css('height','374px');
				    	$('#fortuneCookie-reminder').css('margin-left','25%');
				    	$('#fortuneCookie-reminder').css('margin-top','30%');
				    	$('.cookie-lanjut').css('padding-top','10px');
				    	$('.cookie_coin_congrat-').css('padding-top','30px');
				    	$('.cookie_coin-').css('padding-top','0px');
				    	$('.simpan_voucher').css('width','80%');

				    }
				    if($window.width() <= 414){
				    	
				    	$('#fortuneCookie-reminder').css('margin-left','20px');
				    	
				    }
				    if($window.width() <= 375){
				    	$('.fortuneCookie-reminder').css('width','345px');
				    	$('.fortuneCookie-reminder').css('height','345px');
				    	$('#fortuneCookie-reminder').css('margin-left','15px');
				    	$('.fortuneCookie-reminder').css('background-size','cover');
				    	
				    }
				    if($window.width() <= 360){
				    	$('#fortuneCookie-reminder').css('margin-left','7px');
				    	
				    }
				    if($window.width() <= 320){
				    	$('#fortuneCookie-reminder').css('margin-left','7px');
				    	$('.fortuneCookie-reminder').css('width','305px');
				    	$('.fortuneCookie-reminder').css('height','305px');
				    
				    }
    }
    function open_fortune_cookie(){

    	var $window = $(window);
	    // var cookie = $.cookie('voucher_name', 'chinese_new_year');

	
				// if($('#modal-cookie').html() == 'chinese_new_year'){

				// }else{
						
				    	$('#fortuneCookie').modal('show');


				    	$('main').css('-webkit-filter','blur(5px)');
				    	$('main').css('-moz-filter','blur(5px)');
				    	$('main').css('-o-filter','blur(5px)');
				    	$('main').css('-ms-filter','blur(5px)');
				    	$('main').css('filter','blur(5px)');
				    	$('.modal-backdrop.in').css('opacity','0.5')

				    	$('nav').css('-webkit-filter','blur(5px)');
				    	$('nav').css('-moz-filter','blur(5px)');
				    	$('nav').css('-o-filter','blur(5px)');
				    	$('nav').css('-ms-filter','blur(5px)');
				    	$('nav').css('filter','blur(5px)');

				    	$('#fortuneCookie').css('-webkit-filter','none !important');
				    	$('#fortuneCookie').css('-moz-filter','none !important');
				    	$('#fortuneCookie').css('-o-filter','none !important');
				    	$('#fortuneCookie').css('-ms-filter','none !important');
				    	$('#fortuneCookie').css('filter','none !important');

				    if($window.width() <= 1024){
				    	$('#fortuneCookie').css('margin-left','13%');
				    	$('#fortuneCookie').css('margin-top','15%');
				    	$('#cookie2').css('left','214px');
				    	$('#bg_cookie2').css('left','190px');
				    	$('#cookie1').css('right','205px');
				    	$('#bg_cookie1').css('right','185px');
				    }
				    if($window.width() <= 768){
				    	$('.fortuneCookie').css('width','374px');
				    	$('.fortuneCookie').css('height','374px');
				    	$('#fortuneCookie').css('margin-left','25%');
				    	$('.fortuneCookie').css('background-image','url(https://thewatch.co/img/event/fortune/mobile-background-374x374.jpg');
				    	$('.chinese-title').css('font-size','24px');
				    	$('.chinese-title').css('width','50%');
				    	$('.chinese-title').css('margin-left','25%');
				    	$('#cookie2').css('width','100px');
				    	$('#cookie1').css('width','100px');
				    	$('#cookie2').css('right','55px');
				    	$('#cookie2').css('top','35px');
				    	$('#cookie1').css('left','32px');
				    	$('#cookie1').css('top','35px');
				    	$('#bg_cookie2').css('width','125px');
				    	$('#bg_cookie2').css('right','23px');
				    	$('#bg_cookie2').css('top','52px');
				    	$('#bg_cookie1').css('width','125px');
						$('#bg_cookie1').css('left','22px');
				    	$('#fortuneCookie').css('margin-top','30%');

				    }
				    if($window.width() <= 414){
				    	
				    	$('#fortuneCookie').css('margin-left','20px');
				    	
				    }
				    if($window.width() <= 375){
				    	$('.fortuneCookie').css('width','345px');
				    	$('.fortuneCookie').css('height','345px');
				    	$('#fortuneCookie').css('margin-left','15px');
				    	$('.fortuneCookie').css('background-size','cover');
				    	$('.chinese-title').css('width','100%');
				    	$('.chinese-title').css('margin-left','0');
				    	$('#cookie2').css('right','60px');
				    	$('#bg_cookie2').css('right','28px');
				    	$('#cookie2').css('left','195px');
				    	$('#bg_cookie2').css('left','173px');
				    }
				    if($window.width() <= 360){
				    	$('#fortuneCookie').css('margin-left','7px');
				    	
				    }
				    if($window.width() <= 320){
				    	$('#fortuneCookie').css('margin-left','7px');
				    	$('.fortuneCookie').css('width','305px');
				    	$('.fortuneCookie').css('height','305px');
				    	$('.chinese-title').css('padding-top','25px');
				    	$('.chinese-title').css('font-size','20px');
				    
				    	$('#cookie2').css('top','20px');
				    	$('#cookie1').css('left','7px');
				    	$('#cookie1').css('top','20px');
			
				    	
				    	$('#cookie2').css('left','170px');
				    	$('#bg_cookie2').css('left','150px');

				 
				    
				    	$('#bg_cookie2').css('top','40px');
				    	$('#bg_cookie1').css('left','4px');
				    	$('#bg_cookie1').css('top','40px');
				    }
				// }
			       
		if(getCookie('voucher_close') == '' || getCookie('voucher_close') == 'false'){
			var d = new Date();
			d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
			var expires = "expires="+d.toUTCString();
		    document.cookie = "voucher_close=false;"+ expires +"; path=/";
		}
    }
     function open_cny_footer(){
    	$("#cny_footer_red").slideUp("slow");
    	open_fortune_cookie();
    }
    $("#fortuneCookie").modal({
        show: false,
        backdrop: 'static'
    });
    $('a.simpan_voucher').css('cursor','pointer');
    function simpan_voucher(element){
    	var $temp = $("<input>");
		  $("body").append($temp);
		  $temp.val($(element).html()).select(); //Note the use of html() rather than text()
		  document.execCommand("copy");
		  $temp.remove();
		  $('#body-prev').css('display','none');
		  $('.chinese-title').css('display','none');
		  $('.chinese-sub-title').css('display','none');
		  $('.chinese-title-success').css('display','none');
		  $('#body-success').css('display','block');

    }
    $('#fortuneCookie').on('hidden.bs.modal', function () {
	    $('main').css('-moz-filter','none');
	    	$('main').css('-o-filter','none');
	    	$('main').css('-ms-filter','none');
	    	$('main').css('filter','none');

	    	$('nav').css('-webkit-filter','none');
	    	$('nav').css('-moz-filter','none');
	    	$('nav').css('-o-filter','none');
	    	$('nav').css('-ms-filter','none');
	    	$('nav').css('filter','none');
	})

    $('a.close').on('click',function (e) {
    	$('main').css('-webkit-filter','none');
	    	$('main').css('-moz-filter','none');
	    	$('main').css('-o-filter','none');
	    	$('main').css('-ms-filter','none');
	    	$('main').css('filter','none');

	    	$('nav').css('-webkit-filter','none');
	    	$('nav').css('-moz-filter','none');
	    	$('nav').css('-o-filter','none');
	    	$('nav').css('-ms-filter','none');
	    	$('nav').css('filter','none');

	    	var d = new Date();
		    d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
		    var expires = "expires="+d.toUTCString();
	    	document.cookie = "voucher_close=true;"+ expires +"; path=/";

	    	console.log(getCookie('voucher_cok'));

	    	if(getCookie('voucher_name') == 'chinese_new_year'){
	   			// $("#cny_footer_gold").slideDown("slow");

		    }else{
		    	$("#cny_footer_red").slideDown("slow");
		    }
	    	
		
  	});
  	$('a.close-reminder').on('click',function (e) {
    	$('main').css('-webkit-filter','none');
	    	$('main').css('-moz-filter','none');
	    	$('main').css('-o-filter','none');
	    	$('main').css('-ms-filter','none');
	    	$('main').css('filter','none');

	    	$('nav').css('-webkit-filter','none');
	    	$('nav').css('-moz-filter','none');
	    	$('nav').css('-o-filter','none');
	    	$('nav').css('-ms-filter','none');
	    	$('nav').css('filter','none');
		
  	});
  	$("#cookie1").hover(function(){
        $(this).css("transform", "scale(1.3) rotate(10deg)");
        $(this).css("-ms-transform", "scale(1.3) rotate(10deg)");
        $(this).css("-webkit-transform", "scale(1.3) rotate(10deg)");
       	$(this).css('cursor', 'pointer');

        }, function(){
        $(this).css("transform", "scale(1) rotate(0deg)");
        $(this).css("-ms-transform", "scale(1) rotate(0deg)");
        $(this).css("-webkit-transform", "scale(1) rotate(0deg)");
        $(this).css('cursor', 'default');

    });

    function fortune_size_after(){
    	if($(window).width() > 768){
    		$('.fortuneCookie').css('background-image','url(https://thewatch.co/img/event/fortune/desktop-background-740x652.jpg');
    		$('#fortuneCookie').animate({marginTop: "2%"});
    		$('.fortuneCookie').animate({height: "652px"});
    	}if($(window).width() <= 768 && $(window).width() > 375){

				    	$('#cookie_gif1').css('width','260px');
				    	$('#cookie_gif2').css('width','260px');
				    	$('.chinese-title-success').css('font-size','24px');
				    	$('.chinese-title-success').css('padding-top','20px');
				    	$('.chinese-sub-title-success').css('font-size','14px');
				    
				    	$('.fortuneCookie').css('background-image','url(https://thewatch.co/img/event/fortune/mobile-background-374x541.jpg');
				    	$('#fortuneCookie').animate({marginTop: "5%"});
				    	$('.fortuneCookie').animate({height: "541px"});
				    	$('#cookie_prize_1').css('height','150px');
				    	$('#cookie_prize_2').css('height','150px');
				    	$('.cookie-description').css('font-size','14px');
				    	$('.cookie-description-simpan').css('font-size','14px');
				    	$('.cookie-description-simpan').css('padding-bottom','5px');
				    	$('.simpan_voucher').css('padding','10px');
				    	$('#cookie_code').css('font-size','24px');
				    	$('#cookie_code').css('padding-bottom','22px');
				    	$('#cookie_code').css('padding-top','5px');
				    	$('.simpan_voucher').css('width','40%');
				    }
				    if($(window).width() <= 375 && $(window).width() > 320){
				    	$('#cookie_gif1').css('width','260px');
				    	$('#cookie_gif2').css('width','260px');
				    	$('.chinese-title-success').css('font-size','24px');
				    	$('.chinese-title-success').css('padding-top','10px');
				    	$('.chinese-sub-title-success').css('font-size','14px');
				    
				    	$('.fortuneCookie').css('background-image','url(https://thewatch.co/img/event/fortune/mobile-background-374x541.jpg');
				    	$('#fortuneCookie').animate({marginTop: "5%"});
				    	$('.fortuneCookie').animate({height: "496px"});
				    	$('#cookie_prize_1').css('height','150px');
				    	$('#cookie_prize_2').css('height','150px');
				    	$('.cookie-description').css('font-size','12px');
				    	$('.cookie-description-simpan').css('font-size','14px');
				    	$('.cookie-description-simpan').css('padding-bottom','5px');
				    	$('.simpan_voucher').css('padding','10px');
				    	$('#cookie_code').css('font-size','24px');
				    	$('#cookie_code').css('padding-bottom','18px');
				    	$('#cookie_code').css('padding-top','5px');
				    	$('.simpan_voucher').css('width','40%');
				    }
				    if($(window).width() <= 320){
				    	$('.chinese-title-success').css('display','none');
				    	$('#cookie_gif1').css('width','230px');
				    	$('#cookie_gif2').css('width','230px');
				    	$('.chinese-title-success').css('font-size','24px');
				    	$('.chinese-title-success').css('padding-top','0px');
				    	$('.chinese-sub-title-success').css('font-size','14px');
				    
				    	$('.fortuneCookie').css('background-image','url(https://thewatch.co/img/event/fortune/mobile-background-374x451.jpg');
				    	$('#fortuneCookie').animate({marginTop: "5%"});
				    	$('.fortuneCookie').animate({height: "368px"});
				    	$('#cookie_prize_1').css('height','130px');
				    	$('#cookie_prize_2').css('height','130px');
				    	$('.cookie-description').css('font-size','10px');
				    	$('.cookie-description-simpan').css('font-size','10px');
				    	$('.cookie-description-simpan').css('padding-bottom','5px');
				    	$('.cookie-description-simpan').css('padding-top','10px');
				    	$('.simpan_voucher').css('padding','5px');
				    	$('#cookie_code').css('font-size','14px');
				    	$('#cookie_code').css('padding-bottom','22px');
				    	$('#cookie_code').css('padding-top','5px');
				    	$('.simpan_voucher').css('width','40%');
				    	$('.simpan_voucher').css('font-size','11px');
				    }
    }
    function fortune_size_before(){
    	if($(window).width() > 768){
    		
    	}if($(window).width() <= 768){
    					$('.chinese-title-success').css('font-size','24px');
    					$('.chinese-sub-title-success').css('font-size','14px');
				    	$('#cookie_gif1').css('width','260px');
				    	$('#cookie_gif2').css('width','260px');
				    	$('.cookie_coin_description').css('font-size','12px');
				    	$('.cookie_coin_description').css('padding-left','0');
				    	$('.cookie_coin_description').css('padding-right','0');
				    	$('.cookie_coin_description').css('padding-top','10px');
				    	$('#cookie_coin').css('width','125px');
				    	$('#cookie_coin').css('margin-bottom','10px');
				    	$('.cookie_coin').css('padding-top','165px');

				    }
				    if($(window).width() <= 375){
				    	$('.cookie_coin_congrat').css('font-size','22px');
				    	$('#cookie_gif1').css('width','215px');
				    	$('#cookie_gif2').css('width','215px');
				    }if($(window).width() <= 320){
				    	$('#cookie_coin').css('width','95px');
				    	$('#cookie_gif1').css('width','215px');
				    	$('#cookie_gif2').css('width','215px');
				    	$('#cookie_prize_1').css('height','220px');
				    	$('#cookie_prize_2').css('height','220px');
				    	$('.cookie_coin').css('padding-top','100px');
				    	$('.cookie_coin_congrat').css('font-size','14px');
				    	$('.cookie_coin_description').css('font-size','11px');
				    }

    }

    $('#cookie2').on('click',function (e) {
    	$('#bg_cookie1').css('display','none');
    	$('#bg_cookie2').css('display','none');
    	$('#cookie1').css('display','none');
    	$('#cookie2').css('display','none');
		$('.chinese-title').css('display','none');
		$('.chinese-title-success').css('display','block');
		$('.chinese-sub-title').css('display','none');
		$('.chinese-sub-title-success').css('display','block');
		$('.modal-header').css('padding-bottom','0px');
		$('.modal-body').css('padding-top','0px');
		$('.modal-body').css('padding-bottom','0px');
		fortune_size_before();

		var result = Math.floor((Math.random()* 2)+1);
		var code = randString(8).toUpperCase();

		$.ajax({
            type: "POST",
            url: baseUrl + '/cart/voucher/chinese-new-year/',
            data: {
        		'id': result,       
               	'code': code,
            },
            beforeSend: function () {
                // $('#cookie1_else').css("transform", "translate(100px,0px)");
                $('#cookie_prize_'+result).show();
            },
            success: function (data) {
            	
            	
            	setTimeout(
				  function() 
				  {
				  	console.log(result);
				    fortune_size_after();
	            	
	            	
	            	
	            	$('#cookie_code').text(code);
	            	
	            	$('#cookie_description').show();
				  }, 3000);
            	
                
            }
        });

		
		// $('#cookie2').css('display','none');
  	});

    $('#cookie1').on('click',function (e) {
    	$('#bg_cookie1').css('display','none');
    	$('#bg_cookie2').css('display','none');
    	$('#cookie1').css('display','none');
    	$('#cookie2').css('display','none');
		$('.chinese-title').css('display','none');
		$('.chinese-title-success').css('display','block');
		$('.chinese-sub-title').css('display','none');
		$('.chinese-sub-title-success').css('display','block');
		$('.modal-header').css('padding-bottom','0px');
		$('.modal-body').css('padding-top','0px');
		$('.modal-body').css('padding-bottom','0px');
		fortune_size_before();

		var result = Math.floor((Math.random()* 2)+1);
		var code = randString(8).toUpperCase();

		$.ajax({
            type: "POST",
            url: baseUrl + '/cart/voucher/chinese-new-year/',
            data: {
        		'id': result,       
               	'code': code,
            },
            beforeSend: function () {
                // $('#cookie1_else').css("transform", "translate(100px,0px)");
                $('#cookie_prize_'+result).show();
            },
            success: function (data) {
            	
            	
            	setTimeout(
				  function() 
				  {
				  	console.log(result);
				    fortune_size_after();
	  
	            	$('#cookie_code').text(code);
	            	
	            	$('#cookie_description').show();
				  }, 5000);
            	
                
            }
        });

		
		// $('#cookie2').css('display','none');
  	});

  	

    $("#cookie2").hover(function(){
        $(this).css("transform", "scale(1.3) rotate(10deg)");
        $(this).css("-ms-transform", "scale(1.3) rotate(10deg)");
        $(this).css("-webkit-transform", "scale(1.3) rotate(10deg)");
        $(this).css('cursor', 'pointer');
       
        }, function(){
        $(this).css("transform", "scale(1) rotate(0deg)");
        $(this).css("-ms-transform", "scale(1) rotate(0deg)");
        $(this).css("-webkit-transform", "scale(1) rotate(0deg)");
        $(this).css('cursor', 'default');
    });

    $('#cookie2').on('click',function (e) {
    	$('#bg_cookie1').css('display','none');
    	$('#bg_cookie2').css('display','none');
		$('.chinese-title').css('display','none');
		$('.chinese-sub-title').css('display','none');
		// $('#cookie1').css('display','none');
  	});


