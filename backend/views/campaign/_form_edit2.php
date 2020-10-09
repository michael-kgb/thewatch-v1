<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#information" data-toggle="tab">Bulkhead</a></li>

                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="information">
                        <?php $form = ActiveForm::begin() ?>
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Bulkhead Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="MarketingBulkhead[marketing_bulkhead_name]" id="inputEmail3" placeholder="Name" required="true" value="<?php echo $model->marketing_bulkhead_name; ?>">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Bulkhead Description</label>
                                <div class="col-sm-10">
                                    <textarea id="productdetail-description" class="form-control" rows="5" name="MarketingBulkhead[marketing_bulkhead_text]"><?php echo $model->marketing_bulkhead_text; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 3%;">Bulkhead Periode</label>
                                <div class="col-sm-5" style="margin-top: 3%;">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input type="text" class="form-control" placeholder="click to set date" id="example1" required="true" name="MarketingBulkhead[marketing_bulkhead_date_from]" value="<?php echo $model->marketing_bulkhead_date_from;?>">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> From
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-5" style="margin-top: 3%;">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input type="text" class="form-control" placeholder="click to set date" id="example1" required="true" name="MarketingBulkhead[marketing_bulkhead_date_to]" value="<?php echo $model->marketing_bulkhead_date_to;?>">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> To
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="MarketingBulkhead[marketing_bulkhead_type]">
                                        <option value="bottom" <?php if($model->marketing_bulkhead_type == 'bottom'){echo "selected";}?>>Bottom</option>
                                        <option value="top" <?php if($model->marketing_bulkhead_type == 'top'){echo "selected";}?>>Top</option>
                                        <option value="both" <?php if($model->marketing_bulkhead_type == 'both'){echo "selected";}?>>Bottom & Top</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="MarketingBulkhead[marketing_bulkhead_status]">
                                        <option value="1" <?php if($model->marketing_bulkhead_status == 1){echo "selected";}?>>Active</option>
                                        <option value="0" <?php if($model->marketing_bulkhead_status == 0){echo "selected";}?>>Deactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 4%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                   
                </div>
            </div><!-- /tabbable -->
        </div><!-- /col -->
    </div><!-- /row -->
</section>