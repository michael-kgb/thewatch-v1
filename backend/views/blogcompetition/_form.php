<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KontesSeoContent */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="kontes-seo-content-form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'id')->textInput(['type'=>'hidden']) ?>

                <?= $form->field($model, 'syarat_ketentuan')->textarea(['rows' => 6,'id' => 'productdetail-description']) ?>

                <?= $form->field($model, 'sistem_penilaian')->textarea(['rows' => 6,'id' => 'productdetail-spesification']) ?>
				
				<?= $form->field($model, 'jadwal')->textarea(['rows' => 6,'id' => 'jadwal-spesification']) ?>

                <?= $form->field($model, 'kebutuhan')->textarea(['rows' => 6,'id' => 'short-description']) ?>

                <?= $form->field($model, 'juara1')->textarea(['rows' => 6,'id' => 'journaldetail-description']) ?>

                <?= $form->field($model, 'juara2')->textarea(['rows' => 6,'id' => 'journaldetail-content']) ?>

                <?= $form->field($model, 'juara3')->textarea(['rows' => 6,'id' => 'juara1-description']) ?>

                <?= $form->field($model, 'juara4')->textarea(['rows' => 6,'id' => 'juara2-description']) ?>

                <?= $form->field($model, 'juara11')->textarea(['rows' => 6,'id' => 'juara3-description']) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
