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
<?php
  $url = explode("/",$_SERVER['REQUEST_URI']);

  $urls = explode("?",$url[1]);
  // echo $urls[0];
  $sortby = 'none';
  if(isset($_GET['sortby'])){
    $sortby = $_GET['sortby'];
  }
?>

<!-- start mobile filter -->

            <div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0px; background: #f6f6f6; z-index: 15; overflow: auto" id="filter-content">
                <input type="hidden" value="<?php echo $urls[0]; ?>" id="apply-filters-promo-mobile" name="breadcrumb">
                <input type="hidden" value="<?php echo $sortby; ?>" id="apply-filters-promo-mobile" name="sortby">
                <input style="" class="grey-font" type="hidden" value="<?php echo $limit;?>" name="filter-limit" />
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
                        <div id="filter-type-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">KATEGORI</span>
                            <span class="pull-right radio-btn">
                                <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                            </span>
                        </div>
                       
                        <div id="filter-gender-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">GENDER</span>
                            <span class="pull-right radio-btn">
                                <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                            </span>
                        </div>
                     
                        <div id="filter-brand-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">

                            <span class="pull-left" style="letter-spacing:3px;">BRANDS</span>
                                <span class="pull-right radio-btn">
                                    <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                                </span>
                            </div>
                        
                   
                        <div id="filter-size-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">WATCH SIZE</span>
                            <span class="pull-right radio-btn">
                                <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                            </span>
                        </div>
                       
                        <div id="filter-bandwidth-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">BANDWIDTH</span>
                            <span class="pull-right radio-btn">
                                <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                            </span>
                        </div>
                
                        <div id="filter-movement-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">MOVEMENT</span>
                            <span class="pull-right radio-btn">
                                <div class="ardown"><img class="arrow-down-watches" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-spec.png"></div>
                            </span>
                        </div>
                        
                        <div id="filter-water-mobile-menu" class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                            <span class="pull-left" style="letter-spacing:3px;">WATER RESISTANT</span>
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

                  
                    <div id="list-brand-mobile-menu" class="-act" style="background: rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-brand-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: BRANDS</a>
                                </div>
                                <div style="padding-top:60px;"></div>
                       
                                  
                            <?php
                              $brandses = \backend\models\Brands::find()
                                ->orderBy('brands.brand_name ASC')
                                ->where(['brands.brand_id' => $brands,'brands.brand_status'=>'active'])
                                ->all();
                             ?>
                              <?php
                              foreach ($brandses as $row) {
                              ?>

                                  <?php
                                      $checked = FALSE;
                                      foreach($brands_selection as $brand){
                                          if($row->brand_id == $brand){
                                              $checked = TRUE;
                                          }
                                      }
                                      ?>
                                      <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $row->brand_name; ?>
                                        <input id="apply-filters-promo-mobile" <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" name="brands-mobile" value="<?php echo $row->brand_id; ?>"/>

                                        <div class="control__indicator" style="top:5px;"></div>
                                      </label>

                                      <!-- <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 clearleft clearright">
                                          <span class="pull-left" style="letter-spacing:1px;"><input id="apply-filters-promo" <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" name="brands" value="<?php echo $row->link_rewrite; ?>"/> <label for="" onclick=""><?php echo $row->brand_name; ?></label></span>
                                      </div> -->

                              <?php
                              }
                              ?>

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
                                <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="0-50000000" id="0-50000000" name="price-mobile" <?php echo $price_tampilkan==true ? 'checked' : '';?> >
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>

                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">DI BAWAH 500K
                                <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="0-500000" id="0-500000" name="price-mobile" <?php echo $_GET['price']=='0--500000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>
                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">IDR 500K - IDR 1 M
                                <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="500000-1000000" id="500000-1000000" name="price-mobile" <?php echo $_GET['price']=='500000--1000000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>
                              <label class="control control--radio" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">IDR 1 M - IDR 2 M
                                <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="1000000-2000000" id="1000000-2000000" name="price-mobile" <?php echo $_GET['price']=='1000000--2000000' ? 'checked' : '';?>>
                                <div class="control__indicator"></div>
                              </label>
                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">IDR 2 M - IDR 3 M
                                <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="2000000-3000000" id="2000000-3000000" name="price-mobile" <?php echo $_GET['price']=='2000000--3000000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>
                              <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">DI ATAS IDR 3 M
                                <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="3000000-50000000" id="3000000-50000000" name="price-mobile" <?php echo $_GET['price']=='3000000--50000000' ? 'checked' : '';?>>
                                <div class="control__indicator" style="top:5px;"></div>
                              </label>


                                                          
                        </div>
                    </div>


                    <div id="list-size-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-size-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: WATCH SIZE</a>
                                </div>
                                <div style="padding-top:60px;"></div>
                       
                                <?php
                                  $checked = false;$checked1 = false;$checked2 = false;$checked3 = false;
                                  $ss = 0;
                                  $feature_value_id1 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>26])->one()->feature_value_id;
                                  $feature_value_id2 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>32])->one()->feature_value_id;
                                  $feature_value_id3 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>38])->one()->feature_value_id;
                                  $feature_value_id4 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>41])->one()->feature_value_id;

                                  while($ss < sizeof($size_selection)){

                                      if($size_selection[$ss] == $feature_value_id1){
                                          $checked = true;
                                      }
                                      if($size_selection[$ss] == $feature_value_id2){
                                          $checked1 = true;
                                      }
                                      if($size_selection[$ss] == $feature_value_id3){
                                          $checked2 = true;
                                      }
                                      if($size_selection[$ss] == $feature_value_id4){
                                          $checked3 = true;
                                      }
                                      $ss++;
                                  }

                                  $featureValue1 = \backend\models\ProductFeatureValue::find()
                                          ->where(['feature_id' => 5])
                                          ->andWhere(['between', 'feature_value_value', 26, 30])
                                          ->all();
                                          $j = 0;$data1 = '';
                                          foreach($featureValue1 as $featured){
                                              if($j == 0){
                                                $data1 = $featured->feature_value_id;
                                              }else{
                                                $data1 = $data1. '--'.$featured->feature_value_id;
                                              }
                                              $j++;
                                          }
                                  $featureValue2 = \backend\models\ProductFeatureValue::find()
                                          ->where(['feature_id' => 5])
                                          ->andWhere(['between', 'feature_value_value', 32, 36])
                                          ->all();
                                          $j = 0;$data2 = '';
                                          foreach($featureValue2 as $featured){
                                            if($j == 0){
                                              $data2 = $featured->feature_value_id;
                                            }else{
                                              $data2 = $data2. '--'.$featured->feature_value_id;
                                            }
                                              $j++;
                                          }
                                  $featureValue3 = \backend\models\ProductFeatureValue::find()
                                          ->where(['feature_id' => 5])
                                          ->andWhere(['between', 'feature_value_value', 38, 40])
                                          ->all();
                                          $j = 0;$data3 = '';
                                          foreach($featureValue3 as $featured){
                                            if($j == 0){
                                              $data3 = $featured->feature_value_id;
                                            }else{
                                              $data3 = $data3. '--'.$featured->feature_value_id;
                                            }
                                              $j++;
                                          }
                              $featureValue4 = \backend\models\ProductFeatureValue::find()
                                      ->where(['feature_id' => 5])
                                      ->andWhere(['between', 'feature_value_value', 41, 47])
                                      ->all();
                                      $j = 0;$data4 = '';
                                      foreach($featureValue4 as $featured){
                                        if($j == 0){
                                          $data4 = $featured->feature_value_id;
                                        }else{
                                          $data4 = $data4. '--'.$featured->feature_value_id;
                                        }
                                          $j++;
                                      }


                                      ?>
                                      <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">26 - 30
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data1; ?>" id="apply-filters-promo-mobile" name="size-mobile">

                                        <div class="control__indicator" style="top:5px;"></div>
                                      </label>
                                      <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">32 - 36
                                        <input <?php echo $checked1 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data2; ?>" id="apply-filters-promo-mobile" name="size-mobile">

                                        <div class="control__indicator" style="top:5px;"></div>
                                      </label>
                                      <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">38 - 40
                                        <input <?php echo $checked2 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data3; ?>" id="apply-filters-promo-mobile" name="size-mobile">

                                        <div class="control__indicator" style="top:5px;"></div>
                                      </label>
                                      <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">41 - 47
                                        <input <?php echo $checked3 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data4; ?>" id="apply-filters-promo-mobile" name="size-mobile">

                                        <div class="control__indicator" style="top:5px;"></div>
                                      </label>

                                              
                        </div>
                    </div>

                     
                    <div id="list-type-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-type-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: KATEGORI</a>
                                </div>
                                <div style="padding-top:60px;"></div>

                                <?php
                                // $breadcrumbs = $this->context->breadcrumb;

                               if($brandId != 74 || $brandId != 75 || $brandId != 76 || $brandId != 77 || $brandId != 78 ) { ?>
                                <?php
                                  $feature = \backend\models\Feature::find()->all();
                                  foreach ($feature as $row) {
                                    if (strtoupper($row->feature_name) == "TYPE") {
                                      $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                                      foreach ($product_feature_value as $row) {
                                          $checked = FALSE;
                                          foreach($types_selection as $type){
                                              if($row->feature_value_id == $type){
                                                  $checked = TRUE;
                                              }
                                          }
                                    ?>
                                    <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $row->feature_value_name; ?>
                                      <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-mobile" name="type-mobile">

                                      <div class="control__indicator" style="top:5px;"></div>
                                    </label>
                                    <!-- <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 clearleft">
                                            <span class="pull-left" style="letter-spacing:1px;"><input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_value; ?>" id="apply-filters" name="type"> <label> <?php echo $row->feature_value_name; ?> </label></span>
                                        </div> -->
                                    <?php
                                      }
                                    }
                                }
                                ?>
                                <?php }else{ ?>
                                  <?php
                                    $chk = 0;
                                    if(isset($_GET['sub'])){
                                      $chk = $_GET['sub'];
                                    }
                                    ?>
                                    <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;">Semua Kategori
                                  
                                        <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="0" name="subcat-mobile" <?php if($chk == 0){ echo 'checked';}?>>

                                        <div class="control__indicator" style="top:5px;"></div>
                                        </label>
                                    <?php
                                    $subcat = \backend\models\ProductSubCategory::find()->all();
                                    foreach ($subcat as $row) {
                                          
                                      ?>
                                      <label class="control control--radio border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $row->product_sub_category_name; ?>
                                  
                                        <input id="apply-filters-promo-mobile" type="radio" data-id="water" value="<?php echo $row->product_sub_category_id; ?>" name="subcat-mobile" <?php if($chk == $row->product_sub_category_id){ echo 'checked';}?> >

                                        <div class="control__indicator" style="top:5px;"></div>
                                        </label>
                                      <?php
                                             
                                  }
                                  ?>
                                <?php } ?>

                                    
                        </div>
                    </div>

                    <div id="list-movement-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-movement-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: MOVEMENT</a>
                                </div>
                                <div style="padding-top:60px;"></div>

                               
                                <?php
                                //$feature = \backend\models\Feature::find()->all();
                                foreach ($feature as $row) {
                                    if (strtoupper($row->feature_name) == "MOVEMENT") {
                                    $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                                      foreach ($product_feature_value as $row) {
                                          $checked = FALSE;
                                          foreach($movements_selection as $type){
                                              if($row->feature_value_id == $type){
                                                  $checked = TRUE;
                                              }
                                          }
                                          ?>

                                          <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $row->feature_value_name; ?>
                                            <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-mobile" name="movement-mobile">

                                            <div class="control__indicator" style="top:5px;"></div>
                                          </label>


                                    <?php
                                      }
                                    }
                                ?>
                                <?php
                              }
                              ?>


                                    
                        </div>
                    </div>

                    <div id="list-water-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-water-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: WATER RESISTANT</a>
                                </div>
                                <div style="padding-top:60px;"></div>

                                

                                    <?php
                                      $waterArr = array(3, 5, 8, 10, 20);
                                      foreach($waterArr as $feature){
                                          $feature_value_id = backend\models\ProductFeatureValue::find()->where(['feature_id' => 4 , 'feature_value_value'=>$feature])->one()->feature_value_id;
                                          $checked = FALSE;
                                          foreach($waters_selection as $selection){
                                              if($feature_value_id == $selection){
                                                  $checked = TRUE;
                                              }
                                          }
                                  ?>

                                  <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $feature . ' ATM'; ?>
                                    <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="water" value="<?php echo $feature_value_id; ?>" id="apply-filters-promo-mobile" name="water-mobile">

                                    <div class="control__indicator" style="top:5px;"></div>
                                  </label>


                                <?php } ?>

                        </div>
                    </div>

                    <div id="list-gender-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-gender-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: GENDER</a>
                                </div>
                                <div style="padding-top:60px;"></div>

                                <?php
                                  $feature = \backend\models\Feature::find()->all();
                                  foreach ($feature as $row) {
                                      if (strtoupper($row->feature_name) == "GENDER") {
                                        $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                                            foreach ($product_feature_value as $row) {
                                                $checked = FALSE;
                                                foreach($genders_selection as $gender){
                                                    if($row->feature_value_id == $gender){
                                                        $checked = TRUE;
                                                    }
                                                }

                                      ?>
                                      <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $row->feature_value_name; ?>
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-mobile" name="gender-mobile">

                                        <div class="control__indicator" style="top:5px;"></div>
                                      </label>
                                      <!-- <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 clearleft">
                                                    <span class="pull-left" style="letter-spacing:1px;"><input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_value; ?>" id="apply-filters-brand" name="gender"> <label> <?php echo $row->feature_value_name; ?> </label></span>
                                                </div> -->

                                      <?php
                                        }
                                      }
                                  ?>
                                  <?php
                                }
                                ?>

                        </div>
                    </div>

                    <div id="list-bandwidth-mobile-menu" class="-act" style="background:rgb(246, 246, 246); display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; z-index: 10; overflow: auto" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px;">
                            <div id="close-list-bandwidth-mobile" class="col-xs-12 col-sm-12 slidedown-menu p15" style="text-align:center;margin-top:0;height:50px;line-height:50px;">
                                    <div class="ardown pull-left gotham-medium"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/left-spec.png"></div>
                                    <a>FILTER BY: BANDWIDTH</a>
                                </div>
                                <div style="padding-top:60px;"></div>

                                <?php
                                  $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 6])->all();
                                  foreach ($watches_size as $row) {
                                      $checked = FALSE;
                                      foreach($bandwidth_selection as $bandwidth){
                                          if($row->feature_value_id == $bandwidth){
                                              $checked = TRUE;
                                          }
                                      }
                                      ?>

                                      <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $row->feature_value_name; ?>
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-mobile" name="bandwidth-mobile">

                                        <div class="control__indicator" style="top:5px;"></div>
                                      </label>


                                    <?php
                                  }
                                  ?>

                        </div>
                    </div>
               



                    <div class="hidden padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                        <span class="pull-left" style="letter-spacing:3px;">ALL PRODUCTS</span>
                        <span class="pull-right radio-btn">
                            <input class="roundedOne" id="all-product-mobile" type="radio" name="sort_mobile" value="all-product" checked/> <label></label>
                        </span>
                    </div>
                    <div class="hidden col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                        <span class="pull-left" style="letter-spacing:3px;">NEW ARRIVAL</span>
                        <span class="pull-right radio-btn"><input class="roundedOne" type="radio" value="new-arrival" name="sort_mobile"/> <label></label></span>
                    </div>
                    <div class="hidden col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                        <span class="pull-left" style="letter-spacing:3px;">SALE</span>
                        <span class="pull-right radio-btn"><input class="roundedOne" type="radio" value="sale" name="sort_mobile"/> <label></label></span>
                    </div>

                                       
                </div>
                <div class="col-xs-12 margin-top-5 remove-padding close-filter" style="z-index:11;text-align: left;position: fixed;background-color: #fff;bottom: 0;width: 100%;">
                        <span class="text-gotham-light col-xs-6 clearleft-mobile clearright-mobile" style="padding-bottom:20px;padding-top:20px;text-align: center;background-color: #c2b9b4;color:#fff;">
                        <a href="#" id="close-filter-mobile" style="color:white;letter-spacing: 1px;">
                            CLOSE ALL FILTER
                        </a></span>
                        <span class="text-gotham-light col-xs-6" style="padding-bottom:20px;padding-top:20px;text-align: center;background-color: #9f8562;color:#fff;"><input style="background: transparent;border: none;color:white;letter-spacing: 1px;" class="" type="reset" value="CLEAR" name="clear" /></span>
                        
                </div>
            </div>

            <!-- end of mobile filter -->
