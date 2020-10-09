<div>
<input type="hidden" value="0" id="shippingmet" name="shippingmet">
<?php if(count($carriers) > 0) { ?>
                                    <?php foreach ($carriers as $carrier) { ?>
                                    <?php //if((int)$carrier->price !== 0) { ?>
                                   
                                       <?php if($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'REGULER'){
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                            
                                            <div class="radio-btn" style="">
                                                <input type="radio" name="shipping_method" id="<?php echo $carrier->carrier_cost_id; ?>" value="<?php echo $carrier->carrier_cost_id; ?>" style="pointer-events: none;">
                                                <label for="<?php echo $carrier->carrier_cost_id; ?>" class="black-style" onclick="shipping_method(<?php echo $carrier->carrier_cost_id; ?>)" style="color: #000;">
                                                    <?php
                                                    //echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; 
                                                    echo $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (3 - 5 hari)';
                                                    ?>
                                                </label>
                                            </div>
                                        </div>

                                        
                                        <?php 
                                        // flat price if customer upgrade shipping service
                                        } elseif($carrier->carrierPackageDetail->carrierPackage->carrier_package_name == 'YES'){ 
                                            $provinceId = backend\models\CustomerAddress::findOne(['customer_address_id' => $customerAddressId])->province_id;
                                            $flatPrice = \backend\models\CarrierCostFlatPrice::findOne(['province_id' => $provinceId, 'carrier_package_id' => 3])->price;
                                            if($carrier->price != 0 || $carrier->price != '-'){
                                                if($flatPrice != null){
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                            
                                            <div class="radio-btn" style="">
                                                <input type="radio" id="<?php echo $carrier->carrier_cost_id; ?>" name="shipping_method" value="<?php echo $carrier->carrier_cost_id; ?>" style="pointer-events: none;">
                                                <label for="<?php echo $carrier->carrier_cost_id; ?>" class="black-style" onclick="shipping_method(<?php echo $carrier->carrier_cost_id; ?>)" style="color: #000;">
                                                    <?php
                                                    //echo $carrier->carrier->name . ' - ' . $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (' . $carrier->day . ' days)'; 
                                                    echo $carrier->carrierPackageDetail->carrierPackage->carrier_package_name . ' - (1 - 2 hari)';
                                                    ?>
                                                </label>
                                            </div>
                                        </div>

                                        <?php
                                                }
                                        } } else { } ?>
                                        
                                        
                                 
                                   
                                    <?php //} ?>
                                    <?php } ?>
                                    <?php } ?>
</div>