$('a.addtocartBundling').on('click', function (e) {
    e.preventDefault();
    
    var id = $(this).attr("data-id");

    var attribute_value_id = $('select[name=straps-color-' + id + ']').length && !$('select[name=straps-color-' + id + ']').is(':disabled') ? $('select[name=straps-color-' + id + ']')[0].value : '',
            //id = $('input[name=product_free_id]')[0].value,
            reference = '',
            product_attribute_id = $('select[name=straps-color-' + id + ']').length && !$('select[name=straps-color-' + id + ']').is(':disabled') ? $('select[name=straps-color-' + id + '] option:selected').attr("attributeId") : 0,
            quantity = 1,
            name = $('input[name=product_bundling_name_' + id + ']')[0].value,
            price = $('input[name=product_bundling_price_' + id + ']')[0].value,
            brandName = $('input[name=brand_name_bundling_' + id + ']')[0].value,
            url = $('input[name=link-rewrite-bundling-' + id + ']')[0].value,
            color = $('select[name=straps-color-' + id + ']').length && !$('select[name=straps-color-' + id + ']').is(':disabled') ? $('select[name=straps-color-' + id + '] option:selected').text() : '',
            weight = $('input[name=weight_bundling_' + id + ']')[0].value,
            imageUrl = $('img#' + id).attr('src');
	
	var cartItem = [];
	
	cartItem.push({
            "id": id,
            "name": $('input[name=product_bundling_name_' + id + ']')[0].value,
            "price": price,
            "brand": brandName,
            "category": $('input[name=productCategoryBundling_' + id + ']')[0].value,
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
        "productBundlingCampaign" : true,
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
