<?php 
\Cloudinary::config(array(
    "cloud_name" => "thewatch-co", 
    "api_key" => "517924523584363", 
    "api_secret" => "xVVa4kXkWCV6T6CGIIS0DemOg28" 
));
?>
<div class="hidden-xs homeban">
<div class="row">
<div class="padding-homebanner" style="padding-top:0;"></div>
<header id="myCarousel" class="carousel slide carousel-fade">
    <?php if(count($data) > 0) { ?>

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php 
                $i=0;
                foreach($data as $row) { 
            ?>
                <li style="<?php if($i == (count($data)-1)){echo 'margin-right:0;';}?>" data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $row->homebanner_sequence === 1 ? 'active' : ''; ?>"></li>
                <?php $i++; ?>
            <?php } ?>
        </ol>

    <?php } ?>
    <!-- Wrapper for Slides -->
    <!--<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1 carousel-inner clearleft clearright">-->
    <div class="carousel-inner clearleft clearright">
        <?php if(count($data) > 0) { ?>
            <?php 
                $i=1;
                foreach($data as $row) { 
            ?>
			<script>
			promotions.push({
				"id": "<?php echo $row->homebanner_name; ?>",
				"name": "<?php echo $row->homebanner_name; ?>",
				"creative": "Homebanner<?php echo $i; ?>",
				"position": "slot<?php echo $i; ?>"
			});
			</script>
            <div class="item <?php echo $row->homebanner_sequence === 1 ? 'active' : ''; ?>">
                <!-- Set the first background image using inline CSS below. -->
                <?php if($row->homebanner_has_link == 1){ ?>
                <a id="homeBannerClick" href="<?php echo $row->homebanner_description; ?>">
                    <picture alt="<?php echo $row->homebanner_name; ?>">

                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=2560" media="(min-width: 2560px)">

                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=3840" media="
                                    (min-width: 1400px) and (-webkit-min-device-pixel-ratio: 2),
                                    (min-width: 1400px) and (min-resolution: 192dpi)
                                ">
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1920" media="(min-width: 1400px)">
    
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=2800" media="
                                    (min-width: 1200px) and (-webkit-min-device-pixel-ratio: 2),
                                    (min-width: 1200px) and (min-resolution: 192dpi)
                                ">
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1400" media="(min-width: 1200px)">
                            
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=2000" media="
                                        (min-width: 992px) and (-webkit-min-device-pixel-ratio: 2),
                                        (min-width: 992px) and (min-resolution: 192dpi)
                                    ">
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1000" media="(min-width: 992px)">
    
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1500" media="
                                        (min-width: 768px) and (-webkit-min-device-pixel-ratio: 2),
                                        (min-width: 768px) and (min-resolution: 192dpi)
                                    ">
                            <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=750" media="(min-width: 768px)">
    
                            
                            <img alt="<?php echo $row->homebanner_description; ?>" class="img-responsive initial loading" src="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fm=pjpg" data-was-processed="true">
                      
                    </picture>
                    
            
                </a>
                <?php } else { ?>
                    <picture alt="<?php echo $row->homebanner_name; ?>">
                        
                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=2560" media="(min-width: 2560px)">

                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=3840" media="
                                (min-width: 1400px) and (-webkit-min-device-pixel-ratio: 2),
                                (min-width: 1400px) and (min-resolution: 192dpi)
                            ">
                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1920" media="(min-width: 1400px)">

                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=2800" media="
                                (min-width: 1200px) and (-webkit-min-device-pixel-ratio: 2),
                                (min-width: 1200px) and (min-resolution: 192dpi)
                            ">
                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1400" media="(min-width: 1200px)">
                        
                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=2000" media="
                                    (min-width: 992px) and (-webkit-min-device-pixel-ratio: 2),
                                    (min-width: 992px) and (min-resolution: 192dpi)
                                ">
                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1000" media="(min-width: 992px)">

                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=1500" media="
                                    (min-width: 768px) and (-webkit-min-device-pixel-ratio: 2),
                                    (min-width: 768px) and (min-resolution: 192dpi)
                                ">
                        <source srcset="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fit=max&amp;fm=pjpg&amp;w=750" media="(min-width: 768px)">

                        
                        <img alt="<?php echo $row->homebanner_description; ?>" class="img-responsive initial loading" src="https://thewatch.imgix.net/homebanner/<?php echo $row->homebanner_images; ?>?auto=compress%2Cformat&amp;fm=pjpg" data-was-processed="true">

                    </picture>
                <?php } ?>
                <!--<div class="fill img-responsive" style="background-image:url('<?php // echo \yii\helpers\Url::base(); ?>/img/homebanner/<?php // echo $row->homebanner_images; ?>');"></div>-->
            </div>
			<?php $i++; ?>
            <?php } ?>
        <?php } ?>
    </div>
	
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
    
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <img class="carousel-control-homeban" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_gold.png" style="width: 40px;margin-left: 50px;">
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <img class="carousel-control-homeban" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_gold.png" style="width: 40px;margin-right: 50px;">
    </a>
</header>
</div>
</div>