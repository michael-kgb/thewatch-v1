<?php use yii\db\Expression; ?>
<section id="category">
    <?php if (count($data) > 0) { ?>
                
                <div class="container">
                    <div class="row">
                    <a href="<?php echo \yii\helpers\Url::base() . '/watches/all-product?&gender=male&price=0--50000000&sortby=none&page=1&limit=20'; ?>">
                        <div class="col-lg-4 hidden-md hidden-sm hidden-xs clearleft clearright img-gender kiri1 relative">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/pria04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width img-gender2 bradius5 width100">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Pria</div> 
                            </div>       
                                                                                                  
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 relative mbottom15">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/priam04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Pria</div>  
                            </div>       
                        </div>
                        <div class="hidden-lg col-md-4 col-sm-4 hidden-xs mbottom15 relative pright75 pleft75">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/pria04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Pria</div>   
                            </div>       
                        </div>


                    </a>
                    <a href="<?php echo \yii\helpers\Url::base() . '/watches/all-product?&gender=unisex&price=0--50000000&sortby=none&page=1&limit=20'; ?>">
                        <div class="col-lg-4 hidden-md hidden-sm hidden-xs clearleft clearright img-gender kiri1 relative">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/unisex04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width img-gender2 bradius5 width100">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Uniseks</div>          
                            </div>       
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 relative mbottom15">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/unisexm04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Uniseks</div>      
                            </div>       
                        </div>
                        <div class="hidden-lg col-md-4 col-sm-4 hidden-xs relative mbottom15 pleft75 pright75">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/unisex04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Uniseks</div>         
                            </div>       
                        </div>
                    </a>
                    <a href="<?php echo \yii\helpers\Url::base() . '/watches/all-product?&gender=female&price=0--50000000&sortby=none&page=1&limit=20'; ?>">
                        <div class="col-lg-4 hidden-md hidden-sm hidden-xs clearleft clearright img-gender relative">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/wanita04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width img-gender2 bradius5 width100">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Wanita</div> 
                            </div>                                                                        
                        </div>
                        <div class="hidden-lg hidden-md hidden-sm col-xs-12 relative mbottom15">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/wanitam04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Wanita</div> 
                            </div>                                                                        
                        </div>
                        <div class="hidden-lg col-md-4 col-sm-4 hidden-xs relative mbottom15 pleft75 pright75">
                            <div class="category-image img-gender2 relative bradius5">
                                <img src="https://thewatch.imgix.net/category/wanita04.jpg?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                <div class="opacity-caption-category"></div>
                                 <div class="caption-category">Wanita</div> 
                            </div>                                                                        
                        </div>
                    </a>
                    <div class="col-lg-12 hidden-md hidden-sm hidden-xs ptop15"></div>
                   
                    <?php foreach ($data as $row) { ?>
                     <?php if($row->product_category_name == 'watches' || $row->product_category_name == 'straps' || $row->product_category_name == 'accessories' || $row->product_category_name == 'jewelry') {?>
                            <?php if($row->product_category_name != 'jewelry') {?>
                            
                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>">
                                    <div class="col-lg-4 hidden-sm hidden-md hidden-xs clearleft clearright img-cat kiri1">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $row->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width img-cat2 width100 bradius5">
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $row->product_category_description; ?></div>
                                        </div>                                                          
                                    </div>
                                   
                                    <div class="hidden-lg col-sm-3 col-md-3 hidden-xs pleft75 pright75">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $row->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $row->product_category_description; ?></div>
                                        </div>                                                          
                                    </div>
                                </a>
                            <?php } ?>
                            <?php if($row->product_category_name == 'jewelry') {?>
                                
                                   
                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>">
                                    <div class="col-lg-3 hidden-sm hidden-md hidden-xs clearleft clearright img-cat mright0">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $row->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width img-cat2 width100 bradius5">
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $row->product_category_description; ?></div>
                                        </div>                                                          
                                    </div>
                                    <div class="hidden-lg col-sm-3 col-md-3 hidden-xs pleft75 pright75">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $row->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $row->product_category_description; ?></div>
                                        </div>                                                          
                                    </div>
                                </a>

                            <?php } ?>
                            

                                <?php if($row->product_category_name == 'watches') {?>
                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>">
                                    <div class="col-xs-6 hidden-md hidden-sm hidden-lg pright75">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $row->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $row->product_category_description; ?></div>
                                        </div>                     
                                    
                                    </div>
                                </a>
                                    <?php
                                        $straps = \backend\models\ProductCategory::find()->where(array("product_category_status" => "active", "product_category_name" => "straps"))->one();
                                    ?>
                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $straps->link_rewrite; ?>">
                                    <div class="col-xs-6 hidden-md hidden-sm hidden-lg pleft75">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $straps->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $straps->product_category_description; ?></div>
                                        </div>                     
                                    
                                    </div>
                                </a>
                                <div class="col-xs-12 hidden-lg hidden-sm hidden-md ptop15"></div>
                                <?php }if($row->product_category_name == 'accessories'){ ?>
                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $row->link_rewrite; ?>">
                                    <div class="col-xs-6 hidden-md hidden-sm hidden-lg pright75">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $row->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">                               
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $row->product_category_description; ?></div>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                        $jewelry = \backend\models\ProductCategory::find()->where(array("product_category_status" => "active", "product_category_name" => "jewelry"))->one();
                                    ?>
                                <a href="<?php echo \yii\helpers\Url::base() . '/' . $jewelry->link_rewrite; ?>">
                                    <div class="col-xs-6 hidden-md hidden-sm hidden-lg pleft75">
                                        <div class="category-image relative bradius5">
                                            <img src="https://thewatch.imgix.net/category/<?php echo $jewelry->product_category_images; ?>?auto=compress%2Cformat&fit=max&fm=pjpg" class="img-responsive img-full-width bradius5">
                                            <div class="opacity-caption-category"></div>
                                            <div class="caption-category-sub"><?php echo $jewelry->product_category_description; ?></div>
                                        </div>                     
                                    
                                    </div>
                                </a>
                                <?php } ?>

                                

                                <div class="hidden-lg hidden-md hidden-sm mright-0-mobile">
                                    
                                    <!--<img src="frontend/web/img/category/<?php echo $row->product_category_images_mobile; ?>" class="img-responsive img-full-width">-->
                                 
                                </div>

                 
             
                    <?php } ?>
        <?php } ?>
                    
                    <!-- <?php if ($row->product_category_sequence == 2 || $row->product_category_sequence == 4) { ?>     -->
                    </div>
                </div>
            <!-- <?php } ?> -->
        
    <?php } ?>
    
                   
</section>



<!--<section id="featured-brands" style="padding:0;">-->
    

<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shop-title caption">CAMPAIGN</div>-->

       
<!--    </section>-->
<!--    <section id="category">-->
<!--         <div class="container category">-->
<!--                        <div class="row">-->
<!--                            <a target="_blank" href="<?php echo \yii\helpers\Url::base() . '/watches/all-product?brands=autodromo--briston--casio--dietrich--greyhours--komono--timex--william-l.-1985--zinvo&price=0--50000000&sortby=none&page=1&limit=20'; ?>">-->
<!--                                <div class="col-lg-12 clearleft" style="padding-right: 15px;">-->
<!--                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/campaign/world-cup-campaign-loop.gif" class="img-responsive img-full-width col-lg-12 hidden-xs clearleft clearright" style="border-radius: 5px;">-->
<!--                                </div>-->
<!--                                <div class="col-xs-12 hidden-lg hidden-md hidden-sm" style="padding-right: 14px;padding-top: 0px;">-->
<!--                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/campaign/world-cup-campaign-mobile-loop.gif" class="img-responsive img-full-width col-lg-12 hidden-lg hidden-md hidden-sm clearleft-mobile clearright-mobile" style="border-radius: 5px;">-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--    </section>-->




