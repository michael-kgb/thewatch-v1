<?php
$userRecent = common\components\Instagram::getAllMedia();
$data = $userRecent->data;
?>
<script async="true" src="//ssp.adskom.com/tags/third-party-async/NjI2ZTQwMTUtMGViOS00NGU4LThlMjAtNjRkYzk1NjgzMzI0"></script>
<section id="breadcrumb">
    <div class="container breadcrumb-page">
        <div class="row">
            <span class="fsize-2 gotham-medium font-size-1">SHOP SOCIAL</span>
        </div>
    </div>

    <!-- start mobile filter -->
    <div class="hidden-lg hidden-md">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 breadcrumb-page margin-top-10 margin-bottom-5 margin-top-3">
            <a href="#filtermodal" id="filter" data-toggle="modal" class="filter center-position-ipad" onclick="add_overflow_body()">
                <span class="text-filter">SORT BY <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/right-white.png" id="down-white" style="padding-bottom: 2px;"></span>
            </a>
        </div>
    </div>

    <div class="hidden-lg hidden-md hidden-sm portfolio-modal modal fade filter" id="filtermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" data-dismiss="modal" style="height: 45px;" onclick="rm_overflow_body()">
                <span class="pull-left">SORT BY</span>
                <span class="pull-right">
                    <a href="#">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 5px; width: 25%">
                    </a>
                </span>
                <div class="clearfix"></div>
                <div class="border-bottom-1"></div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-gotham-light">
                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <div class="col-xs-12 remove-padding" onclick="slidedown_filter('filter-brands')">
                        <span class="pull-left">BRANDS</span>
                        <span class="pull-right"><img class="arrow-down-filter-brands arrow-filter" src="/twcnew/img/icons/down-spec.png"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div id="list-filter-brands" class="col-xs-12 text-left margin-top-3 non-active brands-filter" style="display: none; min-width: 100px; max-height: 200px; overflow: auto;">
                        <?php
                        $brands = \backend\models\Brands::findAll(['brand_status' => 'active']);
                        foreach ($brands as $row) {
                            ?>
                            <div class="col-xs-12 remove-padding-right padding-bottom-2">
                                <input type="checkbox" name="brands_mobile" value="<?php echo $row->link_rewrite; ?>"/> <?php echo $row->brand_name; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-gotham-light">
                <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right">
                    <div class="col-xs-12 remove-padding" onclick="slidedown_filter('filter-hashtag')">
                        <span class="pull-left">HASHTAG</span>
                        <span class="pull-right"><img class="arrow-down-filter-hashtag arrow-filter" src="/twcnew/img/icons/down-spec.png"></span>
                    </div>
                    <div class="clearfix"></div>
                    <div id="list-filter-hashtag" class="col-xs-12 text-left margin-top-3 non-active brands-filter" style="display: none; min-width: 100px; max-height: 200px; overflow: auto;">
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="checkbox" name="brands_mobile" value=""> #thewatchco
                        </div>
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="checkbox" name="brands_mobile" value=""> #redefinetime
                        </div>
                        <div class="col-xs-12 remove-padding-right padding-bottom-2">
                            <input type="checkbox" name="brands_mobile" value=""> #graphicessence
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 margin-top-5">
                <span class="pull-left text-underline text-gotham-medium" onclick="clear_filter_mobile()">CLEAR</span>
                <span class="pull-right text-underline text-gotham-medium" onclick="filter_mobile()">APPLY</span>
            </div>
        </div>
    </div>
    <!-- end of mobile filter -->

    <div class="container breadcrumb-page ptop2">
        <div class="row" id="instagram-box">
            <?php if (count($data) > 0) { ?>
                <?php $i = 1; ?>
                <?php foreach ($data as $row) { ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 instagram-image margin-bottom-5">
                        <a href="#" class="shop-social" data-id="<?php echo $row->id; ?>">
                            <img class="img-responsive img-social" id="img-social-<?php echo $row->id; ?>" src="<?php echo $row->images->standard_resolution->url; ?>" />
                            <div id="shop-btn-instagram-<?php echo $row->id; ?>" align="center" class="shop-btn-instagram hidden-sm hidden-xs" style="display: none;">SHOP NOW</div>
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/love.png" class="love-icons hidden-sm hidden-xs" id="love-icons-<?php echo $row->id; ?>" style="display: none;" />
                            <span class="total-love hidden-sm hidden-xs" style="display: none;" id="total-love-<?php echo $row->id; ?>"><?php echo $row->likes->count; ?></span>
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/comment.png" class="comment-icons hidden-sm hidden-xs" id="comment-icons-<?php echo $row->id; ?>" style="display: none;" />
                            <span class="total-comment hidden-sm hidden-xs" id="total-comment-<?php echo $row->id; ?>" style="display: none;"><?php echo $row->comments->count; ?></span>
                            <span id="shop-social-caption-<?php echo $row->id; ?>" style="display: none;"><?php echo $row->caption->text; ?></span>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="container breadcrumb-page pbottom2">
        <?php
        echo "<button id=\"more-desktop\" data-maxid=\"{$userRecent->pagination->next_max_id}\">LOAD MORE</button>";
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="portfolio-modal modal fade shop-modal" id="shopSocialModal" tabindex="-1" role="dialog" aria-hidden="true" style="overflow: auto">
        <div class="modal-content notifyme">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding">
                <!--<div class="modal-body">-->
                <div class="hidden-lg hidden-md col-xs-12 padding-top-5">
                    <a href="#" data-dismiss="modal" onclick="rm_overflow_body()">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" style="width: 8%;float: right; margin-bottom: 0px;">
                    </a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-top-5 ipad-1024">
                    <a href="#" data-dismiss="modal" class="hidden-xs hidden-sm hidden-md" onclick="rm_overflow_body()">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" style="width: 3%;float: right;padding-top: 1%;padding-right: 0%;">
                    </a>
                    <a href="#" data-dismiss="modal" class="hidden-xs hidden-sm hidden-lg" onclick="rm_overflow_body()">
                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" style="width: 5%;float: right;padding-top: 1%;padding-right: 0%;">
                    </a>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 shop-social-box shop-img-big-modal remove-padding">
                        <img style="margin-bottom: 4%;" id="img-social-detail" src="https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/12519642_774625805970244_798901291_n.jpg?ig_cache_key=MTIxNzg5MTI5Mzg5NTEyMjU5Ng%3D%3D.2" class="img-responsive">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shop-social-box ptop2 clearleft remove-padding">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ptop4 clearleft remove-padding" style="height: 65px;">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/twc.png" class="img-responsive" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 left ptop6-5 clearleft padding-top-5 ipad-1024 remove-padding-left">
                            <span class="gotham-light">thewatchco</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 fright ptop6-5 clearleft padding-top-5 ipad-1024 text-to-right remove-padding-right">
                            <a href="#" class="gotham-light shop-social-follow">FOLLOW</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ptop1 clearleft shop-border margin-bottom-5"></div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 left gotham-light clearleft ptop2 remove-padding margin-caption-instagram">
                        <span id="shop-social-caption-detail" class="fsize-0-8" style="line-height: 2;">
                            thewatchcoEastpak is now available in Indonesia. #eastpak #eastpakindonesia #addthestory
                            www.thewatch.co/eastpak
                        </span>
                    </div>
                    <div class="col-lg-1 hidden-md hidden-sm col-xs-1 clearleft clearright remove-padding-left margin-top-5" style="width: 4.3%;">
                        <a href="http://twitter.com/thewatchco_id" target="_blank"><img src="img/icons/twitter-sc.png"></a>
                    </div>
                    <div class="col-lg-1 hidden-md hidden-sm col-xs-1 clearleft clearright margin-top-5" style="width: 4.3%;">
                        <a href="http://www.facebook.com/TheWatchCo" target="_blank"><img src="img/icons/fb-sc.png"></a>
                    </div>
                    <div class="col-lg-1 hidden-md hidden-sm col-xs-1 clearleft clearright margin-top-5" style="width: 4.3%;">
                        <a href="https://pinterest.com/thewatchcompany" target="_blank"><img src="img/icons/pinterest-sc.png"></a>
                    </div>
                    <div class="col-md-1 col-sm-1 hidden-lg hidden-xs clearleft clearright remove-padding-left margin-top-5" style="margin-top: 3%;">
                        <a href="http://twitter.com/thewatchco_id" target="_blank"><img src="img/icons/twitter-sc.png"></a>
                    </div>
                    <div class="col-sm-1 col-md-1 hidden-lg hidden-xs clearleft clearright margin-top-5" style="margin-top: 3%;">
                        <a href="http://www.facebook.com/TheWatchCo" target="_blank"><img src="img/icons/fb-sc.png"></a>
                    </div>
                    <div class="col-sm-1 col-md-1 hidden-lg hidden-xs clearleft clearright margin-top-5" style="margin-top: 3%;">
                        <a href="https://pinterest.com/thewatchcompany" target="_blank"><img src="img/icons/pinterest-sc.png"></a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 col-xs-12 left remove-padding margin-bottom-5">
                        <span class="gotham-light">SHOP NOW</span>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-lg-3 col-md-3 col-sm-3 col-xs-12 left remove-padding margin-bottom-5">
                        <table width="100%">
                            <tr>
                                <td class="collection-name">
                                    <span class="collection-name col-xs-2 clearleft clearright text-gotham-light">
                                        SHOP NOW
                                    </span>
                                </td>
                                <td class="border-collection">
                                    <div class="col-lg-12 col-md-10 col-sm-10 col-xs-12 product-header border-collection"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop2 remove-padding margin-bottom-5" id="shop-social-product">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft">
                            <!--                                    <a href="#" id="product-url">
                                                                    <img style="margin-bottom: 4%;" src="<?php // echo \yii\helpers\Url::base();       ?>/img/product/398/398.jpg" class="img-responsive" />
                                                                    <span class="gotham-medium">IDR 2.700.000</span>
                                                                </a>-->
                        </div>
                    </div>
                </div>
                <!--</div>-->
            </div>
        </div>
    </div>
</section>