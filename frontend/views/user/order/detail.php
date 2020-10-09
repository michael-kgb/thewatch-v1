<?php

use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");

//print_r($_SESSION);
?>
<section id="shopping-bag" class="ptop0">
    <div class="container">
        <div class="row">
            <!-- <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag title">ORDER DETAIL</div> -->
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "my_order",
            ));
            ?>

            <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile remove-padding">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders" selected>MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-9 col-sm-9 col-xs-12 myprofile gotham-light">
                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 clearleft clearright clearleft-mobile clearright-mobile">
                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 talign-center gotham-medium">Detail Transaksi</div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile bgcolorprimary talign-center my-order gotham-light fcolorfff p10">
                        <?php echo $last_history->orderStateLang->name != '' ? $last_history->orderStateLang->name : 'Transaksi di Toko'; ?>
                    </div>
                    <?php 
                        
                        $i = 0;
                        foreach ($order_details as $order_detail) {
                        
                    ?>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line <?php echo $i != 0 ? 'show-detail-history':''; ?>"></div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 product-frame <?php echo $i != 0 ? 'show-detail-history':''; ?>">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile">
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 clearleft-mobile clearleft clearright clearright-mobile" style="height: 65px;">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/brands/black/<?php echo $order_detail->product->brands->brand_logo; ?>" class="img-responsive" style="height: 65px;margin:auto;">
                            </div>
                            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 clearleft-mobile clearleft clearright clearright-mobile" style="height: 65px;display: flex;align-items: center;">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile">
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        Tanggal Pembelian
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">
                                        <?php echo date('d/m/Y', strtotime($orders['date_add'])); ?>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 clearleft-mobile clearleft clearright clearright-mobile">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/product/<?php echo $order_detail->product->productImage->product_image_id . '/' . $order_detail->product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                            </div>
                            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 clearleft-mobile clearleft clearright clearright-mobile">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">
                                    <?php echo $order_detail->product->brands->brand_name; ?>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light">
                                    <?php echo $order_detail->product_name; ?>
                                    <?php echo $order_detail->product_attribute_id == 0 ? '' : ' - '.$order_detail->productAttributeCombination->attributeValue->value; ?>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>

                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">
                                    Jumlah Barang
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light">
                                    <?php echo $order_detail->product_quantity; ?> Barang
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>

                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">
                                    Total
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light">
                                    Rp. <?php echo \common\components\Helpers::getPriceFormat($order_detail->original_product_price); ?>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                        </div>
                    </div>
                    <?php
                        $i++;
                        }
                    ?>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 talign-center gotham-light cpointer" id="more-detail-history">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 fcolorblue" id="lihat-lebih">
                        Lihat lebih
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="lihat-arrow-down">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-arrow-16.png" class="mauto">
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 fcolorblue" id="lihat-kurangi">
                        Kurangi
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="lihat-arrow-up">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/up-arrow-16.png" class="mauto">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>

                    <!-- Total Pembayaran -->
                    <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile my-account detail-frame">
                        <table width="100%">
                            <tr>
                                <td width="50%">Sub Total</td>
                                <td width="50%" class="talign-right">Rp. <?php echo common\components\Helpers::getPriceFormat($sub_total); ?></td>
                            </tr>
                            
                            <tr>
                                <td>Biaya Kirim</td>
                                <td class="talign-right">Rp. <?php echo common\components\Helpers::getPriceFormat($orders->total_shipping); ?></td>
                            </tr>
                            <tr>
                                <td>Asuransi Pengiriman</td>
                                <td class="talign-right">Rp. <?php echo common\components\Helpers::getPriceFormat($orders->total_shipping_insurance); ?></td>
                            </tr>
                            <?php if($diskon != 0){?>
                            <tr>
                                <td>Diskon</td>
                                <td class="talign-right">Rp. <?php echo common\components\Helpers::getPriceFormat($diskon); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($orders->total_special_promo != 0){?>
                            <tr>
                                <td>Diskon Spesial</td>
                                <td class="talign-right">Rp. <?php echo common\components\Helpers::getPriceFormat($orders->total_special_promo); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($orders->unique_code != 0){?>
                            <tr>
                                <td>Kode Unik</td>
                                <td class="talign-right"><?php echo $orders->unique_code; ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td>Grand Total</td>
                                <td class="talign-right">Rp. <?php echo common\components\Helpers::getPriceFormat(($orders->total_shipping + $sub_total + $orders->unique_code + $orders->total_shipping_insurance - $diskon - $orders->total_special_promo)); ?></td>
                            </tr>
                        </table>
                        
                    </div>

                    <!-- Shipping Address -->
                    <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile my-account detail-frame">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-medium mbottom5p">
                            Alamat Pengiriman
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light">
                            <?php echo $orders->customeraddress->firstname.' '.$orders->customeraddress->lastname;?>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light">
                            <?php echo $orders->customeraddress->phone; ?>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light">
                            <?php echo $orders->customeraddress->address1.', '.$orders->customeraddress->district->name.', '.$orders->customeraddress->province->name.', '.$orders->customeraddress->postcode; ?>
                        </div>
                    </div>
                    <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>

                    <?php if($orders->shipping_number != ''){ ?>
                    <!-- Resi Number -->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile my-account detail-frame">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light mbottom5p fcolor151">
                            Nomor Resi
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light mbottom5p">
                            <?php echo $orders->shipping_number;?>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light mbottom5p fcolor151">
                            Kurir Pengiriman
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light mbottom5p">
                            <?php echo $orders->carrier_delivery_name;?>
                        </div>
                        
                    </div>
                    <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                    <?php } ?>

                    <!-- Pantau Pesanan -->
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile my-account detail-frame">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-medium mbottom10">
                            Pantau Pesanan
                        </div>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light">
                            <table class="width100">
                             <?php if($order_cancel_date == ''){?>
                              <tr height="60">
                                <td width="20%">
                                    <?php echo $step_date_8 != '' ? date('d/m/y', strtotime($step_date_8)):''; ?>
                                </td>
                                <td width="10%">
                                    <?php if($step_date_8 != ''){?>
                                      <div class="part-1-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-1-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>

                                      
                                </td>
                                <td>
                                    Produk Pesanan Anda telah sampai tujuan
                                </td>
                              </tr>
                              
                              <?php 
                                if($orders->shipping_number != '' && $orders->carrier_delivery_name == 'NINJAEXPRESS'){ 
                                    $ninja_logs = \backend\models\NinjaLog::find()->where(['tracking_id'=>$orders->shipping_number])->orderBy('date_time_add DESC')->all();
                                    foreach ($ninja_logs as $ninja_log) {
                                ?>
                                    <tr height="60">
                                        <td>
                                            <?php echo date('d/m/y', strtotime($ninja_log->date_time_add)); ?>
                                        </td>
                                        <td>  
                                              <div class="part-2-green">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                              </div>              
                                        </td>
                                        <td>
                                            <?php echo $ninja_log->status.'. '.$ninja_log->comments; ?>
                                        </td>
                                      </tr>
                                <?php
                                    }
                                ?>
                            <?php } ?>
                                                               
                              <tr height="60">
                                <td>
                                    <?php echo $step_date_7 != '' ? date('d/m/y', strtotime($step_date_7)):''; ?>
                                </td>
                                <td>
                                    <?php if($step_date_7 != ''){?>
                                      <div class="part-2-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-2-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Produk Pesanan Anda sudah dikirim
                                </td>
                              </tr>
                              
                              <tr height="60">
                                <td>
                                    <?php echo $step_date_6 != '' ? date('d/m/y', strtotime($step_date_6)):''; ?>
                                </td>
                                <td>
                                    <?php if($step_date_6 != ''){?>
                                      <div class="part-2-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-2-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Produk Pesanan Anda sedang diproses packing oleh The Watch Co
                                </td>
                              </tr>
                                  <?php if($not_pass_date == ''){?>
                                    <?php if($customerInfo['customer_id'] == 2){ ?>
                                      <tr height="60">
                                        <td>
                                            <?php echo $step_date_5 != '' ? date('d/m/y', strtotime($step_date_5)):''; ?>
                                        </td>
                                        <td>
                                            <?php if($step_date_5 != ''){?>
                                              <div class="part-2-green">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                              </div>
                                              <?php }else{ ?>
                                              <div class="part-2-gray">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                              </div>
                                              <?php } ?>
                                        </td>
                                        <td>
                                            Produk Anda telah Lolos Proses Cek Kualitas Produk
                                        </td>
                                      </tr>
                                     <?php } ?>
                                  <?php } ?>
                              <?php } ?>

                              <?php if($refund_date != ''){?>
                              <tr height="60">
                                <td>
                                    <?php echo $refund_date != '' ? date('d/m/y', strtotime($refund_date)):''; ?>
                                </td>
                                <td>
                                    <?php if($refund_date != ''){?>
                                      <div class="part-2-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-2-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Proses Refund
                                </td>
                              </tr>
                              <?php } ?>

                              <?php if($order_cancel_date != ''){?>
                              <tr height="60">
                                <td width="20%">
                                    <?php echo $order_cancel_date != '' ? date('d/m/y', strtotime($order_cancel_date)):''; ?>
                                </td>
                                <td width="10%">
                                    <?php if($order_cancel_date != ''){?>
                                      <div class="part-2-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-2-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Pesanan Telah Dibatalkan
                                </td>
                              </tr>
                              <?php } ?>

                              <?php if($customer_cancel_date != ''){?>
                              <tr height="60">
                                <td>
                                    <?php echo $customer_cancel_date != '' ? date('d/m/y', strtotime($customer_cancel_date)):''; ?>
                                </td>
                                <td>
                                    <?php if($customer_cancel_date != ''){?>
                                      <div class="part-2-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-2-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Anda telah membatalkan pesanan
                                </td>
                              </tr>
                              <?php } ?>

                              <?php if($not_pass_date != ''){?>
                                <?php if($customerInfo['customer_id'] == 2){ ?>
                                  <tr height="60">
                                    <td>
                                        <?php echo $not_pass_date != '' ? date('d/m/y', strtotime($not_pass_date)):''; ?>
                                    </td>
                                    <td>
                                        <?php if($not_pass_date != ''){?>
                                          <div class="part-2-green">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                          </div>
                                          <?php }else{ ?>
                                          <div class="part-2-gray">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                          </div>
                                          <?php } ?>
                                    </td>
                                    <td>
                                        Produk Pesanan Anda tidak Lolos Cek Kualitas Produk
                                    </td>
                                  </tr>
                                 <?php } ?>
                              <?php } ?>

                              <?php if($order_cancel_date == ''){?>
                                <?php if($customerInfo['customer_id'] == 2){ ?>
                                  <tr height="60">
                                    <td>
                                        <?php echo $step_date_4 != '' ? date('d/m/y', strtotime($step_date_4)):''; ?>
                                    </td>
                                    <td>
                                        <?php if($step_date_4 != ''){?>
                                          <div class="part-2-green">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                          </div>
                                          <?php }else{ ?>
                                          <div class="part-2-gray">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                          </div>
                                          <?php } ?>
                                    </td>
                                    <td>
                                        Produk Pesanan Anda sedang dalam Proses Cek Kualitas Produk
                                    </td>
                                  </tr>
                                <?php } ?>

                                  <?php if($step_date_3b != ''){?>
                                      <tr height="60">
                                        <td>
                                            <?php echo $step_date_3b != '' ? date('d/m/y', strtotime($step_date_3b)):''; ?>
                                        </td>
                                        <td>
                                            <?php if($step_date_3b != ''){?>
                                              <div class="part-2-green">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                              </div>
                                              <?php }else{ ?>
                                              <div class="part-2-gray">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                              </div>
                                              <?php } ?>
                                        </td>
                                        <td>
                                            Pembayaran Berhasil
                                        </td>
                                      </tr>
                                  <?php } ?>

                                  <?php if($step_date_3b == ''){?>
                                      <tr height="60">
                                        <td>
                                            <?php echo $step_date_3 != '' ? date('d/m/y', strtotime($step_date_3)):''; ?>
                                        </td>
                                        <td>
                                            <?php if($step_date_3 != ''){?>
                                              <div class="part-2-green">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                              </div>
                                              <?php }else{ ?>
                                              <div class="part-2-gray">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                              </div>
                                              <?php } ?>
                                        </td>
                                        <td>
                                            Pembayaran Telah Diterima
                                        </td>
                                      </tr>
                                  <?php } ?>
                              <?php } ?>

                              <?php if($payment_failed_date != ''){?>
                              <tr height="60">
                                <td>
                                    <?php echo $payment_failed_date != '' ? date('d/m/y', strtotime($payment_failed_date)):''; ?>
                                </td>
                                <td>
                                    <?php if($payment_failed_date != ''){?>
                                      <div class="part-2-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-2-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Pembayaran Gagal
                                </td>
                              </tr>
                              <?php } ?>

                              <tr height="60">
                                <td>
                                    <?php echo $step_date_2 != '' ? date('d/m/y', strtotime($step_date_2)):''; ?>
                                </td>
                                <td>
                                    <?php if($step_date_2 != ''){?>
                                      <div class="part-2-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-2-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-42.png" style="margin-left:7px;display:block;position: absolute;height:42px;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Menunggu Pembayaran
                                </td>
                              </tr>


                              <tr height="60">
                                <td>
                                    <?php echo $step_date_1 != '' ? date('d/m/y', strtotime($step_date_1)):''; ?>
                                </td>
                                <td>
                                    <?php if($step_date_1 != ''){?>
                                      <div class="part-8-green">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                      </div>
                                      <?php }else{ ?>
                                      <div class="part-8-gray">
                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                      </div>
                                      <?php } ?>
                                </td>
                                <td>
                                    Pesanan Anda Telah Diterima 
                                </td>
                              </tr>
                            </table>
                            
                        </div>
                  
                        
                    </div>
                    <a class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile blue-round default" href="<?php echo \yii\helpers\Url::base(); ?>/user/orders">Kembali</a>
                </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style type="text/css">
    .show-detail-history{
        display: none;
    }
    #lihat-kurangi,#lihat-arrow-up{
        display: none;
    }

</style>