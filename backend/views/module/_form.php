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
                        <?= $form->field($model, 'module_controller')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'module_name')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Module Group</label>
                        <select class="form-control" name="Module[module_group_id]" id="visibility">
                            <?php
                            $modulegroup = \backend\models\ModuleGroup::find()->orderBy('show_number ASC')->all();

                            foreach ($modulegroup as $row) {
                                ?>
                                <option value="<?php echo $row->module_group_id; ?>"><?php echo $row->module_group_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Show Number</label>
                        <select class="form-control" name="Module[show_number]" id="visibility">
                            <?php
                            $module = \backend\models\Module::find()->all();
                            for ($i = 1; $i <= count($module); $i++) {
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
