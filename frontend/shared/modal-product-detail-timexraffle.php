<div class="popup-product-wrap modal-wrap" id="popup-product-wrap2">
    <div class="popup-product">
        <div onclick="closeShop()" class="close-btn close-button-popup">
            <img src="https://thewatch.imgix.net/icons/close-round.png" alt="icon" />
        </div>
        <div class="img-product">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <input type="hidden" name="product_name" value="<?php echo $product->productDetail->name; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                <input type="hidden" name="link-rewrite" value="<?php echo $product->productDetail->link_rewrite; ?>">
                <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                <input type="hidden" name="brand_name" value="<?php echo $product->brands->brand_name; ?>">
                <input type="hidden" name="productCategoryID" value="<?php echo $product->productCategory->product_category_id; ?>">
                <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                <input type="hidden" name="productCategoryDesc" value="<?php echo $product->productCategory->product_category_description; ?>">
                <input type="hidden" class="flash_sale" name="flash_sale" value="0">
                <input type="hidden" class="pre_order" name="pre_order" value="0">



                    <div class="col-lg-2 col-md-2 col-sm-12 thumbnail-product clearleft " id="product-thumb">
                        <ul id="thumb-small">
                            <?php 
                            /*
                            $img_seq = 0; 
                            foreach ($productImages as $image) { ?>
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
                                
                                <li class="small-thumb" 
                                id="<?php echo $attributeId; ?>" 
                                data-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" 
                                data-zoom-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg">
                                    <a href="#" onclick="video_stop_product();" class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" 
                                        data-zoom-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg">
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_small.jpg" class="img-responsive">
                                    </a>
                                </li>
                                <?php $img_seq++;?>
                            <?php } */?>

                            <li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6557/6557_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6557/6557_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6557/6557_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6557/6557_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6557/6557_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                            <li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6555/6555_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6555/6555_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6555/6555_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6555/6555_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6555/6555_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							<li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6556/6556_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6556/6556_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6556/6556_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6556/6556_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6556/6556_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                            <li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6558/6558_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6558/6558_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6558/6558_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6558/6558_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6558/6558_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							<li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6559/6559_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6559/6559_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6559/6559_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6559/6559_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6559/6559_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 clearleft-ipad clearright clearleft image-thumb" style="display: block;">
                        <img alt="https://thewatch.imgix.net/product/6557/6557_big.jpg" 
                        id="product-img" 
                        src="https://thewatch.imgix.net/product/6557/6557_big.jpg" 
                        class="img-responsive">
                    </div>
             

            </div>
        </div>
        <div class="form-product form-content">
            
            <div class="form-product-brand-full">Q TIMEX 1979 REISSUE</div>
            <p>
				The trd of the much sought after "mirrored face" watch series; inspired by the "Tokoya Dokei (Barbar's watch)", designed for quick time-reading whilst getting a haircut. Commemorating BEAMS BOY 20th Anniversary, the new series comes in a stainless steel case. An exquisite piece, perfectly melding the playful energy of ENGINEERED GARMENTS and the rugged toughness of TIMEX.
            </p>
            
            <div class="form-modal-product">
                <div class="wrap-select">
                    

                <button class="rounded-button green-btn no-border">Register</button>
                    
                        
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="popup-product-wrap modal-wrap" id="popup-product-wrap">
    <div class="popup-product">
        <div onclick="closeShop()" class="close-btn close-button-popup">
            <img src="https://thewatch.imgix.net/icons/close-round.png" alt="icon" />
        </div>
        <div class="img-product">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <input type="hidden" name="product_name" value="<?php echo $product->productDetail->name; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                <input type="hidden" name="link-rewrite" value="<?php echo $product->productDetail->link_rewrite; ?>">
                <input type="hidden" class="original_price" name="original_price" value="<?php echo $product->price; ?>">
                <input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
                <input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
                <input type="hidden" name="brand_name" value="<?php echo $product->brands->brand_name; ?>">
                <input type="hidden" name="productCategoryID" value="<?php echo $product->productCategory->product_category_id; ?>">
                <input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
                <input type="hidden" name="productCategoryDesc" value="<?php echo $product->productCategory->product_category_description; ?>">
                <input type="hidden" class="flash_sale" name="flash_sale" value="0">
                <input type="hidden" class="pre_order" name="pre_order" value="0">



                    <div class="col-lg-2 col-md-2 col-sm-12 thumbnail-product clearleft " id="product-thumb">
                        <ul id="thumb-small">
                            <?php 
                            /*
                            $img_seq = 0; 
                            foreach ($productImages as $image) { ?>
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
                                
                                <li class="small-thumb" 
                                id="<?php echo $attributeId; ?>" 
                                data-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" 
                                data-zoom-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg">
                                    <a href="#" onclick="video_stop_product();" class="small-thumb" id="<?php echo $attributeId; ?>" data-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_medium.jpg" 
                                        data-zoom-image="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_big.jpg">
                                        <img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $image->product_image_id . '/' . $image->product_image_id; ?>_small.jpg" class="img-responsive">
                                    </a>
                                </li>
                                <?php $img_seq++;?>
                            <?php } */?>

                            <li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6557/6557_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6557/6557_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6557/6557_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6557/6557_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6557/6557_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                            <li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6555/6555_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6555/6555_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6555/6555_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6555/6555_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6555/6555_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							<li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6556/6556_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6556/6556_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6556/6556_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6556/6556_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6556/6556_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                            <li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6558/6558_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6558/6558_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6558/6558_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6558/6558_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6558/6558_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							<li class="small-thumb" id="0" 
                            data-image="https://thewatch.imgix.net/product/6559/6559_medium.jpg" 
                            data-zoom-image="https://thewatch.imgix.net/product/6559/6559_big.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="https://thewatch.imgix.net/product/6559/6559_medium.jpg" 
                                data-zoom-image="https://thewatch.imgix.net/product/6559/6559_big.jpg">
                                    <img alt="" 
                                    src="https://thewatch.imgix.net/product/6559/6559_small.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 clearleft-ipad clearright clearleft image-thumb" style="display: block;">
                        <img alt="https://thewatch.imgix.net/product/6557/6557_big.jpg" 
                        id="product-img" 
                        src="https://thewatch.imgix.net/product/6557/6557_big.jpg" 
                        class="img-responsive">
                    </div>
             

            </div>
        </div>
        <div class="form-product form-content">
            
            <div class="form-product-brand-full">Q TIMEX 1979 REISSUE</div>
            <p>
				The trd of the much sought after "mirrored face" watch series; inspired by the "Tokoya Dokei (Barbar's watch)", designed for quick time-reading whilst getting a haircut. Commemorating BEAMS BOY 20th Anniversary, the new series comes in a stainless steel case. An exquisite piece, perfectly melding the playful energy of ENGINEERED GARMENTS and the rugged toughness of TIMEX.
            </p>
            
            <div class="form-modal-product">
                <div class="wrap-select">
                    

                <button class="rounded-button green-btn no-border">Register</button>
                    
                        
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

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