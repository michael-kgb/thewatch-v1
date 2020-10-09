<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Brands
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Brands</a></li>
    <li><a href="#">Create</a></li>
  </ol>
</section>

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

                	<?php if ($model->category_menu_picture_image != '') { ?>
                                <div class="form-group" style="padding: 2% 0 3% 0;">
                                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                                    <div class="col-lg-10">
                                        <img width="25%" height="25%" src="../../../../frontend/web/img/header/<?php echo $model->category_menu_picture_image; ?>">
                                    </div>
                                </div> 
                            <?php } ?>  

                            <div class="form-group">
                                <?= $form->field($model, 'category_menu_picture_image')->fileInput(); ?>
                            </div>

                    <div class="form-group">
                        <?= $form->field($model, 'category_menu_picture_name')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'category_menu_picture_text')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'category_menu_picture_link')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="CategoryMenuPicture[category_menu_picture_status]">
                                        <option value="1" <?php if($model->category_menu_picture_status == 1){echo "selected";}?>>Active</option>
                                        <option value="0" <?php if($model->category_menu_picture_status == 0){echo "selected";}?>>Deactive</option>
                                    </select>
                                </div>
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