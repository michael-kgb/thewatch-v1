<style type="text/css">
  .modal-backdrop.in {
      opacity: 0.7;
  }
  .close{
    opacity: 1;
  }
  .modal-dialog.warranty{
      width:415px;
      margin-left: auto;
      margin-right: auto;
  }
  .fa.fa-pencil{
    position: absolute;
    z-index: 1;
    top: 0;
    right: 0;
  }
  .modal.warranty {
  text-align: center;
  padding: 0!important;
}

.modal.warranty:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog.warranty {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
  .@media only screen and (max-width : 768px) {
      
  }
</style>
<?php

        $customerInfo = $_SESSION["customerInfo"];

        $customer_address = \backend\models\CustomerAddress::find()->where(['customer_id'=>$_SESSION["customerInfo"]['customer_id']])->andWhere(['set_as_default'=>1])->one();

        if($customer_address == null){
          $customer_address = \backend\models\CustomerAddress::find()->where(['customer_id'=>$_SESSION["customerInfo"]['customer_id']])->one();
        }
?>
<div id="agreement-modal" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Syarat dan Ketentuan
                          </span>
                          <span class="clearleft clearright clearright-mobile gotham-medium">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition.png" style="width: 24px;margin-left: 10px;">
                          </span>
                          
                        </div>
                        
      </div>
      <div class="modal-body title-warranty" style="height: 500px;margin-top:10px;padding-top:5px;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <hr style="margin-top: 0px;margin-bottom: 5px;border-top:1px solid rgb(69,69,69);">
        </div>
      
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-medium" style="padding-bottom: 10px;">
                    
                    Ketentuan Garansi:
                                    
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light" style="padding-bottom: 10px;">
                    Garansi baterai berlaku seumur hidup (lifetime warranty) sejak tanggal pembelian. Garansi kerusakan hanya berlaku khusus untuk mesin, dan pengerjaannya dapat memakan waktu 14 hari kerja (Sabtu, Minggu & libur nasional tidak terhitung). Untuk mengajukan klaim, silahkan kunjungi store The Watch Co. terdekat dengan membawa kartu garansi resmi dari PT. Kami Gawi Berjaya dan nota pembelian yang asli.
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light" style="padding-bottom: 15px;">
                    Service diluar garansi mesin dan baterai dapat dilakukan, namun akan dikenakan biaya sparepart (jika ada) dengan harga khusus. Teknisi kami akan menghubungi Anda melalui telepon untuk konfirmasi biaya (jika ada), oleh karena itu mohon untuk mencantumkan nomor telepon yang dapat dihubungi. Teknisi kami tidak dapat melakukan service diluar garansi mesin dan baterai, jika biaya service belum disetujui oleh customer.
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light" style="padding-bottom: 10px;">
                    
                    <hr style="margin-top: 5px;margin-bottom: 5px;">
                </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                    <a class="blue-round close title-warranty" data-dismiss="modal" style="width:30%;text-align: center;float: right;padding-top: 14px;padding-bottom: 11px;text-shadow: none;">Setuju</a>
                </div>

      </div>
      
    </div>

  </div>
</div>

<div id="how-to-input" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Cara Klaim Garansi Digital
                          </span>
                          <span class="clearleft clearright clearright-mobile gotham-medium">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition.png" style="width: 24px;margin-left: 10px;">
                          </span>
                          
                        </div>
                        
      </div>
      <div class="modal-body title-warranty" style="padding-left:0;padding-right:0;margin-top:10px;padding-top:5px;">
        
      <hr style="margin-top: 0px;margin-bottom: 5px;margin-left:15px;margin-right:15px;border-top:1px solid rgb(69,69,69);">
      <ol>
        	<li>Masuk ke Website www.thewatch.co</li>
        	<li>Klik menu Akun Saya</li>
        	<li>Garansi & Service Saya</li>
        	<li>Input Kartu Garansi Baru (Skip Jika telah input)</li>
        	<li>Ajukan Garansi</li>
        	<li>Setujui Syarat & Ketentuan</li>
        	<li>Pilih Jenis Perbaikan</li>
        	<li>Upload Foto kondisi Jam</li>
        	<li>Pilih Lokasi garansi</li>
        	<li>Kirim barang Anda ke Lokasi yang Anda   pilih atau drop langsung ke store       terdekatsekitar Anda.</li>
        	<li>Konfirmasi</li>
        	<li>Upload bukti pengiriman</li>
        	<li>Selesai</li>
        </ol>
      </div>
    </div>
    
  </div>
</div>

<div id="how-unique-code" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium">
                            Letak Kode Produk
                          </span>
                
                        </div>
                        
      </div>
      <div class="modal-body" style="min-height: 235px;margin-top:10px;padding-top:5px;">
        
      <hr style="margin-top: 0px;margin-bottom: 5px;border-top:1px solid rgb(69,69,69);">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
          <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/unique_code.png" style="width: 100%;">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile" style="text-align: center;">
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 clearleft clearright clearleft-mobile clearright-mobile title-warranty" style="text-align: center;">
          Perhatikan kode garansi Anda pada kotak atau jam Anda
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile" style="text-align: center;">
        </div>
      </div>
      
    </div>

  </div>
</div>

<div id="how-to-upload" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty hidden-lg hidden-md">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Bentuk Jam Tangan
                          </span>
                
                        </div>
      </div>
      <div class="modal-body" style="margin-top:10px;padding-top:5px;">
        
      <hr style="margin-top: 0px;margin-bottom: 5px;border-top:1px solid rgb(69,69,69);">
          <img src="<?php echo Yii::$app->params['imgixUrl'] ?>warranty/icons/watch-view.png?auto=compress" style="width: 100%;">
      </div>
      
    </div>

  </div>
  <div class="modal-dialog warranty hidden-xs hidden-sm" style="width:700px;">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Bentuk Jam Tangan
                          </span>
                
                        </div>
      </div>
      <div class="modal-body" style="margin-top:10px;padding-top:5px;">
        
      <hr style="margin-top: 0px;margin-bottom: 5px;border-top:1px solid rgb(69,69,69);">
          <img src="<?php echo Yii::$app->params['imgixUrl'] ?>warranty/icons/watch-view-landscape.jpg?auto=compress" style="width: 100%;">
      </div>
      
    </div>

  </div>
</div>

<div id="preview-download" class="modal warranty fade" role="dialog">
  <div class="modal-dialog preview-alamat">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;opacity: 1;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
         <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Isi Alamat Pengirim
                          </span>
                          <span class="clearleft clearright clearright-mobile gotham-medium">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="padding-left: 5px;width: 22px;">
                          </span>
                          
                        </div>
      </div>
      <div class="modal-body" style="display:inline-block;margin-top:10px;padding-top:5px;">
        
      <hr style="margin-top: 0px;margin-bottom: 5px;border-top: 1px solid rgb(69,69,69);">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 3px;padding-bottom: 7px;">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty">
                            Isi Data Anda
                          </span>
                          <span class="clearleft clearright clearright-mobile gotham-medium">
                  
                          </span>
                          
                        </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="background: rgb(255,255,255);">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile bradius5" style="height:368px;border:solid 1px rgb(69,69,69);margin:5px;width:auto;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="background-color:#000;border-radius:5px 5px 0 0;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo-putih-04.png" style="width: 110px;margin-left: 15px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/setting-white.png" style="width: 15px;margin-right: 15px;margin-top:2px;float:right;"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-warranty" style="padding-top: 15px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light" style="text-align:center;">
                    Paket Perbaikan
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="padding-top:5px;padding-bottom:5px;">
                    DARI
                </div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile text3-warranty">
              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/account-mobile.png" style="width: 11px;margin-right: 5px;vertical-align: top;">NAMA
              </div>
             
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile">
                <input class="bradius5" placeholder="Nama Pengirim" name="customer-name-warranty" id="customer-name" value="<?php echo $service->sender_name == '' ? $_SESSION["customerInfo"]['fname'] : $service->sender_name; ?>" style="width: 100%;border:solid 1px;padding-left:5px;padding-right:5px;">
                
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top:5px;">
              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 11px;margin-right: 5px;vertical-align: top;">ALAMAT
              </div>
             
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile" style="margin-top:5px;">
                <textarea class="bradius5" placeholder="Alamat Pengirim" id="customer-address" rows="4" cols="50" style="border:solid 1px;font-style: normal;padding: 0;width:100%;padding-left:5px;padding-right:5px;"><?php echo $service->sender_address == '' ? $customer_address->address1 : $service->sender_address; ?></textarea>
              
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="margin-top:5px;">
              <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/telephone.png" style="width: 11px;margin-right: 5px;vertical-align: top;">No. HP
              </div>
              
              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 clearleft clearright clearleft-mobile clearright-mobile" style="margin-top:5px;">
                <input class="bradius5" placeholder="Nomor HP Pengirim" type="" name="" id="customer-telp" value="<?php echo $service->sender_telp == '' ? $customer_address->phone : $service->sender_telp; ?>" style="width: 100%;border:solid 1px;padding-left:5px;padding-right:5px;">
             
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="position: absolute;bottom: 15px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="padding-top:10px;padding-bottom:5px;">
                    TUJUAN
                </div>
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile" style="width: 26px;">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/store.png" style="width: 14px;margin-right: 5px;vertical-align:top;"> 
              </div>
              <div id="store-name" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile gotham-medium text3-warranty" style="line-height: 18px;">
                
                  <?php echo $store->store_name; ?>
    
              </div>
    
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
    
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile" style="width: 26px;">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 14px;margin-right: 5px;vertical-align:top;"> 
              </div>    
              <div id="store-address" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="line-height: 18px;">
                <?php echo strip_tags($store->store_address); ?>
              </div>
    
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
    
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright clearleft-mobile clearright-mobile" style="width: 26px;">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/customer_service.png" style="width: 14px;margin-right: 5px;vertical-align:top;">
              </div>
              <div id="store-contact" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile text3-warranty" style="line-height: 18px;">
                <?php echo $store->store_contact_number; ?>
              </div>
            </div>
           
        </div>
      </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
          <hr style="border-top: 1px solid rgb(69,69,69);">
        </div>
                      
                      
                      
      <a id="download-warranty" class="blue-round title-warranty" style="width: 100%;font-size: 11px;float: right;text-align: center;">Unduh</a>
      </div>
      
    </div>

  </div>
</div>

<div id="unggah-bukti" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;opacity: 1;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
         <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Isi Bukti Pengiriman
                          </span>
                          <span class="clearleft clearright clearright-mobile gotham-medium">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 22px;">
                          </span>
                          
                        </div>
      </div>
      <div class="modal-body" style="height: 500px;margin-top:10px;padding-top:5px;">
        
      <hr style="margin-top: 0px;margin-bottom: 5px;border-top: 1px solid rgb(69,69,69);">
      
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-warranty" style="padding-top: 15px;">
          <label>Unggah Bukti Pengiriman</label>
          <span style="color:red;font-size: 12px;display: none;" id="error-file-resi">Silahkan unggah foto resi (Maks. 2 MB)</span>
          <span id="error-1mb" style="color: red;font-size: 12px;display: none;">
                            Ukuran foto melebihi 2 MB
                          </span>
          <span id="error-format" style="color: red;font-size: 12px;display: none;">
                            Format jenis foto harus JPEG atau PNG
                          </span>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile bradius5 bg-image-payment" style="height: 219px;background-color: rgb(240,240,240);">
                        <input style="display: none;" type="file" name="file-resi" id="file-resi" accept="image/*" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" />

                        <label for="file-resi" style="text-align: center;width: 100%;">

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="position: absolute;left: 0;right: 0;margin:auto;border-radius: 100px;height: 115px;width:115px;top:35px;">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/plus.png" style="padding-top: 20px;width: 82px;">
                          </div>
                          <div style="position: absolute;left: 0;right: 0;margin: auto;top:160px;color:rgb(69,69,69);">
                            <span></span>
                          </div>
                            
                          
                        </label>
                        
                      </div>
         
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:40px;text-align: center;padding-top: 10px;padding-bottom: 10px;">
           Atau
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            <input placeholder="Masukan Nomor Resi Pengiriman" name="nomor_resi" id="nomor-resi" value="" style="width: 100%;height:30px;border-radius:25px;background-color: #fff;border:none;padding-left: 20px;">
            <span style="color:red;font-size: 12px;display: none;padding-left: 15px;" id="error-resi">Silahkan isi nomor resi</span>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:15px;">
           
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            <input placeholder="Kurir" name="kurir" id="kurir" value="" style="width: 100%;height:30px;border-radius:25px;background-color: #fff;border:none;padding-left: 20px;">
            <span style="color:red;font-size: 12px;display: none;padding-left: 15px;" id="error-kurir">Silahkan isi nama kurir</span>
          </div>
        </div>
      </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
          <hr style="border-top: 1px solid rgb(69,69,69);">
        </div>
                      
                      
                      
      <a id="simpan-resi" class="blue-round title-warranty" style="width: 40%;font-size: 11px;float: right;text-align: center;">Simpan</a>
      </div>
      
    </div>

  </div>
  </div>
  
  <div id="unggah-bukti-pembayaran" class="modal warranty fade" role="dialog">
  <div class="modal-dialog warranty">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 10px;opacity: 1;background-color: rgb(218,216,217);">
      <div class="modal-body" style="padding-top: 15px;">
        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;top: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
         <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
                          
                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-medium title-warranty">
                            Konfirmasi Pembayaran
                          </span>
                          <span class="clearleft clearright clearright-mobile gotham-medium">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/location.png" style="width: 22px;">
                          </span>
                          
                        </div>
      </div>
      <div class="modal-body" style="height: 623px;margin-top:10px;padding-top:5px;">
        
      <hr style="margin-top: 0px;margin-bottom: 5px;border-top: 1px solid rgb(69,69,69);">
      
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-warranty" style="padding-top: 15px;">
          <label>Unggah Bukti Pembayaran</label>
          <span style="color:red;font-size: 12px;display: none;" id="error-file-resi">Silahkan unggah foto bukti (Maks. 2 MB)</span>
          <span id="error-1mb" style="color: red;font-size: 12px;display: none;position:absolute;top:0;">
                            Ukuran foto melebihi 2 MB
                          </span>
          <span id="error-format" style="color: red;font-size: 12px;display: none;position:absolute;top:0;">
                            Format jenis foto harus JPEG atau PNG
                          </span>
            <span id="error-empty" style="color: red;font-size: 12px;display: none;position:absolute;top:0;">
                            Foto harus terisi
                          </span>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile bradius5 bg-image-payment" style="height: 219px;background-color: rgb(240,240,240);">
                        <input style="display: none;" type="file" name="file-pembayaran" id="file-pembayaran" accept="image/*" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" />

                        <label for="file-pembayaran" style="text-align: center;width: 100%;">

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="position: absolute;left: 0;right: 0;margin:auto;border-radius: 100px;height: 115px;width:115px;top:35px;">
                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/plus.png" style="padding-top: 20px;width: 82px;">
                          </div>
                          <div style="position: absolute;left: 0;right: 0;margin: auto;top:160px;color:rgb(69,69,69);">
                            <span></span>
                          </div>
                            
                          
                        </label>
                        
                      </div>
         
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:20px;text-align: center;padding-top: 10px;padding-bottom: 10px;">
          
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
              <label>Pilih Metode Pembayaran</label>
	            <select style="width: 100%;height:30px;border-radius:25px;background-color: #fff;border:none;padding-left: 20px;" name="warranty_payment_detail" id="warranty-payment-detail">
                    <?php $payment_method_details = \backend\models\PaymentMethodDetail::find()->joinWith([
                                   
                                            "payment",
                                            "paymentMethod",
                                        ])->where(['payment_method_detail.store_id'=>153])->andWhere(['payment.active'=>1])->all(); ?>
            	    <?php foreach($payment_method_details as $payment_method_detail){ ?>
	        
                        <option value="<?php echo $payment_method_detail->payment_method_detail_id; ?>" id="<?php echo $payment_method_detail->paymentMethod->payment_method_name; ?>"><?php echo $payment_method_detail->paymentMethod->payment_method_name; ?></option>
                             
            	     <?php } ?>  
	            </select>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:15px;">
           
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
              <input type="hidden" name="service_id" value="<?php echo $service->service_id; ?>">
            <input placeholder="Nama Bank Pengirim" name="warranty_bank_name" id="warranty-bank-name" value="" style="width: 100%;height:30px;border-radius:25px;background-color: #fff;border:none;padding-left: 20px;">
            <span style="color:red;font-size: 12px;display: none;padding-left: 15px;position:absolute;" id="error-bank-name">Silahkan isi nama bank pengirim</span>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:15px;">
           
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            <input placeholder="Nomor Rekening" name="warranty_account_number" id="warranty-account-number" value="" style="width: 100%;height:30px;border-radius:25px;background-color: #fff;border:none;padding-left: 20px;">
            <span style="color:red;font-size: 12px;display: none;padding-left: 15px;position:absolute;" id="error-account-number">Silahkan isi nomor rekening</span>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:15px;">
           
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            <input placeholder="Nama Pemegang Kartu" name="warranty_account_name" id="warranty-account-name" value="" style="width: 100%;height:30px;border-radius:25px;background-color: #fff;border:none;padding-left: 20px;">
            <span style="color:red;font-size: 12px;display: none;padding-left: 15px;position:absolute;" id="error-account-name">Silahkan isi nama pemegang kartu</span>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="height:15px;">
           
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            <input placeholder="Nominal Angka Pembayaran" name="warranty_nominal" id="warranty-nominal" value="" style="width: 100%;height:30px;border-radius:25px;background-color: #fff;border:none;padding-left: 20px;">
            <span style="color:red;font-size: 12px;display: none;padding-left: 15px;position:absolute;" id="error-nominal">Silahkan isi jumlah nominal</span>
            <span style="color:red;font-size: 12px;display: none;padding-left: 15px;position:absolute;" id="error-nominal-format">Format Nominal Salah</span>
          </div>
        </div>
      </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
          <hr style="border-top: 1px solid rgb(69,69,69);">
        </div>
                      
                      
                      
      <a id="simpan-bukti-pembayaran" class="blue-round title-warranty" style="width: 40%;font-size: 11px;float: right;text-align: center;">Simpan</a>
      </div>
      
    </div>

  </div>
  </div>
</div>