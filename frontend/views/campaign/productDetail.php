<?php

use app\assets\ProductDetailAsset;

ProductDetailAsset::register($this);
?>

<section id="breadcrumb">
    
</section>

<section id="product-details">
    <div class="container clearleft clearright">
        <?php if (count($productImages) > 6) { ?>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="btn-prev"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-top-black.png" style="cursor: pointer"></div>
            </div>
            <div class="clearfix"></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs pright5-ipad">
                <?php if (count($productImages) > 0) { ?>

                    <div class="col-lg-2 col-md-2 col-sm-3 thumbnail-product" id="product-thumb">
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
                                                <img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_small.jpg" class="img-responsive">
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!--                        </div>-->
                        <?php if (count($productImages) > 6) { ?>
                            <div class="btn-next"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/btn-down-black.png" style="cursor: pointer"></div>
                        <?php } ?>
                    </div>

                    <?php foreach ($productImages as $image) { ?>
                        <?php if ($image->cover == 1) { ?>
                            <div class="col-lg-10 col-md-10 col-sm-9 clearleft-ipad">
                                <img id="product-img" data-zoom-image="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" class="img-responsive">
                            </div>
                            <?php
                            break;
                        }
                        ?>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 hidden-lg hidden-md hidden-sm">
                <header id="myCarousel" class="carousel slide brand" style="height: 550px; margin-top: 0px;">
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-name">
                    <span><?php echo strtoupper($product->productDetail->name); ?></span>
					<input type="hidden" name="product_name" value="<?php echo $product->productDetail->name; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                    <input type="hidden" name="link-rewrite" value="<?php echo $product->productDetail->link_rewrite; ?>">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail brand-name brand">
                    <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/brand/' . strtolower(str_replace(' ', '-', $product->brands->brand_name)); ?>" target="_blank">
                        <?php echo strtoupper($product->brands->brand_name); ?>
                    </a>
                    <input type="hidden" name="brand_name" value="<?php echo $product->brands->brand_name; ?>">
                </div>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 product-detail border"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail brand-name price">
                    PRICE
                </div>
                <?php
                // if product has discount
                $spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
                $discount = 0;
                $now = date('Y-m-d H:i:s');
                if ($spesificPrice != null) {
                    ?>
                    <?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price">
                            IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                            <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price">
                            <?php
                            if ($spesificPrice->reduction_type == 'percent') {
                                $discount = (($spesificPrice->reduction / 100) * $product->price);
                            } elseif ($spesificPrice->reduction_type == 'amount') {
                                $discount = $spesificPrice->reduction;
                            }
                            ?>
                            IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?>
                            <span class="discount-price mleft2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
                            <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                            <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                        </div>



                    <?php } ?>
                <?php } else { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price">
                        IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
                        <input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
                        <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                    </div>
                <?php } ?>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 product-detail border"></div>
				<input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-description clearright">
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
                    SPESIFICATIONS
                    <div class="ardown-spesification"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 product-detail product-spesification-after clearright">
                    SPESIFICATIONS
                    <div class="artop-spesification"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/top-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 contain-spesification">
                    <span class="lspace1"><?php echo $product->productDetail->spesification; ?></span>
                </div>
                <?php if($productWarranty != NULL && $productWarranty->warranty_id != 0){ ?>
                <div class="hidden-xs col-lg-12 hidden-md hidden-sm col-xs-12 product-detail border"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-warranty clearright">
                    WARRANTY
                    <div class="ardown-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 product-detail product-warranty-after clearright">
                    WARRANTY
                    <div class="artop-warranty"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/top-spec.png"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 contain-warranty clearleft">
                    <span><?php echo $productWarranty->warranty->warranty_name . ' ' . $productWarranty->product_warranty_year . ' Year Warranty'; ?></span>
                </div>
				<div class="col-lg-12 hidden-md hidden-sm product-detail border"></div>
                <?php } ?>
                
                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 product-detail product-total">
                    Total
                    <span id="loadingAjax" style="display: none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/loading-ajax.gif"></span>
                    <span class="product-total">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?></span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail border"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-select">
                    <?php $productStock = \backend\models\ProductStock::findOne(["product_id" => $id]); ?>
                    <?php if (count($productAttributeCombination) > 0) { ?>
                        <?php $productStock = \backend\models\ProductStock::find()->where(["product_id" => $id])->andWhere(['<>', 'product_attribute_id', 0])->one(); ?>
                        <select class="size margin-bottom-5 fleft" name="size" disabled="disabled">
                            <option value="0">Size</option>
                        </select>
                        <select class="color margin-bottom-5" name="color">
                            <option value="0">Color</option>
                            <?php foreach ($productAttributeCombination as $attribute) { ?>
                                <option attributeId="<?php echo $attribute->product_attribute_id; ?>" id="<?php echo $attribute->attributeValue->value; ?>" value="<?php echo $attribute->attributeValue->attribute_value_id; ?>"><?php echo $attribute->attributeValue->value; ?></option>
                            <?php } ?>
                        </select>
                        <div class="clearleft clearright" id="qty">
                            <select class="qty margin-bottom-5" name="qty" disabled="disabled">
                                <option value="0">Qty</option>
                            </select>
                        </div>
                    <?php } else { ?>
                        <select class="size margin-bottom-5 fleft" name="size" disabled="disabled">
                            <option value="0">Size</option>
                        </select>
                        <select class="color margin-bottom-5" name="color" disabled="disabled">
                            <option value="0">Color</option>
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
                                echo '<option value="0">Qty</option>';
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
                <?php if ($productStock->quantity > 0) { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-addtocart remove-padding">
                        <a href="#" class="addtocartCampaign" id="addtocartCampaign">ADD TO CART</a>
                    </div>
                    <?php if (count($productAttributeCombination) > 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-notifyme remove-padding" style="display: none;">
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>
                    <?php } ?>
                <?php } elseif ($productStock->quantity == 0) { ?>
                    <?php if (count($productAttributeCombination) > 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-addtocart remove-padding">
                            <a href="#" class="addtocartCampaign" id="addtocartCampaign">ADD TO CART</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 product-detail product-notifyme" style='display: none;'>
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-addtocart" style="display: none;">
                            <a href="#" class="addtocartCampaign" id="addtocartCampaign">ADD TO CART</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-notifyme">
                            <a href="#notifyModal" id="forgot" data-toggle="modal" class="notify-me">NOTIFY ME</a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="hidden-xs row product-detail share-box socmed">
            <div class="col-lg-1 col-md-1 col-sm-1">
                <div class="product-detail share">SHARE</div>
            </div>
            <div>
                <?php
                $image_cover = backend\models\ProductImage::find()->where(['product_id' => $product->product_id, 'cover' => 1])->one();
                ?>
                <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/instagram.png">-->
                <a class="pleft-4-ipad" target="popup" onclick="window.open('http://twitter.com/share?source=sharethiscom&amp;text=<?php echo $product->brands->brand_name . ' - ' . $product->productDetail->name; ?>. Shop now on The Watch Co.&amp;url=http://thewatch.co', 'name', 'width=600,height=400')">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twitter.png" style="cursor: pointer" class="pright1">
                </a>
                <a target="popup" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=1466455300249678&display=popup&caption=thewatch.co%20|%20<?php echo $product->brands->brand_name; ?>&description=<?php echo strip_tags(substr($product->productDetail->description, 0, 270)); ?>&name=<?php echo $product->brands->brand_name . ' - ' . $product->productDetail->name; ?>&link=http://thewatch.co&redirect_uri=http://thewatch.co&picture=http://development.kgbgroup.co.id/twcnew/img/product/0/sample2.jpg', 'name', 'width=600,height=400')">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/fb.png" style="cursor: pointer" class="pright1">
                </a>
                <a target="popup" onclick="window.open('https://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.thewatch.co&media=http://development.kgbgroup.co.id/twcnew/img/product/0/sample2.jpg&description=<?php echo strip_tags(substr($product->productDetail->description, 0, 100)); ?>', 'name', 'width=600,height=400')">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/pinterest.png" style="cursor: pointer" class="pright1">
                </a>
                <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line.png">-->
            </div>
        </div>
    </div>
</section>

<section id="product-related">
    <div class="container">
        <div class="row related-item-header">
            <table width="100%">
                <tr>
                    <td class="collection-name">
                        <span class="related-items-title col-xs-6 clearleft clearright">
                            CHOOSE YOUR FREE STRAP
                        </span>
                    </td>
                    <td class="border-collection">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-header border-collection"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php if(count($productCampaign) > 0){ ?>
    <div class="container product-box clearleft">
        <?php
        $i = 1;
        ?>
        <?php foreach($productCampaign as $product){ ?>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 space <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
            <input type="hidden" name="product_free_name_<?php echo $product->product_id; ?>" value="<?php echo $product->productDetail->name; ?>">
            <input type="hidden" name="link-rewrite-free-<?php echo $product->product_id; ?>" value="<?php echo $product->productDetail->link_rewrite; ?>">
            <input type="hidden" class="weight" name="weight_free_<?php echo $product->product_id; ?>" value="<?php echo $product->weight; ?>">
            <input type="hidden" name="productCategoryFree_<?php echo $product->product_id; ?>" value="<?php echo $product->productCategory->product_category_name; ?>">
            <input type="hidden" name="brand_name_free_<?php echo $product->product_id; ?>" value="<?php echo $product->brands->brand_name; ?>">
            <?php  
                $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                $productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
                $found = FALSE;
                foreach ($productStock as $attribute){
                    $productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                    if($productattribute != NULL && $attribute->quantity != 0){
                        $found = TRUE;
                    }
                }

                if($stock != NULL && !$found){
            ?>
            <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/campaign/product/<?php echo $product->productDetail->link_rewrite; ?>">
                <?php } else { ?>
                <a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                <?php } ?>
                    <div>
                        <div class="tag-collection">
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
                        <img id="<?php echo $product->product_id; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2 lspace-1mobile"><?php echo strtoupper($product->productDetail->name); ?></span></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2 lspace-1mobile line-through">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2 lspace-1mobile">IDR 0</span></div>
                </a>
                <?php 
                    $productAttributeCombination = \backend\models\ProductAttributeCombination::find()
                    ->joinWith([
                        "productAttribute",
                        "attributes",
                        "attributeValue",
                        "productStock"
                    ])
                    ->where(["product_attribute.product_id" => $product->product_id])
                    ->all(); 
                    $available = FALSE;
                    if(count($productAttributeCombination) > 0) {
                        foreach($productAttributeCombination as $attribute){
                            $quantity = \backend\models\ProductStock::findOne(["product_attribute_id" => $attribute->productAttribute->product_attribute_id]);
                            if($quantity->quantity != 0){
                                $available = TRUE;
                            }
                        }
                    } else {
                        $stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
                        if($stock->quantity > 0){
                            $available = TRUE;
                        }
                    }
                    // if product out of stock
                                    if(!$available){
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 product product-price">
                    Out Of Stock
                </div>
                <?php } else { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 product product-price">
                    <select class="color-straps margin-bottom-5" name="straps-color-<?php echo $product->product_id; ?>">
                        <option value="0">Color</option>
                        <?php foreach ($productAttributeCombination as $attribute) { ?>
                            <?php 
                            $stock = backend\models\ProductStock::findOne(['product_attribute_id' => $attribute->productAttribute->product_attribute_id]); 
                            if($stock->quantity > 0){
                            ?>
                                <option attributeId="<?php echo $attribute->product_attribute_id; ?>" id="<?php echo $attribute->attributeValue->value; ?>" value="<?php echo $attribute->attributeValue->attribute_value_id; ?>"><?php echo $attribute->attributeValue->value; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 product product-price mtop5">
                    <a href="#" class="addtocartFree" id="addtocartFree" data-id="<?php echo $product->product_id; ?>">ADD TO CART</a>
                </div>
                <?php } ?>
                
        </div>
            <?php
                if($i % 4 == 0){
                    echo '<div class="hidden-xs hidden-sm clearfix"></div>';
                }
                if($i % 3 == 0){
                    echo '<div class="hidden-xs hidden-lg hidden-md clearfix"></div>';
                }
                if($i % 2 == 0){
                    echo '<div class="hidden-lg hidden-md hidden-sm clearfix"></div>';
                }
            ?>
        <?php $i++; ?>
        <?php } ?>
    </div>
    <?php } ?>
</section>

<style>
    a.addtocartCampaign, a.addtocartFree {
        border: 1px solid;
        cursor: pointer;
        padding: 11px 20px;
        letter-spacing: 2px;
        background: #000;
        color: #fff;
        font-family: "gotham-medium";
        font-size: 0.8em;
    }
    
    a.addtocartCampaign:hover, a.addtocartFree:hover {
        border: 1px solid;
        cursor: pointer;
        padding: 11px 20px;
        letter-spacing: 2px;
        background: #fff;
        color: #000;
        font-family: "gotham-light";
    }
    
    #owl-demo .item{
        margin: 3px 3px 3px 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }

    .owl-carousel .owl-wrapper-outer {
        width: 99%;
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
    
    @media only screen and (min-width : 768px) {
        select.color-straps {
            font-family: "gotham-medium";
            padding: 5px 5% 5px 8px;
            z-index:2;
            position:relative;
            line-height:115%;
            letter-spacing:1px;
            border:1px solid #000;
            background: url(http://thewatch.co/img/icons/down-combo-copy.png) no-repeat right #FFFFFF;
            -webkit-appearance:none;
            -moz-appearance:none;
            text-indent:.01px;
            text-overflow:'';
            border-radius:0;
            width: 50%;
        }
    }
    
    @media only screen and (max-width : 767px) {
        a.notify-me, a.addtocart, a.addtocartFree {
            /* border: 1px solid; */
            cursor: pointer;
            padding: 11px 10px 11px 10px;
            letter-spacing: 2px;
            background: #000;
            color: #fff;
            font-family: "gotham-medium";
            font-size: 0.8em;
        }
    }
</style>