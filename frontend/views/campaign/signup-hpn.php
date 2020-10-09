<section id="shopping-bag">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag title">REGISTER NOW</div>
        </div>
    </div>
    <div class="container">
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 ptop3 clearleft clearright remove-padding margin-top-5">
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
                    <input class="email" type="text" id="firstname_checkout_signup" name="lastname_checkout_signup" placeholder="Last Name">
                    <span id="lastname-checkout-error" style="display: none;">* Last Name Required</span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">GENDER</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login email clearright">
                    <input type="radio" name="gender" value="1" checked="checked">
                    <label>MEN</label>
                    <input type="radio" name="gender" value="2">
                    <label>WOMEN</label>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">BIRTHDAY</div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 customer-login email clearleft">
                    <select id="birth-date" class="day" name="day">
                        <option>DAY</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 customer-login email clearleft">
                    <select id="birth-month" class="month" name="month">
                        <option>MONTH</option>
                        <?php
                        $array = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                        for ($i = 0; $i < 12; $i++) {
                            ?>
                            <option value="<?php echo str_pad($i+1, 2, '0', STR_PAD_LEFT); ?>"><?php echo $array[$i]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 customer-login email clearleft">
                    <select id="birth-year" class="year" name="year">
                        <option>YEAR</option>
                        <?php
                        for ($i = (new DateTime)->format("Y"); $i >= 1960; $i--) {
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 customer-login email remove-padding-left">PHONE NUMBER</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 customer-login email clearright">
                    <input class="email" type="text" id="firstname_checkout_signup" name="phone_number" placeholder="Phone Number">
                    <span id="phone-error" style="display: none;">* Phone Number Required</span>
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
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-5 login proceed clearleft remove-padding-right">
                    <a href="#" id="signup-hpn" class="continue proceed-signin">SIGNUP</a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft signup-error remove-padding margin-top-5">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-5 login proceed clearleft">
                <span id="signup-error" style="display: none;">Email Already Registered</span>
                </div>
            </div>
        </div>
    </div>
</section>