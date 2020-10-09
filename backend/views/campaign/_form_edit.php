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
                    <li class="active"><a href="#information" data-toggle="tab">Information</a></li>

                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="information">
                        <?php $form = ActiveForm::begin() ?>
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Campaign Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="MarketingCampaign[marketing_campaign_name]" id="inputEmail3" placeholder="Name" required="true" value="<?php echo $model->marketing_campaign_name; ?>">
                                </div>
                            </div>
                            <?php if ($model->marketing_campaign_banner != '') { ?>
                                <div class="form-group" style="padding: 2% 0 3% 0;">
                                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                                    <div class="col-lg-10">
                                        <img width="50%" height="50%" src="../../../../frontend/web/img/campaign/<?php echo $_GET['id']; ?>/<?php echo $model->marketing_campaign_banner; ?>">
                                    </div>
                                </div> 
                            <?php } ?> 
                            <div class="form-group">
                                <?= $form->field($model, 'marketing_campaign_banner')->fileInput(); ?>
                            </div>
                            <div class="clearfix"></div> 
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Campaign Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" name="MarketingCampaign[marketing_campaign_description]"><?php echo $model->marketing_campaign_description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top: 3%;">Campaign Periode</label>
                                <div class="col-sm-5" style="margin-top: 3%;">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input type="text" class="form-control" placeholder="click to set date" id="example1" required="true" name="MarketingCampaign[marketing_campaign_date_from]" value="<?php echo $model->marketing_campaign_date_from;?>">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> From
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-5" style="margin-top: 3%;">
                                    <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                        <input type="text" class="form-control" placeholder="click to set date" id="example1" required="true" name="MarketingCampaign[marketing_campaign_date_to]" value="<?php echo $model->marketing_campaign_date_to;?>">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span> To
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="MarketingCampaign[marketing_campaign_link]" id="inputEmail3" placeholder="http://" required="true" value="<?php echo $model->marketing_campaign_link; ?>">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Related Products</label>
                                <div class="col-sm-10">
                                    <?php $products = \backend\models\Product::getAllProducts(); ?>
                                    <select id="prod-select2" multiple class="form-control kota" name="marketing_campaign_product[]">
                                        <?php foreach ($products as $product) { ?>
                                            <?php 
                                            $cek = 0;
                                            foreach ($model2 as $prod) { 
                                                if($prod->product_id == $product->product_id){
                                                    $cek = 1;
                                                }
                                            }?>
                                    
                                        <option value="<?php echo $product->product_id;?>" <?php if($cek == 1){ echo 'selected';}?>><?php echo $product->brands->brand_name . ' - ' . $product->productDetail->name;?></option>
                                        

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="MarketingCampaign[marketing_campaign_status]">
                                        <option value="1" <?php if($model->marketing_campaign_status == 1){echo "selected";}?>>Active</option>
                                        <option value="0" <?php if($model->marketing_campaign_status == 0){echo "selected";}?>>Deactive</option>
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