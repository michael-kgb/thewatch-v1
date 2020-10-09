<?php

use yii\web\Session;
use app\assets\VeritransAsset;

VeritransAsset::register($this);

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");

//print_r($_SESSION);
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script type="text/javascript">
var vospay_env = "<?php echo Yii::$app->params['vospay_conf']['environment'];?>" // vospay env
var vospay_mrchnt = "<?php echo Yii::$app->params['vospay_conf']['mrchnt_key'];?>" // vospay merchant_key
function slideDetail(event) {
     
    if (event != null) {
        if ($('#detail-hide-' + event).hasClass("non-active")) {
            $('#detail-hide-' + event).slideDown();
            $('#detail-hide-' + event).removeClass("non-active");
            $('#detail-hide-' + event).addClass("active");
            document.getElementById("see-detail-"+ event).innerHTML = " (HIDE DETAILS)";
            // $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/top-spec.png">');
        }
        else {
            $('#detail-hide-' + event).slideUp();
            $('#detail-hide-' + event).removeClass("active");
            $('#detail-hide-' + event).addClass("non-active");
            document.getElementById("see-detail-"+ event).innerHTML = " (SEE DETAILS)";
            // $('.arrow-down-' + event).replaceWith('<img class="arrow-down-' + event + '" src="/img/icons/down-spec.png">');
        }
    }
}

function payVosPay(orderId){
	
	$.ajax({
        type: "POST",
        url: baseUrl + '/api/orders/check',
        beforeSend: function () {
            $('#loadingScreen').modal('show');
        },
		dataType: 'json',
		contentType: "application/json; charset=utf-8",
        data: JSON.stringify({ orderId: orderId }),
        success: function (data) {
            var d = data;
			console.log(data);
            if (d.success) {
				
				vospayConfig = {
                    merchantKey: vospay_mrchnt,
                    apiHost: vospay_env,
					transactionDetails: {
						orderID: d.data.vospayOrderId,
						orderDescription: 'The Watch Co. - Order Information',
						items: d.data.products,
						currency: 'IDR',
						shipping: d.data.shipping,
						grossAmount: d.data.grossAmount,
						customerDetails: d.data.customerDetails
					},
					onDone: (result) => {
						var status = result.status;
						
						//if(status == "Success"){
							window.location = 'https://www.thewatch.co/user/orders';
						//}
					},
					onError: (error) => {
						console.log('Payment error:', error);
					},
					logoURL: 'https://www.thewatch.co/img/logos/logo.png',
					notifyEndpoint: 'https://thewatch.co/api/payment'
				}
				
                $('#loadingScreen').modal('hide');
				
				vospay.payNow(vospayConfig);
            } else {
				$('#loadingScreen').modal('hide');
				return;
            }
        }
    });
	
}

</script>
<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <!-- <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag title">MY ORDER</div> -->
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "my_order",
            ));
            ?>

         <!--    <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders" selected>MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->

<style type="text/css">
    table tr td div{
        padding:15px;
    }
</style>
            <div class="clear"></div>
         <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearleft clearright clearright-mobile clearleft-mobile">
         <div class="profile-head">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 my-profile title clearleft clearright" style="">
                Daftar Transaksi
            </div>
        </div>

        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearright-mobile clearleft-mobile">
            <div class="alert-success alert-dismissable bradius5 p10">
            <i class="icon fa fa-check"></i>Saved!
            <?= Yii::$app->session->getFlash('success') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
        </div>
        <?php endif; ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright" id="search-warranty">
            <?php 

            ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                        <select id="filter-warranty-card" onchange="filter_order(this)" style="width: 100%;cursor: pointer;border-radius: 20px;padding-left: 12px;outline:0;padding-right: 12px;letter-spacing: 1.5px;height:33px;">
                            <option value="all">Cari Berdasarkan : Semua Order</option>
                            <!-- <option value="status">Cari Berdasarkan : Semua Status</option> -->
                            <option value="date">Cari Berdasarkan : Periode Tanggal</option>
                            <option value="transaction" <?php echo (isset($_GET['tr'])) ? 'selected':''; ?>>Cari Berdasarkan : Nomor Transaksi</option>
                        </select>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light dnone" id="status-section">
                        <a class="blue-round paging">Semua</a> <a class="white-round paging">Proses Packing</a> <a class="blue-round paging">Sedang Dikirim</a> <a class="blue-round paging">Sampai Tujuan</a>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile clearleft clearright gotham-light <?php echo (isset($_GET['date_to'])) ? '':'dnone'; ?>" id="date-section">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearleft-mobile gotham-light">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft-mobile clearleft gotham-light">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light talign-center mbottom5p">Dari</div>
                                <input type="text" name="date-from" value="<?php echo (isset($_GET['date_from'])) ? $_GET['date_from']:date('Y-m-d'); ?>" class="width100 bradius20 pleft15 pright15 height33 talign-center fcolorblue input-default" / >
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft-mobile clearleft gotham-light">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile gotham-light talign-center mbottom5p">Hingga</div>
                                <input type="text" name="date-to" value="<?php echo (isset($_GET['date_to'])) ? $_GET['date_to']:date('Y-m-d'); ?>" class="width100 bradius20 pleft15 pright15 height33 talign-center fcolorblue input-default" / >
                            </div>

                                <a id="tanggal-order" style="position: absolute;top: 30px;cursor:pointer;"><i class="sprite-search-blue-19"></i></a>
                    
                        </div>
                       <!--  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line mbottom5p"></div>
                            <div class="col-lg-12 clearleft-mobile clearright-mobile clearright gotham-light">
                                <a id="tanggal-order"><i class="sprite-search-blue-19"></i></a>
                            </div>
                        </div> -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile clearleft clearright gotham-light <?php echo (isset($_GET['tr'])) ? '':'dnone'; ?>" id="transaction-section">
                        <div class="col-lg-12 clearleft-mobile clearleft clearright clearright-mobile gotham-light">
                            
                            <input type="text" name="tr" class="width100 bradius20 pleft15 pright15 height33 input-default" placeholder="nomor transaksi" value="<?php echo (isset($_GET['tr'])) ? $_GET['tr'] :''; ?>" / >
                            <a id="tr-order" style="position: absolute;top: 7px;right: 22px;width: 20px;cursor:pointer;"><i class="sprite-search-blue-19"></i></a>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
                       
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light new-line"></div>
                    </div>
                    
                </div>
                <?php 
                   
                    $question = \backend\models\Question::find()->where(['questionnaire_id'=>3])->one();
                    $question_choices = \backend\models\QuestionChoice::find()->where(['question_id'=>$question->question_id])->all();
                ?>
    <?php if (count($orders) > 0) { ?>
        <?php $i = 1; ?>
        <?php foreach ($orders as $order) { ?>
            <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12 <?php echo $i == 1 ? 'clearleft pright75-desktop':'clearright pleft75-desktop'; ?>">
                
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile order-history bradius5 box-shadow">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile bgcolorprimary talign-center my-order gotham-light fcolorfff p10 status-top">
                        <?php
                        echo $order->orderhistory->orderStateLang->name != '' ? $order->orderhistory->orderStateLang->name : 'Transaksi di Toko';
                        ?>
 
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearleft-mobile pright75">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">Tanggal</div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile"><?php echo date('d/m/Y', strtotime($order['date_add'])); ?></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearright clearright-mobile pleft75">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">Pukul</div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile"><?php echo date('H:m', strtotime($order['date_add'])); ?></div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearleft-mobile pright75">
                            <?php
                                $orderDetail = backend\models\OrderDetail::findAll(["orders_id" => $order->orders_id]);
                                $grandTotal = 0;
                                if (count($orderDetail)) {
                                    // $grandTotal = 0;
                                    foreach ($orderDetail as $ordered) {
                                        $grandTotal += $ordered->original_product_price * $ordered->product_quantity;
                                    }
                                }
                                
                                $voucher_discount = 0;
                                $order_cart_rule = backend\models\OrderCartRule::find()->where(['orders_id'=>$order->orders_id])->one();
                                if($order_cart_rule != null){
                                    $voucher_discount = $order_cart_rule->value;
                                }
                            ?>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">Nominal Pembayaran</div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">Rp. <?php echo common\components\Helpers::getPriceFormat(($order->total_shipping + $grandTotal + $order->unique_code + $order->total_shipping_insurance) - ($voucher_discount+$order->total_special_promo)); ?></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearright clearright-mobile pleft75">
                            <a class="blue-round default text-btn-responsive" data-toggle="modal" data-target="#showProduct-<?php echo $order->orders_id; ?>">Lihat Produk</a>
                            <div class="modal fade" id="showProduct-<?php echo $order->orders_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog warranty">

                                        <!-- Modal content-->
                                        <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                          <div class="modal-body" style="padding-top: 15px;width:100%;">
                                            <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;z-index: 1;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center">
                                                
                                                     Daftar Pesanan
                                                
                                             </div>
                                             <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                         </div>
                                         <div class="modal-body ptop0 width100" style="max-height: 500px;overflow-y:scroll;">

                                      

                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius:5px;text-align:center;">
                                                <?php 
                                                  
                                                    foreach ($orderDetail as $order_detail) {
                                                    
                                                ?>
                                                
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 product-frame">
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile">
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 clearleft-mobile clearleft clearright clearright-mobile" style="height: 65px;">
                                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/brands/black/<?php echo $order_detail->product->brands->brand_logo; ?>" class="img-responsive" style="height: 65px;margin:auto;">
                                                        </div>
                                                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 clearleft-mobile clearleft clearright clearright-mobile talign-left" style="height: 65px;display: flex;">
                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile">
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                    Tanggal Pembelian
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">
                                                                    <?php echo date('d/m/Y', strtotime($order->date_add)); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 clearleft-mobile clearleft clearright clearright-mobile">
                                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/product/<?php echo $order_detail->product->productImage->product_image_id . '/' . $order_detail->product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                                        </div>
                                                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 clearleft-mobile clearleft clearright clearright-mobile talign-left">
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
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                <?php
                                                  
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer" style="padding:8px;"></div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearleft-mobile pright75">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">Nomor Transaksi</div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile"><?php echo $order['reference']; ?></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearright clearright-mobile pleft75">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">Metode Pembayaran</div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                            <?php
                                if($order->paymentmethoddetail->paymentMethod->payment_method_id != 3){
                                    echo $order->paymentmethoddetail->paymentMethod->payment_method_name;
                                }                            
                                if($order->paymentmethoddetail->paymentMethod->payment_method_id == 1 || $order->paymentmethoddetail->paymentMethod->payment_method_id == 3 || $order->paymentmethoddetail->paymentMethod->payment_method_id == 6 || $order->paymentmethoddetail->paymentMethod->payment_method_id == 9){
                                    echo " ".$order->paymentmethoddetail->payment->name_bank;
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a class="blue-round default fsize-13" href="<?php echo \yii\helpers\Url::base(); ?>/user/order/detail/<?php echo $order->orders_id; ?>">Lihat Detail</a>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearleft-mobile pright75">
                            
                                <?php if ($order->flash_sale == 0 || $order->flash_sale == 1) { ?>
                                    <?php if($order->orderhistory->orderStateLang->template != 'shipped' && $order->orderhistory->orderStateLang->template != 'customer_confirm_receipt_of_goods'){ ?>
                                        
                                        <?php if($order->paymentmethoddetail->payment_method_id == 8){ ?>
                                            <?php if($order->orderhistory->orderStateLang->template == 'awaiting'){ ?>
                                                <button onClick="payVosPay('<?php echo $order->reference; ?>')" id="vospay" type="button" class="blue-round default fsize-13">Bayar</button>
                                            <?php }else{ ?>
                                                <a class="grey-round default fsize-13">Bayar</a>
                                            <?php } ?>
                                            
                                        <?php }else{ ?>
                                            <?php if ($order->paymentmethoddetail->payment_method_id != 4 && $order->paymentmethoddetail->payment_method_id != 5 && $order->paymentmethoddetail->payment_method_id != 2 && $order->paymentmethoddetail->payment_method_id != 3) { ?>
                                                <a <?php echo $order->orderhistory->orderStateLang->template == 'awaiting' ? 'class="blue-round default fsize-13" data-toggle="modal" data-target="#showBayar-'.$order->orders_id.'"':'class="grey-round default fsize-13"'; ?> >Bayar</a>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <a <?php echo $order->orderhistory->orderStateLang->template == 'customer_confirm_receipt_of_goods' ? 'class="yellow-round default fsize-13" data-toggle="modal" data-target="#showComplain-'.$order->orders_id.'"':'class="grey-round default fsize-13"'; ?> >Ulasan</a>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <a <?php echo $order->orderhistory->orderStateLang->template == 'awaiting' ? 'class="blue-round default fsize-13" href="'.\yii\helpers\Url::base().'/user/payment/'.$order->orders_id.'"':'class="grey-round default fsize-13"'; ?> >Bayar</a>
                                <?php } ?>
                            
                            <div class="modal fade" id="showBayar-<?php echo $order->orders_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog warranty">

                                        <!-- Modal content-->
                                        <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                          <div class="modal-body" style="padding-top: 15px;width:100%;">
                                            <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;z-index: 1;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center">
                                                
                                                     Bayar
                                                
                                             </div>

                                         </div>
                                         <div class="modal-body ptop0 width100" style="max-height: 500px;overflow-y:scroll;">

                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius:5px;text-align:center;">
                                                <?php if ($order->orderhistory->orderStateLang->action_text != '') { ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info active clearleft clearright remove-padding padding-top-5 border-top-button" style="font-size: 0.9em;">
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                                            Silahkan melakukan pembayaran transfer ke:
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                                           
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding" style="padding-top: 15px;padding-bottom: 15px;">
                                                            <?php
                                                            $payment_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $order->payment_method_detail_id])->payment_id;
                                                            $payment = \backend\models\Payment::findOne(["payment_id" => $payment_id]);
                                                            echo $payment->name_bank . ' - ' . $payment->account_number;
                                                            if($payment->payment_id == 1 || $payment->payment_id == 2){
                                                                echo ' - '.$payment->name_person;
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                                           
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                                           Once you have made your payment, please confirm at our webstore in the next 48 hours, and once we've verified your payment, we'll ship your package within the next five business days.
                                                        </div>
                                                        
                                                        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs gotham-light clearright remove-padding" style="padding-top: 20px;">
                                                           <a href="<?php echo \yii\helpers\Url::base(); ?>/user/order/confirmation/<?php echo $order->orders_id;?>" class="blue-round default">Konfirmasi Pembayaran</a>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if($order->paymentmethoddetail->payment_method_id == 9){ ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info active clearleft clearright remove-padding padding-top-5 border-top-button" style="font-size: 0.9em;">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding talign-center" style="color:#9e8463;padding-bottom: 15px;">
                                                                PEMBAYARAN GO-PAY
                                                            </div>
                                                            <?php
                                                                $va_log = \backend\models\VaLog::find()->where(['order_id'=>$order->reference])->orderBy('va_id DESC')->one();
                                                                $now = date('Y-m-d H:i:s'); 
                                                                $to = date($va_log->transaction_time);
                                                                $expire_count = \common\components\Helpers::getDifferentMicrotime($now, $to);
                                                                if($now > $to){
                                                                  
                                                                    $expire_count = 0;
                                                                }
                                                            ?>
                                                            <div class="col-xs-12 col-md-12 col-sm-12 hidden-lg clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                                                <a href="<?php echo $va_log->action_deeplink_redirect;?>" class="blue-round default" style="width: 100%;text-align: center;border-radius: 25px;">
                                                                    
                                                                    <span style="">Pay Now with <img id="gopay-img" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/gopay-white.png" class="img-responsive" style="display: inline;width: 35%;"></span>
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-12 hidden-sm hidden-md hidden-xs clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                                                Buka aplikasi <span class="gotham-medium">GO-JEK</span> di HP Anda dan scan kode QR di bawah. 
                                                            </div>
                                                            <div class="col-lg-12 hidden-sm hidden-md hidden-xs clearleft clearright gotham-light" style="padding-bottom: 15px;">
                                                                <img src="<?php echo $va_log->action_qr_code_url; ?>" class="img-responsive" style="width: 100px;margin: auto;">
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                                                Mohon selesaikan pembayaran Anda sebelum <br>
                                                                <?php
                                                                    $expire_time = strtotime('+15 minutes', strtotime($va_log->transaction_time));
                                                                ?>
                                                                <?php echo date('d F', $expire_time).' '.date('H:i', $expire_time); ?>
                                                            </div> 
                                                            <div class="col-lg-12 hidden-md hidden-sm hidden-xs clearleft clearright clearleft-mobile clearright-mobile talign-left">
                                                                <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                                                                <div class="col-lg-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                                                                    Bagaimana cara membayarnya? <br>
                                                                    Silahkan selesaikan pembayaran <span class="gotham-medium">GO-PAY</span> Anda menggunakan aplikasi <span class="gotham-medium">GO-JEK.</span>
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                                <div class="col-lg-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                                                                    <ol style="padding-left: 15px;">
                                                                      <li style="margin-left: 0;">Klik <span class="gotham-medium">Pay Now with GO-PAY.</span></li>
                                                                      <li style="margin-left: 0;">Buka aplikasi <span class="gotham-medium">GO-JEK</span> di handphone Anda.</li>
                                                                      <li style="margin-left: 0;">
                                                                        Klik <span class="gotham-medium">Scan QR.</span><br>
                                                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-1.png" class="img-responsive" style="width: 60%;margin: auto;">
                                                                        <span class="fsize-11 gotham-medium">Catatan:</span><br>
                                                                        <span class="fsize-11">Tombol Scan QR tidak akan muncul jika saldo
                                                                                GO-PAY Anda kurang dari Rp10,000.</span>
                                                                      </li>
                                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                                      <li style="margin-left: 0;">
                                                                        Arahkan kamera Anda ke <span class="gotham-medium">QR Code.</span><br>
                                                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-2.png" class="img-responsive" style="width: 60%;margin: auto;">
                                                                      </li>
                                                                      <li style="margin-left: 0;">Cek detai pembayaran Anda di aplikasi <span class="gotham-medium">GO-JEK</span> lalu <span class="gotham-medium">klik Pay.</span></li>
                                                                      <li style="margin-left: 0;">Transaksi Anda telah selesai.</li>
                                                                    </ol>
                                                                </div>
                                                            </div>   
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    
                                                    <?php if($order->paymentmethoddetail->payment_method_id == 6){ ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info active clearleft clearright remove-padding padding-top-5 border-top-button" style="font-size: 0.9em;">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 remove-padding" style="">
                                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $order->paymentmethoddetail->payment->filename;?>">
                                                            <div class="fcolor69 gotham-medium" style="padding-top: 30px;">
                                                                Anda akan melakukan pembayaran
                                                                menggunakan <?php echo $order->paymentmethoddetail->payment->name_bank; ?>
                                                                
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                                                        </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                                                Silahkan melakukan pembayaran virtual account ke:
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                                               
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-medium remove-padding" style="padding-top: 15px;padding-bottom: 15px;">
                                                                <?php
                                                                    $va_log = \backend\models\VaLog::find()->where(['order_id'=>$order->reference])->orderBy('va_id DESC')->one();
                                                                    echo $va_log->va_number.' - '.$va_log->va_bank;
                                                                ?>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                                               
                                                            </div>
                                                    </div>
                                                    <?php } ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer" style="padding:8px;"></div>
                                </div>

                                </div>
                            </div>
                            <div class="modal fade" id="showComplain-<?php echo $order->orders_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog warranty">

                                        <!-- Modal content-->
                                        <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                          <div class="modal-body" style="padding-top: 15px;width:100%;">
                                            <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;z-index: 1;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center">
                                                Berikan ulasan/komplain kepada pesanan ini
                                             </div>

                                         </div>
                                         <div class="modal-body ptop0 width100" style="max-height: 500px;overflow-y:scroll;">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                            <form method="POST" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/user/complain">
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                        <textarea name="complain" class="width100 bradius20 height100 p10 input-default"><?php echo $order->orderComplain->complain; ?></textarea>
                                                        
                                                    </div>
                                                    <input type="hidden" name="orders_id" value="<?php echo $order->orders_id; ?>">
                                                </div>
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                <?php if($order->orderComplain->complain == null){ ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <button type="submit" class="blue-round default simpan-complain">Simpan</button>
                                                </div>
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <a data-dismiss="modal" class="red-round default">Batal</a>
                                                </div>
                                                <?php } ?>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="modal-footer" style="padding:8px;"></div>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearright clearright-mobile pleft75">
                            <?php if($order->orderhistory->orderStateLang->template != 'shipped' && $order->orderhistory->orderStateLang->template != 'customer_confirm_receipt_of_goods'){ ?>
                                <a <?php echo $order->orderhistory->orderStateLang->template != 'shipped' && $order->orderhistory->orderStateLang->template != 'customer_confirm_receipt_of_goods' ? 'class="blue-round default text-btn-responsive" data-toggle="modal" data-target="#showChange-'.$order->orders_id.'"':'class="grey-round default text-btn-responsive"'; ?> >Ubah Penerima</a>
                            <?php }else{ ?>
                                <a <?php echo $order->orderhistory->orderStateLang->template != 'customer_confirm_receipt_of_goods' ? 'class="blue-round default text-btn-responsive" data-toggle="modal" data-target="#showAccept-'.$order->orders_id.'"':'class="blue-round default text-btn-responsive" data-toggle="modal" data-target="#showFinish-'.$order->orders_id.'"'; ?> ><?php echo $order->orderhistory->orderStateLang->template != 'customer_confirm_receipt_of_goods' ? 'Terima Produk':'Beri Rating'; ?></a>
                            <?php } ?>
                            <div class="modal fade" id="showChange-<?php echo $order->orders_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog warranty">

                                        <!-- Modal content-->
                                        <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                          <div class="modal-body" style="padding-top: 15px;width:100%;">
                                            <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;z-index: 1;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center">
                                                
                                                     Ubah Penerima
                                                
                                             </div>

                                         </div>
                                         <div class="modal-body ptop0 width100" style="max-height: 500px;overflow-y:scroll;">

                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius:5px;text-align:center;">
                                                <form method="POST" action="<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/user/changename">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty talign-left">
                                                            Nama Penerima
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                            <input type="text" name="nama" class="width100 bradius20 height33 pleft15 pright15 input-default" value="<?php echo $order->customeraddress->firstname; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty talign-left">
                                                            Nomor HP/Telp
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                            <input type="text" name="telp" class="width100 bradius20 height33 pleft15 pright15 input-default" value="<?php echo $order->customeraddress->phone; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty talign-left">
                                                            Tujuan
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile talign-left">
                                                            <?php echo $order->customeraddress->address1.', '.$order->customeraddress->district->name; ?><br>
                                                            <?php echo $order->customeraddress->province->name; ?><br>
                                                            <?php echo $order->customeraddress->postcode; ?>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="customer_address_id" value="<?php echo $order->customeraddress->customer_address_id; ?>">
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"></div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile">
                                                        <button type="submit" class="blue-round default">Ubah</button>
                                                    </div>
                                                </form>    
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer" style="padding:8px;"></div>
                                </div>

                                </div>
                            </div>
                            <div class="modal fade" id="showAccept-<?php echo $order->orders_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog warranty">

                                        <!-- Modal content-->
                                        <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                          <div class="modal-body" style="padding-top: 15px;width:100%;">
                                            <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;z-index: 1;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center">
                                                Apakah Anda sudah menerima produk Anda?
                                             </div>

                                         </div>
                                         <div class="modal-body ptop0 width100" style="max-height: 500px;overflow-y:scroll;">

                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius:5px;text-align:center;">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <a class="red-round default fsize-13" data-dismiss="modal">Kembali</a>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <a class="blue-round default fsize-13" id="selesai" attrid="<?php echo $order->orders_id; ?>">Ya</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                        </div>

                                    </div>
                                    <div class="modal-footer" style="padding:8px;"></div>
                                </div>

                                </div>
                            </div>
                            <div class="modal fade" id="showFinish-<?php echo $order->orders_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog warranty">

                                        <!-- Modal content-->
                                        <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                          <div class="modal-body" style="padding-top: 15px;width:100%;">
                                            <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;z-index: 1;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty talign-center">
                                                
                                                     Terimakasih Sudah Menyelesaikan Pesanan!
                                                
                                             </div>
                                             <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty talign-center">
                                                
                                                    <?php echo $question->questionnaire->questionnaire_title; ?>
                                                
                                             </div>
                                             <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                         </div>
                                         <div class="modal-body ptop0 width100" style="max-height: 500px;overflow-y:scroll;">

                                      

                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius:5px;text-align:center;">
                                                <form method="POST" action="<?php echo \yii\helpers\Url::base(); ?>/user/rating">
                                                    <input type="hidden" name="orders_id" value="<?php echo $order->orders_id; ?>">
                                                <?php 
                                                  
                                                    foreach ($orderDetail as $order_detail) {
                                                    
                                                ?>
                                                
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 product-frame">
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile">
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 clearleft-mobile clearleft clearright clearright-mobile" style="height: 65px;">
                                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/brands/black/<?php echo $order_detail->product->brands->brand_logo; ?>" class="img-responsive" style="height: 65px;margin:auto;">
                                                        </div>
                                                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 clearleft-mobile clearleft clearright clearright-mobile talign-left" style="height: 65px;display: flex;">
                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 clearleft-mobile clearleft clearright clearright-mobile">
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                    Tanggal Pembelian
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">
                                                                    <?php echo date('d/m/Y', strtotime($order->date_add)); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="horizontal-line col-lg-12 col-sm-12 col-md-12 col-xs-12"></div>
                                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 clearleft-mobile clearleft clearright clearright-mobile">
                                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/product/<?php echo $order_detail->product->productImage->product_image_id . '/' . $order_detail->product->productImage->product_image_id; ?>.jpg" class="img-responsive">
                                                        </div>
                                                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 clearleft-mobile clearleft clearright clearright-mobile talign-left">
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
                                                        
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-bottom: 10px;">
                                                                <?php 
                                                                    $product_rating = \backend\models\ProductRating::find()->where(['product_id'=>$order_detail->product->product_id])->andWhere(['product_attribute_id'=>$order_detail->product_attribute_id])->andWhere(['orders_id'=>$order->orders_id])->one();

                                                                    if($product_rating == null){
                                                                ?>
                                                       
                                                                    <div class='rating-stars text-center'>
                                                                        <ul id='stars' class="stars-<?php echo $order_detail->product->product_id; ?>">
                                                                          <li class='star' title='Very Poor' data-value='1' attrid='<?php echo $order->orders_id; ?>' attrtype='<?php echo $order_detail->product->product_id; ?>'>
                                                                            <i class='fa fa-star fa-fw'></i>
                                                                          </li>
                                                                          <li class='star' title='Poor' data-value='2' attrid='<?php echo $order->orders_id; ?>' attrtype='<?php echo $order_detail->product->product_id; ?>'>
                                                                            <i class='fa fa-star fa-fw'></i>
                                                                          </li>
                                                                          <li class='star' title='Fair' data-value='3' attrid='<?php echo $order->orders_id; ?>' attrtype='<?php echo $order_detail->product->product_id; ?>'>
                                                                            <i class='fa fa-star fa-fw'></i>
                                                                          </li>
                                                                          <li class='star' title='Good' data-value='4' attrid='<?php echo $order->orders_id; ?>' attrtype='<?php echo $order_detail->product->product_id; ?>'>
                                                                            <i class='fa fa-star fa-fw'></i>
                                                                          </li>
                                                                          <li class='star' title='Excellent' data-value='5' attrid='<?php echo $order->orders_id; ?>' attrtype='<?php echo $order_detail->product->product_id; ?>'>
                                                                            <i class='fa fa-star fa-fw'></i>
                                                                          </li>
                                                                            
                                                                        </ul>
                                                                  </div>
                                                                                                        
                                                                <input id="survei-<?php echo $order_detail->product->product_id; ?>-<?php echo $order->orders_id; ?>" name="survei[<?php echo $order_detail->product->product_id.'+'.$order_detail->product_attribute_id; ?>]" type="hidden">  

                                                                <input name="product[<?php echo $order_detail->product->product_id; ?>]" value="<?php echo $order_detail->product_attribute_id; ?>" type="hidden"> 

                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <div class='rating-stars text-center'>
                                                                        <ul id='starses'>
                                                                            <?php
                                                                                for($j = 0; $j<5;$j++){
                                                                            ?>
                                                                            <li class="star <?php echo $j < $product_rating->rating ? 'selected':'';?>">
                                                                                <i class='fa fa-star fa-fw'></i>
                                                                              </li>
                                                                            <?php
                                                                                }
                                                                            ?>

                                                                            
                                                                        </ul>
                                                                    </div>
                                                                     
                                                                <?php } ?>


                                                            </div>
                                                            
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:10px;"></div>
                                                        

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                <?php
                                                  
                                                    }
                                                ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <button type="submit" class="blue-round default">Selesai</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer" style="padding:8px;"></div>
                                </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                </div>
                
            </div>

            <div class="hidden-lg col-sm-12 hidden-md col-xs-12 new-line"></div>
            <?php if($i == 2){ ?>
                <div class="hidden-xs hidden-sm col-lg-12 col-md-12 new-line"></div>
            <?php $i = 0; } ?>
            <?php $i++; ?>
        <?php } ?>
    <?php } ?>
                <?php
                 
                    $total_page = ceil($count / $limit);
                    

                    if(!isset($_GET['page'])){
                        $current = 1;
                    }else{
                        $current = $_GET['page'];
                    }
                    // echo $limit.' '.count($orders);
                 ?>
                <?php
                     echo Yii::$app->view->renderFile('@app/views/user/_paging.php', array(
                         "current" => $current,
                         "breadcrumbs" => $breadcrumbs,
                         "total_page" => $total_page,
                         "limit" => $limit,
                         "params"=> $params,
                         "sortby"=> $sortby,

                     ));
                 ?>

                 <div class="hidden-lg col-sm-12 hidden-md hidden-xs new-line" style="padding-top: 98px;"></div>
    </div>
    </div>

        </div>
    </div>
</section>
<style type="text/css">
    .non-active{
        display: none;
    }
    .active{
        display: block;
    }
</style>
