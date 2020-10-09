/**
 * Theme: Abstack - Bootstrap 4 Web App kit
 * Author: Coderthemes
 * Module/App: Main Js
 */

 var refreshInterval = ((10 * 60) * 1000);
 
function refreshClaimService(){
	
	$.ajax({
		method: "GET",
		url: storeUrl + "/api/checkclaimservicemanual",
		dataType: 'json',
		success: function(r){
			var success = r.success,
				total = r.total;
			
			if(success){
				$.toast({
					heading: 'Notification',
					text: 'You Have ' + total + ' Claim Service Manual Awaiting For Confirmation Today <a href="' + baseUrl +'/servismanual">Details</a>',
					position: 'top-right',
					loaderBg: '#3b98b5',
					icon: 'info',
					hideAfter: false,
					stack: 1
				});
			}
		}
	});
}

if(isAdminService){
	setInterval(function(){
		refreshClaimService();
	}, refreshInterval);
}

(function ($) {

    'use strict';
	
	$('#11').change(function() {
		if (this.checked) {
			$('#service_other_text').css('display', 'block');
		} else {
			$('#service_other_text').css('display', 'none');
		}
	});

	
	$('#customer_identifier').on("keypress", function(e) {
        if (e.keyCode == 13) {
			$.ajax({
				method: "POST",
				url: storeUrl + "/api/checkorders",
				data: { q: $(this).val() },
				dataType: 'json',
				success: function(r){
					var data = r.data,
						success = r.success;
						
					if(success){
						$("#warrantyData").empty();
						for(var i=0; i < data.length; i++){
							for(var j=0; j < data[i].orderDetail.length; j++){
								$("#warrantyData").append(
									"<tr>" +
									"<td>" + data[i].orderDetail[j].productName + "</td>" +
									"<td>" + data[i].orderDetail[j].productPrice + "</td>" +
									"<td>" + data[i].orderDetail[j].productWarrantyCode + "</td>" +
									"<td>" + data[i].orderDetail[j].productWarrantyNumber + "</td>" +
									"<td>" + data[i].orderDetail[j].productWarrantyExpireDate + "</td>" +
									"</tr>"
								);
							}
						}
					} else {
						$("#warrantyData").empty();
						$("#warrantyData").append(
							"<tr>" +
							"<td colspan=5 align='center'>NO DATA TO DISPLAY</td>" +
							"</tr>"
						);
					}
				}
			})
		}
	});
	
	$('#createWarrantyForm').submit(function() {
		checked = $("input[type=checkbox]:checked").length;

		if(!checked) {
			alert("Please Select at least 1 Service List!");
			return false;
		}
	});
	
	$(".product-claim-service").select2({
		ajax: {
			//url: 'https://api.github.com/search/repositories',
			url: storeUrl + '/api/getproductlist',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					q: params.term, // search term
					page: params.page
				};
			},
			processResults: function (data, params) {
				// parse the results into the format expected by Select2
				// since we are using custom formatting functions we do not need to
				// alter the remote JSON data, except to indicate that infinite
				// scrolling can be used
				params.page = params.page || 1;
				
				productItems;
				productItems = data.items;
				
				return {
					results: data.items,
					pagination: {
						more: (params.page * 30) < data.total_count
					}
				};
			},
			cache: true
		},
		placeholder: 'Search for a product',
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 4,
		//templateResult: formatRepo,
		//templateSelection: formatRepoSelection
	});
	
	$(".product-warranty-number").select2({
		ajax: {
			//url: 'https://api.github.com/search/repositories',
			url: storeUrl + '/api/getwarrantynumber',
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					q: params.term, // search term
					page: params.page
				};
			},
			processResults: function (data, params) {
				// parse the results into the format expected by Select2
				// since we are using custom formatting functions we do not need to
				// alter the remote JSON data, except to indicate that infinite
				// scrolling can be used
				params.page = params.page || 1;
				
				warrantyItems;
				warrantyItems = data.items;
				
				return {
					results: data.items,
					pagination: {
						more: (params.page * 30) < data.total_count
					}
				};
			},
			cache: true
		},
		placeholder: 'Search for a Warranty Number',
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 2,
		//templateResult: formatRepo,
		//templateSelection: formatRepoSelection
	});
	
	$('#store-select2').select2();

    function initSlimscrollMenu() {

        $('.slimscroll-menu').slimscroll({
            height: 'auto',
            position: 'right',
            size: "8px",
            color: '#9ea5ab',
            wheelStep: 5
        });
    }

    function initSlimscroll() {
        $('.slimscroll').slimscroll({
            height: 'auto',
            position: 'right',
            size: "8px",
            color: '#9ea5ab'
        });
    }

    function initMetisMenu() {
        //metis menu
        $("#side-menu").metisMenu();
    }

    function initLeftMenuCollapse() {
        // Left menu collapse
        $('.button-menu-mobile').on('click', function (event) {
            event.preventDefault();
            $("body").toggleClass("enlarged");
        });
    }

    function initEnlarge() {
        if ($(window).width() < 1025) {
            $('body').addClass('enlarged');
        } else {
            $('body').removeClass('enlarged');
        }
    }

    function initActiveMenu() {
        // === following js will activate the menu in left side bar based on url ====
        $("#sidebar-menu a").each(function () {
            if (this.href == window.location.href) {
                $(this).addClass("active");
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().addClass("in");
                $(this).parent().parent().prev().addClass("active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("in"); // add active to li of the current link
                $(this).parent().parent().parent().parent().parent().addClass("active");
            }
        });
    }

    function init() {
        initSlimscrollMenu();
        initSlimscroll();
        initMetisMenu();
        initLeftMenuCollapse();
        initEnlarge();
        initActiveMenu();
    }

    init();

})(jQuery)

