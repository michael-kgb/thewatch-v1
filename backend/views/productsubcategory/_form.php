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
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Sub Category Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ProductSubCategory[product_sub_category_name]" id="inputEmail3" placeholder="Name" required="true" value="<?php echo $model->product_sub_category_name; ?>">
                                </div>
                            </div>
                            <?php if ($model->product_sub_category_image != '') { ?>
                                <div class="form-group" style="padding: 2% 0 3% 0;">
                                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                                    <div class="col-lg-10">
                                        <img width="50%" height="50%" src="<?php echo '../../../../frontend/web/img/category/' . $model->product_sub_category_image; ?>">
                                    </div>
                                </div> 
                            <?php } ?>  

                            <div class="form-group">
                                <?= $form->field($model, 'product_sub_category_image')->fileInput(); ?>
                            </div>

                            <?php if ($model->product_sub_category_image_mobile != '') { ?>
                                <div class="form-group" style="padding: 2% 0 3% 0;">
                                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images Mobile: </label>
                                    <div class="col-lg-10">
                                        <img width="50%" height="50%" src="<?php echo '../../../../frontend/web/img/category/' . $model->product_sub_category_image_mobile; ?>">
                                    </div>
                                </div> 
                            <?php } ?>  

                            <div class="form-group">
                                <?= $form->field($model, 'product_sub_category_image_mobile')->fileInput(); ?>
                            </div>

                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Category Related</label>
                                <div class="col-sm-10">
                                <?php $category = \backend\models\ProductCategory::find()->all();?>
                                    <select class="form-control" name="ProductSubCategory[product_category_id]">
                                        <?php foreach($category as $row){?>
                                        <option value="<?php echo $row->product_category_id;?>" <?php if($model->product_category_id == $row->product_category_id){echo 'selected';}?>><?php echo $row->product_category_name;?></option>
                                       

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ProductSubCategory[product_sub_category_link]" id="inputEmail3" placeholder="link rewrite" required="true" value="<?php echo $model->product_sub_category_link; ?>">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProductSubCategory[product_sub_category_status]">
                                        <option value="active" <?php if($model->product_sub_category_status == 'active'){echo 'selected';}?>>Active</option>
                                        <option value="inactive" <?php if($model->product_sub_category_status == 'inactive'){echo 'selected';}?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
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
