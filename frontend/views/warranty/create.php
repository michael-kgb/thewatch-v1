<link rel="stylesheet" type="text/css" href="<?php echo \yii\helpers\Url::base(); ?>/css/component.css" />
<section id="shopping-bag" style="padding-top: 20px;">
    <div class="container">
    	<div class="row">
    	<?php echo Yii::$app->view->renderFile('@app/views/user/_leftmenu.php', array()); ?>
    		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
	            
	            
	     
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright fcolor69" style="letter-spacing: 0.5px;margin-top: 20px;">
	                <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light box-shadow" style="border-radius: 5px;">
	                	<form name="warranty-manual" id="warranty_manual" enctype="multipart/form-data" action="<?php echo \yii\helpers\Url::base(); ?>/warranty/manual" method="post">	
	                	<input value="<?php echo $customer_id; ?>" type="" name="customer_id" style="display: none;">
	                	<a href="<?php echo \yii\helpers\Url::base(); ?>/warranty/card">
	                		<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-white-24.png" style="position: absolute;top: 8px;right: 8px;width: 18px;">
	                	</a>
	                	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 gotham-medium fcolorblue" style="padding-top: 19px;padding-bottom: 17px;">
	                		Data Produk Garansi Anda
	                	</div>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
	                		<select class="warranty-select-brand"></select>
	                		<span style="color:red;font-size: 12px;display: none;padding-left: 15px;position: absolute;" id="error-select-brand">Silahkan pilih brand</span>
	                		<!-- <input type="" name="" style="width: 100%;border-color: transparent;border-radius: 25px;height: 33px;"> -->
	                	</div>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="warranty-product-list" style="margin-bottom: 20px;">
	                		<select class="warranty-select-product"></select>
	                		<span style="color:red;font-size: 12px;display: none;padding-left: 15px;position: absolute;" id="error-select-product">Silahkan pilih product</span>
	                		<!-- <input type="" name="" style="width: 100%;border-color: transparent;border-radius: 25px;height: 33px;"> -->
	                	</div>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
	                		<select class="warranty-select-store"></select>
	                		<span style="color:red;font-size: 12px;display: none;padding-left: 15px;position: absolute;" id="error-select-store">Silahkan pilih store pembelian</span>
	                		<!-- <input type="" name="" style="width: 100%;border-color: transparent;border-radius: 25px;height: 33px;"> -->
	                	</div>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="other-store" style="margin-bottom: 20px;display: none;">
	                	    
	                		<input placeholder="Nama Toko" type="" name="other_store" style="width: 100%;border: solid 1px rgb(237,237,237);border-radius: 25px;height: 33px;padding-left: 15px;background-color: rgb(237,237,237);">
	                	    
	                	</div>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
	                		<input placeholder="Kode Unik" type="" name="kode_unik" style="width: 100%;border: solid 1px rgb(237,237,237);border-radius: 25px;height: 33px;padding-left: 15px;background-color: rgb(237,237,237);">
	                		<a data-toggle="modal" data-target="#how-unique-code" class="modal-blur">
	                			<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/info-green.png" style="position: absolute;top: 7px;right: 22px;width: 20px;cursor:pointer;">
	                		</a>
	                		<span style="color:red;font-size: 12px;display: none;padding-left: 15px;position: absolute;" id="error-code-unique"></span>
	                	</div>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
	                	    
	                		<input placeholder="Nomor Invoice" type="" name="nomor_invoice" style="width: 100%;border: solid 1px rgb(237,237,237);border-radius: 25px;height: 33px;padding-left: 15px;background-color: rgb(237,237,237);">
	                	    <span style="color:red;font-size: 12px;display: none;padding-left: 15px;position: absolute;" id="error-invoice-d">Silahkan isi nomor invoice dan unggah foto</span>
	                	</div>

	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px;">
	                		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile bradius5 bg-image-input" style="height: 219px;background-color: rgb(237,237,237);">
	                			<input style="display: none;" type="file" name="file-2" id="file-2" class="inputfile inputfile-4" accept="image/*" data-multiple-caption="{count} files selected" />

												<label for="file-2" style="text-align: center;width: 100%;">

													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="position: absolute;left: 0;right: 0;margin:auto;border-radius: 100px;height: 115px;width:115px;top:35px;background-color: transparent;border:solid 1px rgb(69,69,69);">
														<img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/camera.png" style="padding-top: 40px;width: 42px;">
													</div>
													<div style="position: absolute;left: 0;right: 0;margin: auto;top:160px;color:rgb(69,69,69);">
														<span>Unggah Foto Invoice (Maksimal 2 MB)</span>
														<span style="color:red;font-size: 12px;display: none;padding-left: 15px;position: absolute;text-align: center;width: 100%;" id="error-format">Format file unggah harus png atau jpg</span>
													</div>
														
													
												</label>
												
	                		</div>
	                	</div>
	                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light" style="margin-top: 10px;">
		                    <a class="blue-round default" id="create-warranty">Input</a>
		                </div>
		                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light new-line"></div>
	                	</form>		                		
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
<script type="text/javascript">
   var dats = '<?php echo json_encode($brands); ?>';
   var store_datas = '<?php echo json_encode($stores); ?>';
</script>
<style type="text/css">
   
    span.select2-selection__arrow{
        top:5px !important;right:5px !important;
    }
	.bgcolorgray{
		background-color: rgb(193,185,179);
	}
	.select2-container .select2-selection--single {
	    height: 35px !important;
	    border-radius: 25px;
	    
	}
	.select2-container--default .select2-selection--single {
        background-color: rgb(237,237,237);
         border: none; 
        border-radius: 25px;
    }
	.select2-container--default .select2-selection--single .select2-selection__rendered{
		line-height: 33px;
		padding-left: 15px;
	}
	::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
	    color: #999;
	    opacity: 1; /* Firefox */
	    font-size: 14px;
	}

	:-ms-input-placeholder { /* Internet Explorer 10-11 */
	    color: #999;
	}

	::-ms-input-placeholder { /* Microsoft Edge */
	    color: #999;
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
            font-size: 11px;
            background: #1d6068;
            color: #fff;
            /* width: 10%; */
        }
    }
</style>
<script src="<?php echo \yii\helpers\Url::base(); ?>/js/custom-file-input.js"></script>