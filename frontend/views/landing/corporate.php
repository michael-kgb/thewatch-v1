<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$breadcrumbs = $this->context->breadcrumb;

  $url = explode("/",$_SERVER['REQUEST_URI']);

  $urls = explode("?",$url[1]);
  // echo $urls[0];

if(isset($_GET['sort'])){
    $params = 'sort=' . $_GET['sort'];
}

if(isset($_GET['brands'])){
    $params = $params . '&brands=' . $_GET['brands'];
    $brands_selection = explode('--', $_GET['brands']);
}

if(isset($_GET['price'])){
    $params = $params . '&price=' . $_GET['price'];
    $price_selection = explode('--', $_GET['price']);
}

if(isset($_GET['gender'])){
    $params = $params . '&gender=' . $_GET['gender'];
    $genders_selection = explode('--', $_GET['gender']);
}

if(isset($_GET['category'])){
    $params = $params . '&category=' . $_GET['category'];
}

if(isset($_GET['type'])){
    $params = $params . '&type=' . $_GET['type'];
    $types_selection = explode('--', $_GET['type']);
}

if(isset($_GET['movement'])){
    $params = $params . '&movement=' . $_GET['movement'];
    $movements_selection = explode('--', $_GET['movement']);
}

if(isset($_GET['bandwidth'])){
    $params = $params . '&bandwidth=' . $_GET['bandwidth'];
    $bandwidth_selection = explode('--', $_GET['bandwidth']);
}

if(isset($_GET['water'])){
    $params = $params . '&water=' . $_GET['water'];
    $waters_selection = explode('--', $_GET['water']);
}
if(isset($_GET['size'])){
    $params = $params . '&size=' . $_GET['size'];
    $size_selection = explode('--', $_GET['size']);
}

                    if(!isset($_GET['limit'])){
                        $limit = 20;

                    }else{
                        $limit = $_GET['limit'];
                    }



                    if(!isset($_GET['page'])){
                        $current = 1;
                    }else{
                        $current = $_GET['page'];
                    }

                    $sortby = 'none';
                    if(isset($_GET['sortby'])){
                        $sort_name = str_replace('-', ' ', $_GET['sortby']);
                        $sort_name = strtoupper($sort_name);
                        $sortby = $_GET['sortby'];
                    }else{
                        $sort_name = 'NONE';
                    }

?>
<script>
var dataLayer = [],
    items = [];
	
    <?php $i = 1; ?>
    <?php if (count($products) > 0) { ?>
    <?php foreach ($products as $product) { ?>

    items.push({
        "id": "<?php echo $product->product_id; ?>",
        "name": "<?php echo $product->productDetail->name; ?>",
        "price": "<?php echo $product->price; ?>",
        "brand": "<?php echo $product->brands->brand_name; ?>",
        "category": "<?php echo $product->productCategory->product_category_name; ?>",
        "position": <?php echo $i; ?>,
        "list": "Landing Page Promo Ramadhan"
    })

    <?php $i++; ?>
    <?php } ?>
    <?php } ?>

    dataLayer.push({
        "event" : "productImpressions",
        "ecommerce": {
            "currencyCode": "IDR",
            "impressions": items
        }
    });
</script>


<div class="hidden-lg hidden-xs"></div>
<section class="ptop1" style="padding-top:0px;padding-bottom:0;">
    <!--<div class="container">-->
    <!--    <div class="row">-->
        <div style="position: relative;">
        
            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>landing/corporateorder/corporate-banner-desktop.jpg" class="img-responsive hidden-xs" style="display: block;margin: auto;">
            <img src="<?php echo Yii::$app->params['imgixUrl'] ?>landing/corporateorder/corporate-banner-mobile.jpg" class="img-responsive hidden-lg hidden-md hidden-sm" style="display: block;margin: auto;">

        </div>
            
    <!--    </div>-->
    <!--</div>-->
    
</section>
<section class="ptop1" style="padding-bottom:0;">
    <div class="container">
        <div class="row">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft">
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                </div>
                
                    
            <?php endif; ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearleft">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-medium title-gopay corporate-mobile">
                    Corporate Order
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile gotham-light clearleft clearright corporate-mobile">
                        Dengan lebih dari 10.000 produk jam tangan original dengan garansi resmi, The Watch Co. menghadirkan kenyamanan untuk memilih dan membeli produk berkualitas untuk kebutuhan korporasi Anda.
                        Semua produk yang masuk ke dalam toko The Watch Co. telah melalui proses quality control yang ketat untuk menjaminkan kualitas tertinggi dalam setiap produk kami.<br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        Manfaat melakukan corporate order dengan The Watch Co.:
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile gotham-light clearright corporate-mobile">
                        <ol class="pleft0 ptop0 pbottom0">
                            <li>Nikmati harga spesial</li>
                            
                            <li>Desain khusus (custom design) - kami dapat mendesain produk atau packaging yang in-line dengan kebutuhan perusahaan Anda.</li>
                             
                            <li>Embos strap agar tampil unik dan seragam dengan kebutuhan perusahaan Anda</li>
                             
                        </ol>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile gotham-light clearleft clearright corporate-mobile">
                        Untuk informasi lebih lanjut mengenai program corporate order, silahkan melengkapi formulir berikut ini dan Team B2B kami akan segera menghubungi Anda.
                    </div>
                </div>

            </div>
            
            
            <!--form-->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright">
                <?php $form = ActiveForm::begin([
                    // 'action' => '/login',
                    'options' => [
                        'class' => 'corporate_form'
                     ]
                ]); ?>
                <div class="form-corporate col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright-mobile clearleft-mobile clearleft clearright">
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 new-line"></div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 new-line"></div>
                    <input class="default col-lg-12 col-md-12 col-sm-12 col-xs-12" name="CorporateOrder[fullname]" id="fullname" placeholder="Nama Lengkap">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <input class="default col-lg-12 col-md-12 col-sm-12 col-xs-12" name="CorporateOrder[company_name]" id="company_name" placeholder="Nama Perusahaan">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <input class="default col-lg-12 col-md-12 col-sm-12 col-xs-12" name="CorporateOrder[phone_number]" id="phone_number" placeholder="Nomor Telepon / Handphone">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <input class="default col-lg-12 col-md-12 col-sm-12 col-xs-12" name="CorporateOrder[email]" id="email" placeholder="Alamat E-mail">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <textarea class="default col-lg-12 col-md-12 col-sm-12 col-xs-12 height100" height="100" maxlength="2000" placeholder="Pesan (Maksimal 2000 karakter)" name="CorporateOrder[message]" id="message"></textarea>
                    <span id="spnCharLeft"></span>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <button class="blue-round default">Submit</button>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
			<div class="col-lg-12 clearleft" >
                <div style="margin-top:40px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-medium title-gopay corporate-mobile">
                    Corporate Order Partner
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
    
                <div class="corporate-custom">
				
					<img src="<?php echo \yii\helpers\Url::base(); ?>img/icons/icon-qwer-85.png" 
					
					>
					<img src="<?php echo \yii\helpers\Url::base(); ?>img/icons/icon-qwer-84.png" 
					
					>
					
                </div>

            </div>
            
        </div>
    </div>
</section>

<section style="padding-top:0;padding-bottom:0;">
    <div class="container">
        <div class="row">
            
            
            
        </div>
    </div>
</section>

<section class="" style="padding-top:48px;"></section>
<!--SEO Pages-->


<style>
@media only screen and (max-width : 767px) {
	.mtop3-mobile { margin-top: 3%; }
	.mtop8-em-mobile { margin-top: 8em; }
}
p.seodesc{font-size: 0.7em; line-height: 1.3em; font-family: gotham-light;}
    .show-read-more .more-text{
        display: none;
    }


    .container-video {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%;
}
.video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.title-gopay{
    font-size:24px;
}
@media only screen and (max-width : 767px) {
	.title-gopay{
        font-size:20px;
    }
}
</style>

