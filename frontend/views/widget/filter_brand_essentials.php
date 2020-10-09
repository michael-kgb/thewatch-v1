
    <div class="container breadcrumb-page">
        <div class="row hidden-xs">
            <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page clearright">
                <a href="#" class="filter hidden-xs hidden-sm hidden-md" id="filter">
                    <span class="text-filter">FILTER</span>
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-white.png" id="down-white" style="display: inline;padding-right: 10%;float: right;padding-top: 6%;">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-black.png" id="down-black" style="display: none;padding-right: 10%;float: right;padding-top: 6%;">
                </a>
                <br>
                <div class="arrow-filter-all-product" id="arrow-filter"></div>
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
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="filter-brand title left brand">BRAND</div>
                                <div id="ex3" class="col-lg-12 filter-parent brand left scroll-custom" style="overflow:scroll;overflow-x: hidden;">
                                    <?php
                                    $category = backend\models\ProductCategory::findOne(['product_category_name' => "essentials"]);
                                    $brands = \backend\models\ProductCategoryBrands::find()
                                        ->joinWith([
                                            "brands"
                                        ])
                                        ->orderBy('brands.brand_name ASC')
                                        ->where(['product_category_category_id' => $category->product_category_id])
                                        ->all();
                                    $no = 4;
                                    foreach ($brands as $row) {
                                        ?>
                                        <div class="checkbox-btn">
                                            <input class="filter" type="checkbox" value="<?php echo $row->brands->link_rewrite; ?>" id="rc<?php echo $no; ?>" name="brands">
                                            <label for="rc<?php echo $no; ?>" onclick=""><?php echo $row->brands->brand_name; ?></label>
                                        </div>
                                        <?php
                                        $no++;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <?php
                                $feature = \backend\models\Feature::find()->all();
                                foreach ($feature as $row) {
                                    $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                                    if (strtoupper($row->feature_name) != 'SIZE' && strtoupper($row->feature_name) != 'BANDWIDTH' && strtoupper($row->feature_name) != 'WATER RESISTANT' && strtoupper($row->feature_name) != 'GENDER' && strtoupper($row->feature_name) != 'MOVEMENT') {
                                        ?>
                                            <div class="filter-brand title left brand"><?php echo strtoupper($row->feature_name); ?></div>
                                            <div class="col-lg-12 filter-parent brand left">
                                                <?php
                                                foreach ($product_feature_value as $roww) {
                                                    ?>
                                                    <div class="checkbox-btn lspace2">
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
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
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
                    <div class="row box-parent bottom">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-6 col-md-6 col-sm-6 right">
                                <input class="btn-clear" type="reset" value="CLEAR ALL" name="clear" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 left">
                                <input class="btn-apply" type="submit" id="apply-filter" value="APPLY" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- start mobile filter -->

        <div class="row hidden-lg hidden-md hidden-sm">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 breadcrumb-page">
                <a href="#" id="filter-mobile" class="filter">
                    <span class="text-filter">FILTER <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-white.png" id="down-white" style="padding-bottom: 2px;"></span>
                </a>
            </div>
        </div>

        <div class="hidden-lg hidden-md hidden-sm col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0; background: white; z-index: 10; overflow: auto" id="filter-content">
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
                        <span class="pull-right"><img class="arrow-down-filter-brands arrow-filter" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></span>
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