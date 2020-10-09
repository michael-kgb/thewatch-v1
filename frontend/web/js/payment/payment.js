
function lala(sendAsGift, gift_message, installment){
    
    var data;
    if(installment){
        data = {
            "paymentMethod": {
                "payment_id": $('input:radio[name=payment_method]:checked')[0].value,
                "payment_method_id": $('input:radio[name=payment_method]:checked').attr("method-id"),
                "installment_plan": $('input:radio[name=installmentplan]:checked')[0].value
            },
            "send_as_gift" : {
                "is_a_gift" : sendAsGift,
                "gift_message" : gift_message
            }
        };
    }else{
        data = {
            "paymentMethod": {
                "payment_id": $('input:radio[name=payment_method]:checked')[0].value,
                "payment_method_id": $('input:radio[name=payment_method]:checked').attr("method-id"),
            },
            "send_as_gift" : {
                "is_a_gift" : sendAsGift,
                "gift_message" : gift_message
            }
        };
    }
    
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/step/paymentinformation',
        data: data,
        beforeSend: function () {
            // alert("sebat dulu");
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            $('#loadingScreen').modal('hide');
            console.log(data);
                $("#confirmorder-form").submit();
        }
    });
}

$('a#payment-info').on('click', function (e) {
    e.preventDefault();
    
    // alert("Bersiap untuk mengorder...");
    // snap.pay(snapToken); // store your snap token here
    // return false;
    $(this).attr("disabled", "disabled");

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
    
//     if ($('input:radio[data-id=cc]').is(':checked')) {
//         $(function () {
//             // Sandbox Parameter
// //            Veritrans.url = "https://api.sandbox.veritrans.co.id/v2/token";
// //            Veritrans.client_key = "VT-client-mjABlnYixiNp15XZ";
            
//             if($('.credit-valid').html() == '' || $('.credit-length').html() == '' || $('.credit-luhn').html() == ''){
//               $('.cardholder.card-number.credit').css("border","solid 2px rgb(161,29,33)");
           
//                   return false;
//               }
//               if($('.cardholder.card-cvv').val().length < 3){
//                   $('.cardholder.card-cvv').css("border","solid 2px rgb(161,29,33)");
     
//                   return false;
//               }
            
//             // check product stock
//               var isOk = false;
//               $.ajax({
//                     type: "GET",
//                     url: baseUrl + '/cart/checkout/checkstock',
//                     dataType: 'json',
//                     async: false,
//                     data: {
                      
//                     },
//                     beforeSend: function () {
//                         $('#loadingScreen').modal('show');
//                     },
//                     success: function (data) {
//                         $('#loadingScreen').modal('hide');
//                         if(data[0] == 'berhasil'){
//                           // continue
//                           console.log(data[0]);
//                           isOk = true;
//                         }else{
//                           console.log(data[0]);
//                           isOk = false;
//                         }
                        
//                     }
//                 }); 

//               if(isOk == false){
//                 alert('maaf stock habis');
//                 window.location.href = baseUrl;
//                 return false;
//               } 
              
//               /**/
//               function checkValue(str, strArray){
//                 for (var j=0; j<strArray.length; j++) {
//                   if (strArray[j].match(str.substring(0, 4))) return true;
//                 }
//                 return false;
//               }
              
//               var cardnumber = $(".card-number").val();
              
//               if(checkValue(cardnumber, permataBin)){
// 				var promoPermataAmountCC = $('input[name="special_promo"]').val();
//                 grossamount -= Math.round(promoPermataAmountCC);
//               }
              
//               if(checkValue(cardnumber, mandiriBin)){
// 				 var promoMandiriAmountCC = $('input[name="special_promo"]').val();
//                 grossamount -= Math.round(promoMandiriAmountCC);
//               }
              
//               if(checkValue(cardnumber, bcaBin)){
// 				var promoBCAAmountCC = $('input[name="special_promo"]').val();
//                 grossamount -= Math.round(promoBCAAmountCC);
//               }
//               /**/
      
//             // Veritrans.url = "https://api.veritrans.co.id/v2/token";
//             // Veritrans.client_key = "VT-client-_rz55Hanv0PtThrX";

//             Veritrans.url = vtrans_url + '/token';
//             Veritrans.client_key = vtrans_clnt;

//             // Veritrans.url = "https://api.sandbox.veritrans.co.id/v2/token";
//             // Veritrans.client_key = "VT-client-mjABlnYixiNp15XZ";

//             // $('input[name=payment_id]').val($('input:radio[name=payment_method]:checked')[0].value);
//             $('input[name=payment_method_id]').val($('input:radio[name=payment_method]:checked').attr("method-id"));
//             var card = function () {
//                 return {
//                     "card_number": $('.card-number').val(),
//                     "card_exp_month": $('select#card-expiry-month option:selected')[0].value,
//                     "card_exp_year": $('select#card-expiry-year option:selected')[0].value,
//                     "card_cvv": $('.card-cvv').val(),
//                     "secure": true,
//                     "gross_amount": grossamount,
//                     "bank": acquiringBank,
//                 }
//             };

//             function callback(response) {
//                 console.log(response);
//                 if (response.redirect_url) {
//                     alert("3D SECURE");
                    
//                     // 3D Secure transaction, please open this popup
//                     openDialog(response.redirect_url);
//                 }
//                 else if (response.status_code == "200") {
//                     alert("3-D success");
//                     // Success 3-D Secure or success normal
//                     closeDialog();
//                     // Submit form
//                     $("#token_id").val(response.token_id);
//                     $("#payment-form").submit();
//                 }else {
//                     closeDialog();
//                     // Failed request token
//                     console.log(response.status_code);
//                     alert(response.status_message);
                    
//                     $('.shopping-bag.creditcardform').css('padding-left','28px');
//                     $('.shopping-bag.creditcardform').css('padding-right','28px');
//                     $('.shopping-bag.creditcardform').css('padding-top','15px');
//                     $('.shopping-bag.creditcardform').css('padding-bottom','15px');
//                     $('.shopping-bag.creditcardform').css("border","solid 2px rgb(161,29,33)");
//                     $('.shopping-bag.creditcardform').css("border-radius","5px");
//                     $('button').removeAttr("disabled");
                    
//                     // return stock
//                     $.ajax({
//                         type: "GET",
//                         url: baseUrl + '/cart/checkout/returnstock',
//                         dataType: 'json',
//                         async: false,
//                         data: {
                          
//                         },
//                         beforeSend: function () {
//                             // $('#loadingScreen').modal('show');
//                         },
//                         success: function (data) {
//                             // $('#loadingScreen').modal('hide');
//                             console.log('return stock');
//                         }
//                     }); 
//                 }
//             }

//             function openDialog(url) {
//                 $.fancybox.open({
//                     href: url,
//                     type: "iframe",
//                     autoSize: false,
//                     width: 700,
//                     height: 500,
//                     closeBtn: false,
//                     modal: true
//                 });
//             }

//             function closeDialog() {
//                 $.fancybox.close();
//             }

//             //$(".submit-button").click(function (event) {
//             // console.log("SUBMIT");
			
			
// 			function checkValue(str, strArray){
// 				for (var j=0; j<strArray.length; j++) {
// 					if (strArray[j].match(str.substring(0, 4))) return true;
// 				}
// 				return false;
// 			}
			
// 			var cardnumber = $(".card-number").val();
			
// 			/*
// 			if(checkValue(cardnumber, permataBin)){
// 				promoPermataAmount = grossamount * 0.05;
// 				grossamount -= Math.round(promoPermataAmount);
// 			}
			
			
// 			if(checkValue(cardnumber, mandiriBin)){
// 				grossamount -= Math.round(promoMandiriAmount);
// 			}
// 			*/
			
//             //event.preventDefault();
//             //$(this).attr("disabled", "disabled");
            
//             Veritrans.token(card, callback);
//             return false;
//             //});
//         });
//     }

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
    
                if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19 || bank == 29) {
                    lala(sendAsGift, gift_message, true);
                    return 1;
                }

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
                
                  function checkValue(str, strArray){
                    for (var j=0; j<strArray.length; j++) {
                      if (strArray[j].match(str.substring(0, 4))) return true;
                    }
                    return false;
                  }
                  
                  var cardnumber = $(".card-number").val();
                  
                  if(checkValue(cardnumber, permataBin)){
					var promoPermataAmountCC = $('input[name="special_promo"]').val();
                    grossamount -= Math.round(promoPermataAmountCC);
                  }
                  
                  if(checkValue(cardnumber, mandiriBin)){
					var promoMandiriAmountCC = $('input[name="special_promo"]').val();
                    grossamount -= Math.round(promoMandiriAmountCC);
                  }
              
				  if(checkValue(cardnumber, bcaBin)){
					var promoBCAAmountCC = $('input[name="special_promo"]').val();
					grossamount -= Math.round(promoBCAAmountCC);
				  }
                  /**/
              
                // Veritrans.url = "https://api.veritrans.co.id/v2/token";
                // Veritrans.client_key = "VT-client-_rz55Hanv0PtThrX";

                Veritrans.url = vtrans_url + '/token';
                Veritrans.client_key = vtrans_clnt;

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
                        // Success 3-D Secure or success normal
                        closeDialog();
                        // Submit form
                        $("#token_id").val(response.token_id);
                        $("#payment-form").submit();
                    }
                    else {
                        closeDialog();
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

                function closeDialog() {
                    $.fancybox.close();
                }
				
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
                          $('input[name="special_promo"]').val(promoPermataAmountCC);
                          grossamount -= Math.round(promoPermataAmountCC);
                        }
                        
                        // if(checkValue(cardnumber, mandiriBin)){
                        //   $('input[name="special_promo"]').val(promoMandiriAmountCC);
                        //   grossamount -= Math.round(promoMandiriAmountCC);
                        // }
                    } else if (bank == 6){
                        if(checkValue(cardnumber, bcaBin)){
                          $('input[name="special_promo"]').val(promoBCAAmountCC);
                          grossamount -= Math.round(promoBCAAmountCC);
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

    // if ($('input:radio[data-id=cc]').is(':checked') || $('input:radio[data-id=ip]').is(':checked')) {
    if ($('input:radio[data-id=ip]').is(':checked')) {

    } else {

        
        // bank transfer kredivo
        lala(sendAsGift, gift_message, false);
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
