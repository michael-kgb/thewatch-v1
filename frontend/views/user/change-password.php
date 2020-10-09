<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <?php
            $customerInfo = $_SESSION['customerInfo'];
            ?>
            
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "change_password",
            ));
            ?>
            
        <!--     <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders">MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->
            
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 myprofile" style="">
                <div class="profile-head">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 my-profile title clearleft clearright" style="">
                        Change Password
                    </div>
                </div>

                <div class="form-input-wrap col-md-5 col-sm-12 remove-padding">
                
                    <div class="rounded-input-wrap">
                        <input id="opassword" class="rounded-input remove-margin-top" type="password" name="old_password" placeholder="Old Password" />
                        <span class="dnone gotham-light error-input-message">* Old Password Required</span>
                    </div>
                    <div class="rounded-input-wrap">
                        <input id="npassword" class="rounded-input" type="password" name="new_password" placeholder="New Password" />
                        <span class="dnone gotham-light error-input-message">* New Password Required</span>
                    </div>
                    <div class="rounded-input-wrap">
                        <input id="cpassword" class="rounded-input" type="password" name="old_password" placeholder="Confirm Password" />
                        <span class="dnone gotham-light error-input-message">* Confirm Password Required</span>
                    </div>

                    <div class="clear"></div>

                    <div class="rounded-input-wrap">
                        <a href="#" onclick="updatePassword()" class="round-btn-blue">
                        Change Password
                        </a>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['_flash'])){ ?>
                    <?php if ($_SESSION['_flash'] == 'pass1'){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:red;text-align: right;">
                        New password and confirm password not match
                    </div>
                <?php } ?>
                <?php if ($_SESSION['_flash'] == 'pass2'){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:red;text-align: right;">
                        Wrong Password
                    </div>
                <?php } ?>
                <?php if ($_SESSION['_flash'] == 'success'){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:green;text-align: right;">
                        Change Password Success
                    </div>
                <?php } ?>
                <?php 
                unset($_SESSION['_flash']);
                } 

                ?>
               
            
        </div>
    </div>
</section>

<script>
    function updatePassword() {
        let opass = document.getElementById('opassword').value;
        let npass = document.getElementById('npassword').value;
        let cpass = document.getElementById('cpassword').value;

        let url = baseUrl + '/go-api/user/update-password';
        let type = 'POST';
        let data = {
            'opassword': opass,
            'npassword': npass,
            'cpassword': cpass,
        };
        let before_send = function () {
            if(isEmpty(opass) || isEmpty(npass) || isEmpty(cpass)){
                alert('Please fill in the forms!');
                return false;
            }
        };
        let success = function (jqXHR) {
            // let rs = jqXHR.results[0];
            if(jqXHR.status === true){
                location.reload();
            }else{
                alert(jqXHR.message);
            }
        };
        throw_ajax_json(url, type, data, before_send, success, throw_ajax_err);
    }
</script>