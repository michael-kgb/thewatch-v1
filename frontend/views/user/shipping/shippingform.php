
<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            
            <?php 
            echo Yii::$app->view->renderFile('@app/shared/sidebar_profile.php', array(
                "currentPage" => "shipping",
            ));
            ?>
             <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 myprofile" style="">
                <div class="profile-head">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 my-profile title clearleft clearright" style="">
                        Shipping Information
                    </div>
                </div>
                
                <?php if ($shipping != NULL) { ?>

                <form method="post" action="../update/<?php echo $shipping->customer_address_id; ?>">

                <div class="form-input-wrap col-md-12 col-sm-12 remove-padding">

                    <div class="rounded-input-wrap">
                        <label for="firstname">First Names</label>
                        <input class="rounded-input remove-margin-top" type="text" name="firstname" placeholder="First Name" value="<?php echo $shipping->firstname; ?>" pattern="[a-zA-Z0-9\s]+" required/>
                        <span class="dnone gotham-light error-input-message">* First Name Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                    <label for="lastname">Last Name</label>
                        <input class="rounded-input" type="text" name="lastname" placeholder="Last Name"  value="<?php echo $shipping->lastname; ?>" pattern="[a-zA-Z0-9\s]+" required/>
                        <span class="dnone gotham-light error-input-message">* Last Name Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="address1">Save address as ( Ex: Home, work, etc )</label>
                        <input class="rounded-input" type="text" name="address_label" placeholder="Address Name"  
                            value="<?php echo $shipping->address_label; ?>" pattern="[a-zA-Z0-9\s]+" required/>
                        <span class="dnone gotham-light error-input-message">* Address Name Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="address1">Address</label>
                        <textarea rows="4" class="rounded-input" name="address1" placeholder="Address" required><?php echo $shipping->address1; ?></textarea>
                        <span class="dnone gotham-light error-input-message">* Address Required</span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="phone">Mobile Phone</label>
                        <input class="rounded-input" type="number" name="phone" placeholder="Mobile Phone" value="<?php echo $shipping->phone; ?>" required/>
                        <span class="dnone gotham-light error-input-message">* Mobile Phone Required </span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="postcode">Zip Code</label>
                        <input class="rounded-input" type="number" name="postcode" placeholder="Zip Code" value="<?php echo $shipping->postcode; ?>" pattern="[0-9]{5}" maxlength="5" required/>
                        <span class="dnone gotham-light error-input-message">* Zip Code Required </span>
                    </div>

                    <div class="rounded-input-wrap">
                        <label for="province_id">Province</label>
                        <select class="year" id="province-profile" name="province_id" required>
                                <option value="0" selected="selected">Province</option>
                                <?php $provinces = backend\models\Province::findAll(["active" => 1]); ?>
                                <?php if (count($provinces) > 0) { ?>
                                    <?php foreach ($provinces as $province) { ?>
                                        <option value="<?php echo $province->province_id; ?>" <?php echo $province->province_id == $shipping->province_id ? "selected" : ""; ?>><?php echo $province->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        <span class="dnone gotham-light error-input-message">* Province Required</span>
                    </div>
                    <div class="rounded-input-wrap state">
                        <label for="state">State</label>
                        <select class="year" id="state-profile" name="state_id" onchange="checkDistrict()" required>
                            <option value="0" selected="selected">State</option>
                            <?php $states = backend\models\State::findAll(["active" => 1, "province_id" => $shipping->province_id]); ?>
                            <?php if (count($states) > 0) { ?>
                                <?php foreach ($states as $state) { ?>
                                    <option value="<?php echo $state->state_id; ?>" <?php echo $state->state_id == $shipping->state_id ? "selected" : ""; ?>><?php echo $state->name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <span class="dnone gotham-light error-input-message">* State Required </span>
                    </div>
                    <div class="rounded-input-wrap district">
                        <label for="district">District</label>
                        <select class="year" id="district-profile" name="district_id" required>
                            <option value="0" selected="selected">District</option>
                            <?php $districts = backend\models\District::findAll(["active" => 1, "district_id" => $shipping->district_id]); ?>
                            <?php if (count($districts) > 0) { ?>
                                <?php foreach ($districts as $district) { ?>
                                    <option value="<?php echo $district->district_id; ?>" <?php echo $district->district_id == $district->district_id ? "selected" : ""; ?>><?php echo $district->name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <span class="dnone gotham-light error-input-message">* District Required </span>
                    </div>

                </div>
       
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info clearleft clearright" style="padding-top: 30px;">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft">
                      
                            <a href="#" class="round-btn-blue" onclick="submit()">save</a>
                            <button id="btn-submit" style="display: none;">save</button>
                    </div>
         
                </form>
                <?php } ?>
            </div>

        </div>
    </div>
</section>

<script>

function submit(){
    if($('input[name="firstname"]').val() == ''){
            $('span#error-firstname').css('display','inline-block');
            return;
        }
        if($('textarea[name="address1"]').val() == ''){
            $('span#error-address').css('display','inline-block');
            return;
        }
        if($('select#province-profile')[0].value == 0){
            $('span#error-province').css('display','inline-block');
            return;
        }
        if($('select#state-profile')[0].value == 0){
            $('span#error-state').css('display','inline-block');
            return;
        }
        if($('select#district-profile')[0].value == 0){
            $('span#error-district').css('display','inline-block');
            return;
        }
    $('#btn-submit').click();
}

function checkDistrict(){
    var state_id = document.getElementById('state-profile').value;
    
    if(state_id != 0){
        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-district-profile',
            data: {"state_id": state_id},
            beforeSend: function () {

            },
            success: function (data) {
                $("div.district").html(data);
            }
        });
    }
}

</script>