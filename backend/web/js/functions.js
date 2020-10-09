//'use strict';
//
//$(document).ready(function() {
//
//    // Copyright 2014-2015 Twitter, Inc.
//    // Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
//    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
//        var msViewportStyle = document.createElement('style');
//        msViewportStyle.appendChild(document.createTextNode('@-ms-viewport{width:auto!important}'));
//        document.querySelector('head').appendChild(msViewportStyle);
//    }
//
//    // Handling select box in android
//    // By Twitter Bootstrap Team
//    var nua = navigator.userAgent;
//    var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1);
//    if (isAndroid) {
//        $('select.form-control').removeClass('form-control').css('width', '100%');
//    }
//
//});


/*preorder*/
$('#preorder').click(function(){
       $('#preOrder').toggle(this.checked);
   });

$(document).ready(function() {
    $('#related').css('display','none');
        $('#check-product').change(function() {
            if(this.checked) {
                if($('#check-product:checkbox:checked').length > 0){
                    $('#related').css('display','block');
                }else{
                    $('#related').css('display','none');
                }
              
            }else{
                $('#related').css('display','none');
            }
        });
    });
    
$(function () {
    "use strict";

	$("select#seopage").change(function(){
		var seopage = $("select#seopage")[0].value;
		if(seopage == 2){
			$('#brand-list-seo').css('display', 'block');
		} else {
			$('#brand-list-seo').css('display', 'none');
		}
	});
	
	if($('textarea#seo_footer_description_right').length){
		CKEDITOR.replace('seo_footer_description_right', {
			extraPlugins: 'wordcount',
			wordcount : {
				showCharCount : true,
				showWordCount : true
			}
		});
	}
	
	if($('textarea#seo_footer_description_left').length){
		CKEDITOR.replace('seo_footer_description_left', {
			extraPlugins: 'wordcount',
			wordcount : {
				showCharCount : true,
				showWordCount : true
			}
		});
	}
	
	if($('textarea#meta_title').length){
		CKEDITOR.replace('meta_title', {
			extraPlugins: 'wordcount',
			wordcount : {
				showCharCount : true,
				showWordCount : true,

				// Maximum allowed Char Count
				maxCharCount: 160
			}
		});
	}
	
	if($('textarea#meta_description').length){
		CKEDITOR.replace('meta_description', {
			extraPlugins: 'wordcount',
			wordcount : {
				showCharCount : true,
				showWordCount : true,

				// Maximum allowed Char Count
				maxCharCount: 160
			}
		});
	}
	
	if($('textarea#meta_keywords').length){
		CKEDITOR.replace('meta_keywords', {
			extraPlugins: 'wordcount',
			wordcount : {
				showCharCount : true,
				showWordCount : true,

				// Maximum allowed Char Count
				maxCharCount: 160
			}
		});
	}
	
	$( "ul#sortable" ).sortable({
        axis: 'y',
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
                data: data,
                type: 'POST',
                url: baseUrl + '/brandscollection/reordering-collections'
            });
	}
    });
    $( "#sortable" ).disableSelection();
	
	$( "ul#sortable-homebanner" ).sortable({
        axis: 'y',
        stop: function (event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
                data: data,
                type: 'POST',
                url: baseUrl + '/homebanner/reordering-homebanner'
            });
	}
    });
    $( "#sortable-homebanner" ).disableSelection();

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    });
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    //jQuery UI sortable for the todo list
    $(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    $('.daterange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end) {
        $.ajax({
            type: 'POST',
            url: 'getstart',
            data: {
                startdate: start.format('YYYY-MM-DD'),
                enddate: end.format('YYYY-MM-DD')
            },
            dataType: 'json',
            cache: false,
            beforeSend: function (xhr) {
                $('.overlay').delay(1000).fadeIn();
            },
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    visitorsData[data[i][0]] = data[i][1];
                }
                $('.overlay').delay(1000).fadeOut();
            }
        });


//                window.alert("You chosedada: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    /* jQueryKnob */
    $(".knob").knob();

    $('#world-map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: "transparent",
        regionStyle: {
            initial: {
                fill: '#e4e4e4',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
            }
        },
        series: {
            regions: [{
                    values: visitorsData,
                    scale: ["#92c1dc", "#ebf4f9"],
                    normalizeFunction: 'polynomial'
                }]
        },
        onRegionLabelShow: function (e, el, code) {
            if (typeof visitorsData[code] != "undefined")
                el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
        }
    });

    $('.overlay').delay(1000).fadeOut();

    //Sparkline charts
    var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
    $('#sparkline-1').sparkline(myvalues, {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: "#ebf4f9",
        height: '50',
        width: '80'
    });
    myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
    $('#sparkline-2').sparkline(myvalues, {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: "#ebf4f9",
        height: '50',
        width: '80'
    });
    myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
    $('#sparkline-3').sparkline(myvalues, {
        type: 'line',
        lineColor: '#92c1dc',
        fillColor: "#ebf4f9",
        height: '50',
        width: '80'
    });

    //The Calender
    $("#calendar").datepicker();

    var likecomments = (likecomments === undefined) ? "" : likecomments;
    var tags = (tags === undefined) ? "" : tags;

    if (likecomments != "") {
        var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            data: likecomments,
            xkey: 'y',
            ykeys: ['item1', 'item2'],
            labels: ['Likes', 'Comments'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover: 'auto'
        });
    }

    if (tags != "") {
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: tags,
            barColors: ['#a0d0e0'],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Total'],
            hideHover: 'auto'
        });
    }

    //SLIMSCROLL FOR CHAT WIDGET
    $('#chat-box').slimScroll({
        height: '250px'
    });

    /* Morris.js Charts */
    // Sales chart

    //Fix for charts under tabs
    $('.box ul.nav a').on('shown.bs.tab', function () {
        area.redraw();
        donut.redraw();
        line.redraw();
    });

    /* The todo list plugin */
    $(".todo-list").todolist({
        onCheck: function (ele) {
            window.console.log("The element has been checked");
            return ele;
        },
        onUncheck: function (ele) {
            window.console.log("The element has been unchecked");
            return ele;
        }
    });

});

$('[data-load-remote]').on('click',function(e) {
    e.preventDefault();
    var $this = $(this);
    var remote = $this.data('load-remote');
    if(remote) {
        $($this.data('remote-target')).load(remote);
    }
});

//SLIMSCROLL FOR CHAT WIDGET
$('#chat-box').slimScroll({
    height: '500px'
});

$(window).on('load', function(){
    $('.overlay').delay(1000).fadeOut();
});


var date = new Date();
date.setDate(date.getDate());
var product_count = 1;

$('#example1, #example2').datepicker({
    format: "yyyy-mm-dd 00:00:00",
    // startDate: date
});

$('#from1, #to2').datepicker({
    format: "yyyy-mm-dd"
    //startDate: date
});

$(".searchbox").autocomplete({
    source: function (request, response) {

        $.ajax({
            url: "findcustomer",
            dataType: "json",
            data: {
                'email': request.term
            },
            success: function (data) {
                console.log(request.term);
                response(data);
                console.log(data);
            }
        });
    }
});


function delete_attribute_value(id, total_product){
    if (confirm("This data linked with " + total_product + ' products.\n\n Are you sure want to delete this data?') == true) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: baseUrl + '/productattributes/deleteattributevalue/' + id,
            success: function (data) {
                $("tbody").empty();
                $("tbody").append(data.data);
                location.reload();
            }
        });
    }
}
function deleteRecord(id, module) {
    if (confirm("Delete this data ?") == true) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: baseUrl + '/' + module + '/delete/' + id,
            success: function (data) {
                $("tbody").empty();
                $("tbody").append(data.data);
                location.reload();
            }
        });
    }
}
function deleteRecordss(id, module) {
    if (confirm("Delete this data ?") == true) {
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: baseUrl + '/' + module.id + '/delete/' + id,
            success: function (data) {
                $("tbody").empty();
                $("tbody").append(data.data);
                location.reload();
            }
        });
    }
}

function viewRecord(id, module) {
    window.location.href = baseUrl + '/' + module.id + '/view/' + id;
}

function updateRecord(id, module) {
    window.location.href = baseUrl + '/' + module.id + '/update/' + id;
}

var tabsFn = (function () {

    function init() {
        setHeight();
    }

    function setHeight() {
        var $tabPane = $('.tab-pane'),
                tabsHeight = $('.nav-tabs').height();

        $tabPane.css({
//      height: tabsHeight
        });
    }

    $(init);
})();

$("#switch-enabled").bootstrapSwitch();
$("#switch-enabled2").bootstrapSwitch();
$(function () {
	if($('textarea#productdetail-spesification').length){
		CKEDITOR.replace('productdetail-spesification', {
			extraPlugins: 'colorbutton'
		});
	}
	if($('textarea#jadwal-spesification').length){
		CKEDITOR.replace('jadwal-spesification', {
			extraPlugins: 'colorbutton'
		});
	}
	if($('textarea#productdetail-description').length){
		CKEDITOR.replace('productdetail-description', {
			extraPlugins: 'colorbutton'
		});
	}
	if($('textarea#short-description').length){
		CKEDITOR.replace('short-description', {
			extraPlugins: 'colorbutton'
		});
	}
	if($('textarea#journaldetail-description').length){
		CKEDITOR.replace('journaldetail-description', {
			extraPlugins: 'colorbutton'
		});
	}
	if($('textarea#journaldetail-content').length){
		CKEDITOR.replace('journaldetail-content', {
			extraPlugins: 'colorbutton'
		});
	}
	    if($('textarea#juara1-description').length){
        CKEDITOR.replace('juara1-description');
    }
    if($('textarea#juara2-description').length){
        CKEDITOR.replace('juara2-description');
    }
    if($('textarea#juara3-description').length){
        CKEDITOR.replace('juara3-description');
    }
    if($('textarea#productdetail-product_size_info').length){
        CKEDITOR.replace('productdetail-product_size_info');
    }
    if($('textarea#productdetail-product_care').length){
        CKEDITOR.replace('productdetail-product_care');
    }
    $('#tagsfield').tokenfield()
});

$('.relatedItems').multiSelect({
    selectableHeader: "<div class='selectable-header'>Selectable Products</div>",
    selectionHeader: "<div class='selected-header'>Selected Products</div>",
});

$('.shipping-carrier').multiSelect({
    selectableHeader: "<div class='selectable-header' style='margin-top: 0px;'>Selectable Carriers</div>",
    selectionHeader: "<div class='selected-header' style='margin-top: 0px;'>Selected Carriers</div>",
});

$('.product-tag').multiSelect({
    selectableHeader: "<div class='selectable-header' style='margin-top: 0px;'>Selectable Products</div>",
    selectionHeader: "<div class='selected-header' style='margin-top: 0px;'>Selected Products</div>",
});

$('.productItems').multiSelect({
    selectableHeader: "<input type='text' class='selectable-header' autocomplete='off' placeholder='search...'>",
    selectionHeader: "<input type='text' class='selectable-header' autocomplete='off' placeholder='search...'>",
    afterInit: function(ms){
      var that = this,
          $selectableSearch = that.$selectableUl.prev(),
          $selectionSearch = that.$selectionUl.prev(),
          selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
          selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

      that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
      .on('keydown', function(e){
        if (e.which === 40){
          that.$selectableUl.focus();
          return false;
        }
      });

      that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
      .on('keydown', function(e){
        if (e.which == 40){
          that.$selectionUl.focus();
          return false;
        }
      });
    },
    afterSelect: function(){
      this.qs1.cache();
      this.qs2.cache();
    },
    afterDeselect: function(){
      this.qs1.cache();
      this.qs2.cache();
    }
});

$('#is_flash_sale').click(function(){
    if($("#is_flash_sale").is(':checked')){
        $("#addmore-flashsale-periode").removeClass('hidden');
        if($("[id=box-available-flashsale]").length > 1){
            for(var i = 1; i <= $("#box-available-flashsale").length; i++){
                $("[id=box-available-flashsale]").removeClass('hidden');
            }
        } else {
            $("[id=box-available-flashsale]").removeClass('hidden');
        }
        $("#box-available").addClass('hidden');
        $("#qty-flash-sale").removeClass('hidden');
    } else {
        $("#addmore-flashsale-periode").addClass('hidden');
        if($("[id=box-available-flashsale]").length > 1){
            for(var i = 1; i <= $("[id=box-available-flashsale]").length; i++){
                $("[id=box-available-flashsale]").addClass('hidden');
            }
        } else {
            $("[id=box-available-flashsale]").addClass('hidden');
        }
        $("#box-available").removeClass('hidden');
        $("#qty-flash-sale").addClass('hidden');
    }
});

$("#addmore-flashsale-periode").click(function(e) {
    $("#box-available-flashsale").clone().insertAfter("#box-available-flashsale");
    e.preventDefault();
});

$('#newCombination').on('click', function () {
    $('#formAttribute').show();
    $('.add-new-combination').show();
    $('#saveCombination').show();
    $('#editCombination').hide();
    $('.edit-img-combination').hide();
});

$('#cancelCombination').on('click', function () {
    $('#formAttribute').hide();
});

$('#createCombination').on('click', function (e) {
    e.preventDefault();
     if ($('select#attribute_id')[0].value !== "0" && $('select#attribute_value_id')[0].value !== "0") {
        var attribute_value_id = $('select#attribute_value_id')[0].value;
        var attribute_id = $('select#attribute_id')[0].value;
        var attribute_id_text = $('select#attribute_id option:selected').text();
        var attribute_value_id_text = $('select#attribute_value_id option:selected').text();

        if ($('select#attribute_id2')[0].value !== "0" && $('select#attribute_value_id2')[0].value !== "0") {
            var attribute_value_id2 = $('select#attribute_value_id2')[0].value;
            var attribute_id2 = $('select#attribute_id2')[0].value;
            var attribute_id_text2 = $('select#attribute_id2 option:selected').text();
            var attribute_value_id_text2 = $('select#attribute_value_id2 option:selected').text();

            $('select#ProductAttributeCombination').append('<option attributeId="' + attribute_id +'+'+ attribute_id2 + '" value="' + attribute_value_id +'+'+ attribute_value_id2 + '">' + attribute_id_text + ' : ' + attribute_value_id_text + ', '+ attribute_id_text2 + ' : ' + attribute_value_id_text2 + '</option>');
        }else{
                $('select#ProductAttributeCombination').append('<option attributeId="' + attribute_id + '" value="' + attribute_value_id + '">' + attribute_id_text + ' : ' + attribute_value_id_text + '</option>');
        }

    }else{
        if ($('select#attribute_id2')[0].value !== "0" && $('select#attribute_value_id2')[0].value !== "0") {
            var attribute_value_id2 = $('select#attribute_value_id2')[0].value;
            var attribute_id2 = $('select#attribute_id2')[0].value;
            var attribute_id_text2 = $('select#attribute_id2 option:selected').text();
            var attribute_value_id_text2 = $('select#attribute_value_id2 option:selected').text();

            $('select#ProductAttributeCombination').append('<option attributeId="' + '0' +'+'+ attribute_id2 + '" value="' + '0' +'+'+ attribute_value_id2 + '">' + attribute_id_text2 + ' : ' + attribute_value_id_text2 + '</option>');
        }
    }
});

$('#saveCombination').on('click', function (e) {
    e.preventDefault();
    if ($('select#ProductAttributeCombination').has('option').length > 0) {
        var attribute_value_id = [];
        var attribute_id = [];
        var product_id = document.getElementById('product_id').value;

        var i = 0;
        var total_option = $('#ProductAttributeCombination option').size();

        for (i = 0; i < total_option; i++) {
            attribute_value_id[i] = $('select#ProductAttributeCombination')[0][i]['attributes'][1].value;
            attribute_id[i] = $('select#ProductAttributeCombination')[0][i]['attributes'][0].value;
        }

        $.ajax({
            type: "POST",
            url: "../savecombination",
            data: {
                'attribute_id': attribute_id,
                'attribute_value_id': attribute_value_id,
                'product_id': product_id,
            },
            dataType: "json",
            success: function (data) {
                $('#formAttribute').hide();
                $('#test-attribute').empty();
                $('#product-quantity').empty();
                $(data[0]).appendTo($("#test-attribute"));
                $(data[1]).appendTo($("#product-quantity"));
            }
        });
    }
});

$('#editCombination').on('click', function (e) {
    e.preventDefault();

    var checked = document.getElementsByName('product_image_combination[]');
    var product_attribute_id = document.getElementById('edit_image_combination_id').value;
    var product_id = document.getElementById('product_id').value;

    var image_id = [];
    var no = 0;

    for (i = 0; i < checked.length; i++) {
        if (checked[i].checked == true) {
            image_id[no] = checked[i].value;
            no++;
        }
    }

    if (image_id.length != 0) {
        $.ajax({
            type: "POST",
            url: "../editimagecombination",
            data: {
                'product_attribute_id': product_attribute_id,
                'image_id': image_id,
                'product_id': product_id
            },
            success: function (data) {
                $('#formAttribute').hide();
                $('#test-attribute').empty();
                $(data).appendTo($("#test-attribute"));
            }
        });
    }
    else {
        alert('choose 1 image or more');
    }

});

$('#removeCombination').on('click', function (e) {
    e.preventDefault();
    if ($('select#ProductAttributeCombination option:selected').length) {
        $('select#ProductAttributeCombination option:selected').remove();
    }
});

function editCombination(id, title) {
    document.getElementById("edit_image_combination_id").value = id;

    var product_id = document.getElementById('product_id').value;
    var id_product_attribute = id;
    var i = 0;

    $.ajax({
        type: "POST",
        url: "../getstatusimage",
        data: {
            'id_product_attribute': id_product_attribute,
            'product_id': product_id
        },
        dataType: 'json',
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/dist/img/spin.gif'></div>").appendTo($("#combination").css("position", "relative"));
        },
        success: function (data) {
            for (i = 0; i <= data.length - 1; i++) {
                if (data[i] == 1) {
                    $('#checkbox' + (i + 1)).prop('checked', true);
                }
                else {
                    $('#checkbox' + (i + 1)).prop('checked', false);
                }
            }
            document.getElementById('attribute-edit-name').value = title;
            $("#overlay").remove();
            $('#formAttribute').show();
            $('.add-new-combination').hide();
            $('#saveCombination').hide();
            $('#editCombination').show();
            $('.edit-img-combination').show();
        }
    });
}

function deleteCombination(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        var product_id = document.getElementById('product_id').value;
        $.ajax({
            type: "POST",
            url: "../deleteattributecombination",
            data: {
                'product_attribute_id': id,
                'product_id': product_id
            },
            success: function (data) {
                $('#formAttribute').hide();
                $('#test-attribute').empty();
                $(data).appendTo($("#test-attribute"));
            }
        });
    }
}

$('select#attribute_id').on('change', function () {
    if ($('select#attribute_id')[0].value !== "0") {

        var attribute_id = $('select#attribute_id')[0].value;

        $('select#attribute_value_id').prop("disabled", false);

        // generate quantity select box
        $.ajax({
            type: "POST",
            url: baseUrl + '/attributes/value',
            data: {"attribute_id": attribute_id},
            beforeSend: function () {
//                $('#loadingAjax').fadeIn(200, function () {});
//                $('span.product-total').hide();
            },
            success: function (data) {
//                $("#loadingAjax").css('display', 'none');
//                $('span.product-total').show();
                $('select#attribute_value_id').html(data);
                $('#add-new-value-attributes').show();
            }
        });
    }
});

$('select#attribute_id2').on('change', function () {
    if ($('select#attribute_id2')[0].value !== "0") {
        var attribute_id = $('select#attribute_id2')[0].value;
        $('select#attribute_value_id2').prop("disabled", false);
        // generate quantity select box
        $.ajax({
            type: "POST",
            url: baseUrl + '/attributes/value',
            data: {"attribute_id": attribute_id},
            beforeSend: function () {
//                $('#loadingAjax').fadeIn(200, function () {});
//                $('span.product-total').hide();
            },
            success: function (data) {
//                $("#loadingAjax").css('display', 'none');
//                $('span.product-total').show();
                $('select#attribute_value_id2').html(data);
                $('#add-new-value-attributes2').show();
            }
        });
    }
});

function duplicate(no, title) {
    var table = document.getElementById("data-grid-feature");
    var row = table.insertRow(table.rows.length);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);

    var value = document.getElementById('feature_id' + no).outerHTML;
    var value2 = document.getElementById('custom_value_name' + no).outerHTML;
    var value3 = document.getElementById('custom_value_value' + no).outerHTML;

    cell1.innerHTML = title;
    cell2.innerHTML = value;
    cell3.innerHTML = value2;
    cell4.innerHTML = value3;
    cell5.innerHTML = '<a onclick="duplicate(' + no + ',&#39;' + title + '&#39;)" class="btn btn-default text-center delete-features-row"><i class="fa fa-copy"></i> Duplicate</a> <a onclick="delete_row_feature(' + (table.rows.length - 1) + ')" class="btn btn-default text-center"><i class="fa fa-close"></i> Delete</a>';

}

function delete_row_feature(row) {
    document.getElementById("data-grid-feature").deleteRow(row);
}

function saveFeature() {
    var custom_feature = document.getElementsByName('product_feature_custom[][]');
    var custom_feature_variables = document.getElementsByName('product_feature_value_custom[][]');
    var feature = document.getElementsByName('product_feature[][]');
    var product_id = document.getElementById('product_id').value;
    var feature_id = [];
    var feature_value_id = [];
    var custom_feature_id = [];
    var custom_feature_name = [];
    var custom_feature_value = [];

    var j = 0;
    var k = 0;

    for (var i = 0; i < custom_feature.length; i++) {
        if (custom_feature[i].value == "") {
            feature_id[j] = feature[i].id.substring(10, feature[i].id.length);
            feature_value_id[j] = feature[i].value;
            j++;
        }
        else {
            custom_feature_id[k] = feature[i].id.substring(10, feature[i].id.length);
            custom_feature_name[k] = custom_feature[i].value;
            custom_feature_value[k] = custom_feature_variables[i].value;
            k++;
        }
    }

    if (feature_id.length == 0) {
        feature_id[0] = "empty";
        feature_value_id[0] = "empty";
    }

    if (custom_feature_id.length == 0) {
        custom_feature_id[0] = "empty";
        custom_feature_name[0] = "empty";
        custom_feature_value[0] = "empty";
    }

    $.ajax({
        type: "POST",
        url: baseUrl + '/products/saveproductfeature',
        data: {
            "feature_id": feature_id,
            "feature_value_id": feature_value_id,
            "product_id": product_id,
            "custom_feature_id": custom_feature_id,
            "custom_feature_name": custom_feature_name,
            "custom_feature_value": custom_feature_value
        },
        dataType: 'json',
        success: function (data) {
            $('#tbody-feature-value').empty();
            $('#tbody-feature-add').empty();
            $(data[0]).appendTo($("#tbody-feature-value"));
            $(data[1]).appendTo($("#tbody-feature-add"));
        }
    });
}

function deleteFeature(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        var product_id = document.getElementById('product_id').value;
        $.ajax({
            type: "POST",
            url: "../deletefeature",
            data: {
                'product_feature_id': id,
                'product_id': product_id
            },
            success: function (data) {
                $('#tbody-feature-value').empty();
                $(data).appendTo($("#tbody-feature-value"));
            }
        });
    }
}

function uploadimage() {
    var j = "";
    var myFormData = new FormData();
    myFormData.append('product_id', document.getElementById('product_id').value);
    myFormData.append('total_image', userImage.files.length);

    for (var i = 0; i <= userImage.files.length; i++) {
        j = 'image_upload' + i;
        myFormData.append(j, userImage.files[i]);
    }

    $.ajax({
        url: '../upload',
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        dataType: 'json',
        data: myFormData,
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#images").css("position", "relative"));
        },
        success: function (data) {
            $('#image-available').empty();
            $('#image-attribute-combination').empty();
            for (var i = 0; i < data[0].length; i++) {
                $(data[0][i]).appendTo($("#image-available"));
            }
            for (var i = 0; i < data[1].length; i++) {
                $(data[1][i]).appendTo($("#image-attribute-combination"));
            }

            $("#overlay").remove();
        }
    });
}

function deleteProductImage(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        var product_id = document.getElementById('product_id').value;
        $.ajax({
            type: "POST",
            url: "../deleteproductimage",
            data: {
                'product_image_id': id,
                'product_id': product_id
            },
            dataType: 'json',
            beforeSend: function () {
                $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#images").css("position", "relative"));
            },
            success: function (data) {
                $('#image-available').empty();
                for (var i = 0; i < data.length; i++) {
                    $(data[i]).appendTo($("#image-available"));
                }
                $("#overlay").remove();
            }
        });
    }
}

function updatePreviewMeta() {

    var description = "";
    var brand = "";
    var description_input = document.getElementById("productdetail-meta_description").value;

    if (description_input.length > 155) {
        description = description_input.substring(0, 152) + '...';
    }
    else {
        description = description_input;
    }


    var elt = document.getElementById("product-brands_brand_id");
    if (elt.selectedIndex == -1) {
        brand = "";
    }
    else {
        brand = elt.options[elt.selectedIndex].text;
    }

    document.getElementById("preview-page-title").innerHTML = 'The Watch Co. - ' + brand + ' - ' + document.getElementById("productdetail-meta_title").value;
    document.getElementById("preview-page-url").innerHTML = 'https://www.thewatch.coproduct/' + document.getElementById("productdetail-link_rewrite").value;
    document.getElementById("preview-page-description").innerHTML = description;
}

function updateCustomerPrivatenote(id) {
    var privatenote = document.getElementById("customer-private-note").value;

    $.ajax({
        type: "POST",
        url: "../updateprivatenote/" + id,
        data: {
            'customer_id': id,
            'privatenote': privatenote
        },
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#private-note").css("position", "relative"));
        },
        success: function (data) {
            $("#overlay").remove();
        }
    });
}

function deletecustomeraddress(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "../delete/" + id,
            beforeSend: function () {
                $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#customer-address").css("position", "relative"));
            },
            success: function (data) {
                $('#table-customer-address').empty();
                $(data).appendTo($("#table-customer-address"));
                $("#overlay").remove();
            }
        });
    }
}

function deletecustomer(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete/" + id,
            success: function (data) {
            }
        });
    }
}

function checkcarrierpackage() {
    var id = document.getElementById("carrier").value;

    if (id != 0) {
        $.ajax({
            type: "POST",
            url: "checkpackage/" + id,
            success: function (data) {
                $('#carrier-package').empty();
                $(data).appendTo($("#carrier-package"));
            }
        });
    }
}

function checkprovincecarrier() {
    var id = document.getElementById("country").value;

    if (id != 0) {
        $.ajax({
            type: "POST",
            url: "checkprovince/" + id,
            success: function (data) {
                $('#province').empty();
                $('#state').empty();
                $('#district').empty();
                $(data).appendTo($("#province"));
                $('<option value="0"> Please select</option>').appendTo($("#state"));
                $('<option value="0"> Please select</option>').appendTo($("#district"));
            }
        });
    }
}

function checkprovincecreate() {
    var id = document.getElementById("country").value;

    if (id != 0) {
        $.ajax({
            type: "POST",
            url: "province/" + id,
            success: function (data) {
                $('#province').empty();
                $(data).appendTo($("#province"));
            }
        });
    }
}

function checkstatecreate() {
    var id = document.getElementById("province").value;

    if (id != 0) {
        $.ajax({
            type: "POST",
            url: "checkstate/" + id,
            success: function (data) {
                $('#state').empty();
                $('#district').empty();
                $(data).appendTo($("#state"));
                $('<option value="0"> Please select</option>').appendTo($("#district"));
            }
        });
    }
}

function checkdistrictcreate() {
    var id = document.getElementById("state").value;

    if (id != 0) {
        $.ajax({
            type: "POST",
            url: "checkdistrict/" + id,
            success: function (data) {
                $('#district').empty();
                $(data).appendTo($("#district"));
            }
        });
    }
}

function checkprovince() {
    var id = document.getElementById("country").value;

    $.ajax({
        type: "POST",
        url: "../checkprovince/" + id,
        success: function (data) {
            $('#province').empty();
            $('#state').empty();
            $('#district').empty();
            $(data).appendTo($("#province"));
            $('<option value="0"> Please select</option>').appendTo($("#state"));
            $('<option value="0"> Please select</option>').appendTo($("#district"));
        }
    });
}

function checkstate() {
    var id = document.getElementById("province").value;

    $.ajax({
        type: "POST",
        url: "../checkstate/" + id,
        success: function (data) {
            $('#state').empty();
            $('#district').empty();
            $(data).appendTo($("#state"));
            $('<option value="0"> Please select</option>').appendTo($("#district"));
        }
    });
}

function checkstatecreate() {
    var id = document.getElementById("province").value;

    $.ajax({
        type: "POST",
        url: "checkstate/" + id,
        success: function (data) {
            $('#state').empty();
            $('#district').empty();
            $(data).appendTo($("#state"));
            $('<option value="0"> Please select</option>').appendTo($("#district"));
        }
    });
}

function checkdistrict() {
    var id = document.getElementById("state").value;

    $.ajax({
        type: "POST",
        url: "../checkdistrict/" + id,
        success: function (data) {
            $('#district').empty();
            $(data).appendTo($("#district"));
        }
    });
}

function checkcollection() {
    var id = document.getElementById("product-brands_brand_id").value;

    if (id >= 0) {
        $.ajax({
            type: "POST",
            url: baseUrl + "/products/checkcollection/" + id,
            success: function (data) {
                $('#product-brands_collection_id').empty();
                $(data).appendTo($("#product-brands_collection_id"));
            }
        });
    }
    else {
        $('#product-brands_brand_collection_id').empty();
        $('<option value="">Please select</option>').appendTo($("#product-brands_brand_collection_id"));
    }
}

function searchcustomer() {
    var id = document.getElementById("customer-email").value;

    $.ajax({
        type: "POST",
        url: "searchcustomer",
        data: {
            'email': id,
        },
        dataType: 'json',
        success: function (data) {
            if (data[0] == 0) {
                $('#firstname').prop("disabled", true);
                $('#lastname').prop("disabled", true);
                $('#company').prop("disabled", true);
                $('#country').prop("disabled", true);
                $('#province').prop("disabled", true);
                $('#state').prop("disabled", true);
                $('#district').prop("disabled", true);
                $('#address').prop("disabled", true);
                $('#address2').prop("disabled", true);
                $('#postcode').prop("disabled", true);
                $('#phone').prop("disabled", true);
                $('#phone-mobile').prop("disabled", true);
                $('#other').prop("disabled", true);
                document.getElementById('customer-id').value = "";
                document.getElementById('firstname').value = "";
                document.getElementById('lastname').value = "";
                $('#status').empty();
                $('<div class="text-red"><i class="fa fa-close"></i> Invalid</div>').appendTo($("#status"));
            }
            else {
                $('#firstname').prop("disabled", false);
                $('#lastname').prop("disabled", false);
                $('#company').prop("disabled", false);
                $('#country').prop("disabled", false);
                $('#province').prop("disabled", false);
                $('#state').prop("disabled", false);
                $('#district').prop("disabled", false);
                $('#address').prop("disabled", false);
                $('#address2').prop("disabled", false);
                $('#postcode').prop("disabled", false);
                $('#phone').prop("disabled", false);
                $('#phone-mobile').prop("disabled", false);
                $('#other').prop("disabled", false);
                document.getElementById('customer-id').value = data[1];
                document.getElementById('firstname').value = data[2];
                document.getElementById('lastname').value = data[3];
                $('#status').empty();
                $('<div class="text-green"><i class="fa fa-check"></i> Valid</div>').appendTo($("#status"));
            }
        }
    });
}
 
function updatekategoriBrandbannerdetail(id, brand_id) {
    
        $.ajax({
            type: "POST",
            url: "../updatekategoribrandbannerdetail",
            data: {
                'bannerdetailid': id,
                'brandsbrandid': brand_id,
            },
            success: function (data) {
                //$('#brand-banner-detail').empty();
                //$(data).appendTo($("#brand-banner-detail"));
                alert("Sukses mengganti kategori banner");
            }
        });
}

function deleteBrandbannerdetail(id, brand_id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "../deletebrandbannerdetail",
            data: {
                'bannerdetailid': id,
                'brandsbrandid': brand_id,
            },
            success: function (data) {
                $('#brand-banner-detail').empty();
                //$(data).appendTo($("#brand-banner-detail"));
                location.reload(true);
            }
        });
    }
}


function uploadimagebanner(brand_id) {
    var j = "";
    var myFormData = new FormData();
    myFormData.append('brands_brand_id', brand_id);
    myFormData.append('total_image', userImage.files.length);

    for (var i = 0; i <= userImage.files.length; i++) {
        j = 'image_upload' + i;
        myFormData.append(j, userImage.files[i]);
    }

    $.ajax({
        url: '../upload',
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#box-banner").css("position", "relative"));
        },
        success: function (data) {
            $("#overlay").remove();
            $('#brand-banner-detail').empty();
            $(data).appendTo($("#brand-banner-detail"));
            location.reload(true);
        }
    });
}

function uploadimagebannerfeatured(brand_id) {
    var j = "";
    var myFormData = new FormData();
    myFormData.append('brands_brand_id', brand_id);
    myFormData.append('total_image', userImage2.files.length);

    for (var i = 0; i <= userImage2.files.length; i++) {
        j = 'image_upload' + i;
        myFormData.append(j, userImage2.files[i]);
    }

    $.ajax({
        url: '../uploadfeatured',
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#box-banner").css("position", "relative"));
        },
        success: function (data) {
            $("#overlay").remove();
            $('#brand-banner-detail-fetured').empty();
            $(data).appendTo($("#brand-banner-detail-featured"));
            location.reload(true);
        }
    });
}

function uploadimagebannerfeaturedmobile(brand_id) {
    var j = "";
    var myFormData = new FormData();
    myFormData.append('brands_brand_id', brand_id);
    myFormData.append('total_image', userImage3.files.length);

    for (var i = 0; i <= userImage3.files.length; i++) {
        j = 'image_upload' + i;
        myFormData.append(j, userImage3.files[i]);
    }

    $.ajax({
        url: '../uploadfeaturedmobile',
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#box-banner").css("position", "relative"));
        },
        success: function (data) {
            $("#overlay").remove();
            $('#brand-banner-detail-fetured').empty();
            $(data).appendTo($("#brand-banner-detail-featured-mobile"));
            location.reload(true);
        }
    });
}

function deleteBrand(brand_id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'brandsbrandid': brand_id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}


function deletebrandcollection(brand_collection_id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'brand_collection_id': brand_collection_id,
            },
            success: function (data) {
                if (data == 0) {
                    alert('Cannot delete because this collection has 1 or more product');
                }
                else {
                    location.reload();
                }
            }
        });
    }
}

function deletetags(tag_id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'tag_id': tag_id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}

function deletecartrule(cartrule_id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'cartrule_id': cartrule_id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}


function deleteshippingcost(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'id': id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}

function updateorderquantity(id, quantity) {
    document.getElementById('update-order-id').value = id;
    document.getElementById('update-quantity').value = quantity;
    $('#edit-product-order').show();
}

function updatequantity() {
    $.ajax({
        type: "POST",
        url: "../updatequantity",
        data: {
            'id': document.getElementById('update-order-id').value,
            'quantity': document.getElementById('update-quantity').value
        },
        success: function (data) {
            location.reload();
        }
    });
}

function update_tracking_number(id) {
    if (document.getElementById('tracking-number').value != "") {
        $.ajax({
            type: "POST",
            url: "../updatetrackingnumber",
            data: {
                'id': id,
                'tracking_number': document.getElementById('tracking-number').value,
				'shipping_carrier': $('select#shipping-carrier option:selected').val(),
				'carrier_delivery_notes': document.getElementById('carrier_delivery_notes').value
            },
            success: function (data) {
                // console.log(data);
                location.reload();
            }
        });
    }
}

function add_product() {
    $('#add-product-order').show();
}

function close_quantity() {
    $('#edit-product-order').hide();
    $('#add-product-order').hide();
}

function checkcategory() {
    if (document.getElementById('check-category').value != 0) {
        $.ajax({
            type: "POST",
            url: "../checkcategory",
            data: {
                'id': document.getElementById('check-category').value
            },
            success: function (data) {
                $('#check-brands').empty();
                $('#check-product').empty();
                $('#check-attributes').empty();
                $(data).appendTo($("#check-brands"));
                $("<option value='0'>Please select</option>").appendTo($("#check-product"));
                $("<option value='0'>Please select</option>").appendTo($("#check-attributes"));
            }
        });
    }
    else {
        $('#check-brands').empty();
        $("<option value='0'>Please select</option>").appendTo($("#check-brands"));
        $('#check-product').empty();
        $("<option value='0'>Please select</option>").appendTo($("#check-product"));
    }
}

function checkbrands() {
    if (document.getElementById('check-brands').value != 0 && document.getElementById('check-category').value != 0) {
        $.ajax({
            type: "POST",
            url: "../checkbrands",
            data: {
                'brand_id': document.getElementById('check-brands').value,
                'category_id': document.getElementById('check-category').value,
            },
            success: function (data) {
                $('#check-product').empty();
                $('#check-attributes').empty();
                $(data).appendTo($("#check-product"));
                $("<option value='0'>Please select</option>").appendTo($("#check-attributes"));
            }
        });
    }
    else {
        $('#check-product').empty();
        $("<option value='0'>Please select</option>").appendTo($("#check-product"));
    }
}

function checkproduct() {
    if (document.getElementById('check-product').value != 0) {
        $.ajax({
            type: "POST",
            url: "../checkproduct",
            data: {
                'product_id': document.getElementById('check-product').value,
            },
            success: function (data) {
                $('#check-attributes').empty();
                $(data).appendTo($("#check-attributes"));
            }
        });
    }
    else {
        $('#check-attributes').empty();
        $("<option value='0'>Please select</option>").appendTo($("#check-attributes"));
    }
}

function add_product_order() {
    if (document.getElementById('check-product').value != 0) {
        $.ajax({
            type: "POST",
            url: "../addproduct",
            data: {
                'product_id': document.getElementById('check-product').value,
                'product_attribute_id': document.getElementById('check-attributes').value,
                'product_quantity': document.getElementById('quantity-add-order').value,
                'orders_id': document.getElementById('orders-id').value,
            },
            success: function (data) {
                if (data == 0) {
                    alert('product was ordered!');
                }
                else {
                    location.reload();
                }
            }
        });
    }
}

function deleteproductorder(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "../deleteproductorder",
            data: {
                'id': id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}

function updatecontent(id) {
    var title = document.getElementById('journal-detail-title').value;
    var link_seo = document.getElementById('journal-detail-link').value;
    var category = 1;
    var writer = document.getElementById('journal-author').value;
    var status = document.getElementById('journal-status').value;
	var short_description = CKEDITOR.instances['short-description'].getData();
    var description = CKEDITOR.instances['productdetail-spesification'].getData();
    var content = CKEDITOR.instances['productdetail-description'].getData();
	var journalVideoSource = document.getElementById('journal-video-source').value;
	var journalVideoType = $('#journal-video-type option:selected').val();

    $.ajax({
        type: "POST",
        url: "../updatecontent",
        data: {
            'id': id,
            'title': title,
            'link_seo': link_seo,
            'category': category,
            'writer': writer,
            'status': status,
			'short_description' : short_description,
            'description': description,
            'content': content,
			'journalVideoSource' : journalVideoSource,
			'journalVideoType' : journalVideoType
        },
        success: function (data) {
            location.reload();
        }
    });
}

function update_image_small_banner_journal(id) {
    var myFormData = new FormData();
    myFormData.append('journal_id', id);
    myFormData.append('image', smallcover.files[0]);

    $.ajax({
        url: '../uploadsmallcover',
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        dataType: 'json',
        data: myFormData,
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#small-cover-box").css("position", "relative"));
        },
        success: function (data) {
//            $("#overlay").hide();
//            $("#small-cover-image").empty();
//            $(data).appendTo($("#small-cover-image"));
            location.reload();
        }
    });
}

function update_image_big_cover_journal(id) {
    var myFormData = new FormData();
    myFormData.append('journal_id', id);
    myFormData.append('image', bigcover.files[0]);

    $.ajax({
        url: '../uploadbigcover',
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        dataType: 'json',
        data: myFormData,
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#big-cover-box").css("position", "relative"));
        },
        success: function (data) {
            location.reload();
        }
    });
}

function update_image_home_cover_journal(id) {
    var myFormData = new FormData();
    myFormData.append('journal_id', id);
    myFormData.append('image', homecover.files[0]);

    $.ajax({
        url: '../uploadhomecover',
        type: 'POST',
        processData: false, // important
        contentType: false, // important
        dataType: 'json',
        data: myFormData,
        beforeSend: function () {
            $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#home-cover-box").css("position", "relative"));
        },
        success: function (data) {
            location.reload();
        }
    });
}

function delete_image_journal(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "../deleteimage",
            data: {
                'id': id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}

function delete_image_journal_slider(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "../deleteimageslider",
            data: {
                'id': id,
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}

function update_journal_image(id, orientation) {
    var j = "";
    var link = "";
    var myFormData = new FormData();
    myFormData.append('journal_id', id);

    if (orientation == "L") {
        link = '../uploadlandscapeimage';
        myFormData.append('total_image', landscapeimage.files.length);

        for (var i = 0; i <= landscapeimage.files.length; i++) {
            j = 'image_upload' + i;
            myFormData.append(j, landscapeimage.files[i]);
        }
        $.ajax({
            url: link,
            type: 'POST',
            processData: false, // important
            contentType: false, // important
            dataType: 'json',
            data: myFormData,
            beforeSend: function () {
                $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#landscape-box").css("position", "relative"));
            },
            success: function (data) {
                location.reload();
            }
        });
    }
    else {
        link = '../uploadportraitimage';
        myFormData.append('total_image', portraitimage.files.length);

        for (var i = 0; i <= portraitimage.files.length; i++) {
            j = 'image_upload' + i;
            myFormData.append(j, portraitimage.files[i]);
        }

        $.ajax({
            url: link,
            type: 'POST',
            processData: false, // important
            contentType: false, // important
            dataType: 'json',
            data: myFormData,
            beforeSend: function () {
                $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#portrait-box").css("position", "relative"));
            },
            success: function (data) {
                location.reload();
            }
        });
    }

}

function update_journal_image_slider(id) {
    var j = "";
    var link = "";
    var myFormData = new FormData();
    myFormData.append('journal_id', id);

  
        link = '../uploadslider';
        myFormData.append('total_image', imageslider.files.length);

        for (var i = 0; i <= imageslider.files.length; i++) {
            j = 'image_upload' + i;
            myFormData.append(j, imageslider.files[i]);
        }
        $.ajax({
            url: link,
            type: 'POST',
            processData: false, // important
            contentType: false, // important
            dataType: 'json',
            data: myFormData,
            beforeSend: function () {
                $("<div id='overlay'><img id='loading' src='/backend/web/img/spin.svg'></div>").appendTo($("#slider-box").css("position", "relative"));
            },
            success: function (data) {
                location.reload();
            }
        });
   

}

function delete_journal(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'id': id,
            },
            success: function (data) {
                console.log(data);
            }
        });
    }
}

function delete_journal_author(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'id': id,
            },
            success: function (data) {
                console.log(data);
            }
        });
    }
}

function update_status_order(id, apps_language_id, orderstate) {

    $.ajax({
        type: "POST",
        url: "https://www.thewatch.co/adminstorestaff/orders/receiptakulaku",
        data: {
            'id': id,
            'order_state_lang_id': document.getElementById('order-status').value,
            'apps_language_id': apps_language_id,
            'orderstate': orderstate
        },
        success: function (data) {
            
            location.reload();
            console.log(data);
        }
    });

}

function add_detail_category(detail_id) {
    $.ajax({
        type: "POST",
        url: "../updatedetailcategory",
        data: {
            'id': detail_id,
            'detail_category_id': document.getElementById('detail-category').value
        },
        success: function (data) {
            $("#detail-category-list").empty();
            $(data).appendTo($("#detail-category-list"));
        }
    });
}

function delete_journal_category(detail_category_id) {
    $.ajax({
        type: "POST",
        url: "../deletedetailcategory",
        data: {
            'id': detail_category_id
        },
        success: function (data) {
            $("#detail-category-list").empty();
            $(data).appendTo($("#detail-category-list"));
        }
    });
}

function category_duplicate() {
    var table = document.getElementById("multiple-category");
    var row = table.insertRow(table.rows.length);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    var value = document.getElementById('category-list').outerHTML;

    cell1.innerHTML = '<div style="padding-bottom: 20px">' + value + '</div>';
    cell2.innerHTML = '<div style="padding-bottom: 20px"><button class="btn btn-default form-control"><i class="fa fa-close"></i> Delete</button></div>';
}

function deletejournalcategory(id) {
    var confirmation = confirm("are you sure want to delete this?");

    if (confirmation == true) {
        $.ajax({
            type: "POST",
            url: "delete",
            data: {
                'id': id,
            },
            success: function (data) {
                console.log(data);
            }
        });
    }
}

function fetchallinstagram() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "fetchallinstagram",
        success: function (data) {
            console.log(data);
        }
    });
}

function fetchallinstagramcomment() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "fetchallinstagramcomment",
        success: function (data) {
            console.log(data);
        }
    });
}

function fetchallinstagramlike() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "fetchallinstagramlike",
        success: function (data) {
            console.log(data);
        }
    });
}

function fetchallinstagrambycount() {
    var count = document.getElementById("count-post").value;
    if (count > 1) {
        $.ajax({
            type: "post",
            dataType: "json",
            data: {
                'count': count,
            },
            url: "fetchinstagrambycount",
            success: function (data) {
                console.log(data);
            }
        });
    }
}


function randString(x) {
    var s = "";
    while (s.length < x && x > 0) {
        var r = Math.random();
        s += (r < 0.1 ? Math.floor(r * 100) : String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
    }
    return s;
}

function generateVouchercode() {
    document.getElementById("voucher-code").value = randString(8).toUpperCase();
}
//
function openvalue(action) {
    //$("#disc-type").empty();
    if (action == 'percent') {
        $("#disc-input").fadeIn();
        $("#disc-type").html('%');
    }
    else if (action == 'amount') {
        $("#disc-input").fadeIn();
        $("#disc-type").html('Rp.');
    }
	else if (action == 'flat'){
		$("#disc-input").fadeIn();
        $("#disc-type").html('Rp.');
	}
	else if (action == 'customvalue'){
        $("#customlabel-disc").fadeIn();
    }
	else if (action == 'sameasreduction'){
        $("#customlabel-disc").fadeOut();
    }
    else if (action == 'flashicon'){
        $("#customlabel-disc").fadeOut();
    }
	else if (action == 'bulk'){
		$("#table-bulk-selection").fadeIn();
		$('#voucherName').prop('required',false);
		$('#voucher-code').prop('required',false);
	}
	else if (action == 'regular'){
		$("#table-bulk-selection").fadeOut();
		$('#voucherName').prop('required',true);
		$('#voucher-code').prop('required',true);
	}
    else {
        $("#disc-input").fadeOut();
    }
}

function checkproductselection() {
    if (document.getElementById('product-selection').checked) {
        $("#table-product-selection").fadeIn();
    }
    else {
        $("#table-product-selection").fadeOut();
    }
}

function checkcategoryselection() {
    if (document.getElementById('category-selection').checked) {
        $("#table-category-selection").fadeIn();
    }
    else {
        $("#table-category-selection").fadeOut();
    }
}

function checkbrandselection() {
    if (document.getElementById('brand-selection').checked) {
        $("#table-brand-selection").fadeIn();
    }
    else {
        $("#table-brand-selection").fadeOut();
    }
}

function addproductmatch() {
    var rule_selected = document.getElementById('rule-selected').value;
    var check_rule = document.getElementById(rule_selected);
    if (check_rule == null) {
        var row = '<tr id=' + rule_selected + '><td width="15%"><div style="padding-top: 10px">[' + rule_selected + ']</div></td><td width="40%"><div style="padding-left: 20px; padding-right: 20px; padding-top: 10px"><input id="input-' + rule_selected + '" type="text" class="form-control" value="0" disabled></div></td><td><div style="padding-top: 10px;"><a class="btn btn-default" data-toggle="modal" data-target="#modal-' + rule_selected + '"><i class="fa fa-list-ul"></i> Choose</a></div></td><td width="1%"><div style="padding-top: 10px;"><a class="btn btn-default" onclick="deleterowproductselection(&#39;' + rule_selected + '&#39;)"><i class="fa fa-close"></i></a></div></td></tr>';
        $('#table-product-rule-selection > tbody:last-child').append(row);
    }
}

function deleterowproductselection(row_id) {
    if (document.getElementById(row_id) != null) {
        $('#' + row_id).remove();
    }
}

function countproductselected(id) {
    document.getElementById('input-' + id).value = $(".ms-selected").length / 2;
}

$('#data-grid').DataTable();

$('#data-customers').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "getallcustomers"
});

$('#data-shippingcost').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "getallshippingcost"
});

var dataProduct = $('#data-products').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "getallproducts",
    "columns": [
        { "data" : "No", "name" : "no", "searchable" : false },
        { "data" : "Image", "name" : "Image", "searchable" : false },
        { "data" : "sku_number", "name" : "sku_number" },
        { "data" : "product_name", "name" : "product_name" },
        { "data" : "brand_name", "name" : "brand_name" },
        { "data" : "brand_id", "name" : "brand_id" },
        { "data" : "collection_name", "name" : "collection_name" },
        { "data" : "brands_collection_id", "name" : "brands_collection_id" },
        { "data" : "category_name", "name" : "category_name" },
        { "data" : "product_category_id", "name" : "product_category_id" },
        { "data" : "product_price", "name" : "product_price" },
        { "data" : "filter_discount", "name" : "filter_discount" },
        { "data" : "from_date_discount", "name" : "from_date_discount" },
        { "data" : "to_date_discount", "name" : "to_date_discount" },
        { "data" : "filter_price_from", "name" : "filter_price_from" },
        { "data" : "filter_price_to", "name" : "filter_price_to" },
        { "data" : "total_stock", "name" : "total_stock" },
        { "data" : "active", "name" : "active" },
        { "data" : "action", "name" : "action", "searchable" : false }
    ],
    "columnDefs": [
        {
            "targets": [ 5, 7, 9, 11, 12, 13, 14, 15 ],
            "visible": false
        }
    ]
});

var dataOrder = $('#data-order').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "getallorders",
    "columns": [
        { "data" : "No", "name" : "no", "searchable" : false },
        { "data" : "reference", "name" : "reference" },
        { "data" : "customer", "name" : "customer" },
        { "data" : "total_paid", "name" : "total_paid" },
        { "data" : "payment", "name" : "payment" },
        { "data" : "inventory_status", "name" : "inventory_status" },
        { "data" : "status", "name" : "status" },
        { "data" : "date", "name" : "date" },
        { "data" : "action", "name" : "action", "searchable" : false },
        { "data" : "from", "name" : "from" },
        { "data" : "to", "name" : "to" },
    ],
    "columnDefs": [
        {
            "targets": [ 9, 10],
            "visible": false
        }
    ]
});



$('#filterBtnProduct').on('click', function (e) {
    e.preventDefault();
    
    var productCategoryId = $('select#product_category_id option:selected').val(),
        brandId = $('select#product-brands_brand_id option:selected').val(),
        brandsCollectionId = $('select#product-brands_brand_collection_id option:selected').val(),
        fromDateDiscount = $('input[name=FromDateDiscount]').val(),
        toDateDiscount = $('input[name=ToDateDiscount]').val(),
        filterPriceFrom = $('#FilterPriceFrom').val(),
        filterPriceTo = $('#FilterPriceTo').val(),
		exportTo = $('select#export_to option:selected').val();
    
   // console.log(productCategoryId);return;
//   var obj = {
//       "type":"excel",
//       "product_category_id": productCategoryId,
//   }
	if(exportTo != 0){
		window.location.replace('https://www.thewatch.co/adminstorestaff/products/generatereport?type=excel+'+ productCategoryId +'+'+ brandId);
	}
    
    dataProduct.search('').columns().search('');
    
    if(productCategoryId != 0){
        dataProduct.column([8]).search(productCategoryId);
    }
    
    if(brandId != 0){
        dataProduct.column([4]).search(brandId);
    }
    
    if(brandsCollectionId != 0){
        dataProduct.column([6]).search(brandsCollectionId);
    }
    
    if(fromDateDiscount != ''){
        dataProduct.column([11]).search(fromDateDiscount);
    }
    
    if(toDateDiscount != ''){
        dataProduct.column([12]).search(toDateDiscount);
    }
    
    if(filterPriceFrom != 0){
        dataProduct.column([13]).search(filterPriceFrom);
    }
    
    if(filterPriceTo != 0){
        dataProduct.column([14]).search(filterPriceTo);
    }
    
    // discount type percent
    if ($('input:radio#discountTypePercent').is(':checked')) {
        var discountTypePercent = $('input:radio#discountTypePercent').val(),
            discountTypePercentValue = $('#DiscountValue').val();
            
        dataProduct.column([10]).search(discountTypePercent + '=' + discountTypePercentValue);
    }
    
    // discount type amount
    if ($('input:radio#discountTypeAmount').is(':checked')) {
        var discountTypeAmount = $('input:radio#discountTypeAmount').val(),
            discountTypeAmountValue = $('#DiscountValue').val();
            
        dataProduct.column([10]).search(discountTypeAmount + '=' + discountTypeAmountValue);
    }
    
    // discount type all
    if ($('input:radio#discountTypeAll').is(':checked')) {
        var discountTypeAll = $('input:radio#discountTypeAll').val();
        dataProduct.column([10]).search(discountTypeAll);
    }
    
    dataProduct.draw();
});

$('#filterBtnOrderss').on('click', function (e) {
    e.preventDefault();
    
    var status = $('select#status option:selected').val(),
        payment = $('select#payment option:selected').val(),
    
        from = $('input[name=from]').val(),
        to = $('input[name=to]').val();

        
    dataOrder.search('').columns().search('');
    
    if(payment != 0){
        dataOrder.column([4]).search(payment);
    }
    
    if(status != 0){
        dataOrder.column([6]).search(status);
    }
    
    if(from != 0){
        dataOrder.column([9]).search(from);
    }
    
    if(to != ''){
        dataOrder.column([10]).search(to);
    }
          
    dataOrder.draw();

    // window.location.replace("http://stackoverflow.com");
});

$('#orderExportTo').on('click', function (e) {
    e.preventDefault();
    if($('select#export_to option:selected').val() == 'Excel'){
        $.ajax({
            type: 'POST',
            url: 'exportto',
            data: {
                'startdate': $('input[name=from]').val(),
                'enddate': $('input[name=to]').val(),
                'filetype': $('select#export_to option:selected').val()
            },
            dataType: 'json',
            beforeSend: function (xhr) {
                $('.overlay').delay(1000).fadeIn();
            },
            success: function (data) {
                location.reload();
            }
        });
    }
    

    // window.location.replace("http://stackoverflow.com");
});

$('#data-instagram').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "getalldata",
    "order": [[6, "desc"]]
});

$('#data-instagram-selection').DataTable({
//    "order": [[1, "ASC"]],
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets:   0
    }],
    select: {
        style:    'os',
        selector: 'td:first-child'
    },
});

$('#data-list-email').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "getemaillist",
    "order": [[1, "desc"]]
});