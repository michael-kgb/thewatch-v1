sendProductClick = function(items, opt_list) {
    dataLayer.push({
        'event': 'productClick',
        'ecommerce': {
            'click': {
                'actionField': {'list': opt_list || 'none'},
                'products': items
            }
        }
    });
	
	return dataLayer;
};

sendPromotionClick = function(items){
	dataLayer.push({
        'event': 'promotionClick',
        'ecommerce': {
			'promoClick': {
				'promotions': items
			}
        }
    });
	
	return dataLayer;
}

sendAddToCartClick = function(items){
	
	dataLayer.push({
	  "event": "addToCart",
	  "ecommerce": {
		"currencyCode": "IDR",
		"add": {
		  "products": items
		}
	  }
	});
	
	fbq('track', 'AddToCart', {
		value: items[0]['price'],
		currency: 'IDR',
		content_ids: [''+ items[0]['id'] +''],
		content_type: 'product'
	});
	
	return dataLayer;
}

sendRemoveCartItem = function(items){
	
	dataLayer.push({
		"event": "removeFromCart",
		"ecommerce": {
			"currencyCode": "IDR",
			"remove": {
				"products": items
			}
		}
	});
	
	return dataLayer;
}

sendSubscribeNewsletter = function(){
	dataLayer.push({
		"event" : "subscribeNewsletter",
		"eventCategory" : "User",
		"eventAction" : "Subscribe",
		"eventLabel" : "Subscribe Newsletter"
	});
	
	fbq('track', 'CompleteRegistration');
	
	return dataLayer;
}

sendRegisterHomePage = function(){
	dataLayer.push({
		"event" : "registerHomepage",
		"eventCategory" : "User",
		"eventAction" : "Register",
		"eventLabel" : "Register Homepage"
	});
	
	fbq('track', 'CompleteRegistration');
	
	return dataLayer;
}

sendRegisterCheckout = function(){
	dataLayer.push({
		"event" : "checkoutRegister",
		"eventCategory" : "User",
		"eventAction" : "Register",
		"eventLabel" : "Register Checkout"
	});
	
	fbq('track', 'CompleteRegistration');
	
	return dataLayer;
}

sendProductImpression = function(items){
	dataLayer.push({
		"event" : "productImpressions",
		"ecommerce": {
			"currencyCode": "IDR",
			"impressions": items
		}
	});
	
	return dataLayer;
}