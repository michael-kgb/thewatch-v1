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
                <div class="form-group">
                  <?= $form->field($model, 'company_name')->textInput() ?>
                </div>
                
                <?php if($model->company_logo != '') { ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-lg-2 control-label">Existing Logo : </label>
                    <div class="col-lg-10">
                        <img width="50%" height="50%" src="<?php echo Yii::$app->urlManager->getBaseUrl() . Yii::$app->params['logoAsset'] . $model->company_logo; ?>">
                    </div>
                </div> 
                <?php } ?>
                  
                <div class="form-group">
                  <?= $form->field($model, 'company_logo')->fileInput() ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'company_email')->textInput() ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'company_address')->textarea() ?>
                </div>
                  
                <div class="form-group">
                  <?= $form->field($model, 'company_about')->textarea() ?>
                </div>
                  
                <div class="form-group">
                  <?= $form->field($model, 'company_profile')->textarea() ?>
                </div>
                  
                <div class="form-group">
                  <?= $form->field($model, 'company_phone')->textInput() ?>
                </div>
                <div class="form-group">
                  <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
                </div>
              </div><!-- /.box-body -->

              <div class="box-footer">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
              </div>
            <?php ActiveForm::end(); ?>
          </div><!-- /.box -->
        </div>
    </div>
</section>