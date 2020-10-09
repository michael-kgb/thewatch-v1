
<div class="kontes-banner" style="left: 0;right: 0;position:relative;">
        		<img src="<?php echo \yii\helpers\Url::base();?>/img/event/blog-desktop.jpg" class="img-responsive hidden-xs" style="display: block;margin: auto;">
        		<img src="<?php echo \yii\helpers\Url::base();?>/img/event/blog-mobile.jpg" class="img-responsive hidden-lg hidden-md hidden-sm" style="display: block;margin: auto;">
        		
        		<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearright clearleft center gotham-medium kontes-button" style="position:absolute;font-size: 2em;color:#fff;top:120px;letter-spacing:2px;">
            	    Blog Competition 2018
            	</div>
            	<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearright clearleft center gotham-medium kontes-button" style="position:absolute;font-size: 1.2em;color:#fff;top:70px;letter-spacing:2px;">
            	    Blog Competition 2018
            	</div>

        	</div>
<style type="text/css">


</style>
<section class="ptop1">
    <div class="container">
		<div class="row">
            <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright pbottom5 salebrandbannerview">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ptop2 remove-padding clearleft clearright ">
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/watchsale">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/Watches (Jembatan).jpg' class="img-responsive">
                        </a>
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6 ptop2 col-xs-6 remove-padding-right padding-left-1-5'>
                        <a href="<?php echo \yii\helpers\Url::base(); ?>/accessoriesale">
                            <img src='<?php echo \yii\helpers\Url::base(); ?>/img/promo/endsale/Essentials (Jembatan).jpg' class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>-->
        </div>
		
		
		<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 h2 pendaftaran">FORMULIR PENDAFTARAN</div>
		<div class="col-sm-3"></div>
		</div>
		
		<?php if(isset($message)){  ?>
		<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6"><?php echo $message; ?></div>
		<div class="col-sm-3"></div>
		</div>
		<?php } ?>
		
		<div class="row">
		<div class="col-sm-3"></div>
		
			<form method="POST" action="<?php echo \yii\helpers\Url::base(); ?>/blog-competition/daftar" class="col-sm-6">
			
			  <div class="col-sm-12">
			  <div class="form-group">
				<label for="nama">Nama Lengkap</label>
				<input type="text" class="form-control" name="nama" required>
			  </div>
			  </div>
			  <div class="col-sm-6">
			  <div class="form-group">
				<label for="nohp">No. hp</label>
				<input type="text" class="form-control" name="nohp" required onkeypress="return hanyaAngka(event)">
				<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
			  </div>
			  </div>
			  <div class="col-sm-6">
				<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" name="email" type="email" required>
			  </div>
			  </div>
			  <div class="col-sm-12">
			  <div class="form-group">
				<label for="alamat">Alamat</label>
				<textarea class="form-control" rows="5" name="alamat"  required></textarea>
			  </div>
			  </div>
			  <div class="col-sm-12">
			  <div class="form-group">
				<label for="urlkontes" >URL Artikel Lomba</label>
				<input type="text" class="form-control" name="urlkontes" required value="http://">
			  </div>
			  </div>
			 <div class="col-sm-6">
			  <div class="form-group">
				<label for="facebook">Facebook</label>
				<input type="text" class="form-control" name="facebook">
			  </div>
			  </div>
			  <div class="col-sm-6">
			  <div class="form-group">
				<label for="instagram">Instagram</label>
				<input type="text" class="form-control" name="instagram">
			  </div>
			  </div>
			  <div class="col-sm-6">
			  <div class="" style="padding-top: 15px">
			  <button onclick="goBack()" class="btn btn-primary">BACK</button>
			<script>
			function goBack() {
			window.history.back();
			}
			</script>
			  </div>
			  </div>
			  <div class="col-sm-6">
			  <div class="" style="padding-top: 15px">
			  <input type="submit" class="btn btn-primary" value="SUBMIT">
			  </div>
			  </div>
			</form>
			
		<div class="col-sm-3"></div>
		</div>
	
    </div>
</section>
<section class="ptop1">
    </section>
<style>

.form-control{
	background-color:#f1f0ee;
	border: none;
}
.form-group{
	font-family: "gotham-light";
	letter-spacing: 1.5px;
	border: none;
	font-size: 12px;
		
}

.h2.pendaftaran{
	padding-top: 30px;
	font-family: "gotham-light"; 
	font-size: 16px; 
	letter-spacing: 1px; 
	border: none;
	text-align: center;
	padding-bottom: 30px;
	font-weight: bold;
}
.wide {
  width:100%;
  height:auto;
  
}
.btn {
    background-color: #9e8463;
    border: none;
    color: white;
	display: inline-block;
	width: 100%;
}
.btn:active{
	background-color: #d1d2d4;
    border: none;
    color: white;
}
.btn:hover{
	background-color: #d1d2d4;
    border: none;
    color: white;
}


</style>