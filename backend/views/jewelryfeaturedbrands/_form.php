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
                        <?= $form->field($model, 'brands_brand_id')->textInput(['maxlength' => true]) ?>
                    </div>

                    <?php if ($model->brand_featured_jewelry_1 != '') { ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                            <div class="col-lg-10">
                                <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['brandAsset'] . $model->brand_featured_jewelry_1; ?>">
                            </div>
                        </div> 
                    <?php } ?>  

                    <div class="form-group">
                        <?= $form->field($model, 'brand_featured_jewelry_1')->fileInput(); ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'brand_link_rewrite_1')->textInput(); ?>
                    </div>

                    <?php if ($model->brand_featured_jewelry_2 != '') { ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                            <div class="col-lg-10">
                                <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['brandAsset'] . $model->brand_featured_jewelry_2; ?>">
                            </div>
                        </div> 
                    <?php } ?>  

                    <div class="form-group">
                        <?= $form->field($model, 'brand_featured_jewelry_2')->fileInput(); ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'brand_link_rewrite_2')->textInput(); ?>
                    </div>

                    

                    <div class="form-group">
                        <?= $form->field($model, 'brand_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => '']) ?>
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