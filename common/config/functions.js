// addtocart click button trigger
$('a.addtocart').on('click', function(e) {
    e.preventDefault();
    
    if($('select.color').length){
        // validate if user not choosing color
        if($('select.color')[0].value === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Color');

            return;
        }
    }
    
    if($('select.qty').length){
        // validate if user not choosing quantity
        if($('select.qty')[0].value === "0") {
            $('div.cart-add-error.error').show();
            $('div.cart-add-error.error span').html('* Please Select Quantity');

            return;
        }
    }
    
    var attribute_value_id = $('select.color').length ? $('select.color')[0].value : '',
        id = $('input[name=product_id]')[0].value,
        reference = '',
        product_attribute_id = $('select.color').length ? $('select.color option:selected').attr("attributeId") : 0,
        quantity = $('select.qty')[0].value,
        name = $('.product-name span')[0].textContent,
        price = $('input[name=price]')[0].value,
        brandName = $('input[name=brand_name]')[0].value,
        url = $('input[name=link-rewrite]')[0].value,
        color = $('select.color').length ? $('select.color option:selected').text() : '',
        imageUrl = $('select.color').length ? $('a#' + attribute_value_id).attr("data-image") : $('a#0').attr("data-image");
        
    var items = [{
        "id" : id,
        "product_attribute_id" : product_attribute_id,
        "reference" : reference,
        "name" : name,
        "brand_name" : brandName,
        "unit_price" : price,
        "total_price" : (price * quantity),
        "attribute_value_id" : attribute_value_id,
        "color" : color,
        "quantity" : quantity,
        "url" : baseUrl + '/product/' + url,
        "image" : {
            "url" : imageUrl
        }
    }];
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/add-item',
//        dataType: 'json',
        data: {"cart" : {
            "items" : items
        }},
        success: function(data){
            $("div#box-cart").html(data);
            $("#arrow-cart").slideDown();
            $("#box-cart").slideDown();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
    });
});

$('select#payment_method').on('change', function() {
    // validate if user selected color
    if($('select#payment_method')[0].value !== "0") {
        var payment_method_id = $('select#payment_method')[0].value;
        $.ajax({
            type: "GET",
            url: baseUrl + '/cart/payment/get-payment-list/' + payment_method_id,
            success: function(data){
                $('div.payment').html(data);
            }
        });
    }
});

$('a#payment-info').on('click', function(e) {
    e.preventDefault();
    
    if($('input:radio:checked').length < 1){
        $('div.payment-error').show();
        return false;
    }
    
    if(!$('#agreement').is(":checked")){
        $('div.agreement-error').show();
        return false;
    }
    
    $('div.payment-error').hide();
    $('div.agreement-error').hide();
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/step/paymentinformation',
        data: { "paymentMethod" : { "payment_id" : $('input:radio:checked')[0].value, "payment_method_id" : $('select#payment_method option:selected')[0].value } },
        beforeSend: function(){

        },
        success: function(data){
            window.location.href = baseUrl + '/cart/checkout/step/revieworder';
        }
    });
});

$('div#signin-btn').on('click', function(e) {
    e.preventDefault();
    
    var email = $('input[name=email]').val(),
        password = $('input[name=password]').val();
    
    if (email === '') {
        $('span#email-signin-error').show();
        $('span#email-signin-error').html('* Email Is Required!');
        return;
    } else if(!validateEmail(email)) {
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
            "email" : $('input[name=email]')[0].value,
            "password" : $('input[name=password]')[0].value
        },
        success: function(data){
            var d = data;
            if(d === 'FALSE'){
                $('span#signintop-error').show();
                return;
            }
            
            window.location.href = baseUrl + '/user/profile';
        }
    });
});

$('div#signup-btn').on('click', function(e) {
    e.preventDefault();
    
    var email = $('input[name=signup_email]').val(),
        fname = $('input[name=fname]').val(),
        password = $('input[name=signup_password]').val();
    
    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
        return;
    } else if(!validateEmail(email)) {
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
            "customerInfo" : {
                "email" : $('input[name=signup_email]')[0].value,
                "fname" : $('input[name=fname]')[0].value,
                "lname" : '',
                "password" : $('input[name=signup_password]')[0].value,
                "newsletter" : $('input[name=newsletter]')[0].value
            }
        },
        success: function(data){
            var d = data;
            if(d === 'FALSE'){
                $('span#signuptop-error').show();
                return;
            }
            
            location.reload();
        }
    });
});

$('div#signup').on('click', function(e) {
    
    e.preventDefault();
    
    $('div#signup-form').show();
    $('div#signup').css('border', '1px solid #000');
    $('div#signup').css('background', '#ffffff');
    $('div#signup').css('color', '#000');
    
    $('div#signin-form').hide();
    $('div#signin').css('border', '1px solid #000');
    $('div#signin').css('background', '#000');
    $('div#signin').css('color', '#fff');
    
    $('div#signin-box').hide();
    $('div#signup-box').show();
});

$('div#signin').on('click', function(e) {
    
    e.preventDefault();
    
    $('div#signup-form').hide();
    $('div#signup').css('border', '1px solid #000');
    $('div#signup').css('background', '#000');
    $('div#signup').css('color', '#ffffff');
    
    $('div#signin-form').show();
    $('div#signin').css('border', '1px solid #000');
    $('div#signin').css('background', '#ffffff');
    $('div#signin').css('color', '#000');
    
    $('div#signin-box').show();
    $('div#signup-box').hide();
});

$('input:radio[name=shipping]').on('change', function() {
    $('select.shipping').prop("disabled", false);
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/shipping/generate-shipping-method',
        data: { "customer_address_id" : $('input:radio[name=shipping]:checked')[0].value },
        beforeSend: function(){

        },
        success: function(data){
            $("div.step-purchase.shipping-method").html(data);
        }
    });
});

$('a#delivery-list').on('click', function(e) {
    e.preventDefault();
    
    if($('input:radio:checked').length > 0){
        var customer_address_id = $('input:radio:checked')[0].value;
        
        $('div.signup-error').hide();
        
        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/shipping-submit',
            data: { "customer_address_id" : customer_address_id, "shipping_method" : $('select#shipping-method').length ? $('select#shipping-method option:selected').val() : 0 },
            success: function(data){
                window.location.href = baseUrl + '/cart/checkout/step/paymentinformation';
            }
        });

        return;
        
    } else {
        $('div.signup-error').show();
    }
    
    
    
});

$('a#removeItem').on('click', function(e) {
    
    e.preventDefault();
    
    var id = $(this).attr("data-id"),
        attributeId = $(this).attr("attributeId");
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item',
        data: { "id" : id, "attributeId" : attributeId },
        beforeSend: function(){
            
        },
        success: function(data){
            $("div#box-cart").html(data);
        }
    });
    
    if($("section#shopping-bag").length){
        $.ajax({
            type: "POST",
            url: baseUrl + '/cart/checkout/remove-cart-item',
            data: { "id" : id, "attributeId" : attributeId },
            beforeSend: function(){

            },
            success: function(data){
                $("section#shopping-bag").html(data);
            }
        });
    }
});

$('a#removeCartItem').on('click', function(e) {
    
    e.preventDefault();
    
    var id = $(this).attr("data-id"),
        attributeId = $(this).attr("attributeId");
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-cart-item',
        data: { "id" : id, "attributeId" : attributeId },
        beforeSend: function(){
            
        },
        success: function(data){
            $("section#shopping-bag").html(data);
        }
    });
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/remove-item',
        data: { "id" : id, "attributeId" : attributeId },
        beforeSend: function(){
            
        },
        success: function(data){
            $("div#box-cart").html(data);
        }
    });
});

$('select.color').on('change', function() {
    // validate if user selected color
    if($('select.color')[0].value !== "0") {
        $('select.qty').prop("disabled", false);
        $('div.cart-add-error.error').hide();
        
        var ez = $("#product-img").data('elevateZoom');
        var attribute_value_id = $('select.color')[0].value,
            product_attribute_id = $('select.color option:selected').attr("attributeId");
        
        // generate quantity select box
        $.ajax({
            type: "POST",
            url: baseUrl + '/stock/quantity',
            data: {"attribute_value_id" : product_attribute_id },
            beforeSend: function(){
                $('#loadingAjax').fadeIn(200, function () {});
                $('span.product-total').hide();
            },
            success: function(data){
                $('#loadingAjax').fadeOut(200, function () {});
                $('span.product-total').show();
                $('select.qty').html(data);
                
                $('a.small-thumb').hide();
                
                // show selected attribute images
                $('a[id=' + attribute_value_id + ']').show();
                
                var smallImage = $('a#' + attribute_value_id).attr("data-image");
                var largeImage = $('a#' + attribute_value_id).attr("data-zoom-image");
				
				console.log(ez);
				
                // change into first selected attribute images
                ez.swaptheimage(smallImage, largeImage);
            }
        });
        
    } else {
        $('select.qty').val(0);
        $('span.product-total').html('');
        $('select.qty').prop("disabled", true);
    }
    
});

$('select.qty').on('change', function() {
    // validate if user choose quantity
    if($('select.qty')[0].value !== "0") {
        
        $('div.cart-add-error.error').hide();
        
        // generate total price
        $.ajax({
            type: "POST",
            url: baseUrl + '/stock/price',
            data: {"quantity" : $('select.qty')[0].value, "price" : $('input.price').val()},
            beforeSend: function(){
                $('#loadingAjax').fadeIn(200, function () {});
                $('span.product-total').hide();
            },
            success: function(data){
                $("#loadingAjax").css('display', 'none');
                $('span.product-total').show();
                $('.product-total').html(data);
            }
        });
        
    } else {
        $('span.product-total').html('');
    }
});

$('a#signin-checkout').on('click', function(e) {
    e.preventDefault();
    
    var email = $("#email-signin").val(),
        password = $('#password-signin').val();
    
    if (email === '') {
        $('span#email-signin-error').show();
        $('span#email-signin-error').html('* Email Is Required!');
    } else if(!validateEmail(email)) {
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
        data: {"email" : email, "password" : password},
        success: function(data){
            var d = data;
            if(!d){
                $('span#signin-error').show();
                return;
            }
            
            window.location.href = baseUrl + '/cart/checkout/step/deliveryinformation';
        }
    });
});

$('a#signup-checkout').on('click', function(e) {
    e.preventDefault();
    
    var email = $("#email").val(),
        password = $('#password').val(),
        cpassword = $('#cpassword').val();
    
    if (email === '') {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Required!');
    } else if(!validateEmail(email)) {
        $('span#email-error').show();
        $('span#email-error').html('* Email Is Not Valid!');
    } else {
        $('span#email-error').hide();
    }
    
    if (password === '') {
        $('span#password-error').show();
        $('span#password-error').html('* Password Is Required!');
    } else {
        $('span#password-error').hide();
    }
    
    if (cpassword === '') {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Is Required!');
        return;
    } else if(cpassword !== password) {
        $('span#password-confirm-error').show();
        $('span#password-confirm-error').html('* Password Do Not Match!');
        return;
    } else {
        $('span#password-confirm-error').hide();
    }
    
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/sign-up',
        data: { "customerInfo" : {
            "email" : email, 
            "password" : password,
            "isNewCustomer" : true
        }},
        beforeSend: function(){
            
        },
        success: function(data){
            var d = data;
            if(d === 'FALSE'){
                $('span#signup-error').show();
                return;
            } 
            
            window.location.href = baseUrl + '/cart/checkout/step/deliveryinformation';
        }
    });
});

$('a#add-shipping').on('click', function(e) {
    e.preventDefault();
    
    var fname = $("#fname").val(),
        lname = $("#lname").val(),
        phone = $("#phone").val(),
        address = $("#address").val(),
        zip = $("#zip").val(),
        province_id = $("#province").val(),
        province_name = $('select#province option:selected').text(),
        state_id = $("#state").val(),
        state_name = $('select#state option:selected').text(),
        district_id = $("#district").val(),
        district_name = $('select#district option:selected').text(),
        shipping_method_id = $("#shipping-method").val(),
        shipping_method = $("select#shipping-method option:selected").text();
        
    $.ajax({
        type: "POST",
        url: baseUrl + '/cart/checkout/step/deliveryinformation',
        data: { "shippingInformation" : {
            "fname" : fname, 
            "lname" : lname,
            "phone" : phone,
            "address" : address,
            "zip" : zip,
            "province_id" : province_id,
            "province_name" : province_name,
            "state_id" : state_id,
            "state_name" : state_name,
            "district_id" : district_id,
            "district_name" : district_name,
            "shipping_method_id" : shipping_method_id,
            "shipping_method_name" : shipping_method
        }},
        beforeSend: function(){
            
        },
        success: function(data){
            window.location.href = baseUrl + '/cart/checkout/step/deliveryinformation';
        }
    });
});

$('select#province').on('change', function(e){
    
    e.preventDefault();
    
    if($('select#province')[0].value !== "0") {
        
        $('select#district').val(0);
        $('select#district').prop("disabled", true);
        
        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);
        
        var province_id = $('select#province')[0].value;
        
        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-state',
            data: { "province_id" : province_id },
            beforeSend: function(){

            },
            success: function(data){
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

$('select#state').on('change', function(e){
    
    e.preventDefault();
    
    if($('select#state')[0].value !== "0") {
        
        var state_id = $('select#state')[0].value;
        
        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-district',
            data: { "state_id" : state_id },
            beforeSend: function(){

            },
            success: function(data){
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

$('select#district').on('change', function(e){
    
    e.preventDefault();
    
    if($('select#district')[0].value !== "0") {
        
        var district_id = $('select#district')[0].value;
        
        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-shipping-method',
            data: { "district_id" : district_id },
            beforeSend: function(){

            },
            success: function(data){
                $("div.carrier-method").html(data);
            }
        });
    } else {
        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);
    }
    
});

$('a#search').on('click', function(e) {
    e.preventDefault();
    
    $("div.searchform").fadeIn(500, function() {
        
        $('input#search').focus();
    });
    
    $('a#search').hide();
});

$('input#search').on('focusout', function() {
    $("div.searchform").fadeOut(500, function() {
        $('a#search').show();
    });
})

function validateEmail(email) { 
  // http://stackoverflow.com/a/46181/11236
  
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}