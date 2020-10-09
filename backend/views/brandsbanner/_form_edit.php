<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div id="brand_image" class="box box-primary">
                <!-- form start -->
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="box-body">

                    <div class="form-group" style="padding: 4% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Name</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Brands[brand_name]" class="form-control" value="<?php echo $model->brand_name; ?>"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Description</div></label>
                        <div class="col-sm-10">
                            <textarea name="Brands[brand_description]" class="form-control"><?php echo $model->brand_description; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Name</div></label>
                        <div class="col-sm-10">
                            <input type="text" name="Brands[brand_country]" class="form-control" value="<?php echo $model->brand_country; ?>"/>
                        </div>
                    </div>

                    <?php if ($model->brand_logo != '') { ?>
                        <div class="form-group" style="padding: 2% 0 2% 0;">
                            <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Existing Logo</div></label>
                            <div class="col-lg-10">
                                <img height="100px" src="/twcnew/frontend/web/img/brands/black/<?php echo $model->brand_logo; ?>">
                            </div>
                        </div> 
                    <?php } ?>  
                    <?php
                    $brandbanner = \backend\models\BrandsBanner::find()->where(['brands_brand_id' => $model->brand_id])->one();
                    if (!empty($brandbanner)) {
                        ?>
                        <div class="form-group" style="padding: 10% 0 2% 0;">
                            <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Existing Brand Banner</div></label>
                            <div class="col-lg-10">
                                <img height="150px" src="/twcnew/frontend/web/img/brand_identity/<?php echo $brandbanner->brand_banner_small_banner; ?>">
                            </div>
                        </div> 
                    <?php } ?>  

                    <div class="clearfix"></div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Change Brand Logo</div></label>
                        <div class="col-sm-10">
                            <input type="file" name="Brands[brand_logo]"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Change Brand Banner</div></label>
                        <div class="col-sm-10">
                            <input type="file" name="Brands[brand_banner]"/>
                        </div>
                    </div>

                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Status</div></label>
                        <div class="col-sm-10">
                            <?= $form->field($model, 'brand_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => ''])->label(false) ?>
                        </div>
                    </div>

                    <div class="pull-right">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>