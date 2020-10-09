<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <?php $form = ActiveForm::begin(); ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <div class="box-body">

                    <div class="form-group">
                        <?= $form->field($model, 'module_group_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    
                    <div class="form-group">
                        <?= $form->field($model, 'glyphicon')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Show Number</label>
                        <select class="form-control" name="ModuleGroup[show_number]" id="visibility">
                            <?php
                            $modulegroup = \backend\models\ModuleGroup::find()->all();

                            for ($i = 1; $i <= count($modulegroup)+1; $i++) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="box-footer">
                        <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
</section>
