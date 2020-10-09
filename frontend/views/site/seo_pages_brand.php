<section style=" padding: 0px 0;">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fff;z-index:1;">    
        <div class="container clearleft">
            <?php
                if($seo != NULL){
            ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs clearleft" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                        
                            <?php echo $seo->seoPagesContent->seo_footer_description_left;?>
                       
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs" style="padding-top: 30px; padding-bottom: 30px; text-align: justify;">
                            
                                <?php echo $seo->seoPagesContent->seo_footer_description_right;?>
                            
                    </div>
                    <!--mobile version-->
                    <div class="hidden-lg hidden-md hidden-sm" id="readmore" style="padding-top: 11px; padding-bottom: 1px; text-align: justify;">
                        <p class="show-read-more">
                            <?php
                                $text = $seo->seoPagesContent->seo_footer_description_left;
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
                    <div class="hidden-lg hidden-md hidden-sm" id="left" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            <?php echo $seo->seoPagesContent->seo_footer_description_left;?>
                        </p>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm" id="right" style="padding-top: 11px; padding-bottom: 1px; text-align: justify; display: none;">
                        <p class="show-read-more">
                            <?php echo $seo->seoPagesContent->seo_footer_description_right;?>
                        </p>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<style>
    p{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    show-read-more .more-text{
        display: none;
    }
</style>