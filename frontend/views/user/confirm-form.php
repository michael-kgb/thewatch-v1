<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <?php
            $customerInfo = $_SESSION['customerInfo'];
            ?>
            
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myaccount profile separator clearleft clearright"></div>
            <div class="hidden-xs col-lg-9 col-md-9 col-sm-9 shopping-bag product separator clearleft clearright" style="border-bottom: 0px solid;"></div>
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myprofile menu-left box clearleft">
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left active clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders">MY ORDER / CONFIRM PAYMENT</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/sign-out">SIGN OUT</a>
                </div>
                
            </div>
            
<!--             <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders">MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->
            
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 myprofile">
                 <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 my-profile title clearleft">My Profile</div>
                 <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 clearleft" style="border-bottom: solid 1px #a8a9ad;margin-bottom: 10px;"></div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        First Name
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft">
                        <input id="fname" class="email" type="text" name="email" placeholder="First Name" value="<?php echo $customerInfo['fname']; ?>">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding" style="padding-top: 14px;">
                        Last Name
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft date"  id='datetimepicker1'>
                        <input data-provide="datepicker" id="lname" class="email datepicker" type="text" name="email" placeholder="Last Name" value="<?php echo $customerInfo['lname']; ?>">
                    </div>
                    <script type="text/javascript">
                         $(function () {
                           var bindDatePicker = function() {
                                $(".date").datetimepicker({
                                format:'YYYY-MM-DD',
                                    icons: {
                                        time: "fa fa-clock-o",
                                        date: "fa fa-calendar",
                                        up: "fa fa-arrow-up",
                                        down: "fa fa-arrow-down"
                                    }
                                }).find('input:first').on("blur",function () {
                                    // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                                    // update the format if it's yyyy-mm-dd
                                    var date = parseDate($(this).val());

                                    if (! isValidDate(date)) {
                                        //create date based on momentjs (we have that)
                                        date = moment().format('YYYY-MM-DD');
                                    }

                                    $(this).val(date);
                                });
                            }
                           
                           var isValidDate = function(value, format) {
                                format = format || false;
                                // lets parse the date to the best of our knowledge
                                if (format) {
                                    value = parseDate(value);
                                }

                                var timestamp = Date.parse(value);

                                return isNaN(timestamp) == false;
                           }
                           
                           var parseDate = function(value) {
                                var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
                                if (m)
                                    value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

                                return value;
                           }
                           
                           bindDatePicker();
                         });
                    </script>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        Full Address
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright" style="">
                        <textarea id="address" class="email" type="text" name="email" placeholder="First Name" value="<?php echo $customerInfo['fname']; ?>"><?php echo $customerInfo['fname']; ?></textarea>
                    </div>
                </div>
               
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        Gender
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft" style="">
                        <input id="gender" class="email" type="text" name="email" placeholder="Last Name" value="<?php echo $customerInfo['lname']; ?>">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        Email Address
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        <?php echo $customerInfo['email']; ?> <a onclick="updateEmail()" class="editmail">CHANGE</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 clearleft remove-padding">
                        Date of Birthday
                    </div>
                    <?php
                    ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft remove-padding">
                        <select id="birth-date" class="day" name="day">
                            <option>DAY</option>
                            <?php
                            $birthdate = new DateTime($customerInfo['birthday']);
                            for ($i = 1; $i <= 31; $i++) {
                                ?>
                                <option value="<?php echo $i; ?>" <?php echo $birthdate->format("d") == $i ? "selected" : ""; ?>><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 clearleft">
                        <select id="birth-month" class="month" name="month">
                            <option>MONTH</option>
                            <?php
                            $array = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                            for ($i = 0; $i < 12; $i++) {
                                ?>
                                <option value="<?php echo str_pad($i+1, 2, '0', STR_PAD_LEFT); ?>" <?php echo intval($birthdate->format("m")) - 1 == $i ? "selected" : ""; ?>><?php echo $array[$i]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 clearleft remove-padding">
                        <select id="birth-year" class="year" name="year">
                            <option>YEAR</option>
                            <?php
                            for ($i = (new DateTime)->format("Y"); $i >= 1980; $i--) {
                                ?>
                                <option value="<?php echo $i; ?>" <?php echo $birthdate->format("Y") == $i ? "selected" : ""; ?>><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        Mobile Phone
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright" style="">
                        <input id="phone" class="email" type="text" name="email" placeholder="Last Name" value="<?php echo $customerInfo['lname']; ?>">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info clearleft clearright" style="padding-top: 30px;">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright btn-edit-profile" style="float: right;text-align: center;">
                        <a onclick="updateProfile()" class="edit shipping">UPDATE & SAVE DATA</a>
                    </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile customer-info separator last clearleft clearright"></div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 myprofile clearleft remove-padding" style="padding-right: 0px;">
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 myprofile clearleft remove-padding" style="padding-right: 0px;">
                 <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag title clearleft">Change Password</div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                        Old Password
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft">
                        <input id="fname" class="email" type="text" name="email" placeholder="First Name" value="<?php echo $customerInfo['fname']; ?>">
                    </div>
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        New Password
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright" style="">
                        <input id="gender" class="email" type="text" name="email" placeholder="Last Name" value="<?php echo $customerInfo['lname']; ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearright">
                   
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 myprofile customer-info clearleft clearright">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        Confirm Password
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding">
                        <input id="gender" class="email" type="text" name="email" placeholder="Last Name" value="<?php echo $customerInfo['lname']; ?>">
                    </div>
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info clearleft clearright" style="padding-top: 30px;">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearright btn-edit-profile" style="float: right;text-align: center;">
                        <a onclick="updateProfile()" class="edit shipping">UPDATE & SAVE DATA</a>
                    </div>
          
            </div>
        </div>
    </div>
</section>

<script>
    function updateProfile() {
        $.ajax({
            type: "POST",
            url: 'updateprofile',
            data: {
                'fname': document.getElementById('fname').value,
                'lname': document.getElementById('lname').value,
                'birth': document.getElementById('birth-year').value + '-' + document.getElementById('birth-month').value + '-' + document.getElementById('birth-date').value
            },
            success: function (data) {
                location.reload();
            }
        });
    }
</script>