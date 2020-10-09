<?php 
\Cloudinary::config(array(
    "cloud_name" => "thewatch-co", 
    "api_key" => "517924523584363", 
    "api_secret" => "xVVa4kXkWCV6T6CGIIS0DemOg28" 
));
?>
<div class="hidden-lg hidden-md hidden-sm container">
<div class="row">
<div class="padding-homebanner"></div>
<div id="" class="swiper-container-homeban" style="overflow-x:hidden;position: relative;overflow-y:hidden;">
   
    
    <div class="swiper-wrapper clearleft clearright" style="">
        <?php if(count($data) > 0) { ?>
            <?php 
                $i=1;
                foreach($data as $row) { 
                    if($row->homebanner_images_mobile != ''){
            ?>
            <script>
            promotions.push({
                "id": "<?php echo $row->homebanner_name; ?>",
                "name": "<?php echo $row->homebanner_name; ?>",
                "creative": "Homebanner<?php echo $i; ?>",
                "position": "slot<?php echo $i; ?>"
            });
            </script>
            
                <!-- Set the first background image using inline CSS below. -->
                <?php if($row->homebanner_has_link == 1){ ?>
                <div class="swiper-slide">
                    <a id="homeBannerClick" href="<?php echo $row->homebanner_description; ?>">
                        <picture alt="<?php echo $row->homebanner_name; ?>">
 
                                <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images_mobile; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=414" media="
                                        (max-width: 767px) and (-webkit-min-device-pixel-ratio: 2),
                                        (max-width: 767px) and (min-resolution: 192dpi)
                                    ">
                                <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images_mobile; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=414" media="(max-width: 767px)">
            
        
                                <img alt="<?php echo $row->homebanner_description; ?>" class="img-responsive initial loading" src="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images_mobile; ?>?auto=compress%2Cformat&amp;fm=pjpg" data-was-processed="true">
    
                        </picture>
                    </a>
                </div>
                <?php } else { ?>
                <div class="swiper-slide">
                    <picture alt="<?php echo $row->homebanner_name; ?>">
                        
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images_mobile; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=414" media="
                                        (max-width: 767px) and (-webkit-min-device-pixel-ratio: 2),
                                        (max-width: 767px) and (min-resolution: 192dpi)
                                    ">
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images_mobile; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=414" media="(max-width: 767px)">
        
    
                            <img alt="<?php echo $row->homebanner_description; ?>" class="img-responsive initial loading" src="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images_mobile; ?>?auto=compress%2Cformat&amp;fm=pjpg" data-was-processed="true">
    
                        </picture>
                </div>
                <?php } ?>
                <!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
            
            <?php $i++; ?>
            <?php } } ?>
        <?php } ?>
    </div>
	<div class="homebanner-pagination" style="height:35px;z-index:10;"></div>
    <!-- Add Arrows -->
        <?php if(count($data) != 1) { ?>
                                                        <div class="swiper-button-next" style="background-image:none;top:42%;"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_gold.png" style="width: 45px;"></div>
                                                        <div class="swiper-button-prev" style="background-image:none;left:-5px;top:42%;"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_gold.png" style="width: 45px;"></div>
                                                      <?php } ?>
	<script>
	
	sendPromotionView = function(items){
		
		dataLayer.push({
			"ecommerce": {
				"promoView": {
				  "promotions": items
				}
			},
			//"event": "impressionsHomebanner"
		});
		
		return dataLayer;
	}
	
	sendPromotionView(promotions);
	</script>
    
</div>
</div>
</div>