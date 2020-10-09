<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css/component.css" />
<section id="shopping-bag" style="padding-top: 20px;">
    <div class="container">
    	<div class="row">
    	<?php echo Yii::$app->view->renderFile('@app/views/user/_leftmenu.php', array()); ?>
    		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
    			<?php if(count($order_detail_warranty) == 0){ ?>
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light" style="height: 200px;">
	                	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/id-card.png" style="position: absolute;left: 0;right: 0;margin: auto;">
	                   	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light" style="text-align: center;margin-top: 135px;">Belum ada kartu garansi digital yang terinput!</div>
	                </div>
	                
	            </div>
	            <?php } ?>

	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;margin-top: 20px;">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
	                	<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 gotham-light box-shadow" style="border-radius: 5px;">
	                		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile card-left" style="padding-top: 15px;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
	                				
	                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
	                					Kartu Garansi Digital
	                				</span>
	                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty">
	                					<?php echo $order_detail_warranty->warranty->warranty_number;?>
	                					
	                				</span>
	                			</div>
	                			
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 23px;">
	                				</span>
	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
	                				<?php
	                			
	                					$order = \backend\models\Orders::find()->where(['orders_id'=>$service->orders_id])->one();
				                		$store_warranty = \backend\models\Stores::find()->where(['store_id'=>$order->store_id])->one();
	                					 echo $store_warranty->store_name.' '.$store_warranty->store_slug;
	                				?>
	                				</span>
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/invoice.png" style="width: 21px;margin-left: 2px;">
	                				</span>
	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
	                					<?php echo $order_detail_warranty->orderDetail->orders->reference;?>
	                					
	                				</span>
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/watch.png" style="width: 17px;margin-left: 4px;">
	                				</span>
	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
	                					<?php echo $order_detail_warranty->orderDetail->product_name;?>
	                				</span>
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
	                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/warranty-type.png" style="width: 22px;">
	                				</span>
	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
	                					Garansi <?php echo \backend\models\WarrantyType::find()->where(['warranty_type_id'=>$order_detail_warranty->warranty->warranty_type_id])->one()->warranty_type_name;?>
	                				</span>
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearleft-mobile" style="position: absolute;bottom:0px;">
	                				<!-- <a class="blue-round" id="card-action" style="width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;font-size: 14px;">Klaim Garansi</a> -->
	                				<?php
	                				
			                                    $now = new DateTime();
												$ref = new DateTime($order_detail_warranty->warranty->warranty_expired_date);
												$diff = $now->diff($ref);
												$different = $diff->format("%r%a");

				                			?>
				                			
	                			    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/active.jpg" style="width:50%;">
	                			</div>
	                		</div>
	                		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 clearleft clearright clearleft-mobile clearright-mobile card-right" style="padding-top: 15px;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
	                				<?php
	                					$product_image = \backend\models\ProductImage::find()->where(['product_id'=>$order_detail_warranty->orderDetail->product_id])->andWhere(['cover'=>1])->one();
	                					 
	                				?>
	                				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>/img/product/<?php echo $product_image->product_image_id;?>/<?php echo $product_image->product_image_id;?>_medium.jpg" style="width: 100%;">
	                			</div>
	                			
	                			<?php if($different > 0){ ?>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium bradius5 text-warranty box-shadow-smooth" style="text-align: center;background-color: #fff;margin-top: 10px;">
	                				Sisa Waktu Garansi
	                			</div>
	                			
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile fcolor69" style="font-size: 22px;text-align: center;margin-top: 3px;">

	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
	                						<?php
	                							if($different < 0){
	                								echo '0';
	                							} else{
	                								echo str_pad($diff->y, 2, '0', STR_PAD_LEFT);
	                							}
	                							
	                						?>
	                					</div>
	                				</div>
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 1px;padding-left: 1px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
	                					
	                						<?php
	                							if($different < 0){
	                								echo '0';
	                							} else{
	                								echo str_pad($diff->m, 2, '0', STR_PAD_LEFT);
	                							}
	                							
	                						?>
	                					</div>
	                				</div>
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 2px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
	                					
	                						<?php
	                							if($different < 0){
	                								echo '0';
	                							} else{
	                								echo str_pad($diff->d, 2, '0', STR_PAD_LEFT);
	                							}
	                							
	                						?>
	                					</div>
	                				</div>
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty" style="text-align: center;margin-top: 0px;">
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth bgcolorblue fcolorfff" style="border-radius: 0 0 5px 5px;">
	                						Tahun
	                					</div>
	                				</div>
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 1px;padding-left: 1px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth bgcolorblue fcolorfff" style="border-radius: 0 0 5px 5px;">
	                						Bulan
	                					</div>
	                				</div>
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 2px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth bgcolorblue fcolorfff" style="border-radius: 0 0 5px 5px;">
	                						Hari
	                					</div>
	                				</div>
	                			</div>
	                			<?php }else{ ?>
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>warranty/icons/icon-04.jpg?auto=compress" style="width:100%;">
                                    <?php } ?>
	                		</div>
	                	
	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-bottom: 5px;">
	                				
	                				<span class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
		                				<span>Status</span>
		                				<span style="margin-left: 10px;">
		                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/form-checked.png" style="width: 20px;">
		                				</span>
	                				</span>
	                				
	                				
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;min-height: 500px;background-color: rgb(237,238,240);border-radius: 5px;font-size: 13px;">
	                				
	                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
	                				
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
			                				<span>Jenis Perbaikan</span>
			                				<span style="margin-left: 10px;">
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting.png" style="width: 20px;">
			                				</span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty">
		                				<?php
		                					$serv_i = 1;
		                					$serv_length = count($service_type_name);
		                					foreach ($service_type_name as $service_type_n) {
		                						if($serv_length == $serv_i){
		                							echo $service_type_n;
		                						}else{
		                							echo $service_type_n.', ';
		                						}
		                						

		                						$serv_i++;
		                					}
		                				?>
		                				</span>
		                				
		                			</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
	                				
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
			                				<span>Tujuan Garansi Anda</span>
			                				<span style="margin-left: 10px;">
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
			                				</span>
		                				</span>
		                						                				
		                			</div>
		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
	                				
		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Nama Store</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $store->store_name; ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Alamat Store</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($store->store_address); ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Kontak Store</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $store->store_contact_number; ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/status.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Status</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text">
		                					<?php 
		                						$service_lang = \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one();
		                						echo strip_tags($service_lang->text); 
		                					?>
		                						
		                					</span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/ticket.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Kode Service</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($service->service_code); ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text">Bukti Pengiriman</span>
		                					<?php
		                					if($service->customer_shipping_number_image != ''){
		                						?>
		                					<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text">
		                					    
    												    <a class="warranty-text" id="zoom-warranty-back" data-toggle="modal" data-target="#hidden-back" style="cursor: pointer;width: 100%;background-color: rgb(255,255,255);color:rgb(65,155,249);border-radius: 25px;padding-left: 5px;padding-right: 5px;padding-top: 1px;padding-bottom: 1px;float: right;text-align: center;">View</a>
    												    
                                                        <div class="modal fade" role="dialog" id="hidden-back">
                                                            <div class="modal-dialog warranty">
                                                                <!-- Modal content-->
                                                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                                                             Bukti Pengiriman
                                                                        </span>
                                                                    </div>
                                                                    
                                                                  </div>
                                                                  <div class="modal-body" style="height: auto;width:100%;overflow-y:scroll;padding-top:0;">
                                                                       
                                                                            <div style="border-top:solid 1px #000;width:100%;margin-top: 10px;margin-bottom: 10px;"></div>
                                                                            <img style="width:100%;" id="zoom-img-back" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/customer-resi/<?php echo $service->customer_shipping_number_image;?>" style="right: 0px;width: 50px;margin-top: 5px;">
                                                                        	
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>
    										
		                					</span>
		                					<?php } ?>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile"></span>
		                				</span>
		                				
		                				<?php
		                					if($service->customer_shipping_number_image != ''){
		                						?>
		                						<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height: 181px;background-color: #fff;border-radius: 5px;margin-top: 8px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/customer-resi/<?php echo $service->customer_shipping_number_image;?>');background-size: cover;">
		                					        
		                						</span>
		                						<?php
		                					}else{
		                						?>
		                						<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height: 181px;background-color: #fff;border-radius: 5px;margin-top: 8px;">
		                					
		                						</span>
		                						<?php
		                					}
		                					?>
		                				
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/cost.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Biaya Service</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium warranty-details-purpose-text">Rp. <?php echo common\components\Helpers::getPriceFormat($service->service_fee + $service->service_fee_unique_code); ?></span>
		                					
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
		                				
		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Keterangan Perbaikan</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($service->sc_notes); ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
		                			</div>
	                				<?php if($service->sc_drop_store_id != 0){?>
		                			<?php

		                				$drop_store = \backend\models\Stores::find()->where(['store_id'=>$service->sc_drop_store_id])->one();
		                			?>
		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
	                				
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
			                				<span>Lokasi Pengambilan Produk Anda</span>
			                				<span style="margin-left: 10px;">
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
			                				</span>
		                				</span>
		                						                				
		                			</div>
	                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
	                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Nama Store</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $drop_store->store_name; ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Alamat Store</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($drop_store->store_address); ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
	                				</div>
	                				<?php }else{ ?>
	                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
	                				
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
			                				<span>Alamat Pengembalian Produk Anda</span>
			                				<span style="margin-left: 10px;">
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
			                				</span>
		                				</span>
		                						                				
		                			</div>
	                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
	                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Nama</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $service->sc_drop_name; ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Alamat</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($service->sc_drop_address).', '.$service->sc_drop_kelurahan.', '.$service->district->name.', '.$service->province->name; ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
	                				</div>
	                				<?php } ?>
	                				<?php if($service->sc_shipping_carrier != ''){?>
		                			<?php

		                				
		                			?>
		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
	                				
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
			                				<span>Tracking Pengembalian Produk</span>
			                				<span style="margin-left: 10px;">
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
			                				</span>
		                				</span>
		                						                				
		                			</div>
	                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
	                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Nama Shipping</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $service->sc_shipping_carrier; ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>

		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
			                				<span>
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/ticket.png" style="width: 20px;">
			                				</span>		                				
		                				</span>
		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Nomor Tracking</span>
		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($service->sc_tracking_number); ?></span>
		                				</span>
		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
	                				</div>
	                				<?php } ?>
	                			</div>
	                		</div>
	                		<div id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 18px;">
	                			<?php if($service_lang->template == 'awaiting_payment'){ ?>
	                			    <?php $service_confirmation = \backend\models\ServiceConfirmation::find()->where(['service_id'=>$service->service_id])->one(); ?>
		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light  text3-warranty" style="height:20px;">
		                			    <a class="blue-round" href="<?php echo \yii\helpers\Url::base(); ?>/warranty/payment/<?php echo $service->service_id; ?>" style="padding-top:5px;padding-bottom:5px;float:right;font-size:12px;"><?php if($service_confirmation == null){ echo 'Bayar';}else{ echo 'Bukti Bayar';}?></a>
		                			    <a class="yellow-round" href="<?php echo \yii\helpers\Url::base(); ?>/warranty/card" style="padding-top:5px;padding-bottom:5px;float:right;margin-right:10px;font-size:12px;">Kembali</a>
		                			    
		                			</div>
		                		<?php }else{ ?>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light  text3-warranty" style="height:20px;">
	                				<a class="blue-round text3-warranty" href="<?php echo \yii\helpers\Url::base(); ?>/warranty/card" style="width:30%;position:absolute;right:0;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;">Kembali</a>
	                				
	                			</div>
	                			<?php } ?>
	                			
	                		</div>
             				<div id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 18px;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
	                				<hr style="margin-top: 0;border-top-color: rgb(69,69,69);">
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="padding-top: 10px;">
	                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
			                				<span class="text2-warranty">Catatan Khusus</span>
			                				<span style="margin-left: 10px;">
			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
			                				</span>
		                				</span>
		                				
	                				
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="padding-top: 10px;">
	                				
Selain mengirimkan Produk ke Store, perbaikan produk juga dapat dilakukan dengan langsung mengunjungi store terdekat dengan lokasi anda.
	                			
	                			</div>
	                			<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
	                		</div>
	                	</div>
	                   
	                </div>
	                
	            </div>
	     	
	            <div class="hidden-lg col-md-12 col-sm-12 hidden-xs" style="padding-top:90px;"></div>
            </div>
            
        </div>
    </div>
</section>
<?php
    echo Yii::$app->view->renderFile('@app/views/warranty/modal.php');
?>

<style type="text/css">
	.fsize11{
		font-size: 11px;
	}
	.fsize13{
		font-size: 13px;
	}
	.warranty-detail-purpose-group{
		padding-left: 8px;
	}

	 .space-padding{
	 	padding-top: 15px;
	 }
	.card-left{
		width: 62% !important;
		min-height: 331px;
	}
	.card-right{
		width: 38% !important;
	}
	.bgcolorgray{
		background-color: rgb(193,185,179);
	}
	.select2-container .select2-selection--single {
	    height: 35px !important;
	    border-radius: 25px;
	    background-color: #1d6068;
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered{
		line-height: 33px;
		padding-left: 15px;

	}
	.select2-container--default .select2-selection--single .select2-selection__placeholder{
		color: #fff;
	}
	.select2-container--default .select2-selection--multiple {
	    /*background-color: #1d6068;*/
	    border-radius: 25px;
	}
	.inputfile + label {
	    color: rgb(69,69,69);
	}
	.inputfile + label {
	    max-width: 100%;
    	width: 100%;
	    font-size: 1.25rem;
	    font-weight: 700;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    cursor: pointer;
	    display: inline-block;
	    overflow: hidden;
	    padding: 0; 
	}
	.close {
	    float: right;
	    font-size: 21px;
	    font-weight: 700;
	    line-height: 1;
	    color: #000;
	    text-shadow: 0 1px 0 #fff;
	    filter: alpha(opacity=20);
	    opacity: 1;
	}
	p {
	    font-size: 11px;
	    line-height: 1.2;
	}
	
	@media only screen and (max-width : 768px) {
        a.blue-round {
            float: right;
            border: 1px solid #1d6068;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 12px;
            padding-right: 12px;
            letter-spacing: 1.5px;
            /*font-size: 11px;*/
            background: #1d6068;
            color: #fff;
            /* width: 10%; */
        }
    }
</style>


<style>
.drop-service {
    background-color: #fff;
    color: rgb(69,69,69);
    padding-top: 7px;
    padding-bottom: 7px;
    font-size: 12px;
    font-family: gotham-light;
    border: none;
    cursor: pointer;
    padding-left: 15px;
    border-radius: 25px;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 0 0 15px 15px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd}

.show {display:block;}
</style>
<style>

.control {
display: block;
position: relative;
padding-left: 27px;
padding-top: 3px;
margin-bottom: 8px;
cursor: pointer;
font-size: 11px;
}
.control input {
position: absolute;
z-index: -1;
opacity: 0;
}
.control__indicator {
position: absolute;
top: 2px;
left: 10px;
height: 15px;
width: 15px;
background: #e6e6e6;
}
.control--radio .control__indicator {
border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
background: #fff;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control input:checked ~ .control__indicator {
background: #fff;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
background: #fff;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control input:disabled ~ .control__indicator {
background: #fff;
opacity: 0.6;
pointer-events: none;
border: solid 1px rgb(158,131,97);
border-radius: 4px;
}
.control__indicator:after {
content: '';
position: absolute;
display: none;
}
.control input:checked ~ .control__indicator:after {
display: block;
}
.control--checkbox .control__indicator:after {
left: 5px;
top: 2px;
width: 4px;
height: 8px;
border: solid rgb(158,131,97);
border-width: 0 2px 2px 0;
transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
border-color: rgb(158,131,97);
}


</style>