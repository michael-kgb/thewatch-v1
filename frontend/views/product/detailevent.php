<?php

use app\assets\ProductDetailAsset;

ProductDetailAsset::register($this);

$breadcrumbs = $this->context->breadcrumb;
//echo Yii::$app->view->renderFile('@app/views/widget/breadcrumb.php');
?>

<script>
var currentCategory = '<?php echo $breadcrumbs[0]; ?>';
var currentAction = '';
</script>

<?php if($breadcrumbs[0] == "watches" || $breadcrumbs[0] == "straps" || $breadcrumbs[0] == "accessories" || $breadcrumbs[0] == "jewelry"){ ?>
<section id="breadcrumb">
    <div class="container breadcrumb-page">
        <div class="row hidden-xs">
            <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page clearright clearleft">
                
                <div class="hidden-lg hidden-xs col-sm-12 col-md-12" style="padding-top:20px;"></div>    
                <div class="hidden-lg hidden-xs col-sm-12 col-md-12" style="padding-top:20px;"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="">
                <?php
                $breadcrumbs = $this->context->breadcrumb;
                if (count($breadcrumbs) > 0) {
                    $i = 0;
                    $len = count($breadcrumbs);
                    foreach ($breadcrumbs as $breadcrumb) {
                        ?>
                        <a href="#" <?php echo $i == 0 ? 'class=""' : ''; ?>><?php echo strtoupper($breadcrumb); ?></a>
                        <?php if ($i != $len - 1) { ?>
                            <span>/</span>
                        <?php } ?>
                        <?php $i++; ?>
                    <?php } ?>
                <?php } ?>
                </div>
                <div class="hidden-lg hidden-xs col-sm-12 col-md-12" style="padding-top:40px;"></div>
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
                                    $category = backend\models\ProductCategory::findOne(['product_category_name' => $breadcrumbs[0]]);
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
                                <?php if($breadcrumbs[0] != 'straps'){ ?>
                                <div class="filter-brand title left brand">WATCH SIZE</div>
                                <div class="col-lg-12 filter-parent brand left">
                                    <div class="col-lg-12 filter-parent">
                                        <div class="radio-btn lspace2">
                                            <input <?php echo isset($_GET['size']) && $_GET['size'] == '26--30' ? 'checked="checked"' : ''; ?> type="radio" value="26--30" id="26" name="filter_size">
                                            <label for="26" onclick="">26 - 30</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 filter-parent">
                                        <div class="radio-btn lspace2">
                                            <input <?php echo isset($_GET['size']) && $_GET['size'] == '32--36' ? 'checked="checked"' : ''; ?> type="radio" value="32--36" id="32" name="filter_size">
                                            <label for="32" onclick="">32 - 36</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 filter-parent">
                                        <div class="radio-btn lspace2">
                                            <input <?php echo isset($_GET['size']) && $_GET['size'] == '38--40' ? 'checked="checked"' : ''; ?> type="radio" value="38--40" id="38" name="filter_size">
                                            <label for="38" onclick="">38 - 40</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 filter-parent">
                                        <div class="radio-btn lspace2">
                                            <input <?php echo isset($_GET['size']) && $_GET['size'] == '41--47' ? 'checked="checked"' : ''; ?> type="radio" value="41--47" id="41" name="filter_size">
                                            <label for="41" onclick="">41 - 47</label>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                                <div class="filter-brand title left brand">BANDWIDTH</div>
                                <div class="col-lg-12 filter-parent brand left">
                                    <?php
                                    $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 6])->all();
                                    foreach ($watches_size as $row) {
                                        $checked = FALSE;
                                        foreach($bandwidth_selection as $bandwidth){
                                            if($row->feature_value_value == $bandwidth){
                                                $checked = TRUE;
                                            }
                                        }
                                        ?>
                                        <div class="col-lg-12 filter-parent">
                                            <div class="radio-btn lspace2">
                                                <input <?php echo $checked ? "checked='checked'" : ""; ?> type="radio" value="<?php echo $row->feature_value_value; ?>" id="bd<?php echo $row->feature_value_value; ?>" name="filter_bandwidth">
                                                <label for="bd<?php echo $row->feature_value_value; ?>" onclick=""><?php echo $row->feature_value_name; ?></label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            $feature = \backend\models\Feature::find()->all();
                            foreach ($feature as $row) {
                                $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                                if (strtoupper($row->feature_name) != 'SIZE' && strtoupper($row->feature_name) != 'BANDWIDTH' && strtoupper($row->feature_name) != 'WATER RESISTANT') {
                                    if (strtoupper($row->feature_name) == 'MOVEMENT' && $breadcrumbs[0] == 'straps'){

                                    } else {
                                    ?>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
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
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <?php if($breadcrumbs[0] != 'straps'){ ?>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="filter-brand title left brand">WATER RESISTANT</div>
                                <div class="col-lg-12 filter-parent brand left">
                                    <?php 
                                        $waterArr = array(3, 5, 8, 10, 20);
                                        foreach($waterArr as $feature){
                                            $checked = FALSE;
                                            foreach($waters_selection as $selection){
                                                if($feature . '-atm' == $selection){
                                                    $checked = TRUE;
                                                }
                                            }
                                    ?>
                                    <div class="checkbox-btn lspace2">
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="water" value="<?php echo $feature . '-atm'; ?>" id="<?php echo $feature . '-atm'; ?>" name="category">
                                        <label for="<?php echo $feature . '-atm'; ?>" onclick=""><?php echo $feature . ' ATM'; ?></label>
                                    </div>
                                        <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
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
                                <input class="btn-clear" type="reset" value="CLEAR" name="clear" />
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

            <div class="col-xs-12 margin-bottom-5" style="font-size: 12px; letter-spacing: 0.05em">
                <?php
                $breadcrumbs = $this->context->breadcrumb;
                if (count($breadcrumbs) > 0) {
                    $i = 0;
                    $len = count($breadcrumbs);
                    foreach ($breadcrumbs as $breadcrumb) {
                        ?>
                        <a href="#"><?php echo strtoupper($breadcrumb); ?></a>
                        <?php if ($i != $len - 1) { ?>
                            <span>/</span>
                        <?php } ?>
                        <?php $i++; ?>
                    <?php } ?>
                <?php } ?>
            </div>


        </div>



        <!-- end of mobile filter -->
</section>
<?php } else { ?>
<?php echo Yii::$app->view->renderFile('@app/views/widget/filter_essentials.php', array("breadcrumbs" => $breadcrumbs)); ?>
<?php } ?>

<section id="product-details">
    <div class="container clearleft clearright">
        <?php if (count($productImages) > 6) { ?>
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
                <div class="btn-prev"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-top-black.png" style="cursor: pointer; width: 25px;margin-left: 19px;padding-bottom: 5px;"></div>
            </div>
            <div class="clearfix"></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs pright5-ipad">
                <?php if (count($productImages) > 0) { ?>

                    <div class="col-lg-2 col-md-2 col-sm-3 thumbnail-product clearleft clearright" id="product-thumb">
                        <!--                        <div id="jcl-demo">-->
                        <div class="custom-container vertical">
                            <div class="carousel">
                                <ul id="thumb-small">
                                    <?php foreach ($productImages as $image) { ?>
                                        <?php
                                        $productAttributeImage = \backend\models\ProductAttributeImage::find()
                                                ->joinWith("productAttributeCombination")
                                                ->where(["product_image_id" => $image->product_image_id])
                                                ->all();

                                        $attributeId = 0;
                                        if (count($productAttributeImage) > 0) {
                                            foreach($productAttributeImage as $rows){
                                                if($rows->productAttributeCombination->attribute_value_id){
                                                    $attributeId = $rows->productAttributeCombination->attribute_value_id;
                                                }
                                            }
                                        }
                                        ?>
                                        <li class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" data-zoom-image="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg">
                                            <a href="#" class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo Yii::$app->params['cloudfrontDev'] ?>/img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" data-zoom-image="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg">
                                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_small.jpg" class="img-responsive">
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!--                        </div>-->
                        <?php if (count($productImages) > 6) { ?>
                            <div class="btn-next"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-black.png" style="cursor: pointer; width: 25px;margin-left: 19px;padding-bottom: 5px;"></div>
                        <?php } ?>
                    </div>

                    <?php foreach ($productImages as $image) { ?>
                        <?php if ($image->cover == 1) { ?>
                            <div class="col-lg-10 col-md-10 col-sm-9 clearleft-ipad clearleft">
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" id="product-img" data-zoom-image="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" class="img-responsive">
                            </div>
                            <?php
                            break;
                        }
                        ?>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 hidden-lg hidden-md hidden-sm">
                <header id="myCarousel" class="carousel slide brand" style="margin-top: 0px;">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php $i = 0; ?>
                        <?php if (count($productImages) > 0) { ?>
                            <?php foreach ($productImages as $banner) { ?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>"></li>
                                <?php $i++; ?>
                            <?php } ?>
                        <?php } ?>
                    </ol>

                    <!-- Wrapper for Slides -->
                    <div class="carousel-inner">
                        <?php $i = 1; ?>
                        <?php if (count($productImages) > 0) { ?>
                            <?php foreach ($productImages as $banner) { ?>
                                <div class="item <?php echo $i === 1 ? 'active' : ''; ?>">
                                    <img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $banner->product_image_id . '/' . $banner->product_image_id . "_big.jpg"; ?>" class="img-responsive">
                                    <!--<div class="fill" style="background-image: url(<?php // echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php // echo $banner->product_image_id . '/' . $banner->product_image_id . "_big.jpg"; ?>);"></div>-->
                                </div>
                                <?php $i++; ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </header>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft-ipad">
                <div class="hidden-lg hidden-md hidden-sm" style="padding:10px;"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail brand-name-new brand clearleft-mobile clearright-mobile">
                    <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/brand/' . strtolower(str_replace(' ', '-', $product->brands->brand_name)); ?>" target="_blank" style="color:#a8a9ad;">
                        <?php echo strtoupper($product->brands->brand_name); ?>
                    </a>
                    <input type="hidden" name="brand_name" value="<?php echo $product->brands->brand_name; ?>">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                    <span><?php echo strtoupper($product->productDetail->name); ?></span>
					<input type="hidden" name="product_name" value="<?php echo $product->productDetail->name; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                    <input type="hidden" name="link-rewrite" value="<?php echo $product->productDetail->link_rewrite; ?>">
                </div>
                
                <!-- <div class="col-lg-12 hidden-md hidden-sm col-xs-12 product-detail border"></div> -->
                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail brand-name price">
                    PRICE
                </div> -->
                <?php
                // if product has discount
                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                $discount = 0;
                $now = date('Y-m-d H:i:s');
                if ($spesificPrice != null) {
                    ?>
                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                            IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                            <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                            <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                            <?php
                            if ($spesificPrice->reduction_type == 'percent') {
                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                $discount = $spesificPrice->reduction;
                            }
                            ?>
                            IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>
                            <span class="discount-price mleft2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
                            <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                            <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                        </div>



                    <?php } ?>
                <?php } else { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                        IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                        <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                        <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                        <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                    </div>
                <?php } ?>

                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 product-detail product-total">
                    Total
                    <span id="loadingAjax" style="display: none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/loading-ajax.gif"></span>
                    <span class="product-total">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?></span>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail border"></div>
                <div class="hidden-lg hidden-md hidden-sm" style="padding:45px;"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-select">
                    <?php $productStock = \backend\models\ProductStock::findOne(["product_id" => $id]); ?>
                    <?php $productAttribute = \backend\models\ProductAttribute::find()->where(["product_id" => $id])->all(); ?>
                    <?php
                        $prod_att_id = [];
                        $prod_att_i = '';
                        foreach ($productAttribute as $row) {
                            $prod_att_id[] = $row->product_attribute_id;
                            $prod_att_i = $row->product_attribute_id.'+'.$prod_att_i;
                        }
                        // print_r($prod_att_id);
                    ?>

                    <?php if (count($productAttributeCombination) > 0) { ?>
                        <?php $productStock = \backend\models\ProductStock::find()->where(["product_id" => $id])->andWhere(['<>', 'product_attribute_id', 0])->one(); ?>
                        <?php   $tt = 1;$jj = 1;$prodattcomb=[];
                                foreach ($productAttributeCombination as $attribute) {
                                    if($attribute->attribute_id_2 != 0){
                                      $totalval2 = $tt;
                                      $tt = $tt +1; 
                                    }
                                    if($attribute->attribute_id != 0){
                                      $totalval = $jj;
                                      $jj = $jj +1; 
                                    }
                                   
                                
                            } 
                                // echo $totalval2.$totalval;
                           

                            $prodattcomb = \backend\models\ProductAttributeCombination::find()->where(["product_attribute_id" => $prod_att_id])->distinct(['attribute_id'])->all();
                             $prodattcomb2 = \backend\models\ProductAttributeCombination::find()->where(["product_attribute_id" => $prod_att_id])->groupBy(['attribute_id'])->all();
                        ?>


                        <select id="size" class="size margin-bottom-5 fleft" name="size" <?php if($totalval != 0){echo 'disabled="disabled"';}?>>
                            <option value="0">Ukuran</option>
                            <?php foreach ($productAttributeCombination as $attribute) { ?>
                                <?php if($attribute->attribute_id_2 != 0){
                                    ?>
                                    <option attrId="<?php echo $attribute->product_attribute_id; ?>" attributeId="<?php echo $prod_att_i; ?>" id="<?php echo $attribute->attributeValue2->value; ?>" value="<?php echo $attribute->attributeValue->attribute_value_id.'+'.$attribute->attributeValue2->attribute_value_id; ?>"><?php echo $attribute->attributeValue2->value; ?></option>
                                    <?php
                                } ?>
                                
                            <?php } ?>
                        </select>


                        <select class="color margin-bottom-5" name="color" <?php if($totalval == 0 && $totalval2 != 0){echo 'disabled="disabled"';}?>>
                            <option value="0">Warna</option>
                            <?php foreach ($prodattcomb as $attribute) { ?>
                                <option attrId="<?php echo $attribute->product_attribute_id; ?>" attributeId="<?php echo $prod_att_i; ?>" id="<?php echo $attribute->attributeValue->value; ?>" value="<?php echo $attribute->attributeValue->attribute_value_id.'+'.$attribute->attributeValue2->attribute_value_id; ?>"><?php echo $attribute->attributeValue->value; ?></option>
                            <?php } ?>
                        </select>
                        <div class="clearleft clearright" id="qty">
                            <select class="qty margin-bottom-5" name="qty" disabled="disabled">
                                <option value="0">Jumlah</option>
                            </select>
                        </div>
                    <?php } else { ?>
                        <select class="size margin-bottom-5 fleft" name="size" disabled="disabled">
                            <option value="0">Ukuran</option>
                        </select>
                        <select class="color margin-bottom-5" name="color" disabled="disabled">
                            <option value="0">Warna</option>
                        </select>
                        <div class="clearleft clearright" id="qty">
                            <?php
//                            $productStock = \backend\models\ProductStock::findOne(["product_id" => $id]);
                            if ($productStock->quantity == 0) {
                                echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 qty gotham-medium fsize-1 quantity-out-of-stock pleft1">';
                                echo 'Out Of Stock';
                                echo '</div>';
                            } else {
                                echo '<select class="qty margin-bottom-5" name="qty">';
                                echo '<option value="0">Jumlah</option>';
                                for ($i = 1; $i <= $productStock->quantity; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft cart-add-error error" style="display: none;">
                    <span>* Please select Size</span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs product-detail share-box socmed clearleft" style="line-height: 50px;">
                    <div class="col-lg-5 col-md-5 col-sm-5 clearleft">
                        <div class="product-detail share">Share</div>
                    </div>
                    <div style="line-height: 62px;">
                        <?php
                        $image_cover = backend\models\ProductImage::find()->where(['product_id' => $product->product_id, 'cover' => 1])->one();
                        ?>
                        <!-- picture=http://thewatch.co/img/product/<?php echo $image_cover->product_image_id; ?>/<?php echo $image_cover->product_image_id; ?>_medium.jpg -->
                        <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/instagram.png">-->
                        <a class="pleft-4-ipad" target="popup" onclick="window.open('http://twitter.com/share?source=sharethiscom&amp;text=<?php echo $product->brands->brand_name . ' - ' . $product->productDetail->name; ?>. Shop now on The Watch Co.&amp;url=http://thewatch.co', 'name', 'width=600,height=400')">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twitter.png" style="cursor: pointer;width: 8%;" class="pright1">
                        </a>
                        <a target="popup" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=1466455300249678&display=popup&caption=thewatch.co%20|%20<?php echo $product->brands->brand_name; ?>&description=<?php echo strip_tags(substr($product->productDetail->description, 0, 270)); ?>&name=<?php echo $product->brands->brand_name . ' - ' . $product->productDetail->name; ?>&link=http://thewatch.co&redirect_uri=http://thewatch.co&picture=http://thewatch.co/img/product/<?php echo $image_cover->product_image_id; ?>/<?php echo $image_cover->product_image_id; ?>_medium.jpg', 'name', 'width=600,height=400')">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/fb.png" style="cursor: pointer;width: 8%;" class="pright1">
                        </a>
                        <a target="popup" onclick="window.open('https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.thewatch.co&media=http://thewatch.co/img/product/<?php echo $image_cover->product_image_id; ?>/<?php echo $image_cover->product_image_id; ?>_medium.jpg&description=<?php echo strip_tags(substr($product->productDetail->description, 0, 100)); ?>', 'name', 'width=600,height=400')">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/pinterest.png" style="cursor: pointer;width: 8%;" class="pright1">
                        </a>
                        <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line.png">-->
                    </div>
                </div>
                <?php if ($productStock->quantity > 0) { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-detail product-addtocart remove-padding clearright">
                        <a href="#" class="addtocartevent" id="addtocartevent">BELI SEKARANG</a>
                    </div>
                    <?php if (count($productAttributeCombination) > 0) { ?>
                        <!--
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-notifyme remove-padding" style="display: none;">
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>
                        -->
                    <?php } ?>
                <?php } elseif ($productStock->quantity == 0) { ?>
                    <?php if (count($productAttributeCombination) > 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-addtocart remove-padding clearright">
                            <a href="#" class="addtocartevent" id="addtocartevent">BELI SEKARANG</a>
                        </div>
                        <!--
                        <div class="col-lg-12 col-md-12 col-sm-12 product-detail product-notifyme" style='display: none;'>
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>-->
                    <?php } else { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-addtocart clearright" style="display: none;">
                            <a href="#" class="addtocartevent" id="addtocartevent">BELI SEKARANG</a>
                        </div>
                        <!--
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-notifyme">
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>
                        -->
                    <?php } ?>
                <?php } ?>



                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail clearright clearleft-mobile clearright-mobile" style="padding-top: 20px;">
                    <a data-toggle="tab" href="#home" id="a-descriptions" onclick="klik_toggle('a-descriptions')" style="color:#9e8461;border-bottom:solid 1.5px;padding-bottom:3px;">Descriptions </a> 
                    <div style="width: 10px;display: inline;padding-left: 5px;padding-right: 5px;color:#c1bab2;">/</div> 
                    <a data-toggle="tab" href="#menu1" id="a-specifications" onclick="klik_toggle('a-specifications')" style="color:#c1bab2;"> Specification </a> 
                    <div style="width: 10px;display: inline;padding-left: 5px;padding-right: 5px;color:#c1bab2;">/</div> 
                    <a data-toggle="tab" href="#menu2" id="a-productsize" onclick="klik_toggle('a-productsize')" style="color:#c1bab2;"> Product & Size Info</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail clearleft-mobile clearright-mobile" style="padding-top: 15px;">
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active product-detail">
                         
                          <?php echo $product->productDetail->description; ?>
                        </div>
                        <div id="menu1" class="tab-pane fade product-detail">
                         
                          <?php echo $product->productDetail->spesification; ?>
                        </div>
                        <div id="menu2" class="tab-pane fade product-detail">
                         
                          <?php echo $product->productDetail->product_size_info; ?>
                        </div>
                       
                    </div>
                </div>

                <script type="text/javascript">
                    function klik_toggle(event){
                        $("a#a-productsize").css("color", "#c1bab2");
                        $("a#a-productsize").css("border-bottom", "none");

                        $("a#a-specifications").css("color", "#c1bab2");
                        $("a#a-specifications").css("border-bottom", "none");

                        $("a#a-descriptions").css("color", "#c1bab2");
                        $("a#a-descriptions").css("border-bottom", "none");

                        $("a#"+event).css("color", "#9e8461");
                        $("a#"+event).css("border-bottom", "solid 1.5px");
                        $("a#"+event).css("padding-bottom", "3px");
                    }
                </script>
                <!-- <div class="col-lg-12 hidden-md hidden-sm col-xs-12 product-detail border"></div> -->
				<input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
               <!--  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-description clearright">
                    <div class="hidden-xs">DESCRIPTION 
                    <div class="artop-desc"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/top-spec.png"></div></div>
                    <div class="hidden-lg hidden-md hidden-sm">DESCRIPTION
                    <div class="artop-desc"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/top-spec.png"></div></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-description-after clearright">
                    <div class="hidden-xs">DESCRIPTION
                    <div class="ardown-desc"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></div></div>
                    <div class="hidden-lg hidden-md hidden-sm">DESCRIPTION
                    <div class="ardown-desc"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></div></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-description-text">
                    <?php echo $product->productDetail->description; ?>
                </div>
                <div class="hidden-xs col-lg-12 hidden-md hidden-sm col-xs-12 product-detail border"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-spesification clearright">
                    SPESIFIKASI
                    <div class="ardown-spesification"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 product-detail product-spesification-after clearright">
                    SPESIFIKASI
                    <div class="artop-spesification"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/top-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 contain-spesification">
                    <span class="lspace1"><?php echo $product->productDetail->spesification; ?></span>
                </div> -->
				<div class="hidden-xs col-lg-12 hidden-md hidden-sm col-xs-12 product-detail border"></div>
				<div class="hidden-lg hidden-md hidden-sm col-xs-12" style="padding: 10px;"></div>
                <?php if($productWarranty != NULL && $productWarranty->warranty_id != 0){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-warranty clearright gotham-light">
                    Garansi
                    <div class="ardown-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/plus-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-warranty-after clearright gotham-light" style="display: none;">
                    Garansi
                    <div class="artop-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/min-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contain-warranty clearleft" style="display: none;">
                    <span><?php echo $productWarranty->warranty->warranty_name; echo $productWarranty->product_warranty_year != 0 ? ' ' . $productWarranty->product_warranty_year . ' Year Warranty' : ''; ?></span>
                </div>
				<div class="col-lg-12 hidden-md hidden-sm product-detail border"></div>
                <?php } ?>

                <?php if($product->productDetail->product_care != ''){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-care clearright gotham-light">
                    Product Care
                    <div class="ardown-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/plus-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-care-after clearright gotham-light" style="display: none;">
                    Product Care
                    <div class="artop-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/min-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contain-care clearleft" style="display: none;">
                    <?php echo $product->productDetail->product_care; ?>
                </div>
                <div class="col-lg-12 hidden-md hidden-sm product-detail border"></div>
            <?php } ?>


                <?php if($product->productDetail->shipping_availability_location_id != 0){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-estimasi clearright gotham-light">
                    Estimasi Pengiriman
                    <div class="ardown-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/plus-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-estimasi-after clearright gotham-light" style="display: none;">
                    Estimasi Pengiriman
                    <div class="artop-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/min-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contain-estimasi clearleft" style="display: none;">
                    <span><?php echo $product->productDetail->shippingAvailabilityLocation->shipping_availability_location_status_description; ?></span>
                </div>
                <div class="col-lg-12 hidden-md hidden-sm hidden-xs product-detail border"></div>
                <?php } ?>
				
				<?php 
                    // if product price more than 500.000 IDR
                    if($product->price >= 500000){ 
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-cicilan clearright gotham-light">
                    Simulasi Cicilan
                    <div class="ardown-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/plus-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-cicilan-after clearright gotham-light" style="display: none;">
                    Simulasi Cicilan
                    <div class="artop-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/min-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contain-cicilan clearleft" style="display: none;">
					<div class="mbottom-5-mobile mbottom3 mtop3">
						<span class="gotham-light">3 Bulan Bunga 0%</span>
						<span class="gotham-light" style="margin-left: 10%;margin-right: 5%;">:</span>
						<span class="gotham-light">Rp. <?php echo common\components\Helpers::getPriceFormat(($product->price - $discount) / 3); ?></span> <br>
						<span class="gotham-light">6 Bulan Bunga 0%</span>
						<span class="gotham-light" style="margin-left: 10%;margin-right: 5%;">:</span>
						<span class="gotham-light">Rp. <?php echo common\components\Helpers::getPriceFormat(($product->price - $discount) / 6); ?></span> <br>
						<span class="gotham-light">12 Bulan Bunga 0%</span>
						<span class="gotham-light" style="margin-left: 8.5%;margin-right: 5%;">:</span>
						<span class="gotham-light">Rp. <?php echo common\components\Helpers::getPriceFormat(($product->price - $discount) / 12); ?></span>
					</div>
                </div>
                <div class="col-lg-12 hidden-md hidden-sm hidden-xs product-detail border"></div>
                <?php } ?>
				
                
                <!--                <div class="col-lg-12 col-md-12 col-sm-12 product-detail product-notifyme" style="display: none;">
                                    <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                                </div>-->
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm product-detail border"></div>
            </div>
        </div>
        <?php //if($product->brands->brand_id != 2) { ?>
        
		<?php //} ?>
    </div>
</section>

<script>
var dataLayer = [],
	items = [];
	
<?php $i = 1; ?>
<?php foreach ($productRelated as $related) { ?>
	items.push({
		"id": "<?php echo $related->product_id; ?>",
		"name": "<?php echo $related->productDetail->name; ?>",
		"price": "<?php echo $related->price; ?>",
		"brand": "<?php echo $related->brands->brand_name; ?>",
		"category": "<?php echo $related->productCategory->product_category_name; ?>",
		"position": <?php echo $i; ?>,
		"list": "related items"
	});
	<?php $i++; ?>
<?php } ?>
	
dataLayer.push({
	"event" : "productImpressions",
	"ecommerce": {
		"impressions" : items,
		"detail": {
		  "products": [{
			"id": "<?php echo $product->product_id; ?>",
			"name": "<?php echo $product->productDetail->name; ?>",
			"price": "<?php echo $product->price - $discount; ?>",
			"brand": "<?php echo $product->brands->brand_name; ?>",
			"category": "<?php echo $breadcrumbs[0]; ?>"
		  }]
		}
	}
});

//dataLayer = [];
dataLayer.push({
	"event" : "fireRemarketingTag",
	"google_tag_params" : {
		"ecomm_pagetype" : "product",
		"ecomm_prodid" : "<?php echo $product->product_id; ?>",
		"ecomm_totalvalue" : "<?php echo $product->price - $discount; ?>",
		"dynx_itemid" : "<?php echo $product->product_id; ?>",
		"dynx_pagetype" : "product",
		"dynx_totalvalue" : "<?php echo $product->price - $discount; ?>"
	}
});

fbq('track', 'ViewContent', {
	value: <?php echo $product->price - $discount; ?>,
    currency: 'IDR'
});
</script>

<section id="product-related">
    <div class="container">
        <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands caption left"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 featured-brands caption remove-padding">RELATED PRODUCT</div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands caption right"></div>
        </div>
    </div>
    </div>
    <div class="hidden-lg hidden-md hidden-sm col-xs-12" style="padding: 10px;"></div>
    <div class="container product-box clearleft">
        <div id="demo">
            <div class="container">
                <div class="row hidden-lg hidden-md hidden-sm hidden-xs">
                    <div class="span12">
                        <div id="owl-demo">
                            <?php if (count($productRelated) > 0) { ?>
							<?php $i = 1; ?>
                                <?php foreach ($productRelated as $related) { ?>
                                    <div class="item">
                                        <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product-heritage/<?php echo $related->productDetail->link_rewrite; ?>">
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                            <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
											<input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
											<input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
											<input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
											<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
											<input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
											<div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title"><?php echo strtoupper($related->brands->brand_name); ?></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name"><?php echo strtoupper($related->productDetail->name); ?></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-price">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></div>
                                        </a>
                                    </div>
								<?php $i++; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="row hidden-lg hidden-md hidden-sm">
                    <?php
                    if (count($productRelated) > 0) {
                        $i = 0;
                        ?>
                        <?php foreach ($productRelated as $related) { ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 space related <?php echo $i % 2 == 0 ? 'left' : 'right' ?>">
                                <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product-heritage/<?php echo $related->productDetail->link_rewrite; ?>">
                                    <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($related->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><?php echo strtoupper($related->productDetail->name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-price">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></div>
                                    <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                    <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                    <input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
                                    <input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                </a>
                            </div>
                            <?php
                            $i++;
                            if ($i % 2 == 0)
                                echo '<div class="clearfix"></div>';
                        }
                        ?>
                    <?php } ?>
                </div>

                <div class="row hidden-xs">
                    <?php
                    if (count($productRelated) > 0) {
                        $i = 0;
                        ?>
                        <?php foreach ($productRelated as $related) { ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 space related <?php echo $i % 4 == 0 ? 'left' : 'right' ?>">
                                <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product-heritage/<?php echo $related->productDetail->link_rewrite; ?>">
                                    <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $related->productImage->product_image_id . '/' . $related->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($related->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><?php echo strtoupper($related->productDetail->name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-price">IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></div>
									<input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
									<input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
									<input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
									<input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
									<input type="hidden" name="productCategory" value="<?php echo $related->productCategory->product_category_name; ?>">
									<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
                                </a>
                            </div>
                            <?php
                            $i++;
                            if ($i % 4 == 0)
                                echo '<div class="clearfix"></div>';
                        }
                        ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="portfolio-modal modal fade notifyme" id="notifyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content notifyme">
        <div class="col-lg-12 col-md-12 hidden-sm col-xs-12 background-close-notifyme" data-dismiss="modal" style="height: 40px;">
            <a href="#">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-notifyme">
            </a>
        </div>
        
        <div class="hidden-lg hidden-md col-sm-12 hidden-xs background-close-notifyme" data-dismiss="modal">
            <a href="#">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-notifyme">
            </a>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 modal-content-notifyme">
            <div class="modal-body remove-padding">
                <div class="modal-title-notify">PLEASE NOTIFY ME <br> WHEN THIS PRODUCT AVAILABLE</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright name-email-header" style="padding-top: 2%;">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 customer-login email notify" style="text-align: left;">NAME</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 customer-login email notify clearright">
                        <input class="email" type="text" name="name-notifyme" placeholder="Full Name">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearright">
                        <span id="name-notifyme-error" style="display: none;">* Name Required</span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright name-email notify-me" style="padding-top: 2%;">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 customer-login email notify" style="text-align: left;">EMAIL</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 customer-login email notify clearright">
                        <input class="email" type="text" name="email-notifyme" placeholder="Email">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearright">
                        <span id="email-notifyme-error" style="display: none;">* Email Required</span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 2%;">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 login proceed clearleft remove-padding">
                        <a href="#" class="continue" id="submit-notifyme" style="float:left;">SUBMIT</a>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding" style="margin-top: 4%;">
                        <span id="success-notifyme" style="display: none;">Thank You, you will be notify when this product is available .</span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding" style="margin-top: 4%;">
                        <span id="error-notifyme" style="display: none;">You Already notify this product, Please wait when this product is available .</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #owl-demo .item{
        margin: 3px 3px 3px 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }

    .owl-theme .owl-controls .owl-buttons div {
        padding: 5px 9px;
    }

    .owl-theme .owl-buttons i{
        margin-top: 2px;
    }

    /*To move navigation buttons outside use these settings:*/

    .owl-theme .owl-controls .owl-buttons div {
        position: absolute;
    }

    .owl-theme .owl-controls .owl-buttons .owl-prev{
        left: -60px;
        top: 125px; 
    }

    .owl-theme .owl-controls .owl-buttons .owl-next{
        right: -53px;
        top: 125px;
    }

    .owl-theme .owl-controls .owl-buttons div {
        background: transparent;
    }

    .owl-pagination{
        display: none;
    }
</style>

<div class="portfolio-modal modal fade subscribe" id="box-event" tabindex="-1" role="dialog" aria-hidden="true" style="left:20%;right:20%;">
                        <div class="modal-content notifyme">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding modal-newsletter" style="background-color: #fff;background-position: center;background-repeat: no-repeat;background-size: cover;height: 510px;overflow-y: scroll;">
                                <!--<div class="modal-body">-->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-bottom: 10px;">
                                    <a href="#" data-dismiss="modal" class="">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/close-black.png" class="close-mobile">
                                    </a>
                                    <!-- <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 clearleft clearright remove-padding img-subscribe">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/hello.jpg" class="img-responsive" style="height:467px;">
                                    </div> -->
                                    <div id="loading-spinner" style="display: none;">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/spinner.gif" style="width:100%;">
                                    </div>
                                    <div id="box-event-thanks-finish" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 gotham-medium" style="font-size: 15px;padding-top: 120px;padding-bottom: 10px;letter-spacing: 1px;">
                                            Terima Kasih, Order Anda Berhasil Disimpan
                                        </div>
                                        <a href="<?php echo \yii\helpers\Url::base(); ?>/heritage" class="edit shipping col-lg-12 col-md-12 col-sm-12 gotham-light" style="margin-left: 15px;margin-right: 15px;">Lanjut Belanja</a>
                                    </div>
                                    <div id="box-event-thanks">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div id="box-event-open"></div>
                                        </div>
                                        <!-- <form method="post" action="<?php echo \yii\helpers\Url::base(); ?>/product/orderevent">   -->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding gotham-medium" style="letter-spacing: 1px;padding-bottom: 5px;">
                                                Silahkan isi data diri anda:
                                            </div>
                                            <input id="csrf" class="email myprofile" type="hidden" name="csrf" placeholder="Nama" value="sdadawarad">
                                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 ptop1">
                                                <label style="float: left;font-size: 0.95em;">Nama Lengkap:</label>
                                                <input id="ename" class="email-event myprofile" type="text" name="ename" placeholder="Nama" value="">
                                                <span id="error-required-name" style="color:red;font-size: 0.8em;display: none;float: left;">Required</span>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 ptop1">
                                                <label style="float: left;font-size: 0.95em;">Telephone:</label>
                                                <input id="etelp" class="email-event myprofile" type="text" name="etelp" placeholder="Nomor Telephone" value="">
                                                <span id="error-required-telp" style="color:red;font-size: 0.8em;display: none;float: left;">Required</span>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 ptop1">
                                                <label style="float: left;font-size: 0.95em;">Email:</label>
                                                <input id="eemail" class="email-event myprofile" type="text" name="eemail" placeholder="Email" value="">
                                                <span id="error-required-email" style="color:red;font-size: 0.8em;display: none;float: left;">Required</span>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 ptop1">
                                                <label style="float: left;font-size: 0.95em;">Jenis Kelamin:</label>
                                                <select id="egender" name="egender" class="email-event myprofile" style="width: 100%;height: 30px;background-color: #f5f5f5;border: 1px;">
                                                    <option>Select..</option>
                                                    <option value="pria">Pria</option>
                                                    <option value="wanita">Wanita</option>
                                                </select>
                                                <!-- <input id="egender" class="email myprofile" type="text" name="egender" placeholder="Jenis Kelamin" value=""> -->
                                               <span id="error-required-gender" style="color:red;font-size: 0.8em;display: none;float: left;">Required</span>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 ptop1">
                                                <label style="float: left;font-size: 0.95em;">Tanggal Lahir:</label>
                                                <input id="ebirth" class="email-event myprofile" type="date" name="ebirth" placeholder="Tanggal Lahir" value="">
                                                <span id="error-required-birth" style="color:red;font-size: 0.8em;display: none;float: left;">Required</span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop1">
                                            <label>Alamat Lengkap</label>
                                            <textarea id="eaddress" name="eaddress" rows="5" cols="10"></textarea>
                                            <span id="error-required-address" style="color:red;font-size: 0.8em;display: none;">Required</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-12 col-sm-12 ptop1">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                            <!-- <input class="edit shipping" type="submit" name="submit" value="Submit">   -->
                                            <a onclick="saveData()" class="edit shipping" style="padding-right: 0px;padding-left: 0px;">ORDER</a>
                                            </div>
                                        </div>
                                        <!-- </form> -->
                                        <script>
                                            function saveData() {
                                                var fname = $('input[name="ename"]').val(),
                                                    email = $('input[name="eemail"]').val();
                                                    telp = $('input[name="etelp"]').val();
                                                    birth = $('input[name="ebirth"]').val();
                                                    gender = $('input[name="egender"]').val();
                                                    address = document.getElementById('eaddress').value;

                                                if (fname == '') {
                                                    $('input[name="ename"]').focus();
                                                    $('#ename').css('border','1px solid red');
                                                    $('#error-required-name').css('display','inline-block');
                                                    return false;
                                                }else{
                                                    $('#ename').css('border','1px solid black');
                                                    $('#error-required-name').css('display','none');
                                                }

                                                if (telp == '') {
                                                    $('input[name="etelp"]').focus();
                                                    $('#etelp').css('border','1px solid red');
                                                    $('#error-required-telp').css('display','inline-block');
                                                    return false;
                                                }else{
                                                    $('#etelp').css('border','1px solid black');
                                                    $('#error-required-telp').css('display','none');
                                                }

                                                if (email == '') {
                                                    $('input[name="eemail"]').focus();
                                                    $('#eemail').css('border','1px solid red');
                                                    $('#error-required-email').css('display','inline-block');
                                                    return false;
                                                } else if (!validateEmail(email)) {
                                                    $('input[name="eemail"]').focus();
                                                    $('#eemail').css('border','1px solid red');
                                                    return false;
                                                }else{
                                                    $('#eemail').css('border','1px solid black');
                                                    $('#error-required-email').css('display','none');
                                                }

                                                
                                                if (gender == '') {
                                                    $('input[name="egender"]').focus();
                                                    $('#egender').css('border','1px solid red');
                                                    $('#error-required-gender').css('display','inline-block');
                                                    return false;
                                                }else{
                                                    $('#egender').css('border','1px solid black');
                                                    $('#error-required-gender').css('display','none');
                                                }

                                                if (birth == '') {
                                                    $('input[name="ebirth"]').focus();
                                                    $('#ebirth').css('border','1px solid red');
                                                    $('#error-required-birth').css('display','inline-block');
                                                    return false;
                                                }else{
                                                    $('#ebirth').css('border','1px solid black');
                                                    $('#error-required-birth').css('display','none');
                                                }

                                                if (address == '') {
                                                    // $('input[name="firstname_subscribe"]').focus();
                                                    $('#eaddress').css('border','1px solid red');
                                                    $('#error-required-address').css('display','inline-block');
                                                    return false;
                                                }else{
                                                    $('#eaddress').css('border','1px solid black');
                                                    $('#error-required-address').css('display','none');
                                                }

                                                $.ajax({
                                                    type: "POST",
                                                    url: baseUrl + '/promo/orderevent',
                                                    data: {

                                                        '_csrf': document.getElementById('csrf').value,
                                                        'etelp': document.getElementById('etelp').value,
                                                        'ename': document.getElementById('ename').value,
                                                        'eemail': document.getElementById('eemail').value,
                                                        'ebirth': document.getElementById('ebirth').value,
                                                        'egender': document.getElementById('egender').value,
                                                        'eaddress': document.getElementById('eaddress').value,
                                                    },
                                                    beforeSend: function () {
                                                        $('#box-event-thanks').css('display','none');
                                                        $('#loading-spinner').css('display','inline-block');
                                                        // $('#loadingScreen').modal('show');
                                                    },
                                                    success: function (data) {
                                                        $('#loading-spinner').css('display','none');
                                                        $('#box-event-thanks-finish').css('display','inline-block');
                                                        
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
