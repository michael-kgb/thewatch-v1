<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\News */
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
                    <?= $form->field($model, 'news_caption')->textInput(['maxlength' => true]) ?>
                </div>
                  
                <div class="form-group">
                    <?= $form->field($model, 'news_description')->textarea(['rows' => 6]) ?>
                </div>
                
                <?php if($model->news_thumbnail != '') { ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Images : </label>
                    <div class="col-lg-10">
                        <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['newsAsset'] . $model->news_thumbnail; ?>">
                    </div>
                </div> 
                <?php } ?>    
                  
                <div class="form-group">  
                    <?= $form->field($model, 'news_thumbnail')->fileInput() ?>
                </div>
                
                <div class="form-group">  
                    <?= $form->field($model, 'news_video_url')->textInput(['maxlength' => true]) ?>
                </div>
                
                <div class="form-group">
                    <?= $form->field($model, 'news_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
                </div>
                
                <div class="form-group">
                    <?= $form->field($model, 'news_featured')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => '']) ?>
                </div>
                
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
              </div>
          </div>
        </div>
    </div>
</section>
