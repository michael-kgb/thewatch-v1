<style>



</style>
<?php
  $url = explode("/",$_SERVER['REQUEST_URI']);
  $urls = explode("?",$url[1]);
  $currentUrl = explode('?',$_SERVER[REQUEST_URI])[0];
  $currentAc = "//$_SERVER[HTTP_HOST]$currentUrl";

  // echo $urls[0];
  $sortby = 'none';
  if(isset($_GET['sortby'])){
    $sortby = $_GET['sortby'];
  }

?>
<input type="hidden" value="<?php echo $currentAc; ?>" id="apply-filters-promo-custom" name="breadcrumb_url">
<input type="hidden" value="<?php echo $sortby; ?>" id="apply-filters-promo-custom" name="sortby">
<input style="" class="grey-font" type="hidden" value="<?php echo $limit;?>" name="filter-limit" />

<!-- Kategori -->
<div class="hidden-xs col-lg-2 hidden-sm col-md-2" style="font-size:11px;font-family:gotham-light;letter-spacing:1px;">

    <div class="col-lg-6 col-md-6 col-sm-6 talign-left clearleft clearright">
      <span class="fcolorblue fsize-18 gotham-white"><i class="filter-blue-sprite mright10 hidden-md"></i>Filter</span>
          
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 breadcrumb-page clearleft clearright">
        <input style="border: none;" class="fcolor255 bgcolorprimary bradius20 pleft15 pright15 fsize-18 gotham-white" type="reset" value="Reset" name="clear" />
      
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 new-line talign-left clearleft clearright"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 new-line talign-left clearleft clearright"></div>
    <div class="col-xs-6 clearleft clearright gotham-medium">
      Kategori
    </div>
    <div class="col-xs-6 clearleft clearright" style="text-align:right;">
      
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
      <?php
      $feature = \backend\models\Feature::find()->all();
      foreach ($feature as $row) {
        if (strtoupper($row->feature_name) == "TYPE") {
          $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
          foreach ($product_feature_value as $row) {
              $checked = FALSE;
			  $types_selection = array();
              foreach($types_selection as $type){
                  if($row->feature_value_id == $type){
                      $checked = TRUE;
                  }
              }
        ?>
        <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
          <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-custom" name="type">

          <div class="control__indicator"></div>
        </label>
        <!-- <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 clearleft">
                <span class="pull-left" style="letter-spacing:1px;"><input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_value; ?>" id="apply-filters" name="type"> <label> <?php echo $row->feature_value_name; ?> </label></span>
            </div> -->
        <?php
          }
        }
    }
    ?>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>

    <!-- Gender -->
    <div class="col-xs-12 clearleft clearright gotham-medium">
      Gender
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
      <?php
          $feature = \backend\models\Feature::find()->all();
          foreach ($feature as $row) {
              if (strtoupper($row->feature_name) == "GENDER") {
                $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                    foreach ($product_feature_value as $row) {
                        $checked = FALSE;
						$genders_selection = array();
                        foreach($genders_selection as $gender){
                            if($row->feature_value_id == $gender){
                                $checked = TRUE;
                            }
                        }

              ?>
              <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
                <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-custom" name="gender">

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
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>


    <!-- Brand -->
    <div class="col-xs-12 clearleft clearright gotham-medium">
      Brand
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
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
			  $brands_selection = array();
              foreach($brands_selection as $brand){
                  if($row->brand_id == $brand){
                      $checked = TRUE;
                  }
              }
              ?>
              <label class="control control--checkbox"><?php echo $row->brand_name; ?>
                <input id="apply-filters-promo-custom" <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" name="brands" value="<?php echo $row->brand_id; ?>"/>

                <div class="control__indicator"></div>
              </label>

              <!-- <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 clearleft clearright">
                  <span class="pull-left" style="letter-spacing:1px;"><input id="apply-filters-promo-custom" <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" name="brands" value="<?php echo $row->link_rewrite; ?>"/> <label for="" onclick=""><?php echo $row->brand_name; ?></label></span>
              </div> -->

      <?php
      }
      ?>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>

    <!-- Watch Size -->
    <div class="col-xs-12 clearleft clearright gotham-medium">
      Watch Size
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
      <?php
      $checked = false;$checked1 = false;$checked2 = false;$checked3 = false;
      $ss = 0;
      $feature_value_id1 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>26])->one()->feature_value_id;
      $feature_value_id2 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>32])->one()->feature_value_id;
      $feature_value_id3 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>38])->one()->feature_value_id;
      $feature_value_id4 = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5 , 'feature_value_value'=>41])->one()->feature_value_id;

	  $size_selection = array();
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
        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data1; ?>" id="apply-filters-promo-custom" name="size">

        <div class="control__indicator"></div>
      </label>
      <label class="control control--checkbox">32 - 36
        <input <?php echo $checked1 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data2; ?>" id="apply-filters-promo-custom" name="size">

        <div class="control__indicator"></div>
      </label>
      <label class="control control--checkbox">38 - 40
        <input <?php echo $checked2 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data3; ?>" id="apply-filters-promo-custom" name="size">

        <div class="control__indicator"></div>
      </label>
      <label class="control control--checkbox">41 - 47
        <input <?php echo $checked3 ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $data4; ?>" id="apply-filters-promo-custom" name="size">

        <div class="control__indicator"></div>
      </label>


    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>

    <!-- bandwidth -->
    <div class="col-xs-12 clearleft clearright gotham-medium">
      Bandwidth
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
      <?php
      $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 6])->all();
      foreach ($watches_size as $row) {
          $checked = FALSE;
		  $bandwidth_selection = array();
          foreach($bandwidth_selection as $bandwidth){
              if($row->feature_value_id == $bandwidth){
                  $checked = TRUE;
              }
          }
          ?>

          <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
            <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-custom" name="bandwidth">

            <div class="control__indicator"></div>
          </label>


        <?php
      }
      ?>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>

    <!-- MOVEMENT -->
    <div class="col-xs-12 clearleft clearright gotham-medium">
      Movement
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
      <?php
        //$feature = \backend\models\Feature::find()->all();
        foreach ($feature as $row) {
            if (strtoupper($row->feature_name) == "MOVEMENT") {
            $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
              foreach ($product_feature_value as $row) {
                  $checked = FALSE;
				  $movements_selection = array();
                  foreach($movements_selection as $type){
                      if($row->feature_value_id == $type){
                          $checked = TRUE;
                      }
                  }
                  ?>

                  <label class="control control--checkbox"><?php echo $row->feature_value_name; ?>
                    <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_id; ?>" id="apply-filters-promo-custom" name="movement">

                    <div class="control__indicator"></div>
                  </label>


            <?php
              }
            }
        ?>
        <?php
      }
      ?>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>


    <!-- Water Resistant -->
    <div class="col-xs-12 clearleft clearright gotham-medium">
      Water Resistant
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
      <?php
          $waterArr = array(3, 5, 8, 10, 20);
          foreach($waterArr as $feature){
              $feature_value_id = backend\models\ProductFeatureValue::find()->where(['feature_id' => 4 , 'feature_value_value'=>$feature])->one()->feature_value_id;
              $checked = FALSE;
			  $waters_selection = array();
              foreach($waters_selection as $selection){
                  if($feature_value_id == $selection){
                      $checked = TRUE;
                  }
              }
      ?>

      <label class="control control--checkbox"><?php echo $feature . ' ATM'; ?>
        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="water" value="<?php echo $feature_value_id; ?>" id="apply-filters-promo-custom" name="water">

        <div class="control__indicator"></div>
      </label>


    <?php } ?>
    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>


    <!-- PRICE -->
    <div class="col-xs-6 clearleft clearright gotham-medium">
      Price
    </div>
    <div class="col-xs-6 clearleft clearright" style="text-align:right;">
      <input style="background: transparent;border: none;" class="grey-font" type="reset" value="CLEAR" name="clear-promo" />
    </div>
    <div class="col-xs-12 clearleft clearright" style="border-bottom:solid 1px #a8a9ad;margin-top:10px;margin-bottom:10px;">
      <!-- Border 1px -->
    </div>
    <div class="col-xs-12 clearleft clearright" style="max-height: 250px;overflow-y: auto;">
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
        <input id="apply-filters-promo-custom" type="radio" data-id="water" value="0-50000000" id="0-50000000" name="price" <?php echo $price_tampilkan==true ? 'checked' : '';?> >
        <div class="control__indicator"></div>
      </label>

      <label class="control control--radio">DI BAWAH 500K
        <input id="apply-filters-promo-custom" type="radio" data-id="water" value="0-500000" id="0-500000" name="price" <?php echo $_GET['price']=='0--500000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 500K - IDR 1 M
        <input id="apply-filters-promo-custom" type="radio" data-id="water" value="500000-1000000" id="500000-1000000" name="price" <?php echo $_GET['price']=='500000--1000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 1 M - IDR 2 M
        <input id="apply-filters-promo-custom" type="radio" data-id="water" value="1000000-2000000" id="1000000-2000000" name="price" <?php echo $_GET['price']=='1000000--2000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">IDR 2 M - IDR 3 M
        <input id="apply-filters-promo-custom" type="radio" data-id="water" value="2000000-3000000" id="2000000-3000000" name="price" <?php echo $_GET['price']=='2000000--3000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">DI ATAS IDR 3 M
        <input id="apply-filters-promo-custom" type="radio" data-id="water" value="3000000-50000000" id="3000000-50000000" name="price" <?php echo $_GET['price']=='3000000--50000000' ? 'checked' : '';?>>
        <div class="control__indicator"></div>
      </label>



    </div>
    <div class="col-xs-12 clearleft clearright" style="padding-top:20px;">
      <!-- Line Space -->
    </div>

    <div class="row box-filter-bottom">
        <div class="col-lg-12 col-md-12 col-sm-12" style="min-height:200px;padding-top: 30px;">


        </div>
    </div>

</div>
