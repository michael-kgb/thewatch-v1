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
                <?php $form = ActiveForm::begin(['id' => 'SignupForm','options' => [ 'enctype' => 'multipart/form-data']]); ?>

                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <div class="box-body">
                    <div class="form-group">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">  
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>

                    <div class="form-group">  
                        <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">    
                        <input type="file" name="image" />
                    </div>

                    <div class="form-group">  
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Departement</label>
                        <select class="form-control" name="SignupForm[departement_id]" id="visibility">
                            <?php
                            $departement = \backend\models\Departements::find()->all();
                            foreach ($departement as $row) {
                                ?>
                                <option value="<?php echo $row->departement_id ?>"><?php echo $row->departement_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
					
					<div class="form-group">
                        <label class="control-label" for="group_id">Work Location</label>
                        <select class="form-control" name="SignupForm[store_id]" id="visibility">
                            <?php
                            $stores = \backend\models\Stores::find()->where(['store_status'=>'active'])->all();
                            foreach ($stores as $row) {
                                ?>
                                <option value="<?php echo $row->store_id ?>"><?php echo $row->store_name . ' ' . $row->store_address; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="group_id">Group Category</label>
                        <select class="form-control" name="SignupForm[group_id]" id="visibility">
                            <?php
                            $group_category = backend\models\Group::find()->all();
                            foreach ($group_category as $row) {
                                ?>
                                <option value="<?php echo $row->id ?>"><?php echo $row->group_name; ?></option>
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
