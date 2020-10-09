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
            <div class="box box-primary">
                <!-- form start -->
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="box-body">

                    <div class="form-group">
                        <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    
                    <div class="form-group">
                        <?= $form->field($model, 'brand_description')->textInput(['maxlength' => true]) ?>
                    </div>
                    
                    <div class="form-group">
                        <?= $form->field($model, 'brand_country')->textInput(['maxlength' => true]) ?>
                    </div>

                    <?php if ($model->brand_logo != '') { ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                            <div class="col-lg-10">
                                <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['brandAsset'] . $model->brand_logo; ?>">
                            </div>
                        </div> 
                    <?php } ?>  

                    <div class="form-group">
                        <?= $form->field($model, 'brand_logo')->fileInput(); ?>
                    </div>

                    <div class="form-group">
                        <div class="form-group field-brands-brand_logo required">
                            <label class="control-label" for="brands-brand_logo">Brand Banner</label>
                            <input type="file" id="brands-brand_logo" name="Brands[brand_banner]">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-group field-brands-brand_logo required">
                            <label class="control-label" for="brands-brand_logo">Brand Banner Detail</label>
                            <input type="file" id="brands-brand_logo" name="Brands[brand_banner_detail]">
                            <div class="help-block"></div>
                        </div>
                    </div>
					
					<div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Meta Description</div></label>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <textarea id="meta_description" name="Brands[meta_description]" rows="10" cols="80">
                                <?php echo $model->meta_description; ?>
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Meta Keywords</div></label>
                        <div class="col-sm-10" style="margin-bottom: 4%;">
                            <textarea id="meta_keywords" name="Brands[meta_keywords]" rows="10" cols="80">
                                <?php echo $model->meta_keywords; ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'brand_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => '']) ?>
                    </div>
                    
                    <div class="form-group">
                        <?= $form->field($model, 'brand_homepage')->dropDownList([ '1' => 'Yes', '0' => 'No',], ['prompt' => '']) ?>
                    </div>
                    
                    <div class="form-group">
                        <?= $form->field($model, 'brand_homepage_jewelry')->dropDownList([ '1' => 'Yes', '0' => 'No',], ['prompt' => '']) ?>
                    </div>
                    
                    <div class="form-group">
                        <?= $form->field($model, 'brands_menu_type')->dropDownList([ 'new' => 'new', 'hot' => 'hot','sale' => 'sale',], ['prompt' => '']) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>