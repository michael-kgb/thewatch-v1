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
                    <?= $form->field($model, 'homebanner_name')->textInput(['maxlength' => true]) ?>
                </div>
                
                <?php if($model->homebanner_images != '') { ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                    <div class="col-lg-10">
                        <img width="50%" height="50%" src="../../../../frontend/web/img/homebanner/<?php echo $model->homebanner_images; ?>">
                    </div>
                </div> 
                <?php } ?>
                  
                <div class="form-group">
                    <?= $form->field($model, 'homebanner_images')->fileInput(); ?>
                </div>
                
                <?php if($model->homebanner_images_mobile != '') { ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images Mobile: </label>
                    <div class="col-lg-10">
                        <img width="50%" height="50%" src="../../../../frontend/web/img/homebanner/<?php echo $model->homebanner_images_mobile; ?>">
                    </div>
                </div> 
                <?php } ?>
                  
                <div class="form-group">
                    <?= $form->field($model, 'homebanner_images_mobile')->fileInput(); ?>
                </div>
                  
                <div class="form-group">
                    <?= $form->field($model, 'homebanner_description')->textInput() ?>
                </div>
                
                <div class="form-group">  
                    <?= $form->field($model, 'homebanner_sequence')->dropDownList([ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ], ['prompt' => '']) ?>
                </div>
                
                <div class="form-group">  
                    <?= $form->field($model, 'homebanner_has_link')->dropDownList([ '0' => '0', '1' => '1'],['prompt' => '']) ?>
                </div>
                  
                <div class="form-group">  
                    <?= $form->field($model, 'homebanner_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
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
