<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<section id="breadcrumb">
    <div class="container">
        <div class="row">
        </div>
    </div>
</section>
<section id="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 gotham-medium fsize-2 pbottom3 text-center about-title">
                RESET PASSWORD
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::base() . '/customer/reset-password?token=' . $_GET['token'], "id" => "resetpassword-form"]) ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 gotham-light" style="padding-left: 0px; padding-bottom: 4%;">
                        NEW PASSWORD
                    </div>
                    <div class="col-lg-9 col-xs-8" style="padding-right: 0px; padding-left: 0px; padding-bottom: 4%;">
                        <input id="new_password" class="email" type="password" name="new_password">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 gotham-light" style="padding-left: 0px; padding-bottom: 4%;">
                        CONFIRM PASSWORD
                    </div>
                    <div class="col-lg-9 col-xs-8" style="padding-right: 0px; padding-left: 0px; padding-bottom: 4%;">
                        <input id="confirm_password" class="email" type="password" name="confirm_password">
                    </div>
                    <div class="col-lg-12 col-xs-12" style="padding-right: 0px;">
                        <div class="pull-right">
                            <input type="submit" value="SUBMIT" id="submit-reset" class="btn-submit">
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>