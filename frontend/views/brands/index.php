<?php 
use backend\models\Brands;
?>
<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/YzA3ODAyNzgtYjkyNC00Y2EyLThlMzEtMzhiMTBlZDA0ZWQ5"></script>-->

<!-- breadcrumb -->
<?php 
    // echo Yii::$app->view->renderFile('@app/views/widget/breadcrumb.php');
    
?>
<!-- end of breadcrumb -->
<style type="text/css">
    a.brand-categories:hover {border-bottom: 1px solid #9e8461;padding-bottom: 1px;}
    a.brand-categories.active {border-bottom: 1px solid #9e8461;padding-bottom: 1px;}
</style>
<div class="pbottom-6-mobile"></div>
<section id="product-detail" style="padding-bottom: 0px;padding-top: 40px;margin-bottom: 40px;">
    <div class="container category">
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12 category img-block gotham-medium" style="text-align: center;font-size: 12px;">
                                    BRAND CATEGORIES: <span class="gotham-light" style="padding-left: 15px;padding-right: 5px;"><a href="<?php echo \yii\helpers\Url::base() . '/brands'; ?>" class="brand-categories <?php if($flag == 'all'){ echo 'active';}?>">ALL BRANDS</a></span> | <span class="gotham-light" style="padding-left: 5px;padding-right: 5px;"><a href="<?php echo \yii\helpers\Url::base() . '/brands/watches'; ?>" class="brand-categories <?php if($flag == 'watches'){ echo 'active';}?>">WATCHES</a></span> | <span class="gotham-light" style="padding-left: 5px;padding-right: 5px;"><a href="<?php echo \yii\helpers\Url::base() . '/brands/straps'; ?>" class="brand-categories <?php if($flag == 'all'){ echo 'straps';}?>">STRAPS</a></span> | <span class="gotham-light" style="padding-left: 5px;padding-right: 5px;"><a href="<?php echo \yii\helpers\Url::base() . '/brands/accessories'; ?>" class="brand-categories <?php if($flag == 'accessories'){ echo 'active';}?>">ACCESSORIES</a></span>
                                </div>
               
            

        </div>
    </div>
</section>
<section id="product-detail" class="hidden-xs" style="padding-bottom: 0px;padding-top: 40px;margin-bottom: 40px;border-bottom: solid 0.1px #cfcac6;border-top: solid 0.1px #cfcac6;">
    <div class="container category">
        <div class="row">
            
            <?php
                $i = 0;
                foreach ($group as $row) {
                    ?>
                    <?php
                        if($i == 0){
                            $i = 1;
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 category block" style="padding-bottom: 40px;">
                            <?php
                        }
                        if(count($row['brand']) > 0){
                    ?>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 category block">
                        <?php
                        
                            ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 category img-block gotham-medium" style="padding-bottom: 3px;">
                                    <?php echo $row['alpha'];?>
                                </div>
                            <?php
                                foreach ($row['brand'] as $row_brand) {
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 category img-block" style="padding-top: 3px;padding-bottom: 3px;font-size: 0.8em;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . strtolower(str_replace(' ', '-', $row_brand)); ?>">

                                                <?php echo strtoupper($row_brand);?>
                                            </a>
                                        </div>
                                    <?php
                                }
                            
                        # code...
                            $i++;
                        ?>
                        </div>
                        <?php
                        }
                            if($i == 7){
                                echo '</div>';
                                $i = 0;
                            }
                        ?>
                    <?php
                    
                }
            ?>
               
            

        </div>
    </div>
</section>
<section id="product-detail" class="hidden-lg hidden-md hidden-sm hidden-xs" style="padding-bottom: 0px;padding-top: 40px;margin-bottom: 40px;border-bottom: solid 0.1px #cfcac6;border-top: solid 0.1px #cfcac6;">
    <div class="container category">
        <div class="row">
            
            <?php
                $i = 0;
                foreach ($group as $row) {
                    ?>
                    <?php
                        if($i == 0){
                            $i = 1;
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 category block" style="">
                            <?php
                        }
                        if(count($row['brand']) > 0){
                    ?>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 clearleft-mobile clearright-mobile category block">
                        <?php
                        
                            ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 category clearleft-mobile clearright-mobile img-block gotham-medium" style="padding-bottom: 3px;">
                                    <?php echo $row['alpha'];?>
                                </div>
                            <?php
                                foreach ($row['brand'] as $row_brand) {
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 category clearleft-mobile clearright-mobile category img-block" style="padding-top: 3px;padding-bottom: 3px;font-size: 0.8em;">
                                            <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . strtolower(str_replace(' ', '-', $row_brand)); ?>">

                                                <?php echo strtoupper($row_brand);?>
                                            </a>
                                        </div>
                                    <?php
                                }
                            
                        # code...
                            $i++;
                        ?>
                        </div>
                        <?php
                        }
                            if($i == 4){
                                echo '</div>';
                                $i = 0;
                            }
                        ?>
                    <?php
                    
                }
            ?>
               
            

        </div>
    </div>
</section>
<section id="product-detail" style="padding-top: 0;">
    <div class="container category">
        <div class="row" style="text-align: center;padding-bottom: 40px;padding-top: 0px;">
            <div class="col-lg-12 gotham-medium">
            ALL BRANDS
            </div>
        </div>
        <div class="row">
            <?php if(count($data) > 0) { $i = 0; ?>
                <?php foreach($data as $row) { $i++; ?>
                <?php $brand = Brands::find()->select(["brands.brand_name", "brands.brand_logo"])->where(['brands.brand_id' => $row->brands_brand_id])->one(); ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 category block">
                <div class="col-lg-12 col-md-12 col-sm-12 category img-block">
                    <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . strtolower(str_replace(' ', '-', $brand->brand_name)); ?>">

                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/brand_identity/<?php echo $row->brand_banner_small_banner; ?>" class="img-responsive img-brand-responsive">
                    </a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 category img-block category caption" style="margin-bottom: 7%;padding-bottom: 0;padding-top: 0;border: solid 0.1px #cfcac6;border-top: none;">
                    <div class="gotham-medium hidden-xs" style="float: left;padding-top: 80px;padding-left: 15px;"><?php echo strtoupper($brand->brand_name);?></div>
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/brands/black/<?php echo $brand->brand_logo; ?>" style="width: 30%;" class="img-brand-icon logo-img-down">
                </div>
            </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
</section> 
<style type="text/css">
    .logo-img-down{
        float:right;
    }
    .category.caption,.img-brand-responsive{
        width:94%;
    }
    @media only screen and (max-width : 414px) {
    /*.carousel {width: 91%;margin-left: 4%;}*/
    .logo-img-down{
        float:none;
    }
    .category.caption{
        width:100%;
    }
}
</style>