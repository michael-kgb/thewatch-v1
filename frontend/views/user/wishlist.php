

<?php
    $baseUrl = \yii\helpers\Url::base();
?>  

<section id="wishlist-desktop" style="padding-top: 0px;" class="hidden-sm hidden-xs">

	<div class="container">

		<div class="row">

			<?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "my_wishlist",
            ));
            ?>

			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 myprofile">
				<div class="profile-head">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 my-profile title clearleft clearright">
                        Wish List
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 section-right center-blue-btn ">
						<a data-toggle="modal" data-target="#addCategoryModal">
							<img class="round-btn-blue btn_new_list" src="<?php echo Yii::$app->params['imgixUrl'] ?>wishlist/desktop/btn_new_list.png"/>
						</a>
					</div>
				</div>



				<div style="font-weight:bold;font-size:14px;margin-bottom:10px;">Wish List Category</div>
				<div class="wishlist-category">
                    
					<a class="list_wishlist" href="<?=$baseUrl."/user/wishlist/"?>">
                    <?php
                        if($wishlist_current==0){
                            echo '<div class="btn_wishlist btn_wishlist_active btn_wishlist_desktop" style="left:0px;">All Wish List</div>';
                        }else{
                            echo '<div class="btn_wishlist btn_wishlist_desktop" style="left:0px;">All Wish List</div>';
                        }
                    ?>
						
					</a>
                    <?php 
                        foreach($wishlist_name_for_listcategory as $key => $nama){
                            if($wishlist_id_for_listcategory[$key]==$wishlist_current){
                                echo '<a href="'.$baseUrl."/user/wishlist/".$wishlist_id_for_listcategory[$key].'" class="list_wishlist"><div class="btn_wishlist btn_wishlist_desktop btn_wishlist_active" style="left:170px;">'.$nama.'</div></a>';
                            }else{
                                echo '<a href="'.$baseUrl."/user/wishlist/".$wishlist_id_for_listcategory[$key].'" class="list_wishlist"><div class="btn_wishlist btn_wishlist_desktop btn_wishlist" style="left:170px;">'.$nama.'</div></a>';
                            }
                            
                        }
                    ?>  
				</div>  

                <div class="wishlist-content-wrap-desktop">
                    <?php 
                    foreach($wishlist_name as $keyWishlist => $nama){
                    ?>
                        <div class="wishlist-area-wrap-desktop">
                            <!--(header wishlist) NAMA WISHLIST DAN BUTTON EDIT-->
                            <div style="margin-bottom:10px;margin-top:30px;" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="font-weight:bold;font-size:14px;width:200px;margin-top:20px;" ><?=$nama?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            if($wishlist_is_default[$keyWishlist]!=1){
                                        ?>
                                        <button data-id="<?=$keyWishlist?>" class="btn round-btn-red pull-right" onclick="openModalDeleteCategory(<?=$wishlist_id[$keyWishlist]?>)"  style="font-weight:bold;font-size:14px;width:100px;margin-left:10px;">Hapus </button>
                                        <?php
                                            }
                                        ?>
                                        <button data-id="<?=$keyWishlist?>" class="btn round-btn-gold pull-right btnCloseModeSelect" style="font-weight:bold;font-size:14px;width:100px;margin-left:10px;">Cancel </button>
                                        <button data-id="<?=$keyWishlist?>" class="btn round-btn-transparent pull-right dropdown-toggle btnOpenModeSelect" data-toggle="dropdown" style="font-weight:bold;font-size:14px;width:100px;">Tandai <span class="fa fa-angle-down"/>
                                        </button>
                                        <ul class="dropdown-menu pull-right" style="margin-right:100px;">
                                            <li>
                                                <a class="btnCheckAll" data-id="<?=$keyWishlist?>" style="cursor:pointer;">Tandai Semua</a>
                                            </li>
                                            <li>
                                                <a class="btnUncheckAll" data-id="<?=$keyWishlist?>" style="cursor:pointer;">Hapus Tanda</a>
                                            </li>
                                            <li>
                                                
                                            </li>
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div> 
                        
                            <?php

                                if(!array_key_exists($keyWishlist, $wishlist_detail)){
                                    ?>
                                        <div class="wishlist-area" style="margin-bottom:20px;">
                                            <div class="wrap-wishlist">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="text-center" style="font-weight:bold;padding-top:20px;">Belum ada produk</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }else{
                                    foreach($wishlist_detail[$keyWishlist] as $keyDetail => $detail){
                                        $productID = $detail['product']['product_id'];
                                        $productBrandID = $detail['product']['brand_id'];
                                        $productBrandName = $detail['product']['brand_name'];
                                        $productName = $detail['product']['productDetail']['name'];
                                        $productLinkRewrite = $detail['product']['productDetail']['link_rewrite'];
                                        $productPrice = $detail['product']['price'];
                                        $productImage = $detail['product']['product_image'];
                                        $productStock = $detail['product']['product_stock'];
                                        $productAttribute = $detail['product']['attribute'];
                                        $productAttributeID = $detail['product_attribute_id'];
                                        $productUnitPrice = $detail['product']['specific_price']['unit_price'];
                                        $productIsDiscount = $detail['product']['specific_price']['is_discount'];
                                        $productIsFlashSale = $detail['product']['specific_price']['flash_sale'];
                                        //$productReduction = $detail['product']['specific_price']['reduction'];
                                        $productLabelDisc = $detail['product']['specific_price']['label_disc'];
                                        $wishlistdetailCreatedAt = $detail['created_at'];
                                        ?>

                                        
                                            <!--(content wishlist) ISI WISHLIST DAN BUTTON HAPUS PINDAHKAN BELI-->
                                            <div class="wishlist-area" data-detail="<?=$detail['customer_wishlist_detail_id']?>" style="margin-bottom:20px;">
                                                <div class="wrap-wishlist">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                        <div style="position:relative;">
                                        
                                                            <?php
                                                                if($productIsDiscount){   
                                                                    if($productIsFlashSale){
                                                                    ?>
                                                                        <div class="tag-wishlist">
                                                                            <div class="pull-right">
                                                                                <div class="circle">
                                                                                    <span class="text-discount" style="">
                                                                                        <?=$productLabelDisc?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="tag-wishlist" style="right:60px;">
                                                                            <div class="pull-right">
                                                                                <div class="circle flash">
                                                                                    <span class="text-discount" style="">
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php

                                                                    }else{
                                                                    ?>
                                                                        <div class="tag-wishlist">
                                                                            <div class="pull-right">
                                                                                <div class="circle">
                                                                                    <span class="text-discount" style="">
                                                                                        <?=$productLabelDisc?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    <?php
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                            
                                                            <?php
                                                                if($productStock>0){
																	
																	
                                                                    echo '<img src="'.Yii::$app->params['imgixUrl'].'product/'.$productImage.'/'.$productImage.'_medium.jpg" class="img-responsive"/>';
                                                                }else{
                                                                    echo '<img src="'.Yii::$app->params['imgixUrl'].'product/'.$productImage.'/'.$productImage.'_medium.jpg" class="img-responsive out-of-stock-wishlist"/>';
                                                                    echo '<span id="out-of-stock-caption-2891" class="hidden-xs gotham-medium fsize-2 out-of-stock-wishlist-caption">OUT OF STOCK</span>';
                                                                }
                                                            ?>
                                                            
                                                        </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <p style="font-weight:bold;margin:0;font-size:20px;text-transform: uppercase;"><a href="<?=$baseUrl."/brand/".$productBrandID?>"><?=$productBrandName?></a></p>
                                                                            <p style="margin:0;"><a href="<?=$baseUrl."/product/".$productLinkRewrite?>"><?=$productName?></a></p>
                                                                            
                                                                            <?php
                                                                                foreach($productAttribute as $keyAttribute => $itemAttribute){
                                                                                    if(!empty($itemAttribute['name']) && !empty($itemAttribute['value'])){
                                                                                        echo $itemAttribute['name'].": ".$itemAttribute['value']."<br>";
                                                                                    }
                                                                                }
                                                                            ?>

                                                                            <?php
                                                                                if(!empty($productAttribute)){
                                                                                    if($productAttribute[0]['name']=="Color" || $productAttribute[1]['name']=="Color"){

                                                                                        if($productAttribute[0]['name']=="Color" || $productAttribute[1]['name']=="Color"){
                                                                                        }

                                                                                        if($productAttribute[0]['name']=="Color" || $productAttribute[1]['name']=="Color"){
                                                                                        }

                                                                                        echo '<input type="hidden" name="color" value='.$itemAttribute["value"].'>';
                                                                                    }else{
                                                                                        echo '<input type="hidden" name="color" value="">';
                                                                                    }
                                                                                }
                                                                            ?>


                                                                            <input type="hidden" class="productAttribute" data-id="<?=$keyWishlist?>" name="productattribute" value="<?=$productAttributeID?>">
                                                                            
                                                                            <?php
                                                                                if(!$productIsDiscount){
                                                                                    echo '<p style="font-weight:bold;margin:0;font-size:15px;">IDR '.\common\components\Helpers::getPriceFormat($productPrice).'</p>';
                                                                                }else{
                                                                                    echo '<p style="font-weight:bold;margin:0;font-size:15px;">IDR '.\common\components\Helpers::getPriceFormat($productUnitPrice).'<span class="discount-price mleft2">'.\common\components\Helpers::getPriceFormat($productPrice).'</span></p>';
                                                                                }
                                                                            ?>

                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <p><?php echo date('d/m/Y', strtotime($wishlistdetailCreatedAt))?></p>
                                                                        </div>
                                                                        <div class="col-md-5 text-right">
                                                                            <input style="margin-top:50%;" data-id="<?=$keyWishlist?>" data-product="<?=$productID?>" data-attribute="<?=$productAttributeID?>" data-detail="<?=$detail['customer_wishlist_detail_id']?>" class="checkboxSelectWishlist" type="checkbox" name="wishlistproduk" value="<?=$detail['customer_wishlist_detail_id']?>"/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12 col-lg-12" style="padding-top:100px;">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">
                                                                            <a class="btn round-btn-red btnHapusWishlist" onclick="openModalDeleteDetail(<?=$detail['customer_wishlist_detail_id']?>)"  data-id="<?=$keyWishlist?>">Hapus</a>
                                                                        </div>
                                                                        <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">
                                                                            <a class="btn round-btn-gold btnPindahWishlist" onclick="openModalMoveWishlist(<?=$detail['customer_wishlist_detail_id']?>)"  data-id="<?=$keyWishlist?>">Pindahkan</a>
                                                                        </div>
                                                                        <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">
                                                                            <a class="btn round-btn-blue btnBeliWishlist" data-id="<?=$keyWishlist?>" onclick="beliDetailWishlist(<?=$productID?>, <?=$productAttributeID?>, <?=$detail['customer_wishlist_detail_id']?>, this)">Beli</a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        <?php

                                    }
                                }
                            ?>


                            <!--BUTTTON HAPUS PINDAHKAN BELI DIBAWAH KETIKA MODE SELECT ON-->
                            <div class="controllmodeSelect" data-id="<?=$keyWishlist?>" style="margin-bottom:20px;">
                                <div class="row">
                                    
                                    <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3" style="padding-left:10px;padding-right:10px;">
                                        <a data-id="<?=$keyWishlist?>" onclick="openModalMassalDeleteDetail(this)" class="btn round-btn-red btncontrollmodeSelect">Hapus</a>
                                    </div>
                                    <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">
                                        <a data-id="<?=$keyWishlist?>" onclick="openModalMassalMoveWishlist(this)" class="btn round-btn-gold btncontrollmodeSelect">Pindahkan</a>
                                    </div>
                                    <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">
                                        <a data-id="<?=$keyWishlist?>" onclick="beliMassalDetailWishlist(this)" class="btn round-btn-blue btncontrollmodeSelect">Beli</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
			</div>
		</div>
	</div>
</section>

<section id="wishlist-mobile" style="padding-top: 0px;" class="hidden-md hidden-lg">

	<div class="container">

		<div class="row">

			<?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "my_wishlist",
            ));
            ?>

			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 myprofile">
				<div class="profile-head">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 my-profile title clearleft clearright">
                        Wish List
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 section-right center-blue-btn text-right">
                        <a data-toggle="modal" data-target="#addCategoryModal">
							<img style="width:30px;" src="<?php echo Yii::$app->params['imgixUrl'] ?>wishlist/mobile/btn_new_list.png"/>
						</a>
					</div>
				</div>



				<div style="font-weight:bold;font-size:14px;margin-bottom:10px;">Wish List Category</div>
				<div class="wishlist-category">
					

                    <a class="list_wishlist" href="<?=$baseUrl."/user/wishlist/"?>">
                    <?php
                        if($wishlist_current==0){
                            echo '<div class="btn_wishlist btn_wishlist_active btn_wishlist_mobile" style="left:0px;">All Wish List</div>';
                        }else{
                            echo '<div class="btn_wishlist btn_wishlist_mobile" style="left:0px;">All Wish List</div>';
                        }
                    ?>
						
					</a>
                    <?php 
                        foreach($wishlist_name_for_listcategory as $key => $nama){
                            if($wishlist_id_for_listcategory[$key]==$wishlist_current){
                                echo '<a href="'.$baseUrl."/user/wishlist/".$wishlist_id_for_listcategory[$key].'" class="list_wishlist"><div class="btn_wishlist btn_wishlist_mobile btn_wishlist_active" style="left:170px;">'.$nama.'</div></a>';
                            }else{
                                echo '<a href="'.$baseUrl."/user/wishlist/".$wishlist_id_for_listcategory[$key].'" class="list_wishlist"><div class="btn_wishlist btn_wishlist_mobile btn_wishlist" style="left:170px;">'.$nama.'</div></a>';
                            }
                            
                        }
                    ?>  
				</div>  

                <div class="wishlist-content-wrap-mobile">

                <?php 
                foreach($wishlist_name as $keyWishlist => $nama){
                ?>
        
                    <div class="wishlist-area-wrap-mobile">
                        <div style="margin-bottom:10px;margin-top:30px;" >
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div style="font-weight:bold;font-size:14px;width:200px;margin-top:20px;" ><?=$nama?></div>
                                </div>
                                <div class="col-xs-6 col-md-6 col-lg-6" style="margin-top:20px;">
                                    <?php
                                        if($wishlist_is_default[$keyWishlist]!=1){
                                    ?>
                                    <a class="pull-right dropdown-toggle" style="margin-left:20px;" data-id="<?=$keyWishlist?>" onclick="openModalDeleteCategory(<?=$wishlist_id[$keyWishlist]?>)" >
                                        <img width="18px" src="<?php echo Yii::$app->params['imgixUrl'] ?>/icons/trash.png"/>
                                    </a>
                                    <?php
                                        }
                                    ?>

                                    

                                    <a class="pull-right btnCloseModeSelectMobile" style="margin-left:20px;" data-id="<?=$keyWishlist?>">
                                        <img width="15px" src="<?php echo Yii::$app->params['imgixUrl'] ?>icons/close-round.png"/>
                                    </a>

                                    <a class="pull-right dropdown-toggle btnOpenModeSelectMobile" data-toggle="dropdown" data-id="<?=$keyWishlist?>">
                                        <img width="20px" src="<?php echo Yii::$app->params['imgixUrl'] ?>wishlist/mobile/menu-more.png"/>
                                    </a>

                                    <ul class="dropdown-menu pull-right" style="margin-right:40px;">
                                        <li>
                                            <a class="btnCheckAllMobile" data-id="<?=$keyWishlist?>" style="cursor:pointer;">Tandai Semua</a>
                                        </li>
                                        <li>
                                            <a class="btnUncheckAllMobile" data-id="<?=$keyWishlist?>" style="cursor:pointer;">Hapus Tanda</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        

                        <?php

                            if(!array_key_exists($keyWishlist, $wishlist_detail)){
                                ?>
                                    <div class="wishlist-area" style="margin-bottom:20px;">
                                        <div class="wrap-wishlist">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="text-center" style="font-weight:bold;padding-top:20px;">Belum ada produk</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }else{         

                                foreach($wishlist_detail[$keyWishlist] as $keyDetail => $detail){
                                    $productID = $detail['product']['product_id'];
                                    $productBrandID = $detail['product']['brand_id'];
                                    $productBrandName = $detail['product']['brand_name'];
                                    $productName = $detail['product']['productDetail']['name'];
                                    $productLinkRewrite = $detail['product']['productDetail']['link_rewrite'];
                                    $productPrice = $detail['product']['price'];
                                    $productImage = $detail['product']['product_image'];
                                    $productStock = $detail['product']['product_stock'];
                                    $productAttribute = $detail['product']['attribute'];
                                    $productAttributeID = $detail['product_attribute_id'];
                                    $productUnitPrice = $detail['product']['specific_price']['unit_price'];
                                    $productIsDiscount = $detail['product']['specific_price']['is_discount'];
                                    $productIsFlashSale = $detail['product']['specific_price']['flash_sale'];
                                    //$productReduction = $detail['product']['specific_price']['reduction'];
                                    $productLabelDisc = $detail['product']['specific_price']['label_disc'];
                                    $wishlistdetailCreatedAt = $detail['created_at'];
                                    ?>

                                        


                                    <div class="wishlist-area" data-detail="mobile<?=$detail['customer_wishlist_detail_id']?>" style="margin-bottom:20px;">
                                        <div class="row">
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bagianCheckbox" data-id="<?=$keyWishlist?>">  <!--dihidden diawal-->
                                                    <input style="margin-top:125px;margin-left:30px;" class="checkboxSelectWishlistMobile" type="checkbox" name="wishlistproduk" data-id="mobile<?=$keyWishlist?>" data-product="<?=$productID?>" data-attribute="<?=$productAttributeID?>" data-detail="<?=$detail['customer_wishlist_detail_id']?>"  value="<?=$detail['customer_wishlist_detail_id']?>"/>
                                                </div>

                                                <!--(content wishlist) ISI WISHLIST DAN BUTTON HAPUS PINDAHKAN BELI [MOBILE]-->
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bagianProduct" data-id="<?=$keyWishlist?>">
                                                    <div class="wrap-wishlist">
                                                        <div class="row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div style="position:relative;">
                                                                    <?php
                                                                        if($productIsDiscount){   
                                                                            if($productIsFlashSale){
                                                                            ?>
                                                                                <div class="tag-wishlist">
                                                                                    <div class="pull-right">
                                                                                        <div class="circle">
                                                                                            <span class="text-discount" style="">
                                                                                                <?=$productLabelDisc?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="tag-wishlist" style="right:60px;">
                                                                                    <div class="pull-right">
                                                                                        <div class="circle flash">
                                                                                            <span class="text-discount" style="">
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php

                                                                            }else{
                                                                            ?>
                                                                                <div class="tag-wishlist">
                                                                                    <div class="pull-right">
                                                                                        <div class="circle">
                                                                                            <span class="text-discount" style="">
                                                                                                <?=$productLabelDisc?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                    <?php
                                                                        if($productStock>0){
                                                                            echo '<img src="'.Yii::$app->params['imgixUrl'].'product/'.$productImage.'/'.$productImage.'_medium.jpg" class="img-responsive"/>';
                                                                        }else{
                                                                            echo '<img src="'.Yii::$app->params['imgixUrl'].'product/'.$productImage.'/'.$productImage.'_medium.jpg" class="img-responsive out-of-stock-wishlist"/>';
                                                                            echo '<span id="out-of-stock-caption-2891" class="gotham-medium fsize-2 out-of-stock-wishlist-caption" style="left:50% !important;margin-left:-50px !important;">OUT OF STOCK</span>';
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                            
                                                                                <p style="font-weight:bold;margin:0;font-size:13px;"><a href="<?=$baseUrl."/brand/".$productBrandID?>"><?=$productBrandName?></a></p>
                                                                                <p style="margin:0;font-size:12px;"><a href="<?=$baseUrl."/product/".$productLinkRewrite?>"><?=$productName?></a></p>

                                                                                <?php
                                                                                    if(!empty($productAttribute)){
                                                                                        if($productAttribute[0]['name']=="Color" || $productAttribute[1]['name']=="Color"){

                                                                                            if($productAttribute[0]['name']=="Color" || $productAttribute[1]['name']=="Color"){
                                                                                            }

                                                                                            if($productAttribute[0]['name']=="Color" || $productAttribute[1]['name']=="Color"){
                                                                                            }

                                                                                            echo '<input type="hidden" name="color" value='.$itemAttribute["value"].'>';
                                                                                        }else{
                                                                                            echo '<input type="hidden" name="color" value="">';
                                                                                        }
                                                                                    }
                                                                                ?>


                                                                                <input type="hidden" class="productAttribute" data-id="<?=$keyWishlist?>" name="productattribute" value="<?=$productAttributeID?>">
                                                                                
                                                                                <?php
                                                                                if($productIsDiscount==false){
                                                                                    echo '<p style="font-weight:bold;margin:0;font-size:12px;">IDR '.\common\components\Helpers::getPriceFormat($productPrice).'</p>';
                                                                                }else{
                                                                                    echo '<p style="font-weight:bold;margin:0;font-size:12px;">IDR '.\common\components\Helpers::getPriceFormat($productPrice).'</p><span class="discount-price mleft2">IDR 1.550.000</span>';
                                                                                }
                                                                                ?>                                                                                

                                                                                <p style="margin-top:10px;margin-bottom:10px;">
                                                                                    <span style="font-weight:bold;">Ditambahkan:</span> <?php echo date('d/m/Y', strtotime($wishlistdetailCreatedAt))?>
                                                                                </p>											
                                                                                
                                                                                <a style="color:red;text-decoration:underline;" class="btnHapusWishlistMobile" onclick="openModalDeleteDetail(<?=$detail['customer_wishlist_detail_id']?>)"  data-id="<?=$keyWishlist?>">Hapus</a>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="padding-top:0px;">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                                        <a class="btn round-btn-gold btnPindahWishlistMobile" onclick="openModalMoveWishlist(<?=$detail['customer_wishlist_detail_id']?>)"  data-id="<?=$keyWishlist?>" style="padding-left:10px;padding-right:10px;margin-top:10px;">Pindahkan</a>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                        <a class="btn round-btn-blue btnBeliWishlistMobile" data-id="<?=$keyWishlist?>" onclick="beliDetailWishlist(<?=$productID?>, <?=$productAttributeID?>)" style="padding-left:10px;padding-right:10px;margin-top:10px;">Beli</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>


                                <?php

                                }
                            }
                            ?>

                        <!--BUTTTON HAPUS PINDAHKAN BELI DIBAWAH KETIKA MODE SELECT ON [MOBILE]-->
                        <div class="controllmodeSelectMobile" style="margin-bottom:20px;" data-id="<?=$keyWishlist?>">
                            <div class="row">
                                
                                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3" style="padding-left:10px;padding-right:10px;">
                                    <a data-id="<?=$keyWishlist?>" onclick="openModalMassalDeleteDetailMobile(this)" class="btn round-btn-red btncontrollmodeSelectMobile">Hapus</a>
                                </div>
                                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">
                                    <a data-id="<?=$keyWishlist?>" onclick="openModalMassalMoveWishlistMobile(this)" class="btn round-btn-gold btncontrollmodeSelectMobile">Pindahkan</a>
                                </div>
                                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3" style="padding-left:10px;padding-right:10px;">
                                    <a data-id="<?=$keyWishlist?>" onclick="beliMassalDetailWishlistMobile(this)" class="btn round-btn-blue btncontrollmodeSelectMobile">Beli</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>


			</div>
		</div>
	</div>
</section>


<!-- Modal -->
<div class="modal fade" id="moveCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img id="iconCloseModal" src="<?php echo Yii::$app->params['imgixUrl'] ?>icons/close-round.png" alt="icon"/>
				</button>
				<p class="modal-title" id="myModalLabel" style="font-weight:bold;">Choose list</p>
			</div>
			<div class="modal-body">
                <ul class="list-group move-list-wishlist" style="margin:-15px -15px 0px -15px;">
                    <?php 
                        foreach($wishlist_name_for_listcategory as $keyWishlist => $nama){
                            echo '<a class="moveWishlistItem" onclick="moveDetailWishlist('.$wishlist_id_for_listcategory[$keyWishlist].')"><li class="list-group-item" style="min-width:300px;">'.$nama.'</li></a>';
                        }
                    ?>
                    
                </ul>
                <ul class="list-group" style="margin:0px -15px 0px -15px;">
                    
                </ul>
                <div style="margin-top:20px;">
                    <input type="hidden" name="idDetailWishlist" id="move-detail-wishlist" value=""/>
                    <a class="moveWishlistItem btn round-btn-blue" data-toggle="modal" data-target="#addCategoryModal">Add Wishlist</a>
                </div>

			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="moveMassalCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img id="iconCloseModal" src="<?php echo Yii::$app->params['imgixUrl'] ?>icons/close-round.png" alt="icon"/>
				</button>
				<p class="modal-title" id="myModalLabel" style="font-weight:bold;">Choose list</p>
			</div>
			<div class="modal-body">
                <ul class="list-group move-list-massal-wishlist" style="margin:-15px -15px 0px -15px;">
                    <?php 
                        foreach($wishlist_name_for_listcategory as $keyWishlist => $nama){
                            echo '<a class="moveWishlistItem" onclick="moveMassalDetailWishlist('.$wishlist_id_for_listcategory[$keyWishlist].')"><li class="list-group-item">'.$nama.'</li></a>';
                        }
                    ?>
                    
                </ul>
                <div style="margin-top:20px;">
                    <input type="hidden" name="idDetailWishlist" id="move-multiple-detail-wishlist" value=""/>
                    <a class="moveWishlistItem btn round-btn-blue" data-toggle="modal" data-target="#addCategoryModal">Add Wishlist</a>
                </div>

			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img id="iconCloseModal" src="<?php echo Yii::$app->params['imgixUrl'] ?>icons/close-round.png" alt="icon"/>
				</button>
				<p class="modal-title" id="myModalLabel" style="font-weight:bold;">Are you sure want to delete this category wishlist?</p>
			</div>
			<div class="modal-body">
                <input type="hidden" name="idwishlist" id="delete-category-wishlist" value=""/>
				<button class="btn round-btn-blue" id="submit-delete-category-wishlist" onclick="deleteCategoryWishlist()">Yes</button>
				<br/>
				<button class="btn round-btn-blue">No</button>

			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img id="iconCloseModal" src="<?php echo Yii::$app->params['imgixUrl'] ?>icons/close-round.png" alt="icon"/>
				</button>
				<p class="modal-title" id="myModalLabel" style="font-weight:bold;">Are you sure want to delete this product in the current wishlist?</p>
			</div>
			<div class="modal-body">
                <input type="hidden" name="idwishlistdetail" id="delete-detail-wishlist" value=""/>
				<button class="btn round-btn-blue" id="submit-delete-category-wishlist" onclick="deleteDetailWishlist()">Yes</button>
				<br/>
				<button class="btn round-btn-blue">No</button>

			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteMassalDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img id="iconCloseModal" src="<?php echo Yii::$app->params['imgixUrl'] ?>icons/close-round.png" alt="icon"/>
				</button>
				<p class="modal-title" id="myModalLabel" style="font-weight:bold;">Are you sure want to delete this product in the current wishlist?</p>
			</div>
			<div class="modal-body">
                <input type="hidden" name="idwishlistdetail" id="delete-multiple-detail-wishlist" value=""/>
				<button class="btn round-btn-blue" id="submit-delete-category-wishlist" onclick="deleteMassalDetailWishlist()">Yes</button>
				<br/>
				<button class="btn round-btn-blue">No</button>

			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="width:350px;">
		<div class="modal-content">
			<div class="modal-header" style="border:0px;">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<img id="iconCloseModal" src="<?php echo Yii::$app->params['imgixUrl'] ?>icons/close-round.png" alt="icon"/>
				</button>
			</div>
			<div class="modal-body  text-center">
				<p class="text-center" style="font-weight:bold;font-size:14px;">Wish List Category</p>
				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>product/6671/6671_medium.jpg" width="100px"/>
                    <input id="input-category-wishlist" class="rounded-input text-center" type="text" name="category" placeholder="Category" required/>
                    <button id="submit-category-wishlist" class="btn round-btn-blue" onclick="addCategoryWishlist()">Oke</button>

			</div>
		</div>
	</div>
</div>





