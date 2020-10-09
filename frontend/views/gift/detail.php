<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row brand-banner">
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $i = 0; ?>
            <?php if (count($brandBanner) > 0) { ?>
                <?php foreach ($brandBanner as $banner) { ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>"></li>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <?php $i = 1; ?>
            <?php if (count($brandBanner) > 0) { ?>
                <?php foreach ($brandBanner as $banner) { ?>
                    <div class="item <?php echo $i === 1 ? 'active' : ''; ?>">
                        <div class="fill" style="background-image: url(<?php echo \yii\helpers\Url::base(); ?>/img/brand_banner/<?php echo $brand_detail->brand_id; ?>/<?php echo $banner->brands_banner_detail_slide_image; ?>);"></div>
                    </div>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
        </div>
    </header>
</div>

<section id="brand-description">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 brand-logo">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/brands/black/<?php echo $brand_detail->brand_logo; ?>">
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div>
                    <span class="brand-name"><?php echo strtoupper($brand_detail->brand_name); ?> - </span><span class="brand-country"><?php echo strtoupper($brand_detail->brand_country); ?></span>
                </div>
                <div class="brand-description">
                    <p><?php echo $brand_detail->brand_description; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="all-brands">
    <div class="container breadcrumb-page">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page">
                <a href="#" class="filter" id="filter">
                    FILTER
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-white.png" id="down-white" />
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-black.png" id="down-black" style="display: none;" />
                </a>
            </div>
            <div class="arrow-filter" id="arrow-filter"></div>
            <?php
//                $form = ActiveForm::begin([
//                    'id' => 'filter-form',
//                    'action' => \yii\helpers\Url::base() . '/category/filter', 
//                    'method' => 'GET'
//                ]); 
            ?>
            <div class="filter-box" id="box-filter">

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
                                $brands = \backend\models\Brands::find()->where(['brand_status' => 'active'])->orderBy('brand_name')->all();
                                $no = 4;
                                foreach ($brands as $row) {
                                    ?>
                                    <div class="checkbox-btn">
                                        <input class="filter" type="checkbox" value="<?php echo $row->link_rewrite; ?>" id="rc<?php echo $no; ?>" name="brands">
                                        <label for="rc<?php echo $no; ?>" onclick=""><?php echo $row->brand_name; ?></label>
                                    </div>
                                    <?php
                                    $no++;
                                }
                                ?>
                                <!--                                <div class="checkbox-btn">
                                                                    <input type="checkbox" value="value-5" id="rc5" name="rc5">
                                                                    <label for="rc5" onclick="">Autodromo</label>
                                                                </div>
                                                                <div class="checkbox-btn">
                                                                    <input type="checkbox" value="value-6" id="rc6" name="rc6">
                                                                    <label for="rc6" onclick="">Braun</label>
                                                                </div>
                                                                <div class="checkbox-btn">
                                                                    <input type="checkbox" value="value-7" id="rc7" name="rc7">
                                                                    <label for="rc7" onclick="">Bulbul</label>
                                                                </div>
                                                                <div class="checkbox-btn">
                                                                    <input type="checkbox" value="value-8" id="rc8" name="rc8">
                                                                    <label for="rc8" onclick="">Lima</label>
                                                                </div>
                                                                <div class="checkbox-btn">
                                                                    <input type="checkbox" value="value-9" id="rc9" name="rc9">
                                                                    <label for="rc9" onclick="">Tsovet</label>
                                                                </div>
                                                                <div class="checkbox-btn">
                                                                    <input type="checkbox" value="value-10" id="rc10" name="rc10">
                                                                    <label for="rc10" onclick="">Triwa</label>
                                                                </div>-->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">SIZE</div>
                            <div class="col-lg-12 filter-parent brand left">
                                <div class="watch-size">Watch Size</div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="radio-btn">
                                        <input type="radio" value="26--30" id="rc1" name="filter_size">
                                        <label for="rc1" onclick="">26 - 30</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="radio-btn">
                                        <input type="radio" value="32--36" id="rc1" name="filter_size">
                                        <label for="rc1" onclick="">32 - 36</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="radio-btn">
                                        <input type="radio" value="26--30" id="rc1" name="filter_size">
                                        <label for="rc1" onclick="">38 - 40</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 filter-parent">
                                    <div class="radio-btn">
                                        <input type="radio" value="26--30" id="rc1" name="filter_size">
                                        <label for="rc1" onclick="">41 - 47</label>
                                    </div>
                                </div>
                                <?php
//                                $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 5])->all();
//                                foreach ($watches_size as $row) {
                                    ?>
<!--                                    <div class="col-lg-1 watch-size box">
                                        <input id="watch-size" name="filter_size" type="radio" value="<?php // echo $row->feature_value_name; ?>"><span><?php // echo $row->feature_value_name; ?></span>
                                    </div>-->
                                    <?php
//                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        $feature = \backend\models\Feature::find()->all();
                        foreach ($feature as $row) {
                            $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                            if (strtoupper($row->feature_name) != 'SIZE' && strtoupper($row->feature_name) != 'LUG SIZE') {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="filter-brand title left brand"><?php echo strtoupper($row->feature_name); ?></div>
                                    <div class="col-lg-12 filter-parent brand left">
                                        <?php
                                        foreach ($product_feature_value as $roww) {
                                            ?>
                                            <div class="checkbox-btn">
                                                <input type="checkbox" data-id="<?php echo explode(' ', strtolower(trim($row->feature_name)))[0]; ?>" value="<?php echo strtolower(str_replace(' ', '-', $roww->feature_value_name)); ?>" id="rc<?php echo $no; ?>" name="category">
                                                <label for="rc<?php echo $no; ?>" onclick=""><?php echo $roww->feature_value_name; ?></label>
                                            </div>
                                            <?php
                                            $no++;
                                        }
                                        ?>
        <!--                                <input id="brand" name="filter_parent" type="radio"><span>FEMALE</span> <br>
        <input id="brand" name="filter_parent" type="radio"><span>UNISEX</span> <br>-->
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
                            <div class="filter-brand title left brand">LUG SIZE</div>
                            <div class="col-lg-12 filter-parent brand left">
                                <?php
                                $watches_size = backend\models\ProductFeatureValue::find()->where(['feature_id' => 6])->all();
                                foreach ($watches_size as $row) {
                                    ?>
                                    <div class="col-lg-1 watch-size box">
                                        <input id="watch-size" name="filter_size" type="radio" value="<?php echo $row->feature_value_name; ?>"><span><?php echo $row->feature_value_name; ?></span>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">PRICE</div>
                            <div class="filter-brand title left brand" style="border-bottom: 0px; padding-top: 2%;">
                                <input id="foo" type="text" class="span2" value="" data-slider-handle="triangle" data-slider-min="300000" data-slider-max="15000000" data-slider-step="10000" data-slider-value="[300000,15000000]"/>
                                <div style="font-family: gotham-light; padding-top: 13%;">
                                    <div id="bar-left" class="pull-left">300000</div>
                                    <div id="bar-right" class="pull-right">15000000</div>
                                </div>
                            </div>
                        </div>
                        
                        




                        <!--                        <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="filter-brand title left brand">CATEGORY</div>
                                                    <div class="col-lg-12 filter-parent brand left">
                                                        <input id="brand" name="filter_parent" type="radio"><span>PERFORMANCE</span> <br>
                                                        <input id="brand" name="filter_parent" type="radio"><span>MINIMALIST</span> <br>
                                                        <input id="brand" name="filter_parent" type="radio"><span>CLASSIC</span> <br>
                                                    </div>
                                                </div>-->
                    </div>
                </div>
                <!--                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-lg-offset-3">
                                            <div class="filter-brand title left brand">TYPE</div>
                                            <div class="col-lg-12 filter-parent brand left">
                                                <input id="brand" name="filter_parent" type="radio"><span>Quartz</span> <br>
                                                <input id="brand" name="filter_parent" type="radio"><span>Automatic</span> <br>
                                                <input id="brand" name="filter_parent" type="radio"><span>Manual</span> <br>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="filter-brand title left brand">WATER RESISTANT</div>
                                            <div class="col-lg-12 filter-parent brand left">
                                                <input id="brand" name="filter_parent" type="radio"><span>5 ATM</span> <br>
                                                <input id="brand" name="filter_parent" type="radio"><span>8 ATM</span> <br>
                                                <input id="brand" name="filter_parent" type="radio"><span>10 ATM</span> <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
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
            <?php // ActiveForm::end(); ?>
        </div>
    </div>
</section>

<style>
    .tag {
        float: right;
        position: absolute;
        right: 0px;
        margin-right: 15px;
    }

    .text-discount { 
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        margin-top: -9px; 
        text-align: center;
        font-family: "gotham-medium";
        font-size: 1em;
        color: white;
    }

    .circle{
        width: 50px;
        height: 50px;
        background: black; 
        -moz-border-radius: 70px; 
        -webkit-border-radius: 70px; 
        border-radius: 70px;
    }

</style>

<?php if (count($products) > 0) {
    $now = date("Y-m-d H:i:s");
    ?>
    <section id="product">


        <?php
        $i = 1;
        ?>
        <?php $group_active = ""; ?>
        <?php foreach ($products as $product) { ?>
            <?php
            $count = 0;
            foreach ($products as $productt) {
                if ($product->brandsCollection->brands_collection_id == $productt->brandsCollection->brands_collection_id) {
                    $count++;
                } else {
                    continue;
                }
            }
            ?>
            <?php if ($product->brandsCollection->brands_collection_name != $group_active) { ?>
                <?php $i = 1; ?>
                <div class="container product-collection">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 product-header clearright">
                            <span class="collection-name"><?php echo $product->brandsCollection->brands_collection_name; ?></span>
                            <div class="col-lg-10 col-md-10 col-sm-10 product-header border"></div>
                        </div>
                    </div>
                </div>
                <div class="container product-box">
                    <div class="row">
                        <?php
                        $group_active = $product->brandsCollection->brands_collection_name;
                    }
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 space">
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                            <div>
                                <div class="tag">
                                    <?php
                                    if (!empty($product->specificPrice)) {
                                        if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
                                            ?>
                                            <div class='pull-right'>
                                                <div class='circle'>
                                                    <span class='text-discount' style=''>
                                                        <?php
                                                        if ($product->specificPrice->reduction_type == 'amount') {
                                                            echo round($product->specificPrice->reduction / 1000, 2);
                                                        } else {
                                                            echo $product->specificPrice->reduction;
                                                        }
                                                        echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><?php echo strtoupper($product->productDetail->name); ?></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-price">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></div>
                        </a>
                    </div>
                        <?php
                            if($i % 4 == 0){
                                echo '<div class="clearfix"></div>';
                            }
                        ?>
                    <?php if ($i == $count) { ?>
                    </div>
                </div>
            <?php } ?>
            <?php $i++; ?>
        <?php } ?>
    </section>
<?php } ?>
