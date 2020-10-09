/* VARIABLE DECLARE*/



/*FOR MOBILE */

function buildUICategoryWishlistMobile(){
  $( ".btn_wishlist_mobile" ).each(function( index ) {
    var rangeLeft = (index)*170;
    $( this ).css({ "left": rangeLeft+"px"});
  });
}

function generateKeyWishlistMobile(){
  var keyWishlist = 0;
  $( ".wishlist-area-wrap-mobile" ).each(function( index ) {
    keyWishlist = index;
  });
  return keyWishlist+1;
}

function refreshingUIMobile(){
  $(".bagianCheckbox").hide();
  $(".checkboxSelectWishlistMobile").hide();
  $(".controllmodeSelectMobile").hide();
  $(".btnCloseModeSelectMobile").hide();
}

$( document ).ready(function() {
  refreshingUIMobile();
});

$(document).on('click', '.btnOpenModeSelectMobile', function(){
  
  var idWishlist = $(this).data('id');
  $(".bagianCheckbox[data-id='"+idWishlist+"']").show();
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-xs-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-sm-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-md-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-lg-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-xs-10");
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-sm-10");
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-md-10");
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-lg-10");
  $(".controllmodeSelectMobile[data-id='"+idWishlist+"']").show();
  $(".btnCloseModeSelectMobile[data-id='"+idWishlist+"']").show();
  $(".btnHapusWishlistMobile[data-id='"+idWishlist+"']").hide();
  $(".btnPindahWishlistMobile[data-id='"+idWishlist+"']").hide();
  $(".btnBeliWishlistMobile[data-id='"+idWishlist+"']").hide();
  $(".checkboxSelectWishlistMobile[data-id='mobile"+idWishlist+"']").show();
  
});

$(document).on('click', '.btnCloseModeSelectMobile', function(){
  
  var idWishlist = $(this).data('id');
  $(".bagianCheckbox[data-id='"+idWishlist+"']").hide();
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-xs-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-sm-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-md-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").addClass("col-lg-12");
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-xs-10");
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-sm-10");
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-md-10");
  $(".bagianProduct[data-id='"+idWishlist+"']").removeClass("col-lg-10"); 
  $(".controllmodeSelectMobile[data-id='"+idWishlist+"']").hide();
  $(".btnCloseModeSelectMobile[data-id='"+idWishlist+"']").hide();
  $(".btnHapusWishlistMobile[data-id='"+idWishlist+"']").show();
  $(".btnPindahWishlistMobile[data-id='"+idWishlist+"']").show();
  $(".btnBeliWishlistMobile[data-id='"+idWishlist+"']").show();
  $(".checkboxSelectWishlistMobile[data-id='mobile"+idWishlist+"']").hide();
  
});

$(document).on('click', '.btnUncheckAllMobile', function(){
  var idWishlist = $(this).data('id');
  $('input[type="checkbox"][data-id="mobile'+idWishlist+'"]').prop('checked',false);
});

$(document).on('click', '.btnCheckAllMobile', function(){
  var idWishlist = $(this).data('id');
  $('input[type="checkbox"][data-id="mobile'+idWishlist+'"]').prop('checked',true);
});




/*FOR DESKTOP */

function buildUICategoryWishlistDesktop(){
  
  $( ".btn_wishlist_desktop" ).each(function( index ) {
    var rangeLeft = (index)*170;
    $( this ).css({ "left": rangeLeft+"px"});
  });
}

function generateKeyWishlistDesktop(){
  var keyWishlist = 0;
  $( ".wishlist-area-wrap-desktop" ).each(function( index ) {
    keyWishlist = index;
  });
  return keyWishlist+1;
}

function refreshingUIDesktop(){
  $(".checkboxSelectWishlist").hide();
  $(".controllmodeSelect").hide();
  $(".btnCloseModeSelect").hide();
}

$( document ).ready(function() {
  refreshingUIDesktop();
});

$(document).on('click', '.btnOpenModeSelect', function(){
  var idWishlist = $(this).data('id');
  $(".controllmodeSelect[data-id='"+idWishlist+"']").show();
  $(".btnCloseModeSelect[data-id='"+idWishlist+"']").show();
  $(".btnHapusWishlist[data-id='"+idWishlist+"']").hide();
  $(".btnPindahWishlist[data-id='"+idWishlist+"']").hide();
  $(".btnBeliWishlist[data-id='"+idWishlist+"']").hide();
  $(".btnOpenModeSelect[data-id='"+idWishlist+"']").html("Edit <span class='fa fa-angle-up'></span>");
  $(".checkboxSelectWishlist[data-id='"+idWishlist+"']").show();
  
});

$(document).on('click', '.btnCloseModeSelect', function(){

  var idWishlist = $(this).data('id');
  $(".controllmodeSelect[data-id='"+idWishlist+"']").hide();
  $(".btnCloseModeSelect[data-id='"+idWishlist+"']").hide();
  $(".btnHapusWishlist[data-id='"+idWishlist+"']").show();
  $(".btnPindahWishlist[data-id='"+idWishlist+"']").show();
  $(".btnBeliWishlist[data-id='"+idWishlist+"']").show();
  $(".checkboxSelectWishlist[data-id='"+idWishlist+"']").hide();
  
});

$(document).on('click', '.btnUncheckAll', function(){
  var idWishlist = $(this).data('id');
  $('input[type="checkbox"][data-id="'+idWishlist+'"]').prop('checked',false);
});

$(document).on('click', '.btnCheckAll', function(){
  var idWishlist = $(this).data('id');
  $('input[type="checkbox"][data-id="'+idWishlist+'"]').prop('checked',true);
});


/*FOR HYBRID */


/*CHECKING PRODUCT IN WISHLISTM WHEN COLOR & SIZE CHANGE*/
$('select.color').on('change', function (e) {
	
  e.preventDefault();
  
  if ($('select.color').length && !$('select.color').is(':disabled')) {
      $col_value = $('select.color')[0].value.split("+");
      // validate if user not choosing color 
      if ($col_value == "0") {
          $('div.cart-add-error.error').show();
          $('div.cart-add-error.error span').html('* Please Select Color');
        
          return;
      }
  }

  if ($('select.size').length && !$('select.size').is(':disabled')) {
      $col_value = $('select.size')[0].value.split("+");
      // validate if user not choosing color
      if ($col_value == "0") {
          $('div.cart-add-error.error').show();
          $('div.cart-add-error.error span').html('* Please Select Size');

          return;
      }
  }
  var product_attribute_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').attr("attrId") : $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').attr("attrId") : 0;
  var product_id = $('#addtowishlist').data('product-id');

  checkWishlist(product_id, product_attribute_id);

});

$('select.size').on('change', function (e) {
	
  e.preventDefault();
  
  if ($('select.color').length && !$('select.color').is(':disabled')) {
      $col_value = $('select.color')[0].value.split("+");
      // validate if user not choosing color 
      if ($col_value == "0") {
          $('div.cart-add-error.error').show();
          $('div.cart-add-error.error span').html('* Please Select Color');
        
          return;
      }
  }

  if ($('select.size').length && !$('select.size').is(':disabled')) {
      $col_value = $('select.size')[0].value.split("+");
      // validate if user not choosing color
      if ($col_value == "0") {
          $('div.cart-add-error.error').show();
          $('div.cart-add-error.error span').html('* Please Select Size');

          return;
      }
  }
  var product_attribute_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').attr("attrId") : $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').attr("attrId") : 0;
  var product_id = $('#addtowishlist').data('product-id');;

  checkWishlist(product_id, product_attribute_id)

});

$( document ).ready(function() {
  var product_attribute_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').attr("attrId") : $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').attr("attrId") : 0;
  var product_id = $('#addtowishlist').data('product-id');
  checkWishlist(product_id, product_attribute_id);
  $.each($(".addtowishlistCatalogue"), function(){            
    checkWishlistCatalogue($(this).data("product-id"), 0);
  });
  $('#delete-multiple-detail-wishlist').val("");
  $('#move-multiple-detail-wishlist').val("");
  $(".checkboxSelectWishlist").attr('checked',false);
  $(".checkboxSelectWishlistMobile").attr('checked',false);
});



  $( '.addtowishlist' ).click( function( e ) {
      e.preventDefault();     
  
      if ($('select.color').length && !$('select.color').is(':disabled')) {
          $col_value = $('select.color')[0].value.split("+");
          // validate if user not choosing color 
          if ($col_value == "0") {
              $('div.cart-add-error.error').show();
              $('div.cart-add-error.error span').html('* Please Select Color');
            
              return;
          }
      }
  
      if ($('select.size').length && !$('select.size').is(':disabled')) {
          $col_value = $('select.size')[0].value.split("+");
          // validate if user not choosing color
          if ($col_value == "0") {
              $('div.cart-add-error.error').show();
              $('div.cart-add-error.error span').html('* Please Select Size');
  
              return;
          }
      }

      var product_attribute_id = $('select.color').length && !$('select.color').is(':disabled') ? $('select.color option:selected').attr("attrId") : $('select.size').length && !$('select.size').is(':disabled') ? $('select.size option:selected').attr("attrId") : 0;
      var product_id = $(this).data('product-id');

      if ($(this).hasClass('disabled') || $(this).hasClass('initialed')) {  
        return;
      }else{
        addDetailWishlist(product_id, product_attribute_id)
        $(this).addClass('disabled');
        $(".icon-love-wishlist").attr("src","https://thewatch.imgix.net/wishlist/desktop/btn_add_to_wishlist_finish.png");
      }
});

$( '.addtowishlistCatalogue' ).click( function( e ) {
  e.preventDefault();     

  var product_id = $(this).data('product-id');

  if ($(this).hasClass('disabled') || $(this).hasClass('initialed')) {  
    return;
  }else{
    addDetailWishlist(product_id, 0)
    $(this).addClass('disabled');
    $(".circle[data-id='"+product_id+"']").removeClass("love");
    $(".circle[data-id='"+product_id+"']").addClass("loved"); 
  }
});


$( document ).ready(function() {
  
  buildUICategoryWishlistMobile();
  buildUICategoryWishlistDesktop();
});


$(".wishlist-category").niceScroll({
  cursorcolor:"#206167",
  cursorwidth:"16px"
});

function settingScrollAfterAddCategoryWishlist(nameWishlist, id){
  $('#lastCategoryWishlist').removeAttr('id');
  $(".wishlist-category").append('<a class="list_wishlist" href="'+baseUrl+'/user/wishlist/'+id+'"><div id="lastCategoryWishlist" class="btn_wishlist btn_wishlist_mobile" >'+nameWishlist+'</div></a>');
  buildUICategoryWishlistDesktop();
  buildUICategoryWishlistMobile();
  
  var lastRange = $('#lastCategoryWishlist')[0].style.left;
  var widthItem = $('#lastCategoryWishlist').width();
  lastRange =parseInt(lastRange, 10);
  widthItem =parseInt(widthItem, 10);
  var scroll = lastRange+widthItem;
  $('.wishlist-category').getNiceScroll(0).doScrollLeft(0);
  $('.wishlist-category').getNiceScroll(0).doScrollLeft(scroll);
}

function newElementAfterAddCategoryWishlistDesktop(id, nameWishlist){
  var newKeyWishlist = generateKeyWishlistDesktop();
  var newWishlistElement = ''
  +'<div class="wishlist-area-wrap-desktop">'
    +'<!--(header wishlist) NAMA WISHLIST DAN BUTTON EDIT-->'
    +'<div style="margin-bottom:10px;margin-top:30px;" >'
        +'<div class="row">'
            +'<div class="col-md-6">'
                +'<div style="font-weight:bold;font-size:14px;width:200px;margin-top:20px;" >'+nameWishlist+'</div>'
            +'</div>'
            +'<div class="col-md-6">'
                +'<button data-id="'+newKeyWishlist+'" class="btn round-btn-red pull-right" onclick="openModalDeleteCategory('+id+')"  style="font-weight:bold;font-size:14px;width:100px;margin-left:10px;">Hapus </button>'
                +'<button data-id="'+newKeyWishlist+'" class="btn round-btn-gold pull-right btnCloseModeSelect" style="font-weight:bold;font-size:14px;width:100px;margin-left:10px;display:none;">Cancel </button>'
                +'<button data-id="'+newKeyWishlist+'" class="btn round-btn-transparent pull-right dropdown-toggle btnOpenModeSelect" data-toggle="dropdown" style="font-weight:bold;font-size:14px;width:100px;">Edit <span class="fa fa-angle-down"/>'
                +'</button>'
                +'<ul class="dropdown-menu pull-right" style="margin-right:100px;">'
                    +'<li>'
                        +'<a class="btnCheckAll" data-id="'+newKeyWishlist+'" style="cursor:pointer;">Tandai Semua</a>'
                    +'</li>'
                    +'<li>'
                        +'<a class="btnUncheckAll" data-id="'+newKeyWishlist+'" style="cursor:pointer;">Hapus Tanda</a>'
                    +'</li>'
                +'</ul>'
            +'</div>'
        +'</div>'
    +'</div>'
    +'<div class="wishlist-area" style="margin-bottom:20px;">'
        +'<div class="wrap-wishlist">'
            +'<div class="row">'
                +'<div class="col-md-12">'
                    +'<p class="text-center" style="font-weight:bold;padding-top:20px;">Belum ada produk</p>'
                +'</div>'
            +'</div>'
        +'</div>'
    +'</div>'
    +'<!--BUTTTON HAPUS PINDAHKAN BELI DIBAWAH KETIKA MODE SELECT ON-->'
    +'<div class="controllmodeSelect" data-id="'+newKeyWishlist+'" style="margin-bottom:20px;display:none;">'
        +'<div class="row">'
            +'<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3" style="padding-left:10px;padding-right:10px;">'
                +'<a data-id="'+newKeyWishlist+'" onclick="deleteMassalDetailWishlist(this)" class="btn round-btn-red btncontrollmodeSelect">Hapus</a>'
            +'</div>'
            +'<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">'
                +'<a data-id="'+newKeyWishlist+'" onclick="openModalMassalMoveWishlist(this)" class="btn round-btn-gold btncontrollmodeSelect">Pindahkan</a>'
            +'</div>'
            +'<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">'
                +'<a data-id="'+newKeyWishlist+'" onclick="beliMassalDetailWishlist(this)" class="btn round-btn-blue btncontrollmodeSelect">Beli</a>'
            +'</div>'
        +'</div>'
    +'</div>'
  +'</div>';
  $(".wishlist-content-wrap-desktop").append(newWishlistElement);
  refreshingUIDesktop();
}

function newElementAfterAddCategoryWishlistMobile(id, nameWishlist){
  var newKeyWishlist = generateKeyWishlistMobile();

  var newWishlistElement = ''
                      +'<div class="wishlist-area-wrap-mobile">'
                        +'<div style="margin-bottom:10px;margin-top:30px;" >'
                            +'<div class="row">'
                                +'<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">'
                                    +'<div style="font-weight:bold;font-size:14px;width:200px;margin-top:20px;" >'+nameWishlist+'</div>'
                                +'</div>'
                                +'<div class="col-xs-6 col-md-6 col-lg-6" style="margin-top:20px;">'

                                    +'<a class="pull-right dropdown-toggle" style="margin-left:20px;" data-id="'+newKeyWishlist+'" onclick="openModalDeleteCategory('+id+')" >'
                                        +'<img width="18px" src="https://thewatch.imgix.net/icons/trash.png"/>'
                                    +'</a>'

                                    +'<a class="pull-right btnCloseModeSelectMobile" style="margin-left:20px;" data-id="'+newKeyWishlist+''
                                        +'<img width="15px" src="https://thewatch.imgix.net/icons/close-round.png"/>'
                                    +'</a>'

                                    +'<a class="pull-right dropdown-toggle btnOpenModeSelectMobile" data-toggle="dropdown" data-id="'+newKeyWishlist+'">'
                                        +'<img width="20px" src="https://thewatch.imgix.net/wishlist/mobile/menu-more.png"/>'
                                    +'</a>'

                                    +'<ul class="dropdown-menu pull-right" style="margin-right:40px;">'
                                        +'<li>'
                                            +'<a class="btnCheckAllMobile" data-id="'+newKeyWishlist+'" style="cursor:pointer;">Tandai Semua</a>'
                                        +'</li>'
                                        +'<li>'
                                            +'<a class="btnUncheckAllMobile" data-id="'+newKeyWishlist+'" style="cursor:pointer;">Hapus Tanda</a>'
                                        +'</li>'
                                    +'</ul>'
                                +'</div>'
                            +'</div>'
                        +'</div>'
                        
                        +'<div class="wishlist-area" style="margin-bottom:20px;">'
                            +'<div class="wrap-wishlist">'
                                +'<div class="row">'
                                    +'<div class="col-md-12">'
                                        +'<p class="text-center" style="font-weight:bold;padding-top:20px;">Belum ada produk</p>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                        +'</div>'

                        +'<!--BUTTTON HAPUS PINDAHKAN BELI DIBAWAH KETIKA MODE SELECT ON [MOBILE]-->'
                        +'<div class="controllmodeSelectMobile" style="margin-bottom:20px;" data-id="'+newKeyWishlist+'">'
                            +'<div class="row">'
                                
                                +'<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3" style="padding-left:10px;padding-right:10px;">'
                                    +'<a data-id="'+newKeyWishlist+'" onclick="deleteMassalDetailWishlist(this)" class="btn round-btn-red btncontrollmodeSelectMobile">Hapus</a>'
                                +'</div>'
                                +'<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">'
                                    +'<a data-id="'+newKeyWishlist+'" onclick="openModalMassalMoveWishlist(this)" class="btn round-btn-gold btncontrollmodeSelectMobile">Pindahkan</a>'
                                +'</div>'
                                +'<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">'
                                    +'<a data-id="'+newKeyWishlist+'" onclick="beliMassalDetailWishlist(this)" class="btn round-btn-blue btncontrollmodeSelectMobile">Beli</a>'
                                +'</div>'
                            +'</div>'
                        +'</div>'
                    +'</div>';
  
  $(".wishlist-content-wrap-mobile").append(newWishlistElement);
  refreshingUIMobile();
}

function checkWishlistCatalogue(idProduct, idProductAttribute){
  let errorMessage = $("#error-message"),
      successMessage = $("#success-message");
    console.log("Asdsad");
  $.ajax({
    type: "POST",
    // url: 'updateprofile',
    url: baseUrl + '/go-api/user/check-wishlist/',
    data: 
    {
      'product_id': idProduct,
      'product_attribute_id': idProductAttribute
    },
    success: function (jqHxr) {
        if(jqHxr.status === true)
        {
            successMessage.removeClass('dnone');

            //alert($(".addtowishlist[data-product-id='"+idProduct+"'").data("product-id"));

            if(jqHxr.result==1){
              $(".addtowishlistCatalogue[data-product-id='"+idProduct+"']").removeClass('disabled');
              $(".circle[data-id='"+idProduct+"']").removeClass("loved");
              $(".circle[data-id='"+idProduct+"']").addClass("love");
            }else{
              $(".addtowishlistCatalogue[data-product-id='"+idProduct+"']").addClass('disabled');
              $(".addtowishlistCatalogue[data-product-id='"+idProduct+"']").addClass('disabled');
              $(".circle[data-id='"+idProduct+"']").removeClass("love");
              $(".circle[data-id='"+idProduct+"']").addClass("loved"); 
            }

            $(".addtowishlistCatalogue[data-product-id='"+idProduct+"']").removeClass('initialed');

        }else{
            console.log(jqHxr.message);
            errorMessage.removeClass('dnone');
        }

        
        //location.reload();
    }
  });

}

function checkWishlist(idProduct, idProductAttribute){
  let errorMessage = $("#error-message"),
      successMessage = $("#success-message");
  
  $.ajax({
    type: "POST",
    // url: 'updateprofile',
    url: baseUrl + '/go-api/user/check-wishlist/',
    data: 
    {
      'product_id': idProduct,
      'product_attribute_id': idProductAttribute
    },
    success: function (jqHxr) {
        if(jqHxr.status === true)
        {
            successMessage.removeClass('dnone');

            //alert($(".addtowishlist[data-product-id='"+idProduct+"'").data("product-id"));

            if(jqHxr.result==1){
              $('.addtowishlist').removeClass('disabled');
              $(".icon-love-wishlist").attr("src","https://thewatch.imgix.net/wishlist/desktop/btn_add_to_wishlist_idle.png");
            }else{
              $('.addtowishlist').addClass('disabled');
              $(".icon-love-wishlist").attr("src","https://thewatch.imgix.net/wishlist/desktop/btn_add_to_wishlist_finish.png");  
            }

            $('.addtowishlist').removeClass('initialed');

        }else{
            console.log(jqHxr.message);
            errorMessage.removeClass('dnone');
        }

        
        //location.reload();
    }
  });

}

function addDetailWishlist(idProduct, idProductAttribute){
  let errorMessage = $("#error-message"),
      successMessage = $("#success-message");
  
  $.ajax({
    type: "POST",
    // url: 'updateprofile',
    url: baseUrl + '/go-api/user/add-detail-wishlist/',
    data: 
    {
      'product_id': idProduct,
      'product_attribute_id': idProductAttribute
    },
    success: function (jqHxr) {
        if(jqHxr.status === true)
        {
            successMessage.removeClass('dnone');
        }else{
            alert(jqHxr.message);
            errorMessage.removeClass('dnone');
        }

        
        //location.reload();
    }
  });

}

function deleteCategoryWishlist(){
  let errorMessage = $("#error-message"),
      successMessage = $("#success-message");
  var wishlistID = $('#delete-category-wishlist').val();
  $("#submit-delete-category-wishlist").prop('disabled', true);
  
  $.ajax({
    type: "POST",
    // url: 'updateprofile',
    url: baseUrl + '/go-api/user/delete-category-wishlist/',
    data: 
    {
      'id_wishlist': wishlistID
    },
    success: function (jqHxr) {
        if(jqHxr.status === true)
        {
            successMessage.removeClass('dnone');
        }else{
            alert(jqHxr.message);
            errorMessage.removeClass('dnone');
        }

        window.location.replace("../wishlist");

    }
  });

  $("#submit-delete-category-wishlist").prop('disabled', false);
}

function openModalDeleteCategory(wishlistID){
  $('#deleteCategoryModal').modal('show');
  $('#delete-category-wishlist').val(wishlistID);
}

function openModalDeleteDetail(wishlistID){
  $('#deleteDetailModal').modal('show');
  $('#delete-detail-wishlist').val(wishlistID);
}

function openModalMassalDeleteDetail(thisElement){
  $('#deleteMassalDetailModal').modal('show');
  
  var idWishlist = $(thisElement).data('id');
  var listDetailWishlistChecked = [];
  $.each($(".checkboxSelectWishlist[data-id='"+idWishlist+"']:checkbox:checked"), function(){            
    listDetailWishlistChecked.push($(this).val());
  });
  $('#delete-multiple-detail-wishlist').val(listDetailWishlistChecked);
}

function openModalMassalDeleteDetailMobile(thisElement){
  $('#deleteMassalDetailModal').modal('show');
  
  var idWishlist = $(thisElement).data('id');
  var listDetailWishlistChecked = [];
  $.each($(".checkboxSelectWishlistMobile[data-id='mobile"+idWishlist+"']:checkbox:checked"), function(){            
    listDetailWishlistChecked.push($(this).val());
  });
  $('#delete-multiple-detail-wishlist').val(listDetailWishlistChecked);
}

function openModalMoveWishlist(wishlistID){
  $('#moveCategoryModal').modal('show');
  $('#move-detail-wishlist').val(wishlistID);
}

function openModalMassalMoveWishlist(thisElement){
  $('#moveMassalCategoryModal').modal('show');
  
  var idWishlist = $(thisElement).data('id');
  var listDetailWishlistChecked = [];
  $.each($(".checkboxSelectWishlist[data-id='"+idWishlist+"']:checkbox:checked"), function(){            
    listDetailWishlistChecked.push($(this).val());
  });
  $('#move-multiple-detail-wishlist').val(listDetailWishlistChecked);
}

function openModalMassalMoveWishlistMobile(thisElement){
  $('#moveMassalCategoryModal').modal('show');

  var idWishlist = $(thisElement).data('id');
  var listDetailWishlistChecked = [];
  $.each($(".checkboxSelectWishlistMobile[data-id='mobile"+idWishlist+"']:checkbox:checked"), function(){            
    listDetailWishlistChecked.push($(this).val());
  });
  $('#move-multiple-detail-wishlist').val(listDetailWishlistChecked);
}

function addCategoryWishlist() {
  let errorMessage = $("#error-message"),
      successMessage = $("#success-message");
      $("#submit-category-wishlist").prop('disabled', true);
      var nameWishlist = document.getElementById('input-category-wishlist').value;
          $.ajax({
              type: "POST",
              url: baseUrl + '/go-api/user/add-category-wishlist/',
              data: 
              {
                'name': nameWishlist
              },
              success: function (jqHxr) {
                  if(jqHxr.status === true)
                  {
                    successMessage.removeClass('dnone');

                    $('#addCategoryModal').modal('hide');
                    
                    //MENGATUR SCROLL CATEGORY WISHLIST
                    settingScrollAfterAddCategoryWishlist(nameWishlist, jqHxr.id);

                    //MENAMBAHKAN CATEGORY BARU PADA MODAL MOVE WISHLIST
                    $(".move-list-massal-wishlist").append('<a class="moveWishlistItem" onclick="moveMassalDetailWishlist('+jqHxr.id+')"><li class="list-group-item">'+nameWishlist+'</li></a>');
                    $(".move-list-wishlist").append('<a class="moveWishlistItem" onclick="moveDetailWishlist('+jqHxr.id+')"><li class="list-group-item">'+nameWishlist+'</li></a>');

                    //MENAMBAHAKN ELEMENT CATEGORY WISHLIST BARU DESKTOP
                    newElementAfterAddCategoryWishlistDesktop(jqHxr.id, nameWishlist);

                    //MENAMBAHAKN ELEMENT CATEGORY WISHLIST BARU MOBILE
                    newElementAfterAddCategoryWishlistMobile(jqHxr.id, nameWishlist);
                  }else{
                    alert(jqHxr.message);
                    errorMessage.removeClass('dnone');
                }
                  

              }
          });
        
      $("#submit-category-wishlist").prop('disabled', false);
}

function deleteDetailWishlist(){
  let errorMessage = $("#error-message"),
      successMessage = $("#success-message");
  var wishlistID = $('#delete-detail-wishlist').val();
  $("#submit-delete-category-wishlist").prop('disabled', true);
  
  $.ajax({
    type: "POST",
    // url: 'updateprofile',
    url: baseUrl + '/go-api/user/delete-detail-wishlist/',
    data: 
    {
      'id_wishlist': wishlistID
    },
    success: function (jqHxr) {
        if(jqHxr.status === true)
        {
            successMessage.removeClass('dnone');
        }else{
            alert(jqHxr.message);
            errorMessage.removeClass('dnone');
        }

        location.reload();
    }
  });

  $("#submit-delete-category-wishlist").prop('disabled', false);
}

function moveDetailWishlist(categoryID){
  let errorMessage = $("#error-message"),
  successMessage = $("#success-message");
  $(this).prop('disabled', true);
  var detailID = document.getElementById('move-detail-wishlist').value;

  $.ajax({
  type: "POST",
  url: baseUrl + '/go-api/user/move-detail-wishlist/',
  data: 
  {
    'detail_id_wishlist': detailID,
    'category_id_wishlist': categoryID
  },
  success: function (jqHxr) {
      if(jqHxr.status === true)
      {
          successMessage.removeClass('dnone');
      }else{
          alert(jqHxr.message);
          errorMessage.removeClass('dnone');
      }

      location.reload();
  }
  });

  $(this).prop('disabled', false);
}

function deleteMassalDetailWishlist(thisElement){
  let errorMessage = $("#error-message"),
  successMessage = $("#success-message");
  $(thisElement).prop('disabled', true);
  var detailID = document.getElementById('delete-multiple-detail-wishlist').value;
  detailID = detailID.split(",");

  $.ajax({
    type: "POST",
    url: baseUrl + '/go-api/user/delete-multiple-detail-wishlist/',
    data: 
    {
      'id_wishlist': detailID
    },
    success: function (jqHxr) {
        if(jqHxr.status === true)
        {
            successMessage.removeClass('dnone');
        }else{
            alert(jqHxr.message);
            errorMessage.removeClass('dnone');
        }
  
        location.reload();
    }
    });
  
    $(this).prop('disabled', false);

}

function moveMassalDetailWishlist(categoryID){
  let errorMessage = $("#error-message"),
  successMessage = $("#success-message");
  $(this).prop('disabled', true);
  var detailID = document.getElementById('move-multiple-detail-wishlist').value;
  detailID = detailID.split(",");

  $.ajax({
  type: "POST",
  url: baseUrl + '/go-api/user/move-multiple-detail-wishlist/',
  data: 
  {
    'detail_id_wishlist': detailID,
    'category_id_wishlist': categoryID
  },
  success: function (jqHxr) {
      if(jqHxr.status === true)
      {
          successMessage.removeClass('dnone');
      }else{
          alert(jqHxr.message);
          errorMessage.removeClass('dnone');
      }

      location.reload();
  }
  });

  $(this).prop('disabled', false);
}


function beliDetailWishlist(productID, attributeID, detailID, thisElement){
  let errorMessage = $("#error-message"),
  successMessage = $("#success-message");
  
  $(thisElement).addClass('disabled');
  

  $.ajax({
    type: "POST",
    url: baseUrl + '/go-api/user/convert-product-wishlist-to-product/',
    data: 
    {
      'product_id': productID,
      'product_attribute_id': attributeID
    },
    success: function (jqHxr) {  
      var dataproduct = [];
      
      if(jqHxr.stock >0){
        $.each( jqHxr, function( key, value ) {
          dataproduct[key] =  value ;
        });
        
        $.ajax({
          type: "POST",
          url: baseUrl + '/cart/checkout/add-item',
          datatype:'json',
          data: {cart:{items:{0:jqHxr}}},
          success: function (datahasil) {  
            //var hasil = [];
            //hasil.push(datahasil);
            var datahasil = JSON.parse(datahasil); 
            console.log(datahasil[0]);
            console.log(datahasil[1]);
            console.log(datahasil[2]);

            $("div#box-cart").html(datahasil[0]);
            $("div#menu-cart-mobile").html(datahasil[1]);
            pushRight.open();
            $("#arrow-cart").slideDown();
            $("#box-cart").slideDown();
            $("html, body").animate({scrollTop: 0}, "slow");
            

            $.ajax({
              type: "POST",
              // url: 'updateprofile',
              url: baseUrl + '/go-api/user/delete-detail-wishlist/',
              data: 
              {
                'id_wishlist': detailID
              },
              success: function (jqHxr) {
                  if(jqHxr.status === true)
                  {
                      successMessage.removeClass('dnone');
                      $(".wishlist-area[data-detail='"+detailID+"']").remove();
                      $(".wishlist-area[data-detail='mobile"+detailID+"']").remove();
                  }else{
                      alert(jqHxr.message);
                      errorMessage.removeClass('dnone');
                  }
          
                  
              }
            });
          }
          });
      }else{
        alert("Stock "+jqHxr.name+" out of stock");
      }

      $(thisElement).removeClass('disabled');
    }
  });

  
  
}

function beliMassalDetailWishlist(thisElement){
  let errorMessage = $("#error-message"),
  successMessage = $("#success-message");
  $(thisElement).addClass('disabled');
  var idWishlist = $(thisElement).data('id');
  var listDetailWishlistChecked = [];
  $.each($(".checkboxSelectWishlist[data-id='"+idWishlist+"']:checkbox:checked"), function(){
    beliDetailWishlist($(this).data('product'), $(this).data('attribute'), $(this).data('detail'));
  });
  

  $(thisElement).removeClass('disabled');

}

function beliMassalDetailWishlistMobile(thisElement){
  let errorMessage = $("#error-message"),
  successMessage = $("#success-message");
  $(thisElement).prop('disabled', true);
  var idWishlist = $(thisElement).data('id');
  var listDetailWishlistChecked = [];
  $.each($(".checkboxSelectWishlistMobile[data-id='mobile"+idWishlist+"']:checkbox:checked"), function(){
    beliDetailWishlist($(this).data('product'), $(this).data('attribute'), $(this).data('detail'));
  });
    $(this).prop('disabled', false);

}
