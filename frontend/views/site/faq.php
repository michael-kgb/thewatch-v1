
<section id="shopping-bag">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag title">MY PROFILE</div>
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myaccount profile separator clearleft clearright"></div>
            <div class="hidden-xs col-lg-9 col-md-9 col-sm-9 shopping-bag product separator clearleft clearright"></div>
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myprofile menu-left box clearleft">
                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 myprofile menu-left active clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/profile">PROFILE</a>
                </div>
                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders">ORDER & CONFIRM</a>
                </div>
                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</a>
                </div>
                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/sign-out">SIGN OUT</a>
                </div>
                <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 myprofile menu-left separator last clearleft clearright"></div>
            </div>

            <div class="hidden-lg hidden-md hidden-sm margin-30">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders">ORDER & CONFIRM</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 myprofile clearleft">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info active clearleft clearright">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 clearleft remove-padding">
                            YOUR NAME
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 remove-padding">
                            
                        </div>
                    </div>
                    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info separator last clearleft clearright"></div>
            </div>
        </div>
    </div>
</section>