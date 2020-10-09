
<section id="shopping-bag" style="padding-top: 20px;">
    <div class="container">
        <div class="row">
            <?php echo Yii::$app->view->renderFile('@app/views/user/_leftmenu.php', array()); ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 clearleft clearright fcolor69 title-warranty" style="padding-left: 10px;padding-right: 10px;letter-spacing: 0.5px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-medium">
                    
                <span class="col-lg-10 col-md-10 col-sm-10 col-xs-5 clearleft clearright clearleft-mobile clearright-mobile">
                                 Syarat & Ketentuan   
                                    </span>
                    <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft clearright clearleft-mobile clearright-mobile">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/warranty/icons/term_n_condition.png" style="width: 24px;">
                                    </span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                    <hr style="margin-top: 10px;margin-bottom: 15px;">
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
                
                
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 clearleft clearright gotham-light check-agree" style="height: 30px;margin-top:3px;">
              
      
                   <label class="control control--checkbox" style="">
                    <input type="checkbox" id="agreement" name="term-condition">

                    <div class="control__indicator"></div>
                  </label>

              
                </div>
                <style>
                    @media only screen and (max-width: 415px) {
                        .check-agree{
                            width:45px;
                        }
                    }
                </style>
           
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright gotham-light" style="">
                    <div class="agreement-error" style="display: none;margin-top:0;">
                        <span id="agreement-error" class="gotham-light" style="font-size: 12px;font-style: italic;padding-left: 0;color:red;">* Silahkan pilih Setuju dengan Syarat & Ketentuan</span>
                    </div>
                    
                    <span  class="gotham-light" style="font-size: 12px;font-size: 12px;font-style: italic;">Saya telah membaca dan menyetujui segala syarat ketentuan berlaku di The Watch Co.</span>
                </div>
                <input id="id_warranty" style="display:none;" value="<?php echo $id;?>">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light">
                    <a class="grey-round title-warranty" id="warranty-term-condition" style="width:100%;text-align: center;float: right;padding-top: 14px;padding-bottom: 11px;">Setuju</a>
                </div>
                
                <div class="hidden-lg col-md-12 col-sm-12 hidden-xs" style="padding-top:90px;"></div>
            </div>
            
        </div>
    </div>
</section>
<script type="text/javascript">
   
</script>
<style type="text/css">
   
    a.grey-round{
        background-color: rgb(193,185,179);
        color:#fff;
       
        border-radius: 25px;
    }
    a.grey-round:hover{
        background-color: #fff;
        color:rgb(193,185,179);
        
        border-radius: 25px;
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
.control--checkbox .control__indicator:after,.control--checkbox .control__indicator:before {
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