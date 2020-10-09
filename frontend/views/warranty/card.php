<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css/component.css" />
<section id="shopping-bag" style="padding-top: 20px;">
    <div class="container">
    	<div class="row">
    	<?php echo Yii::$app->view->renderFile('@app/views/user/_leftmenu.php', array()); ?>
    		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
    			<?php if(count($order_detail_warrantys) == 0){ ?>
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light" style="height: 200px;">
	                	<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/id-card.png" style="position: absolute;left: 0;right: 0;margin: auto;">
	                   	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light" style="text-align: center;margin-top: 135px;">Belum ada kartu garansi digital yang terinput!</div>
	                </div>
	                
	            </div>
	            
	            <?php } ?>
	            
    	       
    	                    <span id="survei-modal" style="display:none;"><?php echo $survei_check; ?></span>
    	               
	            <?php
	                // Filter Checking, 1 is true view, 0 is false view
	                $filter_waiting = 1;
	                $filter_confirm = 1;
	                $filter_active = '';
	                if(isset($_GET['filter'])){
	                    if($_GET['filter'] == 0){
	                        $filter_waiting = 1;
	                        $filter_confirm = 0;
	                        $filter_active = 'waiting';
	                    }
	                    if($_GET['filter'] == 1){
	                        $filter_waiting = 0;
	                        $filter_confirm = 1;
	                        $filter_active = 'active';
	                    }
	                }
	            ?>
	            <div id="warranty-card-scroll"></div>
	     		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright" id="search-warranty">
		     		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile clearleft clearright gotham-light" style="padding-bottom:15px;">
		     			<select id="filter-warranty-card" onchange="javascript:handleSelect(this)" style="width: 100%;border: 1px solid #1d6068;cursor: pointer;border-radius: 20px;padding-left: 12px;padding-right: 12px;letter-spacing: 1.5px;background: #1d6068;color: #fff;height:33px;">
		     				<option value="<?php echo \yii\helpers\Url::base(); ?>/warranty/card">Cari Berdasarkan : Semua Garansi</option>
		     				<option value="<?php echo \yii\helpers\Url::base(); ?>/warranty/card?filter=0" <?php echo ($filter_active == 'waiting') ? 'selected':''; ?>>Garansi Belum dikonfirmasi</option>
		     				<option value="<?php echo \yii\helpers\Url::base(); ?>/warranty/card?filter=1" <?php echo ($filter_active == 'active') ? 'selected':''; ?>>Garansi Sudah dikonfirmasi</option>
		     			</select>
		     		</div>
		            <script type="text/javascript">
                    function handleSelect(elm)
                    {
                    window.location = elm.value;
                    }
                    </script>
	     		</div>
	     		
	     		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
		     		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile clearleft clearright gotham-light" style="padding-bottom:15px;">
		     			<input placeholder="search" type="" name="warranty-search" style="width: 100%;border: solid 1px #1d6068;border-radius: 25px;height: 33px;padding-left: 15px;background-color: #fff;">
	                	<a id="warranty-search-button">
	                		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/icon-search-green.png" style="position: absolute;top: 7px;right: 22px;width: 20px;cursor:pointer;">
	                	</a>
	                	
	                	<?php if(isset($_GET['search'])){ ?>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft-mobile clearright-mobile gotham-light" style="padding-top: 5px;">
	                	    Search : <div style="display:inline-block;background-color: rgb(193,185,179);padding: 2px 5px 2px 10px;border-radius: 5px;"><?php echo $_GET['search']; ?>
	                	    <a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/card" style="vertical-align: text-top;font-size: 10px;">x</a>
	                	    
	                	    </div>
	                	</div>
	                	<?php } ?>
		     		</div>
		            
	     		</div>
	     		
	            <div class="hidden-lg col-md-12 col-sm-12 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;">
	                <div class="col-lg-12 col-md-10 col-sm-10 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light bgcolorblue" style="padding: 11px 10px 11px 20px;border-radius: 25px;">
	                		<div class="col-xs-7 clearright-mobile clearleft-mobile title-warranty" style="color: #fff;letter-spacing: 0.2px;">Cara Input Kartu Garansi Digital</div> 
	                		<span class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition-white.png" style="width: 24px;margin-left: 10px;">
                                    </span>
	                		<span class="col-xs-2 clearright clearright-mobile"><a data-toggle="modal" data-target="#how-to-input" class="modal-blur"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/info.png" id="cara-claim" style="width: 20px;position: absolute;right: 0;"></a></span>
	                	</div>
	                   
	                </div>
	                
	            </div>
	            <?php $i = 0; ?>
	            
	            <!-- KARTU GARANSI MENUNGGU PERSETUJUAN -->
	            <?php
	                if($filter_waiting == 1){
	                    if(isset($_GET['search'])){
	                        $service_claims = \backend\models\ServiceClaimManual::find()->where(['customer_id'=>$customer_id])->andWhere(['service_claim_manual_status'=>'Awaiting Confirmation'])->andWhere(['product_id'=>$product_id])->orderBy('service_claim_manual_id DESC')->all();
	                    }else{
	                       $service_claims = \backend\models\ServiceClaimManual::find()->where(['customer_id'=>$customer_id])->andWhere(['service_claim_manual_status'=>'Awaiting Confirmation'])->orderBy('service_claim_manual_id DESC')->all(); 
	                    }
    	            	
    	            	if(count($service_claims > 0)){
    	            		foreach($service_claims as $service_claim){
    	            			?>
    	            			    <div class="col-lg-6 col-md-10 col-sm-10 col-xs-12 clearleft clearright <?php if($i==0){ echo 'p75right';}else{ echo 'p75left';} ?> fcolor69" style="letter-spacing: 0.5px;margin-top: 15px;">
    				                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
    				                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light box-shadow" style="border-radius: 5px;">
    				                		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile card-left" style="padding-top: 15px;">
    				                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    				                				
    				                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
    				                					Kartu Garansi Digital
    				                				</span>
    				                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty">
    				                					<?php
    				                						$warranty = \backend\models\Warranty::find()->where(['warranty_code'=>$service_claim->warranty_code])->one();
    				                					 	echo $warranty->warranty_number; 
    				                						
    				                					?>
    				                					
    				                				</span>
    				                			</div>
    				                			
    				                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    				                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon" style="">
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 23px;">
    				                				</span>
    				                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
    				                				<?php
    				                				    // $order_detail = \backend\models\OrderDetail::find()->where(['product_id'=>$service_claim->product_id])->one();
    				                				    // $order = \backend\models\Orders::find()->where(['orders_id'=>$order_detail->orders_id])->one();
    				                					$store = \backend\models\Stores::find()->where(['store_id'=>$service_claim->store_id])->one();
    				                					 echo $store->store_name.' '.$store->store_slug;
    				                				?>
    				                				</span>
    				                			</div>
    				                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
    				                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/invoice.png" style="width: 21px;margin-left: 2px;">
    				                				</span>
    				                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
    				                					<?php echo $warranty->warranty_number; ?>
    				                					
    				                				</span>
    				                			</div>
    				                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
    				                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/watch.png" style="width: 17px;margin-left: 4px;">
    				                				</span>
    				                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
    				                					<?php 
    				                						$product_detail = \backend\models\ProductDetail::find()->where(['product_id'=>$service_claim->product_id])->one();
    				                						echo $product_detail->name;
    				                					?>
    				                				</span>
    				                			</div>
    				                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
    				                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile warranty-icon">
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/warranty-type.png" style="width: 22px;">
    				                				</span>
    				                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile title-warranty">
    				                					Garansi <?php echo \backend\models\WarrantyType::find()->where(['warranty_type_id'=>$warranty->warranty_type_id])->one()->warranty_type_name;?>
    				                				</span>
    				                			</div>
    				                			
    				                		</div>
    				                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile" style="position: absolute;bottom:15px;color: rgb(160,29,34);">
    				                				<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile gotham-medium warranty-icon">
        				                				<span>
        				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/status-red.png" style="width: 24px;">
        				                				</span>		                				
        			                				</span>
        			                				<span class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
        			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Status</span>
        			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text gotham-medium">Menunggu Pengaktifan Kartu Garansi</span>
        			                				</span>
    				                				
    				                			
    				                		</div>
    				                		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 clearleft clearright clearleft-mobile clearright-mobile card-right" style="padding-top: 15px;">
    				                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    				                				<?php
    				                					$product_image = \backend\models\ProductImage::find()->where(['product_id'=>$service_claim->product_id])->andWhere(['cover'=>1])->one();
    				                					 
    				                				?>
    				                				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product_image->product_image_id;?>/<?php echo $product_image->product_image_id;?>_medium.jpg" style="width: 100%;border-radius: 5px;">
    				                			</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light text-warranty box-shadow-smooth" style="text-align: center;background-color: #fff;margin-top: 10px;border-radius: 2px;">
                    	                				Sisa Waktu Garansi
                    	                			</div>
                    	                			
                    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile fcolor69" style="font-size: 22px;text-align: center;margin-top: 3px;">
                    
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 4px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                    	                						
                    	                						00
                    	                					</div>
                    	                				</div>
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;padding-left: 2px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                    	                						
                    	                						00
                    	                					</div>
                    	                				</div>
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 4px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile box-shadow-smooth" style="background-color: #fff;border-radius: 5px 5px 0 0;">
                    	                					
                    	                						00
                    	                					</div>
                    	                				</div>
                    	                			</div>
                    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="font-size: 12px;text-align: center;margin-top: 0px;">
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 4px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                    	                						Tahun
                    	                					</div>
                    	                				</div>
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;padding-left: 2px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                    	                						Bulan
                    	                					</div>
                    	                				</div>
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 4px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                    	                						Hari
                    	                					</div>
                    	                				</div>
                    	                			</div>
    				                			
    				         				                	
    				                			<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
    				                		</div>
    				                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space non warranty-card" style="">
        	                		    </div>
    				                		
    				                	</div>
    				                   	
    				                </div>
    				                
    				            </div>
    	            			<?php
    	            			$i++;
    	            			if($i == 2){
    			            		$i = 0;
    			            	}
    	            		}
    	            	}
	                }
	            ?>
	            
	            <!-- KARTU GARANSI SUDAH AKTIF -->
	            
	            
	            <?php 
	            if($filter_confirm == 1){     
	                foreach($order_detail_warrantys as $order_detail_warranty){ ?>
	            	
    	            <div class="col-lg-6 col-md-10 col-sm-10 col-xs-12 clearleft clearright <?php if($i==0){ echo 'p75right';}else{ echo 'p75left';} ?> fcolor69" style="letter-spacing: 0.5px;margin-top: 15px;">
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
    	                				   // $order_detail = \backend\models\OrderDetail::find()->where(['product_id'=>$order_detail_warranty->orderDetail->orders_id])->one();
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
    	                			
    	                		</div>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="position: absolute;bottom:15px;padding-right:30px;padding-left:0;z-index:1;">
    	                			<?php
    	                			    $service_detail = \backend\models\ServiceDetail::find()->where(['order_detail_warranty_id'=>$order_detail_warranty->order_detail_warranty_id])->orderBy('service_detail_id DESC')->one();
    	                				$service = \backend\models\Service::find()->where(['service_id'=>$service_detail->service_id])->orderBy('service_id DESC')->one();
    	                				$service_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service->service_history_id])->orderBy('service_history_id DESC')->one();
    	                				$service_state_lang = \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one();
                                    ?>
                                    <input style="display: none;" value="<?php echo $service->service_id;?>" name="service_id">
                                    <?php
    	                				if($service_history == null){
    	                			?>
    	                				
    	                				
    	                				<?php
    	                				}elseif ($service_state_lang->template == 'received_by_customer_in_store' || $service_state_lang->template == 'received_by_customer') {
    	                					?>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile" style="top:-45px;color: rgb(32,97,103);">
    		                					<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile gotham-medium warranty-icon">
    				                				<span>
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/status-green.png" style="width: 22px;">
    				                				</span>		                				
    			                				</span>
    			                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Status Terakhir Service</span>
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text gotham-medium">
    			                					    <?php echo \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one()->text; ?>
    			                			
    			                					</span>
    			                				</span>
    		                				</div>
    		                			
    	                				<?php
    	                				}elseif ($service_state_lang->template != 'awaiting_for_confirmation' && $service_state_lang->template != 'received_by_customer' && $service_state_lang->template != 'received_by_customer_in_store' && $service_state_lang->template != 'payment_accepted') {
    	                					?>
    	                				   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile" style="top:-45px;color: rgb(160,29,34);">
    		                					<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile gotham-medium warranty-icon">
    				                				<span>
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/status-red.png" style="width: 22px;">
    				                				</span>		                				
    			                				</span>
    			                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Status</span>
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text gotham-medium">
    			                					    <?php echo \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one()->text; ?>
    			                			
    			                					</span>
    			                				</span>
    		                				</div>
    		                				
    	                						
    	                					<?php
    	                				}elseif($service_state_lang->template == 'awaiting_for_confirmation'){
    	                					?>
    	                					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile" style="top:-45px;color: rgb(160,29,34);">
    		                					<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile gotham-medium warranty-icon">
    				                				<span>
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/status-red.png" style="width: 22px;">
    				                				</span>		                				
    			                				</span>
    			                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Status</span>
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text gotham-medium"><?php echo $service_detail->service_detail_drop_store_id == 153 ? 'Menunggu Bukti Pengiriman':'Menunggu Produk Tiba Di Store'; ?></span>
    			                				</span>
    		                				</div>
    	                					<?php
    	                				}elseif($service_state_lang->template == 'payment_accepted'){
    	                					?>
    	                					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 clearleft clearright clearleft-mobile clearright-mobile" style="top:-45px;color: rgb(32,97,103);">
    		                					<span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile gotham-medium warranty-icon">
    				                				<span>
    				                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/status-green.png" style="width: 22px;">
    				                				</span>		                				
    			                				</span>
    			                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Status</span>
    			                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text gotham-medium">
    			                					    <?php echo \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history->service_state_lang_id])->one()->text; ?>
    			                			
    			                					</span>
    			                				</span>
    		                				</div>
    	                					<?php
    	                				}
    	                				?>
    	                				    
    	                				
    	                		</div>
    	                		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 clearleft clearright clearleft-mobile clearright-mobile card-right" style="padding-top: 15px;">
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                				<?php
    	                					$product_image = \backend\models\ProductImage::find()->where(['product_id'=>$order_detail_warranty->orderDetail->product_id])->andWhere(['cover'=>1])->one();
    	                					 
    	                				?>
    	                				<img src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product_image->product_image_id;?>/<?php echo $product_image->product_image_id;?>_medium.jpg" style="width: 100%;border-radius: 5px;">
    	                			</div>
    
    	                			<?php
 
                                        $now = new DateTime();
    									$ref = new DateTime($order_detail_warranty->warranty->warranty_expired_date);
    									$diff = $now->diff($ref);
    									$different = $diff->format("%r%a");
    
    	                			?>
    	                			<?php if($different > 0){ ?>
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text-warranty box-shadow-smooth" style="text-align: center;background-color: #fff;margin-top: 10px;border-radius: 2px;">
    	                				Sisa Waktu Garansi
    	                			</div>
    	                			
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile fcolor69" style="font-size: 22px;text-align: center;margin-top: 3px;font-family:gotham-white;">
    
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 4px;">
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
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;padding-left: 2px;">
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
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 4px;">
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
    	                			    
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 4px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                    	                						Tahun
                    	                					</div>
                    	                				</div>
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-right: 2px;padding-left: 2px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                    	                						Bulan
                    	                					</div>
                    	                				</div>
                    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="padding-left: 4px;">
                    	                					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text-warranty bgcolorblue box-shadow-smooth fcolorfff" style="border-radius: 0 0 5px 5px;">
                    	                						Hari
                    	                					</div>
                    	                				</div>
    	                			</div>
                                    <?php }else{ ?>
                                        <img src="<?php echo Yii::$app->params['imgixUrl'] ?>warranty/icons/icon-04.jpg?auto=compress" style="width:100%;">
                                    <?php } ?>
    	                	
    	                			<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
    	                		</div>
    	                		<?php
    	                				if($service_history == null){
    	                			?>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;">
    	                			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;z-index:2;width:33%;">
        	                			    <a data-toggle="modal" data-target="#ketentuan-content-<?php echo $order_detail_warranty->warranty->warranty_id; ?>" class="blue-round text2-warranty" id="card-action" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
        	                					<?php 
        	                						if($service == null){
        	                							echo "Ajukan Service";
        	                						}else{
        	                							if($service->service_code == ''){
        		                							echo 'Lanjutkan';
        		                						}else{
        		                							echo "Ajukan Service";
        		                						}
        	                						}
        	                						
        	                					?>
        	                			
        	                				</a>
    	                				</div>
    	                				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;z-index:2;width:33%;">
                    		                <a  data-toggle="modal" data-target="#tracking-<?php echo $service->service_id; ?>" class="grey-round text2-warranty" id="text2-warranty" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
                    		                	Lacak Status
                    		                			
                    		                </a>
            	                		</div>
                		                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;z-index:2;width:33%;">
                    		                <a  data-toggle="modal" data-target="#history-<?php echo $order_detail_warranty->warranty->warranty_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
                    		                	History
                    		                			
                    		                </a>
            	                		</div>
    	                			</div>
    	                		</div>
        	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
        	                		</div>
    	                		<?php
    	                				}elseif ($service_state_lang->template == 'received_by_customer_in_store' || $service_state_lang->template == 'received_by_customer') {
    	                					?>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
        	                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;z-index:2;width:33%;">
            	                		<a data-toggle="modal" data-target="#ketentuan-content-<?php echo $order_detail_warranty->warranty->warranty_id; ?>" class="blue-round text2-warranty" id="card-action text2-warranty" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
                		                					<?php 
                		                						if($service == null){
                		                							echo "Ajukan Service";
                		                						}else{
                		                							if($service->service_code == ''){
                			                							echo 'Lanjutkan';
                			                						}else{
                			                							echo "Ajukan Service";
                			                						}
                		                						}
                		                						
                		                					?>
                		                			
                		                </a>
            		                </div>
            		                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;z-index:2;width:33%;">
                		                <a  data-toggle="modal" data-target="#tracking-<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
                		                	Lacak Status
                		                			
                		                </a>
        	                		</div>
            		                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;z-index:2;width:33%;">
                		                <a  data-toggle="modal" data-target="#history-<?php echo $order_detail_warranty->warranty->warranty_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
                		                	History
                		                			
                		                </a>
        	                		</div>
    	                		</div>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    	                		</div>			
    	                		<?php
    	                				}elseif ($service_state_lang->template != 'awaiting_for_confirmation' && $service_state_lang->template != 'shipped_by_service_center_direct_to_customer' && $service_state_lang->template != 'received_by_customer' && $service_state_lang->template != 'received_by_customer_in_store' && $service_state_lang->template != 'awaiting_payment' && $service_state_lang->template != 'user_payment_confirmation' && $service_state_lang->template != 'payment_accepted') {
    	                					?>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
        	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;">
        	                		    <a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/details/<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="card-action" style="position:absolute;z-index:2;width:40%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
        		                						Detail Service
        		                			
        		                					</a>
        		                	
        		                					<a  data-toggle="modal" data-target="#tracking-<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="position:absolute;z-index:2;right:0;width:38%;text-align: center;float: right;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
            		                					Lacak Status
            		                			
            		                				</a>
        	                		</div>
    	                		</div>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    	                		</div>			
    	                		<?php }elseif($service_state_lang->template == 'awaiting_for_confirmation') { ?>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
        	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;">
        	                		    <?php
        	                		        if($service_detail->service_detail_drop_store_id == 153){
        	                		    ?>
        	                		    <a class="blue-round modal-blur text2-warranty" data-toggle="modal" data-target="#unggah-bukti" attr="<?php echo $service->service_id;?>" id="resi-action" style="position:absolute;z-index:2;width:58%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
        		                			Unggah Bukti Pengiriman
        		                		</a>
        		                		<?php }else{ ?>
        		                		<div class="fcolorblue warranty-text-waiting-drop">Silahkan datang ke store pilihan Anda dengan membawa produk yang akan diservis</div>
        		                		<!--<a class="blue-round text2-warranty" data-toggle="modal" data-target="#instore-<?php echo $service->service_id;?>" style="position:absolute;z-index:2;width:58%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">-->
        		                		<!--	Anda sudah di Store?-->
        		                		<!--</a>-->
        		                		<?php } ?>
        		                
        	                					<a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/details/<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="card-action" style="position:absolute;z-index:2;right:0;width:38%;text-align: center;float: right;padding-top: 8px;padding-bottom: 7px;padding-right: 0;padding-left:0;">
        		                					Detail Service
        		                			
        		                				</a>
        	                		</div>
        	                		
    	                		</div>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    	                		</div>
    	                		<?php }elseif($service_state_lang->template == 'shipped_by_service_center_direct_to_customer') { ?>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
        	                		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:55%;z-index:2;">
    	                		        <a class="blue-round text2-warranty" data-toggle="modal" data-target="#receive-<?php echo $service->service_id; ?>" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
    		                				Konfirmasi Terima Produk
    		                			</a>
    		                	    </div>
    		                	    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:23%;z-index:2;">
    		                	        <a  data-toggle="modal" data-target="#tracking-<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="right:0;width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
        		                					Lacak
        		                			
        		                		</a>
    		                	       
    		                	    </div>
    		                	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:22%;z-index:2;">
    	                				 <a  data-toggle="modal" data-target="#history-<?php echo $order_detail_warranty->warranty->warranty_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="right:0;width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
        		                					History
        		                			
        		                		</a>
    	                		    </div>
        	                		
    	                		</div>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    	                		</div>
    	                		<?php }elseif($service_state_lang->template == 'awaiting_payment') { ?>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:27%;z-index:2;">
    	                		        <a class="blue-round text2-warranty" href="<?php echo \yii\helpers\Url::base(); ?>/warranty/payment/<?php echo $service->service_id; ?>" id="pay-action" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
    		                				Bayar
    		                			</a>
    		                	    </div>
    		                	    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:35%;z-index:2;">
    		                	        <a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/details/<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="card-action" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
    		                						Detail Service
    		                			
    		                			</a>
    		                	    </div>
    		                	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:38%;z-index:2;">
    	                				<a data-toggle="modal" data-target="#tracking-<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="right:0;width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
        		                					Lacak Status
        		                			
        		                		</a> 
    	                		    </div>
    	                		 </div>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    	                		</div>
    	                		<?php }elseif($service_state_lang->template == 'user_payment_confirmation' || $service_state_lang->template == 'payment_accepted') { ?>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    	                		    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:41%;z-index:2;">
    	                		        <a class="yellow-round text2-warranty" href="<?php echo \yii\helpers\Url::base(); ?>/warranty/payment/<?php echo $service->service_id; ?>" id="pay-action" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
    		                				Lihat Bukti Bayar
    		                			</a>
    		                	    </div>
    		                	    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:35%;z-index:2;">
    		                	        <a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/details/<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="card-action" style="width:97%;text-align: center;float: left;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
    		                						Detail Service
    		                			
    		                			</a>
    		                	    </div>
    		                	    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft clearright clearleft-mobile clearright-mobile" style="height:34px;width:24%;z-index:2;">
    	                				<a  data-toggle="modal" data-target="#tracking-<?php echo $service->service_id; ?>" class="yellow-round text2-warranty" id="text2-warranty" style="right:0;width:100%;text-align: center;float: right;padding-top: 8px;padding-bottom: 7px;padding-left: 0;padding-right: 0;">
        		                					Lacak
        		                			
        		                		</a>
    	                		    </div>
    	                		</div>
    	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 15px;">
    	                		</div>
    	                		<?php } ?>
    	                		
    	                	
    	                	</div>
    	                	
    	                	
    	                	
    	                	<!-- === MODAL RECEIVE WARRANTY === -->
    	                	
    	                	<div id="receive-<?php echo $service->service_id; ?>" class="modal warranty fade" role="dialog">
                              <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">
                            
                                <!-- Modal content-->
                                <div class="modal-content bgcolor255" style="border-radius: 10px;">
                                
                                  <div class="modal-body title-warranty" style="height: 176px;margin-top:10px;padding-top:5px;">
                                  
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-medium" style="padding-bottom: 10px;padding-top: 5px;font-size:20px;text-align:center;">
                                                
                                                Penerimaan Pengembalian Produk
                                                                
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light" style="padding-bottom: 25px;padding-top: 20px;text-align:center;">
                                                Apakah Anda sudah menerima produk Anda?
                                            </div>
                                            
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearleft-mobile gotham-light">
                                        <a class="blue-round title-warranty" href="<?php echo \yii\helpers\Url::base(); ?>/warranty/receive/<?php echo $service->service_id; ?>" style="width:100%;text-align: center;float: right;text-shadow: none;">Ya</a>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearright clearright-mobile gotham-light">
                                        <a class="red-round close title-warranty" data-dismiss="modal" style="width:100%;text-align: center;float: right;text-shadow: none;font-weight:unset;line-height:unset;">Belum</a>
                                    </div>
                            
                                  </div>
                                  
                                </div>
                            
                              </div>
                            </div>
                            
                            <!-- === END MODAL === -->
                            
                            <!-- === MODAL RECEIVE WARRANTY === -->
    	                	
    	                	<div id="instore-<?php echo $service->service_id; ?>" class="modal warranty fade" role="dialog">
                              <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">
                            
                                <!-- Modal content-->
                                <div class="modal-content bgcolor255" style="border-radius: 10px;">
                                
                                  <div class="modal-body title-warranty" style="display:inline-block;margin-top:10px;padding-top:5px;">
                                  
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-medium" style="padding-bottom: 10px;padding-top: 5px;font-size:20px;text-align:center;">
                                                
                                                Konfirmasi kedatangan di Store
                                                                
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light" style="padding-bottom: 25px;padding-top: 20px;text-align:center;">
                                                Apakah Anda sudah memberikan produk Anda pada staff store?
                                            </div>
                                            
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft clearleft-mobile gotham-light">
                                        <a class="blue-round title-warranty" href="<?php echo \yii\helpers\Url::base(); ?>/warranty/dropstore/<?php echo $service->service_id; ?>" style="width:100%;text-align: center;float: right;text-shadow: none;">Ya</a>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearright clearright-mobile gotham-light">
                                        <a class="red-round close title-warranty" data-dismiss="modal" style="width:100%;text-align: center;float: right;text-shadow: none;font-weight:unset;line-height:unset;">Belum</a>
                                    </div>
                                   
                                  </div>
                                  
                                </div>
                            
                              </div>
                            </div>
                            
                            <!-- === END MODAL === -->
                            
                            <!-- === MODAL SYARAT KETENTUAN === -->
    	                	
    	                    
                            <div id="ketentuan-content-<?php echo $order_detail_warranty->warranty->warranty_id; ?>" class="modal warranty fade" role="dialog">
                                <div class="modal-dialog konten" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">
            
                                    <?php
                
                                    echo Yii::$app->view->renderFile('@app/views/warranty/ketentuan_content.php', array("id" => $order_detail_warranty->warranty->warranty_id ));
                                    ?>
                                
                                  </div>
                            </div>
                            
                            <!-- === END MODAL === -->
    	                	
                            
    	                	<!-- === MODAL HISTORY WARRANTY ===-->
    	                	<div id="history-<?php echo $order_detail_warranty->warranty->warranty_id; ?>" class="modal warranty fade" role="dialog">
    	                	    <?php
    	                			    $service_detail_history = \backend\models\ServiceDetail::find()->where(['order_detail_warranty_id'=>$order_detail_warranty->order_detail_warranty_id])->groupBy('service_id')->orderBy('service_id DESC')->all();
    	                			    $service_history_total = 0;
    	                			// 	$service = \backend\models\Service::find()->where(['service_id'=>$service_detail->service_id])->orderBy('service_id DESC')->one();
    	                			// 	$service_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service->service_history_id])->orderBy('service_history_id DESC')->one();
                                    ?>
                              <div class="modal-dialog warranty">
                            
                                <!-- Modal content-->
                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                                             History
                                        </span>
                                    </div>
    
                                  </div>
                                  <div class="modal-body" style="height: 500px;width:100%;overflow-y:scroll;">
                                    
                                  <hr style="margin-top: 0px;margin-bottom: 5px;border-top: 1px solid rgb(151,151,151);">
                                  
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
                                      <?php if($service_detail_history != null){?>
                                          <?php foreach($service_detail_history as $service_detail_){ ?>
                                            <?php 
                                                $service_ = \backend\models\Service::find()->where(['service_id'=>$service_detail_->service_id])->andWhere(['<>','service_history_id',0])->one(); 
                                                $service_history_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service_->service_history_id])->one(); 
                                            ?>
                                            <?php
                                                if($service_ != null){
                                                    $service_history_total++;
                                            ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="background-color:rgb(237,238,240);border-radius:5px;padding-bottom:10px;">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="detail_history_warranty(<?php echo $service_->service_id; ?>)" style="cursor:pointer;">
                                                    <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile" style="margin-top:9px;"><?php echo date('d/m/Y', strtotime($service_->service_date_add)); ?> - <?php echo date('d/m/Y', strtotime($service_history_history->date_add)); ?></span>
                                                    <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile" style="margin-top:9px;"><img id="detail-history-down-<?php echo $service_->service_id; ?>" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-arrow-grey.png" style="float:right;"></span>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 4px;margin-bottom: 10px;border-top: 1px solid rgb(151,151,151);"></span>
                                                </div>
                                                
            					                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text2-warranty" style="padding-bottom: 15px;">
    	                				
            		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
            			                				<span>Jenis Perbaikan</span>
            			                				<span style="margin-left: 10px;">
            			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting.png" style="width: 20px;">
            			                				</span>
            		                				</span>
            		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
            		                				<?php 
            					                        $service_detail2 = \backend\models\ServiceDetail::find()->where(['order_detail_warranty_id'=>$order_detail_warranty->order_detail_warranty_id])->andWhere(['service_id'=>$service_detail_->service_id])->all();
            					                    ?>
            		                				<?php
            		                					$serv_i = 1;
            		                					$serv_length = count($service_detail2);
            		                					foreach ($service_detail2 as $service_detail2_) {
            		                					    $service_type_store = \backend\models\ServiceTypeStore::find()
                                                            ->joinWith([
                                                                "serviceType",
                                                            ])
                                                            ->where(['service_type_store.service_type_store_id' => $service_detail2_->service_type_store_id])
                                                            ->one();
                                                    
            		                						if($serv_length == $serv_i){
            		                							echo $service_type_store->serviceType->service_type_name;
            		                						}else{
            		                							echo $service_type_store->serviceType->service_type_name.', ';
            		                						}
            		                						
            
            		                						$serv_i++;
            		                					}
            		                				?>
            		                				</span>
            		                				
            		                			</div>
            					                
            					                <div style="display:none;" id="detail-history-warranty-<?php echo $service_->service_id; ?>">
            					                    <?php
            					                        $store_history = \backend\models\Stores::find()->where(['store_id'=>$service_detail_->service_detail_drop_store_id])->one();
            					                    ?>
            					                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text2-warranty" style="padding-bottom: 15px;">
    	                				
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
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
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $store_history->store_name; ?></span>
                		                				</span>
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                
                		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
                			                				<span>
                			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 20px;">
                			                				</span>		                				
                		                				</span>
                		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Alamat Store</span>
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($store_history->store_address); ?></span>
                		                				</span>
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                
                		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
                			                				<span>
                			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 20px;">
                			                				</span>		                				
                		                				</span>
                		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Kontak Store</span>
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $store_history->store_contact_number; ?></span>
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
                		                						$service_lang = \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history_history->service_state_lang_id])->one();
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
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($service_->service_code); ?></span>
                		                				</span>
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                
                		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
                			                				<span>
                			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
                			                				</span>		                				
                		                				</span>
                		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text">Bukti Pengiriman</span>
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile"></span>
                		                				</span>
                		                				<?php
                		                					if($service_->customer_shipping_number_image != ''){
                		                						?>
                		                						<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height: 181px;background-color: #fff;border-radius: 5px;margin-top: 8px;background-image: url('<?php echo \yii\helpers\Url::base(); ?>/img/warranty/service/uploads/customer-resi/<?php echo $service_->customer_shipping_number_image;?>');background-size: cover;">
                		                					
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
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text">Rp. <?php echo common\components\Helpers::getPriceFormat($service_->service_fee + $service_->service_fee_unique_code); ?></span>
                		                				</span>
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                		                				
                		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
                			                				<span>
                			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting.png" style="width: 20px;">
                			                				</span>		                				
                		                				</span>
                		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Keterangan Perbaikan</span>
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($service_->sc_notes); ?></span>
                		                				</span>
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                		                			</div>
                	                				<?php if($service_->sc_drop_store_id != 0){?>
                		                			<?php
                
                		                				$drop_store = \backend\models\Stores::find()->where(['store_id'=>$service_->sc_drop_store_id])->one();
                		                			?>
                		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
                	                				
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
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
                	                				<?php } ?>
                	                				<?php if($service_->sc_shipping_carrier != ''){?>
                		                			<?php
                
                		                				
                		                			?>
                		                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 15px;">
                	                				
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
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
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo $service_->sc_shipping_carrier; ?></span>
                		                				</span>
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                
                		                				<span class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile gotham-medium" style="width: 28px;">
                			                				<span>
                			                					<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/ticket.png" style="width: 20px;">
                			                				</span>		                				
                		                				</span>
                		                				<span class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-light warranty-detail-purpose-group">
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-title">Nomor Tracking</span>
                		                					<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile warranty-details-purpose-text"><?php echo strip_tags($service_->sc_tracking_number); ?></span>
                		                				</span>
                		                				<span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile space-padding"></span>
                	                				</div>
                	                				<?php } ?>
                	                				<?php if($service_->questionnaire_respondent_id == 0 && ($service_history_history->service_state_lang_id == 33 || $service_history_history->service_state_lang_id == 19)){ ?>
                                                        <a class="blue-round close title-warranty" id="survei-modal" attrid="<?php echo $service_->service_id; ?>" attrtype="<?php echo $order_detail_warranty->warranty->warranty_id; ?>" style="width:100%;text-align: center;float: right;text-shadow: none;font-weight:unset;line-height:unset;padding:7px;">Survei</a>
                                                    <?php } ?>
            					                </div>
            					                
                                            </div>
                                            
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top:15px;"></div>
                                          <?php     }
                                                }
                                                if($service_history_total == 0){
                                                    ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="background-color:rgb(237,238,240);border-radius:5px;text-align:center;padding-top: 15px;padding-bottom: 15px;">
                                                            <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                        					                		Tidak Ada History Untuk Garansi Ini
                        					                </span>
                                                        </div>
                                                    <?php
                                                }
                                                
                                                ?>
                                        <?php }else{ ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="background-color:rgb(237,238,240);border-radius:5px;text-align:center;padding-top: 15px;padding-bottom: 15px;">
                                                <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
            					                		Tidak Ada History Untuk Garansi Ini
            					                </span>
                                            </div>
                                        <?php } ?>
                                  </div>
                                    
                                  </div>
                                  <div class="modal-footer" style="padding:8px;"></div>
                                </div>
                            
                              </div>
                            </div>
                            
                            <!-- === END MODAL === -->
                            
                            <!-- === MODAL TRACKING PROCCESS WARRANTY ===-->
    	                	<div id="tracking-<?php echo $service->service_id; ?>" class="modal warranty fade" role="dialog">
    	                	    <?php
    	                			    $service_detail_history = \backend\models\ServiceDetail::find()->where(['order_detail_warranty_id'=>$order_detail_warranty->order_detail_warranty_id])->groupBy('service_id')->orderBy('service_id DESC')->all();
    	                			    $service_history_total = 0;
    	                			// 	$service = \backend\models\Service::find()->where(['service_id'=>$service_detail->service_id])->orderBy('service_id DESC')->one();
    	                			// 	$service_history = \backend\models\ServiceHistory::find()->where(['service_history_id'=>$service->service_history_id])->orderBy('service_history_id DESC')->one();
                                    ?>
                              <div class="modal-dialog warranty" style="z-index:20000;">
                            
                                <!-- Modal content-->
                                <div class="modal-content" style="border-radius: 5px;opacity: 1;background-color: #fff;">
                                  <div class="modal-body" style="padding-top: 15px;width:100%;">
                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 11px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/cross-out.png" style="width: 16px;"> </button>
                                     <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                                        <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty fcolor69">
                                             Lacak Proses Service
                                        </span>
                                    </div>
    
                                  </div>
                                  <div class="modal-body" style="height: 550px;width:100%;overflow-y:scroll;">
                                    
                                  <hr style="margin-top: 0px;margin-bottom: 5px;border-top: 1px solid rgb(151,151,151);">
                                  
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
                                      <?php
                                        $service_history_all = \backend\models\ServiceHistory::find()->where(['service_id'=>$service->service_id])->all();
                                        $part_1 = 0;$part_2 = 0;$part_3 = 0;$part_4 = 0;$part_5 = 0;$part_6 = 0;$part_7 = 0;$part_8 = 0;$part_1b = 0;$part_7b = 0;
                                        $part_1_d = '-';$part_1b_d = '-';$part_2_d = '-';$part_3_d = '-';$part_4_d = '-';$part_5_d = '-';$part_6_d = '-';$part_7_d = '-';$part_7b_d = '-';$part_8_d = '-';
                                        $part_1_m = '-';$part_1b_m = '-';$part_2_m = '-';$part_3_m = '-';$part_4_m = '-';$part_5_m = '-';$part_6_m = '-';$part_7_m = '-';$part_7b_m = '-';$part_8_m = '-';
                                        
                                        foreach($service_history_all as $service_history_one){
                                            $service_state_lang_track = \backend\models\ServiceStateLang::find()->where(['service_state_lang_id'=>$service_history_one->service_state_lang_id])->one();
                                            if($service_state_lang_track->template == 'awaiting_for_confirmation'){
                                                $part_1 = 1;
                                                $part_1_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_1_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'shipped_by_customer_to_service_center' || $service_state_lang_track->template == 'shipped_by_customer_to_store' || $service_state_lang_track->template == 'dropped_by_customer_to_store'){
                                                $part_1 = 1;$part_2 = 1;
                                                $part_2_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_2_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'shipped_by_store_staff_to_service_center'){
                                                $part_1 = 1;$part_1b = 1;$part_2 = 1;
                                                $part_1b_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_1b_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'received_by_service_center'){
                                                $part_1 = 1;$part_2 = 1;$part_3 = 1;$part_1b = 1;
                                                $part_3_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_3_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'on_process_by_service_center'){
                                                $part_1 = 1;$part_2 = 1;$part_3 = 1;$part_4 = 1;$part_1b = 1;
                                                $part_4_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_4_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'user_payment_confirmation' || $service_state_lang_track->template == 'awaiting_payment'){
                                                $part_1 = 1;$part_2 = 1;$part_3 = 1;$part_4 = 1;$part_5 = 1;$part_1b = 1;
                                                $part_5_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_5_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'payment_accepted'){
                                                $part_1 = 1;$part_2 = 1;$part_3 = 1;$part_4 = 1;$part_5 = 1;$part_6 = 1;$part_1b = 1;
                                                $part_6_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_6_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'shipped_by_service_center_to_store' || $service_state_lang_track->template == 'shipped_by_service_center_direct_to_customer'){
                                                $part_1 = 1;$part_2 = 1;$part_3 = 1;$part_4 = 1;$part_5 = 1;$part_6 = 1;$part_7 = 1;$part_1b = 1;
                                                $part_7_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_7_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'items_has_been_arrived_at_store'){
                                                $part_1 = 1;$part_2 = 1;$part_3 = 1;$part_4 = 1;$part_5 = 1;$part_6 = 1;$part_7 = 1;$part_1b = 1;$part_7b = 1;
                                                $part_7b_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_7b_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                            if($service_state_lang_track->template == 'received_by_customer_in_store' || $service_state_lang_track->template == 'received_by_customer'){
                                                $part_1 = 1;$part_2 = 1;$part_3 = 1;$part_4 = 1;$part_5 = 1;$part_6 = 1;$part_7 = 1;$part_8 = 1;$part_1b = 1;$part_7b = 1;
                                                $part_8_d = date("d/m/Y", strtotime($service_history_one->date_add));
                                                $part_8_m = date("H:i", strtotime($service_history_one->date_add));
                                            }
                                        }
                                      ?>
                                      <?php
                                      if($service->paymentMethodDetail->paymentMethod->payment_method_id != 7){
                                      ?>
                                      <table>
                                          <tr>
                                              <td style="vertical-align:top;width:50px;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/warranty-card.png" style="width: 20px;">
                                                  <div class="" style="height:59px;"></div>
                                                  <?php if($service->serviceDetail->service_detail_drop_store_id != 153){ ?>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/Icon-25.png" style="width: 23px;">
                                                  <div class="" style="height:60px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
                                                  <div class="" style="height:53px;"></div>
                                                  <?php }else{ ?>
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/Icon-25.png" style="width: 23px;">
                                                    <div class="" style="height:60px;"></div>
                                                  <?php } ?>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 20px;">
                                                  <div class="" style="height:54px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting.png" style="width: 20px;">
                                                  <div class="" style="height:56px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/cost.png" style="width: 20px;">
                                                  <div class="" style="height:60px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/cost.png" style="width: 20px;">
                                                  <div class="" style="height:60px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
                                                  <div class="" style="height:58px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/Icon-33.png" style="width: 20px;">
                                              </td>
                                              <td style="vertical-align:top;width:30px;">
                                                  <div style="height:3px;"></div>
                                                  <?php if($part_1 == 1){?>
                                                  <div class="part-1-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-1-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($service->serviceDetail->service_detail_drop_store_id != 153){ ?>
                                                      <?php if($part_2 == 1){?>
                                                      <div class="part-2-green">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                      </div>
                                                      <?php }else{ ?>
                                                      <div class="part-2-gray">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                      </div>
                                                      <?php } ?>
                                                      
                                                      <?php if($part_1b == 1){?>
                                                      <div class="part-1b-green">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                      </div>
                                                      <?php }else{ ?>
                                                      <div class="part-1b-gray">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                      </div>
                                                      <?php } ?>
                                                    <?php }else{ ?>
                                                        <?php if($part_2 == 1){?>
                                                      <div class="part-2-green">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                      </div>
                                                      <?php }else{ ?>
                                                      <div class="part-2-gray">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                      </div>
                                                      <?php } ?>
                                                    <?php } ?>
                                                  
                                                  <?php if($part_3 == 1){?>
                                                  <div class="part-3-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-3-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($part_4 == 1){?>
                                                  <div class="part-4-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-4-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($part_5 == 1){?>
                                                  <div class="part-5-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-5-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($part_6 == 1){?>
                                                  <div class="part-6-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-6-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($part_7 == 1){?>
                                                  <div class="part-7-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-7-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  <?php if($part_8 == 1){?>
                                                  <div class="part-8-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-8-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  
                                              </td>
                                              <td style="vertical-align:top;" class="title-warranty">
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Pengajuan Garansi</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1_m; ?></div>
                                                  </div>
                                                  <?php if($service->serviceDetail->service_detail_drop_store_id != 153){ ?>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk diterima oleh Staff Store</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk sedang dalam perjalanan menuju Pusat Perbaikan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1b_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1b_m; ?></div>
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk dikirim oleh Pelanggan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_m; ?></div>
                                                  </div>
                                                  <?php } ?>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk diterima oleh Teknisi dan sedang dalam antrian</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_3_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_3_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk dalam proses Perbaikan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_4_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_4_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Menunggu pembayaran</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_5_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_5_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Telah dibayar</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_6_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_6_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk sedang dalam perjalanan ke pelanggan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_7_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_7_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk diterima Pelanggan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_8_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_8_m; ?></div>
                                                  </div>
                                              </td>
                                          </tr>
                                      </table>
                                      
                                      <?php }else{  ?>
                                        <table>
                                          <tr>
                                              <td style="vertical-align:top;width:50px;">
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/warranty-card.png" style="width: 20px;">
                                                  <div class="" style="height:59px;"></div>
                                                  <?php if($service->serviceDetail->service_detail_drop_store_id != 153){ ?>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/Icon-25.png" style="width: 23px;">
                                                  <div class="" style="height:60px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
                                                  <div class="" style="height:53px;"></div>
                                                  <?php }else{ ?>
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/Icon-25.png" style="width: 23px;">
                                                    <div class="" style="height:60px;"></div>
                                                  <?php } ?>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 20px;">
                                                  <div class="" style="height:54px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting.png" style="width: 20px;">
                                                  <div class="" style="height:60px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/pengiriman.png" style="width: 20px;">
                                                  <div class="" style="height:58px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/Icon-25.png" style="width: 23px;">
                                                  <div class="" style="height:60px;"></div>
                                                  <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/Icon-33.png" style="width: 20px;">
                                              </td>
                                              <td style="vertical-align:top;width:30px;">
                                                  <div style="height:3px;"></div>
                                                  <?php if($part_1 == 1){?>
                                                  <div class="part-1-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-1-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($service->serviceDetail->service_detail_drop_store_id != 153){ ?>
                                                      <?php if($part_2 == 1){?>
                                                      <div class="part-2-green">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                      </div>
                                                      <?php }else{ ?>
                                                      <div class="part-2-gray">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                      </div>
                                                      <?php } ?>
                                                      
                                                      <?php if($part_1b == 1){?>
                                                      <div class="part-1b-green">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                      </div>
                                                      <?php }else{ ?>
                                                      <div class="part-1b-gray">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                      </div>
                                                      <?php } ?>
                                                    <?php }else{ ?>
                                                        <?php if($part_2 == 1){?>
                                                      <div class="part-2-green">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                      </div>
                                                      <?php }else{ ?>
                                                      <div class="part-2-gray">
                                                          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                      </div>
                                                      <?php } ?>
                                                    <?php } ?>
                                                  
                                                  <?php if($part_3 == 1){?>
                                                  <div class="part-3-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-3-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($part_4 == 1){?>
                                                  <div class="part-4-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-4-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                               
                                                  
                                                  <?php if($part_7 == 1){?>
                                                  <div class="part-7-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-7-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($part_7b == 1){?>
                                                  <div class="part-7b-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-7b-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  <?php if($part_8 == 1){?>
                                                  <div class="part-8-green">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-green-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-green-16.png" style="display:block;">
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div class="part-8-gray">
                                                      <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/line-gray-62.png" style="margin-left:7px;display:block;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/circle-gray-16.png" style="display:block;">
                                                  </div>
                                                  <?php } ?>
                                                  
                                                  
                                              </td>
                                              <td style="vertical-align:top;" class="title-warranty">
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Pengajuan Garansi</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1_m; ?></div>
                                                  </div>
                                        
                                                  <?php if($service->serviceDetail->service_detail_drop_store_id != 153){ ?>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk diterima oleh Staff Store</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk sedang dalam perjalanan menuju Pusat Perbaikan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1b_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_1b_m; ?></div>
                                                  </div>
                                                  <?php }else{ ?>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk dikirim oleh Pelanggan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_2_m; ?></div>
                                                  </div>
                                                  <?php } ?>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk diterima oleh Teknisi dan sedang dalam antrian</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_3_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_3_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk dalam proses Perbaikan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_4_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_4_m; ?></div>
                                                  </div>
                                                  
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk sedang dalam perjalanan menuju store</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_7_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_7_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk sudah tiba di store</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_7b_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_7b_m; ?></div>
                                                  </div>
                                                  <div style="height:78px;">
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-medium">Produk telah dibayar dan diterima Pelanggan</div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_8_d; ?></div>
                                                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 gotham-light"><?php echo $part_8_m; ?></div>
                                                  </div>
                                              </td>
                                          </tr>
                                      </table>
                                      <?php } ?>
                                  </div>
                                    
                                  </div>
                                  <div class="modal-footer" style="padding:8px;"></div>
                                </div>
                            
                              </div>
                            </div>
                            
                            <!-- === END MODAL === -->
    	                	
    	                </div>
    	                
    	            </div>
    	            <?php $i++; ?>
    	            <?php
    	            	if($i == 2){
    	            		echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile"></div>';
    	            		$i = 0;
    	            	}
    	            ?>
    	            
	     		<?php 
	     		    } 
	            }    
	     		?>
	     		
	     		
	            <div class="col-lg-6 col-md-10 col-sm-10 col-xs-12 clearleft clearright  <?php if($i==0){ echo 'p75right';}else{ echo 'p75left';} ?> fcolor69" style="letter-spacing: 0.5px;margin-top: 15px;">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light box-shadow bradius5 warranty-input" style="">
	                		<div style="margin-top: 22%;margin-bottom: 20%;">
	                			<a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/create">
	                				<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/add.png" style="position: absolute;left: 0;right: 0;margin: auto;">
	                			</a>
	                			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light fcolorblue" style="text-align: center;margin-top: 140px;">Input kartu garansi</div>
	                		</div>
	                		
	                	</div>
	                   
	                </div>
	                
	            </div>
	            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" style="padding-top: 15px;"></div>
	            <div class="col-lg-6 hidden-md hidden-sm hidden-xs clearleft clearright fcolor69" style="letter-spacing: 0.5px;padding-right: 7.5px;">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light bgcolorblue" style="padding: 11px 10px 11px 20px;border-radius: 25px;">
	                		<div class="col-xs-7 clearright-mobile clearleft-mobile" style="color: #fff;font-size: 14px;letter-spacing: 0.2px;">Cara Input Kartu Garansi Digital</div> 
	                		<span class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition-white.png" style="width: 24px;margin-left: 10px;">
                                    </span>
	                		<span class="col-xs-2 clearright clearright-mobile"><a data-toggle="modal" data-target="#how-to-input" class="modal-blur"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/info.png" id="cara-claim" style="width: 20px;position: absolute;right: 0;"></a></span>
	                	</div>
	                   
	                </div>
	                
	            </div>
	            
	            <div id="survei-content" class="modal warranty fade" role="dialog">
                    <div class="modal-dialog warranty survei" style="vertical-align: middle;">
                        <!-- Modal content-->
                        <div class="modal-content bgcolor255" id="survei-content2" style="border-radius: 10px;">
                        
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
<script src="<?php echo \yii\helpers\Url::base(); ?>/js/custom-file-input.js"></script>
<style type="text/css">
	.modal.warranty:before{
	    height:0%;
	}
	.space-padding{
	 	padding-top: 15px;
	 }
	.p75right{
		padding-right: 7.5px;
	}
	.p75left{
		padding-left: 7.5px;
	}
	hr.time-seperate{
		position: absolute;top: 15px;border-top: solid 1px rgb(193,185,179);width: 100%;margin-top: 0;margin-bottom: 0;
	}
	.card-left{
		width: 62% !important;
		/*min-height: 296px;*/
	}
	.card-right{
		width: 38% !important;
	}
	.bgcolorgray{
		background-color: rgb(193,185,179);
	}
	.warranty-input{
        height: 391px;
    }
    a.grey-round {
        float: right;
        border: 1px solid rgb(193,185,179);
        cursor: pointer;
        border-radius: 20px;
        padding: 10px;
        padding-left: 20px;
        padding-right: 20px;
        letter-spacing: 1.5px;
        font-size: 12px;
        background: rgb(193,185,179);
        color: #fff;
    }
    .modal-dialog.survei{
      width:420px;
    }
    .modal-dialog.konten{
      width:490px;
    }
	@media only screen and (max-width : 767px) and (min-width : 371px) {
	    .modal-dialog.survei,.modal-dialog.konten{
          width:362px;
        }
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
        .p75right {
            padding-right: 15px;
        }
        .p75left{
    		padding-left: 15px;
    	}
    	.rating-stars ul > li.star{
    	    width:34px;
    	}
    }
     @media only screen and (max-width : 370px) and (min-width : 351px) {
	    .modal-dialog.survei,.modal-dialog.konten{
          width:330px;
        }
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
        .p75right {
            padding-right: 15px;
        }
        .p75left{
    		padding-left: 15px;
    	}
    	.rating-stars ul > li.star{
    	    width:34px;
    	}
    }
    @media only screen and (max-width : 350px) {
	    .modal-dialog.survei,.modal-dialog.konten{
          width:315px;
        }
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
        .p75right {
            padding-right: 15px;
        }
        .p75left{
    		padding-left: 15px;
    	}
    	.rating-stars ul > li.star{
    	    width:34px;
    	}
    }
    @media only screen and (min-width : 768px) and (max-width : 1024px) {
        .p75right {
            padding-right: 0px;
        }
        .p75left{
    		padding-left: 0px;
    	}
    }
    @media only screen and (max-width : 1281px) {
        .warranty-input{
            height: 380px;
        }
    }
</style>