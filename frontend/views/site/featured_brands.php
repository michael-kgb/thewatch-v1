<section id="featured-brands" class="p0">
    <div class="container category">
        <div class="row">
           
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption">BRAND</div>
           
        </div>
    </div>
    <div class="container clearleft clearright">
        <div id="" class="swiper-container-brands hidden-lg hidden-md hidden-sm col-xs-12 clearleft-mobile clearright-mobile">
   
            <div class="swiper-wrapper clearleft clearright">
                <?php if (count($data) > 0) { ?>
                    <?php foreach ($data as $row) { ?>
                        <div class="swiper-slide">
                            <div class="col-xs-12 brand clearleft-mobile clearright-mobile">
                                <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . $row->link_rewrite; ?>">
                                    <img src="https://thewatch.imgix.net/brands/<?php echo $row->brand_logo_home; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-brands bradius5">
                                </a>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php } ?>
               <?php } ?>
                
            </div>
          
            <!-- Add Arrows -->
                <?php if(count($data) != 1) { ?>
                    <div class="swiper-button-next brand-swipe featured-brands"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_white.png" width="25"></div>
                    <div class="swiper-button-prev brand-swipe featured-brands"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_white.png" width="25"></div>
                <?php } ?>
            
        </div>
        <div id="" class="swiper-container-brands-desktop hidden-xs col-lg-12 clearleft clearright">
   
    
            <div class="swiper-wrapper clearleft clearright">
                <?php if (count($data) > 0) { ?>
                    <?php foreach ($data as $row) { ?>
                        <div class="swiper-slide">
                            <div class="col-lg-12 col-md-12 col-sm-12 brand clearleft">
                                <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . $row->link_rewrite; ?>">
                                    <img src="https://thewatch.imgix.net/brands/<?php echo $row->brand_logo_home; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-brands bradius5">
                                </a>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php } ?>
               <?php } ?>
                
            </div>
          
            <!-- Add Arrows -->
                <?php if(count($data) != 1) { ?>
                    <!--<div class="swiper-pagination" style="height:0px;margin-top:70px;"></div>-->

                    <div class="swiper-button-next featured-brands"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/next_slide_white.png" width="40"></div>
                    <div class="swiper-button-prev featured-brands"><img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/icons/prev_slide_white.png" width="40"></div>
                                                              <?php } ?>
            
        </div>

       
        
       
    </div>
</section>