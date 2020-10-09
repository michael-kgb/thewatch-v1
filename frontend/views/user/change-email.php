<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <?php
            $customerInfo = $_SESSION['customerInfo'];

            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "profile",
            ));
            ?>

            
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 myprofile">
            <div class="profile-head">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 my-profile title clearleft clearright" style="">
                        Change Email
                    </div>
                </div>


                <div class="rounded-input-wrap">
                    <label for="email">Current Email </label>
                    <div class="input-info"><?php echo $customerInfo['email']; ?></div>
                </div>

                <div class="rounded-input-wrap">
                    <label for="new-email">New Email</label>
                    <input id="email" class="rounded-input remove-margin-top" type="email" name="email" placeholder="Your new email"/>
                    <span class="dnone gotham-light error-input-message">* New Email Required</span>
                </div>

                <div class="rounded-input-wrap">
                    <label for="password">Password</label>
                    <input id="cpassword" class="rounded-input remove-margin-top" type="password" name="password" placeholder="Your password"/>
                    <span class="dnone gotham-light error-input-message">* Password Required</span>
                </div>

               
                <?php if (isset($_SESSION['_flash'])){ ?>
                    <?php if ($_SESSION['_flash'] == 'pass1'){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:red;text-align: right;">
                        Email has been added
                    </div>
                <?php } ?>
                <?php if ($_SESSION['_flash'] == 'pass2'){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:red;text-align: right;">
                        Wrong Password
                    </div>
                <?php } ?>
                <?php if ($_SESSION['_flash'] == 'success'){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:green;text-align: right;">
                        Change Email Success
                    </div>
                <?php } ?>
                <?php 
                unset($_SESSION['_flash']);
                } 

                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info clearleft clearright" style="padding-top: 30px;">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright" style="float: right;text-align: center;">
                        <a href="#" onclick="updateEmail()" class="round-btn-blue">CHANGE EMAIL</a>
                    </div>
            
            
        </div>
    </div>
</section>

<script>
    function updateEmail() {
        let email = document.getElementById('email').value;
        let cpass = document.getElementById('cpassword').value;

        let url = baseUrl + '/go-api/user/update-email';
        let type = 'POST';
        let data = {
            'customerInfo':
            {
                'email': email,
                'cpassword': cpass,
            }
        };
        let before_send = function () {
            if(isEmpty(email) || isEmpty(cpass)){
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