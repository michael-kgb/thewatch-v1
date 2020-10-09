<section id="all-brands">
    <div class="container breadcrumb-page">

        <div class="row hidden-xs hidden-sm hidden-md">
            
                <a href="#" class="filter" id="filter">
                    <span class="text-filter">FILTER</span>
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-white.png" id="down-white" style="display: inline;padding-right: 10%;float: right;padding-top: 6%;">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-black.png" id="down-black" style="display: none;padding-right: 10%;float: right;padding-top: 6%;">
                </a>
            <br>
            <div class="arrow-filter" id="arrow-filter"></div>
            <div class="hidden-xs filter-box-all-product" id="box-filter">
                <div class="row box-parent">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-4 filter-parent right">
                            <div class="radio-btn">
                                <input type="radio" value="all-product" id="rc1" name="sort" checked>
                                <label for="rc1" onclick="">ALL PRODUCTS</label>
                            </div>
                        </div>
                        <div class="col-lg-4 filter-parent center">
                            <div class="radio-btn">
                                <input type="radio" value="new-arrival" id="rc2" name="sort">
                                <label for="rc2" onclick="">NEW ARRIVAL</label>
                            </div>
                        </div>
                        <div class="col-lg-4 filter-parent left">
                            <div class="radio-btn">
                                <input type="radio" value="sale" id="rc3" name="sort">
                                <label for="rc3" onclick="">SALE</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="filter-brand title left brand">FILTER BY BRANDS</div>
                            <div id="ex3" class="col-lg-2 filter-parent brand left" style="overflow-x: hidden;width:20%;">
                                <?php
                               
                                $brands = \backend\models\ProductCategoryBrands::find()
                                    ->joinWith([
                                        "brands"
                                    ])
                                    ->orderBy('brands.brand_name ASC')
                                    ->where(['product_category_category_id' => $category->product_category_id])
                                    ->all();
                                $no = 4;
                                $loop = 0;
                                foreach ($brands as $row) {
                                    ?>
                                    <div class="checkbox-btn filter-desktop lspace2">
                                        <?php  
                                        $checked = FALSE;
                                        foreach($brands_selection as $brand){
                                            if($row->brands->link_rewrite == $brand){
                                                $checked = TRUE;
                                            }
                                        }
                                        ?>
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> class="filter" type="checkbox" value="<?php echo $row->brands->link_rewrite; ?>" id="rc<?php echo $no; ?>" name="brands">
                                        <label for="rc<?php echo $no; ?>" onclick=""><?php echo $row->brands->brand_name; ?></label>
                                    </div>
                                    <?php
                                    $no++;$loop++;

                                    if($loop == 7){
                                        $loop = 0;
                                        
                                       echo "</div><div id='ex3' class='col-lg-2 filter-parent brand left' style='overflow-x: hidden;width:20%;'>";
                                       
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php if(($breadcrumbs[0] != 'straps') && ($breadcrumbs[0] != 'accessories')){ ?>
                         <div class="col-lg-3 col-md-3 col-sm-3">
                            
                            <div class="filter-brand title left brand">FILTER BY WATCH SIZE</div>
                            <div class="col-lg-12 filter-parent brand left">
                                <?php
                                $checked = false;
                                $checked1 = false;
                                $checked2 = false;
                                $checked3 = false;
                                $ss = 0;
                                while($ss < sizeof($size_selection)){
                                    if($size_selection[$ss] == 26){
                                        $checked = true;
                                    }
                                    if($size_selection[$ss] == 32){
                                        $checked1 = true;
                                    }
                                    if($size_selection[$ss] == 38){
                                        $checked2 = true;
                                    }
                                    if($size_selection[$ss] == 41){
                                        $checked3 = true;
                                    }
                                    $ss = $ss+2;
                                }
                                
                                
                            ?>
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn filter-desktop lspace2">
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="26--30" id="26" name="filter_size">
                                        <label for="26" onclick="">26 - 30</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn filter-desktop lspace2">
                                        <input <?php echo $checked1 ? "checked='checked'" : ""; ?> type="checkbox" value="32--36" id="32" name="filter_size">
                                        <label for="32" onclick="">32 - 36</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn filter-desktop lspace2">
                                        <input <?php echo $checked2 ? "checked='checked'" : ""; ?> type="checkbox" value="38--40" id="38" name="filter_size">
                                        <label for="38" onclick="">38 - 40</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="checkbox-btn filter-desktop lspace2">
                                        <input <?php echo $checked3 ? "checked='checked'" : ""; ?> type="checkbox" value="41--47" id="41" name="filter_size">
                                        <label for="41" onclick="">41 - 47</label>
                                    </div>
                                </div>
                            </div>
                            
                            </div>
                            <?php } ?>
                            <?php if($breadcrumbs[0] != 'accessories'){ ?>
                           <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <div class="filter-brand title left brand">BANDWIDTH</div>
                                <div class="col-lg-2 filter-parent brand left">
                                    <?php
                                    $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 6])->all();
                                    $loop = 0;
                                    foreach ($watches_size as $row) {
                                        $checked = FALSE;
                                        foreach($bandwidth_selection as $bandwidth){
                                            if($row->feature_value_value == $bandwidth){
                                                $checked = TRUE;
                                            }
                                        }
                                        ?>
                                        <div class="col-lg-12 filter-parent">
                                            <div class="checkbox-btn filter-desktop lspace2">
                                                <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $row->feature_value_value; ?>" id="bd<?php echo $row->feature_value_value; ?>" name="filter_bandwidth">
                                                <label for="bd<?php echo $row->feature_value_value; ?>" onclick=""><?php echo $row->feature_value_name; ?></label>
                                            </div>
                                        </div>
                                        <?php

                                        $loop++;

                                        if($loop == 4){
                                            $loop = 0;
                                            
                                           echo "</div><div class='col-lg-2 col-md-2 col-sm-2 filter-parent brand left'>";
                                           
                                        }
                                    }
                                    ?>
                                </div>
                            </div> 
                            <?php } ?>
                        <?php if(($breadcrumbs[0] != 'straps') && ($breadcrumbs[0] != 'accessories')){ ?>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">WATER RESISTANT</div>
                            <div class="col-lg-6 filter-parent brand left">
                                <?php 
                                    $waterArr = array(3, 5, 8, 10, 20);
                                    $loop = 0;
                                    foreach($waterArr as $feature){
                                        $checked = FALSE;
                                        foreach($waters_selection as $selection){
                                            if($feature . '-atm' == $selection){
                                                $checked = TRUE;
                                            }
                                        }
                                ?>
                                <div class="checkbox-btn filter-desktop lspace2">
                                    <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="water" value="<?php echo $feature . '-atm'; ?>" id="<?php echo $feature . '-atm'; ?>" name="category">
                                    <label for="<?php echo $feature . '-atm'; ?>" onclick=""><?php echo $feature . ' ATM'; ?></label>
                                </div>
                                    <?php
                                    $loop++;

                                        if($loop == 4){
                                            $loop = 0;
                                            
                                           echo "</div><div class='col-lg-6 filter-parent brand left'>";
                                           
                                        }

                                     } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="clearfix"></div>
                                                   <?php
                        $feature = \backend\models\Feature::find()->all();
                        foreach ($feature as $row) {
                            $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                            if (strtoupper($row->feature_name) != 'SIZE' && strtoupper($row->feature_name) != 'BANDWIDTH' && strtoupper($row->feature_name) != 'WATER RESISTANT') {
                                if (strtoupper($row->feature_name) == 'MOVEMENT' && $breadcrumbs[0] != 'watches'){
                                    
                                } else {
                                ?>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <div class="filter-brand title left brand"><?php echo strtoupper($row->feature_name); ?></div>
                                    <div class="col-lg-12 filter-parent brand left">
                                        <?php
                                        foreach ($product_feature_value as $roww) {
                                            ?>
                                            <div class="checkbox-btn filter-desktop lspace2">
                                                <?php 
                                                $checked = FALSE;
                                                if($row->feature_name == 'Gender'){
                                                    foreach($genders_selection as $selection){
                                                        if(strtolower(str_replace(' ', '-', $roww->feature_value_name)) == $selection){
                                                            $checked = TRUE;
                                                        }
                                                    }
                                                }
                                                else if($row->feature_name == 'Type'){
                                                    foreach($types_selection as $selection){
                                                        if(strtolower(str_replace(' ', '-', $roww->feature_value_name)) == $selection){
                                                            $checked = TRUE;
                                                        }
                                                    }
                                                }
                                                else if($row->feature_name == 'Movement'){
                                                    foreach($movements_selection as $selection){
                                                        if(strtolower(str_replace(' ', '-', $roww->feature_value_name)) == $selection){
                                                            $checked = TRUE;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="<?php echo explode(' ', strtolower(trim($row->feature_name)))[0]; ?>" value="<?php echo strtolower(str_replace(' ', '-', $roww->feature_value_name)); ?>" id="rc<?php echo $no; ?>" name="category">
                                                <label for="rc<?php echo $no; ?>" onclick=""><?php echo $roww->feature_value_name; ?></label>
                                            </div>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                }
                            }
                        }
                        ?>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <?php 
                            if(count($price_selection) > 0){
                            ?>
                            <div class="filter-brand title left brand">PRICE</div>
                            <div class="filter-brand title left brand" style="border-bottom: 0px; padding-top: 2%;">
                                <input id="foo" type="text" class="span2" value="" data-slider-handle="triangle" data-slider-min="300000" data-slider-max="15000000" data-slider-step="10000" data-slider-value="[<?php echo str_replace(".", "", $price_selection[0]); ?>,<?php echo str_replace(".", "", $price_selection[1]); ?>]"/>
                                <div style="font-family: gotham-light; padding-top: 13%;">
                                    <div id="bar-left" class="pull-left"><?php echo $price_selection[0]; ?></div>
                                    <div id="bar-right" class="pull-right"><?php echo $price_selection[1]; ?></div>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="filter-brand title left brand">PRICE</div>
                            <div class="filter-brand title left brand" style="border-bottom: 0px; padding-top: 2%;">
                                <input id="foo" type="text" class="span2" value="" data-slider-handle="triangle" data-slider-min="300000" data-slider-max="15000000" data-slider-step="10000" data-slider-value="[300000,15000000]"/>
                                <div style="font-family: gotham-light; padding-top: 13%;">
                                    <div id="bar-left" class="pull-left">300.000</div>
                                    <div id="bar-right" class="pull-right">15.000.000</div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row box-filter-bottom">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="height:50px;padding-top: 30px;">
                        <div class="col-lg-6 col-md-6 col-sm-6 right clearleft clearright apply-filter">
                            <input class="btn-apply" type="submit" id="apply-filter" value="APPLY FILTER" />
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 left clearleft clearright clear-filter">
                            <input class="btn-clear" type="reset" value="CLEAR FILTER" name="clear" />
                        </div>
                    </div>
                </div>
            </div>
            <?php // ActiveForm::end(); ?>
        </div>

        <!-- start mobile filter -->
        <div class="row hidden-lg">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 breadcrumb-page">
                <a href="#" id="filter-mobile" class="filter">
                    <span class="text-filter">FILTER <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-white.png" id="down-white" style="padding-bottom: 2px;"></span>
                </a>
            </div>
        </div>

        <div class="hidden-lg hidden-md col-sm-12 col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; background: white; z-index: 10; overflow: auto" id="filter-content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 45px;">
                <span class="pull-left">FILTER</span>
                <span class="pull-right">
                    <a href="#" id="close-filter-mobile">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 5px; width: 25%">
                    </a>
                </span>
                <div class="clearfix"></div>
                <div class="border-bottom-1"></div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <span class="pull-left">ALL PRODUCTS</span>
                    <span class="pull-right">
                        <input id="all-product-mobile" type="radio" name="sort_mobile" value="all-product" checked/>
                    </span>
                </div>
                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <span class="pull-left">NEW ARRIVAL</span>
                    <span class="pull-right"><input type="radio" value="new-arrival" name="sort_mobile"/></span>
                </div>
                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <span class="pull-left">SALE</span>
                    <span class="pull-right"><input type="radio" value="sale" name="sort_mobile"/></span>
                </div>

                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <div class="col-xs-12 remove-padding" onclick="slidedown_filter('filter-brands')">
                        <span class="pull-left">BRANDS</span>
                        <span class="pull-right"><img class="arrow-down-filter-brands arrow-filter ipad" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div id="list-filter-brands" class="col-xs-12 text-left margin-top-3 non-active brands-filter" style="display: none; min-width: 100px; max-height: 200px; overflow: auto;">
                        <?php
                        foreach ($brands as $row) {
                            ?>
                            <div class="col-xs-12 remove-padding-right padding-bottom-2">
                                <input type="checkbox" name="brands_mobile" value="<?php echo $row->brands->link_rewrite; ?>"/> <?php echo $row->brands->brand_name; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <div class="col-xs-12 remove-padding" onclick="slidedown_filter('filter-size')">
                        <span class="pull-left">WATCH SIZE</span>
                        <span class="pull-right"><img class="arrow-down-filter-size arrow-filter" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div id="list-filter-size" class="col-xs-12 text-left margin-top-3 non-active brands-filter" style="display: none; min-width: 100px; max-height: 200px; overflow: auto;">
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="radio" name="size_mobile" value="26--30"/> 26 - 30
                        </div>
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="radio" name="size_mobile" value="32--36"/> 32 - 36
                        </div>
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="radio" name="size_mobile" value="38--40"/> 38 - 40
                        </div>
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="radio" name="size_mobile" value="41--47"/> 41 - 47
                        </div>
                    </div>
                </div>

                <?php
                foreach ($feature as $row) {
                    if (strtoupper($row->feature_name) == "SIZE" || strtoupper($row->feature_name) == "LUG SIZE") {
                        continue;
                    }
                    $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                    ?>
                    <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                        <div class="col-xs-12 remove-padding" onclick="slidedown_filter('filter-<?php echo str_replace(" ", "-", $row->feature_name); ?>')">
                            <span class="pull-left"><?php echo strtoupper($row->feature_name); ?></span>
                            <span class="pull-right"><img class="arrow-down-filter-<?php echo str_replace(" ", "-", $row->feature_name); ?> arrow-filter" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></span>
                        </div>
                        <div class="clearfix"></div>
                        <div id="list-filter-<?php echo str_replace(" ", "-", $row->feature_name); ?>" class="col-xs-12 text-left margin-top-3 non-active brands-filter" style="display: none; min-height: 100px; max-height: 200px; overflow: auto;">
                            <?php
                            foreach ($product_feature_value as $roww) {
                                ?>
                                <div class="col-xs-12 remove-padding-right padding-bottom-2">
                                    <input type="checkbox" name="category_mobile" data-id="<?php echo explode(' ', strtolower(trim($row->feature_name)))[0]; ?>" value="<?php echo $roww->feature_value_name; ?>"/> <?php echo $roww->feature_value_name; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <div class="col-xs-12 remove-padding" onclick="slidedown_filter('filter-price')">
                        <span class="pull-left">PRICE</span>
                        <span class="pull-right"><img class="arrow-down-filter-price arrow-filter" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div id="list-filter-price" class="col-xs-12 text-left margin-top-3 non-active brands-filter" style="display: none; min-width: 100px; max-height: 200px; overflow: auto;">
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="radio" name="price_mobile"/> x - x
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 margin-top-5 remove-padding">
                    <span class="pull-left text-underline text-gotham-medium" onclick="clear_filter_mobile()">CLEAR ALL</span>
                    <span class="pull-right text-underline text-gotham-medium" onclick="filter_mobile()">APPLY</span>
                </div>
            </div>
        </div>

        <!-- end of mobile filter -->

    </div>
</section>