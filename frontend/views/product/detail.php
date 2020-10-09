<?php
session_start();
use app\assets\ProductDetailAsset;
use yii\web\Session;

ProductDetailAsset::register($this);

$breadcrumbs = $this->context->breadcrumb;
$img_src = "";
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft" style="">
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
                                        $bandwidth_selection = [];
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
                                                    $genders_selection = [];
                                                    $types_selection = [];
                                                    $movements_selection = [];
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
                                            $waters_selection = [];
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
                <div class="btn-prev"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-top-black.png" style="cursor: pointer; width: 25px;margin-left: 9px;padding-bottom: 5px;"></div>
            </div>
            <div class="clearfix"></div>
        <?php } ?>
        <?php if($product->product_id == 2263 || $product->product_id == 2278 || $product->product_id == 2317 || $product->product_id == 2416 || $product->product_id == 2431){?>
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
                <div class="btn-prev"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-top-black.png" style="cursor: pointer; width: 25px;margin-left: 9px;padding-bottom: 5px;"></div>
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
                                    <?php $img_seq = 0;?>
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
                                        <?php if(count($productImages)-1 == $img_seq){ ?>
                                            <?php if($product->product_id == 2263 || $product->product_id == 2278 || $product->product_id == 2317 || $product->product_id == 2416 || $product->product_id == 2431){?>
                                                <?php
                                                    if (YII_ENV === 'dev') {
                                                        $img_src = Yii::$app->request->baseUrl . '/img/product/' . $image->product_image_id . '/' . $image->product_image_id;
                                                    } else {
                                                        $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $image->product_image_id . '/' . $image->product_image_id;
                                                    }
                                                ?>
                                                <li class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo $img_src; ?>_medium.jpg" data-zoom-image="<?php echo $img_src; ?>_big.jpg">
                                                        <a href="#" class="small-thumb" onclick="video_play_product();" id="<?php echo $attributeId; ?>" data-image="" data-zoom-image="">
                                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo \yii\helpers\Url::base(); ?>/img/case-cuff.png" class="img-responsive">
                                                        
                                                        
                                                    </a>
                                                </li>
                                                <?php $img_seq++;?>
                                            <?php } ?>
                                        <?php } 
                                        
                                            if (YII_ENV === 'dev') {
                                                $img_src = Yii::$app->request->baseUrl . '/img/product/' . $image->product_image_id . '/' . $image->product_image_id;
                                            } else {
                                                $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $image->product_image_id . '/' . $image->product_image_id;
                                            }
                                        ?>  
                                        <li class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo $img_src; ?>_medium.jpg" data-zoom-image="<?php echo $img_src; ?>_big.jpg">
                                            <a href="#" onclick="video_stop_product();" class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo $img_src; ?>_medium.jpg" data-zoom-image="<?php echo $img_src; ?>_big.jpg">
                                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo $img_src; ?>_small.jpg" class="img-responsive">
                                            </a>
                                        </li>
                                        <?php $img_seq++;?>
                                    <?php } ?>
                                    <?php if($product->product_id == 1701 || $product->product_id == 1997 || $product->product_id == 2259 || $product->product_id == 2260 || $product->product_id == 2415){
                                        
                                        if (YII_ENV === 'dev') {
                                            $img_src = Yii::$app->request->baseUrl . '/img/product/' . $image->product_image_id . '/' . $image->product_image_id;
                                        } else {
                                            $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $image->product_image_id . '/' . $image->product_image_id;
                                        }    
                                    ?>
                                    <li class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo $img_src; ?>_medium.jpg" data-zoom-image="<?php echo $img_src; ?>_big.jpg">
                                            <a href="#" class="small-thumb" onclick="video_play_product();" id="<?php echo $attributeId; ?>" data-image="" data-zoom-image="">
                                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo \yii\helpers\Url::base(); ?>/img/busy-bees.png" class="img-responsive">
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if($product->product_id == 2667 || $product->product_id == 2668 || $product->product_id == 2669 || $product->product_id == 2670 || $product->product_id == 2671 || $product->product_id == 2672 || $product->product_id == 2674 || $product->product_id == 2675 || $product->product_id == 2677 || $product->product_id == 2678 || $product->product_id == 2679 || $product->product_id == 2681){
                                        
                                        if (YII_ENV === 'dev') {
                                            $img_src = Yii::$app->request->baseUrl . '/img/product/' . $image->product_image_id . '/' . $image->product_image_id;
                                        } else {
                                            $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $image->product_image_id . '/' . $image->product_image_id;
                                        }
                                    ?>
                                    <li class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo $img_src; ?>_medium.jpg" data-zoom-image="<?php echo $img_src; ?>_big.jpg">
                                            <a href="#" class="small-thumb" onclick="flash_play_product();" id="<?php echo $attributeId; ?>" data-image="" data-zoom-image="" style="position: absolute;width: 75px;height: 130px;"></a>
                                                <object type="application/x-shockwave-flash" data="http://localhost/thewatchco2/img/flash/<?php echo $product->product_id; ?>.swf" 
                                                    width="75" height="130"> 

                                                    <param name="movie" value="http://localhost/thewatchco2/img/flash/<?php echo $product->product_id; ?>.swf" />
                                                    <param name="quality" value="high" />
                                                </object>
                                            
                                                
                                            
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!--                        </div>-->
                        <?php if ($img_seq > 6) { ?>
                            <div class="btn-next"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-black.png" style="cursor: pointer; width: 25px;margin-left: 26px;padding-bottom: 5px;"></div>
                        <?php } ?>
                    </div>

                    <?php foreach ($productImages as $image) { ?>
                        <?php if ($image->cover == 1) { 
                            
                            if (YII_ENV === 'dev') {
                                $img_src = Yii::$app->request->baseUrl . '/img/product/' . $image->product_image_id . '/' . $image->product_image_id;
                            } else {
                                $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $image->product_image_id . '/' . $image->product_image_id;
                            }
                        ?>
                            <div class="col-lg-10 col-md-10 col-sm-9 clearleft-ipad clearleft image-thumb" style="display: block;">
                                <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" id="product-img" data-zoom-image="<?php echo $img_src; ?>_big.jpg" src="<?php echo $img_src; ?>_medium.jpg" class="img-responsive">
                            </div>
                            <?php
                            break;
                        }
                        ?>
                    <?php } ?>
                    <?php if($product->product_id == 2263 || $product->product_id == 2278 || $product->product_id == 2317 || $product->product_id == 2416 || $product->product_id == 2431){?>
                            <div class="col-lg-10 col-md-10 col-sm-9 clearleft-ipad clearleft video-thumb" style="display: none;">
                     
                                <video controls loop>
                                    <source src="<?php echo \yii\helpers\Url::base(); ?>/img/case-cuff.mp4" type="video/mp4">
                                </video>
                            </div>
                    <?php } ?>
                    <?php if($product->product_id == 1701 || $product->product_id == 1997 || $product->product_id == 2259 || $product->product_id == 2260 || $product->product_id == 2415){?>
                            <div class="col-lg-10 col-md-10 col-sm-9 clearleft-ipad clearleft video-thumb" style="display: none;">
                     
                                <video controls loop>
                                    <source src="<?php echo \yii\helpers\Url::base(); ?>/img/busy-bees.mp4" type="video/mp4">
                                </video>
                            </div>
                     <?php } ?>
                     <?php if($product->product_id == 2667 || $product->product_id == 2668 || $product->product_id == 2669 || $product->product_id == 2670 || $product->product_id == 2671 || $product->product_id == 2672 || $product->product_id == 2674 || $product->product_id == 2675 || $product->product_id == 2677 || $product->product_id == 2678 || $product->product_id == 2679 || $product->product_id == 2681){?>
                            <div class="col-lg-10 col-md-10 col-sm-9 clearleft-ipad clearleft flash-thumb" style="display: none;">
                                <object type="application/x-shockwave-flash" data="http://localhost/thewatchco2/img/flash/<?php echo $product->product_id; ?>.swf" 
                                    width="550" height="400"> 

                                    <param name="movie" value="http://localhost/thewatchco2/img/flash/<?php echo $product->product_id; ?>.swf" />
                                    <param name="quality" value="high" />
                                </object>
                            </div>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 hidden-lg hidden-md hidden-sm">
                <header id="myCarousel" class="carousel slide brand" style="margin-top: 0px;"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php $i = 0; ?>
                        <?php if (count($productImages) > 0) { ?>
                            <?php foreach ($productImages as $banner) { ?>
                                <?php if($product->product_id == 2263 || $product->product_id == 2278 || $product->product_id == 2317 || $product->product_id == 2416 || $product->product_id == 2431){?>
                                    <?php if($i == 5){ ?>
                                        <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class=""></li>
                                        <?php $i++; ?>
                                    <?php } ?>
                                <?php } ?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>"></li>
                                <?php $i++; ?>
                            <?php } ?>
                            <?php if($product->product_id == 1701 || $product->product_id == 1997 || $product->product_id == 2259 || $product->product_id == 2260 || $product->product_id == 2415){?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class=""></li>
                            <?php } ?>
                            <?php if($product->product_id == 2667 || $product->product_id == 2668 || $product->product_id == 2669 || $product->product_id == 2670 || $product->product_id == 2671 || $product->product_id == 2672 || $product->product_id == 2674 || $product->product_id == 2675 || $product->product_id == 2677 || $product->product_id == 2678 || $product->product_id == 2679 || $product->product_id == 2681){?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class=""></li>
                            <?php } ?>
                        <?php } ?>
                    </ol>

                    <!-- Wrapper for Slides -->
                    <div class="carousel-inner">
                        <?php $i = 1; ?>
                        <?php if (count($productImages) > 0) { ?>
                            <?php foreach ($productImages as $banner) { ?>
                                <?php if($product->product_id == 2263 || $product->product_id == 2278 || $product->product_id == 2317 || $product->product_id == 2416 || $product->product_id == 2431){?>
                                    <?php if($i == 6){ ?>
                                        <div class="item">
                                            <video controls autoplay loop width="414">
                                                <source src="<?php echo \yii\helpers\Url::base(); ?>/img/case-cuff.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                        <?php $i++; ?>
                                    <?php } ?>
                                <?php } ?>
                                <div class="item <?php echo $i === 1 ? 'active' : ''; ?>">
                                <?php
                                    if (YII_ENV === 'dev') {
                                        $img_src = Yii::$app->request->baseUrl . '/img/product/' . $image->product_image_id . '/' . $image->product_image_id;
                                    } else {
                                        $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $image->product_image_id . '/' . $image->product_image_id;
                                    }
                                ?>
                                    <img src="<?php echo $img_src . "_big.jpg"; ?>" class="img-responsive">
                                    <!--<div class="fill" style="background-image: url(<?php // echo Yii::$app->params['imgixUrl'] ?>product/<?php // echo $banner->product_image_id . '/' . $banner->product_image_id . "_big.jpg"; ?>);"></div>-->
                                </div>
                                <?php $i++; ?>
                            <?php } ?>
                            <?php if($product->product_id == 1701 || $product->product_id == 1997 || $product->product_id == 2259 || $product->product_id == 2260 || $product->product_id == 2415){?>
                                <div class="item">
                                    <video controls autoplay loop width="414">
                                        <source src="<?php echo \yii\helpers\Url::base(); ?>/img/busy-bees.mp4" type="video/mp4">
                                    </video>
                                </div>
                            <?php } ?>
                            <?php if($product->product_id == 2667 || $product->product_id == 2668 || $product->product_id == 2669 || $product->product_id == 2670 || $product->product_id == 2671 || $product->product_id == 2672 || $product->product_id == 2674 || $product->product_id == 2675 || $product->product_id == 2677 || $product->product_id == 2678 || $product->product_id == 2679 || $product->product_id == 2681){?>
                                <div class="item">
                                    <object type="application/x-shockwave-flash" data="http://localhost/thewatchco2/img/flash/<?php echo $product->product_id; ?>.swf" 
                                        width="550" height="400"> 

                                        <param name="movie" value="http://localhost/thewatchco2/img/flash/<?php echo $product->product_id; ?>.swf" />
                                        <param name="quality" value="high" />
                                    </object>
                                </div>
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
                    <input type="hidden" name="brand_id" value="<?php echo $product->brands->brand_id; ?>">
                    <input type="hidden" name="collection_id" value="<?php echo $product->brands_collection_id; ?>">
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
                $spesificPriceAll = backend\models\SpecificPrice::find()->where(['product_id' => $product->product_id])->all();
                $discount = 0;
                $now = date('Y-m-d H:i:s');
                $check_discount = 0;
                $check_flash = 0;
				$extraDiscount = 0;
				$extraDiscountStartDate = '2019-03-18 11:00:00';
				$extraDiscountEndDate = '2019-03-20 17:00:00';
				if($_SESSION['customerInfo']['customer_id'] == 7614){
				// 	$now = '2018-10-29 11:00:00';
				}
                if ($spesificPriceAll != null) {
                    foreach ($spesificPriceAll as $specificPrice) {
                                            if ($specificPrice->from <= $now && $specificPrice->to > $now) {
                                                if($specificPrice->is_flash_sale == 1){
                                                    $check_flash = 1;
                                                }
                                            }
                                        }
                    ?>
                    <?php
                        foreach ($spesificPriceAll as $spesificPrice) {
                  
                           // $reduction = (int) $spesificPrice->reduction;
                          //  $reduction_extra = (int) $spesificPrice->reduction_extra;
                         //   $reduction_plus_extra = (int) $spesificPrice->reduction_plus_extra;
                            
                    ?>
                        <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>
                            <?php $check_discount = 1; ?>
                            
                        <?php } else { ?>
                            <?php
                                if($check_flash == 1){
                                    if($spesificPrice->is_flash_sale == 1){
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                            <?php
                            
                                if ($spesificPrice->reduction_type == 'percent') {
                                    if($reduction_extra === 0 && $reduction_plus_extra === 0){
                                        $discount = floor(($reduction / 100) * $product->price);
                                        $total_price = $product->price - $discount;
                                    }else{
                                        if($reduction_extra > 0 && $reduction_plus_extra === 0){
                                            // set discount extra
                                            // discount
                                            $discount = floor( ($reduction / 100) * $product->price );
                                            $discount_amount = $product->price - $discount;
                                            // discount extra 
                                            $discount_extra = floor( ($reduction_extra / 100) * $discount_amount );
                                            $discount_amount_extra = $discount_amount - $discount_extra;
                                            $total_price = $discount_amount_extra;
                                        }
                                        if($reduction_extra > 0 && $reduction_plus_extra > 0){
                                            // set discount plus extra
                                            // discount
                                            $discount = floor( ($reduction / 100) * $product->price );
                                            $discount_amount = $product->price - $discount;
                                            // discount extra 
                                            $discount_extra = floor( ($reduction_extra / 100) * $discount_amount );
                                            $discount_amount_extra = $discount_amount - $discount_extra;
                                            // discount plus extra 
                                            $discount_plus_extra = floor( ($reduction_plus_extra / 100) * $discount_amount_extra );
                                            $discount_amount_plus_extra = $discount_amount_extra - $discount_plus_extra;
                                            $total_price = $discount_amount_plus_extra;
                                        }
                                    }
                                } elseif ($spesificPrice->reduction_type == 'amount') {
                                    $discount = $spesificPrice->reduction;
                                    $total_price = $product->price - $discount;
                                }
                                ?>
                                
                                IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>
                                <span class="discount-price mleft2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
                                <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                                <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                                <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                <input type="hidden" class="flash_sale" name="flash_sale" value="1">
                                <input type="hidden" class="isdiscount" name="isdiscount" value="1">
                                <input type="hidden" class="pre_order" name="pre_order" value="0">
                            </div>
    
    
                            <?php $check_discount = 0;break; ?>
                            
                            <?php }
                                }else{
                            ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                                <?php
                                if ($spesificPrice->reduction_type == 'percent') {
                                    $discount = (($spesificPrice->reduction / 100) * $product->price);
                                } elseif ($spesificPrice->reduction_type == 'amount') {
                                    $discount = $spesificPrice->reduction;
                                }
								if($extraDiscountStartDate <= $now && $extraDiscountEndDate > $now){
									$extraDiscount = (($product->price - $discount) * 0.1);
									$discount += $extraDiscount;
								}
                                ?>
                                IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>
                                <span class="discount-price mleft2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
                                <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                                <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                                <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                <input type="hidden" class="flash_sale" name="flash_sale" value="0">
                                <input type="hidden" class="isdiscount" name="isdiscount" value="1">
                                <input type="hidden" class="pre_order" name="pre_order" value="0">
                            </div>
                            <?php $check_discount = 0;break; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                        <?php if($check_discount == 1){ ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                                IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                                <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                                <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                                <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                                <input type="hidden" class="flash_sale" name="flash_sale" value="0">
                                <input type="hidden" class="isdiscount" name="isdiscount" value="0">
                                <input type="hidden" class="pre_order" name="pre_order" value="0">
                            </div>
                        <?php } ?>
                <?php } else { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price">
                        IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                        <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                        <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                        <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                        <input type="hidden" class="flash_sale" name="flash_sale" value="0">
                        <input type="hidden" class="isdiscount" name="isdiscount" value="0">
                        <input type="hidden" class="pre_order" name="pre_order" value="0">
                    </div>
                <?php } ?>

                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 product-detail product-total">
                    Total
                    <span id="loadingAjax" style="display: none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/loading-ajax.gif"></span>
                    <span class="product-total" basePrice="<?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>">
						IDR 
						<span id="priceCustom" >
						<?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>
						</span>
					</span>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs product-detail border"></div>
                <div class="hidden-lg hidden-md hidden-sm" style="padding:45px;"></div>
                <?php
                    session_start();
                    $items = $_SESSION['cart']['items'];
                    $flash_item == 0;
                    if(count($items) > 0){
                        foreach ($items as $item) {
                            // echo $item['flash_sale'];
                            if($item['flash_sale'] == '1'){
                                $flash_item = 1;
                                // echo 'masuk';
                            }
                        }
                    }
                    
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-select" style="<?php echo $flash_item == 1 ? 'display: none;':''; ?>">
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


                        <select 
						class="color margin-bottom-5" 
						name="color" <?php if($totalval == 0 && $totalval2 != 0){echo 'disabled="disabled"';}?>>
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
                                echo '<select onchange="changeQuantityCustom()" class="qty margin-bottom-5" name="qty">';
                                echo '<option value="0">Jumlah</option>';
                                for ($i = 1; $i <= $productStock->quantity; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                    
                                    if($check_flash == 1){
                                        if($i == 1){
                                            break;
                                        }
                                    }
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
                <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs product-detail share-box socmed clearleft" style="line-height: 50px;">
                    <div class="col-lg-5 col-md-5 col-sm-5 clearleft">
                        <div class="product-detail share">Share</div>
                    </div>
                    <div style="line-height: 62px;">
                        <?php
                        $image_cover = backend\models\ProductImage::find()->where(['product_id' => $product->product_id, 'cover' => 1])->one();
                        ?>
                        <!-- picture=http://thewatch.co/product/<?php echo $image_cover->product_image_id; ?>/<?php echo $image_cover->product_image_id; ?>_medium.jpg -->
                        <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/instagram.png">-->
                        <a class="pleft-4-ipad" target="popup" onclick="window.open('http://twitter.com/share?source=sharethiscom&amp;text=<?php echo $product->brands->brand_name . ' - ' . $product->productDetail->name; ?>. Shop now on The Watch Co.&amp;url=http://thewatch.co', 'name', 'width=600,height=400')">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twitter.png" style="cursor: pointer;width: 8%;" class="pright1">
                        </a>
                        <a target="popup" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=1466455300249678&display=popup&caption=thewatch.co%20|%20<?php echo $product->brands->brand_name; ?>&description=<?php echo strip_tags(substr($product->productDetail->description, 0, 270)); ?>&name=<?php echo $product->brands->brand_name . ' - ' . $product->productDetail->name; ?>&link=http://thewatch.co&redirect_uri=http://thewatch.co&picture=http://thewatch.co/product/<?php echo $image_cover->product_image_id; ?>/<?php echo $image_cover->product_image_id; ?>_medium.jpg', 'name', 'width=600,height=400')">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/fb.png" style="cursor: pointer;width: 8%;" class="pright1">
                        </a>
                        <a target="popup" onclick="window.open('https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.thewatch.co&media=http://thewatch.co/product/<?php echo $image_cover->product_image_id; ?>/<?php echo $image_cover->product_image_id; ?>_medium.jpg&description=<?php echo strip_tags(substr($product->productDetail->description, 0, 100)); ?>', 'name', 'width=600,height=400')">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/pinterest.png" style="cursor: pointer;width: 8%;" class="pright1">
                        </a>
                        <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line.png">-->
                    </div>
                </div>
                <?php
                $sessionOrder = new Session();
                $sessionOrder->open();
                $customerInfo = $sessionOrder->get("customerInfo"); 

                
                if($flash_item == 0){ ?>
                <?php if ($productStock->quantity > 0) {
                     if(isset($customerInfo)){?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 product-detail product-wishlist remove-padding clearright text-right">
                        <a href="#" class="addtowishlist initialed" data-product-id="<?=$product->product_id?>" id="addtowishlist"><img  class="icon-love-wishlist" src="https://thewatch.imgix.net/wishlist/desktop/btn_add_to_wishlist_idle.png"/><span class="textaddtowishlist">MASUKAN WISHLIST</a></a>
                    </div>
                     
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 product-detail product-addtocart remove-padding clearright">
                        <a href="#" class="addtocart" id="addtocart">BELI SEKARANG</a>
                    </div>
                    <?php }else{
                    ?>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 product-detail product-addtocart remove-padding clearright">
                            <a href="#" class="addtocart no-wishlist" id="addtocart">BELI SEKARANG</a>
                        </div>
                    <?php }?>
                    <?php if (count($productAttributeCombination) > 0) { ?>
                        <!--
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-notifyme remove-padding" style="display: none;">
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>
                        --> 
                    <?php } ?>
                <?php } elseif ($productStock->quantity == 0) { ?>
                    <?php if (count($productAttributeCombination) > 0) { 
                        if(isset($customerInfo)){?>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 product-detail product-wishlist remove-padding clearright text-right">
                            <a href="#" class="addtowishlist initialed" data-product-id="<?=$product->product_id?>" id="addtowishlist"><img class="icon-love-wishlist" src="https://thewatch.imgix.net/wishlist/desktop/btn_add_to_wishlist_idle.png"/><span class="textaddtowishlist">MASUKAN WISHLIST</a></a>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 product-detail product-addtocart remove-padding clearright">
                            <a href="#" class="addtocart" id="addtocart">BELI SEKARANG</a>
                        </div>
                        <?php }else{
                        ?>
                        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 product-detail product-addtocart remove-padding clearright">
                            <a href="#" class="addtocart no-wishlist" id="addtocart">BELI SEKARANG</a>
                        </div>
                        <?php }?>
                        <!--
                        <div class="col-lg-12 col-md-12 col-sm-12 product-detail product-notifyme" style='display: none;'>
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>-->
                    <?php } else { 
                        if(isset($customerInfo)){?>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 product-detail product-wishlist remove-padding clearright text-right">
                            <a href="#" class="addtowishlist initialed" data-product-id="<?=$product->product_id?>" id="addtowishlist"><img  class="icon-love-wishlist" src="https://thewatch.imgix.net/wishlist/desktop/btn_add_to_wishlist_idle.png"/><span class="textaddtowishlist">MASUKAN WISHLIST</a></a>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-addtocart clearright" style="display: none;">
                            <a href="#" class="addtocart" id="addtocart">BELI SEKARANG</a>
                        </div>
                        <?php }else{
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-addtocart clearright" style="display: none;">
                            <a href="#" class="addtocart" id="addtocart">BELI SEKARANG</a>
                        </div>
                        <?php }?>
                        <!--
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-notifyme">
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>
                        --> 
                    <?php } ?>
                <?php } ?>

                <?php } ?>


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail clearright clearleft-mobile clearright-mobile" style="padding-top: 20px;">
                    <a data-toggle="tab" href="#home" id="a-descriptions" onclick="klik_toggle('a-descriptions')" style="color:#9e8461;border-bottom:solid 1.5px;padding-bottom:3px;">Descriptions </a> 
                    <div style="width: 10px;display: inline;padding-left: 5px;padding-right: 5px;color:#c1bab2;">/</div> 
                    <a data-toggle="tab" href="#menu1" id="a-specifications" onclick="klik_toggle('a-specifications')" style="color:#c1bab2;"> Specification </a> 
                    <div style="width: 10px;display: inline;padding-left: 5px;padding-right: 5px;color:#c1bab2;">/</div> 
                    <a data-toggle="tab" href="#menu2" id="a-productsize" onclick="klik_toggle('a-productsize')" style="color:#c1bab2;"> Product & Size Info</a>
                    <div style="width: 10px;display: inline;padding-left: 5px;padding-right: 5px;color:#c1bab2;">/</div> 
                    <a data-toggle="tab" href="#menu3" id="a-additionalnote" onclick="klik_toggle('a-additionalnote')" style="color:#c1bab2;"> Additional Note</a>
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
                        <div id="menu3" class="tab-pane fade product-detail">
                         
                          <?php echo $product->productDetail->additional_note; ?>
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
                <input type="hidden" name="productCategoryID" value="<?php echo $product->productCategory->product_category_id; ?>">
                <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                <input type="hidden" name="productCategoryDesc" value="<?php echo $product->productCategory->product_category_description; ?>">
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
                <?php if($productWarranty != NULL && $productWarranty->warranty_type_id != 0){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-warranty clearright gotham-light">
                    Garansi
                    <div class="ardown-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/plus-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-warranty-after clearright gotham-light" style="display: none;">
                    Garansi
                    <div class="artop-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/min-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contain-warranty clearleft" style="display: none;">
                    <span><?php echo $productWarranty->warrantyType->warranty_type_name; echo $productWarranty->product_warranty_year != 0 ? ' ' . $productWarranty->product_warranty_year . ' Year Warranty' : ''; ?></span>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contain-care clearleft ptop5p" style="display: none;">
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
var items = [];
    
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
    "event" : "viewProduct",
    "ecommerce": {
        //"impressions" : items,
        "currencyCode" : "IDR",
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
    //value: <?php echo $product->price - $discount; ?>,
    //currency: 'IDR'
	content_ids: ['<?php echo $product->product_id; ?>'],
	content_type: 'product'
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
                                <?php foreach ($productRelated as $related) { 
                                    
                                    if (YII_ENV === 'dev') {
                                        $img_src = Yii::$app->request->baseUrl . '/img/product/' . $related->productImage->product_image_id . '/' . $related->productImage->product_image_id;
                                    } else {
                                        $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $related->productImage->product_image_id . '/' . $related->productImage->product_image_id;
                                    }
                                ?>
                                    <div class="item">
                                        <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                                            <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo $img_src; ?>.jpg" class="img-responsive">
                                            <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                            <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                            <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                            <input type="hidden" name="productCategoryID" value="<?php echo $related->productCategory->product_category_id; ?>">
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
                                    
                            if (YII_ENV === 'dev') {
                                $img_src = Yii::$app->request->baseUrl . '/img/product/' . $related->productImage->product_image_id . '/' . $related->productImage->product_image_id;
                            } else {
                                $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $related->productImage->product_image_id . '/' . $related->productImage->product_image_id;
                            }
                        ?>
                        <?php foreach ($productRelated as $related) { ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 space related <?php echo $i % 2 == 0 ? 'left' : 'right' ?>">
                                <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                                    <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo $img_src; ?>.jpg" class="img-responsive">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($related->brands->brand_name); ?></div>
                                   
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-price">
									<?php echo strtoupper($related->productDetail->name); ?> <br/>
									IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></div>
                                    <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                    <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                    <input type="hidden" name="productCategoryID" value="<?php echo $related->productCategory->product_category_id; ?>">
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
                        <?php foreach ($productRelated as $related) { 
                            if (YII_ENV === 'dev') {
                                $img_src = Yii::$app->request->baseUrl . '/img/product/' . $related->productImage->product_image_id . '/' . $related->productImage->product_image_id;
                            } else {
                                $img_src = Yii::$app->params['imgixUrl'] . 'product/' . $related->productImage->product_image_id . '/' . $related->productImage->product_image_id;
                            }    
                        ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 space related <?php echo $i % 4 == 0 ? 'left' : 'right' ?>">
                                <a class="productClickRelated" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $related->productDetail->link_rewrite; ?>">
                                    <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo $img_src; ?>.jpg" class="img-responsive">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($related->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product product-price">
                                        <div style="display:block; margin-bottom:10px;">
                                            <?php echo strtoupper($related->productDetail->name); ?> 
                                        </div>    
                                        IDR <?php echo \common\components\Helpers::getPriceFormat($related->price); ?></div>
                                    <input type="hidden" name="productId" value="<?php echo $related->product_id; ?>">
                                    <input type="hidden" name="productName" value="<?php echo $related->productDetail->name; ?>">
                                    <input type="hidden" name="productPrice" value="<?php echo $related->price; ?>">
                                    <input type="hidden" name="brandName" value="<?php echo $related->brands->brand_name; ?>">
                                    <input type="hidden" name="productCategoryID" value="<?php echo $related->productCategory->product_category_id; ?>">
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

<?php

    $strap_petite_product = [1684, 1692, 1693, 2041, 2480, 2481, 2482, 2483, 2484, 2485, 2486, 2697, 2698, 3672, 3673, 3674, 3721, 3722, 3723, 3724];
    $strap_classic_product = [365, 367, 378, 382, 438, 439, 440, 441, 442, 443, 444, 445, 446, 447, 448, 465, 466, 467, 468, 469, 470, 471, 472, 1341, 1342, 2578, 2579, 2580, 2581, 3599, 3600, 3601, 3602, 3603, 3604, 3605, 3607, 3608, 3609, 3610, 3611, 3612, 3613, 3614, 3626, 3627, 3628, 3629, 3630, 3631];
    $strap_classy_product = [449, 450, 451, 452, 454, 455, 456, 457, 458, 459, 464, 3615, 3616, 3617, 3618, 3619, 3620, 3621, 3622, 3623, 3624, 3625];
    $strap_grace_product = [460, 461, 462, 463];

?>

<!-- <div class="modal fade" id="tipe1-dw-modal" style="">
    <div class="modal-dialog" role="document">
        <div class="modal-content" role="">
            <div class="modal-header">
                Pilih straps
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                <div class="row">
                <?php
                    

                    $product = \backend\models\Product::find()
                    ->joinWith([    
                        "productDetail",
                        "productImage"
                    ])
                    ->where(['product.product_id' => $strap_petite_product])
                    ->all();

                    foreach($product as $key => $value){
                        
                ?>
                        
                        <div class="hidden-sm col-lg-3 col-md-3 col-xs-6 mbottom-3-mobile" style="height:300px;">
                            <div style="position: relative;">
                                <div class="tag">
                                
                                </div>
                                <a class="productClick" href="/thewatch-v1/product/<?=$value['productDetail']->link_rewrite;?>">
                                    <img alt="Daniel Wellington Classic Bayswater 36mm" src="//thewatch.imgix.net/product/<?=$value['productImage']->product_image_id;?>/<?=$value['productImage']->product_image_id;?>.jpg?fit=max&amp;fm=pjpg" id="out-of-stock-2583" class="img-responsive out-of-stock">
                                    <span id="out-of-stock-caption-2583" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>                                
                                </a>
                            </div>
                            <input type="hidden" name="productId" value="<?=$value['productDetail']->product_id;?>">
                            <input type="hidden" name="productName" value="<?=$value['productDetail']->name;?>">
                            <input type="hidden" name="brandName" value="Daniel Wellington">
                            <input type="hidden" name="productCategory" value="straps">

                            <a class="productClick" href="/thewatch-v1/product/<?=$value['productDetail']->link_rewrite;?>">
                                <div class="col-lg-12 col-md-12 col-sm-12 product brand-title">
                                    DANIEL WELLINGTON 
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 product product-name">
                                    <span class="lspace0-5"><?=$value['productDetail']->name;?></span>
                                </div>
                                <input type="hidden" name="productPrice" value="0">
                            </a>
                        </div>
                <?php
                    }
                ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="tipe2-dw-modal" style="">
    <div class="modal-dialog" role="document">
        <div class="modal-content" role="">
            <div class="modal-header">
                Pilih straps
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                <div class="row">
                <?php
                    

                    $product = \backend\models\Product::find()
                    ->joinWith([    
                        "productDetail",
                        "productImage"
                    ])
                    ->where(['product.product_id' => $strap_classic_product])
                    ->all();

                    foreach($product as $key => $value){
                        
                ?>
                        
                        <div class="hidden-sm col-lg-3 col-md-3 col-xs-6 mbottom-3-mobile" style="height:300px;">
                            <div style="position: relative;">
                                <div class="tag">
                                
                                </div>
                                <a class="productClick" href="/thewatch-v1/product/classic-bayswater-36mm">
                                    <img alt="Daniel Wellington Classic Bayswater 36mm" src="//thewatch.imgix.net/product/<?=$value['productImage']->product_image_id;?>/<?=$value['productImage']->product_image_id;?>.jpg?fit=max&amp;fm=pjpg" id="out-of-stock-2583" class="img-responsive out-of-stock">
                                    <span id="out-of-stock-caption-2583" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>                                
                                </a>
                            </div>
                            <input type="hidden" name="productId" value="2583">
                            <input type="hidden" name="productName" value="Classic Bayswater 36mm">
                            <input type="hidden" name="brandName" value="Daniel Wellington">
                            <input type="hidden" name="opt_list" value="Brands - ">
                            <input type="hidden" name="productCategory" value="watches">
                            <input type="hidden" name="productPosition" value="1">

                            <a class="productClick" href="/thewatch-v1/product/classic-bayswater-36mm">
                                <div class="col-lg-12 col-md-12 col-sm-12 product brand-title">
                                    DANIEL WELLINGTON 
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 product product-name">
                                    <span class="lspace0-5"><?=$value['productDetail']->name;?></span>
                                </div>
                                <input type="hidden" name="productPrice" value="2450000">
                            </a>
                        </div>
                <?php
                    }
                ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tipe3-dw-modal" style="">
    <div class="modal-dialog" role="document">
        <div class="modal-content" role="">
            <div class="modal-header">
                Pilih straps
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                <div class="row">
                <?php
                    

                    $product = \backend\models\Product::find()
                    ->joinWith([    
                        "productDetail",
                        "productImage"
                    ])
                    ->where(['product.product_id' => $strap_classy_product])
                    ->all();

                    foreach($product as $key => $value){
                        
                ?>
                        
                        <div class="hidden-sm col-lg-3 col-md-3 col-xs-6 mbottom-3-mobile" style="height:300px;">
                            <div style="position: relative;">
                                <div class="tag">
                                
                                </div>
                                <a class="productClick" href="/thewatch-v1/product/classic-bayswater-36mm">
                                    <img alt="Daniel Wellington Classic Bayswater 36mm" src="//thewatch.imgix.net/product/<?=$value['productImage']->product_image_id;?>/<?=$value['productImage']->product_image_id;?>.jpg?fit=max&amp;fm=pjpg" id="out-of-stock-2583" class="img-responsive out-of-stock">
                                    <span id="out-of-stock-caption-2583" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>                                
                                </a>
                            </div>
                            <input type="hidden" name="productId" value="2583">
                            <input type="hidden" name="productName" value="Classic Bayswater 36mm">
                            <input type="hidden" name="brandName" value="Daniel Wellington">
                            <input type="hidden" name="opt_list" value="Brands - ">
                            <input type="hidden" name="productCategory" value="watches">
                            <input type="hidden" name="productPosition" value="1">

                            <a class="productClick" href="/thewatch-v1/product/classic-bayswater-36mm">
                                <div class="col-lg-12 col-md-12 col-sm-12 product brand-title">
                                    DANIEL WELLINGTON 
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 product product-name">
                                    <span class="lspace0-5"><?=$value['productDetail']->name;?></span>
                                </div>
                                <input type="hidden" name="productPrice" value="2450000">
                            </a>
                        </div>
                <?php
                    }
                ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<script type="text/javascript">
    function video_play_product(){
  $('div.image-thumb').css("display","none");
  $('div.video-thumb').css("display","block");
  $('div.zoomContainer').css("display","none");
  $('video').trigger('play');
  
    }
    function video_stop_product(){
  $('div.image-thumb').css("display","block");
  $('div.video-thumb').css("display","none");
  $('div.flash-thumb').css("display","none");
  $('div.zoomContainer').css("display","block");
  $('video').trigger('pause');
    }

    function flash_play_product(){
  $('div.image-thumb').css("display","none");
  $('div.flash-thumb').css("display","block");
  $('div.zoomContainer').css("display","none");
    }
</script>
