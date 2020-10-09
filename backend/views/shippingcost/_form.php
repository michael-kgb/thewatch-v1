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
                <!-- form start -->
                <?php
                $form = ActiveForm::begin();
                $names = json_decode(file_get_contents("http://country.io/names.json"), true);
                ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <div class="box-body">

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Carrier Name : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" name="CarrierCost[carrier]" id="carrier" onchange="checkcarrierpackage()">
                                <option value="0">Please Select</option>
                                <?php
                                $carrier = \backend\models\Carrier::find()->all();
                                foreach ($carrier as $row) {
                                    ?>
                                    <option value="<?php echo $row->carrier_id ?>"><?php echo $row->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Carrier Package : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" name="CarrierCost[carrier_package_detail]" id="carrier-package">
                                <option value="0">Please Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Country : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" id="country" onchange="checkprovincecarrier()">
                                <option value="0">Please Select</option>
                                <?php
                                $country = \backend\models\Country::find()->orderBy('iso_code ASC')->all();
                                foreach ($country as $row) {
                                    try {
                                        if ($names[$row->iso_code]) {
                                            ?>
                                            <option value="<?php echo $row->country_id ?>"><?php echo $names[$row->iso_code]; ?></option>
                                            <?php
                                        }
                                    } catch (Exception $ex) {
                                        ?>
                                        <option value="<?php echo $row->country_id ?>"><?php echo $row->iso_code; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Province : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" id="province" onchange="checkstatecreate()">
                                <option value="0">Please Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">State : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" id="state" onchange="checkdistrictcreate()">
                                <option value="0">Please Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">District : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" name="CarrierCost[district]" id="district" required>
                                <option value="0">Please Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Day : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="CarrierCost[day]" placeholder="Example : 1 - 2"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Price : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="CarrierCost[price]" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Status : </label>
                        </div>
                        <div class="col-sm-10">
                            <select class="form-control" name="CarrierCost[status]" id="carrier-package">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="box-footer">
                        <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</section>
