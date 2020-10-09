<?php

use app\assets\PromoAsset;

PromoAsset::register($this);

?>

<section id="breadcrumb-promo">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<section class="ptop1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop2 remove-padding clearleft clearright">
                    <div class='col-lg-12 col-md-12 col-sm-12 ptop2 col-xs-12 remove-padding-left remove-padding-right clearleft clearright'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/dwsummer">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/dwsummer/dwpromo.jpg' class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mtop5 talign-center">
            <span class="gotham-medium fsize-2">AVAILABLE WATCHES</span>
        </div>
        <div id="owl-demo2" class="owl-carousel mtop5">
            <?php 
            if (count($products) > 0) { 
            function limit_text($text, $limit) {
                if (str_word_count($text, 0) > $limit) {
                    $words = str_word_count($text, 2);
                    $pos = array_keys($words);
                    $text = substr($text, 0, $pos[$limit]);
                }
                return $text;
            }    
            ?>
            <?php $i = 1; ?>
                <?php foreach ($products as $product) { ?>
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
                    ?>
                    <?php if($i == 1){ ?>
                    <div class="item">
                    <?php } ?>   
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom20">
                            <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                <img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright"><?php echo strtoupper($product->productDetail->name); ?></div>
                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-price">
                                    IDR 
                                    <?php 
                                    if(strpos(strtoupper($product->productDetail->name), "LEATHER") !== FALSE){
                                        echo \common\components\Helpers::getPriceFormat($product->price - 300000);
                                    } else {
                                        echo \common\components\Helpers::getPriceFormat($product->price - 200000);
                                    }
                                    ?>
                                </div>
                            </a>

                                <?php  
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
                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright mtop2"><input type="checkbox" name="hgwatches" disabled></div>
                                <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright">OUT OF STOCK</div>
                                    <?php } else { ?>
                                    <?php //if(count($productAttributeCombination) > 0){ ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright">
                                            <?php if(count($productAttributeCombination) > 0){ ?>
                                            <select name="color">
                                                <?php foreach ($productAttributeCombination as $attribute) { ?>
                                                    <?php 
                                                    $stock = backend\models\ProductStock::findOne(['product_attribute_id' => $attribute->productAttribute->product_attribute_id]); 
                                                    if($stock->quantity > 0){
                                                    ?>
                                                        <option id="<?php echo $attribute->attributeValue->value; ?>" value="<?php echo $attribute->attributeValue->attribute_value_id; ?>"><?php echo $attribute->attributeValue->value; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <?php } ?>
                                        </div>
                                    <?php //} ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright mtop2"><input type="checkbox" name="hgwatches"></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearleft clearright pbottom10"></div>
                                    <?php } ?>
                                <?php //} ?>
                        </div>
                    <?php if($i == 1){ ?>
                    </div>
                    <?php $i = 0; ?>
                    <?php } ?>
                    <?php $i++; ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="row mtop5 talign-center">
            <span class="gotham-medium fsize-2">AVAILABLE STRAPS</span>
        </div>
        <div class="row mtop5">
            <div id="owl-demo2" class="owl-carousel">
                <?php 
                if (count($straps) > 0) { 
                    function limit_text($text, $limit) {
                        if (str_word_count($text, 0) > $limit) {
                            $words = str_word_count($text, 2);
                            $pos = array_keys($words);
                            $text = substr($text, 0, $pos[$limit]);
                        }
                        return $text;
                    }    
                ?>
                <?php $i = 1; ?>
                    <?php foreach ($straps as $product) { ?>
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
                        ?>
                        <?php if($i == 1){ ?>
                        <div class="item">
                        <?php } ?>   
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mbottom20">
                                <a target="_blank" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
                                    <img src="<?php echo Yii::$app->params['cloudfrontDev'] ?>img/product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                    <div class="col-lg-12 col-md-12 col-sm-12 product gotham-medium brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 promo-hg gotham-light clearleft clearright"><?php echo strtoupper(limit_text($product->productDetail->name, 2)); ?></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-price">
                                        IDR 
                                        <?php 
                                        if(strpos(strtoupper($product->productDetail->name), "LEATHER") !== FALSE){
                                            echo \common\components\Helpers::getPriceFormat($product->price - 300000);
                                        } else {
                                            echo \common\components\Helpers::getPriceFormat($product->price - 200000);
                                        }
                                        ?>
                                    </div>
                                </a>
                                    
                                    <?php  
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright mtop2"><input type="checkbox" name="hgwatches" disabled></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright">OUT OF STOCK</div>
                                        <?php } else { ?>
                                        <?php //if(count($productAttributeCombination) > 0){ ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright">
                                                <?php if(count($productAttributeCombination) > 0){ ?>
                                                <select name="color">
                                                    <?php foreach ($productAttributeCombination as $attribute) { ?>
                                                        <?php 
                                                        $stock = backend\models\ProductStock::findOne(['product_attribute_id' => $attribute->productAttribute->product_attribute_id]); 
                                                        if($stock->quantity > 0){
                                                        ?>
                                                            <option id="<?php echo $attribute->attributeValue->value; ?>" value="<?php echo $attribute->attributeValue->attribute_value_id; ?>"><?php echo $attribute->attributeValue->value; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <?php } ?>
                                            </div>
                                        <?php //} ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 product gotham-light product-name clearleft clearright mtop2"><input type="checkbox" name="hgwatches"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 gotham-light clearleft clearright pbottom10"></div>
                                        <?php } ?>
                                    <?php //} ?>
                            </div>
                        <?php if($i == 4){ ?>
                        </div>
                        <?php $i = 0; ?>
                        <?php } ?>
                        <?php $i++; ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<style>
    #owl-demo .item{
        margin: 3px 3px 3px 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    
    #owl-demo2 .item{
        margin: 3px 3px 3px 3px;
    }
    #owl-demo2 .item img{
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
        top: 25%;
    }

    .owl-theme .owl-controls .owl-buttons .owl-next{
        right: -53px;
        top: 25%;
    }

    .owl-theme .owl-controls .owl-buttons div {
        background: transparent;
    }

    .owl-pagination{
        display: none;
    }
    .owl-item { padding-right: 0; }
</style>