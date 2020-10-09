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
                        <?= $form->field($model, 'departement_name')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Companies</label>
                        <select class="form-control" name="Departements[companies_company_id]" id="visibility">
                            <?php
                            $branches = \backend\models\Companies::find()->all();
                            foreach ($branches as $row) {
                                ?>
                                <option value="<?php echo $row->company_id ?>"><?php echo $row->company_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Branches</label>
                        <select class="form-control" name="Departements[branches_branch_id]" id="visibility">
                            <?php
                            $branches = \backend\models\Branches::find()->all();
                            foreach ($branches as $row) {
                                ?>
                                <option value="<?php echo $row->branch_id ?>"><?php echo $row->branch_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Status</label>
                        <select class="form-control" name="Departements[departement_status]" id="visibility">
                            <option value="active"> Active</option>
                            <option value="Inactive"> Inactive</option>
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
