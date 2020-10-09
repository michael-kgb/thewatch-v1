<div class="popup-product-wrap modal-wrap" id="popup-product-wrap">
    <div class="popup-product" style="height:500px !important;">
        <div onclick="closeShop()" class="close-btn close-button-popup">
            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-round.png" alt="icon" />
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

                <?php 
                
                if (count($productImages) > 0) { ?>

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
                            data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/1.jpg" 
                            data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/1.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/1.jpg" 
                                data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/1.jpg">
                                    <img alt="" 
                                    src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/1.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							 <li class="small-thumb" id="0" 
                            data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/2.jpg" 
                            data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/2.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/2.jpg" 
                                data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/2.jpg">
                                    <img alt="" 
                                    src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/2.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							<li class="small-thumb" id="0" 
                            data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/3.jpg" 
                            data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/3.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/3.jpg" 
                                data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/3.jpg">
                                    <img alt="" 
                                    src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/3.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                            <li class="small-thumb" id="0" 
                            data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/4.jpg" 
                            data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/4.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/4.jpg" 
                                data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/4.jpg">
                                    <img alt="" 
                                    src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/4.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							<li class="small-thumb" id="0" 
                            data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/5.jpg" 
                            data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/5.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/5.jpg" 
                                data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/5.jpg">
                                    <img alt="" 
                                    src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/5.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
							<li class="small-thumb" id="0" 
                            data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/6.jpg" 
                            data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/6.jpg" 
                            style="overflow: hidden; float: none; width: 50px; height: 69px;">
                                <a href="#" onclick="video_stop_product();" class="small-thumb active" id="0" 
                                data-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/6.jpg" 
                                data-zoom-image="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/6.jpg">
                                    <img alt="" 
                                    src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/6.jpg" 
                                    class="img-responsive">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 clearleft-ipad clearright clearleft image-thumb" style="display: block;">
                        <img alt="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/1.jpg" 
                        id="product-img" 
                        src="<?php echo \yii\helpers\Url::base(); ?>/img/landing/timexbeams2/product/1.jpg" 
                        class="img-responsive" style="height:465px;">
                    </div>
             
                <?php } ?>
            </div>
        </div>
        <div class="form-product form-content">
            <div class="form-product-brand">TIMEX</div>
            <div class="form-product-brand-full">TIMEX X BEAMS X ENGINEERD GARMENTS</div>
            <div class="form-product-price">Price IDR <?php echo number_format(($product->price - $discount),2,',','.'); ?></div>
                    
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#menu1">Description</a></li>
                <li><a data-toggle="tab" href="#menu2">Specification</a></li>
				<li><a data-toggle="tab" href="#menu3"> Product & Size Info</a></li>
            </ul>

                <div class="tab-content">
                   
                    <div id="menu1" class="tab-pane tab-custom active">
                    <p>
						The third of the much sought after "mirrored face" watch series; inspired by the "Tokoya Dokei (Barbar's watch)", designed for quick time-reading whilst getting a haircut. Commemorating BEAMS BOY 20th Anniversary, the new series comes in a stainless steel case. An exquisite piece, perfectly melding the playful energy of ENGINEERED GARMENTS and the rugged toughness of TIMEX.
                    </p>
                    </div>
                    <div id="menu2" class="tab-pane fade tab-custom">
                    <table style="width:384px" cellspacing="0" cellpadding="0" border="0" class="spec-table">
						<tbody>
							<tr>
								<td colspan="2" style="height:20px"><b>Water Resistance</b></td>
								<td>: 30m</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td style="height:20px"><b>Strap</b></td>
								<td>&nbsp;</td>
								<td colspan="2">: Black Fabric</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Case Color</b></td>
								<td>: Silver</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Case Height</b></td>
								<td>: 9mm</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Case Lug Width</b></td>
								<td>: 18mm</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Case Width</b></td>
								<td>: 36mm</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Case Material</b></td>
								<td>: Stainless steel</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Crystal/Glass</b></td>
								<td>: Acrylic&nbsp;&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Dial Color</b></td>
								<td>: Black</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" style="height:20px"><b>Movement</b></td>
								<td>: Quartz</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td style="height:20px"><b>Finish</b></td>
								<td>&nbsp;</td>
								<td colspan="2">: Polished</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</tbody>
					</table>
                    </div>
                
                
					<div id="menu3" class="tab-pane fade tab-custom">
						<p>
							(get 1 free Timex Magazine)
						</p>
                    </div>
				</div>
            
            <div class="form-modal-product" style="bottom:15px !important;">
                <div class="wrap-select">
                    

					<?php
					// echo "as product stock" . var_dump($productStock);
//                            $productStock = \backend\models\ProductStock::findOne(["product_id" => $id]);
							
                            if ($stock == 0) {
                                echo '<div style="width: 100%" class="col-sm-12 col-xs-12 qty gotham-medium fsize-1 quantity-out-of-stock pleft1">';
                                echo 'Out Of Stock';
                                echo '</div>';
								?>
								<button class="rounded-button green-btn no-border btn-disabled">Beli</button>
								<?php
                            } else {
                                echo '<select class="rounded-input-select rounded-input quantity">';
                                echo '<option value="0" disabled selected>Jumlah</option>';
								$max = 3;
                                for ($i = 1; $i <= $stock; $i++) {
									if($i <= $max){
										echo '<option value="' . $i . '">' . $i . '</option>';
											if($check_flash == 1){
											if($i == 1){
												break;
											}
										}
									}
                                    
                                    
                                    
                                }
                                echo '</select>';
								?>
								
								<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-arrow-16.png" />
								<button class="rounded-button green-btn no-border" onclick="popupBeli()">Beli</button>
								<?php
                            }
                            ?>
                    
                        
                    
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