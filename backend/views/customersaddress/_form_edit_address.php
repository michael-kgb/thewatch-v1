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
                    <i class="fa fa-map-marker"></i> Customer Address
                    <hr/>
                </div>
                <?php
                $form = ActiveForm::begin();
                $country = backend\models\Country::findOne($model->country_id);
                $names = json_decode(file_get_contents("http://country.io/names.json"), true);
                ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <div class="box-body">
                    <div class="form-group" style="padding: 0 0 3% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Customer</div></label>
                        <div class="col-sm-10">
                            <a href="../../customers/view/<?php echo $model->customer_id; ?>" class="btn btn-default"><i class="fa fa-eye"></i> <?php echo $model->firstname . ' ' . $model->lastname; ?></a>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">First Name</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[firstname]" class="form-control" value="<?php echo $model->firstname; ?>" required/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Last Name</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[lastname]" class="form-control" value="<?php echo $model->lastname; ?>" required/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Company</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[company]" class="form-control" value="<?php echo $model->company; ?>"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Address 1</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[address1]" class="form-control" value="<?php echo $model->address1; ?>" required/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Address 2</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[address2]" class="form-control" value="<?php echo $model->address2; ?>"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Country</div></label>
                        <div class="col-sm-10">
                            <select id="country" name="Customeraddress[country]" class="form-control" onchange="checkprovince()">
                                <option value="0"> Please select</option>
                                <?php
                                $countries = backend\models\Country::find()->all();
                                foreach ($countries as $row) {
                                    try {
                                        ?>
                                        <option value="<?php echo $row->country_id; ?>" <?php
                                        if (!empty($country)) {
                                            if ($row->iso_code == $country->iso_code)
                                                echo 'selected';
                                        }
                                        ?>><?php echo $names[$row->iso_code]; ?></option>
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
                            <select id="province" name="Customeraddress[province]" class="form-control" onchange="checkstate()">
                                <?php
                                if ($model->country_id != 0) {
                                    $provinces = backend\models\Province::find()->where(['country_id' => $model->country_id])->all();
                                    ?>
                                    <option value="0"> Please select</option>
                                    <?php
                                    foreach ($provinces as $row) {
                                        try {
                                            ?>
                                            <option value="<?php echo $row->province_id; ?>" <?php if ($row->province_id == $model->province_id) echo 'selected' ?>><?php echo $row->name; ?></option>
                                            <?php
                                        } catch (Exception $ex) {
                                            continue;
                                        }
                                    }
                                } else {
                                    echo '<option value="0"> Please select</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">State</div></label>
                        <div class="col-sm-10">
                            <select id="state" name="Customeraddress[state]" class="form-control" onchange="checkdistrict()">
                                <?php
                                if ($model->province_id != 0 && $model->country_id != 0) {
                                    $states = backend\models\State::find()->where(['province_id' => $model->province_id, 'country_id' => $model->country_id])->all();
                                    ?>
                                    <option value="0"> Please select</option>
                                    <?php
                                    foreach ($states as $row) {
                                        try {
                                            ?>
                                            <option value="<?php echo $row->state_id; ?>" <?php if ($row->state_id == $model->state_id) echo 'selected' ?>><?php echo $row->name; ?></option>
                                            <?php
                                        } catch (Exception $ex) {
                                            continue;
                                        }
                                    }
                                } else {
                                    echo '<option value="0"> Please select</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">District</div></label>
                        <div class="col-sm-10">
                            <select id="district" name="Customeraddress[district]" class="form-control">
                                <option value="0"> Please select</option>
                                <?php
                                if ($model->province_id != 0 && $model->country_id != 0 && $model->state_id != 0) {
                                    $districts = backend\models\District::find()->where(['state_id' => $model->state_id])->all();
                                    foreach ($districts as $row) {
                                        try {
                                            ?>
                                            <option value="<?php echo $row->district_id; ?>" <?php if ($row->district_id == $model->district_id) echo 'selected' ?>><?php echo $row->name; ?></option>
                                            <?php
                                        } catch (Exception $ex) {
                                            continue;
                                        }
                                    }
                                }
                                else{
                                    echo '<option value="0"> Please select</option>"';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">ZIP/Postal Code</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[postcode]" class="form-control" value="<?php echo $model->postcode; ?>"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Home phone</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[phone]" class="form-control" value="<?php echo $model->phone; ?>"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Mobile phone</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customeraddress[phone_mobile]" class="form-control" value="<?php echo $model->phone_mobile; ?>"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Other</div></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="Customeraddress[other]"><?php echo $model->other; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-12">
                            <button class="btn btn-default pull-right"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            </section>