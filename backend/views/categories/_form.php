<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="box-body">
                    <div class="form-group" style="padding: 4% 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Brand Name : </div></label>
                        <div class="col-sm-10">
                            <input type="text" name="productcategory[name]" class="form-control" value="<?php echo $model->product_category_name; ?>" disabled/>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Existing Image : </div></label>
                        <div class="col-sm-10" style="padding-bottom: 50px;">
                            <img src="../../../../frontend/web/img/category/<?php echo $model->product_category_images; ?>"/>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 0 0 2% 0;">
                        <label for="inputEmail3" class="col-sm-2 control-label"><div class="pull-right">Change Image : </div></label>
                        <div class="col-sm-10">
                            <input type="file" name="category_image"/>
                        </div>
                    </div>
                    <div class="form-group" style="padding: 2% 0 2% 0;">
                        <div class="col-sm-12">
                            <button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div><!-- /.box -->
            </div>
        </div>
</section>