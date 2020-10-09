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
                        <label class="control-label" for="group_id">Company Name</label>
                        <select class="form-control" name="Branches[companies_company_id]" id="visibility">
                            <?php
                            $company = \backend\models\Companies::find()->all();
                            foreach ($company as $row) {
                                ?>
                                <option value="<?php echo $row->company_id ?>"><?php echo $row->company_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Branch Status</label>
                        <select class="form-control" name="Branches[branch_status]" id="visibility">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
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
