<?php

use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");
$shippingInformation = $customerInfo['shippingInformation'];

//print_r($_SESSION);
?>
<script async="true" src="//ssp.adskom.com/tags/third-party-async/NmJlMzA1MzgtZmIwYS00MTI5LTk3NTQtMzI3MDEzZDcyMTE1"></script>

<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
          
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "profile",
            ));
            ?>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 myprofile">
                <div class="profile-head">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 my-profile title clearleft clearright" style="">
                        My Profile
                    </div>
                </div>

                <div class="wrap-profile-info">
                    <?php if (isset($_SESSION['customerInfo'])) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile active clearleft clearright">
                            <div class="col-lg-9 col-md-9 col-sm-12 clearleft remove-padding">
                                <div class="ic_small">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_personal.png" alt="icons" />
                                </div>
                                <?php
                                $lname = '';
                                if (isset($_SESSION['customerInfo']['lname'])) {
                                    $lname = $_SESSION['customerInfo']['lname'];
                                }
                                echo $customerInfo['fname'] . ' ' . $lname;
                                ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 section-right">
                                <a href="<?php echo \yii\helpers\Url::base(); ?>/user/edit-profile" class="round-btn-blue">Edit</a>
                            </div>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
                            <div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
                                <div class="ic_small">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_email.png" alt="icons" />
                                </div>
                                <?php echo $customerInfo['email']; ?>
                            </div>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
                            <div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
                                <div class="ic_small">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_phone.png" alt="icons" />
                                </div>
                                <?php echo isset($shippingInformation[0]['phone']) ? $shippingInformation[0]['phone'] : '-'; ?>
                            </div>
                            
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
                            <div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
                                <div class="ic_small">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_birthday.png" alt="icons" />
                                </div>
                                <?php echo isset($customerInfo['birthday']) ? $customerInfo['birthday'] : '-'; ?>
                            </div>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info profile clearleft clearright">
                            <div class="col-lg-8 col-md-8 col-sm-12  clearleft remove-padding">
                                <div class="ic_small">
                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_gender.png" alt="icons" />
                                </div>
                                <?php echo isset($customerInfo['gender']) && $customerInfo['gender'] !== 0 ? $customerInfo['gender'] : 'Not Set'; ?>
                            </div>
 
                        </div>
                        
                    <?php } ?>
                </div>

                <div class="free-btn col-md-6 remove-padding">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/change-password" class="round-btn-blue">
                    Change Password
                    </a>
                </div>
                
                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info separator last clearleft clearright"></div> -->
            </div>
            <!-- 
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 myprofile" style="float:right;">
                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 my-profile title clearleft clearright" style="">Password</div>
                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 my-profile edit clearright" style=""><a href="<?php echo \yii\helpers\Url::base(); ?>/user/change-password" style="color:#9e8463;text-decoration: underline;">Change Password</a></div>
                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 clearleft" style="border-bottom: solid 1px #a8a9ad;"></div>
            </div>
            -->
        </div>
    </div>
</section>