
function registerNewsletter(){
    var name = $("input[name=newsletter_name]").val(),
        email = $("input[name=newsletter_email]").val(),
        errorMessage = $("#newsletter-error-message"),
        successMessage = $("#newsletter-success-message");

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

    if (name === '') {
        $('span#name-error').show();
        $('span#name-error').html('* First Name Is Required!');
        return;
    } else {
        $('span#name-error').hide();
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/go-api/customer/quick-sign-up',
        //url: 'https://gostaging.thewatch.co/go-api/customer/quick-sign-up',
        data: {"customerInfo": {
                "email": email,
                "fname": name,
            }},
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
        success: function (data) {
            var d = data;
            $('#loadingScreen').modal('hide');
            if (d.status === false) {
                errorMessage.removeClass("dnone");
                errorMessage.text(d.message);
                $('span#signup-error').show();
                
                return;
            }else{
                successMessage.removeClass("dnone");
                successMessage.text(d.message);

                setTimeout(function() {
                    window.location.href = baseUrl;
                }, 4000);
            }

			// sendRegisterCheckout();

			// (function(document, window) {
			// 	var scr = document.createElement("script");
			// 	scr.type = "text/javascript";
			// 	scr.async = true;
			// 	scr.src =  "//ssp.adskom.com/tags/third-party-async/ZmQzMTAxOWYtODQ3ZC00ZTBiLWIyOWUtMTgxYzgzNTI4MTcy";

			// 	document.body.appendChild(scr);
			// })(document, window);
            
           
        }
    });
}