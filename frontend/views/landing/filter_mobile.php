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


<!-- start mobile filter -->

            <div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0px; background: #f6f6f6; z-index: 15; overflow: auto" id="filter-content">
   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 35px;">
                    <span class="" style="letter-spacing:3px;text-align:center;font-family: gotham-medium;">FILTER</span>
                    <!-- <span class="pull-right">
                        <a href="#" id="close-filter-mobile">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 7px; width: 20%">
                        </a>
                    </span> -->
                    <div class="clearfix"></div>
                    <div class="border-bottom-1" style="margin-top: 12px;"></div>
                </div>

                

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div id="list-menu-filter-mobile">
                    
                        
                        <div id="filter-water-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">COLLECTION</span>
                            <span class="pull-right radio-btn">
                                <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                            </span>
                        </div>
                        
                       
            
                        <div id="filter-price-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">PRICE</span>
                            <span class="pull-right radio-btn">
                                <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                            </span>
                        </div>

                        </div>

                  

                      <div id="list-price-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-price-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: HARGA</a>
                                </div>
                                <div style="padding-top:60px;"></div>
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

                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">TAMPILKAN SEMUA
                                <input id="apply-filters-preorder-mobile" type="radio" data-id="water" value="0-50000000" id="0-50000000" name="price-mobile" <?php echo $price_tampilkan==true ? 'checked' : '';?> >
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>

                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">DI BAWAH 500K
                                <input id="apply-filters-preorder-mobile" type="radio" data-id="water" value="0-500000" id="0-500000" name="price-mobile" <?php echo $_GET['price']=='0--500000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>
                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">IDR 500K - IDR 1 M
                                <input id="apply-filters-preorder-mobile" type="radio" data-id="water" value="500000-1000000" id="500000-1000000" name="price-mobile" <?php echo $_GET['price']=='500000--1000000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>
                              <label class="control control--radio" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">IDR 1 M - IDR 2 M
                                <input id="apply-filters-preorder-mobile" type="radio" data-id="water" value="1000000-2000000" id="1000000-2000000" name="price-mobile" <?php echo $_GET['price']=='1000000--2000000' ? 'checked' : '';?>>
                                <div class="control__indicator"></div>
                              </label>
                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">IDR 2 M - IDR 3 M
                                <input id="apply-filters-preorder-mobile" type="radio" data-id="water" value="2000000-3000000" id="2000000-3000000" name="price-mobile" <?php echo $_GET['price']=='2000000--3000000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>
                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">DI ATAS IDR 3 M
                                <input id="apply-filters-preorder-mobile" type="radio" data-id="water" value="3000000-50000000" id="3000000-50000000" name="price-mobile" <?php echo $_GET['price']=='3000000--50000000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>


                                                          
                        </div>
                    </div>


                    <div id="list-water-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-water-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: COLLECTION</a>
                                </div>
                                <div style="padding-top:60px;"></div>

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
                                            
                                            <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $product->brands_collection_name; ?>
                                                <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="water" value="<?php echo $product->brands_collection_id; ?>" id="apply-filters-preoder-mobile" name="collection-mobile">
            
                                                <div class="control__indicator" style="top:5px;"></div>
                                              </label>
                                  
                                            
                                    <?php } ?>

                                    
                        </div>
                    </div>
                                       
                </div>
                <div class="col-xs-12 margin-top-5 remove-padding" style="z-index:11;text-align: left;position: fixed;size: 10px;background-color: #fff;bottom: 0;height: 50px;width: 100%;">
                        <span class="text-gotham-light col-xs-6 ptop4 clearleft-mobile clearright-mobile" style="padding-bottom:20px;text-align: center;background-color: #c2b9b4;color:#fff;">
                        <a href="#" id="close-filter-mobile" style="color:white;letter-spacing: 1px;">
                            CLOSE ALL FILTER
                        </a></span>
                        <span class="text-gotham-light col-xs-6 ptop4" style="padding-bottom:20px;text-align: center;background-color: #9f8562;color:#fff;"><input style="background: transparent;border: none;color:white;letter-spacing: 1px;" class="" type="reset" value="CLEAR" name="clear" /></span>
                        
                </div>
            </div>

            <!-- end of mobile filter -->
