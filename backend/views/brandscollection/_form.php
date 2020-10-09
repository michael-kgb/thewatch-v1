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
                        <label class="control-label" for="group_id">Brand Name</label>
                        <select class="form-control" name="BrandsCollection[brands_brand_id]" id="visibility">
                            <?php
                            $brands = \backend\models\Brands::find()->orderBy('brand_name ASC')->all();
                            foreach ($brands as $row) {
                                ?>
                                <option value="<?php echo $row->brand_id ?>"><?php echo $row->brand_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'brands_collection_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label" for="group_id">Brands Collection Status</label>
                        <select class="form-control" name="BrandsCollection[brands_collection_status]" id="visibility">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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