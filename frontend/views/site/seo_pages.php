<section class="p0">
    <div class="col-lg-12 col-md-12 col-sm-12 bgcolorfff zindex1">    
        <div class="container clearleft clearright">
            <?php
                if($seo>0){
                    foreach ($seo as $content){ 
            ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft seo-description-left">
                        
                            <?php echo $content->seo_footer_description_left;?>
                       
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearright seo-description-right">
                            
                                <?php echo $content->seo_footer_description_right;?>
                            
                    </div>
                    <!--mobile version-->
                    <div class="hidden-lg hidden-md hidden-sm seo-read-more" id="readmore">
                        <p class="show-read-more">
                            <?php
                                $text = $content->seo_footer_description_left;
                                if (strlen($text) > 300) {
                                    $shortText = substr($text, 0, 375);
                                    $shortText .= '...</br></br><a>(Baca Selengkapnya)</a>';
                                }else {
                                    $shortText = $text;
                                }

                                echo $shortText;
                            ?>
                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="left">
                        <p class="show-read-more">
                            <?php echo $content->seo_footer_description_left;?>
                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="right">
                        <p class="show-read-more">
                            <?php echo $content->seo_footer_description_right;?>
                        </p>
                    </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</section>