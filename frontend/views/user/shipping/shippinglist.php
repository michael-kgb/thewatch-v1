<?php
use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");
//$shippingInformation = $customerInfo['shippingInformation'];

$shippingInformation = backend\models\CustomerAddress::findAll(["customer_id" => $customerInfo['customer_id'],"deleted"=>0]);

//print_r($_SESSION);

?>
<script async="true" src="//ssp.adskom.com/tags/third-party-async/MjNmMDE0ZTUtNzA3Ni00NTE2LTk3YjEtZWI2ZGM5NDE3NDli"></script>

<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "shipping",
            ));
            ?>
            
<!--             <div class="hidden-lg hidden-md hidden-sm margin-30">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders">MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping" selected>SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->
            
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 myprofile">
                 <div class="profile-head">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 my-profile title clearleft clearright">
                        Shipping Information
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 section-right center-blue-btn ">
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping/create/" class="round-btn-blue">Add New Address</a>
                    </div>
                </div>

                <div class="list-address">
                <?php 
                if(count($shippingInformation) > 0) { 
                    $i = 0; 
                    foreach($shippingInformation as $shipping) { 
                    $inc_num = (int) $i+1;
                    $address_mask = "Address ".$inc_num;

                ?>

                <div class="col-md-6 col-sm-12 wrap-address <?php echo $shipping['set_as_default'] == 1 ? 'selected-address':''?>" id="ship_<?php echo $shipping['customer_address_id'];?>">
                    <div class="address-button">
                        
                        <div>
                            <div class="address-label"><?php echo empty($shipping['address_label']) || $shipping['address_label'] == '' ? $address_mask : $shipping['address_label'];?></div>
                        </div>
                        <div class="choose-address-wrap">
                            <input class="" type="radio" value="" id=""
                            onclick="setShipping(<?php echo $shipping['customer_address_id'].','.$shipping['customer_id'];?>)" 
                            name="shipping" <?php echo $shipping['set_as_default'] == 1 ? 'checked':''?>>
                            <label for="shipping"><span><span></span></span></label>
                            <a class="choose-address">
                            Choose this address
                            </a>
                        </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs myprofile customer-info clearleft clearright customer-info-address" style="padding-top: 30px;">
                                <a class="round-btn-blue" href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping/edit/<?php echo $shipping['customer_address_id']; ?>">Edit</a>
                            </div>
                            <div class="btn-res hidden-lg hidden-sm hidden-md col-xs-2 myprofile customer-info clearleft clearright customer-info-address" style="">
                                <a class="round-btn-blue" href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping/edit/<?php echo $shipping['customer_address_id']; ?>">Edit</a>
                            </div>
                            <?php if(count($shippingInformation) != 1) { ?>
                            <div class=" ol-lg-12 col-md-12 col-sm-12 hidden-xs myprofile customer-info clearleft clearright customer-info-address" style="padding-top: 5px;">
                                <a class="round-btn-blue" href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping/delete/<?php echo $shipping['customer_address_id']; ?>">Remove</a>
                            </div>
                            <div class="btn-res hidden-lg hidden-sm hidden-md col-xs-2 myprofile customer-info clearleft clearright customer-info-address" style="">
                                <a class="round-btn-blue" href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping/delete/<?php echo $shipping['customer_address_id']; ?>">Remove</a>
                            </div>
                        <?php } ?>
                        
                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
    
                    </div>
                    <div class="address-info">
                        <div class="address-info-inner">
                            <div class="ic_small">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_personal.png" alt="icons" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                <?php echo $shipping->firstname . ' ' . $shipping->lastname; ?>
                            </div>
                        </div>

                        <div class="address-info-inner">
                            <div class="ic_small">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_location.png" alt="icons" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                <?php echo $shipping['address1']; ?>
                                <?php echo backend\models\State::findOne(['state_id' => $shipping['state_id']])->name; ?> - <?php echo backend\models\Province::findOne(['province_id' => $shipping['province_id']])->name; ?>
                            </div>
                        </div>
                        <div class="address-info-inner">
                            <div class="ic_small">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_zip_code.png" alt="icons" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                <?php echo isset($shipping['postcode']) ? $shipping['postcode'] : ''; ?>
                            </div>
                        </div>
                    
                        <div class="address-info-inner">
                            <div class="ic_small">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/profile/ic_phone.png" alt="icons" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                <?php echo isset($shipping['phone']) ? $shipping['phone'] : ''; ?>
                            </div>
                        </div>
                      
                       
                    </div>
                </div>

                <?php 
                        $i++; 
                    } 
                } else { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs myprofile order-status clearleft clearright btn-edit-delete-shipping">
                        
                    </div>
                <?php 
                } 
                ?>
                </div>
                <div class="hidden-lg hidden-md hidden-sm col-xs-12 order-status clearleft clearright">
                    
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function setShipping(event,event2) {
     $.ajax({
        type: "POST",
        url: 'updateshipping',
        data: {
            'customer_address_id': event,
            'customer_id': event2

        },
        success: function (data) {

            let parentAddress = $('#ship_'+event);
            let allAddress = $('.wrap-address');
            
            for(let a = 0; a<allAddress.length; a++){
                $(allAddress[a]).removeClass('selected-address');
            }

            parentAddress.addClass('selected-address');
            //location.reload();
        }
    });
}
</script>