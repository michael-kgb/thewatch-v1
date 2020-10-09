<style>

.control-group {
display: inline-block;
vertical-align: top;
background: #fff;
text-align: left;
box-shadow: 0 1px 2px rgba(0,0,0,0.1);
padding: 30px;
width: 200px;
height: 210px;
margin: 10px;
}
.control {
display: block;
position: relative;
padding-left: 27px;
padding-top: 3px;
margin-bottom: 8px;
cursor: pointer;
font-size: 11px;
}
.control input {
position: absolute;
z-index: -1;
opacity: 0;
}
.control__indicator {
position: absolute;
top: 2px;
left: 0;
height: 15px;
width: 15px;
background: #e6e6e6;
}
.control--radio .control__indicator {
border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
background: #ccc;
}
.control input:checked ~ .control__indicator {
background: #4c757b;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
background: #4c757b;
}
.control input:disabled ~ .control__indicator {
background: #4c757b;
opacity: 0.6;
pointer-events: none;
}
.control__indicator:after {
content: '';
position: absolute;
display: none;
}
.control input:checked ~ .control__indicator:after {
display: block;
}
.control--checkbox .control__indicator:after {
left: 6px;
top: 2px;
width: 4px;
height: 8px;
border: solid #fff;
border-width: 0 2px 2px 0;
transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
border-color: #7b7b7b;
}
.control--radio .control__indicator:after {
left: 5px;
top: 5px;
height: 5px;
width: 5px;
border-radius: 50%;
background: #fff;
}
.control--radio input:disabled ~ .control__indicator:after {
background: #7b7b7b;
}
.select {
position: relative;
display: inline-block;
margin-bottom: 15px;
width: 100%;
}
.select select {
display: inline-block;
width: 100%;
cursor: pointer;
padding: 10px 15px;
outline: 0;
border: 0;
border-radius: 0;
background: #e6e6e6;
color: #7b7b7b;
appearance: none;
-webkit-appearance: none;
-moz-appearance: none;
}
.select select::-ms-expand {
display: none;
}
.select select:hover,
.select select:focus {
color: #000;
background: #ccc;
}
.select select:disabled {
opacity: 0.5;
pointer-events: none;
}
.select__arrow {
position: absolute;
top: 16px;
right: 15px;
width: 0;
height: 0;
pointer-events: none;
border-style: solid;
border-width: 8px 5px 0 5px;
border-color: #7b7b7b transparent transparent transparent;
}
.select select:hover ~ .select__arrow,
.select select:focus ~ .select__arrow {
border-top-color: #000;
}
.select select:disabled ~ .select__arrow {
border-top-color: #ccc;
}

</style>
<input type="hidden" value="<?php echo $breadcrumbs[1]; ?>" id="apply-filters-brand" name="breadcrumb">
<input type="hidden" value="<?php echo $brandName; ?>" id="apply-filters-brand" name="brandname">

<!-- Kategori -->
<!-- Kategori -->
<div class="hidden-sm col-md-2 hidden-xs col-lg-2" style="font-size:11px;font-family:gotham-light;letter-spacing:1px;">
  

  <div id="brand-filters">
      <div class="col-xs-6 clearleft clearright">
        KOLEKSI
      </div>
      <div class="col-xs-6 clearleft clearright" style="text-align:right;">
        <input style="background: transparent;border: none;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
      </div>
      <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
      <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;overflow-x:hidden;">
        <?php
          
              $brand_collection = \backend\models\BrandsCollection::find()->where(['brands_brand_id' => $brandId])->all();
           
            ?>
            <?php foreach ($brand_collection as $product) { ?>
                
             <?php
                $checked = FALSE;
                foreach($collection_selection as $collection){
                            if($product->brands_collection_id == $collection){
                                $checked = TRUE;
                            }
                        }
                ?>

                <label class="control control--checkbox"><?php echo $product->brands_collection_name; ?>
                  <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $product->brands_collection_id; ?>" id="apply-filters-preorder" name="collection">

                  <div class="control__indicator"></div>
                </label>

        <?php } ?>
        <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
          <!-- Line Space -->
        </div>
      </div>
      <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
        <!-- Line Space -->
      </div>
    </div>
 
    <!-- PRICE -->
    <div class="filter-price-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-price')">
        <div class="col-xs-10 clearleft clearright">         
              HARGA       
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-price-show" style="cursor: pointer;"><a onclick="filter_show('filter-price')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
    </div>
    <div class="filter-price-hide" style="cursor: pointer;display:none;">
        <a onclick="filter_hide('filter-price')">
          <div class="col-xs-10 clearleft clearright">         
                HARGA    
           </div>
          <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
            <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
          </div> -->
       
            <div class="col-xs-2 artop-warranty filter-price-hide" style="display:none;cursor: pointer;"><a onclick="filter_hide('filter-price')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-ms-transform: rotate(180deg);-o-transform: rotate(180deg);transform: rotate(180deg);"></a></div>
           </a>
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    

    <div id="filter-price" class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;display:none;">
      <?php
        $price_tampilkan = false;
        if(!isset($_GET['price'])){
          $price_tampilkan = true;
        }else{
          if($_GET['price'] == '0--50000000'){
            $price_tampilkan = true;
          }
        }

      ?>

      <label class="control control--radio">TAMPILKAN SEMUA
        <input id="apply-filters-preorder" type="radio" data-id="water" value="0-50000000" id="0-50000000" name="price" <?php echo $price_tampilkan==true ? 'checked' : '';?> >
        <div class="control__indicator"></div>
      </label>

      <label class="control control--radio">DI BAWAH 500K
        <input id="apply-filters-preorder" type="radio" data-id="water" value="0-500000" id="0-500000" name="price" <?php echo $_GET['price']=='0--500000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 500K - IDR 1 M
        <input id="apply-filters-preorder" type="radio" data-id="water" value="500000-1000000" id="500000-1000000" name="price" <?php echo $_GET['price']=='500000--1000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 1 M - IDR 2 M
        <input id="apply-filters-preorder" type="radio" data-id="water" value="1000000-2000000" id="1000000-2000000" name="price" <?php echo $_GET['price']=='1000000--2000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 2 M - IDR 3 M
        <input id="apply-filters-preorder" type="radio" data-id="water" value="2000000-3000000" id="2000000-3000000" name="price" <?php echo $_GET['price']=='2000000--3000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">DI ATAS IDR 3 M
        <input id="apply-filters-preorder" type="radio" data-id="water" value="3000000-50000000" id="3000000-50000000" name="price" <?php echo $_GET['price']=='3000000--50000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>

      <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
        <!-- Line Space -->
      </div>
    </div>
    <div id="brand-filtersss" class="col-xs-12 clearleft clearright" style="padding-top:0;">
      <!-- Line Space -->
    </div>

    

    <div class="row box-filter-bottom">
        <div class="col-lg-12 col-md-12 col-sm-12" style="min-height:200px;padding-top: 30px;">


        </div>
    </div>
</div>
<script>
function filter_show(type){
    $('.'+type+'-show').css('display', 'none');
    $('#'+type).show("slide", {direction: "up"}, 500);
    $('.'+type+'-hide').css('display', 'block');
}
function filter_hide(type){
    $('.'+type+'-hide').css('display', 'none');
    $('#'+type).show("slide", {direction: "down"}, 500);
    $('#'+type).css('display', 'none');
    $('.'+type+'-show').css('display', 'block');
}
</script>
