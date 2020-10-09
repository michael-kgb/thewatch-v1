<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <?php
            $customerInfo = $_SESSION['customerInfo'];
			$shippingInformation = $customerInfo['shippingInformation'];
			
            ?>
            
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "profile",
            ));
            ?>
            
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 myprofile">
            <div class="profile-head">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 my-profile title clearleft clearright" style="">
                        Edit Profile
                    </div>
                </div>

                <div class="alert alert-danger dnone" id="error-message">
                    There is an error while updating your profile.
                </div>
                <div class="alert alert-success dnone" style="border:none;" id="success-message">
                    Your profile has been updated.
                </div>
                
                <div class="form-input-wrap col-md-12 col-sm-12 remove-padding">

                    <div class="rounded-input-wrap">
                        <label for="firstname">First Name</label>
                        <input id="fname" class="rounded-input remove-margin-top" type="text" name="firstname"  placeholder="First Name" value="<?php echo $customerInfo['fname']; ?>"/>
                        <span class="dnone gotham-light error-input-message">* First Name Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="lastname">Last Name</label>
                        <input id="lname" class="rounded-input remove-margin-top" type="text" name="lastname"  placeholder="Last Name" value="<?php echo $customerInfo['lname']; ?>"/>
                        <span class="dnone gotham-light error-input-message">* Last Name Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="email">Email</label>
                        <div class="email-change">
                            <?php echo $customerInfo['email']; ?> <a href="<?php echo \yii\helpers\Url::base(); ?>/user/change-email" class="editmail">CHANGE</a>
                        </div>
                    </div>
                    <div class="rounded-input-wrap">
                        <label for="gender">Gender</label>
                        <select class="rounded-input-select rounded-input" id="gender" name="gender" required>
                            <option value="0" selected="selected" disabled>Gender</option>
							<?php
								$setMen = $customerInfo['gender'] === "MEN" ? 'selected="selected"' : '';
								$setWomen = $customerInfo['gender'] === "WOMEN" ? 'selected="selected"' : '';
							?>
							<option value="1" <?php echo $setMen; ?>>Men</option>
							<option value="2" <?php echo $setWomen; ?>>Women</option>
                        </select>
                        <span class="dnone gotham-light error-input-message">* Gender Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="dob">Date of Birthday</label>
                        <input id="birthday" class="rounded-input remove-margin-top" type="date" name="dob"  placeholder="Date of Birth" value="<?php echo $customerInfo['birthday'];?>"/>
                        <span class="dnone gotham-light error-input-message">* Date of Birthday Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="phone">Mobile Phone</label>
                        <input id="phone" class="rounded-input remove-margin-top" type="number" name="mobile_phone"  placeholder="Phone" value="<?php echo $shippingInformation[0]['phone']; ?>"/>
                        <span class="dnone gotham-light error-input-message">* Phone Required</span>
                    </div>

                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info clearleft clearright" style="padding-top: 30px;">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright" style="float: right;text-align: center;">
                        <a href="#" onclick="updateProfile()" class="round-btn-blue">UPDATE & SAVE DATA</a>
                    </div>
                
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs myprofile clearleft remove-padding" style="padding-right: 0px;">
            </div>
   
        </div>
    </div>
</section>

<script>
    function updateProfile() {
        let errorMessage = $("#error-message"),
            successMessage = $("#success-message");
        $.ajax({
            type: "POST",
            // url: 'updateprofile',
            url: baseUrl + '/go-api/user/update-profile/',
            data: 
            {
                'customerInfo':
                {
                    'fname': document.getElementById('fname').value,
                    'lname': document.getElementById('lname').value,
                    'phone': document.getElementById('phone').value,
                    'gender': document.getElementById('gender').value,
                    'birthday': document.getElementById('birthday').value,
                }
            },
            success: function (jqHxr) {
                if(jqHxr.status === true)
                {
                    successMessage.removeClass('dnone');
                }else{
                    alert(jqHxr.message);
                    errorMessage.removeClass('dnone');
                }
            }
        }).done(function(){
            setTimeout(function(){
                location.reload();
            }, 5000);
        });
    }
</script>