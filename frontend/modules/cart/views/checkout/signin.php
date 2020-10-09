<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/YWFhOGNkYzItZWE1YS00MmM1LWFlMTItMzhmMDY5Njc2YzI4"></script>-->

<section id="shopping-bag" class="shopping-bag-wrap">

    <div class="container">
        <div class="col-md-6 col-sm-12 none-mobile">
            <div class="big-logo">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/logos/logo-new.png">
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="sigup-in-wrap">
                <div class="tab-signin-up none-mobile">
                    <div class="tab-signin-up-item tab-signin" onclick="tabSignInUp('signin')">
                        <h3>Masuk</h3>
                        jika telah terdaftar
                    </div>  
                    <div class="tab-signin-up-item tab-signup active" onclick="tabSignInUp('signup')">
                        <h3>Daftar</h3>
                        jika belum memiliki akun
                    </div> 
                </div>

                <div class="tab-signin-up show-mobile">
                    <div class="tab-signin signin-form">
                        <h3>Log in di bawah</h3>
                        Belum memiliki akun ? <span class="green-text-btn" onclick="tabSignInUp('signup')">Daftar di sini</span>
                    </div>  
                    <div class="tab-signup  signup-form dnone">
                        <h3>Daftar sekarang !</h3>
                       Sudah punya akun ? <span class="green-text-btn" onclick="tabSignInUp('signin')">Masuk</span>
                    </div> 
                </div>
                <div class="row  signin-form" id="signin-form" >
                
                    <div class="col-md-12">
                        <div class="rounded-input-wrap">
                            <input id="email-login-web" class="rounded-input" type="email" name="email_login" placeholder="Email" required/>
                            <span id="email-signin-error" class=" dnone gotham-light">* Email Required</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="rounded-input-wrap">
                            <input id="password-login-web" class="rounded-input password-login" type="password" name="password_login" placeholder="Kata Sandi" />
                            <div class="password-eye" id="password-eye" onClick="toggleEyePassword(this)">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/eye-closed.png" width="15px">
                            </div>
                            <span id="signin-pwderror" class=" dnone gotham-light">* Password Required</span>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="mn-header form-login flex-login">
                            <div class="inner-flex-login">
                                <label for="remember-me" class="container-checkbox">Ingat Saya
                                    <input type="checkbox" id="remember-me" name="remember-me" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <!-- <input type="checkbox" id="rc001" name="rc001" class="remember">
                                <label for="rc001" class="black-style" onclick>Ingat Saya</label>-->
                            </div>
                            <div class="inner-flex-login text-right">
                                
                                <a href="#" id="forgot-password" class="gotham-light green-text">Lupa kata sandi?</a>
                            </div>
                            <!--<input class="mn-header form-login remember" type="checkbox" name="remember" checked />-->

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 login proceed custom-error-message">
                            <span id="signintop-error" class="dnone">Wrong Email or Password</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="clear"></div>
                        <div class="rounded-button green-btn" id="signin-btn-mobile" onclick="signinCheckout()">LANJUTKAN KE PEMBAYARAN</div>
                        <div class="clear"></div>
                    </div>

                </div>

                <div class="row forgot-btn-box-open dnone" id="forgot-form-content">
                    <div class="col-lg-12 col-md-12 col-sm-12 clearright">
                        <div class="mn-header form-forgot center ptop5">
                            INVALID EMAIL OR PASSWORD <br>
                            Lupa Password Anda?<br>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-lg-offset-5 col-md-offset-5 col-sm-offset-5 forgot-separator"></div>
                        <br>
                        <div class="mn-header form-forgot center ptop5">
                            Please enter your mail address below and we'll<br>
                            send you to confirmation email
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 clearright clearleft">
                        <div class="mn-header form-forgot">
                            <input class="mn-header form-forgot email-forgot" type="email" name="email_forgot" placeholder="Email Address" required/>

                            <span id="email-forgot-top-error" class="talign-center ptop2 dnone gotham-light">* Email Required</span>
                        </div>
                    </div>
                </div>
                
                <div class="row dnone inner-row signup-form" id="signup-form" >

                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="rounded-input-wrap">
                            <input id="name-sign" class="rounded-input" type="text" name="name_mobile" placeholder="Nama Lengkap" pattern="[a-zA-Z0-9\s]+" required/>
                            <span id="firstname-mobile-error" class="dnone gotham-light error-span">* Name Required</span>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="rounded-input-wrap">
                            <input id="email-sign" class="rounded-input" type="email" name="email_mobile" placeholder="Email" required/>
                            <span id="email-error" class=" dnone gotham-light">* Email Required</span>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="rounded-input-wrap">
                            <input id="telp-sign" class="rounded-input" type="number" name="sign_phone_mobile" placeholder="Nomor Telepon" required/>
                            <span id="phone-mobile-error" class="dnone gotham-light error-span">* Phone Number Required</span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="rounded-input-wrap">
                            <input id="password-sign" class="rounded-input" type="password" name="password_mobile" placeholder="Kata sandi" />
                            <span id="password-mobile-error" class="dnone gotham-light error-span">* Password Required</span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="rounded-input-wrap">
                            <input id="password-repeat" class="rounded-input" type="password" name="password_repeat_mobile" placeholder="Konfirmasi kata sandi" />
                            <span id="password-confirm-mobile-error" class="dnone gotham-light error-span">* Password not match</span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="clear"></div>
                        <div class="rounded-button green-btn" id="signin-btn-mobile" onclick="signupCheckout()">LANJUTKAN KE PEMBAYARAN</div>
                        <div class="clear"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 clearleft signup-error">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 login proceed clearleft">
                            <span id="signuptop-error" class="dnone gotham-light">Email Already Registered</span>
                            
                        </div>
                    </div>
                    
                </div>
                <!--
                <div class="row forgot-submit-box dnone" id="forgot-btn-box">
                    <div class="col-lg-12 col-md-12 col-sm-12 mn-header form-login clearright">
                        <div class="mn-header btn-login" id="signin-btn-mobile">MASUK</div>
                        <div class="mn-header btn-login retrieve" id="retrieve-btn">RETRIEVE</div>
                    </div>
                </div>
                <div class="rounded-button-wrap" id="signin-box">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="rounded-button green-btn" id="signin-btn-mobile">MASUK</div>
                        <div class="foot-signin-box">
                            Belum memiliki akun? <div class="signup-text" id="signup">daftar</div>
                        </div>
                    </div>
                </div>
                <div class="dnone rounded-button-wrap" id="signup-box">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="rounded-button green-btn" id="signup-btn-mobile">DAFTAR</div>
                        <div class="foot-signin-box">
                        Sudah memiliki akun?  <div class="signup-text" id="signin">masuk</div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!--
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 customer-login login-box remove-padding">SAYA TELAH MEMILIKI AKUN</div>
                <div class="hidden-xs col-lg-6 col-md-6 col-sm-6 customer-login register-box">SAYA BELUM MEMILIKI AKUN (DAFTAR SEKARANG)</div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 customer-login email clearleft remove-padding">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">EMAIL</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login email clearright remove-padding-right">
                    <input class="email" type="text" id="email-signin" name="email" placeholder="Email">
                    <span id="email-signin-error" style="display: none;">* Email Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-signin email clearleft remove-padding">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login password remove-padding-left">PASSWORD</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login password clearright remove-padding-right">
                    <input class="password password-signin" type="password" id="password-signin" name="password" placeholder="Password">
                    <span id="password-signin-error" style="display: none;">* Password Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-5 customer-login fpassword margin-top-5">
                    <a href="#forgotModal" id="forgot" data-toggle="modal" style="color: #000;">Lupa Password Anda?</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-5 login proceed clearleft remove-padding-right">
                    <a href="#" id="signin-checkout" class="continue proceed-signin">LANJUTKAN KE PEMBAYARAN</a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft signin-error">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-5 login proceed clearleft">
                <span id="signin-error" style="display: none;">Wrong Email or Password</span>
                </div>
            </div>
        </div>
        
        <div class="hidden-lg hidden-md hidden-sm row">
            <div class="col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 customer-login login-box remove-padding">SAYA BELUM MEMILIKI AKUN (DAFTAR SEKARANG)</div>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 customer-login register-form clearleft clearright remove-padding margin-top-5">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">EMAIL</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login email clearright">
                    <input class="email" type="text" id="email" name="signup_ch_email" placeholder="Email">
                    <span id="email-error" style="display: none;">* Email Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">FIRST NAME</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login email clearright">
                    <input class="email" type="text" id="firstname_checkout_signup" name="firstname_checkout_signup" placeholder="First Name">
                    <span id="firstname-checkout-error" style="display: none;">* First Name Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">LAST NAME</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login email clearright">
                    <input class="email" type="text" id="lastname_checkout_signup" name="lastname_checkout_signup" placeholder="Last Name">
                    <span id="firstname-checkout-error" style="display: none;">* Last Name Required</span>
                </div>
            </div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">PHONE NUMBER</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login email clearright">
                    <input class="email" type="text" id="phone_checkout_signup" name="phone_checkout_signup" placeholder="Phone Number">
                    <span id="phone-checkout-error" style="display: none;">* Phone Number Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-signin password clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login password remove-padding-left">PASSWORD</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login password clearright remove-padding-right">
                    <input class="password password-signin" type="password" id="password" name="signup_ch_password" placeholder="Password">
                    <span id="password-error" style="display: none;">* Password Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-signin cpassword clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login password remove-padding-left">CONFIRM PASSWORD</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login password clearright remove-padding-right">
                    <input class="password password-signin" type="password" name="signup_ch_cpassword" id="cpassword" placeholder="Confirm Password">
                    <span id="password-confirm-error" style="display: none;">* Password do not match</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft margin-top-5 remove-padding">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-7 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-5 login proceed clearleft remove-padding-right">
                    <a href="#" id="signup-checkout" class="continue proceed-signin">LANJUTKAN KE PEMBAYARAN</a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft signup-error remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-5 login proceed clearleft">
                <span id="signup-error" style="display: none;">Email Already Registered</span>
                </div>
            </div>
        </div>
        -->
    </div>
</section>

<div class="portfolio-modal modal fade forgot signin-checkout" id="forgotModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 close-dialog">
            <a href="#" data-dismiss="modal">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-black.png" class="close-forgot">
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="modal-body forgot-body">
                <div class="forgot-title-modal">FORGOT MY PASSWORD</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 2%;">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 customer-login email remove-padding" style="text-align: left;">EMAIL</div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 customer-login email clearright remove-padding">
                        <input class="email" type="email" name="email_signin_forgot" placeholder="Email" required>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 clearright remove-padding">
                        <span id="email-signin-forgot-popup-error" class="talign-center ptop2 mright9" style="display: none;">* Email Required</span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 2%;">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-4 login proceed clearleft remove-padding">
                        <a href="#" class="continue" id="reset_password_signin" style="float:left;">RESET MY PASSWORD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("firstname_checkout_signup").onkeypress = function(e) {
	var chr = String.fromCharCode(e.which);
	if ("?></\"".indexOf(chr) >= 0)
		return false;
};
document.getElementById("lastname_checkout_signup").onkeypress = function(e) {
	var chr = String.fromCharCode(e.which);
	if ("?></\"".indexOf(chr) >= 0)
		return false;
};
</script>