<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$_SESSION['IS_SHOW'] = false;

if(!isset($_SESSION['IS_END']) && !isset($_SESSION['customerInfo'])){

    if(!isset($_SESSION['LAST_ACTIVITY'])){
        $_SESSION['LAST_ACTIVITY'] = time(); 
        $_SESSION['SHOW_POPUP'] = 0;
        $_SESSION['IS_SHOW'] = true;
    }
    
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 180)) {
    
        if($_SESSION['SHOW_POPUP'] >= 3){

            unset($_SESSION['SHOW_POPUP']);
            unset($_SESSION['LAST_ACTIVITY']);
            unset($_SESSION['IS_SHOW']);
            
            $_SESSION['IS_END'] = true;
        }else{
            $_SESSION['SHOW_POPUP'] += 1;
            $_SESSION['IS_SHOW'] = true;
            $_SESSION['LAST_ACTIVITY'] = time(); 
        }
    } 
}

// session_unset();     
// session_destroy();  
if(isset($_SESSION['IS_SHOW']) && $_SESSION['IS_SHOW']){
?>

<div class="popup-newsletter-wrap modal-wrap">
    <div class="popup-newsletter">
        <div class="img-newsletter">
            <div class="newsletter-img-text">
                Dapatkan voucher senilai Rp 100.000,- dan info terbaru 
                dengan mendaftarkan nama dan email kamu.</div>
            <img class="desktop" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/popup/desktop_<?= rand(1,3); ?>.jpg" alt="popup" />
            <img class="mobile" src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/popup/mobile_<?= rand(1,3); ?>.jpg" alt="popup" />
        </div>
        <div class="form-newsletter">
            <div onclick="closeModal()" class="close-button-popup">X</div>
            <div class="newsletter-content">
                <div class="logo">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/frontend/web/img/logos/logo.png" alt="logo" />
                </div>

                <div class="alert alert-danger dnone" id="newsletter-error-message">
                    
                </div>
                <div class="alert alert-success dnone" id="newsletter-success-message">
                    
                </div>


                <div class="form-newsletter-inside">
                    <div class="rounded-input-wrap">
                        <input class="rounded-input" type="text" name="newsletter_name" placeholder="Nama" />
                        <span class="dnone gotham-light" id="name-error"></span>
                    </div>
                    <div class="rounded-input-wrap">
                        <input class="rounded-input" type="text" name="newsletter_email" placeholder="Email" />
                        <span class="dnone gotham-light" id="email-error"></span>
                    </div>

                    <div class="clear-20"></div>
                    <div class="rounded-button green-btn" id="btn-terms-on" onclick="registerNewsletter()">Daftar</div>
                    <div class="rounded-button grey-btn" id="btn-terms-off">Daftar</div>
                    <div class="terms-text">
                        <input type="radio" name="terms" onclick="terms(this)">
                        Anda menyetujui syarat & ketetuan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>