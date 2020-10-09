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
<div class="hidden-sm col-md-2 hidden-xs col-lg-2" style="font-family:gotham-light;letter-spacing:1px;">
  

  <div id="brand-filters">
      <div class="col-lg-6 col-md-6 col-sm-6 talign-left clearleft clearright">
      <span class="fcolorblue fsize-18 gotham-white"><i class="filter-blue-sprite mright10 hidden-md"></i>Filter</span>
          
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 breadcrumb-page clearleft clearright">
        <input style="border: none;" class="fcolor255 bgcolorprimary bradius20 pleft15 pright15 fsize-18 gotham-white" type="reset" value="Reset" name="clear-brand" />
      
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 new-line talign-left clearleft clearright"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 new-line talign-left clearleft clearright"></div>
    <div class="col-xs-6 clearleft clearright gotham-medium">
      Koleksi
    </div>
    <div class="col-xs-6 clearleft clearright" style="text-align:right;">
      
    </div>
      <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
      <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;overflow-x:hidden;">
        <?php
            $i = 1;
            if(isset($breadcrumbs[1])){
              $id_category = \backend\models\ProductCategory::find()->where(['product_category_name' => $breadcrumbs[1] ])->one()->product_category_id;
              $product_collection = \backend\models\Product::find()->where(['product_category_id' => $id_category , 'brands_brand_id'=> $brandId])->all();
              $brands_collection_id = [];
              foreach($product_collection as $prod_row){
                $brands_collection_id[] = $prod_row->brands_collection_id;
              }
              $brand_collection = \backend\models\BrandsCollection::find()->where(['brands_collection_id' => $brands_collection_id])->all();
            }else{
              $brand_collection = \backend\models\BrandsCollection::find()->where(['brands_brand_id' => $brandId])->all();
            }
            
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
                  <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $product->brands_collection_id; ?>" id="apply-filters-brand" name="collection">

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
  <?php $brand_category = backend\models\ProductCategoryBrands::find()->where(['brands_brand_id' => $brandId])->one()->product_category_category_id;

   if($brand_category == 12 || $breadcrumbs[1] == 'jewelry') { ?>
    
    <?php }else{ ?>
  <div class="filter-type-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-type')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Feature          
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-type-show" style="cursor: pointer;"><a onclick="filter_show('filter-type')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
  </div>
  <div class="filter-type-hide" style="cursor: pointer;display:none;">
      <a onclick="filter_hide('filter-type')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Feature          
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
     
          <div class="col-xs-2 artop-warranty filter-type-hide" style="display:none;cursor: pointer;"><a onclick="filter_hide('filter-type')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-ms-transform: rotate(180deg);-o-transform: rotate(180deg);transform: rotate(180deg);"></a></div>
         </a>
  </div>

  <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
    <!-- Border 1px -->
  </div>
  


  <div id="filter-type" class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;display:none;">
    <?php
      //$feature = \backend\models\Feature::find()->all();
      foreach ($feature as $row) {
        if (strtoupper($row->feature_name) == "TYPE") {
          $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
          foreach ($product_feature_value as $row) {
              $checked = FALSE;
              $types_selection = [];
              foreach($types_selection as $type){
                  if($row->feature_value_id == $type){
                      $checked = TRUE;
                  }
              } 
			  if($row->feature_value_id!=117){
				  
        ?>
        <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
          <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-brand" name="type">

          <div class="control__indicator"></div>
        </label>
        <?php
          }
		  }
        }
    }
    ?>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>
  </div>
  <div class="col-xs-12 clearleft clearright" style="padding-top:0;">
    <!-- Line Space -->
  </div>
    
    <!-- Gender -->
    <div class="filter-gender-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-gender')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Gender          
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-gender-show" style="cursor: pointer;"><a onclick="filter_show('filter-gender')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
    </div>
    <div class="filter-gender-hide" style="cursor: pointer;display:none;">
        <a onclick="filter_hide('filter-gender')">
          <div class="col-xs-10 clearleft clearright gotham-medium">         
                Gender          
           </div>
          <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
            <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
          </div> -->
       
            <div class="col-xs-2 artop-warranty filter-gender-hide" style="display:none;cursor: pointer;"><a onclick="filter_hide('filter-gender')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-ms-transform: rotate(180deg);-o-transform: rotate(180deg);transform: rotate(180deg);"></a></div>
           </a>
    </div>

    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    

    <div id="filter-gender" class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;display:none;">
      <?php
          $feature = \backend\models\Feature::find()->all();
          foreach ($feature as $row) {
              if (strtoupper($row->feature_name) == "GENDER") {
                $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                    foreach ($product_feature_value as $row) {
                        $checked = FALSE;
                        $genders_selection = [];
                        foreach($genders_selection as $gender){
                            if($row->feature_value_id == $gender){
                                $checked = TRUE;
                            }
                        }

              ?>
              <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
                <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-brand" name="gender">

                <div class="control__indicator"></div>
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
        <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
          <!-- Line Space -->
        </div>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:0;">
      <!-- Line Space -->
    </div>

    <!-- Watch Size -->
    <div class="filter-size-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-size')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Ukuran          
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-size-show" style="cursor: pointer;"><a onclick="filter_show('filter-size')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
    </div>
    <div class="filter-size-hide" style="cursor: pointer;display:none;">
        <a onclick="filter_hide('filter-size')">
          <div class="col-xs-10 clearleft clearright gotham-medium">         
                Ukuran          
           </div>
          <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
            <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
          </div> -->
       
            <div class="col-xs-2 artop-warranty filter-size-hide" style="display:none;cursor: pointer;"><a onclick="filter_hide('filter-size')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-ms-transform: rotate(180deg);-o-transform: rotate(180deg);transform: rotate(180deg);"></a></div>
           </a>
    </div>

    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    

    <div id="filter-size" class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;display:none;">
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
      <label class="control control--checkbox">26 - 30
        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data1; ?>" id="apply-filters-brand" name="size">

        <div class="control__indicator"></div>
      </label>
      <label class="control control--checkbox">32 - 36
        <input <?php echo $checked1 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data2; ?>" id="apply-filters-brand" name="size">

        <div class="control__indicator"></div>
      </label>
      <label class="control control--checkbox">38 - 40
        <input <?php echo $checked2 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data3; ?>" id="apply-filters-brand" name="size">

        <div class="control__indicator"></div>
      </label>
      <label class="control control--checkbox">41 - 47
        <input <?php echo $checked3 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data4; ?>" id="apply-filters-brand" name="size">

        <div class="control__indicator"></div>
      </label>

      <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
        <!-- Line Space -->
      </div>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:0;">
      <!-- Line Space -->
    </div>

    <!-- bandwidth -->
    <div class="filter-bandwidth-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-bandwidth')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Bandwidth          
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-bandwidth-show" style="cursor: pointer;"><a onclick="filter_show('filter-bandwidth')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
    </div>
    <div class="filter-bandwidth-hide" style="cursor: pointer;display:none;">
        <a onclick="filter_hide('filter-bandwidth')">
          <div class="col-xs-10 clearleft clearright gotham-medium">         
                Bandwidth          
           </div>
          <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
            <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
          </div> -->
       
            <div class="col-xs-2 artop-warranty filter-bandwidth-hide" style="display:none;cursor: pointer;"><a onclick="filter_hide('filter-bandwidth')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-ms-transform: rotate(180deg);-o-transform: rotate(180deg);transform: rotate(180deg);"></a></div>
           </a>
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    
    <div id="filter-bandwidth" class="col-xs-12 clearleft clearright" style="max-height: 250px;margin-bottom:20px;overflow-y: auto;display:none;">
      <?php
      $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 6])->all();
      foreach ($watches_size as $row) {
          $checked = FALSE;
          $bandwidth_selection = [];
          foreach($bandwidth_selection as $bandwidth){
              if($row->feature_value_id == $bandwidth){
                  $checked = TRUE;
              }
          }
          ?>

          <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
            <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-brand" name="bandwidth">

            <div class="control__indicator"></div>
          </label>


        <?php
      }
      ?>
      <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
        <!-- Line Space -->
      </div>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:0;">
      <!-- Line Space -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:0;">
      <!-- Line Space -->
    </div>

    <!-- MOVEMENT -->
    <div class="filter-movement-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-movement')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Movement          
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-movement-show" style="cursor: pointer;"><a onclick="filter_show('filter-movement')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
    </div>
    <div class="filter-movement-hide" style="cursor: pointer;display:none;">
        <a onclick="filter_hide('filter-movement')">
          <div class="col-xs-10 clearleft clearright gotham-medium">         
                Movement          
           </div>
          <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
            <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
          </div> -->
       
            <div class="col-xs-2 artop-warranty filter-movement-hide" style="display:none;cursor: pointer;"><a onclick="filter_hide('filter-movement')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-ms-transform: rotate(180deg);-o-transform: rotate(180deg);transform: rotate(180deg);"></a></div>
           </a>
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    
    <div id="filter-movement" class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;display:none;">
      <?php
        //$feature = \backend\models\Feature::find()->all();
        foreach ($feature as $row) {
            if (strtoupper($row->feature_name) == "MOVEMENT") {
            $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
              foreach ($product_feature_value as $row) {
                  $checked = FALSE;
                  $movements_selection = [];
                  foreach($movements_selection as $type){
                      if($row->feature_value_id == $type){
                          $checked = TRUE;
                      }
                  }
                  ?>

                  <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
                    <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-brand" name="movement">

                    <div class="control__indicator"></div>
                  </label>


            <?php
              }
            }
        ?>
        <?php
      }
      ?>
      <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
        <!-- Line Space -->
      </div>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:0;">
      <!-- Line Space -->
    </div>


    <!-- Water Resistant -->
    <div class="filter-water-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-water')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Water Resistant          
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-water-show" style="cursor: pointer;"><a onclick="filter_show('filter-water')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
    </div>
    <div class="filter-water-hide" style="cursor: pointer;display:none;">
        <a onclick="filter_hide('filter-water')">
          <div class="col-xs-10 clearleft clearright gotham-medium">         
                Water Resistant          
           </div>
          <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
            <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
          </div> -->
       
            <div class="col-xs-2 artop-warranty filter-water-hide" style="display:none;cursor: pointer;"><a onclick="filter_hide('filter-water')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png" style="-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-ms-transform: rotate(180deg);-o-transform: rotate(180deg);transform: rotate(180deg);"></a></div>
           </a>
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    

    <div id="filter-water" class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;display:none;">
      <?php
          $waterArr = array(3, 5, 8, 10, 20);
          foreach($waterArr as $feature){
              $feature_value_id = backend\models\ProductFeatureValue::find()->where(['feature_id' => 4 , 'feature_value_value'=>$feature])->one()->feature_value_id;
              $checked = FALSE;
              $waters_selection = [];
              foreach($waters_selection as $selection){
                  if($feature_value_id == $selection){
                      $checked = TRUE;
                  }
              }
      ?>

      <label class="control control--checkbox"><?php echo $feature . ' ATM'; ?>
        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="water" value="<?php echo $feature_value_id; ?>" id="apply-filters-brand" name="water">

        <div class="control__indicator"></div>
      </label>


    <?php } ?>
      <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
        <!-- Line Space -->
      </div>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:0;">
      <!-- Line Space -->
    </div>
    
    <?php } ?>

    <!-- PRICE -->
    <div class="filter-price-show" style="cursor: pointer;">
      <a onclick="filter_show('filter-price')">
        <div class="col-xs-10 clearleft clearright gotham-medium">         
              Harga       
         </div>
        <!-- <div class="col-xs-4 clearleft clearright" style="text-align:right;">
          <input style="background: transparent;border: none;padding-right:0px;" class="grey-font" type="reset" value="CLEAR" name="clear-brand" />
        </div> -->
        <div class="col-xs-2 ardown-warranty filter-price-show" style="cursor: pointer;"><a onclick="filter_show('filter-price')"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-yellow-filter.png"></a></div>

         </a>
    </div>
    <div class="filter-price-hide" style="cursor: pointer;display:none;">
        <a onclick="filter_hide('filter-price')">
          <div class="col-xs-10 clearleft clearright gotham-medium">         
                Harga    
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
        <input id="apply-filters-brand" type="radio" data-id="water" value="0-50000000" id="0-50000000" name="price" <?php echo $price_tampilkan==true ? 'checked' : '';?> >
        <div class="control__indicator"></div>
      </label>

      <label class="control control--radio">DI BAWAH 500K
        <input id="apply-filters-brand" type="radio" data-id="water" value="0-500000" id="0-500000" name="price" <?php echo $_GET['price']=='0--500000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 500K - IDR 1 M
        <input id="apply-filters-brand" type="radio" data-id="water" value="500000-1000000" id="500000-1000000" name="price" <?php echo $_GET['price']=='500000--1000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 1 M - IDR 2 M
        <input id="apply-filters-brand" type="radio" data-id="water" value="1000000-2000000" id="1000000-2000000" name="price" <?php echo $_GET['price']=='1000000--2000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 2 M - IDR 3 M
        <input id="apply-filters-brand" type="radio" data-id="water" value="2000000-3000000" id="2000000-3000000" name="price" <?php echo $_GET['price']=='2000000--3000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">DI ATAS IDR 3 M
        <input id="apply-filters-brand" type="radio" data-id="water" value="3000000-50000000" id="3000000-50000000" name="price" <?php echo $_GET['price']=='3000000--50000000' ? 'checked' : '';?>>
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
