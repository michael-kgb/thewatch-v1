<div>
<?php
                            
                                    echo $customer_address->firstname . ' ' . $customer_address->lastname.'<br> ';
                                        echo $customer_address->address1 . '<br> ';
                                        echo $customer_address->phone . '<br> ';
                                        echo $customer_email . '<br> ';
                                        $shippingSelectedId = $customer_address->customer_address_id;
?>                           
                                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-3 clearleft" style="font-size: 12px;padding-top: 10px;height:70px;">
                                    <a style="position: absolute;padding-top: 5px;padding-bottom: 5px;width: 92px;text-align: center;" class="yellow-round" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/editaddress/<?php echo $shippingSelectedId; ?>">Edit</a>
                                </div>
                      
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 center" style="font-size: 12px;padding-top: 10px;height:70px;">
                                    <a style="position: absolute;padding-top: 5px;padding-bottom: 5px;width: 92px;text-align: center;" class="red-round" href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/deleteaddress/<?php echo $shippingSelectedId; ?>">Hapus</a>
                                </div>
</div>
