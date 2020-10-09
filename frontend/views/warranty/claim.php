<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css/component.css" />
<!-- initial page , dont remove -->
<div id="warranty-card-claim"></div>
<section id="shopping-bag" style="padding-top: 20px;">
    <div class="container">
    	<div class="row">
    	<?php echo Yii::$app->view->renderFile('@app/views/user/_leftmenu.php', array()); ?>
    		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
    			<?php if(count($order_detail_warrantys) == 0){ ?>
	            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light" style="height: 200px;">
	                	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/id-card.png" style="position: absolute;left: 0;right: 0;margin: auto;">
	                   	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light title-warranty" style="text-align: center;margin-top: 135px;">Belum ada kartu garansi digital yang terinput!</div>
	                </div>
	                
	            </div>
	            <?php } ?>
	     
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;">
	                <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light bgcolorblue" style="padding: 11px 10px 11px 20px;border-radius: 25px;">
	                		<div class="col-xs-10 clearright-mobile clearleft-mobile title-warranty" style="color: #fff;letter-spacing: 0.2px;">Cara Input Kartu Garansi Digital</div> <span class="col-xs-2 clearright clearright-mobile"><a data-toggle="modal" data-target="#how-to-input" class="modal-blur"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/info.png" id="cara-claim" style="width: 20px;position: absolute;right: 0;"></a></span>
	                	</div>
	                   
	                </div>
	                
	            </div>
	            <?php foreach($order_detail_warrantys as $order_detail_warranty){ ?>
	            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;margin-top: 20px;">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light box-shadow" style="border-radius: 5px;">
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
	                				  
				                				    $order = \backend\models\Orders::find()->where(['orders_id'=>$order_detail_warranty->orderDetail->orders_id])->one();
				                					$store = \backend\models\Stores::find()->where(['store_id'=>$order->store_id])->one();
				                					 echo $store->store_name.' '.$store->store_slug;
				                					 
				                				
		
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
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearleft-mobile warranty-stat" style="padding-top:10px;bottom:0;">
	                			    <?php
	                				
			                                    $now = new DateTime();
												$ref = new DateTime($order_detail_warranty->warranty->warranty_expired_date);
												$diff = $now->diff($ref);
												$different = $diff->format("%r%a");

				                			?>
				                			
	                			   
	                			    
	                			    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/active.jpg" style="width:50%;">
	                				<!-- <a class="blue-round" id="card-action" style="width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;font-size: 14px;">Klaim Garansi</a> -->
	                			
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
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="font-size: 12px;text-align: center;margin-top: 0px;">
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
	                						Tahun
	                					</div>
	                				</div>
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 1px;padding-left: 1px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
	                						Bulan
	                					</div>
	                				</div>
	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 2px;">
	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
	                						Hari
	                					</div>
	                				</div>
	                			</div>
	                			<?php }else{ ?>
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>warranty/icons/icon-04.jpg?auto=compress" style="width:100%;">
                                    <?php } ?>
	                		</div>
	                		<?php
	                           // check total image in database, $image_total = 1 is full image, $image_total = 0 is no image
	                		    $image_total = 0;
	                		    if($service_image != null){
	                		        if($service_image->service_image_front_view != '0' && $service_image->service_image_right_view != '0' && $service_image->service_image_left_view != '0' && $service_image->service_image_top_view != '0' && $service_image->service_image_bottom_view != '0' && $service_image->service_image_back_view != '0'){
	                		            $image_total = 1;
	                		        }
	                		    }
	                		?>
	                		<form name="warranty-save" id="warranty_save" enctype="multipart/form-data" action="<?php echo \yii\helpers\Url::base(); ?>/warranty/save" method="post">
	                		<input type="" name="service_id" id="service-id" value="<?php echo $service->service_id; ?>" style="display: none;">
	                		<input type="" name="service_detail_id" id="service-detail-id" value="<?php echo $service_detail->service_detail_id; ?>" style="display: none;">
	              
	                		<input type="" name="warranty_id" id="warranty-id" value="<?php echo $_GET['id']; ?>" style="display: none;">
	                		<input type="" name="order_id" id="order-id" value="<?php echo $order_id; ?>" style="display: none;">
	                		<span id="no_1" style="display:none;"><?php echo ($service_detail->service_type_store_id != 0 ? '1' : '0');?></span>
	                		<span id="no_2" style="display:none;"><?php echo ($image_total == 1 ? '1' : '0');?></span>
	                		<span id="no_3" style="display:none;"><?php echo ($service->sender_name != '' ? '1' : '0');?></span>
	                		<span id="no_4" style="display:none;"><?php echo ($service->sc_drop_store_id != 0 || $service->sc_drop_address != '' ? '1' : '0');?></span>
	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5 bgcolorgrey" style="margin-top: 15px;">
	                			<div id="warranty-type-service-title" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:15px;">
	                				
	                				<span class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
		                				<span>1. Pilih Jenis Perbaikan</span>
		                				<span style="margin-left: 10px;">
		                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting.png" style="width: 20px;">
		                				</span>
	                				</span>
	                				
	                				<span class="col-xs-3 clearright clearright-mobile">
	                				    
	                					<a class="text3-warranty" id="change-service" style="<?php if($service_detail->service_type_store_id != 0){ echo 'display:block;'; }else{ echo 'display:none;'; }?>background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center;cursor: pointer;">Ubah</a>
	                	              
	                				</span>
	                				<span id="error-type" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty" style="color: red;display: none;">
		                				Jenis perbaikan belum dipilih
	                				</span>
	                			</div>
	                			
	                			                <?php
        		                					$serv_i = 1;
        		                					$count_serv = 0;
        		                					$text_other = 0;
        		                					$text_other_value = '';
        		                					$service_collection = '';
        		                					$serv_length = count($service_type);
        		                					foreach ($service_type as $service_ty) {
        		                						if($service_ty[checked] == 1){
        		                							if($serv_length == $serv_i){
        			                							
        			                							if($service_ty[text] == 'Lainnya'){
        			                							    $service_collection = $service_collection.'<span style="font-size:10px;font-weight:bold;">Lainnya:</span><br>'.$service_ty[other];
        			                							    $text_other_value = $service_ty[other];
        			                							    $text_other = 1;
        			                							}else{
        			                							    $service_collection = $service_collection.$serv_i.'. '.$service_ty[text];
        			                							}
        			                						}else{
        			                						    if($service_ty[text] == 'Lainnya'){
        			                							    $service_collection = $service_collection.'<span style="font-size:10px;font-weight:bold;">Lainnya:</span><br>'.$service_ty[other].'<br>';
        			                							    $text_other_value = $service_ty[other];
        			                							    $text_other = 1;
        			                							}else{
        			                							    $service_collection = $service_collection.$serv_i.'. '.$service_ty[text].'<br>';
        			                							}
        			                						
        			                						}
        
        													$serv_i++;
        													$count_serv ++ ;
        												}
        		                					}
        		                					if($count_serv == 0){
        												$service_collection = 'Jenis Perbaikan';
        											}
        		                				?>
        		                				
	                			<div id="warranty-type-service" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;<?php if($service_detail->service_type_store_id != 0){ echo 'display:none;'; }else{ echo 'display:block;';}?>">
	                				
	                				<!-- <select class="warranty-select-service" multiple="multiple"></select> -->
	                				
										<a id="dropbtn" class="drop-service col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile title-warranty gotham-light <?php if($service_detail->service_type_store_id != 0){ echo 'bgcolorwhite'; }else{ echo 'bgcolorblue fcolorfff';}?>" style="z-index: 99;<?php if($service_detail->service_type_store_id != 0){ echo 'pointer-events:none;'; }?>">
										    <span id="service-name-display">
										        <?php echo $service_collection; ?>
										    </span>
										    <span id="service-name-none" style="display:none;">
										        Jenis Perbaikan
										    </span>
										

										
										<img id="icon-drop-service-white" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-arrow-white.png" style="z-index:99;width:20px;position: absolute;right: 10px;top:7px;<?php if($service_detail->service_type_store_id != 0){ echo 'display:none;'; }?>">
										<img id="icon-drop-service-black" class="rotated" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-arrow-black.png" style="z-index:99;width:20px;position: absolute;top:7px;right: 10px;display:none;">
										</a>
										<span id="icon-drop-service-after" style="<?php if($service_detail->service_type_store_id == 0){ echo 'display:none;'; }?>">
										    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;position: absolute;right: 42px;top: 19px;z-index:99;">
										    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/service_centre.png" style="width: 20px;position: absolute;right: 16px;top: 17px;z-index:99;">
										</span>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
										  <div id="dropdown-service" class="dropdown-content col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: none;z-index: 98;">
										  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-top: solid 1px rgb(69,69,69);"></div><br>
										  	<div style="height:300px;overflow-y: scroll;margin-top:-15px;">
											   <?php 
											   	foreach ($service_type as $service_ty) {
											   	?>
												   	<div class="checkbox-btn agreement-checkbox ipad col-xs-12 clearright clearright-mobile" style="padding-top: 5px;">
						                                <input type="checkbox" id="<?php echo $service_ty[text];?>" name="service_type" value="<?php echo $service_ty[id];?>" <?php if($service_ty[checked]==1){ echo 'checked="checked"'; } ?>>
						                                
						                                <label for="<?php echo $service_ty[text];?>" id="<?php echo $service_ty[text];?>" class="black-style gotham-light" style="font-size: 12px;color:rgb(69,69,69);padding-left: 18px;padding-top: 2px;width: 100%;" onclick=""><?php echo $service_ty[text];?>
						                                	<?php
						                                		if($service_ty[type] == 2){
						                                			?>
						                                			<span style="float: right;">
						                                				<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/service_centre.png" style="width: 20px;">
						                                			</span>
						                                			
						                                			<?php
						                                		}else{
						                                			?>
						                                			<span style="float: right;">
						                                				<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/service_centre.png" style="width: 20px;">
						                                			</span>
						                                			<?php
						                                		}
						                                	?>
						                                </label>
						                        	</div>
											   	<?php
											   	}

											   ?>
											        

										    </div>
                                            <div class="checkbox-btn agreement-checkbox ipad col-xs-12" id="textarea-other-text" style="padding-top: 5px;<?php if($text_other == 1){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
						                                
						                                <textarea name="other-text" id="other-text" style="width:100%;height:94px;border-radius:5px;" autofocus><?php echo $text_other_value; ?></textarea>
						                                
						                        	</div>
										    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-top: solid 1px rgb(69,69,69);"></div>
				                  			<a class="blue-round title-warranty" id="choose-service" style="width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;margin-top: 15px;margin-bottom: 15px;">Input</a>	
										  </div>
										</div> 
										  <a class="blue-round title-warranty" id="choose-service-save" style="width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;margin-top: 15px;display:none;">Simpan</a>
										 
	                			</div>
	                			<div id="catatan-umum" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;<?php if($service_detail->service_type_store_id != 0 > 0){ echo 'display:none;'; }else{ echo 'display:block;';}?>">
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                				
    	                				<span class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
    		                				<span>Catatan</span>
    		                				<span style="margin-left: 10px;">
    		                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition.png" style="width: 20px;">
    		                				</span>
    	                				</span>
    
    	                					                				
    	                			</div>
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;font-size: 13px;">
    	                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
    	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/service_centre.png" style="width: 20px;">
    	                				</span>
    	                				<span class="col-lg-11 col-md-11 col-sm-11 col-xs-11 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty">
    		                				Perbaikan di Service Centre
    	                				</span>
    	                				
    	                				
    	                			</div>
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text2-warranty" style="padding-top: 10px;">
    	                				Service Centre dapat menerima seluruh jenis perbaikan dengan estimasi waktu kurang lebih 3 minggu
    	                				
    	                				
    	                			</div>
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text2-warranty" style="padding-top: 10px;">
    	                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
    	                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
    	                				</span>
    	                				<span class="col-lg-11 col-md-11 col-sm-11 col-xs-11 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
    		                				Perbaikan di Store
    	                				</span>
    	                				
    	                				
    	                			</div>
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text2-warranty" style="padding-top: 10px;">
    	                				Store hanya dapat melakukan 3 jenis perbaikan yaitu:<br>
    									1.  Penggantian strap<br>
    									2. Penggantian baterai<br>
    									3. Perpendek rantai<br>
    	                				
    	                				
    	                			</div>
    	                			
    	                		</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;"></div>
	                		</div>

	                		<div id="warranty-photo-upload-title" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5 bgcolorgrey" style="margin-top: 15px;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:15px;">
	                				<span class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
		                				<span>2. Foto Kondisi Produk</span>
		                				<span style="margin-left: 10px;">
		                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/camera.png" style="width: 20px;">
		                				</span>
	                				</span>
	                				<span class="col-xs-1 clearright clearright-mobile">
	                				  
	                					
	                				</span>
	                				<span class="col-xs-3 clearright clearright-mobile">
	                				    <a data-toggle="modal" data-target="#how-to-upload" id="how-upload-info" class="modal-blur" style="<?php if($image_total == 0 && $count_serv > 0){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">
	                						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/info-green.png" style="cursor: pointer;position: absolute;right: 0px;width: 20px;">
	                					</a>
	                					<a class="text3-warranty" id="change-upload" style="<?php if($image_total == 1){ echo 'display:block;'; }else{ echo 'display:none;'; }?>cursor: pointer;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center;">Ubah</a>
	                					
	                				</span>
	                				
	                				<span id="error-1mb" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty" style="color: red;display: none;">
		                				Ukuran foto melebihi 2 MB
	                				</span>
	                				<span id="error-format" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty" style="color: red;display: none;">
		                				Format jenis foto harus JPEG atau PNG
	                				</span>
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="warranty-photo-upload" style="<?php if($image_total == 0 && $count_serv > 0){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;text-align: center;">
    	                		
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 11px;">
    	                				    <input style="display:none;" name="img-front-hide" id="img-front-hide" value="<?php echo $service_image->service_image_front_view; ?>">
    	                				    <input style="display:none;" name="img-right-hide" id="img-right-hide" value="<?php echo $service_image->service_image_right_view; ?>">
    	                				    <input style="display:none;" name="img-left-hide" id="img-left-hide" value="<?php echo $service_image->service_image_left_view; ?>">
    	                				    <input style="display:none;" name="img-top-hide" id="img-top-hide" value="<?php echo $service_image->service_image_top_view; ?>">
    	                					<input style="display:none;" name="img-bottom-hide" id="img-bottom-hide" value="<?php echo $service_image->service_image_bottom_view; ?>">
    	                			        <input style="display:none;" name="img-back-hide" id="img-back-hide" value="<?php echo $service_image->service_image_back_view; ?>">
    	                			        
    	                			        <span id="count-img-front" style="display:none;"></span>
    	                			        <span id="count-img-right" style="display:none;"></span>
    	                			        <span id="count-img-left" style="display:none;"></span>
    	                			        <span id="count-img-top" style="display:none;"></span>
    	                			        <span id="count-img-bottom" style="display:none;"></span>
    	                			        <span id="count-img-back" style="display:none;"></span>
    	                			            
    	                			            
    												<input style="display: none;" type="file" name="file-1" id="file-1" class="inputfile inputfile-4" accept="image/*" data-multiple-caption="{count} files selected" />
                                                   
    												<label for="file-1">
    													<div id="image-plus-warranty-front" style="position:absolute;width:100%;height:100%;z-index:1;top:0;">
    												        <img id="plus-warranty-front" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/add-white-32.png" style="display:none;padding-top:25px;margin-left:-10px;">
    												    </div>
    												  
    														<?php 
    														if($service_image != null){
    															if($service_image->service_image_front_view == '0'){
    																?>
    																<div id="img-front" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-front" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/front.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																
    																<?php
    															}elseif($service_image->service_image_front_view != '0'){
    																?>
    																
    																<div id="img-front" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_front_view; ?>');background-size: cover;">
    																</div>
    															
    																<?php
    															}
    														}else{
    																?>
    																<div id="img-front" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-front" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/front.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																<?php
    															}
    														?>
    														
    													
    													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top: 10px;">
    													    <div id="tampak-depan">Tampak Depan</div>
    														<span id="tampak-depan" class="span-front"></span>
    														
    													</div>
    												</label>
    										         <?php 
    														//if($service_image != null){
    											    ?>
    												<div id="image-zoom-warranty-front" style="position:absolute;width:100%;height:100%;z-index:1;top:0;<?php if($image_total == 1){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
    												    <a id="zoom-warranty-front" data-toggle="modal" data-target="#hidden-front" style="cursor:pointer;top: 25%;position: absolute;left: 0;width: 100%;display:none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/search-mobile-white.png" style="width:30px;"></a>
    												    
    												</div>
    												<div class="modal fade" role="dialog" id="hidden-front">
                                                            
                                                            <div class="modal-dialog warranty">
                        
                                                                <!-- Modal content-->
                                                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                                                             Tampak Depan
                                                                        </span>
                                                                    </div>
                                                                    
                                                                  </div>
                                                                  <div class="modal-body" style="height: auto;width:100%;overflow-y:scroll;padding-top:0;">
                                                                       
                                                                            <div style="border-top:solid 1px #000;width:100%;margin-top: 10px;margin-bottom: 10px;"></div>
                                                                            <?php if($service_image != null){ ?>
                                                                                <?php if($service_image->service_image_front_view != 0){ ?>
                                                                                    <img style="width:100%;" id="zoom-img-front" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_front_view; ?>" style="right: 0px;width: 50px;margin-top: 5px;">    
                                                                                <?php }else{ ?>
                                                                                    <img style="width:100%;" id="zoom-img-front" src="" style="right: 0px;width: 50px;margin-top: 5px;">  
                                                                                <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <img style="width:100%;" id="zoom-img-front" src="" style="right: 0px;width: 50px;margin-top: 5px;">        
                                                                            <?php } ?>
                                                                            
                                                                        	<div style="width:100%;">
                                                                        	    <label for="file-1" style="width:100%;">
                                                                        	        <a style="width:100px;float:right;padding-top: 5px;padding-bottom: 5px;text-align: center;margin-top: 17px;" class="blue-round">Edit</a>
                                                                        	    </label>
                                                                        	</div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                            
                                                        </div>
    												<?php //} ?>
    	                					
    	                					
    	                				</div>
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 3.5px;padding-right: 3.5px;">
    	                					<input style="display: none;" type="file" name="file-2" id="file-2" class="inputfile inputfile-4" accept="image/*" data-multiple-caption="{count} files selected" />
                                                
    												<label for="file-2">
    										            <div id="image-plus-warranty-right" style="position:absolute;width:100%;height:100%;z-index:1;top:0;">
    												        <img id="plus-warranty-right" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/add-white-32.png" style="display:none;padding-top:25px;margin-left:-10px;">
    												    </div>
    														<?php 
    														if($service_image != null){
    															if($service_image->service_image_right_view == '0'){
    																?>
    																<div id="img-right" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-right" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/right.png" style="right: 0px;width: 55px;margin-top: 10px;">
    																</div>
    																
    																<?php
    															}elseif($service_image->service_image_right_view != '0'){
    																?>
    																<div id="img-right" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_right_view; ?>');background-size: cover;">
    																</div>
    																
    																<?php
    															}
    														}else{
    																?>
    																<div id="img-right" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-right" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/right.png" style="right: 0px;width: 55px;margin-top: 10px;">
    																</div>
    																<?php
    															}
    														?>
    														
    													
    													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top: 10px;">
    													    <div id="tampak-kanan">Tampak Kanan</div>
    														<span id="tampak-kanan" class="span-right"></span>
    													
    													</div>
    													
    												</label>
    											
    												<div id="image-zoom-warranty-right" style="position:absolute;width:100%;height:100%;z-index:1;top:0;<?php if($image_total == 1){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
    												    <a id="zoom-warranty-right" data-toggle="modal" data-target="#hidden-right" style="cursor:pointer;top: 25%;position: absolute;left: 0;width: 100%;display:none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/search-mobile-white.png" style="width:30px;"></a>
    												    
    												</div>
    												<div class="modal fade" role="dialog" id="hidden-right">
                                                            
                                                            <div class="modal-dialog warranty">
                        
                                                                <!-- Modal content-->
                                                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                                                             Tampak Kanan
                                                                        </span>
                                                                    </div>
                                                                    
                                                                  </div>
                                                                  <div class="modal-body" style="height: auto;width:100%;overflow-y:scroll;padding-top:0;">
                                                                       
                                                                            <div style="border-top:solid 1px #000;width:100%;margin-top: 10px;margin-bottom: 10px;"></div>
                                                                            <?php if($service_image != null){ ?>
                                                                                <?php if($service_image->service_image_right_view != 0){ ?>
                                                                                    <img style="width:100%;" id="zoom-img-right" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_right_view; ?>" style="right: 0px;width: 50px;margin-top: 5px;">    
                                                                                <?php }else{ ?>
                                                                                    <img style="width:100%;" id="zoom-img-right" src="" style="right: 0px;width: 50px;margin-top: 5px;">  
                                                                                <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <img style="width:100%;" id="zoom-img-right" src="" style="right: 0px;width: 50px;margin-top: 5px;">        
                                                                            <?php } ?>
                                                                        	<div style="width:100%;">
                                                                        	    <label for="file-2" style="width:100%;">
                                                                        	        <a style="width:100px;float:right;padding-top: 5px;padding-bottom: 5px;text-align: center;margin-top: 17px;" class="blue-round">Edit</a>
                                                                        	    </label>
                                                                        	</div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                            
                                                        </div>
    											
    	                				</div>
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 11px;">
    	                					<input style="display: none;" type="file" name="file-3" id="file-3" class="inputfile inputfile-4" accept="image/*" data-multiple-caption="{count} files selected" />
                                                
    												<label for="file-3">
    													<div id="image-plus-warranty-left" style="position:absolute;width:100%;height:100%;z-index:1;top:0;">
    												        <img id="plus-warranty-left" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/add-white-32.png" style="display:none;padding-top:25px;margin-left:-10px;">
    												    </div>
    														<?php 
    														if($service_image != null){
    															if($service_image->service_image_left_view == '0'){
    																?>
    																<div id="img-left" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-left" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/left.png" style="right: 0px;width: 55px;margin-top: 10px;">
    																</div>
    																
    																<?php
    															}elseif($service_image->service_image_left_view != '0'){
    																?>
    																<div id="img-left" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_left_view; ?>');background-size: cover;">
    																</div>
    																
    																<?php
    															}
    														}else{
    																?>
    																<div id="img-left" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-left" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/left.png" style="right: 0px;width: 55px;margin-top: 10px;">
    																</div>
    																<?php
    															}
    														?>
    														
    													
    													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top: 10px;">
    													
    														<div id="tampak-kiri">Tampak Kiri</div>
    														<span id="tampak-kiri" class="span-left"></span>
    													</div>
    												</label>
    												
    												<div id="image-zoom-warranty-left" style="position:absolute;width:100%;height:100%;z-index:1;top:0;<?php if($image_total == 1){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
    												    <a id="zoom-warranty-left" data-toggle="modal" data-target="#hidden-left" style="cursor:pointer;top: 25%;position: absolute;left: 0;width: 100%;display:none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/search-mobile-white.png" style="width:30px;"></a>
    												    
    												</div>
    												<div class="modal fade" role="dialog" id="hidden-left">
                                                            
                                                            <div class="modal-dialog warranty">
                        
                                                                <!-- Modal content-->
                                                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                                                             Tampak Kiri
                                                                        </span>
                                                                    </div>
                                                                    
                                                                  </div>
                                                                  <div class="modal-body" style="height: auto;width:100%;overflow-y:scroll;padding-top:0;">
                                                                       
                                                                            <div style="border-top:solid 1px #000;width:100%;margin-top: 10px;margin-bottom: 10px;"></div>
                                                                            <?php if($service_image != null){ ?>
                                                                                <?php if($service_image->service_image_left_view != 0){ ?>
                                                                                    <img style="width:100%;" id="zoom-img-left" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_left_view; ?>" style="right: 0px;width: 50px;margin-top: 5px;">    
                                                                                <?php }else{ ?>
                                                                                    <img style="width:100%;" id="zoom-img-left" src="" style="right: 0px;width: 50px;margin-top: 5px;">  
                                                                                <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <img style="width:100%;" id="zoom-img-left" src="" style="right: 0px;width: 50px;margin-top: 5px;">        
                                                                            <?php } ?>
                                                                        	<div style="width:100%;">
                                                                        	    <label for="file-3" style="width:100%;">
                                                                        	        <a style="width:100px;float:right;padding-top: 5px;padding-bottom: 5px;text-align: center;margin-top: 17px;" class="blue-round">Edit</a>
                                                                        	    </label>
                                                                        	</div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                            
                                                        </div>
    											
    	                				</div>
    	                			</div>
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;text-align: center;">
    	                				
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 11px;">
    	                					<input style="display: none;" type="file" name="file-4" id="file-4" class="inputfile inputfile-4" accept="image/*" data-multiple-caption="{count} files selected" />
                                                
    												<label for="file-4">
    													<div id="image-plus-warranty-top" style="position:absolute;width:100%;height:100%;z-index:1;top:0;">
    												        <img id="plus-warranty-top" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/add-white-32.png" style="display:none;padding-top:25px;margin-left:-10px;">
    												    </div>
    														
    														<?php 
    														if($service_image != null){
    															if($service_image->service_image_top_view == '0'){
    																?>
    																<div id="img-top" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-top" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/top.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																<?php
    															}elseif($service_image->service_image_top_view != '0'){
    																?>
    																<div id="img-top" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_top_view; ?>');background-size: cover;">
    																</div>
    																
    																<?php
    															}
    														}else{
    																?>
    																<div id="img-top" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-top" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/top.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																<?php
    															}
    														?>
    														
    													
    													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top: 10px;">
    													
    														<div id="tampak-atas">Tampak Atas</div>
    														<span id="tampak-atas" class="span-top"></span>
    													</div>
    												</label>
    											
    												<div id="image-zoom-warranty-top" style="position:absolute;width:100%;height:100%;z-index:1;top:0;<?php if($image_total == 1){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
    												    <a id="zoom-warranty-top" data-toggle="modal" data-target="#hidden-top" style="cursor:pointer;top: 25%;position: absolute;left: 0;width: 100%;display:none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/search-mobile-white.png" style="width:30px;"></a>
    												    
    												</div>
    												<div class="modal fade" role="dialog" id="hidden-top">
                                                            <div class="modal-dialog warranty">
                                                                <!-- Modal content-->
                                                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                                                             Tampak Atas
                                                                        </span>
                                                                    </div>
                                                                    
                                                                  </div>
                                                                  <div class="modal-body" style="height: auto;width:100%;overflow-y:scroll;padding-top:0;">
                                                                       
                                                                            <div style="border-top:solid 1px #000;width:100%;margin-top: 10px;margin-bottom: 10px;"></div>
                                                                            <?php if($service_image != null){ ?>
                                                                                <?php if($service_image->service_image_top_view != 0){ ?>
                                                                                    <img style="width:100%;" id="zoom-img-top" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_top_view; ?>" style="right: 0px;width: 50px;margin-top: 5px;">    
                                                                                <?php }else{ ?>
                                                                                    <img style="width:100%;" id="zoom-img-top" src="" style="right: 0px;width: 50px;margin-top: 5px;">  
                                                                                <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <img style="width:100%;" id="zoom-img-top" src="" style="right: 0px;width: 50px;margin-top: 5px;">        
                                                                            <?php } ?>
                                                                        	<div style="width:100%;">
                                                                        	    <label for="file-4" style="width:100%;">
                                                                        	        <a style="width:100px;float:right;padding-top: 5px;padding-bottom: 5px;text-align: center;margin-top: 17px;" class="blue-round">Edit</a>
                                                                        	    </label>
                                                                        	   
                                                                        	</div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>
    											
    	                				</div>
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 3.5px;padding-right: 3.5px;">
    	                					<input style="display: none;" type="file" name="file-5" id="file-5" class="inputfile inputfile-4" accept="image/*" data-multiple-caption="{count} files selected" />
                                                
    												<label for="file-5">
    													<div id="image-plus-warranty-bottom" style="position:absolute;width:100%;height:100%;z-index:1;top:0;">
    												        <img id="plus-warranty-bottom" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/add-white-32.png" style="display:none;padding-top:25px;margin-left:-10px;">
    												    </div>
    														<?php 
    														if($service_image != null){
    															if($service_image->service_image_bottom_view == '0'){
    																?>
    																<div id="img-bottom" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-bottom" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/bottom.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																
    																<?php
    															}elseif($service_image->service_image_bottom_view != '0'){
    																?>
    																<div id="img-bottom" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_bottom_view; ?>');background-size: cover;">
    																</div>
    																
    																<?php
    															}
    														}else{
    																?>
    																<div id="img-bottom" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-bottom" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/bottom.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																<?php
    															}
    														?>
    														
    													
    													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top: 10px;">
    													
    														<div id="tampak-bawah">Tampak Bawah</div>
    														<span id="tampak-bawah" class="span-bottom"></span>
    													</div>
    												</label>
    											
    												<div id="image-zoom-warranty-bottom" style="position:absolute;width:100%;height:100%;z-index:1;top:0;<?php if($image_total == 1){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
    												    <a id="zoom-warranty-bottom" data-toggle="modal" data-target="#hidden-bottom" style="cursor:pointer;top: 25%;position: absolute;left: 0;width: 100%;display:none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/search-mobile-white.png" style="width:30px;"></a>
    												    
    												</div>
    												<div class="modal fade" role="dialog" id="hidden-bottom">
                                                            <div class="modal-dialog warranty">
                                                                <!-- Modal content-->
                                                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                                                             Tampak Bawah
                                                                        </span>
                                                                    </div>
                                                                    
                                                                  </div>
                                                                  <div class="modal-body" style="height: auto;width:100%;overflow-y:scroll;padding-top:0;">
                                                                       
                                                                            <div style="border-top:solid 1px #000;width:100%;margin-top: 10px;margin-bottom: 10px;"></div>
                                                                            <?php if($service_image != null){ ?>
                                                                                <?php if($service_image->service_image_bottom_view != 0){ ?>    
                                                                                    <img style="width:100%;" id="zoom-img-bottom" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_bottom_view; ?>" style="right: 0px;width: 50px;margin-top: 5px;">    
                                                                                <?php }else{ ?>
                                                                                    <img style="width:100%;" id="zoom-img-bottom" src="" style="right: 0px;width: 50px;margin-top: 5px;">  
                                                                                <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <img style="width:100%;" id="zoom-img-bottom" src="" style="right: 0px;width: 50px;margin-top: 5px;">        
                                                                            <?php } ?>
                                                                        	<div style="width:100%;">
                                                                        	    <label for="file-5" style="width:100%;">
                                                                        	        <a style="width:100px;float:right;padding-top: 5px;padding-bottom: 5px;text-align: center;margin-top: 17px;" class="blue-round">Edit</a>
                                                                        	    </label>
                                                                        	</div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>
    											
    	                				</div>
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 11px;">
    	                					<input style="display: none;" type="file" name="file-6" id="file-6" class="inputfile inputfile-4" accept="image/*" data-multiple-caption="{count} files selected" />
                                                
    												<label for="file-6">
    													<div id="image-plus-warranty-back" style="position:absolute;width:100%;height:100%;z-index:1;top:0;">
    												        <img id="plus-warranty-back" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/add-white-32.png" style="display:none;padding-top:25px;margin-left:-10px;">
    												    </div>
    														<?php 
    														if($service_image != null){
    															if($service_image->service_image_back_view == '0'){
    																?>
    																<div id="img-back" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-back" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/back.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																
    																<?php
    															}elseif($service_image->service_image_back_view != '0'){
    																?>
    																<div id="img-back" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_back_view; ?>');background-size: cover;">
    																</div>
    																
    																<?php
    															}
    														}else{
    																?>
    																<div id="img-back" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="border-radius: 10px;height: 86px;background-color: rgb(255,255,255);overflow:hidden;">
    
    																	<img id="img-back" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/back.png" style="right: 0px;width: 50px;margin-top: 5px;">
    																</div>
    																<?php
    															}
    														?>
    														
    													
    													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top: 10px;">
    													
    														<div id="tampak-belakang">Tampak Belakang</div>
    														<span id="tampak-belakang" class="span-back"></span>
    													</div>
    												</label>
    											
    												<div id="image-zoom-warranty-back" style="position:absolute;width:100%;height:100%;z-index:1;top:0;<?php if($image_total == 1){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
    												    <a id="zoom-warranty-back" data-toggle="modal" data-target="#hidden-back" style="cursor:pointer;top: 25%;position: absolute;left: 0;width: 100%;display:none;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/search-mobile-white.png" style="width:30px;"></a>
    												    
    												</div>
    												<div class="modal fade" role="dialog" id="hidden-back">
                                                            <div class="modal-dialog warranty">
                                                                <!-- Modal content-->
                                                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                                                             Tampak Belakang
                                                                        </span>
                                                                    </div>
                                                                    
                                                                  </div>
                                                                  <div class="modal-body" style="height: auto;width:100%;overflow-y:scroll;padding-top:0;">
                                                                       
                                                                            <div style="border-top:solid 1px #000;width:100%;margin-top: 10px;margin-bottom: 10px;"></div>
                                                                            <?php if($service_image != null){ ?>
                                                                                <?php if($service_image->service_image_back_view != 0){ ?>  
                                                                                    <img style="width:100%;" id="zoom-img-back" src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/product_condition/<?php echo $service_image->service_image_id; ?>/<?php echo $service_image->service_image_back_view; ?>" style="right: 0px;width: 50px;margin-top: 5px;">    
                                                                                <?php }else{ ?>
                                                                                    <img style="width:100%;" id="zoom-img-back" src="" style="right: 0px;width: 50px;margin-top: 5px;">  
                                                                                <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <img style="width:100%;" id="zoom-img-back" src="" style="right: 0px;width: 50px;margin-top: 5px;">        
                                                                            <?php } ?>
                                                                        	<div style="width:100%;">
                                                                        	    <label for="file-6" style="width:100%;">
                                                                        	    <a style="width:100px;float:right;padding-top: 5px;padding-bottom: 5px;text-align: center;margin-top: 17px;" class="blue-round">Edit</a>
                                                                        	    </label>
                                                                        	</div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            
                                                        </div>
    												
    												
    											
    	                				</div>
    	                			</div>
    	                			
    	                			<div id="upload-image-btn" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;text-align: center;<?php if($image_total == 1){ echo 'display:none;';}?>">
    	                				<a class="<?php if($count_service_image == 6){ echo 'blue-round';}else{echo 'grey-round';}?> title-warranty" id="upload-service" style="<?php if($count_service_image == 6){ echo 'pointer-events:auto;';}else{echo 'pointer-events:none;';}?>width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;">Unggah (<span id="img-count"><?php echo $count_service_image; ?></span>/6)</a>
    	                				
    	                				
    	                			</div>
    	                			<a class="blue-round title-warranty" id="upload-next" style="<?php if($image_total == 0){ echo 'display:none;';}?>width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;">Lewati</a>
	                		    </div>
	                		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;"></div>
	                		</div>

	                		<div id="warranty-location-title" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5 bgcolorgrey" style="margin-top: 15px;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:15px;">
	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
		                				<span>3. Pilih Lokasi Perbaikan</span>
		                				<span style="margin-left: 10px;">
		                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 15px;">
		                				</span>
	                				</span>
	                				
	                				<span class="col-xs-2 clearright clearright-mobile clearleft-mobile">
	                					<a class="text3-warranty" id="view-location" style="cursor:pointer;width: 100%;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center;<?php if($service->sender_name != ''){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">Ubah</a>
	                					
	                				</span>
	                				<span id="error-location" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty" style="color: red;display: none;">
		                				Lokasi garansi belum dipilih
	                				</span>
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="warranty-location" style="<?php if($service->sender_name == '' && $image_total == 1){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">
    	                			<div id="warranty-store" style="<?php if($service_detail->service_detail_drop_store_id != 0){ echo 'display: none;'; }else{ echo 'display: block;'; }?>">
    		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;text-align: center;">
    		                				<a id="drop-store" class="drop-store">
    			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="color:#fff;text-align: left;height: 60px;background-color: #1d6068;cursor: pointer;">
    			                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
    			                						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store-white.png" style="width: 28px;float:right;">
    			                						<div class="gotham-light title-warranty" style="padding-top: 5px;">Datang Langsung Ke Store</div>
    			                					</div>
    			                					
    			                				
    			                				</div>
    			                			</a>
    		                				
    		                			</div>
    		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;text-align: center;">
    		                				<a id="153" class="drop-centre">
    			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="color:#fff;text-align: left;height: 60px;background-color: #1d6068;cursor: pointer;">
    			                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
    			                						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/service_centre-white.png" style="width: 28px;float:right;">
    			                						<div class="gotham-light title-warranty" style="padding-top: 5px;">Kirim Menggunakan Ekspedisi</div>
    			                					</div>
    			                				
    			                				</div>
    			                			</a>
    		                				
    		                			</div>
    		                			
    	                			</div>
    	                			<div id="store-city" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="display:none;padding-top: 15px;text-align: center;">
    	                			    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty" style="text-align:left;padding-bottom:15px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 28px;"> Drop ke Store Terdekat</div>
    	                			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty" style="padding-bottom:15px;">
    	                			        <a class="text3-warranty" id="back-location-drop" style="cursor: pointer;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center;">Kembali</a>
    	                			    </div>
    	                			<?php 
    	                				$i_city = 0; 
    	                				$padd = '';
    	                			?>
    	                				<?php foreach($store_city as $city){ ?>
    	                					<?php 
    	                						if($i_city == 0){ 
    	                							$padd = 'padding-right: 11px;'; 
    	                						}elseif ($i_city == 1) {
    	                							$padd = 'padding-right: 3.5px;padding-left:3.5px;'; 
    	                						}else{
    	                							$padd = 'padding-left: 11px;'; 
    	                						} 
    
    	                					?>
    	                					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="<?php echo $padd; ?>">
    			                				<a data-toggle="modal" data-target="#location-<?php echo $city->store_location;?>">
    				                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="color:#fff;text-align: center;height: 85px;background-color: #1d6068;cursor: pointer;">
    				                					<div style="position: absolute;left: 0;right: 0;margin:auto;top: 15px;">
    				                						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store-white.png" style="width: 28px;">
    				                						<div class="gotham-light" style="padding-top: 5px;"><?php echo $city->store_location;?></div>
    				                					</div>
    				                					
    				                				
    				                				</div>
    				                			</a>
    				                		</div>
    				                		<div id="location-<?php echo $city->store_location;?>" class="modal warranty fade" role="dialog">
    										  <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">
    
    										    <!-- Modal content-->
    										    <div class="modal-content" style="border-radius: 10px;opacity: 1;height: 506px;text-align: left;">
    										      <div class="modal-body" style="padding-top: 10px;">
    										        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 8px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
    										        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
    	                				
    					                				<span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
    					                					<?php echo $city->store_location;?>
    					                				</span>
    					                				<span class="clearleft clearright clearright-mobile gotham-medium">
    					                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 17px;margin-left: 10px;">
    					                				</span>
    					                				
    					                			</div>
    										      </div>
    										      <div class="modal-body">
    										      	 
    											    <hr style="margin-top: 0px;margin-bottom: 5px;">
    
    										        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height: 404px;overflow-y: scroll;">
    	                							<?php
    	                								$store_list = \backend\models\Stores::find()->where(['store_location'=>$city->store_location])->andWhere(['store_status'=>'active'])->all();
    	                								foreach ($store_list as $store_value) {
    	                								
    	                								
    	                							?>
    	                								<a id="<?php echo $store_value->store_id;?>" class="drop-centre">
    					                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bradius5 text3-warranty" style="color:#fff;background-color: #1d6068;padding-top: 5px;padding-bottom: 10px;margin-top: 12px;cursor:pointer;">
    	                									
    		                									<span class="clearleft clearright clearright-mobile gotham-medium">
    							                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store-white.png" style="width: 19px;">
    							                				</span>
    							                				<span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="padding-left: 5px;">
    							                					<?php echo $store_value->store_name;?>
    							                				</span>
    							                				
    							                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 5px;">
    							                					<?php echo $store_value->store_address;?>
    							                				</div>
    						                			</div>
    						                			</a>
    					                			<?php
    					                				}
    					                			?>	
    					                			</div>
    					                			<hr style="margin-top: 0px;margin-bottom: 5px;">
    
    					                			<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                								<a class="blue-round" id="choose-service" style="width:25%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;margin-top: 10px;">Next</a>
    					                			</div> -->
    										      </div>
    										      
    										    </div>
    
    										  </div>
    										</div>
    				                		<?php $i_city++; ?>
    				                		<?php 
    				                			if($i_city == 3){
    				                				$i_city = 0;
    				                				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:15px;"></div>';
    				                			}
    				                		?>
    		                			<?php } ?>	
    		                		</div>
    
    		                		<div id="address-location" style="<?php if($service_detail->service_detail_drop_store_id != 0){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">
    		                			<input name="location_id" id="location-id" style="display: none;" value="<?php echo $service_detail->service_detail_drop_store_id;?>">
    		                			<?php $store = \backend\models\Stores::find()->where(['store_id'=>$service_detail->service_detail_drop_store_id])->one(); ?>
    		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="margin-top: 10px;text-align: center;background-color: rgb(237,238,240);">
    		                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="text-align: left;background-color: rgb(237,238,240);">
    		                				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-bottom:5px;">
            	                				        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty">
            	                				            Tujuan:  
            	                				        </div>
            	                				        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile gotham-light text3-warranty">
                    		                			 	<a id="change-location" class="text3-warranty" style="margin-right:2px;cursor:pointer;float: right;text-align: center;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center">
                    	                						Ubah Alamat Tujuan
                    	                					</a>
                    		                			 </div>
            	                				    </div>
    		                				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
    				                				</span>
    			                					<span id="store-name" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty">
    			                					    <span class="gotham-medium" style="font-size:8px;">Toko</span><br>
    					                				<?php echo $store->store_name; ?>
    				                				</span>
    			                				</div>
    		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 5px;">
    			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
    				                				</span>
    			                					<span id="store-address" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
    					                				<span class="gotham-medium" style="font-size:8px;">Alamat</span><br>
    					                				<?php echo $store->store_address; ?>
    				                				</span>
    			                				</div>
    			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 5px;padding-bottom: 15px;">
    			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 20px;">
    				                				</span>
    			                					<span id="store-contact" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
    					                				<span class="gotham-medium" style="font-size:8px;">Kontak Pelayanan</span><br>
    					                				<?php echo $store->store_contact_number; ?>
    				                				</span>
    			                				</div>
    		                				    <div id="customer-address-from" style="<?php echo $service_detail->service_detail_drop_store_id != 153 ? 'display:none;' : 'display:block;'; ?>">
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            	                				        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearright clearright-mobile">
            	                				           
            	                				        </div>
            	                				    </div>
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            	                				        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty">
            	                				            Dari:  
            	                				        </div>
            	                				        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile gotham-light text3-warranty">
                    		                			 	<a class="modal-blur text3-warranty" data-toggle="modal" data-target="#preview-download" style="margin-right:2px;cursor:pointer;float: right;text-align: center;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center">
                    	                						Ubah Alamat Pengirim
                    	                					</a>
                    		                			 </div>
            	                				    </div>
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/account-mobile.png" style="width: 15px;">
        				                				</span>
        			                					<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty" style="font-size:9px;">
        					                				Nama
        				                				</span>
        				                				<span id="customer-address-name" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
        					                				<?php echo $service->sender_name == '' ? $_SESSION["customerInfo"]['fname'] : $service->sender_name; ?>
        				                				</span>
        			                				</div>
        			                				<?php
        			                				    $customerInfo = $_SESSION["customerInfo"];
        
                                                        $customer_address = \backend\models\CustomerAddress::find()->where(['customer_id'=>$_SESSION["customerInfo"]['customer_id']])->andWhere(['set_as_default'=>1])->one();
                                                
                                                        if($customer_address == null){
                                                          $customer_address = \backend\models\CustomerAddress::find()->where(['customer_id'=>$_SESSION["customerInfo"]['customer_id']])->one();
                                                        }
        			                				?>
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 5px;">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 15px;padding-top:5px;">
        				                				</span>
        			                					<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty" style="padding-top:4px;font-size:9px;">
        					                				Alamat
        				                				</span>
        				                				<span id="customer-address-address" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty" style="padding-top:5px;">
        					                				<?php echo $service->sender_address == '' ? $customer_address->address1 : $service->sender_address; ?>
        				                				</span>
        			                				</div>
        			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 5px;padding-bottom: 15px;">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/telephone.png" style="width: 15px;padding-top:5px;">
        				                				</span>
        			                					<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty" style="font-size:9px;">
        					                				No. Telp
        				                				</span>
        				                				<span id="customer-address-contact" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
        					                				<?php echo $service->sender_telp == '' ? $customer_address->phone : $service->sender_telp; ?>
        				                				</span>
        			                				</div>
        			                			    
            	                				</div>
    		                					<a id="save-location" class="blue-round title-warranty" style="width: 100%;font-size: 11px;float: right;text-align: center;<?php echo $service->sender_name == '' ? 'display:none;' : 'display:block;'; ?>">Simpan</a>
    		                				</div>
    
    		                				
    		                			</div>
    		                			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    		                			 
    		                			         <a class="blue-round modal-blur text-warranty" data-toggle="modal" data-target="#preview-download" id="preview-location" style="width: 100%;float: right;text-align: center;<?php echo $service->sender_name == '' ? 'display:block;' : 'display:none;'; ?>">
        	                						Isi Form Alamat  Pengirim
        	                					</a>
    		                			   
    		                			 </div>
    	                			</div>
	                		    </div>
	                		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;"></div>
	                		</div>
	                		
	                		<div id="warranty-return-title" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5 bgcolorgrey" style="margin-top: 15px;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:15px;">
	                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
		                				<span>4. Isi Alamat Pengembalian Produk</span>
		                				<span style="margin-left: 10px;">
		                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
		                				</span>
	                				</span>
	                				
	                				<span class="col-xs-2 clearright clearright-mobile clearleft-mobile">
	                					<a class="text3-warranty" id="change-location-return" style="cursor:pointer;width: 100%;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center;<?php if($service->sc_drop_store_id != 0 || $service->sc_drop_address != ''){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">Ubah</a>
	                					
	                				</span>
	                				<span id="error-location" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty" style="color: red;display: none;">
		                				Lokasi garansi belum dipilih
	                				</span>
	                			</div>
	                			
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="warranty-return" style="<?php if($service->sender_name != '' && $service->sc_drop_store_id == 0 && $service->sc_drop_address == ''){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">
    	                			<div id="warranty-return-location" style="<?php if(($service->sc_drop_store_id != 0) || ($service->sc_drop_name != '')){ echo 'display: none;'; }else{ echo 'display: block;'; }?>">
    	                			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty" style="padding-top: 10px;">
    	                				
    Silahkan pilih lokasi pengembalian barang Anda setelah service selesai dilakukan.
    	                			
    	                			    </div>
    		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;text-align: center;">
    		                				<a id="return-store" class="return-store">
    			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="color:#fff;text-align: left;height: 60px;background-color: #1d6068;cursor: pointer;">
    			                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
    			                						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store-white.png" style="width: 28px;float:right;">
    			                						<div class="gotham-light title-warranty" style="padding-top: 5px;">Ambil di Store terdekat</div>
    			                					</div>
    			                				
    			                				</div>
    			                			</a>
    		                				
    		                			</div>
    		                			<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;text-align: center;">
    		                				<a id="return-address" class="return-address" style="<?php echo $service->sc_drop_store_id != 153 ? 'display:none;' : 'display:block;'; ?>">
    			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="color:#fff;text-align: left;height: 60px;background-color: #1d6068;cursor: pointer;">
    			  
    			                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
    			                						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location-white.png" style="width: 21px;float:right;">
    			                						<div class="gotham-light title-warranty" style="padding-top: 5px;">Kirim langsung ke Alamat Saya</div>
    			                					</div>
    			                				
    			                				</div>
    			                			</a>
    		                				
    		                			</div>
    
    
    
    	                			</div>
    	                			<div id="return-address-field" style="display:none;">
    	                			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty" style="padding-top: 10px;">
    	                				    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty" style="padding-bottom:15px;float:right;">
        	                			        <a class="text3-warranty" id="back-location-return" style="cursor: pointer;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center;">Kembali</a>
        	                			    </div>
    	                				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                				        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                                  Nama
                                                  </div>
                                                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
                                                  :
                                                  </div>
                                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <input name="" id="return-name" placeholder="Isi nama penerima barang" style="width: 100%;border:solid 1px rgb(69,69,69);border-radius:5px;padding-left:5px;padding-right:5px;height:30px;">
                                                  </div>  
    	                				    </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:10px;">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                                  Alamat
                                                  </div>
                                                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
                                                  :
                                                  </div>
                                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <textarea id="return-address" placeholder="Isi alamat pengembalian barang setelah barang selesai diservice" rows="4" style="padding-right:5px;padding-left:5px;width:100%;border:solid 1px rgb(69,69,69);border-radius:5px;font-style: normal;padding: 0;"></textarea>
                                                  </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:5px;">
    	                				        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                                  Provinsi
                                                  </div>
                                                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
                                                  :
                                                  </div>
                                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <select class="year" id="province-profile" name="province_id">
                                                        <option value="0" selected="selected">PROVINCE</option>
                                                        <?php $provinces = backend\models\Province::findAll(["active" => 1]); ?>
                                                        <?php if (count($provinces) > 0) { ?>
                                                            <?php foreach ($provinces as $province) { ?>
                                                                <option value="<?php echo $province->province_id; ?>"><?php echo $province->name; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                  </div>  
    	                				    </div>
    	                				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:10px;">
    	                				        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                                  Kota
                                                  </div>
                                                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
                                                  :
                                                  </div>
                                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile state">
                                                    <select class="year" id="state-profile" name="state_id" onchange="checkDistrict()">
                                                        <option value="0" selected="selected">STATE</option>
                                                        
                                                    </select>
                                                  </div>  
    	                				    </div>
    	                				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:10px;">
    	                				        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                                  Kec.
                                                  </div>
                                                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
                                                  :
                                                  </div>
                                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 district clearleft clearright clearleft-mobile clearright-mobile">
                                                    <select class="year" id="district-profile" name="district_id">
                                                        <option value="0" selected="selected">DISTRICT</option>
                                                        
                                                    </select>
                                                  </div>  
    	                				    </div>
    	                				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:10px;">
    	                				        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                                  Kel.
                                                  </div>
                                                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
                                                  :
                                                  </div>
                                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <input name="" id="return-kel" placeholder="Isi kelurahan" style="width: 100%;border:solid 1px rgb(69,69,69);border-radius:5px;padding-left:5px;padding-right:5px;height:30px;">
                                                  </div>  
    	                				    </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:10px;">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                                  No. HP
                                                  </div>
                                                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile">
                                                  :
                                                  </div>
                                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile">
                                                    <input type="" name="" id="return-telp" placeholder="Isi nomor HP penerima barang" style="width: 100%;border:solid 1px rgb(69,69,69);border-radius:5px;padding-left:5px;padding-right:5px;height:30px;">
                                                  </div>
                                            </div>  
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
        		                			 	<a class="blue-round text-warranty" id="save-return-address" style="width: 100%;float: right;text-align: center;">
        	                						Simpan
        	                					</a>
        		                			 </div>  
    	                			        
    	                			    </div>
    		                		
    	                			</div>
    	                			<div id="return-store-city" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="display:none;padding-top: 15px;text-align: center;">
    	                			    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile">
    	                			        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium2 title-warranty" style="text-align:left;">Ambil di Store terdekat</div>
    	                			        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty" style="text-align:left;padding-bottom:15px;">Pembayaran biaya service di lakukan di store tempat pengambilan barang. </div>
    	                			    </div>
    	                			    
    	                			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty" style="padding-bottom:15px;">
    	                			        <a class="text3-warranty" id="back-location-return" style="cursor: pointer;background-color: #fff;color:rgb(33,96,103);border-radius: 25px;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;float: right;text-align: center;">Kembali</a>
    	                			    </div>
    	                			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile"></div>
    	                			<?php 
    	                				$i_city = 0; 
    	                				$padd = '';
    	                			?>
    	                				<?php foreach($store_city as $city){ ?>
    	                					<?php 
    	                						if($i_city == 0){ 
    	                							$padd = 'padding-right: 11px;'; 
    	                						}elseif ($i_city == 1) {
    	                							$padd = 'padding-right: 3.5px;padding-left:3.5px;'; 
    	                						}else{
    	                							$padd = 'padding-left: 11px;'; 
    	                						} 
    
    	                					?>
    	                					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="<?php echo $padd; ?>">
    			                				<a data-toggle="modal" data-target="#return-<?php echo $city->store_location;?>">
    				                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="color:#fff;text-align: center;height: 85px;background-color: #1d6068;cursor: pointer;">
    				                					<div style="position: absolute;left: 0;right: 0;margin:auto;top: 15px;">
    				                						<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store-white.png" style="width: 28px;">
    				                						<div class="gotham-light" style="padding-top: 5px;"><?php echo $city->store_location;?></div>
    				                					</div>
    				                					
    				                				
    				                				</div>
    				                			</a>
    				                		</div>
    				                		<div id="return-<?php echo $city->store_location;?>" class="modal warranty fade" role="dialog">
    										  <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">
    
    										    <!-- Modal content-->
    										    <div class="modal-content" style="border-radius: 10px;opacity: 1;height: 506px;text-align: left;">
    										      <div class="modal-body" style="padding-top: 10px;">
    										        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
    										        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
    	                				
    					                				<span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
    					                					<?php echo $city->store_location;?>
    					                				</span>
    					                				<span class="clearleft clearright clearright-mobile gotham-medium">
    					                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 22px;margin-left: 10px;">
    					                				</span>
    					                				
    					                			</div>
    										      </div>
    										      <div class="modal-body">
    										      	 
    											    <hr style="margin-top: 0px;margin-bottom: 5px;">
    
    										        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height: 404px;overflow-y: scroll;">
    	                							<?php
    	                								$store_list = \backend\models\Stores::find()->where(['store_location'=>$city->store_location])->andWhere(['store_status'=>'active'])->all();
    	                								foreach ($store_list as $store_value) {
    	                								
    	                								
    	                							?>
    	                								<a id="<?php echo $store_value->store_id;?>" class="drop-store-return">
    					                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bradius5 text3-warranty" style="color:#fff;background-color: #1d6068;padding-top: 5px;padding-bottom: 10px;margin-top: 12px;cursor:pointer;">
    	                									
    		                									<span class="clearleft clearright clearright-mobile gotham-medium">
    							                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store-white.png" style="width: 19px;">
    							                				</span>
    							                				<span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="padding-left: 5px;">
    							                					<?php echo $store_value->store_name;?>
    							                				</span>
    							                				
    							                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 5px;">
    							                					<?php echo $store_value->store_address;?>
    							                				</div>
    						                			</div>
    						                			</a>
    					                			<?php
    					                				}
    					                			?>	
    					                			</div>
    					                			<hr style="margin-top: 0px;margin-bottom: 5px;">
    
    					                			<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                								<a class="blue-round" id="choose-service" style="width:25%;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;margin-top: 10px;">Next</a>
    					                			</div> -->
    										      </div>
    										      
    										    </div>
    
    										  </div>
    										</div>
    				                		<?php $i_city++; ?>
    				                		<?php 
    				                			if($i_city == 3){
    				                				$i_city = 0;
    				                				echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:15px;"></div>';
    				                			}
    				                		?>
    		                			<?php } ?>	
    		                		</div>
                                    <div id="address-location-return" style="<?php if(($service->sc_drop_store_id != 0) || ($service->sc_drop_name != '')){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">
    		                		    
    		                		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="margin-top: 10px;text-align: center;background-color: rgb(237,238,240);">
    		                		<?php
    		                		    if($service->sc_drop_store_id != 0){
    		                		        ?>
    		                		            <?php $store_return = \backend\models\Stores::find()->where(['store_id'=>$service->sc_drop_store_id])->one(); ?>
    		                			
        		                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="padding-top: 10px;text-align: left;background-color: rgb(237,238,240);">
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
        				                				</span>
        			                					<span id="drop-store-name" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty">
        					                				<?php echo $store_return->store_name; ?>
        				                				</span>
        			                				</div>
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;padding-top: 10px;">
        				                				</span>
        			                					<span id="drop-store-address" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
        					                				<?php echo $store_return->store_address; ?>
        				                				</span>
        			                				</div>
        			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;padding-bottom: 15px;">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 20px;">
        				                				</span>
        			                					<span id="drop-store-contact" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
        					                				<?php echo $store_return->store_contact_number; ?>
        				                				</span>
        			                				</div>
        		                				</div>
    		                		        <?php
    		                		    }else{
    		                		        ?>
    		                		            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="padding-top: 10px;text-align: left;background-color: rgb(237,238,240);">
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 20px;">
        				                				</span>
        			                					<span id="drop-store-name" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty">
        					                				<?php echo $service->sc_drop_name; ?>
        				                				</span>
        			                				</div>
        		                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;padding-top: 10px;">
        				                				</span>
        			                					<span id="drop-store-address" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
        					                				<?php echo $service->sc_drop_address; ?>
        				                				</span>
        			                				</div>
        			                				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 5px;padding-bottom: 15px;">
        			                					<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 20px;">
        				                				</span>
        			                					<span id="drop-store-contact" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty">
        					                				<?php echo $service->sc_drop_telp; ?>
        				                				</span>
        			                				</div>
        		                				</div>
    		                		        <?php
    		                		    }
    		                		?>  
    		                		    </div>
    		                			
    
    		                			
    		                			
    	                			</div>
		                		</div>
		                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;"></div>
	                		</div>


	                		<div id="warranty-save" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 18px;<?php if(($service->sc_drop_store_id != 0) || ($service->sc_drop_name != '')){ echo 'display: block;'; }else{ echo 'display: none;'; }?>">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height: 90px;">
				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/warranty-card-gold.png" style="width: 117px;height:74px;margin-top: 10px;position: absolute;left: 0;right: 0;margin: auto;background-color: #fff;border-radius: 10px;">
				                				</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty" style="padding-top: 10px;text-align: center;">
	                				Pengajuan Alamat lokasi perbaikan Anda telah lengkap!
	                				
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty" style="padding-top: 10px;text-align: center;">
	                				
Silahkan kirimkan produk Anda dan jangan lupa lakukan konfirmasi pengiriman dengan melampirkan bukti pengiriman setelah Anda klik tombol simpan.
	                			
	                			</div>
	                			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 clearleft clearright clearleft-mobile clearright-mobile text-warranty" style="padding-top: 15px;">
    	                			<label class="control control--checkbox text-warranty" style="color: rgb(65,155,249);margin-left: -10px;text-align:center;">
    				                    <input type="checkbox" id="claim-agreement" name="term-condition">
    				                    Saya telah membaca dan menyetujui segala syarat ketentuan berlaku di The Watch Co.
    				                    <div class="control__indicator"></div>
    				                  </label>
                                    <span id="agreement-error" class="gotham-light" style="font-size: 11px;font-style: italic;padding-left: 0;color:red;display:none;text-align:center;">* Silahkan pilih Syarat & Ketentuan</span>
                                   
    	                		</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;text-align: center;height: 50px;">
	                				<a class="yellow-round title-warranty" id="save-service" style="width:50%;position:absolute;left:0;right:0;margin:auto;text-align: center;float: right;padding-top: 8px;padding-bottom: 9px;">Simpan</a>
	                			</div>
	                		</div>
	                		
	                		<div id="catatan-khusus" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 18px;display: none;">
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
	                				<hr style="margin-top: 0;border-top-color: rgb(69,69,69);">
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty" style="padding-top: 10px;">
	                				<span class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
		                				<span>Catatan Khusus</span>
		                				<span style="margin-left: 10px;">
		                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition.png" style="width: 20px;">
		                				</span>
	                				</span>
	                				
	                			</div>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty" style="padding-top: 10px;">
	                				
Selain mengirimkan Produk ke Store, perbaikan produk juga dapat dilakukan dengan langsung mengunjungi store terdekat dengan lokasi anda.
	                			
	                			</div>
	                			
	                			
	                		</div>
	                		</form>
	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
	                			
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
	                			    <a class="title-warranty" id="cancel-service" style="color:rgb(65,155,249);font-style:italic;text-decoration:underline;cursor:pointer;">
	                			        Batalkan Service
	                			    </a>
	                			    
	                			</div>
	                			
	                		</div>
	                		
	                	</div>
	                   
	                </div>
	                
	            </div>
	     		<?php } ?>
	            <div class="hidden-lg col-md-12 col-sm-12 hidden-xs" style="padding-top:90px;"></div>
            </div>
            
        </div>
    </div>
</section>
<?php
    echo Yii::$app->view->renderFile('@app/views/warranty/modal.php',['store'=>$store,'service'=>$service]);
?>
<script src="<?php echo \yii\helpers\Url::base(); ?>/js/custom-file-input.js"></script>
<script src="<?php echo \yii\helpers\Url::base(); ?>/js/canvas-to-blob.min.js"></script>
<script src="<?php echo \yii\helpers\Url::base(); ?>/js/resize.js"></script>
<script type="text/javascript">
	var sertype = '<?php echo json_encode($service_type); ?>';
    var service_id = '<?php echo $service->service_id; ?>';
    
    function checkDistrict(){
        var state_id = document.getElementById('state-profile').value;
        
        if(state_id != 0){
            $.ajax({
                type: "POST",
                url: baseUrl + '/shipping/generate-district-profile',
                data: {"state_id": state_id},
                beforeSend: function () {
                    $('#loadingScreen').modal('show');
                },
                success: function (data) {
                    $('#loadingScreen').modal('hide');
                    $("div.district").html(data);
                }
            });
        }
    }
</script>

<style type="text/css">
  .modal-backdrop.in {
      opacity: 0.7;
  }
  .close{
    opacity: 1;
  }
  .modal-dialog{
      width:400px;
      margin-left: auto;
      margin-right: auto;
  }
  .fa.fa-pencil{
    position: absolute;
    z-index: 1;
    top: 0;
    right: 0;
  }
  .modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
  .@media only screen and (max-width : 768px) {
      
  }
</style>

<style type="text/css">
    .loading-image{
        background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/icons/tiktok.gif');
        background-size: 50px;
        background-repeat: no-repeat;
        background-position-x: 40%;
        background-position-y: 20%;
    }
    .bgcolorwhite{
        background-color:#fff;   
    }
    a.blue-round#choose-service{
        color: #fff;
    }
    a.blue-round#choose-service:hover{
        color: #1d6068;
    }
	.card-left{
		width: 62% !important;
	
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
         
            background: #1d6068;
            color: #fff;
            /* width: 10%; */
        }
        a.grey-round {
            float: right;
            border: 1px solid grey;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px;
            padding-left: 20px;
            padding-right: 20px;
            letter-spacing: 1.5px;

            background: grey;
            color: #fff;
            /*width: 10%;*/
        }
    }
</style>


<style>
select.year{
    background-color:#fff;
    border:solid 1px;
    border-radius: 5px;
}
.drop-service {
   
    padding-top: 7px;
    padding-bottom: 7px;
   
    font-family: gotham-light;
    border: none;
    cursor: pointer;
    padding-left: 15px;
    border-radius: 15px;
}

.dropbtn:hover, .dropbtn:focus {
    /*background-color: #2980B9;*/
}
a.bgcolorblue:hover{
    color:#fff;
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
.checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::before{
   
     background-color: rgb(158,132,97); 
    background-image: url(/img/warranty/icons/Icon-22.png);
    background-size: cover;
    border-radius: 2px;
}
.checkbox-btn label.black-style::after{
        border: 1px solid rgb(158,132,97);
}
.checkbox-btn label.black-style::before{
    margin-top: 0px;
}
</style>
<style>

.control {
display: block;
position: relative;
padding-left: 27px;
padding-top: 3px;
margin-bottom: 8px;
cursor: pointer;

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
background: #fff;
    border: solid 1px rgb(158,131,97);
    border-radius: 4px;
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