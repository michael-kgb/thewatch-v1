
<?php 
use app\assets\CampaignAsset;

CampaignAsset::register($this);

?>
<section id="breadcrumb-brand-detail">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<section class="ptop1 ptop-30-mobile">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright">
                <!--<a href="<?php echo \yii\helpers\Url::base(); ?>/upto40">-->
                    <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/campaign/banner-bundling-magazine.jpg' class="img-responsive">
                <!--</a>-->
            </div>
        </div>
    </div>
</section>

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
                            <table width="100%">
                                <tr>
                                    <td class="collection-name">
                                        <span class="collection-name col-xs-2 clearleft clearright">
                                            <?php echo $product->brandsCollection->brands_collection_name; ?>
                                        </span>
                                    </td>
                                    <td class="border-collection">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-header border-collection"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="container product-box">
                    <div class="row">
                        <?php
                        $group_active = $product->brandsCollection->brands_collection_name;
                    }
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 space <?php echo $i % 2 == 0 ? 'pleft75' : 'pright75'; ?>">
                        <input type="hidden" name="product_bundling_name_<?php echo $product->product_id; ?>" value="<?php echo $product->productDetail->name; ?>">
                        <input type="hidden" name="link-rewrite-bundling-<?php echo $product->product_id; ?>" value="<?php echo $product->productDetail->link_rewrite; ?>">
                        <input type="hidden" class="weight" name="weight_bundling_<?php echo $product->product_id; ?>" value="<?php echo $product->weight; ?>">
                        <input type="hidden" name="productCategoryBundling_<?php echo $product->product_id; ?>" value="<?php echo $product->productCategory->product_category_name; ?>">
                        <input type="hidden" name="brand_name_bundling_<?php echo $product->product_id; ?>" value="<?php echo $product->brands->brand_name; ?>">
                        <input type="hidden" name="product_bundling_price_<?php echo $product->product_id; ?>" value="<?php echo $product->price; ?>">
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
                            <a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
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
                                <?php  
                                if($stock != NULL){
                                ?>
                                <img id="<?php echo $product->product_id; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
                                <?php
                                    echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption hidden-xs" style="display: none;">OUT OF STOCK</span>' : ''; 
                                ?>
                                <?php 
                                } else {
                                ?><img id="<?php echo $product->product_id; ?>" src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                
                                <?php } ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace2 lspace-1mobile"><?php echo strtoupper($product->productDetail->name); ?></span></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2 lspace-1mobile">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 product product-price mtop5">
                                <a href="#" class="addtocartBundling" id="addtocartBundling" data-id="<?php echo $product->product_id; ?>">ADD TO CART</a>
                            </div>
                            <?php } ?>
                        </a>
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
                    <?php if ($i == $count) { ?>
                    </div>
                </div>
            <?php } ?>
            <?php $i++; ?>
        <?php } ?>
    </section>
<?php } ?>

<style>
    a.addtocartCampaign, a.addtocartBundling {
        border: 1px solid;
        cursor: pointer;
        padding: 11px 20px;
        letter-spacing: 2px;
        background: #000;
        color: #fff;
        font-family: "gotham-medium";
        font-size: 0.8em;
    }
    
    a.addtocartCampaign:hover, a.addtocartBundling:hover {
        border: 1px solid;
        cursor: pointer;
        padding: 11px 20px;
        letter-spacing: 2px;
        background: #fff;
        color: #000;
        font-family: "gotham-light";
    }
    
    @media only screen and (max-width : 767px) {
        a.notify-me, a.addtocart, a.addtocartBundling {
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