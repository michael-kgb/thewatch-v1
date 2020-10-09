<div class="hidden-xs col-lg-4 col-md-4 col-sm-4 myaccount profile separator clearleft clearright"></div>
<div class="hidden-xs col-lg-8 col-md-8 col-sm-8 shopping-bag product separator clearleft clearright" style="border-bottom: 0px solid;"></div>
<div class=" col-lg-4 col-md-4 col-sm-4 myprofile menu-left box clearleft">
    <div class=" col-lg-12 col-md-12 col-sm-12 myprofile menu-left
        <?php echo $currentPage === 'profile' || $currentPage === 'change_password' ? "active" : ""; ?>
        clearleft">
        <a  href="<?php echo \yii\helpers\Url::base(); ?>/user/profile">My Profile</a>
    </div>
    <div class=" col-lg-12 col-md-12 col-sm-12 myprofile menu-left
        <?php echo $currentPage === 'my_order' ? "active" : ""; ?> 
        clearleft">
        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders">My Order / Confirm Payment</a>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left 
        <?php echo $currentPage === 'shipping' ? "active" : ""; ?> 
        clearleft">
        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">Shipping Information</a>
    </div>
	<div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left 
        <?php echo $currentPage === 'my_wishlist' ? "active" : ""; ?> 
        clearleft">
        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/wishlist">My Wishlist</a>
    </div>
    <div class=" col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft">
        <a style="color:red !important;" href="<?php echo \yii\helpers\Url::base(); ?>/user/sign-out">Sign Out</a>
    </div>
</div>