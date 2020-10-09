
<section id="breadcrumb">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 hidden-sm hidden-xs clearleft clearright mbottom-5-mobile gotham-white fsize-18">
                <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright">
                <div class="col-lg-2 hidden-md col-sm-2 clearleft clearright"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 clearleft clearright talign-left line-height40 fsize-18">
                    <?php
                    if(count($breadcrumbs) > 0){
                        ?>
                    
                            <a style="line-height: 32px;" href="<?php echo \yii\helpers\Url::base(); ?>/brands" class="hidden-xs hidden-sm fcolorblue">
                            Brands</a>
                            <span class="hidden-xs hidden-sm fcolorblue">/</span>
                            <a style="line-height: 32px;" class="hidden-xs hidden-sm fcolorblue">
                            <?php echo ucwords(\backend\models\Brands::find()->where(['brand_id'=>$brandId])->one()->brand_name); ?></a>

                            <?php if(isset($breadcrumbs[1])){?>
                                <span class="hidden-xs hidden-sm fcolorblue">/</span>
                                <a style="line-height: 32px;" class="hidden-xs hidden-sm fcolorblue">
                                <?php echo ucwords($breadcrumbs[1]); ?></a>

                            <?php } ?>                  
                
                    <?php } ?>

                    
                </div>
                <div class="col-lg-6 col-md-8 col-sm-6 clearleft clearright">
                    <div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright talign-right">
                    <span class="fcolorblue">View : </span>
                    <a <?php if($limit == 20){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

                    <a <?php if($limit == 40){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

                    <a <?php if($limit == 60){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

                    <a <?php if($limit == 100){ echo ' class="circle-fill-sprites fcolorfff talign-center"';}else{ echo 'class="circle-sprites fcolorblue talign-center"';}?> href="<?php echo $currentAc . '?page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 clearleft clearright line-height40 talign-right">
                    <div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4 fcolorblue lspace0-5" style="display: inline;">Sort by:
                    </div>
                    <div class="clearleft clearright hidden-xs hidden-sm hidden-lg-4" style="display: inline;">
                        <a href="#" class="hidden-xs hidden-sm bradius20 bgcolorprimary pleft15 pright15 ptop5p pbottom5p" id="sorting">
                            <span class="text-sorting fcolorfff"><?php if($sort_name == 'NONE' || $sort_name == 'PRODUCT_SORT'){ echo 'None';}else{ echo $sort_name; }  ?><span class="glyphicon glyphicon-menu-down" style="    padding-left: 5px;display: inline;"></span></span>

                        </a>

                        <div class="" id="arrow-sorting"></div>
                        <div class="hidden-xs sorting-box talign-left" id="box-sorting">
                            <a class="sorting-list top" href="<?php echo $currentAc . '?page='.$current.'&limit='.$limit.'&sortby=none'; ?>">None</a>
                            <a class="sorting-list" id="sorting-none" href="<?php echo $currentAc . '?page='.$current.'&limit='.$limit.'&sortby=price-low-to-high'; ?>">Price Low to High</a>
                            <a class="sorting-list bottom" href="<?php echo $currentAc . '?page='.$current.'&limit='.$limit.'&sortby=price-high-to-low'; ?>">Price High to Low</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>                     

            </div>
            <div class="hidden-lg hidden-md col-sm-12 col-xs-12 clearleft clearright font-paging">
                <div class="col-sm-12 col-xs-12 talign-center clearleft-mobile clearright-mobile">
                <div class="col-sm-4 col-xs-4 clearleft-mobile clearleft">
                    <a class="blue-round default" id="brand-koleksi-mobile" style="padding-bottom: 2px !important;">
                    <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Koleksi</span>
                    <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="collection-white-sprite"></i></span>
                    </a>

                    <div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 50%; left: 0; top: 50%; background: #f6f6f6; z-index: 100; overflow: scroll;border-top:solid 1px #9f8562;" id="brands-collection-content">
                        <a href="#" id="close-koleksi-mobile">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 35px;">
                                <span class="" style="letter-spacing:3px;text-align:center;font-family: gotham-medium;">KOLEKSI</span>
                                <span class="pull-right">
                                    
                                    <span class="glyphicon glyphicon-menu-down" style="color:white;background-color:#9f8562;border-radius:40px;padding: 4px;font-size: 12px;margin-top:-3px;float: right;"></span>
                                    
                                </span>
                                <div class="clearfix"></div>
                                <div class="border-bottom-1" style="margin-top: 12px;"></div>

                            </div>
                        </a>
                        
                        <div class="hidden-lg hidden-md col-xs-12" style="padding-top: 12px;padding-bottom:40px;overflow-y: scroll;-webkit-overflow-scrolling: touch;">
                            <?php
                                $i = 1;
                                if(isset($breadcrumbs[1])){
                                $id_category = \backend\models\ProductCategory::find()->where(['product_category_name' => $breadcrumbs[1] ])->one()->product_category_id;
                                $product_collection = \backend\models\Product::find()->where(['product_category_id' => $id_category , 'brands_brand_id'=> $brandId])->all();
                                $brands_collection_id = [];
                                foreach($product_collection as $prod_row){
                                    $brands_collection_id[] = $prod_row->brands_collection_id;
                                }
                                $brand_collection = \backend\models\BrandsCollection::find()->where(['brands_collection_id' => $brands_collection_id])->all();
                                }else{
                                $brand_collection = \backend\models\BrandsCollection::find()->where(['brands_brand_id' => $brandId])->all();
                                }
                                
                                ?>
                                <?php foreach ($brand_collection as $product) { ?>
                                    
                                <?php
                                    $checked = FALSE;
                                    foreach($collection_selection as $collection){
                                                if($product->brands_collection_id == $collection){
                                                    $checked = TRUE;
                                                }
                                            }
                                    ?>
                                    <label class="control control--checkbox border-bottom-1" style="font-size: 14px;font-family:gotham-light;letter-spacing:1px;text-align: left;padding-top: 5px;padding-bottom: 11px;"><?php echo $product->brands_collection_name; ?>
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" value="<?php echo $product->brands_collection_id; ?>" id="apply-filters-brand-mobile" name="collection-mobile">

                                        <div class="control__indicator" style="top:5px;"></div>
                                    </label>

                                
                            <?php } ?>
                        
                        </div>
                        <div class="col-xs-12 margin-top-5 remove-padding" style="z-index:11;text-align: left;position: fixed;size: 10px;background-color: #fff;bottom: 0;height: 50px;width: 100%;">
                        <!--  <span class="text-gotham-light col-xs-6 ptop4 clearleft-mobile clearright-mobile" style="padding-bottom:20px;text-align: center;background-color: #c2b9b4;color:#fff;">
                            <a href="#" id="close-koleksi-mobile" style="color:white;letter-spacing: 1px;">
                                CLOSE
                            </a></span> -->
                            <span class="text-gotham-light col-xs-12 ptop4" style="padding-bottom:20px;text-align: center;background-color: #9f8562;color:#fff;"><input style="background: transparent;border: none;color:white;letter-spacing: 1px;" class="" type="reset" value="CLEAR" name="clear" /></span>
                        
                        </div>

                    </div>

                </div>
                <div class="col-sm-4 col-xs-4 clearleft-mobile clearleft">
                    <a class="blue-round default" id="filter-mobile" style="padding-bottom: 2px !important;">
                    <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Filter</span>
                    <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="filter-white-sprite"></i></span>
                    </a>
                </div>
                <div class="col-sm-4 col-xs-4 clearleft-mobile clearleft">
                    <a class="blue-round default" id="sorting-mobile" style="padding-bottom: 2px !important;">
                    <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile fsize-12 talign-left">Urutkan</span>
                    <span class="col-sm-6 col-xs-6 clearleft-mobile clearright-mobile talign-right"><i class="sort-white-sprite"></i></span>
                    </a>
                </div>
                    
                    <div class="hidden-lg hidden-md col-xs-12 remove-padding" style="display: none; position: fixed; width: 100%; height: 100%; left: 0; top: 0px; background: #f6f6f6; z-index: 100; overflow: auto" id="sorting-content">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-5 text-gotham-medium" style="height: 45px;">
                        <span class="pull-left talign-center lspace3">SORT BY</span>
                        <span class="pull-right">
                            <a href="#" id="close-sorting-mobile">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot" style="margin-bottom: 7px; width: 20%">
                            </a>
                        </span>
                        <div class="clearfix"></div>
                        <div class="border-bottom-1"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a href="<?php echo $currentAc . '?page='.$current.'&limit='. $limit; ?>&sortby=none">
                            <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                <span class="pull-left lspace3">BRANDS NAME</span>

                            </div>
                        </a>
                        <a href="<?php echo $currentAc . '?page='.$current.'&limit='. $limit; ?>&sortby=price-low-to-high">
                            <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                <span class="pull-left lspace3">PRICE LOW TO HIGH</span>

                            </div>
                        </a>
                        <a href="<?php echo $currentAc . '?page='.$current.'&limit='. $limit; ?>&sortby=price-high-to-low">
                            <div class="col-xs-12 padding-bottom-3 border-bottom-1 margin-top-3 remove-padding-left remove-padding-right" style="padding-top:8px;">
                                <span class="pull-left lspace3">PRICE HIGH TO LOW</span>

                            </div>
                        </a>
                    </div>
                    </div>

                    <?php

                        echo Yii::$app->view->renderFile('@app/views/brands/filter_mobile.php', array(
                        "feature" => $feature,
                        "products"=> $products,
                        "types_selection" => $types_selection,
                        "collection_selection" => $collection_selection,
                        "genders_selection" => $genders_selection,
                        "size_selection" => $size_selection,
                        "bandwidth_selection" => $bandwidth_selection,
                        "movements_selection" => $movements_selection,
                        "waters_selection" => $waters_selection,
                        "brandName" => $brandName,
                        "breadcrumbs" => $breadcrumbs,
                        "brandId"=> $brandId,
                    ));
                    ?>
                </div>
            </div>
            <div class="hidden-sm col-xs-12 hidden-lg hidden-md talign-center fsize-12 ptop15 pbottom15">
                <?php
                    if(count($breadcrumbs) > 0){
                        ?>
                    
                            <a style="line-height: 32px;" href="<?php echo \yii\helpers\Url::base(); ?>/brands" class="fcolorblue">
                            Brands</a>
                            <span class="fcolorblue">/</span>
                            <a style="line-height: 32px;" class="fcolorblue">
                            <?php echo ucwords(\backend\models\Brands::find()->where(['brand_id'=>$brandId])->one()->brand_name); ?></a>

                            <?php if(isset($breadcrumbs[1])){?>
                                <span class=" fcolorblue">/</span>
                                <a style="line-height: 32px;" class="fcolorblue">
                                <?php echo ucwords($breadcrumbs[1]); ?></a>

                            <?php } ?>                  
                
                    <?php } ?>

            </div>
            <div class="hidden-xs col-sm-12 hidden-lg hidden-md talign-center fsize-14 ptop15 pbottom15">
                <?php
                    if(count($breadcrumbs) > 0){
                        ?>
                    
                            <a style="line-height: 32px;" href="<?php echo \yii\helpers\Url::base(); ?>/brands" class="fcolorblue">
                            Brands</a>
                            <span class="fcolorblue">/</span>
                            <a style="line-height: 32px;" class="fcolorblue">
                            <?php echo ucwords(\backend\models\Brands::find()->where(['brand_id'=>$brandId])->one()->brand_name); ?></a>

                            <?php if(isset($breadcrumbs[1])){?>
                                <span class=" fcolorblue">/</span>
                                <a style="line-height: 32px;" class="fcolorblue">
                                <?php echo ucwords($breadcrumbs[1]); ?></a>

                            <?php } ?>                  
                
                    <?php } ?>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="hidden-lg hidden-md hidden-sm col-xs-5 remove-padding clearleft">
                <?php
                    $page_item = ceil($count / $limit);
                    $prev = $current - 1;
                    $next = $current + 1;
                ?>
                    <div class="col-xs-6 clearleft-mobile pright5p" style="width: 60px;">
                    <?php if($current <= 1){
                        ?>
                        <a class="grey-round default top-paging" style="padding:2px !important;">
                        <span class="col-sm-4 col-xs-4 clearright-mobile talign-left" style="padding-left: 5px;display: grid;"><i class="left-white-sprite"></i></span>
                        <span class="col-sm-8 col-xs-8 clearleft-mobile clearright-mobile fsize-12">Prev</span>
                        </a>
                        <?php
                    }else{
                        ?>
                    
                        <a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                            <span class="col-sm-4 col-xs-4 clearright-mobile talign-left" style="padding-left: 5px;display: grid;"><i class="left-white-sprite"></i></span>
                            <span class="col-sm-8 col-xs-8 clearleft-mobile clearright-mobile fsize-12">Prev</span>
                        </a>
            
                        <?php
                    }
                    ?>
                    </div>
                    <div class="col-xs-6 clearright-mobile pleft5p" style="width: 60px;">
                    
                    <?php if($current == $page_item){
                        ?>
                        <a class="grey-round default top-paging" style="padding:2px !important;">
                        <span class="col-sm-10 col-xs-10 clearleft-mobile clearright-mobile fsize-12" style="padding-left: 4px;">Next</span>
                        <span class="col-sm-2 col-xs-2 clearleft-mobile talign-right" style="padding-right: 5px;display: grid;"><i class="right-white-sprite"></i></span>
                        </a>
                        <?php
                    }else{
                        ?>
                    
                        <a class="blue-round default top-paging" style="padding:2px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                            <span class="col-sm-10 col-xs-10 clearleft-mobile clearright-mobile fsize-12" style="padding-left: 4px;">Next</span>
                            <span class="col-sm-2 col-xs-2 clearleft-mobile talign-right" style="padding-right: 5px;display: grid;"><i class="right-white-sprite"></i></span>
                        </a>
            
                        <?php
                    }
                    ?>
                    </div>

                </div>
                <div class="hidden-lg hidden-md col-sm-5 hidden-xs remove-padding clearleft">
                <?php
                    $page_item = ceil($count / $limit);
                    $prev = $current - 1;
                    $next = $current + 1;
                ?>
                    <div class="col-xs-6 clearleft-mobile clearleft pright5p" style="width: 85px;">
                    <?php if($current <= 1){
                        ?>
                        <a class="grey-round default top-paging" style="padding:2px !important;padding-top:3px !important;">
                        
                        <span class="col-sm-4 col-xs-4 clearright talign-left pleft5p"><i class="left-white-sprite"></i></span>
                        <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Prev</span>
                        
                        </a>
                        <?php
                    }else{
                        ?>
                    
                        <a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$prev.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                            <span class="col-sm-4 col-xs-4 clearright talign-left pleft5p"><i class="left-white-sprite"></i></span>
                            <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Prev</span>
                            
                        </a>
            
                        <?php
                    }
                    ?>
                    </div>
                    <div class="col-xs-6 clearright-mobile clearright pleft5p" style="width: 85px;">
                    
                    <?php if($current == $page_item){
                        ?>
                        <a class="grey-round default top-paging" style="padding:2px !important;padding-top:3px !important;">
                        <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Next</span>
                        <span class="col-sm-4 col-xs-4 clearleft talign-right pright5p"><i class="right-white-sprite"></i></span>
                        </a>
                        <?php
                    }else{
                        ?>
                    
                        <a class="blue-round default top-paging" style="padding:2px !important;padding-top:3px !important;" href="<?php echo \yii\helpers\Url::base() . '/' . $currentAc . '?' . $params .'&page='.$next.'&limit=20'; ?>&sortby=<?php echo $sortby;?>">
                            <span class="col-sm-8 col-xs-8 clearleft clearright fsize-12">Next</span>
                            <span class="col-sm-4 col-xs-4 clearleft talign-right pright5p"><i class="right-white-sprite"></i></span>
                        </a>
            
                        <?php
                    }
                    ?>
                    </div>
                </div>

                <div class="hidden-lg hidden-md col-sm-7 col-xs-7 remove-padding clearright" style="float:right;text-align:right;">
                    <span class="fcolorblue">View : </span>
                            <a <?php if($limit == 20){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=20'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">20</span></a>

                            <a <?php if($limit == 40){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=40'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">40</span></a>

                            <a <?php if($limit == 60){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=60'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">60</span></a>

                            <a <?php if($limit == 100){ echo ' class="circle-fill-sprites25 fcolorfff talign-center fsize-12"';}else{ echo 'class="circle-sprites25 fcolorblue talign-center fsize-12"';}?> href="<?php echo $currentAc . '?page=1&limit=100'; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">100</span></a> 
                </div>
            </div>
        </div>
    </div>
</section>