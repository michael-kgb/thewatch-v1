<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-user"></i> Customer
                    <hr/>
                </div>
                <?php
                $form = ActiveForm::begin();
                $names = json_decode(file_get_contents("http://country.io/names.json"), true);
                ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <div class="box-body">
                    <?php
                    if (!empty($error)) {
                        ?>
                        <div class = "alert alert-danger alert-dismissable">
                            <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">×</button>
                            <h4><i class = "icon fa fa-ban"></i> Alert!</h4>
                            <?php echo $error; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group" style="padding: 0 0 4% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Customer Email</div></label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input id="customer-email" type="text" name="Customeraddress[email]" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-flat" onclick="searchcustomer()" type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div id="status"></div>
                        </div>
                    </div>

                    <input type="hidden" id="customer-id" name="Customeraddress[customer_id]" />
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">First Name</div></label>
                        <div class="col-sm-10">
                            <input id="firstname" type="text" name="Customeraddress[firstname]" class="form-control" required disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding:0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Last Name</div></label>
                        <div class="col-sm-10">
                            <input id="lastname" type="text" name="Customeraddress[lastname]" class="form-control" disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Company</div></label>
                        <div class="col-sm-10">
                            <input id="company" type="text" name="Customeraddress[company]" class="form-control" disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Country</div></label>
                        <div class="col-sm-10">
                            <select id="country" name="Customeraddress[country]" class="form-control" onchange="checkprovincecreate()" required disabled="true">
                                <option value="0"> Please select</option>
                                <?php
                                $countries = backend\models\Country::find()->all();
                                foreach ($countries as $row) {
                                    try {
                                        ?>
                                        <option value="<?php echo $row->country_id; ?>"><?php echo $names[$row->iso_code]; ?></option>
                                        <?php
                                    } catch (Exception $ex) {
                                        continue;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Province</div></label>
                        <div class="col-sm-10">
                            <select id="province" name="Customeraddress[province]" class="form-control" onchange="checkstatecreate()" disabled="true">
                                <option value="0"> Please select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">State</div></label>
                        <div class="col-sm-10">
                            <select id="state" name="Customeraddress[state]" class="form-control" onchange="checkdistrictcreate()" disabled="true">
                                <option value="0"> Please select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">District</div></label>
                        <div class="col-sm-10">
                            <select id="district" name="Customeraddress[district]" class="form-control" disabled="true">
                                <option value="0"> Please select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Address</div></label>
                        <div class="col-sm-10">
                            <input id="address" type="text" name="Customeraddress[address1]" class="form-control" required disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Address 2</div></label>
                        <div class="col-sm-10">
                            <input id="address2" type="text" name="Customeraddress[address2]" class="form-control" disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Postal Code</div></label>
                        <div class="col-sm-10">
                            <input id="postcode" type="text" name="Customeraddress[postcode]" class="form-control" required disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Phone</div></label>
                        <div class="col-sm-10">
                            <input id="phone" type="text" name="Customeraddress[phone]" class="form-control" required disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Mobile Phone</div></label>
                        <div class="col-sm-10">
                            <input id="phone-mobile" type="text" name="Customeraddress[phone_mobile]" class="form-control" disabled="true"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right" disabled="true">Other</div></label>
                        <div class="col-sm-10">
                            <input id="other" type="text" name="Customeraddress[other]" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-12">
                            <button class="btn btn-default pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
</section>
