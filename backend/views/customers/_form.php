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
                $customer_group = \backend\models\CustomerGroup::find()->all();
                $allgender = \backend\models\Gender::find()->all();
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
                    <div class="form-group" style="padding: 0 0 6% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Social title</div></label>
                        <div class="col-sm-10">
                            <?php
                            foreach ($allgender as $row) {
                                ?>
                                <input type="radio" name="Customer[gender]" value="<?php echo $row->name; ?>" required> <?php echo $row->name; ?><br>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">First Name</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customer[firstname]" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Last Name</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customer[lastname]" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Email address</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Customer[email]" class="form-control" required/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Password</div></label>
                        <div class="col-sm-10">
                            <input type="password" name="Customer[password]" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Birthday</div></label>
                        <div class="col-sm-3">
                            <select name="Customer[birthday_day]" class="form-control">
                                <?php
                                $date = new DateTime($model->birthday);
                                for ($i = 1; $i <= 31; $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <select name="Customer[birthday_month]" class="form-control">
                                <?php
                                $array = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                for ($i = 0; $i < 12; $i++) {
                                    ?>
                                    <option value="<?php echo str_pad($i + 1, 2, "0", STR_PAD_LEFT); ?>"><?php echo $array[$i]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <select name="Customer[birthday_year]" class="form-control">
                                <?php
                                for ($i = (new DateTime)->format("Y"); $i >= 1980; $i--) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Enabled</div></label>
                        <div class="col-sm-10">
                            <input name="Customer[active]" id="switch-enabled" type="checkbox" value="1" data-size="mini">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Newsletter</div></label>
                        <div class="col-sm-10">
                            <input name="Customer[newsletter]" id="switch-enabled2" type="checkbox" value="1" data-size="mini">
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Group</div></label>
                        <div class="col-sm-10">
                            <?php
                            foreach ($customer_group as $row) {
                                ?>
                                <input type="radio" name="Customer[customer_group]" value="<?php echo $row->customer_group_id; ?>"> <?php echo $row->name; ?><br>
                                <?php
                            }
                            ?>
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
