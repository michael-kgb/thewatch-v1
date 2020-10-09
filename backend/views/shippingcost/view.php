<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        View Shipping Cost 
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Shipping</a></li>
        <li><a href="#">Shipping Cost</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- Horizontal Form -->
            <?php $form = ActiveForm::begin(); ?>
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-map-marker"></i> <?php echo $model->carrier->name . ' - ' . $model->district->name . ' - ' . $model->carrierPackageDetail->carrierPackage->carrier_package_name; ?>
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Carrier Name : </label>
                        </div>
                        <div class="col-sm-10">
                            <label for="inputEmail3" class="col-sm-2 control-label pull-left"><?php echo $model->carrier->name . ' - ' . $model->carrierPackageDetail->carrierPackage->carrier_package_name; ?></label>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Country Name : </label>
                        </div>
                        <div class="col-sm-10">
                            <label for="inputEmail3" class="col-sm-2 control-label pull-left"><?php echo $model->district->country->iso_code; ?></label>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Province Name : </label>
                        </div>
                        <div class="col-sm-10">
                            <label for="inputEmail3" class="col-sm-2 control-label pull-left"><?php echo $model->district->state->province->name; ?></label>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">State Name : </label>
                        </div>
                        <div class="col-sm-10">
                            <label for="inputEmail3" class="col-sm-2 control-label pull-left"><?php echo $model->district->state->name; ?></label>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">District Name : </label>
                        </div>
                        <div class="col-sm-10">
                            <label for="inputEmail3" class="col-sm-2 control-label pull-left"><?php echo $model->district->name; ?></label>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Day : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="CarrierCost[day]" class="form-control" value="<?php echo $model->day; ?>"/>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0% 0 2% 0;">
                        <div class="col-sm-2">
                            <label for="inputEmail3" class="control-label pull-right">Price : </label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="CarrierCost[price]" class="form-control" value="<?php echo $model->price; ?>"/>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0% 0 2% 0;">
                        <div class="col-sm-12 pull-right">
                            <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" style="margin-left: 30px;">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                <i class="fa fa-eye"></i> View All
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
