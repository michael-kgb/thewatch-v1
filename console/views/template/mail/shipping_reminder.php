<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>*|MC:SUBJECT|*</title>
    
  <style type="text/css">
		body{
			margin:0;
		}
		body,table,td,p,a,li,blockquote{
			-webkit-text-size-adjust:none !important;
			font-family:Helvetica;
			font-style:normal;
			font-weight:400;
		}
		button{
			width:90%;
		}
	@media screen and (max-width : 600px ){
		body,table,td,p,a,li,blockquote{
			-webkit-text-size-adjust:none !important;
			font-family:Helvetica;
		}

}	@media screen and (max-width : 600px ){
		table{
			width:100%;
		}

}	@media screen and (max-width : 600px ){
		.footer{
			height:auto !important;
			max-width:48% !important;
			width:48% !important;
		}

}	@media screen and (max-width : 600px ){
		table.responsiveImage{
			height:auto !important;
			max-width:30% !important;
			width:30% !important;
		}

}	@media screen and (max-width : 600px ){
		table.responsiveContent{
			height:auto !important;
			max-width:66% !important;
			width:66% !important;
		}

}	@media screen and (max-width : 600px ){
		.top{
			height:auto !important;
			max-width:48% !important;
			width:48% !important;
		}

}	@media screen and (max-width : 600px ){
		.catalog{
			margin-left:0 !important;
		}

}	@media screen and (max-width:480px){
		body,table,td,p,a,li,blockquote{
			-webkit-text-size-adjust:none !important;
			font-family:Helvetica;
		}

}	@media screen and (max-width:480px){
		table{
			width:100% !important;
			border-style:none !important;
		}

}	@media screen and (max-width:480px){
		.footer{
			height:auto !important;
			max-width:96% !important;
			width:96% !important;
		}

}	@media screen and (max-width:480px){
		.table.responsiveImage{
			height:auto !important;
			max-width:96% !important;
			width:96% !important;
		}

}	@media screen and (max-width:480px){
		.table.responsiveContent{
			height:auto !important;
			max-width:96% !important;
			width:96% !important;
		}

}	@media screen and (max-width:480px){
		.top{
			height:auto !important;
			max-width:100% !important;
			width:100% !important;
		}

}	@media screen and (max-width:480px){
		.catalog{
			margin-left:0 !important;
		}

}	@media screen and (max-width:480px){
		button{
			width:90% !important;
		}

}</style></head>
  <body yahoo="yahoo" style="background-color: #fff;">
    <table width="100%" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td>
            <table width="600" align="center" cellpadding="0" cellspacing="0">
              <!-- Main Wrapper Table with initial width set to 60opx -->
              <tbody>
                <tr>
                  <td>
                    <table width="600" style="height:50px;margin-bottom:10px;background-color:rgb(32,97,103);">
                      <tr>
                        <td width="210">
                          <img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/7562fc00-e0b6-4fbe-bb6a-40c430e62360.png" width="210">
                        </td>
                        <td width="180">
                          <a href="https://www.thewatch.co">
                            <img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/800cc916-8442-4974-9870-18d00540bfaa.png" width="180"></a>
                          </td>
                          
                          <td width="210">
                            <img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/7562fc00-e0b6-4fbe-bb6a-40c430e62360.png" width="210">
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <!-- Introduction area -->
                    <td>
                      <table width="100%" align="left" cellpadding="0" cellspacing="0">
                        <tr>
                          <!-- row container for TITLE/EMAIL THEME -->
                          <td align="center" style="padding-top:25px;" width="600">
                            <a style="text-decoration:none;color:#454545;font-size:18px;font-weight:bold;text-align:center;">
                              Apakah barang pesanan Anda sudah diterima?
                            </a>
                          </td>
                        </tr>
                        
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <!-- HTML Spacer row -->
                    <td style="font-size:0;line-height:0;" height="10">
                      <table width="600" align="left" cellpadding="0" cellspacing="0" style="padding-top:35px;">
                        <tr>
                         
                            <td width="275"></td>
                            <td style="font-size:0;line-height:0;" height="25" width="50"> 
                              <img src="https://thewatch.co/img/icons/box.png">
                            </td>
                            <td width="275"></td>  

                        </tr>
                      </table>
                    </td>
                  </tr>
                  
                  <?php
                      $order_details = \backend\models\OrderDetail::find()->where(['orders_id'=>$model->orders_id])->all();

                      $discount = 0;
                      $order_cart_rule = \backend\models\OrderCartRule::find()->where(['orders_id'=>$model->orders_id])->one();
                      if($order_cart_rule != null){
                        $discount = $order_cart_rule->value;
                      }
                            $grandTotal = 0;
                            if(count($order_details) > 0) {
                              $i = 1; 
                              foreach ($order_details as $order_detail) {
                                $grandTotal += $order_detail->original_product_price * $order_detail->product_quantity;
                              }
                            }
                            $total_item = $grandTotal;
                            $grandTotal += $model->total_shipping;
                            $grandTotal += $model->total_shipping_insurance;
                            $grandTotal += $model->unique_code;
                            $grandTotal -= $model->total_special_promo;
                            $grandTotal -= $discount;

                  ?>
                  <tr>
                    <td>
                      <table width="600" cellspacing="0" cellpadding="0" align="center" style="padding-bottom:35px;padding-top:35px;">
                        <tr>
                          <!-- Row container for Intro/ Description -->
                          <td width="15"></td>
                          <td align="center" width="570">
                            <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                              Apakah barang pesanan Anda sudah diterima?
                              
                            </div>
                            <br>


                              <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                                Halo <?php echo $model->customeraddress->firstname; ?>,
                              </div>
                              <br>
                              
                              <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                                Pesanan Anda telah masuk pada hari kedua dari hari pengiriman, jika pesanan Anda telah diterima silahkan mengkonfirmasi dengan memilih tombol terima dan jika pesanan Anda belum datang maka silahkan pilih tombol belum diterima.
                              </div>
                              <br>
                              <table width="570" align="left" cellpadding="0" cellspacing="0" style="margin-top:5px;font-size: 14px;text-align: center;margin-bottom:20px;">
                              <tr>
                                <td width="107"></td>
                                <td width="170" style="background-color: rgb(160,29,34);color: #fff;border-radius: 25px;padding-top: 5px;padding-bottom: 5px;"><a href="" style="color: #fff;text-decoration:unset;">Belum Diterima</td>
                                <td width="15">
                                </td>
                                <td width="170" style="background-color: rgb(32,97,103);color: #fff;border-radius: 25px;padding-top: 5px;padding-bottom: 5px;"><a href="https://www.thewatch.co/status/acceptproduct/<?php echo $token; ?>/<?php echo $model->secure_key; ?>" style="color: #fff;text-decoration:unset;">Sudah Diterima</td>
                                <td width="107"></td>
                                
                              </tr>
                            </table>
                            <br>
                                                         
                              <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                                <strong>Jasa Pengiriman:</strong> <?php echo $model->carrier_delivery_name; ?>
                                <br>
                                <strong>Nomor Resi:</strong> <?php echo $model->shipping_number; ?>
                                <!-- <br>
                                <strong>Tanggal Pengiriman:</strong> 26 Juni 2018 -->
                              </div>
                              
                              <br>
                                              
                              <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                                <strong>Rincian Pesanan</strong>
                                
                              </div>
                              <table width="570" align="left" cellpadding="0" cellspacing="0" style="margin-top:15px;margin-bottom:20px;font-size: 12px;background-color: rgb(32,97,103);color: #fff;border-radius: 5px;">
                                <tr>
                                  <td width="100" style="text-align: center;padding-top: 10px;padding-bottom: 10px;border-right: 1px solid #fff;">
                                  </td>
                                  <td width="190" style="text-align: center;padding-top: 10px;padding-bottom: 10px;border: 1px solid #fff;border-top:0px;padding-left: 5px;padding-right: 5px;">Nama Barang</td>
                                  <td width="90" style="text-align: center;padding-top: 10px;padding-bottom: 10px;border: 1px solid #fff;border-top:0px;padding-left: 5px;padding-right: 5px;">Jumlah</td>
                                  <td width="190" style="text-align: center;padding-top: 10px;padding-bottom: 10px;border: 1px solid #fff;border-top:0px;border-right: 0px;padding-left: 5px;padding-right: 5px;">Harga</td>
                                  
                                </tr>
                                <?php foreach ($order_details as $order_detail) { ?>
                                <tr>
                                  <td width="100" style="text-align: center;padding-top: 10px;padding-bottom: 10px;border-right: 1px solid #fff;">
                                    <?php
                                      $product_image = \backend\models\ProductImage::find()->where(['product_id'=>$order_detail->product_id])->andWhere(['cover'=>1])->one();
                                    ?>
                                    <img src="https://thewatch.co/img/product/<?php echo $product_image->product_image_id; ?>/<?php echo $product_image->product_image_id; ?>_small.jpg" style="border-radius: 5px;">
                                  </td>
                                  <td width="190" style="text-align: left;padding-top: 10px;padding-bottom: 10px;border: 1px solid #fff;padding-left: 5px;padding-right: 5px;">
                                    <div style="padding-left: 5px;"><?php echo $order_detail->product_name; ?>  <?php echo isset($item['color']) ? $item['color'] : ''; ?></div></td>
                                  <td width="90" style="text-align: center;padding-top: 10px;padding-bottom: 10px;border: 1px solid #fff;padding-left: 5px;padding-right: 5px;"><?php echo $order_detail->product_quantity; ?></td>
                                  <td width="190" style="text-align: right;padding-top: 10px;padding-bottom: 10px;border: 1px solid #fff;border-right: 0px;padding-left: 5px;padding-right: 5px;">
                                  <div style="padding-right: 20px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($order_detail->original_product_price); ?></div></td>
                                  
                                </tr>
                                <?php } ?>

                                <tr>
                                  <td width="100" style="text-align: center;padding-top: 10px;padding-bottom: 10px;">
                                  </td>
                                  <td width="190" colspan="2" style="text-align: left;padding-top: 10px;padding-bottom: 10px;border-top: 1px solid #fff;padding-left: 5px;padding-right: 5px;">
                                    <div style="padding-left: 5px;padding-bottom: 3px;">Total Harga</div>
                                    <div style="padding-left: 5px;padding-bottom: 3px;">Ongkos Kirim</div>
                                    <div style="padding-left: 5px;padding-bottom: 3px;">Asuransi Pengiriman</div>
                                    <?php if($model->unique_code != 0) { ?>
                                    <div style="padding-left: 5px;padding-bottom: 3px;">Kode Unik</div>
                                    <?php } ?>
                                    <?php if($discount != 0) { ?>
                                    <div style="padding-left: 5px;padding-bottom: 3px;">Diskon</div>
                                    <?php } ?>
                                    <?php if($model->total_special_promo != 0) { ?>
                                      <div style="padding-left: 5px;padding-bottom: 3px;">Promo <?php echo $model->specialPromo->promo_name?></div>
                                    <?php } ?>
                                    <div style="padding-left: 5px;padding-bottom: 5px;padding-top: 8px;">Total Pembayaran</div>
                                  </td>
                                  <td width="190" style="text-align: right;padding-top: 10px;padding-bottom: 10px;border-top: 1px solid #fff;padding-left: 5px;padding-right: 5px;">
                                    <div style="padding-right: 20px;padding-bottom: 3px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($total_item); ?></div>
                                    <div style="padding-right: 20px;padding-bottom: 3px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($model->total_shipping); ?></div>
                                    <div style="padding-right: 20px;padding-bottom: 3px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($model->total_shipping_insurance); ?></div>
                                    <?php if($model->unique_code != 0) { ?>
                                    <div style="padding-right: 20px;padding-bottom: 3px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($model->unique_code); ?></div>
                                    <?php } ?>
                                    <?php if($discount != 0) { ?>
                                    <div style="padding-right: 20px;padding-bottom: 3px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($discount); ?></div>
                                    <?php } ?>
                                    <?php if($model->total_special_promo != 0) { ?>
                                      <div style="padding-left: 5px;padding-bottom: 3px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($model->total_special_promo); ?> </div>
                                    <?php } ?>
                                    <div style="padding-right: 20px;padding-bottom: 5px;padding-top: 8px;">Rp. <?php echo \common\components\Helpers::getPriceFormat($grandTotal); ?></div>
                                  </td>
                                </tr>
                              </table>
                              <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 5px;">
                                <strong>Tujuan Pengiriman:</strong> <?php echo $model->customeraddress->firstname; ?>
                                
                              </div>
                            
                              <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 5px;">
                                <?php echo $model->customeraddress->address1; ?>
                              </div>
                             
                              <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 5px;">
                                <strong>Telepon:</strong> <?php echo $model->customeraddress->phone; ?>
                              </div>
                              <br>
                           
                            <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                              
                             Pantau status pesanan anda pada halaman Status Pemesanan
                            </div>
                            <br>

                            <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                              
                              <a href="https://www.thewatch.co/user/orders" style="color: #fff;padding: 8px;background-color: rgb(32,97,103);border-radius: 50px;margin-top: 20px;text-align: center;border: 1px solid rgb(32,97,103);font-size: 14px;text-decoration: unset;padding-left: 30px;padding-right: 30px;">Cek Status</a>
                            </div>
                          </td>
                          <td width="15"></td>
                        </tr>
                                               
                        
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <!-- HTML Spacer row -->
                    <td style="font-size:0;line-height:0;" height="10">
                      <table width="96%" align="left" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="15"></td>
                          <td>
                            <div style="font-size:14px;line-height:1.3;text-align:center;font-family:Helvetica;margin-bottom: 15px;">
                              This email address cannot accept incoming email. Please do not reply to this message. If you need further assistance, please <u><b><a href="http://thewatch.co/contact">contact us.</a>
                            </div>
                            
                          </td>
                          <td width="15"></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <tr>
                    <!-- HTML Spacer row -->
                    <td style="font-size:0;line-height:0;" height="10">
                      <table width="600" align="center" cellpadding="0" cellspacing="0" style="border-top: solid 1px rgb(32,97,103);">
                        <tr>
                          <td></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
          <tr>
            <td>
              <table width="600" align="center" bgcolor="" style="">
                <tr>
                  <td>
                    <table width="300" align="left" cellpadding="0" cellspacing="0">
                      <!-- First column of footer content -->
                      <tr>
                        <td>
                          
                          <div align="left" style="font-size:12px;color:#454545;text-align:left;font-family:Helvetica;margin-top:10px;margin-left:15px;">
                            <a href="https://www.thewatch.co/about" style="text-decoration:none;color:#454545;">About</a>
                          </div>
                          <div align="left" style="font-size:12px;color:#454545;text-align:left;font-family:Helvetica;margin-left:15px;">
                            <a href="https://www.thewatch.co/store" style="text-decoration:none;color:#454545;">Store Location</a>
                          </div>
                          <div align="left" style="font-size:12px;color:#454545;text-align:left;font-family:Helvetica;margin-left:15px;">
                            <a href="https://www.thewatch.co/contact" style="text-decoration:none;color:#454545;">Contact</a>
                          </div>
                          <div align="left" style="font-size:12px;color:#454545;text-align:left;font-family:Helvetica;margin-left:15px;">
                            <a href="https://www.thewatch.co/warranty" style="text-decoration:none;color:#454545;">Warranty &amp; Service</a>
                          </div>
                          <div align="left" style="font-size:12px;color:#454545;text-align:left;font-family:Helvetica;margin-left:15px;">
                            <a href="https://www.thewatch.co/faq" style="text-decoration:none;color:#454545;">FAQ</a>
                          </div>
                          <div align="left" style="font-size:12px;color:#454545;text-align:left;font-family:Helvetica;margin-left:15px;">
                            <a href="https://www.thewatch.co/privacy" style="text-decoration:none;color:#454545;">Terms &amp; Conditions</a>
                          </div>
                          <div align="left" style="font-size:12px;color:#454545;text-align:left;font-family:Helvetica;margin-left:15px;">
                            <a href="https://www.thewatch.co/shipping-information" style="text-decoration:none;color:#454545;">Shipping Information
</a>
                          </div>
                          
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td>
                    <table width="300" cellpadding="0" cellspacing="0" align="right">
                      <tr>
                        <td>
                          <div align="right" style="font-size:12px;color:#454545;text-align:right;font-family:Helvetica;margin-top:10px;margin-right:15px;">Mon - Fri. 9AM - 5PM(+7GMT)</div>
                          <div align="right" style="font-size:12px;color:#454545;text-align:right;font-family:Helvetica;margin-right:15px;">cs@thewatch.co</div>
                          <div align="right" style="font-size:12px;color:#454545;text-align:right;font-family:Helvetica;margin-right:15px;">aftersales@thewatch.co</div>
                          <div align="right" style="font-size:12px;color:#454545;text-align:right;font-family:Helvetica;margin-right:15px;">+62 813 6800 1010</div>
                          <div align="right" style="font-size:12px;text-align:right;font-family:Helvetica;margin-top:20px;margin-right:15px;">
                            <a href="https://www.thewatch.co" style="text-decoration:none;color:#454545;font-weight:bold;">www.thewatch.co</a>
                          </div>
                        </td>
                      </tr>
                     
                    </table>
                  </td>
                </tr>
                <tr>
                    <!-- HTML Spacer row -->
                    <td style="font-size:0;line-height:0;" height="10">
                      <table width="96%" align="left" cellpadding="0" cellspacing="0">
                        <tr>
                          <td></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table width="600" align="center" bgcolor="" style="background-color: rgb(32,97,103);">
                <tr>
                  <td>
                    <table width="300" align="left" cellpadding="0" cellspacing="0">
                      <!-- First column of footer content -->
                      <tr>
                        <td>
                          
                          
                          <div align="left" style="font-size:8px;color:#ffffff;text-align:left;margin-top:10px;font-family:Helvetica;margin-bottom:10px;margin-left:15px;">Copyright © 2018 The Watch Co. All Right Reserved</div>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td>
                    <table width="300" cellpadding="0" cellspacing="0" align="right">
                      
                      <tr style="">
                        <td align="right">
                          <table width="100%" align="right" cellpadding="0" cellspacing="0">
                            <!-- First column of footer content -->
                            <tr>
                              <td width="100">
                              </td>
                              <td width="15">
                                <a href="https://www.facebook.com/TheWatchCo"><img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/607105dd-eaf5-4055-8278-2cc8143ceab1.png" alt="75e81a58-bc53-4bc2-bcea-0f6efee537ab.jpg"></a>
                              </td>
                         
                              <td width="15"><a href="https://twitter.com/thewatchco_id"><img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/afd670f8-253d-43dc-9306-20b53d5b4193.png" alt="23559e62-c3ba-4a99-811b-426f341b29c7.jpg"></a></td>
                    
                              <td width="15"><a href="https://www.instagram.com/thewatchco"><img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/6148fbf0-65bc-4ec9-9039-9b69c24946fa.png" alt="94ced8e7-8c11-4b18-b1a2-edcc573853f8.jpg"></a></td>
                            
                              <td width="15"><a href="https://www.pinterest.com/thewatchcompany"><img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/7d016628-7e00-4a46-a1e1-facc94f02123.png" alt="e9031f15-b4da-49db-bb74-19f3b8ae8ce2.jpg"></a></td>
                             
                              <td width="22"><a href="http://line.me/ti/p/%40thewatchco"><img src="https://gallery.mailchimp.com/7e02983712f248a4df84d988d/images/f888d4d6-0158-4884-ad28-f25b6ada885c.png" alt="8f4a6e12-e0cf-4353-8cc3-0f66319d8b3e.jpg"></a></td>
                            </tr>
                          </table>
                          
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </body>
</html>